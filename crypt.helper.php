<?php
##### mencode/mdecode Function #####
function mencode($secret_key, $value_ar) {

    $encrypt_method = "AES-256-CBC";
    $secret_iv      = 'This is my secret iv';
    $string         = serialize($value_ar);

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    return base64_encode($output);
}

function mdecode($secret_key, $value) {
    $encrypt_method = "AES-256-CBC";
    $secret_iv      = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
    $output = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
    $output = unserialize($output);
    return $output;
}