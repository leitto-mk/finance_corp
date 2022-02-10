<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_corp_master extends CI_Model {
    
    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Currency Start
    function get_list_cur_dt()
    {
        $this->dtables->select("a.CtrlNo, a.Currency, a.CurrencyName, a.Disc, a.Remarks");
        $this->dtables->from("tbl_fa_mas_cur a");
        $this->dtables->add_column('view',
            '<button id="edit_currency" class="btn btn-outline btn-xs green" title="Edit" currency-code="$1"><i class="fa fa-pencil"></i></button>' .
            '<button id="delete_currency" class="btn btn-outline btn-xs red" title="Delete" currency-code="$1"><i class="fa fa-trash"></i></button>', 'Currency');
        return $this->dtables->generate();
    }
    function update_data_cur($dstorage, $currency)
    {
        $this->db->where('Currency', $currency);
        $this->db->update('tbl_fa_mas_cur', $dstorage);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    function get_detail_cur($currency)
    {
        $query = $this->db->query("SELECT * FROM tbl_fa_mas_cur WHERE Currency = '$currency'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_all_cur()
    {
        $this->db->select('*');
        $this->db->from('tbl_fa_mas_cur');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return false;
        }
    }
    function delete_cur_by_curcode($table, $id)
    {
        $this->db->delete($table, array('Currency' => $id));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Currency End

    
}