<?php
/**
*	JsonHelper
*	@author ParkerRo 2018
*/
class JsonHelper{

    public static function header() {
        header('Content-Type: application/json; charset=utf-8');
    }

    public static function parseBody() {
        return json_decode(file_get_contents('php://input', 'r'));
    }

    public static function success($data) {
        $data = json_encode($data);
        return "{ \"status\" : true, \"data\" : $data }";
    }

    public static function error($message) {
        return "{ \"status\" : false, \"message\" : \"$message\" }";
    }

}
