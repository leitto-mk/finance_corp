<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Enrollment extends CI_Controller
{
    //Constructor to load premises permanently (ex, validation, form_validation)
    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth/M_confirm_student');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = 'Form Registration';
        $data['applying'] = $this->db->select('SchoolName, School_Desc')->where('isActive', 1)->get('tbl_02_school')->result();

        $this->load->view('auth/new_std_enroll', $data);
    }

    public function ajax_get_full_enrollment_data(){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $result = $this->M_confirm_student->get_full_enrollment_data($fname, $lname, $email);

        echo json_encode($result);
    }

    public function enroll_confirmed()
    {
        $filename = strtolower($_POST['fname'] . '_' . $_POST['lname']) . '_' . date('Ymdhms');

        $diploma = '';
        $birthcert = '';
        $kk = '';
        $photo = '';

        $data = [
            'is_enrolled' => 1,
            'FirstName' => ucwords(strtolower($_POST['fname'])),
            'MiddleName' => ucwords(strtolower($_POST['mname'])),
            'LastName' => ucwords(strtolower($_POST['lname'])),
            'NickName' => ucwords(strtolower($_POST['nname'])),
            'Gender' => $_POST['gender'],
            'NIK' => $_POST['nik'],
            'KK' => $_POST['kk'],
            'DateofBirth' => date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '/', '-'))),
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
            'NISN' => $_POST['nisn'],
            'HousePhone' => $_POST['housephone'],
            'Phone' => $_POST['handheldnumber'],
            'Email' => $_POST['email'],
            'LiveWith' => (isset($_POST['livewith']) ? $_POST['livewith'] : '-'),
            'Child' => $_POST['child'],
            'Siblings' => $_POST['siblings'],
            'Father' => $_POST['father'],
            'FatherNIK' => $_POST['fathernik'],
            'FatherBorn' => $_POST['fatheryear'],
            'FatherDegree' => (isset($_POST['fatherdegree']) ? $_POST['fatherdegree'] : '-'),
            'FatherJob' => (isset($_POST['fatherjob']) ? $_POST['fatherjob'] : '-'),
            'FatherIncome' => (isset($_POST['fatherincome']) ? $_POST['fatherincome'] : '-'),
            'FatherDisability' => $_POST['fatherdisabled'],
            'Mother' => $_POST['mother'],
            'MotherNIK' => $_POST['mothernik'],
            'MotherBorn' => $_POST['motheryear'],
            'MotherDegree' => (isset($_POST['motherdegree']) ? $_POST['motherdegree'] : '-'),
            'MotherJob' => (isset($_POST['motherjob']) ? $_POST['motherjob'] : '-'),
            'MotherIncome' => (isset($_POST['motherincome']) ? $_POST['motherincome'] : '-'),
            'MotherDisability' => $_POST['motherdisabled'],
            'Guardian' => $_POST['guardian'],
            'GuardianNIK' => $_POST['guardiannik'],
            'GuardianBorn' => $_POST['guardianyear'],
            'GuardianDegree' => (isset($_POST['guardiandegree']) ? $_POST['guardiandegree'] : '-'),
            'GuardianJob' => (isset($_POST['guardianjob']) ? $_POST['guardianjob'] : '-'),
            'GuardianIncome' => (isset($_POST['guardianincome']) ? $_POST['guardianincome'] : '-'),
            'GuardianDisability' => $_POST['guardiandisabled'],
            'Transportation' => (isset($_POST['transport']) ? $_POST['transport'] : '-'),
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => ($_POST['kip'] ?: 'None'),
            'Stayed_KIP' => (isset($_POST['keepkip']) ? $_POST['keepkip'] : 'no'),
            'Refuse_PIP' => (isset($_POST['refusepip']) ? $_POST['refusepip'] : '-'),
            'Achievement' => (isset($_POST['achievement']) ? $_POST['achievement'] : '-'),
            'AchievementLVL' => (isset($_POST['achievementlevel']) ? $_POST['achievementlevel'] : '-'),
            'AchievementYear' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => (isset($_POST['scholarship']) ? $_POST['scholarship'] : '-'),
            'Scholardesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'Competition' => $_POST['competition'],
            'Applying' => $_POST['applying'],
            'PreviousSchool' => $_POST['previousschool'],
            'UNnumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun'],
            'RegDate' => date('Y-m-d')
        ];

        //CHECK IF DATA ALREADY EXSIST
        $checkData = $this->db->select('DiplomaFile, BirthcertFile, KKFile, Photo')->get_where('tbl_11_enrollment', [
            'FirstName' => $_POST['fname'],
            'LastName' => $_POST['lname'],
            'Email' => $_POST['email']
        ])->row();

        // $compress['image_library'] = 'gd2';
        // $compress['create_thumb'] = FALSE;
        // $compress['maintain_ratio'] = FALSE;
        // $compress['quality'] = '60%';
        // $compress['width'] = 800;
        // $compress['height'] = 800;

        if($_FILES['diplomafile']['name'] !== ''){
            $diploma = "diploma_$filename";
            $diplomaext = pathinfo($_FILES['diplomafile']['name'], PATHINFO_EXTENSION); //GET FILE EXTENTION
            
            //If there's image for ID already, delete the old one
            if($checkData->DiplomaFile){
                if (is_file('./assets/photos/student/' . $checkData->DiplomaFile)) {
                    unlink('./assets/photos/student/' . $checkData->DiplomaFile);
                }
            }
        
            $this->upload->initialize([
                'upload_path' => './assets/photos/student/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'file_name' => $diploma
            ]);

            $this->upload->do_upload('diplomafile');
            
            // Compress uploaded image
            // $compress['source_image'] = './assets/photos/student/' . $diploma . '.' . $diplomaext;
            // $compress['new_image'] = './assets/photos/student/' . $diploma . '.' . $diplomaext;
            // $this->load->library('image_lib', $compress);
            // $this->image_lib->resize();

            $data['DiplomaFile'] = $diploma . '.' . $diplomaext;
        }
        
        if($_FILES['birthcertfile']['name'] !== ''){
            $birthcert = "birthcert_$filename";
            $birthcertext = pathinfo($_FILES['birthcertfile']['name'], PATHINFO_EXTENSION); //GET FILE EXTENTION
            
            //If there's image for ID already, delete the old one
            if($checkData->BirthcertFile){
                if (is_file('./assets/photos/student/' . $checkData->BirthcertFile)) {
                    unlink('./assets/photos/student/' . $checkData->BirthcertFile);
                }
            }
        
            $this->upload->initialize([
                'upload_path' => './assets/photos/student/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'file_name' => $birthcert
            ]);

            $this->upload->do_upload('birthcertfile');
            
            // Compress uploaded image
            // $compress['source_image'] = './assets/photos/student/' . $birthcert . '.' . $birthcertext;
            // $compress['new_image'] = './assets/photos/student/' . $birthcert . '.' . $birthcertext;
            // $this->load->library('image_lib', $compress);
            // $this->image_lib->resize();

            $data['BirthcertFile'] = $birthcert . '.' . $birthcertext;
        }
        
        if($_FILES['kkfile']['name'] !== ''){
            $kk = "kk_$filename";
            $kkext = pathinfo($_FILES['kkfile']['name'], PATHINFO_EXTENSION); //GET FILE EXTENTION
            
            //If there's image for ID already, delete the old one
            if($checkData->KKFile){
                if (is_file('./assets/photos/student/' . $checkData->KKFile)) {
                    unlink('./assets/photos/student/' . $checkData->KKFile);
                };
            }
        
            $this->upload->initialize([
                'upload_path' => './assets/photos/student/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'file_name' => $kk
            ]);

            $this->upload->do_upload('kkfile');
            
            // Compress uploaded image
            // $compress['source_image'] = './assets/photos/student/' . $kk . '.' . $kkext;
            // $compress['new_image'] = './assets/photos/student/' . $kk . '.' . $kkext;
            // $this->load->library('image_lib', $compress);
            // $this->image_lib->resize();

            $data['KKFile'] = $kk . '.' . $kkext;
        }
        
        if($_FILES['photo']['name'] !== ''){
            $photo = "photo_$filename";
            $photoext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); //GET FILE EXTENTION
            
            //If there's image for ID already, delete the old one
            if($checkData->Photo){
                if (is_file('./assets/photos/student/' . $checkData->Photo)) {
                    unlink('./assets/photos/student/' . $checkData->Photo);
                }
            }
        
            $this->upload->initialize([
                'upload_path' => './assets/photos/student/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'file_name' => $photo
            ]);

            $this->upload->do_upload('photo');
            
            // Compress uploaded image
            // $compress['source_image'] = './assets/photos/student/' . $photo . '.' . $photoext;
            // $compress['new_image'] = './assets/photos/student/' . $photo . '.' . $photoext;
            // $this->load->library('image_lib', $compress);
            // $this->image_lib->resize();

            $data['Photo'] = $photo . '.' . $photoext;
        }

        $result = $this->M_confirm_student->confirm($data);

        echo $result;
    }
}
