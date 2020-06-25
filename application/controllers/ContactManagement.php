<?php 
defined('BASEPATH') OR exit('No Direct script Access Allowed');

class ContactManagement extends CI_controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ContactManagement_model');
        $this->load->model('user_model');
    }
    public function add_contact(){
        if($_POST){
            $data = $this->input->post();
            $this->load->library('form_validation');
			$this->form_validation->set_rules("Name","Name","required",array("required"=>"Please enter the name"));
			$this->form_validation->set_rules("Company","Company","required",array("required"=>"Please Enter the Company"));
			$this->form_validation->set_rules("Designation","Designation","required",array("required"=>"Please Enter the Designation"));
			$this->form_validation->set_rules("Email","Email","required",array("required"=>"Please Enter Email"));
			$this->form_validation->set_rules("mobile_number","MobileNumber","required",array("required"=>"Please Enter Mobile Number"));
			$this->form_validation->set_rules("landline_number","LandlineNumber","required",array("required"=>"Please Enter Landline Number"));
			$this->form_validation->set_rules("Address","Address","required",array("required"=>"Please Enter Address"));			
			$this->form_validation->set_rules("Purpose","Purpose","required",array("required"=>"Please Select Purpose"));			
			$this->form_validation->set_rules("new_contact","NewContact","required",array("required"=>"Please Select New Contact Options"));			
			$this->form_validation->set_rules("Status","Status","required",array("required"=>"Please Select Status"));			
			$this->form_validation->set_rules("name_of_bus","NameOfBus","required",array("required"=>"Please Enter Name of Bus"));			
			$this->form_validation->set_rules("number_of_bus","NumberOfBus","required",array("required"=>"Please Enter Number of Bus"));			
			$this->form_validation->set_rules("number_of_seat","NumberOfSeat","required",array("required"=>"Please Enter Number of Seats"));			
			$this->form_validation->set_rules("live_seat","LiveSeat","required",array("required"=>"Please Enter Live Seats"));			
			
			if($this->form_validation->run()==true){
                $result= $this->ContactManagement_model->add_contact($data);
                if($result['status']=='success'){
                    redirect('user/view_contact');
                }
                else{
                    redirect('user/dashboard');
                }
            }else{
                $this->session->set_flashdata('error',$this->form_validation->error_array());
				redirect('user/add_contact');
            }
        }
    }
    public function edit_status(){
        if($_POST){
            $data = $this->input->post();
            
            $result = $this->ContactManagement_model->edit_status($data);
            if($result['status']=='success'){
                redirect('user/view_contact');
            }
            else{
                redirect('user/view_contact');
            }
        }
        else{
            if($this->session->userdata('user_logged_in') != '1'){
                redirect('equity', 'refresh');
            }
            $id = $this->uri->segment(3);
			$sess_data = $this->session->all_userdata();
			$user_id   = $sess_data['user_id'];
            $user_role = $sess_data['user_role'];
            $user_dept = $sess_data['user_dept'];
            $user_des = $sess_data['user_des'];
            $contact = $this->user_model->get_each_contact($id);
            $follow_ups = $this->user_model->get_follow_ups($id);
			$data = array(
				'title' 		=> 'update_contact',
                'main_content'	=> 'update_contact',
                'user_id'       => $user_id,
                'role'			=> $user_role,
                'dept'			=> $user_dept,
                'des'			=> $user_des,
                'contact'       => $contact,
                'follow_ups'	=> $follow_ups
            );
			$this->load->view('includes/template', $data);
        }
    }
}