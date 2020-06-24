<?php 
defined('BASEPATH') OR exit('No Direct script Access Allowed');

class ContactManagement extends CI_controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('contactmanagement_model');
        $this->load->model('user_model');
    }
    public function add_contact(){
        if($_POST){
            $data = $this->input->post();
            $result= $this->contactmanagement_model->add_contact($data);
            if($result['status']=='success'){
                redirect('user/view_contact');
            }
            else{
                redirect('dashboard');
            }
        }
    }
    public function edit_status(){
        if($_POST){
            $data = $this->input->post();
            $result = $this->contactmanagement_model->edit_status($data);
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
            $contact = $this->user_model->get_each_contact($id);
            $follow_ups = $this->user_model->get_follow_ups($id);
			$data = array(
				'title' 		=> 'update_contact',
                'main_content'	=> 'update_contact',
                'user_id'       => $user_id,
                'role'			=> $user_role,
                'contact'       => $contact,
                'follow_ups'	=> $follow_ups
            );
			$this->load->view('includes/template', $data);
        }
    }
}