<?php 
 header("Content-Type:text/json");
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
 header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

    $response = array(
        "msg" => "0",
        "data" => "_ERROR"
    );
    
    extract($_GET);
    if(isset($tablename) || $tablename !== ''){
        require_once './../../connection/connection.php';
        $conn = new connection();
        $cn = $conn->connect();
        require_once './../../controller/autono.php';
        $autono = new AutoNum($cn);
        $response = $autono->getNewNumber($tablename);
        echo $response;
    }else{
        $response = array(
            "msg" => "0",
            "data" => "Enter table Name"
        );
    }
    return json_encode($response);
    exit();
?>