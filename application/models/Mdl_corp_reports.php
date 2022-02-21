<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Mdl_corp_reports extends CI_Model {

    //* RE-CALCULATE
    function get_last_trans_date(){
        $query = $this->db->select('TransDate')
                        ->group_by('TransDate')
                        ->order_by('TransDate','DESC')
                        ->limit(1)
                        ->get('tbl_fa_transaction')->row();

        return $query ? $query->TransDate : date('Y-m-d');
    }
}           