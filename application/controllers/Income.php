<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->model('incometransaction_model');
		$this->load->library('sendmail');
    }
    
    public function index(){
        $data = array(
			'title' 		=> 'Login',
		);

		if($this->session->userdata("user_logged_in")){
			redirect('income/income_view', 'refresh');
		}else{
			$this->load->view('page-user-login', $data);

		}
    }

	public function income_add(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('income', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		$data = array(
			'title' 		=> 'Income Add',
			'main_content'	=> 'income_add',
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);
		$this->load->view('includes/template', $data);
    }
    
	public function income_store(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules("eng_date","EngDate","required",array("required"=>"Please Select English Date"));
		$this->form_validation->set_rules("nepali_date","NepaliDate","required",array("required"=>"Please Select Nepali Date"));
		$this->form_validation->set_rules("heading","Heading","required",array("required"=>"Please Enter Heading"));
		$this->form_validation->set_rules("bill_invoice_no","BillInvoiceNo","required",array("required"=>"Please Enter Bill Invoice Number"));
		$this->form_validation->set_rules("responsible_person","ResponsiblePerson","required",array("required"=>"Please Enter Responsible Person"));
		$this->form_validation->set_rules("from","From","required",array("required"=>"Please Enter Asssign To"));
		$this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
		$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
		$this->form_validation->set_rules("details","Details","required",array("required"=>"Please Enter Details"));

		if($this->form_validation->run()==false){
			$this->session->set_flashdata('error',$this->form_validation->error_array());
			redirect('income/income_add');
		}

		if (empty($_FILES['image']['name'])) 
		{
			$error = array('image_empty' => 'Please Upload Image');	
			$this->session->set_flashdata('error',$error);
			redirect('income/income_add');
		}

		// if (empty($_FILES['excel_file']['name'])) 
		// {
		// 	$error = array('image_empty' => 'Please Upload Excel File');	
		// 	$this->session->set_flashdata('error',$error);
		// 	redirect('income/income_add');
		// }

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
				redirect('income/income_add');
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
				redirect('income/income_add');
			} 
			else 
			{
				$document_data[] = $this->upload->data();
			}	
		}

		$post['image'] = isset($image_data[0]['file_name']) ? $image_data[0]['file_name'] : '';
		$post['excel'] = isset($document_data[0]['file_name']) ? $document_data[0]['file_name'] : '';
		$result = $this->incometransaction_model->add_transaction($post);

		if($result['status'] == 'failed')
		{
			$error = array('error' => 'error occured while adding income');
			$this->session->set_flashdata('error',$error);
		}
		
		redirect('income/income_view');
	}

	public function income_view()
	{
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('income', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		$transactions = $this->incometransaction_model->get_transactions();
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'Income View',
			'main_content'	=> 'income_view',
			'transactions'	=> $transactions,
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);
		$this->load->view('includes/template', $data);
	}

	public function income_update($id){
		if($_POST){
			$update_data1 = $this->input->post();

			$this->load->library('form_validation');
			$this->form_validation->set_rules("heading","Heading","required",array("required"=>"Please Enter Heading"));
			$this->form_validation->set_rules("bill_invoice_no","BillInvoiceNo","required",array("required"=>"Please Enter Bill Invoice Number"));
			$this->form_validation->set_rules("responsible_person","ResponsiblePerson","required",array("required"=>"Please Enter Responsible Person"));
			$this->form_validation->set_rules("from","From","required",array("required"=>"Please Enter Asssign To"));
			$this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
			$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
			$this->form_validation->set_rules("details","Details","required",array("required"=>"Please Enter Details"));
	
			if($this->form_validation->run()==false){
				$this->session->set_flashdata('error',$this->form_validation->error_array());
				redirect('income/income_update/'.$id);
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
		
			$result = $this->incometransaction_model->update_transaction($update_data);
	
			if($result['status'] == 'failed'){
				$this->session->set_flashdata('error',array('income_update_error'=>'Error Occured while updating income'));
			}

			redirect('income/income_view');
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('income', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$transaction = $this->incometransaction_model->get_transaction($id);
			$data = array(
				'title' 		=> 'update_income',
				'main_content'	=> 'update_income',
				'transaction'	=> $transaction,
				'role'			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
			);
			$this->load->view('includes/template', $data);
		}
	}

	public function income_delete($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('income', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->incometransaction_model->delete_transaction($id);
	
		if($result['status'] == 'failed'){
			$this->session->set_flashdata('error',array('delete_income_error'=>'Error Occured while deleting income'));
		}

		redirect('income/income_view');
	}
}