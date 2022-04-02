<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_common extends CI_Model
{
    public function __construct(){
		parent::__construct();

		try{
			$this->load->database();
		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}
	}
    
    public function get_company(){
        return $this->db->select('ComName')->get('abase_01_com')->row()->ComName ?? '';
    }
    
    public function get_branch(){
        return $this->db->select('BranchCode, BranchName')
                        ->get('abase_02_branch')->result_array();
    }

    public function get_branch_last_balance($branch, $accno, $transdate){
        //Get AccNo Type
        $acc_type = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $accno])->row()->Acc_Type;

        $query = $this->db->select('BalanceBranch')->limit(1)->order_by('TransDate DESC, CtrlNo DESC');
        
        //IF AccType either R/E, don't get running balance from Last Year,
        //ELSE is permitable
        if($acc_type == 'R' || $acc_type == 'E'){
            $query = $this->db->where("YEAR(TransDate) = YEAR('$transdate')");
        }else{
            $query = $this->db->where("TransDate <= '$transdate'");
        }

        $query = $this->db->get_where('tbl_fa_transaction', [
                                        'Branch' => $branch,
                                        'AccNo' => $accno
                                    ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    public function get_mas_acc(){
        $query = $this->db
                ->order_by('Acc_No', 'ASC')
                ->select('Acc_No, Acc_Name, Acc_Type, TransGroup')
                ->where_not_in('TransGroup', ['H1','H2','H3'])
                ->get('tbl_fa_account_no')->result_array();

        return $query;
    }

    public function get_customer(){
		$query = $this->db->select('CustomerCode, CustomerName')->get('tbl_mat_cat_customer')->result_array();

		return $query;
	}

    public function get_employee(){
        $query = $this->db->query(
            "SELECT
                emp.IDNumber,
                emp.FullName,
                emp.DeptCode,
                emp.Branch,
                emp.CostCenter,
                IF(trans.Balance IS NULL, 0, trans.Balance) AS Balance
             FROM tbl_hr_append AS emp
             LEFT JOIN (SELECT Branch, IDNumber, Balance FROM tbl_fa_transaction ORDER BY CtrlNo DESC LIMIT 1) AS trans
                ON emp.IDNumber = trans.IDNumber AND emp.Branch = trans.Branch"
        )->result_array();
        
        return $query;
    }

    public function get_department(){
        $query = $this->db->select('DeptCode, DeptDes, Branch')->get('abase_03_dept')->result_array();

        return $query;
    }

    public function get_costcenter(){
        $query = $this->db->select('CostCenter, CCDes, DeptCode')->get('abase_04_cost_center')->result_array();

        return $query;
    }

	public function get_storage(){
		$query = $this->db->select('StorageCode, StorageName')->get('tbl_mat_cat_storage')->result_array();

		return $query;
	}

	public function get_stockcode(){
		$query = $this->db->select('Stockcode, StockDescription, UOM, UOMQty')->get('tbl_mat_stockcode')->result_array();

		return $query;
	}

    public function get_currency(){
        return $this->db->get('tbl_fa_mas_cur')->result();
    }

    public function get_last_trans_date(){
        $query = $this->db->select('TransDate')
                        ->group_by('TransDate')
                        ->order_by('TransDate','DESC')
                        ->limit(1)
                        ->get('tbl_fa_transaction')->row();

        return $query ? $query->TransDate : date('Y-m-d');
    }
    
    public function calculate_retaining_earnings($branch, $date){
        $this->db->trans_begin();

        $this->db->query(
            "DELETE FROM `tbl_fa_retaining_earning`
             WHERE Branch = ''
             OR Branch IS NULL
             OR Retaining IS NULL
             OR RetainingSum IS NULL"
        );

        $is_retaining_curmonth_exist = (int) $this->db->query(
            "SELECT COUNT(Month) AS Total FROM tbl_fa_retaining_earning
             WHERE Branch = '$branch'
             AND Month = YEAR('$date')
             AND Year = MONTH('$date')"
        )->row()->Total;

        $retaining = 0;
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        if($is_retaining_curmonth_exist == 0){
            $this->db->query(
                "DELETE FROM `tbl_fa_retaining_earning`
                 WHERE Branch = ?
                 AND Year = ?
                 AND Month = MONTH(?)"
            , [$branch, $year, $date]);

            $retaining = $this->db->query(
                "SELECT 
                    (
                        COALESCE(
                            (SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? 
                            AND MONTH(TransDate) = MONTH(?)
                            AND AccType IN ('R', 'R1'))
                        ,0) -
                        COALESCE(
                            (SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? 
                            AND MONTH(TransDate) = MONTH(?)
                            AND AccType IN ('E', 'E1'))
                        ,0)
                    ) AS Retaining"
            ,[$branch, $year, $date, $branch, $year, $date])->row()->Retaining ?? 0;

            $this->db->query(
                "INSERT INTO `tbl_fa_retaining_earning` (Branch, Year, Month, Retaining)
                 SELECT ?, ?, ?, ?"
            ,[$branch, $year, $month, $retaining]);

            $this->db->query(
                "UPDATE `tbl_fa_retaining_earning` AS parent
                 SET RetainingSum = (
                    SELECT SUM(Retaining) FROM tbl_fa_retaining_earning
                    WHERE Branch = ?
                    AND Year = ?
                    AND Month <= parent.Month
                 )
                 WHERE Branch = ?
                 AND Year = ?"
            ,[$branch, $year, $branch, $year]);
        }else{
            $retaining = $this->db->query(
                "SELECT 
                    (
                        COALESCE(
                            (SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? 
                            AND MONTH(TransDate) = MONTH(?)
                            AND AccType IN ('R', 'R1'))
                        ,0) -
                        COALESCE(
                            (SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? 
                            AND MONTH(TransDate) = MONTH(?)
                            AND AccType IN ('E', 'E1'))
                        ,0)
                    ) AS Retaining"
            ,[$branch, $year, $date, $branch, $year, $date])->row()->Retaining ?? 0;

            $this->db->query(
                "UPDATE `tbl_fa_retaining_earning`
                 SET Retaining = ?
                 WHERE Branch = ?
                 AND Year = ?
                 AND Month = ?"
            ,[$retaining, $branch, $year, $month]);

            $this->db->query(
                "UPDATE `tbl_fa_retaining_earning` AS parent
                 SET RetainingSum = (
                    SELECT SUM(Retaining) FROM tbl_fa_retaining_earning
                    WHERE Branch = ?
                    AND Year = ?
                    AND Month <= parent.Month
                 )
                 WHERE Branch = ?
                 AND Year = ?"
            ,[$branch, $year, $branch, $year]);
        }

        if($this->db->error()['code'] != 0){
            $code = $this->db->error()['code'];
            $message = $this->db->error()['message'];
            log_message('error', "$code: $message");

            $this->db->trans_rollback();

            return "Database Error";
        }
        
        $this->db->trans_complete();
        
        return null;
    }
}