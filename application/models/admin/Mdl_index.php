<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_index extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function count_specific($status)
    {
        $this->db->from('tbl_07_personal_bio');
        $this->db->where('status', $status);
        $result = $this->db->count_all_results();

        return $result;
    }

    public function count_total()
    {

        $this->db->select('status');
        $this->db->from('tbl_07_personal_bio');
        $this->db->where('IDNumber !=', 'abase');
        $result = $this->db->count_all_results();

        return $result;
    }

    public function get_teachers($tch)
    {
        $dat = $this->db->query("SELECT t1.IDNumber, CONCAT(t1.FirstName,' ',t1.LastName) AS Fullname, t1.Gender, t1.status, t2.SubjectTeach FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info AS t2
        ON t1.IDNumber = t2.IDNumber
        WHERE status = '$tch'
        ORDER BY t1.IDNumber");

        if ($dat->num_rows() > 0) {
            return $dat->result();
        } else {
            return null;
        }
    }

    public function get_student($std)
    {
        $dat = $this->db->query("SELECT t1.IDNumber, CONCAT(t1.FirstName,' ',t1.LastName) AS Fullname, t1.Gender, t1.status, t2.Kelas, t2.Ruangan 
        FROM tbl_07_personal_bio AS t1 INNER JOIN tbl_08_job_info_std AS t2 
        ON t1.IDNumber = t2.NIS LEFT JOIN tbl_03_class AS t3 
        ON t3.ClassDesc = t2.Kelas LEFT JOIN tbl_04_class_rooms AS t4
        ON t4.RoomDesc = t2.Ruangan
        WHERE status = '$std' 
        ORDER BY t1.IDNumber");

        if ($dat->num_rows() > 0) {
            return $dat->result();
        } else {
            return null;
        }
    }

    public function get_staff($stf)
    {
        $dat = $this->db->query("SELECT t1.IDNumber, CONCAT(t1.FirstName,' ',t1.LastName) AS Fullname, t1.Gender, t1.status, t2.Occupation FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info AS t2
        ON t1.IDNumber = t2.IDNumber
        WHERE status = '$stf'
        ORDER BY t1.IDNumber");

        if ($dat->num_rows() > 0) {
            return $dat->result();
        } else {
            return null;
        }
    }

    public function model_get_active_degree()
    {
        $data = [
            'SD' => $this->db->get_where('tbl_02_school', ['School_Desc' => 'SD'])->row(),
            'SMP' => $this->db->get_where('tbl_02_school', ['School_Desc' => 'SMP'])->row(),
            'SMA' => $this->db->get_where('tbl_02_school', ['School_Desc' => 'SMA'])->row(),
            'SMK' => $this->db->get_where('tbl_02_school', ['School_Desc' => 'SMK'])->row(),
        ];

        return $data;
    }

    public function model_get_state($degree)
    {
        $query = $this->db->get_where('tbl_02_school', [
            'School_Desc' => $degree
        ])->row();

        return $query->isActive;
    }

    public function model_toggle_degree($degree, $state)
    {
        $this->db->update('tbl_02_school', ['isActive' => $state], ['School_Desc' => $degree]);
    }

    public function model_get_class_list($degree)
    {
        $head = $this->db->query("SELECT * FROM classes WHERE Type = '$degree' GROUP BY ClassNumeric");

        return $head->result_array();
    }

    public function model_get_smk_list(){
        $count = $this->db->distinct()->select('Program')->get('tbl_03_a_mas_vocational');
        $program = $this->db->select("Program, SubProgramID, CONCAT(SubProgram,' [<span class=\"sbold font-grey-mint\">',SubProgramID,'</span>]') AS SubProgram")->get('tbl_03_a_mas_vocational')->result();

        return [$count, $program];
    }

    public function model_get_rooms($degree, $row)
    {
        $ClassID = '';

        if ($degree == 'SMA') {
            if ($row == 10) {
                $lit = "SMAC1BHS";
                $scn = "SMAC1IPA";
                $soc = "SMAC1IPS";
            } elseif ($row == 11) {
                $lit = "SMAC2BHS";
                $scn = "SMAC2IPA";
                $soc = "SMAC2IPS";
            } elseif ($row == 12) {
                $lit = "SMAC3BHS";
                $scn = "SMAC3IPA";
                $soc = "SMAC3IPS";
            }

            $data = [
                'Lit' => $this->db->get_where('classes', ['ClassNumeric' => $row, 'ClassID' => $lit])->result_array(),
                'Scn' => $this->db->get_where('classes', ['ClassNumeric' => $row, 'ClassID' => $scn])->result_array(),
                'Soc' => $this->db->get_where('classes', ['ClassNumeric' => $row, 'ClassID' => $soc])->result_array()
            ];

            return $data;
        } else {
            $ClassID = "{$degree}C{$row}";

            $query = $this->db->get_where('tbl_04_class_rooms', ['ClassID' => $ClassID]);

            return $query->result();
        }
    }

    public function model_get_smk_rooms($SubProgramID){
        $x = $this->db->get_where('tbl_04_class_rooms_vocational', [
                        'Simplified' => "X $SubProgramID"
             ])->result();

        $xi = $this->db->get_where('tbl_04_class_rooms_vocational', [
                        'Simplified' => "XI $SubProgramID"
             ])->result();

        $xii = $this->db->get_where('tbl_04_class_rooms_vocational', [
                        'Simplified' => "XII $SubProgramID"
             ])->result();

        return [$x, $xi, $xii];
    }

    public function model_add_room($degree, $cls, $num)
    {
        $check = $this->db->query(
            "SELECT t1.ClassID AS ClassID,
                    t1.ClassDesc AS ClassDesc,
                    t1.ClassNumeric AS ClassNumeric,
                    t1.Type AS Type,
                    t1.SchoolID AS SchoolID,
                    t2.RoomID AS RoomID, 
                    t2.RoomDesc AS RoomDesc,
                    t2.Simplified AS Simplified 
             FROM tbl_03_class t1 
             JOIN tbl_04_class_rooms t2 
             ON t2.ClassID = t1.ClassID
             WHERE t1.ClassID = '$cls'"
        );

        $this->db->trans_begin();
        if (empty($check->result())) {
            if ($degree == 'SMA') {

                $code = substr($cls, -3);

                if ($code == 'BHS') {
                    $abrv = 'Bahasa';
                } else {
                    $abrv = $code;
                }

                switch ($num) {
                    case 10:
                        $RoomID = str_replace('C', 'R', $cls) . 'A';
                        $RoomDesc = "X $abrv (A)";
                        $simple = 'X (A)';
                        break;
                    case 11:
                        $RoomID = str_replace('C', 'R', $cls) . 'A';
                        $RoomDesc = "XI $abrv (A)";
                        $simple = 'XI (A)';
                        break;
                    case 12:
                        $RoomID = str_replace('C', 'R', $cls) . 'A';
                        $RoomDesc = "XII $abrv (A)";
                        $simple = 'XII (A)';
                        break;
                }

                $data = [
                    'RoomID' => $RoomID,
                    'RoomDesc' => $RoomDesc,
                    'Type' => $degree,
                    'Simplified' => $simple,
                    'ClassID' => $cls
                ];
            }
        } else {
            $row = $check->row();
            $total = $check->num_rows();
            $degree = $row->Type;
            $ClassDesc = $row->ClassDesc;
            $clsnum = $row->ClassNumeric;


            $alph = range('A', 'Z');
            $alph = $alph[$total];

            $simple;
            if ($degree == 'SMA') {
                if ($row->ClassNumeric == 10) {
                    $simple = "X ($alph)";
                } elseif ($row->ClassNumeric == 11) {
                    $simple = "XI ($alph)";
                } elseif ($row->ClassNumeric == 12) {
                    $simple = "XII ($alph)";
                }
            } else {
                $simple = '';
            }

            $RoomID = str_replace('C', 'R', $cls) . $alph;

            $data = [
                'RoomID' => $RoomID,
                'RoomDesc' => "$ClassDesc ($alph)",
                'Type' => $degree,
                'Simplified' => $simple,
                'ClassID' => $cls
            ];
        }

        $query = $this->db->insert('tbl_04_class_rooms', $data);
        $this->db->trans_commit();

        if ($this->db->trans_status() === TRUE) {
            return 'success';
        }
    }

    public function model_add_smk_room($cls, $subprogram, $numeric){
        $this->db->trans_start();

        //Check class availability
        $availability = $this->db->get_where('tbl_04_class_rooms_vocational', [
            'Simplified' => "$cls $subprogram"
        ])->num_rows();

        $classid = 0;
        switch($cls){
            case 'X':
                $classid = 1;
            break;

            case 'XI':
                $classid = 2;
            break;

            case 'XII':
                $classid = 3;
            break;
        }

        $alph = range('A','Z');
        $alph = $alph[$availability];

        if($availability > 0){
            $this->db->insert('tbl_04_class_rooms_vocational', [
                'RoomID' => 'SMKR' . $availability . $subprogram,
                'RoomDesc' => $cls . ' ' . $subprogram . ' ' . "($alph)",
                'Simplified' => $cls . ' ' . $subprogram,
                'SubProgramID' => $subprogram,
                'ClassID' => "SMKC$classid", 
                'RegBy' => 'SysAdmin',
                'RegDate' => date('Y-m-d')
            ]);
        }else{
            $this->db->insert('tbl_04_class_rooms_vocational', [
                'RoomID' => 'SMKR1' . $subprogram,
                'RoomDesc' => "$cls $subprogram (A)",
                'Simplified' => $cls . ' ' . $subprogram,
                'SubProgramID' => $subprogram,
                'ClassID' => "SMKC$classid", 
                'RegBy' => 'SysAdmin',
                'RegDate' => date('Y-m-d')
            ]);
        }

        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    public function model_delete_room($room)
    {
        $check = $this->db->get_where('tbl_06_schedule', ['RoomID' => $room]);

        if (empty($check->result)) {
            $this->db->delete('tbl_04_class_rooms', ['RoomID' => $room]);

            return 'success';
        }
    }

    public function model_remove_smk_room($room){
        $this->db->delete('tbl_04_class_rooms_vocational', [
            'RoomDesc' => $room
        ]);

        return ($this->db->affected_rows() ? 'success' : $this->db->error());
    }

    public function model_get_chart()
    {
        $pie = $this->db->query(
            "SELECT Ruangan, COUNT(Ruangan) AS Total 
             FROM tbl_08_job_info_std 
             GROUP BY Ruangan"
        )->result();

        $bar = $this->db->query(
            "SELECT DISTINCT 
                Semester, 
                schoolyear, 
                (SELECT COUNT(DISTINCT(NIS)) 
                 FROM tbl_09_det_grades 
                 WHERE Semester = t1.Semester 
                 AND schoolyear = t1.schoolyear
                ) AS Total
             FROM tbl_09_det_grades t1"
        )->result();

        return [$pie, $bar];
    }

    public function get_school_event(){
        return $this->db->query(
            "SELECT Title, DateStart, DateEnd, Color FROM tbl_13_calendar"
        )->result();
    }

    public function sv_school_event($title, $date_start, $date_end, $color){
        $this->db->insert('tbl_13_calendar',[
            'Title' => $title,
            'DateStart' => $date_start,
            'DateEnd' => $date_end,
            'Color' => $color
        ]);

        return ($this->db->affected_rows() ? 'success' : $this->db->error());
    }

    public function update_school_event($event, $title, $new_title, $date_start, $date_end, $new_date_start, $new_date_end, $new_color){
        $this->db->trans_begin();

        if($event == 'delete'){
            $this->db->delete('tbl_13_calendar', [
                'Title' => $title,
                'DateStart' => $date_start,
                'DateEnd' => $date_end,
            ]);
        }else{
            $this->db->update('tbl_13_calendar', [
                'Title' => $new_title,
                'DateStart' => $new_date_start,
                'DateEnd' => $new_date_end,
                'Color' => $new_color
            ], [
                'Title' => $title,
                'DateStart' => $date_start,
                'DateEnd' => $date_end,
            ]);
        }

        $this->db->trans_complete();
        
        return ($this->db->trans_status() ? 'success' : $this->db->error());
    }

    public function get_closing_report(){
        $teacher = $this->db->query(
            "SELECT
                COUNT(teacher.IDNumber) AS teacher,
                COUNT(nonteacher.IDNumber) AS nonteacher,
                COUNT(sma.IDNumber) AS sma,
                COUNT(d1.IDNumber) AS d1,
                COUNT(d2.IDNumber) AS d2,
                COUNT(d3.IDNumber) AS d3,
                COUNT(s1.IDNumber) AS s1,
                COUNT(s2.IDNumber) AS s2,
                COUNT(nondegree.IDNumber) AS nondegree,
                COUNT(std_male.NIS) AS male,
                COUNT(std_female.NIS) AS female,
                COUNT(std_total.NIS) AS std_total,
                COUNT(religion_total.IDNumber) AS non_std_total,
                COUNT(idx.IDNumber) AS idx,
                COUNT(nonidx.IDNumber) AS nonidx,
                COUNT(total_idx.IDNumber) AS total_idx,
                COUNT(advent_pns.IDNumber) AS advent_pns,
                COUNT(non_advent_pns.IDNumber) AS non_advent_pns,
                COUNT(advent_idx.IDNumber) AS advent_idx,
                COUNT(non_advent_idx.IDNumber) AS non_advent_idx,
                COUNT(advent_honor.IDNumber) AS advent_honor,
                COUNT(non_advent_honor.IDNumber) AS non_advent_honor,
                COUNT(religion_total.IDNumber) AS religion_total
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_08_job_info AS teacher
             ON bio.IDNumber = teacher.IDNumber AND bio.status = 'teacher'
             LEFT JOIN tbl_08_job_info AS nonteacher
             ON bio.IDNumber = nonteacher.IDNumber AND bio.status = 'staff'
             LEFT JOIN tbl_08_job_info AS sma
             ON bio.IDNumber = sma.IDNumber AND sma.LastEducation = 'SMA'
             LEFT JOIN tbl_08_job_info AS d1
             ON bio.IDNumber = d1.IDNumber AND d1.LastEducation = 'Diploma 1'
             LEFT JOIN tbl_08_job_info AS d2
             ON bio.IDNumber = d2.IDNumber AND d2.LastEducation = 'Diploma 2'
             LEFT JOIN tbl_08_job_info AS d3
             ON bio.IDNumber = d3.IDNumber AND d3.LastEducation = 'Diploma 3'
             LEFT JOIN tbl_08_job_info AS s1
             ON bio.IDNumber = s1.IDNumber AND s1.LastEducation = 'Strata 1'
             LEFT JOIN tbl_08_job_info AS s2
             ON bio.IDNumber = s2.IDNumber AND s2.LastEducation = 'Strata 2'
             LEFT JOIN tbl_08_job_info AS nondegree
             ON bio.IDNumber = nondegree.IDNumber AND nondegree.LastEducation IN(NULL,'','SD','SMP')
             LEFT JOIN tbl_08_job_info_std AS std_male
             ON bio.IDNumber = std_male.NIS AND bio.status = 'student' AND bio.Gender = 'Laki-Laki'
             LEFT JOIN tbl_08_job_info_std AS std_female
             ON bio.IDNumber = std_female.NIS AND bio.status = 'student' AND bio.Gender = 'Perempuan'
             LEFT JOIN tbl_08_job_info_std AS std_total
             ON bio.IDNumber = std_total.NIS AND bio.status = 'student'
             LEFT JOIN tbl_08_job_info AS idx
             ON bio.IDNumber = idx.IDNumber AND idx.Emp_Type IN('GTY','PTY')
			 LEFT JOIN tbl_08_job_info AS nonidx
             ON bio.IDNumber = nonidx.IDNumber AND nonidx.Emp_Type IN('GTT','PTT')
			 LEFT JOIN tbl_08_job_info AS total_idx
             ON bio.IDNumber = total_idx.IDNumber
             LEFT JOIN tbl_08_job_info AS advent_pns
             ON bio.IDNumber = advent_pns.IDNumber AND bio.Religion = 'Advent' AND advent_pns.Emp_Type = 'PNS'
             LEFT JOIN tbl_08_job_info AS non_advent_pns
             ON bio.IDNumber = advent_pns.IDNumber AND bio.Religion != 'Advent' AND advent_pns.Emp_Type = 'PNS'
             LEFT JOIN tbl_08_job_info AS advent_idx
             ON bio.IDNumber = advent_idx.IDNumber AND bio.Religion = 'Advent' AND advent_idx.Emp_Type IN('GTY','PTY')
             LEFT JOIN tbl_08_job_info AS non_advent_idx
             ON bio.IDNumber = non_advent_idx.IDNumber AND bio.Religion != 'Advent' AND non_advent_idx.Emp_Type IN('GTY','PTY')
             LEFT JOIN tbl_08_job_info AS advent_honor
             ON bio.IDNumber = advent_honor.IDNumber AND bio.Religion = 'Advent' AND advent_honor.Emp_Type IN('GTT','PTT')
             LEFT JOIN tbl_08_job_info AS non_advent_honor
             ON bio.IDNumber = non_advent_honor.IDNumber AND bio.Religion != 'Advent' AND non_advent_honor.Emp_Type IN('GTT','PTT')
             LEFT JOIN tbl_08_job_info AS religion_total
             ON bio.IDNumber = religion_total.IDNumber
             WHERE bio.status NOT IN('admin')"
        )->row();

        return $teacher;
    }

    public function get_report_school(){
        return $this->db->query("SELECT School_Desc FROM tbl_02_school WHERE isActive = 1")->result();
    }

    public function get_report_class($sch){
       $query = $this->db->query(
            "SELECT DISTINCT
             cls.ClassDesc,
             cls.ClassNumeric,
             (SELECT 
                COUNT(RoomDesc)
                FROM tbl_04_class_rooms 
                WHERE ClassID = cls.ClassID) AS Total,
             (SELECT
                COUNT(SubjName) 
                FROM tbl_06_schedule
                WHERE RoomDesc = rooms.RoomDesc
                AND SubjName IN(SELECT SubjName FROM tbl_05_subject WHERE Type IN('Elective','Excul','Regular'))) AS Hour
             FROM tbl_03_class AS cls
             JOIN tbl_04_class_rooms AS rooms
             USING(ClassID)
             WHERE cls.Type = '$sch'
             GROUP BY cls.ClassDesc
             UNION ALL
             SELECT DISTINCT
             cls.ClassDesc,
             cls.ClassNumeric,
             (SELECT 
                COUNT(DISTINCT RoomDesc)
                FROM tbl_04_class_rooms_vocational
                WHERE Simplified = cls.ClassDesc) AS Total,
             (SELECT
                COUNT(SubjName) 
                FROM tbl_06_schedule
                WHERE RoomDesc = rooms.RoomDesc
                AND SubjName IN(SELECT SubjName FROM tbl_05_subject WHERE Type IN('Elective','Excul','Regular'))) AS Hour
             FROM tbl_03_b_class_vocational AS cls
             JOIN tbl_04_class_rooms_vocational AS rooms
             ON cls.ClassDesc = rooms.Simplified
             WHERE cls.Type = '$sch'
             GROUP BY cls.ClassDesc
             ORDER BY ClassNumeric ASC, ClassDesc ASC"
        )->result();

        return $query;
    }

    public function get_report_student($sch){
        $TABLE = '';
        if($sch == 'SMK'){
           $TABLE = 'tbl_04_class_rooms_vocational';
        }else{
            $TABLE = 'tbl_04_class_rooms';
        }

        $all_std = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            WHERE bio.status = 'student'
            AND room.Type = '$sch'"
        )->row();

        $adventist = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            WHERE bio.status = 'student'
            AND bio.Religion = 'Advent'
            AND room.Type = '$sch'"
        )->row();

        $non_adventist = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            WHERE bio.status = 'student'
            AND bio.Religion != 'Advent'
            AND room.Type = '$sch'"
        )->row();

        $year = date('Y');
        $month = date('m');

        $attendance = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_10_absent_std AS absent   
            LEFT JOIN tbl_07_personal_bio AS bio
            ON bio.IDNumber = absent.NIS
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            WHERE room.Type = '$sch'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $sick = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'Sick'
            AND room.Type = '$sch'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $on_permit = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'On Permit'
            AND room.Type = '$sch'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $absent = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN $TABLE AS room
            ON room.RoomDesc = male.Ruangan OR room.RoomDesc = female.Ruangan
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'Absent'
            AND room.Type = '$sch'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        return [$all_std, $adventist, $non_adventist, $attendance, $sick, $on_permit, $absent];
    }

    public function get_report_student_overall(){
        $all_std = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            WHERE bio.status = 'student'"
        )->row();

        $adventist = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            WHERE bio.status = 'student'
            AND bio.Religion = 'Advent'"
        )->row();

        $non_adventist = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            WHERE bio.status = 'student'
            AND bio.Religion != 'Advent'"
        )->row();

        $year = date('Y');
        $month = date('m');

        $attendance = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_10_absent_std AS absent   
            LEFT JOIN tbl_07_personal_bio AS bio
            ON bio.IDNumber = absent.NIS
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $sick = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'Sick'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $on_permit = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'On Permit'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $absent = $this->db->query(
            "SELECT
                COUNT(male.NIS) AS Male,
                COUNT(female.NIS) AS Female,
                COUNT(male.NIS) + COUNT(female.NIS) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info_std AS male
            ON bio.IDNumber = male.NIS AND bio.Gender = 'Laki-Laki'
            LEFT JOIN tbl_08_job_info_std AS female
            ON bio.IDNumber = female.NIS AND bio.Gender = 'Perempuan'
            LEFT JOIN tbl_10_absent_std AS absent
            ON bio.IDNumber = absent.NIS
            WHERE bio.status = 'student'
            AND absent.Ket = 'Absent'
            AND absent.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        return [$all_std, $adventist, $non_adventist, $attendance, $sick, $on_permit, $absent];
    }

    public function get_report_nonstudent(){
        $nonstd = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_07_personal_bio AS male
             ON bio.IDNumber = male.IDNumber AND male.Gender = 'Laki-Laki'
             LEFT JOIN tbl_07_personal_bio AS female
             ON bio.IDNumber = female.IDNumber AND female.Gender = 'Perempuan'
             WHERE bio.IDNumber != 'abase'
             AND bio.status NOT IN('student','admin')"
        )->row();

        $gty = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.Emp_Type = 'GTY'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.Emp_Type = 'GTY'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $asn = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.Emp_Type = 'PNS'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.Emp_Type = 'PNS'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $gtt = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.Emp_Type = 'GTT'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.Emp_Type = 'GTT'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $nontch = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.Occupation != 'teacher'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.Occupation != 'teacher'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $acc = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.JobDesc = 'Keuangan'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.JobDesc = 'Keuangan'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $adm = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
                ON bio.IDNumber = male.IDNumber 
                AND bio.Gender = 'Laki-Laki' 
                AND male.JobDesc IN ('Tata Usaha', 'Administrasi')
            LEFT JOIN tbl_08_job_info AS female
                ON bio.IDNumber = female.IDNumber 
                AND bio.Gender = 'Perempuan' 
                AND female.JobDesc IN ('Tata Usaha', 'Administrasi')
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $others = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
                ON bio.IDNumber = male.IDNumber 
                AND bio.Gender = 'Laki-Laki' 
                AND male.Occupation != 'teacher' 
                AND male.JobDesc NOT IN ('Keuangan', 'Tata Usaha', 'Administrasi')
            LEFT JOIN tbl_08_job_info AS female
                ON bio.IDNumber = female.IDNumber 
                AND bio.Gender = 'Perempuan' 
                AND female.Occupation != 'teacher' 
                AND female.JobDesc NOT IN ('Keuangan', 'Tata Usaha', 'Administrasi')
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $adv = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_07_personal_bio AS male
             ON bio.IDNumber = male.IDNumber AND male.Gender = 'Laki-Laki'
             LEFT JOIN tbl_07_personal_bio AS female
             ON bio.IDNumber = female.IDNumber AND female.Gender = 'Perempuan'
             WHERE bio.Religion = 'Advent'
             AND bio.status NOT IN('student', 'admin')"
        )->row();

        $nonadv = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_07_personal_bio AS male
             ON bio.IDNumber = male.IDNumber AND male.Gender = 'Laki-Laki'
             LEFT JOIN tbl_07_personal_bio AS female
             ON bio.IDNumber = female.IDNumber AND female.Gender = 'Perempuan'
             WHERE bio.Religion != 'Advent'
             AND bio.status NOT IN('student', 'admin')"
        )->row();

        $nonstrat = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.LastEducation NOT IN ('Strata 1', 'Strata 2', 'Strata 3')
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.LastEducation NOT IN ('Strata 1', 'Strata 2', 'Strata 3')
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $strat1 = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.LastEducation = 'Strata 1'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.LastEducation = 'Strata 1'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $strat2 = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
            FROM tbl_07_personal_bio AS bio
            LEFT JOIN tbl_08_job_info AS male
            ON bio.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki' AND male.LastEducation = 'Strata 2'
            LEFT JOIN tbl_08_job_info AS female
            ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan' AND female.LastEducation = 'Strata 2'
            WHERE bio.status NOT IN('student', 'admin')"
        )->row();

        $year = date('Y');
        $month = date('m');

        $attd = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_10_absent AS attd
             LEFT JOIN tbl_07_personal_bio AS bio
             USING(IDNumber)
             LEFT JOIN tbl_08_job_info AS male
             ON attd.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki'
             LEFT JOIN tbl_08_job_info AS female
             ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan'
             WHERE bio.status NOT IN('student', 'admin')
             AND bio.IDNumber != 'abase'
             AND attd.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $sck = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_10_absent AS attd
             LEFT JOIN tbl_07_personal_bio AS bio
             USING(IDNumber)
             LEFT JOIN tbl_08_job_info AS male
             ON attd.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki'
             LEFT JOIN tbl_08_job_info AS female
             ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan'
             WHERE bio.status NOT IN('student', 'admin')
             AND bio.IDNumber != 'abase'
             AND attd.Ket = 'Sick'
             AND attd.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $onpermit = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_10_absent AS attd
             LEFT JOIN tbl_07_personal_bio AS bio
             USING(IDNumber)
             LEFT JOIN tbl_08_job_info AS male
             ON attd.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki'
             LEFT JOIN tbl_08_job_info AS female
             ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan'
             WHERE bio.status NOT IN('student', 'admin')
             AND bio.IDNumber != 'abase'
             AND attd.Ket = 'On Permit'
             AND attd.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        $abs = $this->db->query(
            "SELECT
                COUNT(male.IDNumber) AS Male,
                COUNT(female.IDNumber) AS Female,
                COUNT(male.IDNumber) + COUNT(female.IDNumber) AS Total
             FROM tbl_10_absent AS attd
             LEFT JOIN tbl_07_personal_bio AS bio
             USING(IDNumber)
             LEFT JOIN tbl_08_job_info AS male
             ON attd.IDNumber = male.IDNumber AND bio.Gender = 'Laki-Laki'
             LEFT JOIN tbl_08_job_info AS female
             ON bio.IDNumber = female.IDNumber AND bio.Gender = 'Perempuan'
             WHERE bio.status NOT IN('student', 'admin')
             AND bio.IDNumber != 'abase'
             AND attd.Ket = 'Absent'
             AND attd.Absent BETWEEN '$year-$month-01' AND LAST_DAY('$year-$month-01')"
        )->row();

        return [$nonstd, $gty, $asn, $gtt, $nontch, $acc, $adm, $others, $adv, $nonadv, $nonstrat, $strat1, $strat2, $attd, $sck, $onpermit, $abs];
    }

    public function get_report_full_nonstudent(){
        $teacher = $this->db->query(
            "SELECT 
                bio.IDNumber,
                CONCAT(
                    IF(info.StudyFocus IN('Dr','Dra'), CONCAT(info.StudyFocus,'. '), ''),
                    bio.FirstName,
                    IF(bio.MiddleName NOT IN(NULL,''), CONCAT(' ',bio.MiddleName,' '), ' '),
                    bio.LastName, 
                    IF(info.StudyFocus NOT IN('Dr','Dra'), CONCAT(', ', info.StudyFocus), '')
                ) AS FullName,
                bio.Gender,
                info.Emp_Type,
                CONCAT(bio.PointofBirth, ', ',DATE_FORMAT(bio.DateofBirth,'%Y/%m/%d')) AS Birth,
                info.StudyFocus,
                info.JobDesc,
                info.YearStarts,
                bio.Address,
                info.Govt_Cert,
                info.Institute_Cert
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_08_job_info AS info
             USING(IDNumber)
             WHERE bio.status = 'teacher'
             ORDER BY FullName"
        )->result();

        $nonteacher = $this->db->query(
            "SELECT 
                bio.IDNumber,
                CONCAT(
                    IF(info.StudyFocus IN('Dr','Dra'), CONCAT(info.StudyFocus,'. '), ''),
                    bio.FirstName,
                    IF(bio.MiddleName NOT IN(NULL,''), CONCAT(' ',bio.MiddleName,' '), ' '),
                    bio.LastName, 
                    IF(info.StudyFocus NOT IN('Dr','Dra','',NULL), CONCAT(', ', info.StudyFocus), '')
                ) AS FullName,
                bio.Gender,
                info.Emp_Type,
                CONCAT(bio.PointofBirth, ', ',DATE_FORMAT(bio.DateofBirth,'%Y/%m/%d')) AS Birth,
                info.StudyFocus,
                info.JobDesc,
                info.YearStarts,
                bio.Address,
                info.Govt_Cert,
                info.Institute_Cert
             FROM tbl_07_personal_bio AS bio
             LEFT JOIN tbl_08_job_info AS info
             USING(IDNumber)
             WHERE bio.status NOT IN ('admin','student', 'teacher')
             ORDER BY FullName"
        )->result();

        return [$teacher, $nonteacher];
    }

    public function Mdl_get_report(){
        return $this->db->get_where('tbl_02_school', ['isActive' => 1])->first_row();
    }

    public function Mdl_save_report($field, $value){
        $this->db->update('tbl_02_school', [ $field => $value ]);

        return ($this->db->affected_rows() ? 'success' : $this->db->error());
    }
}
