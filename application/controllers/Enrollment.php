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
    }

    public function index()
    {
        $data['title'] = 'Form Registration';
        $data['applying'] = $this->db->select('SchoolName, School_Desc')->where('isActive', 1)->get('tbl_02_school')->result();

        $this->load->view('auth/new_std_enroll', $data);
    }

    public function enroll_confirmed()
    {
        $Birth =  date('Y-m-d', strtotime(strtr($_POST['tgllhr'], '/', '-')));
        // $SchoolStart = date('Y-m-d', strtotime(strtr($_POST['schoolstarts'], '/', '-')));

        $data = [
            'FirstName' => $_POST['fname'],
            'MiddleName' => $_POST['mname'],
            'LastName' => $_POST['lname'],
            'NickName' => $_POST['nname'],
            'Gender' => $_POST['gender'],
            'NIK' => $_POST['nik'],
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
            'NISN' => $_POST['nisn'],
            'HousePhone' => $_POST['housephone'],
            'Phone' => $_POST['handheldnumber'],
            'Email' => $_POST['email'],
            'LiveWith' => $_POST['livewith'],
            'Child' => $_POST['child'],
            'Siblings' => $_POST['siblings'],
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
            'GuardianDisability' => $_POST['guardiandisable'],
            'Transportation' => $_POST['transport'],
            'Range' => $_POST['range'],
            'ExactRange' => $_POST['exactrange'],
            'TimeRange' => $_POST['timerange'],
            'Latitude' => $_POST['lintang'],
            'Longitude' => $_POST['bujur'],
            'KIP' => $_POST['kip'],
            'Stayed_KIP' => $_POST['keepkip'],
            'Refuse_PIP' => $_POST['refusepip'],
            'Achievement' => $_POST['achievement'],
            'AchievementLVL' => $_POST['achievementlevel'],
            'AchievementYear' => $_POST['ach_name'],
            'AchievementYear' => $_POST['ach_year'],
            'Sponsor' => $_POST['sponsor'],
            'AchievementRank' => $_POST['ach_rank'],
            'Scholarship' => $_POST['scholarship'],
            'Scholardesc' => $_POST['scholardesc'],
            'ScholarStart' => $_POST['scholarstart'],
            'ScholarFinish' => $_POST['scholarfinish'],
            'Prosperity' => $_POST['prosperity'],
            'ProsperNumber' => $_POST['prospernumber'],
            'ProsperNameTag' => $_POST['prospernametag'],
            'Competition' => $_POST['competition'],
            'Registration' => $_POST['registration'],
            'Applying' => $_POST['applying'],
            // 'SchoolStarts' => $SchoolStart,
            'PreviousSchool' => $_POST['previousschool'],
            'UNnumber' => $_POST['unnumber'],
            'Diploma' => $_POST['diploma'],
            'SKHUN' => $_POST['skhun'],
            'RegDate' => date('Y-m-d')
        ];

        $result = $this->M_confirm_student->confirm($data);

        echo $result;
    }
}
