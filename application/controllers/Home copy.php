<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Homemodel');
        $this->load->model('Cartmodel');
        $this->load->model('admin/Productmodel');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('email'); // ✅ Load the email library
        // print_r($this->session->userdata());
 
    }

    public function index() 
    {
    $this->load->helper('cookie'); // ✅ Load cookie helper
    $token = $this->input->cookie('guest_token'); 
    // echo $token; exit;
    $this->session->set_userdata('order_type', 'rt');
    $existing_customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if($existing_customer){
        $this->session->set_userdata('order_no', $existing_customer['order_no']);
    }
    else{
    $orders_id= $this->Homemodel->getorderid(); 
    $orderno = 'ORD' . date('Y') . $orders_id; 
    $this->session->set_userdata('order_no', $orderno);
    }
echo "session : = " . $this->session->userdata('order_no');

    //print_r($ordersno);
    // echo "Order Type: " . $this->session->userdata('order_type');
    $data['ordertype'] = $this->session->userdata('order_type');  
    if (empty($token)) {
        $token = bin2hex(random_bytes(8));
        set_cookie('guest_token', $token, 86400); // 1 day = 86400 seconds
    }   
        $data['cartitems'] = $this->Cartmodel->cartitems($token);
        $data['sumofprice']=$this->Cartmodel->getsumofprice($token);
        $data['cart']= $this->Cartmodel->cartproducts($token);
        $data['categories']=$this->Homemodel->listcategories();
        // print_r($data['categories']); exit;
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['seasonaloffer']=$this->Homemodel->getseasonaloffer();
        $data['bestseller']=$this->Homemodel->getbestseller();
        $data['home']=$this->Homemodel->gethome();
        $data['testimonial']=$this->Homemodel->gettestimonial();
        // $data['brands']=$this->Homemodel->listbrand();
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['slider']=$this->Homemodel->getslider();
        $data['store']=$this->Homemodel->getstore();
        $this->db->where('user_token', $token);
        $query = $this->db->get('customers');
       //echo $token; $query->num_rows();exit;
        if ($query->num_rows() === 0) {
            // Insert only if not exists
            $datas = [
                'user_token'   => $token,
                'order_no'     => $this->session->userdata('order_no'),
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                 'order_type'   =>$this->session->userdata('order_type'),
                'is_active'    => 0,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
        }

        //   print_r($data['home']);
        $this->load->view('website/header', $data);
        $this->load->view('website/home',$data);
        $this->load->view('website/footer', $data);
    }
    
    
public function wholesale()
{
    $this->load->helper('cookie');
    $this->session->set_userdata('order_type', 'ws');
    $order_type = $this->session->userdata('order_type');
    $existing_customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if($existing_customer){
        $this->session->set_userdata('order_no', $existing_customer['order_no']);
    }
    else{
    $orders_id= $this->Homemodel->getorderid(); 
    $orderno = 'ORD' . date('Y') . $orders_id; 
    $this->session->set_userdata('order_no', $orderno);
    }
    
    $data['ordertype'] = $order_type;
    if($data['ordertype'] == 'ws'){
    if (!$this->session->userdata('user_id')) {
        redirect(site_url('home/login'));
        return; // stop further execution
    }
}

    $token = $this->input->cookie('guest_token');
    // print_r($token);
    if (!$token && $this->session->userdata('guest_token')) {
        $token = $this->session->userdata('guest_token');
    }

    // ✅ Step 3: If still no token, generate and insert
    if (!$token) {
        $token = bin2hex(random_bytes(8));
        set_cookie('guest_token', $token, 3600 * 24);
        $this->session->set_userdata('guest_token', $token); // Save as fallback

        // Insert into DB
        $datas = [
            'user_token'   => $token,
            'order_no'     => $this->session->userdata('order_no'),
            'name'         => null,
            'email'        => null,
            'password'     => null,
            'phone'        => null,
            'address'      => null,
            'city'         => null,
            'state'        => null,
            'postal_code'  => null,
            'country'      => null,
            'order_type'   => $order_type,
            'is_active'    => 0,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->Homemodel->inserttoken($datas);
    } else {
        // ✅ Step 4: If token exists, ensure no duplicate DB insert
        $exists = $this->db->where('user_token', $token)->get('customers')->num_rows();
        if ($exists === 0) {
            $datas = [
                'user_token'   => $token,
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                'order_type'   => $order_type,
                'is_active'    => 0,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
        }
    }

    // ✅ Step 5: Load page data
    $data['categories']      = $this->Homemodel->listcategories();
    $data['home']            = $this->Homemodel->gethome();
    $data['subcategories']   = $this->Homemodel->getsubcategories();
    $data['headercategory']  = $this->Homemodel->listheadercategories();
    $data['footercategory']  = $this->Homemodel->listfootercategories();
    $data['cart']            = $this->Cartmodel->cartproducts($token);
    $data['store']           = $this->Homemodel->getstore();

    // ✅ Step 6: Render wholesale view
    $this->load->view('website/header', $data);
    $this->load->view('website/wholesale', $data);
    $this->load->view('website/footer', $data);
}


    public function B2B()
    {   
        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');
        //  echo $token;
        // echo "B2B"; exit;
     $this->session->set_userdata('order_type', 'bb');
 
    // echo "Order Type: " . $this->session->userdata('order_type');
    //  echo "Order Type: " . $this->session->userdata('order_type');

     $data['ordertype'] = $this->session->userdata('order_type');
       $existing_customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if($existing_customer){
        $this->session->set_userdata('order_no', $existing_customer['order_no']);
    }
    else{
    $orders_id= $this->Homemodel->getorderid(); 
    $orderno = 'ORD' . date('Y') . $orders_id; 
    $this->session->set_userdata('order_no', $orderno);
    }
     //print_r($data['ordertype']); // will print 'bb'
      
    if (!$token) 
    {
        $token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
        set_cookie('guest_token', $token, 3600 * 24 ); // 1 days
    };
        $data['categories']=$this->Homemodel->listcategories();
        $data['home']=$this->Homemodel->gethome();
        $data['cart']= $this->Cartmodel->cartproducts($token);
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['store']=$this->Homemodel->getstore();
        $this->load->view('website/header', $data);
        $this->load->view('website/b2b',$data);
        $this->load->view('website/footer',$data);
        $this->db->where('user_token', $token);
        $query = $this->db->get('customers');
       //echo $token; $query->num_rows();exit;
         if ($query->num_rows() === 0) 
           {
            // Insert only if not exists
            $datas = [
                'user_token'   => $token,
                'order_no'     => $this->session->userdata('order_no'),
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                'is_active'    => 0,
                'order_type'   => $data['ordertype'],
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
            }   
    }


// export website
public function Export() {
        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');
        $this->session->set_userdata('order_type', 'exp');
    // echo "Order Type: " . $this->session->userdata('order_type');

     $data['ordertype'] = $this->session->userdata('order_type');
       $existing_customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if($existing_customer){
        $this->session->set_userdata('order_no', $existing_customer['order_no']);
    }
    else{
    $orders_id= $this->Homemodel->getorderid(); 
    $orderno = 'ORD' . date('Y') . $orders_id; 
    $this->session->set_userdata('order_no', $orderno);
    }
      
    if (!$token) 
    {
        $token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
        set_cookie('guest_token', $token, 3600 * 24 ); // 1 days
    };
    // Cart and other data
    $data['cartitems']     = $this->Cartmodel->cartitems($token);
    $data['sumofprice']    = $this->Cartmodel->getsumofprice($token);
    $data['cart']          = $this->Cartmodel->cartproducts($token);
    $data['categories']    = $this->Homemodel->listcategories();
    $data['subcategories'] = $this->Homemodel->getsubcategories();
    $data['seasonaloffer'] = $this->Homemodel->getseasonaloffer();
    $data['bestseller']    = $this->Homemodel->getbestseller();
    $data['home']          = $this->Homemodel->getexport();
    $data['testimonial']   = $this->Homemodel->gettestimonial();
    $data['brands']        = $this->Homemodel->listbrand();
    $data['headercategory']= $this->Homemodel->listheadercategories();
    $data['footercategory']= $this->Homemodel->listfootercategories();
    $data['store']         = $this->Homemodel->getstore();
    $data['slider']        = $this->Homemodel->getslider();
// get the export categories from product table
    $categories = $this->Homemodel->listcategories();
    // print_r( $categories); exit;
    
  $category_ids_with_export = [];
foreach ($categories as $category) {
    $category_id = $category['category_id'];
    $category_name = $category['category_name'];
    $category_image = $category['category_img'];
    $has_export = $this->Homemodel->has_export_products();
    if ($has_export) {
        $category_ids_with_export[] = [
            'id' => $category_id,
            'name' => $category_name,
            'image' => $category_image
        ];
    }
    $data['category_ids_with_export'] = $category_ids_with_export;
}
 // ✅ after loop

// print_r( $data['category_ids_with_export']); exit;

    // Check if token exists in DB
    $this->db->where('user_token', $token);
    $query = $this->db->get('customers');
    if ($query->num_rows() === 0) {
        $datas = [
            'user_token'   => $token,
            'order_no'     => $this->session->userdata('order_no'),
            'name'         => null,
            'email'        => null,
            'password'     => null,
            'phone'        => null,
            'address'      => null,
            'city'         => null,
            'state'        => null,
            'postal_code'  => null,
            'country'      => null,
            'is_active'    => 0,
            'order_type'   => $data['ordertype'],
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->Homemodel->inserttoken($datas);
    }

    // Finally render views
    $this->load->view('website/header', $data);
    $this->load->view('website/export', $data);
    $this->load->view('website/footer', $data);
}

public function logout() {
$this->load->helper('cookie');
$token = $this->input->cookie('guest_token');
$ordertype = $this->session->userdata('order_type');
// echo $ordertype; exit;
if($ordertype == 'ws')
    {
$this->session->unset_userdata('order_type'); delete_cookie('guest_token');
 $this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
// $this->db->where('user_token', $token)->delete('customers');

 $this->session->sess_destroy();
    redirect('wholesale');
}
else if($ordertype == 'rt')
{
    // echo  "here";
$this->session->unset_userdata('order_type');
delete_cookie('guest_token');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
// $this->db->where('user_token', $token)->delete('customers');
$this->session->sess_destroy();
redirect('home');
}

else if($ordertype == 'bb')
{
$this->session->unset_userdata('order_type');
delete_cookie('guest_token');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
// $this->db->where('user_token', $token)->delete('customers');

$this->session->sess_destroy();
redirect('b2b');
}

else if($ordertype == 'exp')
{
$this->session->unset_userdata('order_type');
delete_cookie('guest_token');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
// $this->db->where('user_token', $token)->delete('customers');

$this->session->sess_destroy();
redirect('export');
}

}

    public function productpage($id)
    {
    $token = $this->input->cookie('guest_token');
    $data['headercategory']=$this->Homemodel->listheadercategories();
    $data['footercategory']=$this->Homemodel->listfootercategories();
    $data['store']=$this->Homemodel->getstore();
    $data['subcategories']=$this->Homemodel->getsubcategories();
    $data['productdetails']=$this->Homemodel->getproductdetails($id);
    $data['ordertype'] = $this->session->userdata('order_type');

    $data['cart']= $this->Cartmodel->cartproducts($token);
    // print_r($data['productdetails']);
    $this->load->view('website/header', $data);
    $this->load->view('website/productdetails',$data);
    $this->load->view('website/footer',$data);
    }
    

public function getCategoriesproducts(){
    $category_id = $this->input->post('category_id');
    //  print_r($category_id);
    $subcategory_id = $this->input->post('subcategory_id');
    // print_r($subcategory_id);
    $products = $this->Homemodel->getCategoriesproducts($category_id, $subcategory_id);
    $this->session->userdata('order_type'); 
    $data['ordertype'] = $this->session->userdata('order_type');
    // print_r($products);
     $token = $this->input->cookie('guest_token');
     $cart= $this->Cartmodel->cartproducts($token);
    $html = '';
    
    if (count($products) > 0) {
   foreach ($products as $product) {
    $price= '';
    if ($data['ordertype'] == 'ws') {
            $price = $product['wholesale_price'];
        } elseif ($data['ordertype'] == 'rt') {
            $price = $product['retail_price'];
        } elseif ($data['ordertype'] == 'bb') {
            $price = $product['franchise_price'];
        }
        //  else {
        //     $price = 0;
        // }

    // Determine quantity from cart
    $quantity = 1;
    foreach ($cart as $item) {
        if ($item['product_id'] == $product['product_id']) {
            $quantity = $item['quantity'];
            break;
        }
    }

    $html .= '<div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item">';
    $html .= '<div class="service-box">';
    $html .= '<div class="project-grid-style2">';
    $html .= '<div class="project-details">';
    $html .= '<img src="' . base_url() . 'uploads/product/' . $product['image'] . '" alt="product" class="product__image-img" width="190" height="150">';
    $html .= '<div class="portfolio-post-border"></div>';
    $html .= '</div>'; // .project-details

    $html .= '<div class="portfolio-title text-center">';
    $html .= '<div class="portfolio-link">';
    $html .= '<a href="' . base_url('details/' . $product['product_id']) . '" class="product__details-name text-decoration-none">' . $product['product_name'] . '</a>';
    $html .= '</div>';

    $html .= '<p class="price-cart" data-price="' .  $price . '">₹' .  $price . '</p>';

    // Quantity section
    $html .= '<div class="d-flex align-items-center px-2 qty-area justify-content-center">';
    $html .= '<button class="btn btn-sm p-1 decrement-btn" data-product-id="' . $product['product_id'] . '">−</button>';
    $html .= '<span data-qty>' . $quantity . '</span>';
    $html .= '<button class="btn btn-sm p-1 increment-btn" data-product-id="' . $product['product_id'] . '">+</button>';
    $html .= '</div>'; // .qty-area

    // Add to Cart form
    $html .= '<form method="post" id="add_cart_form" enctype="multipart/form-data">';
    $html .= '<input type="hidden" id="cart_product_id"  name="cart_product_id" value="' . $product['product_id'] . '">';
    $html .= '<input type="hidden" id="quantity" name="quantity" value="' . $quantity . '" class="qty-input">';
   
    $html .= '<input type="hidden" id="price" name="price" value="' .  $price . '" class="qty-price">';
    $html .= '  <input type="hidden" id="product_weight" value="' . $product['weight'] . '" >';
    $html .= '  <input type="hidden" id="product_kg_g" value="' . $product['kg_g'] . '" >';
    //  $html .= '<input type="hidden" id="product_price" value="' . (isset($final_price) ? $final_price : $price) . '">';

    $html .= '<input type="hidden" id="product_price"  name="product_price" value="' .  $price . '" >';

    $html .= '<div class="d-flex justify-content-center gap-2 mt-3 product">';
    if ($product['out_of_stock'] == 1) {
        $html .= '<button type="button" class="btn btn-sm out-of-stock  d-flex align-items-center gap-1" disabled>';
        $html .= 'Out of Stock';
        $html .= '</button>';
    } else {
        $html .= '<button type="submit" class="btn btn-sm d-flex align-items-center gap-1" title="Add to Cart">';
        $html .= '<i class="fas fa-shopping-cart"></i> Add to Cart';
        $html .= '</button>';
    }

    $html .= '<button type="button" class="btn btn-sm d-flex align-items-center gap-1" id="wishlist_button">';
    $html .= '<i class="fas fa-heart"></i> Wishlist';
    $html .= '</button>';
    $html .= '</div>'; // .product
    $html .= '</form>';

    $html .= '</div>'; // .portfolio-title
    $html .= '</div>'; // .project-grid-style2
    $html .= '</div>'; // .service-box
    $html .= '</div>'; // .col
}

    } else {
        $html .= '<div class="col-md-12 col-sm-12 col-xs-12"><h4>No products found</h4></div>';
    }

    // Always return JSON only
    echo json_encode([
        'success' => true,
        'html' => $html
    ]);
}



public function category($category_id){
if(!$category_id){
    return show_404();
}
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order_type');
$this->load->view('website/header',$data);
$this->load->view('website/category',$data);
$this->load->view('website/footer',$data);
}



public function wholesalecategory($category_id){
if(!$category_id){
    return show_404();
}
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
// print_r($category);
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
//  echo $category_id; echo "here"; exit;
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
// print_r($data['products']);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order_type');
// print_r($data['ordertype']);
// print_r($data['products']); exit;
$this->load->view('website/header',$data);
$this->load->view('website/wholesalepage',$data);
$this->load->view('website/footer',$data);
}


public function b2bcategory($category_id){
if(!$category_id){
    return show_404();
}
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
// print_r($category);
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
//  echo $category_id; echo "here"; exit;
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
// print_r($data['products']);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order_type');
// print_r($data['ordertype']);
// print_r($data['products']); exit;
$this->load->view('website/header',$data);
$this->load->view('website/b2bpage',$data);
$this->load->view('website/footer',$data);
}


public function exportcategory($category_id){
if(!$category_id){
    return show_404();
}
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
//  echo $category_id; echo "here"; exit;
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order_type');
$this->load->view('website/header',$data);
$this->load->view('website/exportcategory',$data);
$this->load->view('website/footer',$data);
// print_r($category_id);

}



public function contact(){
$data['ordertype'] = $this->session->userdata('order_type');
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
$this->load->view('website/header', $data);
$this->load->view('website/contact',$data);
$this->load->view('website/footer', $data);
}


public function login() 
{
$token = $this->input->cookie('guest_token');
    // print_r($token);
$ordertype = $this->session->userdata('order_type');
    // echo $ordertype;    
$data['ordertype'] = $this->session->userdata('order_type');
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
// $this->load->view('website/header', $data);
$this->load->view('website/loginwebsite',$data);
// $this->load->view('website/footer', $data);
}


public function forgotpassword() 
{
$token = $this->input->cookie('guest_token');   
$data['ordertype'] = $this->session->userdata('order_type');
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
$this->load->view('website/header', $data);
$this->load->view('website/forgotpassword',$data);
$this->load->view('website/footer', $data);
}


public function checkout()
{
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$data['token']= $this->input->cookie('guest_token');
$data['weightcalculation']=$this->Cartmodel->getweightcalculation($token);
$ordersno = $this->session->userdata('order_no');
print_r($ordersno);
// $data['weightcalculation']=$this->Productmodel->getweightcalc($token);

$data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
$data['shipping_charge'] = $this->Cartmodel->get_shipping_by_state($data['customerdetails']['state']);
$data['sumofprice']=$this->Cartmodel->getsumofprice($token);
$data['sumofpricewishlist']=$this->Cartmodel->getsumofpricewishlist($token);
$data['shipping']=$this->Productmodel->listshipping();
$data['couponcode']=$data['customerdetails']['coupon_code'];
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['cart']= $this->Cartmodel->cartproducts($token);
$data['wishlist']=$this->Cartmodel->getwishlists($token);
$data['ordertype'] = $this->session->userdata('order_type');
$user_id = $this->session->userdata('user_id');
$data['checkoutdetails']=$this->Homemodel->getcheckoutdetails($token,$user_id);
$data['retailcheckoutdetails'] = $this->Homemodel->getretailcheckoutdetails($token);
$orders = $this->Homemodel->getOrdersByToken($token);
// print_r($orderno);
// $orders_id= $this->Homemodel->getorderid(); 
$data['orderno'] = $this->session->userdata('order_no');
// print_r($data['orderno']);



// $data['orderno'] = 'ORD' . date('Y') . $orders_id ?? $orderno; 
// print_r($data['orderno']);
$this->load->view('website/header', $data);
$this->load->view('website/checkout',$data);
 $this->load->view('website/footer', $data);  
}


public function websitelogin()
{
    
    $token = $this->input->cookie('guest_token');
    $ordertype = $this->session->userdata('order_type');
    // print_r($ordertype);
    // print_r($token);
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $user = $this->Homemodel->websitelogincheck($username, $password);
    if ($user) {
        
        $this->session->set_userdata([
            'user_id'   => $user->id,      // make sure your DB column is `id` or change accordingly
        ]);
        
         $updateData = [
            'user_token' => $token,
            'order_type' => 'ws',
            'name'    => $user->name,
            'email'   => $user->email,
            'address' => $user->address,
            'phone'   => $user->phone_number,
            'user_id' => $user->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // $this->db->where('user_token', $token);
$this->db->insert('customers', $updateData);

        echo json_encode(['success' => 'success', 'message' => 'Login successful','redirect_url' => base_url('home/wholesale')]);
    } else {
        echo json_encode(['success' => 'false', 'message' => 'Invalid email or password']);
    }
    
}


public function webforgotpassword()
{
    
    $token = $this->input->cookie('guest_token');
    $ordertype = $this->session->userdata('order_type');
    // print_r($ordertype);
    // print_r($token);
    $username = $this->input->post('username');
     $user = $this->db->where('email', $username)->or_where('email', $username)->get('dealer')->row();
     if($user){
         $newHash = password_hash($password, PASSWORD_BCRYPT);
        $plain = isset($user->plain_password) ? $user->plain_password : null;
        $name = isset($user->username) ? $user->username : null;
          $this->load->library('email');
    require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        require 'PHPMailer/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
        $mail->isSMTP();
        $mail->Host       = 'sg2plzcpnl505572.prod.sin2.secureserver.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@woodsberg.com';
        $mail->Password   = 'opX3(57,a0Mm'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
            $mail->setFrom('info@woodsberg.com', 'Woodsberg');
            $mail->addAddress($username); // send to dealer's email
            $mail->isHTML(true);
            $mail->Subject = 'Your Dealer Account password Credentials - Woodsberg';
            $mail->Body    = "
                Hello <b>".$name."</b>,<br><br>
                Your password credentials are as follows.<br><br>
                <b>Password:</b> ".$plain."<br><br>
                Regards,<br>
                <b>Woodsberg</b>
            ";

            if ($mail->send()) {
               // echo 'Email sent successfully';
                $response = ['success' => 'success', 'message' => 'Dealer added and email sent successfully'];
            } else {
                // echo 'Email sending failed';
             $response = ['success' => true, 'message' => 'Dealer added but email not sent: '.$mail->ErrorInfo];
            }
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
            $response = ['success' => true, 'message' => 'Dealer added but email failed: '.$mail->ErrorInfo];
        }

                echo json_encode(['success' => 'success','message' => 'Email sent successfully' ]);

          
        //  print_r($user); exit;
     }else{
        echo json_encode(['success' => 'false', 'message' => 'Invalid email']);
     }
        
   
//     if ($user) {
        
//         $this->session->set_userdata([
//             'user_id'   => $user->id,      // make sure your DB column is `id` or change accordingly
//         ]);
        
//          $updateData = [
//             'user_token' => $token,
//             'order_type' => 'ws',
//             'name'    => $user->name,
//             'email'   => $user->email,
//             'address' => $user->address,
//             'phone'   => $user->phone_number,
//             'user_id' => $user->id,
//             'updated_at' => date('Y-m-d H:i:s')
//         ];

//         // $this->db->where('user_token', $token);
// $this->db->insert('customers', $updateData);

//         echo json_encode(['success' => 'success', 'message' => 'Login successful','redirect_url' => base_url('home/wholesale')]);
//     } else {
//         echo json_encode(['success' => 'false', 'message' => 'Invalid email or password']);
//     }
    
}

public function addcontact(){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');  
            $this->form_validation->set_rules('contact_name', 'name', 'required');
            $this->form_validation->set_rules('contact_email', 'email', 'required');
            $this->form_validation->set_rules('contact_desc', 'description', 'required');
            $this->form_validation->set_rules('contact_phone', 'phone', 'required|regex_match[/^\d{10}$/]');



			if($this->form_validation->run() == FALSE) 
			{

                $response = [
					'success' => false,
					'errors' => [
					'contact_name' => form_error('contact_name'),
                    'contact_email' => form_error('contact_email'),
                    'contact_desc' => form_error('contact_desc'),
                    'contact_phone' => form_error('contact_phone'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
                $data = array(
                    'name' => $this->input->post('contact_name'),
                    'email' => $this->input->post('contact_email'),
                    'description' => $this->input->post('contact_desc'),
                    'phone_no' => $this->input->post('contact_phone'),
                );
                // print_r($data);exit;
                $this->Homemodel->insert_contact_details($data);
                echo json_encode(['success' => 'success']);
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

// MARK: customer email
public function customeremail($token)
{
    // $token = $this->input->cookie('guest_token');
    $cartitems = $this->Cartmodel->cartitems($token);

    $order = $this->db->where('guest_token', $token)->get('orders')->row_array();
    $orderno = $order['order_no'];

    //  $orders_id= $this->Homemodel->getorderid(); 
    //  $orderno = 'ORD' . date('Y') . $orders_id;  
      $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
                // $sumofprice=$this->Cartmodel->getsumofprice($token);
                $customer_id=$data['customerdetails']['id'];
                $customer_name=$data['customerdetails']['name'];
                $customer_phone=$data['customerdetails']['phone'];
                $customer_email=$data['customerdetails']['email'] ?: '';
                $customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
                $customer_coupon=$data['customerdetails']['coupon_code'] ?: '';

    
    $totalQty = 0;
    $grandTotal = 0;
    $rows = '';
    $i = 1;


foreach ($cartitems as $item) {
    $lineTotal = $item['quantity'] * $item['product_price'];
    $totalQty  += $item['quantity'];
    $grandTotal += $lineTotal;
     $imagePath = "https://woodsberg.com/uploads/product/" . $item['image'];

    $rows .= "
        <tr>
            <td>{$i}</td>
             <td><img src='{$imagePath}' alt='{$item['name']}' width='80' height='80' style='object-fit:cover;border-radius:8px;'></td>
<td>{$item['name']}</td>
<td>{$item['quantity']}</td>
<td class='price-col'>₹{$item['product_price']}</td>
<td class='total-col'>₹{$item['price']}</td>
</tr>
";
$i++;
}

try {
// echo 'Sending mail...'; exit;
$mail = $this->init_mailer();
$mail->addAddress($customer_email); // ✅ Send to customer or admin
$mail->isHTML(true);
$mail->Subject = 'Order Confirmation - Woodsberg';

$mail->Body = '
<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #333;
        padding-bottom: 20px;
    }

    .company-info h2 {
        margin: 0;
        color: #333;
        font-size: 24px;
    }

    .company-info p {
        margin: 5px 0;
        color: #666;
        font-size: 12px;
    }

    .invoice-info {
        text-align: right;
    }

    .invoice-info h3 {
        margin: 0;
        font-size: 28px;
        color: #333;
    }

    .invoice-info p {
        margin: 5px 0;
        color: #666;
    }

    .customer-section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .customer-details h4 {
        margin-top: 0;
        color: #333;
        text-transform: uppercase;
        font-size: 14px;
    }

    .customer-details p {
        margin: 3px 0;
        font-size: 13px;
        color: #555;
    }

    .order-info p {
        margin: 3px 0;
        font-size: 13px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 13px;
    }

    th,
    td {
        border: none;
        padding: 12px 8px;
        text-align: center;
    }

    th {
        background: #f8f9fa;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        font-size: 11px;
    }

    .item-desc {
        text-align: left;
        font-weight: 500;
    }

    .price-col,
    .total-col {
        font-weight: 500;
    }

    .grand-total {
        text-align: right;
        font-weight: bold;
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
        font-size: 18px;
    }

    .gst-info {
        margin: 20px 0;
        font-size: 12px;
        color: #666;
    }
    </style>
</head>

<body>
    <table width="100%" style="border-bottom:2px solid #333; margin-bottom:30px; padding-bottom:20px;">
        <tr>
            <!-- Left: Company Info -->
            <td style="text-align:left; vertical-align:top;">
                <h2 style="margin:0; font-size:24px; color:#333;">Woodsberg Furnitures</h2>
                <p style="margin:5px 0; font-size:12px; color:#666;">
                    Near Cherussericalam tower, Pallom mc road,<br>
                    Opposite Karimpiti taste land, Kottayam, Kerala - 686012
                </p>
                <p style="margin:5px 0; font-size:12px; color:#666;">Phone: +91 95449 42242</p>
            </td>

            <!-- Right: Invoice Info -->
            <td style="text-align:right; vertical-align:top;">
                <h3 style="margin:0; font-size:28px; color:#333;">Estimate</h3>
                <p style="margin:5px 0; font-size:13px;"><strong>Order ID:</strong> '.$orderno.'</p>
                <p style="margin:5px 0; font-size:13px;"><strong>Date:</strong> '.date("d-m-Y").'</p>
            </td>
        </tr>
    </table>



    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            '.$rows.'
        </tbody>
    </table>

    <div class="grand-total">
        Grand Total: <span style="color: #e74c3c;">₹'.number_format($grandTotal, 2).'</span>
    </div>
</body>

</html>';

// <p>Your order has been placed successfully. Order No: <b>'.$orderno.'</b></p>';
$mail->send();
// echo $mail; exit;
$mail_status = 'Mail sent successfully.';
// echo $mail_status; exit;
}
catch (Exception $e)
{
$mail_status = 'Mail Error: '.$mail->ErrorInfo;
}
}

// MARK: owner mail

public function owneremail($token){
// $token = $this->input->cookie('guest_token');
$cartitems = $this->Cartmodel->cartitems($token);
$order = $this->db->where('guest_token', $token)->get('orders')->row_array();
$orderno = $order['order_no'];
// $orders_id= $this->Homemodel->getorderid(); 
// $orderno = 'ORD' . date('Y') . $orders_id;  
$data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
// $sumofprice=$this->Cartmodel->getsumofprice($token);
$customer_id=$data['customerdetails']['id'];
$customer_name=$data['customerdetails']['name'];
$customer_phone=$data['customerdetails']['phone'];
$customer_email=$data['customerdetails']['email'] ?: '';
$customer_address=$data['customerdetails']['address'] ?: '';
$customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
$customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
 foreach ($cartitems as &$item) 
    {
        if (!empty($item['image'])) {
            $item['image_url'] = base_url('uploads/products/' . $item['image']);
        } else {
            $item['image_url'] = base_url('assets/images/no-image.png'); // fallback
        }
    }

$data=[
    'orderno'=>$orderno,
    'customer_id'=>$customer_id,
    'customer_name'=>$customer_name,
    'customer_phone'=>$customer_phone,
    'customer_email'=>$customer_email,
    'customer_address'=>$customer_address,
    'customer_shipping'=>$customer_shipping,
    'customer_coupon'=>$customer_coupon,
    'cartitems'=>$cartitems
];
// print_r($data); exit;
    $email_body = $this->load->view('website/email', $data, TRUE);

    try {
        $mail = $this->init_mailer();
        $mail->clearAllRecipients();
        $mail->addAddress('arjunvt67@gmail.com'); // or admin email
        $mail->isHTML(true);
        $mail->Subject = 'New Order Received - ' . $orderno;
        $mail->Body = $email_body;
        $mail->send();

       // echo 'Mail sent successfully.';
    } catch (Exception $e) {
        echo 'Mail Error: ' . $mail->ErrorInfo;
    }
}



//MARK: retail mail

public function ownerretailemail($token){
$cartitems = $this->Cartmodel->cartitems($token);
$order = $this->db->where('guest_token', $token)->get('orders')->row_array();
$orderno = $order['order_no'];
// $orders_id= $this->Homemodel->getorderid(); 
// $orderno = 'ORD' . date('Y') . $orders_id;  
$data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
// $sumofprice=$this->Cartmodel->getsumofprice($token);
$customer_id=$data['customerdetails']['id'];
$customer_name=$data['customerdetails']['name'];
$customer_phone=$data['customerdetails']['phone'];
$customer_email=$data['customerdetails']['email'] ?: '';
$customer_address=$data['customerdetails']['address'] ?: '';
$customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
$customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
 foreach ($cartitems as &$item) 
    {
        if (!empty($item['image'])) {
            $item['image_url'] = base_url('uploads/products/' . $item['image']);
        } else {
            $item['image_url'] = base_url('assets/images/no-image.png'); // fallback
        }
    }

$data=[
    'orderno'=>$orderno,
    'customer_id'=>$customer_id,
    'customer_name'=>$customer_name,
    'customer_phone'=>$customer_phone,
    'customer_email'=>$customer_email,
    'customer_address'=>$customer_address,
    'customer_shipping'=>$customer_shipping,
    'customer_coupon'=>$customer_coupon,
    'cartitems'=>$cartitems
];
// print_r($data); exit;
    $email_body = $this->load->view('website/email', $data, TRUE);

    try {
        $mail = $this->init_mailer();
        $mail->clearAllRecipients();
        $mail->addAddress('woodsbergorder@gmail.com'); // or admin email
        $mail->isHTML(true);
        $mail->Subject = 'New Order Received - ' . $orderno;
        $mail->Body = $email_body;
        $mail->send();
       // echo 'Mail sent successfully.';
    } catch (Exception $e) {
        echo 'Mail Error: ' . $mail->ErrorInfo;
    }
}





public function decrease_stock_afterpurchase($token,$orderno){
$cart_items = $this->Cartmodel->cartitems($token);  
foreach ($cart_items as $item)
{
$product_id = $item['product_id'];
$quantity = $item['quantity'];
$price = $item['product_price'];
$amount = $item['price'];
$this->db->insert('store_stock',
[
'product_id' => $product_id,
'tr_date' => date('Y-m-d '),
'order_id' => $orderno,
'ttype'=> 'SL',
'pu_qty' => 0,
'sl_qty' => $quantity,
'created_by' => 0,
'created_date' => date('Y-m-d H:i:s'),
'modified_by' => 0,
'modified_date' => date('Y-m-d H:i:s')
]
);
}

}

public function getshippingvalue(){
        $token= $this->input->post('token');
        // print_r($token);exit;
    $this->db->select_sum('quantity');
    $this->db->where('guest_token', $token);
    $query = $this->db->get('cart');
    $result = $query->row();
   $total_qty = $result->quantity ?? 0;
    if ($total_qty <= 3) {
        $shipping_charge = 150;
        $charge = $shipping_charge;
    } else {
        $shipping_charge = 60;
          $charge = $total_qty * $shipping_charge;
    }
    echo json_encode([
        'success' => 'success',
        'total_qty' => $total_qty,
        'shipping_charge' => $shipping_charge,
        'charge' => $charge
    ]);
 
    
}



public function addusercheckout()
{
$total_amount = $this->input->post('total_amount');
$shipping_charge = $this->input->post('shipping_charge');
$coupon_code = $this->input->post('coupon_code');
$state = $this->input->post('state');
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$cartitems = $this->Cartmodel->cartitems($token);
$base_url = base_url();
if (!$token)
{
$token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
set_cookie('guest_token', $token, 3600 * 24 * 24); // 30 days
}
$order_type = 'rt';
$this->form_validation->set_rules('checkout_username', 'First Name', 'required');
$this->form_validation->set_rules('checkout_useremail', 'Email', 'required|valid_email');
$this->form_validation->set_rules('checkout_userphone', 'Phone', 'required|regex_match[/^\d{10}$/]');
$this->form_validation->set_rules('checkout_usercity', 'City', 'required');
$this->form_validation->set_rules('checkout_userpostcode', 'Postcode', 'required');
$this->form_validation->set_rules('checkout_usercountry', 'Country', 'required');
$this->form_validation->set_rules('checkout_useraddress', 'Address', 'required');
$this->form_validation->set_rules('state', 'State', 'required');

if($this->form_validation->run() == FALSE)
{

    $errors = array();
    $errors['checkout_username'] = form_error('checkout_username');
    $errors['checkout_useremail'] = form_error('checkout_useremail');
    $errors['checkout_userphone'] = form_error('checkout_userphone');
    $errors['checkout_usercity'] = form_error('checkout_usercity');
    $errors['checkout_userpostcode'] = form_error('checkout_userpostcode');
    $errors['checkout_usercountry'] = form_error('checkout_usercountry');
    $errors['checkout_useraddress'] = form_error('checkout_useraddress');
    $errors['state'] = form_error('state');

    echo json_encode([
    'success' => false,
    'errors' => $errors
    ]);

}

else
{
    $data = array(
    'user_token' => $token,
    'name' => $this->input->post('checkout_username'),
    'email' => $this->input->post('checkout_useremail')?: null,
    'password' => 0,
    'phone' => $this->input->post('checkout_userphone')?: null,
    'address' => $this->input->post('checkout_useraddress')?: null,
    'city' => $this->input->post('checkout_usercity')?: null,
    'state' => $state ?: null,
    'shipping_charge' => $shipping_charge ?: 0,
    'coupon_code' => $coupon_code ?: 0,
    'postal_code' => $this->input->post('checkout_userpostcode')?: null,
    'country' => $this->input->post('checkout_usercountry')?: null,
    'is_active' => 1,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
    );
    $this->Homemodel->updatecustomer($data,$token);
    $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
    $customer_id=$data['customerdetails']['id'];
    $customer_name=$data['customerdetails']['name'];
    $customer_phone=$data['customerdetails']['phone'];
    $customer_email=$data['customerdetails']['email'] ?: '';
    $customer_address=$data['customerdetails']['address'] ?: '';
    $customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
    $customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
    $this->db->where('guest_token',$token);
    $existing_order = $this->db->get('orders')->row_array();
    if($existing_order)
{
    $orderno=$existing_order['order_no'];
    $this->db->where('guest_token', $token); 
    $this->db->delete('orders');
}
else
{
    $orderno = $this->session->userdata('order_no');
    // print_r($ordersno);exit;
    // echo $ordersno;
    // $orders_id= $this->Homemodel->getorderid(); 
    // $orderno = 'ORD' . date('Y') . $orders_id;  
    
}
    $this->db->insert('orders',
[
    'order_no'=> $orderno,
    'customer_id' => $customer_id ?? 0,
    'total_amount' => $total_amount,
    'guest_token' => $token,
    'status' => 0,
    'order_date' => date('Y-m-d H:i:s'),
    'time' => date('H:i:s'),
    'delivery_date' => 0,
    'payment_status' => 'Pending',   // pending , processing, success
    'order_type' =>$order_type,
    'name'=>$customer_name,
    'email'=>$customer_email,
    'store_id'=> 1,
    'phone'=>$customer_phone,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
]);
$order_id = $this->db->insert_id();
$cart_items = $this->Cartmodel->cartitems($token);
$this->db->where('order_id', $orderno);
$this->db->delete('order_items');
foreach ($cart_items as $item)
{
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['product_price'];
    $amount = $item['price'];
    $this->db->insert('order_items',
    [
    'order_id' => $orderno,
    'product_id' => $product_id,
    'quantity' => $quantity,
    'price' => $price,
    'amount' => $amount,
    'total_price' => $total_amount,
    'order_type' => $order_type,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
    ]
    );
}

    $query = [
    'order_id' => $orderno,
    'amount' => $total_amount,
    'cust_id' => $customer_id,
    'cust_name' => $customer_name,
    'cust_phone' => $customer_phone,
    'cust_email' => $customer_email,
    'cust_shipping' => $customer_shipping,
    'cust_coupon' => $customer_coupon,
    'base_url' => base_url(),
    ];
    $checkout_url = base_url("Payment/index.php");
    echo json_encode([
    'success' => 'success',
    'message' => 'Order placed',
    'redirect_url' => $checkout_url,
    'base_url' => base_url(),
    'cartitems' => $cartitems,
    'query' => $query,
    ]);
    return;
}

}


public function addwholesalecheckout()
{
$total_amount = $this->input->post('total_amount');
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$cartitems = $this->Cartmodel->cartitems($token);
$base_url = base_url(); 
if (!$token)
{
$token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
set_cookie('guest_token', $token, 3600 * 24 * 24); // 30 days
}

$order_type = 'ws';
$this->form_validation->set_rules('checkout_username', 'First Name', 'required');
$this->form_validation->set_rules('checkout_useremail', 'Email', 'required|valid_email');
$this->form_validation->set_rules('checkout_userphone', 'Phone', 'required|regex_match[/^\d{10}$/]');
$this->form_validation->set_rules('checkout_useraddress', 'Address', 'required');
if($this->form_validation->run() == FALSE)
{

    $errors = array();
    $errors['checkout_username'] = form_error('checkout_username');
    $errors['checkout_useremail'] = form_error('checkout_useremail');
    $errors['checkout_userphone'] = form_error('checkout_userphone');
    $errors['checkout_useraddress'] = form_error('checkout_useraddress');

    echo json_encode([
    'success' => false,
    'errors' => $errors
    ]);

}

else
{
    $data = array(
    'user_token' => $token,
    'name' => $this->input->post('checkout_username'),
    'email' => $this->input->post('checkout_useremail')?: null,
    'password' => 0,
    'phone' => $this->input->post('checkout_userphone')?: null,
    'address' => $this->input->post('checkout_useraddress')?: null,
    'city' =>0,
    'state' => 0,
    'shipping_charge' => 0,
    'coupon_code' => 0,
    'postal_code' =>  0,
    'country' => 'India',
    'is_active' => 1,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
    );
    $this->Homemodel->updatecustomer($data,$token);
    $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
    $customer_id=$data['customerdetails']['id'];
    $customer_name=$data['customerdetails']['name'];
    $customer_phone=$data['customerdetails']['phone'];
    $customer_email=$data['customerdetails']['email'] ?: '';
    $customer_address=$data['customerdetails']['address'] ?: '';
    $customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
    $customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
    $this->db->where('guest_token',$token);
    $existing_order = $this->db->get('orders')->row_array();
    if($existing_order )
{
    $orderno=$existing_order['order_no'];
    $this->db->where('guest_token', $token); 
    $this->db->delete('orders');
}
else
{
$orderno = $this->session->userdata('order_no');
}
    $this->db->insert('orders',
[
    'order_no'=> $orderno,
    'customer_id' => $customer_id ?? 0,
    'total_amount' => $total_amount,
    'guest_token' => $token,
    'status' => 0,
    'order_date' => date('Y-m-d H:i:s'),
    'time' => date('H:i:s'),
    'delivery_date' => 0,
    'payment_status' => 0,
    'is-paid' => 1,   // pending , processing, success
    'order_type' =>$order_type,
    'name'=>$customer_name,
    'email'=>$customer_email,
    'store_id'=> 1,
    'phone'=>$customer_phone,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
]);
$order_id = $this->db->insert_id();
$cart_items = $this->Cartmodel->cartitems($token);
$this->db->where('order_id', $orderno);
$this->db->delete('order_items');

foreach ($cart_items as $item)
{
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['product_price'];
    $amount = $item['price'];
    $this->db->insert('order_items',
    [
    'order_id' => $orderno,
    'product_id' => $product_id,
    'quantity' => $quantity,
    'price' => $price,
    'amount' => $amount,
    'total_price' => $total_amount,
    'order_type' => $order_type,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
    ]
    );
}
$this->decrease_stock_afterpurchase($token,$orderno);
$this->customeremail($token);
$this->owneremail($token);
$this->session->unset_userdata('order_type');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
$this->session->unset_userdata('user_id');
delete_cookie('guest_token');
// ✅ 2. Create new guest token
$new_token = bin2hex(random_bytes(8));
$cookie = [
'name' => 'guest_token',
'value' => $new_token,
'expire' => 3600 * 24 * 30,
'path' => '/',
'secure' => TRUE,
'httponly' => TRUE
];
$this->input->set_cookie($cookie);
echo json_encode([
'success' => 'success',
'ordertype' => $order_type,
'new_token' => $new_token,
'message' => ' order handled successfully.',
]);

}

}




public function addb2bcheckout()
{
$total_amount = $this->input->post('total_amount');
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$cartitems = $this->Cartmodel->cartitems($token);
$base_url = base_url(); 
if (!$token)
{
$token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
set_cookie('guest_token', $token, 3600 * 24 * 24); // 30 days
}

$order_type = 'bb';
$this->form_validation->set_rules('checkout_username', 'First Name', 'required');
$this->form_validation->set_rules('checkout_useremail', 'Email', 'required|valid_email');
$this->form_validation->set_rules('checkout_userphone', 'Phone', 'required|regex_match[/^\d{10}$/]');
$this->form_validation->set_rules('checkout_useraddress', 'Address', 'required');
if($this->form_validation->run() == FALSE)
{

    $errors = array();
    $errors['checkout_username'] = form_error('checkout_username');
    $errors['checkout_useremail'] = form_error('checkout_useremail');
    $errors['checkout_userphone'] = form_error('checkout_userphone');
    $errors['checkout_useraddress'] = form_error('checkout_useraddress');

    echo json_encode([
    'success' => false,
    'errors' => $errors
    ]);

}

else
{
    $data = array(
    'user_token' => $token,
    'name' => $this->input->post('checkout_username'),
    'email' => $this->input->post('checkout_useremail')?: null,
    'password' => 0,
    'phone' => $this->input->post('checkout_userphone')?: null,
    'address' => $this->input->post('checkout_useraddress')?: null,
    'city' =>0,
    'state' => 0,
    'shipping_charge' => 0,
    'coupon_code' => 0,
    'postal_code' =>  0,
    'country' => 'India',
    'is_active' => 1,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
    );
    $this->Homemodel->updatecustomer($data,$token);
    $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
    $customer_id=$data['customerdetails']['id'];
    $customer_name=$data['customerdetails']['name'];
    $customer_phone=$data['customerdetails']['phone'];
    $customer_email=$data['customerdetails']['email'] ?: '';
    $customer_address=$data['customerdetails']['address'] ?: '';
    $customer_shipping=$data['customerdetails']['shipping_charge'] ?: '';
    $customer_coupon=$data['customerdetails']['coupon_code'] ?: '';
    $this->db->where('guest_token',$token);
    $existing_order = $this->db->get('orders')->row_array();
    if($existing_order )
{
    $orderno=$existing_order['order_no'];
    $this->db->where('guest_token', $token); 
    $this->db->delete('orders');
}
else
{
$orderno = $this->session->userdata('order_no');
}

// echo $orderno; exit;
    $this->db->insert('orders',
[
    // echo $orderno;
    'order_no'=> $orderno,
    'customer_id' => $customer_id ?? 0,
    'total_amount' => $total_amount,
    'guest_token' => $token,
    'status' => 0,
    'order_date' => date('Y-m-d H:i:s'),
    'time' => date('H:i:s'),
    'delivery_date' => 0,
    'payment_status' => 0,
    'is_paid' => 0,  
    'order_type' =>$order_type,
    'name'=>$customer_name,
    'email'=>$customer_email,
    'store_id'=> 1,
    'phone'=>$customer_phone,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
]);

$order_id = $this->db->insert_id();
$cart_items = $this->Cartmodel->cartitems($token);
$this->db->where('order_id', $orderno);
$this->db->delete('order_items');
foreach ($cart_items as $item)
{
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['product_price'];
    $amount = $item['price'];
    $this->db->insert('order_items',
    [
    'order_id' => $orderno,
    'product_id' => $product_id,
    'quantity' => $quantity,
    'price' => $price,
    'amount' => $amount,
    'total_price' => $total_amount,
    'order_type' => $order_type,
    'shipping_charge'=>$customer_shipping,
    'coupon_code'=>$customer_coupon
    ]
    );
}
$this->decrease_stock_afterpurchase($token,$orderno);
// $this->customeremail($token);
// $this->owneremail($token);
$this->session->unset_userdata('order_type');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
$this->session->unset_userdata('user_id');
delete_cookie('guest_token');
// ✅ 2. Create new guest token
$new_token = bin2hex(random_bytes(8));
$cookie = [
'name' => 'guest_token',
'value' => $new_token,
'expire' => 3600 * 24 * 30,
'path' => '/',
'secure' => TRUE,
'httponly' => TRUE
];
$this->input->set_cookie($cookie);
echo json_encode([
'success' => 'success',
'ordertype' => $order_type,
'new_token' => $new_token,
'message' => ' order handled successfully.',
]);

}

}

public function handlePaymentResponse()
{
$order_type = $this->session->userdata('order_type');
$order_id = $this->input->post('order_id');
$transaction_id = $this->input->post('transaction_id');
// echo "id=".$transaction_id; exit;
$order = $this->db->where('order_no', $order_id)->get('orders')->row_array();
$token = $order['guest_token'];
$coupon_code= $order['coupon_code'];
$shipping_charge = $order['shipping_charge'];
$total_amount = $order['total_amount'];
$order = $this->db->where('guest_token', $token)->get('orders')->row_array();
$orderno = $order['order_no'];
$cartitems = $this->Cartmodel->cartitems($token);
// print_r($cartitems);
$data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
$customer_email=$data['customerdetails']['email'] ?: '';
$customer_name=$data['customerdetails']['name'] ?: '';
$customer_phone=$data['customerdetails']['phone'] ?: '';
$customer_address=$data['customerdetails']['address'] ?: '';
$customer_pincode=$data['customerdetails']['postal_code'] ?: '';
$customer_state=$data['customerdetails']['state'] ?: '';
$customer_id=$data['customerdetails']['id'];
$status = $this->input->post('status');
$parts = explode('|', $status);
$txn_status = strtolower(trim($parts[1] ?? '')); // e.g., 'success', 'user aborted'
// print_r($txn_status);
if ($txn_status  &&  $order_id)
{
$this->Homemodel->updatePaymentStatus($order_id,$transaction_id,$txn_status);
$this->Homemodel->regenerateOrderId($orders_id);
$this->decrease_stock_afterpurchase($token,$order_id);
$totalQty = 0;
$grandTotal = 0;
$rows = '';
$i = 1;

foreach ($cartitems as $item)
{
$lineTotal = $item['quantity'] * $item['product_price'];
$totalQty += $item['quantity'];
$grandTotal += $lineTotal;
$imagePath = "https://woodsberg.com/uploads/product/" . $item['image'];
$rows .= "
<tr>
    <td>{$i}</td>
     <td><img src='{$imagePath}' alt='{$item['name']}' width='80' height='80' style='object-fit:cover;border-radius:8px;'></td>
    <td>{$item['name']}</td>
    <td>{$item['quantity']}</td>
    <td>₹{$item['product_price']}</td>
    <td>₹{$item['price']}</td>
</tr>
";
$i++;
}

try {
// $mail->SMTPDebug = 2;
// $mail->Debugoutput = 'error_log';
// echo 'Sending mail...'; exit;
$mail = $this->init_mailer();
$mail->clearAllRecipients();
$mail->addAddress($customer_email); // ✅ Send to customer or admin
$mail->isHTML(true);
$mail->Subject = 'Order Confirmation - Woodsberg';

$mail->Body = '
<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #333;
        padding-bottom: 20px;
    }

    .company-info h2 {
        margin: 0;
        color: #333;
        font-size: 24px;
    }

    .company-info p {
        margin: 5px 0;
        color: #666;
        font-size: 12px;
    }

    .invoice-info {
        text-align: right;
    }

    .invoice-info h3 {
        margin: 0;
        font-size: 28px;
        color: #333;
    }

    .invoice-info p {
        margin: 5px 0;
        color: #666;
    }

    .customer-section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .customer-details h4 {
        margin-top: 0;
        color: #333;
        text-transform: uppercase;
        font-size: 14px;
    }

    .customer-details p {
        margin: 3px 0;
        font-size: 13px;
        color: #555;
    }

    .order-info p {
        margin: 3px 0;
        font-size: 13px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 13px;
    }

    th,
    td {
        border: none;
        padding: 12px 8px;
        text-align: center;
    }

    th {
        background: #f8f9fa;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        font-size: 11px;
    }

    .item-desc {
        text-align: left;
        font-weight: 500;
    }

    .price-col,
    .total-col {
        font-weight: 500;
    }

    .grand-total {
        text-align: right;
        font-weight: bold;
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
        font-size: 18px;
    }

    .gst-info {
        margin: 20px 0;
        font-size: 12px;
        color: #666;
    }
    </style>
</head>

<body>

    <table width="100%" style="border-bottom:2px solid #333; margin-bottom:30px; padding-bottom:20px;">
        <tr>
            <!-- Left: Company Info -->
            <td style="text-align:left; vertical-align:top;">
                <h2 style="margin:0; font-size:24px; color:#333;">Woodsberg Furnitures</h2>
                <p style="margin:5px 0; font-size:12px; color:#666;">
                    Near Cherussericalam tower, Pallom mc road,<br>
                    Opposite Karimpiti taste land, Kottayam, Kerala - 686012
                </p>
                <p style="margin:5px 0; font-size:12px; color:#666;">Phone: +91 95449 42242</p>
            </td>

            <!-- Right: Invoice Info -->
            <td style="text-align:right; vertical-align:top;">
                <h3 style="margin:0; font-size:28px; color:#333;">Estimate</h3>
                <p style="margin:5px 0; font-size:13px;"><strong>Order ID:</strong> '.$orderno.'</p>
                <p style="margin:5px 0; font-size:13px;"><strong>Date:</strong> '.date("d-m-Y").'</p>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            '.$rows.'
        </tbody>
    </table>


    <div class="grand-total">
        Shipping Charge : <span style="color: #e74c3c;">₹'.number_format($shipping_charge, 2).'</span>
    </div>

    <div class="grand-total">
        Coupon Code : <span style="color: #e74c3c;">₹'.number_format($coupon_code, 2).'</span>
    </div>

    <div class="grand-total">
        Grand Total: <span style="color: #e74c3c;">₹'.number_format($total_amount, 2).'</span>
    </div>


</body>

</html>';

$mail->send();
$mail->clearAllRecipients(); // ✅ Reset recipients for second mail

$this->ownerretailemail($token);

// $mail->addAddress('woodsbergorder@gmail.com');
// $mail->Subject = 'New Order Placed - '.$orderno;
// $mail->Body = '
// <!DOCTYPE html>
// <html>

// <head>
//     <style>
//     /* your CSS */
//     </style>
// </head>

// <body>
//     <div class="customer-section">
//         <div class="customer-details">
//             <h4>Customer Details</h4>
//             <p><strong> Name:'. $customer_name.'</strong></p>
//             <p>Email: '.$customer_email.'</p>
//             <p>Phone: '.$customer_phone.'</p>
//             <p>Address: '.$customer_address.'</p>
//            <p>Pincode: '.$customer_pincode.'</p> 

//         </div>
//     </div>



//     <table>
//         <thead>
//             <tr>
//                 <th>No.</th>
//                 <th>Product</th>
//                 <th>Qty</th>
//                 <th>Price</th>
//                 <th>Total</th>
//             </tr>
//         </thead>
//         <tbody>
//             '.$rows.'
//         </tbody>
//     </table>
// </body>
// <div class="grand-total">
//     Shipping Charge : <span style="color: #e74c3c;">₹'.number_format($shipping_charge, 2).'</span>
// </div>

// <div class="grand-total">
//     Coupon Code : <span style="color: #e74c3c;">₹'.number_format($coupon_code, 2).'</span>
// </div>

// <div class="grand-total">
//     Grand Total: <span style="color: #e74c3c;">₹'.number_format($total_amount, 2).'</span>
// </div>

// </html>';
// $mail->send();
// // echo $mail; exit;
// $mail_status = 'Mail sent successfully.';
// echo $mail_status; exit;
}
catch (Exception $e)
{
$mail_status = 'Mail Error: '.$mail->ErrorInfo;
}

}

// ✅ 3. Send Mail after handling order

}



public function clearPaymentSession()
{
$order_type = $this->session->userdata('order_type');
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$this->session->unset_userdata('order_type');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
delete_cookie('guest_token');
// ✅ 2. Create new guest token
$new_token = bin2hex(random_bytes(8));
$cookie = [
'name' => 'guest_token',
'value' => $new_token,
'expire' => 3600 * 24 * 30,
'path' => '/',
'secure' => TRUE,
'httponly' => TRUE
];
$this->input->set_cookie($cookie);
echo json_encode([
'success' => 'success',
'message' => 'Payment session cleared successfully',
'ordertype' => $order_type,
'new_token' => $new_token
]);

}



public function show_404()
{
    return $this->load->view('website/404');
}

}
?>