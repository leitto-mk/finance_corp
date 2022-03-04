<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Mdl_corp_reports extends CI_Model {

   //* GENERAL LEDGER
   function get_branch(){
      return $this->db->select('BranchCode, BranchName')
                      ->get('abase_02_branch')
                      ->result();
   }

   function get_account_no(){
      return $this->db->select('Acc_No, Acc_Name')
                     ->order_by('Acc_No', 'ASC')
                     ->where_not_in('TransGroup',['H1','H2','H3'])
                     ->get_where('tbl_fa_account_no', [
                        'Acc_Type !=' => 'H'
                     ])   
                     ->result();
   }

   function get_last_trans_date(){
      $query = $this->db->select('TransDate')
                     ->group_by('TransDate')
                     ->order_by('TransDate','DESC')
                     ->limit(1)
                     ->get('tbl_fa_transaction')->row();

      return $query ? $query->TransDate : date('Y-m-d');
   }

   function get_general_ledger($branch, $accno_start, $accno_finish, $datestart, $datefinish){
  
      if($branch == 'All' || $branch == ''){
         $branch_condition = "Branch IS NOT NULL";
      }else{
         $branch_condition = "Branch = '$branch'";
      }

      $start = $finish = '';
      if(strtotime($datestart) < strtotime($datefinish)){
         $start = $datestart;
         $finish = $datefinish;
      }else{
         $start = $datefinish;
         $finish = $datestart;
      }

      $this->db->cache_on();

      //GET RESULT IN SELECTED DATE RANGE
      $ondate_selected_result = $this->db->query(
         "SELECT 
            company.ComCode,
            company.ComName,
            CONCAT(company.Address,', ',company.City,', ',company.Province,', ',company.PostalCode) AS Address,
            CONCAT(company.PhoneNo,'/',company.ContactNo) AS Contact,
            company.Email,
            trans.CtrlNo,
            trans.DocNo,
            acc.Acc_Name,
            acc.Acc_Type,
            trans.TransType, 
            trans.TransDate, 
            trans.Branch,
            trans.Department,
            trans.CostCenter,
            trans.AccNo,
            trans.Remarks,
            trans.Debit,
            trans.Credit, 
            trans.Currency,
            trans.Balance,
            CASE
               WHEN (SELECT YEAR(TransDate) 
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < ?
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR(?)
                  AND (trans.AccType = 'R' OR trans.AccType = 'E') THEN
                  0
               WHEN trans.AccType = 'C1' THEN
                  (SELECT
                     COALESCE(
                        (SELECT IFNULL(RetainingSum, 0) AS LastYearEarning
                        FROM tbl_fa_retaining_earning
                        WHERE $branch_condition
                        AND YEAR = YEAR(DATE_SUB(?, INTERVAL 1 YEAR))
                        ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                     ,0)
                     +
                     COALESCE(
                        (SELECT IFNULL((SUM(Credit)-SUM(Debit)),0) AS GeneralJournalRE
                        FROM tbl_fa_transaction
                        WHERE $branch_condition
                        AND YEAR(TransDate) <= YEAR(?)
                        AND TransDate <= ?
                        AND AccType IN ('C1'))
                     ,0)
                  )
               ELSE
                  (SELECT BalanceBranch
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < ?
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
            END AS beg_balance,
            CASE 
               WHEN trans.AccType = 'C1' THEN
                  (SELECT
                     COALESCE(
                        (SELECT IFNULL(RetainingSum, 0) AS LastYearEarning
                        FROM tbl_fa_retaining_earning
                        WHERE $branch_condition
                        AND YEAR = YEAR(DATE_SUB(?, INTERVAL 1 YEAR))
                        ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                     ,0)
                     +
                     COALESCE(
                        (SELECT IFNULL((SUM(Credit)-SUM(Debit)),0) AS GeneralJournalRE
                        FROM tbl_fa_transaction
                        WHERE $branch_condition
                        AND YEAR(TransDate) <= YEAR(?)
                        AND AccType IN ('C1'))
                     ,0)
                  )
               ELSE
                  trans.BalanceBranch
            END AS BalanceBranch,
            trans.EntryDate
         FROM tbl_fa_transaction AS trans
         LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
         LEFT JOIN abase_01_com AS company
            ON trans.Branch = company.ComCode
         WHERE trans.$branch_condition
         AND trans.TransDate BETWEEN ? AND ?
         AND trans.AccNo BETWEEN ? AND ?
         AND trans.PostedStatus = 1
         ORDER BY AccNo, Branch, TransDate, CtrlNo, DocNo ASC"
      ,[
         $start, $start, $start, $start, $start, $start, $start, $start, $start, $finish, $accno_start, $accno_finish
      ])->result_array();

      //GET RUNNING BALANCE OF EACH EXCLUDED ACCNO IN SELECTED DATE RANGE
      $other_accno_result = $this->db->query(
         "SELECT 
            company.ComCode,
            company.ComName,
            CONCAT(company.Address,', ',company.City,', ',company.Province,', ',company.PostalCode) AS Address,
            CONCAT(company.PhoneNo,'/',company.ContactNo) AS Contact,
            company.Email,
            trans.AccNo,
            acc.Acc_Name,
            acc.Acc_Type,
            trans.TransDate,
            trans.Branch,
            trans.Remarks,
            trans.DocNo,
            trans.TransType,
            trans.Department,
            trans.CostCenter,
            trans.Currency,
            trans.Debit,
            trans.Credit,
            trans.BalanceBranch,
            CASE
               WHEN (SELECT YEAR(TransDate) 
                     FROM tbl_fa_transaction 
                     WHERE AccNo = acc.Acc_No 
                     AND Branch = trans.Branch
                     AND TransDate < ?
                     ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1) < YEAR(?)
                  AND (trans.AccType = 'R' OR trans.AccType = 'E') THEN
                  0
               WHEN trans.AccType = 'C1' THEN
                  (SELECT
                     COALESCE(
                        (SELECT IFNULL(RetainingSum, 0) AS LastYearEarning
                        FROM tbl_fa_retaining_earning
                        WHERE $branch_condition
                        AND YEAR = YEAR(DATE_SUB(?, INTERVAL 1 YEAR))
                        ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                     ,0) 
                     +
                     COALESCE(
                        (SELECT IFNULL((SUM(Credit)-SUM(Debit)),0) AS GeneralJournalRE
                        FROM tbl_fa_transaction
                        WHERE $branch_condition
                        AND YEAR(TransDate) <= YEAR(?)
                        AND TransDate <= ?
                        AND AccType IN ('C1'))
                     ,0)
                  )
               ELSE
                  (SELECT BalanceBranch
                  FROM tbl_fa_transaction 
                  WHERE AccNo = acc.Acc_No 
                  AND Branch = trans.Branch
                  AND TransDate < ?
                  ORDER BY TransDate DESC, CtrlNo DESC LIMIT 1)
            END AS beg_balance
         FROM tbl_fa_transaction AS trans
         LEFT JOIN tbl_fa_account_no AS acc
            ON trans.AccNo = acc.Acc_No
         LEFT JOIN abase_01_com AS company
            ON trans.Branch = company.ComCode
         WHERE trans.$branch_condition
         AND AccNo NOT IN (
            SELECT AccNo 
            FROM tbl_fa_transaction 
            WHERE TransDate 
            BETWEEN ? AND ?
            GROUP BY AccNo
         )
         AND AccNo BETWEEN ? AND ?
         AND TransDate IN (
            SELECT MAX(TransDate) 
            FROM tbl_fa_transaction 
            WHERE AccNo = trans.AccNo
            AND TransDate < ?
         )
         ORDER BY trans.TransDate DESC, trans.CtrlNo DESC"
      ,[
         $start, $start, $start, $start, $start, $start, $start, $finish, $accno_start, $accno_finish, $start
      ])->result_array();

      $result = array_merge($ondate_selected_result, $other_accno_result);
      
      usort($result, function ($item, $compare){
         return $item['AccNo'] > $compare['AccNo'] ? 1 : -1;
      });

      return $result;
   }

   //* BALANCE SHEET
   function get_balance_sheet_report($branch, $year, $month){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      //? Get last day of selected `year` and ``month``
      $date = date('Y-m-t', strtotime("$year-$month-01"));

      $company = $this->db->select(
         "ComCode,
         ComName,
         CONCAT(Address,', ',City,', ',Province,', ',PostalCode) AS Address,
         CONCAT(PhoneNo,'/',ContactNo) AS Contact"
      )->get('abase_01_com')->row();

      $asset = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND $branch
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'A'
            GROUP BY acc.Acc_No
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      $liabilities = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(trans.BalanceBranch IS NOT NULL, trans.BalanceBranch, 0) AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND $branch
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type = 'L'
            GROUP BY acc.Acc_No
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      $capital = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               CASE
                  -- IF acc.Acc_No refers to `31201` (Current Earning - CX) OR `31202` (Retaining Earning - C1) --
                  -- THEN GET TOTAL FROM tbl_fa_retaining_earning --
                  -- ELSE, GET LAST `trans.BalanceBranch` --
                  WHEN acc.Acc_No = '31201' THEN
                     (SELECT
                        COALESCE(
                           (SELECT IFNULL(RetainingSum, 0) AS RetainingEarning
                           FROM tbl_fa_retaining_earning
                           WHERE $branch
                           AND Year = YEAR('$date')
                           AND Month <= MONTH('$date')
                           AND (Retaining IS NOT NULL OR RetainingSum IS NOT NULL)
                           ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                        ,0)
                     )
                  WHEN acc.Acc_No = '31202' THEN
                     (SELECT
                        COALESCE(
                           (SELECT IFNULL(RetainingSum, 0) AS LastYearEarning
                           FROM tbl_fa_retaining_earning
                           WHERE $branch
                           AND YEAR = YEAR(DATE_SUB('$date', INTERVAL 1 YEAR))
                           ORDER BY Month DESC, CtrlNo DESC LIMIT 1)
                        ,0)
                        +
                        COALESCE(
                           (SELECT IFNULL((SUM(Credit)-SUM(Debit)),0) AS GeneralJournalRE
                           FROM tbl_fa_transaction
                           WHERE $branch
                           AND YEAR(TransDate) <= YEAR('$date')
                           AND AccType IN ('C1'))
                        ,0)
                     )
                  WHEN  acc.TransGroup IN('H1','H2','H3') THEN
                     NULL
                  ELSE
                     IFNULL(trans.BalanceBranch, 0)
               END AS Amount
            FROM tbl_fa_account_no AS acc
            LEFT JOIN (
               SELECT Branch, AccNo, AccType, BalanceBranch, TransDate, EntryDate 
               FROM tbl_fa_transaction AS parent
               WHERE $branch
               AND TransDate <= CAST('$date' AS Date)
               AND TransDate = (
                  SELECT TransDate
                  FROM tbl_fa_transaction
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
               AND CtrlNo = (
                  SELECT CtrlNo
                  FROM tbl_fa_transaction 
                  WHERE AccNo = parent.AccNo 
                  AND TransDate <= CAST('$date' AS Date)
                  ORDER BY TransDate DESC, CtrlNo DESC
                  LIMIT 1
               )
            ) AS trans
               ON acc.Acc_No = trans.AccNo
            WHERE acc.Acc_Type IN ('C','CX', 'C1')
            GROUP BY acc.Acc_No
            ORDER BY acc.Acc_No ASC"
      )->result_array();

      return [$company, $asset, $liabilities, $capital];
   }

   //* INCOME STATEMENT
   function get_income_report($branch, $year, $month){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }

      $date = "$year-$month-" . date('d');
      
      $company = $this->db->select(
         "ComCode,
         ComName,
         CONCAT(Address,', ',City,', ',Province,', ',PostalCode) AS Address,
         CONCAT(PhoneNo,'/',ContactNo) AS Contact"
      )->get('abase_01_com')->row();

      $revenue = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 40000 AND 49999"
      )->result_array();

      $operational = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 50000 AND 59999"
      )->result_array();

      $other_rev = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 60000 AND 69999"
      )->result_array();

      $other_expense = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(mTrans.Balance IS NOT NULL, mTrans.Balance, 0) AS Monthly,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-$month-01' AS DATETIME) AND LAST_DAY('$year-$month-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mTrans
            ON acc.Acc_No = mTrans.AccNo
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$date')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 70000 AND 79999"
      )->result_array();

      return [$company, $revenue, $operational, $other_rev, $other_expense];
   }

   function get_columnar_report($branch, $year){
      if($branch){
         $branch = "Branch = '$branch'";
      }else{
         $branch = "Branch IS NOT NULL";
      }
      
      $company = $this->db->select(
         "ComCode,
         ComName,
         CONCAT(Address,', ',City,', ',Province,', ',PostalCode) AS Address,
         CONCAT(PhoneNo,'/',ContactNo) AS Contact"
      )->get('abase_01_com')->row();

      $query = "LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-01-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jan
               ON acc.Acc_No = jan.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-02-01' AS DATETIME) AND LAST_DAY('$year-02-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS feb
               ON acc.Acc_No = feb.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-03-01' AS DATETIME) AND LAST_DAY('$year-03-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS mar
               ON acc.Acc_No = mar.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-04-01' AS DATETIME) AND LAST_DAY('$year-04-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS apr
               ON acc.Acc_No = apr.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-05-01' AS DATETIME) AND LAST_DAY('$year-05-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS may
               ON acc.Acc_No = may.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-06-01' AS DATETIME) AND LAST_DAY('$year-06-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jun
               ON acc.Acc_No = jun.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-07-01' AS DATETIME) AND LAST_DAY('$year-07-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS jul
               ON acc.Acc_No = jul.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-08-01' AS DATETIME) AND LAST_DAY('$year-08-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS aug
               ON acc.Acc_No = aug.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-09-01' AS DATETIME) AND LAST_DAY('$year-09-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS sep
               ON acc.Acc_No = sep.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-10-01' AS DATETIME) AND LAST_DAY('$year-10-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS oct
               ON acc.Acc_No = oct.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-11-01' AS DATETIME) AND LAST_DAY('$year-11-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS nov
               ON acc.Acc_No = nov.AccNo
               LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-12-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS des
               ON acc.Acc_No = des.AccNo";

      $revenue = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-31')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 40000 AND 49999"
      )->result_array();

      $operational = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 50000 AND 59999"
      )->result_array();

      $other_rev = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 60000 AND 69999"
      )->result_array();

      $other_expense = $this->db->query(
         "SELECT
               acc.Acc_No,
               acc.Acc_Name,
               acc.Acc_Type,
               IF(jan.Balance IS NOT NULL, jan.Balance, 0) AS Jan,
               IF(feb.Balance IS NOT NULL, feb.Balance, 0) AS Feb,
               IF(mar.Balance IS NOT NULL, mar.Balance, 0) AS Mar,
               IF(apr.Balance IS NOT NULL, apr.Balance, 0) AS Apr,
               IF(may.Balance IS NOT NULL, may.Balance, 0) AS May,
               IF(jun.Balance IS NOT NULL, jun.Balance, 0) AS Jun,
               IF(jul.Balance IS NOT NULL, jul.Balance, 0) AS Jul,
               IF(aug.Balance IS NOT NULL, aug.Balance, 0) AS Aug,
               IF(sep.Balance IS NOT NULL, sep.Balance, 0) AS Sep,
               IF(oct.Balance IS NOT NULL, oct.Balance, 0) AS Oct,
               IF(nov.Balance IS NOT NULL, nov.Balance, 0) AS Nov,
               IF(des.Balance IS NOT NULL, des.Balance, 0) AS Des,
               IF(acc.TransGroup = '', NULL, acc.TransGroup) AS TransGroup,
               IF(yTrans.Balance IS NOT NULL, yTrans.Balance, 0) AS Yearly
         FROM tbl_fa_account_no AS acc
         $query
         LEFT JOIN (SELECT Branch, AccNo, AccType, SUM(Amount) AS Balance, TransDate, EntryDate 
                     FROM tbl_fa_transaction
                     WHERE TransDate BETWEEN CAST('$year-01-01' AS DATETIME) AND LAST_DAY('$year-12-01')
                     AND ItemNo != 0
                     AND $branch GROUP BY AccNo) AS yTrans
            ON acc.Acc_No = yTrans.AccNo
         WHERE acc.Acc_No BETWEEN 70000 AND 79999"
      )->result_array();

      return [$company, $revenue, $operational, $other_rev, $other_expense];
   }

   //* JOURNAL TRANSACTION
   function get_journal_transaction($branch, $transtype, $accno_start, $accno_finish, $date_start, $date_finish){
      $query = $this->db
               ->order_by('trans.TransDate ASC, trans.CtrlNo ASC')
               ->select("
                  DATE_FORMAT(trans.TransDate, '%d-%b-%y') AS TransDate,
                  trans.DocNo,
                  trans.TransType,
                  trans.Remarks,
                  trans.Department,
                  trans.CostCenter,
                  trans.AccNo,
                  acc.Acc_Name,
                  trans.Currency,
                  trans.Rate,
                  trans.Unit,
                  trans.Debit,
                  trans.Credit
               ")
               ->from('tbl_fa_transaction AS trans')
               ->join('tbl_fa_account_no AS acc', 'trans.AccNo = acc.Acc_No', 'LEFT')
               ->where([
                  'trans.Branch' => $branch,
                  // 'trans.AccNo >=' => $accno_start,
                  // 'trans.AccNo <=' => $accno_finish,
               ]);

      if(strtolower($transtype) !== 'all'){
         $query = $query->where('trans.TransType', $transtype);
      }

      $query = $query->get();


      if($this->db->error()['code'] != 0){
         $code = $this->db->error()['code'];
         $message = $this->db->error()['message'];
         log_message('error', "$code: $message");

         return [null, "Database Error"];
      }

      return [$query->result_array(), null];
   }
}           