<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fin_auth extends CI_Model {

    function insert($table, $data) {
        $this->db->insert($table, $data);
    }    

    function get_validate(){
        $dbtrial = $this->load->database('abase_trial', true);
        $data = $dbtrial->select('trial')->from('trial')->get();        
        return $data->result();
    }

    //validation license
    function ceklicense() {
        $db = $this->load->database('db_abase_trial', true);
        $data = $db->query('SELECT kode FROM license');
        return $data->result();
    }

    //Get Duration
    function getDurasi($license) {
        $db = $this->load->database('db_abase_trial', true);
        $data = $db->query("SELECT * FROM license WHERE kode = '$license'");
        return $data->result();
    }

    function updatedate($license, $durasi, $max){        
        $db = $this->load->database('db_abase_trial', TRUE);
        if ($durasi == 1) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 1 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true;
        }elseif ($durasi == 2) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 2 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true;     
        }elseif ($durasi == 3) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 3 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true; 
        }elseif ($durasi == 4) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 4 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true;   
        }elseif ($durasi == 5) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 5 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true;   
        }elseif ($durasi == 6) {            
            $data['addMonth'] = $db->query("UPDATE trial SET trial = DATE_ADD(trial, INTERVAL 6 MONTH), max = '$max'");
            $data['deleteKode'] = $db->query("DELETE FROM license WHERE kode = '$license'");
            return true;
        }
    }    

    function get_pass($uname){
        $users = $this->load->database('abase_users', true);
        $query = $users->query("SELECT u_password FROM tbl_users WHERE u_name = '$uname' AND disc = 'no'");
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return null;
        }
    }

    function get_login_data($uname, $upass){
        $users = $this->load->database('abase_users', true);
        $query = $users->query("SELECT user_id, Branch, IDNumber, u_name, u_level, ms_login, last_login FROM tbl_users WHERE u_name = '$uname' AND u_password =  '$upass' AND disc = 'no'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function update_status_login_by_user($userid){
        $users = $this->load->database('abase_users', true);
        $users->set('ms_login', 'login');
        $users->where('user_id', $userid);
        $users->update('tbl_users');
        if ($users->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_logout_status_users_login($userid, $username, $last_login){
        $users = $this->load->database('abase_users', true);
        $users->set('ms_login', 'logout');
        $users->set('last_login', $last_login);
        $users->where('user_id', $userid);
        $users->update('tbl_users');
        if ($users->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }    
    
}