<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller {
        public function __construct() {
        parent::__construct();

        $this->load->model('admin/Productmodel');
        $this->load->model('Cartmodel');
         $this->load->model('Homemodel');
        $this->load->library('session');
        $this->load->helper('url');
        // $this->load->helper('cookie');

    //      if (!$this->input->cookie('guest_token')) {
    //     $token = bin2hex(random_bytes(8)); // 32 char token
    //     set_cookie('guest_token', $token, 3600*24); // expires in 1 day
    // }
    }

    public function cartview(){
        $token= $this->session->userdata('guest_token');
        $data['token']=$token;
         $data['ordertype'] = $this->session->userdata('order_type');
        // print_r($data['ordertype']);
        $data['cartitems'] = $this->Cartmodel->cartitems($token);
        $data['sumofprice']=$this->Cartmodel->getsumofprice($token);
        $data['weightcalculation']=$this->Productmodel->getweightcalc($token);
        // echo $data['weightcalculation'];
        $data['cart']= $this->Cartmodel->cartproducts($token);
        
        $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
       // print_r($data['customerdetails']); exit;
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['store']=$this->Homemodel->getstore();
        $data['shipping']=$this->Productmodel->listshipping();
        $this->load->view('website/header', $data);
         $this->load->view('website/cart',$data);
         $this->load->view('website/footer', $data);
    }

    public function wishlist(){
        $data['ordertype'] = $this->session->userdata('order_type');
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $token= $this->session->userdata('guest_token');
        // $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
        // $data['weightcalculation']=$this->Productmodel->getweightcalcinwishlist($token);
        // $data['shipping']=$this->Productmodel->listshipping();
        $data['sumofprice']= $this->Cartmodel->getsumofpricewishlist($token);
        $data['wishlist']=$this->Cartmodel->getwishlist($token);
        $data['store']=$this->Homemodel->getstore();
        $this->load->view('website/header', $data);
        $this->load->view('website/wishlist',$data); 
         $this->load->view('website/footer', $data);  
    }

    public function cart(){
        // echo "here"; exit;
        $cookie= $this->session->userdata('guest_token');
        $cart_product_id= $this->input->post('cart_product_id');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
          if ($quantity <= 0 || $price <= 0) 
    {
        echo json_encode(['error' => 'error', 'message' =>  'Quantity and price must be greater than 0']);
        return;
    }
        // print_r($price);
        $product_price= $this->input->post('product_price');
        $calculate_weight = $this->input->post('calculateweight');
        // echo $calculate_weight;
        $product_weight= $this->input->post('product_weight');
        $product_kg_g= $this->input->post('product_kg_g');
        // echo $calculate_weight; exit;

    $product= $this->Cartmodel->getcartitems($cart_product_id);
        // print_r($product);
        if ($product) {
    $product_id = $product[0]['product_id'];
    $product_name = $product[0]['product_name'];
    $product_image = $product[0]['image'];
    $currentprice = $product[0]['price'];
    // $quan = $product[0]['quantity'];
    $full_weight = $product_weight . $product_kg_g;

    $totalKg = $product_weight * $quantity;
    $calculatedweight = number_format($totalKg, 2) . 'kg';
    
    // Check if product already exists in cart (for same guest)
    $this->db->where('product_id', $product_id);
    $this->db->where('guest_token', $cookie);
    $query = $this->db->get('cart');
    if ($query->num_rows() > 0) {
    // ✅ Product exists: update quantity directly
    $this->db->where('product_id', $product_id);
    $this->db->where('guest_token', $cookie);
   $this->db->update('cart', [
    'quantity' => $quantity,
    'product_price' => $product_price,
    'price'    => $price,
    'full_weight' => $calculate_weight
]);
} else {
    $data = [
        'product_id' => $product_id,
        'user_id' => 0,
        'guest_token' => $cookie,
        'name' => $product_name,
        'quantity' => $quantity,
        'price' => $price,
        'product_price' => $product_price,
        'image' => $product_image,
        'full_weight' =>$calculatedweight,
        'default_weight' => $full_weight
    ];
    $this->Cartmodel->insert_cart($data);

}
    echo json_encode(['success' => 'success','cookie'=>$cookie,'calculatedweight'=>$calculatedweight]);
} else {
    echo json_encode(['error' => 'Product not found']);
}
 
    }


public function loadcart(){
    $token= $this->session->userdata('guest_token');
    $cartitems=$this->Cartmodel->cartitems($token);
    $sumofprice=$this->Cartmodel->getsumofprice($token);
    $customerdetails= $this->db->where('user_token', $token)->get('customers')->row_array();
     $total_amout = $sumofprice;

// if (!empty($customerdetails) && is_array($customerdetails)) {

//     if (!empty($customerdetails['coupon_code']) && $customerdetails['coupon_code'] != 0) {
//         $total_amout -= $customerdetails['coupon_code'];
//     }

//     if (!empty($customerdetails['shipping_charge']) && $customerdetails['shipping_charge'] != 0) 
//     {
//         $total_amout += $customerdetails['shipping_charge'];
//     }

//     $shippingcharge = 0;

// if (is_array($customerdetails) && isset($customerdetails['shipping_charge'])) {
//     $shippingcharge = $customerdetails['shipping_charge'];
// }

// }

    if (!empty($customerdetails['coupon_code'] != 0)) {
        $total_amout -= $customerdetails['coupon_code'];
    }

    if (!empty($customerdetails['shipping_charge'] != 0)) {
        $total_amout += $customerdetails['shipping_charge'];
    }

    $weight=$this->Productmodel->getweightcalc($token);
    
//    $shippingcharge = isset($shippingcharge) ? $shippingcharge : 0;

    if (preg_match('/([\d.]+)\s*(kg|g)/i', $weight, $matches)) {
    $weightValue = (float)$matches[1];        
    $unit = strtolower($matches[2]);  
    $shippingcharge= $customerdetails['shipping_charge'];        

    // Convert to kg
    if ($unit === 'g') {
        $weightInKg = $weightValue / 1000;
    } 
    else {
        $weightInKg = $weightValue;
    }

    // Minimum 1kg charge rule
    if ($weightInKg <= 1) {
        $shipping = $shippingcharge;
    } else {
        $shipping = $weightInKg * $shippingcharge;
    }

} else {
    $shipping = 0; // fallback
}

    echo json_encode(['success' => 'success', 'data' => $cartitems, 'message'=>'product added to cart successfully','totalprice'=>$sumofprice,'total_amount'=>$total_amout,'weightcalculation'=>$this->Productmodel->getweightcalc($token),'shippingcharge'=>$shipping, 'ordertype'=>$this->session->userdata('order_type')]);
    // print_r($cartitems); exit;
}

public function loadcartitems(){
     $token= $this->session->userdata('guest_token');
     $ordertype = $this->session->userdata('order_type');
    //  print_r($ordertype);
     $cartcount=$this->Cartmodel->getcartcount($token);
     $cartitems = $this->Cartmodel->cartitems($token);
    //  print_r($cartitems);
     $sumofprice= $this->Cartmodel->getsumofprice($token);
     $html = '';
     $total=$sumofprice ?? 0;
 
if (count($cartitems) > 0) {
    foreach ($cartitems as $product) {

        if($ordertype =='exp'){
            $symbol= '$';
        }
        else{
            $symbol= '₹';
        }

        //  $seasonal_percentage = '';
        //                     if ($ordertype == 'rt' && !empty($product['seasonal_percentage'])) 
        //                     {
        //                         $seasonal_percentage = $product['seasonal_percentage'];
        //                         $discount = ($price * $seasonal_percentage) / 100;
        //                         $final_price = $price - $discount;
        //                     }

        
        //     if ($ordertype == 'ws') {
        //     $price = $product['wholesale_price'];
        // } elseif ($ordertype == 'rt') {
        //     $price = $product['retail_price'];
        // } elseif ($ordertype == 'bb') {
        //     $price = $product['franchise_price'];
        // } 
        // else if($ordertype == 'exp'){
        //     $price = $product['export_price'];
        // }
        $product_id = $product['product_id'];
        $products= $this->Cartmodel->getcartitemprice($product_id,$token);
        //  print_r($products); exit;
        $html .= '<li class="border-none">';
        $html .= '<input type="hidden" value="' . $product['product_id'] . '" ></input>';
        $html .= '<a href="#!" class="photo"><img src="' . base_url() . 'uploads/product/' . $product['image'] . '" class="cart-thumb" alt="..."></a>';
        $html .= '<h6><a href="#!">' . htmlspecialchars($product['name']) . '</a></h6>';
        $totals = $product['quantity'] * $products;
$html .= '<p>' . $product['quantity'] . 'x <span class="price">' . $symbol . $products . '</span> = '. $symbol . $totals . '</p>';

// $html .= '<p>' . $product['quantity'] . 'x - <span class="price">₹' . $product['price'] . '</span></p>';

$html .= '</li>';
}

// Append total row only once after all items
$html .= '<li class="total bg-primary" style="background-color: #4a4848 !important;">';
    $html .= '<span class="pull-left"><strong>Total</strong>: ' . $symbol . number_format($total, 2) . '</span>';
    $html .= '<a href="' . base_url() . 'cart" class="butn small btn-cart white"><span>View Cart</span></a>';
    $html .= '</li>';
}

echo json_encode([
'success' => 'success',
'cartcount' => $cartcount,
'html' => $html,
'message'=> 'product added to cart successfully'
]);

}

public function deletecart(){
$deleteitemcart= $this->input->post('deletecart');
// echo $deleteitemcart; exit;
$this->Cartmodel->deletecart($deleteitemcart);
echo json_encode(['success' => 'success']);
}

public function deletewishlist(){
$deleteitemwish= $this->input->post('deletewish');
// echo $deleteitemcart; exit;
$this->Cartmodel->deletewishlist($deleteitemwish);
echo json_encode(['success' => 'success']);
}

public function addwishlist(){
$product_id = $this->input->post('product_id');
$product_weight = $this->input->post('product_weight');
$product_kg = $this->input->post('product_kg');
$quantity = $this->input->post('quantity');
$price= $this->input->post('price');
$product_price= $this->input->post('product_price');
$cookie = $this->session->userdata('guest_token');
$full_weight = $product_weight . $product_kg;
if (strtolower($product_kg) === 'kg') {
$weightInGrams = $product_weight * 1000;
} elseif (strtolower($product_kg) === 'g') {
$weightInGrams = $product_weight;
} else {
$weightInGrams = 0; // fallback if unit invalid
}

// Multiply by quantity
$totalGrams = $weightInGrams * $quantity;

// Format result to kg or g
if ($totalGrams >= 1000) {
$calculatedweight = number_format($totalGrams / 1000, 2) . 'kg';
} else {
$calculatedweight = $totalGrams . 'g';
}

// echo $full_weight;
// echo $product_id;
// echo $price;
$product= $this->Cartmodel->getcartitems($product_id);

if($product){
$product_name = $product[0]['product_name'];
$product_image = $product[0]['image'];
$this->db->where('product_id', $product_id);
$this->db->where('guest_token', $cookie);
$query = $this->db->get('wishlist');
if ($query->num_rows() > 0) {
// ✅ Product exists: update quantity directly
$this->db->where('product_id', $product_id);
$this->db->where('guest_token', $cookie);
$this->db->update('wishlist', [
'price' => $price
]); // set, not add
}

else
{
$data = [
'product_id' => $product_id,
'guest_token' => $cookie,
'name' => $product_name,
'price' => $price,
'image' => $product_image,
'quantity' => $quantity,
'product_price'=>$product_price,
'full_weight' => $calculatedweight,
'default_weight' => $full_weight
];
$this->Cartmodel->addwishlist($data);
$count = $this->Cartmodel->getwishlistcount($cookie);
header('Content-Type: application/json');
echo json_encode(['success' => true ,'message'=>'Product added to wishlist successfully' ,'wishlistcount' => $count]);
}

}


}


public function wishtocart(){
$product_id = $this->input->post('product_id');
// $product_name=$this->input->post('product_name');
// $product_price=$this->input->post('product_price');
// $quantity=$this->input->post('quantity');
// $product_image=$this->input->post('product_image');
// $cookie = $this->session->userdata('guest_token');
$product= $this->Cartmodel->getwishitems($product_id);

if($product){
$cookie = $this->session->userdata('guest_token');
$price = $product[0]['price'];
$product_price = $product[0]['product_price'];
$quantity = $product[0]['quantity'];
$product_name = $product[0]['name'];
$product_image = $product[0]['image'];
$full_weight = $product[0]['full_weight'];
$default_weight = $product[0]['default_weight'];


// Extract weight number and unit using regex
if (preg_match('/([\d.]+)\s*(kg|g)/i',$default_weight, $matches)) {
$weight = (float)$matches[1]; // e.g., 4.25
$unit = strtolower($matches[2]); // 'kg' or 'g'

// Convert to grams
if ($unit === 'kg') {
$weightInGrams = $weight * 1000;
} else {
$weightInGrams = $weight;
}

// Calculate total weight based on quantity
$totalGrams = $weightInGrams * $quantity;

// Format it back to 'g' or 'kg'
if ($totalGrams >= 1000) {
$calculatedWeight = number_format($totalGrams / 1000, 2) . 'kg';
} else {
$calculatedWeight = $totalGrams . 'g';
}

}

// ✅ Now you can use $calculatedWeight
// echo "Total Weight: " . $calculatedWeight;







// $default_weight = $product[0]['default_weight'];
// $product_name = $product[0]['product_name'];
// $product_image = $product[0]['image'];

$this->db->where('product_id', $product_id);
$this->db->where('guest_token', $cookie);
$query = $this->db->get('cart');
if ($query->num_rows() > 0) {
$existing = $query->row();
$new_quantity = $existing->quantity + $quantity;
$updated_price = $existing->price + $price;
if (preg_match('/([\d.]+)\s*(kg|g)/i',$default_weight, $matches)) {
$weight = (float)$matches[1]; // e.g., 4.25
$unit = strtolower($matches[2]); // 'kg' or 'g'

// Convert to grams
if ($unit === 'kg') {
$weightInGrams = $weight * 1000;
} else {
$weightInGrams = $weight;
}

// Calculate total weight based on quantity
$totalGrams = $weightInGrams * $new_quantity;

// Format it back to 'g' or 'kg'
if ($totalGrams >= 1000) {
$calculatedWeights = number_format($totalGrams / 1000, 2) . 'kg';
} else {
$calculatedWeights = $totalGrams . 'g';
}

}
// ✅ Product exists: update quantity directly
$this->db->where('product_id', $product_id);
$this->db->where('guest_token', $cookie);
$this->db->update('cart', [
'price' => $updated_price,
'quantity' => $new_quantity,
'full_weight' => $calculatedWeights

]); // set, not add
}

else
{
$data = [
'product_id' => $product_id,
'user_id' => 0,
'guest_token' => $cookie,
'name' => $product_name,
'quantity' => $quantity,
'price' => $price,
'product_price' => $product_price,
'image' => $product_image,
'full_weight' => $full_weight,
'default_weight' => $default_weight

];
$this->Cartmodel->insert_cart($data);


// print_r($data);
}

echo json_encode(['success' => 'success']);

}

// $wishlist=$this->Cartmodel->getwishlist($token);
// if($product_id==$wishlist[0]['product_id']){
// $weight=$wishlist[0]['full_weight'];
// }




// $data = [
// 'product_id' => $product_id,
// 'user_id' => 0,
// 'guest_token' => $cookie,
// 'name' => $product_name,
// 'product_price' => 0,
// 'price' => $product_price,
// 'image' => $product_image,
// 'quantity' => $quantity,
// 'full_weight' => $weight
// ];

// $this->Cartmodel->wishtocart($data);
// header('Content-Type: application/json');
// echo json_encode(['success' => true,'message'=>'Product added to cart successfully']);
}

public function wishlistcount() {
$cookie = $this->session->userdata('guest_token');
$count = $this->Cartmodel->getwishlistcount($cookie);
header('Content-Type: application/json');
echo json_encode(['success' => 'success', 'wishlistcount' => $count]);
}

public function update_shipping_charge() {
$this->load->helper('cookie');
$token = $this->session->userdata('guest_token');
if (!$token && isset($_COOKIE['guest_token'])) {
$token = $_COOKIE['guest_token'];
}

$shipping_charge = $this->input->post('shipping_charge');
$state = $this->input->post('selected_state');
$weightcalculation=$this->Productmodel->getweightcalc($token);
$sumofprice=$this->Cartmodel->getsumofprice($token);
$customerdetails= $this->db->where('user_token', $token)->get('customers')->row_array();
if($customerdetails['state']!=''){
    $state= $customerdetails['state'];
    $shipping_charge=$customerdetails['shipping_charge'];
}
else{
    $state=$state;
    $shipping_charge=$shipping_charge;
}
if ($token) {
$data = [
'shipping_charge' => $shipping_charge,
'state' => $state
];
$this->db->where('user_token', $token)->update('customers', $data);
$total_amout = $sumofprice;
$coupon_code = $customerdetails['coupon_code'];
if ( !empty($coupon_code)) {
$total_amout -=$coupon_code;
}
if (!empty($shipping_charge)) {
$total_amout += $shipping_charge;
}


echo json_encode([
'success' => 'success',
'message' => $shipping_charge,
'state' => $state,
'weight' => $weightcalculation,
'total_amout' => $total_amout,
// 'coupon_code' => $coupon_code
]);
}



// $stateselect = $this->db->insert('state', $state);
$shipping = $this->db->where('user_token', $token)->get('customers')->row_array();

if ($shipping) {
// ✅ Only update if value has changed
if (!isset($shipping['shipping_charge']) || $shipping['shipping_charge'] != $shipping_charge) {
$this->db->where('user_token', $token);
$this->db->update('customers', ['shipping_charge' => $shipping_charge]);

echo json_encode([
'success' => 'success',
'message' => 'Shipping charge updated to ' . $shipping_charge,
'state' => $state
]);
}

} else {
echo json_encode(['success' => false, 'message' => 'Customer not found']);
}
}


}
?>