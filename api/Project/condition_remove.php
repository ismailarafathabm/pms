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
        if (!isset($data->condition_id) || $data->condition_id === "") {
            _errorlog("Project Informations Missing", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Project Informations Missing");
        } else if (!isset($data->projectname) || $data->projectname === "") {
            _errorlog("Enter Specification", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "Enter Specification");
        } else {

            $_msg = array(
                "status" => "OK",
                "PAGEID" => "DASHBOARD",
                "ACTION" => "REMOVE PROJECT CONDITION",
                "API_PAGE" => "api/Project/condition_remove.php",
                "msg" => "REMOVED CONDTION INFO - " . $data->condition_id . "-" . $data->projectname . "-" . getConditionInfos($db, $data->condition_id, $data->projectname, $user)
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "DELETE",
                'log_token' => $data->naf_user->user_token
            );
            // include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);


            include_once('../../controller/Projects.php');
            $project = new Projects($db);
            echo $project->conditions_remove($data->condition_id, $data->projectname);
        }
    } else {
        _errorlog("Access Error", $data->naf_user->user_name, $data->naf_user->user_token, $db);
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}

function getConditionInfos($cn, $id, $project, $enc)
{
    $sql = "SELECT *FROM project_conditions where project_conditions_id=:project_conditions_id and project_conditions_project=:project_conditions_project";
    $cm = $cn->prepare($sql);
    $params = array(
        ':project_conditions_id' => $id,
        ":project_conditions_project" => $enc->enc('enc', $project)
    );
    $cm->execute($params);
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    $infos = $enc->enc('denc', $rows['project_conditions_remark']);
    return $infos;
}

function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "DASHBOARD",
        "ACTION" => "REMOVE PROJECT CONDITION",
        "API_PAGE" => "api/Project/condition_remove.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "DELETE",
        'log_token' => $user_token
    );
    // include_once '../../controller/log.php';
    // $log = new LOG($db);
    // $log->save_log($_log);
}
