<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_report extends CI_Model
{
    public function select($query) {
        $sql = $this->db->query($query);
        return $sql->result();
    }
    
    // public function insert($table, $data) {
    //     $this->db->insert($table, $data);
    // }

    function insert($table, $data) {
        $query = $this->db->insert($table, $data);
        // print_r($this->db->last_query());
        // die();
        if ($query) {
            # code...
            return true;
        }else{ 
            return false;
        }
    }
    
    public function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function delete($table, $where) {
        $this->db->where($where); 
        $this->db->delete($table);
    }

    function get_list_sch_by_school($schcode){
        $query = $this->db->query("SELECT ClassID, ClassDesc, ClassNumeric FROM tbl_03_class WHERE SchoolID = '$schcode' UNION SELECT ClassID, ClassDesc, ClassNumeric FROM tbl_03_b_class_vocational  WHERE SchoolID= '$schcode' ORDER BY ClassNumeric");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }

    function get_list_room_by_class($clscodesid){
        $query = $this->db->query("SELECT RoomID,RoomDesc FROM tbl_04_class_rooms WHERE ClassID = '$clscodesid' UNION SELECT RoomID,RoomDesc FROM tbl_04_class_rooms_vocational WHERE ClassID = '$clscodesid' ORDER BY RoomDesc ASC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }  
    }


    //Per ID
    function get_data_school($idschool){
        $query = $this->db->query("SELECT SchoolID,SchoolName,School_Desc FROM tbl_02_school WHERE SchoolID ='$idschool'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }        
    }

    function get_data_class($idclass){
        $query = $this->db->query("SELECT ClassID, ClassDesc, ClassNumeric FROM tbl_03_class WHERE ClassDesc = '$idclass' UNION SELECT ClassID, ClassDesc, ClassNumeric FROM tbl_03_b_class_vocational  WHERE ClassDesc= '$idclass' ORDER BY ClassNumeric");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }        
    }

    function get_data_report_student_by_room($idschool,$idclass,$idroom){
        
        $result = $this->db->query(
            "SELECT 
        school.SchoolName,
        class.ClassDesc,
        room.RoomDesc,
        prof.NIS,
        bio.FirstName,
        bio.MiddleName,
        bio.LastName,
        prof.Phone,
        prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_class AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms AS room
            ON class.ClassID = room.ClassID
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool' AND class.ClassDesc = '$idclass' AND room.RoomDesc = '$idroom'
        UNION ALL
        SELECT 
            school.SchoolName,
            class.ClassDesc,
            room.RoomDesc,
            prof.NIS,
            bio.FirstName,
            bio.MiddleName,
            bio.LastName,
            prof.Phone,
            prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_b_class_vocational AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms_vocational AS room
            ON class.ClassDesc = room.Simplified
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool' AND class.ClassDesc = '$idclass' AND room.RoomDesc = '$idroom'"
            );
       
        return $result->result();
    }


    //Class All
    function get_data_class_all(){
        $query = $this->db->query("SELECT SchoolID,ClassID, ClassDesc, ClassNumeric FROM tbl_03_class UNION SELECT SchoolID,ClassID, ClassDesc, ClassNumeric FROM tbl_03_b_class_vocational ORDER BY ClassNumeric");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }        
    }

    function get_data_report_student_by_class_all($idschool){
        
        $result = $this->db->query(
            "SELECT 
        school.SchoolID,
        school.SchoolName,
        class.ClassDesc,
        room.RoomDesc,
        prof.NIS,
        bio.FirstName,
        bio.MiddleName,
        bio.LastName,
        prof.Phone,
        prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_class AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms AS room
            ON class.ClassID = room.ClassID
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool'
        UNION ALL
        SELECT 
            school.SchoolID,
            school.SchoolName,
            class.ClassDesc,
            room.RoomDesc,
            prof.NIS,
            bio.FirstName,
            bio.MiddleName,
            bio.LastName,
            prof.Phone,
            prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_b_class_vocational AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms_vocational AS room
            ON class.ClassDesc = room.Simplified
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool'"
            );
       
        return $result->result();
    }


    //Room All
    function get_data_report_student_by_room_all($idschool,$idclass){
        
        $result = $this->db->query(
            "SELECT 
        school.SchoolID,
        school.SchoolName,
        class.ClassDesc,
        room.RoomDesc,
        prof.NIS,
        bio.FirstName,
        bio.MiddleName,
        bio.LastName,
        prof.Phone,
        prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_class AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms AS room
            ON class.ClassID = room.ClassID
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool' AND class.ClassDesc = '$idclass'
        UNION ALL
        SELECT 
            school.SchoolID,
            school.SchoolName,
            class.ClassDesc,
            room.RoomDesc,
            prof.NIS,
            bio.FirstName,
            bio.MiddleName,
            bio.LastName,
            prof.Phone,
            prof.HousePhone
        FROM tbl_02_school AS school
        JOIN tbl_03_b_class_vocational AS class
            ON school.SchoolID = class.SchoolID
        JOIN tbl_04_class_rooms_vocational AS room
            ON class.ClassDesc = room.Simplified
        JOIN tbl_08_job_info_std AS prof
            ON room.RoomDesc = prof.Ruangan
        LEFT JOIN tbl_07_personal_bio AS bio
            ON prof.NIS = bio.IDNumber
        WHERE school.SchoolID = '$idschool' AND class.ClassDesc = '$idclass'"
            );
       
        return $result->result();
    }

}
