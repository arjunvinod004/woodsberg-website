<?php class Order extends CI_Controller {
public function __construct() 
{   
    parent::__construct();
    $this->load->model('admin/Productmodel');
    $this->load->model('admin/Storemodel');
    $this->load->model('Homemodel');
    $this->load->library('pagination');
}



public function index()
{
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
$data['orders'] = $this->Productmodel->getPaginatedOrders($config['per_page'], $page, $logged_in_store_id);
$data['pagination'] = $this->pagination->create_links();
$role_id = $this->session->userdata('roleid'); // Role id of logged in user
$user_id = $this->session->userdata('loginid'); // Loged in user id
$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
$data['shipping']=$this->Productmodel->listshipping();
$data['orders']=$this->Productmodel->listorders();
$data['orderswholesale'] = $this->Productmodel->listorderswholesale();
$data['Name'] = $store_details->Name;
$data['support_no'] = $store_details->UserPhoneNumber;
$data['support_email'] = $store_details->userEmail;
$this->load->view('admin/includes/header',$data);
$this->load->view('admin/includes/owner-dashboard',$data);
$this->load->view('admin/catalog/orders',$data);
$this->load->view('admin/includes/footer',$data);
}

private function init_mailer() {
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    require_once 'PHPMailer/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'sg2plzcpnl505572.prod.sin2.secureserver.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@woodsberg.com';
    $mail->Password   = 'opX3(57,a0Mm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('info@woodsberg.com', 'Woodsberg');
    $mail->isHTML(true);
    return $mail;
}

public function despatchmail($to_email,$trackingId,$orderno)
{

$data=[
    'to_email'      => $to_email,
    'trackingId'    => $trackingId,
    'orderno'       => $orderno
];



//  print_r($data);exit;

    $email_body = $this->load->view('website/despatchemail', $data, TRUE);
    try {
        $mail = $this->init_mailer();
        $mail->clearAllRecipients();
        $mail->addAddress($to_email); // or admin email
        $mail->isHTML(true);
        $mail->Subject = ' Order No - ' . $orderno;
        $mail->Body = $email_body;
        $mail->send();
       // echo 'Mail sent successfully.';
    } catch (Exception $e) {
        echo 'Mail Error: ' . $mail->ErrorInfo;
    }

}

public function emaildespatch()
{
    $id=$this->input->post('id');
    $order = $this->db->where('order_no', $id)->get('orders')->row_array();
    $orderemail = $order['email'];
    // print_r($orderemail);exit;
    $trackingId=$this->input->post('trackingId');
     $this->despatchmail($orderemail,$trackingId,$id);
    $this->Productmodel->emaildespatch($id,$trackingId);
    echo json_encode(['success' => 'success']);
}

public function emailcanceldespatch(){
    $id=$this->input->post('id');
    $this->Productmodel->emailcanceldespatch($id);
    echo json_encode(['success' => 'success']);
}



public function despatchorder()
{
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$controller = $this->router->fetch_class(); // Gets the current controller name
$method = $this->router->fetch_method();   // Gets the current method name
$data['controller'] = $controller;
// print_r($data['controller']);
  $logged_in_store_id=$this->session->userdata('logged_in_store_id');
//   print_r($logged_in_store_id);
$config['base_url'] = site_url('admin/order/index/');
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; // CORRECT ✅
//  print_r($page);
        $config['total_rows'] = $this->Productmodel->getStoreOrdersCountbyadmin($logged_in_store_id);
        $config['per_page'] = 5; // number of rows per page
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
        // Get the current page number
        $data['pagination'] = $this->pagination->create_links();
// echo $controller;
//$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
$role_id = $this->session->userdata('roleid'); // Role id of logged in user
$user_id = $this->session->userdata('loginid'); // Loged in user id
$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
$data['shipping']=$this->Productmodel->listshipping();
$data['orders']=$this->Productmodel->listdespatchorders();
$data['orderswholesale'] = $this->Productmodel->listorderdespatchswholesale();
$data['Name'] = $store_details->Name;
$data['support_no'] = $store_details->UserPhoneNumber;
$data['support_email'] = $store_details->userEmail;
$this->load->view('admin/includes/header',$data);
 $this->load->view('admin/includes/owner-dashboard',$data);
$this->load->view('admin/catalog/despatch',$data);
$this->load->view('admin/includes/footer',$data);
}


public function searchPendingOrder(){
    $name    = trim($this->input->post('name'));
    $email   = trim($this->input->post('email'));
    $phone   = trim($this->input->post('phone'));
    $orderno = trim($this->input->post('orderno'));
    $type    = trim($this->input->post('type'));
    $html = '';

 if ($name || $email || $phone || $orderno || $type) {
 $searchorders = $this->Productmodel->searchpendingorder($name, $email, $phone, $orderno, $type);
$count = 1; 
 foreach ($searchorders as $val) {
        $html .= '<tr>';
        $html .= '<td>' . $count . '</td>';
        $html .= '<td>' . $val['order_no'] . '</td>';
        $html .= '<td>' . date("d/M/Y", strtotime($val['order_date'])) . '</td>';
        $html .= '<td>' . date("h:i A", strtotime($val['time'])) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['transaction_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['state']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['postal_code']) . '</td>';
       if ($val['is_paid'] == '1') {
    $html .= '<td><span class="badge bg-success">Success</span></td>';
} elseif ($val['payment_status'] == 'processing') {
    $html .= '<td><span class="badge bg-secondary">Processing</span></td>';
} elseif (strtolower($val['payment_status']) == 'pending') {
    $html .= '<td><span class="badge bg-primary">Pending</span></td>';
} elseif (strtolower($val['payment_status']) == 'user aborted' || strtolower($val['payment_status']) == '0') {
    $html .= '<td><span class="badge bg-danger">Failed</span></td>';
}
   
        $html .= '<td>' . htmlspecialchars($val['total_amount']) . '</td>';

        // The “View” button
        $html .= '<td class="pb-0 pt-0 d-flex">';
        $html .= '<button class="btn btn-success btn-sm p-1 m-2 tblEditBtn edit_order" 
                    type="button"
                    data-bs-toggle="modal" 
                    data-id="' . htmlspecialchars($val['order_no']) . '" 
                    data-bs-target="#edit-order">View</button>';
        $html .= '</td>';

        $html .= '</tr>';
        $count++;
    }
echo json_encode(['success' => 'success',  'html' => $html ,'type'=> $type]);
    } else {
        $searchorders = []; 
    }
}



public function searchUnpaidOrder(){
    $name    = trim($this->input->post('name'));
    $email   = trim($this->input->post('email'));
    $phone   = trim($this->input->post('phone'));
    $orderno = trim($this->input->post('orderno'));
    $type    = trim($this->input->post('type'));
    $payment_status = trim($this->input->post('payment_status'));
    $html = '';

 if ($name || $email || $phone || $orderno || $type || $payment_status) {
 $searchorders = $this->Productmodel->searchunpaidorder($name, $email, $phone, $orderno, $type, $payment_status);
$count = 1; 
 foreach ($searchorders as $val) 
    {
        $html .= '<tr>';
        $html .= '<td>' . $count . '</td>';
        $html .= '<td>' . $val['order_no'] . '</td>';
        $html .= '<td>' . date("d/M/Y", strtotime($val['order_date'])) . '</td>';
        $html .= '<td>' . date("h:i A", strtotime($val['time'])) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['transaction_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['state']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['postal_code']) . '</td>';
       if ($val['is_paid'] == '1') {
    $html .= '<td><span class="badge bg-success">Success</span></td>';
} elseif ($val['payment_status'] == 'processing') {
    $html .= '<td><span class="badge bg-secondary">Processing</span></td>';
} elseif (strtolower($val['payment_status']) == 'pending') {
    $html .= '<td><span class="badge bg-primary">Pending</span></td>';
} elseif (strtolower($val['payment_status']) == 'user aborted' || strtolower($val['payment_status']) == '0' || strtolower($val['payment_status']) == 'failed') {
    $html .= '<td><span class="badge bg-danger">Failed</span></td>';
}
        $html .= '<td>' . htmlspecialchars($val['total_amount']) . '</td>';

        // The “View” button
        $html .= '<td class="pb-0 pt-0 d-flex">';
        $html .= '<button class="btn btn-success btn-sm p-1 m-2 tblEditBtn edit_order" 
                    type="button"
                    data-bs-toggle="modal" 
                    data-id="' . htmlspecialchars($val['order_no']) . '" 
                    data-bs-target="#edit-order">View</button>';
        $html .= '</td>';

        $html .= '</tr>';
        $count++;
    }
echo json_encode(['success' => 'success',  'html' => $html ,'type'=> $type]);
    } else {
        $searchorders = []; 
    }


}


public function searchDespatchOrder()
{
   $name    = trim($this->input->post('name'));
    $email   = trim($this->input->post('email'));
    $phone   = trim($this->input->post('phone'));
    $orderno = trim($this->input->post('orderno'));
    $type    = trim($this->input->post('type'));
    $html = '';

 if ($name || $email || $phone || $orderno || $type) {
 $searchorders = $this->Productmodel->searchdespatchorder($name, $email, $phone, $orderno, $type);

$count = 1; 
 foreach ($searchorders as $val) 
    {
        $html .= '<tr>';
        $html .= '<td>' . $count . '</td>';
        $html .= '<td>' . $val['order_no'] . '</td>';
        $html .= '<td>' . date("d/M/Y", strtotime($val['order_date'])) . '</td>';
        $html .= '<td>' . date("h:i A", strtotime($val['time'])) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['transaction_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['state']) . '</td>';
        $html .= '<td>' . htmlspecialchars($val['postal_code']) . '</td>';
       if ($val['is_paid'] == '1') {
    $html .= '<td><span class="badge bg-success">Success</span></td>';
} elseif ($val['payment_status'] == 'processing') {
    $html .= '<td><span class="badge bg-secondary">Processing</span></td>';
} elseif (strtolower($val['payment_status']) == 'pending') {
    $html .= '<td><span class="badge bg-primary">Pending</span></td>';
} elseif (strtolower($val['payment_status']) == 'user aborted' || strtolower($val['payment_status']) == '0') {
    $html .= '<td><span class="badge bg-danger">Failed</span></td>';
}
   
        $html .= '<td>' . htmlspecialchars($val['total_amount']) . '</td>';

        // The “View” button
        $html .= '<td class="pb-0 pt-0 d-flex">';
        $html .= '<button class="btn btn-success btn-sm p-1 m-2 tblEditBtn edit_order" 
                    type="button"
                    data-bs-toggle="modal" 
                    data-id="' . htmlspecialchars($val['order_no']) . '" 
                    data-bs-target="#edit-order">View</button>';
        $html .= '</td>';

        $html .= '</tr>';
        $count++;
    }
echo json_encode(['success' => 'success',  'html' => $html ,'type'=> $type]);
    } else {
        $searchorders = []; 
    }

}

    public function convertorder()
{
    $id=$this->input->post('id');
    $remarks=$this->input->post('remarks');
    $this->Productmodel->convertorder($id,$remarks);
    echo json_encode(['success' => 'success']);

}


}
 


?>