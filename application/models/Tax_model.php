<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Tax_model extends CI_model
{
    public function add_fiscal_year($data){
        $is_exists = $this->tax_model->is_exists($data);
        if(!$is_exists){
            try{
                $query = $this->db->insert('tbl_fiscal_year',$data);
                $result_status = array('status' => 'success', 'message' =>"Successfully added Fiscal Year");    
            }
            catch(Exception $e){
                $result_status = array('status'=> 'failed', 'message' => 'Fail to add Fiscal Year');
            }
        }
        else{
            $result_status = array('status'=> 'failed', 'message' => 'Fiscal Year Already Exists or Cannot have two active Fiscal Year at once');
        }

        return $result_status;
    }

    public function is_exists($data,$id=0){
        if($data['current_fy']=='1'){
            $query  =   $this->db->select('*')->from('tbl_fiscal_year')->where("current_fy=1 and id!=".$id)->get();
            
            if($query->num_rows() > 0 ){
                return true;
            }
        }

        $query2  =   $this->db->select('*')->from('tbl_fiscal_year')->where("fiscal_year=".$data['fiscal_year']." and id!=".$id)->get();
        if($query2->num_rows() > 0 ){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function get_fiscal_years(){
        $query = $this->db->select('*')->from('tbl_fiscal_year')->where('status',1)->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return $false;
        }
    }
    public function get_fiscal_year($id){
        $query = $this->db->select('*')->from('tbl_fiscal_year')->where('id',$id)->get();
        if($query){
            $result = $query->row_array();
            return $result;
        }
        else{
            return $false;
        }
    }

    public function edit_fiscal_year($data){
        $is_exists = $this->tax_model->is_exists($data,$data['id']);
        if(!$is_exists){
            try{
                $this->db->where('id',$data['id']);
                $query = $this->db->update('tbl_fiscal_year',$data);
                $result_status = array('status' => 'success', 'message' =>"Successfully added Fiscal Year");    
            }
            catch(Exception $e){
                $result_status = array('status'=> 'failed', 'message' => 'Fail to update Fiscal Year');
            }
        }
        else{
            $result_status = array('status'=> 'failed', 'message' => 'Fiscal Year Already Exists or Cannot have two active Fiscal Year at once');
        }
        return $result_status;
    }
 
    public function delete_fiscal_year($id)
    {
        try{
            try{
                $data = [
                    'status'    =>  0
                ];
                $this->db->where('id', $id);
                $this->db->update('tbl_fiscal_year',$data);
                $this->db->where('fiscal_year_id',$id);
                $this->db->delete('tbl_tax_structure',);
                $result_status = array('status'=>'success','message'=>'Fiscal Year Deleted Successfully');
            }
           catch(Exception $e){
                $result_status = array('status'=>'failed','message'=>'Fiscal Year Cannot be deleted');
           }

        }
        catch(Exception $e){
            $result_status = array('status'=>'falied','message'=>'Cannot Delete Fiscal Year');
        }
        return $result_status;
    }
    public function add_tax_structure($data)
    {  
        $fy_exists_tax = $this->tax_model->fy_exists_tax($data[0]['fiscal_year_id']);
        if($fy_exists_tax){
            $result_status = array('status'=> 'failed', 'message' => 'Tax Structure already exists! Please delete or edit to make changes');
        }
        else{
            try{
                foreach($data as $d){
                    $entries [] = array(
                        'tax_percent' =>    $d['tax_percent'],
                        'marital_status' =>    $d['marital_status'],
                        'fiscal_year_id'    =>  $d['fiscal_year_id'],
                        'amount'    =>  $d['amount'],
                        'last_modified_by'  =>  $d['last_modified_by']
                    );
                }
                $this->db->insert_batch('tbl_tax_structure', $data);
                $result_status = array('status' => 'success', 'message' => 'Tax Structure Added Successfully');
            }
            catch(Exception $e){
                $result_status = array('status'=> 'failed','message' => 'Cannot Add Tax Structure');
            }
        }
        
        return $result_status;
    }
    public function fy_exists_tax($data)
    {
        $condition = [
            'fiscal_year_id' => $data,
            'status'    =>  1
        ];
        $query  =   $this->db->select('*')->from('tbl_tax_structure')->where($condition)->get();
        if($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_tax_structure($id){
        try{
            $condition = [
                'fiscal_year_id'    =>  $id,
                'status'            =>  1
            ];
            $query = $this->db->select('*')->from('tbl_tax_structure')->where($condition)->get();
            if($query){
                $result =   $query->result_array();
                return $result;
            }
            else{
                return false;
            }
        }
        catch(Exception $e){
            return false;
        }
    }
    public function edit_tax_structure($data)
    {
        try{
            $this->db->where('fiscal_year_id', $data[0]['fiscal_year_id']);
            $this->db->delete('tbl_tax_structure');
            foreach($data as $d){
                $entries [] = array(
                    'tax_percent' =>    $d['tax_percent'],
                    'marital_status' =>    $d['marital_status'],
                    'fiscal_year_id'    =>  $d['fiscal_year_id'],
                    'amount'    =>  $d['amount'],
                    'last_modified_by'  =>  $d['last_modified_by']
                );
            }
            $this->db->insert_batch('tbl_tax_structure', $data);
            $result_status = array('status' => 'success', 'message' => 'Tax Structure Added Successfully');
        }
        catch(Exception $e){
            $result_status = array('status'=> 'failed','message' => 'Cannot Add Tax Structure');
        }  
        return $result_status;
    }
}   