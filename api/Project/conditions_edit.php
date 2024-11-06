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
        if (!isset($data->condition_add_edit) || $data->condition_add_edit === "") {
            _errorlog("Enter Conditions..", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Enter Conditions..");
        } else if (!isset($data->conditions_add_edit_number) || $data->conditions_add_edit_number === "") {
            _errorlog("Enter Conditions Nummber", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Enter Conditions Nummber");
        } else {
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "DASHBOARD",
                "ACTION" => "EDIT PROJECT CONDITION",
                "API_PAGE" => "api/Project/conditions_edit.php",
                "msg" => "$data->condition_add_edit - CONDTIONS NUMBER S.NO"
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "EDIT",
                'log_token' => $data->naf_user->user_token
            );
            // include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);

            include_once('../../controller/Projects.php');
            $project = new Projects($db);
            echo $project->condition_Edit($data->project_conditions_id, $data->condition_add_edit, $data->conditions_add_edit_number);
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
        "PAGEID" => "DASHBOARD",
        "ACTION" => "EDIT PROJECT CONDITION",
        "API_PAGE" => "api/Project/conditions_edit.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "EDIT",
        'log_token' => $user_token
    );
    // include_once '../../controller/log.php';
    // $log = new LOG($db);
    // $log->save_log($_log);
}
