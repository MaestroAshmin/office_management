<?php 
defined('BASEPATH')OR exit('No direct script access');

class Import extends CI_Model {

    public function save_to_db($insertData,$user_id){ 
        // echo '<pre>';print_r($insertData);exit;
        foreach($insertData as $insertdata){
            $data = [
                'Name' => $insertdata[0],
                'Company' => $insertdata[1],
                'Designation' => $insertdata[2],
                'Email' => $insertdata[3],
                'mobile_number' => $insertdata[4],
                'landline_number' => $insertdata[5],
                'Address' => $insertdata[6],
                'Purpose' => $insertdata[7],
                'new_contact' => $insertdata[8],
                'Status' => $insertdata[11],
                'name_of_bus' => $insertdata[12],
                'number_of_bus' => $insertdata[13],
                'number_of_seat' => $insertdata[14],
                'live_seat'      => ($insertdata[15]=='') ? 0 : $insertdata[15],
                'uploaded_by'=> $user_id,
            ];

            $data = array_flip($data); 
            $data = array_change_key_case($data, CASE_UPPER); 
            $data = array_flip($data);
            try{
                $is_exists = $this->is_exists($insertdata,$user_id);
                if($is_exists){
                    $condition = [
                        'name' => $insertdata[0],
                        'uploaded_by' => $user_id,
                        'Company' => $insertdata[1],
                        'mobile_number' => $insertdata[4]
                    ];
                    $csv_data_id = $this->db->select('id')->from('csv_data')->where($condition)->get()->row_array();
                    $follow_up_data = [
                        'follow_up_round' => $insertdata[9],
                        'date' => $insertdata[10],
                        'csv_data_id' => $csv_data_id['id']
                    ];
                    $has_changed = $this->follow_up_has_changed($follow_up_data);
                    if($has_changed){
                        $this->db->where($condition);
                        $this->db->update('csv_data',$data);
                        $this->db->insert('tbl_follow_up',$follow_up_data);
                    }
                    else{
                         $this->db->where($condition);
                        $this->db->update('csv_data',$data);
                    }
                    $result_status = array('status' => 'success', 'message' =>"Successfully added");
                }
                else{
                    $this->db->insert('csv_data',$data);
                    $insert_id = $this->db->insert_id();
                    $follow_up_data = [
                        'follow_up_round' => $insertdata[9],
                        'date' => $insertdata[10],
                        'csv_data_id' => $insert_id
                    ];
                    $this->db->insert('tbl_follow_up', $follow_up_data);
                }
                $result_status = array('status' => 'success', 'message' =>"Successfully added");
            }
            catch(Exception $e){
                $result_status = array('status' => 'failed', 'message' =>"Fail to Add to Database");
            }
            
        }
        return $result_status;
    }
    public function is_exists($checkData, $user_id){
        $condition = [
            'Name' => $checkData[0],
            'uploaded_by' => $user_id,
            'Company' => $checkData[1],
            'mobile_number' => $checkData[4]
        ];
        $query = $this->db->select('*')->from('csv_data')->where($condition)->get();
        if($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function follow_up_has_changed($follow_up_data){
        $query = $this->db->select('*')->from('tbl_follow_up')->where($follow_up_data)->get();
        if($query->num_rows() == 0){
            return true;
        }
        else{
            return false;
        }
    }
}