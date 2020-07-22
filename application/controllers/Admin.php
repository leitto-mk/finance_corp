<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // =============================== CONSTRUCTOR =============================== //
    public function __construct()
    {
        //SET CONSTRUCTOR FOR THIS FUNCTION
        parent::__construct();

        //LIBRARIES
        $this->load->library('form_validation');
        $this->load->library('pagination');

        //MODEL
        $this->load->model('admin/Mdl_index');
        $this->load->model('admin/Mdl_profile');
        $this->load->model('admin/Mdl_schedule');
        $this->load->model('admin/Mdl_finance');
        $this->load->model('admin/Mdl_grade');
        $this->load->model('admin/Mdl_absent');
        $this->load->model('admin/Mdl_enroll');

        //If there is no known user and role is wrong
        //redirect back to login page
        if ($this->session->userdata('status') != 'admin') {
            redirect('Auth/index');
        }
    }


    // ==================================================================================================================== \\
    // ==============================                    PUBLIC CONTROLLER                   ============================== \\
    // ==================================================================================================================== \\
    public function change_password()
    {
        $id = $this->uri->segment(3);
        $result = $this->Mdl_profile->get_credentials($id);

        $db = $result['password'];
        $cur = $this->input->post('curpass');
        $new = $this->input->post('newpass');
        $confirm = $this->input->post('renew');
        $hashcur = md5($cur);

        if ($cur == '' || $new == '' || $confirm == '') {
            $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert"> Please fill all the form </div>');

            if ($result['status'] == 'admin') {
                redirect('Admin/load_prof_adm' . '#tab_4');
            } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_3');
            } elseif ($result['status'] == 'student') {
                redirect('Admin/load_prof_std_update/' . $id . '#tab_1_3');
            }
        } else {
            if ($hashcur != $db) {
                $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert"> Wrong Current Password </div>');

                if ($result['status'] == 'admin') {
                    redirect('Admin/load_prof_adm' . '#tab_4');
                } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                    redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_3');
                } elseif ($result['status'] == 'student') {
                    redirect('Admin/load_prof_std_update/' . $id . '#tab_1_3');
                }
            } else {
                if ($cur == $new) {
                    $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert"> New Password must not be identical with Current password </div>');

                    if ($result['status'] == 'admin') {
                        redirect('Admin/load_prof_adm' . '#tab_4');
                    } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                        redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_3');
                    } elseif ($result['status'] == 'student') {
                        redirect('Admin/load_prof_std_update/' . $id . '#tab_1_3');
                    }
                } else {
                    if ($new != $confirm) {
                        $this->session->set_flashdata('pass', '<div class="alert alert-success" role="alert"> New Password and Confirm Password does not match </div>');

                        if ($result['status'] == 'admin') {
                            redirect('admin/load_prof_adm' . '#tab_4');
                        } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                            redirect('admin/load_prof_tch_update/' . $id . '#tab_1_3');
                        } elseif ($result['status'] == 'student') {
                            redirect('admin/load_prof_std_update/' . $id . '#tab_1_3');
                        }
                    } else {
                        $pass = md5($new);

                        $this->Mdl_profile->update_pass($id, $pass);

                        $this->session->set_flashdata('pass', '<div class="alert alert-success" role="alert"> Your password has been updated </div>');

                        if ($result['status'] == 'admin') {
                            redirect('admin/load_prof_adm' . '#tab_3');
                        } elseif ($result['status'] == 'teacher' || $result['status'] == 'staff') {
                            redirect('admin/load_prof_tch_update/' . $id . '#tab_1_3');
                        } elseif ($result['status'] == 'student') {
                            redirect('admin/load_prof_std_update/' . $id . '#tab_1_3');
                        }
                    }
                }
            }
        }
    }

    //AJAX CALLBACK FOR SEARCH PROFILE (STUDENT / NON-STUDENT)
    public function get_person_name()
    {
        $output = $_POST['output'];
        $emp = $_POST['emp'];

        $result = $this->Mdl_profile->model_get_person_name($output, $emp);

        $value = '';
        $i = 1;
        foreach ($result as $row) {
            if ($emp == 'student') {
                $value .= ' <tr>
                                <td class="hiddex-xs"> ' . $i . '</td>
                                <td class="hiddex-xs">
                                    <a href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>
                                <td class="hiddex-xs">' . $row->FirstName . $row->LastName . '</td>
                                <td class="hiddex-xs">' . $row->NickName . '</td>
                                <td class="hiddex-xs">' . $row->Gender . '</td>
                                <td class="hiddex-xs">' . $row->DateofBirth . '</td>
                                <td class="hiddex-xs">' . ucfirst($row->status) . '</td>
                                <td class="hiddex-xs">' . $row->Kelas . '</td>
                                <td class="hiddex-xs">' . $row->Ruangan . '</td>
                                <td>
                                    <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;Profile&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std_update/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="' . base_url('Admin/delete/') . $row->IDNumber . ';">
                                        &nbsp;Delete&nbsp;
                                    </a>
                                </td>
                            </tr>';
            } else {
                $value .= ' <tr data-id=" ' . $row->IDNumber . '">
                                <td class="hiddex-xs">' . $i . '</td>
                                <td class="hiddex-xs">
                                    <a href=" ' . base_url('Admin/load_prof_tch/') . $row->IDNumber  . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>

                                <td class="hiddex-xs">' . $row->FirstName . ' ' . $row->LastName . '</td>
                                <td class="hiddex-xs">' . $row->Gender . '</td>
                                <td class="hiddex-xs">' . $row->DateofBirth . '</td>
                                <td class="hiddex-xs">' . ucfirst($row->status) . '</td>
                                <td class="hiddex-xs">' . $row->JobDesc . '</td>
                                <td class="hiddex-xs">' . $row->Honorer . '</td>
                                <td class="hiddex-xs">' . $row->Emp_Type . '</td>
                                <td class="hiddex-xs">' . $row->Homeroom . '</td>
                                <td class="hiddex-xs">' . $row->SubjectTeach . '</td>

                                <td>
                                    <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_tch/') . $row->IDNumber . '">
                                        Profile
                                    </a>
                                    <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_tch_update/') . $row->IDNumber . '">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/delete/') . $row->IDNumber . '">
                                        Delete
                                    </a>
                                </td>
                            </tr>';
            }

            $i++;
        }

        echo $value;
    }

    //AJAX CALLBACK FOR SEARCH PROFILE BY SELECTED
    public function get_active_room_students()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_profile->model_get_active_room_studets($room);

        $value = '';
        $i = 1;
        if ($result) {
            foreach ($result as $row) {

                $value .= ' <tr>
                                <td> ' . $i . '</td>
                                <td>
                                    <a href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        ' . $row->IDNumber . '
                                    </a>
                                </td>
                                <td>' . $row->FirstName . $row->LastName . '</td>
                                <td>' . $row->NickName . '</td>
                                <td>' . $row->Gender . '</td>
                                <td>' . $row->DateofBirth . '</td>
                                <td>' . ucfirst($row->status) . '</td>
                                <td>' . $row->Kelas . '</td>
                                <td>' . $row->Ruangan . '</td>
                                <td>
                                    <a class="btn font-white bg-blue text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;Profile&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-primary text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href=" ' . base_url('Admin/load_prof_std_update/') . $row->IDNumber . '">
                                        &nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
                                    </a>
                                    <a class="btn btn-danger text-center" style="min-height: 10px; min-width: 80px;" data-toggle="modal" href="' . base_url('Admin/delete/') . $row->IDNumber . ';">
                                        &nbsp;Delete&nbsp;
                                    </a>
                                </td>
                            </tr>';

                $i++;
            }
        } else {
            $value .= ' <tr> 
                                <td colspan="8" class="text-center"> NO STUDENT LISTED IN THIS CLASS </td> 
                            </tr>';
        }

        echo $value;
    }

    public function getChart()
    {
        [$pie, $bar] = $this->Mdl_index->model_get_chart();

        $data = [
            'pie' => $pie,
            'bar' => $bar
        ];

        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        //Check status ID, for successfull redirection
        $result = $this->db->query("SELECT * FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();



        if ($result->status == 'teacher') {
            $path = './assets/photos/teachers/';
            $img_name = $result->Photo;
        } elseif ($result->status == 'student') {
            $path = './assets/photos/student/';
            $img_name = $result->Photo;
        } elseif ($result->status == 'staff') {
            $path = './assets/photos/staff/';
            $img_name = $result->Photo;
        } else {
            $path = './assets/photos/adm/';
            $img_name = $result->Photo;
        }

        $this->Mdl_profile->model_delete($id);

        if ($img_name != 'default.png') {
            unlink($path . $img_name);
        }

        $this->session->set_flashdata('delmsg', '<div class="delete-success"></div>');

        if ($result->status == 'teacher' || $result->status == 'staff') {
            redirect('Admin/load_prof_tch_edit');
        } else {
            redirect('Admin/load_prof_std_edit');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     CONTROL PANEL CONTROLLER           ============================== \\
    // ==================================================================================================================== \\
    public function index()
    {
        $tch = 'teacher';
        $std = 'student';
        $stf = 'staff';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch' => $this->Mdl_index->count_specific($tch),
            'std' => $this->Mdl_index->count_specific($std),
            'stf' => $this->Mdl_index->count_specific($stf),
            'count' => $this->Mdl_index->count_total(),
            'tch_t' => $this->Mdl_index->get_teachers($tch),
            'std_t' => $this->Mdl_index->get_student($std),
            'stf_t' => $this->Mdl_index->get_staff($stf)
        ];

        $this->load->view('admin/index', $data);
    }

    public function get_active_degree()
    {
        $result = $this->Mdl_index->model_get_active_degree();

        extract($result);

        $data = [
            'SD' => $SD->isActive,
            'SMP' => $SMP->isActive,
            'SMA' => $SMA->isActive,
            'SMK' => $SMK->isActive
        ];

        echo json_encode($data);
    }

    public function get_state()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_index->model_get_state($degree);

        echo $result;
    }

    public function toggle_degree()
    {
        $degree = $_POST['degree'];
        $state = $_POST['active'];

        $this->Mdl_index->model_toggle_degree($degree, $state);
    }

    public function get_class_list()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_index->model_get_class_list($degree);

        $value = '';
        if ($degree == 'SD' || $degree == 'SMP') {
            $value .= ' <thead>
                            <tr class="uppercase">';
            $i = 1;
            foreach ($result as $row) {
                $value .= '     <th data-class="' . $row['ClassID'] . '" data-class-num="' . $row['ClassNumeric'] . '"> ' . $row['ClassDesc'] . ' 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a>
                                    </span> 
                                </th>';
                $i++;
            }
            $value .= '    </tr>
                        </thead>
                        <tbody>
                            <tr>';
            for ($i = 1; $i <= count($result); $i++) {
                $rooms = $this->Mdl_index->model_get_rooms($degree, $i);

                $value .= '     <td width="1%">';
                foreach ($rooms as $row) {
                    $value .= '     <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $row->RoomID . '" style="padding-right: 5px;"> ' . $row->RoomDesc . '
                                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>
                                    </a><br><br>';
                }
                $value .= '     </td>';
            }
            $value .= '     </tr>
                        </tbody>';
        } elseif ($degree == 'SMA') {
            $value .= ' <thead>
                            <tr>
                                <th colspan="3" class="text-center sbold"> X </th>
                                <th colspan="3" class="text-center sbold"> XI </th>
                                <th colspan="3" class="text-center sbold"> XII </th>
                            </tr>
                            <tr>';
            for ($i = 1; $i <= 3; $i++) {
                $value .= '     <th data-class="SMAC' . $i . 'BHS" data-class-num="' . ($i + 9) . '"> Literature 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>
                                <th data-class="SMAC' . $i . 'IPA" data-class-num="' . ($i + 9) . '"> Science 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>
                                <th data-class="SMAC' . $i . 'IPS" data-class-num="' . ($i + 9) . '"> Social 
                                    <span style="float: right; padding-right: 50px"> 
                                        <a href="javascript:;" class="sbold new_room">
                                            <i class="fa fa-plus" style="font-size: 1.1em"></i>
                                        </a> 
                                    </span> 
                                </th>';
            }
            $value .= '     </tr>
                        </thead>
                        <tbody>
                            <tr>';
            for ($i = 10; $i <= 12; $i++) {
                $sma = $this->Mdl_index->model_get_rooms($degree, $i);

                extract($sma);

                $value .= '<td width="1%">';
                foreach ($Lit as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';

                $value .= '<td width="1%">';
                foreach ($Scn as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';

                $value .= '<td width="1%">';
                foreach ($Soc as $sma) {
                    $value .= ' <a href="javascript:;" class="btn btn-md blue remove_room" data-room="' . $sma['RoomID'] . '" style="padding-right: 5px;"> ' . $sma['Simplified'] . '
                                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> 
                                </a><br><br>';
                }
                $value .= '</td>';
            }
            $value .= '     </tr>
                        </tbody>';
        }

        echo $value;
    }

    public function add_room()
    {
        $degree = $_POST['degree'];
        $cls = $_POST['cls'];
        $num = $_POST['num'];

        $result = $this->Mdl_index->model_add_room($degree, $cls, $num);

        echo $result;
    }

    public function delete_room()
    {
        $room = $_POST['room'];

        if (substr($room, 0, 2) == 'SD' || substr($room, 0, 3) == 'SMP') {
            echo 'abort';
        } else {
            $result = $this->Mdl_index->model_delete_room($room);

            echo $result;
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     PROFILE ADMIN CONTROLLER           ============================== \\
    // ==================================================================================================================== \\
    public function load_prof_adm()
    {
        $id = $this->session->userdata('id');

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'table' => $this->Mdl_profile->get_full_info($id)
        ];

        $this->load->view('admin/adm_prof_adm', $data);
    }

    public function update_img_adm()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-adm.jpg';

        $config = [
            'upload_path' => './assets/photos/adm/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/adm/' . $img_name)) {
            unlink('./assets/photos/adm/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_adm/' . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/adm/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/adm/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_adm/' . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     SCHEDULE CONTROLLER                ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_sche()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo')
        ];

        $this->load->view('admin/adm_acd_sch', $data);
    }

    public function get_degrees()
    {
        $result = $this->Mdl_schedule->model_get_degrees();

        $value = '';
        foreach ($result as $result) {
            $color = '';
            switch ($result->School_Desc) {
                case 'SD':
                    $color = 'red';
                    break;
                case 'SMP':
                    $color = 'blue-steel';
                    break;
                case 'SMA':
                    $color = 'grey-silver';
                    break;
                case 'SMK':
                    $color = 'red-haze';
                    break;
            }

            $value .= ' <div class="portlet box ' . $color . '">
                            <div class="portlet-title" style="padding: 1% 5%;">
                                <div class="caption">
                                    ' . $result->School_Desc . ' </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body sch_' . strtolower($result->School_Desc) . '_classes" style="display: none; padding: 0px 0px 0px 0px;">
                                <!-- AJAX GOES HERE -->
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function load_acd_sch_edit()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Get Data for Every School Level
            'sd_t' => $this->Mdl_schedule->get_sd(),
            'smp_t' => $this->Mdl_schedule->get_smp(),
            'sma_t' => $this->Mdl_schedule->get_sma(),

            'sch_t' => $this->Mdl_schedule->get_sch_info(),

            //Get Dropdown for Modal ADD SCHEDULE
            'class' => $this->Mdl_schedule->get_dropdown_class(),
            'subj' => $this->Mdl_schedule->get_dropdown_subject(),
            'tch' => $this->Mdl_schedule->get_dropdown_teachers()
        ];

        $this->load->view('admin/adm_acd_sch_edit', $data);
    }

    public function load_classes_sch_sd()
    {
        $sd = $this->Mdl_schedule->get_sd();

        $value = '';

        foreach ($sd as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sch_smp()
    {
        $smp = $this->Mdl_schedule->get_smp();

        $value = '';

        foreach ($smp as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sch_sma()
    {
        $sma = $this->Mdl_schedule->get_sma();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default detail_sche" data-room="' . $row->RoomDesc . '">CLASS ' . $row->RoomDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_sche_details()
    {
        //Get Room 
        $room = $this->input->post('room');

        $query = $this->Mdl_schedule->get_schedule_full($room)->result();

        $level = $this->Mdl_schedule->model_get_room_level($room);

        //For checking if Schedule is empty, show clear button
        $schedule = $this->Mdl_schedule->get_sche_roominfo($room);

        //Additional info besides Schedule's Table
        $count = $this->Mdl_schedule->get_class_info($room);
        $chief = $this->Mdl_schedule->get_sche_chief($room);
        $homeroom = $this->Mdl_schedule->get_homeroom($room);

        if ($query) {
            $value = '';
            $value .= '<div class="row">';
            $value .= '     <div class="col-sm-9">';
            $value .= '         <div class="portlet light portlet-fit" style="margin-bottom: 0px;padding-left: 0px;">';
            $value .= '             <div class="portlet-title" style="padding-left: 40px;padding-top: 0px;border-bottom: 0px;margin-bottom: 0px;">';
            $value .= '                 <div class="caption">';
            $value .= '                     <i class="fa fa-calendar font-red font-red"></i>';
            $value .= '                     <span class="caption-subject font-red sbold uppercase" data-degree="' . $level . '" data-room="' . $room . '">&nbsp;SCHEDULE CLASS: ' . $room . '</span>';
            $value .= '                 </div>';
            $value .= '                 <div style="float: right">';
            $value .= '                     <button type="button" class="btn green-jungle btn-circle text-center add_sche" data-toggle="tooltip" data-placement="bottom" title="Add new subject" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                                <icon class="fa fa-plus"/>
                                            </button>';
            if (!empty($schedule->RoomDesc)) {
                $value .= '                 <button type="button" class="btn btn-circle btn-danger text-center delete_sche" data-toggle="tooltip" data-placement="bottom" title="Clear Schedule" data-room="' . $room . '">
                                                <icon class="fa fa-times"/>
                                            </button>';
            }
            $value .= '                 </div>';
            $value .= '             </div>';
            $value .= '             <div class="portlet-body" style="padding-top: 0px;padding-bottom: 0px;">';
            $value .= '                 <div class="table-responsive">';
            $value .= '                     <table class="table table-light">';
            $value .= '                         <thead>';
            $value .= '                             <tr class="uppercase text-justify">';
            $value .= '                                 <th class="text-center" style="min-width: 20px; border-bottom: 0"> Hour </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Monday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Tuesday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Wednesday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Thursday </th>';
            $value .= '                                 <th class="text-center" style="max-width: 80px; border-bottom: 0"> Friday </th>';
            $value .= '                             </tr>';
            $value .= '                         </thead>';
            $value .= '                         <tbody>';
            foreach ($query as $row) {
                $value .= '                         <tr>';
                if ($row->Start != NULL && $row->Finish != NULL) {
                    $value .= '                         <td style="border-bottom: 0px;" class="text-center"> 
                                                            <a class="btn_edit_hour" data-toggle="tooltip" title="Edit Hour" style="font-size: 100%;" data-start="' . $row->Start . '" data-finish="' . $row->Finish . '" data-room="' . $room . '">
                                                                ' . $row->Start . ' - ' . $row->Finish . ' 
                                                            </a>
                                                        </td>';
                }
                if ($row->Mon != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> ' . $row->Mon . '
                                                            <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Senin" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Mon . '">
                                                                <i class="glyphicon glyphicon-edit"/>
                                                            </button>
                                                        </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Tue != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> ' . $row->Tue . '
                                                            <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Selasa" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Tue . '">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button> 
                                                        </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Wed != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> ' . $row->Wed . '
                                                            <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Rabu" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Wed . '">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button> 
                                                        </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Thu != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> ' . $row->Thu . '
                                                            <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Kamis" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Thu . '">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button> 
                                                        </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                if ($row->Fri != NULL) {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"> ' . $row->Fri . '
                                                            <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Jumat" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Fri . '">
                                                                <i class="glyphicon glyphicon-edit"/> 
                                                            </button> 
                                                        </td>';
                } else {
                    $value .= '                         <td style="border-bottom: 0px; padding-left: 0px;" class="text-center"></td>';
                }
                // if ($row->Sat != NULL) {
                //     $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"> ' . $row->Sat . '
                //                                             <button class="btn btn-xs btn_edit_sch" style="font-size: 8px; background-color: #f1f4f7; line-height: 0.5;" data-day="Sabtu" data-room="' . $room . '" data-hour="' . $row->Start . '" data-subj="' . $row->Sat . '">
                //                                                 <i class="glyphicon glyphicon-edit"/>
                //                                             </button> 
                //                                         </td>';
                // } else {
                //     $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"></td>';
                // }
                $value .= '                         <td style="border-bottom: 0px; max-width: 45px; padding-left: 0px;" class="text-center"></td>';
                $value .= '                         </tr>';
            }
            $value .= '                         </tbody>';
            $value .= '                     </table>';
            $value .= '                 </div>';
            $value .= '             </div>';
            $value .= '         </div>';
            $value .= '     </div>';
        } else {
            $value  = '';
            $value .= ' <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">';
            $value .= '     <div class="row">';
            $value .= '         <div class="col-sm-7">
                                    <div class="portlet light portlet-fit">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-calendar font-red font-red"></i>
                                                <span class="caption-subject font-red sbold uppercase">&nbsp;SCHEDULE CLASS: ' . $room . '</span>
                                            </div>';
            if (!empty($schedule->RoomDesc)) {
                $value .= '                 <button type="button" class="btn btn-success text-center add_sche" style="max-height: 50px; min-width: 80px;" data-room="' . $room . '" data-toggle="modal" href="new-sch">
                                                Add
                                            </button>';
                $value .=  '                <button type="button" class="btn btn-danger text-center delete_sche" style="max-height: 50px; min-width: 80px;" data-room="' . $room . '">
                                                Clear
                                            </button>';
            }
            $value .= '                 </div>
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-light">
                                                    <thead>
                                                        <tr class="uppercase text-center">
                                                            <th class="text-center" style="min-width: 20px; border-bottom: 0"> Hour </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Monday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Tuesday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Wednesday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Thursday </th>
                                                            <th style="min-width: 20px; border-bottom: 0"> Friday </th>
                                                        </tr>
                                                        <td class="text-center" colspan="7">
                                                            <p class="font font-weight-bold"> PLEASE SET THE HOUR BEFORE ADDING A NEW SCHEDULE </p>
                                                        </td>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
        }
        $value .= '             <div class="col-sm-3">
                                    <div class="row">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-user font-red font-red"></i>
                                                    <span class="caption-subject font-red sbold uppercase">Class Detail: ' . $room . '</span>
                                                 </div>
                                            </div>
                                            <div class="portlet-body">
                                                <table class="table table-hover table-light" style="padding-left: 20%; padding-right: 20%;;">
                                                    <thead>';
        $value .= '                                     <tr>
                                                            <th class="uppercase" style="width: 35%; border-bottom: 0px;"> Total Students </th>
                                                            <td style="border-top: 0px;"> ' . $count->Total . ' </td>
                                                        </tr>';
        if (!empty($chief)) {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px;"> Class Leader </th>
                                                            <td style="border-top: 0px;"> ' . $chief->Student . ' </td>
                                                            </tr>';
        } else {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Class Leader </th>
                                                            <td style="border-top: 0px;"> None </td>
                                                        </tr>';
        }
        if (!empty($homeroom)) {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Homeroom Teacher </th>
                                                            <td style="border-top: 0px;"> ' . $homeroom->Teacher . ' </td>
                                                        </tr>';
        } else {
            $value .= '                                 <tr>
                                                            <th class="uppercase" style="border-bottom: 0px"> Homeroom Teacher </th>
                                                            <td style="border-top: 0px;"> None </td>
                                                        </tr>';
        }
        $value .= '                                 </thead>
                                                </table>
                                            </div>
                                        </div>';
        $value .= '                 </div>
                                </div>';
        $value .= '         </div>';

        echo $value;
    }

    public function sv_hour_config()
    {
        $hlevel = $_POST['hlevel'];

        $hstart = $_POST['hstart'];
        $brief = date('H:i', strtotime("+15 minutes", strtotime($hstart)));

        $afterbrief = $brief;
        $numclass = $_POST['hourperday'] - 4;
        $hinterval = $_POST['hinterval'];

        $preset = $_POST['preset'];


        $break1 = $_POST['break1'] + 1;
        $break1interval = $_POST['break1interval'];
        $caregroup = $_POST['caregroup'];
        $caregroupinterval = $_POST['caregroupinterval'];
        $break2 = $_POST['break2'] + 1;
        $break2interval = $_POST['break2interval'];
        $exculinterval = $_POST['exculinterval'];

        $hours = [date('H:i:s', strtotime($hstart)), date('H:i:s', strtotime($afterbrief))];

        for ($i = 1; $i <= $numclass; $i++) {
            if ($preset == 'ON') {
                if ($i == $break1 && $caregroup == 'after') {
                    $break = date('H:i:s', strtotime("+$break1interval minutes", strtotime($afterbrief)));
                    $care = date('H:i:s', strtotime("+$caregroupinterval minutes", strtotime($break)));

                    array_push($hours, $break, $care);
                    $afterbrief = $care;
                } elseif ($i == $break1 && $caregroup == 'before') {
                    $care = date('H:i:s', strtotime("+$caregroupinterval minutes", strtotime($afterbrief)));
                    $break = date('H:i:s', strtotime("+$break1interval minutes", strtotime($care)));

                    array_push($hours, $care, $break);
                    $afterbrief = $break;
                }

                if ($i == $break2) {
                    $afterbrief = date('H:i:s', strtotime("+$break2interval minutes", strtotime($afterbrief)));

                    array_push($hours, $afterbrief);
                }
            }

            $afterbrief = date('H:i:s', strtotime("+$hinterval minutes", strtotime($afterbrief)));

            $hours[] = $afterbrief;
        }

        $hours[] = date('H:i:s', strtotime("+$exculinterval minutes", strtotime($afterbrief)));

        $query = $this->Mdl_schedule->modal_sv_hconfig($hlevel, $hours);

        if ($query == 'false') {
            echo 'false';
        } else {
            echo json_encode($hours);
        }
    }

    public function get_decrease_minute()
    {
        $start = strtotime($_POST['current']);
        $finish = strtotime($_POST['finish']);

        $interval = ($start - $finish) / 60;

        $total = abs($interval) - 5;

        $value = '';
        $value .= '<select class="form-control edited interval" id="form_control_1">';
        $value .= '<option value="" selected>by...</option>';
        for ($i = 5; $i <= $total; $i += 5) {
            $value .= '<option value="' . $i . '"> ' . $i . ' Minutes </option>';
        }
        $value .= '</select>';

        echo $value;
    }

    public function sv_new_curhour()
    {
        $data = [
            'room' => $_POST['room'],
            'current' => $_POST['cur'],
            'type' => $_POST['type'],
            'interval' => $_POST['interval'],
        ];

        $this->Mdl_schedule->model_sv_new_curhour($data);

        echo json_encode($data['current']);
    }

    public function reset_hcon()
    {
        $level = $_POST['level'];

        $result = $this->Mdl_schedule->model_reset_hcon($level);

        echo $result;
    }

    public function get_full_tbl_session()
    {
        $result = $this->Mdl_schedule->modal_get_full_tbl_session();

        extract($result);

        $i = 1;
        $j = 1;
        $k = 1;
        $l = 1;

        $regular = '';
        foreach ($reg as $row) {
            $regular .= '<tr>
                            <td> ' . $i . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur-id="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur-name="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                         </tr>';

            $i++;
        }

        $elective = '';
        foreach ($elc as $row) {
            $elective .= '<tr>
                            <td> ' . $j . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur-id="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur-name="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                          </tr>';

            $j++;
        }

        $excul = '';
        foreach ($exc as $row) {
            $excul .= ' <tr>
                            <td> ' . $k . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur-id="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur-name="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                        </tr>';

            $k++;
        }

        $nonsubj = '';
        foreach ($non as $row) {
            $nonsubj .= '<tr>
                            <td> ' . $l . ' </th>
                            <td name="code" contenteditable="true" data-field="SubjID" data-cur-id="' . $row->SubjID . '">' . $row->SubjID . '</th>
                            <td name="subj" contenteditable="true" data-field="SubjName" data-cur-name="' . $row->SubjName . '">' . $row->SubjName . '</th>
                            <td>
                                <a href="javascript:;" data-subj="' . $row->SubjName . '" class="btn btn-icon-only red del_sess">
                                    <i class="fa fa-times"></i>
                                </a> 
                            </td>
                         </tr>';

            $l++;
        }

        $response = [
            'reg' => $regular,
            'elc' => $elective,
            'exc' => $excul,
            'non' => $nonsubj
        ];

        echo JSON_ENCODE($response);
    }

    public function sv_new_session()
    {
        $type = $_POST['type'];
        $code = $_POST['code'];
        $name = $_POST['name'];

        $result = $this->Mdl_schedule->model_sv_new_session($type, $code, $name);

        echo $result;
    }

    public function edit_session()
    {
        $field = $_POST['field'];
        $old = $_POST['old'];
        $new = $_POST['newv'];

        $result = $this->Mdl_schedule->model_edit_session($field, $old, $new);

        echo $result;
    }

    public function det_session()
    {
        $subj = $_POST['subjname'];

        $result = $this->Mdl_schedule->model_det_session($subj);

        echo $result;
    }

    public function load_add_sch()
    {
        //Get Dropdown for Modal ADD SCHEDULE
        $room = $_POST['room'];

        $query = $this->Mdl_schedule->check_students($room);
        $subj = $this->Mdl_schedule->get_dropdown_subject();
        $tch = $this->Mdl_schedule->get_dropdown_teachers();

        $h = $this->Mdl_schedule->get_dropdown_hour($room);

        if ($query > 0) {
            $value = '';
            $value = '<div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                      <div class="col-sm-12">';
            $value .= '<div class="form-group">
                                <label class="control-label col-md-3">Class<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="room" class="form-control" readonly>';
            $value .=                  '<option id="room" value="' . $room . '">' . $room . '</option>';
            $value .= '             </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Day<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="day" class="form-control">
                                        <option value=""> -- Choose -- </option>
                                        <option id="day" value="Senin"> Monday </option>
                                        <option id="day" value="Selasa"> Tuesday </option>
                                        <option id="day" value="Rabu"> Wednesday </option>
                                        <option id="day" value="Kamis"> Thursday </option>
                                        <option id="day" value="Jumat"> Friday </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Hour<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="hour" class="form-control">';
            foreach ($h as $hrow) {
                $value .= '             <option id="hour" value="' . $hrow->Hour . '"> ' . date('H:i', strtotime($hrow->Hour)) . ' </option>';
            }

            $value .= '             </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Subject<span style="color: red">*</span></label>
                                <div class="col-md-4">
                                    <select name="type" class="form-control">
                                        <option value="Regular"> Regular </option>
                                        <option value="Elective"> Elective </option>
                                        <option value="Excul"> Excul </option>
                                        <option value="Non-Subject"> Non Subject </option>
                                    </select>
                                </div>
                                <div class="col-md-5 dd_subj">
                                    <select name="subj" class="form-control">';
            foreach ($subj as $row) {
                $value .=   '           <option id="subj" value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
            $value .=   '           </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group teacher">
                                <label class="control-label col-md-3">Note<span style="color: red">*</span></label>
                                <div class="col-md-9">
                                    <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    $value .=    '          <option id="teacher" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                }
            } else {
                $value .=    '          <option id="teacher" selected="selected"> No Teacher in Database </option>';
            }

            $value .=   '           </select>
                                </div>
                            </div>
                            <br class="teacher">
                            <br class="teacher">
                            <div class="form-group">
                                <label class="control-label col-md-3">Note</label>
                                <div class="col-md-9">
                                    <textarea id="note" name="note" class="form-control" style="max-width: 125%; min-width: 92%;" rows="3" placeholder="Catatan" value="-"></textarea>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn green bg-green submit_new_sche" style="min-width: 85px;">Add</button>
                                <button type="button" class="btn danger" data-dismiss="modal" style="min-width: 85px;">Cancel</button>
                            </div>';
        } else {
            $value = '';
            $value .= 'no_students';
            // $value .= '<div class="modal-body">
            //             <div class="col-sm-12">';
            // $value .= '      <h2 class="text-center display-5"> THIS CLASS HAS NO STUDENTS YET </h2>';
            // $value .= '  </div>
            //           </div>';
            // $value .= '<div class="modal-footer">
            //             <button type="button" class="btn danger" data-dismiss="modal" style="min-width: 85px; margin-top: 35px;"> Close </button>
            //           </div>';
        }


        echo $value;
    }

    public function load_unpicked_hour()
    {
        $room = $_POST['room'];
        $day = $_POST['day'];

        $hour = $this->Mdl_schedule->getNonCollideDate($room, $day);
        $last = $hour->last_row();

        $value = '';
        $value .= '<select name="hour" class="form-control">';

        //Show time only when it's unoccupied and exclude the last one
        foreach ($hour->result() as $row) {
            if ($row->Hour != $last->Hour) {
                $value .= '<option id="hour" value="' . $row->Hour . '"> ' . date('H:i', strtotime($row->Hour)) . ' </option>';
            } elseif (empty($hour)) {
                $value .= '<option id="hour" value="' . $row->Hour . '"> No Session Available </option>';
            }
        }

        echo $value;
    }

    public function get_session_type()
    {
        $type = $_POST['type'];

        $query = $this->Mdl_schedule->modal_get_session_type($type);

        $value = '';

        if ($query->num_rows() < 1) {
            $value .= ' <select name="subj" class="form-control">
                            <option> - </option>
                        </select>';
        } elseif ($type == '') {
            $value .= ' <select name="subj" class="form-control">
                            <option value="-"> --Choose-- </option>
                        </select>';
        } else {
            $value .= '<select name="subj" class="form-control">';
            $value .= '         <option id="subj" value="-"> - </option>';
            foreach ($query->result() as $row) {
                $value .= '     <option id="subj" value="' . $row->SubjName . '"> ' . $row->SubjName . ' </option>';
            }
            $value .= '</select>';
        }

        echo $value;
    }

    public function check_teacher_avail()
    {
        $day = $_POST['day'];
        $hour = $_POST['hour'];
        $teacher = $_POST['teacher'];

        $query = $this->Mdl_schedule->modal_check_teacher_avail($day, $hour, $teacher);

        if ($query == 'proceed') {
            echo $query;
        }

        //echo $day . ' ' . $hour . ' ' . $teacher;
    }

    public function save_add_sch()
    {
        $new = [
            'room' => $_POST['room'],
            'day' => $_POST['day'],
            'hour' => $_POST['hour'],
            'type' => $_POST['type'],
            'subj' => $_POST['subj'],
            'teacher' => $_POST['teacher'],
            'note' => $_POST['note']
        ];

        $result = $this->Mdl_schedule->model_add_sch($new);

        echo $result;
    }

    //LOAD AJAXK FOR DISPLAYING EDIT MENU (MODAL)
    public function load_edit_sch()
    {
        $room = $_POST['room'];
        $day = $_POST['day'];
        $hour = date('H:i:s', strtotime($_POST['hour']));

        //GET SELECTED SCHEDULE DATA
        $data = $this->Mdl_schedule->get_sche_data($day, $room, $hour);

        $type = $data->Type;

        //GET DROPDOWN FOR MODAL ADD SCHEDULE
        $session = $this->Mdl_schedule->get_dropdown_session();
        $subj = $this->Mdl_schedule->get_dropdown_edit_subject($type);
        $tch = $this->Mdl_schedule->get_dropdown_teachers();

        $value = '';
        $value .= '<div class="form-group">
                        <label class="control-label col-md-3">Room<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="room" class="form-control" readonly>';
        $value .=                  '<option id="room" value="' . $room . '">' . $room . '</option>';
        $value .= '             </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Day<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="day" class="form-control" readonly>
                                    <option> ' . $day . ' </option>
                                </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Hour<span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <select name="hour" class="form-control" readonly>
                                    <option> ' . date('H:i', strtotime($hour)) . ' </option>
                                </select>
                                <!-- <span class="help-block"> This is inline help </span> -->
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-md-3">Subject<span style="color: red">*</span></label>
                            <div class="col-md-4">
                                    <select name="type" class="form-control">';
        foreach ($session as $row) {
            if ($row->Type == $data->Type) {
                $value .=   '           <option id="type" value="' . $row->Type . '" selected>' . $row->Type . '</option>';
            } else {
                $value .=   '           <option id="type" value="' . $row->Type . '">' . $row->Type . '</option>';
            }
        }
        $value .= '                  </select>
                                </div>
                            <div class="col-md-5">
                                <select name="subj" class="form-control">';
        foreach ($subj as $row) {
            if ($row->SubjName == $data->SubjName) {
                $value .=   '       <option id="subj" value="' . $row->SubjName . '" selected>' . $row->SubjName . '</option>';
            } else {
                $value .=   '       <option id="subj" value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
        }
        $value .=   '           </select>
                            </div>
                        </div>
                        <br>
                        <br>';

        if ($data->Type == 'Regular') {
            $value .= '     <div class="form-group teacher">
                                <label class="control-label col-md-3">Teacher<span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    if ($row->FullName == $data->TeacherName) {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '" selected>' . $row->FullName . '</option>';
                    } else {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                    }
                }
            } else {
                $value .=    '              <option id="teacher" selected> No Teacher in Database </option>';
            }
            $value .=   '               </select>
                                    <!-- <span class="help-block"> This is inline help </span> -->
                                </div>
                            </div>
                            <br class="teacher">
                            <br class="teacher">';
        } else {
            $value .= '     <div class="form-group teacher" style="display: none">
                                <label class="control-label col-md-3">Teacher<span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <select name="teacher" class="form-control">';
            if ($tch) {
                foreach ($tch as $row) {
                    if ($row->FullName == $data->TeacherName) {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '" selected>' . $row->FullName . '</option>';
                    } else {
                        $value .= '         <option id="teacher" value="' . $row->IDNumber . '">' . $row->FullName . '</option>';
                    }
                }
            } else {
                $value .=    '              <option id="teacher" selected> No Teacher in Database </option>';
            }
            $value .=   '               </select>
                                    <!-- <span class="help-block"> This is inline help </span> -->
                                </div>
                            </div>
                            <br class="teacher" style="display: none">
                            <br class="teacher" style="display: none">';
        }
        $value .= '     <div class="form-group">
                            <label class="control-label col-md-3">Note</label>
                            <div class="col-md-9">
                                <textarea id="note" name="note" class="form-control" style="max-width: 125%; min-width: 92%;" rows="3">' . $data->Note . '</textarea>
                            </div>
                        </div>';

        echo $value;
    }

    public function save_sche_update()
    {
        $ref = [
            'room' => $_POST['upd_room'],
            'day' => $_POST['upd_day'],
            'hour' => date('H:i:s', strtotime($_POST['upd_hour'])),
            'type' => $_POST['upd_type'],
            'subj' => $_POST['upd_subj'],
            'teacher' => $_POST['upd_teacher'],
            'note' => $_POST['upd_note'],
        ];

        $result = $this->Mdl_schedule->model_upd_sch($ref);

        if ($result == 'success') {
            echo $result;
        } elseif ($result == 'unproceed') {
            echo $result;
        } else {
            echo 'error';
        }
    }

    public function delete_sche()
    {
        $room = $this->input->post('room');

        $result = $this->Mdl_schedule->model_delete_sche($room);

        if ($result) {
            echo "DELETED";
        } else {
            echo "SOMETHING'S WRONG";
        }
    }



    // ==================================================================================================================== \\
    // ==============================                     STUDENT GRADES CONTROLLER          ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_grde()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Period (Semester List) for all Modal
            'period' => $this->Mdl_grade->get_period(),

            //For Modal Material (KD)
            'class' => $this->Mdl_grade->get_active_classes(),
            'rooms' => $this->Mdl_grade->get_active_rooms(),
            'subject' => $this->Mdl_grade->get_dd_subjects(),

            //For Modal Grade Option
            'degree' => $this->Mdl_grade->get_active_degree(),

            //For Character Table
            'social' => $this->Mdl_grade->get_social_desc(),
            'spirit' => $this->Mdl_grade->get_spirit_desc()
        ];

        $this->load->view('admin/adm_acd_grde', $data);
    }

    public function get_active_degrees_grade()
    {
        $result = $this->Mdl_grade->model_get_degrees();

        $value = '';
        foreach ($result as $result) {
            $color = '';
            switch ($result->School_Desc) {
                case 'SD':
                    $color = 'red';
                    break;
                case 'SMP':
                    $color = 'blue-steel';
                    break;
                case 'SMA':
                    $color = 'grey-silver';
                    break;
                case 'SMK':
                    $color = 'red-haze';
                    break;
            }

            $value .= ' <div class="portlet box ' . $color . '">
                            <div class="portlet-title" style="padding: 1% 5%;">
                                <div class="caption">
                                ' . $result->School_Desc . ' </div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body ' . strtolower($result->School_Desc) . '_classes" style="display: none; padding: 0px 0px 0px 0px;">
                                <!-- AJAX GOES HERE -->
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function get_table_by_subjects()
    {
        $result = $this->Mdl_grade->model_get_table_by_subjects();

        $value = '';
        $value .= ' <div class="portlet-title" style="border-bottom: 0px;">
                        <div class="caption font-red-sunglo">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase port-title">&nbsp;DETAIL BY SUBJECTS </span>
                            <!-- <span class="caption-helper">monthly stats...</span> -->
                        </div>
                    </div>';
        $value .= ' <div class="portlet-body portlet_subcls">
                        <div class="table-responsive table-hover tbl_cls">
                            <table class="table table_subject_kd">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> CODE </th>
                                        <th> Subject </th>
                                        <th> Subject Type </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                </tbody>';
        $index = 1;
        foreach ($result as $row) {
            $value .= '             <tr>';
            $value .= '                 <td> ' . $index . ' </td>';
            $value .= '                 <td> ' . $row->SubjID . ' </td>';
            $value .= '                 <td> ' . $row->SubjName . ' </td>';
            $value .= '                 <td> ' . $row->Type . ' </td>';
            $value .= '                 <td> 
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-subject="' . $row->SubjName . '" data-type="cognitive" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Cognitive
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-subject="' . $row->SubjName . '" data-type="skills" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Skill
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_grade" data-subject="' . $row->SubjName . '" data-type="character" style="min-width: 100px"> 
                                                <i class="fa fa-edit"></i> Character
                                            </a>
                                        </td>';
            $value .= '             </tr>';

            $index++;
        }
        $value .= '             </tbody>
                            </table>
                        </div>
                    </div>';

        echo $value;
    }

    public function get_kd_by_subject()
    {
        $type = $_POST['type'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];

        $result1 = $this->Mdl_grade->model_get_kd_by_subject($type, $cls, $subj, 1);
        $result2 = $this->Mdl_grade->model_get_kd_by_subject($type, $cls, $subj, 2);

        $i = 1;
        $j = 1;

        $semester1 = '';
        if ($result1) {
            foreach ($result1 as $row) {
                $semester1 .= ' <tr data-code="' . $row->Code . '" data-semester="1" data-subj="' . $row->SubjName . '">
                                    <td contenteditable="true"> ' . $i . ' </td>
                                    <td contenteditable="true" data-field="KD"> ' . $row->KD . ' </td>
                                    <td contenteditable="true" data-field="Code"> ' . $row->Code . ' </td>
                                    <td contenteditable="true" data-field="Adjust"> ' . $row->Adjust . ' </td>
                                    <td contenteditable="true" data-field="KKM"> ' . $row->KKM . ' </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-icon-only red delete_kd">
                                            <i class="fa fa-times"></i>
                                        </a> 
                                    </td>
                                </tr>';

                $i++;
            }
        } else {
            $semester1 .= '<tr>
                                <td colspan="6" class="text-center"> NONE LISTED </td>
                            </tr>';
        }

        $semester2 = '';
        if ($result2) {
            foreach ($result2 as $row) {
                $semester2 .= ' <tr data-code="' . $row->Code . '" data-semester="2" data-subj="' . $row->SubjName . '">
                                    <td contenteditable="true"> ' . $j . ' </td>
                                    <td contenteditable="true" data-field="KD"> ' . $row->KD . ' </td>
                                    <td contenteditable="true" data-field="Code"> ' . $row->Code . ' </td>
                                    <td contenteditable="true" data-field="Adjust"> ' . $row->Adjust . ' </td>
                                    <td contenteditable="true" data-field="KKM"> ' . $row->KKM . ' </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-icon-only red delete_kd">
                                            <i class="fa fa-times"></i>
                                        </a> 
                                    </td>
                                </tr>';

                $j++;
            }
        } else {
            $semester2 .= '<tr>
                                <td colspan="6" class="text-center"> NONE LISTED </td>
                            </tr>';
        }

        $response = [
            'Semester1' => $semester1,
            'Semester2' => $semester2
        ];

        echo json_encode($response);
    }

    public function save_new_kd()
    {
        $type = $_POST['type'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];
        $semester = $_POST['semester'];

        $material = $_POST['material'];
        $code = $_POST['code'];
        $adjust = $_POST['adjust'];

        if ($material != '' && $code != '') {
            $this->Mdl_grade->model_save_new_kd($type, $cls, $subj, $semester, $material, $code, $adjust);
        } else {
            echo 'abort';
        }

        echo 'success';
    }

    public function edit_kd()
    {
        $type = $_POST['type'];
        $field = $_POST['field'];
        $newval = $_POST['newval'];

        $code = $_POST['code'];
        $sem = $_POST['semester'];
        $subj = $_POST['subj'];

        $this->Mdl_grade->model_edit_kd($type, $field, $newval, $code, $sem, $subj);
    }

    public function delete_kd()
    {
        $type = $_POST['type'];
        $code = $_POST['code'];
        $sem = $_POST['semester'];
        $subj = $_POST['subj'];

        $this->Mdl_grade->model_delete_kd($type, $code, $sem, $subj);
    }

    public function get_kkm()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->modal_get_kkm($degree);

        echo $result->KKM;
    }

    public function save_new_kkm()
    {
        $lvl = $_POST['lvl'];
        $kkm = $_POST['kkm'];

        $result = $this->Mdl_grade->modal_save_new_kkm($lvl, $kkm);

        echo $result;
    }

    public function load_classes_sd()
    {
        $sd = $this->Mdl_grade->get_sd();

        $value = '';

        foreach ($sd as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_smp()
    {
        $smp = $this->Mdl_grade->get_smp();

        $value = '';

        foreach ($smp as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_classes_sma()
    {
        $sma = $this->Mdl_grade->get_sma();

        $value = '';

        foreach ($sma as $row) {
            $value .= '<button type="button" style="min-width: 100%; background-color: #fff; border-color: #fff; padding-left: 35px; text-align: left; line-height: 2.5;" 
                            class="btn default cls_grade" data-room="' . $row->ClassDesc . '">CLASS ' . $row->ClassDesc . '</button><br>';
        }

        echo $value;
    }

    public function load_sub_class_grade()
    {
        $room = $this->input->post('room');

        $query = $this->Mdl_grade->model_sub_classes_grade($room);

        $value = '';
        if ($query) {
            $value .= ' <div class="portlet-body portlet_subcls">
                            <div class="table-responsive tbl_cls">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Full Name </th>
                                            <th> Room </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>';
            $i = 1;
            foreach ($query as $row) {
                $value .= '         <tr>
                                        <td> ' . $i . ' </td>
                                        <td> ' . $row->NIS . ' </td>
                                        <td> ' . $row->FullName . ' </td>
                                        <td> ' . $row->Room . ' </td>
                                        <td>';
                // $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_alter" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                //                                 <i class="fa fa-edit"></i> Grades
                //                             </a>';
                $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                                                <i class="fa fa-list-ul"></i> Full Report
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail_compact" data-nis="' . $row->NIS . '" data-class="' . $row->Class . '"> 
                                                <i class="fa fa-list-ul"></i> Summary
                                            </a>
                                        </td>
                                    </tr>';
                $i++;
            }
            $value .= '         </tbody>
                            </table>
                        </div>
                    </div>';
        } else {
            $value .= ' <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Nama Siswa </th>
                                            <th> Ruang Kelas </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"> NO SCHEDULE ARRANGED FOR THIS CLASS YET </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
        }

        echo $value;
    }

    public function load_spec_class_grade()
    {
        //GET DATA FOR TABLES (AJAX)
        $cls = $this->input->post('cls');

        $clss = $this->Mdl_grade->model_get_sub_classes($cls);
        $query = $this->Mdl_grade->model_classes_grade($cls);

        $value = '';
        if (empty($query)) {
            $value .= ' <div class="portlet-title" style="border-bottom: 0px;">
                            <div class="caption font-red-sunglo">
                                <i class="icon-share font-red-sunglo"></i>
                                <span class="caption-subject bold uppercase port-title">&nbsp;STUDENTS CLASS: ' . $cls . ' </span>
                                <!-- <span class="caption-helper">monthly stats...</span> -->
                            </div>
                            <div class="actions">';
            foreach ($clss as $row) {
                $value .= '   <button type="button" class="btn btn-lg btn-circle grey-mint btn-outline sbold uppercase sub_class" data-class="' . $cls . '" data-room="' . $row->RoomDesc . '">' . $row->RoomDesc . '</button>';
            }
            $value .= '     </div>
                        </div>
                        <div class="portlet-body portlet_subcls">
                            <div class="table-responsive tbl_cls">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> NIS </th>
                                            <th> Full Name </th>
                                            <th> Room </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"> NO SCHEDULE ARRANGED FOR THIS CLASS YET </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
        } else {
            $value .= '<div class="portlet-title" style="border-bottom: 0px;">
                        <div class="caption font-red-sunglo">
                            <i class="icon-share font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase port-title">&nbsp;STUDENTS CLASS: ' . $cls . ' </span>
                            <!-- <span class="caption-helper">monthly stats...</span> -->
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">';
            foreach ($clss as $row) {
                $value .= '   <button type="button" class="btn btn-circle grey-mint btn-outline sbold uppercase sub_class" data-class="' . $cls . '" data-room="' . $row->RoomDesc . '">' . $row->RoomDesc . '</button>';
            }
            $value .= '     </div>
                        </div>
                    </div>
                    <div class="portlet-body portlet_subcls">
                        <div class="table-responsive tbl_cls">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> NIS </th>
                                        <th> Full Name </th>
                                        <th> Room </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>';
            $i = 1;
            foreach ($query as $row) {
                $value .= '         <tr>
                                        <td> ' . $i . ' </td>
                                        <td> ' . $row->NIS . ' </td>
                                        <td> ' . $row->FullName . ' </td>
                                        <td> ' . $row->Room . ' </td>
                                        <td>';
                // $value .=                   '<a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_alter" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                //                                 <i class="fa fa-edit"></i> Grades
                //                             </a>';
                $value .= '                 <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                                                <i class="fa fa-list-ul"></i> Full Report
                                            </a>
                                            <a type="submit" class="btn blue-ebonyclay btn-md btn-outline btn_detail_compact" data-nis="' . $row->NIS . '" data-class="' . $cls . '"> 
                                                <i class="fa fa-list-ul"></i> Summary
                                            </a>
                                        </td>
                                    </tr>';
                $i++;
            }
            $value .= '         </tbody>
                            </table>
                        </div>
                    </div>';
        }

        echo $value;
    }

    public function get_full_table_details_cognitive()
    {
        $cls = $_POST['cls'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $type = $_POST['type'];

        $head_details = $this->Mdl_grade->model_get_full_kd_details($cls, $semester, $subj, $type);
        $full_query = $this->Mdl_grade->model_get_person_full_details($cls, $year, $semester, $subj);

        $kd_multi = $head_details->num_rows() * 3;
        $total_kd = $head_details->num_rows();

        $full = '';
        $full .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>NOMOR</b></td>
                            <td style="border-bottom-color:white"></td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $kd_multi . '" class="text-center"><b> PENGETAHUAN </b></td>
                            <td colspan="2" rowspan="2" class="text-center"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="2" rowspan="2" class="text-center"><b> Hasil Penilaian Akhir Semester</b></td>           
                        </tr>
                        
                        <tr>
                            <td rowspan="4" class="text-center"><b> URT </b></td>
                            <td rowspan="4" class="text-center"><b> INDUK </b></td>
                            <td rowspan="4" class="text-center"><b> NAMA </b></td>';
        for ($i = 1; $i <= $head_details->num_rows(); $i++) {
            $full .= '                             
                            <td colspan="3" class="text-center"><b> HPH&nbsp; ' . $i . ' </b> </td>';
        }
        $full .= '      </tr>
                        <tr>';

        foreach ($head_details->result() as $row) {
            $full .= '     <td colspan="3" class="text-center"><b> ' . $row->Code . ' </b> </td>';
        }

        $full .= '         <td colspan="2" class="text-center"><b> HPTS </b></td>
                            <td colspan="2" class="text-center"><b> HPAS </b></td>
                        </tr>
                                            
                        <tr>
                            <td><b> % </b></td>';
        foreach ($head_details->result() as $row) {
            if ($row->Weight1 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1"> ' . $row->Weight1 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1" contenteditable="true" class="table_head" width="3%"></td>';
            }

            if ($row->Weight2 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2"> ' . $row->Weight2 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2" contenteditable="true" class="table_head" width="3%"></td>';
            }

            if ($row->Weight3 != NULL) {
                $full .= '  <td contenteditable="true" class="table_head" data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3"> ' . $row->Weight3 . '%</td>';
            } else {
                $full .= '  <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3" contenteditable="true" class="table_head" width="3%"></td>';
            }
        }
        $full .= '          <td colspan="2"></td>
                            <td colspan="2"></td>                                    
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight1_Desc" contenteditable="true" class="table_head"> ' . $row->Weight1_Desc . ' </td>';
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight2_Desc" contenteditable="true" class="table_head"> ' . $row->Weight2_Desc . ' </td>';
            $full .= '      <td data-type="' . $row->Type . '" data-subj="' . $row->SubjName . '" data-code="' . $row->Code . '" data-field="Weight3_Desc" contenteditable="true" class="table_head"> ' . $row->Weight3_Desc . ' </td>';
        }
        $full .= '          <td class="text-center"><b> NILAI</b></td>
                            <td class="text-center"><b> REMIDI</b></td>
                            <td class="text-center"><b> NILAI</b></td>
                            <td class="text-center"><b> REMIDI</b></td>
                        </tr>
                    </thead>';
        $full .= '  <tbody> ';
        $j = 1;
        foreach ($full_query->result() as $row) {
            $full .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $full .= '          <td> ' . $j . ' </td>';
            $full .= '          <td>' . $row->NIS . '</td>';
            $full .= '          <td colspan="2">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade1" data-code="' . $codes . '">' . $kd_grade['Grade1'] . '</td>';
                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade2" data-code="' . $codes . '">' . $kd_grade['Grade2'] . '</td>';
                $full .= '      <td class="table_body" contenteditable="true" data-row="kd" data-field="Grade3" data-code="' . $codes . '">' . $kd_grade['Grade3'] . '</td>';
            }
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="MidTest"> ' . $row->MidTest . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="MidRemedial"> ' . $row->MidRemedial . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="Final"> ' . $row->Final . ' </td>';
            $full .= '          <td class="table_body" contenteditable="true" data-row="exams" data-field="FinalRemedial"> ' . $row->FinalRemedial . ' </td>';
            $full .= '      </tr>';
            $j++;
        }
        $full .= '  </tbody>';

        $recap = '';
        $recap .= ' <thead>
                        <tr>
                            <td colspan="2" class="text-center" width="1%"> <b> NOMOR </b> </td>
                            <td rowspan="5" class="text-center"> <b> NAMA </b> </td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $total_kd . '" class="text-center"><b>REKAP&nbsp;HPH </b></td>
                            <td rowspan="5" width="2%"><b> Rata-Rata HPH </b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Akhir Semester</b></td>
                            <td rowspan="3" class="text-center"><b> Absent </b></td>
                        </tr>
                        <tr>
                            <td rowspan="5"> <b> URUT </b> </td>
                            <td rowspan="5"> <b> INDUK </b> </td>';
        for ($i2 = 1; $i2 <= $head_details->num_rows(); $i2++) {
            $recap .= '     <td colspan="1" class="text-center"><b> HPH ' . $i2 . ' </b> </td>';
        }
        $recap .= '     </tr>
                        <tr>';
        foreach ($head_details->result() as $row) {
            $recap .= '     <td colspan="1" class="text-center"><b> ' . $row->Code . ' </b></td>';
        }

        $recap_query = $this->Mdl_grade->get_recap_weight($cls, $subj);

        $recap .= '         <td colspan="1" class="text-center"><b> HPTS </b></td>
                            <td colspan="1" class="text-center"><b> HPAS </b></td> 
                        </tr>
                        <tr>
                            <td><b> % </b></td>
                            <td colspan="' . $total_kd . '" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="KDWeight" contenteditable="true"> ' . $recap_query->KDWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="MidWeight" contenteditable="true"> ' . $recap_query->MidWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="FinalWeight" contenteditable="true"> ' . $recap_query->FinalWeight . '% </td>
                            <td colspan="1" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="Absent" contenteditable="true"> ' . $recap_query->Absent . '% </td>
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $w1desc = ($row->Weight1_Desc != '' ? "$row->Weight1_Desc, " : '- ,');
            $w2desc = ($row->Weight2_Desc != '' ? "$row->Weight2_Desc, " : ' - ,');
            $w3desc = ($row->Weight3_Desc != '' ? "$row->Weight3_Desc" : ' -');

            $recap .= "     <td class=\"text-center\" colspan=\"1\">{$w1desc}{$w2desc}{$w3desc}</td>";
        }
        $recap .= '         <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                        </tr>
                    </thead>';
        $recap .= '  <tbody> ';

        $k = 1;
        foreach ($full_query->result() as $row) {
            $recap .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $recap .= '          <td> ' . $k . ' </td>';
            $recap .= '          <td>' . $row->NIS . '</td>';
            $recap .= '          <td colspan="2" width="15%">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $recap .= '      <td data-row="kd" data-field="KDAvg" data-code="' . $codes . '">' . $kd_grade['KDAvg'] . '</td>';
            }
            $recap .= '          <td class="text-center sbold"> ' . $row->KDRecapAvg . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->MidRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->FinalRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->Absent . ' </td>';
            $recap .= '      </tr>';

            $k++;
        }
        $recap .= '  </tbody>';

        $summary = '';
        $summary .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>SISWA</b></td>
                            <td colspan="3" class="text-center"><b>NILAI&nbsp;AKHIR&nbsp;PENGETAHUAN</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>URUT</b></td>
                            <td class="text-center"><b>NAMA</b></td>
                            <td class="text-center"><b> NILAI AKHIR</b></td>
                            <td class="text-center"><b> PREDIKAT </b></td>
                            <td width="35%" class="text-center"><b> DESKRIPSI</b></td>
                        </tr>
                    </thead>';
        $summary .= ' <tbody>';
        $l = 1;
        foreach ($full_query->result() as $smry) {

            if ($smry->Predicate == 'A') {
                $color = '#5edfff';
            } elseif ($smry->Predicate == 'B') {
                $color = '#71a95a';
            } elseif ($smry->Predicate == 'C') {
                $color = '#fbe555';
            } elseif ($smry->Predicate == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $summary .= '   <tr>';
            $summary .= '       <td> ' . $l . ' </td>';
            $summary .= '       <td> ' . $smry->FullName . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $color . '"> ' . $smry->Report . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $color . '"> ' . $smry->Predicate . ' </td>';
            $summary .= '       <td> ' . $smry->Description . ' </td>';
            $summary .= '   </tr>';

            $l++;
        }
        $summary .= ' </tbody>';

        $response = [
            'full' => $full,
            'recap' => $recap,
            'summary' => $summary
        ];

        echo json_encode($response);
    }

    public function get_full_table_details_skills()
    {
        $cls = $_POST['cls'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $type = $_POST['type'];

        $head_details = $this->Mdl_grade->model_get_full_kd_details($cls, $semester, $subj, $type);
        $full_query = $this->Mdl_grade->model_get_person_full_details($cls, $year, $semester, $subj);

        $total_kd = $head_details->num_rows();

        $recap = '';
        $recap .= ' <thead>
                        <tr>
                            <td colspan="2" class="text-center" width="1%"> <b> NOMOR </b> </td>
                            <td rowspan="5" class="text-center"> <b> NAMA </b> </td>
                            <td rowspan="3"> <b> KD </b> </td>
                            <td colspan="' . $total_kd . '" class="text-center"><b>REKAP&nbsp;HPH </b></td>
                            <td rowspan="5" width="2%"><b> Rata-Rata HPH </b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Tengah Semester</b></td>
                            <td colspan="1" rowspan="2" class="text-center" width="3%"><b> Hasil Penilaian Akhir Semester</b></td>
                            <td rowspan="4" class="text-center"><b> Absent </b></td>
                        </tr>
                        <tr>
                            <td rowspan="5"> <b> URUT </b> </td>
                            <td rowspan="5"> <b> INDUK </b> </td>';
        $i = 1;
        for ($i; $i <= $head_details->num_rows(); $i++) {
            $recap .= '     <td colspan="1" class="text-center"><b> HPH ' . $i . ' </b> </td>';
        }
        $recap .= '     </tr>
                        <tr>';
        foreach ($head_details->result() as $row) {
            $recap .= '     <td colspan="1" class="text-center"><b> ' . $row->Code . ' </b></td>';
        }

        $recap_query = $this->Mdl_grade->get_recap_weight($cls, $subj);

        $recap .= '         <td colspan="1" rowspan="2" class="text-center"><b> (HPTS) </b></td>
                            <td colspan="1" rowspan="2" class="text-center"><b> (HPAS) </b></td> 
                        </tr>
                        <tr>
                            <td><b> % </b></td>
                            <td colspan="' . $total_kd . '" class="text-center" data-class="' . $recap_query->Class . '" data-subj="' . $recap_query->SubjName . '" data-field="KDWeight_SK" contenteditable="true"> ' . $recap_query->KDWeight_SK . '% </td>
                        </tr>
                        <tr>
                            <td><b> KET </b></td>';
        foreach ($head_details->result() as $row) {
            $recap .= "     <td class=\"text-center kd_desc_sk\" colspan=\"1\" contenteditable=\"true\" data-type=\"skills\" data-subj=\"$row->SubjName\" data-code=\"$row->Code\" data-field=\"Weight1_Desc\"> $row->Weight1_Desc </td>";
        }
        $recap .= '         <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                            <td colspan="1"><b> NILAI </b></td>
                        </tr>
                    </thead>';
        $recap .= '  <tbody> ';

        $j = 1;
        foreach ($full_query->result() as $row) {
            $recap .= '      <tr data-class="' . $row->Class . '" data-room="' . $row->Room . '">';
            $recap .= '          <td> ' . $j . ' </td>';
            $recap .= '          <td>' . $row->NIS . '</td>';
            $recap .= '          <td colspan="2" width="15%">' . $row->FullName . '</td>';
            foreach ($head_details->result() as $row2) {
                //Eliminate posible white space
                $codes = preg_replace('/\s+/', '', $row2->Code);

                $data = [
                    'nis' => $row->NIS,
                    'smstr' => $semester,
                    'subj' => $subj,
                    'room' => $row->Room,
                    'type' => $type,
                    'code' => $codes
                ];

                $kd_grade = $this->Mdl_grade->get_std_kd_grade($data);

                $recap .= '      <td class="table_body" data-row="kd" data-field="Grade1" data-code="' . $codes . '" contenteditable="true">' . $kd_grade['KDAvg'] . '</td>';
            }
            $recap .= '          <td class="text-center sbold"> ' . $row->KDRecapAvg_SK . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->MidRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->FinalRecap . ' </td>';
            $recap .= '          <td class="text-center sbold"> ' . $row->Absent . ' </td>';
            $recap .= '      </tr>';
            $j++;
        }
        $recap .= '  </tbody>';

        $summary = '';
        $summary .= '<thead>
                        <tr>
                            <td colspan="2" class="text-center"><b>SISWA</b></td>
                            <td colspan="3" class="text-center"><b>NILAI&nbsp;AKHIR&nbsp;PENGETAHUAN</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>URUT</b></td>
                            <td class="text-center"><b>NAMA</b></td>
                            <td class="text-center"><b> NILAI AKHIR</b></td>
                            <td class="text-center"><b> PREDIKAT </b></td>
                            <td width="35%" class="text-center"><b> DESKRIPSI</b></td>
                        </tr>
                    </thead>';
        $summary .= ' <tbody>';

        $k = 1;
        foreach ($full_query->result() as $smry) {

            $col = '';
            if ($smry->Predicate_SK == 'A') {
                $col = '#5edfff';
            } elseif ($smry->Predicate_SK == 'B') {
                $col = '#71a95a';
            } elseif ($smry->Predicate_SK == 'C') {
                $col = '#fbe555';
            } elseif ($smry->Predicate_SK == 'D') {
                $col = '#fb5b5a';
            } else {
                $col = 'black';
            }

            $summary .= '   <tr>';
            $summary .= '       <td> ' . $k . ' </td>';
            $summary .= '       <td> ' . $smry->FullName . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $col . '"> ' . $smry->Report_SK . ' </td>';
            $summary .= '       <td class="text-center sbold" style="color: ' . $col . '"> ' . $smry->Predicate_SK . ' </td>';
            $summary .= '       <td> ' . $smry->Description_SK . ' </td>';
            $summary .= '   </tr>';

            $k++;
        }
        $summary .= ' </tbody>';

        $response = [
            'recap' => $recap,
            'summary' => $summary
        ];

        echo json_encode($response);
    }

    public function get_full_table_details_character()
    {
        $room = $_POST['cls'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];

        $soc_desc = $this->Mdl_grade->get_social_desc();
        $spirit_desc = $this->Mdl_grade->get_spirit_desc();

        $full_query = $this->Mdl_grade->model_get_person_full_details($room, $year, $semester, $subj);

        $i = 1;
        $social = '';
        foreach ($full_query->result() as $row) {
            if ($row->Predicate_SOC == 'A') {
                $color = '#5edfff';
            } elseif ($row->Predicate_SOC == 'B') {
                $color = '#71a95a';
            } elseif ($row->Predicate_SOC == 'C') {
                $color = '#fbe555';
            } elseif ($row->Predicate_SOC == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $social .= '<tr data-room="' . $row->Room . '">';
            $social .= '    <td> ' . $i . ' </td>';
            $social .= '    <td> ' . $row->NIS . ' </td>';
            $social .= '    <td>' . $row->FullName . '</td>';
            foreach ($soc_desc as $soc) {
                $data = [
                    'nis' => $row->NIS,
                    'subj' => $subj,
                    'semester' => $semester,
                    'room' => $room,
                    'type' => $soc->Type,
                    'desc' => $soc->Description
                ];

                $char_grade = $this->Mdl_grade->model_get_character_grade($data);

                $social .= '<td class="text-center data_soc_char" data-type="' . $soc->Type . '" data-desc="' . $soc->Description . '" contenteditable="true"> ' . $char_grade['Point'] . ' </td>';
            }
            $social .= '    <td class="text-center sbold"> ' . $row->Report_SOC . ' </td>';
            $social .= '    <td class="text-center sbold" style="color: ' . $color . '"> ' . $row->Predicate_SOC . ' </td>';
            $social .= '    <td> ' . $row->Description_SOC . ' </td>';
            $social .= '</tr>';

            $i++;
        }

        $k = 1;
        $spirit = '';
        foreach ($full_query->result() as $row) {
            if ($row->Predicate_SPR == 'A') {
                $color = '#5edfff';
            } elseif ($row->Predicate_SPR == 'B') {
                $color = '#71a95a';
            } elseif ($row->Predicate_SPR == 'C') {
                $color = '#fbe555';
            } elseif ($row->Predicate_SPR == 'D') {
                $color = '#fb5b5a';
            } else {
                $color = 'black';
            }

            $spirit .= '<tr data-room="' . $row->Room . '">';
            $spirit .= '    <td>' . $k . ' </td>';
            $spirit .= '    <td>' . $row->NIS . ' </td>';
            $spirit .= '    <td>' . $row->FullName . '</td>';
            foreach ($spirit_desc as $spr) {
                $data = [
                    'nis' => $row->NIS,
                    'subj' => $subj,
                    'semester' => $semester,
                    'room' => $room,
                    'type' => $spr->Type,
                    'desc' => $spr->Description
                ];

                $char_grade = $this->Mdl_grade->model_get_character_grade($data);

                $spirit .= '<td class="text-center data_spr_char" data-type="' . $spr->Type . '" data-desc="' . $spr->Description . '" contenteditable="true"> ' . $char_grade['Point'] . ' </td>';
            }
            $spirit .= '    <td class="text-center sbold"> ' . $row->Report_SPR . ' </td>';
            $spirit .= '    <td class="text-center sbold" style="color: ' . $color . '"> ' . $row->Predicate_SPR . ' </td>';
            $spirit .= '    <td> ' . $row->Description_SPR . ' </td>';
            $spirit .= '</tr>';

            $k++;
        }

        $response = [
            'SOC' => $social,
            'SPR' => $spirit
        ];

        echo json_encode($response);
    }

    public function update_kd_weight()
    {
        $room = $_POST['room'];
        $semester = $_POST['semester'];
        $type = $_POST['type'];
        $subj = $_POST['subj'];
        $code = $_POST['code'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_update_kd_weight($room, $semester, $type, $subj, $code, $field, $value);

        echo $result;
    }

    public function update_recap_weight()
    {
        $semester = $_POST['semester'];
        $room = $_POST['room'];
        $subj = $_POST['subj'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_update_recap_weight($semester, $room, $subj, $field, $value);

        echo $result;
    }

    public function get_active_days()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_active_days($degree);

        echo $result;
    }

    public function sv_active_days()
    {
        $degree = $_POST['degree'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_sv_active_days($degree, $value);

        echo $result;
    }

    public function sv_std_kd_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'fullname' => $_POST['fullname'],
            'semester' => $_POST['semester'],
            'cls' => $_POST['cls'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'code' => $_POST['code'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $result = $this->Mdl_grade->model_sv_kd_grades($data);

        echo $result;
    }

    public function sv_std_exam_grades()
    {
        $data = [
            'nis' => $_POST['nis'],
            'cls' => $_POST['cls'],
            'semester' => $_POST['semester'],
            'room' => $_POST['room'],
            'subj' => $_POST['subj'],
            'type' => $_POST['type'],
            'field' => $_POST['field'],
            'value' => $_POST['val']
        ];

        $result = $this->Mdl_grade->model_sv_exam_grades($data);

        echo $result;
    }

    public function sv_std_char_grades()
    {
        $nis = $_POST['nis'];
        $name = $_POST['name'];
        $semester = $_POST['semester'];
        $subj = $_POST['subj'];
        $room = $_POST['room'];
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $value = $_POST['value'];

        $result = $this->Mdl_grade->model_sv_std_char_grades($nis, $name, $semester, $subj, $room, $type, $desc, $value);

        echo $result;
    }

    public function load_std_grades_dt()
    {
        $nis = $this->input->post('nis');

        $query = $this->Mdl_grade->model_get_std_grades($nis);

        echo json_encode($query);
    }

    public function get_grade_weight()
    {
        $lvl = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_grade_weight($lvl)->row();

        echo json_encode($result);
    }

    public function get_grade_weight_nat()
    {
        $degree = $_POST['degree'];

        $result = $this->Mdl_grade->model_get_grade_weight_nat($degree)->result();

        echo json_encode($result);
    }

    public function save_grade_weight()
    {
        $data = [
            'degree' => $_POST['lvl'],
            'field' => $_POST['field'],
            'value' => $_POST['value']
        ];

        $result = $this->Mdl_grade->model_sv_grade_weight($data);

        echo $result;
    }

    public function save_nat_weight()
    {
        $degree = $_POST['degree'];
        $type = $_POST['type'];
        $field = $_POST['field'];
        $val = $_POST['val'];

        $this->Mdl_grade->modal_save_nat_weight($degree, $type, $field, $val);
    }

    public function load_predicate()
    {
        $spectrum = $this->Mdl_grade->get_spectrum_asc();

        $val = '';
        foreach ($spectrum as $row) {
            $val .= '<tr data-prd="' . $row->Predicate . '">
                        <td class="sbold"> ' . $row->Predicate . ' </td>
                        <td contenteditable="true" data-prd="max"> ' . $row->Maximum . ' </td>
                        <td contenteditable="true" data-prd="min"> ' . $row->Minimum . ' </td>
                     </tr>';
        }

        echo $val;
    }

    public function post_predicate()
    {
        $predicate = $_POST['predicate'];
        $max = $_POST['max'];
        $min = $_POST['min'];

        $this->Mdl_grade->model_post_predicate($predicate, $max, $min);
    }

    public function get_grade_report()
    {
        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $subj = $_POST['subj'];
        $semester = $_POST['semester'];

        $result_kd = $this->Mdl_grade->get_std_kd_det($nis, $subj, $semester);

        $kd_cog = '';
        $kd_sk = '';
        $l = 1;
        $m = 1;
        foreach ($result_kd as $row) {

            $color = '';
            if ($row->KDAvg < $row->KKM) {
                $color = '#fb5b5a';
            } else {
                $color = '#71a95a';
            }

            if ($row->Type == 'cognitive') {
                $kd_cog .= '<tr>';
                $kd_cog .= '    <td>' . $l . '</td>';
                $kd_cog .= '    <td>' . $row->KD . '</td>';
                $kd_cog .= '    <td>' . $row->Code . '</td>';
                $kd_cog .= '    <td class="sbold">' . $row->KKM . '</td>';
                $kd_cog .= '    <td class="sbold" style="color: ' . $color . '">' . $row->KDAvg . '</td>';
                $kd_cog .= '</tr>';

                $l++;
            } elseif ($row->Type == 'skills') {
                $kd_sk .= '<tr>';
                $kd_sk .= '    <td>' . $m . '</td>';
                $kd_sk .= '    <td>' . $row->KD . '</td>';
                $kd_sk .= '    <td>' . $row->Code . '</td>';
                $kd_sk .= '    <td class="sbold">' . $row->KKM . '</td>';
                $kd_sk .= '    <td class="sbold" style="color: ' . $color . '">' . $row->KDAvg . '</td>';
                $kd_sk .= '</tr>';

                $m++;
            }
        }

        $result_exam = $this->Mdl_grade->get_std_exam_det($nis, $cls, $subj, $semester);

        $exam = '';
        $exam .= '<tr>';
        $exam .= '    <td colspan="4" class="text-center"> <b> Mid Test </b> </td>';
        $exam .= '    <td colspan="1" class="sbold">' . $result_exam->MidRecap . '</td>';
        $exam .= '</tr>';
        $exam .= '<tr>';
        $exam .= '    <td colspan="4" class="text-center"> <b> Final </b> </td>';
        $exam .= '    <td colspan="1" class="sbold">' . $result_exam->FinalRecap . '</td>';
        $exam .= '</tr>';

        $result_report = $this->Mdl_grade->get_std_report_det($nis, $cls, $subj, $semester);

        $col = '';
        if ($result_report->Predicate == 'A') {
            $col = '#5edfff';
        } elseif ($result_report->Predicate == 'B') {
            $col = '#71a95a';
        } elseif ($result_report->Predicate == 'C') {
            $col = '#fbe555';
        } elseif ($result_report->Predicate == 'D') {
            $col = '#fb5b5a';
        }

        $col_SK = '';
        if ($result_report->Predicate_SK == 'A') {
            $col_SK = '#5edfff';
        } elseif ($result_report->Predicate_SK == 'B') {
            $col_SK = '#71a95a';
        } elseif ($result_report->Predicate_SK == 'C') {
            $col_SK = '#fbe555';
        } elseif ($result_report->Predicate_SK == 'D') {
            $col_SK = '#fb5b5a';
        }

        $report = '';
        $report .= '<tr>';
        $report .= '    <td colspan="4" class="text-center">' . $result_report->Report . '</td>';
        $report .= '    <td colspan="1" class="sbold" style="color: ' . $col . '">' . $result_report->Predicate . '</td>';
        $report .= '</tr>';

        $report_sk = '';
        $report_sk .= '<tr>';
        $report_sk .= '    <td colspan="4" class="text-center">' . $result_report->Report_SK . '</td>';
        $report_sk .= '    <td colspan="1" class="sbold" style="color: ' . $col_SK . '">' . $result_report->Predicate_SK . '</td>';
        $report_sk .= '</tr>';

        $desc_cog = '<tr> 
                        <td colspan="5" style="padding: 25px"> ' . $result_report->Description . ' </td>
                     </tr>';
        $desc_sk = '<tr> 
                        <td colspan="5" style="padding: 25px"> ' . $result_report->Description_SK . ' </td>
                     </tr>';



        $soc = '';
        $soc = '<tr>
                    <td class="text-center"> ' . $result_report->Description_SOC . ' </td>
                    <td class="text-center sbold" style="color: #4B77BE"> ' . $result_report->Report_SOC . ' </td>
                    <td class="text-center sbold" style="color: #BF55EC"> ' . $result_report->Predicate_SOC . ' </td>
                </tr>';

        $spr = '';
        $spr = '<tr>
                    <td class="text-center"> ' . $result_report->Description_SPR . ' </td>
                    <td class="text-center sbold" style="color: #4B77BE"> ' . $result_report->Report_SPR . ' </td>
                    <td class="text-center sbold" style="color: #BF55EC"> ' . $result_report->Predicate_SPR . ' </td>
                </tr>';

        $data = [
            'KDCog' => $kd_cog,
            'KDSK' => $kd_sk,
            'EXM' => $exam,
            'REPCog' => $report,
            'REPSK' => $report_sk,
            'DESCCog' => $desc_cog,
            'DESCSK' => $desc_sk,
            'SOC' => $soc,
            'SPR' => $spr,
        ];

        echo json_encode($data);
    }

    public function get_grade_report_compact()
    {
        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $semester = $_POST['semester'];

        $row = $this->Mdl_grade->model_get_grade_report($nis, $cls, $semester)->result();
        $matrix = $this->Mdl_grade->get_spectrum();
        $character = $this->Mdl_grade->model_get_character_grade_compact($nis, $semester);
        $absence = $this->Mdl_grade->get_absent($nis, $cls, $semester);

        $cognitive = '';
        $skills = '';
        // $cognitive .= ' <tr> 
        //                     <td colspan="5" class="sbold" style="padding-left: 10px; padding-top: 2px; padding-bottom: 2px"> Regular </td>
        //                 <tr>';
        // $skills .= ' <tr> 
        //                     <td colspan="5" class="sbold" style="padding-left: 10px; padding-top: 2px; padding-bottom: 2px"> Regular </td>
        //                 <tr>';
        $i = 1;
        if (!empty($row)) {
            foreach ($row as $compact) {
                $cognitive .= ' <tr>    
                                <td> ' . $i . ' </td>
                                <td> ' . $compact->SubjName . ' </td>
                                <td> ' . $compact->Report . ' </td>';
                $skills .= ' <tr>    
                                <td> ' . $i . ' </td>
                                <td> ' . $compact->SubjName . ' </td>
                                <td> ' . $compact->Report_SK . ' </td>';
                if ($compact->Predicate == 'A') {
                    $cognitive .= '     <td class="sbold" style="color: #5edfff; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'B') {
                    $cognitive .= '     <td class="sbold" style="color: #71a95a; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'C') {
                    $cognitive .= '     <td class="sbold" style="color: #fbe555; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                } elseif ($compact->Predicate == 'D') {
                    $cognitive .= '     <td class="sbold" style="color: #fb5b5a; padding-left: 3%"> ' . $compact->Predicate . ' </td>';
                }

                if ($compact->Predicate_SK == 'A') {
                    $skills .= '        <td class="sbold" style="color: #5edfff; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'B') {
                    $skills .= '        <td class="sbold" style="color: #71a95a; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'C') {
                    $skills .= '        <td class="sbold" style="color: #fbe555; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                } elseif ($compact->Predicate_SK == 'D') {
                    $skills .= '        <td class="sbold" style="color: #fb5b5a; padding-left: 3%"> ' . $compact->Predicate_SK . ' </td>';
                }

                $cognitive .= '         <td>
                                            ' . $compact->Description . '
                                        </td>
                                    </tr>';
                $skills .= '            <td>
                                            ' . $compact->Description_SK . '
                                        </td>
                                    </tr>';

                $i++;
            }
            // $cognitive .= ' <tr> 
            //                 <td colspan="5" class="sbold" style="padding-left: 10px"> Elective </td>
            //             <tr>';
        } else {
            $cognitive .= '<tr><td colspan="5"> No Subjects has been assigned yet </td></tr>';
            $skills .= '<tr><td colspan="5"> No Subjects has been assigned yet </td></tr>';
        }

        $spectrum = '';
        $spectrum .= '  <tr>';
        foreach ($matrix as $row) {
            $spectrum .= '<td class="sbold text-center"> ' . $row->Minimum . ' - ' . $row->Maximum . ' </td>';
        }
        $spectrum .= '  </tr>';


        $k = 1;
        $soc = '';
        $soc .= '<tr class="sbold"><td colspan="5">Social</td></tr>';
        if (!empty($character)) {
            foreach ($character as $row) {
                if ($row->Predicate_SOC == 'A') {
                    $col1 = '#5edfff';
                } elseif ($row->Predicate_SOC == 'B') {
                    $col1 = '#71a95a';
                } elseif ($row->Predicate_SOC == 'C') {
                    $col1 = '#fbe555';
                } else {
                    $col1 = '#fb5b5a';
                }

                $soc .= '   <tr>
                                <td class="sbold uppercase"> ' . $k . ' </td>
                                <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                                <td class="sbold uppercase"> ' . $row->Report_SOC . ' </td>
                                <td class="sbold uppercase" style="color: ' . $col1 . '"> ' . $row->Predicate_SOC . ' </td>
                                <td class="sbold"> ' . $row->Description_SOC . ' </td>
                            </tr>';

                $k++;
            }
        } else {
            $soc .= '       <tr>
                                <td colspan="5" class="text-center sbold"> Social Grades is still empty </td>
                            </tr>';
        }

        $l = 1;
        $spr = '';
        $spr .= '<tr class="sbold"><td colspan="5">Spiritual</td></tr>';
        if (!empty($character)) {
            foreach ($character as $row) {
                if ($row->Predicate_SPR == 'A') {
                    $col2 = '#5edfff';
                } elseif ($row->Predicate_SPR == 'B') {
                    $col2 = '#71a95a';
                } elseif ($row->Predicate_SPR == 'C') {
                    $col2 = '#fbe555';
                } else {
                    $col2 = '#fb5b5a';
                }

                $spr .= '   <tr>
                                <td class="sbold uppercase"> ' . $l . ' </td>
                                <td class="sbold uppercase"> ' . $row->SubjName . ' </td>
                                <td class="sbold uppercase"> ' . $row->Report_SPR . ' </td>
                                <td class="sbold uppercase" style="color: ' . $col2 . '"> ' . $row->Predicate_SPR . ' </td>
                                <td class="sbold"> ' . $row->Description_SPR . ' </td>
                            </tr>';

                $l++;
            }
        } else {
            $spr .= '       <tr>
                                <td colspan="5" class="text-center sbold"> Spiritual Grades is still empty </td>
                            </tr>';
        }

        $absent = '';
        if ($absence->num_rows() != 0) {
            foreach ($absence->result() as $row) {
                if ($row->Ket != NULL) {
                    $absent .= '<tr>';
                    $absent .= '    <td width="25%"> ' . $row->Ket . ' </td>';
                    $absent .= '    <td> ' . $row->Total . '</td>
                                </tr>';
                }
            }
        } else {
            $absent .= '<tr> 
                            <td colspan="2"> This Student has no absent </td> 
                        </tr>';
        }

        $data = [
            'COG' => $cognitive,
            'SK' => $skills,
            'Spectrum' => $spectrum,
            'SOC' => $soc,
            'SPR' => $spr,
            'Absent' => $absent
        ];

        echo json_encode($data);
    }

    public function get_std_subject_list()
    {
        $nis = $_POST['nis'];
        $cls = $_POST['cls'];
        $semester = $_POST['rep_semester'];

        $subj = isset($_POST['subj']) ? $_POST['subj'] : '';

        $result = $this->Mdl_grade->model_get_subject_list($nis, $cls, $semester);

        $dd_list_subj = '';
        $dd_list_subj .= '   <div class="form-group form-md-line-input form-md-floating-label has-info">';
        $dd_list_subj .= '       <select class="form-control avail_subj" id="form_control_1">';
        foreach ($result as $row) {
            if ($row->SubjName == $subj) {
                $dd_list_subj .= '           <option value="' . $row->SubjName . '" selected>' . $row->SubjName . '</option>';
            } else {
                $dd_list_subj .= '           <option value="' . $row->SubjName . '">' . $row->SubjName . '</option>';
            }
        }
        $dd_list_subj .= '       </select>';
        $dd_list_subj .= '   <label for="form_control_1">Select Subject</label>';
        $dd_list_subj .= '   </div>';


        echo $dd_list_subj;
    }

    public function display_report_print()
    {
        $nis = $this->input->get('nis');
        $cls = $this->input->get('cls');
        $subj = $this->input->get('subj');
        $semester = $this->input->get('semester');
        $report_type = 'full';

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $semester, $report_type),
            'kd' => $this->Mdl_grade->get_std_kd_det($nis, $subj, $semester),
            'exam' => $this->Mdl_grade->get_std_exam_det($nis, $cls, $subj, $semester),
            'rep' => $this->Mdl_grade->get_std_report_det($nis, $cls, $subj, $semester),
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Absent'),
        ];

        $this->load->view('grade_report_print', $data);
    }

    public function display_report_mid_print()
    {
        $nis = $this->input->get('nis');
        $cls = $this->input->get('cls');
        $subj = $this->input->get('subj');
        $semester = $this->input->get('semester');
        $report_type = 'mid';

        [$query, $score, $average] = $this->Mdl_grade->get_report_mid_grade($nis, $cls, $semester);

        $data = [
            'info' => $this->Mdl_grade->get_report_print_info($nis, $cls, $subj, $semester, $report_type),
            'subjects' => $query,
            'score' => $score,
            'average' => $average,
            'sick' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Sick'),
            'permit' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'On Permit'),
            'absent' => $this->Mdl_grade->get_print_absent($nis, $cls, $semester, 'Absent')
        ];

        $this->load->view('grade_report_mid_print', $data);
    }


    // ==================================================================================================================== \\
    // ==============================                    ABSENT CONTROLLER                   ============================== \\
    // ==================================================================================================================== \\
    public function load_acd_absn()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            'type' => $this->Mdl_absent->get_absent_type()
        ];

        $this->load->view('admin/adm_acd_absn', $data);
    }

    public function get_classes()
    {
        $query = $this->Mdl_absent->model_get_classes();

        $value = '';
        $value .= '<select name="rooms" class="form-control" id="class_dd" style="margin-left: 5px;">';
        $value .= '<option> -- Select Class -- </option>';
        foreach ($query as $row) {
            $value .= '<option id="room" value="' . $row->RoomDesc . '"> ' . $row->RoomDesc . ' </option>';
        }
        $value .= '</select>';

        echo $value;
    }

    public function get_tbl_byclass()
    {
        $room = $this->input->post('room');

        $query = $this->Mdl_absent->modal_tbl_search_std($room);

        $value = '';
        if (!empty($query)) {
            foreach ($query as $row) {
                $value .= '<tr class="gradeX odd" role="row">
                                <td><input class="form-check-input" name="std-checkbox" type="checkbox" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '"></td>
                                <td> <a href="#" class="nis" data-status="student" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>
                                <td> ' . $row->FullName . ' </td>
                            </tr>';
            }
        } else {
            $value .= '<tr class="gradeX odd" role="row">
                            <td colspan="2"> NO STUDENT IN THIS CLASS </td>
                        </tr>';
        }


        echo $value;
    }

    public function get_tbl_personal()
    {
        $data = $this->input->post('search');
        $status = $this->input->post('status');

        $query = $this->Mdl_absent->modal_tbl_search_personal($data, $status);

        $value = '';
        if (!empty($query)) {
            foreach ($query as $row) {
                $value .= '<tr class="gradeX odd" role="row">
                                <td><input class="form-check-input" type="checkbox" data-name="' . $row->FullName . '" value="' . $row->IDNumber . '"></td>';
                if ($status == 'student') {
                    $value .= '     <td> <a href="#" class="nis" data-status="student" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>';
                } else {
                    $value .= '     <td> <a href="#" class="nis" data-status="teacher" data-id="' . $row->IDNumber . '"> ' . $row->IDNumber . ' </a> </td>';
                }

                $value .= '         <td> ' . $row->FullName . ' </td>
                            </tr>';
            }
        } else {
            $value .= '<tr class="gradeX odd" role="row">
                            <td colspan="2"> NO STUDENT IN THIS CLASS </td>
                        </tr>';
        }

        echo $value;
    }

    public function get_ids_cur_subject()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_absent->model_get_cur_subject($room);

        echo json_encode($result);
    }

    public function add_absent_std()
    {
        $id = $_POST['selected'];
        $type = $_POST['type'];
        $date = $_POST['new_date'];
        $subj = (($_POST['subj'] !== '') ? $_POST['subj'] : NULL);
        $hour = (($_POST['time'] !== '') ? $_POST['time'] : NULL);
        $status = $_POST['status'];

        $id = (count($id) > 1 ? implode(',', $id) : $id[0]);

        $this->Mdl_absent->model_insert_absent($id, $type, $date, $subj, $hour, $status);
    }

    public function get_absn_det()
    {

        $data = $this->input->post('id');
        $status = $this->input->post('status');

        $query = $this->Mdl_absent->get_absn_det($data, $status);
        $total_absn = $this->Mdl_absent->model_total_absn($data, $status);

        $value = '';
        $value .= '<thead>
                        <tr>
                            <th> ID </th>
                            <th> Fullname </th>
                            <th> Absence Date </th>
                            <th> Absence Type </th>';
        $value .= '     </tr>
                    </thead>';
        if (!empty($query->result())) {
            $value .= ' <tbody>';
            $i = 1;
            foreach ($query->result() as $row) {
                $value .= '     <tr>';
                if ($i == 1) {
                    if ($status == 'student') {
                        $value .= ' <td> ' . $row->NIS . ' </td>';
                    } else {
                        $value .= ' <td> ' . $row->IDNumber . ' </td>';
                    }
                    $value .= '     <td> ' . $row->FullName . ' </td>';
                    $value .= '     <td> ' . date('d-m-Y', strtotime($row->Absent)) . ' </td>';
                    if ($row->Ket == 'Sick') {
                        $value .= '     <td> <span class="label label-warning label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'On Permit') {
                        $value .= '     <td> <span class="label label-success label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Absent') {
                        $value .= '     <td> <span class="label label-danger label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Truant') {
                        $value .= '     <td> <span class="label label-primary label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Late') {
                        $value .= '     <td> <span class="label label-info label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    }
                } else {
                    $value .= '     <td></td>';
                    $value .= '     <td></td>';
                    $value .= '     <td> ' . date('d-m-Y', strtotime($row->Absent)) . ' </td>';
                    if ($row->Ket == 'Sick') {
                        $value .= '     <td> <span class="label label-warning label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'On Permit') {
                        $value .= '     <td> <span class="label label-success label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Absent') {
                        $value .= '     <td> <span class="label label-danger label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Truant') {
                        $value .= '     <td> <span class="label label-primary label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    } elseif ($row->Ket == 'Late') {
                        $value .= '     <td> <span class="label label-info label-sm uppercase"> ' . $row->Ket . ' </span> </td>';
                    }
                }
                $value .= '     </tr>';

                $i++;
            }
            $value .= ' </tbody>';
            $value .= ' <thead> 
                            <tr> 
                                <th>
                                    <td class="sbold"> Total Absent </td>';
            $value .= '             <td class="sbold"> ' . $total_absn . ' </td>';
            $value .= '         </th> 
                            </tr> 
                        </thead>';
        } else {
            $value .= ' <tbody>';
            $value .= '     <tr>';
            if ($status == 'student') {
                $value .= '         <td colspan="6"> STUDENT ' . $data . ' HAS NO ABSENT ON RECORD <td>';
            } else {
                $value .= '         <td colspan="6"> ID ' . $data . ' HAS NO ABSENT ON RECORD <td>';
            }
            $value .= '     </tr>';
            $value .= ' </tbody>';
        }

        echo $value;
    }

    // =============================================================================================================================== \\
    // ==============================                     PROFILE TEACHER / STAFF CONTROLLER            ============================== \\
    // =============================================================================================================================== \\
    public function load_prof_tch_edit()
    {
        $tch = 'teacher';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch_t' => $this->Mdl_profile->get_teachers($tch)
        ];

        $this->load->view('admin/adm_prof_tch_edit', $data);
    }

    public function load_prof_tch()
    {
        $id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'tch_t' => $this->Mdl_profile->get_full_info($id)

        ];

        $this->load->view('admin/adm_prof_tch', $data);
    }

    public function load_prof_tch_add()
    {
        $status = 'teacher';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'room' => $this->Mdl_profile->get_classrooms(),
            'subj' => $this->Mdl_profile->get_dropdown_subject()
        ];

        $this->load->view('admin/adm_prof_tch_add', $data);
    }

    //Page loads only when accessed through Edit Page
    //No Direct access through NAVBAR
    public function load_prof_tch_update()
    {
        $selected_id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'room' => $this->Mdl_profile->get_classrooms(),
            'subj' => $this->Mdl_profile->get_dropdown_subject(),

            //Get data from ID that will be editted
            'datatoedit' => $this->Mdl_profile->get_full_info($selected_id)
        ];

        $this->load->view('admin/adm_prof_tch_update', $data);

        return $selected_id;
    }

    public function get_homeroom_availability()
    {
        $room = $_POST['room'];

        $result = $this->Mdl_profile->model_get_homeroom_availability($room);

        echo json_encode($result);
    }

    public function add_tch()
    {
        $id = $_POST['newid'];
        $img = $_FILES['image']['name'];
        $img_name = 'img-' . $id . '-tch.jpg';

        $config = [
            'upload_path' => './assets/photos/teachers/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        if ($img == '') {
            $img_name = 'default.png';
        }

        if ($institute == '') {
            $institute = 'no';
        }

        $status = $_POST['status'];

        $table1 = [
            'IDNumber' => $id,
            'PersonalID' => $_POST['newktp'],
            'FirstName' => ucfirst(strtolower($_POST['newfname'])),
            'LastName' => ucfirst(strtolower($_POST['newlname'])),
            'status' => $status,
            'Gender' => $_POST['gender'],
            'DateofBirth' => date("Y-m-d", strtotime($_POST['newtgllhr'])),
            'PointofBirth' => $_POST['newtmplhr'],
            'Address' => $_POST['newaddr'],
            'District' => $_POST['newdis'],
            'Region' => $_POST['newreg'],
            'City' => $_POST['newcity'],
            'Province' => $_POST['newprov'],
            'Country' => $_POST['newnat'],
            'Photo' => $img_name
        ];

        $table2 = [
            'IDNumber' => $id,
            'Occupation' => $_POST['status'],
            'Honorer' => $_POST['honorer'],
            'Emp_Type' => $_POST['emp'],
            'Homeroom' => $_POST['homeroom'],
            'JobDesc' => $_POST['jobdesc'],
            'SubjectTeach' => $_POST['subjteach'],
            'LastEducation' => $_POST['education'],
            'StudyFocus' => $_POST['diploma'],
            'Govt_Cert' => $_POST['govt'],
            'Institute_Cert' => $_POST['institute'],
            'YearStarts' => $_POST['starts'],
            'MaritalStatus' => $_POST['marital'],
            'Email' => $_POST['newmail'],
            'Phone' => $_POST['newtelp']
        ];

        $result = $this->Mdl_profile->new_tch($id, $status, $table1, $table2);

        if ($result == 'success') {
            // $this->upload->data(); //Upload data to upload_path
            if (!$this->upload->do_upload('image')) {
                $error_msg = $this->upload->display_errors();

                $this->session->set_flashdata('disp_err', "<div class=\"alert alert-success text-center text-uppercase\" role=\"alert\"> $errormsg </div>");
            } else {
                $this->session->set_flashdata('addmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> New Teacher Added!!! </div>');
            }

            redirect('Admin/load_prof_tch_edit');
        } else {
            $this->session->set_flashdata('addmsg', '<div class="alert alert-danger text-center text-uppercase" role="alert"> ID already Existed!!! </div>');
            redirect('Admin/load_prof_tch_edit');
        }
    }

    public function update_tch()
    {
        $selected_id = $this->uri->segment(3);

        $institute = $_POST['inst'];

        if ($institute == '') {
            $institute = 'no';
        }

        $table1 = [
            'PersonalID' => $_POST['newktp'],
            'FirstName' => ucfirst(strtolower($_POST['newfname'])),
            'LastName' => ucfirst(strtolower($_POST['newlname'])),
            'status' => $_POST['status'],
            'Gender' => $_POST['gender'],
            'DateofBirth' => date("Y-m-d", strtotime($_POST['newtgllhr'])),
            'PointofBirth' => $_POST['newtmplhr'],
            'Address' => $_POST['newaddr'],
            'District' => $_POST['newdis'],
            'Region' => $_POST['newreg'],
            'City' => $_POST['newcity'],
            'Province' => $_POST['newprov'],
            'Country' => $_POST['newnat'],
        ];

        $table2 = [
            'Occupation' => $_POST['status'],
            'Honorer' => $_POST['honorer'],
            'Emp_Type' => $_POST['emp'],
            'Homeroom' => $_POST['homeroom'],
            'JobDesc' => $_POST['jobdesc'],
            'SubjectTeach' => $_POST['subjteach'],
            'LastEducation' => $_POST['education'],
            'StudyFocus' => $_POST['diploma'],
            'Govt_Cert' => $_POST['govt'],
            'Institute_Cert' => $institute,
            'YearStarts' => $_POST['starts'],
            'MaritalStatus' => $_POST['marital'],
            'Email' => $_POST['newmail'],
            'Phone' => $_POST['newtelp']
        ];

        $update = $this->Mdl_profile->model_update_tch($selected_id, $table1, $table2);

        if ($update == TRUE) {
            $this->session->set_flashdata('updmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> Profile Updated </div>');
            redirect('Admin/load_prof_tch_edit');
        } else {
            $this->session->set_flashdata('updmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> No data updated! </div>');
            redirect('Admin/load_prof_tch_edit');
        }
    }

    public function update_img_tch()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-nonstd.jpg';

        $config = [
            'upload_path' => './assets/photos/teachers/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/teachers/' . $img_name)) {
            unlink('./assets/photos/teachers/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/teachers/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/teachers/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_tch_update/' . $id . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                     PROFILE STUDENT CONTROLLER         ============================== \\
    // ==================================================================================================================== \\
    public function load_prof_std_edit()
    {
        $std = 'student';

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'std_t' => $this->Mdl_profile->get_student($std),
            'active_room' => $this->Mdl_profile->model_get_dropdown_active_rooms(),
        ];

        $this->load->view('admin/adm_prof_std_edit', $data);
    }

    public function load_prof_std()
    {
        $id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
            'std_t' => $this->Mdl_profile->get_full_info_std($id)

        ];

        $this->load->view('admin/adm_prof_std', $data);
    }

    //Page loads only when accessed through Edit Page
    //No Direct access from NAVBAR
    public function load_prof_std_add()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown
            'class' => $this->Mdl_profile->get_dropdown_class(),
            //'room' => $this->Mdl_profile->get_dropdown_room()
        ];

        $this->load->view('admin/adm_prof_std_add', $data);
    }

    public function get_room_from_selected_class()
    {
        $cls = $_POST['cls'];

        $query = $this->Mdl_profile->model_get_room_from_selected_class($cls);

        $value = '';
        foreach ($query as $row) {
            $value .= '<option value="' . $row->RoomDesc . '">' . $row->RoomDesc . '</option>';
        }

        echo $value;
    }

    public function load_prof_std_update()
    {
        $selected_id = $this->uri->segment(3);

        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            //Dropdown for Subject
            'class' => $this->Mdl_profile->get_dropdown_class(),

            //Get data from ID that will be editted
            'datatoedit' => $this->Mdl_profile->get_full_info_std($selected_id)
        ];

        $this->load->view('admin/adm_prof_std_update', $data);

        return $selected_id;
    }

    //Called upon when load_prof_std_add pressed the button Save
    public function add_std()
    {
        $id = $_POST['nis'];
        $img = $_FILES['image']['name'];
        $img_name = 'img-' . $id . '-std.jpg';

        $config = [
            'upload_path' => './assets/photos/student/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if ($img == '') {
            $img_name = 'default.png';
        }

        $Birth =  date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '-', '/')));
        $keepkip = $_POST['keepkip'];
        $ach = $_POST['achievement'];
        $achlvl = $_POST['achievementlevel'];
        $scholar = $_POST['scholarship'];

        if (!isset($keepkip)) {
            $keepkip = '-';
        }

        if (!isset($ach)) {
            $ach = '-';
        }

        if (!isset($achlvl)) {
            $achlvl = '-';
        }

        if (!isset($scholar)) {
            $scholar = '-';
        }

        $table1 = [
            //TAB 1
            'IDNumber' => $id,
            'FirstName' => ucfirst(strtolower($_POST['fname'])),
            'MiddleName' => ucfirst(strtolower($_POST['mname'])),
            'LastName' => ucfirst(strtolower($_POST['lname'])),
            'NickName' => ucfirst(strtolower($_POST['nname'])),
            'status' => 'student',
            'Gender' => $_POST['gender'],
            'PersonalID' => $_POST['nik'],
            'KK' => $_POST['kk'],
            'DateofBirth' => $Birth,
            'PointofBirth' => $_POST['tmplhr'],
            'BirthCertificate' => $_POST['akta'],
            'Religion' => $_POST['religion'],
            'Country' => $_POST['country'],
            'Disability' => $_POST['disabled'],
            'Address' => $_POST['address'],
            'RT' => $_POST['rt'],
            'RW' => $_POST['rw'],
            'Dusun' => $_POST['dusun'],
            'Village' => $_POST['village'],
            'District' => $_POST['district'],
            'Region' => $_POST['region'],
            'Postal' => $_POST['postal'],
            'Height' => $_POST['height'],
            'Weight' => $_POST['weight'],
            'HeadDiameter' => $_POST['headdiameter'],
            'Photo' => $img_name,
            'RegDate' => date('Y-m-d')
        ];

        $table2 = [
            'NIS' => $id,
            'NISN' => $_POST['nisn'],
            'Kelas' => $_POST['classes'],
            'Ruangan' => $_POST['room'],
            'Position' => '-',
            'Email' => $_POST['email'],
            'Phone' => $_POST['handheldnumber'],
            'HousePhone' => $_POST['housephone'],
            'LiveWith' => $_POST['livewith'],
            'AnakKe' => $_POST['child'],
            'Saudara' => $_POST['siblings'],
            'Father' => $_POST['father'],
            'FatherNIK' => $_POST['fathernik'],
            'FatherBorn' => $_POST['fatheryear'],
            'FatherDegree' => $_POST['fatherdegree'],
            'FatherJob' => $_POST['fatherjob'],
            'FatherIncome' => $_POST['fatherincome'],
            'FatherDisability' => $_POST['fatherdisabled'],
            'Mother' => $_POST['mother'],
            'MotherNIK' => $_POST['mothernik'],
            'MotherBorn' => $_POST['motheryear'],
            'MotherDegree' => $_POST['motherdegree'],
            'MotherJob' => $_POST['motherjob'],
            'MotherIncome' => $_POST['motherincome'],
            'MotherDisability' => $_POST['motherdisabled'],
            'Guardian' => $_POST['guardian'],
            'GuardianNIK' => $_POST['guardiannik'],
            'GuardianBorn' => $_POST['guardianyear'],
            'GuardianDegree' => $_POST['guardiandegree'],
            'GuardianJob' => $_POST['guardianjob'],
            'GuardianIncome' => $_POST['guardianincome'],
            'GuardianDisability' => $_POST['guardiandisabled'],
            'Transportation' => $_POST['transport'],
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => $_POST['kip'],
            'Stayed_KIP' => $keepkip,
            'Refuse_PIP' => $_POST['refusepip'],
            'Achievement' => $ach,
            'AchievementLVL' => $achlvl,
            'AchievementYear' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => $scholar,
            'ScholarDesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'Competition' => $_POST['competition'],
            'Registration' => $_POST['registration'],
            'PreviousSchool' => $_POST['previousschool'],
            'UNNumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun']
        ];

        //Check if new ID already existed, to prevent collision
        $result = $this->db->query("SELECT IDNUmber FROM tbl_07_personal_bio WHERE IDNumber = '$id'")->row();

        if (empty($result)) {
            $result = $this->Mdl_profile->new_std($table1, $table2);

            if ($result == 'success') {
                // $this->upload->data(); //Upload data to upload_path
                if (!$this->upload->do_upload('image')) {
                    $error_msg = $this->upload->display_errors();

                    $this->session->set_flashdata('disp_err', "<div class=\"alert alert-success text-center text-uppercase\" role=\"alert\"> $errormsg </div>");
                } else {
                    $this->session->set_flashdata('addmsg', '<div class="alert alert-success text-center text-uppercase" role="alert"> New Teacher Added!!! </div>');
                }

                $this->session->set_flashdata('addmsg', '<div class="saved-success" data-id="' . $id . '"></div>');
                redirect('Admin/load_prof_std_edit');
            } else {
                $this->session->set_flashdata('errormsg', '<div class="error-alert"></div>');
                redirect('Admin/load_prof_std_edit');
            }
        } else {

            $this->session->set_flashdata('regismsg', '<div class="regis-alert" data-id="' . $id . '"></div>');
            redirect('Admin/load_prof_std_edit');
        }
    }

    public function update_std()
    {
        $selected_id = $this->uri->segment(3);

        //Get Date for DB Formatting
        $room = $_POST['room'];
        $Birth =  date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '-', '/')));

        $keepkip = $_POST['keepkip'];
        $ach = $_POST['achievement'];
        $achlvl = $_POST['achievementlevel'];
        $scholar = $_POST['scholarship'];

        if (!isset($keepkip)) {
            $keepkip = '-';
        }

        if (!isset($ach)) {
            $ach = '-';
        }

        if (!isset($achlvl)) {
            $achlvl = '-';
        }

        if (!isset($scholar)) {
            $scholar = '-';
        }

        $table1 = [
            //TAB 1
            'IDNumber' => $selected_id,
            'FirstName' => ucfirst(strtolower($_POST['fname'])),
            'MiddleName' => ucfirst(strtolower($_POST['mname'])),
            'LastName' => ucfirst(strtolower($_POST['lname'])),
            'NickName' => ucfirst(strtolower($_POST['nname'])),
            'status' => 'student',
            'Gender' => $_POST['gender'],
            'PersonalID' => $_POST['nik'],
            'KK' => $_POST['kk'],
            'DateofBirth' => $Birth,
            'PointofBirth' => $_POST['tmplhr'],
            'BirthCertificate' => $_POST['akta'],
            'Religion' => $_POST['religion'],
            'Country' => $_POST['country'],
            'Disability' => $_POST['disabled'],
            'Address' => $_POST['address'],
            'RT' => $_POST['rt'],
            'RW' => $_POST['rw'],
            'Dusun' => $_POST['dusun'],
            'Village' => $_POST['village'],
            'District' => $_POST['district'],
            'Region' => $_POST['region'],
            'Postal' => $_POST['postal'],
            'Height' => $_POST['height'],
            'Weight' => $_POST['weight'],
            'HeadDiameter' => $_POST['headdiameter'],
        ];

        $table2 = [
            'NIS' => $selected_id,
            'NISN' => $_POST['nisn'],
            'Kelas' => $_POST['classes'],
            'Ruangan' => $_POST['room'],
            'Position' => '-',
            'Email' => $_POST['email'],
            'Phone' => $_POST['handheldnumber'],
            'HousePhone' => $_POST['housephone'],
            'LiveWith' => $_POST['livewith'],
            'AnakKe' => $_POST['child'],
            'Saudara' => $_POST['siblings'],
            'Father' => $_POST['father'],
            'FatherNIK' => $_POST['fathernik'],
            'FatherBorn' => $_POST['fatheryear'],
            'FatherDegree' => $_POST['fatherdegree'],
            'FatherJob' => $_POST['fatherjob'],
            'FatherIncome' => $_POST['fatherincome'],
            'FatherDisability' => $_POST['fatherdisabled'],
            'Mother' => $_POST['mother'],
            'MotherNIK' => $_POST['mothernik'],
            'MotherBorn' => $_POST['motheryear'],
            'MotherDegree' => $_POST['motherdegree'],
            'MotherJob' => $_POST['motherjob'],
            'MotherIncome' => $_POST['motherincome'],
            'MotherDisability' => $_POST['motherdisabled'],
            'Guardian' => $_POST['guardian'],
            'GuardianNIK' => $_POST['guardiannik'],
            'GuardianBorn' => $_POST['guardianyear'],
            'GuardianDegree' => $_POST['guardiandegree'],
            'GuardianJob' => $_POST['guardianjob'],
            'GuardianIncome' => $_POST['guardianincome'],
            'GuardianDisability' => $_POST['guardiandisabled'],
            'Transportation' => $_POST['transport'],
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => $_POST['kip'],
            'Stayed_KIP' => $keepkip,
            'Refuse_PIP' => $_POST['refusepip'],
            'Achievement' => $ach,
            'AchievementLVL' => $achlvl,
            'AchievementYear' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => $scholar,
            'ScholarDesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'PreviousSchool' => $_POST['previousschool'],
            'UNNumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun']
        ];

        $update = $this->Mdl_profile->model_update_std($selected_id, $table1, $table2, $room);

        if ($update == 'success') {
            $this->session->set_flashdata('updmsg', '<div class="upd-success" data-id="' . $selected_id . '"> </div>');
            redirect('Admin/load_prof_std_update/' . $selected_id);
        } else {
            $this->session->set_flashdata('updmsg', '<div class="alert-upd" data-id="' . $selected_id . '"> </div>');
            redirect('Admin/load_prof_std_update/' . $selected_id);
        }
    }

    public function update_img_std()
    {
        $id = $this->uri->segment(3);

        $img_def = 'default.png';
        $img_name = 'img-' . $id . '-std.jpg';

        $config = [
            'upload_path' => './assets/photos/student/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'file_name' => $img_name
        ];

        $this->load->library('upload', $config);

        //If there's image for ID already, delete the old one
        if (is_file('./assets/photos/student/' . $img_name)) {
            unlink('./assets/photos/student/' . $img_name);
        }

        //If Image has different extension, or no pic uploaded, set to default picture
        //If exist, upload the new picture to the destination
        if (!$this->upload->do_upload('image')) {
            $error_msg = $this->upload->display_errors();

            $this->Mdl_profile->model_upload_img_std($id, $img_def);

            $this->session->set_flashdata('disp_err', $error_msg);

            redirect('Admin/load_prof_std_update/' . $id . '#tab_1_2', 'refresh');
        } else {
            // $this->upload->data(); //Upload data to upload_path

            //Compress uploaded image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/photos/student/' . $img_name;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/photos/student/' . $img_name;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $this->Mdl_profile->model_upload_img_std($id, $img_name);

            redirect('Admin/load_prof_std_update/' . $id . '#tab_1_2', 'refresh');
        }
    }

    // ==================================================================================================================== \\
    // ==============================                    ENROLLMENT CONTROLLER               ============================== \\
    // ==================================================================================================================== \\
    public function load_enroll()
    {
        $data = [
            'title' => 'Admin Control Panel',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            'total' => $this->Mdl_enroll->count_total(),
            'page' => $this->pagination->create_links()
        ];

        $this->load->view('admin/adm_enroll', $data);
    }

    //POST FROM ENROLLMENT FORM PAGE
    public function enroll_proceed()
    {
        $idrand = $this->input->post('fname') . date('h:m:s');

        $data = [
            'ListID' => md5($idrand),
            'FirstName' => $this->input->post('fname'),
            'MiddleName' => $this->input->post('mname'),
            'LastName' => $this->input->post('lname'),
            'NickName' => $this->input->post('nname'),
            'Gender' => $this->input->post('gender'),
            'DateofBirth' => $this->input->post('tgllhr'),
            'PointofBirth' => $this->input->post('tmplhr'),
            'Race' => $this->input->post('race'),
            'Religion' => $this->input->post('religion'),
            'Bloodtype' => $this->input->post('blood'),
            'Height' => $this->input->post('height'),
            'Weight' => $this->input->post('weight'),
            'Apply' => $this->input->post('level'),
            'PreviousSchool' => $this->input->post('prevsch'),
            'Address' => $this->input->post('address'),
            'District' => $this->input->post('district'),
            'Region' => $this->input->post('region'),
            'City' => $this->input->post('city'),
            'Province' => $this->input->post('prov'),
            'Country' => $this->input->post('country'),
            'Email' => $this->input->post('mail'),
            'Phone' => $this->input->post('phone'),
            'Parental' => $this->input->post('parental'),
            'Father' => $this->input->post('father'),
            'Mother' => $this->input->post('mother'),
            'FatherAddr' => $this->input->post('fatheraddr'),
            'MotherAddr' => $this->input->post('motheraddr'),
            'FatherJob' => $this->input->post('fatherjob'),
            'MotherJob' => $this->input->post('motherjob'),
            'FatherAge' => $this->input->post('fatherage'),
            'MotherAge' => $this->input->post('motherage'),
            'FatherEmail' => $this->input->post('fathermail'),
            'MotherEmail' => $this->input->post('mothermail'),
            'FatherPhone' => $this->input->post('fatherphone'),
            'MotherPhone' => $this->input->post('motherphone'),
            'Child' => $this->input->post('child'),
            'Sibling' => $this->input->post('sibling'),
            'Step' => $this->input->post('step'),
            'Foster' => $this->input->post('foster'),
            'RegDate' => date('Y-m-d')
        ];

        $this->Mdl_enroll->model_insert_enrolled($data);

        redirect('auth/enroll');
    }

    public function new_student_details()
    {
        $ctrlno = $_POST['ctrlno'];

        $result = $this->Mdl_enroll->model_student_details($ctrlno);

        echo json_encode($result);
    }

    public function get_list_enroll()
    {
        $rows = 30;

        $config = [
            'base_url' => base_url('admin/load_enroll'),
            'use_page_numbers' => TRUE,
            'total_rows' => $this->Mdl_enroll->count_total(),
            'per_page' => $rows,
            'uri_segment' => 3,
            'num_links' => 5,
            'attributes' => [
                'class' => 'pagin',
            ],

            'full_tag_open' => '<div class="pagging"><nav><ul class="pagination pagination-lg">',
            'full_tag_close' => '</ul></nav></div>',

            'num_tag_open' => '<li class="page-item"><span class="page-link">',
            'num_tag_close' => '</span></li>',

            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',

            'next_tag_open' => '<li class="page-item"><span class="page-link">',
            'next_tag_close' => '<span aria-hidden="true"></span></span></li>',

            'prev_tag_open' => '<li class="page-item"><span class="page-link">',
            'prev_tag_close' => '</span></li>',

            'first_tag_open' => '<li class="page-item"><span class="page-link">',
            'first_tag_close' => '</span></li>',

            'last_tag_open' => '<li class="page-item"><span class="page-link">',
            'last_tag_close' => '</span></li>'
        ];

        $this->pagination->initialize($config);

        $index = $this->uri->segment(3);
        $start = ($index - 1) * $rows;

        $page = $this->pagination->create_links();

        $record = $this->Mdl_enroll->get_enrollment($start, $rows)->result();

        $today = date('Y-m-d');

        $index = 1;
        $value = '';
        foreach ($record as $row) {
            if ($row->Gender == 'Laki-Laki') {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }

            $agecount = date_diff(date_create($row->DateofBirth), date_create($today));
            $value .= ' <tr data-list="' . $row->CtrlNo . '">
                            <td> ' . $index . ' </td>
                            <td> <a href="#" data-id="' . $row->CtrlNo . '"> ' . $row->FirstName . ' ' . $row->LastName . ' </a> </td>
                            <td> ' . $row->DateofBirth . ' </td>
                            <td> ' . $agecount->format('%y') . ' </td>
                            <td> ' . $gender . ' </td>
                            <td> ' . $row->PreviousSchool . ' </td>
                            <td> ' . $row->Address . ' </td>
                            <td> ' . date('d-m-Y', strtotime($row->RegDate)) . ' </td>
                            <td>
                                <div class="btn-group btn-group-solid">
                                    <button type="button" class="btn green detail" data-id="' . $row->CtrlNo . '" data-apply="SMA" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Details</button>
                                    <button type="button" class="btn blue approve" data-apply="SMA" style="min-width: 80px; margin-right: 6px; margin-bottom: 5px">Approve</button>
                                    <button type="button" class="btn red cancel" style="min-width: 80px;"> Delete </button>
                                </div>
                            </td>
                        </tr>';
            $index++;
        }

        $data = array(
            'page' => $page,
            'value' => $value
        );

        $JSON = json_encode($data);

        echo $JSON;
    }

    public function get_dropdown_apply()
    {
        $apply = $this->input->post('apply');

        $query = $this->Mdl_enroll->model_get_dropdown_apply($apply);

        $value = '';
        $value .= '<div class="form-group form-md-line-input form-md-floating-label has-info" style="width: 60%;">
                        <select class="form-control" name="room" id="form_control_1">';
        foreach ($query as $row) {
            $value .= '         <option value="' . $row->RoomDesc . '">' . $row->RoomDesc . '</option>';
        }
        $value .= '      </select>
                    </div>';

        echo $value;
    }

    public function approve_list()
    {
        $data = [
            'uniq' => $_POST['uniq'],
            'room' => $_POST['room']
        ];

        $this->Mdl_enroll->set_approve($data);

        $total = $this->Mdl_enroll->count_total();

        echo $total;
    }

    public function cancel_list()
    {
        $uniq = $_POST['uniq'];

        $this->db->delete('tbl_11_enrollment', "CtrlNo = '$uniq'");

        $total = $this->Mdl_enroll->count_total();

        echo $total;
    }

    // =============================================================================================================================== \\
    // ==============================                     FINANCE TEACHER / STAFF CONTROLLER            ============================== \\
    // =============================================================================================================================== \\

    public function load_fnc_tch()
    {
        $data = [
            'title' => 'Finance Student',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),
        ];

        $this->load->view('admin/adm_fnc_tch', $data);
    }

    // ==================================================================================================================== \\
    // ==============================                     FINANCE STUDENT CONTROLLER         ============================== \\
    // ==================================================================================================================== \\

    public function load_fnc_std()
    {
        $data = [
            'title' => 'Finance Student',
            'fname' => $this->session->userdata('fname'),
            'lname' => $this->session->userdata('lname'),
            'status' => $this->session->userdata('status'),
            'photo' => $this->session->userdata('photo'),

            'tuition_a' => $this->Mdl_finance->get_all_tuition('A'),
            'tuition_b' => $this->Mdl_finance->get_all_tuition('B'),
            'tuition_c' => $this->Mdl_finance->get_all_tuition('C'),
            'tuition_d' => $this->Mdl_finance->get_all_tuition('D'),
            'tuition_e' => $this->Mdl_finance->get_all_tuition('E'),

            'degrees' => $this->Mdl_finance->get_all_degrees(),
        ];

        $this->load->view('admin/adm_fnc_std', $data);
    }

    public function get_cat_tuition()
    {
        $degree = $_POST['degree'];
        $cat = $_POST['cat'];

        $result = $this->Mdl_finance->get_cat_tuition($degree, $cat);

        $tuition = number_format($result['Tuition'], 2, ",", ".");

        echo $tuition;
    }

    public function save_cat_tuition()
    {
        $degree = $_POST['degree'];
        $cat = $_POST['cat'];
        $newinput = $_POST['newinput'];

        $result = $this->Mdl_finance->model_save_cat_tuition($degree, $cat, $newinput);

        echo $result;
    }

    public function get_fnc_by_id()
    {
        $selected = $_POST['id'];

        $degrees = $this->Mdl_finance->model_get_fnc_data_by_id($selected);

        $value = '';
        if (!empty($degrees->result())) {
            foreach ($degrees->result() as $row) {
                $value .= ' <tr role="row" class="odd">';
                //$value .= '     <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>';
                $value .= '     <td> ' . $row->NIS . ' </td>';
                $value .= '     <td><a href=""> ' . $row->FullName . ' </a></td>';
                if ($row->Degree == 'SD') {
                    $value .= '     <td><span class="label label-sm label-danger"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMP') {
                    $value .= '     <td><span class="label label-sm label-info"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMA') {
                    $value .= '     <td><span class="label label-sm label-secondary" style="background-color: #ACB5C3"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                }
                $value .= '     <td> ' . $row->Kelas . ' </td>';
                $value .= '     <td> ' . $row->Ruangan . ' </td>';
                $value .= ' </tr>';
            }
        } else {
            $value .= ' <tr role="row" class="odd">';
            $value .= '     <td colspan="5"> NO STUDENTS LISTED IN THIS CLASS </td>';
            $value .= '</tr>';
        }

        echo $value;
    }

    public function get_fnc_by_name()
    {
        $selected = $_POST['name'];

        $degrees = $this->Mdl_finance->model_get_fnc_data_by_name($selected);

        $value = '';
        if (!empty($degrees->result())) {
            foreach ($degrees->result() as $row) {
                $value .= ' <tr role="row" class="odd">';
                //$value .= '     <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>';
                $value .= '     <td> ' . $row->NIS . ' </td>';
                $value .= '     <td><a href=""> ' . $row->FullName . ' </a></td>';
                if ($row->Degree == 'SD') {
                    $value .= '     <td><span class="label label-sm label-danger"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMP') {
                    $value .= '     <td><span class="label label-sm label-info"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMA') {
                    $value .= '     <td><span class="label label-sm label-secondary" style="background-color: #ACB5C3"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                }
                $value .= '     <td> ' . $row->Kelas . ' </td>';
                $value .= '     <td> ' . $row->Ruangan . ' </td>';
                $value .= ' </tr>';
            }
        } else {
            $value .= ' <tr role="row" class="odd">';
            $value .= '     <td colspan="5"> NO STUDENTS LISTED IN THIS CLASS </td>';
            $value .= '</tr>';
        }

        echo $value;
    }

    public function get_fnc_degrees()
    {
        $selected = $_POST['selected'];

        $degrees = $this->Mdl_finance->model_get_fnc_data_by_degree($selected);
        $class = $this->Mdl_finance->model_get_fnc_classes($selected);

        $classes = '';
        $classes .= '<option value="-"> Classes </option>';
        foreach ($class->result() as $row) {
            $classes .= '<option value="' . $row->ClassDesc . '"> ' . $row->ClassDesc . ' </option>';
        }

        $value = '';
        if (!empty($degrees->result())) {
            foreach ($degrees->result() as $row) {
                $value .= ' <tr role="row" class="odd">';
                //$value .= '     <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>';
                $value .= '     <td> ' . $row->NIS . ' </td>';
                $value .= '     <td><a href=""> ' . $row->FullName . ' </a></td>';
                if ($row->Degree == 'SD') {
                    $value .= '     <td><span class="label label-sm label-danger"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMP') {
                    $value .= '     <td><span class="label label-sm label-info"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMA') {
                    $value .= '     <td><span class="label label-sm label-secondary" style="background-color: #ACB5C3"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                }
                $value .= '     <td> ' . $row->Kelas . ' </td>';
                $value .= '     <td> ' . $row->Ruangan . ' </td>';
                $value .= ' </tr>';
            }
        } else {
            $value .= ' <tr role="row" class="odd">';
            $value .= '     <td colspan="5"> NO STUDENTS LISTED IN THIS CLASS </td>';
            $value .= '</tr>';
        }

        $data = [
            'classes' => $classes,
            'row' => $value
        ];

        echo json_encode($data);
    }

    public function get_fnc_classes()
    {
        $selected = $_POST['cls'];

        $degrees = $this->Mdl_finance->model_get_fnc_data_by_class($selected);
        $rooms = $this->Mdl_finance->model_get_fnc_rooms($selected);

        $room = '';
        $room .= '<option value="-"> Rooms </option>';
        foreach ($rooms->result() as $row) {
            $room .= '<option value="' . $row->RoomDesc . '"> ' . $row->RoomDesc . ' </option>';
        }

        $value = '';
        if (!empty($degrees->result())) {
            foreach ($degrees->result() as $row) {
                $value .= ' <tr role="row" class="odd">';
                //$value .= '     <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>';
                $value .= '     <td> ' . $row->NIS . ' </td>';
                $value .= '     <td><a href=""> ' . $row->FullName . ' </a></td>';
                if ($row->Degree == 'SD') {
                    $value .= '     <td><span class="label label-sm label-danger"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMP') {
                    $value .= '     <td><span class="label label-sm label-info"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMA') {
                    $value .= '     <td><span class="label label-sm label-secondary" style="background-color: #ACB5C3"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                }
                $value .= '     <td> ' . $row->Kelas . ' </td>';
                $value .= '     <td> ' . $row->Ruangan . ' </td>';
                $value .= ' </tr>';
            }
        } else {
            $value .= ' <tr role="row" class="odd">';
            $value .= '     <td colspan="5"> NO STUDENTS LISTED IN THIS CLASS </td>';
            $value .= '</tr>';
        }

        $data = [
            'classes' => $room,
            'row' => $value
        ];

        echo json_encode($data);
    }

    public function get_fnc_rooms()
    {
        $selected = $_POST['room'];

        $degrees = $this->Mdl_finance->model_get_fnc_data_by_rooms($selected);

        $value = '';
        if (!empty($degrees->result())) {
            foreach ($degrees->result() as $row) {
                $value .= ' <tr role="row" class="odd">';
                //$value .= '     <td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="1"><span></span></label></td>';
                $value .= '     <td> ' . $row->NIS . ' </td>';
                $value .= '     <td><a href=""> ' . $row->FullName . ' </a></td>';
                if ($row->Degree == 'SD') {
                    $value .= '     <td><span class="label label-sm label-danger"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMP') {
                    $value .= '     <td><span class="label label-sm label-info"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                } elseif ($row->Degree == 'SMA') {
                    $value .= '     <td><span class="label label-sm label-secondary" style="background-color: #ACB5C3"> &nbsp;&nbsp; ' . $row->Degree . ' &nbsp;&nbsp; </span></td>';
                }
                $value .= '     <td> ' . $row->Kelas . ' </td>';
                $value .= '     <td> ' . $row->Ruangan . ' </td>';
                $value .= ' </tr>';
            }
        } else {
            $value .= ' <tr role="row" class="odd">';
            $value .= '     <td colspan="5"> NO STUDENTS LISTED IN THIS CLASS </td>';
            $value .= '</tr>';
        }

        echo $value;
    }
}
