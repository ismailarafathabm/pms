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
    $cn = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($cn);
    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($ppid) || $ppid === '') {
            echo response("0", "ID is missing");
        } else if (!isset($qty) || $qty === "") {
            echo response("0", "Enter Qty/PCS");
        } else if (!isset($totkg) || $totkg === "") {
            echo response("0", "Enter WT/KG");
        } else if (!isset($eta) || $eta === "") {
            echo response("0", "Enter ETA");
        } else if (!isset($location) || $location === "") {
            echo response("0", "Enter Location");
        } else if (!isset($remarks) || $remarks === "") {
            echo response("0", "Enter Remark");
        }  else if (!isset($ppcolor) || $ppcolor === "") {
            echo response("0", "Enter Remark");
        } else {
            if (!is_numeric($qty)) {
                echo response("0", "Qty/PCS is not valid Format");
            }  else {
                $_date = date('Y-m-d H:i:s');
                $updateData = array(
                    ':qty' => $qty,
                    ':totkg' => $totkg,
                    ':eta' => $eta,
                    ':location' => $location,
                    ':remarks' => $remarks,
                    ':edate' => $_date,
                    ':eby' => $user_name,   
                    ':ppcolor' => $ppcolor,
                    ':ppid' => $ppid,
                );

                require_once '../../controller/ppworknew.php';
                $PPwork = new PPWorkNew($cn);
                echo $PPwork->UpdateData($updateData);
            }
        }
    } else {
        echo response("404", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
