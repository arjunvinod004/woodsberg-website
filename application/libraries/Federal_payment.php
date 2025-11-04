<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Federal_payment {
    
    private $CI;
    private $config;
    
    public function __construct($params = array()) {
        $this->CI =& get_instance();
        $this->CI->load->config('payment_config');
        $this->config = $this->CI->config->item('federal_bank');
        
        if (!empty($params)) {
            $this->config = array_merge($this->config, $params);
        }
    }
    
    /**
     * Generate payment form data
     */
    public function generate_form($order_data) {
        print_r($order_data);
        $form_data = array(
            'merchant_id' => $this->config['merchant_id'],
            'order_id' => $order_data['order_id'],
            'amount' => $order_data['amount'],
            'currency' => $this->config['currency'],
            'customer_name' => $order_data['customer_name'],
            'customer_email' => $order_data['customer_email'],
            'customer_phone' => $order_data['customer_phone'],
            'billing_address' => $order_data['billing_address'],
            'return_url' => $this->config['return_url'],
            'cancel_url' => $this->config['cancel_url'],
            'notify_url' => $this->config['notify_url'],
            'timestamp' => date('Y-m-d H:i:s')
        );
        
        // Generate hash
        $form_data['hash'] = $this->generate_hash($form_data);
        
        return $form_data;
    }
    
    /**
     * Generate secure hash for the transaction
     */
    private function generate_hash($data) {
        $hash_string = $this->config['merchant_id'] . '|' .
                      $data['order_id'] . '|' .
                      $data['amount'] . '|' .
                      $data['currency'] . '|' .
                      $this->config['secret_key'];
        
        return hash($this->config['hash_method'], $hash_string);
    }
    
    /**
     * Verify payment response hash
     */
    public function verify_hash($response_data) {
        $hash_string = $response_data['merchant_id'] . '|' .
                      $response_data['order_id'] . '|' .
                      $response_data['amount'] . '|' .
                      $response_data['currency'] . '|' .
                      $response_data['status'] . '|' .
                      $this->config['secret_key'];
        
        $generated_hash = hash($this->config['hash_method'], $hash_string);
        
        return ($generated_hash === $response_data['hash']);
    }
    
    /**
     * Get gateway URL based on test/live mode
     */
    public function get_gateway_url() {
        return $this->config['test_mode'] ? 
               $this->config['gateway_url']['test'] : 
               $this->config['gateway_url']['live'];
    }
}