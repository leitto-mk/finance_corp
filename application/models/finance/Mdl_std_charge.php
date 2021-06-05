<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_std_charge extends CI_Model
{
    public function get_charge_overview(){
        return $this->db->query(
            "SELECT 
                t1.AccGroupReg,
                t1.NIS,
                t1.FullName,
                t1.Room,
                (SELECT SUM(Amount) 
                 FROM tbl_12_fin_std_charge_det WHERE NIS = t1.NIS) AS Amount,
                (SELECT SUM(Debit) 
                 FROM tbl_12_fin_transaction WHERE NIS = t1.NIS) AS Paid,
                t3.IDNumber AS HomeroomID,
                CONCAT(t3.FirstName, ' ', t3.LastName) AS Homeroom
             FROM tbl_12_fin_std_charge_det AS t1
             LEFT JOIN tbl_08_job_info AS t2
                ON t1.Room = t2.Homeroom
             LEFT JOIN tbl_07_personal_bio AS t3
                ON t2.IDNumber = t3.IDNumber
             LEFT JOIN tbl_04_class_rooms AS t4
                ON t1.Room = t4.RoomDesc
             LEFT JOIN tbl_04_class_rooms_vocational AS t4v
                ON t1.Room = t4v.RoomDesc
             LEFT JOIN tbl_03_class AS t5
                ON t4.ClassID = t5.ClassID
             LEFT JOIN tbl_03_class AS t5v
                ON t4v.ClassID = t5v.ClassID
             GROUP BY t1.NIS
             ORDER BY t5.ClassNumeric, t5v.ClassNumeric, t1.Room, t1.FullName, t1.MonthCharge"
        )->result_array();
    }

    public function get_mas_acc(){
        return $this->db
                ->select('Acc_No, Acc_Name, Acc_Type')
                ->order_by('Acc_Name', 'ASC')
                ->get('tbl_12_fin_account_no')->result();
    }

    public function get_mas_acc_charge_type(){
        return $this->db
                ->select('Acc_No, Acc_Name, Acc_Type')
                ->order_by('Acc_No', 'ASC')
                ->get_where('tbl_12_fin_account_no', [
                    'Acc_Type' => 'R',
                    'Acc_No <=' => '41106',
                ])->result();
    }

    public function get_school(){
        return $this->db
                ->select('SchoolID, SchoolName, DegreeName, School_Desc')
                ->order_by('SchoolName', 'ASC')
                ->get_where('tbl_02_school', [
                    'isActive' => 1,
                ])->result();
    }

    public function get_cls($sch){
        $condition = '';

        if($sch){
            $condition = "AND t1.School_Desc = '$sch'";
        }else{
            $condition = "AND t1.School_Desc IS NOT NULL";
        }

        return $this->db->query(
            "SELECT t2.ClassDesc, t2.ClassNumeric FROM tbl_02_school t1 
             LEFT JOIN tbl_03_class t2
             ON t1.School_Desc = t2.Type
             RIGHT JOIN tbl_04_class_rooms
             USING(ClassID)
             WHERE t2.ClassDesc != '-'
             AND t1.isActive = 1
             $condition
             GROUP BY ClassDesc
             UNION ALL
             SELECT class.ClassDesc, class.ClassNumeric FROM tbl_02_school t1
             LEFT JOIN tbl_03_b_class_vocational AS class
             ON t1.School_Desc = class.Type
             RIGHT JOIN tbl_04_class_rooms_vocational AS room
                ON class.ClassDesc = room.Simplified
             WHERE t1.isActive = 1
             $condition
             GROUP BY ClassDesc
             ORDER BY ClassNumeric"
        )->result();
    }

    public function get_room($cls){
        $condition = '';

        if($cls){
            $condition = "WHERE t1.ClassDesc = '$cls'";
        }else{
            $condition = "WHERE t1.ClassDesc IS NOT NULL";
        }

        return $this->db->query(
            "SELECT t1.ClassDesc, t1.ClassNumeric, t2.RoomDesc 
             FROM tbl_03_class AS t1
             LEFT JOIN tbl_04_class_rooms AS t2
                ON t2.ClassID = t1.ClassID
             LEFT JOIN tbl_02_school AS t3
                ON t2.Type = t3.School_Desc
             $condition
             AND t3.isActive = 1
             UNION ALL
             SELECT t1.ClassDesc, t1.ClassNumeric, t2.RoomDesc
             FROM tbl_03_b_class_vocational t1
             LEFT JOIN tbl_04_class_rooms_vocational t2
                ON t1.ClassDesc = t2.Simplified
             LEFT JOIN tbl_02_school AS t3
                ON t2.Type = t3.School_Desc
             $condition
             AND t3.isActive = 1
             AND t2.RoomDesc IS NOT NULL
             ORDER BY ClassNumeric, ClassDesc, RoomDesc"
        )->result();
    }

    public function get_std($sch, $cls, $room){
        $cls_condition = $room_condition = '';

        if($cls){
            $cls_condition = "AND info.Kelas = '$cls'";
        }else{
            $cls_condition = "AND info.Kelas IS NOT NULL";
        }

        if($room){
            $room_condition = "AND info.Ruangan = '$room'";
        }else{
            $room_condition = "AND info.Ruangan IS NOT NULL";
        }

        return $this->db->query(
            "SELECT 
                bio.IDNumber, 
                CONCAT(bio.FirstName,' ', bio.LastName) AS FullName,
                info.Ruangan
             FROM tbl_02_school AS sch
             LEFT JOIN tbl_03_class AS cls
                ON sch.SchoolID = cls.SchoolID
             LEFT JOIN tbl_03_b_class_vocational AS cls_v
                ON sch.SchoolID = cls_v.SchoolID
             LEFT JOIN tbl_04_class_rooms AS room
                ON cls.ClassID = room.ClassID
             LEFT JOIN tbl_04_class_rooms_vocational AS room_v
                ON cls_v.ClassID = room_v.ClassID
             LEFT JOIN tbl_08_job_info_std AS info
                ON info.Kelas = cls.ClassDesc OR info.Kelas = cls_v.ClassDesc OR info.Ruangan = room.RoomDesc OR info.Ruangan = room_v.RoomDesc
             RIGHT JOIN tbl_07_personal_bio AS bio
                ON info.NIS = bio.IDNumber
             WHERE School_Desc = '$sch'
             $cls_condition
             $room_condition
             AND bio.isActive = 1
             AND status = 'student'
             GROUP BY bio.IDNumber
             ORDER BY FullName"
        )->result();
    }

    public function get_charge_type_matrix($charge, $std){
        return $this->db->select('IDNumber, Amount')
                           ->where_in('IDNumber', $std)
                           ->get_where('tbl_12_fin_matrix', [
                               'accno_type' => $charge
                           ])->result();
    }

    public function get_std_last_balance($nis){
        $query = $this->db->select('Balance')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_12_fin_transaction', [
                         'IDNumber' => $nis
                      ])->row();

        return ($query ? $query->Balance : 0);
    }

    public function get_branch_balance($branch){
        $query = $this->db->select('BalanceBranch')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get_where('tbl_12_fin_transaction', [
                         'Branch' => $branch
                      ])->row();

        return ($query ? $query->BalanceBranch : 0);
    }

    public function get_gl_balance(){
        $query = $this->db->select('BalanceGL')
                      ->limit(1)
                      ->order_by('CtrlNo', 'DESC')
                      ->get('tbl_12_fin_transaction')->row();

        return ($query ? $query->BalanceGL : 0);
    }

    public function submit_std_charge($master, $details, $trans){
        $this->db->trans_begin();
        
        $this->db->insert('tbl_12_fin_std_charge_mas', $master);
        $this->db->insert_batch('tbl_12_fin_std_charge_det', $details);
        $this->db->insert_batch('tbl_12_fin_transaction', $trans);
        
        $this->db->trans_complete();
        
        return ($this->db->trans_status() ? 'success' : this->db->error());
    }
}
