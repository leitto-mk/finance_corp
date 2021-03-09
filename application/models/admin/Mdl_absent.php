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
            "SELECT t1.RoomDesc, t3.ClassNumeric
             FROM tbl_04_class_rooms t1
             JOIN tbl_02_school t2
                ON t1.Type = t2.School_Desc
             JOIN tbl_03_class t3 
                ON t1.ClassID = t3.ClassID
             WHERE t2.isActive = 1
             UNION ALL
             SELECT room.RoomDesc, class.ClassNumeric
             FROM tbl_02_school school
             LEFT JOIN tbl_03_b_class_vocational AS class 
             	ON school.School_Desc = class.Type
			 RIGHT JOIN tbl_04_class_rooms_vocational AS room
             	ON class.ClassDesc = room.Simplified
             WHERE school.isActive = 1
             ORDER BY ClassNumeric, RoomDesc"
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
            //DELETE CURRENT DATE IF IT'S NONE
            if($type == 'None'){
                $this->db->where("NIS IN ($id)")
                         ->where('Absent', date('Y-m-d', strtotime($date)))
                         ->delete('tbl_10_absent_std');
            }else{
                //GET DATA BASED ON LIST
                $query = $this->db->query(
                    "SELECT NIS, FullName, Class, Room FROM tbl_09_det_grades
                     WHERE NIS IN ($id)
                     AND Semester = '$semester'
                     AND schoolyear = '$schYear'
                     GROUP BY NIS"
                )->result_array();
    
                //NEW ARRAY FOR BATCH STORING
                for ($i = 0; $i < count($query); $i++) {
                    //Check if current Date & Attendance is Duplicate
                    $duplicate = $this->db->get_where('tbl_10_absent_std', [
                        'NIS' => $query[$i]['NIS'],
                        'Absent' => date('Y-m-d', strtotime($date))
                    ])->num_rows();
    
                    if($duplicate > 0){
                        $this->db->update('tbl_10_absent_std', [
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
                        ],[
                            'NIS' => $query[$i]['NIS'],
                            'Absent' => date('Y-m-d', strtotime($date))
                        ]);
                    }else{
                        $this->db->insert('tbl_10_absent_std', [
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
                }
            }

            // $this->db->query(
            //     "UPDATE tbl_09_det_grades t1
            //      RIGHT JOIN tbl_10_absent_std t2
            //      ON t1.NIS = t2.NIS AND t2.NIS IN ($id)
            //      SET t1.Absent = 
            //         CEIL(
            //                 (
            //                     (
            //                         (SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$query[0]['Room']')) 
            //                         -
            //                         (SELECT COUNT(Ket) FROM tbl_10_absent_std WHERE NIS = t2.NIS AND Semester = '$semester' AND schoolyear = '$schYear' AND Ket IN ('Absent','On Permit','Sick'))
            //                     ) 
            //                     / 
            //                     (SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$query[0]['Room']'))
            //                 ) * 100
            //             )
            //      WHERE t1.Semester = '$semester'
            //      AND t1.schoolyear = '$schYear'
            //      AND t1.Room = '$query[0]['Room']'"
            // );
        } else {
            if($type == 'None'){
                $this->db->where_in('IDNumber', $id)
                         ->where('Absent', date('Y-m-d', strtotime($date)))
                         ->delete('tbl_10_absent');
            }else{
                $teacher = $this->db->query(
                    "SELECT IDNumber, CONCAT(FirstName,' ',LastName) AS FullName
                     FROM tbl_07_personal_bio t1
                     WHERE IDNumber IN ($id)"
                )->result_array();

                //NEW ARRAY FOR BATCH STORING
                for ($i = 0; $i < count($teacher); $i++) {
                    //Check if current Date & Attendance is Duplicate
                    $duplicate = $this->db->get_where('tbl_10_absent', [
                        'IDNumber' => $query[$i]['NIS'],
                        'Absent' => date('Y-m-d', strtotime($date))
                    ])->num_rows();
    
                    if($duplicate > 0){
                        $this->db->update('tbl_10_absent_std', [
                            'IDNumber' => $teacher[$i]['IDNumber'],
                            'FullName' => $teacher[$i]['FullName'],
                            'Semester' => $semester,
                            'schoolyear' => $schYear,
                            'status' => $status,
                            'Absent' => date('Y-m-d', strtotime($date)),
                            'Ket' => $type
                        ],[
                            'IDNumber' => $teacher[$i]['IDNumber'],
                            'Absent' => date('Y-m-d', strtotime($date))
                        ]);
                    }else{
                        $this->db->insert('tbl_10_absent_std', [
                            'IDNumber' => $teacher[$i]['IDNumber'],
                            'FullName' => $teacher[$i]['FullName'],
                            'Semester' => $semester,
                            'schoolyear' => $schYear,
                            'status' => $status,
                            'Absent' => date('Y-m-d', strtotime($date)),
                            'Ket' => $type
                        ]);
                    }
                }
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
