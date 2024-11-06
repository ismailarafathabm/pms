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
        if (!isset($data->project_no) || $data->project_no === '') {
            echo response('0', "Enter project Number");
        }else if(!isset($data->orderno) || $data->orderno === ''){
            echo response('0', "Enter project Number");
        } else {
            include_once("../../controller/GlassOrder.php");
            $glassorder = new GlassOrder($db);
            echo $glassorder->GetGlassorderInforusingRefno($data->project_no, strtoupper($data->orderno));
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
