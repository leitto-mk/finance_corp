<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");

class secure
{
    function encrypt_url($string)
    {
        $output = false;
	
        $security = parse_ini_file('security.ini'); 
        
        $secret_key     = $security['ENC_SECRET_KEY'];
        $secret_iv      = $security['ENC_IV'];
        $encrypt_method = $security['ENC_MECHANISM'];

        //hash $secret_key dengan algoritma sha256 
        $key = hash("sha256", $secret_key);

        //iv(initialize vector), encrypt iv dengan encrypt method AES-256-CBC (16 bytes)
        $iv     = substr(hash("sha256", $secret_iv), 0, 16);
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }

    function decrypt_url($string)
    {
        $output = false;

        $security = parse_ini_file('security.ini');

        $secret_key     = $security['ENC_SECRET_KEY'];
        $secret_iv      = $security['ENC_IV'];
        $encrypt_method = $security['ENC_MECHANISM'];

        $key = hash("sha256", $secret_key);

        $iv     = substr(hash("sha256", $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}