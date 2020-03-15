<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_enroll extends CI_Model
{
    public function model_insert_enrolled($data)
    {
        $this->db->insert('tbl_11_enrollment', $data);
    }

    public function model_get_dropdown_apply($apply)
    {
        $room = $apply . 'C1';

        $query = $this->db->query("SELECT RoomDesc FROM tbl_04_class_rooms WHERE ClassID LIKE '$room%'");

        return $query->result();
    }

    public function set_approve($data)
    {
        extract($data);

        $result = $this->db->query("SELECT * FROM tbl_11_enrollment WHERE CtrlNo = '$uniq'")->row_array();

        $transfer_bio = [
            'IDNumber' => 'NEW_STD',
            'PersonalID' => $result['NIK'],
            'FirstName' => $result['FirstName'],
            'MiddleName' => $result['MiddleName'],
            'LastName' => $result['LastName'],
            'NickName' => $result['NickName'],
            'status' => 'student',
            'Gender' => $result['Gender'],
            'DateofBirth' => $result['DateofBirth'],
            'PointofBirth' => $result['PointofBirth'],
            'KK' => $result['KK'],
            'BirthCertificate' => $result['BirthCertificate'],
            'Religion' => $result['Religion'],
            'Height' => $result['Height'],
            'Weight' => $result['Weight'],
            'HeadDiameter' => $result['HeadDiameter'],
            'Disability' => $result['Disability'],
            'Address' => $result['Address'],
            'RT' => $result['RT'],
            'RW' => $result['RW'],
            'Dusun' => $result['Dusun'],
            'Village' => $result['Village'],
            'District' => $result['District'],
            'Region' => $result['Region'],
            'Postal' => $result['Postal'],
            'Country' => $result['Country'],
            'Photo' => 'default.png',
            'RegDate' => date('Y-m-d')
        ];

        $class = $this->db->query(
            "SELECT t1.ClassDesc AS Class, t2.RoomDesc FROM tbl_03_class t1
             JOIN tbl_04_class_rooms t2
             ON t1.ClassID = t2.ClassID
             WHERE t2.RoomDesc = '$room'"
        )->row_array();

        $transfer_info = [
            'NIS' => $newID,
            'NISN' => $result['NISN'],
            'Kelas' => $class['Class'],
            'Ruangan' => $room,
            'HousePhone' => $result['HousePhone'],
            'Phone' => $result['Phone'],
            'Email' => $result['Email'],
            'LiveWith' => $result['LiveWith'],
            'AnakKe' => $result['Child'],
            'Saudara' => $result['Siblings'],
            'Father' => $result['Father'],
            'FatherNIK' => $result['FatherNIK'],
            'FatherBorn' => $result['FatherBorn'],
            'FatherDegree' => $result['FatherDegree'],
            'FatherJob' => $result['FatherJob'],
            'FatherIncome' => $result['FatherIncome'],
            'FatherDisability' => $result['FatherDisability'],
            'Mother' => $result['Mother'],
            'MotherNIK' => $result['MotherNIK'],
            'MotherBorn' => $result['MotherBorn'],
            'MotherDegree' => $result['MotherDegree'],
            'MotherJob' => $result['MotherJob'],
            'MotherIncome' => $result['MotherIncome'],
            'MotherDisability' => $result['MotherDisability'],
            'Guardian' => $result['Guardian'],
            'GuardianNIK' => $result['GuardianNIK'],
            'GuardianBorn' => $result['GuardianBorn'],
            'GuardianDegree' => $result['GuardianDegree'],
            'GuardianJob' => $result['GuardianJob'],
            'GuardianIncome' => $result['GuardianIncome'],
            'GuardianDisability' => $result['GuardianDisability'],
            'Transportation' => $result['Transportation'],
            'Range' => $result['Range'],
            'ExactRange' => $result['ExactRange'],
            'TimeRange' => $result['TimeRange'],
            'Latitude' => $result['Latitude'],
            'Longitude' => $result['Longitude'],
            'KIP' => $result['KIP'],
            'Stayed_KIP' => $result['Stayed_KIP'],
            'Refuse_PIP' => $result['Refuse_PIP'],
            'Achievement' => $result['Achievement'],
            'AchievementLVL' => $result['AchievementLVL'],
            'AchievementYear' => $result['AchievementYear'],
            'AchievementYear' => $result['AchievementYear'],
            'Sponsor' => $result['Sponsor'],
            'AchievementRank' => $result['AchievementRank'],
            'Scholarship' => $result['Scholarship'],
            'ScholarDesc' => $result['ScholarDesc'],
            'ScholarStart' => $result['ScholarStart'],
            'ScholarFinish' => $result['ScholarFinish'],
            'Prosperity' => $result['Prosperity'],
            'ProsperNumber' => $result['ProsperNumber'],
            'ProsperNameTag' => $result['ProsperNameTag'],
            'Competition' => $result['Competition'],
            'Registration' => $result['Registration'],
            'SchoolStarts' => $result['SchoolStarts'],
            'PreviousSchool' => $result['PreviousSchool'],
            'UNnumber' => $result['UNNumber'],
            'Diploma' => $result['Diploma'],
            'SKHUN' => $result['SKHUN'],
        ];

        $credentials = [
            'IDNumber' => $newID,
            'status' => 'student',
            'password' => md5('123456')
        ];

        $this->db->trans_begin();
        $this->db->insert('tbl_07_personal_bio', $transfer_bio);
        $this->db->insert('tbl_08_job_info_std', $transfer_info);
        $this->db->insert('tbl_credentials', $credentials);
        $this->db->delete('tbl_11_enrollment', "CtrlNo = '$uniq'");
        $this->db->trans_commit();
    }

    public function count_total()
    {
        $result = $this->db->count_all_results('tbl_11_enrollment');

        return $result;
    }

    public function get_enrollment($start, $rows)
    {
        $result = $this->db->query("SELECT * FROM tbl_11_enrollment LIMIT $start, $rows");

        return $result;
    }

    public function model_student_details($ctrlno)
    {
        return $this->db->get_where('tbl_11_enrollment', [
            'CtrlNo' => $ctrlno
        ])->row();
    }
}
