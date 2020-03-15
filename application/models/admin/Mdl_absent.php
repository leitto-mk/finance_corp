<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_absent extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function model_get_classes()
    {
        $query = $this->db->query(
            "SELECT t1.RoomDesc FROM tbl_04_class_rooms t1
             JOIN tbl_02_school t2
             ON t1.Type = t2.School_Desc
             JOIN tbl_03_class t3 
             ON t1.ClassID = t3.ClassID
             WHERE t2.isActive = 1
             ORDER BY t3.ClassNumeric, t1.RoomDesc ASC"
        );

        return $query->result();
    }

    public function modal_tbl_search_std($room)
    {
        $result = $this->db->query(
            "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName 
             FROM tbl_07_personal_bio t1 
             JOIN tbl_08_job_info_std t2
             ON t1.IDNumber = t2.NIS
             WHERE t2.Ruangan = '$room'"
        );

        return $result->result();
    }

    public function modal_tbl_search_personal($data, $status)
    {
        if ($status == 'student') {
            $result = $this->db->query(
                "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName 
                FROM tbl_07_personal_bio t1 
                JOIN tbl_08_job_info_std t2
                ON t1.IDNumber = t2.NIS
                WHERE t1.FirstName LIKE '$data%'
                OR t1.LastNAme LIKE '$data%'
                OR t2.NIS LIKE '$data%'
                ORDER BY FullName"
            );
        } else {
            $result = $this->db->query(
                "SELECT t1.IDNumber, CONCAT(FirstName,' ',LastName) AS FullName 
                FROM tbl_07_personal_bio t1 
                JOIN tbl_08_job_info t2
                ON t1.IDNumber = t2.IDNumber
                WHERE t1.FirstName LIKE '$data%'
                OR t1.LastNAme LIKE '$data%'
                OR t2.IDNumber LIKE '$data%'
                ORDER BY FullName"
            );
        }

        return $result->result();
    }

    public function get_absent_type()
    {
        $query = $this->db->get('tbl_meta_absent');

        return $query->result();
    }

    public function model_get_cur_subject($room)
    {
        $schYear = '';
        $semester = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
            $semester = 2;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        $query = $this->db->query(
            "SELECT DISTINCT SubjName FROM tbl_06_schedule
             WHERE RoomDesc = '$room'
             AND Semester = '$semester'
             AND schoolyear = '$schYear'"
        )->result();

        return $query;
    }

    public function model_insert_absent($id, $type, $date, $subj, $hour, $status)
    {
        $schYear = '';
        $semester = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
            $semester = 2;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        if ($status == 'student') {
            //GET DATA BASED ON LIST
            $query = $this->db->query(
                "SELECT DISTINCT NIS, FullName, Class, Room FROM tbl_09_det_grades
			     WHERE NIS IN ($id)"
            )->result_array();

            if (count($query) > 1) {
                $i = 0;
                $attendance = [];

                //NEW ARRAY FOR BATCH STORING
                for ($i; $i < count($query); $i++) {
                    array_push($attendance, [
                        'NIS' => $query[$i]['NIS'],
                        'FullName' => $query[$i]['FullName'],
                        'Kelas' => $query[$i]['Class'],
                        'Ruang' => $query[$i]['Room'],
                        'Semester' =>  $semester,
                        'schoolyear' =>  $schYear,
                        'SubjDesc' =>  $subj,
                        'Hour' =>  $hour,
                        'Absent' =>  date('Y-m-d', strtotime($date)),
                        'Ket' =>  $type
                    ]);
                }

                //INSERT BATCH FROM ARRAY
                $this->db->insert_batch('tbl_10_absent_std', $attendance);
            } else {
                $this->db->insert('tbl_10_absent_std', [
                    'NIS' => $query[0]['NIS'],
                    'FullName' => $query[0]['FullName'],
                    'Kelas' => $query[0]['Class'],
                    'Ruang' => $query[0]['Room'],
                    'Semester' =>  $semester,
                    'schoolyear' =>  $schYear,
                    'SubjDesc' =>  $subj,
                    'Hour' =>  $hour,
                    'Absent' =>  date('Y-m-d', strtotime($date)),
                    'Ket' =>  $type
                ]);
            }

            //COUNT ABSENT GRADES
            if (!empty($check)) {
                $this->db->query(
                    "UPDATE tbl_09_det_grades t1
                    RIGHT JOIN tbl_10_absent_std t2
                    ON t1.NIS = t2.NIS AND t2.NIS IN ($id)
                    SET t1.Absent = 
                        CEIL(
                                (
                                    (
                                        (SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$query[0]['Room']')) 
                                        -
                                        (SELECT COUNT(Ket) FROM tbl_10_absent_std WHERE NIS = t2.NIS AND Semester = '$semester' AND schoolyear = '$schYear' AND Ket IN ('Absent','On Permit','Sick'))
                                    ) 
                                    / 
                                    (SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$query[0]['Room']'))
                                ) * 100
                            )
                    WHERE t1.Semester = '$semester'
                    AND t1.schoolyear = '$schYear'
                    AND t1.Room = '$query[0]['Room']'"
                );
            }

            $this->db->trans_commit();
        } else {
            $teacher = $this->db->query(
                "SELECT IDNumber, CONCAT(FirstName,' ',LastName) AS FullName
                 FROM tbl_07_personal_bio t1
                 WHERE IDNumber IN ($id)"
            )->result_array();

            $attd_tch = [];

            if (count($teacher) > 1) {
                for ($i = 0; $i < count($teacher); $i++) {
                    array_push($attd_tch, [
                        'IDNumber' => $teacher[$i]['IDNumber'],
                        'FullName' => $teacher[$i]['FullName'],
                        'Semester' => $semester,
                        'schoolyear' => $schYear,
                        'status' => $status,
                        'Absent' => date('Y-m-d', strtotime($date)),
                        'Ket' => $type
                    ]);
                }

                $this->db->insert_batch('tbl_10_absent', $attd_tch);
            } else {
                $this->db->insert('tbl_10_absent', [
                    'IDNumber' => $teacher[0]['IDNumber'],
                    'FullName' => $teacher[0]['FullName'],
                    'Semester' => $semester,
                    'schoolyear' => $schYear,
                    'status' => $status,
                    'Absent' => date('Y-m-d', strtotime($date)),
                    'Ket' => $type
                ]);
            }
        }
    }

    public function model_total_absn($data, $status)
    {
        $schYear = '';
        $semester = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
            $semester = 2;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        if ($status == 'student') {
            $result = $this->db->from('tbl_10_absent_std')->where([
                'NIS' => $data,
                'Semester' => $semester,
                'schoolyear' => $schYear
            ])->count_all_results();
        } else {
            $result = $this->db->from('tbl_10_absent')->where([
                'IDNumber' => $data,
                'Semester' => $semester,
                'schoolyear' => $schYear
            ])->count_all_results();
        }

        return $result;
    }

    public function model_get_absn_list($data, $status)
    {
        $schYear = '';
        $semester = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
            $semester = 2;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        if ($status == 'student') {
            $result = $this->db->query("SELECT Absent FROM tbl_10_absent_std WHERE NIS = '$data' AND Semester = '$semester' AND schoolyear = '$schYear'");
        } else {
            $result = $this->db->query("SELECT Absent FROM tbl_10_absent WHERE IDNumber = '$data' AND Semester = '$semester' AND schoolyear = '$schYear'");
        }

        return $result->result();
    }

    public function get_absn_det($data, $status)
    {
        $schYear = '';
        $semester = '';

        $time = date('d-m-Y');
        $year = date('Y');

        if (date('n', strtotime($time)) <= 6) {
            $schYear = ($year - 1) . '/' . $year;
            $semester = 2;
        } else {
            $schYear = $year . '/' . ($year + 1);
            $semester = 1;
        }

        if ($status == 'student') {
            $result = $this->db->query("SELECT * FROM tbl_10_absent_std WHERE NIS = '$data' AND Semester = '$semester' AND schoolyear = '$schYear' ORDER BY Absent ASC");
        } else {
            $result = $this->db->query("SELECT * FROM tbl_10_absent WHERE IDNumber = '$data' AND Semester = '$semester' AND schoolyear = '$schYear' ORDER BY Absent ASC");
        }

        return $result;
    }
}
