<?php
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        require_once '../../controller/log.php';
        $log = new LOG($db);
        if(!isset($data->getinfouser) || $data->getinfouser === ''){
            echo response("0","Choose Any User");
        }else if(!isset($data->stdate) || $data->stdate === ''){
            echo response("0","Choose From Date");
        }else if(!isset($data->enddate) || $data->enddate === ''){
            echo response("0","Choose End Date");
        }else{
            if(!date_create($data->stdate)){
                echo response("0","From Date Not A Date format");
            }else if(!date_create($data->enddate)){
                echo response("0","End Date Not A Date format");
            }else{
                $userName = $log->enc('enc',$data->getinfouser);
                $_fdate = date_format(date_create($data->stdate),'Y-m-d');
                $_edate = date_format(date_create($data->enddate),'Y-m-d');
                echo $log->LoginLog($userName,$_fdate,$_edate);                
            }
        }
    } else {
        echo response("0", $_data);
    }
} else {
    echo response("0", "Request Error");
}
