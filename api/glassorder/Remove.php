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
        if (!isset($data->project_id) || $data->project_id === '') {
            echo response('0', "Enter project Number");
        } else if (!isset($data->ordertoken) || $data->ordertoken === '') {
            echo response('0', "Enter token Number");
        } else {
            include_once("../../controller/GlassOrder.php");
            $glassorder = new GlassOrder($db);
            $api = json_decode($glassorder->RemoveGlassOrder($data->project_id, $data->ordertoken));
            if($api->msg === '1'){
                $location = "../../assets/glassorder/";
                $filenamesxzy = $location . $data->ordertoken . ".pdf";
                if (file_exists($filenamesxzy)) {
                    unlink($filenamesxzy);
                }
            }

            echo response($api->msg,$api->data);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
