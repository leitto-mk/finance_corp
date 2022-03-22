<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper([
            'response',
            'validate'
        ]);

        $this->load->model('Mdl_corp_coa', 'finance');
    }

    public function index()
    {
        $result = $this->get_coa_data();

        $table_data = [
            'coa' => $result ?? []
        ];

        $table_view = $this->load->view('financecorp/master/coa/component/v_coa_table', $table_data, true);

        $container_data = [
            'table' => $table_view
        ];

        $container_view = $this->load->view('financecorp/master/coa/v_coaccount', $container_data, true);

        $data = [
            'title' => 'Chart Of Account',
            'container' => $container_view,
            'script' => 'master'
        ];

        $this->load->view('financecorp/header_footer/coa/header_footer', $data);
    }

    public function get_form()
    {
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);

        $data_view = [];
        $body = '';
        $title = '';

        if ($id && $type) {
            $data_coa =  $this->finance->M_get_coaccount([
                'ID' => $id
            ])->row_array();

            switch ($type) {
                case 'child':
                    $data_view['coa']['Acc_No'] = $this->finance->M_get_last_co_number([
                        'level' => $data_coa['Level'],
                        'parent' => $data_coa['Acc_No'],
                        'id' => $id
                    ]);

                    $title = 'Create New Child';
                    break;

                case 'edit':
                    $data_view['coa'] = $data_coa;
                    $data_view['transgroup'] = $data_coa['TransGroup'];
                    $title = $data_coa['Acc_No'] . ' - ' . $data_coa['Acc_Name'];
                    break;

                default:
                    $title = 'Modal';
                    break;
            }

            $data_view['type'] = $type;

            $body = $this->load->view('financecorp/master/coa/component/v_coa_form', $data_view, true);
        } else {
            $title = 'Create New Head';

            $data_view['coa']['Acc_No'] = $this->finance->M_get_last_co_number([
                'level' => 0,
                'parent' => 'null',
                'id' => 'null'
            ]);

            $data_view['coa']['Acc_Type'] = 'H';
            $data_view['type'] = 'head';
            $data_view['transgroup'] = null;

            $body = $this->load->view('financecorp/master/coa/component/v_coa_form', $data_view, true);
        }

        $result = [
            'title' => $title,
            'body' => $body,
            'acc_types' => $this->finance->M_get_account_type()->result_array(),

            'type_url' => base_url('C_Finance/get_type'),
            'group_url' => base_url('C_Finance/get_group'),
            'submit_url' => base_url('C_Finance/submit_coa'),
            'content_url' => base_url('C_Finance/get_coa_content')
        ];

        return set_success_response($result);
    }

    public function get_type()
    {
        $result = $this->finance->M_get_account_type()->result_array();
        echo json_encode($result);
    }

    public function get_group()
    {
        $result = $this->finance->M_get_group();
        echo json_encode($result);
    }

    public function submit_coa()
    {
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        $acc_no = $this->input->post('coa_accno', true);
        $name = $this->input->post('coa_name', true);
        $coa_type = $this->input->post('coa_type', true);
        // $cash_bank = $this->input->post('cash_bank', true);
        $group = $this->input->post('coa_group', true);
        $reg_by = '';
        $reg_date = date('Y-m-d');

        $data = [
            'Acc_Name' => $name,
            'Acc_type' => $coa_type,
            // 'CashBank' => $cash_bank,
            'TransGroup' => $group,
            'Disc' => 'No'
        ];

        switch ($type) {
            case 'head':
                $data['Acc_No'] = $acc_no;
                $data['Level'] = '1';
                $data['Parent'] = NULL;
                $data['RegBy'] = $reg_by;
                $data['RegDate'] = $reg_date;

                $insert = $this->finance->M_insert_coa($data);
                
                if ($insert == 'success') {
                    $result['result'] = 'success';
                    $result['message'] = 'Data Inserted';
                } else {
                    $result['result'] = 'error';
                    $result['message'] = 'Contact Our Developer';
                }
                break;

            case 'child':
                $data_coa = $this->finance->M_get_coaccount([
                    'ID' => $id
                ])->row_array();

                $level = intval($data_coa['Level']) + 1;

                if ($level > 4) {
                    $result['result'] = 'error';
                    $result['message'] = 'Level Maxed';
                } else {
                    $data['Acc_No'] = $acc_no;
                    $data['Parent'] = $data_coa['Acc_No'];
                    $data['Level'] = $level;
                    $data['RegBy'] = $reg_by;
                    $data['RegDate'] = $reg_date;

                    $result = $this->finance->M_insert_coa($data);

                    if ($result == 'success') {
                        $result['result'] = 'success';
                        $result['message'] = 'Data Inserted';
                    } else {
                        $result['result'] = 'error';
                        $result['message'] = 'Contact Our Developer';
                    }
                }
                break;

            case 'edit':
                $result = $this->finance->M_update_coa($data, ['ID' => $id]);

                if ($result == 'success') {
                    $result['result'] = 'success';
                    $result['message'] = 'Data Updated';
                } else {
                    $result['result'] = 'error';
                    $result['message'] = $result;
                }
                break;

            default:
                $result['result'] = 'error';
                $result['message'] = 'Contact Our Developer';
                break;
        }

        return set_success_response($result);
    }

    public function get_coa_content()
    {
        $result = $this->get_coa_data();
        
        $table_data = [
            'coa' => $result
        ];

        $this->load->view('financecorp/master/coa/component/v_coa_table', $table_data);
    }

    public function delete_account()
    {
        $ctrlno = $this->input->post('unique');

        $result = $this->finance->M_delete_account($ctrlno);

        echo $result;
    }

    private function get_coa_data()
    {
        $max = $this->finance->M_count_level()['maxLevel'];
        $min = $this->finance->M_count_level()['minLevel'];

        $data = [];

        for ($i = 1; $i < $max + 1; $i++) {
        $data['level_' . $i] = $this->finance->M_get_coaccount([
            'Disc' => 'No',
            'Level' => strval($i)
        ])->result_array();
        }

        for ($max; $max > $min; $max--) {
        foreach ($data['level_' . $max] as $row => $value) {
            foreach ($data['level_' . strval($max - 1)] as $parent_row => $parent_value) {
            if ($parent_value['Acc_No'] == $value['Parent']) {
                $data['level_' . strval($max - 1)][$parent_row]['child'][] = $data['level_' . $max][$row];
            }
            }
        }
        }

        $result = $data['level_1'] ?? null;

        return $result;
    }

    function reset_coa()
    {
        $this->finance->reset_coa();
        $this->session->set_flashdata('success_reset', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> COA has been reset</center> </div>');
        redirect('C_Finance');
    }
}
