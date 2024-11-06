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
    //print_r($data);
    include_once('../_auth.php');
    if ($auth === true) {
        include_once('../../controller/Variations.php');
        $variation = new Variations($db);        
        if (!isset($data->variation_project) || $data->variation_project === "") {
            echo response("0", "Choose Any Project");
        }
        if (!isset($data->variation_token) || $data->variation_token === "") {
            echo response("0", "Choose Any Project");
        } else {
            echo $variation->RemoveVariations($data->variation_project, $data->variation_token);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
