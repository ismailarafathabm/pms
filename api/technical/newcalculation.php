<?php
if (!isset($tech)) {
    include_once '../_error.php';
    exit;
}

$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");
$data = json_decode($payload);
//print_r($data);
$tcproject = !isset($data->tcproject) || trim($data->tcproject) === "" ? "" : $data->tcproject;
$tcsubmitall = !isset($data->tcsubmitall) || trim($data->tcsubmitall) === "" ? "" : $data->tcsubmitall;
$tcsubmittedby = !isset($data->tcsubmittedby) || trim($data->tcsubmittedby) === "" ? "" : $data->tcsubmittedby;
$tcsubmittaldate = !isset($data->tcsubmittaldate) || trim($data->tcsubmittaldate) === "" ? "" : $data->tcsubmittaldate;
$tcstatus = !isset($data->tcstatus) || trim($data->tcstatus) === "" ? "" : $data->tcstatus;
$tcapproveddate = !isset($data->tcapproveddate) || trim($data->tcapproveddate) === "" ? "" : $data->tcapproveddate;
$tcsubmittalno = !isset($data->tcsubmittalno) || trim($data->tcsubmittalno) === "" ? "" : $data->tcsubmittalno;
$tcsubmittalrv = !isset($data->tcsubmittalrv) || trim($data->tcsubmittalrv) === "" ? "" : $data->tcsubmittalrv;
$tccby = $uuser;
$tceby = $uuser;
$tccdate = $ddate;
$tcedate = $ddate;

if($tcsubmitall === ""){
    echo response('0',"Enter Submittal Informations");
    exit;
}
if($tcsubmittalno === ""){
    echo response('0',"Enter Submittal Number");
    exit;
}
if($tcsubmittalrv === ""){
    echo response('0',"Enter Submittal Revision Number");
    exit;
}
if($tcsubmittedby === ""){
    echo response('0',"Enter Submitted by");
    exit;
}

if($tcsubmittaldate === ""){
    echo response('0',"Enter Submitted Date");
    exit;
}

if(!date_create($tcsubmittaldate)){
    echo response('0',"Submitted Date Not valid Format");
    exit;
}

if($tcstatus === ""){
    echo response('0',"Enter Status");
    exit;
}
if((string)$tcstatus !== "U"){
    if($tcapproveddate === ""){
        echo response('0',"Enter Approval Date");
        exit;
    }

    if(!date_create($tcapproveddate)){
        echo response('0',"Approval Date Not Valid Format");
        exit;
    }

    $tcapproveddate = date_format(date_create($tcapproveddate),'Y-m-d');    
}else{
    $tcapproveddate = date('Y-m-d');
}

$params = array(
    ":tcproject" => $tcproject,
    ":tcsubmitall" => $tcsubmitall,
    ":tcsubmittedby" => $tcsubmittedby,
    ":tcsubmittaldate" => date_format(date_create($tcsubmittaldate),'Y-m-d'),
    ":tcstatus" => $tcstatus,
    ":tcapproveddate" => $tcapproveddate,
    ":tcsubmittalno" => $tcsubmittalno,
    ":tcsubmittalrv" => $tcsubmittalrv,
    ":tccby" => $tccby,
    ":tceby" => $tceby,
    ":tccdate" => $tccdate,
    ":tcedate" => $tcedate,
);

echo $tech->SaveNewCalculationApprovals($params);
exit;
