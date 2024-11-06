<?php 
    header("Content-Type:text/json");
    header("Access-Control-Allow-Headers: Origin, Content-Type, Token");    
    require_once "../../connection/connection.php";
    $conn = new connection();
    $cn = $conn->connect();
   
    require_once '../../controller/User.php';
    $users = new User($cn);
    $method = $_SERVER['REQUEST_METHOD'];
    $uuser = "demo";
    $ddate = date("Y-m-d H:i:s");
    function response($msg,$data){
        return json_encode(array("msg" => $msg,"data" => $data));
    }
?>