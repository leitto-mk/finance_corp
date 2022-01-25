<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('validate')){
    /**
     * Constructor for the REST API.
     * 
     * Extended CI's Form Validation. 
     * Currently checks for any empty data or invalid number or date (Y-m-d)
     *
     * @param   array   $forms     takes `POST` or `GET` form data 
     * @param   array   $case     set Specific Validation (currently supports only `date` & `number`)
     * @param   array   $ignores   form data's name, ex: ['docno','idnumber', ...]
     * 
     * @return  string
     * @author  ABASE
    */
    function validate($forms, $case = [], $ignores = NULL)
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');
        $CI->load->helper('validate_helper');

        //Remove Any Delimiters
        $CI->form_validation->set_error_delimiters('', '');

        if($CI->input->server('REQUEST_METHOD') === "GET"){
            $CI->form_validation->set_data($forms);
        }
       
        $lists = array_keys($forms);
        
        if(is_array($forms) && count($forms) > 0){
            foreach($lists as $list){
                //Check if $list is in ignore list
                if(in_array($list, $ignores, TRUE)){
                    continue;
                }

                //Check if $list is Array & validate every iteration
                if(is_array($forms[$list]) && count($forms[$list]) > 0){
                    for($i=0;$i<count($forms[$list]);$i++){
                        $date = $list[$i];
                        if(in_array($list, $case['date']) || $case['date'] === $list){
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ", "xss_clean|date_valid[$date,$list]");
                        }elseif(in_array($list, $case['number']) || $case['number'] === $list){
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ",'xss_clean|numeric|min_length[0]');
                        }else{
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ",'required|trim|xss_clean');
                        }
                    }

                    continue;
                }

                if(in_array($list, $case['date']) || $case['date'] === $list){
                    $date = $forms[$list];
                    $CI->form_validation->set_rules($list, $list, "xss_clean|date_valid[$date,$list]");
                }elseif(in_array($list, $case['number']) || $case['number'] === $list){
                    $CI->form_validation->set_rules($list, $list,'xss_clean|numeric|min_length[0]');
                }else{
                    $CI->form_validation->set_rules($list, $list,'required|trim|xss_clean');
                }
            }
        }

        if($CI->form_validation->run() == FALSE){
            return validation_errors();
        }

        return "success";
    }
}

if(!function_exists('date_valid')){
    /**
     * Validate Form Date
     * 
     * Special Method use for check valid date in helper validate.
     * this method is primarily built for helper validate above,
     * so do not use it outside that method
     * 
     * @param   string  $date  takes string from Form Data
     * @param   string  $list  key name of the current POST or GET payload
     * 
     * @return  bool
     * @author  ABASE
     */
    function date_valid($date,$list){
        $CI =& get_instance();
        $CI->load->library('form_validation');

        //CI's somehow concatenate $list with $date so it needs to be exploded
        //to get the expected value
        $list = explode(',', $list)[1];

        $d = DateTime::createFromFormat('Y-m-d', $date);
        if($d && $d->format('Y-m-d') === $date){
            return true;
        }else{
            $CI->form_validation->set_message('date_valid', "$list is not a valid Date Format");
            return false;
        }
    }
}