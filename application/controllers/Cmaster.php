<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmaster extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mdl_corp_master', 'master');
        // $this->load->library(array('Datatables' => 'dtables', 'Zend'));
	}

	public function index(){
		$data['title'] = 'Masters';
		$data['h2'] = 'Master & Settings';		
		$this->load->view('finance_corp/master/v_master_dashboard', $data);
	}

	//Master Currency Start
    function list_cur_dt()
    {
        $result = $this->master->get_list_cur_dt();
        echo $result;
    }
    function add_cur()
    {
    	$cur = $this->input->post('n_cur');
        $currency = array(
            'Currency' => $this->input->post('n_cur'),
            'CurrencyName' => $this->input->post('n_curname'),
            // 'Disc' => $this->input->post('n_disc'),
            // 'Remarks' => $this->input->post('n_remarks'),
            'Disc' => '0'

        );
    	$rstatus = $this->master->insert('tbl_fa_mas_currency', $currency);
        echo json_encode(array(
            'rstatus' => true,
            'Currency' => $currency['Currency']
        ));       
    }
    function get_detail_cur_to_edit()
    {
        $cur = $this->input->post('currencycode');
        $data = $this->master->get_detail_cur($cur);
        $yes_ = array(
            'yes' => 'Yes',
            'no' => 'No',
        );
        echo json_encode(array(
            'cur' => $this->master->get_all_cur(),
            'dcur' => $data,
            'yess' => $yes_['yes'],
            'noo' => $yes_['no'],
        ));
    }
    function edit_cur()
    {
        $currency = $this->input->post('id_accno');
        $dstorage = array(
            'Currency' => $this->input->post('currency'),
            'CurrencyName' => $this->input->post('currencyname'),
            'Disc' => $this->input->post('ei_disc'),
            'Remarks' => $this->input->post('remarks'),
        );
        $rstatus = $this->master->update_data_cur($dstorage, $currency);
        echo json_encode(array(
            'rstatus' => $rstatus,
            'Currency' => $dstorage['Currency']
        ));
    }
    function delete_cur_by_accgid()
    {
        $cur = $this->input->post('currencycode');
        $rstatus = $this->master->delete_cur_by_curcode('tbl_fa_mas_currency', $cur);
        if ($rstatus != false) {
            echo json_encode(array(
                'rstatus' => true,
                'Currency' => $cur
            ));
        } else {
            echo json_encode(array(
                'rstatus' => false
            ));
        }
    }
	//Master Currency End

	
  
}
