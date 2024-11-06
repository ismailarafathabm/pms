<?php
include_once('../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    $naf_user = array(
        'user_name' => $user_name,
        'user_token' => $user_token
    );
    $datas = array(
        'naf_user' => $naf_user
    );
    $s = json_encode($datas);
    $data = json_decode($s);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if (isset($approvals_id) && $approvals_id !== '') {
            $sql = "DELETE FROM pms_approvals where approvals_id=:approvals_id";
            $cm = $db->prepare($sql);
            $cm->bindParam(":approvals_id", $approvals_id);
            if ($cm->execute()) {
                echo response("1", "Removed");
            } else {
                echo response("0", "Database Error");
            }
        } else {
            echo response("0", "Approval Id missing");
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
