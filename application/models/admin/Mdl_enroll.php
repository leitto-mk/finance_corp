<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_enroll extends CI_Model
{
    public function model_insert_enrolled($data)
    {
        //Reset Auto_Inc Numbers
        $total = $this->db->get('tbl_11_enrollment')->num_rows();

        if($total > 999){
            $this->db->query("ALTER TABLE tbl_11_enrollment AUTO_INCREMENT = '$total+1'");
        }
        
        //Insert Data
        $this->db->insert('tbl_11_enrollment', $data);
    }

    public function model_get_dropdown_apply($apply, $email)
    {
        $room = $apply . 'C1';

        $regis_type = $this->db->select('Registration')->get_where('tbl_11_enrollment', ['Email' => $email])->row()->Registration;

        if($regis_type == 'New'){
            $query = $this->db->query(
                "SELECT 
                    RoomDesc 
                 FROM tbl_04_class_rooms 
                 WHERE ClassID LIKE '$room%'
                 UNION ALL
                 SELECT 
                    RoomDesc
                 FROM tbl_04_class_rooms_vocational
                 WHERE ClassID LIKE '$room%'"
            );
        }elseif($regis_type == 'Transfer'){
            $query = $this->db->query(
                "SELECT 
                    RoomDesc 
                 FROM tbl_04_class_rooms
                 UNION ALL
                 SELECT 
                    RoomDesc
                 FROM tbl_04_class_rooms_vocational"
            );
        }

        return $query->result();
    }

    public function set_evaluation($id, $data){
        $this->db->update('tbl_11_enrollment', $data, ['CtrlNo' => $id]);

        if($data['is_approved_diploma'] == 1 && $data['is_approved_birthcert'] == 1 && $data['is_approved_kk'] == 1 && $data['is_approved_photo'] == 1 && $data['is_approved_spp'] == 1){
            $this->db->update('tbl_11_enrollment', ['is_approved' => 1], ['CtrlNo' => $id]);
        }

        return ($this->db->affected_rows() ? 'success' : $this->db->error());
    }

    public function set_approve($data)
    {
        extract($data);

        $result = $this->db->query("SELECT * FROM tbl_11_enrollment WHERE CtrlNo = '$uniq'")->row_array();

        $applying = '';

        if($result['Applying'] == 'SD'){
            $applying = '01';
        }elseif($result['Applying'] == 'SMP'){
            $applying = '02';
        }elseif($result['Applying'] == 'SMA'){
            $applying = '03';
        }elseif($result['Applying'] == 'SMK'){
            $applying = '04';
        }

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = '02';
        } else {
            $semester = '01';
        }

        //COUNT ACTIVATED STUDENTS OF THE CURRENT ENROLLMENT BATCH
        $checkAppliants = $this->db->like('IDNumber', $applying . date('y') . $semester, 'after')->get('tbl_07_personal_bio')->num_rows();

        if($checkAppliants == 0){
            //ID = School Code + Last Two Digit of Cur. Year + Cur. Semester + Cur. New Student Index
            $ID = $applying . date('y') . $semester . '001';
        }else{
            //ID = School Code + Last Two Digit of Cur. Year + Cur. Semester + Cur. New Student Index
            $ID = $applying . date('y') . $semester . str_pad(($checkAppliants+1),3,"0", STR_PAD_LEFT);
        }

        $transfer_bio = [
            'IDNumber' => $ID,
            'isActive' => 1,
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
            'DiplomaFile' => $result['DiplomaFile'],
            'BirthcertFile' => $result['BirthcertFile'],
            'KKFile' => $result['KKFile'],
            'Photo' => $result['Photo'],
            'SPP' => $result['SPP'],
            'RegDate' => date('Y-m-d')
        ];

        $class = $this->db->query(
            "SELECT t1.ClassDesc AS Class, t2.RoomDesc FROM tbl_03_class t1
             JOIN tbl_04_class_rooms t2
             ON t1.ClassID = t2.ClassID
             WHERE t2.RoomDesc = '$room'
             UNION ALL
             SELECT t1.ClassDesc AS Class, t2.RoomDesc FROM tbl_03_b_class_vocational t1
             JOIN tbl_04_class_rooms_vocational t2
             ON t1.ClassDesc = t2.Simplified
             WHERE t2.RoomDesc = '$room'"
        )->row_array();

        $transfer_info = [
            'NIS' => $ID,
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
            'Scholardesc' => $result['Scholardesc'],
            'Scholarstart' => $result['Scholarstart'],
            'Scholarfinish' => $result['Scholarfinish'],
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
            'IDNumber' => $ID,
            'status' => 'student',
            'password' => md5('123456')
        ];

        $this->db->trans_begin();

        //MOVE ENROLLMENT DATA TO ACTIVE STUDENTS TABLE AND RESET CREDENTIALS
        $this->db->insert('tbl_07_personal_bio', $transfer_bio);
        $this->db->insert('tbl_08_job_info_std', $transfer_info);
        $this->db->insert('tbl_credentials', $credentials);
        $this->db->update('tbl_credentials', $credentials, ['IDNumber' => $result['Email']]);

        $this->db->delete('tbl_11_enrollment', "CtrlNo = '$uniq'");

        //CHECK FOR EMPTY TABLE AND RESET AUTO_INCREMENT TO 1 IF EMPTY
        $checkEmpty = $this->db->get('tbl_11_enrollment')->num_rows();

        if($checkEmpty == 0){
            $this->db->query("ALTER TABLE tbl_11_enrollment AUTO_INCREMENT = 1");
        }
        
        $this->db->trans_commit();
        
        if($this->db->trans_status()){
            //GET SCHOOL NAME
            $school = $this->db->select('SchoolName')
                           ->get_where('tbl_02_school', ['School_Desc' => $result['Applying']])
                           ->row()->SchoolName;

            //RETURN SUCCESS
            return [$ID, $result['Email'], $school];
        }
    }

    public function remove_list($uniq){
        //GET NECESSARY DATA FOR DELETION
        $data = $this->db->select('Email, DiplomaFile, BirthcertFile, KKFile, Photo, SPP')->get_where('tbl_11_enrollment', [
            'CtrlNo' => $uniq,
        ])->row();

        $this->db->delete('tbl_11_enrollment', "CtrlNo = '$uniq'");
        $this->db->delete('tbl_credentials', ['IDNumber' => $data->Email]);
        
        if (is_file('./assets/photos/student/' . $data->DiplomaFile)) {
            unlink('./assets/photos/student/' . $data->DiplomaFile);
        }
        
        if (is_file('./assets/photos/student/' . $data->BirthcertFile)) {
            unlink('./assets/photos/student/' . $data->BirthcertFile);
        }
        
        if (is_file('./assets/photos/student/' . $data->KKFile)) {
            unlink('./assets/photos/student/' . $data->KKFile);
        }
        
        if (is_file('./assets/photos/student/' . $data->Photo)) {
            unlink('./assets/photos/student/' . $data->Photo);
        }
        
        if (is_file('./assets/photos/student/' . $data->SPP)) {
            unlink('./assets/photos/student/' . $data->SPP);
        }

        //CHECK FOR EMPTY TABLE AND RESET AUTO_INCREMENT TO 1 IF EMPTY
        $checkEmpty = $this->db->get('tbl_11_enrollment')->num_rows();

        if($checkEmpty == 0){
            $this->db->query("ALTER TABLE tbl_11_enrollment AUTO_INCREMENT = 1");
        }
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
