<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BankAccount extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->model('bankAccount_model');
		$this->load->library('sendmail');
    }
    
    public function index(){
        $data = array(
			'title' 		=> 'Login',
		);

		if($this->session->userdata("user_logged_in")){
			redirect('bankAccount/bank_account_view', 'refresh');
		}else{
			$this->load->view('page-user-login', $data);

		}
	}
	
	public function check_account_no(){
		$data = $this->input->post();
		$result = $this->bankAccount_model->check_account_no($data);
		if ($result == TRUE)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
	}

	public function bank_account_add(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('bankAccount', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		$data = array(
			'title' 		=> 'Bank Account Add',
			'main_content'	=> 'bank_account_add',
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);
		$this->load->view('includes/template', $data);
    }
    
	public function account_store(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules("bank_name","BankName","required",array("required"=>"Please Enter Bank Name"));
		$this->form_validation->set_rules("account_type","AccountType","required",array("required"=>"Please Enter Account Type"));
		$this->form_validation->set_rules("account_no","AccountNo","required",array("required"=>"Please Enter Account Number"));
		$this->form_validation->set_rules("closing_balance","ClosingBalance","required",array("required"=>"Please Enter Closing Balance"));

		if($this->form_validation->run()==false){
			$this->session->set_flashdata('error',$this->form_validation->error_array());
			redirect('bankAccount/bank_account_add');
		}

		if($this->bankAccount_model->check_account_no($post)){
			$error["duplicate_account_no"] = "Account number already exists.";
			$this->session->set_flashdata("error",$error);
			redirect("bankAccount/bank_account_add");
		}else{

			$result = $this->bankAccount_model->add_account($post);

			if($result['status'] == 'failed')
			{
				$error = array('error' => 'error occured while adding equity');
				$this->session->set_flashdata('error',$error);
			}
			
			redirect('bankAccount/bank_account_view');
		}
	}

	public function bank_account_view()
	{
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('bankAccount', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$accounts = $this->bankAccount_model->get_accounts();
		$user_role = $sess_data['user_role'];
		$user_dept  = $sess_data['user_dept'];
		$user_des  	= $sess_data['user_des'];
		$data = array(
			'title' 		=> 'Bank Account View',
			'main_content'	=> 'bank_account_view',
			'accounts'  	=> $accounts,
			'role' 			=> $user_role,
			'dept'			=>	$user_dept,
			'des'			=>	$user_des
		);
		$this->load->view('includes/template', $data);
	}

	public function bank_account_update($id){
		if($_POST){
			$update_data = $this->input->post();

			$this->load->library('form_validation');
            $this->form_validation->set_rules("bank_name","BankName","required",array("required"=>"Please Enter Bank Name"));
            $this->form_validation->set_rules("account_type","AccountType","required",array("required"=>"Please Enter Account Type"));
            $this->form_validation->set_rules("account_no","AccountNo","required",array("required"=>"Please Enter Account Number"));
            $this->form_validation->set_rules("closing_balance","ClosingBalance","required",array("required"=>"Please Enter Closing Balance"));
    
			if($this->form_validation->run()==false){
				$this->session->set_flashdata('error',$this->form_validation->error_array());
				redirect('bankAccount/bank_account_update/'.$id);
			}

			if($this->bankAccount_model->check_account_no($update_data) && $update_data['old_account_no']!=$update_data['account_no']){
				$error["duplicate_account_no"] = "Account number already exists.";
				$this->session->set_flashdata("error",$error);
				redirect('bankAccount/bank_account_update/'.$id);
			}
			else{
				$result = $this->bankAccount_model->update_account($update_data);
		
				if($result['status'] == 'failed'){
					$this->session->set_flashdata('error',array('equity_update_error'=>'Error Occured while updating equity'));
				}

				redirect('bankAccount/bank_account_view');
			}
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('equity', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];
			$user_dept  = $sess_data['user_dept'];
			$user_des  	= $sess_data['user_des'];

			$account = $this->bankAccount_model->get_account($id);
			$data = array(
				'title' 		=> 'update bank account',
				'main_content'	=> 'update_bank_account',
				'account'	    => $account,
				'role'			=> $user_role,
				'dept'			=>	$user_dept,
				'des'			=>	$user_des
            );
			$this->load->view('includes/template', $data);
		}
	}

	public function bank_account_delete($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('equity', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->bankAccount_model->delete_account($id);
	
		if($result['status'] == 'failed'){
			$this->session->set_flashdata('error',array('delete_equity_error'=>'Error Occured while deleting equity'));
		}

		redirect('bankAccount/bank_account_view');
	}
}