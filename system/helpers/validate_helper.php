<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('validate')){
    /**
     * Constructor for the REST API.
     *
     * @param array  form     takes `POST` or `GET` form data 
     * @param array  case     set Specific Validation (currently supports only `date` & `number`)
     * @param array  ignore   form data's name, ex: ['docno','idnumber', ...]
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

        $validate_date_fun = function($label = NULL, $date = NULL){
            $CI =& get_instance();
            $CI->load->library('form_validation');

            $d = DateTime::createFromFormat('Y-m-d', $date);
            if($d && $d->format('Y-m-d') === $date){
                $CI->form_validation->set_message($label, "$date is not a valid Date Format");
                return false;
            }else{
                return true;
            }
        };
        
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
     * @param string  date  takes string from Form Data
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