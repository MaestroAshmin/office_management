<?php 
defined('BASEPATH')OR exit('No direct script access');

class User_model extends CI_Model{

	public function login($email, $password){
		$password = md5($password);
		$result= $this->db->select('id, name, email,role')->from('tbl_users')
					-> where('email', $email)
					-> where('password', $password)
       				-> limit(1)
                                   -> get()
       				-> row_array();
       	if(!empty($result)){
       		return $result;
       	}else{
       		return false;
       	}
       }
       public function view_roles(){
              $this->db->select('*')->from('tbl_users');
              $this->db->join('tbl_role','tbl_users.role = tbl_role.role_id');
              $this->db->where('tbl_users.role!=',1);
              $query = $this->db->get(); 
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function add_role($data){
              try{
                     $insertData = [
                         'user_type' => $data['user_type'],
                     ];
                     $this->db->insert('tbl_role',$insertData);
                     $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                 }
                 return $result_status;
       }
       public function get_roles(){
              $query = $this->db->select('*')->from('tbl_role')->where('tbl_role.role_id!=',1)->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function add_user($data){
              try{
                     $insertData = [
                         'name' => $data['name'],
                         'email' => $data['email'],
                         'password' => md5($data['password']),
                         'role' => $data['user_type'],

                     ];
                     $this->db->insert('tbl_users',$insertData);
                     $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                 }
                 return $result_status;
       }
       public function update_user($update_data){
              try{
                     if(!empty($update_data['password'])){
                            $data = array(
                                   'name' => $update_data['name'],
                                   'email' => $update_data['email'],
                                   'password' => md5($update_data['password']),
                                   'role' => $update_data['user_type'],
                            );
                     }
                     else{
                            $data = array(
                                   'name' => $update_data['name'],
                                   'email' => $update_data['email'],
                                   'role' => $update_data['user_type'],
                            );
                     }
                     $this->db->where('ID',$update_data['id']);
                     $query = $this->db->update('tbl_users',$data);
                     $result_status = array('status' => 'success', 'message' =>"Successfully Edited transaction");
         
                 }
                 catch (Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                 }
                 return $result_status;
       }
       public function get_user_data($id){
              $query = $this->db->select('*')->from('tbl_users')->where('id',$id)->get();
              if ($query) {
                     $result = $query->row_array();
                 } else {
                     $result = array("Error" => $this->db->error());
                 }
                 return $result;
       }

       public function delete_user($id){
              try{
                     $this->db->where('id',$id);
                     $query = $this->db->delete('tbl_users');
                     $result_status = array('status' => 'success', 'message' =>"Successfully Deleted transaction");
                     return $result_status;
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                     return $result_status;
                 }
       }
       public function delete_role($id){
              try{
                     $this->db->where('role_id',$id);
                     $query = $this->db->delete('tbl_role');
                     $this->db->where('role',$id);
                     $query = $this->db->delete('tbl_users');
                     $result_status = array('status' => 'success', 'message' =>"Successfully Deleted transaction");
                     return $result_status;
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                     return $result_status;
                 }
       }

}