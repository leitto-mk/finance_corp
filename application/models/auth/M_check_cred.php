<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_check_cred extends CI_Model
{
    public function check_login($id)
    {
        $status = $this->db->query("SELECT status FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();

        if ($status->status == 'teacher' || $status->status == 'staff' || $status->status == 'admin') {
            $result = $this->db->query(
                "SELECT t1.IDNumber, t1.FirstName, t1.LastName, t1.status, t1.Photo, t2.password, t3.JobDesc, t3.Homeroom, t3.SubjectTeach, t3.StudyFocus FROM tbl_07_personal_bio AS t1 
                 INNER JOIN tbl_credentials AS t2 
                 ON t1.IDNumber = t2.IDNumber
                 INNER JOIN tbl_08_job_info t3
                 ON t1.IDNumber = t3.IDNumber
                 WHERE t1.IDNumber = '$id'"
            )->row();
        } elseif ($status->status == 'student') {
            $result = $this->db->query(
                "SELECT t1.IDNumber, t1.FirstName, t1.LastName, t1.status, t3.Kelas, t3.Ruangan, t1.Photo, t2.password FROM tbl_07_personal_bio AS t1 
                 INNER JOIN tbl_credentials AS t2 
                 ON t1.IDNumber = t2.IDNumber
                 INNER JOIN tbl_08_job_info_std t3
                 ON t1.IDNumber = t3.NIS
                 WHERE t1.IDNumber = '$id'"
            )->row();
        } else {
            $result = 'empty';
        }

        return $result;
    }
}
