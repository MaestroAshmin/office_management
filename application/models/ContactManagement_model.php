<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactManagement_model extends CI_model{

    public function add_contact($data){
        try{
            $this->db->insert('csv_data',$data);
            $result_status = array('status' => 'success', 'message' =>"Successfully added Contact");
        }
        catch(Exception $e){
            $result_status = array('status' => 'failed', 'message' =>"Contact Add failed");
        }
        return $result_status;
    }
    
    public function edit_status($data){
        // echo '<pre>';print_r($data);exit;

        if($data['follow_up_round'] == '' && $data['date'] == ''){
            try{
                $updateData = [
                    'new_contact'   =>  $data['new_contact'],
                    'Status'        =>  $data['Status'],
                    'number_of_bus' => $data['number_of_bus'],
                    'number_of_seat'    => $data['number_of_bus'],
                    'live_seat'       =>$data['live_seat']
                ];
                $this->db->where('id',$data['id']);
                $this->db->update('csv_data',$updateData);
                $result_status = array(
                    'status'=> 'success',
                    'message'   => 'Successfully Updated Contacts'
                );
            }
            catch(Exception $e){
                $result_status = array(
                    'status'=> 'failed',
                    'message'   => 'Failed to update contacts'
                );
            }
            return $result_status;
        }
        else{
            try{
                $updateData_contact = [
                    'new_contact'   =>  $data['new_contact'],
                    'Status'        =>  $data['Status'],
                    'number_of_bus' => $data['number_of_bus'],
                    'number_of_seat'    => $data['number_of_bus'],
                    'live_seat'       =>$data['live_seat']
                ];
                $this->db->where('id',$data['id']);
                $this->db->update('csv_data',$updateData_contact);
                $insertData_follow_up = [
                    'follow_up_round'   =>  $data['follow_up_round'],
                    'date'              =>  $data['date'],
                    'csv_data_id'       =>  $data['id']
                ];
                $this->db->insert('tbl_follow_up',$insertData_follow_up);
                $result_status = array(
                    'status'=> 'success',
                    'message'   => 'Successfully Updated Contacts'
                );
            }
            catch(Exception $e){
                $result_status = array(
                    'status'=> 'failed',
                    'message'   => 'Failed to update contacts'
                );
            }
            return $result_status;
        }
    }

}