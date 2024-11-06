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
        $variations = new Variations($db);
        echo $variations->ListVariationSubject();
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
