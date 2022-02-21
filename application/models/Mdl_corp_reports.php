<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Mdl_corp_reports_model extends CI_Model {

    //* ENTRY REPORT
    function get_treasury_report($type, $docno, $branch, $transdate){
        $query =  $this->db->query(
            "SELECT 
                trans.ItemNo,
                trans.DocNo,
                trans.RefNo,
                trans.AccNo,
                trans.JournalGroup,
                mas.Remarks AS DescMaster,
                trans.TransDate,
                trans.IDNumber,
                trans.Giro,
                trans.Remarks AS DescDetail,
                trans.Department,
                trans.CostCenter,
                acc.Acc_Name,
                trans.Currency,
                trans.Rate,
                trans.Unit,
                trans.Debit,
                trans.Credit,
                trans.Amount
             FROM tbl_fa_transaction AS trans
             LEFT JOIN tbl_fa_account_no AS acc
                ON trans.AccNo = acc.Acc_No
             LEFT JOIN tbl_fa_treasury_mas AS mas
                USING(DocNo)
             WHERE trans.Docno = '$docno'
             AND trans.Branch = '$branch'
             AND trans.TransDate = '$transdate'
             AND trans.TransType = '$type'
             ORDER BY ItemNo ASC"
        )->result_array();

        return $query;
    }

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