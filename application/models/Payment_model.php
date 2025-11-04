<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Save transaction details
     */
    public function save_transaction($data) {
        return $this->db->insert('transactions', $data);
    }
    
    /**
     * Update transaction status
     */
    public function update_transaction($order_id, $data) {
        $this->db->where('order_id', $order_id);
        return $this->db->update('transactions', $data);
    }
    
    /**
     * Get transaction by order ID
     */
    public function get_transaction($order_id) {
        $this->db->where('order_id', $order_id);
        return $this->db->get('transactions')->row_array();
    }
    
    /**
     * Get all transactions
     */
    public function get_all_transactions() {
        return $this->db->get('transactions')->result_array();
    }
}