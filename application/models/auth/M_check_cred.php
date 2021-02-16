<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_check_cred extends CI_Model
{
    public function check_login($id)
    {
        $result;
        $status = $this->db->query("SELECT status FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();

        if($status){
            if ($status->status == 'board' || $status->status == 'teacher' || $status->status == 'staff' || $status->status == 'admin') {
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
                    // "SELECT t1.IDNumber, t1.FirstName, t1.LastName, t1.status, t3.Kelas, t3.Ruangan, t1.Photo, t2.password FROM tbl_07_personal_bio AS t1 
                    //  INNER JOIN tbl_credentials AS t2 
                    //  ON t1.IDNumber = t2.IDNumber
                    //  INNER JOIN tbl_08_job_info_std t3
                    //  ON t1.IDNumber = t3.NIS
                    //  WHERE t1.IDNumber = '$id'"
                     "SELECT 
                        bio.IDNumber, 
                        bio.FirstName, 
                        bio.LastName, 
                        bio.status, 
                        info.Kelas, 
                        info.Ruangan, 
                        school.SchoolID,
                        bio.Photo, 
                        cred.password 
                     FROM tbl_07_personal_bio AS bio 
                     INNER JOIN tbl_credentials AS cred 
                     ON bio.IDNumber = cred.IDNumber
                     INNER JOIN tbl_08_job_info_std AS info
                     ON bio.IDNumber = info.NIS
                     INNER JOIN tbl_03_class AS class
                     ON info.Kelas = class.ClassDesc
                     INNER JOIN tbl_02_school AS school
                     ON school.SchoolID = class.SchoolID
                     WHERE bio.IDNumber = '$id'
                     UNION ALL
                     SELECT 
                        bio.IDNumber, 
                        bio.FirstName, 
                        bio.LastName, 
                        bio.status, 
                        info.Kelas, 
                        info.Ruangan, 
                        school.SchoolID,
                        bio.Photo, 
                        cred.password 
                     FROM tbl_07_personal_bio AS bio 
                     INNER JOIN tbl_credentials AS cred 
                     ON bio.IDNumber = cred.IDNumber
                     INNER JOIN tbl_08_job_info_std AS info
                     ON bio.IDNumber = info.NIS
                     INNER JOIN tbl_03_b_class_vocational AS class_voc
                     ON info.Kelas = class_voc.ClassDesc
                     INNER JOIN tbl_02_school AS school
                     ON school.SchoolID = class_voc.SchoolID
                     WHERE bio.IDNumber = '$id'"
                )->row();
    
                // print_r($this->db->last_query());
                // die();
            }    
        }else{
            $new_student = $this->db->query(
                "SELECT 
                    t1.CtrlNo,
                    t2.IDNumber,
                    t1.is_enrolled,
                    t1.FirstName,
                    t1.LastName,
                    t1.DateofBirth,
                    t1.Applying,
                    t1.SchoolApplied,
                    t1.status,
                    t2.password
                 FROM tbl_11_enrollment t1
                 INNER JOIN tbl_credentials t2
                 ON t1.Email = t2.IDNumber
                 WHERE t1.Email = '$id'"
            )->row();

            $result = $new_student;
        }

        return $result;
    }
}
