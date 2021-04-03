<?php
defined('BASEPATH') or exit('No direct script access allowed');

include APPPATH.'third_party\phpmailer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Sign extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth/M_confirm_student');
    }

    public function index()
    {
        $data = [
            'schools' => $this->M_confirm_student->get_active_school()
        ];

        $this->load->view('sign/v_sign_in', $data);
    }

    public function ajax_submit_data(){
        $data = [
            'FirstName' => $_POST['firstname'],
            'LastName' => $_POST['lastname'],
            'DateofBirth' => $_POST['dateofbirth'],
            'Email' => $_POST['email'],
            'Registration' => $_POST['student_type'],
            'Applying' => $_POST['school'],
            'previousschool' => $_POST['previousschool'],
            'Phone' => $_POST['handheldnumber']
        ];

        $checkMail = $this->db->get_where('tbl_11_enrollment', ['Email' => $data['Email']])->num_rows();

        if($checkMail > 0){
            $response = [
                'result' => 'EMAIL_REGISTERED'
            ];
        }else{
            $email = $_POST['email'];
            $school = $this->db->select('SchoolName')->get_where('tbl_02_school', ['School_Desc' => $_POST['school']])->row()->SchoolName;
            $school = strtoupper($school);

            // $mail = new PHPMailer(TRUE);  
            
            // //Server settings
            // // $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'smtp.googlemail.com';                  //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = 'leitto.ibtj@gmail.com';                //SMTP username
            // $mail->Password   = '172304200124';                         //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged [FOR LOCALHOST TEST USE THIS]
            // // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //PHPMailer::ENCRYPTION_SMTPS is encouraged
            // $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // $mail->isHTML(true);                                        //Set Body format to HTML

            // //Recipients
            // $mail->setFrom('kaaenrollmentabase@kaa.sch.id', 'KAA Registration');
            // $mail->addAddress($email, $_POST['firstname'] . ' ' . $_POST['lastname']);     //Add a recipient

            // //Content
            // $mail->Subject = "$school | SIGNIN CREDENTIALS";
            // $mail->Body    = "Welcome to <strong>$school</strong>. your sign-in process has been accepted. You can login to KAA with the following Username and Password:
            //                   <br><br>
            //                   <strong> Username:  $email </strong>
            //                   <br>
            //                   <strong> Password:  123456 </strong>
            //                   <br><br>
            //                   For more information, contact the school administration. 
            //                   <br>
            //                   <span style=\"text-style:italic;color:#008CBA;\">
            //                     This is an automatic notification which will not be responded to any further replies
            //                   </span>.";

            // if($mail->send()){
                
            // }else{
            //     $response = [
            //         'result' => 'MAIL_ERROR',
            //         'email' => $email,
            //         'message' => $mail->ErrorInfo
            //     ];
            // }
            $result = $this->M_confirm_student->confirm($data);
    
            $response = [
                'result' => $result,
                'email' => $email
            ];
        }

        echo json_encode($response);
    }
}
