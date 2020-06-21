<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equity extends CI_Controller
{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->model('equitytransaction_model');
		$this->load->library('sendmail');
    }
    
    public function index(){
        $data = array(
			'title' 		=> 'Login',
		);

		if($this->session->userdata("user_logged_in")){
			redirect('equity/equity_view', 'refresh');
		}else{
			$this->load->view('page-user-login', $data);

		}
    }

	public function equity_add(){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('equity', 'refresh');
		}

		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'equity Add',
			'main_content'	=> 'equity_add',
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
    }
    
	public function equity_store(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules("eng_date","EngDate","required",array("required"=>"Please Select English Date"));
		$this->form_validation->set_rules("nepali_date","NepaliDate","required",array("required"=>"Please Select Nepali Date"));
		$this->form_validation->set_rules("depositor","Depositor","required",array("required"=>"Please Enter Depositor"));
		$this->form_validation->set_rules("status","Status","required",array("required"=>"Please Enter Status"));
		$this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
		$this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));

		if($this->form_validation->run()==false){
			$this->session->set_flashdata('error',$this->form_validation->error_array());
			redirect('equity/equity_add');
		}
		$result = $this->equitytransaction_model->add_transaction($post);

		if($result['status'] == 'failed')
		{
			$error = array('error' => 'error occured while adding equity');
			$this->session->set_flashdata('error',$error);
		}
		
		redirect('equity/equity_view');
	}

	public function equity_view()
	{
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('equity', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$transactions = $this->equitytransaction_model->get_transactions();
		$user_role = $sess_data['user_role'];
		$data = array(
			'title' 		=> 'equity View',
			'main_content'	=> 'equity_view',
			'transactions'	=> $transactions,
			'role' 			=> $user_role
		);
		$this->load->view('includes/template', $data);
	}

	public function equity_update($id){
		if($_POST){
			$update_data1 = $this->input->post();

			$this->load->library('form_validation');
            $this->form_validation->set_rules("depositor","Depositor","required",array("required"=>"Please Enter Depositor"));
            $this->form_validation->set_rules("status","Status","required",array("required"=>"Please Enter Status"));
            $this->form_validation->set_rules("amount","Amount","required",array("required"=>"Please Enter Amount"));
            $this->form_validation->set_rules("remarks","Remarks","required",array("required"=>"Please Enter Remarks"));
    
			if($this->form_validation->run()==false){
				$this->session->set_flashdata('error',$this->form_validation->error_array());
				redirect('equity/equity_update/'.$id);
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
		
			$result = $this->equitytransaction_model->update_transaction($update_data);
	
			if($result['status'] == 'failed'){
				$this->session->set_flashdata('error',array('equity_update_error'=>'Error Occured while updating equity'));
			}

			redirect('equity/equity_view');
		}
		else{
			if($this->session->userdata('user_logged_in') != '1'){
				redirect('equity', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
			$user_role = $sess_data['user_role'];

			$transaction = $this->equitytransaction_model->get_transaction($id);
			$data = array(
				'title' 		=> 'update_equity',
				'main_content'	=> 'update_equity',
				'transaction'	=> $transaction,
				'role'			=> $user_role
			);
			$this->load->view('includes/template', $data);
		}
	}

	public function equity_delete($id){
		if($this->session->userdata('user_logged_in') != '1'){
			redirect('equity', 'refresh');
		}
		$sess_data = $this->session->all_userdata();
		$user_id   = $sess_data['user_id'];
		$result = $this->equitytransaction_model->delete_transaction($id);
	
		if($result['status'] == 'failed'){
			$this->session->set_flashdata('error',array('delete_equity_error'=>'Error Occured while deleting equity'));
		}

		redirect('equity/equity_view');
	}
}