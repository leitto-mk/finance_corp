<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_corp_common extends CI_Model
{
    public function calculate_retaining_earnings($branch, $date){
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