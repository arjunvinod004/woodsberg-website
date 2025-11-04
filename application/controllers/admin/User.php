<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
        $this->load->model('admin/Usermodel');
    }

    public function index() {
        $controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
        $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
        $data['Name'] = $store_details->Name;
        $data['support_no'] = $store_details->UserPhoneNumber;
        $data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
        $data['users']=$this->Usermodel->listusers();
    //  print_r($data['users']);exit;
        $data['order_index']=$this->Productmodel->getNextOrderIndex();
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/user/users',$data);
		$this->load->view('admin/includes/footer',$data);
    }

    public function add(){
            $logged_in_store_id = $this->session->userdata('logged_in_store_id'); 
            // print_r($logged_in_store_id); exit;
            // $order_index=$this->Productmodel->getNextOrderIndex();
                    $this->load->library('form_validation'); 
                    $this->form_validation->set_error_delimiters('', ''); 
                    $this->form_validation->set_rules('user_name', 'name', 'required');
                    $this->form_validation->set_rules('user_email', 'email', 'required|valid_email');
                    $this->form_validation->set_rules('user_phoneno', 'phoneno', 'required|regex_match[/^\d{10}$/]');
                    $this->form_validation->set_rules('user_password', 'password', 'required');
                    $this->form_validation->set_rules('user_role', 'role', 'required');
                    $this->form_validation->set_rules('user_username', 'username', 'required');
                
                    if($this->form_validation->run() == FALSE) 
                    {
                        $response = [
                            'success' => false,
                            'errors' => [
                                'user_name' => form_error('user_name'), 
                                'user_email' => form_error('user_email'),
                                'user_phoneno' => form_error('user_phoneno'),
                                'user_password' => form_error('user_password'),
                                'user_role' => form_error('user_role'),
                                'user_username' => form_error('user_username'),
                            ]
                        ];
                        echo json_encode($response);
                    }
                    else
                    {
                       
                        $data = array(
                            'store_id' => $logged_in_store_id, 
                            'Name' => $this->input->post('user_name'),
                            'userEmail' => $this->input->post('user_email'),
                            'UserPhoneNumber' => $this->input->post('user_phoneno'),
                            'userPassword' => md5(trim($this->input->post('user_password'))), // $this->input->post('user_password'),
                            'userroleid' => $this->input->post('user_role'),
                            'userName' => $this->input->post('user_username'),
                            'is_active' => 1,
                        );
                        // print_r($data);exit;
                        $this->Usermodel->insert($data);
                        // print_r($data);exit;
                        echo json_encode(['success' => 'success', 'data' => $data]);
                    }
                }

      public function edit() {
                        $id=$this->input->post('id'); 
                        
                        $edit_user=$this->Usermodel->get_user_details($id);     // print_r($edit_user);exit;
                
                        if (!$edit_user || !is_array($edit_user)) 
                        {
                            echo json_encode([
                                'success' => false,
                                'message' => 'Invalid user_details data.'
                            ]);
                            return;
                        }
                        $result = [
                            'Name' => $edit_user['Name'],
                            'userName' => $edit_user['userName'], //If admin store id default 0 
                            'UserPhoneNumber' => $edit_user['UserPhoneNumber'],
                            'userPassword' => $edit_user['userPassword'],
                            'userEmail' => $edit_user['userEmail'],
                            'userroleid' => $edit_user['userroleid']
                        ];
                
                        // print_r($result); exit;
                        echo json_encode([
                            'success' => 'success',
                            'data' => $result
                        ]);
                }


         public function update(){

                $id=$this->input->post('hidden_user_id'); 
                // echo $id; exit;
                    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); 
                    // print_r($logged_in_store_id); exit;
                    // $order_index=$this->Productmodel->getNextOrderIndex();
                            $this->load->library('form_validation'); 
                            $this->form_validation->set_error_delimiters('', ''); 
                            $this->form_validation->set_rules('user_name', 'name', 'required');
                            $this->form_validation->set_rules('user_email', 'email', 'required|valid_email');
                            $this->form_validation->set_rules('user_phoneno', 'phoneno', 'required|regex_match[/^\d{10}$/]');
                            // $this->form_validation->set_rules('user_password', 'password', 'required');
                            $this->form_validation->set_rules('user_role', 'role', 'required');
                            $this->form_validation->set_rules('user_username', 'username', 'required');
                        
                            if($this->form_validation->run() == FALSE) 
                            {
                                $response = [
                                    'success' => false,
                                    'errors' => [
                                        'user_name' => form_error('user_name'),
                                        'user_email' => form_error('user_email'),
                                        'user_phoneno' => form_error('user_phoneno'),
                                        //'user_password' => form_error('user_password'),
                                        'user_role' => form_error('user_role'),
                                        'user_username' => form_error('user_username'),
                                    ]
                                ];
                                echo json_encode($response);
                            }
                            else
                            {
                               
                                $data = array(
                                    'store_id' => $logged_in_store_id, 
                                    'Name' => $this->input->post('user_name'),
                                    'userEmail' => $this->input->post('user_email'),
                                    'UserPhoneNumber' => $this->input->post('user_phoneno'),
                                    // 'userPassword' => md5(trim($this->input->post('user_password'))), // $this->input->post('user_password'),
                                    'userroleid' => $this->input->post('user_role'),
                                    'userName' => $this->input->post('user_username'),
                                    'is_active' => 1,
                                );
                                //  print_r($data);exit;
                                $this->Usermodel->update($id,$data);
                                // print_r($data);exit;
                                echo json_encode(['success' => 'success', 'data' => $data]);
                            }
                        }  
                        
    public function delete() {
        $id=$this->input->post('id'); 
        //  echo $id; exit;
        $this->Usermodel->delete($id);
        echo json_encode(['success' => 'success']);
          
        
    }
}


?>