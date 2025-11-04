<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

        public function __construct() {
         parent::__construct();
        $this->load->model('Homemodel');
        $this->load->model('Cartmodel');
        $this->load->library('session');
        $this->load->helper('url');
         $this->load->helper('cookie'); // ✅ load cookie helper

 if (!$this->session->userdata('guest_token')) {
        $token = bin2hex(random_bytes(8));
        $this->session->set_userdata('guest_token', $token);
    } else {
        $token = $this->session->userdata('guest_token');
    }
    }
    public function index($category_id = null, $sub_category_id = null) 
{ 
    
    //  $this->session->set_userdata('order-type');
    $data['ordertype'] = $this->session->userdata('order-type');
    // print_r($data['ordertype']);
    $ordertype = $data['ordertype'];
    $data['selected_category_id'] = $category_id;
    $data['selected_subcategory_id'] = $sub_category_id;
    $category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
    $subcategory = $this->Homemodel->getsubCategoryById($sub_category_id); // Create this method if not present
    if ($category_id !== null && $sub_category_id !== null) {
        $data['name'] =  $subcategory['name'];
        $data['product'] = $this->Homemodel->get_product_by_catsubid($category_id, $sub_category_id, $ordertype);
        // print_r($data['product']);
    } elseif ($category_id !== null) {
        $data['name'] =  $category['category_name'];
        $data['product'] = $this->Homemodel->get_product_by_categoryid($category_id);
    } 
   
    else {
        $data['name'] = "Products";
        $data['product'] = $this->Homemodel->get_all_product();
        // print_r($data['product']);
    }
     if($ordertype == 'exp')
    {
        $data['name'] = "Export Product";
        $data['product'] = $this->Homemodel->get_all_export($category_id, $sub_category_id);

    }

    // print_r($data['product']);
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['categories']=$this->Homemodel->listcategories();
        $token= $this->session->userdata('guest_token');
         $data['cart']= $this->Cartmodel->cartproducts($token);
         $data['store']=$this->Homemodel->getstore();
    // print_r($data['product']);
    $this->load->view('website/header', $data);
    $this->load->view('website/product', $data);
      $this->load->view('website/footer',$data);
}


//search in website
public function search(){
    $search = $this->input->get('search');
    $token = $this->session->userdata('guest_token');
    $data['headercategory']=$this->Homemodel->listheadercategories();
    $data['footercategory']=$this->Homemodel->listfootercategories();
    $data['store']=$this->Homemodel->getstore();
    $data['subcategories']=$this->Homemodel->getsubcategories();
    // $data['productdetails']=$this->Homemodel->getproductdetails($id);
    $data['ordertype'] = $this->session->userdata('order-type');
    $search = $this->input->get('search');
    $data['searchproduct'] = $this->Homemodel->searchProduct($search);
    $data['searchcategories'] = $this->Homemodel->getcategoryBysearchId($search);

  //echo json_encode(['success' => 'success', 'data' => $data['searchproduct'],'category' => $data['searchcategories']]);
    // print_r($data['searchproduct']);
    $data['cart']= $this->Homemodel->cartproducts($token);
// print_r($data['searchproduct']);
  $this->load->view('website/header', $data);
  $this->load->view('website/search', $data);
  $this->load->view('website/footer',$data);





}

}
?>