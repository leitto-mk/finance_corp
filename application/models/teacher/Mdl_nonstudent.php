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
			"SELECT RoomDesc, Days, SubjName, Hour FROM tbl_06_schedule
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$schYear'
			 AND SubjName NOT IN ('','None','ELECTIVE','EXCUL')
			 ORDER BY Hour"
		)->result();

		return [$queryTaught, $querySchedule];
	}

	public function get_teaching_schedule($id, $semester, $period)
	{

		$query = $this->db->query(
			"SELECT * FROM tbl_06_schedule 
			 WHERE IDNumber = '$id'
			 AND semester = '$semester'
			 AND schoolyear = '$period'
			 ORDER BY FIELD(Days,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'), Hour"
		)->result();

		return $query;
	}

	public function get_active_room()
	{
		$query = $this->db->query(
			"SELECT DISTINCT t3.ClassDesc, t1.RoomDesc FROM tbl_04_class_rooms t1
			 JOIN tbl_02_school t2
			 ON t1.Type = t2.School_Desc
			 JOIN tbl_03_class t3
			 ON t1.Type = t3.Type AND t1.ClassID = t3.ClassID
			 WHERE t2.isActive = 1
			 ORDER BY t3.ClassNumeric, t1.RoomDesc"
		);

		return $query;
	}

	public function get_full_table_grading()
	{
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

	public function model_get_student_reports($header)
	{
		extract($header);

		$WHERE_NAME = ($search == '') ? '' : "WHERE t1.FirstNAme LIKE '$search%' OR t1.LastName LIKE '$search%' OR t1.IDNumber LIKE '$search%' OR t2.Kelas LIKE '$search%' OR t2.Ruangan LIKE '$search%'";
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
			 ORDER BY t3.ClassNumeric, $ORDER
			 LIMIT $limit OFFSET $start"
		)->result();

		return $query;
	}
}
