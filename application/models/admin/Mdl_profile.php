<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_profile extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // ========================================================================================================================= \\
    // ==============================                     MODEL PROFILE ADMINISTRATOR             ============================== \\
    // ========================================================================================================================= \\
    public function get_full_info($id)
    {
        $dat = $this->db->query(
            "SELECT * FROM tbl_07_personal_bio AS t1
             INNER JOIN tbl_08_job_info AS t2
             ON t1.IDNumber = t2.IDNumber
             WHERE t1.IDNumber = '$id'
             ORDER BY t1.IDNumber"
        );

        if ($dat->num_rows() > 0) {
            return $dat->row();
        } else {
            return null;
        }
    }

    public function count_specific($status)
    {
        $this->db->from('tbl_07_personal_bio');
        $this->db->where('status', $status);
        $result = $this->db->count_all_results();

        return $result;
    }

    public function get_pass($id)
    {
        $result = $this->db->query("SELECT password from tbl_credentials where IDNumber = '$id'")->row();

        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }

    // ================================================================================================================================= \\
    // ==============================                     MODEL PROFILE TEACHER / STAFF                   ============================== \\
    // ================================================================================================================================= \\
    public function get_teachers($tch)
    {
        $dat = $this->db->query(
            "SELECT t1.IDNumber, CONCAT(t1.FirstName,' ',t1.LastName,', ',t2.StudyFocus) AS Fullname, t1.Gender, t1.DateofBirth , t2.Occupation, t2.JobDesc , t2.Honorer, t2.Emp_Type, t2.Homeroom, t2.SubjectTeach 
             FROM tbl_07_personal_bio AS t1
             INNER JOIN tbl_08_job_info AS t2
             ON t1.IDNumber = t2.IDNumber
             WHERE status = '$tch' OR status = 'staff'
             ORDER BY t1.status ASC, t1.IDNumber ASC"
        );

        if ($dat->num_rows() > 0) {
            return $dat->result();
        } else {
            return null;
        }
    }

    public function get_classrooms()
    {
        $query = $this->db->query(
            "SELECT t3.RoomDesc 
             FROM tbl_02_school t1
             JOIN tbl_03_class t2
                ON t1.SchoolID = t2.SchoolID
             JOIN tbl_04_class_rooms t3
                ON t2.ClassId = t3.ClassID
             WHERE t1.isActive = '1'
             UNION ALL
             SELECT RoomDesc
             FROM tbl_04_class_rooms_vocational
             ORDER BY RoomDesc"
        );

        return $query->result();
    }

    //Dropdown Menu of Subject for New Teacher Form
    public function get_dropdown_subject()
    {
        $query = $this->db->query("SELECT SubjName FROM tbl_05_subject WHERE SubjName NOT IN('EXCUL', 'ELECTIVE', '-','','None', '0')");

        return $query->result();
    }

    public function model_get_homeroom_availability($room)
    {
        $query = $this->db->get_where('tbl_08_job_info', ['Homeroom' => $room])->row();

        $query = $this->db->query(
            "SELECT t1.FirstName, t1.LastName, t2.Homeroom 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info t2
             ON t1.IDNumber = t2.IDNumber
             WHERE t2.Homeroom = '$room'"
        )->row();

        if (!empty($query)) {
            $callback = [
                'Name' => "$query->FirstName $query->LastName",
                'Response' => 'true'
            ];

            return $callback;
        } else {
            $callback = [
                'Response' => 'false'
            ];

            return $callback;
        }
    }

    public function new_tch($id, $status, $table1, $table2)
    {
        //Check if new ID already existed, to prevent collision
        $result = $this->db->query("SELECT IDNUmber FROM tbl_07_personal_bio WHERE IDNumber = '$id'");

        if ($result->num_rows() == 0) {
            $pass = md5('123456');

            $this->db->trans_begin();

            $this->db->insert('tbl_07_personal_bio', $table1);
            $this->db->insert('tbl_08_job_info', $table2);
            $this->db->query("INSERT INTO tbl_credentials (IDNumber,status,password) VALUES ('$id','$status','$pass')");

            $this->db->trans_commit();
            $this->db->trans_complete();

            if ($this->db->trans_status() !== false) {
                return 'success';
            } else {
                return 'abort';
            }
        } else {
            return 'abort';
        }
    }

    public function model_update_tch($selected_id, $table1, $table2)
    {
        $status = $_POST['previlege'];

        $this->db->trans_begin();
        $this->db->update('tbl_07_personal_bio', $table1, ['IDNumber' => $selected_id]);
        $this->db->update('tbl_07_personal_bio', ['status' => $status], ['IDNumber' => $selected_id]);
        $this->db->update('tbl_credentials', ['status' => $status], ['IDNumber' => $selected_id]);
        $this->db->update('tbl_08_job_info', $table2, ['IDNumber' => $selected_id]);
        $this->db->trans_commit();

        return true;
    }


    // ==================================================================================================================== \\
    // ==============================                     MODEL PROFILE STUDENT              ============================== \\
    // ==================================================================================================================== \\
    public function get_student($header)
    {
        extract($header);

        $where_room = ($room == 'all' ? 'IS NOT NULL' : "= '$room'");
        $search = ($search ? "LIKE '%$search%'" : "IS NOT NULL");
        $order_by = ($order_by ? $order_by : 'Fullname');
        $order_dir = ($order_dir ? $order_dir : 'ASC');

        $query = $this->db->query(
            "SELECT 
                t1.IDNumber, 
                CONCAT(t1.FirstName,' ',t1.MiddleName,' ',t1.LastName) AS Fullname, 
                t1.NickName, t1.Gender, 
                t1.DateofBirth, 
                t1.status, 
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio AS t1
             INNER JOIN tbl_08_job_info_std AS t2
                ON t1.IDNumber = t2.NIS 
                AND t2.Ruangan $where_room
             WHERE status = 'student'
             AND t1.IDNumber $search OR t1.FirstName $search OR t1.MiddleName $search OR t1.LastName $search
             ORDER BY $order_by $order_dir
             LIMIT $limit OFFSET $start"
        );
        
        $total = $this->db->query(
            "SELECT 
                t1.IDNumber, 
                CONCAT(t1.FirstName,' ',t1.MiddleName,' ',t1.LastName) AS Fullname, 
                t1.NickName, t1.Gender, 
                t1.DateofBirth, 
                t1.status, 
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio AS t1
             INNER JOIN tbl_08_job_info_std AS t2
                ON t1.IDNumber = t2.NIS 
                AND t2.Ruangan $where_room
             WHERE status = 'student'
             AND t1.IDNumber $search OR t1.FirstName $search OR t1.MiddleName $search OR t1.LastName $search
             ORDER BY $order_by $order_dir"
        )->num_rows();

        return [$query, $total];
    }

    //Dropdown Menu of Class for New Student Form
    public function get_dropdown_class()
    {
        $query = $this->db->query(
            "SELECT t2.ClassDesc FROM tbl_02_school t1 
             LEFT JOIN tbl_03_class t2
             ON t1.School_Desc = t2.Type
             RIGHT JOIN tbl_04_class_rooms
             USING(ClassID)
             WHERE t2.ClassDesc != '-'
             AND t1.isActive = 1
             UNION ALL
             SELECT class.ClassDesc FROM tbl_03_b_class_vocational AS class
             RIGHT JOIN tbl_04_class_rooms_vocational AS room
                ON class.ClassDesc = room.Simplified
             GROUP BY ClassDesc
             ORDER BY ClassDesc"
        );

        return $query->result();
    }

    public function get_dropdown_room()
    {
        $query = $this->db->query(
            "SELECT ClassDesc, RoomDesc 
             FROM tbl_03_class AS t1
             JOIN tbl_04_class_rooms AS t2
                ON t2.ClassID = t1.ClassID
             UNION ALL
             SELECT t1.ClassDesc, t2.RoomDesc
             FROM tbl_03_b_class_vocational t1
             LEFT JOIN tbl_04_class_rooms_vocational t2
                ON t1.ClassDesc = t2.Simplified 
             WHERE t2.RoomDesc IS NOT NULL
             ORDER BY ClassDesc"
        );

        return $query->result();
    }

    public function model_get_room_from_selected_class($cls)
    {
        $result = $this->db->query(
            "SELECT t1.RoomDesc FROM tbl_04_class_rooms t1
             JOIN tbl_03_class t2
             ON t2.ClassID = t1.ClassID
             WHERE ClassDesc = '$cls'
             UNION ALL
             SELECT room.RoomDesc
             FROM tbl_03_b_class_vocational AS class
             LEFT JOIN tbl_04_class_rooms_vocational AS room
                ON class.ClassDesc = room.Simplified
             WHERE ClassDesc = '$cls'"
        );

        return $result->result();
    }

    public function get_new_std_id($class){
        $schooltype = $this->db->query(
            "SELECT t1.School_Desc AS Applying
             FROM tbl_02_school AS t1
             RIGHT JOIN tbl_03_b_class_vocational AS t2
             USING(SchoolID)
             WHERE t2.ClassDesc = '$class'
             UNION ALL
             SELECT t1.School_Desc AS Applying
             FROM tbl_02_school AS t1
             RIGHT JOIN tbl_03_class AS t2
             USING(SchoolID)
             WHERE t2.ClassDesc = '$class'"
        )->row_array();

        if($schooltype['Applying'] == 'SD'){
            $applying = '01';
        }elseif($schooltype['Applying'] == 'SMP'){
            $applying = '02';
        }elseif($schooltype['Applying'] == 'SMA'){
            $applying = '03';
        }elseif($schooltype['Applying'] == 'SMK'){
            $applying = '04';
        }

        if (date('n', strtotime($time)) <= 6) {
            $semester = '02';
        } else {
            $semester = '01';
        }

        //COUNT ACTIVATED STUDENTS OF THE CURRENT ENROLLMENT BATCH
        $checkAppliants = $this->db->like('IDNumber', $applying . date('y') . $semester, 'after')->get('tbl_07_personal_bio')->num_rows();

        if($checkAppliants == 0){
            //ID = School Code + Last Two Digit of Cur. Year + Cur. Semester + Cur. New Student Index
            return $applying . date('y') . $semester . '001';
        }else{
            //ID = School Code + Last Two Digit of Cur. Year + Cur. Semester + Cur. New Student Index
            return $applying . date('y') . $semester . str_pad(($checkAppliants+1),3,"0", STR_PAD_LEFT);
        }
    }

    public function new_std($table1, $table2)
    {
        $time = date('d-m-Y');
        $year = date('Y');
        $semester = '';
        $schYear = '';

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $semester = 1;
            $schYear = $year . '/' . ($year + 1);
        }

        $newid = $table1['IDNumber'];
        $status = 'student';
        $room = $_POST['room'];
        $pass = md5('123456');

        $this->db->trans_begin();
        $this->db->insert('tbl_07_personal_bio', $table1);
        $this->db->insert('tbl_08_job_info_std', $table2);
        $this->db->query("INSERT INTO tbl_credentials (IDNumber, status, password) VALUES ('$newid','$status','$pass')");

        $sch = $this->db->query("SELECT RoomDesc FROM tbl_06_schedule WHERE RoomDesc = '$room'");

        //IF There's a schedule, insert new student data for table grade
        if (!empty($sch->result())) {
            $bio = $this->db->query(
                "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName, t2.Kelas, t2.Ruangan, t3.SubjName
                 FROM tbl_07_personal_bio t1
                 JOIN tbl_08_job_info_std t2
                 ON t2.NIS = t1.IDNumber
                 JOIN tbl_06_schedule t3
                 ON t2.Ruangan = t3.RoomDesc
                 WHERE t2.Ruangan = '$room' AND
                 t1.IDNumber NOT IN 
                    (SELECT NIS FROM tbl_09_det_grades 
                        WHERE Room = '$room' 
                        AND Semester = '$semester' 
                        AND schoolyear = '$schYear')"
            )->result();

            //If Subject is listed already => DON'T INSERT TO TBL_09_DET_GRADES
            //If not, then insert it as a new entry schedule
            $i = 1;
            foreach ($bio as $row) {
                $grade[$i]['NIS'] = $row->IDNumber;
                $grade[$i]['FullName'] = $row->FullName;
                $grade[$i]['Class'] = $row->Kelas;
                $grade[$i]['Room'] = $row->Ruangan;
                $grade[$i]['SubjName'] = $row->SubjName;
                $grade[$i]['Semester'] = $semester;
                $grade[$i]['schoolyear'] = $schYear;

                $i++;
            }

            $this->db->insert_batch('tbl_09_det_grades', $grade);
        }

        $this->db->trans_commit();
        $this->db->trans_complete();

        if ($this->db->trans_status() !== FALSE) {
            return 'success';
        }
    }

    public function get_full_info_std($selected_id)
    {
        $dat = $this->db->query("SELECT * FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info_std AS t2
        ON t1.IDNumber = t2.NIS
        WHERE t1.IDNumber = '$selected_id'
        ORDER BY t1.IDNumber");

        if ($dat->num_rows() > 0) {
            return $dat->row();
        } else {
            return null;
        }
    }

    public function model_update_std($selected_id, $table1, $table2, $room)
    {
        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $this->db->trans_begin();
        $this->db->where('IDNumber', $selected_id);
        $this->db->update('tbl_07_personal_bio', $table1);
        $this->db->where('NIS', $selected_id);
        $this->db->update('tbl_08_job_info_std', $table2);

        $Exist = $this->db->get_where('tbl_09_det_grades', [
            'NIS' => $selected_id,
            'Semester' => $semester,
            'schoolyear' => $schYear
        ])->result();

        //Delete previous grade's list from previous class, if exists
        if (!empty($Exist)) {
            $this->db->delete('tbl_09_det_grades', [
                'NIS' => $selected_id,
                'Semester' => $semester,
                'schoolyear' => $schYear
            ]);
        }

        $sch = $this->db->query("SELECT RoomDesc FROM tbl_06_schedule WHERE RoomDesc = '$room'");

        //IF There's a schedule for the room, insert new student data for table grade
        if (!empty($sch->result())) {

            //Get Student whose does not have schedule for this current room, and ignore the rest
            $bio = $this->db->query(
                "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName, t2.Kelas, t2.Ruangan, t3.SubjName
                 FROM tbl_07_personal_bio t1
                 JOIN tbl_08_job_info_std t2
                 ON t2.NIS = t1.IDNumber
                 JOIN tbl_06_schedule t3
                 ON t2.Ruangan = t3.RoomDesc
                 WHERE t2.Ruangan = '$room' AND
                 t1.IDNumber NOT IN 
                    (SELECT NIS FROM tbl_09_det_grades 
                        WHERE Room = '$room' 
                        AND Semester = '$semester' 
                        AND schoolyear = '$schYear')"
            )->result();

            //Create grade's list for students in result
            $i = 1;
            foreach ($bio as $row) {
                $grade[$i]['NIS'] = $row->IDNumber;
                $grade[$i]['FullName'] = $row->FullName;
                $grade[$i]['Class'] = $row->Kelas;
                $grade[$i]['Room'] = $row->Ruangan;
                $grade[$i]['SubjName'] = $row->SubjName;
                $grade[$i]['Semester'] = $semester;
                $grade[$i]['schoolyear'] = $schYear;

                $i++;
            }

            $this->db->insert_batch('tbl_09_det_grades', $grade);
        }

        $this->db->trans_commit();

        return 'success';
    }

    public function model_upload_img_std($id, $image)
    {
        $set['Photo'] = $image;
        $where['IDNumber'] = $id;

        $this->db->update('tbl_07_personal_bio', $set, $where);
    }

    // ==================================================================================================================== \\
    // ==============================                     PUBLIC MODEL PROFILE               ============================== \\
    // ==================================================================================================================== \\
    public function model_get_dropdown_active_rooms()
    {
        $result = $this->db->query(
            "SELECT t2.RoomDesc FROM tbl_02_school t1
             JOIN tbl_04_class_rooms t2
             ON t1.School_Desc = t2.Type
             WHERE t1.isActive = 1
             UNION ALL
             SELECT RoomDesc
             FROM tbl_04_class_rooms_vocational
             ORDER BY RoomDesc"
        )->result();

        return $result;
    }

    public function model_get_person_name($output, $emp)
    {

        if ($emp == 'student') {
            $table2 = 'tbl_08_job_info_std';
            $ids = 't2.NIS';
        } else {
            $table2 = 'tbl_08_job_info';
            $ids = 't2.IDNumber';
        }

        $query = $this->db->query(
            "SELECT t1.*, t2.* FROM tbl_07_personal_bio t1
             JOIN $table2 t2
             ON t1.IDNumber = $ids
             WHERE t1.FirstName LIKE '$output%' 
             OR t1.LastName LIKE '$output%'
             OR t1.IDNumber LIKE '$output%'
             AND t1.IDNumber NOT IN ('abase')
             ORDER BY t1.FirstName"
        )->result();

        return $query;
    }

    public function model_get_active_room_students($room)
    {
        $result = $this->db->query(
            "SELECT t1.*, t2.* FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
             ON t1.IDNumber = t2.NIS
             WHERE t2.Ruangan = '$room'
             ORDER BY t1.FirstName"
        )->result();

        return $result;
    }

    public function get_credentials($id)
    {
        $result = $this->db->query("SELECT status, password FROM tbl_credentials WHERE IDNumber = '$id'");

        return $result->row_array();
    }

    public function update_pass($id, $pass)
    {
        $this->db->set('password', $pass);
        $this->db->where('IDNumber', $id);
        $this->db->update('tbl_credentials');
    }

    public function model_delete($id)
    {
        $this->db->query("DELETE FROM tbl_07_personal_bio WHERE IDNumber = '$id'");
    }
}