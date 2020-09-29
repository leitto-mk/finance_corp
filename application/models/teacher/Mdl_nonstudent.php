<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_nonstudent extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function show_prof($session)
	{
		$query = $this->db->query("SELECT * FROM tbl_07_personal_bio AS t1
        INNER JOIN tbl_08_job_info AS t2
        ON t1.IDNumber = '$session'")->row();

		return $result;
	}

	public function get_all_info($id)
	{
		$query = $this->db->query(
			"SELECT t1.*, t2.* FROM tbl_07_personal_bio t1
    		 JOIN tbl_08_job_info t2
    		 ON t1.IDNumber = t2.IDNumber
    		 WHERE t1.IDNumber = '$id'"
		)->row();

		return $query;
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

	public function modal_get_student_compact($room)
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

		$query = $this->db
			->order_by('FullName')
			->group_by('NIS')
			->get_where('tbl_09_det_grades', [
				'Room' => $room,
				'Semester' => $semester,
				'schoolyear' => $schYear
			])->result();

		return $query;
	}

	public function get_period($id)
	{
		$query = $this->db->query(
			"SELECT DISTINCT Semester, schoolyear FROM tbl_06_schedule WHERE IDNumber = '$id' ORDER BY schoolyear, Semester"
		)->result_array();

		return array_reverse($query);
	}

	public function get_teaching_room($id, $semester, $period)
	{
		$query = $this->db->query(
			"SELECT DISTINCT RoomDesc 
			 FROM tbl_06_schedule 
			 WHERE IDNumber = '$id' 
			 AND semester = '$semester' 
			 AND schoolyear = '$period'"
		)->result();

		return $query;
	}

	public function model_get_taught_subject($id)
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

		$queryTaught = $this->db->query(
			"SELECT DISTINCT SubjName FROM tbl_06_schedule
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$schYear'
			 AND SubjName NOT IN ('','None','ELECTIVE','EXCUL')"
		)->result();

		$querySchedule = $this->db->query(
			"SELECT 
				RoomDesc, 
				Days, 
				SubjName, 
				TIME_FORMAT(Hour, '%H:%i') AS Hour
			 FROM tbl_06_schedule
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$schYear'
			 AND SubjName NOT IN ('','None','ELECTIVE','EXCUL')
			 UNION ALL
			 SELECT 
				RoomDesc, 
				Days, 
				SubjName, 
				Hour 
			 FROM tbl_06_schedule_nonregular
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$schYear'
			 ORDER BY Hour"
		)->result();

		return [$queryTaught, $querySchedule];
	}

	public function get_teaching_schedule($id, $semester, $period, $room)
	{
		$query = $this->db->query(
			"SELECT * FROM tbl_06_schedule 
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$period'
			 AND RoomDesc = '$room'
			 ORDER BY FIELD(Days,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'), Hour"
		)->result();

		return $query;
	}

	public function get_active_room()
	{
		$id = $this->session->userdata('id');
		
		$query = $this->db->query(
			"SELECT DISTINCT t3.ClassNumeric, t3.ClassDesc, t1.RoomDesc FROM tbl_04_class_rooms t1
			 LEFT JOIN tbl_02_school t2
			 ON t1.Type = t2.School_Desc
			 LEFT JOIN tbl_03_class t3
			 ON t1.Type = t3.Type AND t1.ClassID = t3.ClassID
			 LEFT JOIN tbl_06_schedule t4
			 ON t1.RoomDesc = t4.RoomDesc
			 WHERE t2.isActive = 1
			 AND t4.IDNumber = '$id'
			 UNION ALL
			 SELECT DISTINCT t3.ClassNumeric, t3.ClassDesc, t1.RoomDesc FROM tbl_04_class_rooms_vocational t1
			 LEFT JOIN tbl_02_school t2
			 ON t1.Type = t2.School_Desc
			 LEFT JOIN tbl_03_b_class_vocational t3
			 ON t1.Simplified = t3.ClassDesc
			 LEFT JOIN tbl_06_schedule t4
			 ON t1.RoomDesc = t4.RoomDesc
			 WHERE t2.isActive = 1
			 AND t4.IDNumber = '$id'
             ORDER BY ClassNumeric"
		);

		return $query;
	}

	public function get_active_voc_only_room(){
		return $this->db->query(
			"SELECT room.RoomDesc 
			 FROM tbl_04_class_rooms_vocational AS room
			 JOIN tbl_02_school AS school
				ON school.School_Desc = room.Type
			 WHERE school.isActive = 1
			 AND room.ClassID != 'SMKC1'
			 ORDER BY RoomDesc ASC"
		)->result();
	}

	public function get_full_table_voc($semester, $period, $room, $subj){
		$query = $this->db->query(
            "SELECT 
                std.NIS,
                std.FullName,
                voc.Report,
                voc.Predicate,
                voc.Description
             FROM tbl_09_det_grades AS std
             JOIN tbl_09_det_voc_grades AS voc
                USING(NIS)
             WHERE voc.Semester = '$semester'
             AND voc.schoolyear = '$period'
             AND voc.Room = '$room'
             AND voc.SubjName = '$subj'
             ORDER BY std.FullName"
		)->result();
		
		return $query;
	}

	public function model_get_kd_details($room, $subj){
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

        $result = $this->db->query(
            "SELECT Type, Code, KD, Weight1_Desc, Weight2_Desc, Weight3_Desc
             FROM tbl_05_subject_kd
             WHERE Semester = '$semester'
             AND SubjName = '$subj'
             AND Classes = 
                (SELECT ClassRomanic FROM tbl_03_class t1 
                 JOIN tbl_04_class_rooms t2
                 ON t1.ClassID = t2.ClassID
                 WHERE t2.RoomDesc = '$room')"
		)->result();
		
		return $result;
	}

	public function modal_get_full_attendance($semester, $period, $room)
	{
		$query = $this->db->query(
			"SELECT DISTINCT t1.NIS, t1.FullName,
                (SELECT COUNT(Ket) AS Ket FROM tbl_10_absent_std atd
                    WHERE atd.NIS = t1.NIS
                    AND atd.Semester = '$semester'
                    AND atd.schoolyear = '$period'    
                    AND atd.Ruang = '$room') AS Total
             FROM tbl_09_det_grades t1
             WHERE t1.Semester = '$semester'
             AND t1.schoolyear = '$period'
			 AND t1.Room = '$room'
			 ORDER BY t1.FullName"
		)->result();

		return $query;
	}

	public function model_add_absent_std($data)
	{
		extract($data);

		$this->db->trans_start();

		//GET DATA BASED ON LIST
		$query = $this->db->query(
			"SELECT DISTINCT NIS, FullName, Class, Room FROM tbl_09_det_grades
			 WHERE NIS IN ($NIS)"
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
					'Ruang' => $Room,
					'Semester' =>  $Semester,
					'schoolyear' =>  $Period,
					'SubjDesc' =>  $Subj,
					'Hour' =>  $Time,
					'Absent' =>  date('Y-m-d', strtotime($Date)),
					'Ket' =>  $Reason
				]);
			}

			//INSERT BATCH FROM ARRAY
			$this->db->insert_batch('tbl_10_absent_std', $attendance);
		} else {
			$this->db->insert('tbl_10_absent_std', [
				'NIS' => $query[0]['NIS'],
				'FullName' => $query[0]['FullName'],
				'Kelas' => $query[0]['Class'],
				'Ruang' => $Room,
				'Semester' =>  $Semester,
				'schoolyear' =>  $Period,
				'SubjDesc' =>  $Subj,
				'Hour' =>  $Time,
				'Absent' =>  date('Y-m-d', strtotime($Date)),
				'Ket' =>  $Reason
			]);
		}

		//RE/UPDATE ABSENT GRADE AFTER INSERTION
		$this->db->query(
			"UPDATE tbl_09_det_grades t1
			 RIGHT JOIN tbl_10_absent_std t2
			 ON t1.NIS = t2.NIS AND t2.NIS IN ($NIS)
			 SET t1.Absent = 
			 	CEIL(
						(
							(
								(SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$Room')) 
								-
								(SELECT COUNT(Ket) FROM tbl_10_absent_std WHERE NIS = t2.NIS AND Semester = '$Semester' AND schoolyear = '$Period' AND Ket IN ('Absent','On Permit','Sick'))
							) 
							/ 
							(SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$Room'))
						) * 100
					)
			 WHERE t1.Semester = '$Semester'
			 AND t1.schoolyear = '$Period'
			 AND t1.Room = '$Room'"
		);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			return $this->db->error();
		} else {
			return 'success';
		}
	}

	public function model_delete_absn($data)
	{
		extract($data);

		$this->db->trans_start();

		//DELETE 
		if ($SubjDesc == 'null' && $Hour == 'null') {
			$this->db->query(
				"DELETE FROM tbl_10_absent_std
				 WHERE NIS = '$NIS'
				 AND Absent = '$Absent'
				 AND Ket = '$Ket'
				 AND SubjDesc IS NULL
				 AND Hour IS NULL
				 AND Semester = '$Semester'
				 AND schoolyear = '$schoolyear'
				 AND Ruang = '$Ruang'
				 LIMIT 1"
			);
		} else {
			$this->db->query(
				"DELETE FROM tbl_10_absent_std
				 WHERE NIS = '$NIS'
				 AND Absent = '$Absent'
				 AND Ket = '$Ket'
				 AND SubjDesc = '$SubjDesc'
				 AND Hour = '$Hour'
				 AND Semester = '$Semester'
				 AND schoolyear = '$schoolyear'
				 AND Ruang = '$Ruang'
				 LIMIT 1"
			);
		}

		//RE/UPDATE ABSENT GRADE AFTER INSERTION
		$total = $this->db->query(
			"SELECT COUNT(Ket) AS Total_Absent 
			 FROM tbl_10_absent_std 
			 WHERE NIS = '$NIS' 
			 AND Semester = '$Semester' 
			 AND schoolyear = '$schoolyear' 
			 AND Ket IN ('Absent','On Permit','Sick')"
		)->row();

		if ($total->Total_Absent == 0) {
			$this->db->update('tbl_09_det_grades', [
				'Absent' => 100
			], [
				'NIS' => $NIS,
				'Semester' => $Semester,
				'schoolyear' => $schoolyear,
				'Room' => $Ruang
			]);
		} elseif ($total->Total_Absent > 0) {
			$this->db->query(
				"UPDATE tbl_09_det_grades t1
				 RIGHT JOIN tbl_10_absent_std t2
				 ON t1.NIS = t2.NIS
				 SET t1.Absent = 
					 CEIL(
							(
								(
									(SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$Ruang')) 
									-
									(SELECT COUNT(Ket) AS Total_Absent FROM tbl_10_absent_std WHERE NIS = t2.NIS AND Semester = '$Semester' AND schoolyear = '$schoolyear' AND Ket IN ('Absent','On Permit','Sick'))
								) 
								/ 
								(SELECT Total FROM tbl_meta_active_days WHERE Degree = (SELECT Type FROM tbl_04_class_rooms WHERE RoomDesc = '$Ruang'))
							) * 100
						)
				 WHERE t1.NIS = '$NIS'
				 AND t1.Semester = '$Semester'
				 AND t1.schoolyear = '$schoolyear'
				 AND t1.Room = '$Ruang'"
			);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			return $this->db->error();
		} else {
			return 'success';
		}
	}

	public function promote_student($id, $cls, $room){
		$this->db->trans_begin();

        $degree = $this->db->query(
            "SELECT 
                ClassID, 
                Type,
                ClassNumeric 
             FROM tbl_03_class 
             WHERE ClassDesc = '$cls'
             UNION ALL
             SELECT 
                ClassID, 
                Type,
                ClassNumeric
             FROM tbl_03_b_class_vocational
             WHERE ClassDesc = '$cls'"
        )->row();

        if($degree == 'SD'){
            if($degree->ClassNumeric == 6){
                $newcls = 'GRADUATED';
                $newroom = 'GRADUATED';
            }else{
                $level = substr($degree->ClassID, 3, 1) + 1;
                $newcls = str_replace(substr($degree->ClassID, 3, 1), $level, $degree->ClassID);
				$newroom = 'SDR'.$level.'A';
				
				$newcls = $this->db->select('ClassDesc')->where('ClassID', $newcls)->get('tbl_03_class')->row()->ClassDesc;
				$newroom = $this->db->select('RoomDesc')->where('RoomID', $newroom)->get('tbl_04_class_rooms')->row()->RoomDesc;
            }
        }elseif($degree->Type == 'SMP'){
            if($degree->ClassNumeric == 9){
                $newcls = 'GRADUATED';
                $newroom = 'GRADUATED';
            }else{
                $level = substr($degree->ClassID, 4, 1) + 1;
                $newcls = str_replace(substr($degree->ClassID, 4, 1), $level, $degree->ClassID);
				$newroom = 'SMPR'.$level.'A';
				
				$newcls = $this->db->select('ClassDesc')->where('ClassID', $newcls)->get('tbl_03_class')->row()->ClassDesc;
				$newroom = $this->db->select('RoomDesc')->where('RoomID', $newroom)->get('tbl_04_class_rooms')->row()->RoomDesc;
            }
        }elseif($degree->Type == 'SMA'){
            if($degree->ClassNumeric == 12){
                $newcls = 'GRADUATED';
                $newroom = 'GRADUATED';
            }else{
                $level = substr($degree->ClassID, 4, 1) + 1;
                $newcls = str_replace(substr($degree->ClassID, 4, 1), $level, $degree->ClassID);
				$newroom = 'SMAR'.$level.''.substr($degree->ClassID, 5).'A';
				
				$newcls = $this->db->select('ClassDesc')->where('ClassID', $newcls)->get('tbl_03_class')->row()->ClassDesc;
				$newroom = $this->db->select('RoomDesc')->where('RoomID', $newroom)->get('tbl_04_class_rooms')->row()->RoomDesc;
            }
        }elseif($degree->Type == 'SMK'){
            $level = explode(' ', $cls);

            if($level[0] == 'X'){
                $newcls = 'XI'.' '.$level[1];
                $newroom = 'XI'.' '.$level[1].' (A)';
            }elseif($level[0] == 'XI'){
                $newcls = 'XII'.' '.$level[1];
                $newroom = 'XII'.' '.$level[1].' (A)';
            }elseif($level[0] == 'XII'){
                $newcls = 'GRADUATED';
                $newroom = 'GRADUATED';
            }
        }

        $result = $this->db->query(
            "UPDATE tbl_08_job_info_std
             SET 
                Kelas = '$newcls',
                Ruangan = '$newroom' 
             WHERE NIS = '$id'
             AND Ruangan = '$room'"
        );

        $this->db->trans_complete();

        return ($this->db->trans_status() ? 'success' : $this->db->error());
	}

	public function model_get_absn_det($id, $semester, $period, $room)
	{
		$query = $this->db->query(
			"SELECT NIS, SubjDesc, DATE_FORMAT(Absent,'%d-%m-%Y') AS Absent, Hour, Ket 
			 FROM tbl_10_absent_std
			 WHERE NIS = '$id'
			 AND Semester = '$semester'
			 AND schoolyear = '$period'
			 AND Ruang = '$room'
			 ORDER BY DATE(Absent)"
		)->result();

		return $query;
	}

	public function get_nonregular_info($type){
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
        
        $schedule = $this->db
                            ->where([
                                'semester' => $semester,
                                'schoolyear' => $schYear,
                                'subjName' => $type
                            ])
                            ->select('Days, Hour')
                            ->get('tbl_06_schedule')->result();

        $subjects = $this->db
							->where("Type = '$type' AND SubjName != '$type'")
                            ->select('SubjID, SubjName')
							->get('tbl_05_subject')->result();
							
		return [$schedule, $subjects];
	}

	public function get_hour_of_day($room, $type, $day){
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
		
		$query = $this->db
							->where([
								'Days' => $day,
								'semester' => $semester,
								'schoolyear' => $schYear,
								'SubjName' => $type
							])
							->select('Hour')
							->order_by('Hour', 'ASC')
							->get('tbl_06_schedule')->result();

		return $query;
	}

	public function get_nonregular_subjects($room, $type, $day, $hour){
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

        $subjects = $this->db
                            ->where("Type = '$type' AND SubjName != '$type'")
                            ->where("SubjName IN(
                                                SELECT SubjName FROM tbl_06_schedule_nonregular
                                                WHERE semester = '$semester'
                                                AND schoolyear = '$schYear'
                                                AND RoomDesc = '$room'
                                                AND Days = '$day'
												AND Hour = '$hour')")
							->select('SubjID, SubjName')
							->order_by('SubjName', 'ASC')
							->get('tbl_05_subject')->result();

		return $subjects;
	}

	public function add_nonregular($data){
		extract($data);

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

		//Get data for Availability
		$availability = $this->db->query(
			"SELECT 
				Grd.NIS,
				Sch.Hour, 
				Sch.Days, 
				Sch.SubjName 
			 FROM tbl_06_schedule_nonregular AS Sch
			 LEFT JOIN tbl_09_det_grades AS Grd
				ON Sch.SubjName = Grd.SubjName AND Sch.RoomDesc = Grd.Room
			 WHERE Grd.NIS = '$NIS'
			 AND Sch.semester = '$semester'
			 AND Sch.schoolyear = '$schYear'
             AND Sch.Days = '$Day'
             AND Sch.Hour = TIME_FORMAT('$Hour', '%H:%i')"
		);
		
		//If this student has been registered with one non-regular subject, 
		//reject the upcoming Non-Regular Assignment
		if($availability->num_rows() > 0){
			return 'SUBJ_REGISTERED';
		}

		$this->db->insert('tbl_09_det_grades', [
			'NIS' => $NIS,
			'FullName' => $this->db->select("CONCAT(FirstName, ' ', LastName) AS FullName")->where('IDNumber', $NIS)->get('tbl_07_personal_bio')->row()->FullName,
			'Semester' => $semester,
			'schoolyear' => $schYear,
            'Class' => $Class,
            'Room' => $Room,
            'SubjName' => $SubjName
		]);

		return ($this->db->affected_rows() ? 'success' : $this->db->error());
	}

	public function model_get_student_reports($header)
	{
		extract($header);

		$WHERE_NAME = ($search == '') ? 'WHERE t1.FirstName IS NOT NULL' : "WHERE t1.FirstName LIKE '$search%' OR t1.LastName LIKE '$search%' OR t1.IDNumber LIKE '$search%' OR t2.Kelas LIKE '$search%' OR t2.Ruangan LIKE '$search%'";
		$ORDER = ($order_by == 0) ? "FullName ASC" : "$order_by $order_dir";

		$query = $this->db->query(
			"SELECT 
                t1.IDNumber,
                CONCAT(t1.FirstName,' ',t1.LastName) As FullName,
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
			 ON t1.IDNumber = t2.NIS
             JOIN tbl_03_class t3
             ON t2.Kelas = t3.ClassDesc
			 $WHERE_NAME
			 AND t2.Ruangan = (SELECT Homeroom FROM tbl_08_job_info WHERE IDNumber = '$id')
			 UNION ALL
			 SELECT 
                t1.IDNumber,
                CONCAT(t1.FirstName,' ',t1.LastName) As FullName,
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
			 ON t1.IDNumber = t2.NIS
			 JOIN tbl_03_b_class_vocational t4
			 ON t2.Kelas = t4.ClassDesc
			 $WHERE_NAME
			 AND t2.Ruangan = (SELECT Homeroom FROM tbl_08_job_info WHERE IDNumber = '$id')
			 ORDER BY $ORDER
			 LIMIT $limit OFFSET $start"
		);

		$total = $this->db->query(
			"SELECT 
                t1.IDNumber,
                CONCAT(t1.FirstName,' ',t1.LastName) As FullName,
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
			 ON t1.IDNumber = t2.NIS
             JOIN tbl_03_class t3
             ON t2.Kelas = t3.ClassDesc
			 $WHERE_NAME
			 AND t2.Ruangan = (SELECT Homeroom FROM tbl_08_job_info WHERE IDNumber = '$id')
			 UNION ALL
			 SELECT 
                t1.IDNumber,
                CONCAT(t1.FirstName,' ',t1.LastName) As FullName,
                t2.Kelas, 
                t2.Ruangan 
             FROM tbl_07_personal_bio t1
             JOIN tbl_08_job_info_std t2
			 ON t1.IDNumber = t2.NIS
			 JOIN tbl_03_b_class_vocational t4
			 ON t2.Kelas = t4.ClassDesc
			 $WHERE_NAME
			 AND t2.Ruangan = (SELECT Homeroom FROM tbl_08_job_info WHERE IDNumber = '$id')
			 ORDER BY $ORDER"
		)->num_rows();

		return [$query, $total];
	}

	public function model_get_class_full_mid_recap($homeroom, $semester, $period){
		$query = $this->db->query(
            "SELECT DISTINCT t1.SubjName FROM tbl_05_subject t1
             JOIN tbl_06_schedule t2
             ON t1.SubjName = t2.SubjName
             WHERE t2.RoomDesc = '$homeroom'
             AND t2.semester = '$semester'
             AND t2.schoolyear = '$period'
             AND t1.Type != 'Non-Subject'
             AND t2.SubjName NOT IN ('EXCUL','ELECTIVE','None','')
             ORDER BY t1.SubjName ASC"
		)->result();
		
		return $query;
	}
}
