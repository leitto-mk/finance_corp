<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_confirm_student extends CI_Model
{
    public function confirm($data)
    {
        $this->db->insert('tbl_11_enrollment', $data);

        return 'success';
    }
}
