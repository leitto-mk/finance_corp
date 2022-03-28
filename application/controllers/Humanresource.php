<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
    
class Humanresource extends CI_Controller {
    public function __construct() {   
        parent::__construct();
        $this->load->model('humanresource/M_humanresource');
        $this->load->library('pagination');
        $this->load->library('session');
        // if ($this->session->userdata('log_ses') != 'login') {
        //     $this->session->set_flashdata('notif', '<div class="alert alert-danger"><center><font color="red"><b>Login First</b></font></center></div>');
        //     redirect('Login');
        // }
    }


    //Upload File Function
    function upload_image($filename){
        $config['upload_path'] = './upload/recruit_file/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|xlsx|docx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($filename)){
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./upload/recruit_file/'.$gbr['file_name'];
            $config['file_name']= round(microtime(true));
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 600;
            $config['height']= 400;
            $config['new_image']= './upload/recruit_file/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar=$gbr['file_name'];
            return $gambar;
        }
    }

    function upload_image_reg($filename){
        $config['upload_path'] = './upload/profile/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf|xlsx|docx'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($filename)){
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./upload/profile/'.$gbr['file_name'];
            $config['file_name']= round(microtime(true));
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 600;
            $config['height']= 400;
            $config['new_image']= './upload/profile/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar=$gbr['file_name'];
            return $gambar;
        }
    }

    public function ddoo_upload($filename){
        $config = array(
            'upload_path' => './upload/recruit_file/',
            'allowed_types' => 'gif|jpg|png|jpeg|bmp|pdf|xlsx|docx',
            'max_size' => '8000',
            'max_width' => '4272',
            'max_height' => '4272'
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($filename)){
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $data = array('upload_data' => $this->upload->data('file_name'));
            return true;
        }
    }

    //Dashboard
    function view_home() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Dashboard';
        // $query['sumgender'] = $this->M_humanresource->get_data_sum_employee_by_gender($branch);
        $query['sumemptype'] = $this->M_humanresource->get_data_sum_employee_by_employeetype($branch);
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append_abc($branch);
        // $query['level'] = $this->M_humanresource->get_level();
        // $query['report_level'] = $this->M_humanresource->get_data_report_by_dept_level();
        // $query['function'] = $this->M_humanresource->get_function();
        // $query['report_function'] = $this->M_humanresource->get_data_report_by_dept_function();

        $query['emptype'] = $this->M_humanresource->get_employeetype_abc($branch);
        $query['report_emptype'] = $this->M_humanresource->get_data_report_by_dept_employeetype_abc($branch);
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals_abc($branch);

        // $query['employmenttype'] = $this->M_humanresource->get_employmenttype();
        // $query['report_employmenttype'] = $this->M_humanresource->get_data_report_by_dept_employmenttype();
        // $query['grandtotalemploymenttype'] = $this->M_humanresource->get_report_emp_employmenttype_gtotals();

        //Chart
        // $query['tahun'] = $this->M_datachart->getYear();
        // $year1 = '2019';
        // $year2 = '2020';
        // $earning1 = $this->M_datachart->getEarning($year1);
        // $earning2 = $this->M_datachart->getEarning($year2);

        // $total1 = array();
        // $total2 = array();

        // foreach ($earning1 as $tot) {
        //     $total1[] = $tot->total;
        // }

        // foreach ($earning2 as $tot) {
        //     $total2[] = $tot->total;
        // }

        // $bulan = $this->M_datachart->getMonth();
        // $label = array();
        // foreach ($bulan as $m) {
        //     $label[] = $m->month;
        // }
        
        // $query['label'] = json_encode($label); //json_encode($label);
        // $query['tahun'] = $this->M_datachart->getYear();
        // $query['result1'] = json_encode($total1);
        // $query['result2'] = json_encode($total2);
        // $query['one'] = $year1;
        // $query['two'] = $year2;
        // $this->load->view('humanresource/v_home', $query);
        $this->load->view('humanresource/v_home_n', $query);
    }

    // public function getChart()
    // {
    //     [$pie, $bar] = $this->M_humanresource->model_get_chart();

    //     $data = [
    //         'pie' => $pie,
    //         'bar' => $bar
    //     ];

    //     echo json_encode($data);
    // }

    public function getChart()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        [$pie, $bar] = $this->M_humanresource->model_get_chart($branch);

        $data = [
            'pie' => $pie,
            'bar' => $bar
        ];

        echo json_encode($data);
    }

    //Manpower Plan
    function view_man_power_plan() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $query['manplanno'] = $this->M_humanresource->get_data_manplanno();
        $query['year'] = $this->M_humanresource->get_data_year();
        $query['depart'] = $this->M_humanresource->get_data_department();
        $query['list_plan'] = $this->M_humanresource->get_data_plan();
        $this->load->view('humanresource/manpowerplan/v_man_power_plan', $query);
    }

    function view_list_mp_posting() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $query['jobslist'] = $this->M_humanresource->get_post_list();
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countoutstandingdata'] = $this->M_humanresource->get_count_outstanding_data($currentdate);
        $this->load->view('humanresource/manpowerplan/v_man_power_plan_posting', $query);
    }

    function view_list_mp_posting_internalexp() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpireinternaldata'] = $this->M_humanresource->get_count_expire_internal_data($currentdate);
        $this->load->view('humanresource/manpowerplan/v_man_power_plan_posting_expire_internal', $query);
    }

    function view_list_mp_posting_externalexp() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpireexternaldata'] = $this->M_humanresource->get_count_expire_external_data($currentdate);
        $this->load->view('humanresource/manpowerplan/v_man_power_plan_posting_expire_external', $query);
    }

    function view_list_mp_posting_expire() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpiredata'] = $this->M_humanresource->get_count_expire_data($currentdate);
        $this->load->view('humanresource/manpowerplan/v_man_power_plan_posting_expire', $query);
    }

    function view_list_mp_posting_oustanding() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Man Power Plan';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countoutstandingdata'] = $this->M_humanresource->get_count_outstanding_data($currentdate);
        $this->load->view('humanresource/manpowerplan/v_man_power_plan_posting_outstanding', $query);
    }

    function view_new_manpower() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'New Manpower Plan';
        $query['headertitle'] = 'Create New Man Power';
        $query['getauto'] = $this->M_humanresource->getmanplannoauto();
        if ($query['getauto'] == '') {
          $increment = 0;
        }else{
        $increment=$query['getauto'][0]->ManPlanNo;
        }
        $query['autoidnum'] = $increment + 1;
        $query['currentyear'] = date('Y');
        $query['empl'] = $this->M_humanresource->get_empl();
        $query['company'] = $this->M_humanresource->get_company();
        $query['branch'] = $this->M_humanresource->get_branch();
        $query['department'] = $this->M_humanresource->get_department();
        $query['costcenter'] = $this->M_humanresource->get_costcenter();
        $this->load->view('humanresource/manpowerplan/v_new_manpower', $query);
    }

    function transfer_manpower(){
        if ($this->input->post('submit')) {
            //Master Manpower
            $query['Mmanplanno'] = $manplanno_ = $this->input->post('manplanno');
            $query['Mplanyear'] = $planyear_ = $this->input->post('planyear');
            $query['Mplannoempl'] = $plannoempl_ = $this->input->post('plannoempl');
            $query['Mcompany_data'] = $company_data_ = $this->input->post('company_data');
            $query['Mi_company_des'] = $i_company_des_ = $this->input->post('i_company_des');
            $query['Mdepartment_data'] = $department_data_ = $this->input->post('department_data');
            $query['Mi_department_des'] = $i_department_des_ = $this->input->post('i_department_des');
            $query['Mbranch_data'] = $branch_data_ = $this->input->post('branch_data');
            $query['Mi_branch_des'] = $i_branch_des_ = $this->input->post('i_branch_des');
            $query['Mcostcenter_data'] = $costcenter_data_ = $this->input->post('costcenter_data');
            $query['Mi_costcenter_des'] = $i_costcenter_des_ = $this->input->post('i_costcenter_des');
            $query['Mremarks_plan'] = $remarks_plan_ = $this->input->post('remarks_plan');
            if(isset($_FILES['docscan']) && $_FILES['docscan']['name'] != ''){
            // $this->ddoo_upload('docscan');
            // $docscan = $_FILES['docscan']['name'];
            $docscan = $this->upload_image('docscan');
            }else{
                $docscan = "";
            }
            if(isset($_FILES['docscanapp_']) && $_FILES['docscanapp_']['name'] != ''){
                // $this->ddoo_upload('docscanapp_');
                // $docscanapp_ = $_FILES['docscanapp_']['name'];
                $docscanapp_ = $this->upload_image('docscanapp_');
            }else{
                $docscanapp_ = "";
            }            
            //Array Detail
            $query['Mjobtitle'] = $jobtitle_ = $this->input->post('jobtitle_');
            $query['Mpositionlevel'] = $positionlevel_ = $this->input->post('positionlevel_');
            $query['Memployeetype'] = $employeetype_ = $this->input->post('employeetype_');
            $query['Mcompanytype'] = $companytype_ = $this->input->post('companytype_');
            $query['Mreportto'] = $reportto_ = $this->input->post('reportto_');
            $query['Mreason_justification'] = $reason_justification_ = $this->input->post('reason_justification_');
            $datas['cek'] = $this->M_humanresource->cek_manplanno($manplanno_);
            if ($datas['cek'] != true) {
                $dataMasterManPow=array(
                    'ManPlanNo' =>$manplanno_,
                    'PlanYear' => $planyear_,
                    'PlanNoEmpl' =>$plannoempl_,
                    'Company' =>$company_data_,
                    'CompanyDes' =>$i_company_des_,
                    'DepartCode' =>$department_data_,
                    'DeptDes' =>$i_department_des_,
                    'BranchSite' =>$branch_data_,
                    'BranchSiteDes' =>$i_branch_des_,
                    'CostCenter' =>$costcenter_data_,
                    'CostCenterDes' =>$i_costcenter_des_,
                    'Remarks' =>$remarks_plan_,
                    'DocScan' =>$docscan,
                    'ScanDocApproval' =>$docscanapp_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                    );
                $ret1 = $this->M_humanresource->insert('tbl_emp_plan', $dataMasterManPow);
                $planno = $this->M_humanresource->get_last_manplanno();
                if ($ret1 != null) {
                        foreach ($jobtitle_ as $key => $value) {
                            # code...
                            $dataDetailManPow=array(
                              'ManPlanNo' =>$planno->ManPlanNo,
                              'PositionNo' => explode('#', $jobtitle_[$key])[0],
                              'JobPositionCode' => explode('#', $jobtitle_[$key])[0],
                              'JobPosition' => explode('#',$jobtitle_[$key])[1],
                              'PositionLevel' => explode('#', $positionlevel_[$key])[0],
                              'PositionLevelDes' => explode('#', $positionlevel_[$key])[1],
                              'EmployeeType' =>$employeetype_[$key],
                              'CompanyType' =>$companytype_[$key],
                              'ReportToLevel' => explode('#', $reportto_[$key])[0],
                              'ReportToLevelDes' => explode('#', $reportto_[$key])[1],
                              'ReasonJustification' =>$reason_justification_[$key],
                              // 'ScanDocApproval' =>$docscanapp_[$key],
                              'RegBy' => $this->session->userdata('IDNumber'),
                              'RegDate' => date('Y-m-d')
                            );    
                            $this->M_humanresource->insert('tbl_emp_plan_det', $dataDetailManPow);
                        }
                        $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                            redirect('Humanresource/view_new_manpower');
                }else{
                    $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Failed to submit data!</strong></center> </div>');
                     redirect('Humanresource/view_new_manpower');
                }   
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_new_manpower');
            }              
        }
    }

    function view_edit_manpower($jobpostno) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'New Manpower Plan';
        $query['headertitle'] = 'Edit Man Power';
        $query['jobpostno_header'] = $this->M_humanresource->get_position_byjobpostno($jobpostno);
        $query['jobslist'] = $this->M_humanresource->get_post_list_byjobpostno($jobpostno);
        $query['get_education'] = $this->M_humanresource->get_education_req();
        $query['get_fieldstudy'] = $this->M_humanresource->get_fieldstudy_req();
        $query['get_yearexperience'] = $this->M_humanresource->get_yearexp_req();
        $query['get_age'] = $this->M_humanresource->get_age_req();
        $query['get_english'] = $this->M_humanresource->get_english_req();
        $this->load->view('humanresource/manpowerplan/v_edit_manpower', $query);
    }

    function edit_manpowerplan(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('edit')) {
            $id = $this->input->post('jobpostno');
            $data_manpower = array(
              'PostDate' => $this->input->post('postdate'),
              'PostExpireDate' => $this->input->post('postexpiredate'),
              'JobDesc' => $this->input->post('jobdesc'), 
              'Responsibilities' => $this->input->post('responsibilities'), 
              'Requisition' => $this->input->post('requisition'), 
              'LicenseCertification' => $this->input->post('licensecertification'), 
              'WorkLocation' => $this->input->post('worklocation'), 
              'CandidateType' => $this->input->post('candidatetype'), 
              'CtrlNoPosition' => $this->input->post('ctrlnoposition'), 
              'PositionNo' => $this->input->post('positionno'), 
              'PositionTitle' => $this->input->post('positiontitle'), 
              'EducationCode' => $this->input->post('educationreq'), 
              'EducationDes' => $this->input->post('i_edu_des'), 
              'FieldStudy' => $this->input->post('fieldstudyreq'), 
              'FieldStudyDes' => $this->input->post('i_fieldstudy_des'), 
              'Experience' => $this->input->post('yearexpreq'), 
              'ExperienceDes' => $this->input->post('i_expreq_des'), 
              'EnglishMin' => $this->input->post('engreq'), 
              'EnglishDes' => $this->input->post('i_english_des'), 
              'AgeMin' => $this->input->post('agereq'), 
              'AgeDes' => $this->input->post('i_age_des'), 
            );
            $this->M_humanresource->edit_jobpost_byjobpostno($id, $data_manpower);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_manpower/'.$id);        
        }
        if ($this->input->post('repost')) {
            //Master Manpower
            $query['Mctrlnoposition'] = $ctrlnoposition_ = $this->input->post('ctrlnoposition');
            $query['Mpositionno'] = $positionno_ = $this->input->post('positionno');
            $query['Mpositiontitle'] = $positiontitle_ = $this->input->post('positiontitle');
            $query['Mpostdate'] = $postdate_ = $this->input->post('postdate');
            $query['Mpostexpiredate'] = $postexpiredate_ = $this->input->post('postexpiredate');
            $query['Mjobdesc'] = $jobdesc_ = $this->input->post('jobdesc');
            $query['Mresponsibilities'] = $responsibilities_ = $this->input->post('responsibilities');
            $query['Mrequisition'] = $requisition_ = $this->input->post('requisition');
            $query['Mlicensecertification'] = $licensecertification_ = $this->input->post('licensecertification');
            $query['Mworklocation_'] = $worklocation_ = $this->input->post('worklocation');
            $query['Mcandidatetype'] = $candidatetype_ = $this->input->post('candidatetype');
            $query['Meducationreq'] = $educationreq_ = $this->input->post('educationreq');
            $query['Mi_edu_des'] = $i_edu_des_ = $this->input->post('i_edu_des');
            $query['Mfieldstudyreq'] = $fieldstudyreq_ = $this->input->post('fieldstudyreq');
            $query['Mi_fieldstudy_des'] = $i_fieldstudy_des_ = $this->input->post('i_fieldstudy_des');
            $query['Myearexpreq'] = $yearexpreq_ = $this->input->post('yearexpreq');
            $query['Mi_expreq_des'] = $i_expreq_des_ = $this->input->post('i_expreq_des');
            $query['Mengreq'] = $engreq_ = $this->input->post('engreq');
            $query['Mi_english_des'] = $i_english_des_ = $this->input->post('i_english_des');
            $query['Magereq'] = $agereq_ = $this->input->post('agereq');
            $query['Mi_age_des'] = $i_age_des_ = $this->input->post('i_age_des');
            $datas['cek'] = $this->M_humanresource->cek_posting($postdate_,$ctrlnoposition_,$positionno_,$candidatetype_);
            if ($datas['cek'] != true) {
                $dataPosting=array(
                    'PostDate' =>$postdate_,
                    'PostExpireDate' => $postexpiredate_,
                    'CandidateType' =>$candidatetype_,
                    'CtrlNoPosition' =>$ctrlnoposition_,
                    'PositionNo' =>$positionno_,
                    'PositionTitle' =>$positiontitle_,
                    'JobDesc' =>$jobdesc_,
                    'Responsibilities' =>$responsibilities_,
                    'Requisition' =>$requisition_,
                    'Experience' =>$yearexpreq_,
                    'ExperienceDes' =>$i_expreq_des_,
                    'EducationCode' =>$educationreq_,
                    'EducationDes' =>$i_edu_des_,
                    'FieldStudy' =>$fieldstudyreq_,
                    'FieldStudyDes' =>$i_fieldstudy_des_,
                    'AgeMin' =>$agereq_,
                    'AgeDes' =>$i_age_des_,
                    'EnglishMin' =>$engreq_,
                    'EnglishDes' =>$i_english_des_,
                    'WorkLocation' =>$worklocation_,
                    'LicenseCertification' =>$licensecertification_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                    );
                $this->M_humanresource->insert('tbl_emp_plan_post', $dataPosting);
                $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                redirect('Humanresource/view_list_mp_posting');
               
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_list_mp_posting');
            }              
        }
    }

    function delete_manpower_post($uid){
        $this->M_humanresource->delete_data_manpower_post($uid);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_list_mp_posting');
        //redirect('HR_Modul/view_all_careeranddevelopment');
    }

    function get_jobtitle_plan(){
        $select_box = '';
        $job_title = $this->M_humanresource->get_jobtitle();
        $select_box .= '<option value="">--Choose--</option>';
        foreach ($job_title as $row) {
          # code...
          $select_box .= '<option value="'.$row->JobTitleCode. '#' .$row->JobTitle.'">'.$row->JobTitle.'</option>';
        }
        echo json_encode($select_box);
    }

    function get_positionlevel_plan(){
        $select_box = '';
        $position_level = $this->M_humanresource->get_postitionlevel();
        $select_box .= '<option value="">--Choose--</option>';
        foreach ($position_level as $row) {
          # code...
          $select_box .= '<option value="'.$row->WorkFunction. '#' .$row->WorkFunctionDes.'">'.$row->WorkFunctionDes.'</option>';
        }
        echo json_encode($select_box);
    }

    function get_employeetype_plan(){
        $select_box = '';
        $employee_type = $this->M_humanresource->get_emplyoyeetype();
        $select_box .= '<option value="">--Choose--</option>';
        foreach ($employee_type as $row) {
          # code...
          $select_box .= '<option value="'.$row->EmployeeType.'">'.$row->EmployeeTypeDes.'</option>';
        }
        echo json_encode($select_box);
    }

     function get_companytype_plan(){
        $select_box = '';
        $company_type = $this->M_humanresource->get_companytype();
        $select_box .= '<option value="">--Choose--</option>';
        foreach ($company_type as $row) {
          # code...
          $select_box .= '<option value="'.$row->CompanyType.'">'.$row->CompanyTypeDes.'</option>';
        }
        echo json_encode($select_box);
    }

    //Recruitment & Selection
    function view_recruitment_select() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Recruitment & Selection';
        $query['headertitle'] = 'Job Post';
        $query['get_rec'] = $this->M_humanresource->get_data_recruit();
        $query['jobslist'] = $this->M_humanresource->get_post_list();
        $this->load->view('humanresource/recruitselect/v_recruit_select', $query);
    }

    function view_recruitment_applied($applicantno) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Personal Applied';
        $query['headertitle'] = 'Personal';
        $query['get_rec_byid'] = $this->M_humanresource->get_data_recruit_byid($applicantno);
        $this->load->view('humanresource/recruitselect/v_rec_applied', $query);
    }

    function view_new_recruit($jobpostno) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'New Recruitment';
        $query['headertitle'] = 'New Recruitment';
        $query['getauto'] = $this->M_humanresource->getpapplicantnoauto();
        if ($query['getauto'] == '') {
          $increment = 0;
        }else{
        $increment=$query['getauto'][0]->ApplicantNo;
        }
        $query['autoidnum'] = $increment + 1;
        $query['gpost'] = $this->M_humanresource->get_post_list_by_postno($jobpostno);
        $query['currentdate'] = date('Y-m-d');
        $query['get_education'] = $this->M_humanresource->get_education_req();
        $query['get_fieldstudy'] = $this->M_humanresource->get_fieldstudy_req();
        $query['get_yearexperience'] = $this->M_humanresource->get_yearexp_req();
        $query['get_age'] = $this->M_humanresource->get_age_req();
        $query['get_english'] = $this->M_humanresource->get_english_req();
        $this->load->view('humanresource/recruitselect/v_new_recruit', $query);
    }

    function transfer_recruitment(){
        if ($this->input->post('submit')) {
            //Master Recruit
            $query['Mapplicantno'] = $applicantno_ = $this->input->post('applicantno');
            $query['Mapplieddate'] = $applieddate_ = $this->input->post('applieddate');
            $query['Mjobpost'] = $jobpost_ = $this->input->post('jobpost');
            $query['Mpositionno'] = $positionno_ = $this->input->post('positionno');
            $query['Meducationreq'] = $educationreq_ = $this->input->post('educationreq');
            $query['Mi_edu_des'] = $i_edu_des_ = $this->input->post('i_edu_des');
            $query['Mfieldstudyreq'] = $fieldstudyreq_ = $this->input->post('fieldstudyreq');
            $query['Mi_fieldstudy_des'] = $i_fieldstudy_des_ = $this->input->post('i_fieldstudy_des');
            $query['Myearexpreq'] = $yearexpreq_ = $this->input->post('yearexpreq');
            $query['Mi_expreq_des'] = $i_expreq_des_ = $this->input->post('i_expreq_des');
            $query['Mengreq'] = $engreq_ = $this->input->post('engreq');
            $query['Mi_english_des'] = $i_english_des_ = $this->input->post('i_english_des');
            $query['Magereq'] = $agereq_ = $this->input->post('agereq');
            $query['Mi_age_des'] = $i_age_des_ = $this->input->post('i_age_des');
            $query['Mfirstname'] = $firstname_ = $this->input->post('firstname');
            $query['Mmiddlename'] = $middlename_ = $this->input->post('middlename');
            $query['Mlastname'] = $lastname_ = $this->input->post('lastname');
            $query['Mdateofbirth'] = $dateofbirth_ = $this->input->post('dateofbirth');
            $query['Mpointofbirth'] = $pointofbirth_ = $this->input->post('pointofbirth');
            $query['Mgender'] = $gender_ = $this->input->post('gender');
            $query['Mmaritalstatus'] = $maritalstatus_ = $this->input->post('maritalstatus');
            $query['Mreligion'] = $religion_ = $this->input->post('religion');
            $query['Mnationality'] = $nationality_ = $this->input->post('nationality');
            $query['Mforeignpermitno'] = $foreignpermitno_ = $this->input->post('foreignpermitno');
            $query['Mpermitexpiredate'] = $permitexpiredate_ = $this->input->post('permitexpiredate');
            $query['Methnic'] = $ethnic_ = $this->input->post('ethnic');
            $query['Mheight'] = $height_ = $this->input->post('height');
            $query['Mweight'] = $weight_ = $this->input->post('weight');
            $query['Mbloodtype'] = $bloodtype_ = $this->input->post('bloodtype');
            $query['Mmedication'] = $medication_ = $this->input->post('medication');
            $query['Mallergie'] = $allergies = $this->input->post('allergies');
            $query['Mchronicmedicalhistory'] = $chronicmedicalhistory_ = $this->input->post('chronicmedicalhistory');
            $query['Mmobile'] = $mobile_ = $this->input->post('mobile');
            $query['Mphone'] = $phone_ = $this->input->post('phone');
            $query['Mwa'] = $wa_ = $this->input->post('wa');
            $query['Memail'] = $email_ = $this->input->post('email');
            $query['Maddress'] = $address_ = $this->input->post('address');
            $query['Mcountry'] = $country_ = $this->input->post('country');
            $query['Mprovince'] = $province_ = $this->input->post('province');
            $query['Mregion'] = $region_ = $this->input->post('region');
            $query['Mdistrict'] = $district_ = $this->input->post('district');
            $query['Msubdistrict'] = $subdistrict_ = $this->input->post('subdistrict');
            $query['Mcity'] = $city_ = $this->input->post('city');
            $query['Mpostcode'] = $postcode_ = $this->input->post('postcode');
            $query['Midentityno'] = $identityno_ = $this->input->post('identityno');
            $query['Midentityexpire'] = $identityexpire_ = $this->input->post('identityexpire');

            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
            // $this->ddoo_upload('photo');
            // $photo = $_FILES['photo']['name'];
            $photo = $this->upload_image('photo');
            }else{
                $photo = "";
            }
            if(isset($_FILES['identity']) && $_FILES['identity']['name'] != ''){
                // $this->ddoo_upload('identity');
                // $identity = $_FILES['identity']['name'];
                $identity = $this->upload_image('identity');
            }else{
                $identity = "";
            }
            if(isset($_FILES['cvfile']) && $_FILES['cvfile']['name'] != ''){
                // $this->ddoo_upload('cvfile');
                // $cvfile = $_FILES['cvfile']['name'];
                $cvfile = $this->upload_image('cvfile');
            }else{
                $cvfile = "";
            }

            //Array Detail Experience
            $query['Mcompany'] = $company_ = $this->input->post('company_');
            $query['Mlocation'] = $location_ = $this->input->post('location_');
            $query['Mfrom'] = $from_ = $this->input->post('from_');
            $query['Mto'] = $to_ = $this->input->post('to_');
            $query['Mduration'] = $duration_ = $this->input->post('duration_');
            $query['Mlastposition_'] = $lastposition_ = $this->input->post('lastposition_');
            $query['Mcomments'] = $comments_ = $this->input->post('comments_');

            //Array Detail Education (Formal)
            $query['Minstitution'] = $institution_ = $this->input->post('institution_');
            $query['Mloc'] = $loc_ = $this->input->post('loc_');
            $query['Mcompetecies'] = $competecies_ = $this->input->post('competecies_');
            $query['Mfrome'] = $frome_ = $this->input->post('frome_');
            $query['Mtoe'] = $toe_ = $this->input->post('toe_');
            $query['Mduratione'] = $duratione_ = $this->input->post('duratione_');
            $query['Mcertificated'] = $certificated_ = $this->input->post('certificated_');

            //Array Detail Training
            $query['Mcoursename'] = $coursename_ = $this->input->post('coursename_');
            $query['Mcoursestart'] = $coursestart_ = $this->input->post('coursestart_');
            $query['Mcourseend'] = $courseend_ = $this->input->post('courseend_');
            $query['Mdurationt'] = $durationt_ = $this->input->post('durationt_');
            $query['Minstitutiont'] = $institutiont_ = $this->input->post('institutiont_');
            $query['Mresult'] = $result_ = $this->input->post('result_');

            //Array Detail Hobby
            $query['Mhobby'] = $hobby_ = $this->input->post('hobby_');
            $query['Mreason'] = $reason_ = $this->input->post('reason_');

            //Array Detail Language
            $query['Mlanguage'] = $language_ = $this->input->post('language_');
            $query['Mspeaking'] = $speaking_ = $this->input->post('speaking_');
            $query['Mreading'] = $reading_ = $this->input->post('reading_');
            $query['Mwriting'] = $writing_ = $this->input->post('writing_');
            $query['Mlistening'] = $listening_ = $this->input->post('listening_');
            $query['Mreasonl'] = $reasonl_ = $this->input->post('reasonl_');

            if(isset($_FILES['photodep']) && $_FILES['photodep']['name'] != ''){
                // $this->ddoo_upload('photodep');
                // $photodep = $_FILES['photodep']['name'];
                $photodep = $this->upload_image('photodep');
            }else{
                $photodep = "";
            }
            //Dependent
            $query['Middep'] = $iddep = $this->input->post('iddep');
            $query['Mrelationshipdep'] = $relationshipdep = $this->input->post('relationshipdep');
            $query['Mfullnamedep'] = $fullnamedep = $this->input->post('fullnamedep');
            $query['Mgenderdep'] = $genderdep = $this->input->post('genderdep');
            $query['Mnationalitydep'] = $nationalitydep = $this->input->post('nationalitydep');
            $query['Mdateofbirthdep'] = $dateofbirthdep = $this->input->post('dateofbirthdep');
            $query['Mpointofbirthdep'] = $pointofbirthdep = $this->input->post('pointofbirthdep');
            $query['Mmaritalstatusdep'] = $maritalstatusdep = $this->input->post('maritalstatusdep');
            $query['Mreligiondep'] = $religiondep = $this->input->post('religiondep');
            $query['Methnicdep'] = $ethnicdep = $this->input->post('ethnicdep');
            $query['Mheightdep'] = $heightdep = $this->input->post('heightdep');
            $query['Mweightdep'] = $weightdep = $this->input->post('weightdep');
            $query['Mbloodtypedep'] = $bloodtypedep = $this->input->post('bloodtypedep');
            $query['Maddressdep'] = $addressdep = $this->input->post('addressdep');
            $query['Mcoutrydep'] = $coutrydep = $this->input->post('coutrydep');
            $query['Mprovincedep'] = $provincedep = $this->input->post('provincedep');
            $query['Mregiondep'] = $regiondep = $this->input->post('regiondep');
            $query['Mdistrictdep'] = $districtdep = $this->input->post('districtdep');
            $query['Msubdistrictdep'] = $subdistrictdep = $this->input->post('subdistrictdep');
            $query['Mcitydep'] = $citydep = $this->input->post('citydep');
            $query['Mpostcodedep'] = $postcodedep = $this->input->post('postcodedep');
            $query['Mphonedep'] = $phonedep = $this->input->post('phonedep');
            $query['Mmobiledep'] = $mobiledep = $this->input->post('mobiledep');
            $query['Mwadep'] = $wadep = $this->input->post('wadep');
            $query['Memaildep'] = $emaildep = $this->input->post('emaildep');
            
            $datas['cek'] = $this->M_humanresource->cek_applicantno($applicantno_);
            if ($datas['cek'] != true) {
                $dataMasterRec=array(
                    'AppliedDate' =>$applieddate_,
                    'JobPostNo' => $jobpost_,
                    'PositionNo' =>$positionno_,
                    'EducationReq' =>$educationreq_,
                    'EducationDes' =>$i_edu_des_,
                    'FieldStudyReq' =>$fieldstudyreq_,
                    'FieldStudyDes' =>$i_fieldstudy_des_,
                    'YearExpReq' =>$yearexpreq_,
                    'YearExpDes' =>$i_expreq_des_,
                    'AgeReq' =>$agereq_,
                    'AgeDes' =>$i_age_des_,
                    'EnglishReq' =>$engreq_,
                    'EnglishDes' =>$i_english_des_,
                    'FirstName' => $firstname_,
                    'MiddleName' =>$middlename_,
                    'LastName' =>$lastname_,
                    'DateofBirth' =>$dateofbirth_,
                    'PointofBirth' =>$pointofbirth_,
                    'Gender' =>$gender_,
                    'Maritalstatus' =>$maritalstatus_,
                    'Religion' =>$religion_,
                    'Nationality' =>$nationality_,
                    'ForeignPermitNo' =>$foreignpermitno_,
                    'PermitExpireDate' =>$permitexpiredate_,
                    'Ethnic' =>$ethnic_,
                    'Height' =>$height_,
                    'Weight' =>$weight_,
                    'BloodType' =>$bloodtype_,
                    'Medication' =>$medication_,
                    'Allergies' =>$allergies,
                    'ChronicMedicalHistory' =>$chronicmedicalhistory_,
                    'Mobile' =>$mobile_,
                    'Phone' =>$phone_,
                    'WA' =>$wa_,
                    'Email' =>$email_,
                    'Address' =>$address_,
                    'Country' =>$country_,
                    'Province' =>$province_,
                    'Region' =>$region_,
                    'District' =>$district_,
                    'SubDistrict' =>$subdistrict_,
                    'City' =>$city_,
                    'PostCode' =>$postcode_,
                    'IdentityNo' =>$identityno_,
                    'IdentityExpire' =>$identityexpire_,
                    'Identity' =>$identity,
                    'Photo' =>$photo,
                    'CVFile' =>$cvfile,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                    );
                $ret1 = $this->M_humanresource->insert('tbl_emp_recruit', $dataMasterRec);
                $appno = $this->M_humanresource->get_last_applicantno();
                if ($ret1 != null) {
                        foreach ($company_ as $key => $value) {
                            # code...
                            $dataExperience=array(
                              'ApplicantNo' =>$appno->ApplicantNo,
                              'Company' =>$company_[$key],
                              'Location' =>$location_[$key],
                              'FromYear' =>$from_[$key],
                              'ToYear' =>$to_[$key],
                              'Duration' =>$duration_[$key],
                              'LastPosition' =>$lastposition_[$key],
                              'Comments' =>$comments_[$key],
                            );    
                            $this->M_humanresource->insert('tbl_emp_recruit_experience', $dataExperience);
                        }
                        foreach ($institution_ as $key => $value) {
                            # code...
                            $dataEducation=array(
                              'ApplicantNo' =>$appno->ApplicantNo,
                              'Institution' =>$institution_[$key],
                              'Location' =>$loc_[$key],
                              'Competecies' =>$competecies_[$key],
                              'FromYear' =>$frome_[$key],
                              'ToYear' =>$toe_[$key],
                              'Duration' =>$duratione_[$key],
                              'Certificated' =>$certificated_[$key],
                            );    
                            $this->M_humanresource->insert('tbl_emp_recruit_formal', $dataEducation);
                        }
                        foreach ($coursename_ as $key => $value) {
                            # code...
                            $dataTraining=array(
                              'ApplicantNo' =>$appno->ApplicantNo,
                              'CourseName' =>$coursename_[$key],
                              'CourseStart' =>$coursestart_[$key],
                              'CourseEnd' =>$courseend_[$key],
                              'Duration' =>$durationt_[$key],
                              'Institution' =>$institutiont_[$key],
                              'Result' =>$result_[$key],
                            );    
                            $this->M_humanresource->insert('tbl_emp_recruit_train', $dataTraining);
                        }
                        foreach ($hobby_ as $key => $value) {
                            # code...
                            $dataHobby=array(
                              'ApplicantNo' =>$appno->ApplicantNo,
                              'Hobby' =>$hobby_[$key],
                              'Reason' =>$reason_[$key],
                            );    
                            $this->M_humanresource->insert('tbl_emp_recruit_hobby', $dataHobby);
                        }
                        foreach ($language_ as $key => $value) {
                            # code...
                            $dataLanguage=array(
                              'ApplicantNo' =>$appno->ApplicantNo,
                              'Language' =>$language_[$key],
                              'Speaking' =>$speaking_[$key],
                              'Reading' =>$reading_[$key],
                              'Writing' =>$writing_[$key],
                              'Listening' =>$listening_[$key],
                              'Reason' =>$reasonl_[$key],
                            );    
                            $this->M_humanresource->insert('tbl_emp_recruit_language', $dataLanguage);
                        }

                        $dataDep=array(
                          'ApplicantNo' =>$appno->ApplicantNo,
                          'IDNumberDependent' =>$iddep,
                          'FullName' =>$fullnamedep,
                          'Relationship' =>$relationshipdep,
                          'Gender' =>$genderdep,
                          'MaritalStatus' =>$maritalstatusdep,
                          'PlaceofBirth' =>$pointofbirthdep,
                          'DateofBirth' =>$dateofbirthdep,
                          'Religion' =>$religiondep,
                          'Nationality' =>$nationalitydep,
                          'Ethnic' =>$ethnicdep,
                          'Address' =>$addressdep,
                          'City' =>$citydep,
                          'SubDistrict' =>$subdistrictdep,
                          'District' =>$districtdep,
                          'Region' =>$regiondep,
                          'Province' =>$provincedep,
                          'Country' =>$coutrydep,
                          'PostCode' =>$postcodedep,
                          'BloodType' =>$bloodtypedep,
                          'Height' =>$heightdep,
                          'Weight' =>$weightdep,
                          // 'DateofDeath' =>$reasonl,
                          // 'BenefitType' =>$reasonl,
                          'Phone' =>$phonedep,
                          'Mobile' =>$mobiledep,
                          'WA' =>$wadep,
                          'Email' =>$emaildep,
                          'DepPhoto' =>$photodep,
                        );    
                        $this->M_humanresource->insert('tbl_emp_recruit_dependent', $dataDep);
                        $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                            redirect('Humanresource/view_job_post');
                }else{
                    $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Failed to submit data!</strong></center> </div>');
                     redirect('Humanresource/view_job_post');
                }   
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_job_post');
            }              
        }
    }

    function view_data_selection_rec($jobpostno,$educationseq,$fieldstudy,$agemin,$experience,$englishseq){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Selection Data';
        $query['headertitle'] = 'Selection Data';
        // $query['edu'] = $educationseq;
        // $query['fs'] = $fieldstudy;
        // $query['ag'] = $agemin;
        // $query['exp'] = $experience;
        // $query['eng'] = $englishseq;
        $query['get_data_selection_edexist_fsexist'] = $this->M_humanresource->get_data_selection_by_priority_edexist_fsexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_edexist_fsnotexist'] = $this->M_humanresource->get_data_selection_by_priority_edexist_fsnotexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_ednotexist_fsexist'] = $this->M_humanresource->get_data_selection_by_priority_ednotexist_fsexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_ednotexist_fsnotexist'] = $this->M_humanresource->get_data_selection_by_priority_ednotexist_fsnotexist($jobpostno,$educationseq,$fieldstudy);
        // $query['get_data_selection5'] = $this->M_humanresource->get_data_selection_by_priority5($jobpostno,$educationseq,$fieldstudy,$agemin,$experience,$englishseq);
        $this->load->view('humanresource/recruitselect/v_data_select_rec', $query);
    }



    //Job Posting
    function view_new_post_job($ctrlno,$positionno) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Create New Jobs';
        $query['headertitle'] = 'Manpower Plan';
        $query['data_post'] = $this->M_humanresource->get_detail_post($ctrlno,$positionno);
        $query['get_education'] = $this->M_humanresource->get_education_req();
        $query['get_fieldstudy'] = $this->M_humanresource->get_fieldstudy_req();
        $query['get_yearexperience'] = $this->M_humanresource->get_yearexp_req();
        $query['get_age'] = $this->M_humanresource->get_age_req();
        $query['get_english'] = $this->M_humanresource->get_english_req();
        $this->load->view('humanresource/jobpost/v_new_job_post', $query);
    }

    function transfer_new_jobpost(){
        if ($this->input->post('submit')) {
            //Master Manpower
            $query['Mctrlnoposition'] = $ctrlnoposition_ = $this->input->post('ctrlnoposition');
            $query['Mpositionno'] = $positionno_ = $this->input->post('positionno');
            $query['Mpositiontitle'] = $positiontitle_ = $this->input->post('positiontitle');
            $query['Mpostdate'] = $postdate_ = $this->input->post('postdate');
            $query['Mpostexpiredate'] = $postexpiredate_ = $this->input->post('postexpiredate');
            $query['Mjobdesc'] = $jobdesc_ = $this->input->post('jobdesc');
            $query['Mresponsibilities'] = $responsibilities_ = $this->input->post('responsibilities');
            $query['Mrequisition'] = $requisition_ = $this->input->post('requisition');
            $query['Mlicensecertification'] = $licensecertification_ = $this->input->post('licensecertification');
            $query['Mworklocation_'] = $worklocation_ = $this->input->post('worklocation');
            $query['Mcandidatetype'] = $candidatetype_ = $this->input->post('candidatetype');
            $query['Meducationreq'] = $educationreq_ = $this->input->post('educationreq');
            $query['Mi_edu_des'] = $i_edu_des_ = $this->input->post('i_edu_des');
            $query['Mfieldstudyreq'] = $fieldstudyreq_ = $this->input->post('fieldstudyreq');
            $query['Mi_fieldstudy_des'] = $i_fieldstudy_des_ = $this->input->post('i_fieldstudy_des');
            $query['Myearexpreq'] = $yearexpreq_ = $this->input->post('yearexpreq');
            $query['Mi_expreq_des'] = $i_expreq_des_ = $this->input->post('i_expreq_des');
            $query['Mengreq'] = $engreq_ = $this->input->post('engreq');
            $query['Mi_english_des'] = $i_english_des_ = $this->input->post('i_english_des');
            $query['Magereq'] = $agereq_ = $this->input->post('agereq');
            $query['Mi_age_des'] = $i_age_des_ = $this->input->post('i_age_des');
            $datas['cek'] = $this->M_humanresource->cek_posting($postdate_,$ctrlnoposition_,$positionno_,$candidatetype_);
            if ($datas['cek'] != true) {
                $dataPosting=array(
                    'PostDate' =>$postdate_,
                    'PostExpireDate' => $postexpiredate_,
                    'CandidateType' =>$candidatetype_,
                    'CtrlNoPosition' =>$ctrlnoposition_,
                    'PositionNo' =>$positionno_,
                    'PositionTitle' =>$positiontitle_,
                    'JobDesc' =>$jobdesc_,
                    'Responsibilities' =>$responsibilities_,
                    'Requisition' =>$requisition_,
                    'Experience' =>$yearexpreq_,
                    'ExperienceDes' =>$i_expreq_des_,
                    'EducationCode' =>$educationreq_,
                    'EducationDes' =>$i_edu_des_,
                    'FieldStudy' =>$fieldstudyreq_,
                    'FieldStudyDes' =>$i_fieldstudy_des_,
                    'AgeMin' =>$agereq_,
                    'AgeDes' =>$i_age_des_,
                    'EnglishMin' =>$engreq_,
                    'EnglishDes' =>$i_english_des_,
                    'WorkLocation' =>$worklocation_,
                    'LicenseCertification' =>$licensecertification_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                    );
                $this->M_humanresource->insert('tbl_emp_plan_post', $dataPosting);
                $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                redirect('Humanresource/view_man_power_plan');
               
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_man_power_plan');
            }              
        }
    }

    function view_job_post() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Posting';
        $query['headertitle'] = 'Jobs Post';
        $currentdate = date('Y-m-d');
        $query['jobslist'] = $this->M_humanresource->get_post_list_not_expire($currentdate);
        $query['countapplied'] = $this->M_humanresource->get_count_applied();
        $this->load->view('humanresource/jobpost/v_job_post', $query);
    }

    //Master
    function view_master() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Master File';
        $this->load->view('humanresource/master/v_master_data', $query);
    }

    //Employee Admin
    function view_personal_list() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Master';
        $query['headert2'] = 'Profile';
        $query['title'] = 'Master Profile';
        $query['sumemptype'] = $this->M_humanresource->get_data_sum_employee_by_employeetype($branch);
        $query['data_list'] = $this->M_humanresource->get_data_personaldata_list($branch);
        $this->load->view('humanresource/employeeadmin/v_personal_list', $query);
    }

    function view_personal_data($id) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Admin';
        $query['headertitle'] = 'Personal Profile';
        $query['personal'] = $this->M_humanresource->get_data_personaldata($id);
        $query['dependent'] = $this->M_humanresource->get_data_dependent_byid($id);
        $query['kin'] = $this->M_humanresource->get_data_kin_byid($id);
        $query['myasset'] = $this->M_humanresource->get_data_asset_byid($id);
        $query['experience'] = $this->M_humanresource->get_data_experience_byid($id);
        $query['education'] = $this->M_humanresource->get_data_formal_byid($id);
        $query['training'] = $this->M_humanresource->get_data_training_byid($id);
        $query['language'] = $this->M_humanresource->get_data_language_byid($id);
        $query['hobby'] = $this->M_humanresource->get_data_hobby_byid($id);
        $query['get_dept'] = $this->M_humanresource->get_all_department($id);
        $query['get_data_his'] = $this->M_humanresource->get_dept_his($id);
        $this->load->view('humanresource/employeeadmin/v_personal_data', $query);
    }

    function view_new_data_personal() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'New Personal';
        $query['headertitle'] = 'Employee Register';
        $lastidnumbercode = $this->M_humanresource->get_last_idnumber();
        if ($lastidnumbercode != false) {                        
            $last = substr($lastidnumbercode, 4);
            $cur = $last + 1;
            $new = '1'.str_pad($cur, 6, '0',STR_PAD_LEFT);
            $idnumbercode = $new;            
        } else {
            $idnumbercode  = '1'.'000001';
        }        
        $query['idnumbercode'] = $idnumbercode;        
        // var_dump($last);

        //Jobinformation Select Dropdown
        $query['get_marital'] = $this->M_humanresource->get_data_marital();
        $query['get_ethnic'] = $this->M_humanresource->get_data_ethnic();
        $query['get_employeeclass'] = $this->M_humanresource->get_data_employeeclass();
        $query['get_employeetype'] = $this->M_humanresource->get_data_employeetype();
        $query['get_employmenttype'] = $this->M_humanresource->get_data_employmenttype();
        $query['get_individualgrade'] = $this->M_humanresource->get_data_individualgrade();
        $query['get_point'] = $this->M_humanresource->get_data_point();
        $query['get_level'] = $this->M_humanresource->get_data_level();
        $query['get_title'] = $this->M_humanresource->get_data_title();
        $query['get_workfunction'] = $this->M_humanresource->get_data_workfunction();
        $query['get_workgroup'] = $this->M_humanresource->get_data_workgroup();
        $query['get_onsitemarital'] = $this->M_humanresource->get_data_onsitemarital();
        $query['get_maritalbenefit'] = $this->M_humanresource->get_data_maritalbenefit();
        $query['get_company'] = $this->M_humanresource->get_data_company();
        $query['get_supervisor'] = $this->M_humanresource->get_data_supervisor();
        $query['get_leavetype'] = $this->M_humanresource->get_data_leavetype();
        $query['get_workday'] = $this->M_humanresource->get_data_workday();
        $this->load->view('humanresource/employeeadmin/v_new_personaldata', $query);
    }

    function get_list_country(){
        $data = $this->M_humanresource->get_list_country();
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));
        }
    }

    function get_list_province_by_country(){
        $countrycode = $this->input->post('country_code');
        $data = $this->M_humanresource->get_list_province_by_country($countrycode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsiteprovince_by_onsitecountry(){
        $ocountrycode = $this->input->post('ocountry_code');
        $data = $this->M_humanresource->get_list_onsiteprovince_by_onsitecountry($ocountrycode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }


    function get_list_provincedep_by_countrydep(){
        $countrydepcode = $this->input->post('countrydep_code');
        $data = $this->M_humanresource->get_list_provincedep_by_countrydep($countrydepcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }


    function get_list_provincekin_by_countrykin(){
        $countrykincode = $this->input->post('countrykin_code');
        $data = $this->M_humanresource->get_list_provincekin_by_countrykin($countrykincode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }


    function get_list_region_by_province(){
        $provincecode =  $this->input->post('province_code');
        $data = $this->M_humanresource->get_list_region_by_province($provincecode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsiteregion_by_onsiteprovince(){
        $oprovincecode =  $this->input->post('oprovince_code');
        $data = $this->M_humanresource->get_list_onsiteregion_by_onsiteprovince($oprovincecode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_regiondep_by_provincedep(){
        $provincedepcode =  $this->input->post('provincedep_code');
        $data = $this->M_humanresource->get_list_regiondep_by_provincedep($provincedepcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_regionkin_by_provincekin(){
        $provincekincode =  $this->input->post('provincekin_code');
        $data = $this->M_humanresource->get_list_regionkin_by_provincekin($provincekincode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsiteregion_by_onsiteregion(){
        $oregioncode =  $this->input->post('oregion_code');
        $data = $this->M_humanresource->get_list_onsiteregion_by_onsiteregion($oregioncode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_city_by_province(){
        $provincecode =  $this->input->post('province_code');
        $data = $this->M_humanresource->get_list_city_by_province($provincecode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_city_by_region(){
        $regioncode =  $this->input->post('region_code');
        $data = $this->M_humanresource->get_list_city_by_region($regioncode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsitecity_by_onsiteprovince(){
        $oprovincecode =  $this->input->post('oprovince_code');
        $data = $this->M_humanresource->get_list_onsitecity_by_onsiteprovince($oprovincecode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsitecity_by_onsiteregion(){
        $oregioncode =  $this->input->post('oregion_code');
        $data = $this->M_humanresource->get_list_onsitecity_by_onsiteregion($oregioncode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_citydep_by_regiondep(){
        $regiondepcode =  $this->input->post('regiondep_code');
        $data = $this->M_humanresource->get_list_citydep_by_regiondep($regiondepcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_citykin_by_regionkin(){
        $regionkincode =  $this->input->post('regionkin_code');
        $data = $this->M_humanresource->get_list_citykin_by_regionkin($regionkincode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_district_by_region(){
        $regioncode =  $this->input->post('region_code');
        $data = $this->M_humanresource->get_list_district_by_region($regioncode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsitedistrict_by_onsiteregion(){
        $oregioncode =  $this->input->post('oregion_code');
        $data = $this->M_humanresource->get_list_onsitedistrict_by_onsiteregion($oregioncode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_districtdep_by_regiondep(){
        $regiondepcode =  $this->input->post('regiondep_code');
        $data = $this->M_humanresource->get_list_districtdep_by_regiondep($regiondepcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_districtkin_by_regionkin(){
        $regionkincode =  $this->input->post('regionkin_code');
        $data = $this->M_humanresource->get_list_districtkin_by_regionkin($regionkincode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_subdistrict_by_district(){
        $districtcode =  $this->input->post('district_code');
        $data = $this->M_humanresource->get_list_subdistrict_by_district($districtcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_onsitesubdistrict_by_onsitedistrict(){
        $odistrictcode =  $this->input->post('odistrict_code');
        $data = $this->M_humanresource->get_list_onsitesubdistrict_by_onsitedistrict($odistrictcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_subdistrictdep_by_districtdep(){
        $districtdepcode =  $this->input->post('districtdep_code');
        $data = $this->M_humanresource->get_list_subdistrictdep_by_districtdep($districtdepcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_subdistrictkin_by_districtkin(){
        $districtkincode =  $this->input->post('districtkin_code');
        $data = $this->M_humanresource->get_list_subdistrictkin_by_districtkin($districtkincode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_indivuduallevel_list(){
        $levelcode = $this->input->post('id_level');
        $select_box = '';
        $level = $this->M_humanresource->get_individuuallevel_list($levelcode);
        foreach ($level as $lvl) {
            if ($lvl->CtrlNo == 1) {
                $select_box .='<option value="'.$lvl->Level.'" individuallevel-code="'.$lvl->LevelCode.'"  individuallevel-des="'.$lvl->LevelDescription.'" management-type="'.$lvl->ManagementType.'" management-group="'.$lvl->ManagementGroup.'" selected>'.$lvl->LevelDescription.'</option>';
            } else {
                $select_box .='<option value="'.$lvl->Level.'" individuallevel-code="'.$lvl->LevelCode.'"  individuallevel-des="'.$lvl->LevelDescription.'" management-type="'.$lvl->ManagementType.'" management-group="'.$lvl->ManagementGroup.'" selected>'.$lvl->LevelDescription.'</option>';
            }
        }
        echo json_encode($select_box);        
    }

    function get_branch_list(){
        $companycode = $this->input->post('id_company');
        $select_box = '';
        $branch = $this->M_humanresource->get_branch_list($companycode);
        foreach ($branch as $br) {
            if ($br->CtrlNo == 1) {
                $select_box .='<option value="'.$br->BranchCode.'" branch-des="'.$br->BranchDes.'" selected>'.$br->BranchCode.' | '.$br->BranchDes.'</option>';
            } else {
                $select_box .='<option value="'.$br->BranchCode.'" branch-des="'.$br->BranchDes.'" selected>'.$br->BranchCode.' | '.$br->BranchDes.'</option>';
            }
        }
        echo json_encode($select_box);        
    }

    function get_department_list(){
        $branchcode = $this->input->post('id_branch');
        $select_box = '';
        $select_cost = '';
        $department = $this->M_humanresource->get_department_list($branchcode);
        if ($department != '') {
            for($i = 0; $i < count($department); $i++) {
                $select_box .='<option value="'.$department[$i]['DeptCode'].'" department-des="'.$department[$i]['DeptDes'].'" bu-code="'.$department[$i]['BUCode'].'" bu-des="'.$department[$i]['BUDes'].'" div-code="'.$department[$i]['DivCode'].'" div-des="'.$department[$i]['DivDes'].'">'.$department[$i]['DeptCode'].' | '.$department[$i]['DeptDes'].'</option>';
            }
        }else {
            $select_box .='<option value="">No Data Department</option>';
        }

        echo json_encode($select_box);        
    }

    // function get_cost_center(){
    //     $deptcode = $_POST['deptcode'];
    //     $result = $this->db->query(
    //         "SELECT a.DeptCode,a.DeptDes,a.Branch,b.CostCenter,b.CCDes 
    //          FROM abase_03_dept a 
    //          JOIN abase_04_sectioncc b 
    //             ON b.DeptCode = a.DeptCode 
    //          WHERE a.DeptCode = '$deptcode'"
    //     )->result();

    //     $render = '';

    //     if(!empty($result)){
    //         foreach($result as $row){
    //             $render .= '<option value="'.$row->CostCenter.'" costcenter-des="'.$row->CCDes.'"> '.$row->CostCenter.' | '.$row->CCDes.' </option>';
    //         }
    //     }else{
    //         $render .= '<option value="">No Data Cost Center</option>';
    //     }

    //     echo $render;
    // }

    function get_cost_center(){
        $deptcode = $_POST['deptcode'];
        $result = $this->db->query(
            "SELECT a.DeptCode,a.DeptDes,a.Branch,b.CostCenter,b.CCDes 
             FROM abase_03_dept a 
             JOIN abase_04_cost_center b 
                ON b.DeptCode = a.DeptCode 
             WHERE a.DeptCode = '$deptcode'"
        )->result();

        $render = '';

        if(!empty($result)){
            foreach($result as $row){
                $render .= '<option value="'.$row->CostCenter.'" costcenter-des="'.$row->CCDes.'"> '.$row->CostCenter.' | '.$row->CCDes.' </option>';
            }
        }else{
            $render .= '<option value="">No Data Cost Center</option>';
        }

        echo $render;
    }


    // function get_cost_center_edit(){
    //     $i_dept = $_POST['i_dept'];
    //     $result = $this->db->query(
    //         "SELECT a.DeptCode,a.DeptDes,a.Branch,b.CostCenter,b.CCDes 
    //          FROM abase_03_dept a 
    //          JOIN abase_04_sectioncc b 
    //             ON b.DeptCode = a.DeptCode 
    //          WHERE a.DeptCode = '$i_dept'"
    //     )->result();

    //     // print_r($this->db->last_query());
    //     // die();

    //     $render = '';

    //     if(!empty($result)){
    //         foreach($result as $row){
    //             $render .= '<option value="'.$row->CostCenter.'" costcenter-des="'.$row->CCDes.'"> '.$row->CostCenter.' | '.$row->CCDes.' </option>';
    //         }
    //     }else{
    //         $render .= '<option value="">No Data Cost Center</option>';
    //     }

    //     echo $render;
    // }

    function get_cost_center_edit(){
        $i_dept = $_POST['i_dept'];
        $result = $this->db->query(
            "SELECT a.DeptCode,a.DeptDes,a.Branch,b.CostCenter,b.CCDes 
             FROM abase_03_dept a 
             JOIN abase_04_cost_center b 
                ON b.DeptCode = a.DeptCode 
             WHERE a.DeptCode = '$i_dept'"
        )->result();

        // print_r($this->db->last_query());
        // die();

        $render = '';

        if(!empty($result)){
            foreach($result as $row){
                $render .= '<option value="'.$row->CostCenter.'" costcenter-des="'.$row->CCDes.'"> '.$row->CostCenter.' | '.$row->CCDes.' </option>';
            }
        }else{
            $render .= '<option value="">No Data Cost Center</option>';
        }

        echo $render;
    }


    function transfer_data_personal(){
        if ($this->input->post('submit')) {
            //Personal Data
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');
            $query['Midnumberidentifier'] = $idnumberidentifier_ = $identifier;
            $query['Mfirstname'] = $firstname_ = $this->input->post('firstname');
            $query['Mmiddlename'] = $middlename_ = $this->input->post('middlename');
            $query['Mlastname'] = $lastname_ = $this->input->post('lastname');
            $query['Mnickname'] = $nickname_ = $this->input->post('nickname');
            $query['Mfullname_'] = $fullname_ = $this->input->post('fullname');
            $query['Mgender'] = $gender_ = $this->input->post('gender');
            $query['Mdateofbirth'] = $dateofbirth_ = $this->input->post('dateofbirth');
            $query['Mpointofbirth'] = $pointofbirth_ = $this->input->post('pointofbirth');
            $query['Mmaritalstatus'] = $maritalstatus_ = $this->input->post('maritalstatus');
            $query['Mmaritalstatusdes'] = $maritalstatusdes_ = $this->input->post('i_maritalstatusdes');
            $query['Mreligion'] = $religion_ = $this->input->post('religion');
            $query['Mnationality'] = $nationality_ = $this->input->post('nationality');
            $query['Mnationalitydes'] = $nationalitydes_ = $this->input->post('i_nationalitydes');
            $query['Mforeignpermitno'] = $foreignpermitno_ = $this->input->post('foreignpermitno');
            $query['Mpermitexpiredate'] = $permitexpiredate_ = $this->input->post('permitexpiredate');
            $query['Methnic'] = $ethnic_ = $this->input->post('ethnic');
            $query['Maddress'] = $address_ = $this->input->post('address');
            $query['Mcity'] = $city_ = $this->input->post('city');
            $query['Mcitydes'] = $citydes_ = $this->input->post('i_citydes');
            $query['Msubdistrict'] = $subdistrict_ = $this->input->post('subdistrict');
            $query['Msubdistrictdes'] = $subdistrictdes_ = $this->input->post('i_subdistrictdes');
            $query['Mdistrict'] = $district_ = $this->input->post('district');
            $query['Mdistrictdes'] = $districtdes_ = $this->input->post('i_districtdes');
            $query['Mregion'] = $region_ = $this->input->post('region');
            $query['Mregiondes'] = $regiondes_ = $this->input->post('i_regiondes');
            $query['Mprovince'] = $province_ = $this->input->post('province');
            $query['Mprovincedes'] = $provincedes_ = $this->input->post('i_provincedes');
            $query['Mcountry'] = $country_ = $this->input->post('country');
            $query['Mcountrydes'] = $countrydes_ = $this->input->post('i_countrydes');
            $query['Mpostcode'] = $postcode_ = $this->input->post('postcode');
            $query['Mbloodtype'] = $bloodtype_ = $this->input->post('bloodtype');
            $query['Mheight'] = $height_ = $this->input->post('height');
            $query['Mweight'] = $weight_ = $this->input->post('weight');
            $query['Mmedication'] = $medication_ = $this->input->post('medication');
            $query['Mallergie'] = $allergies = $this->input->post('allergies');
            $query['Mchronicmedicalhistory'] = $chronicmedicalhistory_ = $this->input->post('chronicmedicalhistory');
            $query['Midentityno'] = $identityno_ = $this->input->post('identityno');
            $query['Midentityexpire'] = $identityexpire_ = $this->input->post('identityexpire');
            $query['Mpersonalid'] = $personalid_ = $this->input->post('personalid');

            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
            // $this->ddoo_upload('photo');
            // $photo = $_FILES['photo']['name'];
            $photo = $this->upload_image_reg('photo');
            }else{
                $photo = "";
            }
            if(isset($_FILES['identity']) && $_FILES['identity']['name'] != ''){
                // $this->ddoo_upload('identity');
                // $identity = $_FILES['identity']['name'];
                $identity = $this->upload_image_reg('identity');
            }else{
                $identity = "";
            }

            //Job Information
            $query['Mpositionno'] = $positionno_ = $this->input->post('positionno');
            $query['Mapplicantno'] = $applicantno_ = $this->input->post('applicantno');
            $query['Midnoref'] = $idnoref_ = $this->input->post('idnoref');
            $query['Mempcompany'] = $empcompany_ = $this->input->post('empcompany');
            $query['Mempcompanydes'] = $empcompanydes_ = $this->input->post('i_empcompany_des');
            $query['Mcompany'] = $company_ = $this->input->post('company');
            $query['Mcompanydes'] = $companydes_ = $this->input->post('i_company_des');
            $query['Mbranch'] = $branch_ = $this->input->post('branch');
            $query['Mbranchdes'] = $branchdes_ = $this->input->post('i_branchdes');
            $query['Mdeptcode'] = $deptcode_ = $this->input->post('deptcode');
            $query['Mdeptcodedes'] = $deptdes_ = $this->input->post('i_deptdes');
            $query['Mbucode'] = $bucode_ = $this->input->post('i_bucode');
            $query['Mbudes'] = $budes_ = $this->input->post('i_budes');
            $query['Mdivcode'] = $divcode_ = $this->input->post('i_divcode');
            $query['Mdivdes'] = $divdes_ = $this->input->post('i_divdes');
            $query['Mcostcenter'] = $costcenter_ = $this->input->post('costcenter');
            $query['Mcostcenterdes'] = $costcenterdes_ = $this->input->post('i_costdes');
            $query['Memployeeclass'] = $employeeclass_ = $this->input->post('employeeclass');
            $query['Memployeeclassdes'] = $employeeclassdes_ = $this->input->post('i_employeeclassdes');
            $query['Memployeetype'] = $employeetype_ = $this->input->post('employeetype');
            $query['Memployeetypedes'] = $employeetypedes_ = $this->input->post('i_employeetypedes');
            $query['Memploymenttype'] = $employmenttype_ = $this->input->post('employmenttype');
            $query['Memploymenttypedes'] = $employmenttypedes_ = $this->input->post('i_employmenttypedes');
            $query['Monsitelocation'] = $onsitelocation_ = $this->input->post('onsitelocation');
            $query['Mworklocation'] = $worklocation_ = $this->input->post('worklocation');
            $query['Msupervisor'] = $supervisor_ = $this->input->post('supervisor');
            $query['Msupervisordes'] = $supervisordes_ = $this->input->post('i_sup_des');
            $query['Msupervisortitle'] = $supervisortitle_ = $this->input->post('i_sup_title_code');
            $query['Msupervisortitledes'] = $supervisortitledes_ = $this->input->post('i_sup_title_des');
            $query['Monsiteaddress'] = $onsiteaddress_ = $this->input->post('onsiteaddress');
            $query['Monsitecity'] = $onsitecity_ = $this->input->post('onsitecity');
            $query['Monsitecitydes'] = $onsitecitydes_ = $this->input->post('i_ocitydes');
            $query['Monsitesubdistrict'] = $onsitesubdistrict_ = $this->input->post('onsitesubdistrict');
            $query['Monsitesubdistrictdes'] = $onsitesubdistrictdes_ = $this->input->post('i_osubdistrictdes');
            $query['Monsitedistrict'] = $onsitedistrict_ = $this->input->post('onsitedistrict');
            $query['Monsitedistrictdes'] = $onsitedistrictdes_ = $this->input->post('i_odistrictdes');
            $query['Monsiteregion'] = $onsiteregion_ = $this->input->post('onsiteregion');
            $query['Monsiteregiondes'] = $onsiteregiondes_ = $this->input->post('i_oregiondes');
            $query['Monsiteprovince'] = $onsiteprovince_ = $this->input->post('onsiteprovince');
            $query['Monsiteprovincedes'] = $onsiteprovincedes_ = $this->input->post('i_oprovincedes');
            $query['Monsitecountry'] = $onsitecountry_ = $this->input->post('onsitecountry');
            $query['Monsitecountrydes'] = $onsitecountrydes_ = $this->input->post('i_ocountrydes');
            $query['Monsitepostcode'] = $onsitepostcode_ = $this->input->post('onsitepostcode');
            $query['Mindividualgrade'] = $individualgrade_ = $this->input->post('individualgrade');
            $query['Mindividualgradedes'] = $individualgradedes_ = $this->input->post('i_individualgradedes');
            $query['Mindividuallevelcode'] = $individuallevelcode_ = $this->input->post('i_individuallevelcode');
            $query['Mindividuallevel'] = $individuallevel_ = $this->input->post('individuallevel');
            $query['Mindividualleveldes'] = $individualleveldes_ = $this->input->post('i_individualleveldes');
            $query['Mindividuallevelmgttype'] = $individuallevelmgttype_ = $this->input->post('i_managementtype');
            $query['Mindividuallevelmgtgroup'] = $individuallevelmgtgroup_ = $this->input->post('i_managementgroup');
            $query['Mjobgrade'] = $jobgrade_ = $this->input->post('jobgrade');
            $query['Mjobgradedes'] = $jobgradedes_ = $this->input->post('i_jobgradedes');
            $query['Mjoblevelcode'] = $joblevelcode_ = $this->input->post('i_joblevelcode');
            $query['Mjoblevel'] = $joblevel_ = $this->input->post('joblevel');
            $query['Mjobleveldes'] = $jobleveldes_ = $this->input->post('i_jobleveldes');
            $query['Mjobleveltype'] = $jobleveltype_ = $this->input->post('i_joblevelmgttype');
            $query['Mjoblevelgroup'] = $joblevelgroup_ = $this->input->post('i_joblevelmgtgroup');
            $query['Mjobtitle'] = $jobtitle_ = $this->input->post('jobtitle');
            $query['Mjobtitledes'] = $jobtitledes_ = $this->input->post('i_jobtitle');
            $query['Mjobpoint'] = $jobpoint_ = $this->input->post('jobpoint');
            $query['Mjobpointdes'] = $jobpointdes_ = $this->input->post('i_jobpointdes');
            $query['Mjobratepoint'] = $jobratepoint_ = $this->input->post('i_jobratepoint');
            $query['Mjobamountpoint'] = $jobamountpoint_ = $this->input->post('i_jobamountpoint');
            $query['Mpositiontitle'] = $positiontitle_ = $this->input->post('positiontitle');
            $query['Mpositiontitledes'] = $positiontitledes_ = $this->input->post('i_positiontitle');
            $query['Mradio'] = $radio_ = $this->input->post('radio');
            $query['Mofficecode'] = $officecode_ = $this->input->post('officecode');
            $query['Mlastpromotion'] = $lastpromotion_ = $this->input->post('lastpromotion');
            // $query['Moriginalpointofhire'] = $originalpointofhire_ = $this->input->post('originalpointofhire');
            $query['Mpointofhire'] = $pointofhire_ = $this->input->post('pointofhire');
            // $query['Moriginalhiredate'] = $originalhiredate_ = $this->input->post('originalhiredate');
            $query['Mhiredate'] = $hiredate_ = $this->input->post('hiredate');
            // $query['Mrehiredate'] = $rehiredate_ = $this->input->post('rehiredate');
            $query['Mservicedate'] = $servicedate_ = $this->input->post('servicedate');
            // $query['Moriginalpointofleave'] = $originalpointofleave_ = $this->input->post('originalpointofleave');
            $query['Mpointofleave'] = $pointofleave_ = $this->input->post('pointofleave');
            // $query['Moriginalpointoftravel'] = $originalpointoftravel_ = $this->input->post('originalpointoftravel');
            $query['Mpointoftravel'] = $pointoftravel_ = $this->input->post('pointoftravel');
            $query['Mpaygroup'] = $paygroup_ = $this->input->post('paygroup');
            $query['Mbenefitcode'] = $benefitcode_ = $this->input->post('benefitcode');
            $query['Munioncode'] = $unioncode_ = $this->input->post('unioncode');
            $query['Mtaxcode'] = $taxcode_ = $this->input->post('taxcode');
            $query['Mworkday'] = $workday_ = $this->input->post('workday');
            $query['Mworkdaydes'] = $workdaydes_ = $this->input->post('i_workdaydes');
            $query['Mcontractno'] = $contractno_ = $this->input->post('contractno');
            $query['Mcontractdate'] = $contractdate_ = $this->input->post('contractdate');
            $query['Mcontractexpire'] = $contractexpire_ = $this->input->post('contractexpire');
            $query['Mterminationdate'] = $terminationdate_ = $this->input->post('terminationdate');
            $query['Mterminationreason'] = $terminationreason_ = $this->input->post('terminationreason');
            $query['Mstatus'] = $status_ = $this->input->post('status');
            $query['Mstatusdate'] = $statusdate_ = $this->input->post('statusdate');
            $query['Mworkfunction'] = $workfunction_ = $this->input->post('workfunction');
            $query['Mworkfunctiondes'] = $workfunctiondes_ = $this->input->post('i_workfunctiondes');
            $query['Mwgroup'] = $wgroup_ = $this->input->post('i_wgroup');
            $query['Mwgroupdes'] = $wgroupdes_ = $this->input->post('i_wgroupdes');
            $query['Mcrew'] = $crew_ = $this->input->post('crew');
            $query['Mcrewdes'] = $crewdes_ = $this->input->post('i_workgroup');
            $query['Monsitemarital'] = $onsitemarital_ = $this->input->post('onsitemarital');
            $query['Monsitemaritaldes'] = $onsitemaritaldes_ = $this->input->post('i_onsitemaritaldes');
            $query['Mmaritalbenefit'] = $maritalbenefit_ = $this->input->post('maritalbenefit');
            $query['Mmaritalbenefitdes'] = $maritalbenefitdes_ = $this->input->post('i_maritalbenefitdes');
            $query['Mprobationdate'] = $probationdate_ = $this->input->post('probationdate');
            $query['Mworkphone'] = $workphone_ = $this->input->post('workphone');
            $query['Mmobile1'] = $mobile1_ = $this->input->post('mobile1');
            $query['Mmobile2'] = $mobile2_ = $this->input->post('mobile2');
            $query['Mphone'] = $phone_ = $this->input->post('phone');
            $query['Mwa'] = $wa_ = $this->input->post('wa');
            $query['Memailcompany'] = $emailcompany_ = $this->input->post('emailcompany');
            $query['Memailpersonal'] = $emailpersonal_ = $this->input->post('emailpersonal');
            $query['Mworkinsurance'] = $workinsurance_ = $this->input->post('workinsurance');
            $query['Mmedicalinsurance'] = $medicalinsurance_ = $this->input->post('medicalinsurance');
            $query['Mleavetype'] = $leavetype_ = $this->input->post('leavetype');
            $query['Mleavetypedes'] = $leavetypedes_ = $this->input->post('i_leavetypedes');
            $query['Mbankaccount1'] = $bankaccount1_ = $this->input->post('bankaccount1');
            $query['Mbankaccount2'] = $bankaccount2_ = $this->input->post('bankaccount2');
            $query['Muniformtshirt'] = $uniformtshirt_ = $this->input->post('uniformtshirt');
            $query['Muniformpants'] = $uniformpants_ = $this->input->post('uniformpants');
            $query['Mshoes'] = $shoes_ = $this->input->post('shoes');
            $query['Mglasses'] = $glasses_ = $this->input->post('glasses');
           
            //Dependent
            $query['Middep'] = $iddep_ = $this->input->post('iddep');
            $query['Mrelationshipdep'] = $relationshipdep_ = $this->input->post('relationshipdep');
            $query['Mfullnamedep'] = $fullnamedep_ = $this->input->post('fullnamedep');
            $query['Mgenderdep'] = $genderdep_ = $this->input->post('genderdep');
            $query['Mmaritalstatusdep'] = $maritalstatusdep_ = $this->input->post('maritalstatusdep');
            $query['Mpointofbirthdep'] = $pointofbirthdep_ = $this->input->post('placeofbirthdep');
            $query['Mdateofbirthdep'] = $dateofbirthdep_ = $this->input->post('dateofbirthdep');
            $query['Mreligiondep'] = $religiondep_ = $this->input->post('religiondep');
            $query['Mnationalitydep'] = $nationalitydep_ = $this->input->post('nationalitydep');
            $query['Methnicdep'] = $ethnicdep_ = $this->input->post('ethnicdep');
            $query['Maddressdep'] = $addressdep_ = $this->input->post('addressdep');
            $query['Mcitydep'] = $citydep_ = $this->input->post('citydep');
            $query['Mcitydepdes'] = $citydepdes_ = $this->input->post('i_citydepdes');
            $query['Msubdistrictdep'] = $subdistrictdep_ = $this->input->post('subdistrictdep');
            $query['Msubdistrictdepdes'] = $subdistrictdepdes_ = $this->input->post('i_subdistrictdepdes');
            $query['Mdistrictdep'] = $districtdep_ = $this->input->post('districtdep');
            $query['Mdistrictdepdes'] = $districtdepdes_ = $this->input->post('i_districtdepdes');
            $query['Mregiondep'] = $regiondep_ = $this->input->post('regiondep');
            $query['Mregiondepdes'] = $regiondepdes_ = $this->input->post('i_regiondepdes');
            $query['Mprovincedep'] = $provincedep_ = $this->input->post('provincedep');
            $query['Mprovincedepdes'] = $provincedepdes_ = $this->input->post('i_provincedepdes');
            $query['Mcountrydep'] = $countrydep_ = $this->input->post('countrydep');
            $query['Mcountrydepdes'] = $countrydepdes_ = $this->input->post('i_countrydepdes');
            $query['Mpostcodedep'] = $postcodedep_ = $this->input->post('postcodedep');
            $query['Mbloodtypedep'] = $bloodtypedep_ = $this->input->post('bloodtypedep');
            $query['Mdateofdeathdep'] = $dateofdeathdep_ = $this->input->post('dateofdeathdep');
            $query['Mbenefittypedep'] = $benefittypedep_ = $this->input->post('benefittypedep');
            $query['Mphonedep'] = $phonedep_ = $this->input->post('phonedep');
            $query['Mmobiledep'] = $mobiledep_ = $this->input->post('mobiledep');
            $query['Mwadep'] = $wadep_ = $this->input->post('wadep');
            $query['Memaildep'] = $emaildep_ = $this->input->post('emaildep');

            if(isset($_FILES['photodep']) && $_FILES['photodep']['name'] != ''){
                // $this->ddoo_upload('photodep');
                // $photodep = $_FILES['photodep']['name'];
                $photodep = $this->upload_image_reg('photodep');
            }else{
                $photodep = "";
            }

            //Kin
            $query['Midnumberkin'] = $idnumberkin_ = $this->input->post('idnumberkin');
            $query['Mrelationshipkin'] = $relationshipkin_ = $this->input->post('relationshipkin');
            $query['Mfullnamekin'] = $fullnamekin_ = $this->input->post('fullnamekin');
            $query['Maddresskin'] = $addresskin_ = $this->input->post('addresskin');
            $query['Mcitykin'] = $citykin_ = $this->input->post('citykin');
            $query['Mcitykindes'] = $citykindes_ = $this->input->post('i_citykindes');
            $query['Msubdistrictkin'] = $subdistrictkin_ = $this->input->post('subdistrictkin');
            $query['Msubdistrictkindes'] = $subdistrictkindes_ = $this->input->post('i_subdistrictkindes');
            $query['Mdistrictkin'] = $districtkin_ = $this->input->post('districtkin');
            $query['Mdistrictkindes'] = $districtkindes_ = $this->input->post('i_districtkindes');
            $query['Mregionkin'] = $regionkin_ = $this->input->post('regionkin');
            $query['Mregionkindes'] = $regionkindes_ = $this->input->post('i_regionkindes');
            $query['Mprovincekin'] = $provincekin_ = $this->input->post('provincekin');
            $query['Mprovincekindes'] = $provincekindes_ = $this->input->post('i_provincekindes');
            $query['Mcountrykin'] = $countrykin_ = $this->input->post('countrykin');
            $query['Mcountrykindes'] = $countrykindes_ = $this->input->post('i_countrykindes');
            $query['Mpostcodekin'] = $postcodekin_ = $this->input->post('postcodekin');
            $query['Mmobilekin'] = $mobilekin_ = $this->input->post('mobilekin');
            $query['Mphonekin'] = $phonekin_ = $this->input->post('phonekin');
            $query['Mworkphonekin'] = $workphonekin_ = $this->input->post('workphonekin');
            $query['Mwakin'] = $wakin_ = $this->input->post('wakin');
            $query['Memailkin'] = $emailkin_ = $this->input->post('emailkin');
            
            $datas['cek'] = $this->M_humanresource->cek_idnumber($idnumber_);
            if ($datas['cek'] != true) {
                $personaldata = array(
                    'IDNumber' =>$idnumber_,
                    'IDNumberIdentifier' =>$idnumberidentifier_,
                    'FirstName' => $firstname_,
                    'MiddleName' =>$middlename_,
                    'LastName' =>$lastname_,
                    'NickName' =>$nickname_,
                    'FullName' =>$fullname_,
                    'Gender' =>$gender_,
                    'DateofBirth' =>$dateofbirth_,
                    'PointofBirth' =>$pointofbirth_,
                    'MaritalStatus' =>$maritalstatus_,
                    'Religion' =>$religion_,
                    'Nationality' =>$nationality_,
                    'ForeignPermitNo' =>$foreignpermitno_,
                    'PermitExpireDate' => $permitexpiredate_,
                    'Ethnic' =>$ethnic_,
                    'Address' =>$address_,
                    'City' =>$city_,
                    'SubDistrict' =>$subdistrict_,
                    'District' =>$district_,
                    'Region' =>$region_,
                    'Province' =>$province_,
                    'Country' =>$country_,
                    'PostCode' =>$postcode_,
                    'BloodType' =>$bloodtype_,
                    'Height' =>$height_,
                    'Weight' =>$weight_,
                    'Medication' =>$medication_,
                    'Allergies' =>$allergies,
                    'ChronicMedicalHistory' =>$chronicmedicalhistory_,
                    'Identity' =>$identity,
                    'IdentityNo' =>$identityno_,
                    'IdentityExpire' =>$identityexpire_,
                    'Photo' =>$photo,
                    'PersonalID' =>$personalid_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_data', $personaldata);

                $jobinformation = array(
                    'IDNumber' =>$idnumber_,
                    'PositionNo' =>$positionno_,
                    'ApplicantNo' => $applicantno_,
                    'IDNoRef' =>$idnoref_,
                    'EmpCompany' =>$empcompany_,
                    'Company' =>$company_,
                    'Branch' =>$branch_,
                    'DeptCode' =>$deptcode_,
                    'CostCenter' =>$costcenter_,
                    'EmployeeClass' =>$employeeclass_,
                    'EmployeeType' =>$employeetype_,
                    'EmploymentType' =>$employmenttype_,
                    'OnsiteLocation' =>$onsitelocation_,
                    'WorkLocation' =>$worklocation_,
                    'Supervisor' => $supervisor_,
                    'OnsiteAddress' =>$onsiteaddress_,
                    'OnsiteCity' =>$onsitecity_,
                    'OnsiteSubDistrict' =>$onsitesubdistrict_,
                    'OnsiteDistrict' =>$onsitedistrict_,
                    'OnsiteRegion' =>$onsiteregion_,
                    'OnsiteProvince' =>$onsiteprovince_,
                    'OnsiteCountry' =>$onsitecountry_,
                    'JobTitle' =>$jobtitle_,
                    'JobLevel' =>$joblevelcode_,
                    'JobPoint' =>$jobpoint_,
                    'JobGrade' =>$jobgrade_,
                    'PositionTitle' =>$positiontitle_,
                    'OnsitePostCode' =>$onsitepostcode_,
                    'IndividualGrade' =>$individualgrade_,
                    'IndividualLevel' =>$individuallevelcode_,
                    'Radio' =>$radio_,
                    'OfficeCode' =>$officecode_,
                    'LastPromotion' =>$lastpromotion_,
                    // 'OriginalPointofHire' =>$originalpointofhire_,
                    'PointofHire' =>$pointofhire_,
                    // 'OriginalHireDate' =>$originalhiredate_,
                    'HireDate' =>$hiredate_,
                    // 'ReHireDate' =>$rehiredate_,
                    'ServiceDate' =>$servicedate_,
                    // 'OriginalPointofLeave' =>$originalpointofleave_,
                    'PointofLeave' =>$pointofleave_,
                    // 'OriginalPointofTravel' =>$originalpointoftravel_,
                    'PointofTravel' =>$pointoftravel_,
                    'Paygroup' =>$paygroup_,
                    'BenefitCode' =>$benefitcode_,
                    'UnionCode' =>$unioncode_,
                    'TaxCode' =>$taxcode_,
                    'WorkDay' =>$workday_,
                    'Status' =>'Active',
                    'StatusDate' => date('Y-m-d'),
                    'WorkFunction' =>$workfunction_,
                    'Crew' =>$crew_,
                    'OnsiteMarital' =>$onsitemarital_,
                    'MaritalBenefit' =>$maritalbenefit_,
                    'ProbationDate' =>$probationdate_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                    'Mobile2' =>$mobile2_,
                    'Phone' =>$phone_,
                    'WA' =>$wa_,
                    'EmailCompany' =>$emailcompany_,
                    'EmailPersonal' =>$emailpersonal_,
                    'WorkInsurance' =>$workinsurance_,
                    'MedicalInsurance' =>$medicalinsurance_,
                    'LeaveType' =>$leavetype_,
                    'BankAccount1' =>$bankaccount1_,
                    'BankAccount2' =>$bankaccount2_,
                    'UniformTshirt' =>$uniformtshirt_,
                    'UniformPants' =>$uniformpants_,
                    'Shoes' =>$shoes_,
                    'Glasses' =>$glasses_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job', $jobinformation);

                $employeeappend = array(
                    'IDNumber' =>$idnumber_,
                    'IDNumberIdentifier' =>$idnumberidentifier_,
                    'FirstName' => $firstname_,
                    'MiddleName' =>$middlename_,
                    'LastName' =>$lastname_,
                    'NickName' =>$nickname_,
                    'FullName' =>$fullname_,
                    'Gender' =>$gender_,
                    'DateofBirth' =>$dateofbirth_,
                    'PointofBirth' =>$pointofbirth_,
                    'MaritalStatus' =>$maritalstatus_,
                    'MaritalStatusDes' =>$maritalstatusdes_,
                    'Religion' =>$religion_,
                    'Nationality' =>$nationality_,
                    'NationalityDes' =>$nationalitydes_,
                    'ForeignPermitNo' =>$foreignpermitno_,
                    'PermitExpireDate' => $permitexpiredate_,
                    'Ethnic' =>$ethnic_,
                    'Address' =>$address_,
                    'CityCode' =>$city_,
                    'CityDes' =>$citydes_,
                    'SubDistrictCode' =>$subdistrict_,
                    'SubDistrictDes' =>$subdistrictdes_,
                    'DistrictCode' =>$district_,
                    'DistrictDes' =>$districtdes_,
                    'RegionCode' =>$region_,
                    'RegionDes' =>$regiondes_,
                    'ProvinceCode' =>$province_,
                    'ProvinceDes' =>$provincedes_,
                    'CountryCode' =>$country_,
                    'CountryDes' =>$countrydes_,
                    'PostCode' =>$postcode_,
                    'BloodType' =>$bloodtype_,
                    'Height' =>$height_,
                    'Weight' =>$weight_,
                    'Medication' =>$medication_,
                    'Allergies' =>$allergies,
                    'ChronicMedicalHistory' =>$chronicmedicalhistory_,
                    'Identity' =>$identity,
                    'IdentityNo' =>$identityno_,
                    'IdentityExpire' =>$identityexpire_,
                    'Photo' =>$photo,
                    'PersonalID' =>$personalid_,

                    'PositionNo' =>$positionno_,
                    'ApplicantNo' => $applicantno_,
                    'IDNoRef' =>$idnoref_,
                    'EmpCompany' =>$empcompany_,
                    'EmpCompanyDes' =>$empcompanydes_,
                    'Company' =>$company_,
                    'ComDes' =>$companydes_,
                    'Branch' =>$branch_,
                    'BranchDes' =>$branchdes_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'BusinessUnit' =>$bucode_,
                    'BUDes' =>$budes_,
                    'DivCode' =>$divcode_,
                    'DivisionName' =>$divdes_,
                    'CostCenter' =>$costcenter_,
                    'CostCenterDes' =>$costcenterdes_,
                    'EmployeeClass' =>$employeeclass_,
                    'EmployeeClassDes' =>$employeeclassdes_,
                    'EmployeeType' =>$employeetype_,
                    'EmployeeTypeDes' =>$employeetypedes_,
                    'EmploymentType' =>$employmenttype_,
                    'EmploymentTypeDes' =>$employmenttypedes_,
                    'OnsiteLocation' =>$onsitelocation_,
                    'WorkLocation' =>$worklocation_,
                    'Supervisor' => $supervisor_,
                    'SupervisorName' => $supervisordes_,
                    'SupervisorTitle' => $supervisortitle_,
                    'SupervisorTitleDes' => $supervisortitledes_,
                    'OnsiteAddress' =>$onsiteaddress_,
                    'OnsiteCity' =>$onsitecity_,
                    'OnsiteCityDes' =>$onsitecitydes_,
                    'OnsiteSubDistrict' =>$onsitesubdistrict_,
                    'OnsiteSubDistrictDes' =>$onsitesubdistrictdes_,
                    'OnsiteDistrict' =>$onsitedistrict_,
                    'OnsiteDistrictDes' =>$onsitedistrictdes_,
                    'OnsiteRegion' =>$onsiteregion_,
                    'OnsiteRegionDes' =>$onsiteregiondes_,
                    'OnsiteProvince' =>$onsiteprovince_,
                    'OnsiteProvinceDes' =>$onsiteprovincedes_,
                    'OnsiteCountry' =>$onsitecountry_,
                    'OnsiteCountryDes' =>$onsitecountrydes_,
                    'OnsitePostCode' =>$onsitepostcode_,
                    'IndividualGrade' =>$individualgrade_,
                    'IndividualGradeDes' =>$individualgradedes_,
                    'IndividualLevelCode' =>$individuallevelcode_,
                    'IndividualLevel' =>$individuallevel_,
                    'IndividualLevelDes' =>$individualleveldes_,
                    'IndividualLevelMgtType' =>$individuallevelmgttype_,
                    'IndividualLevelMgtGroup' =>$individuallevelmgtgroup_,
                    'JobGrade' =>$jobgrade_,
                    'JobGradeDes' =>$jobgradedes_,
                    'JobLevelCode' =>$joblevelcode_,
                    'JobLevel' =>$joblevel_,
                    'JobLevelDes' =>$jobleveldes_,
                    'JobLevelMgtType' =>$jobleveltype_,
                    'JobLevelMgtGroup' =>$joblevelgroup_,
                    'JobTitle' =>$jobtitle_,
                    'JobTitleDes' =>$jobtitledes_,
                    'JobPoint' =>$jobpoint_,
                    'JobPointDes' =>$jobpointdes_,
                    'JobRatePoint' =>$jobratepoint_,
                    'JobAmountPoint' =>$jobamountpoint_,
                    'PositionTitle' =>$positiontitle_,
                    'PositionTitleDes' =>$positiontitledes_,
                    'Radio' =>$radio_,
                    'OfficeCode' =>$officecode_,
                    'LastPromotion' =>$lastpromotion_,
                    // 'OriginalPointofHire' =>$originalpointofhire_,
                    'PointofHire' =>$pointofhire_,
                    // 'OriginalHireDate' =>$originalhiredate_,
                    'HireDate' =>$hiredate_,
                    // 'ReHireDate' =>$rehiredate_,
                    'ServiceDate' =>$servicedate_,
                    // 'OriginalPointofLeave' =>$originalpointofleave_,
                    'PointofLeave' =>$pointofleave_,
                    // 'OriginalPointofTravel' =>$originalpointoftravel_,
                    'PointofTravel' =>$pointoftravel_,
                    'Paygroup' =>$paygroup_,
                    'BenefitCode' =>$benefitcode_,
                    'UnionCode' =>$unioncode_,
                    'TaxCode' =>$taxcode_,
                    'WorkDay' =>$workday_,
                    'WorkDayDes' =>$workdaydes_,
                    'Status' =>'Active',
                    'StatusDate' => date('Y-m-d'),
                    'WorkFunction' =>$workfunction_,
                    'WorkFunctionDes' =>$workfunctiondes_,
                    'WorkFunctionGroup' =>$wgroup_,
                    'WorkFunctionGroupDes' =>$wgroupdes_,
                    'Crew' =>$crew_,
                    'CrewDes' =>$crewdes_,
                    'OnsiteMarital' =>$onsitemarital_,
                    'OnsiteMaritalDes' =>$onsitemaritaldes_,
                    'MaritalBenefit' =>$maritalbenefit_,
                    'MaritalBenefitDes' =>$maritalbenefitdes_,
                    'ProbationDate' =>$probationdate_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                    'Mobile2' =>$mobile2_,
                    'Phone' =>$phone_,
                    'WA' =>$wa_,
                    'EmailCompany' =>$emailcompany_,
                    'EmailPersonal' =>$emailpersonal_,
                    'WorkInsurance' =>$workinsurance_,
                    'MedicalInsurance' =>$medicalinsurance_,
                    'LeaveType' =>$leavetype_,
                    'LeaveTypeDes' =>$leavetypedes_,
                    'BankAccount1' =>$bankaccount1_,
                    'BankAccount2' =>$bankaccount2_,
                    'UniformTshirt' =>$uniformtshirt_,
                    'UniformPants' =>$uniformpants_,
                    'Shoes' =>$shoes_,
                    'Glasses' =>$glasses_,

                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_hr_append', $employeeappend);

                $datacom=array(
                    'IDNumber' =>$idnumber_,
                    'Company' =>$company_,
                    'CompanyDes' =>$companydes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_com', $datacom);

                $databranch = array(
                    'IDNumber' =>$idnumber_,
                    'Branch' =>$branch_,
                    'BranchDes' =>$branchdes_,
                    'Company' =>$company_,
                    'CompanyDes' => $companydes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_branch', $databranch);

                $datadepartment = array(
                    'IDNumber' =>$idnumber_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'BuCode' => $bucode_,
                    'BuDes' => $budes_,
                    'DivCode' => $divcode_,
                    'DivDes' => $divdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_dept', $datadepartment);

                $datacostcenter = array(
                    'IDNumber' =>$idnumber_,
                    'CostCenterCode' =>$costcenter_,
                    'CostCenterDes' =>$costcenterdes_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_costcenter', $datacostcenter);

                $datacontact=array(
                    'IDNumber' =>$idnumber_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                    'Mobile2' =>$mobile2_,
                    'Phone' =>$phone_,
                    'WA' =>$wa_,
                    'EmailCompany' =>$emailcompany_,
                    'EmailPersonal' =>$emailpersonal_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_contact', $datacontact);

                $datacrew=array(
                    'IDNumber' =>$idnumber_,
                    'Crew' =>$crew_,
                    'CrewDes' =>$crewdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_crew', $datacrew);

                $dataemplevel=array(
                    'IDNumber' =>$idnumber_,
                    'EmployeeLevel' =>$individuallevelcode_,
                    'EmployeeLevelDes' =>$individualleveldes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_employeelevel', $dataemplevel);

                $dataemptype=array(
                    'IDNumber' =>$idnumber_,
                    'EmployeeType' =>$employeetype_,
                    'EmployeeTypeDes' =>$employeetypedes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_employeetype', $dataemptype);

                $dataemploymenttype=array(
                    'IDNumber' =>$idnumber_,
                    'EmploymentType' =>$employmenttype_,
                    'EmploymentTypeDes' =>$employmenttypedes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_employmenttype', $dataemploymenttype);

                $datahiredate=array(
                    'IDNumber' =>$idnumber_,
                    'HireDate' =>$hiredate_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_hiredate', $datahiredate);

                $dataworkinsurance=array(
                    'IDNumber' =>$idnumber_,
                    'InsuranceBPJS' =>$workinsurance_,
                    'InsuranceBPJSDes' =>'InsuranceBPJSDes',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_insurancebpjs', $dataworkinsurance);

                $datamedicalinsurance=array(
                    'IDNumber' =>$idnumber_,
                    'InsuranceMedical' =>$medicalinsurance_,
                    'InsuranceMedicalDes' =>'InsuranceMedicalDes',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_insurancemedical', $datamedicalinsurance);

                $dataposition=array(
                    'IDNumber' =>$idnumber_,
                    'JobPosition' =>$positiontitle_,
                    'JobPositionDes' =>$positiontitledes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_jobposition', $dataposition);

                $datajobtitle=array(
                    'IDNumber' =>$idnumber_,
                    'JobTitle' =>$jobtitle_,
                    'JobTitleDes' =>$jobtitledes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_jobtitle', $datajobtitle);

                $datajobworkfunction=array(
                    'IDNumber' =>$idnumber_,
                    'WorkFunction' =>$workfunction_,
                    'WorkFunctionDes' =>$workfunctiondes_,
                    'WorkGroup' =>$wgroup_,
                    'WorkGroupDes' =>$wgroupdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_jobworkfunction', $datajobworkfunction);

                $datalocation=array(
                    'IDNumber' =>$idnumber_,
                    'WorkLocation' =>$worklocation_,
                    'WorkLocationDes' =>'WorkLocationDes',
                    'Branch' =>$branch_,
                    'BranchDes' =>'BranchDes',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_location', $datalocation);

                $datamarital=array(
                    'IDNumber' =>$idnumber_,
                    'Marital' =>$maritalstatus_,
                    'MaritalDes' =>$maritalstatusdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_marital', $datamarital);

                $datamaritalbenefit=array(
                    'IDNumber' =>$idnumber_,
                    'MaritalBenefit' =>$maritalbenefit_,
                    'MaritalBenefitDes' =>$maritalbenefitdes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_maritalbenefit', $datamaritalbenefit);

                $dataonsitemarital=array(
                    'IDNumber' =>$idnumber_,
                    'OnsiteMarital' =>$onsitemarital_,
                    'OnsiteMaritalDes' =>$onsitemaritaldes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_onsitemarital', $dataonsitemarital);

                $datapointofhire=array(
                    'IDNumber' =>$idnumber_,
                    'PointOfHire' =>$pointofhire_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_pointofhire', $datapointofhire);

                $datapointofleave=array(
                    'IDNumber' =>$idnumber_,
                    'PointOfLeave' =>$pointofleave_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_pointofleave', $datapointofleave);

                $datapointoftravel=array(
                    'IDNumber' =>$idnumber_,
                    'PointOfTravel' =>$pointoftravel_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_pointoftravel', $datapointoftravel);

                $dataprobationdate=array(
                    'IDNumber' =>$idnumber_,
                    'ProbationDate' =>$probationdate_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_probationdate', $dataprobationdate);

                $dataleavetype=array(
                    'IDNumber' =>$idnumber_,
                    'LeaveType' =>$leavetype_,
                    'LeaveTypeDes' =>$leavetypedes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_leavetype', $dataleavetype);

                $dataservicedate=array(
                    'IDNumber' =>$idnumber_,
                    'ServiceDate' =>$servicedate_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_servicedate', $dataservicedate);

                $datasupervisor=array(
                    'IDNumber' =>$idnumber_,
                    'Supervisor' => $supervisor_,
                    'SupervisorName' => $supervisordes_,
                    'SupervisorTitle' => $supervisortitle_,
                    'SupervisorTitleDes' => $supervisortitledes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_supervisor', $datasupervisor);

                $dataworkday=array(
                    'IDNumber' =>$idnumber_,
                    'WorkDay' => $workday_,
                    'WorkDayDes' => $workdaydes_,
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_workday', $dataworkday);

                $datauniformtshirt=array(
                    'IDNumber' =>$idnumber_,
                    'UniformTshirt' =>$uniformtshirt_,
                    'UniformTshirtDes' =>'UniformTshirtDes',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_uniform_tshirt', $datauniformtshirt);

                $databankaccount1=array(
                    'IDNumber' =>$idnumber_,
                    'BankAccount1' =>$bankaccount1_,
                    'BankAccount1Des' =>'BankAccount1Des',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_bankaccount1', $databankaccount1);

                $databankaccount2=array(
                    'IDNumber' =>$idnumber_,
                    'BankAccount2' =>$bankaccount2_,
                    'BankAccount2Des' =>'BankAccount2Dess',
                    'RegBy' => $this->session->userdata('IDNumber'),
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_bankaccount2', $databankaccount2);

                $dataDep=array(
                      'IDNumber' =>$idnumber_,
                      'IDNumberDependent' =>$iddep_,
                      'FullName' =>$fullnamedep_,
                      'Relationship' =>$relationshipdep_,
                      'Gender' =>$genderdep_,
                      'MaritalStatus' =>$maritalstatusdep_,
                      'PlaceofBirth' =>$pointofbirthdep_,
                      'DateofBirth' =>$dateofbirthdep_,
                      'Religion' =>$religiondep_,
                      'Nationality' =>$nationalitydep_,
                      'Ethnic' =>$ethnicdep_,
                      'Address' =>$addressdep_,
                      'City' =>$citydep_,
                      'CityDes' =>$citydepdes_,
                      'SubDistrict' =>$subdistrictdep_,
                      'SubDistrictDes' =>$subdistrictdepdes_,
                      'District' =>$districtdep_,
                      'DistrictDes' =>$districtdepdes_,
                      'Region' =>$regiondep_,
                      'RegionDes' =>$regiondepdes_,
                      'Province' =>$provincedep_,
                      'ProvinceDes' =>$provincedepdes_,
                      'Country' =>$countrydep_,
                      'CountryDes' =>$countrydepdes_,
                      'PostCode' =>$postcodedep_,
                      'BloodType' =>$bloodtypedep_,
                      'DateofDeath' =>$dateofdeathdep_,
                      'BenefitType' =>$benefittypedep_,
                      'Phone' =>$phonedep_,
                      'Mobile' =>$mobiledep_,
                      'WA' =>$wadep_,
                      'Email' =>$emaildep_,
                      'DepPhoto' =>$photodep,
                      'RegBy' => $this->session->userdata('IDNumber'),
                      'RegDate' => date('Y-m-d')
                );    
                $this->M_humanresource->insert('tbl_emp_per_dep', $dataDep);

                $dataKin=array(
                      'IDNumber' =>$idnumber_,
                      'IDNumberKin' =>$idnumberkin_,
                      'FullName' =>$fullnamekin_,
                      'Relationship' =>$relationshipkin_,
                      'Address' =>$addresskin_,
                      'City' =>$citykin_,
                      'CityDes' =>$citykindes_,
                      'SubDistrict' =>$subdistrictkin_,
                      'SubDistrictDes' =>$subdistrictkindes_,
                      'District' =>$districtkin_,
                      'DistrictDes' =>$districtkindes_,
                      'Region' =>$regionkin_,
                      'RegionDes' =>$regionkindes_,
                      'Province' =>$provincekin_,
                      'ProvinceDes' =>$provincekindes_,
                      'Country' =>$countrykin_,
                      'CountryDes' =>$countrykindes_,
                      'PostCode' =>$postcodekin_,
                      'Mobile' =>$mobilekin_,
                      'Phone' =>$phonekin_,
                      'WorkPhone' =>$workphonekin_,
                      'WA' =>$wakin_,
                      'Email' =>$emailkin_,
                      'RegBy' => $this->session->userdata('IDNumber'),
                      'RegDate' => date('Y-m-d')
                );    
                $this->M_humanresource->insert('tbl_emp_data_kin', $dataKin);
                $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                    redirect('Humanresource/view_new_data_personal');  
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_new_data_personal');
            }              
        }
    }

    function view_edit_data_personal($id) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Edit Personal';
        $query['headertitle'] = 'Edit Personal';
        $query['personal'] = $this->M_humanresource->get_data_personaldata($id);

        //Jobinformation Select Dropdown
        $query['get_ethnic'] = $this->M_humanresource->get_data_ethnic();
        $query['get_marital'] = $this->M_humanresource->get_data_marital();
        $query['get_marital_his'] = $this->M_humanresource->get_data_marital_history($id);
        $query['get_employeeclass'] = $this->M_humanresource->get_data_employeeclass();
        $query['get_employeetype'] = $this->M_humanresource->get_data_employeetype();
        $query['get_employeetype_his'] = $this->M_humanresource->get_data_employeetype_history($id);
        $query['get_employmenttype'] = $this->M_humanresource->get_data_employmenttype();
        $query['get_employmenttype_his'] = $this->M_humanresource->get_data_employmenttype_history($id);
        $query['get_title'] = $this->M_humanresource->get_data_title();
        $query['get_jobtitle_his'] = $this->M_humanresource->get_data_jobtitle_history($id);
        $query['get_position_his'] = $this->M_humanresource->get_data_position_history($id);
        $query['get_point'] = $this->M_humanresource->get_data_point();
        // $query['get_grade'] = $this->M_humanresource->get_all_data_structure_grade();
        // $query['get_grade_level_his'] = $this->M_humanresource->get_data_grade_level_history($id);
        $query['get_grade'] = $this->M_humanresource->get_all_data_structure_grade();
        $query['get_grade_level_his'] = $this->M_humanresource->get_data_grade_level_history($id);
        $query['get_level'] = $this->M_humanresource->get_data_level();
        $query['get_workfunction'] = $this->M_humanresource->get_data_workfunction();
        $query['get_workfunction_his'] = $this->M_humanresource->get_data_workfunction_history($id);
        $query['get_workgroup'] = $this->M_humanresource->get_data_workgroup();
        $query['get_workgroup_his'] = $this->M_humanresource->get_data_workgroup_history($id);
        $query['get_onsitemarital'] = $this->M_humanresource->get_data_onsitemarital();
        $query['get_onsitemarital_his'] = $this->M_humanresource->get_data_onsitemarital_history($id);
        $query['get_maritalbenefit'] = $this->M_humanresource->get_data_maritalbenefit();
        $query['get_maritalbenefit_his'] = $this->M_humanresource->get_data_maritalbenefit_history($id);
        $query['get_probationdate_his'] = $this->M_humanresource->get_data_probationdate_history($id);
        $query['get_hire_his'] = $this->M_humanresource->get_data_hiredate_history($id);
        $query['get_service_his'] = $this->M_humanresource->get_data_servicedate_history($id);
        $query['get_pointofhire_his'] = $this->M_humanresource->get_data_pointofhire_history($id);
        $query['get_pointofleave_his'] = $this->M_humanresource->get_data_pointofleave_history($id);
        $query['get_pointoftravel_his'] = $this->M_humanresource->get_data_pointoftravel_history($id);
        $query['get_worklocation_his'] = $this->M_humanresource->get_data_worklocation_history($id);
        $query['get_supervisor'] = $this->M_humanresource->get_data_supervisor();
        $query['get_supervisor_his'] = $this->M_humanresource->get_data_supervisor_history($id);
        $query['get_workinsurance_his'] = $this->M_humanresource->get_data_workinsurance_history($id);
        $query['get_medicalinsurance_his'] = $this->M_humanresource->get_data_medicalinsurance_history($id);
        $query['get_workday'] = $this->M_humanresource->get_data_workday();
        $query['get_workday_his'] = $this->M_humanresource->get_data_workday_history($id);
        $query['get_leavetype'] = $this->M_humanresource->get_data_leavetype();
        $query['get_leavetype_his'] = $this->M_humanresource->get_data_leavetype_history($id);
        $query['get_bankaccount1_his'] = $this->M_humanresource->get_data_bankaccount1_history($id);
        $query['get_bankaccount2_his'] = $this->M_humanresource->get_data_bankaccount2_history($id);
        $query['get_uniformtshirt_his'] = $this->M_humanresource->get_data_uniformtshirt_history($id);

        $query['get_country'] = $this->M_humanresource->get_list_country();
        // $query['get_dept'] = $this->M_humanresource->get_all_department();
        $query['get_empcompany'] = $this->M_humanresource->get_company();
        $query['get_data_empcompany_his'] = $this->M_humanresource->get_company_his($id);
        $query['get_data_branch_his'] = $this->M_humanresource->get_branch_his($id);
        $query['get_dept'] = $this->M_humanresource->get_all_data_structure_dept();
        $query['get_data_dept_his'] = $this->M_humanresource->get_dept_his($id);
        $query['get_data_costcenter_his'] = $this->M_humanresource->get_costcenter_his($id);
        $idnumber = $id;
        //get data idnumber dependent
        $query['dependent'] = $this->M_humanresource->get_data_dependent_byid($id);
        $lastidnumberdepcode = $this->M_humanresource->get_last_iddep_byid($id);
        if ($lastidnumberdepcode != false) {                        
            $lastdep = substr($lastidnumberdepcode, -2);
            $curdep = $lastdep + 1;
            $newdep = $idnumber.'-'.'D'.str_pad($curdep, 2, '0',STR_PAD_LEFT);
            $idnumbercodedep = $newdep;            
        } else {
            $idnumbercodedep  = $idnumber.'-D01';
        }
        $query['idnumbercodedep'] = $idnumbercodedep;
        //get data idnumber kin
        $query['kin'] = $this->M_humanresource->get_data_kin_byid($id);
        $lastidnumberkincode = $this->M_humanresource->get_last_idkin_byid($id);
        if ($lastidnumberkincode != false) {                        
            $lastkin = substr($lastidnumberkincode, -2);
            $curkin = $lastkin + 1;
            $newkin = $idnumber.'-'.'K'.str_pad($curkin, 2, '0',STR_PAD_LEFT);
            $idnumbercodekin = $newkin;            
        } else {
            $idnumbercodekin  = $idnumber.'-K01';
        }
        $query['idnumbercodekin'] = $idnumbercodekin;
        $this->load->view('humanresource/employeeadmin/v_edit_personaldata', $query);
    }

    function transfer_edit_data_personal(){
        if ($this->input->post('submitdataeditpersonal')) {
            //Personal Data
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');
            $query['Midnumberidentifier'] = $idnumberidentifier_ = $identifier;
            $query['Mfirstname'] = $firstname_ = $this->input->post('firstname');
            $query['Mmiddlename'] = $middlename_ = $this->input->post('middlename');
            $query['Mlastname'] = $lastname_ = $this->input->post('lastname');
            $query['Mnickname'] = $nickname_ = $this->input->post('nickname');
            $query['Mfullname_'] = $fullname_ = $this->input->post('fullname');
            $query['Mgender'] = $gender_ = $this->input->post('gender');
            $query['Mdateofbirth'] = $dateofbirth_ = $this->input->post('dateofbirth');
            $query['Mpointofbirth'] = $pointofbirth_ = $this->input->post('pointofbirth');
            $query['Mreligion'] = $religion_ = $this->input->post('religion');
            $query['Mnationality'] = $nationality_ = $this->input->post('nationality');
            $query['Mforeignpermitno'] = $foreignpermitno_ = $this->input->post('foreignpermitno');
            $query['Mpermitexpiredate'] = $permitexpiredate_ = $this->input->post('permitexpiredate');
            $query['Methnic'] = $ethnic_ = $this->input->post('ethnic');
            $query['Maddress'] = $address_ = $this->input->post('address');
            $query['Mcity'] = $city_ = $this->input->post('city');
            $query['Mcitydes'] = $citydes_ = $this->input->post('i_citydes');
            $query['Msubdistrict'] = $subdistrict_ = $this->input->post('subdistrict');
            $query['Msubdistrictdes'] = $subdistrictdes_ = $this->input->post('i_subdistrictdes');
            $query['Mdistrict'] = $district_ = $this->input->post('district');
            $query['Mdistrictdes'] = $districtdes_ = $this->input->post('i_districtdes');
            $query['Mregion'] = $region_ = $this->input->post('region');
            $query['Mregiondes'] = $regiondes_ = $this->input->post('i_regiondes');
            $query['Mprovince'] = $province_ = $this->input->post('province');
            $query['Mprovincedes'] = $provincedes_ = $this->input->post('i_provincedes');
            $query['Mcountry'] = $country_ = $this->input->post('country');
            $query['Mcountrydes'] = $countrydes_ = $this->input->post('i_countrydes');
            $query['Mpostcode'] = $postcode_ = $this->input->post('postcode');
            $query['Mbloodtype'] = $bloodtype_ = $this->input->post('bloodtype');
            $query['Mheight'] = $height_ = $this->input->post('height');
            $query['Mweight'] = $weight_ = $this->input->post('weight');
            $query['Mmedication'] = $medication_ = $this->input->post('medication');
            $query['Mallergie'] = $allergies = $this->input->post('allergies');
            $query['Mchronicmedicalhistory'] = $chronicmedicalhistory_ = $this->input->post('chronicmedicalhistory');
            $query['Midentityno'] = $identityno_ = $this->input->post('identityno');
            $query['Midentityexpire'] = $identityexpire_ = $this->input->post('identityexpire');
            $query['Mpersonalid'] = $personalid_ = $this->input->post('personalid');

            $personaldata = array(
                'FirstName' => $firstname_,
                'MiddleName' =>$middlename_,
                'LastName' =>$lastname_,
                'NickName' =>$nickname_,
                'FullName' =>$fullname_,
                'Gender' =>$gender_,
                'DateofBirth' =>$dateofbirth_,
                'PointofBirth' =>$pointofbirth_,
                'Religion' =>$religion_,
                'Nationality' =>$nationality_,
                'ForeignPermitNo' =>$foreignpermitno_,
                'PermitExpireDate' => $permitexpiredate_,
                'Ethnic' =>$ethnic_,
                'Address' =>$address_,
                'City' =>$city_,
                'SubDistrict' =>$subdistrict_,
                'District' =>$district_,
                'Region' =>$region_,
                'Province' =>$province_,
                'Country' =>$country_,
                'PostCode' =>$postcode_,
                'BloodType' =>$bloodtype_,
                'Height' =>$height_,
                'Weight' =>$weight_,
                'Medication' =>$medication_,
                'Allergies' =>$allergies,
                'ChronicMedicalHistory' =>$chronicmedicalhistory_,
                'PersonalID' =>$personalid_
            );
            $this->M_humanresource->edit_emp_data_byid($idnumber_, $personaldata);

            $employeeappend = array(
                'FirstName' => $firstname_,
                'MiddleName' =>$middlename_,
                'LastName' =>$lastname_,
                'NickName' =>$nickname_,
                'FullName' =>$fullname_,
                'Gender' =>$gender_,
                'DateofBirth' =>$dateofbirth_,
                'PointofBirth' =>$pointofbirth_,
                'Religion' =>$religion_,
                'Nationality' =>$nationality_,
                'ForeignPermitNo' =>$foreignpermitno_,
                'PermitExpireDate' => $permitexpiredate_,
                'Ethnic' =>$ethnic_,
                'Address' =>$address_,
                'CityCode' =>$city_,
                'CityDes' =>$citydes_,
                'SubDistrictCode' =>$subdistrict_,
                'SubDistrictDes' =>$subdistrictdes_,
                'DistrictCode' =>$district_,
                'DistrictDes' =>$districtdes_,
                'RegionCode' =>$region_,
                'RegionDes' =>$regiondes_,
                'ProvinceCode' =>$province_,
                'ProvinceDes' =>$provincedes_,
                'CountryCode' =>$country_,
                'CountryDes' =>$countrydes_,
                'PostCode' =>$postcode_,
                'BloodType' =>$bloodtype_,
                'Height' =>$height_,
                'Weight' =>$weight_,
                'Medication' =>$medication_,
                'Allergies' =>$allergies,
                'ChronicMedicalHistory' =>$chronicmedicalhistory_,
                'PersonalID' =>$personalid_
            );
            $this->M_humanresource->edit_emp_app_data_byid($idnumber_, $employeeappend);
          
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data edited</center> </div>');
                redirect('Humanresource/view_edit_data_personal/'.$idnumber_.'/#persdata');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be edited</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$idnumber_.'/#persdata');    
        }
    }

    function transfer_edit_data_job(){
        if ($this->input->post('submitdataeditjob')) {
            //Job Information
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');

            $query['Mpositionno'] = $positionno_ = $this->input->post('positionno');
            $query['Mapplicantno'] = $applicantno_ = $this->input->post('applicantno');
            $query['Midnoref'] = $idnoref_ = $this->input->post('idnoref');

            $query['Memployeeclass'] = $employeeclass_ = $this->input->post('employeeclass');
            $query['Memployeeclassdes'] = $employeeclassdes_ = $this->input->post('i_employeeclassdes');
        
            $query['Monsitelocation'] = $onsitelocation_ = $this->input->post('onsitelocation');
           
            $query['Monsiteaddress'] = $onsiteaddress_ = $this->input->post('onsiteaddress');
            $query['Monsitecity'] = $onsitecity_ = $this->input->post('onsitecity');
            $query['Monsitecitydes'] = $onsitecitydes_ = $this->input->post('i_ocitydes');
            $query['Monsitesubdistrict'] = $onsitesubdistrict_ = $this->input->post('onsitesubdistrict');
            $query['Monsitesubdistrictdes'] = $onsitesubdistrictdes_ = $this->input->post('i_osubdistrictdes');
            $query['Monsitedistrict'] = $onsitedistrict_ = $this->input->post('onsitedistrict');
            $query['Monsitedistrictdes'] = $onsitedistrictdes_ = $this->input->post('i_odistrictdes');
            $query['Monsiteregion'] = $onsiteregion_ = $this->input->post('onsiteregion');
            $query['Monsiteregiondes'] = $onsiteregiondes_ = $this->input->post('i_oregiondes');
            $query['Monsiteprovince'] = $onsiteprovince_ = $this->input->post('onsiteprovince');
            $query['Monsiteprovincedes'] = $onsiteprovincedes_ = $this->input->post('i_oprovincedes');
            $query['Monsitecountry'] = $onsitecountry_ = $this->input->post('onsitecountry');
            $query['Monsitecountrydes'] = $onsitecountrydes_ = $this->input->post('i_ocountrydes');
            $query['Monsitepostcode'] = $onsitepostcode_ = $this->input->post('onsitepostcode');


            $query['Mjobpoint'] = $jobpoint_ = $this->input->post('jobpoint');
            $query['Mjobpointdes'] = $jobpointdes_ = $this->input->post('i_jobpointdes');
            $query['Mjobratepoint'] = $jobratepoint_ = $this->input->post('i_jobratepoint');
            $query['Mjobamountpoint'] = $jobamountpoint_ = $this->input->post('i_jobamountpoint');
           
            $query['Mjoblevelcode'] = $joblevelcode_ = $this->input->post('i_joblevelcode');
            $query['Mjoblevel'] = $joblevel_ = $this->input->post('joblevel');
            $query['Mjobleveldes'] = $jobleveldes_ = $this->input->post('i_jobleveldes');
            $query['Mjobleveltype'] = $jobleveltype_ = $this->input->post('i_joblevelmgttype');
            $query['Mjoblevelgroup'] = $joblevelgroup_ = $this->input->post('i_joblevelmgtgroup');

            $query['Mindividualgrade'] = $individualgrade_ = $this->input->post('individualgrade');
            $query['Mindividualgradedes'] = $individualgradedes_ = $this->input->post('i_individualgradedes');

            $query['Mjobgrade'] = $jobgrade_ = $this->input->post('jobgrade');
            $query['Mjobgradedes'] = $jobgradedes_ = $this->input->post('i_jobgradedes');
           
            $query['Mradio'] = $radio_ = $this->input->post('radio');
            $query['Mofficecode'] = $officecode_ = $this->input->post('officecode');
            $query['Mlastpromotion'] = $lastpromotion_ = $this->input->post('lastpromotion');
       
            $query['Mpaygroup'] = $paygroup_ = $this->input->post('paygroup');
            $query['Mbenefitcode'] = $benefitcode_ = $this->input->post('benefitcode');
            $query['Munioncode'] = $unioncode_ = $this->input->post('unioncode');
            $query['Mtaxcode'] = $taxcode_ = $this->input->post('taxcode');
          
            $query['Mstatus'] = $status_ = $this->input->post('status');
            $query['Mstatusdate'] = $statusdate_ = $this->input->post('statusdate');
           
         
            $query['Mworkphone'] = $workphone_ = $this->input->post('workphone');
            $query['Mmobile1'] = $mobile1_ = $this->input->post('mobile1');
            $query['Mmobile2'] = $mobile2_ = $this->input->post('mobile2');
            $query['Mphone'] = $phone_ = $this->input->post('phone');
            $query['Mwa'] = $wa_ = $this->input->post('wa');
            $query['Memailcompany'] = $emailcompany_ = $this->input->post('emailcompany');
            $query['Memailpersonal'] = $emailpersonal_ = $this->input->post('emailpersonal');
          
          
            $query['Muniformpants'] = $uniformpants_ = $this->input->post('uniformpants');
            $query['Mshoes'] = $shoes_ = $this->input->post('shoes');
            $query['Mglasses'] = $glasses_ = $this->input->post('glasses');

            $jobinformation = array(
                'PositionNo' =>$positionno_,
                'ApplicantNo' => $applicantno_,
                'IDNoRef' =>$idnoref_,
             
                'EmployeeClass' =>$employeeclass_,
               
                'OnsiteLocation' =>$onsitelocation_,
              
                'OnsiteAddress' =>$onsiteaddress_,
                'OnsiteCity' =>$onsitecity_,
                'OnsiteSubDistrict' =>$onsitesubdistrict_,
                'OnsiteDistrict' =>$onsitedistrict_,
                'OnsiteRegion' =>$onsiteregion_,
                'OnsiteProvince' =>$onsiteprovince_,
                'OnsiteCountry' =>$onsitecountry_,
                'OnsitePostCode' =>$onsitepostcode_,
            
                'JobPoint' =>$jobpoint_,
                'JobLevel' =>$joblevel_,
                'IndividualGrade' =>$individualgrade_,
                'JobGrade' =>$jobgrade_,
              
                'Radio' =>$radio_,
                'OfficeCode' =>$officecode_,
                'Status' =>$status_,
                'StatusDate' =>$statusdate_,
                'LastPromotion' =>$lastpromotion_,
              
                'Paygroup' =>$paygroup_,
                'BenefitCode' =>$benefitcode_,
                'UnionCode' =>$unioncode_,
                'TaxCode' =>$taxcode_,
               
                'WorkPhone' =>$workphone_,
                'Mobile1' =>$mobile1_,
                'Mobile2' =>$mobile2_,
                'Phone' =>$phone_,
                'WA' =>$wa_,
                'EmailCompany' =>$emailcompany_,
                'EmailPersonal' =>$emailpersonal_,
               
                'UniformPants' =>$uniformpants_,
                'Shoes' =>$shoes_,
                'Glasses' =>$glasses_
            );
            $this->M_humanresource->edit_emp_job_data_byid($idnumber_, $jobinformation);

            $employeeappend = array(
                'PositionNo' =>$positionno_,
                'ApplicantNo' => $applicantno_,
                'IDNoRef' =>$idnoref_,

                'EmployeeClass' =>$employeeclass_,
                'EmployeeClassDes' =>$employeeclassdes_,
               
                'OnsiteLocation' =>$onsitelocation_,
              
                'OnsiteAddress' =>$onsiteaddress_,
                'OnsiteCity' =>$onsitecity_,
                'OnsiteSubDistrict' =>$onsitesubdistrict_,
                'OnsiteDistrict' =>$onsitedistrict_,
                'OnsiteRegion' =>$onsiteregion_,
                'OnsiteProvince' =>$onsiteprovince_,
                'OnsiteCountry' =>$onsitecountry_,
                'OnsitePostCode' =>$onsitepostcode_,
            
                'JobLevelCode' =>$joblevelcode_,
                'JobLevel' =>$joblevel_,
                'JobLevelDes' =>$jobleveldes_,
                'JobLevelMgtType' =>$jobleveltype_,
                'JobLevelMgtGroup' =>$joblevelgroup_,

                'JobPoint' =>$jobpoint_,
                'JobPointDes' =>$jobpointdes_,
                'JobRatePoint' =>$jobratepoint_,
                'JobAmountPoint' =>$jobamountpoint_,

                'IndividualGrade' =>$individualgrade_,
                'IndividualGradeDes' =>$individualgradedes_,

                'JobGrade' =>$jobgrade_,
                'JobGradeDes' =>$jobgradedes_,
              
                'Radio' =>$radio_,
                'OfficeCode' =>$officecode_,
                'Status' =>$status_,
                'StatusDate' =>$statusdate_,
                'LastPromotion' =>$lastpromotion_,
              
                'Paygroup' =>$paygroup_,
                'BenefitCode' =>$benefitcode_,
                'UnionCode' =>$unioncode_,
                'TaxCode' =>$taxcode_,
               
                'WorkPhone' =>$workphone_,
                'Mobile1' =>$mobile1_,
                'Mobile2' =>$mobile2_,
                'Phone' =>$phone_,
                'WA' =>$wa_,
                'EmailCompany' =>$emailcompany_,
                'EmailPersonal' =>$emailpersonal_,
               
                'UniformPants' =>$uniformpants_,
                'Shoes' =>$shoes_,
                'Glasses' =>$glasses_
            );
            $this->M_humanresource->edit_emp_app_data_byid($idnumber_, $employeeappend);
          
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data edited</center> </div>');
                redirect('Humanresource/view_edit_data_personal/'.$idnumber_.'/#jobinfo');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be edited</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$idnumber_.'/#jobinfo');    
        }
    }

    function edit_persphoto_byid(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitpersphoto')) {
            $id = $this->input->post('IDNumber');
            $idn = $this->input->post('idnum');
            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
                // $this->ddoo_upload('photo');
                // $photo = $_FILES['photo']['name'];
                $photo = $this->upload_image_reg('photo');
            }else{
                $photo = "";
            }
            $datapersphoto = array(
                'Photo' => $photo,
            );
            $this->M_humanresource->edit_persphoto_data_byid($idn, $datapersphoto);
            $this->M_humanresource->edit_persphoto_app_data_byid($idn, $datapersphoto);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#pers');   

        }else{
        $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
        redirect('Humanresource/view_edit_data_personal/'.$id.'/#pers');        
        }
    }

    function edit_ktp_byid(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitktpfile')) {
            $id = $this->input->post('IDNumber');
            $identityno_ = $this->input->post('identityno');
            $identityex_ = $this->input->post('identityexpire');
            if(isset($_FILES['identity']) && $_FILES['identity']['name'] != ''){
                // $this->ddoo_upload('identity');
                // $photo = $_FILES['identity']['name'];
                $identity = $this->upload_image_reg('identity');
            }else{
                $identity = "";
            }
            $datafilektp = array(
                'Identity' => $identity,
                'IdentityNo' => $identityno_,
                'IdentityExpire' => $identityex_,
            );
            $this->M_humanresource->edit_ktp_data_byid($id, $datafilektp);
            $this->M_humanresource->edit_ktp_app_data_byid($id, $datafilektp);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#pers');   

        }else{
        $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
        redirect('Humanresource/view_edit_data_personal/'.$id.'/#pers');        
        }
    }

    function get_data_dep(){
        $cno = $this->input->post('ctrlno');
        $get_dep = $this->M_humanresource->get_data_dependent_byctrlno($cno);

        $value = '';
        if ($get_dep != null) {
            foreach ($get_dep as $dp ) {
                $value .='<div class="col-md-5">';
                $value .='<div class="portlet light" style="background-color: #f5f5f5ba">';
                $value .='<div class="text-center modal_edit_pic">';
                if ($dp->DepPhoto != null){ 
                $value .='<a href="#"><img data-id="'.$dp->IDNumberDependent.'" src="'. base_url('upload/profile/').$dp->DepPhoto.'" alt="" style="width:auto; height: 200px"/></a>';
                }else{
                $value .='<img data-id="'.$dp->IDNumberDependent.'" src="'.base_url('upload/profile/kosong.png').'" alt="" width="70%" height="70%"/>';
                }
                $value .='</div>';
                $value .='<hr>';
                $value .='<div class="text-center">';
                $value .='<h5 class="img-rounded bold"><input type="text" name="fullnamedep" class="form-control text-center" value="'.$dp->FullName.'"></h5>';
                $value .='</div>';
                $value .='<hr style="margin: 9px 0;">';
                $value .='<table class="table" style="margin-bottom: 0px;">';
                $value .='<tbody>';
                $value .='<tr>';
                $value .='<td width="28%" style="border-top: none;"><center>ID Number :</center></td>';
                $value .='</tr>';
                $value .='<tr class="hidden">';
                $value .='<td class="bold" style="border-top: none;"><center><input type="text" name="IDNumber" class="form-control text-center" value="'.$dp->IDNumber.'" readonly></center></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td class="bold" style="border-top: none;"><center><input type="text" name="iddep" class="form-control text-center" value="'.$dp->IDNumberDependent.'" readonly></center></td>';
                $value .='</tr>';
                $value .='</tbody>';
                $value .='</table>';
                $value .='</div>';
                $value .='<div class="portlet light" style="background-color: #f5f5f5ba">';
                $value .='<div>';
                $value .='<h5 class="img-rounded bold">Contact</h5>';
                $value .='</div>';
                $value .='<hr style="margin: 9px 0;">';
                $value .='<table class="table" style="margin-bottom: 0px;">';
                $value .='<tbody>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Phone </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="phonedep" class="form-control" value="'.$dp->Phone.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Mobile </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="mobiledep" class="form-control" value="'.$dp->Mobile.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> WA </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="wadep" class="form-control" value="'.$dp->WA.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Email </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="emaildep" class="form-control" value="'.$dp->Email.'"></td>';
                $value .='</tr>';
                $value .='</tbody>';
                $value .='</table>';
                $value .='</div>';
                $value .='</div>';
                $value .='<div class="col-md-7">';
                $value .='<table class="table table-stripped">';
                $value .='<tbody>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Relationship </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="relationshipdep" class="form-control" value="'.$dp->Relationship.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Gender </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold">
                <select name="genderdep"  class="form-control">
                      <option value="'.$dp->Gender.'">'.$dp->Gender.'*</option>
                      <option id="genderdep" value="Male">Male</option>
                      <option id="genderdep" value="Female">Female</option>
                </select>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Marital </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold">
                <select name="maritalstatusdep"  class="form-control">
                      <option value="'.$dp->MaritalStatus.'">'.$dp->MaritalStatus.'*</option>
                      <option id="maritalstatusdep" value="Married">Married</option>
                      <option id="maritalstatusdep" value="Single">Single</option>
                      <option id="maritalstatusdep" value="Divorce">Divorce</option>
                      <option id="maritalstatusdep" value="Widow">Widow</option>
                      <option id="maritalstatusdep" value="Widower">Widower</option>
                </select>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Date of Birth </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="date" name="dateofbirthdep" class="form-control" value="'.$dp->DateofBirth.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Point of Birth </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="placeofbirthdep" class="form-control" value="'.$dp->PlaceofBirth.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Religion </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold">
                <select name="religiondep"  class="form-control">
                      <option value="'.$dp->Religion.'">'.$dp->Religion.'*</option>
                      <option id="religiondep" value="Advent">Christian (Advent)</option>
                      <option id="religiondep" value="Protestan">Christian (Protestan)</option>
                      <option id="religiondep" value="Islam">Islam</option>
                      <option id="religiondep" value="Catholic">Catholic</option>
                      <option id="religiondep" value="Hindu">Hindu</option>
                      <option id="religiondep" value="Buddha">Buddha</option>
                      <option id="religiondep" value="Khonghucu">Khonghucu</option>
                </select>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Nationality </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="nationalitydep" class="form-control" value="'.$dp->Nationality.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Ethnic </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="ethnicdep" class="form-control" value="'.$dp->Ethnic.'"></td>';
                $value .='</tr><tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Blood Type </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold">
                <select name="bloodtypedep"  class="form-control">
                      <option value="'.$dp->BloodType.'">'.$dp->BloodType.'*</option>
                      <option id="bloodtypedep" value="O">O</option>
                      <option id="bloodtypedep" value="A">A</option>
                      <option id="bloodtypedep" value="B">B</option>
                      <option id="bloodtypedep" value="AB">AB</option>
                </select>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Address </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="addressdep" class="form-control" value="'.$dp->Address.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> City </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="citydep" class="form-control" value="'.$dp->City.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Subdistrict </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="subdistrictdep" class="form-control" value="'.$dp->SubDistrict.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Distrtict </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="districtdep" class="form-control" value="'.$dp->District.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Region </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="regiondep" class="form-control" value="'.$dp->Region.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Province </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="provincedep" class="form-control" value="'.$dp->Province.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Country </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="countrydep" class="form-control" value="'.$dp->Country.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Post Code </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="postcodedep" class="form-control" value="'.$dp->PostCode.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Date of Death </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="date" name="dateofdeathdep" class="form-control" value="'.$dp->DateofDeath.'"></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Benefit Type </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="benefittypedep" class="form-control" value="'.$dp->BenefitType.'"></td>';
                $value .='</tr>';
                $value .='</tbody>';
                $value .='</table>';
                $value .='</div>';
                $value .='<hr style="border: solid 1px">';
                $value .='<div class="col-md-2 col-sm-2 pull-right">';
                    $value .='<div class="form-group">';
                        $value .='<div class="col-md-12 col-sm-12">';
                            $value .='<input type="submit" name="submiteditdep" value="Submit" onclick="return confirm("Are you sure?"")" class="btn btn-transparent green btn-block btn-sm">   ';     
                        $value .='</div>';
                    $value .='</div>';                          
                $value .='</div>';
            }
        }else{
            $value .='<tr>';
            $value .='<td align="center" colspan="6">Tidak Ada Data!</td>';
            $value .='</tr>';
        }                                  
        echo json_encode($value);
    }

    function add_dependent(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitdep')) {
            $id = $this->input->post('IDNumber');
            //Dependent
            $query['Middep'] = $iddep_ = $this->input->post('iddep');
            $query['Mrelationshipdep'] = $relationshipdep_ = $this->input->post('relationshipdep');
            $query['Mfullnamedep'] = $fullnamedep_ = $this->input->post('fullnamedep');
            $query['Mgenderdep'] = $genderdep_ = $this->input->post('genderdep');
            $query['Mmaritalstatusdep'] = $maritalstatusdep_ = $this->input->post('maritalstatusdep');
            $query['Mpointofbirthdep'] = $pointofbirthdep_ = $this->input->post('placeofbirthdep');
            $query['Mdateofbirthdep'] = $dateofbirthdep_ = $this->input->post('dateofbirthdep');
            $query['Mreligiondep'] = $religiondep_ = $this->input->post('religiondep');
            $query['Mnationalitydep'] = $nationalitydep_ = $this->input->post('nationalitydep');
            $query['Methnicdep'] = $ethnicdep_ = $this->input->post('ethnicdep');
            $query['Maddressdep'] = $addressdep_ = $this->input->post('addressdep');
            $query['Mcitydep'] = $citydep_ = $this->input->post('citydep');
            $query['Mcitydepdes'] = $citydepdes_ = $this->input->post('i_citydepdes');
            $query['Msubdistrictdep'] = $subdistrictdep_ = $this->input->post('subdistrictdep');
            $query['Msubdistrictdepdes'] = $subdistrictdepdes_ = $this->input->post('i_subdistrictdepdes');
            $query['Mdistrictdep'] = $districtdep_ = $this->input->post('districtdep');
            $query['Mdistrictdepdes'] = $districtdepdes_ = $this->input->post('i_districtdepdes');
            $query['Mregiondep'] = $regiondep_ = $this->input->post('regiondep');
            $query['Mregiondepdes'] = $regiondepdes_ = $this->input->post('i_regiondepdes');
            $query['Mprovincedep'] = $provincedep_ = $this->input->post('provincedep');
            $query['Mprovincedepdes'] = $provincedepdes_ = $this->input->post('i_provincedepdes');
            $query['Mcountrydep'] = $countrydep_ = $this->input->post('countrydep');
            $query['Mcountrydepdes'] = $countrydepdes_ = $this->input->post('i_countrydepdes');
            $query['Mpostcodedep'] = $postcodedep_ = $this->input->post('postcodedep');
            $query['Mbloodtypedep'] = $bloodtypedep_ = $this->input->post('bloodtypedep');
            $query['Mdateofdeathdep'] = $dateofdeathdep_ = $this->input->post('dateofdeathdep');
            $query['Mbenefittypedep'] = $benefittypedep_ = $this->input->post('benefittypedep');
            $query['Mphonedep'] = $phonedep_ = $this->input->post('phonedep');
            $query['Mmobiledep'] = $mobiledep_ = $this->input->post('mobiledep');
            $query['Mwadep'] = $wadep_ = $this->input->post('wadep');
            $query['Memaildep'] = $emaildep_ = $this->input->post('emaildep');
            if(isset($_FILES['photodep']) && $_FILES['photodep']['name'] != ''){
                // $this->ddoo_upload('photodep');
                // $photodep = $_FILES['photodep']['name'];
                $photodep = $this->upload_image_reg('photodep');
            }else{
                $photodep = "";
            }
            $data_dep = array(
                'IDNumber' =>$id,
                'IDNumberDependent' =>$iddep_,
                'FullName' =>$fullnamedep_,
                'Relationship' =>$relationshipdep_,
                'Gender' =>$genderdep_,
                'MaritalStatus' =>$maritalstatusdep_,
                'PlaceofBirth' =>$pointofbirthdep_,
                'DateofBirth' =>$dateofbirthdep_,
                'Religion' =>$religiondep_,
                'Nationality' =>$nationalitydep_,
                'Ethnic' =>$ethnicdep_,
                'Address' =>$addressdep_,
                'City' =>$citydep_,
                'CityDes' =>$citydepdes_,
                'SubDistrict' =>$subdistrictdep_,
                'SubDistrictDes' =>$subdistrictdepdes_,
                'District' =>$districtdep_,
                'DistrictDes' =>$districtdepdes_,
                'Region' =>$regiondep_,
                'RegionDes' =>$regiondepdes_,
                'Province' =>$provincedep_,
                'ProvinceDes' =>$provincedepdes_,
                'Country' =>$countrydep_,
                'CountryDes' =>$countrydepdes_,
                'PostCode' =>$postcodedep_,
                'BloodType' =>$bloodtypedep_,
                'DateofDeath' =>$dateofdeathdep_,
                'BenefitType' =>$benefittypedep_,
                'Phone' =>$phonedep_,
                'Mobile' =>$mobiledep_,
                'WA' =>$wadep_,
                'Email' =>$emaildep_,
                'DepPhoto' =>$photodep,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_dep', $data_dep);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');        
        }
    }

    function edit_dependent(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditdep')) {
            $id = $this->input->post('IDNumber');
            //Dependent
            $query['Middep'] = $iddep_ = $this->input->post('iddep');
            $query['Mrelationshipdep'] = $relationshipdep_ = $this->input->post('relationshipdep');
            $query['Mfullnamedep'] = $fullnamedep_ = $this->input->post('fullnamedep');
            $query['Mgenderdep'] = $genderdep_ = $this->input->post('genderdep');
            $query['Mmaritalstatusdep'] = $maritalstatusdep_ = $this->input->post('maritalstatusdep');
            $query['Mpointofbirthdep'] = $pointofbirthdep_ = $this->input->post('placeofbirthdep');
            $query['Mdateofbirthdep'] = $dateofbirthdep_ = $this->input->post('dateofbirthdep');
            $query['Mreligiondep'] = $religiondep_ = $this->input->post('religiondep');
            $query['Mnationalitydep'] = $nationalitydep_ = $this->input->post('nationalitydep');
            $query['Methnicdep'] = $ethnicdep_ = $this->input->post('ethnicdep');
            $query['Maddressdep'] = $addressdep_ = $this->input->post('addressdep');
            $query['Mcitydep'] = $citydep_ = $this->input->post('citydep');
            $query['Msubdistrictdep'] = $subdistrictdep_ = $this->input->post('subdistrictdep');
            $query['Mdistrictdep'] = $districtdep_ = $this->input->post('districtdep');
            $query['Mregiondep'] = $regiondep_ = $this->input->post('regiondep');
            $query['Mcountrydep'] = $countrydep_ = $this->input->post('countrydep');
            $query['Mpostcodedep'] = $postcodedep_ = $this->input->post('postcodedep');
            $query['Mprovincedep'] = $provincedep_ = $this->input->post('provincedep');
            $query['Mbloodtypedep'] = $bloodtypedep_ = $this->input->post('bloodtypedep');
            $query['Mdateofdeathdep'] = $dateofdeathdep_ = $this->input->post('dateofdeathdep');
            $query['Mbenefittypedep'] = $benefittypedep_ = $this->input->post('benefittypedep');
            $query['Mphonedep'] = $phonedep_ = $this->input->post('phonedep');
            $query['Mmobiledep'] = $mobiledep_ = $this->input->post('mobiledep');
            $query['Mwadep'] = $wadep_ = $this->input->post('wadep');
            $query['Memaildep'] = $emaildep_ = $this->input->post('emaildep');
            $data_dep = array(
                'FullName' =>$fullnamedep_,
                'Relationship' =>$relationshipdep_,
                'Gender' =>$genderdep_,
                'MaritalStatus' =>$maritalstatusdep_,
                'PlaceofBirth' =>$pointofbirthdep_,
                'DateofBirth' =>$dateofbirthdep_,
                'Religion' =>$religiondep_,
                'Nationality' =>$nationalitydep_,
                'Ethnic' =>$ethnicdep_,
                'Address' =>$addressdep_,
                'City' =>$citydep_,
                'SubDistrict' =>$subdistrictdep_,
                'District' =>$districtdep_,
                'Region' =>$regiondep_,
                'Province' =>$provincedep_,
                'Country' =>$countrydep_,
                'PostCode' =>$postcodedep_,
                'BloodType' =>$bloodtypedep_,
                'DateofDeath' =>$dateofdeathdep_,
                'BenefitType' =>$benefittypedep_,
                'Phone' =>$phonedep_,
                'Mobile' =>$mobiledep_,
                'WA' =>$wadep_,
                'Email' =>$emaildep_,
            );
            $this->M_humanresource->update_dep_data_byid($iddep_, $data_dep);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');        
        }
    }

    function edit_depphoto_byid(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitdepphoto')) {
            $id = $this->input->post('IDNumber');
            $idp = $this->input->post('idep');
            if(isset($_FILES['photodep']) && $_FILES['photodep']['name'] != ''){
                // $this->ddoo_upload('photodep');
                // $photodep = $_FILES['photodep']['name'];
                $photodep = $this->upload_image_reg('photodep');
            }else{
                $photodep = "";
            }
            $datadepphoto = array(
                'DepPhoto' => $photodep,
            );
            $this->M_humanresource->edit_depphoto_data_byid($idp, $datadepphoto);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');   

        }else{
        $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
        redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');        
        }
    }

    function delete_dependent($id,$cno){
        $this->M_humanresource->delete_data_dependent($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_data_personal/'.$id.'/#dependent');  
    }

    function get_data_kin(){
        $cno = $this->input->post('ctrlno');
        $get_kin = $this->M_humanresource->get_data_kin_byctrlno($cno);

        $value = '';
        if ($get_kin != null) {
            foreach ($get_kin as $ki ) {
                $value .='<div class="col-md-5">';
                $value .='<div class="portlet light" style="background-color: #f5f5f5ba">';
                $value .='<div class="text-center">';
                $value .='<h5 class="img-rounded bold"><input type="text" name="fullnamekin" class="form-control text-center" value="'.$ki->FullName.'" ></h5>';
                $value .='</div>';
                $value .='<hr style="margin: 9px 0;">';
                $value .='<table class="table" style="margin-bottom: 0px;">';
                $value .='<tbody>';
                $value .='<tr>';
                $value .='<td width="28%" style="border-top: none;"><center>ID Number :</center></td>';
                $value .='</tr>';
                $value .='<tr class="hidden">';
                $value .='<td class="bold" style="border-top: none;"><center><input type="text" name="IDNumber" class="form-control text-center" value="'.$ki->IDNumber.'" readonly></center></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td class="bold" style="border-top: none;"><center><input type="text" name="idnumberkin" class="form-control text-center" value="'.$ki->IDNumberKin.'"  readonly></center></td>';
                $value .='</tr>';
                $value .='</tbody>';
                $value .='</table>';
                $value .='</div>';
                $value .='</div>';
                $value .='<div class="col-md-7">';
                $value .='<table class="table table-stripped">';
                $value .='<tbody>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Relationship </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="relationshipkin" class="form-control" value="'.$ki->Relationship.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Address </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="addresskin" class="form-control" value="'.$ki->Address.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> City </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="citykin" class="form-control" value="'.$ki->City.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Subdistrict </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="subdistrictkin" class="form-control" value="'.$ki->SubDistrict.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Distrtict </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="districtkin" class="form-control" value="'.$ki->District.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Region </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="regionkin" class="form-control" value="'.$ki->Region.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Province </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="provincekin" class="form-control" value="'.$ki->Province.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Country </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="countrykin" class="form-control" value="'.$ki->Country.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td width="38%" class="text-right"> Post Code </td>';
                $value .='<td width="1%" class="bold"> : </td>';
                $value .='<td class="sbold"><input type="text" name="postcodekin" class="form-control" value="'.$ki->PostCode.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Phone </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="number" name="phonekin" class="form-control" value="'.$ki->Phone.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Mobile </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="number" name="mobilekin" class="form-control" value="'.$ki->Mobile.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Workphone </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="number" name="workphonekin" class="form-control" value="'.$ki->WorkPhone.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> WA </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="number" name="wakin" class="form-control" value="'.$ki->WA.'" ></td>';
                $value .='</tr>';
                $value .='<tr>';
                $value .='<td style="background-color: #f5f5f5ba" width="38%" class="text-right"> Email </td>';
                $value .='<td style="background-color: #f5f5f5ba" width="1%" class="bold"> : </td>';
                $value .='<td style="background-color: #f5f5f5ba" class="sbold"><input type="text" name="emailkin" class="form-control" value="'.$ki->Email.'" ></td>';
                $value .='</tr>';
                $value .='</tbody>';
                $value .='</table>';
                $value .='</div>';
                $value .='<hr style="border: solid 1px">';
                $value .='<div class="col-md-2 col-sm-2 pull-right">';
                    $value .='<div class="form-group">';
                        $value .='<div class="col-md-12 col-sm-12">';
                            $value .='<input type="submit" name="submiteditkin" value="Submit" onclick="return confirm("Are you sure?")" class="btn btn-transparent green btn-block btn-sm">   ';     
                        $value .='</div>';
                    $value .='</div>';                          
                $value .='</div>';
            }
        }else{
            $value .='<tr>';
            $value .='<td align="center" colspan="6">Tidak Ada Data!</td>';
            $value .='</tr>';
        }                                  
        echo json_encode($value);
    }

    function add_kin(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitkin')) {
            $id = $this->input->post('IDNumber');
            //Kin
            $query['Midnumberkin'] = $idnumberkin_ = $this->input->post('idnumberkin');
            $query['Mrelationshipkin'] = $relationshipkin_ = $this->input->post('relationshipkin');
            $query['Mfullnamekin'] = $fullnamekin_ = $this->input->post('fullnamekin');
            $query['Maddresskin'] = $addresskin_ = $this->input->post('addresskin');
            $query['Mcitykin'] = $citykin_ = $this->input->post('citykin');
            $query['Mcitykindes'] = $citykindes_ = $this->input->post('i_citykindes');
            $query['Msubdistrictkin'] = $subdistrictkin_ = $this->input->post('subdistrictkin');
            $query['Msubdistrictkindes'] = $subdistrictkindes_ = $this->input->post('i_subdistrictkindes');
            $query['Mdistrictkin'] = $districtkin_ = $this->input->post('districtkin');
            $query['Mdistrictkindes'] = $districtkindes_ = $this->input->post('i_districtkindes');
            $query['Mregionkin'] = $regionkin_ = $this->input->post('regionkin');
            $query['Mregionkindes'] = $regionkindes_ = $this->input->post('i_regionkindes');
            $query['Mprovincekin'] = $provincekin_ = $this->input->post('provincekin');
            $query['Mprovincekindes'] = $provincekindes_ = $this->input->post('i_provincekindes');
            $query['Mcountrykin'] = $countrykin_ = $this->input->post('countrykin');
            $query['Mcountrykindes'] = $countrykindes_ = $this->input->post('i_countrykindes');
            $query['Mpostcodekin'] = $postcodekin_ = $this->input->post('postcodekin');
            $query['Mmobilekin'] = $mobilekin_ = $this->input->post('mobilekin');
            $query['Mphonekin'] = $phonekin_ = $this->input->post('phonekin');
            $query['Mworkphonekin'] = $workphonekin_ = $this->input->post('workphonekin');
            $query['Mwakin'] = $wakin_ = $this->input->post('wakin');
            $query['Memailkin'] = $emailkin_ = $this->input->post('emailkin');

            $data_kin = array(
                'IDNumber' =>$id,
                'IDNumberKin' =>$idnumberkin_,
                'FullName' =>$fullnamekin_,
                'Relationship' =>$relationshipkin_,
                'Address' =>$addresskin_,
                'City' =>$citykin_,
                'CityDes' =>$citykindes_,
                'SubDistrict' =>$subdistrictkin_,
                'SubDistrictDes' =>$subdistrictkindes_,
                'District' =>$districtkin_,
                'DistrictDes' =>$districtkindes_,
                'Region' =>$regionkin_,
                'RegionDes' =>$regionkindes_,
                'Province' =>$provincekin_,
                'ProvinceDes' =>$provincekindes_,
                'Country' =>$countrykin_,
                'CountryDes' =>$countrykindes_,
                'PostCode' =>$postcodekin_,
                'Mobile' =>$mobilekin_,
                'Phone' =>$phonekin_,
                'WorkPhone' =>$workphonekin_,
                'WA' =>$wakin_,
                'Email' =>$emailkin_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')  
            );
            $this->M_humanresource->insert('tbl_emp_data_kin', $data_kin);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#kin');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#kin');        
        }
    }

    function edit_kin(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditkin')) {
            $id = $this->input->post('IDNumber');
           //Kin
            $query['Midnumberkin'] = $idnumberkin_ = $this->input->post('idnumberkin');
            $query['Mrelationshipkin'] = $relationshipkin_ = $this->input->post('relationshipkin');
            $query['Mfullnamekin'] = $fullnamekin_ = $this->input->post('fullnamekin');
            $query['Maddresskin'] = $addresskin_ = $this->input->post('addresskin');
            $query['Mcitykin'] = $citykin_ = $this->input->post('citykin');
            $query['Msubdistrictkin'] = $subdistrictkin_ = $this->input->post('subdistrictkin');
            $query['Mdistrictkin'] = $districtkin_ = $this->input->post('districtkin');
            $query['Mregionkin'] = $regionkin_ = $this->input->post('regionkin');
            $query['Mprovincekin'] = $provincekin_ = $this->input->post('provincekin');
            $query['Mcountrykin'] = $countrykin_ = $this->input->post('countrykin');
            $query['Mpostcodekin'] = $postcodekin_ = $this->input->post('postcodekin');
            $query['Mbloodtypekin'] = $bloodtypekin_ = $this->input->post('bloodtypekin');
            $query['Mmobilekin'] = $mobilekin_ = $this->input->post('mobilekin');
            $query['Mphonekin'] = $phonekin_ = $this->input->post('phonekin');
            $query['Mworkphonekin'] = $workphonekin_ = $this->input->post('workphonekin');
            $query['Mwakin'] = $wakin_ = $this->input->post('wakin');
            $query['Memailkin'] = $emailkin_ = $this->input->post('emailkin');
            $data_kin = array(
                'FullName' =>$fullnamekin_,
                'Relationship' =>$relationshipkin_,
                'Address' =>$addresskin_,
                'City' =>$citykin_,
                'SubDistrict' =>$subdistrictkin_,
                'District' =>$districtkin_,
                'Region' =>$regionkin_,
                'Province' =>$provincekin_,
                'Country' =>$countrykin_,
                'PostCode' =>$postcodekin_,
                'Mobile' =>$mobilekin_,
                'Phone' =>$phonekin_,
                'WorkPhone' =>$workphonekin_,
                'WA' =>$wakin_,
                'Email' =>$emailkin_,
            );
            $this->M_humanresource->update_kin_data_byid($idnumberkin_, $data_kin);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#kin');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#kin');        
        }
    }

    function delete_kin($id,$cno){
        $this->M_humanresource->delete_data_kin($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_data_personal/'.$id.'/#kin');  
    }

    function update_marital(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditmarital')) {
            $id = $this->input->post('IDNumber');
            $data_marital = array(
              'MaritalStatus' => $this->input->post('maritalstatus'),
              'MaritalStatusDes' => $this->input->post('i_maritalstatusdes') 
            );
            $this->M_humanresource->update_marital_data_byid_append($id, $data_marital);
            $data_marital1 = array(
              'MaritalStatus' => $this->input->post('maritalstatus')
            );
            $this->M_humanresource->update_marital_data_byid($id, $data_marital1);
            $data_marital2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Marital' => $this->input->post('maritalstatus'),
              'MaritalDes' => $this->input->post('i_maritalstatusdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_marital', $data_marital2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#persdata');        
        }
    }

    function update_employeetype(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditemployeetype')) {
            $id = $this->input->post('IDNumber');
            $data_employeetype = array(
              'EmployeeType' => $this->input->post('employeetype'),
              'EmployeeTypeDes' => $this->input->post('i_employeetypedes') 
            );
            $this->M_humanresource->update_employeetype_data_byid_append($id, $data_employeetype);
            $data_employeetype1 = array(
              'EmployeeType' => $this->input->post('employeetype')
            );
            $this->M_humanresource->update_employeetype_data_byid($id, $data_employeetype1);
            $data_employeetype2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'EmployeeType' => $this->input->post('employeetype'),
              'EmployeeTypeDes' => $this->input->post('i_employeetypedes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_employeetype', $data_employeetype2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_employmenttype(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditemploymenttype')) {
            $id = $this->input->post('IDNumber');
            $data_employmenttype = array(
              'EmploymentType' => $this->input->post('employmenttype'),
              'EmploymentTypeDes' => $this->input->post('i_employmenttypedes') 
            );
            $this->M_humanresource->update_employmenttype_data_byid_append($id, $data_employmenttype);
            $data_employmenttype1 = array(
              'EmploymentType' => $this->input->post('employmenttype')
            );
            $this->M_humanresource->update_employmenttype_data_byid($id, $data_employmenttype1);
            $data_employmenttype2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'EmploymentType' => $this->input->post('employmenttype'),
              'EmploymentTypeDes' => $this->input->post('i_employmenttypedes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_employmenttype', $data_employmenttype2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_jobtitle(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditjobtitle')) {
            $id = $this->input->post('IDNumber');
            $data_jobtitle = array(
              'JobTitle' => $this->input->post('jobtitle'),
              'JobTitleDes' => $this->input->post('i_jobtitle') 
            );
            $this->M_humanresource->update_jobtitle_data_byid_append($id, $data_jobtitle);
            $data_jobtitle1 = array(
              'JobTitle' => $this->input->post('jobtitle')
            );
            $this->M_humanresource->update_jobtitle_data_byid($id, $data_jobtitle1);
            $data_jobtitle2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'JobTitle' => $this->input->post('jobtitle'),
              'JobTitleDes' => $this->input->post('i_jobtitle'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_jobtitle', $data_jobtitle2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_positiontitle(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditpositiontitle')) {
            $id = $this->input->post('IDNumber');
            $data_positiontitle = array(
              'PositionTitle' => $this->input->post('positiontitle'),
              'PositionTitleDes' => $this->input->post('i_positiontitle') 
            );
            $this->M_humanresource->update_positiontitle_data_byid_append($id, $data_positiontitle);
            $data_positiontitle1 = array(
              'PositionTitle' => $this->input->post('positiontitle')
            );
            $this->M_humanresource->update_positiontitle_data_byid($id, $data_positiontitle1);
            $data_positiontitle2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'JobPosition' => $this->input->post('positiontitle'),
              'JobPositionDes' => $this->input->post('i_positiontitle'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_jobposition', $data_positiontitle2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_individualgrade(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditindividualgrade')) {
            $id = $this->input->post('IDNumber');
            $data_upt_app_grade = array(
              'IndividualGrade' => $this->input->post('individualgrade'),
              'IndividualGradeDes' => $this->input->post('i_individualgradedes'),
              'IndividualLevelCode' => $this->input->post('i_levelcode'),
              'IndividualLevel' => $this->input->post('i_level'),
              'IndividualLevelDes' => $this->input->post('i_leveldes'),
              'IndividualLevelMgtType' => $this->input->post('i_mgttype'),
              'IndividualLevelMgtGroup' => $this->input->post('i_mgtgroup')
            );
            $this->M_humanresource->update_grade_level_data_byid_append($id, $data_upt_app_grade);
            $data_upt_job_grade = array(
              'IndividualGrade' => $this->input->post('individualgrade'),
              'IndividualLevel' => $this->input->post('i_level')
            );
            $this->M_humanresource->update_grade_level_data_byid($id, $data_upt_job_grade);
            $data_upt_his_level = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'EmployeeLevel' => $this->input->post('i_level'),
              'EmployeeLevelDes' => $this->input->post('i_leveldes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_employeelevel', $data_upt_his_level);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_individuallevel(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditindividuallevel')) {
            $id = $this->input->post('IDNumber');
            $data_upt_app_level = array(
              'IndividualLevelCode' => $this->input->post('i_levelcode'),
              'IndividualLevel' => $this->input->post('i_level'),
              'IndividualLevelDes' => $this->input->post('i_leveldes'),
              'IndividualLevelMgtType' => $this->input->post('i_mgttype'),
              'IndividualLevelMgtGroup' => $this->input->post('i_mgtgroup')
            );
            $this->M_humanresource->update_level_data_byid_append($id, $data_upt_app_level);
            $data_upt_job_level = array(
              'IndividualLevel' => $this->input->post('i_levelcode')
            );
            $this->M_humanresource->update_level_data_byid($id, $data_upt_job_level);
            $data_upt_his_level = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'EmployeeLevel' => $this->input->post('i_levelcode'),
              'EmployeeLevelDes' => $this->input->post('i_leveldes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_employeelevel', $data_upt_his_level);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_workfunction(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkfunction')) {
            $id = $this->input->post('IDNumber');
            $data_workfunction = array(
              'WorkFunction' => $this->input->post('workfunction'),
              'WorkFunctionDes' => $this->input->post('i_workfunctiondes') 
            );
            $this->M_humanresource->update_workfunction_data_byid_append($id, $data_workfunction);
            $data_workfunction1 = array(
              'WorkFunction' => $this->input->post('workfunction')
            );
            $this->M_humanresource->update_workfunction_data_byid($id, $data_workfunction1);
            $data_workfunction2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'WorkFunction' => $this->input->post('workfunction'),
              'WorkFunctionDes' => $this->input->post('i_workfunctiondes'),
              'WorkGroup' => $this->input->post('i_wgroup'),
              'WorkGroupDes' => $this->input->post('i_wgroupdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_jobworkfunction', $data_workfunction2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_workgroup(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkgroup')) {
            $id = $this->input->post('IDNumber');
            $data_workgroup = array(
              'Crew' => $this->input->post('crew'),
              'CrewDes' => $this->input->post('i_workgroup') 
            );
            $this->M_humanresource->update_workgroup_data_byid_append($id, $data_workgroup);
            $data_workgroup1 = array(
              'Crew' => $this->input->post('crew')
            );
            $this->M_humanresource->update_workgroup_data_byid($id, $data_workgroup1);
            $data_workgroup2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Crew' => $this->input->post('crew'),
              'CrewDes' => $this->input->post('i_workgroup'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_crew', $data_workgroup2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_onsitemarital(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditonsitemarital')) {
            $id = $this->input->post('IDNumber');
            $data_onsitemarital = array(
              'OnsiteMarital' => $this->input->post('onsitemarital'),
              'OnsiteMaritalDes' => $this->input->post('i_onsitemaritaldes') 
            );
            $this->M_humanresource->update_onsitemarital_data_byid_append($id, $data_onsitemarital);
            $data_onsitemarital1 = array(
              'OnsiteMarital' => $this->input->post('onsitemarital')
            );
            $this->M_humanresource->update_onsitemarital_data_byid($id, $data_onsitemarital1);
            $data_onsitemarital2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'OnsiteMarital' => $this->input->post('onsitemarital'),
              'OnsiteMaritalDes' => $this->input->post('i_onsitemaritaldes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_onsitemarital', $data_onsitemarital2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_maritalbenefit(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditmaritalbenefit')) {
            $id = $this->input->post('IDNumber');
            $data_maritalbenefit = array(
              'MaritalBenefit' => $this->input->post('maritalbenefit'),
              'MaritalBenefitDes' => $this->input->post('i_maritalbenefitdes') 
            );
            $this->M_humanresource->update_maritalbenefit_data_byid_append($id, $data_maritalbenefit);
            $data_maritalbenefit1 = array(
              'MaritalBenefit' => $this->input->post('maritalbenefit')
            );
            $this->M_humanresource->update_maritalbenefit_data_byid($id, $data_maritalbenefit1);
            $data_maritalbenefit2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'MaritalBenefit' => $this->input->post('maritalbenefit'),
              'MaritalBenefitDes' => $this->input->post('i_maritalbenefitdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_maritalbenefit', $data_maritalbenefit2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_probationdate(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditprobationdate')) {
            $id = $this->input->post('IDNumber');
            $data_probationdate = array(
              'ProbationDate' => $this->input->post('probationdate')
            );
            $this->M_humanresource->update_probationdate_data_byid_append($id, $data_probationdate);
            $data_probationdate1 = array(
              'ProbationDate' => $this->input->post('probationdate')
            );
            $this->M_humanresource->update_probationdate_data_byid($id, $data_probationdate1);
            $data_probationdate2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'ProbationDate' => $this->input->post('probationdate'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_probationdate', $data_probationdate2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_hiredate(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitedithiredate')) {
            $id = $this->input->post('IDNumber');
            $data_hiredate = array(
              'HireDate' => $this->input->post('hiredate')
            );
            $this->M_humanresource->update_hiredate_data_byid_append($id, $data_hiredate);
            $data_hiredate1 = array(
              'HireDate' => $this->input->post('hiredate')
            );
            $this->M_humanresource->update_hiredate_data_byid($id, $data_hiredate1);
            $data_hiredate2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'HireDate' => $this->input->post('hiredate'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_hiredate', $data_hiredate2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_servicedate(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditservicedate')) {
            $id = $this->input->post('IDNumber');
            $data_servicedate = array(
              'ServiceDate' => $this->input->post('servicedate')
            );
            $this->M_humanresource->update_servicedate_data_byid_append($id, $data_servicedate);
            $data_servicedate1 = array(
              'ServiceDate' => $this->input->post('servicedate')
            );
            $this->M_humanresource->update_servicedate_data_byid($id, $data_servicedate1);
            $data_servicedate2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'ServiceDate' => $this->input->post('servicedate'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_servicedate', $data_servicedate2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_pointofhire(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditpointofhire')) {
            $id = $this->input->post('IDNumber');
            $data_pointofhire = array(
              'PointofHire' => $this->input->post('pointofhire')
            );
            $this->M_humanresource->update_pointofhire_data_byid_append($id, $data_pointofhire);
            $data_pointofhire1 = array(
              'PointofHire' => $this->input->post('pointofhire')
            );
            $this->M_humanresource->update_pointofhire_data_byid($id, $data_pointofhire1);
            $data_pointofhire2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'PointOfHire' => $this->input->post('pointofhire'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_pointofhire', $data_pointofhire2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_pointofleave(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditpointofleave')) {
            $id = $this->input->post('IDNumber');
            $data_pointofleave = array(
              'PointofLeave' => $this->input->post('pointofleave')
            );
            $this->M_humanresource->update_pointofleave_data_byid_append($id, $data_pointofleave);
            $data_pointofleave1 = array(
              'PointofLeave' => $this->input->post('pointofleave')
            );
            $this->M_humanresource->update_pointofleave_data_byid($id, $data_pointofleave1);
            $data_pointofleave2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'PointOfLeave' => $this->input->post('pointofleave'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_pointofleave', $data_pointofleave2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_pointoftravel(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditpointoftravel')) {
            $id = $this->input->post('IDNumber');
            $data_pointoftravel = array(
              'PointofTravel' => $this->input->post('pointoftravel')
            );
            $this->M_humanresource->update_pointoftravel_data_byid_append($id, $data_pointoftravel);
            $data_pointoftravel1 = array(
              'PointofTravel' => $this->input->post('pointoftravel')
            );
            $this->M_humanresource->update_pointoftravel_data_byid($id, $data_pointoftravel1);
            $data_pointoftravel2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'PointOfTravel' => $this->input->post('pointoftravel'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_pointoftravel', $data_pointoftravel2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_worklocation(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworklocation')) {
            $id = $this->input->post('IDNumber');
            $data_worklocation = array(
              'WorkLocation' => $this->input->post('worklocation')
            );
            $this->M_humanresource->update_worklocation_data_byid_append($id, $data_worklocation);
            $data_worklocation1 = array(
              'WorkLocation' => $this->input->post('worklocation')
            );
            $this->M_humanresource->update_worklocation_data_byid($id, $data_worklocation1);
            $data_worklocation2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'WorkLocation' => $this->input->post('worklocation'),
              'WorkLocationDes' => 'WorkLocationDes',
              'Branch' => 'Branch',
              'BranchDes' => 'BranchDes',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_location', $data_worklocation2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_supervisor(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditsupervisor')) {
            $id = $this->input->post('IDNumber');
            $data_supervisor = array(
              'Supervisor' => $this->input->post('supervisor'),
              'SupervisorName' => $this->input->post('i_sup_des'),
              'SupervisorTitle' => $this->input->post('i_sup_title_code'),
              'SupervisorTitleDes' => $this->input->post('i_sup_title_des') 
            );
            $this->M_humanresource->update_supervisor_data_byid_append($id, $data_supervisor);
            $data_supervisor1 = array(
              'Supervisor' => $this->input->post('supervisor')
            );
            $this->M_humanresource->update_supervisor_data_byid($id, $data_supervisor1);
            $data_supervisor2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Supervisor' => $this->input->post('supervisor'),
              'SupervisorName' => $this->input->post('i_sup_des'),
              'SupervisorTitle' => $this->input->post('i_sup_title_code'), 
              'SupervisorTitleDes' => $this->input->post('i_sup_title_des'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_supervisor', $data_supervisor2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_workinsurance(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkinsurance')) {
            $id = $this->input->post('IDNumber');
            $data_workinsurance = array(
              'WorkInsurance' => $this->input->post('workinsurance'),
              'WorkInsuranceDes' => 'WorkInsuranceDes'
            );
            $this->M_humanresource->update_workinsurance_data_byid_append($id, $data_workinsurance);
            $data_workinsurance1 = array(
              'WorkInsurance' => $this->input->post('workinsurance')
            );
            $this->M_humanresource->update_workinsurance_data_byid($id, $data_workinsurance1);
            $data_workinsurance2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'InsuranceBPJS' => $this->input->post('workinsurance'),
              'InsuranceBPJSDes' => 'WorkInsuranceDes',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_insurancebpjs', $data_workinsurance2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_medicalinsurance(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditmedicalinsurance')) {
            $id = $this->input->post('IDNumber');
            $data_medicalinsurance = array(
              'MedicalInsurance' => $this->input->post('medicalinsurance'),
              'MedicalInsuranceDes' => 'MedicalInsuranceDes'
            );
            $this->M_humanresource->update_medicalinsurance_data_byid_append($id, $data_medicalinsurance);
            $data_medicalinsurance1 = array(
              'MedicalInsurance' => $this->input->post('medicalinsurance')
            );
            $this->M_humanresource->update_medicalinsurance_data_byid($id, $data_medicalinsurance1);
            $data_medicalinsurance2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'InsuranceMedical' => $this->input->post('medicalinsurance'),
              'InsuranceMedicalDes' => 'MedicalInsuranceDes',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_insurancemedical', $data_medicalinsurance2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_workday(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkday')) {
            $id = $this->input->post('IDNumber');
            $data_workday = array(
              'WorkDay' => $this->input->post('workday'),
              'WorkDayDes' => $this->input->post('i_workdaydes')
            );
            $this->M_humanresource->update_workday_data_byid_append($id, $data_workday);
            $data_workday1 = array(
              'WorkDay' => $this->input->post('workday')
            );
            $this->M_humanresource->update_workday_data_byid($id, $data_workday1);
            $data_workday2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'WorkDay' => $this->input->post('workday'),
              'WorkDayDes' => $this->input->post('i_workdaydes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_workday', $data_workday2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }


    function update_leavetype(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditleavetype')) {
            $id = $this->input->post('IDNumber');
            $data_leavetype = array(
              'LeaveType' => $this->input->post('leavetype'),
              'LeaveTypeDes' => $this->input->post('i_leavetypedes')
            );
            $this->M_humanresource->update_leavetype_data_byid_append($id, $data_leavetype);
            $data_leavetype1 = array(
              'LeaveType' => $this->input->post('leavetype')
            );
            $this->M_humanresource->update_leavetype_data_byid($id, $data_leavetype1);
            $data_leavetype2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'LeaveType' => $this->input->post('leavetype'),
              'LeaveTypeDes' => $this->input->post('i_leavetypedes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_leavetype', $data_leavetype2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_bankaccount1(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditbankaccount1')) {
            $id = $this->input->post('IDNumber');
            $data_bankaccount1 = array(
              'BankAccount1' => $this->input->post('bankaccount1'),
              'BankAccount1Des' => 'BankAccount1Des'
            );
            $this->M_humanresource->update_bankaccount1_data_byid_append($id, $data_bankaccount1);
            $data_bankaccount11 = array(
              'BankAccount1' => $this->input->post('bankaccount1')
            );
            $this->M_humanresource->update_bankaccount1_data_byid($id, $data_bankaccount11);
            $data_bankaccount12 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'BankAccount1' => $this->input->post('bankaccount1'),
              'BankAccount1Des' => 'BankAccount1Des',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_bankaccount1', $data_bankaccount12);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_bankaccount2(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditbankaccount2')) {
            $id = $this->input->post('IDNumber');
            $data_bankaccount2 = array(
              'BankAccount2' => $this->input->post('bankaccount2'),
              'BankAccount2Des' => 'BankAccount2Des'
            );
            $this->M_humanresource->update_bankaccount2_data_byid_append($id, $data_bankaccount2);
            $data_bankaccount21 = array(
              'BankAccount2' => $this->input->post('bankaccount2')
            );
            $this->M_humanresource->update_bankaccount2_data_byid($id, $data_bankaccount21);
            $data_bankaccount22 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'BankAccount2' => $this->input->post('bankaccount2'),
              'BankAccount2Des' => 'BankAccount2Des',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_bankaccount2', $data_bankaccount22);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_uniformtshirt(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitedituniformtshirt')) {
            $id = $this->input->post('IDNumber');
            $data_uniformtshirt = array(
              'UniformTshirt' => $this->input->post('uniformtshirt'),
            );
            $this->M_humanresource->update_uniformtshirt_data_byid_append($id, $data_uniformtshirt);
            $data_uniformtshirt1 = array(
              'UniformTshirt' => $this->input->post('uniformtshirt')
            );
            $this->M_humanresource->update_uniformtshirt_data_byid($id, $data_uniformtshirt1);
            $data_uniformtshirt2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'UniformTshirt' => $this->input->post('uniformtshirt'),
              'UniformTshirtDes' => 'UniformTshirtDes',
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_uniform_tshirt', $data_uniformtshirt2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_empcompany(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditempcompany')) {
            $id = $this->input->post('IDNumber');
            $data_empcompany = array(
              'EmpCompany' => $this->input->post('empcompany'),
              'EmpCompanyDes' => $this->input->post('i_empcompanydes')
            );
            $this->M_humanresource->update_empcompany_data_byid_append($id, $data_empcompany);
            $data_empcompany1 = array(
              'EmpCompany' => $this->input->post('empcompany')
            );
            $this->M_humanresource->update_empcompany_data_byid($id, $data_empcompany1);
            $data_empcompany2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Company' => $this->input->post('empcompany'),
              'CompanyDes' => $this->input->post('i_empcompanydes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_com', $data_empcompany2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    function update_dept(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submit')) {
            $id = $this->input->post('IDNumber');
            $data_upt_app = array(
              'Company' => $this->input->post('i_companycode'),
              'ComDes' => $this->input->post('i_companydes'),
              'Branch' => $this->input->post('i_branchcode'),
              'BranchDes' => $this->input->post('i_branchdes'),
              'DivCode' => $this->input->post('i_divcode'),
              'DivisionName' => $this->input->post('i_divdes'),
              'BusinessUnit' => $this->input->post('i_bucode'),
              'BUDes' => $this->input->post('i_budes'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'CostCenter' => $this->input->post('costcenter'),
              'CostCenterDes' => $this->input->post('i_costdes')
            );
            $this->M_humanresource->update_dept_data_byid_append($id, $data_upt_app);
            $data_upt_job = array(
              'Company' => $this->input->post('i_companycode'),
              'Branch' => $this->input->post('i_branchcode'),
              'DeptCode' => $this->input->post('i_dept'),
              'CostCenter' => $this->input->post('costcenter')
            );
            $this->M_humanresource->update_dept_data_byid($id, $data_upt_job);
            // $data_upt_his_company = array(
            //   'IDNumber' => $this->input->post('IDNumber'),
            //   'Company' => $this->input->post('i_companycode'),
            //   'CompanyDes' => $this->input->post('i_companydes'),
            //   'Reason' => $this->input->post('reason'),
            //   'RegBy' => $this->session->userdata('IDNumber'),
            //   'RegDate' => date('Y-m-d')
            // );
            // $this->M_humanresource->insert('tbl_emp_per_job_his_com', $data_upt_his_company);
            $data_upt_his_branch = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Branch' => $this->input->post('i_branchcode'),
              'BranchDes' => $this->input->post('i_branchdes'),
              'Company' => $this->input->post('i_companycode'),
              'CompanyDes' => $this->input->post('i_companydes'),
              'Reason' => $this->input->post('reason')  ,
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_branch', $data_upt_his_branch);
            $data_upt_his_department = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'BuCode' => $this->input->post('i_bucode'),
              'BuDes' => $this->input->post('i_budes'),
              'DivCode' => $this->input->post('i_divcode'),
              'DivDes' => $this->input->post('i_divdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_dept', $data_upt_his_department);
            $data_upt_his_costcenter = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'CostCenterCode' => $this->input->post('costcenter'),
              'CostCenterDes' => $this->input->post('i_costdes'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_costcenter', $data_upt_his_costcenter);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal/'.$id.'/#jobinfo');        
        }
    }

    //Phonebook
    function view_phonebook() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Phonebook';
        $this->load->view('humanresource/employeeadmin/v_phonebook', $query);
    }

    //Report
    function view_report() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $this->load->view('humanresource/report/v_report_parameter', $query);
    }

    /*For Ajax Start*/
    function get_department(){
        $branch = $this->input->post('i_branch');
        $this->session->set_userdata('branch', $branch);
        if ($branch != 'All') {
            # code...
            $dep = $this->M_humanresource->get_dept_from_branch($branch);
            if(count($dep)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Department --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($dep as $bu) {
                    $select_box .='<option value="'.$bu->DeptCode.'">'.$bu->DeptCode.' | '.$bu->DeptDes.'</option>';
                }

                echo json_encode($select_box);
            }
        } else {
            $dep = $this->M_humanresource->get_dept_from_branch_all();
            if(count($dep)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Department --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($dep as $bu) {
                    $select_box .='<option value="'.$bu->DeptCode.'">'.$bu->DeptCode.' | '.$bu->DeptDes.'</option>';
                }
                echo json_encode($select_box);
            }
        }
    }

    function get_bussinessunit(){
        $dept = $this->input->post('i_dept');
        if ($dept != 'All') {
            # code...
            $bus = $this->M_humanresource->get_buss_from_comp($dept);
            if(count($bus)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Business Unit --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($bus as $dp) {
                    $select_box .='<option value="'.$dp->BUCode.'">'.$dp->BUCode.' | '.$dp->BUDes.'</option>';
                }
                echo json_encode($select_box);
            }
        } else {
            $bus = $this->M_humanresource->get_buss_from_comp_all();
            if(count($bus)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Business Unit --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($bus as $dp) {
                    $select_box .='<option value="'.$dp->BUCode.'">'.$dp->BUCode.' | '.$dp->BUDes.'</option>';
                }
                echo json_encode($select_box);
            }
        }
    }

    function get_department_by_bu(){
        $bus = $this->input->post('i_bu');
        if ($bus != 'All') {
            # code...
            $dep = $this->M_humanresource->get_dept_from_bu($bus);
            if(count($dep)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Department --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($dep as $dp) {
                    $select_box .='<option value="'.$dp->DeptCode.'">'.$dp->DeptCode.' | '.$dp->DeptDes.'</option>';
                }

                echo json_encode($select_box);
            }
        } else {
            $bus = $this->M_humanresource->get_dept_from_comp_all();
            if(count($dep)>0){
                $select_box = '';
                $select_box .= '<option disabled="true">-- Select Department --</option>';
                $select_box .= '<option value="All">All</option>';
                foreach ($dep as $dp) {
                    $select_box .='<option value="'.$dp->DeptCode.'">'.$dp->DeptCode.' | '.$dp->DeptDes.'</option>';
                }
                echo json_encode($select_box);
            }
        }
    }
    /*For Ajax End*/
    

    
    function get_list_businessunit_by_branch(){
        $branchcode =  $this->input->post('id_branch');
        $data = $this->M_humanresource->get_list_businessunit_by_branch($branchcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_department_by_businessunit(){
        $branchcode =  $this->input->post('id_branch');
        $businesscode =  $this->input->post('id_bucode');

        $data = $this->M_humanresource->get_list_department_by_businessunit($branchcode,$businesscode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_department_by_branch(){
        $branchcode =  $this->input->post('id_branch');
        $data = $this->M_humanresource->get_list_department_by_branch($branchcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }


    function get_list_costcenter_by_branch(){
        $branchcode =  $this->input->post('id_branch');
        $data = $this->M_humanresource->get_list_costcenter_by_branch($branchcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    function get_list_costcenter_by_department(){
        $branchcode =  $this->input->post('id_branch');
        $businesscode =  $this->input->post('id_bucode');
        $departmentcode =  $this->input->post('id_deptcode');
        
        $data = $this->M_humanresource->get_list_costcenter_by_department($branchcode,$businesscode,$departmentcode);
        if ($data != false) {
            echo json_encode(array('rstatus' => "success", 'data' => $data));
        } else {
            echo json_encode(array('rstatus' => "nodata"));            
        }
    }

    //Trigger Report
    function red_report_view(){
        $companyy = $this->input->post('company');
        $branchh = $this->input->post('branch');
        $bucodee = $this->input->post('bucode');
        $deptcodee = $this->input->post('deptcode');
        $costcenterr = $this->input->post('costcenter');

        $this->session->set_userdata('companys', $companyy);
        $this->session->set_userdata('branchs', $branchh);
        $this->session->set_userdata('bucodes', $bucodee);
        $this->session->set_userdata('deptcodes', $deptcodee);
        $this->session->set_userdata('costcenters', $costcenterr);

        if($this->input->post('submit') == 'Preview'){
            if ($this->input->post('parametertype') == 'pemployetype'){
                redirect('Humanresource/view_report_preview_by_emptype/no');
            }
            else if ($this->input->post('parametertype') == 'pemployeclass'){ 
                redirect('Humanresource/view_report_preview_by_empclass/no');
            }
            else if ($this->input->post('parametertype') == 'pemploymenttype'){
                redirect('Humanresource/view_report_preview_by_employmenttype/no');
            }
            else if ($this->input->post('parametertype') == 'pemployeefunction'){
                redirect('Humanresource/view_report_preview_by_empfunction/no');
            }
            else if ($this->input->post('parametertype') == 'pgender'){
                redirect('Humanresource/view_report_preview_by_gender/no');  
            }
            else if ($this->input->post('parametertype') == 'preligion'){
                redirect('Humanresource/view_report_preview_by_religion/no');  
            }
            else if ($this->input->post('parametertype') == 'pmarital'){
                redirect('Humanresource/view_report_preview_by_marital/no');  
            }
        }
    }
    //Report Employee Type
    function view_report_preview_by_emptype($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparameteretype'] = $parameteretype = 'Employee Type';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $etype_all_ = $this->session->userdata('etype_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_emptype'] = $this->M_humanresource->get_count_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_etype_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_etype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_etype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_etype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_etype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['emptype'] = $this->M_humanresource->get_report_emp_etype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_etype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_etype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($etype_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['employeetype'] = $this->M_humanresource->get_report_by_employeetype_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$etype_all_);
                } else {
                    $query['tpe'] = 'All';
                    $query['employeetype'] = $this->M_humanresource->get_report_by_employeetype_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$etype_all_);
                }   
                $query['dataetype'] = $this->M_humanresource->get_report_data_by_employeetype_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$etype_all_);
                $query['detotal'] = $this->M_humanresource->get_report_data_by_employeetype_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$etype_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_emptype'] = $this->M_humanresource->get_count_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_etype_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_etype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_etype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_etype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_etype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['emptype'] = $this->M_humanresource->get_report_emp_etype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_etype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_etype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['etypest'] = $this->M_humanresource->get_report_emp_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataetype'] = $this->M_humanresource->get_report_data_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['employeetype'] = $this->M_humanresource->get_report_by_employeetype_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['dataetype'] = $this->M_humanresource->get_report_data_by_employeetype_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_employeetype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }
        $this->load->view('humanresource/report/v_report_employeetype', $query);         
    }

    function view_report_preview_by_employeetype_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$etype){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('etype_all', $etype);
        redirect('Humanresource/view_report_preview_by_emptype/'.$det);
    }


    //Report Employment Class
    function view_report_preview_by_empclass($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparametereclass'] = $parametereclass = 'Employee Class';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $empclass_all_ = $this->session->userdata('empclass_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_empclass'] = $this->M_humanresource->get_count_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_empclass_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_empclass_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_empclass_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_empclass_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_eclass_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['empclass'] = $this->M_humanresource->get_report_emp_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_empclass_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_empclass_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($empclass_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['employeeclass'] = $this->M_humanresource->get_report_by_empclass_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empclass_all_);
                        // print_r($query['terserah']);die;
                } else {
                    $query['tpe'] = 'All';
                    $query['employeeclass'] = $this->M_humanresource->get_report_by_empclass_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empclass_all_);
                        //print_r($query['employmenttype']);die;
                }   
                $query['dataempclass'] = $this->M_humanresource->get_report_data_by_empclass_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empclass_all_);
                // print_r($query['dataempltype']);die;
                $query['detotal'] = $this->M_humanresource->get_report_data_by_empclass_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empclass_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_empclass'] = $this->M_humanresource->get_count_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_empclass_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_empclass_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_empclass_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_empclass_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_eclass_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['empclass'] = $this->M_humanresource->get_report_emp_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_empclass_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_empclass_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['empclassst'] = $this->M_humanresource->get_report_emp_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataempclass'] = $this->M_humanresource->get_report_data_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['employeeclass'] = $this->M_humanresource->get_report_by_empclass_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['dataempclass'] = $this->M_humanresource->get_report_data_by_empclass_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_empclass_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }

        // print_r($query);
        // die();

        $this->load->view('humanresource/report/v_report_employeeclass', $query);         
    }

    function view_report_preview_by_employeeclass_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$eclass){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('empclass_all', $eclass);
        redirect('Humanresource/view_report_preview_by_empclass/'.$det);
    }


    //Report Employment Type
    function view_report_preview_by_employmenttype($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparameteremploymenttype'] = $parameteremploymenttype = 'Employment Type';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $empltype_all_ = $this->session->userdata('empltype_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_employmenttype'] = $this->M_humanresource->get_count_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_employment_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_employmenttype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_employmenttype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_employmenttype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_employmenttype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['empltype'] = $this->M_humanresource->get_report_emp_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_employmenttype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_employmenttype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($empltype_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['employmenttype'] = $this->M_humanresource->get_report_by_employmenttype_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empltype_all_);
                        // print_r($query['terserah']);die;
                } else {
                    $query['tpe'] = 'All';
                    $query['employmenttype'] = $this->M_humanresource->get_report_by_employmenttype_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empltype_all_);
                        //print_r($query['employmenttype']);die;
                }   
                $query['dataempltype'] = $this->M_humanresource->get_report_data_by_employmenttype_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empltype_all_);
                // print_r($query['dataempltype']);die;
                $query['detotal'] = $this->M_humanresource->get_report_data_by_employmenttype_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$empltype_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_employmenttype'] = $this->M_humanresource->get_count_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_employment_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_employmenttype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_employmenttype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_employmenttype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_employmenttype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['empltype'] = $this->M_humanresource->get_report_emp_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_employmenttype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_employmenttype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['employmenttypest'] = $this->M_humanresource->get_report_emp_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataempltype'] = $this->M_humanresource->get_report_data_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['employmenttype'] = $this->M_humanresource->get_report_by_employmenttype_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['dataempltype'] = $this->M_humanresource->get_report_data_by_employmenttype_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_employmenttype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }

        // print_r($query);
        // die();

        $this->load->view('humanresource/report/v_report_employmenttype', $query);         
    }

    function view_report_preview_by_employmenttype_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empltype){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('empltype_all', $empltype);
        redirect('Humanresource/view_report_preview_by_employmenttype/'.$det);
    }

    //Report Employee Function
    function view_report_preview_by_empfunction($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparameterempfunction'] = $parameterempfunction = 'Employee Function';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $empfunction_all_ = $this->session->userdata('empfunction_all'); 
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;
        if ($det == 'yes') {
            $query['det'] = $det;
            //All Category & //Summary
            $query['r_data_empfunction'] = $this->M_humanresource->get_count_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['datas'] = $this->M_humanresource->get_report_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

            //Details
            // $query['empfunction'] = $empfunction_all_;
            $query['empfunctionst'] = $this->M_humanresource->get_report_emp_by_employeefunction_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empfunction_all_);
            $query['dataempfunction'] = $this->M_humanresource->get_report_data_by_employeefunction_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_, $empfunction_all_);
            $query['detotal'] = $this->M_humanresource->get_report_data_by_employeefunction_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_, $empfunction_all_);
        }else {
            $query['det'] = $det;
            $this->session->set_userdata('index', '');
            //All Category & //Summary
            $query['r_data_empfunction'] = $this->M_humanresource->get_count_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['datas'] = $this->M_humanresource->get_report_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

            //Details
            $query['empfunctionst'] = $this->M_humanresource->get_report_emp_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataempfunction'] = $this->M_humanresource->get_report_data_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['detotal'] = $this->M_humanresource->get_report_data_by_employeefunction_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        }
        $this->load->view('humanresource/report/v_report_employeefunction', $query);     
    }

    function view_report_preview_by_empfunction_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$empf, $ind){

        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('empfunction_all', $empf);
        $this->session->set_userdata('index', $ind);

        redirect('Humanresource/view_report_preview_by_empfunction/'.$det);
    }



    //Report Gender
    function view_report_preview_by_gender($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparametergender'] = $parameteretype = 'Gender';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $gender_all_ = $this->session->userdata('gender_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_gender'] = $this->M_humanresource->get_count_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_gender_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_gender_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_gender_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_gender_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['genders'] = $this->M_humanresource->get_report_emp_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_gender_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_gender_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($gender_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['gender'] = $this->M_humanresource->get_report_by_gender_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$gender_all_);
                } else {
                    $query['tpe'] = 'All';
                    $query['gender'] = $this->M_humanresource->get_report_by_gender_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$gender_all_);
                }   
                $query['datagender'] = $this->M_humanresource->get_report_data_by_gender_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$gender_all_);
                $query['detotal'] = $this->M_humanresource->get_report_data_by_gender_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$gender_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_gender'] = $this->M_humanresource->get_count_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_gender_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_gender_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_gender_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_gender_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['genders'] = $this->M_humanresource->get_report_emp_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_gender_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_gender_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['genderst'] = $this->M_humanresource->get_report_emp_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['datagender'] = $this->M_humanresource->get_report_data_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['gender'] = $this->M_humanresource->get_report_by_gender_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['datagender'] = $this->M_humanresource->get_report_data_by_gender_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_gender_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }
        $this->load->view('humanresource/report/v_report_gender', $query);         
    }

    function view_report_preview_by_gender_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$gender){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('gender_all', $gender);
        redirect('Humanresource/view_report_preview_by_gender/'.$det);
    }

    //Report Religion
    function view_report_preview_by_religion($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparameterreligion'] = $parameteretype = 'Religion';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $religion_all_ = $this->session->userdata('religion_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_religion'] = $this->M_humanresource->get_count_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_religion_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_religion_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_religion_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_religion_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['religions'] = $this->M_humanresource->get_report_emp_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_religion_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_religion_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($religion_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['religion'] = $this->M_humanresource->get_report_by_religion_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$religion_all_);
                } else {
                    $query['tpe'] = 'All';
                    $query['religion'] = $this->M_humanresource->get_report_by_religion_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$religion_all_);
                }   
                $query['datareligion'] = $this->M_humanresource->get_report_data_by_religion_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$religion_all_);
                $query['detotal'] = $this->M_humanresource->get_report_data_by_religion_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$religion_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_religion'] = $this->M_humanresource->get_count_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_religion_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_religion_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_religion_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_religion_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['religions'] = $this->M_humanresource->get_report_emp_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_religion_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_religion_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['religionst'] = $this->M_humanresource->get_report_emp_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['datareligion'] = $this->M_humanresource->get_report_data_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['religion'] = $this->M_humanresource->get_report_by_religion_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['datareligion'] = $this->M_humanresource->get_report_data_by_religion_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_religion_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }
        $this->load->view('humanresource/report/v_report_religion', $query);         
    }

    function view_report_preview_by_religion_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$religion){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('religion_all', $religion);
        redirect('Humanresource/view_report_preview_by_religion/'.$det);
    }

    //Report Marital
    function view_report_preview_by_marital($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Report Employee';
        $query['last_comp'] = $this->M_humanresource->get_last_data_company();
        $query['branch'] = $this->M_humanresource->get_data_branch();
        $query['rparametermarital'] = $parameteretype = 'Marital';

        // $query['rcompany'] = $company_ = $this->input->post('company');
        // $query['rbranch'] = $branch_ = $this->input->post('branch');
        // $query['rbucode'] = $bucode_ = $this->input->post('bucode');
        // $query['rdeptcode'] = $deptcode_ = $this->input->post('deptcode');
        // $query['rcostcenter'] = $costcenter_ = $this->input->post('costcenter');
          
        $company_ = $this->session->userdata('companys');            
        $branch_ = $this->session->userdata('branchs'); 
        $bucode_ = $this->session->userdata('bucodes'); 
        $deptcode_ = $this->session->userdata('deptcodes'); 
        $costcenter_ = $this->session->userdata('costcenters'); 

        $company_all_ = $this->session->userdata('company_all');            
        $branch_all_ = $this->session->userdata('branch_all'); 
        $bucode_all_ = $this->session->userdata('bucode_all'); 
        $deptcode_all_ = $this->session->userdata('deptcode_all'); 
        $costcenter_all_ = $this->session->userdata('costcenter_all'); 
        $marital_all_ = $this->session->userdata('marital_all'); 
        if ($det == 'yes') {
                $query['det'] = $det;
                //All Caterory
                $query['r_data_marital'] = $this->M_humanresource->get_count_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                //Summary
                $query['comp'] = $this->M_humanresource->get_report_emp_marital_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['databranch'] = $this->M_humanresource->get_report_emp_marital_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['buss'] = $this->M_humanresource->get_report_emp_marital_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dept'] = $this->M_humanresource->get_report_emp_marital_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['costcenter'] = $this->M_humanresource->get_report_emp_marital_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['maritals'] = $this->M_humanresource->get_report_emp_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['dataget'] = $this->M_humanresource->get_report_emp_marital_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                $query['grandtotal'] = $this->M_humanresource->get_report_emp_marital_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
                if ($marital_all_ != 'All') {
                    # code...
                    $query['tpe'] = 'Not';
                    // $query['employeetype'] = $etype_all_;
                    $query['marital'] = $this->M_humanresource->get_report_by_marital_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$marital_all_);
                } else {
                    $query['tpe'] = 'All';
                    $query['marital'] = $this->M_humanresource->get_report_by_marital_type($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$marital_all_);
                }   
                $query['datamarital'] = $this->M_humanresource->get_report_data_by_marital_det($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$marital_all_);
                $query['detotal'] = $this->M_humanresource->get_report_data_by_marital_det_total($company_all_, $branch_all_, $bucode_all_, $deptcode_all_, $costcenter_all_,$marital_all_);
                // print_r($query['dataetype']);die();
        }else{
            $query['det'] = $det;
            //All Caterory
            $query['r_data_marital'] = $this->M_humanresource->get_count_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            //Summary
            $query['comp'] = $this->M_humanresource->get_report_emp_marital_comp($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['databranch'] = $this->M_humanresource->get_report_emp_marital_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['buss'] = $this->M_humanresource->get_report_emp_marital_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dept'] = $this->M_humanresource->get_report_emp_marital_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['costcenter'] = $this->M_humanresource->get_report_emp_marital_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['maritals'] = $this->M_humanresource->get_report_emp_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['dataget'] = $this->M_humanresource->get_report_emp_marital_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['grandtotal'] = $this->M_humanresource->get_report_emp_marital_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


            //Details
            $query['maritalst'] = $this->M_humanresource->get_report_emp_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['datagender'] = $this->M_humanresource->get_report_data_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
            $query['tpe'] = 'All';
            $query['marital'] = $this->M_humanresource->get_report_by_marital_type($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['datamarital'] = $this->M_humanresource->get_report_data_by_marital_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
            $query['detotal'] = $this->M_humanresource->get_report_data_by_marital_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        }
        $this->load->view('humanresource/report/v_report_marital', $query);         
    }

    function view_report_preview_by_marital_det($det,$company_, $branch_, $bucode_, $deptcode_, $costcenter_,$marital){
        
        $this->session->set_userdata('company_all', $company_);
        $this->session->set_userdata('branch_all', $branch_);
        $this->session->set_userdata('bucode_all', $bucode_);
        $this->session->set_userdata('deptcode_all', $deptcode_);
        $this->session->set_userdata('costcenter_all', $costcenter_);
        $this->session->set_userdata('marital_all', $marital);
        redirect('Humanresource/view_report_preview_by_marital/'.$det);
    }


    //Career & Development
    function view_career_development() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Career & Development';
        $query['data_list'] = $this->M_humanresource->get_data_personaldata_list();
        $this->load->view('humanresource/development/v_career_development', $query);
    }

    function view_edit_career_development_by_id($id) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Career & Development';
        $query['headertitle'] = 'Edit Career & Development';
        $query['personal'] = $this->M_humanresource->get_data_personaldata($id);
        $query['experience'] = $this->M_humanresource->get_data_experience_byid($id);
        $query['education'] = $this->M_humanresource->get_data_formal_byid($id);
        $query['training'] = $this->M_humanresource->get_data_training_byid($id);
        $query['language'] = $this->M_humanresource->get_data_language_byid($id);
        $query['hobby'] = $this->M_humanresource->get_data_hobby_byid($id);
        $this->load->view('humanresource/development/v_edit_careerdevelopment', $query);
    }

    //Experience
    function add_experience(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitexperience')) {
            $id = $this->input->post('IDNumber');
            //Experience
            $query['Mcompanyexperience'] = $companyexperience_ = $this->input->post('companyexperience');
            $query['Mlocationexperience'] = $locationexperience_ = $this->input->post('locationexperience');
            $query['Mfromyearexperience'] = $fromyearexperience_ = $this->input->post('fromyearexperience');
            $query['Mtoyearexperience'] = $toyearexperience_ = $this->input->post('toyearexperience');
            $query['Mdurationexperience'] = $durationexperience_ = $this->input->post('durationexperience');
            $query['Mlastpositionexperience'] = $lastpositionexperience_ = $this->input->post('lastpositionexperience');
            $query['Mcommentsexperience'] = $commentsexperience_ = $this->input->post('commentsexperience');
        
            $data_experience = array(
                'IDNumber' =>$id,
                'Company' =>$companyexperience_,
                'Location' =>$locationexperience_,
                'FromYear' =>$fromyearexperience_,
                'ToYear' =>$toyearexperience_,
                'Duration' =>$durationexperience_,
                'LastPosition' =>$commentsexperience_,
                'Comments' =>$commentsexperience_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_cd_career_experience', $data_experience);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#experience');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#experience');        
        }
    }

    function delete_experience($id,$cno){
        $this->M_humanresource->delete_data_experience($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#experience');  
    }

    function edit_experience(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditexperience')) {
            $ctrlno = $this->input->post('ControlNo');
            $id = $this->input->post('IDNumber');
            $data_edit_experience = array(
              'Company' => $this->input->post('companyexperience'),
              'Location' => $this->input->post('locationexperience'),
              'FromYear' => $this->input->post('fromyearexperience'),
              'ToYear' => $this->input->post('toyearexperience'),
              'Duration' => $this->input->post('durationexperience'),
              'LastPosition' => $this->input->post('lastpositionexperience'),
              'Comments' => $this->input->post('commentsexperience')
            );
            $this->M_humanresource->edit_data_experience($ctrlno, $data_edit_experience);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#experience');        
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#experience');       
        }
    }

    //Education
    function add_education(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteducation')) {
            $id = $this->input->post('IDNumber');
            //Experience
            $query['Minstitutioneducation'] = $institutioneducation_ = $this->input->post('institutioneducation');
            $query['Mlocationeducation'] = $locationeducation_ = $this->input->post('locationeducation');
            $query['Mcompetecieseducation'] = $competecieseducation_ = $this->input->post('competecieseducation');
            $query['Mfromyeareducation'] = $fromyeareducation_ = $this->input->post('fromyeareducation');
            $query['Mtoyeareducation'] = $toyeareducation_ = $this->input->post('toyeareducation');
            $query['Mdurationeducation'] = $durationeducation_ = $this->input->post('durationeducation');
            $query['Mcertificatededucation'] = $certificatededucation_ = $this->input->post('certificatededucation');
        
            $data_education = array(
                'IDNumber' =>$id,
                'Institution' =>$institutioneducation_,
                'Location' =>$locationeducation_,
                'Competecies' =>$competecieseducation_,
                'FromYear' =>$fromyeareducation_,
                'ToYear' =>$toyeareducation_,
                'Duration' =>$durationeducation_,
                'Certificated' =>$certificatededucation_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_cd_career_formal', $data_education);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#education');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#education');        
        }
    }

    function delete_education($id,$cno){
        $this->M_humanresource->delete_data_education($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#education');  
    }

    function edit_education(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitediteducation')) {
            $ctrlno = $this->input->post('ControlNo');
            $id = $this->input->post('IDNumber');
            $data_edit_education = array(
              'Institution' => $this->input->post('institutioneducation'),
              'Location' => $this->input->post('locationeducation'),
              'Competecies' => $this->input->post('competecieseducation'),
              'FromYear' => $this->input->post('fromyeareducation'),
              'ToYear' => $this->input->post('toyeareducation'),
              'Duration' => $this->input->post('durationeducation'),
              'Certificated' => $this->input->post('certificatededucation')
            );
            $this->M_humanresource->edit_data_education($ctrlno, $data_edit_education);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#education');        
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#education');       
        }
    }

    //Training
    function add_training(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submittraining')) {
            $id = $this->input->post('IDNumber');
            //Experience
            $query['Mdaterequesttraining'] = $daterequesttraining_ = $this->input->post('daterequesttraining');
            $query['Mcoursetypetraining'] = $coursetypetraining_ = $this->input->post('coursetypetraining');
            $query['Mcoursetypexternaltraining'] = $coursetypexternaltraining_ = $this->input->post('coursetypexternaltraining');
            $query['Mcoursenametraining'] = $coursenametraining_ = $this->input->post('coursenametraining');
            $query['Mcoursestarttraining'] = $coursestarttraining_ = $this->input->post('coursestarttraining');
            $query['Mcourseendtraining'] = $courseendtraining_ = $this->input->post('courseendtraining');
            $query['Mdurationtraining'] = $durationtraining_ = $this->input->post('durationtraining');
            $query['Minstitutiontraining'] = $institutiontraining_ = $this->input->post('institutiontraining');
            $query['Minstitutionaddresstraining'] = $institutionaddresstraining_ = $this->input->post('institutionaddresstraining');
            $query['Minstitutioncontacttraining'] = $institutioncontacttraining_ = $this->input->post('institutioncontacttraining');
            $query['Minstitutionaccountnotraining'] = $institutionaccountnotraining_ = $this->input->post('institutionaccountnotraining');
            $query['Mestimatecosttraining'] = $estimatecosttraining_ = $this->input->post('estimatecosttraining');
            $query['Mactualcosttraining'] = $actualcosttraining_ = $this->input->post('actualcosttraining');
            $query['Mapprovedbytraining'] = $approvedbytraining_ = $this->input->post('approvedbytraining');
            $query['Mjustificationtraining'] = $justificationtraining_ = $this->input->post('justificationtraining');
            $query['Mresulttraining'] = $resulttraining_ = $this->input->post('resulttraining');
            $query['Mresultcommentstraining'] = $resultcommentstraining_ = $this->input->post('resultcommentstraining');
            $query['Mtrainedscheduletraining'] = $trainedscheduletraining_ = $this->input->post('trainedscheduletraining');
        
            $data_training = array(
                'RequestBy' =>$id,
                'DateRequest' =>$daterequesttraining_,
                'CourseType' =>$coursetypetraining_,
                'CourseTypeExternal' =>$coursetypexternaltraining_,
                'CourseName' =>$coursenametraining_,
                'CourseStart' =>$coursestarttraining_,
                'CourseEnd' =>$courseendtraining_,
                'Duration' =>$durationtraining_,
                'Institution' =>$institutiontraining_,
                'InstitutionAddress' =>$institutionaddresstraining_,
                'InstitutionContact' =>$institutioncontacttraining_,
                'InstitutionAccountNo' =>$institutionaccountnotraining_,
                'EstimateCost' =>$estimatecosttraining_,
                'ActualCost' =>$actualcosttraining_,
                'ApprovedBy' =>$approvedbytraining_,
                'Justification' =>$justificationtraining_,
                'Result' =>$resulttraining_,
                'ResultComments' =>$resultcommentstraining_,
                'TrainedSchedule' =>$trainedscheduletraining_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_cd_career_train', $data_training);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#training');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#training');        
        }
    }

    function delete_training($id,$cno){
        $this->M_humanresource->delete_data_training($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#training');  
    }

    function edit_training(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitedittraining')) {
            $ctrlno = $this->input->post('ControlNo');
            $id = $this->input->post('IDNumber');
            $data_edit_training = array(
              'DateRequest' => $this->input->post('daterequesttraining'),
              'CourseType' => $this->input->post('coursetypetraining'),
              'CourseTypeExternal' => $this->input->post('coursetypexternaltraining'),
              'CourseName' => $this->input->post('coursenametraining'),
              'CourseStart' => $this->input->post('coursestarttraining'),
              'CourseEnd' => $this->input->post('courseendtraining'),
              'Duration' => $this->input->post('durationtraining'),
              'Institution' => $this->input->post('institutiontraining'),
              'InstitutionAddress' => $this->input->post('institutionaddresstraining'),
              'InstitutionContact' => $this->input->post('institutioncontacttraining'),
              'InstitutionAccountNo' => $this->input->post('institutionaccountnotraining'),
              'EstimateCost' => $this->input->post('estimatecosttraining'),
              'ActualCost' => $this->input->post('actualcosttraining'),
              'ApprovedBy' => $this->input->post('approvedbytraining'),
              'Justification' => $this->input->post('justificationtraining'),
              'Result' => $this->input->post('resulttraining'),
              'ResultComments' => $this->input->post('resultcommentstraining'),
              'TrainedSchedule' => $this->input->post('trainedscheduletraining')
            );
            $this->M_humanresource->edit_data_training($ctrlno, $data_edit_training);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#training');        
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#training');       
        }
    }

    //Language
    function add_language(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitlanguage')) {
            $id = $this->input->post('IDNumber');
            //Experience
            $query['Mlanguage'] = $language_ = $this->input->post('language');
            $query['Mspeakinglanguage'] = $speakinglanguage_ = $this->input->post('speakinglanguage');
            $query['Mreadinglanguage'] = $readinglanguage_ = $this->input->post('readinglanguage');
            $query['Mwritinglanguage'] = $writinglanguage_ = $this->input->post('writinglanguage');
            $query['Mlisteninglanguage'] = $listeninglanguage_ = $this->input->post('listeninglanguage');
            $query['Mreasonlanguage'] = $reasonlanguage_ = $this->input->post('reasonlanguage');
        
            $data_language = array(
                'IDNumber' =>$id,
                'Language' =>$language_,
                'Speaking' =>$speakinglanguage_,
                'Reading' =>$readinglanguage_,
                'Writing' =>$writinglanguage_,
                'Listening' =>$listeninglanguage_,
                'Reason' =>$reasonlanguage_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_cd_career_language', $data_language);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#language');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#language');        
        }
    }

    function delete_language($id,$cno){
        $this->M_humanresource->delete_data_language($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#language');  
    }

    function edit_language(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditlanguage')) {
            $ctrlno = $this->input->post('ControlNo');
            $id = $this->input->post('IDNumber');
            $data_edit_language = array(
              'Language' => $this->input->post('language'),
              'Speaking' => $this->input->post('speakinglanguage'),
              'Reading' => $this->input->post('readinglanguage'),
              'Writing' => $this->input->post('writinglanguage'),
              'Listening' => $this->input->post('listeninglanguage'),
              'Reason' => $this->input->post('reasonlanguage')
            );
            $this->M_humanresource->edit_data_language($ctrlno, $data_edit_language);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#language');        
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#language');       
        }
    }

    //Hobby
    function add_hobby(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submithobby')) {
            $id = $this->input->post('IDNumber');
            //Experience
            $query['Mhobby'] = $hobby_ = $this->input->post('hobby');
            $query['Mremarkshobby'] = $remarkshobby_ = $this->input->post('remarkshobby');
        
            $data_hobby = array(
                'IDNumber' =>$id,
                'Hobby' =>$hobby_,
                'Remarks' =>$remarkshobby_,
                'RegBy' => $this->session->userdata('IDNumber'),
                'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_cd_career_hobby', $data_hobby);
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Added</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#hobby');        
        }else{
            $this->session->set_flashdata('failed_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#hobby');        
        }
    }
    
    function delete_hobby($id,$cno){
        $this->M_humanresource->delete_data_hobby($id,$cno);
        $this->session->set_flashdata('success_delete', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Delete</center> </div>');
        redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#hobby');  
    }

    function edit_hobby(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitedithobby')) {
            $ctrlno = $this->input->post('ControlNo');
            $id = $this->input->post('IDNumber');
            $data_edit_hobby = array(
              'Hobby' => $this->input->post('hobby'),
              'Remarks' => $this->input->post('remarkshobby')
            );
            $this->M_humanresource->edit_data_hobby($ctrlno, $data_edit_hobby);
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Edit</center> </div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#hobby');        
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
            redirect('Humanresource/view_edit_career_development_by_id/'.$id.'/#hobby');       
        }
    }

    //Start - 01Feb2021
    // function allEmployee_priview()
    // {
    //     $asdept = $this->M_humanresource->get_emp_dept();
    //     $all = $this->M_humanresource->get_all_employee();

    //     $value = '';
    //     $value.='<div id="target-ascla">';
    //     $value.='<table class="table table-bordered">';
    //     $value.='<thead>';
    //     $value.='<tr style="background-color: #22313F" class="font-white">';
    //     $value.='<th class="text-center">No</th>';
    //     $value.='<th class="text-center">ID Number</th>';
    //     $value.='<th class="text-center">Full Name</th>';
    //     $value.='<th class="text-center">Jobt Title</th>';
    //     $value.='<th class="text-center">Gender</th>';
    //     $value.='<th class="text-center">Address</th>';
    //     $value.='<th class="text-center">No. Hp</th>';
    //     $value.='<th class="text-center">Action</th>';
    //     $value.='<tr>';
    //     $value.='</thead>';
    //     $value.='<tbody>';
    //     if ($asdept != false) {
    //         foreach ($asdept as $asd) {
    //             # code...
    //             $value.='<tr>';
    //             $value.='<td colspan="8" class="font-black bold" style="background-color: #f4f7f8"><i>'.$asd->DeptDes.'</i></td>';
    //             $value.='</tr>';
    //             $no=1;
    //             foreach ($all as $key) {
    //                 if ($key->DeptCode == $asd->DeptCode) {
    //                 $value.='<tr class="font-white">';
    //                 $value.='<td class="text-center">'.$no.'</td>';
    //                 $value.='<td>'.$key->IDNumber.'</td>';
    //                 $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
    //                 $value.='<td>'.$key->JobTitleDes.'</td>';
    //                 $value.='<td>'.$key->Gender.'</td>';
    //                 $value.='<td>'.$key->Address.'</td>';
    //                 $value.='<td>'.$key->Phone.'</td>';
    //                 $value.='<td>
    //                         <center>
    //                             <a href="'.site_url('Humanresource/view_personal_data/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs green" title="Detail"><i class="fa fa-search"> </i>
    //                             </a>
    //                         </center>
    //                         </td>';
    //                 $value.='</tr>';
    //                 $no++;}
    //             }
    //         }
    //         echo json_encode(array('all' => $value));
    //     } else {
    //         $value .= '<tr>';
    //         $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
    //         $value .= '</tr>';
    //         echo json_encode(array('all' => $value));
    //     }
    //     $value.='</tbody>';
    //     $value.='</table>';
    //     $value.='</div>';
    // }

    function allEmployee_priview()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        $asdept = $this->M_humanresource->get_emp_dept($branch);
        $all = $this->M_humanresource->get_all_employee($branch);

        $value = '';
        $value.='<div id="target-ascla">';
        $value.='<table class="table table-bordered">';
        $value.='<thead>';
        $value.='<tr class="bg-blue-ebonyclay font-white">';
        $value.='<th class="text-center">No</th>';
        $value.='<th class="text-center">ID Number</th>';
        $value.='<th class="text-center">Full Name</th>';
        $value.='<th class="text-center">Jobt Title</th>';
        $value.='<th class="text-center">Gender</th>';
        $value.='<th class="text-center">Address</th>';
        $value.='<th class="text-center">No. Hp</th>';
        $value.='<th class="text-center">Action</th>';
        $value.='<tr>';
        $value.='</thead>';
        $value.='<tbody>';
        if ($asdept != false) {
            foreach ($asdept as $asd) {
                # code...
                $value.='<tr>';
                $value.='<td colspan="8" class="font-black bold bg-grey-salsa"><i>'.$asd->DeptDes.'</i></td>';
                $value.='</tr>';
                $no=1;
                foreach ($all as $key) {
                    if ($key->DeptCode == $asd->DeptCode) {
                    $value.='<tr class="font-dark">';
                    $value.='<td class="text-center">'.$no.'</td>';
                    $value.='<td>'.$key->IDNumber.'</td>';
                    $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
                    $value.='<td>'.$key->JobTitleDes.'</td>';
                    $value.='<td>'.$key->Gender.'</td>';
                    $value.='<td>'.$key->Address.'</td>';
                    $value.='<td>'.$key->Phone.'</td>';
                    $value.='<td>
                            <center>
                                <a href="'.site_url('Humanresource/view_personal_data/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                                </a>
                            </center>
                            </td>';
                    $value.='</tr>';
                    $no++;}
                }
            }
            echo json_encode(array('all' => $value));
        } else {
            $value .= '<tr>';
            $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
            $value .= '</tr>';
            echo json_encode(array('all' => $value));
        }
        $value.='</tbody>';
        $value.='</table>';
        $value.='</div>';
    }

    function allEmployee_priview_cardev()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        $asdept = $this->M_humanresource->get_emp_dept($branch);
        $all = $this->M_humanresource->get_all_employee($branch);

        $value = '';
        $value.='<div id="target-ascla">';
        $value.='<table class="table table-bordered">';
        $value.='<thead>';
        $value.='<tr class="bg-blue-ebonyclay font-white">';
        $value.='<th class="text-center">No</th>';
        $value.='<th class="text-center">ID Number</th>';
        $value.='<th class="text-center">Full Name</th>';
        $value.='<th class="text-center">Jobt Title</th>';
        $value.='<th class="text-center">Gender</th>';
        $value.='<th class="text-center">Address</th>';
        $value.='<th class="text-center">No. Hp</th>';
        $value.='<th class="text-center">Action</th>';
        $value.='<tr>';
        $value.='</thead>';
        $value.='<tbody>';
        if ($asdept != false) {
            foreach ($asdept as $asd) {
                # code...
                $value.='<tr>';
                $value.='<td colspan="8" class="font-black bold bg-grey-salsa"><i>'.$asd->DeptDes.'</i></td>';
                $value.='</tr>';
                $no=1;
                foreach ($all as $key) {
                    if ($key->DeptCode == $asd->DeptCode) {
                    $value.='<tr class="font-dark">';
                    $value.='<td class="text-center">'.$no.'</td>';
                    $value.='<td>'.$key->IDNumber.'</td>';
                    $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
                    $value.='<td>'.$key->JobTitleDes.'</td>';
                    $value.='<td>'.$key->Gender.'</td>';
                    $value.='<td>'.$key->Address.'</td>';
                    $value.='<td>'.$key->Phone.'</td>';
                    $value.='<td>
                            <center>
                                <a href="'.site_url('Humanresource/view_edit_career_development_by_id/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail Career & Development"><i class="fa fa-search"> </i>
                                </a>
                            </center>
                            </td>';
                    $value.='</tr>';
                    $no++;}
                }
            }
            echo json_encode(array('all' => $value));
        } else {
            $value .= '<tr>';
            $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
            $value .= '</tr>';
            echo json_encode(array('all' => $value));
        }
        $value.='</tbody>';
        $value.='</table>';
        $value.='</div>';
    }

    // public function search_priview()
    // {
    //     $html = '';
    //     $query = '';
    //     if ($this->input->post('query')) {
    //         $query = $this->input->post('query');
    //     }
    //     $data = $this->M_humanresource->M_search_data($query);
    //     $result = $data->result_array();
    //     $html.='<div id="target-ascla">';
    //     $html.='<table class="table table-bordered">';
    //     $html.='<thead>';
    //     $html.='<tr style="background-color: #22313F" class="font-white">';
    //     $html.='<th class="text-center">No</th>';
    //     $html.='<th class="text-center">ID Number</th>';
    //     $html.='<th class="text-center">Full Name</th>';
    //     $html.='<th class="text-center">Job Title</th>';
    //     $html.='<th class="text-center">Gender</th>';
    //     $html.='<th class="text-center">Address</th>';
    //     $html.='<th class="text-center">No. Hp</th>';
    //     $html.='<th class="text-center">Action</th>';
    //     $html.='<tr>';
    //     $html.='</thead>';
    //     $html.='<tbody>';
    //     if ($data->num_rows() > 0) {
    //         $no=1; foreach ($result as $r) {
    //             $html.='<tr class="font-white">';
    //             $html.='<td class="text-center">'.$no.'</td>';
    //             $html.='<td>'.$r['IDNumber'].'</td>';
    //             $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
    //             $html.='<td>'.$r['JobTitleDes'].'</td>';
    //             $html.='<td>'.$r['Gender'].'</td>';
    //             $html.='<td>'.$r['Address'].'</td>';
    //             $html.='<td>'.$r['Phone'].'</td>';
    //             $html.='<td>
    //                     <center>
    //                         <a href="'.site_url('Asset/asset_view_detail/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs green" title="Detail"><i class="fa fa-search"> </i>
    //                         </a>
    //                     </center>
    //                     </td>';
    //             $html.='</tr>';
    //         $no++;}
    //     } else {
    //         $html .= '<tr><td align="center" colspan="10"><p class="font-white">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-yellow-saffron">Please check you input</span></p></td></tr>';
    //     }
    //     $html.='</tbody>';
    //     $html.='</table>';
    //     $html.='</div>';
    //     echo $html;
    // }

    public function search_priview()
    {
        $html = '';
        $query = '';
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->M_humanresource->M_search_data($branch, $query);
        $result = $data->result_array();
        $html.='<div id="target-ascla">';
        $html.='<table class="table table-bordered">';
        $html.='<thead>';
        $html.='<tr class="bg-blue-ebonyclay font-white">';
        $html.='<th class="text-center">No</th>';
        $html.='<th class="text-center">ID Number</th>';
        $html.='<th class="text-center">Full Name</th>';
        $html.='<th class="text-center">Job Title</th>';
        $html.='<th class="text-center">Gender</th>';
        $html.='<th class="text-center">Address</th>';
        $html.='<th class="text-center">No. Hp</th>';
        $html.='<th class="text-center">Action</th>';
        $html.='<tr>';
        $html.='</thead>';
        $html.='<tbody>';
        if ($data->num_rows() > 0) {
            $no=1; foreach ($result as $r) {
                $html.='<tr class="font-dark">';
                $html.='<td class="text-center">'.$no.'</td>';
                $html.='<td>'.$r['IDNumber'].'</td>';
                $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
                $html.='<td>'.$r['JobTitleDes'].'</td>';
                $html.='<td>'.$r['Gender'].'</td>';
                $html.='<td>'.$r['Address'].'</td>';
                $html.='<td>'.$r['Phone'].'</td>';
                $html.='<td>
                        <center>
                            <a href="'.site_url('Humanresource/view_personal_data/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                            </a>
                        </center>
                        </td>';
                $html.='</tr>';
            $no++;}
        } else {
            $html .= '<tr><td align="center" colspan="10"><p class="font-dark">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-blue-madison">Please check you input</span></p></td></tr>';
        }
        $html.='</tbody>';
        $html.='</table>';
        $html.='</div>';
        echo $html;
    }

    public function search_priview_cardev()
    {
        $html = '';
        $query = '';
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->M_humanresource->M_search_data($branch, $query);
        $result = $data->result_array();
        $html.='<div id="target-ascla">';
        $html.='<table class="table table-bordered">';
        $html.='<thead>';
        $html.='<tr class="bg-blue-ebonyclay font-white">';
        $html.='<th class="text-center">No</th>';
        $html.='<th class="text-center">ID Number</th>';
        $html.='<th class="text-center">Full Name</th>';
        $html.='<th class="text-center">Job Title</th>';
        $html.='<th class="text-center">Gender</th>';
        $html.='<th class="text-center">Address</th>';
        $html.='<th class="text-center">No. Hp</th>';
        $html.='<th class="text-center">Action</th>';
        $html.='<tr>';
        $html.='</thead>';
        $html.='<tbody>';
        if ($data->num_rows() > 0) {
            $no=1; foreach ($result as $r) {
                $html.='<tr class="font-dark">';
                $html.='<td class="text-center">'.$no.'</td>';
                $html.='<td>'.$r['IDNumber'].'</td>';
                $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
                $html.='<td>'.$r['JobTitleDes'].'</td>';
                $html.='<td>'.$r['Gender'].'</td>';
                $html.='<td>'.$r['Address'].'</td>';
                $html.='<td>'.$r['Phone'].'</td>';
                $html.='<td>
                        <center>
                            <a href="'.site_url('Humanresource/view_edit_career_development_by_id/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail Career & Developmen"><i class="fa fa-search"> </i>
                            </a>
                        </center>
                        </td>';
                $html.='</tr>';
            $no++;}
        } else {
            $html .= '<tr><td align="center" colspan="10"><p class="font-dark">Were So Sorry we have <strong>No Data</strong> On you search! <br><span class="font-blue-madison">Please check you input</span></p></td></tr>';
        }
        $html.='</tbody>';
        $html.='</table>';
        $html.='</div>';
        echo $html;
    }
    //End - 01Feb2021

    //Start - 02Mar2021
    function view_workforce_mgt() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Workforce';
        $query['headert2'] = 'Management';
        $query['title'] = 'Workforce Management';
        $this->load->view('humanresource/workforcemgt/v_workforce_mgt', $query);
    }

    function view_admin_mgt() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert'] = 'Corporate';
        $query['headert1'] = 'Admin';
        $query['headert2'] = 'Management';
        $query['title'] = 'Admin Management';
        $this->load->view('humanresource/adminmgt/v_admin_mgt', $query);
    }
    //End - 02Mar2021

    //Start - 03Mar2021
    // function allEmployee_listreg()
    // {
    //     $all = $this->M_humanresource->get_all_employee();
    //     $value = '';
    //     $value.='<div id="target-ascla">';
    //     $value.='<table class="table table-bordered">';
    //     $value.='<thead>';
    //     $value.='<tr style="background-color: #22313F" class="font-white">';
    //     $value.='<th class="text-center">No</th>';
    //     $value.='<th class="text-center">ID Number</th>';
    //     $value.='<th class="text-center">Full Name</th>';
    //     $value.='<th class="text-center">Job Title</th>';
    //     $value.='<th class="text-center">Gender</th>';
    //     $value.='<th class="text-center">Address</th>';
    //     $value.='<th class="text-center">Department</th>';
    //     $value.='<th class="text-center">Action</th>';
    //     $value.='<tr>';
    //     $value.='</thead>';
    //     $value.='<tbody>';
    //     if ($all != false) { 
    //             $no=1;
    //             foreach ($all as $key) { 
    //                 $value.='<tr class="font-dark">';
    //                 $value.='<td class="text-center">'.$no.'</td>';
    //                 $value.='<td>'.$key->IDNumber.'</td>';
    //                 $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
    //                 $value.='<td>'.$key->JobTitleDes.'</td>';
    //                 $value.='<td>'.$key->Gender.'</td>';
    //                 $value.='<td>'.$key->Address.'</td>';
    //                 $value.='<td>'.$key->DeptDes.'</td>';
    //                 $value.='<td>
    //                         <center>
    //                             <a href="'.site_url('Humanresource/view_personal_data/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs green" title="Detail"><i class="fa fa-search"> </i>
    //                             </a>
    //                             <a href="'.site_url('Humanresource/view_edit_data_personal/'.$key->IDNumber.'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
    //                             </a>
    //                             <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
    //                                 <i class="fa fa-close"></i>
    //                             </a>
    //                         </center>
    //                         </td>';
    //                 $value.='</tr>';
    //         $no++;}
    //         echo json_encode(array('all' => $value));
    //     } else {
    //         $value .= '<tr>';
    //         $value .= '<td colspan="7" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
    //         $value .= '</tr>';
    //         echo json_encode(array('all' => $value));
    //     }
    //     $value.='</tbody>';
    //     $value.='</table>';
    //     $value.='</div>';
    // }

    // function allEmployee_listreg()
    // {
    //     $asdept = $this->M_humanresource->get_emp_dept();
    //     $all = $this->M_humanresource->get_all_employee();

    //     $value = '';
    //     $value.='<div id="target-ascla">';
    //     $value.='<table class="table table-bordered">';
    //     $value.='<thead>';
    //     $value.='<tr style="background-color: #22313F" class="font-white">';
    //     $value.='<th class="text-center">No</th>';
    //     $value.='<th class="text-center">ID Number</th>';
    //     $value.='<th class="text-center">Full Name</th>';
    //     $value.='<th class="text-center">Jobt Title</th>';
    //     $value.='<th class="text-center">Gender</th>';
    //     $value.='<th class="text-center">Address</th>';
    //     $value.='<th class="text-center">No. Hp</th>';
    //     $value.='<th class="text-center">Action</th>';
    //     $value.='<tr>';
    //     $value.='</thead>';
    //     $value.='<tbody>';
    //     if ($asdept != false) {
    //         foreach ($asdept as $asd) {
    //             # code...
    //             $value.='<tr>';
    //             $value.='<td colspan="8" class="font-black bold bg-default"><i>'.$asd->DeptDes.'</i></td>';
    //             $value.='</tr>';
    //             $no=1;
    //             foreach ($all as $key) {
    //                 if ($key->DeptCode == $asd->DeptCode) {
    //                 $value.='<tr class="font-dark">';
    //                 $value.='<td class="text-center">'.$no.'</td>';
    //                 $value.='<td>'.$key->IDNumber.'</td>';
    //                 $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
    //                 $value.='<td>'.$key->JobTitleDes.'</td>';
    //                 $value.='<td>'.$key->Gender.'</td>';
    //                 $value.='<td>'.$key->Address.'</td>';
    //                 $value.='<td>'.$key->Phone.'</td>';
    //                 $value.='<td>
    //                         <center>
    //                             <a href="'.site_url('Humanresource/view_personal_data/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
    //                             </a>
    //                             <a href="'.site_url('Humanresource/view_edit_data_personal/'.$key->IDNumber.'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
    //                             </a>
    //                             <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
    //                                 <i class="fa fa-close"></i>
    //                             </a>
    //                         </center>
    //                         </td>';
    //                 $value.='</tr>';
    //                 $no++;}
    //             }
    //         }
    //         echo json_encode(array('all' => $value));
    //     } else {
    //         $value .= '<tr>';
    //         $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
    //         $value .= '</tr>';
    //         echo json_encode(array('all' => $value));
    //     }
    //     $value.='</tbody>';
    //     $value.='</table>';
    //     $value.='</div>';
    // }

    function allEmployee_listreg()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        $asdept = $this->M_humanresource->get_emp_dept($branch);
        $all = $this->M_humanresource->get_all_employee($branch);

        $value = '';
        $value.='<div id="target-ascla">';
        $value.='<table class="table table-bordered">';
        $value.='<thead>';
        $value.='<tr class="bg-blue-madison font-white">';
        $value.='<th class="text-center">No</th>';
        $value.='<th class="text-center">ID Number</th>';
        $value.='<th class="text-center">Full Name</th>';
        $value.='<th class="text-center">Jobt Title</th>';
        $value.='<th class="text-center">Gender</th>';
        $value.='<th class="text-center">Address</th>';
        $value.='<th class="text-center">No. Hp</th>';
        $value.='<th class="text-center">Action</th>';
        $value.='<tr>';
        $value.='</thead>';
        $value.='<tbody>';
        if ($asdept != false) {
            foreach ($asdept as $asd) {
                # code...
                $value.='<tr>';
                $value.='<td colspan="8" class="font-black bold bg-grey-salsa"><i>'.$asd->DeptDes.'</i></td>';
                $value.='</tr>';
                $no=1;
                foreach ($all as $key) {
                    if ($key->DeptCode == $asd->DeptCode) {
                    $value.='<tr class="font-dark">';
                    $value.='<td class="text-center">'.$no.'</td>';
                    $value.='<td>'.$key->IDNumber.'</td>';
                    $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
                    $value.='<td>'.$key->JobTitleDes.'</td>';
                    $value.='<td>'.$key->Gender.'</td>';
                    $value.='<td>'.$key->Address.'</td>';
                    $value.='<td>'.$key->Phone.'</td>';
                    $value.='<td>
                            <center>
                                <a href="'.site_url('Humanresource/view_personal_data/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                                </a>
                                <a href="'.site_url('Humanresource/view_edit_data_personal/'.$key->IDNumber.'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                    <i class="fa fa-close"></i>
                                </a>
                            </center>
                            </td>';
                    $value.='</tr>';
                    $no++;}
                }
            }
            echo json_encode(array('all' => $value));
        } else {
            $value .= '<tr>';
            $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
            $value .= '</tr>';
            echo json_encode(array('all' => $value));
        }
        $value.='</tbody>';
        $value.='</table>';
        $value.='</div>';
    }

    // public function search_priview_listreg()
    // {
    //     $html = '';
    //     $query = '';
    //     if ($this->input->post('query')) {
    //         $query = $this->input->post('query');
    //     }
    //     $data = $this->M_humanresource->M_search_data($query);
    //     $result = $data->result_array();
    //     $html.='<div id="target-ascla">';
    //     $html.='<table class="table table-bordered">';
    //     $html.='<thead>';
    //     $html.='<tr style="background-color: #22313F" class="font-white">';
    //     $html.='<th class="text-center">No</th>';
    //     $html.='<th class="text-center">ID Number</th>';
    //     $html.='<th class="text-center">Full Name</th>';
    //     $html.='<th class="text-center">Job Title</th>';
    //     $html.='<th class="text-center">Gender</th>';
    //     $html.='<th class="text-center">Address</th>';
    //     $html.='<th class="text-center">No. Hp</th>';
    //     $html.='<th class="text-center">Action</th>';
    //     $html.='<tr>';
    //     $html.='</thead>';
    //     $html.='<tbody>';
    //     if ($data->num_rows() > 0) {
    //         $no=1; foreach ($result as $r) {
    //             $html.='<tr class="font-dark">';
    //             $html.='<td class="text-center">'.$no.'</td>';
    //             $html.='<td>'.$r['IDNumber'].'</td>';
    //             $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
    //             $html.='<td>'.$r['JobTitleDes'].'</td>';
    //             $html.='<td>'.$r['Gender'].'</td>';
    //             $html.='<td>'.$r['Address'].'</td>';
    //             $html.='<td>'.$r['Phone'].'</td>';
    //             $html.='<td>
    //                     <center>
    //                         <a href="'.site_url('Asset/asset_view_detail/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
    //                         </a>
    //                         <a href="'.site_url('Asset/asset_view_detail/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs green" title="Edit Personal"><i class="fa fa-edit"> </i>
    //                         </a>
    //                         <a href="#" type="button"class="btn  btn-xs yellow" title="Detail"><i class="fa fa-close"> </i>
    //                         </a>
    //                     </center>
    //                     </td>';
    //             $html.='</tr>';
    //         $no++;}
    //     } else {
    //         $html .= '<tr><td align="center" colspan="7"><p class="font-dark">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-yellow-saffron">Please check you input</span></p></td></tr>';
    //     }
    //     $html.='</tbody>';
    //     $html.='</table>';
    //     $html.='</div>';
    //     echo $html;
    // }

    public function search_priview_listreg()
    {
        $html = '';
        $query = '';
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->M_humanresource->M_search_data($branch, $query);
        $result = $data->result_array();
        $html.='<div id="target-ascla">';
        $html.='<table class="table table-bordered">';
        $html.='<thead>';
        $html.='<tr class="bg-blue-madison font-white">';
        $html.='<th class="text-center">No</th>';
        $html.='<th class="text-center">ID Number</th>';
        $html.='<th class="text-center">Full Name</th>';
        $html.='<th class="text-center">Job Title</th>';
        $html.='<th class="text-center">Gender</th>';
        $html.='<th class="text-center">Address</th>';
        $html.='<th class="text-center">No. Hp</th>';
        $html.='<th class="text-center">Action</th>';
        $html.='<tr>';
        $html.='</thead>';
        $html.='<tbody>';
        if ($data->num_rows() > 0) {
            $no=1; foreach ($result as $r) {
                $html.='<tr class="font-dark">';
                $html.='<td class="text-center">'.$no.'</td>';
                $html.='<td>'.$r['IDNumber'].'</td>';
                $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
                $html.='<td>'.$r['JobTitleDes'].'</td>';
                $html.='<td>'.$r['Gender'].'</td>';
                $html.='<td>'.$r['Address'].'</td>';
                $html.='<td>'.$r['Phone'].'</td>';
                $html.='<td>
                        <center>
                            <a href="'.site_url('Humanresource/view_personal_data/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                            </a>
                            <a href="'.site_url('Humanresource/view_edit_data_personal/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs green" title="Edit Personal"><i class="fa fa-edit"> </i>
                            </a>
                            <a href="#" type="button"class="btn  btn-xs yellow" title="Detail"><i class="fa fa-close"> </i>
                            </a>
                        </center>
                        </td>';
                $html.='</tr>';
            $no++;}
        } else {
            $html .= '<tr><td align="center" colspan="8"><p class="font-dark">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-blue-madison">Please check you input</span></p></td></tr>';
        }
        $html.='</tbody>';
        $html.='</table>';
        $html.='</div>';
        echo $html;
    }
    //End - 03Mar2021

    //Start - 21Mei2021
    function view_position_mgt() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Dashboard';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['level'] = $this->M_humanresource->get_level_manpower();
        $query['emptype'] = $this->M_humanresource->get_employeetype();
        $query['report_emptype'] = $this->M_humanresource->get_data_current_manpower_emptype_by_dept();
        $query['subtotalemptype'] = $this->M_humanresource->get_report_emp_etype_subtotals();
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals();
        $this->load->view('humanresource/positionmgt/v_position_mgt', $query);
    }

    function view_rec_sel() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Recruitment';
        $query['headert2'] = 'Selection';
        $query['title'] = 'Dashboard';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['level'] = $this->M_humanresource->get_level_manpower();
        $query['emptype'] = $this->M_humanresource->get_employeetype();
        $query['report_emptype'] = $this->M_humanresource->get_data_current_manpower_emptype_by_dept();
        $query['subtotalemptype'] = $this->M_humanresource->get_report_emp_etype_subtotals();
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals();
        $this->load->view('humanresource/recruitselect/v_rec_sel', $query);
    }
    //End - 21Mei2021

    //Start - 23Mei2021
    function view_personal_register() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Personal';
        $query['headert2'] = 'Register';
        $query['title'] = 'Personal Register';

        $query['sumemptype'] = $this->M_humanresource->get_data_sum_employee_by_employeetype($branch);

        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append($branch);
        $query['level'] = $this->M_humanresource->get_level($branch);
        $query['report_level'] = $this->M_humanresource->get_data_report_by_dept_level($branch);
        $query['function'] = $this->M_humanresource->get_function($branch);
        $query['report_function'] = $this->M_humanresource->get_data_report_by_dept_function($branch);

        $query['emptype'] = $this->M_humanresource->get_employeetype($branch);
        $query['report_emptype'] = $this->M_humanresource->get_data_report_by_dept_employeetype($branch);
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals($branch);

        $query['employmenttype'] = $this->M_humanresource->get_employmenttype($branch);
        $query['report_employmenttype'] = $this->M_humanresource->get_data_report_by_dept_employmenttype($branch);
        $query['grandtotalemploymenttype'] = $this->M_humanresource->get_report_emp_employmenttype_gtotals($branch);
        $this->load->view('humanresource/employeeadmin/v_personal_register', $query);
    }

    function view_emp_contract() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Employment';
        $query['headert2'] = 'Contract';
        $query['title'] = 'Employment Contract';
        // $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['datadet'] = $this->M_humanresource->get_data_emp_con_det();
        $this->load->view('humanresource/contract/v_emp_contract', $query);
    }

    function view_company_asset() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Company';
        $query['headert2'] = 'Asset';
        $query['title'] = 'My Company Asset';
        $this->load->view('humanresource/asset/v_company_asset', $query);
    }

    function view_training_mgt() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Training';
        $query['headert2'] = 'Management';
        $query['title'] = 'Training Management';
        $this->load->view('humanresource/training/v_training_mgt', $query);
    }

    function view_performance_app() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Performance';
        $query['headert2'] = 'Appraisal';
        $query['title'] = 'Performance Appraisal';
        $this->load->view('humanresource/performanceapp/v_performance_app', $query);
    }

    function view_leave_travel() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Leave';
        $query['headert2'] = 'Travel';
        $query['title'] = 'Leave & Travel Management';
        $this->load->view('humanresource/leavetravel/v_leave_travel', $query);
    }

    function view_time_management() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Time';
        $query['headert2'] = 'Management';
        $query['title'] = 'Time Management';
        $this->load->view('humanresource/timemgt/v_time_management', $query);
    }

    function view_violation_discipline() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Violation';
        $query['headert2'] = 'Discipline';
        $query['title'] = 'Violation & Discipline';
        $this->load->view('humanresource/viodisc/v_violation_discipline', $query);
    }

    function view_payroll_mgt() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Payroll';
        $query['headert2'] = 'Management';
        $query['title'] = 'Payroll Management';
        $this->load->view('humanresource/payroll/v_pay_mgt', $query);
    }

    function view_cash_disb() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Cash';
        $query['headert2'] = 'Disbursement';
        $query['title'] = 'Cash Disbursement';
        $this->load->view('humanresource/cashdisb/v_cash_disbursement', $query);
    }

    function view_medical_insurance() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Medical';
        $query['headert2'] = 'Insurance';
        $query['title'] = 'Medical & Insurance';
        $this->load->view('humanresource/medicalinsurance/v_medical_insurance', $query);
    }
    //End - 23Mei2021


    //Start - 26Mei2021
    function view_current_manpower() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Current Manpower Summary';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['level'] = $this->M_humanresource->get_level_manpower();
        $query['emptype'] = $this->M_humanresource->get_employeetype();
        $query['report_emptype'] = $this->M_humanresource->get_data_current_manpower_emptype_by_dept();
        $query['subtotalemptype'] = $this->M_humanresource->get_report_emp_etype_subtotals();
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals();
        $this->load->view('humanresource/positionmgt/v_current_manpower', $query);
    }

    function view_current_manpower_details() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Current Manpower Details';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['datadet'] = $this->M_humanresource->get_data_manpower_detail();
        $this->load->view('humanresource/positionmgt/v_current_manpower_details', $query);
    }

    function view_man_power_demand() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Manpower Demand';
        $query['manplanno'] = $this->M_humanresource->get_data_manplanno();
        $query['year'] = $this->M_humanresource->get_data_year();
        $query['depart'] = $this->M_humanresource->get_data_department();
        $query['list_plan'] = $this->M_humanresource->get_data_plan();
        $this->load->view('humanresource/positionmgt/v_man_power_demand', $query);
    }

    function view_key_development() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Key Development';
        $this->load->view('humanresource/positionmgt/v_key_development', $query);
    }
    //End - 26Mei2021

    //Start - 01Juni2021
    function view_manpower_post() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Man Power Plan';
        $query['jobslist'] = $this->M_humanresource->get_post_list();
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countoutstandingdata'] = $this->M_humanresource->get_count_outstanding_data($currentdate);
        $this->load->view('humanresource/positionmgt/v_man_power_posting', $query);
    }

    function view_list_mpposting_internalexp() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Internal Expired';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpireinternaldata'] = $this->M_humanresource->get_count_expire_internal_data($currentdate);
        $this->load->view('humanresource/positionmgt/v_man_power_posting_expire_internal', $query);
    }

    function view_list_mpposting_externalexp() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'External Expired';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpireexternaldata'] = $this->M_humanresource->get_count_expire_external_data($currentdate);
        $this->load->view('humanresource/positionmgt/v_man_power_posting_expire_external', $query);
    }

    function view_list_mpposting_expire() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Expired';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countexpiredata'] = $this->M_humanresource->get_count_expire_data($currentdate);
        $this->load->view('humanresource/positionmgt/v_man_power_posting_expire', $query);
    }

    function view_list_mpposting_oustanding() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Outstanding';
        $currentdate = date('Y-m-d');
        $query['countexpireinternal'] = $this->M_humanresource->get_count_expire_internal($currentdate);
        $query['countexpireexternal'] = $this->M_humanresource->get_count_expire_external($currentdate);
        $query['countexpire'] = $this->M_humanresource->get_count_expire($currentdate);
        $query['countoutstanding'] = $this->M_humanresource->get_count_outstanding($currentdate);
        $query['countoutstandingdata'] = $this->M_humanresource->get_count_outstanding_data($currentdate);
        $this->load->view('humanresource/positionmgt/v_man_power_posting_outstanding', $query);
    }
    //End - 01Juni2021

    //Start - 02Juni2021
    function view_recsel() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Recrutiment';
        $query['headert2'] = 'Selection';
        $query['title'] = 'Recruitment & Selection';
        $query['headertitle'] = 'Job Post';
        $query['get_rec'] = $this->M_humanresource->get_data_recruit();
        $query['jobslist'] = $this->M_humanresource->get_post_list();
        $this->load->view('humanresource/recruitselect/v_recruit_selection', $query);
    }

    function view_data_selection_recruit($jobpostno,$educationseq,$fieldstudy,$agemin,$experience,$englishseq){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Recruitment';
        $query['headert2'] = 'Selection';
        $query['title'] = 'Selection Data';
        $query['headertitle'] = 'Selection Data';
        // $query['edu'] = $educationseq;
        // $query['fs'] = $fieldstudy;
        // $query['ag'] = $agemin;
        // $query['exp'] = $experience;
        // $query['eng'] = $englishseq;
        $query['get_data_selection_edexist_fsexist'] = $this->M_humanresource->get_data_selection_by_priority_edexist_fsexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_edexist_fsnotexist'] = $this->M_humanresource->get_data_selection_by_priority_edexist_fsnotexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_ednotexist_fsexist'] = $this->M_humanresource->get_data_selection_by_priority_ednotexist_fsexist($jobpostno,$educationseq,$fieldstudy);
        $query['get_data_selection_ednotexist_fsnotexist'] = $this->M_humanresource->get_data_selection_by_priority_ednotexist_fsnotexist($jobpostno,$educationseq,$fieldstudy);
        // $query['get_data_selection5'] = $this->M_humanresource->get_data_selection_by_priority5($jobpostno,$educationseq,$fieldstudy,$agemin,$experience,$englishseq);
        $this->load->view('humanresource/recruitselect/v_data_select_recruit', $query);
    }

    //End - 02Juni2021

    //Start - 02Juni2021
    //Rekap Employee Gender
    function view_rekap_preview_all_by_gender($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Gender Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_gender'] = $this->M_humanresource->get_count_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_gender_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_gender_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_gender_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['genders'] = $this->M_humanresource->get_report_emp_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_gender_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_gender_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


        //Details
        $query['genderst'] = $this->M_humanresource->get_report_emp_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datagender'] = $this->M_humanresource->get_report_data_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_gender_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_gender', $query);         
    }

    //Rekap Employee Religion
    function view_rekap_preview_all_by_religion($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Religion Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_religion'] = $this->M_humanresource->get_count_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_religion_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_religion_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_religion_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['religions'] = $this->M_humanresource->get_report_emp_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_religion_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_religion_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['religionst'] = $this->M_humanresource->get_report_emp_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datareligion'] = $this->M_humanresource->get_report_data_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_religion_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_religion', $query);         
    }

    //Rekap Employee Marital
    function view_rekap_preview_all_by_marital($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Marital Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_marital'] = $this->M_humanresource->get_count_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_marital_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_marital_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_marital_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_marital_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['maritals'] = $this->M_humanresource->get_report_emp_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_marital_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_marital_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


        //Details
        $query['maritalst'] = $this->M_humanresource->get_report_emp_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datamarital'] = $this->M_humanresource->get_report_data_by_marital_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $query['detotal'] = $this->M_humanresource->get_report_data_by_marital_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_marital', $query);         
    }

    //Rekap Employee Ethnic
    function view_rekap_preview_all_by_ethnic($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Ethnic Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_ethnic'] = $this->M_humanresource->get_count_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['eethnict'] = $this->M_humanresource->get_report_emp_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempethnic'] = $this->M_humanresource->get_report_data_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_ethnic_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_ethnic', $query);     
    }

    //Rekap Employee Type
    function view_rekap_preview_all_by_emptype($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Type Rekap';
          
        $company_ = 'All';          
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;

        //All Caterory
        $query['r_data_emptype'] = $this->M_humanresource->get_count_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_etype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_etype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_etype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_etype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['emptype'] = $this->M_humanresource->get_report_emp_etype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_etype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_etype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['etypest'] = $this->M_humanresource->get_report_emp_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataetype'] = $this->M_humanresource->get_report_data_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeetype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_emptype', $query);         
    }

    //Rekap Employee Class
    function view_rekap_preview_all_by_empclass($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Class Rekap';
       
        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det; 
       
        //All Caterory
        $query['r_data_empclass'] = $this->M_humanresource->get_count_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_empclass_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_empclass_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_empclass_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_eclass_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['empclass'] = $this->M_humanresource->get_report_emp_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_empclass_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_empclass_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empclassst'] = $this->M_humanresource->get_report_emp_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempclass'] = $this->M_humanresource->get_report_data_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_empclass_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_empclass', $query);         
    }

    //Rekap Employment Type
    function view_rekap_preview_all_by_employmenttype($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employment Type Rekap';
        
        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_employmenttype'] = $this->M_humanresource->get_count_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_employmenttype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_employmenttype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_employmenttype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_employmenttype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['empltype'] = $this->M_humanresource->get_report_emp_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_employmenttype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_employmenttype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['employmenttypest'] = $this->M_humanresource->get_report_emp_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempltype'] = $this->M_humanresource->get_report_data_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employmenttype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_employmenttype', $query);         
    }

    //Rekap Employee Function
    function view_rekap_preview_all_by_empfunction($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Function Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_empfunction'] = $this->M_humanresource->get_count_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empfunctionst'] = $this->M_humanresource->get_report_emp_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempfunction'] = $this->M_humanresource->get_report_data_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeefunction_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_employeefunction', $query);     
    }

    //Rekap Employee Grade
    function view_rekap_preview_all_by_empgrade($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Grade Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_empgrade'] = $this->M_humanresource->get_count_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empgradest'] = $this->M_humanresource->get_report_emp_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempgrade'] = $this->M_humanresource->get_report_data_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeegrade_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_empgrade', $query);     
    }

    //Rekap Employee Level
    function view_rekap_preview_all_by_emplevel($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Level Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_emplevel'] = $this->M_humanresource->get_count_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['emplevelst'] = $this->M_humanresource->get_report_emp_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataemplevel'] = $this->M_humanresource->get_report_data_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeelevel_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_emplevel', $query);     
    }


    //Rekap Employee Company
    function view_rekap_preview_all_by_company($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Company Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_company'] = $this->M_humanresource->get_count_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['ecomnict'] = $this->M_humanresource->get_report_emp_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datacom'] = $this->M_humanresource->get_report_data_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_company_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_company', $query);     
    }

    //Rekap Employee Department
    function view_rekap_preview_all_by_department($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Department Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_department'] = $this->M_humanresource->get_count_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['edepartmentnict'] = $this->M_humanresource->get_report_emp_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datadepartment'] = $this->M_humanresource->get_report_data_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_department_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_department', $query);     
    }

    //Rekap Employee Location
    function view_rekap_preview_all_by_location($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Location Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_location'] = $this->M_humanresource->get_count_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['elocationnict'] = $this->M_humanresource->get_report_emp_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datalocation'] = $this->M_humanresource->get_report_data_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_location_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_location', $query);     
    }

    //Rekap Employee Supervisor
    function view_rekap_preview_all_by_supervisor($det) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Supervisor Rekap';

        $company_ = 'All';            
        $branch_ = 'All'; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_supervisor'] = $this->M_humanresource->get_count_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['esupervisornict'] = $this->M_humanresource->get_report_emp_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datasupervisor'] = $this->M_humanresource->get_report_data_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_supervisor_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_supervisor', $query);     
    }
    //End - 02Juni2021

    //Start - 03Juni2021
    function view_cardev() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Career';
        $query['headert2'] = 'Development';
        $query['title'] = 'Career & Development';
        $query['data_list'] = $this->M_humanresource->get_data_personaldata_list($branch);
        $this->load->view('humanresource/development/v_cardev', $query);
    }

    function view_car_dev() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Career';
        $query['headert2'] = 'Development';
        $query['title'] = 'Career & Development';
        $query['data_list'] = $this->M_humanresource->get_data_personaldata_list($branch);
        $this->load->view('humanresource/development/v_car_dev', $query);
    }
    //End - 03Juni2021

    //Start - 09Juni2021
    function view_mpower_plan() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Position';
        $query['headert2'] = 'Management';
        $query['title'] = 'Manpower Plan';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['level'] = $this->M_humanresource->get_level_manpower();
        $query['emptype'] = $this->M_humanresource->get_employeetype();
        $query['report_emptype'] = $this->M_humanresource->get_data_current_manpower_emptype_by_dept();
        $query['subtotalemptype'] = $this->M_humanresource->get_report_emp_etype_subtotals();
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals();
        $this->load->view('humanresource/positionmgt/v_mp_plan', $query);
    }
    //End 09-Juni2021

    //Start - 14Juni2021
    function view_emp_con_sum() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Employment';
        $query['headert2'] = 'Contract';
        $query['title'] = 'Contract Summary';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['level'] = $this->M_humanresource->get_level_manpower();
        $query['emptype'] = $this->M_humanresource->get_employeetype();
        $query['report_emptype'] = $this->M_humanresource->get_data_current_manpower_emptype_by_dept();
        $query['subtotalemptype'] = $this->M_humanresource->get_report_emp_etype_subtotals();
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals();
        $this->load->view('humanresource/contract/v_emp_contract_sum', $query);
    }

    function view_emp_con_det() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Employment';
        $query['headert2'] = 'Contract';
        $query['title'] = 'Contract Details';
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append();
        $query['datadet'] = $this->M_humanresource->get_data_emp_con_det();
        $this->load->view('humanresource/contract/v_emp_contract_det', $query);
    }
    //End - 14Juni2021

    //Start - 15Juni2021
    function view_industrial_relation() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Industrial';
        $query['headert2'] = 'Relation';
        $query['title'] = 'Industrial Relation';
        $this->load->view('humanresource/industrialrelation/v_industrial_relation', $query);
    }
    //End - 15Juni2021


    //Start - 18Oct2021
    function view_myjobcard() {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'JobCard';
        $query['headert2'] = '';
        $query['headert3'] = '';
        $query['title'] = 'My JobCard';
        $query['comp'] = $this->M_humanresource->get_data_comp();
        $this->load->view('humanresource/roster/v_myjobcard', $query);
    }
    //End - 18Oct2021















    //Start - Function ABC//
    //25October2021
    //Personal Register Modul
    function view_personal_register_abc() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Employee';
        $query['headert2'] = 'Register';
        $query['title'] = 'Employee Register';
        $query['sumemptype'] = $this->M_humanresource->get_data_sum_employee_by_employeetype_abc($branch);
        $query['dept'] = $this->M_humanresource->get_list_department_from_hr_append_abc($branch);
        $query['emptype'] = $this->M_humanresource->get_employeetype_abc($branch);
        $query['report_emptype'] = $this->M_humanresource->get_data_report_by_dept_employeetype_abc($branch);
        $query['grandtotalemptype'] = $this->M_humanresource->get_report_emp_etype_gtotals_abc($branch);
        $query['script'] = 'employee';
        $this->load->view('humanresource/employeeadmin/v_personal_register_abc', $query);
    }

    function view_personal_data_abc($id) {
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Admin';
        $query['headertitle'] = 'Personal Profile';
        $query['personal'] = $this->M_humanresource->get_data_personaldata($id);
        $this->load->view('humanresource/employeeadmin/v_personal_data_abc', $query);
    }

    function view_new_data_personal_abc() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'New Personal';
        $query['headertitle'] = 'Employee Register';
        $lastidnumbercode = $this->M_humanresource->get_last_idnumber();
        if ($lastidnumbercode != false) {                        
            $last = substr($lastidnumbercode, 4);
            $cur = $last + 1;
            $new = '1'.str_pad($cur, 6, '0',STR_PAD_LEFT);
            $idnumbercode = $new;            
        } else {
            $idnumbercode  = '1'.'000001';
        }        
        $query['idnumbercode'] = $idnumbercode;     
        //var_dump($last);

        //Jobinformation Select Dropdown
        $query['get_company'] = $this->M_humanresource->get_data_company_abc();
        $query['get_branch'] = $this->M_humanresource->get_data_branch_abc($branch);
        $query['get_marital'] = $this->M_humanresource->get_data_marital();
        $query['get_ethnic'] = $this->M_humanresource->get_data_ethnic();
        $query['get_employeeclass'] = $this->M_humanresource->get_data_employeeclass();
        $query['get_employeetype'] = $this->M_humanresource->get_data_employeetype();
        $query['get_point'] = $this->M_humanresource->get_data_point();
        $query['get_title'] = $this->M_humanresource->get_data_title();
        $query['get_workfunction'] = $this->M_humanresource->get_data_workfunction();
        $query['get_workgroup'] = $this->M_humanresource->get_data_workgroup();
        $query['get_supervisor'] = $this->M_humanresource->get_data_supervisor_abc($branch);
        $this->load->view('humanresource/employeeadmin/v_new_personaldata_abc', $query);
    }


    function transfer_data_personal_abc(){
        if ($this->input->post('submit')) {
            //Personal Data
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');
            $query['Midnumberidentifier'] = $idnumberidentifier_ = $identifier;
            $query['Mfirstname'] = $firstname_ = $this->input->post('firstname');
            $query['Mmiddlename'] = $middlename_ = $this->input->post('middlename');
            $query['Mlastname'] = $lastname_ = $this->input->post('lastname');
            $query['Mnickname'] = $nickname_ = $this->input->post('nickname');
            $query['Mfullname_'] = $fullname_ = $this->input->post('fullname');
            $query['Mgender'] = $gender_ = $this->input->post('gender');
            $query['Mdateofbirth'] = $dateofbirth_ = $this->input->post('dateofbirth');
            $query['Mpointofbirth'] = $pointofbirth_ = $this->input->post('pointofbirth');
            $query['Mmaritalstatus'] = $maritalstatus_ = $this->input->post('maritalstatus');
            $query['Mmaritalstatusdes'] = $maritalstatusdes_ = $this->input->post('i_maritalstatusdes');
            $query['Mreligion'] = $religion_ = $this->input->post('religion');
            $query['Mnationality'] = $nationality_ = $this->input->post('nationality');
            $query['Mnationalitydes'] = $nationalitydes_ = $this->input->post('i_nationalitydes');
            $query['Methnic'] = $ethnic_ = $this->input->post('ethnic');
            $query['Maddress'] = $address_ = $this->input->post('address');
            $query['Mcity'] = $city_ = $this->input->post('city');
            $query['Mcitydes'] = $citydes_ = $this->input->post('i_citydes');
            $query['Msubdistrict'] = $subdistrict_ = $this->input->post('subdistrict');
            $query['Msubdistrictdes'] = $subdistrictdes_ = $this->input->post('i_subdistrictdes');
            $query['Mdistrict'] = $district_ = $this->input->post('district');
            $query['Mdistrictdes'] = $districtdes_ = $this->input->post('i_districtdes');
            $query['Mregion'] = $region_ = $this->input->post('region');
            $query['Mregiondes'] = $regiondes_ = $this->input->post('i_regiondes');
            $query['Mprovince'] = $province_ = $this->input->post('province');
            $query['Mprovincedes'] = $provincedes_ = $this->input->post('i_provincedes');
            $query['Mcountry'] = $country_ = $this->input->post('country');
            $query['Mcountrydes'] = $countrydes_ = $this->input->post('i_countrydes');
            $query['Mpostcode'] = $postcode_ = $this->input->post('postcode');
            $query['Midentityno'] = $identityno_ = $this->input->post('identityno');
            $query['Midentityexpire'] = $identityexpire_ = $this->input->post('identityexpire');
            $query['Mpersonalid'] = $personalid_ = $this->input->post('personalid');

            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
            // $this->ddoo_upload('photo');
            // $photo = $_FILES['photo']['name'];
            $photo = $this->upload_image_reg('photo');
            }else{
                $photo = "";
            }
            if(isset($_FILES['identity']) && $_FILES['identity']['name'] != ''){
                // $this->ddoo_upload('identity');
                // $identity = $_FILES['identity']['name'];
                $identity = $this->upload_image_reg('identity');
            }else{
                $identity = "";
            }

            //Job Information
            $query['Mcompany'] = $company_ = $this->input->post('company');
            $query['Mcompanydes'] = $companydes_ = $this->input->post('i_company_des');
            $query['Mbranch'] = $branch_ = $this->input->post('branch');
            $query['Mbranchdes'] = $branchdes_ = $this->input->post('i_branchdes');
            $query['Mdeptcode'] = $deptcode_ = $this->input->post('deptcode');
            $query['Mdeptcodedes'] = $deptdes_ = $this->input->post('i_deptdes');
            $query['Mbucode'] = $bucode_ = $this->input->post('i_bucode');
            $query['Mbudes'] = $budes_ = $this->input->post('i_budes');
            $query['Mdivcode'] = $divcode_ = $this->input->post('i_divcode');
            $query['Mdivdes'] = $divdes_ = $this->input->post('i_divdes');
            $query['Mcostcenter'] = $costcenter_ = $this->input->post('costcenter');
            $query['Mcostcenterdes'] = $costcenterdes_ = $this->input->post('i_costdes');
            $query['Memployeeclass'] = $employeeclass_ = $this->input->post('employeeclass');
            $query['Memployeeclassdes'] = $employeeclassdes_ = $this->input->post('i_employeeclassdes');
            $query['Memployeetype'] = $employeetype_ = $this->input->post('employeetype');
            $query['Memployeetypedes'] = $employeetypedes_ = $this->input->post('i_employeetypedes');
            $query['Msupervisor'] = $supervisor_ = $this->input->post('supervisor');
            $query['Msupervisordes'] = $supervisordes_ = $this->input->post('i_sup_des');
            $query['Msupervisortitle'] = $supervisortitle_ = $this->input->post('i_sup_title_code');
            $query['Msupervisortitledes'] = $supervisortitledes_ = $this->input->post('i_sup_title_des');
            $query['Mjobtitle'] = $jobtitle_ = $this->input->post('jobtitle');
            $query['Mjobtitledes'] = $jobtitledes_ = $this->input->post('i_jobtitle');
            $query['Mpointofhire'] = $pointofhire_ = $this->input->post('pointofhire');
            $query['Mhiredate'] = $hiredate_ = $this->input->post('hiredate');
            $query['Mstatus'] = $status_ = $this->input->post('status');
            $query['Mstatusdate'] = $statusdate_ = $this->input->post('statusdate');
            $query['Mworkfunction'] = $workfunction_ = $this->input->post('workfunction');
            $query['Mworkfunctiondes'] = $workfunctiondes_ = $this->input->post('i_workfunctiondes');
            $query['Mwgroup'] = $wgroup_ = $this->input->post('i_wgroup');
            $query['Mwgroupdes'] = $wgroupdes_ = $this->input->post('i_wgroupdes');
            $query['Mworkphone'] = $workphone_ = $this->input->post('workphone');
            $query['Mmobile1'] = $mobile1_ = $this->input->post('mobile1');
            $query['Mwa'] = $wa_ = $this->input->post('wa');
            $query['Memailpersonal'] = $emailpersonal_ = $this->input->post('emailpersonal');
            $query['Mptkp'] = $ptkp_ = $this->input->post('ptkp');
            $query['Mnpwp'] = $npwp_ = $this->input->post('npwp');
            $datas['cek'] = $this->M_humanresource->cek_idnumber($idnumber_);
            if ($datas['cek'] != true) {
                $personaldata = array(
                    'IDNumber' =>$idnumber_,
                    'IDNumberIdentifier' =>$idnumberidentifier_,
                    'FirstName' => $firstname_,
                    'MiddleName' =>$middlename_,
                    'LastName' =>$lastname_,
                    'NickName' =>$nickname_,
                    'FullName' =>$fullname_,
                    'Gender' =>$gender_,
                    'DateofBirth' =>$dateofbirth_,
                    'PointofBirth' =>$pointofbirth_,
                    'MaritalStatus' =>$maritalstatus_,
                    'Religion' =>$religion_,
                    'Nationality' =>$nationality_,
                    'Ethnic' =>$ethnic_,
                    'Address' =>$address_,
                    'City' =>$city_,
                    'SubDistrict' =>$subdistrict_,
                    'District' =>$district_,
                    'Region' =>$region_,
                    'Province' =>$province_,
                    'Country' =>$country_,
                    'PostCode' =>$postcode_,
                    'Identity' =>$identity,
                    'IdentityNo' =>$identityno_,
                    'IdentityExpire' =>$identityexpire_,
                    'Photo' =>$photo,
                    'PersonalID' =>$personalid_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_data', $personaldata);

                $jobinformation = array(
                    'IDNumber' =>$idnumber_,
                    'Company' =>$company_,
                    'Branch' =>$branch_,
                    'DeptCode' =>$deptcode_,
                    'CostCenter' =>$costcenter_,
                    'EmployeeClass' =>$employeeclass_,
                    'EmployeeType' =>$employeetype_,
                    'Supervisor' => $supervisor_,
                    'JobTitle' =>$jobtitle_,
                    'PointofHire' =>$pointofhire_,
                    'HireDate' =>$hiredate_,
                    'Status' =>'Active',
                    'StatusDate' => date('Y-m-d'),
                    'WorkFunction' =>$workfunction_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                    'WA' =>$wa_,
                    'EmailPersonal' =>$emailpersonal_,
                    'PTKP' =>$ptkp_,
                    'NPWP' =>$npwp_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job', $jobinformation);

                $employeeappend = array(
                    'IDNumber' =>$idnumber_,
                    'IDNumberIdentifier' =>$idnumberidentifier_,
                    'FirstName' => $firstname_,
                    'MiddleName' =>$middlename_,
                    'LastName' =>$lastname_,
                    'NickName' =>$nickname_,
                    'FullName' =>$fullname_,
                    'Gender' =>$gender_,
                    'DateofBirth' =>$dateofbirth_,
                    'PointofBirth' =>$pointofbirth_,
                    'MaritalStatus' =>$maritalstatus_,
                    'MaritalStatusDes' =>$maritalstatusdes_,
                    'Religion' =>$religion_,
                    'Nationality' =>$nationality_,
                    'NationalityDes' =>$nationalitydes_,
                    'Ethnic' =>$ethnic_,
                    'Address' =>$address_,
                    'CityCode' =>$city_,
                    'CityDes' =>$citydes_,
                    'SubDistrictCode' =>$subdistrict_,
                    'SubDistrictDes' =>$subdistrictdes_,
                    'DistrictCode' =>$district_,
                    'DistrictDes' =>$districtdes_,
                    'RegionCode' =>$region_,
                    'RegionDes' =>$regiondes_,
                    'ProvinceCode' =>$province_,
                    'ProvinceDes' =>$provincedes_,
                    'CountryCode' =>$country_,
                    'CountryDes' =>$countrydes_,
                    'PostCode' =>$postcode_,
                    'Identity' =>$identity,
                    'IdentityNo' =>$identityno_,
                    'IdentityExpire' =>$identityexpire_,
                    'Photo' =>$photo,
                    'PersonalID' =>$personalid_,
                    'Company' =>$company_,
                    'ComDes' =>$companydes_,
                    'Branch' =>$branch_,
                    'BranchDes' =>$branchdes_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'BusinessUnit' =>$bucode_,
                    'BUDes' =>$budes_,
                    'DivCode' =>$divcode_,
                    'DivisionName' =>$divdes_,
                    'CostCenter' =>$costcenter_,
                    'CostCenterDes' =>$costcenterdes_,
                    'EmployeeClass' =>$employeeclass_,
                    'EmployeeClassDes' =>$employeeclassdes_,
                    'EmployeeType' =>$employeetype_,
                    'EmployeeTypeDes' =>$employeetypedes_,
                    'Supervisor' => $supervisor_,
                    'SupervisorName' => $supervisordes_,
                    'SupervisorTitle' => $supervisortitle_,
                    'SupervisorTitleDes' => $supervisortitledes_,
                    'JobTitle' =>$jobtitle_,
                    'JobTitleDes' =>$jobtitledes_,
                    'PointofHire' =>$pointofhire_,
                    'HireDate' =>$hiredate_,
                    'Status' =>'Active',
                    'StatusDate' => date('Y-m-d'),
                    'WorkFunction' =>$workfunction_,
                    'WorkFunctionDes' =>$workfunctiondes_,
                    'WorkFunctionGroup' =>$wgroup_,
                    'WorkFunctionGroupDes' =>$wgroupdes_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                    'WA' =>$wa_,
                    'EmailPersonal' =>$emailpersonal_,
                    'PTKP' =>$ptkp_,
                    'NPWP' =>$npwp_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_hr_append', $employeeappend);

                $datacom=array(
                    'IDNumber' =>$idnumber_,
                    'Company' =>$company_,
                    'CompanyDes' =>$companydes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_com', $datacom);

                $databranch = array(
                    'IDNumber' =>$idnumber_,
                    'Branch' =>$branch_,
                    'BranchDes' =>$branchdes_,
                    'Company' =>$company_,
                    'CompanyDes' => $companydes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_branch', $databranch);

                $datadepartment = array(
                    'IDNumber' =>$idnumber_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'BuCode' => $bucode_,
                    'BuDes' => $budes_,
                    'DivCode' => $divcode_,
                    'DivDes' => $divdes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_dept', $datadepartment);

                $datacostcenter = array(
                    'IDNumber' =>$idnumber_,
                    'CostCenterCode' =>$costcenter_,
                    'CostCenterDes' =>$costcenterdes_,
                    'DeptCode' =>$deptcode_,
                    'DeptDes' =>$deptdes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_costcenter', $datacostcenter);

                $datacontact=array(
                    'IDNumber' =>$idnumber_,
                    'WorkPhone' =>$workphone_,
                    'Mobile1' =>$mobile1_,
                   
                  
                    'WA' =>$wa_,
                   
                    'EmailPersonal' =>$emailpersonal_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_contact', $datacontact);

                $dataemptype=array(
                    'IDNumber' =>$idnumber_,
                    'EmployeeType' =>$employeetype_,
                    'EmployeeTypeDes' =>$employeetypedes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_employeetype', $dataemptype);

                $datahiredate=array(
                    'IDNumber' =>$idnumber_,
                    'HireDate' =>$hiredate_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_hiredate', $datahiredate);

                $datajobtitle=array(
                    'IDNumber' =>$idnumber_,
                    'JobTitle' =>$jobtitle_,
                    'JobTitleDes' =>$jobtitledes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_jobtitle', $datajobtitle);

                $datajobworkfunction=array(
                    'IDNumber' =>$idnumber_,
                    'WorkFunction' =>$workfunction_,
                    'WorkFunctionDes' =>$workfunctiondes_,
                    'WorkGroup' =>$wgroup_,
                    'WorkGroupDes' =>$wgroupdes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_jobworkfunction', $datajobworkfunction);

                $datamarital=array(
                    'IDNumber' =>$idnumber_,
                    'Marital' =>$maritalstatus_,
                    'MaritalDes' =>$maritalstatusdes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_marital', $datamarital);

                $datapointofhire=array(
                    'IDNumber' =>$idnumber_,
                    'PointOfHire' =>$pointofhire_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_pointofhire', $datapointofhire);

                $datasupervisor=array(
                    'IDNumber' =>$idnumber_,
                    'Supervisor' => $supervisor_,
                    'SupervisorName' => $supervisordes_,
                    'SupervisorTitle' => $supervisortitle_,
                    'SupervisorTitleDes' => $supervisortitledes_,
                    'RegBy' => '',
                    'RegDate' => date('Y-m-d')
                );
                $this->M_humanresource->insert('tbl_emp_per_job_his_supervisor', $datasupervisor);
                $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data submitted</center> </div>');
                    redirect('Humanresource/view_new_data_personal_abc');  
            }else{
            $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Duplicated Data !</strong></center></div>');
                redirect('Humanresource/view_new_data_personal_abc');
            }              
        }
    }

    function transfer_edit_data_personal_abc(){
        if ($this->input->post('submitdataeditpersonal')) {
            //Personal Data
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');
            $query['Midnumberidentifier'] = $idnumberidentifier_ = $identifier;
            $query['Mfirstname'] = $firstname_ = $this->input->post('firstname');
            $query['Mmiddlename'] = $middlename_ = $this->input->post('middlename');
            $query['Mlastname'] = $lastname_ = $this->input->post('lastname');
            $query['Mnickname'] = $nickname_ = $this->input->post('nickname');
            $query['Mfullname_'] = $fullname_ = $this->input->post('fullname');
            $query['Mgender'] = $gender_ = $this->input->post('gender');
            $query['Mdateofbirth'] = $dateofbirth_ = $this->input->post('dateofbirth');
            $query['Mpointofbirth'] = $pointofbirth_ = $this->input->post('pointofbirth');
            $query['Mreligion'] = $religion_ = $this->input->post('religion');
            $query['Mnationality'] = $nationality_ = $this->input->post('nationality');
            $query['Methnic'] = $ethnic_ = $this->input->post('ethnic');
            $query['Maddress'] = $address_ = $this->input->post('address');
            $query['Mcity'] = $city_ = $this->input->post('city');
            $query['Mcitydes'] = $citydes_ = $this->input->post('i_citydes');
            $query['Msubdistrict'] = $subdistrict_ = $this->input->post('subdistrict');
            $query['Msubdistrictdes'] = $subdistrictdes_ = $this->input->post('i_subdistrictdes');
            $query['Mdistrict'] = $district_ = $this->input->post('district');
            $query['Mdistrictdes'] = $districtdes_ = $this->input->post('i_districtdes');
            $query['Mregion'] = $region_ = $this->input->post('region');
            $query['Mregiondes'] = $regiondes_ = $this->input->post('i_regiondes');
            $query['Mprovince'] = $province_ = $this->input->post('province');
            $query['Mprovincedes'] = $provincedes_ = $this->input->post('i_provincedes');
            $query['Mcountry'] = $country_ = $this->input->post('country');
            $query['Mcountrydes'] = $countrydes_ = $this->input->post('i_countrydes');
            $query['Mpostcode'] = $postcode_ = $this->input->post('postcode');
            $query['Mpersonalid'] = $personalid_ = $this->input->post('personalid');

            $personaldata = array(
                'FirstName' => $firstname_,
                'MiddleName' =>$middlename_,
                'LastName' =>$lastname_,
                'NickName' =>$nickname_,
                'FullName' =>$fullname_,
                'Gender' =>$gender_,
                'DateofBirth' =>$dateofbirth_,
                'PointofBirth' =>$pointofbirth_,
                'Religion' =>$religion_,
                'Nationality' =>$nationality_,
                'Ethnic' =>$ethnic_,
                'Address' =>$address_,
                'City' =>$city_,
                'SubDistrict' =>$subdistrict_,
                'District' =>$district_,
                'Region' =>$region_,
                'Province' =>$province_,
                'Country' =>$country_,
                'PostCode' =>$postcode_,
                'PersonalID' =>$personalid_
            );
            $this->M_humanresource->edit_emp_data_byid($idnumber_, $personaldata);

            $employeeappend = array(
                'FirstName' => $firstname_,
                'MiddleName' =>$middlename_,
                'LastName' =>$lastname_,
                'NickName' =>$nickname_,
                'FullName' =>$fullname_,
                'Gender' =>$gender_,
                'DateofBirth' =>$dateofbirth_,
                'PointofBirth' =>$pointofbirth_,
                'Religion' =>$religion_,
                'Nationality' =>$nationality_,
                'Ethnic' =>$ethnic_,
                'Address' =>$address_,
                'CityCode' =>$city_,
                'CityDes' =>$citydes_,
                'SubDistrictCode' =>$subdistrict_,
                'SubDistrictDes' =>$subdistrictdes_,
                'DistrictCode' =>$district_,
                'DistrictDes' =>$districtdes_,
                'RegionCode' =>$region_,
                'RegionDes' =>$regiondes_,
                'ProvinceCode' =>$province_,
                'ProvinceDes' =>$provincedes_,
                'CountryCode' =>$country_,
                'CountryDes' =>$countrydes_,
                'PostCode' =>$postcode_,
                'PersonalID' =>$personalid_
            );
            $this->M_humanresource->edit_emp_app_data_byid($idnumber_, $employeeappend);
          
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data edited</center> </div>');
                redirect('Humanresource/view_edit_data_personal_abc/'.$idnumber_.'/#persdata');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be edited</center></div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$idnumber_.'/#persdata');    
        }
    }

    function transfer_edit_data_job_abc(){
        if ($this->input->post('submitdataeditjob')) {
            //Job Information
            $identifier = ($this->input->post('i_check_aidnumber') == 'iset') ? 'iset' : 'inc';
            $query['Midnumber'] = $idnumber_ = $this->input->post('i_idnumber');

            $query['Memployeeclass'] = $employeeclass_ = $this->input->post('employeeclass');
            $query['Memployeeclassdes'] = $employeeclassdes_ = $this->input->post('i_employeeclassdes');

            $query['Mjobpoint'] = $jobpoint_ = $this->input->post('jobpoint');
            $query['Mjobpointdes'] = $jobpointdes_ = $this->input->post('i_jobpointdes');
            $query['Mjobratepoint'] = $jobratepoint_ = $this->input->post('i_jobratepoint');
            $query['Mjobamountpoint'] = $jobamountpoint_ = $this->input->post('i_jobamountpoint');
          
            $query['Mstatus'] = $status_ = $this->input->post('status');
            $query['Mstatusdate'] = $statusdate_ = $this->input->post('statusdate');
        
            $query['Mmobile1'] = $mobile1_ = $this->input->post('mobile1');
            $query['Mwa'] = $wa_ = $this->input->post('wa');
            $query['Mworkphone'] = $workphone_ = $this->input->post('workphone');
            $query['Memailpersonal'] = $emailpersonal_ = $this->input->post('emailpersonal');

            $query['Mptkp'] = $ptkp_ = $this->input->post('ptkp');
            $query['Mnpwp'] = $npwp_ = $this->input->post('npwp');
          
            $jobinformation = array(
                'EmployeeClass' =>$employeeclass_,            
                'JobPoint' =>$jobpoint_,
                'WorkPhone' =>$workphone_,
                'Mobile1' =>$mobile1_,
                'WA' =>$wa_,
                'EmailPersonal' =>$emailpersonal_,
                'PTKP' =>$ptkp_,
                'NPWP' =>$npwp_,
            );
            $this->M_humanresource->edit_emp_job_data_byid($idnumber_, $jobinformation);

            $employeeappend = array(
                'EmployeeClass' =>$employeeclass_,
                'EmployeeClassDes' =>$employeeclassdes_,
                'JobPoint' =>$jobpoint_,
                'JobPointDes' =>$jobpointdes_,
                'JobRatePoint' =>$jobratepoint_,
                'JobAmountPoint' =>$jobamountpoint_,
                'Mobile1' =>$mobile1_,
                'WA' =>$wa_,
                'WorkPhone' =>$workphone_,
                'EmailPersonal' =>$emailpersonal_,
                'PTKP' =>$ptkp_,
                'NPWP' =>$npwp_,
            );
            $this->M_humanresource->edit_emp_app_data_byid($idnumber_, $employeeappend);
          
            $this->session->set_flashdata('success_edit', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success !</strong> data edited</center> </div>');
                redirect('Humanresource/view_edit_data_personal_abc/'.$idnumber_.'/#jobinfo');               
        }else{
            $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be edited</center></div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$idnumber_.'/#jobinfo');    
        }
    }

    function edit_persphoto_byid_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitpersphoto')) {
            $id = $this->input->post('IDNumber');
            $idn = $this->input->post('idnum');
            if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
                // $this->ddoo_upload('photo');
                // $photo = $_FILES['photo']['name'];
                $photo = $this->upload_image_reg('photo');
            }else{
                $photo = "";
            }
            $datapersphoto = array(
                'Photo' => $photo,
            );
            $this->M_humanresource->edit_persphoto_data_byid($idn, $datapersphoto);
            $this->M_humanresource->edit_persphoto_app_data_byid($idn, $datapersphoto);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#pers');   

        }else{
        $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
        redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#pers');        
        }
    }

    function edit_ktp_byid_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitktpfile')) {
            $id = $this->input->post('IDNumber');
            $identityno_ = $this->input->post('identityno');
            $identityex_ = $this->input->post('identityexpire');
            if(isset($_FILES['identity']) && $_FILES['identity']['name'] != ''){
                // $this->ddoo_upload('identity');
                // $photo = $_FILES['identity']['name'];
                $identity = $this->upload_image_reg('identity');
            }else{
                $identity = "";
            }
            $datafilektp = array(
                'Identity' => $identity,
                'IdentityNo' => $identityno_,
                'IdentityExpire' => $identityex_,
            );
            $this->M_humanresource->edit_ktp_data_byid($id, $datafilektp);
            $this->M_humanresource->edit_ktp_app_data_byid($id, $datafilektp);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#pers');   

        }else{
        $this->session->set_flashdata('failed_edit', '<div class="alert alert-danger alert-dismissable"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><center><strong>Failed!</strong> data cannot be submit</center></div>');
        redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#pers');        
        }
    }

    function update_dept_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submit')) {
            $id = $this->input->post('IDNumber');
            $data_upt_app = array(
              'Company' => $this->input->post('i_companycode'),
              'ComDes' => $this->input->post('i_companydes'),
              'Branch' => $this->input->post('i_branchcode'),
              'BranchDes' => $this->input->post('i_branchdes'),
              'DivCode' => $this->input->post('i_divcode'),
              'DivisionName' => $this->input->post('i_divdes'),
              'BusinessUnit' => $this->input->post('i_bucode'),
              'BUDes' => $this->input->post('i_budes'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'CostCenter' => $this->input->post('costcenter'),
              'CostCenterDes' => $this->input->post('i_costdes')
            );
            $this->M_humanresource->update_dept_data_byid_append($id, $data_upt_app);
            $data_upt_job = array(
              'Company' => $this->input->post('i_companycode'),
              'Branch' => $this->input->post('i_branchcode'),
              'DeptCode' => $this->input->post('i_dept'),
              'CostCenter' => $this->input->post('costcenter')
            );
            $this->M_humanresource->update_dept_data_byid($id, $data_upt_job);
            // $data_upt_his_company = array(
            //   'IDNumber' => $this->input->post('IDNumber'),
            //   'Company' => $this->input->post('i_companycode'),
            //   'CompanyDes' => $this->input->post('i_companydes'),
            //   'Reason' => $this->input->post('reason'),
            //   'RegBy' => $this->session->userdata('IDNumber'),
            //   'RegDate' => date('Y-m-d')
            // );
            // $this->M_humanresource->insert('tbl_emp_per_job_his_com', $data_upt_his_company);
            $data_upt_his_branch = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Branch' => $this->input->post('i_branchcode'),
              'BranchDes' => $this->input->post('i_branchdes'),
              'Company' => $this->input->post('i_companycode'),
              'CompanyDes' => $this->input->post('i_companydes'),
              'Reason' => $this->input->post('reason')  ,
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_branch', $data_upt_his_branch);
            $data_upt_his_department = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'BuCode' => $this->input->post('i_bucode'),
              'BuDes' => $this->input->post('i_budes'),
              'DivCode' => $this->input->post('i_divcode'),
              'DivDes' => $this->input->post('i_divdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_dept', $data_upt_his_department);
            $data_upt_his_costcenter = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'CostCenterCode' => $this->input->post('costcenter'),
              'CostCenterDes' => $this->input->post('i_costdes'),
              'DeptCode' => $this->input->post('i_dept'),
              'DeptDes' => $this->input->post('i_deptdesc'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d')
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_costcenter', $data_upt_his_costcenter);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_marital_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditmarital')) {
            $id = $this->input->post('IDNumber');
            $data_marital = array(
              'MaritalStatus' => $this->input->post('maritalstatus'),
              'MaritalStatusDes' => $this->input->post('i_maritalstatusdes') 
            );
            $this->M_humanresource->update_marital_data_byid_append($id, $data_marital);
            $data_marital1 = array(
              'MaritalStatus' => $this->input->post('maritalstatus')
            );
            $this->M_humanresource->update_marital_data_byid($id, $data_marital1);
            $data_marital2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Marital' => $this->input->post('maritalstatus'),
              'MaritalDes' => $this->input->post('i_maritalstatusdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_marital', $data_marital2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#persdata');        
        }
    }

    function update_jobtitle_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditjobtitle')) {
            $id = $this->input->post('IDNumber');
            $data_jobtitle = array(
              'JobTitle' => $this->input->post('jobtitle'),
              'JobTitleDes' => $this->input->post('i_jobtitle') 
            );
            $this->M_humanresource->update_jobtitle_data_byid_append($id, $data_jobtitle);
            $data_jobtitle1 = array(
              'JobTitle' => $this->input->post('jobtitle')
            );
            $this->M_humanresource->update_jobtitle_data_byid($id, $data_jobtitle1);
            $data_jobtitle2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'JobTitle' => $this->input->post('jobtitle'),
              'JobTitleDes' => $this->input->post('i_jobtitle'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_jobtitle', $data_jobtitle2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_workfunction_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkfunction')) {
            $id = $this->input->post('IDNumber');
            $data_workfunction = array(
              'WorkFunction' => $this->input->post('workfunction'),
              'WorkFunctionDes' => $this->input->post('i_workfunctiondes') 
            );
            $this->M_humanresource->update_workfunction_data_byid_append($id, $data_workfunction);
            $data_workfunction1 = array(
              'WorkFunction' => $this->input->post('workfunction')
            );
            $this->M_humanresource->update_workfunction_data_byid($id, $data_workfunction1);
            $data_workfunction2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'WorkFunction' => $this->input->post('workfunction'),
              'WorkFunctionDes' => $this->input->post('i_workfunctiondes'),
              'WorkGroup' => $this->input->post('i_wgroup'),
              'WorkGroupDes' => $this->input->post('i_wgroupdes'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_jobworkfunction', $data_workfunction2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_workgroup_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditworkgroup')) {
            $id = $this->input->post('IDNumber');
            $data_workgroup = array(
              'Crew' => $this->input->post('crew'),
              'CrewDes' => $this->input->post('i_workgroup') 
            );
            $this->M_humanresource->update_workgroup_data_byid_append($id, $data_workgroup);
            $data_workgroup1 = array(
              'Crew' => $this->input->post('crew')
            );
            $this->M_humanresource->update_workgroup_data_byid($id, $data_workgroup1);
            $data_workgroup2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Crew' => $this->input->post('crew'),
              'CrewDes' => $this->input->post('i_workgroup'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_crew', $data_workgroup2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_hiredate_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submitedithiredate')) {
            $id = $this->input->post('IDNumber');
            $data_hiredate = array(
              'HireDate' => $this->input->post('hiredate')
            );
            $this->M_humanresource->update_hiredate_data_byid_append($id, $data_hiredate);
            $data_hiredate1 = array(
              'HireDate' => $this->input->post('hiredate')
            );
            $this->M_humanresource->update_hiredate_data_byid($id, $data_hiredate1);
            $data_hiredate2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'HireDate' => $this->input->post('hiredate'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_hiredate', $data_hiredate2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_pointofhire_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditpointofhire')) {
            $id = $this->input->post('IDNumber');
            $data_pointofhire = array(
              'PointofHire' => $this->input->post('pointofhire')
            );
            $this->M_humanresource->update_pointofhire_data_byid_append($id, $data_pointofhire);
            $data_pointofhire1 = array(
              'PointofHire' => $this->input->post('pointofhire')
            );
            $this->M_humanresource->update_pointofhire_data_byid($id, $data_pointofhire1);
            $data_pointofhire2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'PointOfHire' => $this->input->post('pointofhire'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_pointofhire', $data_pointofhire2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function update_supervisor_abc(){
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        if ($this->input->post('submiteditsupervisor')) {
            $id = $this->input->post('IDNumber');
            $data_supervisor = array(
              'Supervisor' => $this->input->post('supervisor'),
              'SupervisorName' => $this->input->post('i_sup_des'),
              'SupervisorTitle' => $this->input->post('i_sup_title_code'),
              'SupervisorTitleDes' => $this->input->post('i_sup_title_des') 
            );
            $this->M_humanresource->update_supervisor_data_byid_append($id, $data_supervisor);
            $data_supervisor1 = array(
              'Supervisor' => $this->input->post('supervisor')
            );
            $this->M_humanresource->update_supervisor_data_byid($id, $data_supervisor1);
            $data_supervisor2 = array(
              'IDNumber' => $this->input->post('IDNumber'),
              'Supervisor' => $this->input->post('supervisor'),
              'SupervisorName' => $this->input->post('i_sup_des'),
              'SupervisorTitle' => $this->input->post('i_sup_title_code'), 
              'SupervisorTitleDes' => $this->input->post('i_sup_title_des'),
              'Reason' => $this->input->post('reason'),
              'RegBy' => $this->session->userdata('IDNumber'),
              'RegDate' => date('Y-m-d'),  
            );
            $this->M_humanresource->insert('tbl_emp_per_job_his_supervisor', $data_supervisor2);
            $this->session->set_flashdata('success_update', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('Humanresource/view_edit_data_personal_abc/'.$id.'/#jobinfo');        
        }
    }

    function allEmployee_priview_abc()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        $asdept = $this->M_humanresource->get_emp_dept_abc($branch);
        $all = $this->M_humanresource->get_all_employee_abc($branch);

        $value = '';
        $value.='<div id="target-ascla">';
        $value.='<table class="table table-bordered">';
        $value.='<thead>';
        $value.='<tr class="bg-blue-ebonyclay font-white">';
        $value.='<th class="text-center">No</th>';
        $value.='<th class="text-center">ID Number</th>';
        $value.='<th class="text-center">Full Name</th>';
        $value.='<th class="text-center">Job Title</th>';
        $value.='<th class="text-center">Gender</th>';
        $value.='<th class="text-center">Address</th>';
        $value.='<th class="text-center">No. Hp</th>';
        $value.='<th class="text-center">Action</th>';
        $value.='<tr>';
        $value.='</thead>';
        $value.='<tbody>';
        if ($asdept != false) {
            foreach ($asdept as $asd) {
                # code...
                $value.='<tr>';
                $value.='<td colspan="8" class="font-black bold bg-grey-salsa"><i>'.$asd->DeptDes.'</i></td>';
                $value.='</tr>';
                $no=1;
                foreach ($all as $key) {
                    if ($key->DeptCode == $asd->DeptCode) {
                    $value.='<tr class="font-dark">';
                    $value.='<td class="text-center">'.$no.'</td>';
                    $value.='<td>'.$key->IDNumber.'</td>';
                    $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
                    $value.='<td>'.$key->JobTitleDes.'</td>';
                    $value.='<td>'.$key->Gender.'</td>';
                    $value.='<td>'.$key->Address.'</td>';
                    $value.='<td>'.$key->Phone.'</td>';
                    $value.='<td>
                            <center>
                                <a href="'.site_url('Humanresource/view_personal_data_abc/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                                </a>
                                <a href="'.site_url('Humanresource/view_edit_data_personal_abc/'.$key->IDNumber.'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                </a>
                            </center>
                            </td>';
                    $value.='</tr>';
                    $no++;}
                }
            }
            echo json_encode(array('all' => $value));
        } else {
            $value .= '<tr>';
            $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
            $value .= '</tr>';
            echo json_encode(array('all' => $value));
        }
        $value.='</tbody>';
        $value.='</table>';
        $value.='</div>';
    }

    public function search_priview_abc()
    {
        $html = '';
        $query = '';
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->M_humanresource->M_search_data_abc($branch, $query);
        $result = $data->result_array();
        //print_r($this->db->last_query());die;
        $html.='<div id="target-ascla">';
        $html.='<table class="table table-bordered">';
        $html.='<thead>';
        $html.='<tr class="bg-blue-ebonyclay font-white">';
        $html.='<th class="text-center">No</th>';
        $html.='<th class="text-center">ID Number</th>';
        $html.='<th class="text-center">Full Name</th>';
        $html.='<th class="text-center">Job Title</th>';
        $html.='<th class="text-center">Gender</th>';
        $html.='<th class="text-center">Address</th>';
        $html.='<th class="text-center">No. Hp</th>';
        $html.='<th class="text-center">Action</th>';
        $html.='<tr>';
        $html.='</thead>';
        $html.='<tbody>';
        if ($data->num_rows() > 0) {
            $no=1; foreach ($result as $r) {
                $html.='<tr class="font-dark">';
                $html.='<td class="text-center">'.$no.'</td>';
                $html.='<td>'.$r['IDNumber'].'</td>';
                $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
                $html.='<td>'.$r['JobTitleDes'].'</td>';
                $html.='<td>'.$r['Gender'].'</td>';
                $html.='<td>'.$r['Address'].'</td>';
                $html.='<td>'.$r['Phone'].'</td>';
                $html.='<td>
                        <center>
                            <a href="'.site_url('Humanresource/view_personal_data_abc/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                            </a>
                            <a href="'.site_url('Humanresource/view_edit_data_personal_abc/'.$r['IDNumber'].'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                            </a>
                        </center>
                        </td>';
                $html.='</tr>';
            $no++;}
        } else {
            $html .= '<tr><td align="center" colspan="10"><p class="font-dark">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-blue-madison">Please check you input</span></p></td></tr>';
        }
        $html.='</tbody>';
        $html.='</table>';
        $html.='</div>';
        echo $html;
    }


    function view_personal_list_abc() {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Master';
        $query['headert2'] = 'Profile';
        $query['title'] = 'Master Profile';
        $this->load->view('humanresource/employeeadmin/v_personal_list_abc', $query);
    }

    function allEmployee_listreg_abc()
    {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        $asdept = $this->M_humanresource->get_emp_dept_abc($branch);
        $all = $this->M_humanresource->get_all_employee_abc($branch);

        $value = '';
        $value.='<div id="target-ascla">';
        $value.='<table class="table table-bordered">';
        $value.='<thead>';
        $value.='<tr class="bg-blue-madison font-white">';
        $value.='<th class="text-center">No</th>';
        $value.='<th class="text-center">ID Number</th>';
        $value.='<th class="text-center">Full Name</th>';
        $value.='<th class="text-center">Jobt Title</th>';
        $value.='<th class="text-center">Gender</th>';
        $value.='<th class="text-center">Address</th>';
        $value.='<th class="text-center">No. Hp</th>';
        $value.='<th class="text-center">Action</th>';
        $value.='<tr>';
        $value.='</thead>';
        $value.='<tbody>';
        if ($asdept != false) {
            foreach ($asdept as $asd) {
                # code...
                $value.='<tr>';
                $value.='<td colspan="8" class="font-black bold bg-grey-salsa"><i>'.$asd->DeptDes.'</i></td>';
                $value.='</tr>';
                $no=1;
                foreach ($all as $key) {
                    if ($key->DeptCode == $asd->DeptCode) {
                    $value.='<tr class="font-dark">';
                    $value.='<td class="text-center">'.$no.'</td>';
                    $value.='<td>'.$key->IDNumber.'</td>';
                    $value.='<td>'.$key->FirstName.' '.$key->MiddleName.' '.$key->LastName.'</td>';
                    $value.='<td>'.$key->JobTitleDes.'</td>';
                    $value.='<td>'.$key->Gender.'</td>';
                    $value.='<td>'.$key->Address.'</td>';
                    $value.='<td>'.$key->Phone.'</td>';
                    $value.='<td>
                            <center>
                                <a href="'.site_url('Humanresource/view_personal_data_abc/'.$key->IDNumber.'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                                </a>
                                <a href="'.site_url('Humanresource/view_edit_data_personal_abc/'.$key->IDNumber.'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-xs yellow" title="Discontinue Personal">
                                    <i class="fa fa-close"></i>
                                </a>
                            </center>
                            </td>';
                    $value.='</tr>';
                    $no++;}
                }
            }
            echo json_encode(array('all' => $value));
        } else {
            $value .= '<tr>';
            $value .= '<td colspan="10" align="center" class="uppercase font-white">NO DATA REGISTER</td>';
            $value .= '</tr>';
            echo json_encode(array('all' => $value));
        }
        $value.='</tbody>';
        $value.='</table>';
        $value.='</div>';
    }

    public function search_priview_listreg_abc()
    {
        $html = '';
        $query = '';
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->M_humanresource->M_search_data_abc($branch, $query);
        $result = $data->result_array();
        //print_r($this->db->last_query());die;
        $html.='<div id="target-ascla">';
        $html.='<table class="table table-bordered">';
        $html.='<thead>';
        $html.='<tr class="bg-blue-madison font-white">';
        $html.='<th class="text-center">No</th>';
        $html.='<th class="text-center">ID Number</th>';
        $html.='<th class="text-center">Full Name</th>';
        $html.='<th class="text-center">Job Title</th>';
        $html.='<th class="text-center">Gender</th>';
        $html.='<th class="text-center">Address</th>';
        $html.='<th class="text-center">No. Hp</th>';
        $html.='<th class="text-center">Action</th>';
        $html.='<tr>';
        $html.='</thead>';
        $html.='<tbody>';
        if ($data->num_rows() > 0) {
            $no=1; foreach ($result as $r) {
                $html.='<tr class="font-dark">';
                $html.='<td class="text-center">'.$no.'</td>';
                $html.='<td>'.$r['IDNumber'].'</td>';
                $html.='<td>'.$r['FirstName'].' '.$r['MiddleName'].' '.$r['LastName'].'</td>';
                $html.='<td>'.$r['JobTitleDes'].'</td>';
                $html.='<td>'.$r['Gender'].'</td>';
                $html.='<td>'.$r['Address'].'</td>';
                $html.='<td>'.$r['Phone'].'</td>';
                $html.='<td>
                        <center>
                            <a href="'.site_url('Humanresource/view_personal_data_abc/'.$r['IDNumber'].'').'" type="button" target="_blank" class="btn  btn-xs blue" title="Detail"><i class="fa fa-search"> </i>
                            </a>
                            <a href="'.site_url('Humanresource/view_edit_data_personal_abc/'.$r['IDNumber'].'').'" class="btn btn-xs green" target="_blank" title="Edit Personal"><i class="fa fa-pencil"></i>
                            </a>
                            <a href="#" type="button"class="btn  btn-xs yellow" title="Detail"><i class="fa fa-close"> </i>
                            </a>
                        </center>
                        </td>';
                $html.='</tr>';
            $no++;}
        } else {
            $html .= '<tr><td align="center" colspan="8"><p class="font-dark">Were So Sorry we have <strong>No Employee Data</strong> On you search! <br><span class="font-blue-madison">Please check you input</span></p></td></tr>';
        }
        $html.='</tbody>';
        $html.='</table>';
        $html.='</div>';
        echo $html;
    }

    function view_edit_data_personal_abc($id) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Edit Personal';
        $query['headertitle'] = 'Edit Personal';
        $query['personal'] = $this->M_humanresource->get_data_personaldata($id);

        //Jobinformation Select Dropdown
        $query['get_ethnic'] = $this->M_humanresource->get_data_ethnic();
        $query['get_marital'] = $this->M_humanresource->get_data_marital();
        $query['get_marital_his'] = $this->M_humanresource->get_data_marital_history($id);
        $query['get_employeeclass'] = $this->M_humanresource->get_data_employeeclass();
        $query['get_employeetype'] = $this->M_humanresource->get_data_employeetype();
        $query['get_employeetype_his'] = $this->M_humanresource->get_data_employeetype_history($id);
        $query['get_title'] = $this->M_humanresource->get_data_title();
        $query['get_jobtitle_his'] = $this->M_humanresource->get_data_jobtitle_history($id);
        $query['get_point'] = $this->M_humanresource->get_data_point();
       
        $query['get_workfunction'] = $this->M_humanresource->get_data_workfunction();
        $query['get_workfunction_his'] = $this->M_humanresource->get_data_workfunction_history($id);
        $query['get_workgroup'] = $this->M_humanresource->get_data_workgroup();
        $query['get_workgroup_his'] = $this->M_humanresource->get_data_workgroup_history($id);
       
        $query['get_hire_his'] = $this->M_humanresource->get_data_hiredate_history($id);
        $query['get_pointofhire_his'] = $this->M_humanresource->get_data_pointofhire_history($id);
     
        $query['get_supervisor'] = $this->M_humanresource->get_data_supervisor_abc($branch);
        $query['get_supervisor_his'] = $this->M_humanresource->get_data_supervisor_history($id);
       
        $query['get_country'] = $this->M_humanresource->get_list_country();
        // $query['get_dept'] = $this->M_humanresource->get_all_department();
        $query['get_empcompany'] = $this->M_humanresource->get_company();
        $query['get_data_empcompany_his'] = $this->M_humanresource->get_company_his($id);
        $query['get_data_branch_his'] = $this->M_humanresource->get_branch_his($id);
        $query['get_dept'] = $this->M_humanresource->get_all_data_structure_dept_abc($branch);
        $query['get_data_dept_his'] = $this->M_humanresource->get_dept_his($id);
        $query['get_data_costcenter_his'] = $this->M_humanresource->get_costcenter_his($id);
       
        $this->load->view('humanresource/employeeadmin/v_edit_personaldata_abc', $query);
    }


    //Start - 01Dec2021
    //Rekap Employee Gender
    function view_rekap_preview_all_by_gender_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Gender Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_gender'] = $this->M_humanresource->get_count_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_gender_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_gender_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_gender_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['genders'] = $this->M_humanresource->get_report_emp_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_gender_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_gender_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


        //Details
        $query['genderst'] = $this->M_humanresource->get_report_emp_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datagender'] = $this->M_humanresource->get_report_data_by_gender($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_gender_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_gender', $query);         
    }

    function view_rekap_preview_all_by_religion_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Religion Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_religion'] = $this->M_humanresource->get_count_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_religion_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_religion_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_religion_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_gender_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['religions'] = $this->M_humanresource->get_report_emp_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_religion_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_religion_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['religionst'] = $this->M_humanresource->get_report_emp_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datareligion'] = $this->M_humanresource->get_report_data_by_religion($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_religion_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_religion', $query);         
    }


    //Rekap Employee Marital
    function view_rekap_preview_all_by_marital_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Marital Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_marital'] = $this->M_humanresource->get_count_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_marital_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_marital_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_marital_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_marital_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['maritals'] = $this->M_humanresource->get_report_emp_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_marital_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_marital_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);


        //Details
        $query['maritalst'] = $this->M_humanresource->get_report_emp_by_marital($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datamarital'] = $this->M_humanresource->get_report_data_by_marital_det($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $query['detotal'] = $this->M_humanresource->get_report_data_by_marital_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_marital', $query);         
    }

    //Rekap Employee Ethnic
    function view_rekap_preview_all_by_ethnic_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Ethnic Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_ethnic'] = $this->M_humanresource->get_count_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['eethnict'] = $this->M_humanresource->get_report_emp_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempethnic'] = $this->M_humanresource->get_report_data_by_ethnic($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_ethnic_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_ethnic', $query);     
    }

    //Rekap Employee Type
    function view_rekap_preview_all_by_emptype_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Type Rekap';
          
        $company_ = 'All';          
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;

        //All Caterory
        $query['r_data_emptype'] = $this->M_humanresource->get_count_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_etype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_etype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_etype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_etype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['emptype'] = $this->M_humanresource->get_report_emp_etype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_etype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_etype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['etypest'] = $this->M_humanresource->get_report_emp_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataetype'] = $this->M_humanresource->get_report_data_by_employeetype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeetype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_emptype', $query);         
    }

    //Rekap Employee Class
    function view_rekap_preview_all_by_empclass_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Class Rekap';
       
        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det; 
       
        //All Caterory
        $query['r_data_empclass'] = $this->M_humanresource->get_count_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_empclass_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_empclass_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_empclass_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_eclass_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['empclass'] = $this->M_humanresource->get_report_emp_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_empclass_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_empclass_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empclassst'] = $this->M_humanresource->get_report_emp_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempclass'] = $this->M_humanresource->get_report_data_by_empclass($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_empclass_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_empclass', $query);         
    }

    //Rekap Employment Type
    function view_rekap_preview_all_by_employmenttype_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employment Type Rekap';
        
        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All'; 

        $query['det'] = $det;
        //All Caterory
        $query['r_data_employmenttype'] = $this->M_humanresource->get_count_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Summary
        $query['databranch'] = $this->M_humanresource->get_report_emp_employmenttype_branch($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['buss'] = $this->M_humanresource->get_report_emp_employmenttype_buss($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dept'] = $this->M_humanresource->get_report_emp_employmenttype_dept($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['costcenter'] = $this->M_humanresource->get_report_emp_employmenttype_cc($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['empltype'] = $this->M_humanresource->get_report_emp_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataget'] = $this->M_humanresource->get_report_emp_employmenttype_count($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['grandtotal'] = $this->M_humanresource->get_report_emp_employmenttype_gtotal($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['employmenttypest'] = $this->M_humanresource->get_report_emp_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempltype'] = $this->M_humanresource->get_report_data_by_employmenttype($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employmenttype_det_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_,'All');
        $this->load->view('humanresource/rekap/v_all_rekap_employmenttype', $query);         
    }

    //Rekap Employee Function
    function view_rekap_preview_all_by_empfunction_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Function Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_empfunction'] = $this->M_humanresource->get_count_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empfunctionst'] = $this->M_humanresource->get_report_emp_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempfunction'] = $this->M_humanresource->get_report_data_by_employeefunction($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeefunction_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_employeefunction', $query);     
    }

    //Rekap Employee Grade
    function view_rekap_preview_all_by_empgrade_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Grade Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_empgrade'] = $this->M_humanresource->get_count_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['empgradest'] = $this->M_humanresource->get_report_emp_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataempgrade'] = $this->M_humanresource->get_report_data_by_employeegrade($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeegrade_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_empgrade', $query);     
    }

    //Rekap Employee Level
    function view_rekap_preview_all_by_emplevel_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Level Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_emplevel'] = $this->M_humanresource->get_count_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['emplevelst'] = $this->M_humanresource->get_report_emp_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['dataemplevel'] = $this->M_humanresource->get_report_data_by_employeelevel($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_employeelevel_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_emplevel', $query);     
    }


    //Rekap Employee Company
    function view_rekap_preview_all_by_company_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Company Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_company'] = $this->M_humanresource->get_count_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['ecomnict'] = $this->M_humanresource->get_report_emp_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datacom'] = $this->M_humanresource->get_report_data_by_company($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_company_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_company', $query);     
    }

    //Rekap Employee Department
    function view_rekap_preview_all_by_department_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Department Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_department'] = $this->M_humanresource->get_count_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['edepartmentnict'] = $this->M_humanresource->get_report_emp_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datadepartment'] = $this->M_humanresource->get_report_data_by_department($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_department_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_department', $query);     
    }

    //Rekap Employee Location
    function view_rekap_preview_all_by_location_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Location Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_location'] = $this->M_humanresource->get_count_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['elocationnict'] = $this->M_humanresource->get_report_emp_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datalocation'] = $this->M_humanresource->get_report_data_by_location($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_location_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_location', $query);     
    }

    //Rekap Employee Supervisor
    function view_rekap_preview_all_by_supervisor_by_branch($det) {
        // $branch = $this->session->userdata('branch');
        $branch = '0101';
        // $query['curuser'] = $this->M_humanresource->get_cur_user();
        $query['curuser'] = '090106-001';
        $query['headert1'] = 'Human';
        $query['headert2'] = 'Resource';
        $query['title'] = 'Employee Supervisor Rekap';

        $company_ = 'All';            
        $branch_ = $branch; 
        $bucode_ = 'All'; 
        $deptcode_ = 'All'; 
        $costcenter_ = 'All';  
        $ind_all = $this->session->userdata('index'); 

        $query['ind'] = $ind_all;

        $query['det'] = $det;
        $this->session->set_userdata('index', '');
        //All Category & //Summary
        $query['r_data_supervisor'] = $this->M_humanresource->get_count_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datas'] = $this->M_humanresource->get_report_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);

        //Details
        $query['esupervisornict'] = $this->M_humanresource->get_report_emp_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['datasupervisor'] = $this->M_humanresource->get_report_data_by_supervisor($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        $query['detotal'] = $this->M_humanresource->get_report_data_by_supervisor_total($company_, $branch_, $bucode_, $deptcode_, $costcenter_);
        
        $this->load->view('humanresource/rekap/v_all_rekap_supervisor', $query);     
    }
    //End - 01Dec2021

    //End - Function ABC//

}