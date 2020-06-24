<?php
defined('BASEPATH') OR exit('No direct Script Access');

class GrossReport_model extends CI_model{

    public function get_grossreport(){
        $where = "c.Status = 'CONTRACT SIGNED'  OR c.status = 'LIVE'";
        $query = $this->db->select('c.Company, c.number_of_bus, c.number_of_seat,c.live_seat,t.Name, c.Status')
            ->from('csv_data as c')
            ->join('tbl_users as t ','t.id=c.uploaded_by')
            ->where($where)
            ->get();
        if($query){
            $result = $query->result_array();
            return $result;
        }
        else{
            return false;
        }
    }
}
