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
        if (!isset($returndate) || $returndate === "") {
            echo response("0", "Enter Date");
        } else if (!isset($returnqty) || $returnqty === "") {
            echo response("0", "Enter Qty");
        } else if (!isset($rcpno) || $rcpno === "") {
            echo response("0", "Enter Receipt NO");
        } else if (!isset($remark) || $remark === "") {
            echo response("0", "Enter Remark");
        } else if (!isset($ppid) || $ppid === "") {
            echo response("0", "Select Any Data");
        } else {
            if (!is_numeric($returnqty)) {
                echo response("0", "Enter Return QTY");
            } else {
                if (!date_create($returndate)) {
                    echo response("0", "Enter Return Date");
                } else {
                    require_once '../../controller/ppworknew.php';
                    $PPwork = new PPWorkNew($cn);
                    $d = date('Y-m-d H:i:s');
                    $rcinfo = array(
                        ':returndate' => date_format(date_create($returndate),'Y-m-d'),
                        ':returnqty' => $returnqty,
                        ':rtno' => $rcpno,
                        ':rcpno' => $rcpno,
                        ':remark' => $remark,
                        ':ppid' => $ppid,
                        ':pcby' => $user_name,
                        ':peby' => $user_name,
                        ':pcdate' => $d,
                        ':peditdate' => $d,
                        ':pextra' => '-'
                    );
                    echo $PPwork->SaveReceipt($rcinfo);
                }
            }
        }       
    } else {
        echo response("404", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
