<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('application/libraries/dompdf/autoload.inc.php'); 

// excel 
require_once('application/third_party/PHPExcel-1.8/Classes/PHPExcel.php');
// require_once ('application/libraries/phpexcel/autoload.php');
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Style\Fill;
// use PhpOffice\PhpSpreadsheet\Style\Border;
// use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Dompdf\Dompdf; 
use Dompdf\Options; 
use Dompdf\FontMetrics; 

class Store extends CI_Controller {

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
		$this->load->model('admin/Storemodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}


	public function index(){
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
         $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
		//   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
      
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;

		$data['stores']=$this->Storemodel->liststores();
		// print_r($data['stores']);exit;
		 $this->load->view('admin/includes/header',$data);
		// $this->load->view('admin/menudashboard',$data);
		$this->load->view('admin/includes/owner-dashboard',$data);
		$this->load->view('admin/store/store',$data);
		$this->load->view('admin/includes/footer',$data);
	}


	public function edit()
	{
			$id=$this->input->post('id'); 

			// echo $id;exit;
			
			$edit_store = $this->Storemodel->get_store_by_id($id);

// Check and extract the first store record
if (!$edit_store || !is_array($edit_store) || !isset($edit_store[0])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid store data.'
    ]);
    return;
}

$store = $edit_store[0]; // Extract the first store object

$result = [
    'store_disp_name' => $store['store_disp_name'],
    'store_name' => $store['store_name'],
    'store_desc' => $store['store_desc'], // Fixed field name here
    'store_email' => $store['store_email'],
    'store_phone' => $store['store_phone'],
    'store_address' => $store['store_address'],
    'store_opening_time' => $store['store_opening_time'],
    'store_closing_time' => $store['store_closing_time'],
    'store_country' => $store['store_country'],
    'gst_or_tax' => $store['gst_or_tax'],
    'store_logo_image' => $store['store_logo_image'],
];

// print_r($result); exit;

echo json_encode([
    'success' => 'success',
    'data' => $result
]);

	}


	public function update(){
		$id=$this->input->post('hidden_store_id'); 
		// echo $id;exit;
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');
		$this->load->library('form_validation'); 
		$this->form_validation->set_error_delimiters('', '');  
		
		$this->form_validation->set_rules('store_name', 'name', 'required');
		$this->form_validation->set_rules('store_disp_name', 'display name', 'required');
		$this->form_validation->set_rules('store_desc', 'description', 'required');
		$this->form_validation->set_rules('store_email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('store_phoneno', 'phone', 'required|regex_match[/^\d{10}$/]');
		$this->form_validation->set_rules('store_address', 'address', 'required');
		$this->form_validation->set_rules('store_opening_time', 'opening time', 'required');
		$this->form_validation->set_rules('store_closing_time', 'closing time', 'required');
		$this->form_validation->set_rules('store_country', 'country', 'required');
		$this->form_validation->set_rules('store_gst_tax', 'gst or tax', 'required');


	
	if ($this->form_validation->run() == FALSE) 
	{
		$response = [
			'success' => false,
			'errors' => [
				'store_name' => form_error('store_name'),
				'store_disp_name' => form_error('store_disp_name'),
				'store_desc' => form_error('store_desc'),
				'store_email' => form_error('store_email'),
				'store_phoneno' => form_error('store_phoneno'),
				'store_address' => form_error('store_address'),
				'store_opening_time' => form_error('store_opening_time'),
				'store_closing_time' => form_error('store_closing_time'),
				'store_country' => form_error('store_country'),
				'store_gst_tax' => form_error('store_gst_tax'),
				// 'userfile' => form_error('userfile'),
			]
		];
	
		echo json_encode($response);
	}
	else
	{
		$this->load->library('upload');
		$this->load->library('image_lib');
		
		$upload_images = [];
		
		if (!empty($_FILES['store_logo']['name'])) {
			$config['upload_path']   = './uploads/store/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name']     = time() . '_1';
		
			$this->upload->initialize($config);
		
			if ($this->upload->do_upload('store_logo')) {
				$upload_data = $this->upload->data();
		
				// Resize image
				$resize['image_library']  = 'gd2';
				$resize['source_image']   = $upload_data['full_path'];
				$resize['maintain_ratio'] = TRUE;
				$resize['width']          = 500;
				$resize['height']         = 500;
		
				$this->image_lib->initialize($resize);
				$this->image_lib->resize();
				$this->image_lib->clear();
		
			  // After upload loop...
			  $category_img = $upload_data['file_name']; // ✅ Correct string
			}
		} else {
			$category_img = $this->input->post('store_logo_image'); // ✅ Also a string now
		}
		
		$data = array(
			'store_name' => $this->input->post('store_name'),
			'store_disp_name' => $this->input->post('store_disp_name'),
			'store_desc' => $this->input->post('store_desc'),
			'store_email' => $this->input->post('store_email'),
			'store_phone' => $this->input->post('store_phoneno'),
			'store_address' => $this->input->post('store_address'),
			'store_opening_time' => $this->input->post('store_opening_time'),
			'store_closing_time' => $this->input->post('store_closing_time'),
			'store_country' => $this->input->post('store_country'),
			'gst_or_tax' => $this->input->post('store_gst_tax'),
			'store_logo_image' => $category_img,
			'is_active' => 1,
		);

		// print_r($data);exit;
		$this->Storemodel->update($id, $data);
	 
	
		echo json_encode(['success' => 'success','data'=>$data]);
	}
	}
	
	// public function edit( $store_id = NULL){
    //     //echo $store_id;exit;
	// 	$data['countries']=$this->Countrymodel->listcountries();
	//     if(isset($_POST['edit']))
	// 	{
	// 	    $id=$this->input->post('id'); //echo $roleid;die();
	// 		$data['storeDet']=$this->Storemodel->get($store_id);
	// 		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('hiddencountry')); //when edit get country tax rates using hidden country 
	// 		$this->form_validation->set_rules('disp_name', 'Display Name', 'required');
	// 		$this->form_validation->set_rules('name', 'Name', 'required');
	// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    //         $this->form_validation->set_rules('phone', 'Phone', 'required');
	// 		$this->form_validation->set_rules('address', 'Address', 'required');
	// 		$this->form_validation->set_rules('store_opening_time', 'Opening Time', 'required');
	// 		$this->form_validation->set_rules('store_closing_time', 'Closing Time', 'required');
	// 		// $this->form_validation->set_rules('no_of_tables', 'No of Tables', 'required');
	// 		$this->form_validation->set_rules('store_trade_license', 'Trade License', 'required');
	// 		$this->form_validation->set_rules('store_location', 'Location', 'required');
	// 		//$this->form_validation->set_rules('gst_or_tax', 'Tax rate', 'required');
	// 		//$this->form_validation->set_rules('country', 'Country', 'required');
	// 		$this->form_validation->set_rules('language', 'Language', 'required');
    //         //$this->form_validation->set_rules('currency', 'Currency', 'required');

	// 		if ($this->form_validation->run() == FALSE) 
	// 		{
	// 			//echo "here";exit;
	// 			$this->load->view('owner/includes/header');
	// 		    $this->load->view('owner/store/edit',$data); 
	// 		    $this->load->view('owner/includes/footer');
	// 		}
	// 		else
	// 		{
	// 			//echo "here1";exit;
	// 			if(!empty($_FILES['store_logo_image']['name'])){
	// 				$image_path = './uploads/store/' . $this->input->post('old_image');
	// 				//echo $image_path;exit;
	// 				unlink($image_path);
	// 				$config['upload_path'] = './uploads/store/';
	// 				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
	// 				$config['file_name'] = $_FILES['store_logo_image']['name'];
					
					
	// 				$this->load->library('upload',$config);
	// 				$this->upload->initialize($config);
					
	// 				if($this->upload->do_upload('store_logo_image')){
	// 					$uploadData = $this->upload->data();
	// 					$store_logo_image = $uploadData['file_name'];
	// 				}else{
	// 					$upload=0;
	// 				   $uploaderr=$this->upload->display_errors();
	
	// 				}
	// 			}else{
	// 				$store_logo_image = $this->security->xss_clean($this->input->post('old_image'));
	// 			}

	// 			$checkbox_values = $this->input->post('checkbox');
    //     		$checkbox_string = implode(",", $checkbox_values);// Convert array to comma-separated values if needed

	// 			$checkbox_pickup_or_take_away = $this->input->post('checkbox_pickup_or_take_away'); //if checked 1 else 0
	// 			$checkbox_dining = $this->input->post('checkbox_dining');
	// 			$checkbox_delivery = $this->input->post('checkbox_delivery');

	// 			$txt_pickup_or_take_away = $this->input->post('txt_pickup_or_take_away'); //if checked 1 else 0
	// 			$txt_dining = $this->input->post('txt_dining');
	// 			$txt_delivery = $this->input->post('txt_delivery');	

	// 			$data = array(
	// 				'store_disp_name' => $this->input->post('disp_name'),
	// 				'store_name' => $this->input->post('name'),
	// 		        'store_desc' => $this->input->post('store_desc'),
	// 		        'store_email' => $this->input->post('email'),
	// 		        'store_phone' => $this->input->post('phone'),
    //                 'store_address' => $this->input->post('address'),
    //                 'store_opening_time' => $this->input->post('store_opening_time'),
	// 				'store_closing_time' => $this->input->post('store_closing_time'),
	// 				'no_of_tables' => $this->input->post('no_of_tables'),
	// 				'store_trade_license' => $this->input->post('store_trade_license'),
    //                 'store_location' => $this->input->post('store_location'),
	// 				'store_language' => $this->input->post('language'),
	// 				'store_selected_languages' => $checkbox_string,
	// 				'is_pickup' => $checkbox_pickup_or_take_away,
	// 				'pickup_number' => $txt_pickup_or_take_away,
	// 				'is_dining' => $checkbox_dining,
	// 				'dining_number' => $txt_dining,
	// 				'is_delivery' => $checkbox_delivery,
	// 				'delivery_number' => $txt_delivery,
	// 				'store_logo_image' => $store_logo_image,
	// 		        'is_active' => $this->input->post('is_active'),
	// 		        );
	// 				//print_r($data);exit;
	// 			$this->Storemodel->update($id,$data);
	// 			$this->session->set_flashdata('success','Store details updated...');
	// 			redirect('owner/store/edit/'.$store_id);
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$data['storeDet']=$this->Storemodel->get($store_id);//print_r($data['storeDet']);exit;
	// 		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($data['storeDet'][0]['store_country']); //when edit get country tax rates using hidden country id
	// 		$this->load->view('owner/includes/header');
	// 		$this->load->view('owner/store/edit',$data); 
	// 		$this->load->view('owner/includes/footer');
	// 	}
	// }

	public function getTaxRates(){
		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('country_id'));
		echo '<option value="">Select Rate</option>';
            foreach($data['tax_rates'] as $rate) { ?>
                <option value="<?php echo $rate['tax_id']; ?>"><?php echo $rate['tax_rate']; ?></option>
            <?php }
	}

	// public function valid_phone($phone_number) {
	// 	$pattern = "/^\+?\d{1,3}?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/";
    //     $clean_phone_number = preg_replace('/\D/', '', $phone_number);
    //     if (preg_match('#[^0-9]#',$phone_number)) {
    //         $this->form_validation->set_message('valid_phone', 'The %s field must be digits.');
    //         return FALSE;
    //     } 
	// 	return TRUE;
    // }
}
