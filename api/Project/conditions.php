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
        if ($data->project_no) {
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "CONDITIONS",
                "ACTION" => "GET PROJECT CONDITIONS",
                "API_PAGE" => "api/Project/conditions.php",
                "msg" => $user->enc('denc',$data->project_no)
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "READ",
                'log_token' => $data->naf_user->user_token
            );
            // include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);

            include_once('../../controller/Projects.php');
            $project = new Projects($db);
            echo $project->get_conditions($data->project_no);
        } else {
            _errorlog("Enter Project Number", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Enter Project Number");
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
        "PAGEID" => "CONDITIONS",
        "ACTION" => "GET PROJECT CONDITIONS",
        "API_PAGE" => "api/Project/conditions.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "READ",
        'log_token' => $user_token
    );
    // include_once '../../controller/log.php';
    // $log = new LOG($db);
    // $log->save_log($_log);
}
