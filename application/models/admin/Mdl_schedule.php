<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_schedule extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // ==================================================================================================================== \\
    // ==============================                     MODEL SCHEDULE                     ============================== \\
    // ==================================================================================================================== \\
    public function get_sch_info()
    {
        $query = $this->db->query("SELECT * FROM tbl_06_schedule");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function model_get_degrees()
    {
        $query = $this->db->get_where('tbl_02_school', ['isActive' => 1])->result();

        return $query;
    }

    public function get_sd()
    {
        $result = $this->db->query(
            "SELECT t1.RoomDesc, t1.ClassID FROM tbl_04_class_rooms t1
             JOIN tbl_03_class t2
             ON t1.ClassID = t2.ClassID
             WHERE t1.ClassID LIKE 'SD%' ORDER BY t2.ClassNumeric, t1.RoomDesc"
        );

        if ($result) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function get_smp()
    {
        $result = $this->db->query(
            "SELECT t1.RoomDesc, t1.ClassID FROM tbl_04_class_rooms t1
             JOIN tbl_03_class t2
             ON t1.ClassID = t2.ClassID
             WHERE t1.ClassID LIKE 'SMP%' ORDER BY t2.ClassNumeric, t1.RoomDesc"
        );

        if ($result) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function get_sma()
    {
        $result = $this->db->query(
            "SELECT t1.RoomDesc, t1.ClassID FROM tbl_04_class_rooms t1
             JOIN tbl_03_class t2
             ON t1.ClassID = t2.ClassID
             WHERE t1.ClassID LIKE 'SMA%' ORDER BY t2.ClassNumeric, t1.RoomDesc"
        );

        if ($result) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function modal_sv_hconfig($hlevel, $hours)
    {
        extract($hours);

        if ($hlevel == 'SD') {
            $query = $this->db->get('tbl_meta_hour_elementary');

            if ($query->num_rows() < 1) {
                for ($i = 0; $i < count($hours); $i++) {
                    $data = $hours[$i];
                    $this->db->query("INSERT INTO tbl_meta_hour_elementary(Hour) VALUES ('$data')");
                }
            } else {
                return 'false';
            }
        } elseif ($hlevel == 'SMP') {
            $query = $this->db->get('tbl_meta_hour_junior');

            if ($query->num_rows() < 1) {
                for ($i = 0; $i < count($hours); $i++) {
                    $data = $hours[$i];
                    $this->db->query("INSERT INTO tbl_meta_hour_junior(Hour) VALUES ('$data')");
                }
            } else {
                return 'false';
            }
        } elseif ($hlevel == 'SMA') {
            $query = $this->db->get('tbl_meta_hour_high');

            if ($query->num_rows() < 1) {
                for ($i = 0; $i < count($hours); $i++) {
                    $data = $hours[$i];
                    $this->db->query("INSERT INTO tbl_meta_hour_high(Hour) VALUES ('$data')");
                }
            } else {
                return 'false';
            }
        }
    }

    public function model_reset_hcon($level)
    {
        $table = '';

        $used_hour = $this->db->get_where('tbl_06_schedule', ['Degree' => $level])->result();

        if (empty($used_hour)) {
            if ($level == 'SD') {
                $table = 'tbl_meta_hour_elementary';
            } elseif ($level == 'SMP') {
                $table = 'tbl_meta_hour_junior';
            } elseif ($level == 'SMA') {
                $table = 'tbl_meta_hour_high';
            }

            $this->db->truncate($table);
        } else {
            return 'is_used';
        }
    }

    public function modal_get_full_tbl_session()
    {
        $reg = $this->db->query("SELECT SubjID, SubjName FROM tbl_05_subject WHERE Type = 'Regular' AND SubjName != '-'")->result();
        $elc = $this->db->query("SELECT SubjID, SubjName FROM tbl_05_subject WHERE Type = 'Elective' AND SubjName NOT IN ('-','ELECTIVE')")->result();
        $exc = $this->db->query("SELECT SubjID, SubjName FROM tbl_05_subject WHERE Type = 'Excul' AND SubjName NOT IN ('-','ECXUL')")->result();
        $non = $this->db->query("SELECT SubjID, SubjName FROM tbl_05_subject WHERE Type = 'Non-Subject' AND SubjName != '-'")->result();

        $data = [
            'reg' => $reg,
            'elc' => $elc,
            'exc' => $exc,
            'non' => $non
        ];

        return $data;
    }

    public function model_sv_new_session($type, $code, $name)
    {
        if ($type == 'reg_subj') {
            $type = 'Regular';
        } elseif ($type == 'elective_subj') {
            $type = 'Elective';
        } elseif ($type == 'excul') {
            $type = 'Excul';
        } elseif ($type == 'non_subj') {
            $type = 'Non-Subject';
        }

        $result = $this->db->query("SELECT SubjName FROM tbl_05_subject WHERE SubjID = '$code' OR SubjName = '$name'");

        if ($result->num_rows() < 1) {
            $this->db->insert('tbl_05_subject', [
                'SubjID' => $code,
                'SubjName' => $name,
                'Type' => $type
            ]);

            return 'success';
        } else {
            return 'is_available';
        }
    }

    public function model_edit_session($field, $old, $new)
    {
        $this->db->trans_begin();

        if ($field == 'SubjID') {
            $subjid = $this->db->get_where('tbl_05_subject', ['SubjID' => $new])->result();

            if (empty($subjid)) {
                $this->db->query("UPDATE tbl_05_subject SET SubjID = '$new' WHERE $field = '$old'");

                $this->db->trans_commit();

                return 'success';
            } else {
                return 'is_available';
            }
        } elseif ($field == 'SubjName') {
            $subjname = $this->db->get_where('tbl_05_subject', ['SubjName' => $new])->result();

            if (empty($subjname)) {
                //CHECK IF SCHEDULE EXISTS, IF IT IS THEN ABORT UPDATE
                $check = $this->db->query("SELECT SubjName FROM tbl_06_schedule WHERE SubjName = '$old'")->result();

                if (empty($check)) {
                    $this->db->query(
                        "UPDATE tbl_05_subject t1
                         LEFT JOIN tbl_05_subject_kd t2
                         ON t1.SubjName = t2.SubjName
                         SET 
                            t1.SubjName = '$new',
                            t2.SubjName = '$new',
                         WHERE t1.SubjName = '$old'"
                    );

                    $this->db->trans_commit();

                    return 'success';
                } else {
                    return 'is_attached';
                }
            } else {
                return 'is_available';
            }

            // $subjname = $this->db->get_where('tbl_05_subject', ['SubjName' => $new])->result();

            // if (empty($subjname)) {
            //     $this->db->query(
            //         "UPDATE tbl_05_subject t1
            //          LEFT JOIN tbl_05_subject_kd t2
            //          ON t1.SubjName = t2.SubjName
            //          LEFT JOIN tbl_05_subject_weight t3
            //          ON t1.SubjName = t3.SubjName
            //          LEFT JOIN tbl_06_schedule t4
            //          ON t1.SubjName = t4.SubjName
            //          LEFT JOIN tbl_09_det_character t5
            //          ON t1.SubjName = t5.SubjName
            //          LEFT JOIN tbl_09_det_grades t6
            //          ON t1.SubjName = t6.SubjName
            //          LEFT JOIN tbl_09_det_kd t7
            //          ON t1.SubjName = t7.SubjName
            //          SET 
            //             t1.SubjName = '$new',
            //             t2.SubjName = '$new',
            //             t3.SubjName = '$new',
            //             t4.SubjName = '$new',
            //             t5.SubjName = '$new',
            //             t6.SubjName = '$new',
            //             t7.SubjName = '$new'
            //          WHERE t1.SubjName = '$old'"
            //     );
        }
    }

    public function model_det_session($subj)
    {
        //CHECK IF SCHEDULE EXISTS, IF IT IS THEN ABORT DELETION
        $check = $this->db->query("SELECT SubjName FROM tbl_06_schedule WHERE SubjName = '$subj'")->result();

        $this->db->trans_begin();

        if (empty($check)) {

            $this->db->query(
                "DELETE t1
                 FROM tbl_05_subject t1
                 LEFT JOIN tbl_05_subject_kd t2
                 ON t1.SubjName = t2.SubjName
                 WHERE t1.SubjName = '$subj'"
            );

            $this->db->trans_commit();

            return 'success';
        } else {
            return 'is_available';
        }
    }

    public function model_get_room_level($room)
    {
        $query = $this->db->query(
            "SELECT t1.School_Desc FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             WHERE t3.RoomDesc = '$room'"
        )->row();

        return $query->School_Desc;
    }

    public function model_sv_new_curhour($data)
    {
        extract($data);

        $query = $this->db->query(
            "SELECT t1.School_Desc FROM tbl_02_school t1
             JOIN tbl_03_class t2
             ON t2.SchoolID = t1.SchoolID
             JOIN tbl_04_class_rooms t3
             ON t3.ClassID = t2.ClassID
             WHERE t3.RoomDesc = '$room'"
        )->row();

        if ($query->School_Desc == 'SD') {
            $table = 'tbl_meta_hour_elementary';
        } elseif ($query->School_Desc == 'SMP') {
            $table = 'tbl_meta_hour_junior';
        } elseif ($query->School_Desc == 'SMA') {
            $table = 'tbl_meta_hour_high';
        }

        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $schedule = $this->db->get_where('tbl_06_schedule', ['Degree' => $query->School_Desc])->result();

        $this->db->trans_begin();

        if ($type == 'inc') {
            if (!empty($schedule)) {
                $this->db->query(
                    "UPDATE tbl_06_schedule 
                     SET Hour = DATE_ADD(STR_TO_DATE(Hour,'%H:%i:%s'), INTERVAL $interval MINUTE) 
                     WHERE Hour > STR_TO_DATE('$current','%H:%i:%s') 
                     AND Degree = '$query->School_Desc'
                     AND Semester = '$semester'
                     AND SchoolYear = '$schYear'"
                );
            }

            $query = $this->db->query(
                "UPDATE $table SET Hour = DATE_ADD(STR_TO_DATE(Hour,'%H:%i:%s'), INTERVAL $interval MINUTE) WHERE Hour > STR_TO_DATE('$current','%H:%i:%s')"
            );
        } else {
            if (!empty($schedule)) {
                $this->db->query(
                    "UPDATE tbl_06_schedule 
                     SET Hour = DATE_SUB(STR_TO_DATE(Hour,'%H:%i:%s'), INTERVAL $interval MINUTE) 
                     WHERE Hour > STR_TO_DATE('$current','%H:%i:%s') 
                     AND Degree = '$query->School_Desc'
                     AND Semester = '$semester'
                     AND SchoolYear = '$schYear'"
                );
            }

            $query = $this->db->query(
                "UPDATE $table SET Hour = DATE_SUB(STR_TO_DATE(Hour,'%H:%i:%s'), INTERVAL $interval MINUTE) WHERE Hour > STR_TO_DATE('$current','%H:%i:%s')"
            );
        }

        $this->db->trans_commit();
    }

    public function check_students($room)
    {
        $result = $this->db->query("SELECT Ruangan FROM tbl_08_job_info_std WHERE Ruangan = '$room'");

        return $result->num_rows();
    }

    public function get_cls_lvl($val)
    {
        $query = $this->db->query(
            "SELECT t2.RoomDesc FROM tbl_03_class t1
            JOIN tbl_04_class_rooms t2
            ON t2.ClassID = t1.ClassID
            WHERE t1.ClassDesc = '$val'"
        );

        return $query->result();
    }

    public function get_sche_spec($room, $hour, $day)
    {
        $query = $this->db->query("SELECT * FROM tbl_06_schedule WHERE RoomDesc = '$room' AND Hour = '$hour' AND Days = '$day'");

        if ($query) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_dropdown_class()
    {
        $query = $this->db->query("SELECT ClassDesc, RoomDesc 
            FROM tbl_03_class AS t1
            JOIN tbl_04_class_rooms AS t2
            ON t2.ClassID = t1.ClassID");

        return $query->result();
    }

    public function get_dropdown_session()
    {
        $result = $this->db->query("SELECT DISTINCT Type FROM tbl_05_subject WHERE Type != '-' ORDER BY FIELD(Type, 'Regular', 'Elective', 'Excul', 'Non-Subject')");

        return $result->result();
    }

    public function get_dropdown_subject()
    {
        $query = $this->db->query("SELECT SubjName FROM tbl_05_subject WHERE Type = 'Regular' ORDER BY SubjName ASC");

        return $query->result();
    }

    public function get_dropdown_edit_subject($type)
    {
        $query = $this->db->query("SELECT SubjName FROM tbl_05_subject WHERE Type = '$type' ORDER BY SubjName ASC");

        return $query->result();
    }

    public function get_sche_data($day, $room, $hour)
    {
        $query = $this->db->query(
            "SELECT t1.SubjName, t1.TeacherName, t1.Note, t2.Type
             FROM tbl_06_schedule t1
             JOIN tbl_05_subject t2
             ON t1.SubjName = t2.SubjName 
             WHERE Days = '$day' AND RoomDesc = '$room' AND Hour = '$hour'"
        );

        return $query->row();
    }

    public function get_dropdown_day($room)
    {
        $query = $this->db->query("SELECT DISTINCT Days FROM tbl_06_schedule WHERE RoomDesc = '$room'");

        return $query->result();
    }

    public function get_dropdown_hour($room)
    {
        $query = $this->db->query(
            "SELECT t1.School_Desc, t3.RoomDesc 
            FROM tbl_02_school t1
            LEFT JOIN tbl_03_class t2
            ON t1.SchoolID = t2.SchoolID
            LEFT JOIN tbl_04_class_rooms t3
            ON t2.ClassID = t3.ClassID
            WHERE t3.RoomDesc = '$room'"
        )->row();

        if ($query->School_Desc == 'SD') {
            $table = 'tbl_meta_hour_elementary';
        } elseif ($query->School_Desc == 'SMP') {
            $table = 'tbl_meta_hour_junior';
        } elseif ($query->School_Desc == 'SMA') {
            $table = 'tbl_meta_hour_high';
        }

        $result = $this->db->query("SELECT Hour FROM (SELECT Hour FROM $table GROUP BY Hour DESC LIMIT 1, 30) Hours ORDER BY Hour ASC");

        return $result->result();
    }

    public function get_dropdown_teachers()
    {
        $dat = $this->db->query("SELECT t1.IDNumber, CONCAT(t1.FirstName,' ',t1.LastName) AS FullName, t2.SubjectTeach 
        FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info AS t2
        ON t1.IDNumber = t2.IDNumber
        WHERE status = 'teacher'
        ORDER BY t1.IDNumber");

        if ($dat->num_rows() > 0) {
            return $dat->result();
        } else {
            return false;
        }
    }

    public function get_schedule_full($room)
    {
        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $level = $this->db->query(
            "SELECT t1.School_Desc, t3.RoomDesc 
             FROM tbl_02_school t1
             LEFT JOIN tbl_03_class t2
             ON t1.SchoolID = t2.SchoolID
             LEFT JOIN tbl_04_class_rooms t3
             ON t2.ClassID = t3.ClassID
             WHERE t3.RoomDesc = '$room'"
        )->row();

        if ($level->School_Desc == 'SD') {
            $table = 'tbl_meta_hour_elementary';
        } elseif ($level->School_Desc == 'SMP') {
            $table = 'tbl_meta_hour_junior';
        } elseif ($level->School_Desc == 'SMA') {
            $table = 'tbl_meta_hour_high';
        }

        $result = $this->db->query(
            "SELECT  
                TIME_FORMAT(start.Hour, '%H:%i') AS Start,
                TIME_FORMAT(end.Hour, '%H:%i') AS Finish,
                r1.SubjName AS Mon,
                r2.SubjName AS Tue,
                r3.SubjName AS Wed,
                r4.SubjName AS Thu,
                r5.SubjName AS Fri,
                r6.SubjName AS Sat   
             FROM $table r0
                LEFT JOIN (SELECT Hour FROM (SELECT Hour FROM $table GROUP BY Hour DESC LIMIT 1, 30) Hours ORDER BY Hour ASC) as start
                    ON start.Hour = r0.Hour
                LEFT JOIN (SELECT Hour FROM $table GROUP BY Hour LIMIT 1, 30) as end
                    ON end.Hour > start.Hour
                LEFT JOIN tbl_06_schedule r1 
                    ON TIME_FORMAT(r1.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r1.RoomDesc = '$room' AND r1.semester = '$semester' AND r1.schoolyear = '$schYear' AND r1.Days = 'Senin'
                LEFT JOIN tbl_06_schedule r2 
                    ON TIME_FORMAT(r2.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r2.RoomDesc = '$room' AND r2.semester = '$semester' AND r2.schoolyear = '$schYear' AND r2.Days = 'Selasa'
                LEFT JOIN tbl_06_schedule r3 
                    ON TIME_FORMAT(r3.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r3.RoomDesc = '$room' AND r3.semester = '$semester' AND r3.schoolyear = '$schYear' AND r3.Days = 'Rabu'
                LEFT JOIN tbl_06_schedule r4 
                    ON TIME_FORMAT(r4.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r4.RoomDesc = '$room' AND r4.semester = '$semester' AND r4.schoolyear = '$schYear' AND r4.Days = 'Kamis'
                LEFT JOIN tbl_06_schedule r5 
                    ON TIME_FORMAT(r5.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r5.RoomDesc = '$room' AND r5.semester = '$semester' AND r5.schoolyear = '$schYear' AND r5.Days = 'Jumat'
                LEFT JOIN tbl_06_schedule r6
                    ON TIME_FORMAT(r6.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r6.RoomDesc = '$room' AND r6.semester = '$semester' AND r6.schoolyear = '$schYear' AND r6.Days = 'Sabtu'
                GROUP BY r0.Hour ASC"
        );

        return $result;
    }

    public function get_sche_roominfo($room)
    {
        $query = $this->db->query(
            "SELECT t1.RoomDesc, t2.Hour, t2.Days 
            FROM tbl_04_class_rooms t1 
            JOIN tbl_06_schedule t2 
            ON t1.RoomID = t2.RoomID 
            WHERE t1.RoomDesc = '$room'"
        );

        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getNonCollideDate($room, $day)
    {
        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $level = $this->db->query(
            "SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$room'"
        )->row();

        if ($level->Type == 'SD') {
            $table = 'tbl_meta_hour_elementary';
        } elseif ($level->Type == 'SMP') {
            $table = 'tbl_meta_hour_junior';
        } elseif ($level->Type == 'SMA' or $level->School_Desc == 'SMK') {
            $table = 'tbl_meta_hour_high';
        }

        $result = $this->db->query(
            "SELECT Hour FROM $table 
             WHERE Hour NOT IN 
                (SELECT Hour FROM tbl_06_schedule 
                 WHERE semester = '$semester' 
                 AND schoolyear = '$schYear' 
                 AND Days = '$day' 
                 AND RoomDesc = '$room'
                ) 
             ORDER BY Hour ASC"
        );

        return $result;
    }

    public function get_sche_chief($room)
    {
        $res = $this->db->query(
            "SELECT CONCAT(FirstName,' ', LastName) AS Student 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
             ON t1.IDNumber = t2.NIS
             WHERE t2.Ruangan = '$room' AND t2.Position = 'Ketua Kelas'
        "
        );

        return $res->row();
    }

    public function get_homeroom($room)
    {
        $query = $this->db->query(
            "SELECT CONCAT(FirstName,' ',LastName) AS Teacher 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info t2
             ON t1.IDNumber = t2.IDNumber
             WHERE Homeroom = '$room'"
        );

        return $query->row();
    }

    public function get_class_info($room)
    {
        $res = $this->db->query("SELECT COUNT(Ruangan) AS Total FROM tbl_08_job_info_std WHERE Ruangan = '$room'");

        return $res->row();
    }

    public function modal_get_session_type($type)
    {
        $result = $this->db->query(
            "SELECT SubjName FROM tbl_05_subject 
             WHERE Type = '$type' AND SubjName != 'None' 
             ORDER BY SubjName ASC"
        );

        return $result;
    }

    public function modal_check_teacher_avail($day, $hour, $teacher)
    {
        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $query = $this->db->get_where('tbl_06_schedule', [
            'IDNumber' => $teacher,
            'Days' => $day,
            'Hour' => $hour,
            'semester' => $semester,
            'schoolyear' => $schYear
        ]);

        if ($query->num_rows() < 1) {
            return 'proceed';
        } else {
            return 'unproceed';
        }
    }

    public function model_add_sch($new)
    {
        extract($new);

        // POST Schedule
        $RoomDesc = $room;
        $Hour = date('H:i:s', strtotime($hour));
        $SubjName = $subj;

        $RoomID = $this->db->query("SELECT RoomID FROM tbl_04_class_rooms WHERE RoomDesc = '$RoomDesc'")->row();

        if ($type == 'Non-Subject') {
            $IDNumber = '-';
            $TeacherName = '-';
        } elseif ($type == 'Elective') {
            $SubjName = 'ELECTIVE';
            $IDNumber = '-';
            $TeacherName = '-';
        } elseif ($type == 'Excul') {
            $SubjName = 'EXCUL';
            $IDNumber = '-';
            $TeacherName = '-';
        } else {
            $IDNumber = $teacher;
            $tch = $this->db->query("SELECT CONCAT(FirstName,' ', LastName) AS FullName FROM tbl_07_personal_bio WHERE IDNumber = '$IDNumber'")->row();
            $TeacherName = $tch->FullName;
        }

        $query = $this->db->query(
            "SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$room'"
        )->row();

        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        //Data for DB Schedule
        $sche = [
            'Degree' => $query->Type,
            'RoomID' => $RoomID->RoomID,
            'RoomDesc' => $RoomDesc,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'Hour' => $Hour,
            'SubjName' => $SubjName,
            'Days' => $day,
            'IDNumber' => $IDNumber,
            'TeacherName' => $TeacherName,
            'Note' => $note
        ];

        $this->db->trans_start();

        $this->db->insert('tbl_06_schedule', $sche);

        if ($type == 'Regular') {
            //Get Student for said Class
            $students = $this->db->query(
                "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName, t2.Kelas, t2.Ruangan 
                 FROM tbl_07_personal_bio t1
                 JOIN tbl_08_job_info_std t2
                 ON t2.NIS = t1.IDNumber
                 WHERE t2.Ruangan = '$RoomDesc'
                 "
            )->result();

            $available = $this->db->query("SELECT * FROM tbl_09_det_grades WHERE Room = '$RoomDesc' AND SubjName = '$SubjName' AND Semester = '$semester' AND schoolyear = '$schYear'");

            if (!empty($students)) {
                if ($available->num_rows() == 0) {
                    $i = 0;

                    //Insert same Schedule Details for each student's for said class
                    foreach ($students as $row) {
                        $grade[$i]['NIS'] = $row->IDNumber;
                        $grade[$i]['FullName'] = $row->FullName;
                        $grade[$i]['Semester'] = $semester;
                        $grade[$i]['schoolyear'] = $schYear;
                        $grade[$i]['Class'] = $row->Kelas;
                        $grade[$i]['Room'] = $row->Ruangan;
                        $grade[$i]['SubjName'] = $SubjName;

                        $i++;
                    }

                    $this->db->insert_batch('tbl_09_det_grades', $grade);
                }

                $response = 'success';
            } else {
                $response = 'empty';
            }
        } else {
            $response = 'success';
        }

        $this->db->trans_commit();

        return $response;
    }

    public function model_upd_sch($ref)
    {
        extract($ref); //get array from controller as its own var

        $semester = '';
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $semester = 2;
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $IDNumber = '';
        $TeacherName = '';

        if ($type == 'Non-Subject') {
            $IDNumber = '-';
            $TeacherName = '-';
        } else {
            $IDNumber = $teacher;
            $tch = $this->db->query("SELECT CONCAT(FirstName,' ', LastName) AS FullName FROM tbl_07_personal_bio WHERE IDNumber = '$IDNumber'")->row_array();
            $TeacherName = $tch['FullName'];
        }

        $this->db->trans_begin();

        $this->db->set('SubjName', $subj);
        $this->db->set('IDNumber', $IDNumber);
        $this->db->set('TeacherName', $TeacherName);
        $this->db->set('Note', $note);

        $this->db->where('RoomDesc', $room);
        $this->db->where('Days', $day);
        $this->db->where('Hour', $hour);
        $this->db->where('semester', $semester);
        $this->db->where('schoolyear', $schYear);

        $this->db->update('tbl_06_schedule');

        $tch_avail = $this->db->get_where('tbl_06_schedule', [
            'IDNumber' => $IDNumber,
            'Days' => $day,
            'Hour' => $hour,
            'semester' => $semester,
            'schoolyear' => $schYear
        ])->num_rows();

        $tch_current = $this->db->get_where('tbl_06_schedule', [
            'RoomDesc' => $room,
            'Days' => $day,
            'Hour' => $hour,
            'semester' => $semester,
            'schoolyear' => $schYear
        ])->row();

        $unmatched = $this->db->query("SELECT SubjName FROM unmatch");

        if ($type == 'Regular' || $type == 'Elective') {
            if ($tch_avail == 0 ||  $IDNumber == $tch_current->IDNumber) {
                //Get current Subject before Update
                $duplicate = $this->db->query(
                    "SELECT SubjName FROM tbl_09_det_grades 
                     WHERE Room = '$room' 
                     AND SubjName = '$subj' 
                     AND semester = '$semester' 
                     AND schoolyear = '$schYear'"
                );

                //SCRIPT FOR MAKING VIEW "UNMATCH":
                // "CREATE VIEW UNMATCH AS 
                // SELECT SubjName FROM tbl_09_det_grades 
                // WHERE SubjName 
                // NOT IN (SELECT SubjName FROM tbl_06_schedule)"

                //FIND UNMATCHED DATA FOR BOTH SCH & GRD HERE, GET RESULT FROM MYSQL VIEW

                if ($unmatched->num_rows() > 0) {
                    $this->db->query("DELETE FROM `tbl_09_det_grades` WHERE SubjName IN (SELECT SubjName FROM unmatch)");
                }

                if ($duplicate->num_rows() == 1) {

                    $this->db->update('tbl_09_det_grades', ['SubjName' => $subj], ['SubjName' => $subj, 'Room' => $room]);
                } elseif ($duplicate->num_rows() == 0) {

                    $students = $this->db->query(
                        "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName, t2.Kelas, t2.Ruangan 
                         FROM tbl_07_personal_bio t1
                         JOIN tbl_08_job_info_std t2
                         ON t2.NIS = t1.IDNumber
                         WHERE t2.Ruangan = '$room'"
                    )->result();

                    $i = 0;
                    //Insert same Schedule Details for each student's for said class
                    foreach ($students as $row) {
                        $grade[$i]['NIS'] = $row->IDNumber;
                        $grade[$i]['FullName'] = $row->FullName;
                        $grade[$i]['Semester'] = $semester;
                        $grade[$i]['schoolyear'] = $schYear;
                        $grade[$i]['Class'] = $row->Kelas;
                        $grade[$i]['Room'] = $row->Ruangan;
                        $grade[$i]['SubjName'] = $subj;

                        $i++;
                    }

                    $this->db->insert_batch('tbl_09_det_grades', $grade);
                }
            } else {
                return 'unproceed';
            }
        } else {
            if ($unmatched->num_rows() > 0) {
                $this->db->query("DELETE FROM `tbl_09_det_grades` WHERE SubjName IN (SELECT SubjName FROM unmatch)");
            }
        }

        $this->db->trans_commit();

        return 'success';
    }

    public function model_delete_sche($room)
    {
        $semester = '';
        $schYear = '';

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

        $this->db->query(
            "DELETE FROM tbl_06_schedule 
             WHERE semester = '$semester'
             AND schoolyear = '$schYear' 
             AND RoomDesc = '$room'"
        );

        $this->db->query(
            "DELETE FROM tbl_09_det_grades 
             WHERE Semester = '$semester'
             AND schoolyear = '$schYear' 
             AND Room = '$room'"
        );

        $this->db->query(
            "DELETE FROM tbl_09_det_kd 
             WHERE Semester = '$semester'
             AND schoolyear = '$schYear' 
             AND Room = '$room'"
        );

        $this->db->trans_commit();
    }
}
