<?php
include_once('../../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    include_once('../../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../../controller/User.php');
    $user = new User($db);
    include_once('../../_auth.php');
    if ($auth === true) {
        if (!isset($data->notesid) || $data->notesid === '') {
            echo response("0", "Select Any Project and try");
        } else if (!isset($data->notesdescription) || $data->notesdescription === '') {
            echo response("0", "Enter BOQ Special Note");
        } else if (!isset($data->notesimportats) || $data->notesimportats === '') {
            echo response("0", "Select importants");
        } else {
            include_once('../../../controller/boqitems.php');
            $boqitems = new Boqitems($db);
            $_sv = array(                
                ':notesdescription' => $boqitems->enc('enc', $data->notesdescription),
                ':notesimportats' => $boqitems->enc('enc', $data->notesimportats),
                ':notesid' =>  $data->notesid,                
            );
            echo $boqitems->BoqitemEdit($_sv);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
