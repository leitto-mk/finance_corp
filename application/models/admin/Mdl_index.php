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
}
