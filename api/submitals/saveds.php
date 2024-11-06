<?php
if (!isset($ts)) {
    include_once '../_error.php';
    exit;
}
$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");
$data = json_decode($payload);
//print_r($data); 
$ds_project = !isset($data->ds_project) || trim($data->ds_project) === "" ? "" : $data->ds_project;
$ds_submitalno = !isset($data->ds_submitalno) || trim($data->ds_submitalno) === "" ? "" : $data->ds_submitalno;
$ds_rvno = !isset($data->ds_rvno) || trim($data->ds_rvno) === "" ? "" : $data->ds_rvno;
$ds_date = !isset($data->ds_date) || trim($data->ds_date) === "" ? "" : $data->ds_date;
$ds_purpose = !isset($data->ds_purpose) || trim($data->ds_purpose) === "" ? "" : $data->ds_purpose;
$ds_remark = !isset($data->ds_remark) || trim($data->ds_remark) === "" ? "" : $data->ds_remark;
$ds_submittedby = !isset($data->ds_submittedby) || trim($data->ds_submittedby) === "" ? "" : $data->ds_submittedby;
$ds_submitteddate = !isset($data->ds_submitteddate) || trim($data->ds_submitteddate) === "" ? "" : $data->ds_submitteddate;
$ds_status = "1";
$ds_remarks = "";
$ds_cby = $uuser;
$ds_eby = $uuser;
$ds_cdate = $ddate;
$ds_edate = $ddate;
$ds_extra = !isset($data->ds_extra) || trim($data->ds_extra) === "" ? "" : $data->ds_extra;

if($ds_project === ""){
    echo response("0" , "Select Any Project");
    exit;
}

if($ds_submitalno === ""){
    echo response("0" , "Enter Submital Number");
    exit;
}

if($ds_rvno === ""){
    echo response("0" , "Enter Revision No");
    exit;
}

if($ds_date === ""){
    echo response("0" , "Enter Date");
    exit;
}
if(!date_create($ds_date)){
    echo response("0","Date is not valid format");
    exit;
}
if($ds_purpose === ""){
    echo response("0" , "Select Purpose");
    exit;
}
if($ds_remark === ""){
    echo response("0" , "Enter Remark");
    exit;
}
if($ds_submittedby === ""){
    echo response("0" , "Enter Submitted by");
    exit;
}
if($ds_submitteddate === ""){
    echo response("0" , "Enter Submitted Date");
    exit;
}

if(!date_create($ds_submitteddate)){
    echo response("0","Submital Date is not valid format");
    exit;
}

if($ds_extra === ""){
    echo response("0" , "Enter Details");
    exit;
}

$dtinforamtions = json_decode($ds_extra);
$submital = array(
    ":ds_project"  => $ds_project,
    ":ds_submitalno"  => $ds_submitalno,
    ":ds_rvno"  => $ds_rvno,
    ":ds_date"  => date_format(date_create($ds_date),'Y-m-d'),
    ":ds_purpose"  => $ds_purpose,
    ":ds_remark"  => $ds_remark,
    ":ds_submittedby"  => $ds_submittedby,
    ":ds_submitteddate"  => date_format(date_create($ds_submitteddate),'Y-m-d'),
    ":ds_status"  => $ds_status,
    ":ds_remarks"  => $ds_remarks,
    ":ds_cby"  => $ds_cby,
    ":ds_eby"  => $ds_eby,
    ":ds_cdate"  => $ds_cdate,
    ":ds_edate"  => $ds_edate,
    ":ds_extra"  => $ds_extra,
);

echo $ts->save_drawing_submital($submital,$dtinforamtions);
exit;
