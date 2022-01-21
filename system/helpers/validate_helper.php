<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('validate')){
    /**
     * Constructor for the REST API.
     *
     * @param array  form     takes `POST` or `GET` form data 
     * @param array  ignore   form data's name, ex: ['docno','idnumber', ...]
    */
    function validate($forms,$ignores)
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');

        //Remove Any Delimiters
        $CI->form_validation->set_error_delimiters('<h4 class="sbold">', '</h4>');

        if($CI->input->server('REQUEST_METHOD') === "GET"){
            $CI->form_validation->set_data($forms);
        }

        $list = array_keys($forms);
        
        if(is_array($forms) && count($forms) > 0){
            foreach($list as $val){
                //Check if $val is in ignore list
                if(in_array($val, $ignores, TRUE)){
                    continue;
                }

                //Check if $val is Array & validate every iteration
                if(is_array($forms[$val]) && count($forms[$val]) > 0){
                    for($i=0;$i<count($forms[$val]);$i++){
                        $CI->form_validation->set_rules($val ."[]",strtoupper($val) . "at index [$i]",'required|trim|xss_clean');
                    }

                    continue;
                }

                //Validate current $val
                $CI->form_validation->set_rules($val,strtoupper($val),'required|trim|xss_clean');
            }
        }

        if($CI->form_validation->run() == FALSE){
            return validation_errors();
        }

        return "success";
    }
}