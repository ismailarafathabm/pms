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
        if (!isset($data->notes_id) || $data->notes_id === "") {
            echo response("0", "Choose Any Project");
        }  else {
            include_once('../../controller/Projects.php');
            $Projects = new Projects($db);
            
            echo $Projects->remove_boq_notes($data->notes_id);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
