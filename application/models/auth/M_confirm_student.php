<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_confirm_student extends CI_Model
{
    public function get_active_school(){
        return $this->db->select('School_Desc, SchoolName')->get_where('tbl_02_school', ['isActive' => 1])->result();
    }

    public function get_full_enrollment_data($fname, $lname, $email){
        return $this->db->get_where('tbl_11_enrollment', [
            'FirstName' => $fname,
            'LastName' => $lname,
            'Email' => $email,
        ])->row();
    }

    public function confirm($data)
    {        
        $checkAvailability = $this->db->get_where('tbl_11_enrollment', ['FirstName' => $data['FirstName'], 'LastName' => $data['LastName'], 'Email' => $data['Email']])->num_rows();

        if($checkAvailability == 0){
            $this->db->insert('tbl_11_enrollment', $data);
            
            $this->db->insert('tbl_credentials', [
                'IDNumber' => $_POST['email'],
                'status' => 'student',
                'password' => md5('123456')
            ]);
        }else{
            $this->db->update('tbl_11_enrollment', $data, ['FirstName' => $data['FirstName'], 'LastName' => $data['LastName'], 'Email' => $data['Email']]);
        }
        
        return ($this->db->affected_rows() ? 'success' : $this->db->error());
    }
}
