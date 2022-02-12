<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_cash_advance extends CI_Model
{
    function get_ranged_treasury($type, $docno, $start, $end){
        if($docno){
            $docno_condition = "DocNo LIKE '$docno%'";
        }else{
            $docno_condition = "DocNo IS NOT NULL";
        }

        $query = $this->db->query(
            "SELECT
                t1.IDNumber,
                t1.TransDate,
                t1.DocNo,
                t1.TransType,
                t1.Branch,
                t2.BranchName,
                t1.Remarks,
                t1.TotalAmount
             FROM tbl_fa_treasury_mas AS t1
             LEFT JOIN abase_02_branch AS t2
                ON t1.Branch = t2.BranchCode
             WHERE t1.TransDate BETWEEN '$start' AND '$end'
             AND t1.TransType = '$type'
             AND t1.$docno_condition
             ORDER BY TransDate DESC, DocNo DESC"
        )->result_array();

        return $query;
    }

    function get_new_treasury_docno($type){
        $current = $this->db->select('DocNo')
                          ->get_where('tbl_fa_treasury_mas', "DocNo LIKE '%$type'")
                          ->num_rows();

        $iteration = str_pad($current+1, 5, 0, STR_PAD_LEFT);
        $docno = date('ym') . '-' . $iteration . $type; 

        return $docno;
    }

    function get_docno_details($docno){
        return $this->db->select(
                            "t1.*, 
                             (SELECT Balance 
                              FROM tbl_fa_transaction
                              WHERE IDNumber = t1.IDNumber
                              ORDER BY TransDate DESC, CtrlNo DESC) AS Outstanding,
                             t2.IDNumber AS PaidTo, 
                             t2.Giro")
                        ->join('tbl_fa_treasury_mas AS t2', 't1.DocNo = t2.DocNo', 'LEFT')
                        ->order_by('t1.CtrlNo', 'ASC')
                        ->get_where('tbl_fa_transaction AS t1', ['t1.DocNo' => $docno])->result_array();
    }

    function get_docno_accnos($docno){
        return $this->db->group_by('AccNo')
                        ->select('AccNo')
                        ->get_where('tbl_fa_transaction', ['DocNo' => $docno])
                        ->result_array();
    }

    function get_branch(){
        return $this->db->select('BranchCode, BranchName')
                        ->get('abase_02_branch')->result();
    }

    function get_employee(){
        $query = $this->db->query(
            "SELECT
                emp.IDNumber,
                emp.FullName,
                emp.DeptCode,
                emp.Branch,
                emp.CostCenter,
                IF(trans.Balance IS NULL, 0, trans.Balance) AS Balance
             FROM tbl_fa_hr_append AS emp
             LEFT JOIN (SELECT Branch, IDNumber, Balance FROM tbl_fa_transaction ORDER BY CtrlNo DESC LIMIT 1) AS trans
                ON emp.IDNumber = trans.IDNumber AND emp.Branch = trans.Branch"
        )->result_array();
        
        return $query;
    }

    function get_department(){
        $query = $this->db->select('DeptCode, DeptDes, Branch')->get('abase_03_dept')->result_array();

        return $query;
    }

    function get_costcenter(){
        $query = $this->db->select('CostCenter, CCDes, DeptCode')->get('abase_04_cost_center')->result_array();

        return $query;
    }

    function get_mas_acc(){
        $query = $this->db
                ->order_by('Acc_No', 'ASC')
                ->select('Acc_No, Acc_Name, Acc_Type, TransGroup')
                ->where_not_in('TransGroup', ['H1','H2','H3'])
                ->get('tbl_fa_account_no')->result_array();

        return $query;
    }

    function get_last_trans_date(){
        $query = $this->db->select('TransDate')
                        ->group_by('TransDate')
                        ->order_by('TransDate','DESC')
                        ->limit(1)
                        ->get('tbl_fa_transaction')->row();

        return $query ? $query->TransDate : date('Y-m-d');
    }

    function get_currency(){
        return $this->db->get('tbl_fa_mas_cur')->result();
    }

    function get_accno_last_balance($accno){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                         'AccNo' => $accno
                      ])->row();

        return ($query ? $query->Balance : 0);
    }

    function get_emp_last_balance($branch, $id){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_fa_transaction', [
                            'Branch' => $branch,
                            'IDNumber' => $id
                      ])->row();

        return ($query ? $query->Balance : 0);
    }
    
    function get_branch_last_balance($branch, $accno, $transdate){
        //Get AccNo Type
        $acc_type = $this->db->select('Acc_Type')->get_where('tbl_fa_account_no', ['Acc_No' => $accno])->row()->Acc_Type;

        $query = $this->db->select('BalanceBranch')->limit(1)->order_by('EntryDate DESC, CtrlNo DESC');
        
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

    function delete_existed_docno($docno){
        $this->db->query(
            "DELETE t1, t2, t3
             FROM tbl_fa_treasury_mas AS t1
             LEFT JOIN tbl_fa_treasury_det AS t2
                 USING(DocNo)
             LEFT JOIN tbl_fa_transaction AS t3
                  USING(DocNo)
             WHERE t1.DocNo = '$docno'"
        );
    }

    function submit_treasury($master, $details, $trans, $branch, $cur_date){
        $this->db->trans_begin();
        
        $this->db->insert_batch('tbl_fa_treasury_mas', $master);
        $this->db->insert_batch('tbl_fa_treasury_det', $details);
        $this->db->insert_batch('tbl_fa_transaction', $trans);

        /**
         ** UPDATE RETAINING EARNING
         */
        $this->db->query(
            "DELETE FROM `tbl_fa_retaining_earning`
             WHERE Branch = ''
             OR Branch IS NULL"
        );

        $is_retaining_curmonth_exist = $this->db->query(
            "SELECT COUNT(Month) AS Total FROM tbl_fa_retaining_earning
             WHERE Branch = '$branch'
             AND Month = YEAR('$cur_date')
             AND Year = MONTH('$cur_date')"
        )->row()->Total;

        $year = date('Y', strtotime($cur_date));
        $month = date('m', strtotime($cur_date));

        if($is_retaining_curmonth_exist == 0){
            $this->db->query(
                "DELETE FROM `tbl_fa_retaining_earning`
                 WHERE Branch = ?
                 AND Year = ?
                 AND Month = ?"
            , [$branch, $year, $month]);

            $retaining = $this->db->query(
                "SELECT 
                    (
                        (
                            SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? AND MONTH(TransDate) = ?
                            AND AccType IN ('R', 'R1')
                        ) +
                        (
                            SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? AND MONTH(TransDate) = ?
                            AND AccType IN ('E', 'E1')
                        )
                    ) AS Retaining"
            ,[$branch, $year, $month, $branch, $year, $month])->row()->Retaining;

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
                        (
                            SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? AND MONTH(TransDate) = ?
                            AND AccType IN ('R', 'R1')
                        ) +
                        (
                            SELECT SUM(Amount) FROM tbl_fa_transaction
                            WHERE Branch = ?
                            AND YEAR(TransDate) = ? AND MONTH(TransDate) = ?
                            AND AccType IN ('E', 'E1')
                        )
                    ) AS Retaining"
            ,[$branch, $year, $month, $branch, $year, $month])->row()->Retaining;

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

        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    function calculate_balance($branch, $accno, $cur_date, $last_date){
        $start = $finish = '';

        if(strtotime($cur_date) < strtotime($last_date)){
            $start = $cur_date;
            $finish = $last_date;
        }else{
            $start = $last_date;
            $finish = $cur_date;
        }

        $this->db->trans_begin();
     
        $query = $this->db->query(
            "SELECT 
               trans.CtrlNo,
               trans.DocNo,
               acc.Acc_Name,
               trans.AccType,
               trans.TransDate, 
               trans.TransType, 
               trans.JournalGroup,
               trans.Branch,
               trans.Department,
               trans.CostCenter,
               trans.AccNo,
               trans.IDNumber,
               trans.Remarks,
               trans.Debit,
               trans.Credit, 
               trans.Currency,
               CASE
                    WHEN YEAR(trans.TransDate) < YEAR('$finish') AND trans.AccType IN('R','E') THEN
                        0
                    ELSE
                        (SELECT BalanceBranch
                          FROM tbl_fa_transaction 
                          WHERE AccNo = acc.Acc_No 
                          AND Branch = trans.Branch
                          AND TransDate < '$start'
                          ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
               END AS beg_balance,
               trans.Balance,
               trans.BalanceBranch,
               trans.EntryDate,
               trans.EntryBy
             FROM tbl_fa_transaction AS trans
             LEFT JOIN tbl_fa_account_no AS acc
               ON trans.AccNo = acc.Acc_No
             WHERE trans.Branch = '$branch'
             AND trans.AccNo IN ($accno)
             AND trans.TransDate BETWEEN '$start' AND '$finish'
             AND trans.PostedStatus = 1
             ORDER BY AccNo, Branch, TransDate, CtrlNo, DocNo ASC"
        )->result_array();

        if(empty($query)){
            $this->db->trans_complete();
            return ($this->db->trans_status() ? 'success' : $this->db->error());
        }

        $lastBalance = 0;
        if(!empty($query)){
            if($query[0]['beg_balance'] !== '' || is_null($query[0]['beg_balance']) == false){
                $lastBalance = (int)$query[0]['beg_balance'];
            }
        }
        
        for($i = 0; $i < count($query); $i++){
            
            $debit = (int)$query[$i]['Debit'];
            $credit = (int)$query[$i]['Credit'];

            /*
            * IF CURRENT INDEX'S YEAR NOT EQUAL TO PREVIOUS INDEX'S AND ACCTYPE EITHER 'R' OR 'E',
            * SET BEGINNING BALANCE TO 0  
            */ 
            if($i > 0 && date('Y', strtotime($query[$i-1]['TransDate'])) !== date('Y', strtotime($query[$i]['TransDate'])) && ($query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'E')){
                $lastBalance = 0;
            }
        
            if($debit > 0 && ($query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1')){
               $query[$i]['BalanceBranch'] = $debit + $lastBalance;
            }elseif($credit > 0 && ($query[$i]['AccType'] == 'A' || $query[$i]['AccType'] == 'E' || $query[$i]['AccType'] == 'E1')){
               $query[$i]['BalanceBranch'] = $lastBalance - $credit;
            }elseif($credit > 0 && ($query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2')){
               $query[$i]['BalanceBranch'] = $credit + $lastBalance;
            }elseif($debit > 0 && ($query[$i]['AccType'] == 'L' || $query[$i]['AccType'] == 'C' || $query[$i]['AccType'] == 'R' || $query[$i]['AccType'] == 'A1' || $query[$i]['AccType'] == 'R1' || $query[$i]['AccType'] == 'C1' || $query[$i]['AccType'] == 'C2')){
               $query[$i]['BalanceBranch'] = $lastBalance - $debit;
            }
        
            /*
            * IF NEXT INDEX ACCNO IS DIFFERENT THAN CURRENT INDEX'S,
            * SET THE `lastBalance` TO NEXT INDEX'S BEGINNING BALANCE
            */
            if($i+1 < count($query)){
                if($query[$i]['AccNo'] !== $query[$i+1]['AccNo'] || $query[$i]['Branch'] !== $query[$i+1]['Branch']){
                    if($query[$i]['beg_balance'] !== '' || is_null($query[$i]['beg_balance']) == false){
                        $lastBalance = (int)$query[$i]['beg_balance'];
                    }else{
                        $lastBalance = 0;
                    }
                }else{
                    $lastBalance = $query[$i]['BalanceBranch'];
                }
            }
        
            //REMOVE UNNECESSARY 'KEY' TO PREVENT UPDATE_BATCH FROM CRASHING
            unset($query[$i]['Acc_Name']);
            unset($query[$i]['beg_balance']);
        }
    
        $this->db->update_batch('tbl_fa_transaction', $query, 'CtrlNo');

        $is_retaining_curmonth_exist = $this->db->query(
            "SELECT COUNT(Month) AS Total FROM tbl_fa_retaining_earning
               WHERE Branch = '$branch'
               AND Month = YEAR('$cur_date')
               AND Year = MONTH('$cur_date')"
         )->row()->Total;
   
         $year = date('Y', strtotime($cur_date));
         $month = date('m', strtotime($cur_date));
   
         if($is_retaining_curmonth_exist > 0){
            $this->db->query("CALL retaining_earnings_update('$branch',$year,$month)");
         }else{
            $this->db->query("CALL retaining_earnings_insert('$branch',$year,$month)");
         }
        
        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    //GENERATE TREASURY REPORTS
    function get_treasury_report($type, $docno, $branch, $transdate){
        $query =  $this->db->query(
            "SELECT 
                mas.IDNumber,
                emp.FullName,
                emp.JobTitleDes AS Position,
                (SELECT Balance 
                 FROM tbl_fa_transaction
                 WHERE IDNumber = mas.IDNumber
                 ORDER BY TransDate DESC, CtrlNo DESC) AS Outstanding,
                trans.ItemNo,
                trans.DocNo,
                trans.AccNo,
                trans.JournalGroup,
                mas.Remarks AS DescMaster,
                trans.TransDate,
                trans.Giro,
                trans.Remarks AS DescDetail,
                trans.Department,
                trans.CostCenter,
                acc.Acc_Name,
                trans.Currency,
                trans.Rate,
                trans.Unit,
                trans.Amount
             FROM tbl_fa_transaction AS trans
             LEFT JOIN tbl_fa_account_no AS acc
                ON trans.AccNo = acc.Acc_No
             LEFT JOIN tbl_fa_treasury_mas AS mas
                USING(DocNo)
             LEFT JOIN tbl_fa_hr_append AS emp
                ON mas.IDNumber = emp.IDNumber
             WHERE trans.Docno = '$docno'
             AND trans.Branch = '$branch'
             AND trans.TransDate = '$transdate'
             AND trans.TransType = '$type'
             ORDER BY ItemNo ASC"
        )->result_array();
    }

    //CASH ADVANCE REPORT
    function get_ca_employees(){
        $query = $this->db->select('
            IDNumber,
            FullName
        ')->order_by('IDNumber ASC')->get_where('tbl_fa_hr_append')->result_array();

        return $query;
    }

    function get_ca_registered_ids($id){
        $query = $this->db->query(
            "SELECT
                emp.IDNumber,
                emp.FullName,
                emp.JobTitle,
                emp.JobTitleDes,
                emp.Supervisor,
                emp.SupervisorName,
                trans.DocNo,
                trans.TransDate,
                trans.Branch,
                trans.Department,
                trans.CostCenter,
                trans.Remarks,
                trans.AccNo,
                trans.AccType,
                trans.Debit,
                trans.Credit,
                trans.Balance
             FROM tbl_fa_hr_append AS emp
             LEFT JOIN tbl_fa_transaction AS trans
                ON emp.IDNumber = trans.IDNumber
            WHERE emp.IDNumber = ?
            ORDER BY trans.TransDate DESC, trans.CtrlNo DESC"
        , $id)->result_array();

        return $query;
    }
}