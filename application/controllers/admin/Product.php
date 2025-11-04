<?php
class Product extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->model('admin/Productmodel');
        $this->load->model('admin/Commonmodel');
        $this->load->library('pagination');
        $this->load->model('Homemodel');
    }

    public function index()
	{
       
        $controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
        $logged_in_store_id=$this->session->userdata('logged_in_store_id');
        $config['base_url'] = site_url('admin/product/index/');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; // CORRECT ✅
        $config['total_rows'] = $this->Productmodel->getStoreProductsCountbyadmin($logged_in_store_id);
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
        // Get the current page number
        //$data['products'] = $this->Productmodel->shopAssignedProductsbyPagination($config['per_page'], $page);
        $all_products = $this->Productmodel->getPaginatedProducts($config['per_page'], $page, $logged_in_store_id); //print_r($all_products);
        $data['products'] = $all_products;
        // print_r($data['products']); exit;
        $data['pagination'] = $this->pagination->create_links();
        // print_r($data['pagination']);exit;
        $date =date('Y-m-d');
        $data['date'] =$date;
        $role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
        $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
        $data['categories']=$this->Productmodel->listcategories();
        $data['subcategories']=$this->Productmodel->listsubcategories();
        $data['Name'] = $store_details->Name;
        // $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
        $data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
		$this->load->view('admin/includes/header',$data);
        $this->load->view('admin/includes/owner-dashboard',$data);
		$this->load->view('admin/catalog/products',$data);
		$this->load->view('admin/includes/footer');
	}

// add product page
    public function addproduct(){
        $controller = $this->router->fetch_class(); // Gets the current controller name
        $method = $this->router->fetch_method();   // Gets the current method name
        $data['controller'] = $controller;
        $data['categories']=$this->Productmodel->listcategories();
        $data['subcategories']=$this->Productmodel->listsubcategories();
        $logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
        $role_id = $this->session->userdata('roleid'); // Role id of logged in user
        $user_id = $this->session->userdata('loginid'); // Loged in user id
         $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
        //  $data['categories']=$this->Productmodel->listcategories();
        //   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
        // print_r($data['Name']);exit;
        // $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;
        // $data['profileimg'] = $store_details->profileimg;
    
        $this->load->view('admin/includes/header',$data);
        $this->load->view('admin/includes/owner-dashboard',$data);
        $this->load->view('admin/catalog/add-product',$data);
        $this->load->view('admin/includes/footer');
    }

// add product when the button clicked in add product page
    public function add() {  
        $logged_in_store_id=$this->session->userdata('logged_in_store_id');
        $user_id = $this->session->userdata('loginid'); // Loged in user id
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('category_id', 'Category', 'required');    
        $this->form_validation->set_rules('product_name', 'Name', 'required'); 
        // $this->form_validation->set_rules('product_description', 'description', 'required');
        // $this->form_validation->set_rules('product_code', 'Product Code', 'required');
        // $this->form_validation->set_rules('erp_product_name', 'Erp Name', 'required');  
        // $this->form_validation->set_rules('product_price', 'price', 'required'); 
        if(empty($_FILES['image1']['name'])) {
        $this->form_validation->set_rules('image1', 'Thumbnail Image', 'required');
        }  
        //  $this->form_validation->set_rules('product_wholesale_price', 'Wholesale Price', 'required');   
        // $this->form_validation->set_rules('product_retail_price', 'Retail Price', 'required');
        // $this->form_validation->set_rules('product_franchise_price', 'Franchise Price', 'required');
        // $this->form_validation->set_rules('product_description', 'description', 'required');
        // $this->form_validation->set_rules('product_weight', 'weight', 'required');
        // $this->form_validation->set_rules('product_weight_type', 'weight type', 'required');
        // $this->form_validation->set_rules('product_export_price', 'Export price', 'required');
        // $this->form_validation->set_rules('select_product', 'select product', 'required');

        // $this->form_validation->set_rules('seasonal_percentage', 'percentage', 'required');

        // if (empty($_FILES['image1']['name'])) {
        //     $this->form_validation->set_rules('image1', 'Image 1', 'required');
        // }
        // if (empty($_FILES['image2']['name'])) {
        //     $this->form_validation->set_rules('image2', 'Image 2', 'required');
        // }
        // if (empty($_FILES['image3']['name'])) {
        //     $this->form_validation->set_rules('image3', 'Image 3', 'required');
        // }
        // if (empty($_FILES['image4']['name'])) {
        //     $this->form_validation->set_rules('image4', 'Image 4', 'required');
        // }  
        



        
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, send errors back to the view
            $response = [
                'success' => false,
                'errors' => [
                    'category_id' => form_error('category_id'),
                    'product_name' => form_error('product_name'),
                    
                    // 'product_price' => form_error('product_price'),
                    // 'erp_product_name' => form_error('erp_product_name'),
                    // 'product_code' => form_error('product_code'),
                    // 'product_wholesale_price' => form_error('product_wholesale_price'),
                    // 'product_retail_price' => form_error('product_retail_price'),
                    // 'product_franchise_price' => form_error('product_franchise_price'),
                    // 'product_description' => form_error('product_description'),
                    // 'product_weight' => form_error('product_weight'),
                    // 'product_weight_type' => form_error('product_weight_type'),
                    // 'product_export_price' => form_error('product_export_price'),
                    // 'select_product' => form_error('select_product'),
                    // 'seasonal_percentage' => form_error('seasonal_percentage'),
                    'image1' => form_error('image1'),
                    // 'image2' => form_error('image2'),
                    // 'image3' => form_error('image3'),
                    // 'image4' => form_error('image4'),
                  
                ]
            ];
            echo json_encode($response);
        } else {


            $this->load->library('upload');
            $this->load->library('image_lib');
            
            $uploaded_images = [];
            
            for ($i = 1; $i <= 4; $i++) {
                $input_name = 'image' . $i;
            
                if (!empty($_FILES[$input_name]['name'])) {
                    $_FILES['image']['name']     = $_FILES[$input_name]['name'];
                    $_FILES['image']['type']     = $_FILES[$input_name]['type'];
                    $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'];
                    $_FILES['image']['error']    = $_FILES[$input_name]['error'];
                    $_FILES['image']['size']     = $_FILES[$input_name]['size'];
                    $config['upload_path']   = './uploads/product/';
                    $config['allowed_types'] = 'jpg|jpeg|png|webp';
                    $config['file_name']     = $_FILES[$input_name]['name'];

                    // print_r($config);exit;
            
                    $this->upload->initialize($config);
            
                    if ($this->upload->do_upload('image')) {
                        $upload_data = $this->upload->data();
            
                        // Resize
                        $resize['image_library']  = 'gd2';
                        $resize['source_image']   = $upload_data['full_path'];
                        $resize['maintain_ratio'] = TRUE;
                        $resize['width']          = 500;
                        $resize['height']         = 500;
            
                        $this->image_lib->initialize($resize);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
            
                        // Save image URL
                        $uploaded_images[] = 'uploads/product/' . $upload_data['file_name'];
                        $upload_images[] = $upload_data['file_name'];



                    }
                }
            }

            // print_r($upload_images); exit;
            $data = array(
                'category_id' => $this->input->post('category_id'),
               'subcategory_id' => !empty($this->input->post('subcategory_id')) ? $this->input->post('subcategory_id'):0,
                'product_name'=> $this->input->post('product_name'),
                'height' => $this->input->post('product_height') ?? null,
                'width' => $this->input->post('product_width') ?? null,
                'store_id' =>$logged_in_store_id, //If admin store id default 0 
                'price' => $this->input->post('product_price') ?? null,
                'image' => isset($upload_images[0]) ? $upload_images[0] : null,
                'image1' => isset($upload_images[1]) ? $upload_images[1] : null,
                'image2' => isset($upload_images[2]) ? $upload_images[2] : null,
                'image3' => isset($upload_images[3]) ? $upload_images[3] : null,
                'wholesale_price' => $this->input->post('product_wholesale_price') ?? null,
                'retail_price' => $this->input->post('product_retail_price')?? null,
                'franchise_price' => $this->input->post('product_franchise_price')?? null,
                'export_price' => $this->input->post('product_export_price') ?? null,
                'description' => $this->input->post('product_description')?? null,
                'weight' => $this->input->post('product_weight')?? null,
                'kg_g' => $this->input->post('product_weight_type')?? null,
                'is_home'=>$this->input->post('is_home_add_hidden') ?? null,
                'is_bestseller'=>$this->input->post('is_bestseller_add_hidden') ?? null,
                'is_seasonaloffer'=>$this->input->post('is_seasonaloffer_add_hidden') ?? null,
                'out_of_stock'=>$this->input->post('out_of_stock_hidden') ?? null,
                'seasonal_percentage' => $this->input->post('seasonal_percentage') ?? null,
                'erp_product_name' => $this->input->post('erp_product_name')?? null,
                'item_code'=>$this->input->post('product_code')?? null,
                'shipping'=>0,
                'ctns'=> 0,
                'pcs'=>0,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' =>$user_id,
                // 'updated_date' => date('Y-m-d H:i:s'),
                // 'updated_by' => $user_id,
                
                // 'stock' => $this->input->post('product_stock')?? null,  
                'is_active' => 1
            );
            $this->Productmodel->insert_product_translation($data);
            $user_id = $this->session->userdata('loginid'); // Loged in user id = $this->session->userdata('loginid'); // Loged in user id
            $stock = $this->input->post('product_stock');
            $product_id = $this->db->insert_id();
            $storestock=  $this->Productmodel->insert_product_stock($stock,$product_id,$user_id);
            
            // print_r($storestock);exit;
            echo json_encode(['success' => 'success']);
        }
    }

    // edit product
public function edit(){
$id= $this->input->post('id');
// echo $id;exit;

// print_r($data['categories']);exit;
$edit_product=$this->Productmodel->get_product_by_id($id);  // print_r( $edit_product);exit;

$stock  = $this->Homemodel->getCurrentStock($id);

if (!$edit_product || !is_array($edit_product)) 
{
    echo json_encode([
        'success' => false,
        'message' => 'Invalid enquiry_details data.'
    ]);
    return;
}

$result = [
    'product_id' => $edit_product['product_id'],
    'category_id' => $edit_product['category_id'], //If admin store id default 0 
    'subcategory_id' => $edit_product['subcategory_id'],
    'product_name' => $edit_product['product_name'],
    'height' => $edit_product['height'],
    'width' => $edit_product['width'],
    'wholesale_price' => $edit_product['wholesale_price'],
    'retail_price' => $edit_product['retail_price'],
    'franchise_price' => $edit_product['franchise_price'],
    'price' => $edit_product['price'],
    'description' => $edit_product['description'],
    'weight' => $edit_product['weight'],
    'kg_g' => $edit_product['kg_g'],
    'image' => $edit_product['image'],
    'image1' => $edit_product['image1'],
    'image2' => $edit_product['image2'],
    'image3' => $edit_product['image3'],
    'is_home' => $edit_product['is_home'],
    'is_bestseller' => $edit_product['is_bestseller'],
    'is_seasonaloffer' => $edit_product['is_seasonaloffer'],
    'out_of_stock' => $edit_product['out_of_stock'],
    'seasonal_percentage' => $edit_product['seasonal_percentage'],
    'export_price' => $edit_product['export_price'],
    'erp_product_name' => $edit_product['erp_product_name'],
    'item_code' =>$edit_product['item_code'],
    'shipping' =>$edit_product['shipping'],
    'stock' => $stock,
];

// print_r($result); exit;
echo json_encode([
    'success' => 'success',
    'data' => $result
]);

   }

// delete product

    public function DeleteProduct(){
         $id=$this->input->post('id');
    $this->db->where('product_id', $id);
    $this->db->where('is_despatch', 0);
    $exists = $this->db->count_all_results('order_items');
            if ($exists > 0) {
        // Product is linked to one or more orders — cannot delete
        echo json_encode([
            'success' => 'success',
            'message' => 'This product cannot be deleted because it is linked to orders.'
        ]);
        return;
    }
    else
    {
        $this->Productmodel->delete_product($id);
        echo json_encode(['success' => 'success', 'message' => 'Product deleted successfully.']);
    }
	}


    public function searchProductOnKeyUp() {
    $search = $this->input->get('search');
    $searchproducts = $this->Productmodel->shopAssignedProductsByadminKeyUpSearch($search);
    $html = '';
    if (!empty($searchproducts)) {
        $html .= '<table class="table table-striped">';
        $html .= '<thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price (₹)</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';

        $count = 1;

        foreach ($searchproducts as $product) {
            $path = !empty($product->image)
                ? site_url("uploads/product/" . $product->image)
                : site_url("assets/images/no-image.png");

            $stock = $this->Homemodel->getCurrentStock($product->product_id);

            $html .= '<tr>';
            $html .= '<td>' . $count++ . '</td>';
            $html .= '<td><img class="product-list__item-img" src="' . $path . '" alt="' . $product->product_name . '" width="100" height="80"></td>';
            $html .= '<td>' . htmlspecialchars($product->product_name) . '</td>';
            $html .= '<td>₹ ' . number_format($product->retail_price, 2) . '</td>';

            if ($stock > 0) {
                $html .= '<td>' . $stock . '</td>';
            } else {
                $html .= '<td><span class="badge bg-danger">Out of Stock</span></td>';
            } 
            
            

            $html .= '<td>
                <a href="#" class="tblEditBtn edit_product"
                    data-bs-toggle="modal"
                    data-id="' . $product->product_id . '"
                    data-bs-target="#Edit-Product">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="tblDelBtn remove_product"
                    data-bs-toggle="modal"
                    data-bs-target="#delete-product"
                    data-id="' . $product->product_id . '">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>';

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

    } else {
        $html .= '<div class="no-products-found"><p>No products found.</p></div>';
    }

    echo $html;
}

    
  // product search window
//     public function searchProductOnKeyUp(){
//         $search = $this->input->get('search');
//         $searchproducts=$this->Productmodel->shopAssignedProductsByadminKeyUpSearch($search);
//     //  print_r($searchproducts); exit;
//         $html = '';
//         if (!empty($searchproducts)) {
//             $store_id = $this->session->userdata('logged_in_store_id');
//             $date = date('Y-m-d');
//             foreach ($searchproducts as $product) {
//                 $path = ($product->image != '') ? site_url() . "uploads/product/" . $product->image : site_url() . "uploads/product/" . $product->image;

// $html  = '<table class="table table-striped">';
// $html .= '<thead>
//             <tr>
//                 <th>#</th>
//                 <th>Image</th>
//                 <th>Product Name</th>
//                 <th>Price (₹)</th>
//                 <th>Stock</th>
//                 <th>Actions</th>
//             </tr>
//           </thead>';
// $html .= '<tbody>';

// $count = 1;

//     $stock = $this->Homemodel->getCurrentStock($product->product_id);

//     $html .= '<tr>';
//     $html .= '<td>' . $count++ . '</td>';
//     $html .= '<td><img class="product-list__item-img" src="' . $path . '" alt="' . $product->product_name . '" width="100" height="80"></td>';
//     $html .= '<td>' . $product->product_name . '</td>';
//     $html .= '<td>₹ ' . $product->retail_price . '</td>';

//     if ($stock > 0) {
//         $html .= '<td>' . $stock . '</td>';
//     } else {
//         $html .= '<td><span class="badge bg-danger">Out of Stock</span></td>';
//     }

//     $html .= '<td>
//         <a href="" class=" tblEditBtn edit_product"
//             data-bs-toggle="modal"
//             data-id="' . $product->product_id . '"
//             data-bs-target="#Edit-Product">
//           <i class="fa fa-edit"></i></a> 
//         </a>
//         <a href="" class="tblDelBtn remove_product"
//             data-bs-toggle="modal"
//             data-bs-target="#delete-product"
//             data-id="' . $product->product_id . '">
//           <i class="fa-solid fa-trash"></i>
//         </a>
//     </td>';

//     $html .= '</tr>';


// $html .= '</tbody></table>';

//             }
//         } else {
//             $html .= '<div class="no-products-found"><p>No products found.</p></div>';
//         }
//         echo $html; 
//         }


// update product

public function updateproductdetails(){
        $id=$this->input->post('hidden_product_id'); //echo $id;die();
        $data['productDet']=$this->Productmodel->get_product_by_id($id);
          $user_id = $this->session->userdata('loginid');
        //print_r($data['categoryDet']);exit;
        $this->load->library('form_validation'); 
        $this->form_validation->set_error_delimiters('', ''); 
        $this->form_validation->set_rules('category_id', 'Category', 'required');   
        $this->form_validation->set_rules('product_name', 'Name', 'required');   
        //  $this->form_validation->set_rules('price', 'price', 'required');  
        // $this->form_validation->set_rules('product_description', 'description', 'required'); 
        // $this->form_validation->set_rules('product_weight', 'weight', 'required');  
        // $this->form_validation->set_rules('product_export_price', 'Export price', 'required');
        if ($this->form_validation->run() == FALSE) 
        {
            $response = [
                'success' => false,
                'errors' => [
                    'category_id' => form_error('category_id'),
                    'product_name' => form_error('product_name'),
                    // 'product_description' => form_error('product_description'),
                    // 'product_weight' => form_error('product_weight'),
                    // 'product_export_price' => form_error('product_export_price'),
                    // 'price' => form_error('price'),
                  
                ]
            ];
            echo json_encode($response);
        }
        else
        {
            
            $this->load->library('upload');
            $this->load->library('image_lib');
            
            $uploaded_images = [];
            
            for ($i = 0; $i < 4; $i++) {
    $input_name = ($i == 0) ? 'image' : 'image' . $i;

    // Skip if file input is empty
    if (!isset($_FILES[$input_name]) || empty($_FILES[$input_name]['name'])) {
        // No new image — keep old one
        $upload_images[$i] = $this->input->post('image_id' . ($i == 0 ? '' : $i));
        continue;
    }

    // Prepare $_FILES['image'] dynamically
    $_FILES['image']['name']     = $_FILES[$input_name]['name'];
    $_FILES['image']['type']     = $_FILES[$input_name]['type'];
    $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'];
    $_FILES['image']['error']    = $_FILES[$input_name]['error'];
    $_FILES['image']['size']     = $_FILES[$input_name]['size'];

    $config['upload_path']   = './uploads/product/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['file_name']     = $_FILES[$input_name]['name'];
    $config['overwrite']     = TRUE;

    $this->upload->initialize($config);

    if ($this->upload->do_upload('image')) {
        $upload_data = $this->upload->data();

        // Unlink old image if exists
        $old_image = $this->input->post('image_id' . ($i == 0 ? '' : $i));
        if (!empty($old_image)) {
            $old_image_path = './uploads/product/' . $old_image;
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        // Resize
        $resize['image_library']  = 'gd2';
        $resize['source_image']   = $upload_data['full_path'];
        $resize['maintain_ratio'] = TRUE;
        $resize['width']          = 500;
        $resize['height']         = 500;

        $this->image_lib->initialize($resize);
        $this->image_lib->resize();
        $this->image_lib->clear();

        $uploaded_images[] = 'uploads/product/' . $upload_data['file_name'];
        $upload_images[$i] = $upload_data['file_name'];
    } else {
        // If upload fails, fall back to old image
        $upload_images[$i] = $this->input->post('image_id' . ($i == 0 ? '' : $i));
    }
}
            

            // print_r($upload_images);exit;


            $data = array(
                'category_id' => $this->input->post('category_id'),
              'subcategory_id' => !empty($this->input->post('subcategory_id')) ? $this->input->post('subcategory_id'):0,
                'product_name'=> $this->input->post('product_name'),
                'height' => $this->input->post('product_height'),
                'width' => $this->input->post('product_width'),
                'price' => $this->input->post('price'),
                'image' => isset($upload_images[0]) ? $upload_images[0] : null,
                'image1' => isset($upload_images[1]) ? $upload_images[1] : null,
                'image2' => isset($upload_images[2]) ? $upload_images[2] : null,
                'image3' => isset($upload_images[3]) ? $upload_images[3] : null,
                'wholesale_price' => $this->input->post('product_wholesale_price'),
                'retail_price' => $this->input->post('product_retail_price'),
                'franchise_price' => $this->input->post('product_franchise_price'),
                'export_price' => $this->input->post('product_export_price')??0,
                'description' => $this->input->post('product_description'),
                'weight' => $this->input->post('product_weight'),
                'kg_g' => $this->input->post('product_weight_type'),
                'is_home'=>$this->input->post('is_home_edit_hidden'),
                'is_bestseller'=>$this->input->post('is_bestseller_edit_hidden'),
                'is_seasonaloffer'=>$this->input->post('is_seasonaloffer_edit_hidden'),
                'out_of_stock'=>$this->input->post('out_of_stock_edit_hidden'),
                'seasonal_percentage'=>$this->input->post('seasonal_percentage'),
                'erp_product_name' => $this->input->post('erp_product_name'),
                'item_code' => $this->input->post('product_codee'),
                'shipping' => $this->input->post('product_shippingg'), 
                // 'stock' => $this->input->post('product_stock')?? null,
                'is_active' => 1,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id,
            );
            
            //   print_r($data);exit;
             $this->Productmodel->update_product($id,$data);
             
            
             $user_id = $this->session->userdata('loginid'); // Loged in user id
             $stock = $this->input->post('update_product_stock');
             $updatedstock = $this->Productmodel->insert_product_stock($stock,$id,$user_id);

            //  print_r($updatedstock);exit;
             
             echo json_encode(['success' => 'success', 'data' => $data]);
                
        }
}
// get subcategories in dropdown change
public function get_subcategories(){
    $category_id = $this->input->post('id');
    // echo $category_id; exit;
    $subcategories = $this->Productmodel->get_subcategory($category_id);
    echo json_encode(['success' => 'success', 'data' => $subcategories]);
}


// export page








}
?>