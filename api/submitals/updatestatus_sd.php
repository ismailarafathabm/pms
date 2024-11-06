<?php
if (!isset($ts)) {
    include_once '../_error.php';
    exit;
}
$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");

$ds_project = !isset($ds_project) || trim($ds_project) === '' ? "" : $ds_project;
if ($ds_project === '') {
    header("HTTP/1.0 400 Bad request");
    echo response("0", "Enter Project Number");
    exit;
}

$ds_status = !isset($ds_status) || trim($ds_status) === '' ? "" : $ds_status;

if ($ds_status === "") {
    header("HTTP/1.0 400 Bad request");
    echo response("0", "Enter Status");
    exit;
}

$_date = date('Y-m-d');

if ($ds_status !== "A") {
    $ds_submitteddate = !isset($ds_submitteddate) || trim($ds_submitteddate) === "" ? "" : $ds_submitteddate;
    if ($ds_submitteddate === "") {
        header("HTTP/1.0 400 Bad request");
        echo response("0", "Enter Date");
        exit;
    }

    if(!date_create($ds_submitteddate)){
        header("HTTP/1.0 400 Bad request");
        echo response("0", "Enterd Date is not valid Format");
        exit;
    }
    $_date = date_format(date_create($ds_submitteddate),'Y-m-d');
}

$params = array(
    ":ds_submitteddate" => $_date,
    ":ds_status" => $ds_status,
    ":ds_eby" => $uuser,
    ":ds_edate" => $ddate
);

echo $ts->DgStatusUpdate($params,$ds_project);
exit;
