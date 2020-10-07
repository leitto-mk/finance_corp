<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_grade extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function model_get_degrees()
    {
        $query = $this->db->get_where('tbl_02_school', ['isActive' => 1])->result();

        return $query;
    }

    public function model_get_table_by_subjects()
    {
        $query = $this->db->order_by('SubjName','ASC')
                          ->where("SubjID NOT IN('ELECTIVE','EXCUL','-', '0')")
                          ->where("Type NOT IN('','-','Non-Subject')")
                          ->get('tbl_05_subject')->result();
        return $query;
    }

    public function model_get_kd_by_subject($type, $cls, $subj, $semester)
    {
        $query = $this->db->query(
            "SELECT * FROM tbl_05_subject_kd 
             WHERE Type = '$type'
             AND SubjName = '$subj' 
             AND Semester = '$semester' 
             AND Classes = '$cls' 
             ORDER BY CtrlNo"
        )->result();

        return $query;
    }

    public function model_save_new_kd($type, $cls, $subj, $semester, $material, $code, $adjust)
    {
        $this->db->insert('tbl_05_subject_kd', [
            'Type' => $type,
            'Classes' => $cls,
            'SubjName' => $subj,
            'Semester' => $semester,
            'KD' => $material,
            'Code' => preg_replace('/\s/', '', $code),
            'Adjust' => $adjust
        ]);
    }

    public function model_edit_kd($type, $field, $newval, $code, $sem, $subj)
    {
        $this->db->update('tbl_05_subject_kd', [$field => $newval], [
            'Code' => preg_replace('/\s/', '', $code),
            'Semester' => $sem,
            'SubjName' => $subj,
            'Type' => $type
        ]);
    }

    public function model_delete_kd($type, $code, $sem, $subj)
    {
        $this->db->delete('tbl_05_subject_kd', [
            'Type' => $type,
            'Code' => $code,
            'Semester' => $sem,
            'SubjName' => $subj
        ]);
    }

    public function get_social_desc()
    {
        $query = $this->db->get_where('tbl_05_subject_character_desc', ['Type' => 'Social'])->result();

        return $query;
    }

    public function get_spirit_desc()
    {
        $query = $this->db->get_where('tbl_05_subject_character_desc', ['Type' => 'Spiritual'])->result();

        return $query;
    }

    public function model_get_active_days($degree)
    {
        $query = $this->db->get_where('tbl_meta_active_days', ['Degree' => $degree])->row();

        return $query->Total;
    }

    public function get_active_classes()
    {
        $query = $this->db->query(
            "SELECT t2.ClassDesc
             FROM tbl_02_school t1
             INNER JOIN tbl_03_class t2
                ON t1.School_Desc = t2.Type
             WHERE t1.isActive = 1
             GROUP BY ClassDesc
             UNION ALL
             SELECT t2.ClassDesc
             FROM tbl_02_school t1
             INNER JOIN tbl_03_b_class_vocational t2
                ON t1.School_Desc = t2.Type
             RIGHT JOIN tbl_04_class_rooms_vocational t3
             	ON t2.ClassDesc = t3.Simplified
             WHERE t1.isActive = 1
             GROUP BY ClassDesc"
        )->result();

        return $query;
    }

    public function get_active_rooms()
    {
        $query = $this->db->query(
            "SELECT t3.RoomDesc, t2.ClassNumeric 
             FROM tbl_02_school t1
			 JOIN tbl_03_class t2
             ON t1.School_Desc = t2.Type
             JOIN tbl_04_class_rooms t3
             ON t2.ClassID = t3.ClassID
             WHERE t1.isActive = 1
             UNION ALL
             SELECT t3.RoomDesc, t2.ClassNumeric
             FROM tbl_02_school t1
			 JOIN tbl_03_b_class_vocational t2
             ON t1.School_Desc = t2.Type
             JOIN tbl_04_class_rooms_vocational t3
             ON t2.ClassID = t3.ClassID
             WHERE t1.isActive = 1
             ORDER BY ClassNumeric, RoomDesc"
        )->result();

        return $query;
    }

    public function get_active_rooms_voc()
    {
        $query = $this->db->query(
            "SELECT room.RoomDesc 
             FROM tbl_04_class_rooms_vocational AS room
             LEFT JOIN tbl_03_b_class_vocational AS class 
                ON class.ClassDesc = room.Simplified
             WHERE class.ClassNumeric > 10"
        )->result();

        return $query;
    }

    public function get_period(){
        $query = $this->db->query(
            "SELECT DISTINCT 
                Semester, 
                schoolyear 
             FROM tbl_09_det_grades 
             ORDER BY schoolyear DESC, Semester DESC"
        )->result();

        return $query;
    }

    public function get_active_degree()
    {
        $query = $this->db->get_where('tbl_02_school', ['isActive' => 1])->result();

        return $query;
    }

    public function get_dd_subjects()
    {
        $query = $this->db->query(
            "SELECT SubjName, Type 
             FROM tbl_05_subject 
             WHERE Type IN ('Regular','Elective') 
             AND SubjName NOT IN ('','None','ELECTIVE','EXUL') 
             ORDER BY SubjName"
        )->result();

        return $query;
    }

    public function get_sd()
    {
        $result = $this->db->query(
            "SELECT ClassDesc, ClassID 
             FROM tbl_03_class 
             WHERE ClassID LIKE 'SD%' 
             ORDER BY ClassNumeric"
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
            "SELECT ClassDesc, ClassID 
             FROM tbl_03_class 
             WHERE ClassID LIKE 'SMP%' 
             ORDER BY ClassNumeric"
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
            "SELECT ClassDesc, ClassID 
             FROM tbl_03_class 
             WHERE ClassID LIKE 'SMA%' 
             ORDER BY ClassNumeric"
        );

        if ($result) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function get_smk()
    {
        $result = $this->db->query(
            "SELECT 
                class.ClassDesc, 
                class.ClassID 
             FROM tbl_03_b_class_vocational AS class
             RIGHT JOIN tbl_04_class_rooms_vocational AS room
             ON class.ClassDesc = room.Simplified
             GROUP BY class.ClassDesc
             ORDER BY class.ClassNumeric"
        );

        if ($result) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function model_classes_grade_total($cls)
    {
        $query = $this->db->query("SELECT DISTINCT NIS, FullName, Room FROM tbl_09_det_grades WHERE Class = '$cls'");

        return $query->num_rows();
    }

    public function model_classes_grade($cls)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT DISTINCT NIS, FullName, Room 
             FROM tbl_09_det_grades 
             WHERE Class = '$cls'
             AND schoolyear = '$schYear'
             ORDER BY FullName"
        );

        return $query->result();
    }

    public function model_get_sub_classes($cls)
    {
        $data = $this->db->query(
            "SELECT 
                ClassID 
             FROM tbl_03_class 
             WHERE ClassDesc = '$cls'
             UNION ALL
             SELECT 
                ClassID
             FROM tbl_03_b_class_vocational 
             WHERE ClassDesc = '$cls'"
        )->row();
        
        $query = $this->db->query(
            "SELECT t2.RoomDesc FROM tbl_03_class t1
             JOIN tbl_04_class_rooms t2 
             ON t1.ClassID = t2.ClassID
             WHERE t2.ClassID = '$data->ClassID'"
        );

        return $query->result();
    }

    public function model_sub_classes_grade($room)
    {
        $query = $this->db->query("SELECT DISTINCT NIS, FullName, Class, Room FROM tbl_09_det_grades WHERE Room = '$room'");

        return $query->result();
    }

    public function model_get_full_kd_details($cls, $semester, $subj, $type)
    {
        $romanic = $this->db->query(
            "SELECT t1.ClassDesc 
             FROM tbl_03_class t1
             JOIN tbl_04_class_rooms t2
             ON t1.ClassID = t2.ClassID
             WHERE RoomDesc = '$cls'
             UNION ALL
             SELECT t1.ClassDesc
             FROM tbl_03_b_class_vocational t1
             LEFT JOIN tbl_04_class_rooms_vocational t2
             ON t1.ClassDesc = t2.Simplified
             WHERE t2.RoomDesc = '$cls'"
        )->row();

        $query = $this->db->get_where('tbl_05_subject_kd', [
            'Classes' => $romanic->ClassDesc,
            'Semester' => $semester,
            'SubjName' => $subj,
            'Type' => $type
        ]);

        return $query;
    }

    public function model_get_person_full_details($cls, $year, $semester, $subj)
    {
        $query = $this->db->query(
            "SELECT * FROM tbl_09_det_grades
             WHERE Room = '$cls' 
             AND Semester = '$semester'
             AND schoolyear = '$year'
             AND SubjName = '$subj'
             GROUP BY NIS
             ORDER BY FullName"
        );

        return $query;
    }

    public function model_get_person_voc_details($cls, $year, $semester, $subj)
    {
        $query = $this->db->query(
            "SELECT 
                grade.NIS, 
                grade.FullName, 
                grade.Room,
                voc.Report,
                voc.Predicate,
                voc.Description
             FROM tbl_09_det_grades AS grade
             LEFT JOIN tbl_09_det_voc_grades AS voc
                USING(NIS)
             WHERE grade.Room = '$cls' 
             AND grade.Semester = '$semester'
             AND grade.schoolyear = '$year'
             AND grade.SubjName = '$subj'
             ORDER BY FullName"
        )->result();

        return $query;
    }

    public function model_get_character_grade($data)
    {
        extract($data);

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->get_where('tbl_09_det_character', [
            'NIS' => $nis,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'Room' => $room,
            'Type' => $type,
            'Description' => $desc
        ])->row_array();

        return $query;
    }

    public function get_recap_weight($cls, $subj)
    {
        $query = $this->db->get_where('tbl_05_subject_weight', [
            'SubjName' => $subj,
            'Class' => $cls
        ]);

        return $query->row();
    }

    public function model_update_kd_weight($room, $year, $semester, $type, $subj, $code, $field, $value)
    {
        $schYear = '';

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            $schYear = $year;
        } else {
            $schYear = $period;
        }

        if ($value == '') {
            $value = NULL;
        }

        $KDRecapAvg = '';

        if ($type == 'cognitive') {
            $KDRecapAvg = 'KDRecapAvg';
        } else {
            $KDRecapAvg = 'KDRecapAvg_SK';
        }

        $this->db->trans_begin();

        $this->db->update('tbl_05_subject_kd', [$field => $value], [
            'Type' => $type,
            'SubjName' => $subj,
            'Code' => $code
        ]);

        //GET ROOM'S CLASS
        $cls = $this->db->query(
            "SELECT t1.ClassRomanic FROM tbl_03_class t1
             JOIN tbl_04_class_rooms t2
             ON t1.ClassID = t2.ClassID
             WHERE t2.RoomDesc = '$room'"
        )->row_array();

        $cls = $cls['ClassRomanic'];

        //UPDATE SELECTED KD Average 
        $this->db->query(
            "UPDATE tbl_09_det_kd t1
             LEFT JOIN tbl_05_subject_kd t2
             ON t1.SubjName = t2.SubjName AND t1.Semester = t2.Semester AND t1.Code = t2.Code AND t1.Type = t2.Type
             SET t1.KDAvg = 
                    IF(t1.Grade1 IS NULL AND t1.Grade2 IS NULL AND t1.Grade3 IS NULL, NULL, 
                        CEIL(
                            IF(t1.Grade1 IS NULL, 0, t1.Grade1 * IF(t2.Weight1 IS NULL, 0, t2.Weight1 / 100))
                            +             
                            IF(t1.Grade2 IS NULL, 0, t1.Grade2 * IF(t2.Weight2 IS NULL, 0, t2.Weight2 / 100))
                            +
                            IF(t1.Grade3 IS NULL, 0, t1.Grade3 * IF(t2.Weight3 IS NULL, 0, t2.Weight3 / 100))
                        )
                    ) 
             WHERE t1.SubjName = '$subj'
             AND t1.Room = '$room'
             AND t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.Type = '$type'
             AND t1.Code = '$code'
             AND t2.Classes = '$cls'"
        );

        //UPDATE KD RECAP AVERAGE
        $this->db->query(
            "UPDATE tbl_09_det_grades t1 
             SET $KDRecapAvg = 
                (SELECT CEIL(SUM(KDAvg) / COUNT(KDAVg))         
                 FROM tbl_09_det_kd t2
                 WHERE t1.NIS = t2.NIS 
                 AND Semester = '$semester' 
                 AND schoolyear = '$schYear' 
                 AND Room = '$room' 
                 AND SubjName = '$subj' 
                 AND Type = '$type'
                ) 
             WHERE NIS IN (SELECT DISTINCT NIS FROM tbl_09_det_kd)
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Room = '$room' 
             AND SubjName = '$subj'"
        );

        //UPDATE FINAL REPORT GRADE
        $this->db->query(
            "UPDATE tbl_09_det_grades t1
             JOIN tbl_05_subject_weight t2
             ON t1.SubjName = t2.SubjName
             SET 
                t1.Report = 
                    IF(t1.KDRecapAvg IS NULL OR t1.MidRecap IS NULL OR t1.FinalRecap IS NULL, NULL, 
                        CEIL(
                            IF(t1.KDRecapAvg IS NULL, 0, t1.KDRecapAvg) * (t2.KDWeight / 100)
                            +
                            IF(t1.MidRecap IS NULL, 0, t1.MidRecap) * (t2.MidWeight / 100)
                            +
                            IF(t1.FinalRecap IS NULL, 0, t1.FinalRecap) * (t2.FinalWeight / 100)
                            +
                            IF(t1.Absent IS NULL, 0, t1.Absent) * (t2.Absent / 100)
                        )
                    ),
                t1.Report_SK = 
                    IF(t1.KDRecapAvg_SK IS NULL, NULL, 
                        CEIL(
                            IF(t1.KDRecapAvg_SK IS NULL, 0, t1.KDRecapAvg_SK) * (t2.KDWeight_SK / 100)
                        )
                    )
             WHERE t1.Semester = '$semester'
             AND t1.Room = '$room'
             AND t1.schoolyear = '$schYear'
             AND t1.SubjName = '$subj'"
        );

        //SET PREDICATE BASED ON REPORT
        $this->db->query(
            "UPDATE tbl_09_det_grades t1
             LEFT JOIN tbl_meta_predicate t2
             ON t1.Report >= t2.Minimum AND t1.Report <= t2.Maximum 
             LEFT JOIN tbl_meta_predicate t3
             ON t1.Report_SK >= t3.Minimum AND t1.Report_SK <= t3.Maximum
             SET 
                t1.Predicate = IF(t1.Report IS NULL, NULL, t2.Predicate),
                t1.Predicate_SK = IF(t1.Report_SK IS NULL, NULL, t3.Predicate),
                t1.Description = IF(t1.Report IS NULL, NULL, CONCAT(t2.COGFirst,'; ',t2.COGLast)),
                t1.Description_SK = IF(t1.Report_SK IS NULL, NULL, CONCAT(t3.SKFirst,'; ',t3.SKLast))
             WHERE t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.Room = '$room'
             AND t1.SubjName = '$subj'"
        );

        $this->db->trans_commit();

        return 'success';
    }

    public function model_update_recap_weight($semester, $room, $subj, $field, $value)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        if ($value == '') {
            $value = NULL;
        }

        $this->db->trans_begin();

        $this->db->update('tbl_05_subject_weight', [$field => $value], [
            'Class' => $room,
            'SubjName' => $subj
        ]);

        //UPDATE FINAL REPORT GRADE
        $this->db->query(
            "UPDATE tbl_09_det_grades 
             SET 
                Report = 
                    IF(KDRecapAvg IS NULL OR MidRecap IS NULL OR FinalRecap IS NULL, NULL, 
                        CEIL(
                            IF(KDRecapAvg IS NULL, 0, KDRecapAvg) * (SELECT (KDWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(MidRecap IS NULL, 0, MidRecap) * (SELECT (MidWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(FinalRecap IS NULL, 0, FinalRecap) * (SELECT (FinalWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(Absent IS NULL, 0, Absent) * (SELECT (Absent / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                        )
                    ),
                Report_SK =
                    IF(KDRecapAvg_SK IS NULL, NULL, 
                        CEIL(
                            IF(KDRecapAvg_SK IS NULL, 0, KDRecapAvg_SK) * (SELECT (KDWeight_SK / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                        )
                    )
             WHERE Room = '$room'
             AND SubjName = '$subj'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'"
        );

        //SET PREDICATE BASED ON REPORT
        $this->db->query(
            "UPDATE tbl_09_det_grades t1
             LEFT JOIN tbl_meta_predicate t2
             ON t1.Report >= t2.Minimum AND t1.Report <= t2.Maximum 
             LEFT JOIN tbl_meta_predicate t3
             ON t1.Report_SK >= t3.Minimum AND t1.Report_SK <= t3.Maximum
             SET 
                t1.Predicate = IF(t1.Report IS NULL, NULL, t2.Predicate),
                t1.Predicate_SK = IF(t1.Report_SK IS NULL, NULL, t3.Predicate),
                t1.Description = IF(t1.Report IS NULL, NULL, CONCAT(t2.COGFirst,'; ',t2.COGLast)),
                t1.Description_SK = IF(t1.Report_SK IS NULL, NULL, CONCAT(t3.SKFirst,'; ',t3.SKLast))
             WHERE t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.Room = '$room'
             AND t1.SubjName = '$subj'"
        );

        $this->db->trans_commit();

        return 'success';
    }

    public function model_sv_std_char_grades($nis, $name, $semester, $subj, $room, $type, $desc, $value)
    {

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        $check = $this->db->get_where('tbl_09_det_character', [
            'NIS' => $nis,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'Room' => $room,
            'SubjName' => $subj,
            'Type' => $type,
            'Description' => $desc
        ])->row();

        if ($value == '') {
            $value = NULL;
        }

        $this->db->trans_begin();

        if (empty($check)) {
            $this->db->insert('tbl_09_det_character', [
                'NIS' => $nis,
                'FullName' => $name,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Room' => $room,
                'SubjName' => $subj,
                'Type' => $type,
                'Description' => $desc,
                'Point' => $value
            ]);
        } else {
            $this->db->update('tbl_09_det_character', [
                'Point' => $value
            ], [
                'NIS' => $nis,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Room' => $room,
                'SubjName' => $subj,
                'Type' => $type,
                'Description' => $desc
            ]);
        }

        $report = '';
        $predicate = '';
        $Description = '';

        $div = $this->db->query(
            "SELECT COUNT(Point) AS Total FROM tbl_09_det_character 
             WHERE NIS = '$nis'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'
             AND Room = '$room'
             AND SubjName = '$subj'
             AND Type = '$type' 
             AND Point IS NOT NULL"
        )->row();

        if ($type == 'Social') {
            $report = 'Report_SOC';
            $predicate = 'Predicate_SOC';
            $Description = 'Description_SOC';
        } else if ($type == 'Spiritual') {
            $report = 'Report_SPR';
            $predicate = 'Predicate_SPR';
            $Description = 'Description_SPR';
        }

        //UPDATE GRADE REPORT SOCIAL / SPIRITUAL
        $this->db->query(
            "UPDATE tbl_09_det_grades SET $report = 
                FORMAT((SELECT SUM(Point) FROM tbl_09_det_character 
                    WHERE NIS = '$nis'
                    AND Semester = '$semester'
                    AND schoolyear = '$schYear'
                    AND Room = '$room'
                    AND SubjName = '$subj'
                    AND Type = '$type'
                ) / $div->Total, 1)
            WHERE NIS = '$nis'
            AND Semester = '$semester'
            AND schoolyear = '$schYear'
            AND Room = '$room'
            AND SubjName = '$subj'"
        );

        //UPDATE PREDICATE & DESCRIPTION SOCIAL / SPIRITUAL
        $this->db->query(
            "UPDATE tbl_09_det_grades t1 
             JOIN tbl_meta_character_weight t2
             ON t2.Minimum <= t1.$report AND t2.Maximum >= t1.$report
             SET 
                t1.$predicate = t2.Predicate,
                t1.$Description = t2.Char_Desc
             WHERE NIS = '$nis'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'
             AND Room = '$room'
             AND SubjName = '$subj'"
        );

        $this->db->trans_commit();

        return 'success';
    }

    public function model_sv_std_voc_grades($nis, $year, $semester, $subj, $room, $value){
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        $check = $this->db->get_where('tbl_09_det_voc_grades', [
            'NIS' => $nis,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'Room' => $room,
            'SubjName' => $subj
        ])->row();

        if ($value == '') {
            $value = NULL;
        }

        $this->db->trans_begin();

        $meta_predicate = $this->db->select("Predicate, SKFirst, SKLast")->where("Maximum >= '$value' AND Minimum <= '$value'")->get('tbl_meta_predicate')->row();

        if (empty($check)) {
            $this->db->insert('tbl_09_det_voc_grades', [
                'NIS' => $nis,
                'FullName' => $this->db->select("CONCAT(FirstName,' ',LastName) AS FullName")->where('IDNumber', $nis)->get('tbl_07_personal_bio')->row()->FullName,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Class' => $this->db->select('Simplified')->where('RoomDesc', $room)->get('tbl_04_class_rooms_vocational')->row()->Simplified,
                'Room' => $room,
                'SubjName' => $subj,
                'Report' => $value,
                'Predicate' => $meta_predicate->Predicate,
                'Description' => $meta_predicate->SKFirst .', '. $meta_predicate->SKLast
            ]);
        } else {
            $this->db->update('tbl_09_det_voc_grades', [
                'Report' => $value,
                'Predicate' => $meta_predicate->Predicate,
                'Description' => $meta_predicate->SKFirst .', '. $meta_predicate->SKLast
            ], [
                'NIS' => $nis,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Room' => $room,
                'SubjName' => $subj
            ]);
        }

        $this->db->trans_commit();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    public function model_get_std_grades($nis)
    {
        $query = $this->db->query(
            "SELECT t1.SubjID, t2.* 
             FROM tbl_05_subject t1
             INNER JOIN tbl_09_det_grades t2
             ON t1.SubjName = t2.SubjName
             WHERE t2.NIS = '$nis'"
        );

        return $query->result();
    }

    public function get_std_kd_grade($data)
    {

        extract($data);

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');


        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        $query = $this->db->query(
            "SELECT * FROM tbl_09_det_kd 
             WHERE NIS = '$nis'
             AND Semester = '$smstr'
             AND schoolyear = '$schYear'
             AND Room = '$room' 
             AND SubjName = '$subj'
             AND Type = '$type'
             AND Code = '$code'"
        )->row_array();

        return $query;
    }

    public function model_get_grade_report($nis, $cls, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $result = $this->db->get_where('tbl_09_det_grades', [
            'NIS' => $nis,
            'Class' => $cls,
            'Semester' => $semester,
            'schoolyear' => $schYear
        ]);

        return $result;
    }

    public function model_get_character_grade_compact($nis, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT SubjName, Report_SOC, Report_SPR, Predicate_SOC, Predicate_SPR, Description_SOC, Description_SPR
             FROM tbl_09_det_grades 
             WHERE NIS = '$nis' 
             AND Semester = '$semester' 
             AND schoolyear = '$schYear'"
        )->result();

        return $query;
    }

    public function model_get_voc_grade_compact($nis, $cls, $semester){
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT Report, Predicate, Description 
             FROM tbl_09_det_voc_grades 
             WHERE NIS = '$nis' 
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Class = '$cls'"
        );

        return ($query->num_rows() > 0 ? $query->row() : '');
    }

    public function get_std_kd_det($nis, $subj, $semester)
    {

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT t1.NIS, t1.FullName, t1.Semester, t1.schoolyear, t1.SubjName, t1.Type, t2.Code, t2.KD, t2.KKM, t1.KDAvg FROM tbl_09_det_kd t1
             LEFT JOIN tbl_05_subject_kd t2
             ON t1.SubjName = t2.SubjName AND t1.Type = t2.Type AND t1.Semester = t2.Semester AND t1.Code = t2.Code
             WHERE t1.NIS = '$nis'
             AND t1.SubjName = '$subj'
             AND t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             ORDER BY t2.CtrlNo"
        )->result();

        return $query;
    }

    public function get_std_exam_det($nis, $cls, $subj, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT 
                t1.NIS, 
                t1.FullName, 
                t3.Type,
                t1.KDRecapAVG, 
                t1.KDRecapAVG_SK, 
                t1.MidRecap, 
                t1.FinalRecap, 
                t2.KDWeight, 
                t2.KDWeight_SK,
                t2.MidWeight, 
                t2.FinalWeight, 
                t4.KD_KKM, 
                t4.Mid_KKM, 
                t4.Final_KKM,
                t4.Report_KKM 
             FROM tbl_09_det_grades t1
             JOIN tbl_05_subject_weight t2
             ON t1.SubjName = t2.SubjName
             JOIN tbl_03_class t3
             ON t1.Class = t3.ClassDesc
             JOIN tbl_meta_grade_weight t4
             ON t3.Type = t4.Degree
             WHERE t1.NIS = '$nis'
             AND t1.Class = '$cls'
             AND t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.SubjName = '$subj'
             GROUP BY t1.NIS"
        )->row();

        return $query;
    }

    public function get_std_voc_det($nis, $cls, $subj, $semester){
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT Report, Predicate, Description
             FROM tbl_09_det_voc_grades
             WHERE NIS = '$nis'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'
             AND Class = '$cls'
             AND SubjName = '$subj'"
        );

        return $query;
    }

    public function get_std_report_det($nis, $cls, $subj, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->get_where('tbl_09_det_grades', [
            'NIS' => $nis,
            'class' => $cls,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'SubjName' => $subj
        ])->row();

        return $query;
    }

    public function model_get_subject_list($nis, $cls, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT DISTINCT SubjName FROM tbl_09_det_grades
             WHERE NIS = '$nis'
             AND Class = '$cls'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'"
        )->result();

        return $query;
    }

    public function get_absent($nis, $cls, $semester)
    {
        $schYear = '';
        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $result = $this->db->query(
            "SELECT Ket, COUNT(Ket) AS Total FROM tbl_10_absent_std WHERE NIS = '$nis' AND Semester = '$semester' AND schoolyear = '$schYear' AND Kelas = '$cls' AND Ket = 'Sick'
             UNION ALL
             SELECT Ket, COUNT(Ket) AS Total FROM tbl_10_absent_std WHERE NIS = '$nis' AND Semester = '$semester' AND schoolyear = '$schYear' AND Kelas = '$cls' AND Ket = 'On Permit'
             UNION ALL
             SELECT Ket, COUNT(Ket) AS Total FROM tbl_10_absent_std WHERE NIS = '$nis' AND Semester = '$semester' AND schoolyear = '$schYear' AND Kelas = '$cls' AND Ket = 'Absent'
             UNION ALL
             SELECT Ket, COUNT(Ket) AS Total FROM tbl_10_absent_std WHERE NIS = '$nis' AND Semester = '$semester' AND schoolyear = '$schYear' AND Kelas = '$cls' AND Ket = 'Truant'
             UNION ALL
             SELECT Ket, COUNT(Ket) AS Total FROM tbl_10_absent_std WHERE NIS = '$nis' AND Semester = '$semester' AND schoolyear = '$schYear' AND Kelas = '$cls' AND Ket = 'Late'"
        );

        return $result;
    }

    public function get_print_absent($nis, $cls, $semester, $ket)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $query = $this->db->query(
            "SELECT COUNT(Ket) AS Total 
             FROM tbl_10_absent_std 
             WHERE NIS = '$nis'
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Kelas = '$cls' 
             AND Ket = '$ket'"
        );

        return $query->row();
    }

    public function get_spectrum()
    {
        $query = $this->db->query("SELECT * FROM tbl_meta_predicate ORDER BY Predicate DESC");

        return $query->result();
    }

    public function get_spectrum_asc()
    {
        $query = $this->db->query("SELECT * FROM tbl_meta_predicate ORDER BY Predicate ASC");

        return $query->result();
    }

    public function model_sv_kd_grades($data)
    {
        extract($data);

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        if ($value == '') {
            $value = NULL;
        }

        $this->db->trans_begin();
        $check = $this->db->get_where('tbl_09_det_kd', [
            'NIS' => $nis,
            'Room' => $room,
            'SubjName' => $subj,
            'Code' =>  $code,
            'Type' => $type,
            'Semester' => $semester,
            'schoolyear' => $schYear
        ])->row();

        if (empty($check)) {
            $this->db->insert('tbl_09_det_kd', [
                'NIS' => $nis,
                'FullName' => $fullname,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Class' => $cls,
                'Room' => $room,
                'SubjName' => $subj,
                'Type' => $type,
                'Code' =>  $code,
                $field => $value
            ]);
        } else {
            $this->db->update('tbl_09_det_kd', [
                $field => $value
            ], [
                'NIS' => $nis,
                'Room' => $room,
                'Type' => $type,
                'Code' =>  $code,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'SubjName' => $subj
            ]);
        }

        //CHANGE KDAvg TO NULL WHEN ALL KD Grade are NULL
        $this->db->query(
            "UPDATE tbl_09_det_kd 
             SET KDAvg = NULL 
             WHERE Grade1 IS NULL
             AND Grade2 IS NULL
             AND Grade3 IS NULL"
        );

        /* RECAP AND SUMMARY START HERE */

        //UPDATE EACH KD's AVERAGE
        if ($type == 'cognitive') {
            $this->db->query(
                "UPDATE tbl_09_det_kd
                 SET KDAvg = 
                        IF(Grade1 IS NULL AND Grade2 IS NULL AND Grade3 IS NULL, NULL, 
                            CEIL(
                                IF(Grade1 IS NULL, 0, 
                                    Grade1 * (SELECT IF(Weight1 IS NULL, 0, Weight1) / 100 FROM tbl_05_subject_kd WHERE SubjName = '$subj' AND Classes = '$cls' AND Type = '$type' AND Code = '$code' AND Semester = '$semester'))
                                +             
                                IF(Grade2 IS NULL, 0, 
                                    Grade2 * (SELECT IF(Weight2 IS NULL, 0, Weight2) / 100 FROM tbl_05_subject_kd WHERE SubjName = '$subj' AND Classes = '$cls' AND Type = '$type' AND Code = '$code' AND Semester = '$semester'))
                                +
                                IF(Grade3 IS NULL, 0, 
                                    Grade3 * (SELECT IF(Weight3 IS NULL, 0, Weight3) / 100 FROM tbl_05_subject_kd WHERE SubjName = '$subj' AND Classes = '$cls' AND Type = '$type' AND Code = '$code' AND Semester = '$semester'))
                            )
                        )
                 WHERE NIS = '$nis' 
                 AND SubjName = '$subj'
                 AND Room = '$room'
                 AND Semester = '$semester'
                 AND schoolyear = '$schYear'
                 AND Type = '$type'
                 AND Code = '$code'"
            );
        } elseif ($type == 'skills') {
            $this->db->update('tbl_09_det_kd', [
                'KDAvg' => $value
            ], [
                'NIS' => $nis,
                'SubjName' => $subj,
                'Room' => $room,
                'Semester' => $semester,
                'schoolyear' => $schYear,
                'Type' => $type,
                'Code' => $code
            ]);
        }


        //UPDATE AVERAGE OF ALL COMBINED KD
        $KDRecapAvg = '';
        if ($type == 'cognitive') {
            $KDRecapAvg = 'KDRecapAvg';
        } else {
            $KDRecapAvg = 'KDRecapAvg_SK';
        }

        $this->db->query(
            "UPDATE tbl_09_det_grades 
             SET $KDRecapAvg = CEIL(
                    (SELECT SUM(KDAvg) / 
                        (SELECT COUNT(NIS) 
                            FROM tbl_09_det_kd 
                            WHERE NIS = '$nis'
                            AND Semester = '$semester' 
                            AND schoolyear = '$schYear' 
                            AND Room = '$room' 
                            AND SubjName = '$subj' 
                            AND Type = '$type'
                            AND KDAvg IS NOT NULL
                        ) 
                    FROM tbl_09_det_kd 
                    WHERE NIS = '$nis' 
                    AND Semester = '$semester' 
                    AND schoolyear = '$schYear' 
                    AND Room = '$room' 
                    AND SubjName = '$subj' 
                    AND Type = '$type'
                    )) 
             WHERE NIS = '$nis' 
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Room = '$room' 
             AND SubjName = '$subj'"
        );

        //UPDATE FINAL REPORT GRADE
        $this->db->query(
            "UPDATE tbl_09_det_grades 
             SET 
                Report = 
                    IF(KDRecapAvg IS NULL OR MidRecap IS NULL OR FinalRecap IS NULL, NULL, 
                        CEIL(
                            IF(KDRecapAvg IS NULL, 0, KDRecapAvg) * (SELECT (KDWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(MidRecap IS NULL, 0, MidRecap) * (SELECT (MidWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(FinalRecap IS NULL, 0, FinalRecap) * (SELECT (FinalWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                            +
                            IF(Absent IS NULL, 0, Absent) * (SELECT (Absent / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                        )
                    ),
                Report_SK =
                    IF(KDRecapAvg_SK IS NULL, NULL, 
                        CEIL(
                            IF(KDRecapAvg_SK IS NULL, 0, KDRecapAvg_SK) * (SELECT (KDWeight_SK / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                        )
                    )
             WHERE NIS = '$nis' 
             AND Room = '$room'
             AND SubjName = '$subj'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'"
        );

        //SET PREDICATE BASED ON REPORT
        $this->db->query(
            "UPDATE tbl_09_det_grades t1
             LEFT JOIN tbl_meta_predicate t2
             ON t1.Report >= t2.Minimum AND t1.Report <= t2.Maximum 
             LEFT JOIN tbl_meta_predicate t3
             ON t1.Report_SK >= t3.Minimum AND t1.Report_SK <= t3.Maximum
             SET 
                t1.Predicate = IF(t1.Report IS NULL, NULL, t2.Predicate),
                t1.Predicate_SK = IF(t1.Report_SK IS NULL, NULL, t3.Predicate),
                t1.Description = IF(t1.Report IS NULL, NULL, CONCAT(t2.COGFirst,'; ',t2.COGLast)),
                t1.Description_SK = IF(t1.Report_SK IS NULL, NULL, CONCAT(t3.SKFirst,'; ',t3.SKLast))
             WHERE t1.NIS = '$nis' 
             AND t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.Room = '$room'
             AND t1.SubjName = '$subj'"
        );

        $this->db->trans_commit();

        return 'success';
    }

    public function model_sv_exam_grades($data)
    {
        extract($data);

        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        //VARIABLE FROM AJAX TEACHER-PERSONAL
        $period = (isset($_POST['period']) ? $_POST['period'] : NULL);

        if ($period === NULL) {
            if (date('n', strtotime($time)) <= 6) {
                $schYear = ($year - 1) . '/' . $year;
            } else {
                $schYear = $year . '/' . ($year + 1);
            }
        } else {
            $schYear = $period;
        }

        if ($value == '') {
            $value = NULL;
        }

        $Report;
        $Predicate;
        $Desc;

        if ($type == 'cognitive') {
            $Report = 'Report';
            $Predicate = 'Predicate';
            $Desc = 'Description';
        } else {
            $Report = 'Report_SK';
            $Predicate = 'Predicate_SK';
            $Desc = 'Description_SK';
        }

        $this->db->trans_begin();

        $this->db->update('tbl_09_det_grades', [
            $field => $value
        ], [
            'NIS' => $nis,
            'Room' => $room,
            'Semester' => $semester,
            'schoolyear' => $schYear,
            'SubjName' => $subj
        ]);

        //SET REMEDIAL PRIORITY
        $this->db->query(
            "UPDATE tbl_09_det_grades 
             SET 
                MidRecap = IF(MidRemedial IS NULL, MidTest, MidRemedial),
                FinalRecap = IF(FinalRemedial IS NULL, Final, FinalRemedial)
             WHERE NIS = '$nis' 
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Room = '$room' 
             AND SubjName = '$subj'"
        );

        //UPDATE FINAL REPORT GRADE
        $this->db->query(
            "UPDATE tbl_09_det_grades 
             SET 
                 Report = 
                     IF(KDRecapAvg IS NULL OR MidRecap IS NULL OR FinalRecap IS NULL, NULL, 
                         CEIL(
                             IF(KDRecapAvg IS NULL, 0, KDRecapAvg) * (SELECT (KDWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                             +
                             IF(MidRecap IS NULL, 0, MidRecap) * (SELECT (MidWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                             +
                             IF(FinalRecap IS NULL, 0, FinalRecap) * (SELECT (FinalWeight / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                             +
                             IF(Absent IS NULL, 0, Absent) * (SELECT (Absent / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                         )
                     ),
                 Report_SK =
                     IF(KDRecapAvg_SK IS NULL, NULL, 
                         CEIL(
                             IF(KDRecapAvg_SK IS NULL, 0, KDRecapAvg_SK) * (SELECT (KDWeight_SK / 100) FROM tbl_05_subject_weight WHERE Class = '$room' AND SubjName = '$subj')
                         )
                     )
             WHERE NIS = '$nis'
             AND Room = '$room'
             AND SubjName = '$subj'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'"
        );

        //SET PREDICATE BASED ON REPORT
        $this->db->query(
            "UPDATE tbl_09_det_grades t1
             LEFT JOIN tbl_meta_predicate t2
             ON t1.Report >= t2.Minimum AND t1.Report <= t2.Maximum 
             LEFT JOIN tbl_meta_predicate t3
             ON t1.Report_SK >= t3.Minimum AND t1.Report_SK <= t3.Maximum
             SET 
                t1.Predicate = IF(t1.Report IS NULL, NULL, t2.Predicate),
                t1.Predicate_SK = IF(t1.Report_SK IS NULL, NULL, t3.Predicate),
                t1.Description = IF(t1.Report IS NULL, NULL, CONCAT(t2.COGFirst,'; ',t2.COGLast)),
                t1.Description_SK = IF(t1.Report_SK IS NULL, NULL, CONCAT(t3.SKFirst,'; ',t3.SKLast))
             WHERE t1.Semester = '$semester'
             AND t1.schoolyear = '$schYear'
             AND t1.Room = '$room'
             AND t1.SubjName = '$subj'"
        );

        $this->db->trans_commit();

        return 'success';
    }

    public function model_get_grade_weight($lvl)
    {
        $result = $this->db->get_where('tbl_05_subject_weight', ['Degree' => $lvl]);

        return $result;
    }

    public function model_get_grade_weight_nat($degree)
    {
        $query = $this->db->get_where('tbl_meta_grade_weight_nat', ['Degree' => $degree]);

        return $query;
    }

    public function modal_save_nat_weight($degree, $type, $field, $val)
    {
        $this->db->update('tbl_meta_grade_weight_nat', [$field => $val], [
            'Degree' => $degree,
            'Type' => $type
        ]);
    }

    public function model_sv_active_days($degree, $value)
    {
        $this->db->update('tbl_meta_active_days', ['Total' => $value], ['Degree' => $degree]);

        if ($this->db->affected_rows()) {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function model_sv_grade_weight($data)
    {
        extract($data);

        $val = ($value == '' ? NULL : $value);

        $this->db->trans_begin();

        //DO AVAILABILITY CHECKING
        $check = $this->db->query(
            "SELECT t1.Degree FROM tbl_05_subject_weight t1
             LEFT JOIN tbl_04_class_rooms t2
             ON t1.Degree = t2.Type
             LEFT JOIN tbl_04_class_rooms t3
             ON t1.Degree = t3.Type
             WHERE t1.Degree = '$degree'
             GROUP BY t1.Degree"
        )->result();

        //INSERT NEW IF EMPTY, AND UPDATE IF DATA ALREADY EXISTS
        if (empty($check)) {
            //Get class list
            $list = $this->db->query(
                "SELECT RoomDesc, ClassNumeric 
                 FROM tbl_04_class_rooms AS rooms
                 LEFT JOIN tbl_03_class AS class
                 USING(ClassID)
                 UNION ALL 
                 SELECT RoomDesc, ClassNumeric
                 FROM tbl_04_class_rooms_vocational AS rooms
                 LEFT JOIN tbl_03_b_class_vocational AS class
                 ON class.ClassDesc = rooms.Simplified
                 ORDER BY ClassNumeric"
            )->row_array();

            $this->db->query(
                "INSERT INTO tbl_05_subject_weight 
                 (Degree, Class, SubjName, $field)
                 SELECT rooms.Type, rooms.RoomDesc, subj.SubjName, $value
                 FROM tbl_04_class_rooms AS rooms
                 LEFT JOIN tbl_03_class AS class
                    USING(ClassID)
                 LEFT JOIN tbl_05_subject AS subj
                 	ON subj.Degree = rooms.Type
                 WHERE rooms.Type = '$degree'
                 AND subj.SubjName NOT IN('','-','None','ELECTIVE','EXCUL','0')
                 UNION ALL
                 SELECT rooms.Type, rooms.RoomDesc, subj.SubjName, $value
                 FROM tbl_04_class_rooms_vocational AS rooms
                 LEFT JOIN tbl_03_b_class_vocational AS class
                    ON class.ClassDesc = rooms.Simplified
                 LEFT JOIN tbl_05_subject AS subj
                 	ON subj.Degree = rooms.Type
                 WHERE rooms.Type = '$degree'
                 AND subj.SubjName NOT IN('','-','None','ELECTIVE','EXCUL','0')"
            );
        } else {
            $this->db->update(
                'tbl_05_subject_weight',
                [
                    $field => $val
                ],
                [
                    'Degree' => $degree
                ]
            );
        }

        $this->db->trans_commit();

        return 'success';
    }

    public function modal_get_kkm($degree)
    {
        $query = $this->db->query(
            "SELECT KKM FROM tbl_05_subject_kd
             WHERE Classes IN (SELECT ClassRomanic FROM tbl_03_class WHERE Type = '$degree') "
        )->first_row();

        return $query;
    }

    public function modal_save_new_kkm($lvl, $kkm)
    {
        $this->db->query(
            "UPDATE tbl_05_subject_kd
             SET KKM = '$kkm'
             WHERE Classes IN (SELECT ClassRomanic FROM tbl_03_class WHERE Type = '$lvl')"
        );

        if ($this->db->affected_rows()) {
            return 'success';
        }
    }

    public function get_predicate()
    {
        $result = $this->db->get('SELECT Predicate FROM tbl_meta_predicate WHERE Maximum >= 67 AND Minimum <= 67');

        return $result;
    }

    public function model_post_predicate($predicate, $max, $min)
    {
        $this->db->update('tbl_meta_predicate', [
            'Maximum' => $max,
            'Minimum' => $min
        ], [
            'Predicate' => $predicate
        ]);
    }

    public function get_report_print_info($nis, $cls, $subj, $semester, $report_type)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        if ($report_type == 'full') {
            $query = $this->db->query(
                "SELECT 
                    t1.NIS, 
                    t1.FullName, 
                    t1.SubjName, 
                    t1.Semester, 
                    t1.schoolyear, 
                    t1.Room, 
                    t2.SchoolName, 
                    t3.IDNumber, 
                    t3.TeacherName,
                    t4.StudyFocus
                 FROM tbl_09_det_grades t1
                 JOIN tbl_02_school t2
                 ON t2.School_Desc = (SELECT Type FROM tbl_03_class WHERE ClassDesc = t1.Class)
                 JOIN tbl_06_schedule t3
                 ON t1.SubjName = t3.SubjName AND t1.Room = t3.RoomDesc
                 JOIN tbl_08_job_info t4
                 ON t3.IDNumber = t4.IDNumber
                 WHERE t1.NIS = '$nis'
                 AND t1.Class = '$cls'
                 AND t1.Semester = '$semester'
                 AND t1.schoolyear = '$schYear'
                 AND t1.SubjName = '$subj'"
            )->row();    
        } elseif ($report_type == 'mid') {
            $query = $this->db->query(
                "SELECT
                    t1.NIS, 
                    t1.FullName, 
                    t1.Semester, 
                    t1.schoolyear, 
                    t1.Room, 
                    t2.SchoolName, 
                    t3.IDNumber,
                    CONCAT(t4.FirstName,' ',t4.LastName) As TeacherName,
                    t3.StudyFocus
                 FROM tbl_09_det_grades t1
                 LEFT JOIN tbl_02_school t2
                 ON t2.School_Desc = (SELECT Type FROM tbl_03_class WHERE ClassDesc = t1.Class)
                 LEFT JOIN tbl_08_job_info t3
                 ON t1.Room = t3.Homeroom
                 LEFT JOIN tbl_07_personal_bio t4
                 ON t4.IDNumber = t3.IDNumber
                 WHERE t1.NIS = '$nis'
                 AND t1.Class = '$cls'
                 AND t1.Semester = '$semester'
                 AND t1.schoolyear = '$schYear'
                 GROUP BY t1.NIS"
            )->row();
        }

        return $query;
    }

    public function get_report_mid_grade($nis, $cls, $semester)
    {
        $schYear = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
        } else {
            $schYear = $year . '/' . ($year + 1);
        }

        $check = $this->db->get_where('tbl_03_class',[ 'ClassDesc' => $cls ])->row();

        $cls_romanic = ($check->Type == 'SMA') ? $check->ClassRomanic : $cls;

        $query = $this->db->query(
            "SELECT DISTINCT t1.SubjName, t2.KKM, t1.MidRecap FROM tbl_09_det_grades t1
             JOIN tbl_05_subject_kd t2 
             ON t1.SubjName = t2.SubjName
             WHERE t1.Class = '$cls'
             AND t2.Classes = '$cls_romanic'
             AND t1.Semester = '$semester'
             AND t1.NIS = '$nis'
             AND t1.schoolyear = '$schYear'
             AND t2.Type = 'cognitive'
             GROUP BY t1.SubjName"
        );

        $score = 0;
        $qry = $query->result_array();

        for ($i = 0; $i < count($qry); $i++) {
            $score += $qry[$i]['MidRecap'];
        }

        $average = $score / count($qry);
        $average = (fmod($average, 1) !== 0.00 ? number_format($average, 2, ",", ".") : $average);

        return [$query->result(), $score, $average];
    }
}
