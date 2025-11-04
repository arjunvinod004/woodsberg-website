<?php
class Test extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Storemodel');
        $this->load->model('admin/Productmodel');
		  $this->load->model('Homemodel');
        $this->load->model('Cartmodel');
		// $this->load->model('admin/Countrymodel');
		// $this->load->model('admin/Packagemodel');
		// $this->load->model('admin/Taxmodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
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


    public function index()
{
    $token = '65fc07923392c9d7';
    $cartitems = $this->Cartmodel->cartitems($token);
    $orders = $this->db->where('guest_token', $token)->order_by('id', 'DESC')->get('orders')->row_array();
    $orderno = $orders['order_no']; 
    $data['customerdetails'] = $this->db->where('user_token', $token)->get('customers')->row_array();
    
    $customer_id = $data['customerdetails']['id'];
    $customer_name = $data['customerdetails']['name'];
    $customer_phone = $data['customerdetails']['phone'];
    $customer_email = $data['customerdetails']['email'] ?: '';
    $customer_address = $data['customerdetails']['address'] ?: '';
    $customer_shipping = $data['customerdetails']['shipping_charge'] ?: '';
    $customer_coupon = $data['customerdetails']['coupon_code'] ?: '';
    
    // ✅ IMPORTANT: Convert image paths to absolute URLs for email
    foreach ($cartitems as &$item) {
        if (!empty($item['image'])) {
            // Use full absolute URL with your domain
            $item['image_url'] = 'https://woodsberg.com/uploads/product/' . $item['image'];
            
            // OR if you want to use base_url (make sure it's configured correctly)
            // $item['image_url'] = base_url('uploads/product/' . $item['image']);
        } else {
            $item['image_url'] = 'https://woodsberg.com/assets/images/no-image.png';
        }
    }
    unset($item); // Break the reference
    
    $data = [
        'orderno' => $orderno,
        'customer_id' => $customer_id,
        'customer_name' => $customer_name,
        'customer_phone' => $customer_phone,
        'customer_email' => $customer_email,
        'customer_address' => $customer_address,
        'customer_shipping' => $customer_shipping,
        'customer_coupon' => $customer_coupon,
        'cartitems' => $cartitems
    ];
    
    $email_body = $this->load->view('website/email', $data, TRUE);

    try {
        $mail = $this->init_mailer();
        $mail->clearAllRecipients();
        $mail->addAddress('arjunvt004@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'New Order Received - ' . $orderno;
        $mail->Body = $email_body;
        $mail->send();

        echo 'Mail sent successfully.';
    } catch (Exception $e) {
        echo 'Mail Error: ' . $mail->ErrorInfo;
    }
}

//     public function index()
// 	{
// $token ='65fc07923392c9d7';
// $cartitems = $this->Cartmodel->cartitems($token);
// // print_r($token); exit;
// // print_r($cartitems); exit;
// $orders = $this->db->where('guest_token', $token)->order_by('id', 'DESC')->get('orders')->row_array();
// $orderno= $orders['order_no']; 
// $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
// // $sumofprice=$this->Cartmodel->getsumofprice($token);
// $customer_id=$data['customerdetails']['id'];
// $customer_name=$data['customerdetails']['name'];
// $customer_phone=$data['customerdetails']['phone'];
// $customer_email=$data['customerdetails']['email'] ?: '';
// $customer_address=$data['customerdetails']['address'] ?: '';
// $customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
// $customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
// //  foreach ($cartitems as &$item) 
// //     {
// //         if (!empty($item['image'])) {
// //             $item['image_url'] = base_url('uploads/product/' . $item['image']);
// //         } else {
// //             $item['image_url'] = base_url('assets/images/no-image.png'); // fallback
// //         }
// //     }

// $data=[
//     'orderno'=>$orderno,
//     'customer_id'=>$customer_id,
//     'customer_name'=>$customer_name,
//     'customer_phone'=>$customer_phone,
//     'customer_email'=>$customer_email,
//     'customer_address'=>$customer_address,
//     'customer_shipping'=>$customer_shipping,
//     'customer_coupon'=>$customer_coupon,
//     'cartitems'=>$cartitems
// ];
// // print_r($data); exit;
//     $email_body = $this->load->view('website/email', $data, TRUE);

//     try {
//         $mail = $this->init_mailer();
//         $mail->clearAllRecipients();
//         $mail->addAddress('arjunvt004@gmail.com'); // or admin email
//         $mail->isHTML(true);
//         $mail->Subject = 'New Order Received - ' . $orderno;
//         $mail->Body = $email_body;
//         $mail->send();

//        echo 'Mail sent successfully.';
//     } catch (Exception $e) {
//         echo 'Mail Error: ' . $mail->ErrorInfo;
//     }
//     }
}
?>