<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cartmodel extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }

 public function getcartitems($id){
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('product_id', $id);
    $query = $this->db->get();
    return $query->result_array();
 }


 public function getwishitems($id){
    $this->db->select('*');
    $this->db->from('wishlist');
    $this->db->where('product_id', $id);
    $query = $this->db->get();
    return $query->result_array();
 }



 public function getcartitemprice($id, $token){
    $this->db->select('product_price');
    $this->db->from('cart');
    $this->db->where('guest_token', $token);
    $this->db->where('product_id', $id);
    $query = $this->db->get();
    return $query->row_array()['product_price'];
 }

//   public function getcartitemprice($id){
//     $this->db->select('price');
//     $this->db->from('product');
//     $this->db->where('product_id', $id);
//     $query = $this->db->get();
//     return $query->row_array()['price'];
//  }

 public function insert_cart($data){
    $this->db->insert('cart', $data);
   //  echo $this->db->last_query();
 }

 public function cartitems($token){
    $this->db->select('*');
    $this->db->where('guest_token', $token);
    $this->db->from('cart');
    $query = $this->db->get();
    return $query->result_array();
 }

 public function getcartitemscheckout($token){
    $this->db->select('*');
    $this->db->where('guest_token', $token);
    $this->db->from('cart');
    $query = $this->db->get();
    return $query->row_array();
 }

 public function getcartcount($token){
     $this->db->select_sum('quantity');
    $this->db->where('guest_token', $token);
    $query = $this->db->get('cart');
    return $query->row()->quantity ?? 0;
 }

 public function getsumofprice($token){
     $this->db->select_sum('price');
    $this->db->where('guest_token', $token);
    $query = $this->db->get('cart');
    return $query->row()->price ?? 0;
 }

  public function getsumofpricewishlist($token){
     $this->db->select_sum('price');
    $this->db->where('guest_token', $token);
    $query = $this->db->get('wishlist');
    return $query->row()->price ?? 0;
 }

 public function deletecart($id){
    $this->db->where('product_id', $id);
    $this->db->delete('cart');
    return true;
 }

 public function deletewishlist($id){
    $this->db->where('product_id', $id);
    $this->db->delete('wishlist');
    return true;
 }

 public function cartproducts($guest_token) {
    $this->db->select('product_id, quantity, price');
    $this->db->where('guest_token', $guest_token);
    $query = $this->db->get('cart');
    return $query->result_array(); // Safe, returns full list
}

public function getwishlists($guest_token) {
    $this->db->select('product_id , price');
    $this->db->where('guest_token', $guest_token);
    $this->db->from('wishlist');
    $query = $this->db->get();
    return $query->result_array();
}

public function addwishlist($data) {
    $this->db->insert('wishlist', $data);
    // echo $this->db->last_query();
}

public function getproducts(){
    $this->db->select('*');
    $this->db->from('product');
    $query = $this->db->get();
    return $query->result_array();
}

public function getwishlist($cookie){
    $this->db->select('*');
    $this->db->where('guest_token',$cookie);
    $this->db->from('wishlist');
    $query = $this->db->get();
    return $query->result_array();

}

public function wishtocart($data){
    $this->db->insert('cart', $data);  
    // echo $this->db->last_query();
}

public function getwishlistcount($token) {
   $this->db->where('guest_token', $token);
   $this->db->from('wishlist');
   $count = $this->db->count_all_results();
   // echo $count;
   return $count;
}

 public function getweightcalculation($token){
    $this->db->select_sum('quantity');
    $this->db->where('guest_token', $token);
    $query = $this->db->get('cart');
    $result = $query->row();
   $total_qty = $result->quantity ?? 0;
    $total_qty_with_kg = $total_qty . ' kg';
    return $total_qty_with_kg;
   // return $total_qty;
 }



   public function saveproductitem($token,$cartitems,$total_amount,$orderno)
 {
     
     $this->db->where('guest_token', $token); 
    $this->db->delete('sample_order');
   foreach ($cartitems as $item)
{
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $product_name = $item['name'];
    $price = $item['product_price'];
    $amount = $item['price'];
    $this->db->insert('sample_order',
    [
    'guest_token' => $token,
    'order_no' => $orderno,
    'product_id' => $product_id,
    'product_name'=>$product_name,
    'quantity' => $quantity,
    'price' => $price,
    'amount' => $amount,
    'total_amount' => $total_amount,
    'date' => date('Y-m-d H:i:s'),
    'time' => date('H:i:s')
    ]
    );
}

 }
public function get_shipping_by_state($state)
{
        $this->db->select('shipping_charge');
        $this->db->from('shipping_charges');
        $this->db->where('state', $state);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->shipping_charge;  // ✅ Return only the numeric charge
        } else {
            return 0; // or null, depending on your logic
        }
   }

}
?>