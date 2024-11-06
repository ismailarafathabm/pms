<?php
if (!isset($ts)) {
    include_once '../_error.php';
    exit;
}
$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");
$techsub_project = !isset($techsub_project) || trim($techsub_project) === "" ? '' : $techsub_project;
if($techsub_project === ""){
    header("HTTP/1.0 400 Bad request");
    echo response("0","Enter Project");
    exit;
}

$techsub_status = !isset($techsub_status) || trim($techsub_status) === "" ? '' : $techsub_status;
if($techsub_status === ""){
    header("HTTP/1.0 400 Bad request");
    echo response("0","Select Status");
    exit;
}

$techsub_subdate = !isset($techsub_subdate) || trim($techsub_subdate) === "" ? '' : $techsub_subdate;
if($techsub_subdate === ""){
    header("HTTP/1.0 400 Bad request");
    echo response("0","Enter Status Updated Date");
    exit;
}

if(!date($techsub_subdate) === ""){
    header("HTTP/1.0 400 Bad request");
    echo response("0","Not valid Status Updated Date");
    exit;
}
$svdata = array(
    "techsub_status" => $techsub_status,
    "techsub_subdate" => date_format(date_create($techsub_subdate),'Y-m-d'),
    "techsub_eby" => $uuser,
    "techsub_edate" => $ddate,
    "techsub_id" => $techsub_id,
);

echo $ts->UpdateTechnicalApprovalsStatus($svdata,$techsub_project);exit;
 ?>