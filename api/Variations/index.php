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
            echo response("0", "Choose Any Project");
        } else {
            

            echo $variation->AllVariations($data->project_no);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}


function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "VARIATION",
        "ACTION" => "GET VARIATION REVISON",
        "API_PAGE" => "api/Variations/index.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "READ",
        'log_token' => $user_token
    );
    
}
