<?php
include_once('../_def.php');
$auth = true;

include_once('../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();
include_once('../../controller/User.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $data = json_decode(file_get_contents("php://input"));
    $user = new User($db);

    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($data->condition_add_new) || $data->condition_add_new === "") {
            _errorlog("Project Informations Missing",$data->naf_user->user_name,$data->naf_user->user_token,$db);
            echo response("0", "Project Informations Missing");
        } else if (!isset($data->projectname) || $data->projectname === "") {
            _errorlog("Enter Specification",$data->naf_user->user_name,$data->naf_user->user_token,$db);
            echo response("0", "Enter Specification");
        } else {

            $_msg = array(
                "status" => "OK",
                "PAGEID" => "VIEW PROJECT",
                "ACTION" => "ADDED NEW CONDTION $data->condition_add_new",
                "API_PAGE" => "api/Project/condition_add.php",
                "msg" => "ADDED NEW CONDTION $data->condition_add_new, PROJECT NO : $data->projectname"
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "NEW",
                'log_token' => $data->naf_user->user_token
            );
            // include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);


            include_once('../../controller/Projects.php');
            $project = new Projects($db);
            echo $project->condition_add($data->condition_add_new, $data->projectname, $data->conditions_add_new_number);
        }
    } else {
        _errorlog("Access Error",$data->naf_user->user_name,$data->naf_user->user_token,$db);
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}

function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "PROJECTS",
        "ACTION" => "ADD NEW CONDTION",
        "API_PAGE" => "api/Project/condition_add.php",
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
