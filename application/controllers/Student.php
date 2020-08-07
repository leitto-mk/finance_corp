<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('student/Mdl_student');

        //If there is no known user and role is wrong
        if ($this->session->userdata('status') != 'student') {
            echo "<script> console.log('Wrong Role, redirect to Auth'); </script>";
            redirect('Auth/index');
        }
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $room = $this->session->userdata('room');

        $detail = $this->Mdl_student->get_school_detail($room);

        extract($detail);

        $data = [
            'title' => 'Student Information',
            'id' => $this->session->userdata('id'),
            'room' => $room,
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'prof' => $this->Mdl_student->get_full_profile($id),

            //MODAL AKADEMIK
            'period' => $this->Mdl_student->get_period($id),

            //SCHEDULE
            'mon' => $this->Mdl_student->get_schedule($id, 'Senin', $room),
            'tue' => $this->Mdl_student->get_schedule($id, 'Selasa', $room),
            'wed' => $this->Mdl_student->get_schedule($id, 'Rabu', $room),
            'thu' => $this->Mdl_student->get_schedule($id, 'Kamis', $room),
            'fri' => $this->Mdl_student->get_schedule($id, 'Jumat', $room),

            //SCHOOL DETAILS
            'homeroom' => $homeroom,
            'total' => $total,

            //ABSENCE
            'absn' => $this->Mdl_student->get_absent($id, $room, 'Absent'),
            'permit' => $this->Mdl_student->get_absent($id, $room, 'On Permit'),
            'sick' => $this->Mdl_student->get_absent($id, $room, 'Sick'),
            'truant' => $this->Mdl_student->get_absent($id, $room, 'Truant'),
            'late' => $this->Mdl_student->get_absent($id, $room, 'Late'),
        ];

        $this->load->view('student/index', $data);
    }

    public function get_full_acd_detail()
    {
        $id = $_POST['id'];
        $semester = $_POST['semester'];
        $period = $_POST['period'];

        $schedule = $this->Mdl_student->get_schedule_full($id, $semester, $period);
        $grades = $this->Mdl_student->model_get_full_acd_detail($id, $semester, $period);
        $absent = $this->Mdl_student->get_absence_full($id, $semester, $period);

        $sch = '';
        foreach ($schedule as $row) {
            $sch .= '   <tr>
                            <td style="border-bottom: 0px;" class="text-center sbold">
                                ' . $row->Start . ' ' . $row->Finish . '
                            </td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Mon . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Tue . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Wed . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Thu . '</td>
                            <td style="border-bottom: 0px; padding-left: 0px;" class="text-center uppercase sbold">' . $row->Fri . '</td>
                        </tr>';
        }

        $cog = '';
        $i = 1;
        $j = 1;
        $k = 1;
        $l = 1;
        $m = 1;

        foreach ($grades as $row) {
            $cog .= '   <tr>
                            <td class="sbold uppercase"> ' . $i . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate . ' </td>
                            <td class="sbold"> ' . $row->Description . ' </td>
                        </tr>';

            $i++;
        }

        $sk = '';
        $i = 1;
        foreach ($grades as $row) {
            $sk .= '   <tr>
                            <td class="sbold uppercase"> ' . $j . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SK . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SK . ' </td>
                            <td class="sbold"> ' . $row->Description_SK . ' </td>
                        </tr>';

            $j++;
        }

        $soc = '';
        $i = 1;
        $soc .= '<tr class="sbold"><td colspan="5">Social</td></tr>';
        foreach ($grades as $row) {
            $soc .= '   <tr>
                            <td class="sbold uppercase"> ' . $k . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SOC . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SOC . ' </td>
                            <td class="sbold"> ' . $row->Description_SOC . ' </td>
                        </tr>';

            $k++;
        }

        $spr = '';
        $i = 1;
        $spr .= '<tr class="sbold"><td colspan="5">Spiritual</td></tr>';
        foreach ($grades as $row) {
            $spr .= '   <tr>
                            <td class="sbold uppercase"> ' . $l . ' </td>
                            <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                            <td class="sbold uppercase"> ' . $row->Report_SPR . ' </td>
                            <td class="sbold uppercase"> ' . $row->Predicate_SPR . ' </td>
                            <td class="sbold"> ' . $row->Description_SPR . ' </td>
                        </tr>';

            $l++;
        }

        $abs = '';
        foreach ($absent as $row) {
            $abs .= '   <tr>';
            $abs .= '       <td class="sbold"> ' . $m . ' </td>';
            $abs .= '       <td class="sbold"> ' . $row->Absent . ' </td>';
            if ($row->Ket == 'Sick') {
                $abs .= '   <td> <span class="label label-warning label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'On Permit') {
                $abs .= '   <td> <span class="label label-success label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Absent') {
                $abs .= '   <td> <span class="label label-danger label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Truant') {
                $abs .= '   <td> <span class="label label-primary label-sm uppercase">' . $row->Ket . '</span></td>';
            } elseif ($row->Ket == 'Late') {
                $abs .= '   <td> <span class="label label-info label-sm uppercase">' . $row->Ket . '</span></td>';
            }
            $abs .= '   </tr>';

            $m++;
        }

        $response = [
            //SCHEDULE
            'SCH' => $sch,

            //GRADES
            'COG' => $cog,
            'SK' => $sk,
            'SOC' => $soc,
            'SPR' => $spr,

            //ABSENT
            'ABS' => $abs
        ];

        echo json_encode($response);
    }

    public function chg_pass()
    {
        $id = $this->session->userdata('id');
        $sesspass = $this->db->get_where('tbl_credentials', ['IDNumber' => $id])->row()->password;
        $curpass = $_POST['oldpass'];
        $curpass = md5($curpass);
        $newpass = $_POST['newpass'];
        $renewpass = $_POST['renewpass'];

        if ($curpass == '' || $newpass == '' || $renewpass == '') {
            $data = [
                'type' => 'error',
                'title' => 'UPDATE FAILED',
                'text' => 'PLEASE FILL ALL THE FORM!',
                'code' => 'empty'
            ];
        } else {
            if ($curpass !== $sesspass) {
                $data = [
                    'type' => 'error',
                    'title' => 'UPDATE FAILED',
                    'text' => 'CURRENT PASSWORD IS INCORRECT!',
                    'code' => 'incorrect'
                ];
            } else {
                if ($curpass === md5($newpass)) {
                    $data = [
                        'type' => 'error',
                        'title' => 'UPDATE FAILED',
                        'text' => 'NEW PASSWORD IS IDENTICAL WITH CURRENT PASSWORD!',
                        'code' => 'identical'
                    ];
                } else {
                    if ($newpass !== $renewpass) {
                        $data = [
                            'type' => 'error',
                            'title' => 'UPDATE FAILED',
                            'text' => 'PLEASE MATCH NEW PASSWORD WITH RE-CONFIRMATION FIELD!',
                            'code' => 'reconfirm'
                        ];
                    } else {
                        $newpass = md5($newpass);

                        $result = $this->Mdl_student->sv_pass($id, $newpass);

                        if ($result == 'success') {
                            $data = [
                                'type' => 'success',
                                'title' => 'UPDATE SUCCESS',
                                'text' => 'YOUR PASSWORD HAS BEEN UPDATED',
                                'code' => 'success'
                            ];
                        } else {
                            $data = [
                                'type' => 'error',
                                'title' => 'UPDATE FAILED',
                                'text' => 'Update password failed due to server problem !',
                                'code' => 'server'
                            ];
                        }
                    }
                }
            }
        }

        echo json_encode($data);
    }

    public function get_nonregular_subjects()
    {
        $type = $this->uri->segment(3);
        $subj = strtoupper($type);

        $query = $this->db->query(
            "SELECT SubjName FROM tbl_05_subject
             WHERE Type = '$type'
             AND SubjName != '$subj'"
        )->result();

        echo json_encode($query);
    }
}
