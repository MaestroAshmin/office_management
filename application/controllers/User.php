<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->model('expensestransaction_model');
		$this->load->model('dashboard_model');
		$this->load->library(array('sendmail','nepali_date'));
	}


	public function index(){
		$data = array(
			'title' 		=> 'Login',
		);

		if($this->session->userdata("user_logged_in")){
			redirect('user/dashboard', 'refresh');
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
				redirect('user/dashboard', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('user', 'refresh');
			}
		}
	}

	private function get_monthly_income(){
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$res 		=  $this->dashboard_model->get_monthly_income($nepali_year);
		$month_name = ['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik','Mangshir','Poush','Magh','Falgun','Chaitra'];
		$income = [];
		$monthly_income = [];
		foreach($res as $r){
			$month = (int)explode('-', $r["date"])[1];
			if(isset($income[$month]))
				$income[$month] += (float)$r["amount"];
			else
				$income[$month] = (float)$r["amount"];
		}

		$max_month = 1;
		foreach($income as $key=>$e){
			if($key>$max_month){
				$max_month = $key;
			}
		}

		for($i=1;$i<=$max_month;$i++){
			$month_index = $i-1;
			foreach($income as $key=>$e){
				if($key==$i){
					$monthly_income[$i] = array('month'=>$month_name[$month_index],'amount'=>$e);
					break;
				}
				else{
					$monthly_income[$i] = array('month'=>$month_name[$month_index],'amount'=>0);
				}
			}
		}

		return $monthly_income;
	}

	private function get_monthly_expense(){
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$res 		=  $this->dashboard_model->get_monthly_expense($nepali_year);
		$month_name = ['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik','Mangshir','Poush','Magh','Falgun','Chaitra'];
		$expense = [];
		$monthly_expense = [];
		foreach($res as $r){
			$month = (int)explode('-', $r["date"])[1];
			if(isset($expense[$month]))
				$expense[$month] += (float)$r["amount"];
			else
				$expense[$month] = (float)$r["amount"];
		}

		$max_month = 1;
		foreach($expense as $key=>$e){
			if($key>$max_month){
				$max_month = $key;
			}
		}

		for($i=1;$i<=$max_month;$i++){
			$month_index = $i-1;
			foreach($expense as $key=>$e){
				if($key==$i){
					$monthly_expense[$i] = array('month'=>$month_name[$month_index],'amount'=>$e);
					break;
				}
				else{
					$monthly_expense[$i] = array('month'=>$month_name[$month_index],'amount'=>0);
				}
			}
		}

		return $monthly_expense;
	}

	public function dashboard(){

		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$monthly_expense = $this->get_monthly_expense();

		$data = array(
			'title' 			=>	'User Dashbaord',
			'main_content'		=>	'page-user-dashboard',
			'role'				=>	$user_role,
			'monthly_expense' 	=>	$this->get_monthly_expense(),
			'monthly_income' 	=>	$this->get_monthly_income()
		);
		$this->load->view('includes/template', $data);
	}

	public function expenses_add(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'Add',
			'main_content'	=> 'expenses_add',
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
	}
	public function expenses_store(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules("eng_date","EngDate","required",array("required"=>"Please Select English Date"));
		$this->form_validation->set_rules("nepali_date","NepaliDate","required",array("required"=>"Please Select Nepali Date"));
		$this->form_validation->set_rules("heading","Heading","required",array("required"=>"Please Enter Heading"));
		$this->form_validation->set_rules("bill_invoice_no","BillInvoiceNo","required",array("required"=>"Please Enter Bill Invoice Number"));
		$this->form_validation->set_rules("responsible_person","ResponsiblePerson","required",array("required"=>"Please Enter Responsible Person"));
		$this->form_validation->set_rules("to","To","required",array("required"=>"Please Enter Asssign To"));
		$this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
		$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
		$this->form_validation->set_rules("details","Details","required",array("required"=>"Please Enter Details"));

		if($this->form_validation->run()==false){
			$this->session->set_flashdata('error',$this->form_validation->error_array());
			redirect('user/expenses_add');
		}

		if (empty($_FILES['image']['name'])) 
		{
			$error = array('image_empty' => 'Please Upload Image');	
			$this->session->set_flashdata('error',$error);
			redirect('user/expenses_add');
		}



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
				$this->session->set_flashdata('error',$error);
				redirect('user/expenses_add');
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
				$this->session->set_flashdata('error',$error);
				redirect('user/expenses_add');
			} 
			else 
			{
				$document_data[] = $this->upload->data();
			}	
		}

		$post['image'] = isset($image_data[0]['file_name']) ? $image_data[0]['file_name'] : '';
		$post['excel'] = isset($document_data[0]['file_name']) ? $document_data[0]['file_name'] : '';
		$result = $this->expensestransaction_model->add_transaction($post);

		if($result['status'] == 'failed')
		{
			$error = array('error' => 'error occured while adding expenses');
			$this->session->set_flashdata('error',$error);
		}
		
		redirect('user/expenses_view');
	}

	public function expenses_view()
	{
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$transactions = $this->expensestransaction_model->get_transactions();
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'View',
			'main_content'	=> 'expenses_view',
			'transactions'	=> $transactions,
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
	}

	public function expenses_update($id){
		if($_POST){
			$update_data1 = $this->input->post();

			$this->load->library('form_validation');
			$this->form_validation->set_rules("heading","Heading","required",array("required"=>"Please Enter Heading"));
			$this->form_validation->set_rules("bill_invoice_no","BillInvoiceNo","required",array("required"=>"Please Enter Bill Invoice Number"));
			$this->form_validation->set_rules("responsible_person","ResponsiblePerson","required",array("required"=>"Please Enter Responsible Person"));
			$this->form_validation->set_rules("to","To","required",array("required"=>"Please Enter Asssign To"));
			$this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
			$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
			$this->form_validation->set_rules("details","Details","required",array("required"=>"Please Enter Details"));
	
			if($this->form_validation->run()==false){
				$this->session->set_flashdata('error',$this->form_validation->error_array());
				redirect('user/expenses_update/'.$id);
			}

			if (!empty($_FILES['image']['name'])) 
			{
				$config['upload_path'] = './images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = 2000;
				$config['max_width'] = 1500;
				$config['max_height'] = 1500;
	
				$this->load->library('upload', $config);
	
				if (!$this->upload->do_upload('image')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('error',$error);
				} else {
					$data = array('upload_data' => $this->upload->data());
					$update_data2 = array("image_name"=> $data['upload_data']['file_name']);
					$update_data = array_merge($update_data1,$update_data2);
				}
			}else{
				$update_data = $update_data1;
			}
		
			$result = $this->expensestransaction_model->update_transaction($update_data);
	
			if($result['status'] == 'failed'){
				$this->session->set_flashdata('error',array('expense_update_error'=>'Error Occured while updating expense'));
			}

			redirect('user/expenses_view');
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];

			$transaction = $this->expensestransaction_model->get_transaction($id);
			$data = array(
				'title' 		=> 'update_expenses',
				'main_content'	=> 'update_expenses',
				'transaction'	=> $transaction,
				'role'			=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
	}

	public function expenses_delete($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->expensestransaction_model->delete_transaction($id);
	
		if($result['status'] == 'failed'){
			$this->session->set_flashdata('error',array('delete_expenses_error'=>'Error Occured while deleting Expenses'));
		}

		redirect('user/expenses_view');
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
			'role'	=> $user_role
		);
		$this->load->view('includes/template', $data);
	}
	public function check_role(){
		$data = $this->input->post();
		$result = $this->user_model->check_role($data);
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}
	public function add_role(){
		if($_POST){
			$data = $this->input->post();
			
			if(!isset($data["user_type"]) || $data["user_type"]==NULL){
				$this->session->set_flashdata("error",array("empty_value"=>"Please Enter Role"));
				redirect("user/add_role");
			}

			if($this->user_model->check_role($data)){
				$this->session->set_flashdata("error",array("duplicate_entry"=>"The role already exists."));
				redirect("user/add_role");
			}else{
				$result = $this->user_model->add_role($data);
			}
		
			if($result['status'] == 'failed'){
				$this->session->set_flashdata("error",array("error_adding"=>"Adding Failed Error Occured"));
				redirect("user/add_role");
			}

			redirect('user/add_role', 'refresh');
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
	
		if($result['status'] == 'failed'){
			$this->session->set_flashdata("error",array("error_delete"=>"Delete Failed Error Occured"));
			redirect("user/add_role");		}

		
		redirect('user/add_role', 'refresh');
	}
	
	public function check_user_phone(){
		$data = $this->input->post();
		$result = $this->user_model->check_user_phone($data);
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}

	public function check_user_email(){
		$data = $this->input->post();
		$result = $this->user_model->check_user_email($data);
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}

	public function add_user(){
		if($_POST){
			$data = $this->input->post();
			if($data['user_type']!=3){
				unset($data['department']);
				unset($data['designation']);
			}
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
			$this->form_validation->set_rules("allow","Allow","required",array("required"=>"Please Select Allow Option"));
			$this->form_validation->set_rules("allow_approve","Allow_approve","required",array("required"=>"Please Select Allow Option"));

			if($data['user_type']==3){
				$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
				$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
			}

			if($this->form_validation->run()==true)
			{
				if($this->user_model->check_user_phone($data) || $this->user_model->check_user_email($data)){
					
					$error = [];

					if($this->user_model->check_user_phone($data)){
						$error["duplicate_phone_entry"] = "Personal Phone Number already exists.";
					}
						
					if($this->user_model->check_user_email($data)){
						$error["duplicate_email_entry"] = "Personal email already exists.";
					}

					$this->session->set_flashdata("error",$error);
					redirect("user/add_user");
				}

				$result = $this->user_model->add_user($data);

				if($result['status'] == 'success'){
					redirect("user/view_roles",'refresh');
				}else{
					$this->session->set_flashdata("error",array("error_adding_user"=>"Error occured while adding user."));
					redirect("user/view_roles",'refresh');
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
			if($data['user_type']!=3){
				unset($data['department']);
				unset($data['designation']);
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules("name","Name","required",array("required"=>"Please Enter Name"));
			$this->form_validation->set_rules("address","Address","required",array("required"=>"Please Enter Address"));
			$this->form_validation->set_rules("contact_person","ContactPerson","required",array("required"=>"Please Enter Contact"));
			$this->form_validation->set_rules("contact_office","ContactOffice","required",array("required"=>"Please Enter Office Contact"));
			$this->form_validation->set_rules("email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("email_office","EmailOffice","required",array("required"=>"Please Enter Office Email"));
			$this->form_validation->set_rules("gender","Gender","required",array("required"=>"Please Select Your Gender"));
			$this->form_validation->set_rules("join_date","JoinDate","required",array("required"=>"Please Select Join Date"));
			$this->form_validation->set_rules("user_type","UserType","required",array("required"=>"Please Select User Type"));
			$this->form_validation->set_rules("allow","Allow","required",array("required"=>"Please Select Allow Option"));
			$this->form_validation->set_rules("allow_approve","Allow_approve","required",array("required"=>"Please Select Allow Option"));

			if($data['user_type']==3){
				$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
				$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
			}

			if($this->form_validation->run()==true)
			{
				if($this->user_model->check_user_phone($data) || $this->user_model->check_user_email($data)){
					
					$error = [];

					if($this->user_model->check_user_phone($data) && $data['old_contact_person']!=$data['contact_person']){
						$error["duplicate_phone_entry"] = "Personal Phone Number already exists.";
						$this->session->set_flashdata("error",$error);
						redirect("user/update_user/$id");
					}
						
					if($this->user_model->check_user_email($data) && $data['old_email']!=$data['email']){
						$error["duplicate_email_entry"] = "Personal email already exists.";
						$this->session->set_flashdata("error",$error);
						redirect("user/update_user/$id");
					}
				}

				$result = $this->user_model->update_user($data);

				if($result['status'] == 'success'){
					redirect("user/view_roles",'refresh');
				}
				if($result['status'] == 'failed'){
					$this->session->set_flashdata("error",array("error_updating_user"=>"Error occured while updating user."));
					redirect("user/view_roles",'refresh');
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

		if($result['status'] == 'failed'){
			$this->session->set_flashdata("error",array("error_deleting_user"=>"Error occured while deleting user."));
		}

		redirect("user/view_roles",'refresh');
	}
	public function update_expenses_status($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->expensestransaction_model->update_status($id);
		
		if($result['status'] == 'failed'){
			$this->sesstion->set_flashdata('error',array('update_approve_status'=>'Error while updating approve Status'));
		}

		redirect('user/expenses_view');
	}
	public function view_activity(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		
		$is_head = $this->user_model->is_head($user_id);
		$dept = $this->user_model->find_dept($user_id);
		$activity = $this->user_model->view_activity($user_role,$user_id,$is_head,$dept);
		$data = array(
			'title' 		=> 'View Activity',
			'main_content'	=> 'view_activity',
			'role' 			=> $user_role,
			'activity'		=> $activity,
		);
		$this->load->view('includes/template', $data);
	
	}
	public function add_daily_task(){
		if($_POST){
			$data = $this->input->post();
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules("entry_date","EntryDate","required",array("required"=>"Please Select Entry Date"));
			$this->form_validation->set_rules("task_undertaken","TaskUndertaken","required",array("required"=>"Please Enter Task UnderTaken"));
			$this->form_validation->set_rules("progress","Progress","required",array("required"=>"Please Enter Progress"));
			$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
			
			
			if($this->form_validation->run()==true)
			{
				$result = $this->user_model->add_daily_task($data);

				if($result['status'] == 'failed'){
					$this->session->set_flashdata("error",array("error_adding_activity"=>"Error occured while adding daily task."));
				}
				
				redirect("user/view_activity");
			}else{
				$this->session->set_flashdata("error",$this->form_validation->error_array());
				redirect("user/add_daily_task");
			}
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$data = array(
				'title' 		=> 'Add Activity',
				'main_content'	=> 'add_daily_task',
				'user_id'	=> $user_id,
				'role' 			=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
			
	}
	public function view_contact(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		// $is_head = $this->user_model->is_head($user_id);
		// $dept = $this->user_model->find_dept($user_id);
		// $activity = $this->user_model->view_activity($user_id,$is_head,$dept);
		$data = array(
			'title' 		=> 'View Contact Management',
			'main_content'	=> 'view_contact_management',
			'role' 			=> $user_role,
			// 'activity'		=> $activity,
		);
		$this->load->view('includes/template', $data);
	}
	public function add_contact(){
		if($_POST){
			$data = $this->input->post();
			$result = $this->user_model->add_daily_task($data);
			if($result['status'] == 'success'){
				$this->view_contact();
			}
			if($result['status'] == 'failed'){
				$this->view_contact();
			}
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$data = array(
				'title' 		=> 'Add Contacts',
				'main_content'	=> 'add_contact',
				'user_id'	=> $user_id,
				'role' 			=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
			
	}
	public function view_target(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$is_head = $this->user_model->is_head($user_id);
		$dept = $this->user_model->find_dept($user_id);
		$targets = $this->user_model->get_targets($user_id,$is_head,$dept);
		$data = array(
			'title' 		=> 'View Target',
			'main_content'	=> 'view_target',
			'role' 			=> $user_role,
			'targets'		=> $targets
		);
		// echo '<pre>';print_r($data);exit;
		$this->load->view('includes/template', $data);
	}

	public function add_target(){
		if($_POST){
			$data = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules("assigned_to","AssignedTo","required",array("required"=>"Please Select Persons"));
			$this->form_validation->set_rules("title","Title","required",array("required"=>"Please Enter Title"));
			
			if($this->form_validation->run()==true){
				$result = $this->user_model->add_target($data);
			}
			else{
				$this->session->set_flashdata('error',$this->form_validation->error_array());
			}
			if($result['status'] == 'failed'){
				$this->session->set_flashdata('error',array('error'=>'Error while adding target'));
				redirect('user/add_target');
			}
			
			redirect('user/view_activity');
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$management_role = $this->get_all_management_role();

			$data = array(
				'title' 			=> 'Add Contacts',
				'main_content'		=> 'add_target',
				'user_id'			=> $user_id,
				'role' 				=> $user_role,
				'management_role' 	=> $management_role
			);
			$this->load->view('includes/template', $data);
		}
			
	}
	public function get_all_management_role(){
		$result = $this->user_model->get_all_management_role();
		return $result;
	}
	public function get_each_target(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$post = $this->uri->segment(3);
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$target = $this->user_model->get_each_target($post);
		$data = array(
			'title' 		=> 'View Target',
			'main_content'	=> 'view_each_target',
			'role' 			=> $user_role,
			'target'		=> $target,
		);
		// echo '<pre>';print_r($target);exit;
		$this->load->view('includes/template', $data);
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