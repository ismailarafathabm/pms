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
        if (!isset($data->notesprojectcode) || $data->notesprojectcode === '') {
            echo response("0", "Select Any Project and try");
        }else if(!isset($data->newboqitems->notesdescription) || $data->newboqitems->notesdescription === ''){
            echo response("0","Enter BOQ Special Note");
        }else if(!isset($data->newboqitems->notesimportats) || $data->newboqitems->notesimportats === ''){
            echo response("0", "Select importants");
        } else {
            include_once('../../../controller/boqitems.php');
            $boqitems = new Boqitems($db);
            $delstatus = $boqitems->enc('enc','1');
            $token = $boqitems->token(85);
            $_sv = array(
                ':notestoken' => $token,
                ':notesdescription' => $boqitems->enc('enc', $data->newboqitems->notesdescription),
                ':notesimportats' => $boqitems->enc('enc', $data->newboqitems->notesimportats),
                ':notesprojectcode' =>$boqitems->enc('enc', $data->notesprojectcode),
                ':delstatus' => $delstatus
            );
            echo $boqitems->Boqitemsnew($_sv);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
