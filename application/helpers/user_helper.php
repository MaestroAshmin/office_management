<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function getCompanyData($filed_name, $company_id){
        $ci=& get_instance();
	  	$result = $ci->db->select($filed_name)->where('company_id', $company_id)->get('tbl_companies')->row_array();
	    if(!empty($result)){
	      return $result[$filed_name];
	    }else{
	      return "";
	    }
    }

    function getClientData($filed_name, $pk_value){
        $ci=& get_instance();
        $result = $ci->db->select($filed_name)->where('id', $pk_value)->get('tbl_clients')->row_array();
        if(!empty($result)){
          return $result[$filed_name];
        }else{
          return "";
        }
    }

    function stringToArray($string){
    	$array = array();
    	if($string != ''){
    		$array = unserialize($string);
    	}
    	return $array;
    }

    function getItemsImage($item_id){
         $ci=& get_instance();
        $result = $ci->db->select('item_image')->where('item_id', $item_id)->get('tbl_items')->row_array();
        if(!empty($result)){
          return $result['item_image'];
        }else{
          return "";
        }
    }

    function getNumbertoWords($number){
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 
            1 => 'One', 
            2 => 'Two',
            3 => 'Three', 
            4 => 'Four', 
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven', 
            8 => 'Eight', 
            9 => 'Nine',
            10 => 'Ten', 
            11 => 'Eleven', 
            12 => 'Twelve',
            13 => 'Thirteen', 
            14 => 'Fourteen', 
            15 => 'Fifteen',
            16 => 'Sixteen', 
            17 => 'Seventeen', 
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty', 
            30 => 'Thirty',
            40 => 'Forty', 
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy', 
            80 => 'Eighty', 
            90 => 'Ninety'
        );
        $digits = array(
            '', 
            'hundred',
            'thousand',
            'lakh', 
            'crore'
        );
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));

        $paisa = ($decimal) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paisa' : '';
        $text =  strtolower(($Rupees ? $Rupees . 'rupees ' : '') . $paisa .' only/-');
        return ucfirst($text);
}

function getItemsDetails($field_name, $item_id){
         $ci=& get_instance();
        $result = $ci->db->select($field_name)->where('item_id', $item_id)->get('tbl_items')->row_array();
        if(!empty($result)){
          return $result[$field_name];
        }else{
          return "";
        }
    }