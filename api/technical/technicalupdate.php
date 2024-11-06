<?php 
if(!isset($tech)){
    include_once '../_error.php';
    exit;
}

$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");
$data = json_decode($payload);
$taproject = !isset($data->taproject) || trim($data->taproject) === "" ? "" : $data->taproject;
$taapproval = !isset($data->taapproval) || trim($data->taapproval) === "" ? "" : $data->taapproval;
$tadescription = !isset($data->tadescription) || trim($data->tadescription) === "" ? "" : $data->tadescription;
$taremarks = !isset($data->taremarks) || trim($data->taremarks) === "" ? "" : $data->taremarks;
$tasubmittedby = !isset($data->tasubmittedby) || trim($data->tasubmittedby) === "" ? "" : $data->tasubmittedby;
$tasubmitteddate = !isset($data->tasubmitteddate) || trim($data->tasubmitteddate) === "" ? "" : $data->tasubmitteddate;
$tastatus = !isset($data->tastatus) || trim($data->tastatus) === "" ? "" : $data->tastatus;
$taapproveddate = date('Y-m-d');
$tacby = $uuser;
$taeby = $uuser;
$tacdate = $ddate;
$taedate = $ddate;
$taid = !isset($data->taid) || trim($data->taid) === "" ? "0" : $data->taid;

if($taproject === ""){
    echo response("0","Enter Project No");
    exit;
}

if($taapproval === ""){
    echo response("0","Enter Approval Type");
    exit;
}

if($tadescription === ""){
    echo response("0","Enter Description");
    exit;
}

if($taremarks === ""){
    echo response("0","Enter Remark");
    exit;
}

if($tasubmittedby === ""){
    echo response("0","Enter Submitted By");
    exit;
}

if($tasubmitteddate === ""){
    echo response("0","Enter Submitted Date");
    exit;
}
if(!date_create($tasubmitteddate)){
    echo response("0","Submittal Date is not valid Format");
    exit;
}

if((string)$tastatus !== "U"){
    $taapproveddate = !isset($data->taapproveddate) || trim($data->taapproveddate) === "" ? "" : $data->taapproveddate;
    if($taapproveddate === ""){
        echo response("0","Enter Approved Date");
        exit;
    }

    if(!date_create($taapproveddate)){
        echo response("0","Approved Date is not valid Format");
        exit;
    }

    $taapproveddate = date_format(date_create($taapproveddate),'Y-m-d');
}

$params = array(    
    ':taapproval' => $taapproval,
    ':tadescription' => $tadescription,
    ':taremarks' => $taremarks,
    ':tasubmittedby' => $tasubmittedby,
    ':tasubmitteddate' => date_format(date_create($tasubmitteddate),'Y-m-d'),
    ':tastatus' => $tastatus,
    ':taapproveddate' => $taapproveddate,    
    ':taeby' => $taeby,    
    ':taedate' => $taedate,
    ':taid' => $taid,
);

echo $tech->UpdateProjectTechnicalApprovals($params,$taproject);

