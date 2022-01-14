<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('validate')){
    function validate($forms)
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');

        $list = array_keys($forms);
        
        if(is_array($forms) && count($forms) > 0){    
            foreach($list as $val){
                if(is_array($forms[$val]) && count($forms[$val]) > 0){
                    for($i=0;$i<count($forms[$val]);$i++){
                        $CI->form_validation->set_rules($val ."[]",strtoupper($val) . "at index [$i]",'required|trim|xss_clean');
                    }

                    continue;
                }

                $CI->form_validation->set_rules($val,strtoupper($val),'required|trim|xss_clean');
            }
        }

        if($CI->form_validation->run() == FALSE){
            return validation_errors();
        }

        return "success";
    }
}