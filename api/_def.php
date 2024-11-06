<?php 
    header("Content-Type:text/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
    //echo "defalut working";
    function response($msg,$data){
        $response = array(
            "msg" => $msg,
            "data" => $data
        );
        return json_encode($response);
    }
?>