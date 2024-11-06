<?php
include_once('../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($data->approval_typeName) || $data->approval_typeName === '') {
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "APPROVEL TYPES",
                "ACTION" => "USER ADDED NEW APPROVAL TYPE",
                "API_PAGE" => "api/Approval_Type/new.php",
                "msg" => "NEW APPROVAL TYPE : ". $data->approval_typeName
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

            echo response("0", "Enter Approval Type Name");
        } else {
            include_once("../../controller/ApprovalTypes.php");
            $approval_type = new ApprovalType($db);
            echo $approval_type->new_approval_type($data->approval_typeName);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
