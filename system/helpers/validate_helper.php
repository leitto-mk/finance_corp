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
     * @param   mixed   $case     set Specific Validation (currently supports only `date` & `number`)
     * @param   mixed   $ignores   form data's name, ex: ['docno','idnumber', ...] or just single 'keyname' is doable
     * 
     * @return  string
     * @author  ABASE
    */
    function validate($forms, ?array $case = [], ?array $ignores = [])
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');
        $CI->load->helper('validate_helper');

        if(!$forms || empty($forms)){
            return true;
        }

        //Remove Any Delimiters
        $CI->form_validation->set_error_delimiters('','');

        if($CI->input->server('REQUEST_METHOD') === "GET"){
            $CI->form_validation->set_data($forms);
        }
       
        $lists = array_keys($forms);
        
        if(is_array($forms) && count($forms) > 0){
            foreach($lists as $list){
                //Check if $list(s) is in ignore list
                if(!empty($ignores) && (in_array($list, $ignores, TRUE) || $list === $ignores)){
                    continue;
                }

                //Check if $list is Array & validate every iteration
                if(is_array($forms[$list]) && count($forms[$list]) > 0){
                    for($i=0;$i<count($forms[$list]);$i++){
                        if(empty($case)){
                            goto check_required_arr;
                        }

                        if(array_key_exists('date', $case) && (in_array($list, $case['date']) || $case['date'] === $list)){
                            $date = $list[$i];
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ", "xss_clean|date_valid[$date,$list]");
                        }elseif(array_key_exists('number', $case) && (in_array($list, $case['number']) || $case['number'] === $list)){
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ",'xss_clean|numeric|min_length[0]');
                        }elseif(array_key_exists('email', $case) && (in_array($list, $case['email']) || $case['email'] === $list)){
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ",'xss_clean|email');
                        }else{
                            check_required_arr:
                            $CI->form_validation->set_rules($list . "[]", "`$list` at index [$i] ",'required|trim|xss_clean');
                        }
                    }

                    continue;
                }

                if(empty($case)){
                    goto check_required;
                }

                if(array_key_exists('date', $case) && (in_array($list, $case['date']) || $case['date'] === $list)){
                    $date = $forms[$list];
                    $CI->form_validation->set_rules($list, $list, "xss_clean|date_valid[$date,$list]");
                }elseif(array_key_exists('number', $case) && (in_array($list, $case['number']) || $case['number'] === $list)){
                    $CI->form_validation->set_rules($list, $list,'xss_clean|numeric|min_length[0]');
                }elseif(array_key_exists('email', $case) && (in_array($list, $case['email']) || $case['email'] === $list)){
                    $CI->form_validation->set_rules($list, $list,'xss_clean|email');
                }else{
                    check_required:
                    $CI->form_validation->set_rules($list, $list,'required|trim|xss_clean');
                }
            }
        }

        if($CI->form_validation->run() == FALSE){
            return validation_errors();
        }

        return true;
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
            $CI->form_validation->set_message('date_valid', "The $list field is not a valid Date Format");
            return false;
        }
    }
}