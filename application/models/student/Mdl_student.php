<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_student extends CI_Model
{
    public function show_prof($session)
    {
        $result = $this->db->query("SELECT * FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info_std AS t2
        ON t1.IDNumber = '$session'")->row();

        return $result;
    }

    public function get_full_profile($id)
    {
        $query = $this->db->query(
            "SELECT t1.*, t2.* FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
             ON t1.IDNumber = t2.NIS
             WHERE t1.IDNumber = '$id'"
        )->row();

        return $query;
    }

    public function get_period($id)
    {
        $query = $this->db->query(
            "SELECT DISTINCT Semester, schoolyear FROM tbl_09_det_grades WHERE NIS = '$id' ORDER BY schoolyear, Semester"
        )->result_array();

        return array_reverse($query);
    }

    public function get_schedule_full($id, $semester, $period)
    {

        $level = $this->db->query(
            "SELECT 
                t1.Type, 
                t2.Room 
             FROM tbl_04_class_rooms t1
             JOIN tbl_09_det_grades t2
             ON t1.RoomDesc = t2.Room
             WHERE t2.NIS = '$id'
             AND Semester = '$semester'
             AND schoolyear = '$period'
             UNION ALL
             SELECT 
                t1.Type, 
                t2.Room 
             FROM tbl_04_class_rooms_vocational t1
             JOIN tbl_09_det_grades t2
             ON t1.RoomDesc = t2.Room
             WHERE t2.NIS = '$id'
             AND Semester = '$semester'
             AND schoolyear = '$period'"
        )->first_row();

        if ($level->Type == 'SD') {
            $table = 'tbl_meta_hour_elementary';
        } elseif ($level->Type == 'SMP') {
            $table = 'tbl_meta_hour_junior';
        } elseif ($level->Type == 'SMA') {
            $table = 'tbl_meta_hour_high';
        } elseif ($level->Type == 'SMK') {
            $table = 'tbl_meta_hour_vocational';
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
                    ON TIME_FORMAT(r1.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r1.RoomDesc = '$level->Room' AND r1.semester = '$semester' AND r1.schoolyear = '$period' AND r1.Days = 'Senin'
                LEFT JOIN tbl_06_schedule r2 
                    ON TIME_FORMAT(r2.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r2.RoomDesc = '$level->Room' AND r2.semester = '$semester' AND r2.schoolyear = '$period' AND r2.Days = 'Selasa'
                LEFT JOIN tbl_06_schedule r3 
                    ON TIME_FORMAT(r3.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r3.RoomDesc = '$level->Room' AND r3.semester = '$semester' AND r3.schoolyear = '$period' AND r3.Days = 'Rabu'
                LEFT JOIN tbl_06_schedule r4 
                    ON TIME_FORMAT(r4.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r4.RoomDesc = '$level->Room' AND r4.semester = '$semester' AND r4.schoolyear = '$period' AND r4.Days = 'Kamis'
                LEFT JOIN tbl_06_schedule r5 
                    ON TIME_FORMAT(r5.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r5.RoomDesc = '$level->Room' AND r5.semester = '$semester' AND r5.schoolyear = '$period' AND r5.Days = 'Jumat'
                LEFT JOIN tbl_06_schedule r6
                    ON TIME_FORMAT(r6.Hour,'%H:%i') = TIME_FORMAT(start.Hour,'%H:%i') AND r6.RoomDesc = '$level->Room' AND r6.semester = '$semester' AND r6.schoolyear = '$period' AND r6.Days = 'Sabtu'
                GROUP BY r0.Hour ASC"
        );

        return $result->result();
    }

    public function get_absence_full($id, $semester, $period)
    {
        $query = $this->db->get_where('tbl_10_absent_std', [
            'NIS' => $id,
            'Semester' => $semester,
            'schoolyear' => $period
        ])->result();

        return $query;
    }

    public function get_schedule($id, $day, $room)
    {
        $schYear = '';

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
            "SELECT 
                Sch.Days,
                TIME_FORMAT(Sch.Hour, '%H:%i') AS Hour,
                Grd.SubjName,
                Sch.TeacherName
             FROM tbl_09_det_grades AS Grd
             LEFT JOIN tbl_06_schedule AS Sch
                    ON Sch.RoomDesc = Grd.Room 
                    AND Sch.SubjName = Grd.SubjName
                    AND Sch.semester = Grd.semester
                    AND Sch.schoolyear = Grd.schoolyear
                WHERE Grd.NIS = '$id'
                AND Grd.Semester = '$semester'
                AND Grd.schoolyear = '$schYear'
                AND Sch.Days = '$day'
                AND Sch.Days IS NOT NULL 
                AND Sch.Hour IS NOT NULL
                GROUP BY Grd.SubjName
             UNION ALL
             SELECT 
                Non.Days,
                Non.Hour,
                Grd.SubjName,
                Non.TeacherName
             FROM tbl_09_det_grades AS Grd
             LEFT JOIN tbl_06_schedule_nonregular AS Non
                    ON Non.RoomDesc = Grd.Room 
                    AND Non.SubjName = Grd.SubjName
                    AND Non.semester = Grd.semester
                    AND Non.schoolyear = Grd.schoolyear
                WHERE Grd.NIS = '$id'
                AND Grd.Semester = '$semester'
                AND Grd.schoolyear = '$schYear'
                AND Non.Days = '$day'
                AND Non.Days IS NOT NULL 
                AND Non.Hour IS NOT NULL
             GROUP BY Grd.SubjName
             ORDER BY Hour ASC"
        )->result();

        return $query;
    }

    public function get_school_detail($room)
    {
        $homeroom = $this->db->query(
            "SELECT 
                t1.FirstName, 
                t1.LastName, 
                t2.Homeroom 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info t2
             ON t1.IDNumber = t2.IDNumber
             WHERE Homeroom = '$room'"
        )->row();

        if(empty($homeroom)){
            $homeroom = '-';
        }else{
            $homeroom = "$homeroom->FirstName $homeroom->LastName";
        }

        $total = $this->db->query("SELECT COUNT(NIS) AS Total FROM tbl_08_job_info_std WHERE Ruangan = '$room'")->row();

        $data = [
            'homeroom' => $homeroom,
            'total' => $total->Total
        ];

        return $data;
    }

    public function get_absent($id, $room, $ket)
    {
        $schYear = '';

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
            "SELECT COUNT(KET) AS Absence 
             FROM tbl_10_absent_std 
             WHERE NIS = '$id' 
             AND Ruang = '$room' 
             AND Semester = '$semester' 
             AND schoolyear = '$schYear' 
             AND Ket = '$ket'"
        )->row();

        return $query->Absence;
    }

    public function model_get_full_acd_detail($id, $semester, $period)
    {
        $grade = $this->db->query(
            "SELECT 
                SubjName,
                Report,
                Report_SK,
                Report_SOC,
                Report_SPR,
                Predicate,
                Predicate_SK,
                Predicate_SOC,
                Predicate_SPR,
                Description,
                Description_SK,
                Description_SOC,
                Description_SPR
             FROM tbl_09_det_grades 
             WHERE NIS = '$id' 
             AND Semester = '$semester' 
             AND schoolyear = '$period'
             GROUP BY SubjName"
        )->result();

        $voc = $this->db->query(
            "SELECT 
                SubjName,
                Report, 
                Predicate,
                Description
             FROM tbl_09_det_voc_grades 
             WHERE NIS = '$id'
             AND Semester = '$semester' 
             AND schoolyear = '$period'
             GROUP BY SubjName"
        )->result();
        
        return [$grade, $voc];
    }

    public function sv_pass($id, $newpass)
    {
        $this->db->query(
            "UPDATE tbl_credentials 
    		 SET 
    		 	password = '$newpass' 
			 WHERE IDNumber = '$id'"
        );

        return 'success';
    }
}
