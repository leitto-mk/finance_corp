<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('set_success_response')){
    function set_success_response($body)
    {
        $CI =& get_instance();

        if($body == 0 || $body == null || $body == '' || empty($body) == TRUE){
            $body = "No Data Found";
        }
    
        $CI->output->set_status_header(200);
        $CI->output->set_content_type('application/json','utf-8');
        $CI->output->set_output(json_encode([
            'status' => 'success',
            'desc' => NULL,
            'result' => $body
        ]));
    }
}

if(!function_exists('set_error_response')){
    function set_error_response($code, $message)
    {
        $CI =& get_instance();
    
        $CI->output->set_status_header($code);
        $CI->output->set_content_type('application/json','utf-8');
        $CI->output->set_output(json_encode([
            'status' => 'error',
            'desc' => $message,
            'result' => NULL
        ]));
    }
}
