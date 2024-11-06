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
        }else if(!isset($data->p3) || $data->p3 === ""){
            echo response("0", "Enter Subject P3");
        } else {
            echo $variation->GetVariationsinfobyP3($data->project_no,$data->p3);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
