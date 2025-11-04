<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		require('Common.php');
		$this->load->model('admin/Productmodel');
		$this->load->model('admin/Storemodel');
		$this->load->model('Homemodel');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$data['store_id'] = $this->session->userdata('logged_in_store_id');
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
		$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
		$data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
		// $data['userAddress'] = $store_details->userAddress;
		$data['support_no'] = $store_details->UserPhoneNumber;
		$data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/includes/owner-dashboard',$data);
		$this->load->view('admin/catalog/reports',$data);
		$this->load->view('admin/includes/footer');
		// $this->load->model('website/Homemodel');
	
		// if($role_id == 1 || $role_id == 2) { //Admin and Shop owner

		// }
		
	}

	public function getRetailReport()
{
	$date= $this->input->post('date');
	$name= $this->input->post('name');
	$phone= $this->input->post('phone');
	$ordertype= $this->input->post('ordertype');
$data = $this->Homemodel->getRetailReport($date, $ordertype, $name, $phone);
$formattedDate = date('d-m-Y', strtotime($date));
$html = '';

$typeLabels = [
    'rt'  => 'Retail',
    'ws'  => 'Wholesale',
    'bb'  => 'Franchise',
    'exp' => 'Export'
];

  foreach ($data as $row) 
{
    $html .= '<tr>';
    $html .= '<td>' . $formattedDate . '</td>';
    $html .= '<td>' . $row['order_no'] . '</td>';
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['phone'] . '</td>';
    $html .= '<td>' . ($typeLabels[$row['order_type']] ?? $row['order_type']) . '</td>';
	$html .= '<td>' . $row['total_amount'] . '</td>';
    $html .= '</tr>';
}

echo json_encode(['success' => 'success',  'html' => $html]);

}

// public function getSummaryReport()
// {
//     $fromdate = $this->input->post('fromdate');
//     $todate   = $this->input->post('todate');

//     // Get total between fromdate and todate
//     $totalAmount = $this->Homemodel->getSummaryReport($fromdate, $todate);

//     // Also get individual day totals
//     $fromAmount = $this->Homemodel->getSummaryReport($fromdate, $fromdate);
//     $toAmount   = $this->Homemodel->getSummaryReport($todate, $todate);

//     // Format dates
//     $formattedFrom = date('d-m-Y', strtotime($fromdate));
//     $formattedTo   = date('d-m-Y', strtotime($todate));

//     $html  = '';

//     // ✅ From Date Row
//     $html .= '<tr>';
//     $html .= '<td>' . $formattedFrom . '</td>';
//     $html .= '<td><strong>₹' . number_format(($fromAmount ?? 0), 2) . '</strong></td>';
//     $html .= '</tr>';

//     // ✅ To Date Row
//     $html .= '<tr>';
//     $html .= '<td>' . $formattedTo . '</td>';
//     $html .= '<td><strong>₹' . number_format(($toAmount ?? 0), 2) . '</strong></td>';
//     $html .= '</tr>';

//     echo json_encode(['success' => 'success', 'html' => $html]);
// }

public function getSummaryReport()
{
    $fromdate = $this->input->post('fromdate');
    $todate   = $this->input->post('todate');

    // Convert to timestamps
    $start = strtotime($fromdate);
    $end   = strtotime($todate);
    $html = '';
	    // ✅ Get total once (not inside loop)
    $totalAmount = $this->Homemodel->getSummaryReport($fromdate, $todate);
    // Loop through each day between fromdate and todate
    for ($date = $start; $date <= $end; $date = strtotime("+1 day", $date)) {
        $currentDate = date('Y-m-d', $date);
        $formattedDate = date('d-m-Y', $date);
        $dayAmount = $this->Homemodel->getSummaryReport($currentDate, $currentDate);
		$totalAmount = $this->Homemodel->getSummaryReport($fromdate, $todate);
		// print_r($totalAmount);
		
        $html .= '<tr>';
        $html .= '<td>' . $formattedDate . '</td>';
        $html .= '<td><strong>₹' . number_format(($dayAmount ?? 0), 2) . '</strong></td>';
        $html .= '</tr>';
    }
	  // ✅ Add total summary row
    // $html .= '<tr style="background:#f8f9fa; font-weight:bold;">';
    // $html .= '<td>Total</td>';
    // $html .= '<td><strong>₹' . number_format(($totalAmount ?? 0), 2) . '</strong></td>';
    // $html .= '</tr>';

    echo json_encode(['success' => 'success', 'html' => $html,'total_amount'=>$totalAmount]);
}






// 	public function getRetailReportname(){
// 	$date= $this->input->post('date');
// 	$name= $this->input->post('name');
// 	$rt = $this->Homemodel->getRetailReportname($name, 'rt', $date);
//     $ws = $this->Homemodel->getRetailReportname($name, 'ws', $date);
//     $bb = $this->Homemodel->getRetailReportname($name, 'bb', $date);
//   $data = array('rt' => $rt , 'ws' => $ws , 'bb' => $bb );
//  $formattedDate = date('d-m-Y', strtotime($date));
//     $html = '<tr>';
//     $html .= '<td>' . $formattedDate . '</td>';
//     $html .= '<td>₹ ' . $data['rt'] . '</td>';
//     $html .= '<td>₹ ' .$data['ws'] . '</td>';
//     $html .= '<td>₹ ' . $data['bb'] . '</td>';
//     $html .= '</tr>';
// 	echo json_encode(['success' => 'success',  'html' => $html]);
// 	//  print_r($html);

// 	// echo json_encode($data);
// 	}

// 		public function getRetailReportphone(){
// 	$date= $this->input->post('date');
// 	$name= $this->input->post('name');
// 	$phone= $this->input->post('phone');
// 	$rt = $this->Homemodel->getRetailReportphone($name, 'rt', $date, $phone);
//     $ws = $this->Homemodel->getRetailReportphone($name, 'ws', $date, $phone);
//     $bb = $this->Homemodel->getRetailReportphone($name, 'bb', $date, $phone);
//   $data = array('rt' => $rt , 'ws' => $ws , 'bb' => $bb );
//  $formattedDate = date('d-m-Y', strtotime($date));
//     $html = '<tr>';
//     $html .= '<td>' . $formattedDate . '</td>';
//     $html .= '<td>₹ ' . $data['rt'] . '</td>';
//     $html .= '<td>₹ ' .$data['ws'] . '</td>';
//     $html .= '<td>₹ ' . $data['bb'] . '</td>';
//     $html .= '</tr>';
// 	echo json_encode(['success' => 'success',  'html' => $html]);
// 	//  print_r($html);

// 	// echo json_encode($data);
// 	}

}