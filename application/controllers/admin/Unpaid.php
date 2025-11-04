<?php class Unpaid extends CI_Controller {
public function __construct() 
{   
    parent::__construct();
    $this->load->model('admin/Productmodel');
    $this->load->model('admin/Storemodel');
    $this->load->model('Homemodel');
    $this->load->library('pagination');
}

public function index(){
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$controller = $this->router->fetch_class(); // Gets the current controller name
$method = $this->router->fetch_method();   // Gets the current method name
$data['controller'] = $controller;
$logged_in_store_id=$this->session->userdata('logged_in_store_id');
$config['base_url'] = site_url('admin/order/index/');
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; // CORRECT ✅
$config['total_rows'] = $this->Productmodel->getStoreOrdersCountbyadmin($logged_in_store_id);
        // print_r($config['total_rows']);
        $config['per_page'] = 10; // number of rows per page
        $config['uri_segment'] = 4; // which URI segment contains the page numberg
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '<span class="pagination-previous">Previous</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '<span class="pagination-next">Next</span>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // Custom icons for first and last links
        $config['first_link'] = '<span class="pagination-first">First</span>'; // First link icon
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<span class="pagination-last">Last</span>'; // Last link icon
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config); 
$data['pagination'] = $this->pagination->create_links();
$role_id = $this->session->userdata('roleid'); // Role id of logged in user
$user_id = $this->session->userdata('loginid'); // Loged in user id
$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
$data['shipping']=$this->Productmodel->listshipping();
$data['orders']=$this->Productmodel->listunpaidorders();
$data['orderswholesale'] = $this->Productmodel->listunpaidwholesaleorders();

$data['Name'] = $store_details->Name;
$data['support_no'] = $store_details->UserPhoneNumber;
$data['support_email'] = $store_details->userEmail;
$this->load->view('admin/includes/header',$data);
$this->load->view('admin/includes/owner-dashboard',$data);
$this->load->view('admin/catalog/unpaid',$data);
$this->load->view('admin/includes/footer',$data);
}


}

?>