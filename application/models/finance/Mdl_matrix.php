<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_matrix extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    function get_last_tday_mat_std()
    {
        $query = $this->db->query(
            "SELECT 
                DocNo, 
                PaidTo, 
                TransDate, 
                Amount, 
                Type_pay, 
                accno_type, 
                itemno, 
                RegBy
             FROM tbl_fa_cash_app_std 
             GROUP BY accno_type"
        );

        return ($query->num_rows() > 0 ? $query->result() : FALSE);
    }

    function get_last_tday_matrix_student($accno_type)
    {
        $query = $this->db->query(
            "SELECT 
                DocNo 
             FROM tbl_fa_cash_app_std 
             WHERE accno_type = '$accno_type' 
             GROUP BY DocNo");
        
        return [
            'count' => $query->num_rows(),
            'records' => $query->result()
        ];
    }

    function get_last_tday_mat_std_det($accno)
    {
        $query = $this->db->query(
            "SELECT 
                DocNo, 
                PaidTo, 
                TransDate, 
                Amount, 
                Type_pay, 
                accno_type, 
                itemno, 
                RegBy
            FROM tbl_fa_cash_app_std 
            WHERE accno_type = '$accno'
            ORDER BY accno_type, itemno ASC"
        );
        
        return ($query->num_rows() > 0 ? $query->result() : FALSE);
    }

    function get_accname_by_accno($maccno)
    {
        $query = $this->db->query("SELECT Acc_Name FROM tbl_fa_mas_account WHERE Acc_No = '$maccno'");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->Acc_Name;
        } else {
            return false;
        }
    }

    function get_itemno_pay_std($paidto, $accno_type)
    {
        $data = $this->db->query("SELECT IFNULL(itemno, 0) AS itemno, PaidTo, accno_type, Amount FROM tbl_fa_cash_app_std WHERE PaidTo = '$paidto' AND accno_type = '$accno_type' ORDER BY itemno DESC LIMIT 1");
        if ($data) {
            return $data->row();
        } else {
            return null;
        }
    }

    function get_list_nis()
    {
        $query = $this->db->query("SELECT a.NISN, a.NIS AS NIS, CONCAT_WS(' ', b.FirstName, b.MiddleName, b.LastName) AS AddtionalName FROM tbl_08_job_info_std a LEFT OUTER JOIN tbl_07_personal_bio b ON b.IDNumber = a.NIS ORDER BY b.FirstName ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_tday_mat_std()
    {
        $query = $this->db->query("SELECT 
                    DocNo, PaidTo, TransDate, Amount, Type_pay, accno_type, itemno, RegBy
                FROM 
                    tbl_fa_cash_app_std 
               GROUP BY
               accno_type 
                    ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getallbranch()
    {
        $query = $this->db->query("SELECT * FROM tbl_fa_mas_branch_fin WHERE Disc = 'No'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getalljgrp()
    {
        $this->db->select('Journal_Grp, JG_Name');
        $this->db->from('tbl_fa_mas_jgrp');
        $query = $this->db->get();
        return $query;
    }

    function get_last_docn()
    {
        $query = $this->db->query("SELECT IDtemp FROM tbl_fa_trans_temp ORDER BY IDtemp DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data->IDtemp;
        } else {
            return false;
        }
    }

    function get_list_account_no_eq_rec()
    {
        $query = $this->db->query("SELECT Acc_No, Acc_Name, AccType FROM tbl_fa_mas_account WHERE AccType = 'R' AND Acc_No <= '41106' ORDER BY Acc_No ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
