<?php
class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
        $this->load->library('pagination');
    }

    public function index()
	{
        $controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
        $config['base_url'] = site_url('admin/Categories');
        $config['total_rows'] = $this->Productmodel->getcategoryCount($logged_in_store_id);
        // $config['base_url'] = base_url() . $controller .;
        //  print_r($config['base_url']); 
        $config['per_page'] =5 ; // number of rows per page
        $config['uri_segment'] = 4; // which URI segment contains the page numberg
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '<span class="pagination-previous">Previous</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '<span class="pagination-next">Next</span>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="application-navigation__a application-navigation__a--active page-link" href="#">';
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
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; // Get the current 
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
        $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
        $data['Name'] = $store_details->Name;
        // $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
        $data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
        $data['categories']=$this->Productmodel->listcategories();
        $data['order_index']=$this->Productmodel->getNextOrderIndex();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/catalog/categories',$data);
		$this->load->view('admin/includes/footer',$data);

	}

public function addsubcategory($offset = 0) {
    $controller = $this->router->fetch_class();
    $method = $this->router->fetch_method();
    $data['controller'] = $controller;
    $logged_in_store_id = $this->session->userdata('logged_in_store_id');

    $config['base_url'] = site_url('admin/categories/addsubcategory');
    $config['total_rows'] = $this->Productmodel->getsubcategoryCount($logged_in_store_id);
    $config['per_page'] = 5;
    $config['uri_segment'] = 4; // ✅ Fix here

    // Pagination tags...
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['prev_link'] = '<span class="pagination-previous">Previous</span>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['next_link'] = '<span class="pagination-next">Next</span>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="application-navigation__a application-navigation__a--active page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['first_link'] = '<span class="pagination-first">First</span>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '<span class="pagination-last">Last</span>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $data['page'] = $offset;
    $data['per_page'] = $config['per_page'];
    $data['pagination'] = $this->pagination->create_links();

    $role_id = $this->session->userdata('roleid');
    $user_id = $this->session->userdata('loginid');
    $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
    $data['Name'] = $store_details->Name;
    $data['support_no'] = $store_details->UserPhoneNumber;
    $data['support_email'] = $store_details->userEmail;
    $data['categories'] = $this->Productmodel->listcategories();
    $data['subcategories'] = $this->Productmodel->getPaginatedSubcategories($config['per_page'], $offset, $logged_in_store_id);
    $data['order_indexsubcategories'] = $this->Productmodel->getNextOrderIndexsubcategories();

    $this->load->view('admin/includes/header', $data);
    $this->load->view('admin/catalog/subcategories', $data);
    $this->load->view('admin/includes/footer',$data);
}









 
// add category
public function add()
{
    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); 
    // print_r($logged_in_store_id); exit;
    $order_index=$this->Productmodel->getNextOrderIndex();
$this->load->library('form_validation');
$this->form_validation->set_error_delimiters('', '');  
        if (empty($_FILES['userfile']['name'])) 
        {
         $this->form_validation->set_rules('userfile', 'Image', 'required');
           
        }
$this->form_validation->set_rules('category_name', 'name', 'required');
 $this->form_validation->set_rules('category_desc', 'description', 'required');
			
		
			if($this->form_validation->run() == FALSE) 
			{

                $response = [
					'success' => false,
					'errors' => [
						'category_name' => form_error('category_name'),
                        'category_desc' => form_error('category_desc'),
                        'userfile' => form_error('userfile'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
                $this->load->library('upload');
                $this->load->library('image_lib');
                
                $upload_images = [];
                
                if (!empty($_FILES['userfile']['name'])) {
                    $config['upload_path']   = './uploads/categories/';
                   $config['allowed_types'] = 'jpg|jpeg|png|gif|webp'; // ✅ added webp
                    $config['file_name']     = $_FILES['userfile']['name'];
                
                    $this->upload->initialize($config);
                
                    if ($this->upload->do_upload('userfile')) 
                        {
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
                $category_img = isset($upload_images[1]) ? $upload_images[1] : null;
                $category_img = $upload_data['file_name']; // from upload result
                    }
                } else {
                    $upload_images[1] = $this->input->post('imagehidden1'); // fallback if needed
                }
                

                $data = array(
                    'store_id' => $logged_in_store_id, //If admin store id default 0 
                    'category_name' => $this->input->post('category_name'),
                    'category_desc' => $this->input->post('category_desc'),
                    'order_index' =>$order_index,
                    'category_img' => $category_img,
                    'is_header' => $this->input->post('is_header_category_hidden'),
                    'is_footer' => $this->input->post('is_footer_category_hidden'),
                    'is_active' => 1,
                );
            $this->db->where('category_name', $data['category_name']);
            $query = $this->db->get('categories');
        
            if ($query->num_rows() > 0) {
                echo json_encode(['success' => false, 'errors' => 'category exists']);
            } 
            else{
                $this->Productmodel->insert_categories_translation($data);
                echo json_encode(['success' => 'success']);
            }
               // print_r($data);exit;
              
        }
  
}


//edit category
public function edit()
{
        $id=$this->input->post('id'); 
        
        $edit_category=$this->Productmodel->get_categories_by_id($id);   //print_r( $edit_category);exit;

        if (!$edit_category || !is_array($edit_category)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
            'category_id' => $edit_category['id'],
            'store_id' => $edit_category['store_id'], //If admin store id default 0 
            'category_img' => $edit_category['category_img'],
            'category_name' => $edit_category['category_name'],
            'category_desc' => $edit_category['category_desc'],
            'order_index' => $edit_category['order_index'],
            'is_header' => $edit_category['is_header'],
            'is_footer' => $edit_category['is_footer'],
            'is_active' => $edit_category['is_active']
        ];

        // print_r($result); exit;
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
}

//update category
public function updatecategorydetails(){
$id=$this->input->post('hidden_category_id'); 
    // echo $id;exit;
$logged_in_store_id = $this->session->userdata('logged_in_store_id');
$this->load->library('form_validation'); 
$this->form_validation->set_error_delimiters('', '');    
$this->form_validation->set_rules('category_name', 'English', 'required');
$this->form_validation->set_rules('category_desc', 'English', 'required');

if ($this->form_validation->run() == FALSE) 
{
    $response = [
        'success' => false,
        'errors' => [
            'category_name' => form_error('category_name'),
            'category_desc' => form_error('category_desc'),
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
    
    if (!empty($_FILES['userfile']['name'])) {
        $config['upload_path']   = './uploads/categories/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']     = time() . '_1';
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('userfile')) {
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
        $category_img = $this->input->post('existing_userfile'); // ✅ Also a string now
    }
    
    $data = array(
        'category_name' => $this->input->post('category_name'),
        'category_desc' => $this->input->post('category_desc'),
        'order_index' => $this->input->post('category_order'),
        'category_img' => $category_img,
        'is_header' => $this->input->post('is_edit_header_category_hidden'),
        'is_footer' => $this->input->post('is_edit_footer_category_hidden'),
        'is_active' => 1,
    );
    $this->Productmodel->update_categories($id, $data);
 

    echo json_encode(['success' => 'success','data'=>$data]);
}
}

// delete category
public function deletecategory()
{
    $id=$this->input->post('id');
    // echo $id; exit;
    $this->Productmodel->DeleteCategory($id);
    echo json_encode(['success' => 'success']);
}



// add subcategory
public function addsubcategories(){

    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); 
    // print_r($logged_in_store_id); exit;
    $order_indexsubcategory=$this->Productmodel->getNextOrderIndexsubcategories();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
               if (empty($_FILES['subcategory_userfile']['name'])) 
        {
         $this->form_validation->set_rules('subcategory_userfile', 'Image', 'required');
           
        }
            $this->form_validation->set_rules('subcategory_id', 'category', 'required');
            $this->form_validation->set_rules('subcategory_name', 'name', 'required');

		if($this->form_validation->run() == FALSE) 
			{

                $response = [
					'success' => false,
					'errors' => [
					'subcategory_id' => form_error('subcategory_id'),
                    'subcategory_name' => form_error('subcategory_name'),
                     'subcategory_userfile' => form_error('subcategory_userfile'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
			    
			     $this->load->library('upload');
                $this->load->library('image_lib');
                
                $upload_images = [];
                
                if (!empty($_FILES['subcategory_userfile']['name'])) {
                    $config['upload_path']   = './uploads/subcategories/';
                    $config['allowed_types'] = 'jpg|jpeg|png|webp';
                    $config['file_name']     = time() . '_1';
                    $this->upload->initialize($config);
                
                    if ($this->upload->do_upload('subcategory_userfile')) {
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
                $subcategory_img = isset($upload_images[1]) ? $upload_images[1] : null;
                $subcategory_img = $upload_data['file_name']; // from upload result
                    }
                } else {
                    $upload_images[1] = $this->input->post('imagehidden1'); // fallback if needed
                }
                
                $data = array(
                    'category_id' => $this->input->post('subcategory_id'),
                    'name' => $this->input->post('subcategory_name'),
                    'store_id'=> $logged_in_store_id,
                    'order_index' =>$order_indexsubcategory,
                    'is_active' => 1,
                    'image'=> $subcategory_img
                );
                // print_r($data);exit;
                $this->Productmodel->insert_subcategories_translation($data);
                echo json_encode(['success' => 'success']);
        }
}

// edit subcategory
public function editsubcategories()
{
 $id=$this->input->post('id');
 $edit_subcategory=$this->Productmodel->get_subcategories_by_id($id);   //print_r( $edit_subcategory);exit;

 if (!$edit_subcategory || !is_array($edit_subcategory)) 
 {
     echo json_encode([
         'success' => false,
         'message' => 'Invalid subcategory_details data.'
     ]);
     return;
 }
 $result = [
     'category_id' => $edit_subcategory['category_id'],
     'name' => $edit_subcategory['name'], //If admin store id default 0 
     'order_index' => $edit_subcategory['order_index'],
     'is_active' => $edit_subcategory['is_active'],
     'image' => $edit_subcategory['image']
 ];

 // print_r($result); exit;
 echo json_encode([
     'success' => 'success',
     'data' => $result
 ]);

}


// update subcategory

public function updatesubcategories()
{
    $id=$this->input->post('hidden_subcategory_id'); 
    $order_indexsubcategory=$this->Productmodel->getNextOrderIndexsubcategories();
    $logged_in_store_id = $this->session->userdata('logged_in_store_id');
    $this->load->library('form_validation'); 
    $this->form_validation->set_error_delimiters('', '');  
    $this->form_validation->set_rules('subcategory_id', 'category', 'required');
    $this->form_validation->set_rules('subcategory_name', 'Name', 'required');

if ($this->form_validation->run() == FALSE) 
{
    $response = [
        'success' => false,
        'errors' => [
            'subcategory_id' => form_error('subcategory_id'),
            'subcategory_name' => form_error('subcategory_name'),
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
    
    if (!empty($_FILES['subcategory_userfile']['name'])) {
        $config['upload_path']   = './uploads/subcategories/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time() . '_1';
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('subcategory_userfile')) {
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
          $subcategory_img = $upload_data['file_name']; // ✅ Correct string
        }
    } else {
        $subcategory_img = $this->input->post('existing_subcategory_userfile'); // ✅ Also a string now
    }

    $data = array(
        'category_id' => $this->input->post('subcategory_id'),
        'name' => $this->input->post('subcategory_name'),
        'order_index' =>$this->input->post('subcategory_order'),
        'is_active' => 1,
        'image'=> $subcategory_img
    );
    $this->Productmodel->update_subcategories($id, $data);
    // print_r($data); exit;
    echo json_encode(['success' => 'success','data'=>$data]);
}

}


public function DeleteSubCategory()
{
    $id=$this->input->post('id');
    // echo $id; exit; 
    $this->Productmodel->delete_subcategory($id);
    echo json_encode(['success' => 'success']);
}

//update category order index
public function update_category_order_index()
{
    $id = $this->input->post('id');
    $order_index = $this->input->post('order_index');
    $this->Productmodel->update_category_order_index($id,$order_index);
}

// update subcategory order index
public function update_subcategory_order_index()
{
    $id = $this->input->post('id');
    $order_index = $this->input->post('order_index');
    $this->Productmodel->update_subcategory_order_index($id,$order_index);
}




}
?>