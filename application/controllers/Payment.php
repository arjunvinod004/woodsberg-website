<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('federal_payment');
        $this->load->model('payment_model');
        $this->load->helper('url');
    }
    
    /**
     * Display checkout page
     */
    public function payments() {
        // $data['title'] = 'Checkout';
        $this->load->view('website/payment');
    }
    
    /**
     * Process payment initiation
     */
    public function process() {
        // Get form data
        $order_data = array(
            'order_id' => 'ORD' . time() . rand(1000, 9999),
            'amount' => $this->input->post('amount'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_phone' => $this->input->post('customer_phone'),
            'billing_address' => $this->input->post('billing_address')
        );
        
        // Validate required fields
        if (empty($order_data['amount']) || empty($order_data['customer_name']) || 
            empty($order_data['customer_email'])) {
            $this->session->set_flashdata('error', 'Please fill all required fields.');
            redirect('payment/checkout');
            return;
        }
        
        // Save transaction to database
        $transaction_data = array(
            'order_id' => $order_data['order_id'],
            'customer_name' => $order_data['customer_name'],
            'customer_email' => $order_data['customer_email'],
            'customer_phone' => $order_data['customer_phone'],
            'amount' => $order_data['amount'],
            'status' => 'pending'
        );
        
        $this->payment_model->save_transaction($transaction_data);
        
        // Generate payment form data
        $form_data = $this->federal_payment->generate_form($order_data);
        echo $form_data;
        $gateway_url = $this->federal_payment->get_gateway_url();
        
        $data = array(
            'form_data' => $form_data,
            'gateway_url' => $gateway_url,
            'title' => 'Payment Processing'
        );
        
        $this->load->view('website/gateway', $data);
    }
    
    /**
     * Handle successful payment response
     */
    public function success() {
        $response_data = $this->input->post();
        
        if (empty($response_data)) {
            $response_data = $this->input->get();
        }
        
        // Verify hash
        if (!$this->federal_payment->verify_hash($response_data)) {
            $this->session->set_flashdata('error', 'Invalid payment response.');
            redirect('payment/failure');
            return;
        }
        
        // Update transaction status
        $update_data = array(
            'status' => ($response_data['status'] == 'success') ? 'completed' : 'failed',
            'transaction_id' => $response_data['transaction_id'],
            'payment_method' => $response_data['payment_method'],
            'gateway_response' => json_encode($response_data)
        );
        
        $this->payment_model->update_transaction($response_data['order_id'], $update_data);
        
        if ($response_data['status'] == 'success') {
            $data = array(
                'title' => 'Payment Successful',
                'transaction_data' => $response_data
            );
            $this->load->view('payment_success', $data);
        } else {
            redirect('payment/failure');
        }
    }
    
    /**
     * Handle payment failure
     */
    public function failure() {
        $data['title'] = 'Payment Failed';
        $this->load->view('payment_failure', $data);
    }
    
    /**
     * Handle payment cancellation
     */
    public function cancel() {
        $data['title'] = 'Payment Cancelled';
        $this->load->view('payment_failure', $data);
    }
    
    /**
     * Handle payment notification (webhook)
     */
    public function notify() {
        $response_data = $this->input->post();
        
        // Log the notification for debugging
        log_message('info', 'Federal Bank Payment Notification: ' . json_encode($response_data));
        
        // Verify and process the notification
        if ($this->federal_payment->verify_hash($response_data)) {
            $update_data = array(
                'status' => ($response_data['status'] == 'success') ? 'completed' : 'failed',
                'transaction_id' => $response_data['transaction_id'],
                'gateway_response' => json_encode($response_data)
            );
            
            $this->payment_model->update_transaction($response_data['order_id'], $update_data);
            
            // Send success response to gateway
            echo "OK";
        } else {
            echo "FAILED";
        }
    }
}