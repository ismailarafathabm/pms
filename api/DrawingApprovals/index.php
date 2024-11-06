<?php
include_once('../_def.php');
$auth = true;
include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));    
    
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if(!isset($data->project_no) || $data->project_no === ''){
            _errorlog("Enter project Number", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response('0',"Enter project Number");

        }else{

            include_once("../../controller/DrawingApprovals.php");
            $DrawingApprovals = new DrawingApprovals($db);
            $pno = $DrawingApprovals->enc('denc', $data->project_no);
            echo $DrawingApprovals->all_approvals($pno);
        }
    } else {
        _errorlog("Access Error", $data->naf_user->user_name, $data->naf_user->user_token, $db);
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}

function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "DRAWING APPROVALS",
        "ACTION" => "GET DRAWING APPROVALS",
        "API_PAGE" => "api/DrawingApprovals/index.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "READ",
        'log_token' => $user_token
    );
    include_once '../../controller/log.php';
   
}

