<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_confirm_student extends CI_Model
{
    public function get_active_school(){
        return $this->db->select('School_Desc, SchoolName')->get_where('tbl_02_school', ['isActive' => 1])->result();
    }

    public function confirm($data)
    {
        $this->db->trans_begin();

        //DELETE PREVIOUS DATA IF EXIST
        $this->db->delete('tbl_enrollment', [
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'DateofBirth' => $data['DateofBirth']
        ]);
        
        $this->db->insert('tbl_11_enrollment', $data);
        $this->db->insert('tbl_credentials', [
            'IDNumber' => $_POST['email'],
            'status' => 'student',
            'password' => md5('123456')
        ]);
        
        $this->db->trans_complete();
        
        return ($this->db->trans_status() ? 'success' : this->db->error());
    }
}
