<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FinanceCorp extends CI_Controller
{
    /**
     * Common HTTP status codes and their respective description.
     *
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_INTERNAL_ERROR = 500;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('response');

        $this->load->model('Mdl_corp_master', 'master');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'h2' => 'Master & Settings',
            'company' => $this->master->M_get_company(),
            'storagecode' => $this->master->get_last_storagecode(),

            'script' => 'master'
        ];
       
        $this->load->view('financecorp/dashboard/v_home_3', $data);
    }

    public function get_csrf_token_data(){
        $env = ENVIRONMENT;

        if($env == 'development'){
            $csrf_name = $this->security->get_csrf_token_name();
            $csrf_token = $this->security->get_csrf_hash();

            $body = [
                $csrf_name => $csrf_token
            ];

            return set_success_response($body);
        }

        return set_error_response(self::HTTP_FORBIDDEN, 'development only');
    }

    public function not_found()
    {
        $this->load->view('financecorp/dashboard/404');
    }
}
