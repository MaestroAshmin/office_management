<?php 
defined('BASEPATH')OR exit('No direct script access');

class User_model extends CI_Model{

	public function login($email, $password){
		$password = md5($password);
		$result= $this->db->select('id, name, email,role,dept_id,des_id')->from('tbl_users')
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
              $this->db->select('tbl_users.*,tbl_role.user_type as user_type,tbl_designation.designation as designation')->from('tbl_users');
              $this->db->join('tbl_role','tbl_users.role = tbl_role.role_id');
              $this->db->join('tbl_designation','tbl_users.des_id = tbl_designation.id','left');
              $this->db->where('tbl_users.role!=',1);
              $this->db->order_by('tbl_users.created_at','DESC');
              $query = $this->db->get(); 
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              // var_dump($result);exit;
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

       public function check_role($data){
              $query = $this->db->select('*')->from('tbl_role')->where('tbl_role.user_type',$data["user_type"])->get();
              if ($query->num_rows()>0) {
                     $result = true;
              } else {
                     $result = false;
              }
              return $result;
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

       public function check_user_phone($data){
              $query = $this->db->select('*')->from('tbl_users')->where('personal_no',$data["contact_person"])->get();
              if ($query->num_rows()>0) {
                     $result = true;
              } else {
                     $result = false;
              }
              return $result;
       }

       public function check_user_email($data){
              $query = $this->db->select('*')->from('tbl_users')->where('email',$data["email"])->get();
              if ($query->num_rows()>0) {
                     $result = true;
              } else {
                     $result = false;
              }
              return $result;
       }

       public function check_emp_code($data){
              $query = $this->db->select('*')->from('tbl_employee_info')->where('emp_code',$data["emp_code"])->get();
              if ($query->num_rows()>0) {
                     $result = true;
              } else {
                     $result = false;
              }
              return $result;
       }

       public function check_fiscal_year($emp_code,$fy_id){
              $query = $this->db->select('*')->from('tbl_salary')->where('emp_code',$emp_code)
              ->where('fy_id',$fy_id)->get();

              if ($query->num_rows()>0) {
                     $result = true;
              } else {
                     $result = false;
              }
              return $result;
       }

       public function get_emp_record($emp_code,$fy_id){
              $query = $this->db->select('*')->from('tbl_salary')
                            ->where('emp_code',$emp_code)
                            ->where('fy_id',$fy_id)->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array('status' => 'failed',"message" => $this->db->error());
              }
              return $result;
       }

       public function get_emp_record_by_id($id){
              $query = $this->db->select('*')->from('tbl_salary')
                            ->where('id',$id)->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array('status' => 'failed',"message" => $this->db->error());
              }
              return $result;
       }

       public function get_emp_fiscal_years($emp_code){
              $query = $this->db->select('f.*')->from('tbl_fiscal_year as f')
                            ->join('tbl_salary as s','s.fy_id=f.id')       
                            ->where('s.emp_code',$emp_code)
                            ->where('f.status',1)->order_by("f.fiscal_year", "desc")->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array('status' => 'failed',"message" => $this->db->error());
              }

              return $result;
       }
       
       public function add_emp_record($data){
              $query = $this->db->insert('tbl_salary',$data);
              if ($query) {
                     $result_status = array('status' => 'success', 'message' =>"Successfully added employee record");
              } else {
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
              }
              return $result_status;
       }

       public function update_emp_record($data){
              $this->db->where('id',$data['id']);
              $query = $this->db->update('tbl_salary',$data);
              if ($query) {
                     $result_status = array('status' => 'success', 'message' =>"Successfully update employee record");
              } else {
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
              }
              return $result_status;
       }

       public function delete_emp_record($id){
              try{
                     $this->db->where('id',$id);
                     $query = $this->db->delete('tbl_salary');
                     $result_status = array('status' => 'success', 'message' =>"Successfully Deleted Employee Record");
                     return $result_status;
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                     return $result_status;
                 }
       }

       public function get_emp_code($id){
              $query = $this->db->select('emp_code')->from('tbl_users')
                            ->where('id',$id)->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array('status' => 'failed',"message" => $this->db->error());
              }
              return $result;
       }

       
       public function get_emp_code_and_pic($id){
              $query = $this->db->select('e.emp_code,e.profile_pic')->from('tbl_employee_info as e')
                            ->join('tbl_users as u','u.emp_code=e.emp_code')
                            ->where('u.id',$id)->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array('status' => 'failed',"message" => $this->db->error());
              }
              return $result;
       }

       public function add_employee($data){
              try{
                     $this->db->insert('tbl_employee_info',$data);
                     $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
              }
              catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
              }
              return $result_status;
       }
       
       public function remove_employee($data){
              try{
                     $this->db->delete('tbl_employee_info',array('emp_code'=>$data));
                     $result_status = array('status' => 'success', 'message' =>"Successfully deleted employee");
              }
              catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
              }
              return $result_status;
       }

       public function add_user($data){
              try{
                     if(!isset($data['department'])){
                            $data['department']=null;
                     }

                     if(!isset($data['designation'])){
                            $data['designation']=null;
                     }
                     
                     if(!isset($data['emp_code'])){
                            $data['emp_code']=null;
                     }
                     $insertData = [
                         'name'                  => $data['name'],
                         'email'                 => $data['email'],
                         'address'               => $data['address'],
                         'personal_no'           => $data['contact_person'],
                         'office_no'             => $data['contact_office'],
                         'email_office'          => $data['email_office'],
                         'Gender'                => $data['gender'],
                         'date_of_birth'         => $data['date_of_birth'],
                         'password'              => md5($data['password']),
                         'role'                  => $data['user_type'],
                         'dept_id'               => $data['department'],
                         'des_id'                => $data['designation'],
                         'emp_code'              => $data['emp_code'],
                         'is_allowed_to_approve' => $data['allow_approve']
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
                     if(!isset($update_data['department'])){
                            $update_data['department']=null;
                     }

                     if(!isset($update_data['designation'])){
                            $update_data['designation']=null;
                     }

                     if(!isset($update_data['emp_code'])){
                            $update_data['emp_code']=null;
                     }

                     $data = array(
                            'name'                  => $update_data['name'],
                            'email'                 => $update_data['email'],
                            'address'               => $update_data['address'],
                            'personal_no'           => $update_data['contact_person'],
                            'office_no'             => $update_data['contact_office'],
                            'email_office'          => $update_data['email_office'],
                            'Gender'                => $update_data['gender'],
                            'date_of_birth'         => $update_data['date_of_birth'],
                            'role'                  => $update_data['user_type'],
                            'dept_id'               => $update_data['department'],
                            'des_id'                => $update_data['designation'],
                            'emp_code'              => $update_data['emp_code'],
                            'is_allowed_to_approve' => $update_data['allow_approve']                          
                     );
  
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

       public function get_emp_data($emp_code){
              $query = $this->db->select('*')->from('tbl_employee_info')->where('emp_code',$emp_code)->get();
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
       public function get_departments(){
              $query = $this->db->select('*')->from('tbl_department')->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_designations($dept){
              $query = $this->db->select('des.id,designation')->from('tbl_designation as des')->join('tbl_department as dept','dept.id=des.department_id')->where('dept.id',$dept['id'])->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function add_daily_task($data){
              try{
                     $insertData = [
                         'user_id' => $data['user_id'],
                         'entry_date' => $data['entry_date'],
                         'task_undertaken' => $data['task_undertaken'],
                         'progress' => $data['progress'],
                         'remarks' => $data['remarks'],
                     ];
                     $this->db->insert('tbl_activity',$insertData);
              $result_status = array('status' => 'success', 'message' =>"Successfully added transaction");
                 }
                 catch(Exception $e){
                     $result_status = array('status' => 'failed', 'message' => $e->getMessage());
                 }
                 return $result_status;
       }
       public function is_head($user_id){
              $this->db->select('tbl_designation.is_head')->from('tbl_designation');
              $this->db->join('tbl_users','tbl_users.des_id=tbl_designation.id')->where('tbl_users.id',$user_id);
              $query = $this->db->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function find_dept($user_id){
              $this->db->select('dept_id')->from('tbl_users')->where('tbl_users.id',$user_id);
              $query = $this->db->get();
              if ($query) {
                     $result = $query->result_array();
              } else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function view_activity($user_role,$user_id,$is_head,$dept){
              if($user_id==1 && $user_role==1){
                     $this->db->select('a.id as a_id, tbl_users.name, a.entry_date, a.task_undertaken,a .progress, a.remarks')->from('tbl_activity as a');
                     $this->db->join('tbl_users','tbl_users.id = a.user_id','left')->ORDER_BY('a.created_at', 'DESC');
              }
              else{
                     if($is_head[0]['is_head']==0){
                            $this->db->select('tbl_users.name, a.entry_date, a.task_undertaken,a .progress, a.remarks')->from('tbl_activity as a');
                            $this->db->join('tbl_users','tbl_users.id = a.user_id');
                            $this->db->where('a.user_id',$user_id);
                     }
                     else{
                            $this->db->distinct()->select('tbl_users.name,tbl_users.dept_id, a.entry_date, a.task_undertaken,a .progress, a.remarks')->from('tbl_activity as a');
                            $this->db->join('tbl_users','tbl_users.id = a.user_id');
                            
                            $this->db->where('tbl_users.dept_id',$dept[0]['dept_id']);
                     }     
              }
              
              $query = $this->db->get();

              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_each_activity($id){
              $query = $this->db->select('a.id as a_id, tbl_users.name, a.entry_date, a.task_undertaken,a .progress, a.remarks')->from('tbl_activity as a')
                            ->join('tbl_users','tbl_users.id = a.user_id','left')
                            ->where('a.id',$id)
                            ->get();
              if($query){
                     $result = $query->row_array();
                     return $result;
              }
              else{
                     return false;
              }
       }
       public function get_each_activity_target($id){
              $query = $this->db->select('*')->from('tbl_target as t')
                            ->join('tbl_users','tbl_users.id=t.assigned_to')
                            ->where('t.t_id',$id)
                            ->get();
              if($query){
                     $result = $query->row_array();
                     return $result;
              }
              else{
                     return false;
              }
       }
       public function get_assigned_by($id){
              $query = $this->db->select('tbl_users.name')->from('tbl_users ')
                     ->join('tbl_target as t','tbl_users.id=t.assigned_by')
                     ->where('t.t_id',$id)
                     ->get();
              if($query){
                     $result = $query->row_array();
                     return $result;
              }
              else{
                     return false;
              }  
       }
       public function get_activity($user_role,$user_id,$is_head,$dept){
         
              if($user_id==1){
                     $this->db->select('*')->from('tbl_target as a')
                     ->join('tbl_users','tbl_users.id=a.assigned_to')
                     ->where('a.employee','other')
                     ->order_by('a.created_at', 'DESC');
              }
              else{
                     if($is_head[0]['is_head']==0){
                            $condition = "a.assigned_to = $user_id OR a.assigned_by = $user_id && a.employee='other'";
                            $this->db->select('*')->from('tbl_target as a');
                            $this->db->join('tbl_users','tbl_users.id = a.assigned_to');
                            $this->db->where($condition)->order_by('a.created_at', 'DESC');
                     }
                     else{
                            $this->db->distinct()->select('*')->from('tbl_target as a');
                            $this->db->join('tbl_users','tbl_users.id = a.assigned_to');
                            $this->db->where('tbl_users.dept_id',$dept[0]['dept_id'])->order_by('a.created_at', 'DESC');
                     }
                     
              }
              $query = $this->db->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              // echo '<pre>';print_r($result);exit;
              return $result;
       }
       public function get_all_management_role(){
              $query = $this->db->select('id,name')->from('tbl_users')->where('dept_id',2)->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_users(){
              $condition = "role = 3  AND dept_id != 2";
              $query = $this->db->select('id,name')->from('tbl_users')->where($condition)->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function add_target($data){
              try{
                     $this->db->insert('tbl_target',$data);
                     $result_status = array('status' => 'success', 'message' =>"Successfully added Target");
              }
              catch (Exception $e){
                     $result_status = array('status' => 'failed', 'message' =>"Cannot add Target");
              }
              return $result_status;
       }
       public function get_targets($user_id,$is_head,$dept){
              if($user_id==1){
                     $this->db->select('*')->from('tbl_target as a')
                     ->join('tbl_users','tbl_users.id=a.assigned_to')
                     ->where('a.employee','sales')
                     ->order_by('a.created_at', 'DESC');
              }
              else{
                     if($is_head[0]['is_head']==0){
                            $condition = "a.assigned_to = $user_id OR a.assigned_by = $user_id && a.employee='sales'";
                            $this->db->select('*')->from('tbl_target as a');
                            $this->db->join('tbl_users','tbl_users.id = a.assigned_to');
                            $this->db->where($condition)->order_by('a.created_at', 'DESC');
                     }
                     else{
                            $condition = [
                                   'tbl_users.dept_id'=>$dept[0]['dept_id'],
                                   'a.employee' =>'sales'
                                   ];
                                  $this->db->distinct()->select('*')->from('tbl_target as a');
                                  $this->db->join('tbl_users','tbl_users.id = a.assigned_to');
                                  $this->db->where($condition)->order_by('a.created_at', 'DESC');
                     }
                     
              }
              
              $query = $this->db->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_each_target($id){
              $query = $this->db->select('*')->from('tbl_target')
                     ->join('tbl_users','tbl_users.id=tbl_target.assigned_to')
                     ->where('t_id',$id)->get();
              if ($query) {
              $result = $query->row_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function view_contacts(){
              $this->db->select('t.*,c.*')->from('csv_data as c')->join('tbl_users as t' ,'t.id=c.uploaded_by');
              $query = $this->db->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_each_contact($id){
              $query = $this->db->select('t.*,c.*')->from('csv_data as c')
              ->join('tbl_users as t','t.id=c.uploaded_by')
                     ->where('c.id',$id)->get();
              if ($query) {
              $result = $query->row_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function get_follow_ups($id){
              $query = $this->db->select('*')->from('tbl_follow_up')
                     ->where('csv_data_id',$id)->get();
              if ($query) {
              $result = $query->result_array();
              } else {
              $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function generate_report(){
              $query = $this->db->select('c.created_at as csv_date, c.Name,c.mobile_number,c.Company,c.Address, c.Status, c.Purpose, f.follow_up_round, f.date , c.live_seat')->from('csv_data as c')
                            ->join('tbl_follow_up as f', 'f.csv_data_id= c.id')
                            ->get();
              if ($query) {
                     $result = $query->result_array();
                     } 
              else {
                     $result = array("Error" => $this->db->error());
              }
              return $result;
       }
       public function check_if_email_same($id,$email){
              $condition = [
                     'id'   =>     $id,
                     'email'       =>     $email
              ];
              $query = $this->db->select('*')->from('tbl_users')->where($condition)->get();
              if($query->num_rows()>0){
                     return true;
              }
              else{
                     return false;
              }
       }
}