<?php
$user_name = isset($_GET['user_name']) ? $_GET['user_name'] : '';
$user_token = isset($_GET['user_token']) ? $_GET['user_token'] : ''; 
include_once('../../_def.php');
include_once('../../../connection/connection.php');
$connection = new connection();
$cn = $connection->connect();
$_msg = array(
    "status" => "ok",
    "PAGEID" => "DRAWING APPROVALS REPORT",
    "ACTION" => "DRAWING APPROVALS REPORT ALL",
    "API_PAGE" => "api/DrawingApprovals/speedcode/index.php",
    "msg" => "-"
);
$_log = array(
    'log_user' => $user_name,
    'log_time' => date('Y-m-d H:i:s'),
    'log_descripton' => json_encode($_msg),
    'log_action' => "READ",
    'log_token' => $user_token
);
// include_once '../../../controller/log.php';
// $log = new LOG($cn);
// $log->save_log($_log);


 include_once('../../../controller/mac.php');
 $enc = new mac();
 $sql = "SELECT *FROM pms_draw_approvals";
 $cm = $cn->prepare($sql);
 $cm->execute();
 $rowcnt = $cm->rowCount();
 echo response("1", $rowcnt);
 //echo response("1", 0);

$auth = true;
?>
