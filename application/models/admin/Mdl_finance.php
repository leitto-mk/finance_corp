<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_finance extends CI_Model
{
    public function get_all_tuition($string)
    {
        $result = $this->db->query("SELECT TuitionCat, COUNT(TuitionCat) AS Total FROM tbl_12_finance_std WHERE TuitionCat = '$string'");

        return $result->row();
    }

    public function get_all_degrees()
    {
        $result = $this->db->query("SELECT School_Desc FROM tbl_02_school WHERE School_Desc != '-' ORDER BY CtrlNo ASC");

        return $result->result();
    }

    public function get_cat_tuition($degree, $cat)
    {
        $result = $this->db->get_where('tbl_meta_tuition', [
            'Level' => $degree,
            'Category' => $cat
        ])->row_array();

        return $result;
    }

    public function model_save_cat_tuition($degree, $cat, $newinput)
    {
        $this->db->update('tbl_meta_tuition', [
            'Tuition' => $newinput
        ], [
            'Level' => $degree,
            'Category' => $cat
        ]);
    }

    public function model_get_fnc_data_by_id($selected)
    {
        $query = $this->db->query(
            "SELECT t4.NIS, CONCAT(FirstName,' ',LastName) AS FullName, t1.School_Desc as Degree, t4.Kelas, t4.Ruangan
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             JOIN tbl_08_job_info_std t4
             ON t4.Ruangan = t3.RoomDesc
             JOIN tbl_07_personal_bio t5
             ON t5.IDNumber = t4.NIS
             WHERE t4.NIS LIKE '$selected%'
             ORDER BY t4.NIS ASC"
        );

        return $query;
    }

    public function model_get_fnc_data_by_name($selected)
    {
        $query = $this->db->query(
            "SELECT t4.NIS, CONCAT(FirstName,' ',LastName) AS FullName, t1.School_Desc as Degree, t4.Kelas, t4.Ruangan
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             JOIN tbl_08_job_info_std t4
             ON t4.Ruangan = t3.RoomDesc
             JOIN tbl_07_personal_bio t5
             ON t5.IDNumber = t4.NIS
             WHERE t5.FirstName LIKE '$selected%'
             OR t5.LastName LIKE '$selected%'
             ORDER BY t4.NIS ASC"
        );

        return $query;
    }

    public function model_get_fnc_data_by_degree($selected)
    {
        $query = $this->db->query(
            "SELECT t4.NIS, CONCAT(FirstName,' ',LastName) AS FullName, t1.School_Desc as Degree, t4.Kelas, t4.Ruangan
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             JOIN tbl_08_job_info_std t4
             ON t4.Ruangan = t3.RoomDesc
             JOIN tbl_07_personal_bio t5
             ON t5.IDNumber = t4.NIS
             WHERE t1.School_Desc = '$selected'
             ORDER BY t4.NIS ASC"
        );

        return $query;
    }

    public function model_get_fnc_classes($selected)
    {
        $query = $this->db->query(
            "SELECT t1.School_Desc, t2.ClassDesc FROM tbl_02_school t1 
             JOIN tbl_03_class t2 
             ON t1.SchoolID = t2.SchoolID 
             WHERE t1.School_Desc = '$selected'"
        );

        return $query;
    }

    public function model_get_fnc_data_by_class($selected)
    {
        $query = $this->db->query(
            "SELECT t4.NIS, CONCAT(FirstName,' ',LastName) AS FullName, t1.School_Desc as Degree, t4.Kelas, t4.Ruangan
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             JOIN tbl_08_job_info_std t4
             ON t4.Ruangan = t3.RoomDesc
             JOIN tbl_07_personal_bio t5
             ON t5.IDNumber = t4.NIS
             WHERE t4.Kelas = '$selected'
             ORDER BY t4.NIS ASC"
        );

        return $query;
    }

    public function model_get_fnc_rooms($selected)
    {
        $query = $this->db->query(
            "SELECT t1.School_Desc, t2.ClassDesc, t3.RoomDesc FROM tbl_02_school t1 
             JOIN tbl_03_class t2 
             ON t1.SchoolID = t2.SchoolID 
             JOIN tbl_04_class_rooms t3
             ON t2.ClassID = t3.ClassID
             WHERE t2.ClassDesc = '$selected'"
        );

        return $query;
    }

    public function model_get_fnc_data_by_rooms($selected)
    {
        $query = $this->db->query(
            "SELECT t4.NIS, CONCAT(FirstName,' ',LastName) AS FullName, t1.School_Desc as Degree, t4.Kelas, t4.Ruangan
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             JOIN tbl_08_job_info_std t4
             ON t4.Ruangan = t3.RoomDesc
             JOIN tbl_07_personal_bio t5
             ON t5.IDNumber = t4.NIS
             WHERE t4.Ruangan = '$selected'
             ORDER BY t4.NIS ASC"
        );

        return $query;
    }
}
