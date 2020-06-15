<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->helper('url', 'form');
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->model('transaction_model');
		$this->load->library('sendmail');
	}


	public function index(){
		$data = array(
			'title' 		=> 'Login',
		);

		if($this->session->userdata("user_logged_in")){
			redirect('user/view', 'refresh');
		}else{
			$this->load->view('page-user-login', $data);

		}
	}

	public function login(){
		if(isset($_POST['user_login'])){
			$email 		= $this->input->post('email_address', true);
			$password 	= $this->input->post('password', true);
			$res 		= $this->user_model->login($email, $password);
			if(!empty($res)){
				$sess_data = array(
						'user_email' 		=> $res['email'], 
						'user_id' 			=> $res['id'], 
						'user_fullname' 	=> $res['name'],
						'user_role' 		=> $res['role'],
						'user_logged_in'	=> 1
				);
				$this->session->set_userdata($sess_data);
				redirect('user/view', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('user', 'refresh');
			}
		}
	}

	public function dashboard(){

		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'User Dashbaord',
			'main_content'	=> 'page-user-dashboard',
			'role'	=> $user_role
		);
		$this->load->view('includes/template', $data);
	}

	public function add(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'Add',
			'main_content'	=> 'add',
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
	}
	public function store(){
		$post 			= $this->input->post();

		$image_data 	= array();
		$document_data 	= array();

		$this->load->library('upload');

		if (!empty($_FILES['image']['name'])) 
		{
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = 2000;
			$config['max_width'] = 1500;
			$config['max_height'] = 1500;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$image_data[] = $this->upload->data();
			}
		}

		if(!empty($_FILES['excel_file']['name'])) 
		{
			$excel_config['upload_path'] = './images/';
			$excel_config['allowed_types'] = 'xls|csv|xlsx';
			$excel_config['max_size'] = 2000;

			$this->upload->initialize($excel_config);

			if (!$this->upload->do_upload('excel_file')) 
			{
				$error = array('error' => $this->upload->display_errors());
			} 
			else 
			{
				$document_data[] = $this->upload->data();
			}	
		}

		$post['image'] = isset($image_data[0]['file_name']) ? $image_data[0]['file_name'] : '';
		$post['excel'] = isset($document_data[0]['file_name']) ? $document_data[0]['file_name'] : '';
		$result = $this->transaction_model->add_transaction($post);
		if($result['status'] == 'success')
		{
			$this->view();
		}
		if($result['status'] == 'failed')
		{
			$this->view();
		}
	}

	public function view()
	{
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$transactions = $this->transaction_model->get_transactions();
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'View',
			'main_content'	=> 'view',
			'transactions'	=> $transactions,
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
	}

	public function update_transaction($id){
		if($_POST){
			$update_data1 = $this->input->post();
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 2000;
			$config['max_width'] = 1500;
			$config['max_height'] = 1500;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				$update_data = $update_data1;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$update_data2 = array("image_name"=> $data['upload_data']['file_name']);
				$update_data = array_merge($update_data1,$update_data2);
			}
			$result = $this->transaction_model->update_transaction($update_data);
			if($result['status'] == 'success'){
				$this->view();
			}
			if($result['status'] == 'failed'){
				$data = array(
					'title' 		=> 'Update',
					'main_content'	=> 'update',
				);
				$this->load->view('includes/template',$data);
			}
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];

			$transaction = $this->transaction_model->get_transaction($id);
			$data = array(
				'title' 		=> 'Update',
				'main_content'	=> 'update',
				'transaction'	=> $transaction,
				'role'			=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
		
	}
	public function delete_transaction($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->transaction_model->delete_transaction($id);
		if($result['status'] == 'success'){
			$this->view();
		}
		if($result['status'] == 'failed'){
			$this->view();
		}
	}
	public function view_roles(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$roles = $this->user_model->view_roles();
		$data = array(
			'title' 		=> 'View',
			'main_content'	=> 'view_roles',
			'roles'	=> $roles,
			'role'	=>$user_role,
		);
		$this->load->view('includes/template', $data);
	}
	public function add_role(){
		if($_POST){
			$data = $this->input->post();
			$result = $this->user_model->add_role($data);
			$roles = $this->user_model->get_roles();

			if($result['status'] == 'success'){
				$this->view_roles();
			}
			if($result['status'] == 'failed'){
				$data = array(
					'title' 		=> 'Add',
					'main_content'	=> 'add_role',
				);
				$this->load->view('includes/template',$data);
			}
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];

			$roles = $this->user_model->get_roles();
			$data = array(
				'title' 		=> 'Add',
				'main_content'	=> 'add_role',
				'roles' => $roles,
				'role'	=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
	}
	public function delete_role($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$result = $this->user_model->delete_role($id);
		$roles = $this->user_model->get_roles();
		if($result['status'] == 'success'){
			$data = array(
				'title' 		=> 'Add',
				'main_content'	=> 'add_role',
				'roles'	=> $roles,
				'role'	=>$user_role
			);
			$this->load->view('includes/template',$data);
		}
		if($result['status'] == 'failed'){
			$this->view();
		}
	}
	public function add_user(){
		if($_POST){
			$data = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules("name","Name","required",array("required"=>"Please Enter Name"));
			$this->form_validation->set_rules("address","Address","required",array("required"=>"Please Enter Address"));
			$this->form_validation->set_rules("contact_person","ContactPerson","required",array("required"=>"Please Enter Contact"));
			$this->form_validation->set_rules("contact_office","ContactOffice","required",array("required"=>"Please Enter Office Contact"));
			$this->form_validation->set_rules("email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("email_office","EmailOffice","required",array("required"=>"Please Enter Office Email"));
			$this->form_validation->set_rules("gender","Gender","required",array("required"=>"Please Select Your Gender"));
			$this->form_validation->set_rules("password","Password","required|min_length[8]",array("required"=>"Please Enter Password","min_length"=>"Password must contain at least 8 character"));
			$this->form_validation->set_rules("join_date","JoinDate","required",array("required"=>"Please Select Join Date"));
			$this->form_validation->set_rules("user_type","UserType","required",array("required"=>"Please Select User Type"));
			$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
			$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
			$this->form_validation->set_rules("allow","Allow","required",array("required"=>"Please Select Allow Option"));

			if($this->form_validation->run()==true)
			{
				$result = $this->user_model->add_user($data);

				if($result['status'] == 'success'){
					$this->view_roles();
				}
			}else
			{
				$this->session->set_flashdata("error",$this->form_validation->error_array());
				redirect("user/add_user");
			}
			
			
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$departments = $this->user_model->get_departments();
			$roles = $this->user_model->get_roles();
			$data = array(
				'title' 		=> 'Add',
				'main_content'	=> 'add_user',
				'roles' => $roles,
				'role'	=> $user_role,
				'departments' => $departments
			);
			$this->load->view('includes/template', $data);
		}
		
	}
	public function get_designations(){
		$dept = $this->input->post();
		$result = $this->user_model->get_designations($dept);
		print_r(json_encode($result));exit;
	}
	
	public function update_user($id){
		if($_POST){
			$data = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules("name","Name","required",array("required"=>"Please Enter Name"));
			$this->form_validation->set_rules("address","Address","required",array("required"=>"Please Enter Address"));
			$this->form_validation->set_rules("contact_person","ContactPerson","required",array("required"=>"Please Enter Contact"));
			$this->form_validation->set_rules("contact_office","ContactOffice","required",array("required"=>"Please Enter Office Contact"));
			$this->form_validation->set_rules("email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("email_office","EmailOffice","required",array("required"=>"Please Enter Office Email"));
			$this->form_validation->set_rules("gender","Gender","required",array("required"=>"Please Select Your Gender"));
			$this->form_validation->set_rules("password","Password","required|min_length[8]",array("required"=>"Please Enter Password","min_length"=>"Password must contain at least 8 character"));
			$this->form_validation->set_rules("join_date","JoinDate","required",array("required"=>"Please Select Join Date"));
			$this->form_validation->set_rules("user_type","UserType","required",array("required"=>"Please Select User Type"));
			$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
			$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
			$this->form_validation->set_rules("allow","Allow","required",array("required"=>"Please Select Allow Option"));

			if($this->form_validation->run()==true)
			{
				$result = $this->user_model->update_user($data);

				if($result['status'] == 'success'){
					$this->view_roles();
					$this->load->view('includes/template',$data);
				}
				if($result['status'] == 'failed'){
					$data = array(
						'title' 		=> 'Update',
						'main_content'	=> 'update_role',
					);
					$this->load->view('includes/template',$data);
				}

			}else
			{
				$this->session->set_flashdata("error",$this->form_validation->error_array());
				redirect("user/update_user/$id");
			}
			
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];

			$user_data = $this->user_model->get_user_data($id);
			$roles = $this->user_model->get_roles();
			$departments = $this->user_model->get_departments();
			$data = array(
				'title' 		=> 'Update',
				'main_content'	=> 'update_user',
				'user_data' => $user_data,
				'roles' => $roles,
				'role'	=> $user_role,
				'departments' => $departments
			);
			$this->load->view('includes/template', $data);
		}
	}
	public function delete_user($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];

		$result = $this->user_model->delete_user($id);
		$roles = $this->user_model->view_roles();
		if($result['status'] == 'success'){
			$data = array(
				'title' 		=> 'View',
				'main_content'	=> 'view_roles',
				'roles'	=> $roles,
				'role'	=> $user_role
			);
			$this->load->view('includes/template',$data);
		}
		if($result['status'] == 'failed'){
			$this->view();
		}
	}
	public function update_status($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->transaction_model->update_status($id);
		if($result['status'] == 'success'){
			$this->view();
		}
		if($result['status'] == 'failed'){
			$this->view();
		}
	}
	public function logout(){

		$sess_data = array(
			'user_email', 
			'user_id', 
			'user_fullname',
			'user_logged_in'
		);

		$this->session->unset_userdata($sess_data);
		$this->session->sess_destroy();
		redirect('user', 'refresh');
	}

	public function settings(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$id 	   = $sess_data['user_id'];

		if(isset($_POST['update_user_details'])){

			$data = array(
				'password' 			=> md5($this->input->post('password', true)),
				'actual_password' 	=> $this->input->post('password', true),
			);

			$this->user_model->update_user_details($data, $id);
		   	$this->session->set_flashdata('success', 'User password updated successfully');
			redirect('user/settings', 'refresh');
		}
			
		$data = array(
			'title' 		=> 'User Settings',
			'main_content'	=> 'page-user-settings-form',
			'record'		=> array('id' => $id)
		);

		$this->load->view('includes/template', $data);
	}

	public function request_list(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id  = $sess_data['user_id'];

		$data = array(
			'title' 		=> 'Request Lists',
			'main_content'	=> 'page-user-request-list',
			'records'		=> $this->user_model->getRequestsList($user_id)
		);

		$this->load->view('includes/template', $data);
	}

	public function request_create(){

		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$id 	   = $sess_data['user_id'];
		$name 	   = $sess_data['user_fullname'];


		if(isset($_POST['create_request'])){

			$data  = array(
				'user_id'  			=> $this->input->post('user_id', true),
				'request_date' 		=> $this->input->post('date', true),
				'ticket_number' 	=> $this->input->post('ticket_number', true),
				'start'				=> $this->input->post('start_reading', true),
				'end' 				=> $this->input->post('end_reading', true),
				'from' 				=> $this->input->post('from_address', true),
				'to' 				=> $this->input->post('to_address', true),
				'purpose'			=> $this->input->post('purpose_of_visit', true),
				'client_username' 	=> $this->input->post('client_username', true),
				'total_distance' 	=> $this->input->post('total_distance', true),
				'status' 			=> $this->input->post('status', true),
				'created_on'		=> date('Y-m-d H:i:s')
			);	

			$email_data_arr = $data;
			$email_data_arr['full_name'] = $name;

			//save 
			$this->user_model->save_request($data);

			$message = $this->load->view('emails/fuel_request_email', $email_data_arr, true);
			$this->sendmail->sendEmail(ADMINEMAIL, 'New fuel request received on portal', $message);
			$this->session->set_flashdata('success', 'Fuel request saved successfylly');
			redirect('user/requests', 'refresh');
		}

		$data = array(
			'title' 		=> 'Create Request',
			'main_content'	=> 'page-user-request-form',
			'record'		=> array('user_id' => $id)
		);

		$this->load->view('includes/template', $data);
	}


	public function request_details($id = NULL){
		
		$request_id 	= $this->uri->segment(4);
		$request_info 	= $this->user_model->getRequestDetails($id);
		$view = $this->load->view('partials-request-fuel-info', $request_info, true);
		echo $view;exit;
	}

	public function generate_report(){

		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$uid 	   = $sess_data['user_id'];

		if(isset($_GET['generate_report'])){
			$from_date 	= isset($_GET['from_date']) ? $_GET['from_date'] : '';
			$to_date 	= isset($_GET['to_date']) ? $_GET['to_date'] : '';
			$type 		= isset($_GET['type']) ? $_GET['type'] : '';

			$results    		= $this->user_model->getReport($from_date, $to_date, $type, $uid);
			$data       		= array();
			$data['results'] 	= $results;
			$data['from_date'] 	= $from_date;
			$data['to_date'] 	= $to_date; 
			$data['type'] 		= $type; 
			$data['logo']		= site_url()."/img/logo_12.png";
			
			$this->load->library('pdfgenerator');
			$html = $this->load->view('page-user-report-pdf', $data, true);
			$this->pdfgenerator->generate($html, time());
		}

		$days_ago = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));

		$data = array(
			'title' 		=> 'Generate Report',
			'main_content'	=> 'page-user-report-list',
			'records'		=> $this->user_model->getReport($days_ago, date('Y-m-d'), 'Approved',  $uid)
		);
		
		$this->load->view('includes/template', $data);
	}
}