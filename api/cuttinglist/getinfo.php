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
        }
        if (!isset($data->refno) || $data->refno === '') {
            echo response('0', "Enter choose mo ref number");
        } else {
            include_once("../../controller/cuttinglistmo.php");
            $cuttinglistmo = new CuttingListMo($db);
            echo $cuttinglistmo->GetCuttinglistInfo($data->project_no,$data->refno);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
