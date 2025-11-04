<?php
class Testimonial extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
    }
    public function index()
	{
        $controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
        $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
        $data['Name'] = $store_details->Name;
        // $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
        $data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
        $data['testimonial']=$this->Productmodel->listtestimonial();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/catalog/testimonial',$data);
		$this->load->view('admin/includes/footer',$data);

	} 

    public function add() {
        $logged_in_store_id = $this->session->userdata('logged_in_store_id'); 
        // print_r($logged_in_store_id); exit;
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');  
         if (empty($_FILES['testimonial_image']['name'])) {
                    $this->form_validation->set_rules('testimonial_image', 'Image', 'required');
                }
                $this->form_validation->set_rules('testimonial_name', 'Name', 'required');
                $this->form_validation->set_rules('testimonial_desc', 'Description', 'required');
                $this->form_validation->set_rules('testimonial_position', 'Position', 'required');
                
            
                if($this->form_validation->run() == FALSE) 
                {
    
                    $response = [
                        'success' => false,
                        'errors' => [
                            'testimonial_name' => form_error('testimonial_name'),
                            'testimonial_position' => form_error('testimonial_position'),
                            'testimonial_image' => form_error('testimonial_image'),
                            'testimonial_desc' => form_error('testimonial_desc'),
                        ]
                    ];
                
                    echo json_encode($response);
                }
                else
                {
                    $this->load->library('upload');
                    $this->load->library('image_lib');
                    
                    $upload_images = [];
                    
                    if (!empty($_FILES['testimonial_image']['name'])) {
                        $config['upload_path']   = './uploads/testimonial/';
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['file_name']     = time() . '_1';
                    
                        $this->upload->initialize($config);
                    
                        if ($this->upload->do_upload('testimonial_image')) {
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
                       
                        'name' => $this->input->post('testimonial_name'),
                        'description' => $this->input->post('testimonial_desc'),
                        'position' =>$this->input->post('testimonial_position'),
                        'image' => $category_img,
                    );
                
                //    print_r($data);exit;
                   $this->Productmodel->insert_testimonial_translation($data);
                   echo json_encode(['success' => 'success']);
                  
            }
      
    }

    public function edit()
    {
            $id=$this->input->post('id'); 
            
            $edit_testimonial=$this->Productmodel->get_testimonial_by_id($id);   //print_r( $edit_testimonial);exit;
    
            if (!$edit_testimonial || !is_array($edit_testimonial)) 
            {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid testimonial_details data.'
                ]);
                return;
            }
            $result = [
                'name' => $edit_testimonial['name'],
                'description' => $edit_testimonial['description'], //If admin store id default 0 
                'position' => $edit_testimonial['position'],
                'image' => $edit_testimonial['image']
            ];
    
            // print_r($result); exit;
            echo json_encode([
                'success' => 'success',
                'data' => $result
            ]);
    } 

    public function updatetestimonial(){
        $id=$this->input->post('hidden_testimonial_id'); 
        // echo $id;exit;
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');  
                $this->form_validation->set_rules('testimonial_name', 'Name', 'required');
                $this->form_validation->set_rules('testimonial_desc', 'Description', 'required');
                $this->form_validation->set_rules('testimonial_position', 'Position', 'required');
                
    
    if ($this->form_validation->run() == FALSE) 
    {
        $response = [
            'success' => false,
            'errors' => [
                'testimonial_name' => form_error('testimonial_name'),
                'testimonial_position' => form_error('testimonial_position'),
                // 'testimonial_image' => form_error('testimonial_image'),
                'testimonial_desc' => form_error('testimonial_desc'),
            ]
        ];
        echo json_encode($response);
    }
    else
    {
        $this->load->library('upload');
        $this->load->library('image_lib');
        
        $upload_images = [];
        
        if (!empty($_FILES['testimonial_image']['name'])) {
            $config['upload_path']   = './uploads/testimonial/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name']     = time() . '_1';
        
            $this->upload->initialize($config);
        
            if ($this->upload->do_upload('testimonial_image')) {
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
            $category_img = $this->input->post('testimonial_image_existing'); // ✅ Also a string now
        }
        
        $data = array(
                       
            'name' => $this->input->post('testimonial_name'),
            'description' => $this->input->post('testimonial_desc'),
            'position' =>$this->input->post('testimonial_position'),
            'image' => $category_img,
        );
        $this->Productmodel->update_testimonial($id, $data);
     
    
        echo json_encode(['success' => 'success','data'=>$data]);
    }
    }

   public function Delete(){
    $id=$this->input->post('id');
    // echo $id; exit; 
    $this->Productmodel->delete_testimonial($id);
    echo json_encode(['success' => 'success']);
   } 
    
}
    ?>
