<?php
include_once('../../_def.php');
$auth = true;
include_once('../../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));    
    if ($auth === true) {
        include_once('../../../controller/Variations.php');
        $variation = new Variations($db);
        echo $variation->rpt();
        
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
