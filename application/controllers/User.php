<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->library(array('session','Nepali_date','sendMail','Pdfgenerator')); 
		$this->load->model('ExpensesTransaction_model');
		$this->load->model('tax_model');
		$this->load->model('dashboard_model');
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
						'user_dept' 		=> $res['dept_id'],
						'user_des' 			=> $res['des_id'],
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

	private function get_monthly_income_expense($data_type){
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		if($data_type=='income'){
			$res 		=  $this->dashboard_model->get_monthly_income($nepali_year);
		}else if($data_type=='expense'){
			$res 		=  $this->dashboard_model->get_monthly_expense($nepali_year);
		}
		$month_name = ['Baisakh', 'Jestha', 'Asar', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik','Mangshir','Poush','Magh','Falgun','Chaitra'];
		$data = [];
		$monthly_data = [];
		foreach($res as $r){
			$month = (int)explode('-', $r["date"])[1];
			if(isset($data[$month]))
				$data[$month] += (float)$r["amount"];
			else
				$data[$month] = (float)$r["amount"];
		}

		$max_month = 1;
		foreach($data as $key=>$e){
			if($key>$max_month){
				$max_month = $key;
			}
		}

		for($i=1;$i<=$max_month;$i++){
			$month_index = $i-1;
			foreach($data as $key=>$e){
				if($key==$i){
					$monthly_data[$i] = array('month'=>$month_name[$month_index],'amount'=>$e);
					break;
				}
				else{
					$monthly_data[$i] = array('month'=>$month_name[$month_index],'amount'=>0);
				}
			}
		}

		return $monthly_data;
	}

	public function get_monthly_income_expense_combined(){
		$income = $this->get_monthly_income_expense('income');
		$expense = $this->get_monthly_income_expense('expense');
		echo json_encode(array('income'=>$income,'expense'=>$expense));
	}

	private function get_yearly_income_expense($data_type){
		if($data_type=='income'){
			$res 		=  $this->dashboard_model->get_yearly_income();
		}else if($data_type=='expense'){
			$res 		=  $this->dashboard_model->get_yearly_expense();
		}
		$data = [];
		$yearly_data = [];
		foreach($res as $r){
			$year = (int)explode('-', $r["date"])[0];
			if(isset($data[$year]))
				$data[$year] += (float)$r["amount"];
			else
				$data[$year] = (float)$r["amount"];
		}

		$yearly_data = $data;

		return $yearly_data;
	}

	public function get_yearly_income_expense_combined(){
				
		$yearly_expense = 	$this->get_yearly_income_expense('expense');
		$yearly_income	=	$this->get_yearly_income_expense('income');

		$year = [];

		foreach($yearly_expense as $key=>$value){
			$year[] = $key;
		}
		
		foreach($yearly_income as $key=>$value){
			$year[] = $key;
		}
		$year = array_unique($year);
		sort($year);    

		foreach($year as $y){
			if(!isset($yearly_expense[$y])){
			  $yearly_expense[$y]=(float)0;
			}

			if(!isset($yearly_income[$y])){
				$yearly_income[$y]=(float)0;
			}
		}

		ksort($yearly_expense);
		ksort($yearly_income);

		echo json_encode(array('year'=>$year,'yearly_income'=>$yearly_income,'yearly_expense'=>$yearly_expense));
	}

	public function get_current_year_income_expense_equity(){
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$income =  $this->dashboard_model->get_current_year_income($nepali_year);
		$expense =  $this->dashboard_model->get_current_year_expense($nepali_year);
		$equity =  $this->dashboard_model->get_current_year_equity($nepali_year);

		echo json_encode(array('income'=>$income[0]["amount"],'expense'=>$expense[0]["amount"],'equity'=>$equity[0]["amount"]));
	}

	
	public function get_total_year_income_expense_equity(){
		$income =  $this->dashboard_model->get_total_year_income();
		$expense =  $this->dashboard_model->get_total_year_expense();
		$equity =  $this->dashboard_model->get_total_year_equity();
		
		echo json_encode(array('income'=>$income[0]["amount"],'expense'=>$expense[0]["amount"],'equity'=>$equity[0]["amount"]));
	}

	private function get_monthly_achievement(){
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$nepali_month = $this->nepali_date->AD_to_BS($year,$month,$day)["month"];
		if(strlen($nepali_month)==1){
			$nepali_month = '0'.$nepali_month;
		}
		$nepali_date = $nepali_year.'-'.$nepali_month;
		$result['live'] =  $this->dashboard_model->get_live($nepali_date,$user_id);
		$result['follow_up'] =  $this->dashboard_model->get_follow_up($nepali_date,$user_id);
		$result['contract_signed'] =  $this->dashboard_model->get_contract_signed($nepali_date,$user_id);
		$result['new_contact'] =  $this->dashboard_model->get_new_contact($nepali_date,$user_id);
		echo '<pre>';print_r($result);exit;
		return $result;
	}

	public function get_monthly_target($user_id){
		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');

		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$nepali_month = $this->nepali_date->AD_to_BS($year,$month,$day)["month"];
		
		if(strlen($nepali_month)==1){
			$nepali_month = '0'.$nepali_month;
		}
		$nepali_date = $nepali_year.'-'.$nepali_month;
		$result 	 =  $this->dashboard_model->get_monthly_target($nepali_date, $user_id);
		$target = [];
		if(!empty($result)){
			$target['new_contact_target'] 	=  $result['nc_seat_seller_monthly'] + $result['nc_bus_company_monthly'] + $result['nc_merchant_monthly'];
				
			$target['follow_up_target']		=  $result['fu_seat_seller_monthly'] + $result['fu_bus_company_monthly'] + $result['fu_merchant_monthly'];
					
			$target['new_live_target'] 		=  $result['nl_seat_seller_monthly'] + $result['nl_no_of_seats_monthly'] + $result['nl_merchant_monthly'];
			$target['new_contract_target'] 	=  $result['m_seat_seller_monthly'] + $result['m_bus_company_monthly'] + $result['m_merchant_monthly'];
			return $target;
		}
		else{
			return false;
		}	
	}
	public function calculate_performance(){
		$user_id   =  $this->input->post('user_id');

		$year 	= date('Y');
		$month  = date('m');
		$day    = date('d');
		$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
		$nepali_month = $this->nepali_date->AD_to_BS($year,$month,$day)["month"];
		if(strlen($nepali_month)==1){
			$nepali_month = '0'.$nepali_month;
		}
		$nepali_date = $nepali_year.'-'.$nepali_month;
		$target = $this->get_monthly_target($user_id);
		if(!empty($target)){
			$live_seat = $this->dashboard_model->get_live_seats($nepali_date,$user_id);
			$data['live'] = $live_seat;
			$total_percentage = 0;
			if($live_seat >= $target['new_live_target']){
				$total_percentage = $total_percentage + 50;
			}
			else{
				$total_percentage = $total_percentage + (0.5)*($live_seat/$target['new_live_target'])*100;
			}
			$follow_up = $this->dashboard_model->get_follow_ups($nepali_date,$user_id);
			$data['follow_up']	= $follow_up;
			if($follow_up >= $target['follow_up_target']){
				$total_percentage = $total_percentage + 5;
			}
			else{
				$total_percentage = $total_percentage +  (0.05)*($follow_up/$target['follow_up_target'])*100;
			}
			$contracts_signed = $this->dashboard_model->get_signed_contracts($nepali_date,$user_id);
			$data['contract_signed'] = $contracts_signed;
			if($contracts_signed >= $target['new_contract_target']){
				$total_percentage = $total_percentage + 40;
			}
			else{
				$total_percentage  = $total_percentage + (0.4)*($contracts_signed/$target['new_contract_target'])*100;
			}
			$new_contacts = $this->dashboard_model->get_new_contacts($nepali_date,$user_id);
			$data['new_contact']	=	$new_contacts;
			if($new_contacts >= $target['new_contact_target']){
				$total_percentage  = $total_percentage + 5;
			}
			else{
				$total_percentage  = $total_percentage + (0.05)*($new_contacts/$target['new_contact_target'])*100;
			}
			
			echo json_encode(array('performance'=>$data,'target'=>$target, 'total'=>$total_percentage));
			exit;
		}
		else{
			echo json_encode(false);
			exit;
		}
		
	}
	
	public function dashboard(){

		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data 	= $this->session->all_userdata();
		$user_id   	= $sess_data['user_id'];
		$user_role 	= $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_dept==3){
			redirect('user/view_contact');
		}
		
		$is_head = $this->user_model->is_head($user_id);
		
		$users = $this->dashboard_model->get_marketing_employee($user_role,$user_id,$is_head);
		$data = array(
			'title' 						=>	'User Dashbaord',
			'main_content'					=>	'page-user-dashboard',
			'role'							=>	$user_role,
			'dept'							=>	$user_dept,
			'des'							=>	$user_des,
			'users'							=> 	$users
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
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		$data = array(
			'title' 		=> 'Add',
			'main_content'	=> 'expenses_add',
			'role' 			=>  $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);

		if($user_dept==1 || $user_role==1){
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
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
		$result = $this->ExpensesTransaction_model->add_transaction($post);

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
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		$transactions = $this->ExpensesTransaction_model->get_transactions($user_role);
		
		$data = array(
			'title' 		=> 'View',
			'main_content'	=> 'expenses_view',
			'transactions'	=> $transactions,
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);

		if($user_role==1 || $user_role==2 || $user_dept==1){
			$this->load->view('includes/template', $data);
		}
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
		
			$result = $this->ExpensesTransaction_model->update_transaction($update_data);
	
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$transaction = $this->ExpensesTransaction_model->get_transaction($id);
			$data = array(
				'title' 		=> 'update_expenses',
				'main_content'	=> 'update_expenses',
				'transaction'	=> $transaction,
				'role'			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			if($user_des==5 || $user_role==1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
	}

	public function expenses_delete($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		
		$sess_data = $this->session->all_userdata();
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_des==5 || $user_role==1){
			$result = $this->ExpensesTransaction_model->delete_transaction($id);
		
			if($result['status'] == 'failed'){
				$this->session->set_flashdata('error',array('delete_expenses_error'=>'Error Occured while deleting Expenses'));
			}

			redirect('user/expenses_view');
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}
	public function view_roles(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		$roles = $this->user_model->view_roles();
		$data = array(
			'title' 		=> 'View',
			'main_content'	=> 'view_roles',
			'roles'			=> $roles,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des,
			'role'			=> $user_role
		);

		if($user_role==1){
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$roles = $this->user_model->get_roles();
			$data = array(
				'title' 		=> 'Add',
				'main_content'	=> 'add_role',
				'roles' 		=> $roles,
				'role'			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			if($user_role==1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
	}

	public function delete_role($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];

		if($user_role==1){
			$result = $this->user_model->delete_role($id);
	
			if($result['status'] == 'failed'){
				$this->session->set_flashdata("error",array("error_delete"=>"Delete Failed Error Occured"));
				redirect("user/add_role");		
			}			
			redirect('user/add_role', 'refresh');
		}else{
			$this->load->view('includes/pagenotfound');
		}
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

	public function check_emp_code(){
		$data = $this->input->post();
		$result = $this->user_model->check_emp_code($data);
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}

	public function upload_profile_pic(){
		$post = $this->input->post();
		$data = $post['image'];	
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = time() . '.png';
		file_put_contents('./images/profile_pic/'.$imageName, $data);

		echo $imageName;
	}

	public function add_user(){
		if($_POST){
			$post = $this->input->post();
			//form validation
			$this->load->library('form_validation');
			$this->form_validation->set_rules("name","Name","required",array("required"=>"Please Enter Name"));
			$this->form_validation->set_rules("address","Address","required",array("required"=>"Please Enter Address"));
			$this->form_validation->set_rules("contact_person","ContactPerson","required",array("required"=>"Please Enter Contact"));
			$this->form_validation->set_rules("contact_office","ContactOffice","required",array("required"=>"Please Enter Office Contact"));
			$this->form_validation->set_rules("email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("email_office","EmailOffice","required",array("required"=>"Please Enter Office Email"));
			$this->form_validation->set_rules("gender","Gender","required",array("required"=>"Please Select Your Gender"));
			$this->form_validation->set_rules("date_of_birth","date_of_birth","required",array("required"=>"Please Select Date of Birth"));
			$this->form_validation->set_rules("user_type","UserType","required",array("required"=>"Please Select User Type"));
			$this->form_validation->set_rules("allow_approve","Allow_approve","required",array("required"=>"Please Select Allow Option"));
			if($post['user_type']==3){
				$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
				$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
				$this->form_validation->set_rules("emp_code","EmpCode","required",array("required"=>"Please Enter Emp Code"));
			}
			// form validation ends //

			if($this->form_validation->run()==true)
			{
				if($post['user_type']==3){	
					$address_per = array(
						'municipality' 		=> $post['municipality'],
						'ward_number' 		=> $post['ward_number'],
						'tole'		 		=> $post['tole'],
						'house_number' 		=> $post['house_number'],
						'street_name' 		=> $post['street_name'],
						'district'	 		=> $post['district'],
						'province'	 		=> $post['province']
					);

					$address_temp = array(
						'municipality_temp'		=> $post['municipality_temp'],
						'ward_number_temp' 		=> $post['ward_number_temp'],
						'tole_temp'		 		=> $post['tole_temp'],
						'house_number_temp'		=> $post['house_number_temp'],
						'street_name_temp' 		=> $post['street_name_temp'],
						'district_temp'	 		=> $post['district_temp'],
						'province_temp'	 		=> $post['province_temp']
					);

					$guardian_details = array(
						'father_name'			=> $post['father_name'],
						'grand_father_name'		=> $post['grand_father_name'],
						'mother_name'			=> $post['mother_name'],
						'spouse_name' 			=> $post['spouse_name'],
						'children_name'	 		=> $post['children_name'],
						'guardian_name'	 		=> $post['guardian_name'],
						'guardian_gender' 		=> $post['guardian_gender'],
						'guardian_relation'		=> $post['guardian_relation']
					);
					
					
					$education_details = array(
						'last_degree'			=> $post['last_degree'],
						'institution'			=> $post['institution'],
						'edu_year'				=> $post['edu_year'],
						'exp_field'				=> $post['exp_field']
					);

					$emp_data = array(
						'emp_code'				=> $post['emp_code'],
						'citizenship_no'		=> $post['citizenship_no'],
						'pan_no'				=> $post['pan_no'],
						'join_date'				=> $post['join_date'],
						'marital_status'		=> $post['married_status'],
						'address_permanent'		=> Serialize($address_per),
						'address_temporary'		=> Serialize($address_temp),
						'guardian_details'		=> Serialize($guardian_details),
						'education_details'		=> Serialize($education_details),
						'profile_pic'			=> $post['profile_pic'],
						'dept_id'				=> $post['department'],
						'des_id'				=> $post['designation']
					);
					
					$add_emp = $this->user_model->add_employee($emp_data);
				}

				if($post['user_type']!=3 || ($post['user_type']==3 && $add_emp['status']=='success'))
				{
					$this->load->helper('random_password');
					$login_password = random_password();
					//add user
					$data = array(
						'name' 				=> $post['name'],
						'address' 			=> $post['address'],
						'contact_person' 	=> $post['contact_person'],
						'contact_office' 	=> $post['contact_office'],
						'email' 			=> $post['email'],
						'email_office'	 	=> $post['email_office'],
						'gender'		 	=> $post['gender'],
						'password'			=> $login_password,
						'date_of_birth'		=> $post['date_of_birth'],
						'user_type'			=> $post['user_type'],
						'allow_approve'		=> $post['allow_approve']
					);
					if($post['user_type']==3){
						$data['department'] = $post['department'];
						$data['designation'] = $post['designation'];
						$data['emp_code'] = $post['emp_code'];
					}

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
						$message = "Please Use this password with your email to login to account.<br>\r\n";
						$message .= "Password : ".$login_password."<br>\r\n";
						$message .= "Go to <a href='".site_url()."'>Login Page</a>\r\n";
						$this->sendmail->sendEmail($post['email'],"Bonjour Management Login Information",$message);
						redirect("user/view_roles",'refresh');
					}else{
						if($post['user_type']==3){
							$result = $this->user_model->remove_employee($post['emp_code']);
						}
						$this->session->set_flashdata("error",array("error_adding_user"=>"Error occured while adding user."));
						redirect("user/view_roles",'refresh');
					}
					// add user ends
				}else{
					$this->session->set_flashdata("error",array("error_adding_user"=>"Error occured while adding employee user."));
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$departments = $this->user_model->get_departments();
			$roles = $this->user_model->get_roles();
			$data = array(
				'title' 		=> 'Add',
				'main_content'	=> 'add_user',
				'roles' 		=> $roles,
				'role'			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des,
				'departments' 	=> $departments
			);
			if($user_role==1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
		
	}

	public function get_each_contact(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$post = $this->uri->segment(3);
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		$contact = $this->user_model->get_each_contact($post);
		$follow_ups = $this->user_model->get_follow_ups($post);

		$data = array(
			'title' 		=> 'View Contact',
			'main_content'	=> 'view_each_contact',
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des,
			'contact'		=> $contact,
			'follow_ups'	=> $follow_ups
		);
		$this->load->view('includes/template', $data);
	}

	public function report_generate(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_role==1 || $user_dept==2)
		{
			$reports = $this->user_model->generate_report();
			$data = array(
				'title' 		=> 'View Reports',
				'main_content'	=> 'report_generate',
				'role' 			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des,
				'reports'		=> $reports
			);
			// echo '<pre>';print_r($data);exit;
			$this->load->view('includes/template', $data);	
		}else{
			$this->load->view('includes/pagenotfound');	
		}		
	}

	public function get_designations(){
		$dept = $this->input->post();
		$result = $this->user_model->get_designations($dept);
		print_r(json_encode($result));exit;
	}
	
	public function update_user($id){
		if($_POST){
			$post = $this->input->post();
			//form validation
			$this->load->library('form_validation');
			$this->form_validation->set_rules("name","Name","required",array("required"=>"Please Enter Name"));
			$this->form_validation->set_rules("address","Address","required",array("required"=>"Please Enter Address"));
			$this->form_validation->set_rules("contact_person","ContactPerson","required",array("required"=>"Please Enter Contact"));
			$this->form_validation->set_rules("contact_office","ContactOffice","required",array("required"=>"Please Enter Office Contact"));
			$this->form_validation->set_rules("email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("email_office","EmailOffice","required",array("required"=>"Please Enter Office Email"));
			$this->form_validation->set_rules("gender","Gender","required",array("required"=>"Please Select Your Gender"));
			$this->form_validation->set_rules("date_of_birth","date_of_birth","required",array("required"=>"Please Select Date of Birth"));
			$this->form_validation->set_rules("user_type","UserType","required",array("required"=>"Please Select User Type"));
			$this->form_validation->set_rules("allow_approve","Allow_approve","required",array("required"=>"Please Select Allow Option"));
			if($post['user_type']==3){
				$this->form_validation->set_rules("department","Department","required",array("required"=>"Please Select Department"));
				$this->form_validation->set_rules("designation","Designation","required",array("required"=>"Please Select Designation"));
				$this->form_validation->set_rules("emp_code","EmpCode","required",array("required"=>"Please Enter Emp Code"));
			}
			// form validation ends //

			if($this->form_validation->run()==true)
			{
				if($post['user_type']==3){	
					$address_per = array(
						'municipality' 		=> $post['municipality'],
						'ward_number' 		=> $post['ward_number'],
						'tole'		 		=> $post['tole'],
						'house_number' 		=> $post['house_number'],
						'street_name' 		=> $post['street_name'],
						'district'	 		=> $post['district'],
						'province'	 		=> $post['province']
					);

					$address_temp = array(
						'municipality_temp'		=> $post['municipality_temp'],
						'ward_number_temp' 		=> $post['ward_number_temp'],
						'tole_temp'		 		=> $post['tole_temp'],
						'house_number_temp'		=> $post['house_number_temp'],
						'street_name_temp' 		=> $post['street_name_temp'],
						'district_temp'	 		=> $post['district_temp'],
						'province_temp'	 		=> $post['province_temp']
					);

					$guardian_details = array(
						'father_name'			=> $post['father_name'],
						'grand_father_name'		=> $post['grand_father_name'],
						'mother_name'			=> $post['mother_name'],
						'spouse_name' 			=> $post['spouse_name'],
						'children_name'	 		=> $post['children_name'],
						'guardian_name'	 		=> $post['guardian_name'],
						'guardian_gender' 		=> $post['guardian_gender'],
						'guardian_relation'		=> $post['guardian_relation']
					);
					
					
					$education_details = array(
						'last_degree'			=> $post['last_degree'],
						'institution'			=> $post['institution'],
						'edu_year'				=> $post['edu_year'],
						'exp_field'				=> $post['exp_field']
					);

					$emp_data = array(
						'emp_code'				=> $post['emp_code'],
						'citizenship_no'		=> $post['citizenship_no'],
						'pan_no'				=> $post['pan_no'],
						'join_date'				=> $post['join_date'],
						'address_permanent'		=> Serialize($address_per),
						'address_temporary'		=> Serialize($address_temp),
						'guardian_details'		=> Serialize($guardian_details),
						'education_details'		=> Serialize($education_details),
						'marital_status'		=> $post['married_status'],
						'profile_pic'			=> $post['profile_pic'],
						'dept_id'				=> $post['department'],
						'des_id'				=> $post['designation']
					);

					if(!empty($post['old_emp_code'])){
						$delete_emp = $this->user_model->remove_employee($post['old_emp_code']);
						if($delete_emp['status'] == 'failed'){
							$this->session->set_flashdata("error",array("error_updating_user"=>"Error occured while updating employee."));
							redirect("user/view_roles",'refresh');
						}
					}
					$add_emp = $this->user_model->add_employee($emp_data);
				}

				if($post['user_type']!=3 || ($post['user_type']==3 && $add_emp['status']=='success'))
				{
					$check_if_email_same = $this->user_model->check_if_email_same($post['id'],$post['email']);
					if(!$check_if_email_same){
						$this->load->helper('random_password');
						$login_password = random_password();
						$data = array(
							'id'				=> $post['id'],
							'name' 				=> $post['name'],
							'address' 			=> $post['address'],
							'contact_person' 	=> $post['contact_person'],
							'contact_office' 	=> $post['contact_office'],
							'email' 			=> $post['email'],
							'email_office'	 	=> $post['email_office'],
							'gender'		 	=> $post['gender'],
							'date_of_birth'		=> $post['date_of_birth'],
							'user_type'			=> $post['user_type'],
							'allow_approve'		=> $post['allow_approve'],
							'password'			=> $login_password,
						);
					}
					//update user
					else{
						$data = array(
							'id'				=> $post['id'],
							'name' 				=> $post['name'],
							'address' 			=> $post['address'],
							'contact_person' 	=> $post['contact_person'],
							'contact_office' 	=> $post['contact_office'],
							'email' 			=> $post['email'],
							'email_office'	 	=> $post['email_office'],
							'gender'		 	=> $post['gender'],
							'date_of_birth'		=> $post['date_of_birth'],
							'user_type'			=> $post['user_type'],
							'allow_approve'		=> $post['allow_approve']
						);
					}
					
					if($post['user_type']==3){
						$data['department'] = $post['department'];
						$data['designation'] = $post['designation'];
						$data['emp_code'] = $post['emp_code'];
					}else{
						if(!empty($post['old_emp_code'])){
							$delete_emp = $this->user_model->remove_employee($post['old_emp_code']);
							if($delete_emp['status'] == 'failed'){
								$this->session->set_flashdata("error",array("error_updating_user"=>"Error occured while updating user role."));
								redirect("user/view_roles",'refresh');
							}
						}
					}

					if($this->user_model->check_user_phone($data) || $this->user_model->check_user_email($data)){
					
						$error = [];

						if($this->user_model->check_user_phone($data) && $post['old_contact_person']!=$data['contact_person']){
							$error["duplicate_phone_entry"] = "Personal Phone Number already exists.";
							$this->session->set_flashdata("error",$error);
							redirect("user/update_user/$id");
						}
						
						if($this->user_model->check_user_email($data) && $post['old_email']!=$data['email']){
							$error["duplicate_email_entry"] = "Personal email already exists.";
							$this->session->set_flashdata("error",$error);
							redirect("user/update_user/$id");
						}
					}

					$result = $this->user_model->update_user($data);

					if($result['status'] == 'success'){
						if(!$check_if_email_same){
							$message = "Please Use this password with your email to login to account.<br>\r\n";
							$message .= "Password : ".$login_password."<br>\r\n";
							$message .= "Go to <a href='".site_url()."'>Login Page</a>\r\n";
							$this->sendmail->sendEmail($post['email'],"Bonjour Management Login Information",$message);
						}
						
						redirect("user/view_roles",'refresh');
					}
					if($result['status'] == 'failed'){
						$this->session->set_flashdata("error",array("error_updating_user"=>"Error occured while updating user."));
						redirect("user/view_roles",'refresh');
					}
				}else{
					$this->session->set_flashdata("error",array("error_adding_user"=>"Error occured while adding employee user."));
					redirect("user/view_roles",'refresh');
				}  
			}else{
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];
			if($user_role==1){
				$user_data = $this->user_model->get_user_data($id);
				$roles = $this->user_model->get_roles();
				$departments = $this->user_model->get_departments();

				$data = array(
					'title' 		=> 'Update',
					'main_content'	=> 'update_user',
					'user_data' 	=> $user_data,
					'roles'	 		=> $roles,
					'role'			=> $user_role,
					'dept'			=>	$user_dept,
					'des'			=>	$user_des,
					'departments' 	=> $departments
				);

				if($user_data['role']==3){
					$emp_info = $this->user_model->get_emp_data($user_data['emp_code']);

					$emp_data = array(
						'emp_code'				=> $emp_info['emp_code'],
						'citizenship_no'		=> $emp_info['citizenship_no'],
						'pan_no'				=> $emp_info['pan_no'],
						'join_date'				=> $emp_info['join_date'],
						'address_permanent'		=> unserialize($emp_info['address_permanent']),
						'address_temporary'		=> unserialize($emp_info['address_temporary']),
						'guardian_details'		=> unserialize($emp_info['guardian_details']),
						'education_details'		=> unserialize($emp_info['education_details']),
						'marital_status'		=> $emp_info['marital_status'],
						'profile_pic'			=> $emp_info['profile_pic'],
						'dept_id'				=> $emp_info['dept_id'],
						'des_id'				=> $emp_info['des_id']
					);

					$data['emp_data'] = $emp_data;
				}

				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}			
		}
	}

	public function get_employee_record(){
		$post = $this->input->post();
		$emp_code = $post['emp_code'];
		$fy_id    = $post['fy_id'];

		$result = $this->user_model->get_emp_record($emp_code,$fy_id);
		
		echo json_encode($result);
	}

	public function check_fiscal_year(){
		$post = $this->input->post();
		$emp_code = $post['emp_code'];
		$fy_id    = $post['fy_id'];

		$result = $this->user_model->check_fiscal_year($emp_code,$fy_id);
		
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}

	public function view_employee_record($id){
		// $emp_record = $this->user_model->get_emp_code($id);
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		$sess_data			=   $this->session->all_userdata();
		$user_id   			=   $sess_data['user_id'];
		$user_role  		=   $sess_data['user_role'];
		$user_dept  		=   $sess_data['user_dept'];
		$user_des  			=   $sess_data['user_des'];
		$emp_code_pic	    =   $this->user_model->get_emp_code_and_pic($id)[0];
		$emp_fiscal_years   =   $this->user_model->get_emp_fiscal_years($emp_code_pic['emp_code']);
		$data = array(
			'title' 		=> 'View Employee Record',
			'main_content'	=> 'view_employee_record',
			'role'          =>  $user_role,
			'dept'          =>  $user_dept,
			'des'           =>  $user_des,
			'emp_code_pic'  =>	$emp_code_pic,
			'emp_id'		=>  $id,
			'fiscal_years'  =>  $emp_fiscal_years
		);
		if($user_role==1){
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}
	
	public function add_employee_record($id){
		// $emp_record = $this->user_model->get_emp_code($id);
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		if($_POST){
			$post = $this->input->post();
			$result = $this->user_model->add_emp_record($post);

			if($result['status']=='failed'){
				$this->session->set_flashdata("error",array('add_employee_record_error'=>"Error while adding employee record"));
			}
			redirect('user/view_employee_record/'.$id);
		}else{
			$sess_data		= $this->session->all_userdata();
			$user_id   		= $sess_data['user_id'];
			$user_role  	=   $sess_data['user_role'];
			$user_dept  	=   $sess_data['user_dept'];
			$user_des  		=   $sess_data['user_des'];
			$emp_code_pic	    =   $this->user_model->get_emp_code_and_pic($id)[0];
			$fiscal_years   =   $this->tax_model->get_fiscal_years();

			$data = array(
				'title' 		=> 'Add Employee Record',
				'main_content'	=> 'add_employee_record',
				'role'          =>  $user_role,
				'dept'          =>  $user_dept,
				'des'           =>  $user_des,
				'emp_code_pic'  =>	$emp_code_pic,
				'fiscal_years'  =>  $fiscal_years
			);
			if($user_role==1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
	}

	public function edit_employee_record($eid,$rid){
		// $emp_record = $this->user_model->get_emp_code($id);
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}

		if($_POST){
			$post = $this->input->post();
			$result = $this->user_model->update_emp_record($post);

			if($result['status']=='failed'){
				$this->session->set_flashdata("error",array('edit_employee_record_error'=>"Error while updating employee record"));
			}
			redirect('user/view_employee_record/'.$eid);
		}else{
			$sess_data		= 	$this->session->all_userdata();
			$user_id   		= 	$sess_data['user_id'];
			$user_role  	=   $sess_data['user_role'];
			$user_dept  	=   $sess_data['user_dept'];
			$user_des  		=   $sess_data['user_des'];
			$emp_code_pic	=   $this->user_model->get_emp_code_and_pic($eid)[0];
			$emp_record     =   $this->user_model->get_emp_record_by_id($rid)[0];
			$fiscal_years   =   $this->tax_model->get_fiscal_years();

			$data = array(
				'title' 		=> 'Edit Employee Record',
				'main_content'	=> 'edit_employee_record',
				'role'          =>  $user_role,
				'dept'          =>  $user_dept,
				'des'           =>  $user_des,
				'emp_code_pic'	=>	$emp_code_pic,
				'emp_record'	=>	$emp_record,
				'fiscal_years'  =>  $fiscal_years
			);
			if($user_role==1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
	}

	public function delete_employee_record($eid,$rid){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];

		if($user_role==1){
			$result = $this->user_model->delete_emp_record($rid);

			if($result['status'] == 'failed'){
				$this->session->set_flashdata("error",array("error_deleting_user"=>"Error occured while deleting employee record."));
			}

			redirect('user/view_employee_record/'.$eid);
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}

	public function delete_user($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];

		if($user_role==1){
			$result = $this->user_model->delete_user($id);
			$roles = $this->user_model->view_roles();

			if($result['status'] == 'failed'){
				$this->session->set_flashdata("error",array("error_deleting_user"=>"Error occured while deleting user."));
			}

			redirect("user/view_roles",'refresh');
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}

	public function update_expenses_status($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role   = $sess_data['user_role'];
		$user_des   = $sess_data['user_des'];

		if($user_role==1 || $user_des==5){
			$result = $this->ExpensesTransaction_model->update_status($id);
			
			if($result['status'] == 'failed'){
				$this->sesstion->set_flashdata('error',array('update_approve_status'=>'Error while updating approve Status'));
			}

			redirect('user/expenses_view');
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}

	public function view_activity(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		
		if($user_role==1 || $user_role==3){
			$is_head = $this->user_model->is_head($user_id);
			$dept = $this->user_model->find_dept($user_id);
			$activity = $this->user_model->view_activity($user_role,$user_id,$is_head,$dept);
			$activity_target = $this->user_model->get_activity($user_role,$user_id,$is_head,$dept);
			$data = array(
				'title' 		=> 'View Activity',
				'main_content'	=> 'view_activity',
				'role' 			=> $user_role,
				'dept'			=> $user_dept,
				'des'			=> $user_des,
				'activity'		=> $activity,
				'activity_target'		=> $activity_target

			);
			$this->load->view('includes/template', $data);	
		}else{
			$this->load->view('includes/pagenotfound');
		}
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$data = array(
				'title' 		=> 'Add Activity',
				'main_content'	=> 'add_daily_task',
				'user_id'		=> $user_id,
				'role' 			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);

			if($user_role==1 || $user_role==3){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
			
	}
	public function view_contact(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		$contacts = $this->user_model->view_contacts();
		$data = array(
			'title' 		=> 'View Contact Management',
			'main_content'	=> 'view_contact_management',
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des,
			'contacts'		=> $contacts
		);
		if($user_role==1 || $user_dept==2 || $user_dept==3){
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
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
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$data = array(
				'title' 		=> 'Add Contacts',
				'main_content'	=> 'add_contact',
				'user_id'		=> $user_id,
				'role' 			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			if($user_role==1 || $user_dept==2){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
		}
	}
	public function view_target(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		
		if($user_role!=2){
			$is_head = $this->user_model->is_head($user_id);
			$dept = $this->user_model->find_dept($user_id);
			$targets = $this->user_model->get_targets($user_id,$is_head,$dept);
			$data = array(
				'title' 		=> 'View Target',
				'main_content'	=> 'view_target',
				'role' 			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des,
				'targets'		=> $targets
			);
			// echo '<pre>';print_r($data);exit;
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}

	public function add_target(){
		if($_POST){
			$first_data = $this->input->post();
			if($first_data['employee']=='sales'){
				unset($first_data['assigned_to_other']);
				unset($first_data['task_details']);
				unset($first_data['remarks']);
				unset($first_data['for_month2']);
				unset($first_data['date']);
				$this->load->library('form_validation');
				$this->form_validation->set_rules("assigned_to","AssignedTo","required",array("required"=>"Please Select Persons"));
				$this->form_validation->set_rules("title","Title","required",array("required"=>"Please Enter Title"));
				
				if($this->form_validation->run()==true){
					$year 	= date('Y');
					$month  = date('m');
					$day    = date('d');
	
					$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
					$date['check_date'] = $nepali_year.'-'.$first_data['for_month'];
					$data = [];
					$data = array_merge($first_data,$date);
					$result = $this->user_model->add_target($data);
				}
				else{
					$this->session->set_flashdata('error',$this->form_validation->error_array());
					redirect('user/add_target');
				}
				if($result['status'] == 'failed'){
					$this->session->set_flashdata('error',array('error'=>'Error while adding target'));
					redirect('user/add_target');
				}
				
				redirect('user/view_target');
			}
			else{
				$first_data['assigned_to'] = $first_data['assigned_to_other'];
				$first_data['for_month']	=	$first_data['for_month2'];
				$first_data['title']	=	$first_data['title2'];
				unset($first_data['title2']);
				unset($first_data['assigned_to_other']);
				unset($first_data['for_month2']);
				$this->load->library('form_validation');
				$this->form_validation->set_rules("assigned_to_other","AssignedToother","required",array("required"=>"Please Select whom you want to assign task to"));
				$this->form_validation->set_rules("task_details","TaskDetails","required",array("required"=>"Please Enter Task Details"));
				
				if($this->form_validation->run()==true){
					$year 	= date('Y');
					$month  = date('m');
					$day    = date('d');
	
					$nepali_year = $this->nepali_date->AD_to_BS($year,$month,$day)["year"];
					$date['check_date'] = $nepali_year.'-'.$first_data['for_month'];
					$data = [];
					$data = array_merge($first_data,$date);
					$result = $this->user_model->add_target($data);
				}
				else{
					$this->session->set_flashdata('error',$this->form_validation->error_array());
					redirect('user/add_target');
				}
				if($result['status'] == 'failed'){
					$this->session->set_flashdata('error',array('error'=>'Error while adding target'));
					redirect('user/add_target');
				}
				
				redirect('user/view_target');
			}
			
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

		
			$management_role = $this->get_all_management_role();
			$other = $this->get_users();

			$data = array(
				'title' 			=> 'Add Contacts',
				'main_content'		=> 'add_target',
				'user_id'			=> $user_id,
				'role' 				=> $user_role,
				'dept'				=>	$user_dept,
				'des'				=>	$user_des,
				'management_role' 	=> $management_role,
				'other'				=>	$other
			);
			$this->load->view('includes/template', $data);
		}			
	}

	public function get_all_management_role(){
		$result = $this->user_model->get_all_management_role();
		return $result;
	}
	public function get_users(){
		$result = $this->user_model->get_users();
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
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_role!=2){
			$target = $this->user_model->get_each_target($post);
			$data = array(
				'title' 		=> 'View Target',
				'main_content'	=> 'view_each_target',
				'role' 			=> $user_role,
				'target'		=> $target,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			// echo '<pre>';print_r($target);exit;
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}
	public function get_each_activity(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$post = $this->uri->segment(3);
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_role!=2){
			$target = $this->user_model->get_each_activity($post);
			$data = array(
				'title' 		=> 'View Target',
				'main_content'	=> 'view_task',
				'role' 			=> $user_role,
				'target'		=> $target,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
		}
	}
	public function get_each_activity_target(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('user', 'refresh');
		}
		$post = $this->uri->segment(3);
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];

		if($user_role!=2){
			$target = $this->user_model->get_each_activity_target($post);
			$assigned_by = $this->user_model->get_assigned_by($post);
			$data = array(
				'title' 		=> 'View Target',
				'main_content'	=> 'view_activity_target',
				'role' 			=> $user_role,
				'target'		=> $target,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des,
				'assigned_by'	=>	$assigned_by
			);
			// echo '<pre>';print_r($target);
			// echo '<pre>';print_r($assigned_by);
			$this->load->view('includes/template', $data);
		}else{
			$this->load->view('includes/pagenotfound');
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
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];

		if(isset($_POST['update_user_details'])){
            if($_POST['password']==$_POST['confirm_password']){
                $data = array(
				'password' 			=> md5($this->input->post('password', true)),
			    );

			$this->user_model->update_user_details($data, $id);
		   	$this->session->set_flashdata('success', 'User password updated successfully');
			redirect('user/settings', 'refresh');
            }
            else{
                	$this->session->set_flashdata('success', 'Password does not match');
			        redirect('user/settings', 'refresh');
            }
			
		}
			
		$data = array(
			'title' 		=> 'User Settings',
			'main_content'	=> 'page-user-settings-form',
			'record'		=> array('id' => $id),
			'role'			=> $user_role,
			'dept'			=>	$user_dept
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

		$sess_data 		= $this->session->all_userdata();
		$uid 	   		= $sess_data['user_id'];
		$user_role 	   	= $sess_data['user_role'];
		$user_dept 	   	= $sess_data['user_dept'];
		$user_des 	   	= $sess_data['user_des'];

		if($user_role==1 || $user_dept==2)
		{
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
		else{
			$this->load->view('includes/pagenotfound');
		}
	}
}