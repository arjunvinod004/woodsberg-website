<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stockcheck extends CI_Controller {

    public function index()
    {
       $product_id= $this->input->post('product_id');
       $this->load->model('Homemodel');
    //    echo $product_id;
       if($product_id){
        $stock = $this->Homemodel->getCurrentStock($product_id);
        
        
        echo json_encode(['success' => 'success', 'stock' => $stock]);
        
       }

      
    //   $this->load->view('website/stockcheck');
    }
}
?>