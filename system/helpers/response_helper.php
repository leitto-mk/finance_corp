<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('set_success_response')){
    function set_success_response($body)
    {
        $CI =& get_instance();

        if($body == 0 || $body == null || $body == '' || empty($body) == TRUE){
            $desc = null;
            $body = null;
        }
    
        $CI->output->set_status_header(200);
        $CI->output->set_content_type('application/json','utf-8');
        $CI->output->set_output(json_encode([
            'success' => TRUE,
            'desc' => $desc,
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
            'success' => FALSE,
            'desc' => $message,
            'result' => NULL
        ]));
    }
}
