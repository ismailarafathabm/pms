<?php
include_once('../_def.php');
$auth = true;
include_once('../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();
include_once('../../controller/User.php');
$user = new User($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    include_once('../_auth.php');
    if ($auth === true) {
        include_once('../../controller/Variations.php');
        $variation = new Variations($db);
        if (!isset($data->project_no) || $data->project_no === "") {
            _errorlog("Choose Any Project", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Choose Any Project");
        } else if (!isset($data->p3) || $data->p3 === "") {
            _errorlog("Enter Subject P3", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Enter Subject P3");
        } else {
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "VARIATION - REVISION",
                "ACTION" => "GET VARIATION REVISON FOR".$user->enc('denc',$data->project_no),
                "API_PAGE" => "api/Variations/allrevision.php",
                "msg" => "-"
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

            echo $variation->VariationsAllRevision($data->project_no, $data->p3);
        }
    } else {
        _errorlog("Access Error", $data->naf_user->user_name, $data->naf_user->user_token, $db);
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}

function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "VARIATION - REVISION",
        "ACTION" => "GET VARIATION REVISON",
        "API_PAGE" => "api/Variations/allrevision.php",
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