<?php 
defined('BASEPATH') OR exit('No direct Script Access Allowed');

class Tax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tax_model');
        $this->load->library('session');
    }
    public function add_fiscal_year()
    {
        if($_POST){
            $data = $this->input->post();

            $this->load->library('form_validation');
            $this->form_validation->set_rules("fiscal_year","Fiscal_Year","required",array("required"=>"Please Enter Fiscal Year"));
            $this->form_validation->set_rules("current_fy","Current_FY","required",array("required"=>"Please Select Status of Fiscal Year"));
            if($this->form_validation->run()==false){
                $this->session->set_flashdata('error',$this->form_validation->error_array());
                redirect('tax/add_fiscal_year');
            }
            $result = $this->tax_model->add_fiscal_year($data);
            if($result['status']=='success'){
                redirect('tax/add_fiscal_year');
            }
            else{
                $this->session->set_flashdata('error',$result['message']);
                redirect('tax/add_fiscal_year');

            }
        }
        else{
            if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
            $user_role  =   $sess_data['user_role'];
            $user_dept  =   $sess_data['user_dept'];
            $user_des  =   $sess_data['user_des'];
            $fiscal_years   =   $this->tax_model->get_fiscal_years();

			$data = array(
				'title' 		=> 'Add',
                'main_content'	=> 'add_fiscal_year',
                'role'          =>  $user_role,
                'dept'          =>  $user_dept,
                'des'           =>  $user_des,
                'fiscal_years'  =>  $fiscal_years
			);
			if($user_role==1 || $user_dept=1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
        }

    }

    public function edit_fiscal_year()
    {
        $id = $this->uri->segment(3);
        if($_POST){
           
            $data = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules("fiscal_year","Fiscal_Year","required",array("required"=>"Please Enter Fiscal Year"));
            $this->form_validation->set_rules("current_fy","Current_FY","required",array("required"=>"Please Select Status of Fiscal Year"));
            if($this->form_validation->run()==false){
                $this->session->set_flashdata('error',$this->form_validation->error_array());
                redirect('tax/edit_fiscal_year');
            }
            $result = $this->tax_model->edit_fiscal_year($data,$id);
            if($result['status']=='success'){
                redirect('tax/add_fiscal_year');
            }
            else{
                $this->session->set_flashdata('error',$result['message']);
                redirect('tax/add_fiscal_year');
            }
        }
        else{
            if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
            $user_role  =   $sess_data['user_role'];
            $user_dept  =   $sess_data['user_dept'];
            $user_des  =   $sess_data['user_des'];
            $fiscal_year   =   $this->tax_model->get_fiscal_year($id);

			$data = array(
				'title' 		=> 'Add',
                'main_content'	=> 'edit_fiscal_year',
                'role'          =>  $user_role,
                'dept'          =>  $user_dept,
                'des'           =>  $user_des,
                'fy'  =>  $fiscal_year
			);
			if($user_role==1 || $user_dept=1){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
        }

    }
    public function delete_fiscal_year()
    {
        $id = $this->uri->segment(3);
        $result = $this->tax_model->delete_fiscal_year($id);
        if($result['status']=='success'){
            redirect('tax/add_fiscal_year');
        }
        else{
            $this->session->set_flashdata('error',$result['message']);
            redirect('tax/add_fiscal_year');
        }
    }

    
    public function add_tax_structure()
    {
        if($_POST){
            $data = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fiscal_year','Fiscal_Year','required',array('required' =>'Please Select Fiscal Year'));
            $this->form_validation->set_rules('tax[]','Tax','required',array('required' =>'Please Add Tax Percent'));
            if($this->form_validation->run() == false){
                $this->session->set_flashdata('error',$this->form_validation->error_array());
                redirect('tax/add_tax_structure');
            }
            $result = $this->tax_model->add_tax_structure($data);
            if($result['status']=='success'){
                redirect('tax/add_tax_structure');
            }
            else{
                $this->session->set_flashdata('error',$result['message']);
                redirect('tax/add_tax_structure');
            }
            
        }
        else{
            if($this->session->userdata('user_logged_in') != '1'){
				redirect('user', 'refresh');
			}
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
            $user_role  =   $sess_data['user_role'];
            $user_dept  =   $sess_data['user_dept'];
            $user_des  =   $sess_data['user_des'];
            $fiscal_years   =   $this->tax_model->get_fiscal_years();

			$data = array(
				'title' 		=> 'Add',
                'main_content'	=> 'add_tax_structure',
                'role'          =>  $user_role,
                'dept'          =>  $user_dept,
                'des'           =>  $user_des,
                'fiscal_years'  =>  $fiscal_years
			);
			if($user_role==1 || ($user_role==3 && $user_dept=2)){
				$this->load->view('includes/template', $data);
			}else{
				$this->load->view('includes/pagenotfound');
			}
        }

    }
}