<?php
if (!isset($mtbl)) {
    include_once '../_error.php';
    exit;
}
if (!isset($loaddate) || trim($loaddate) === "") {
    echo response("0", "Enter Run Date");
    exit;
}
if (!date_create($loaddate)) {
    echo response("0", "Enter Run Date is Not Valid Date Format");
    exit;
}

if (!isset($loadproject) || trim($loadproject) === "") {
    echo response("0", "Enter Project");
    exit;
}

if (!isset($location) || trim($location) === "") {
    echo response("0", "Enter Location");
    exit;
}

if (!isset($description) || trim($description) === "") {
    echo response("0", "Enter Description");
    exit;
}

if (!isset($qty) || trim($qty) === "") {
    echo response("0", "Enter Qty");
    exit;
}

if(!is_numeric($qty)){
    echo response("0", "Qty is not a Number Format");
    exit;
}



if (!isset($unit) || trim($unit) === "") {
    echo response("0", "Select Unit");
    exit;
}


if (!isset($driver) || trim($driver) === "") {
    echo response("0", "Enter Driver Name");
    exit;
}


if (!isset($loadingdate) || trim($loadingdate) === "") {
    echo response("0", "Enter Loading Date");
    exit;
}
if (!date_create($loadingdate)) {
    echo response("0", "Enter Loading Date is Not Valid Date Format");
    exit;
}


if (!isset($ascurrentdate) || trim($ascurrentdate) === "") {
    echo response("0", "Enter At Site Date");
    exit;
}
if (!date_create($ascurrentdate)) {
    echo response("0", "Enter At Site Date is Not Valid Date Format");
    exit;
}

if (!isset($remark) || trim($remark) === "") {
    echo response("0", "Enter Remark");
    exit;
}

if (!isset($status) || trim($status) === "") {
    echo response("0", "Enter status");
    exit;
}

if (!isset($pjcno) || trim($pjcno) === "") {
    echo response("0", "Enter Project Number");
    exit;
}
$date1 = date_format(date_create($fromdate),"Y-m-d");
$date2 = date_format(date_create($todate),"Y-m-d");

$s1 = array(
    ":loaddate" => date_format(date_create($loaddate),'Y-m-d'),
    ":loadproject" => $loadproject,
    ":location" => $location,
    ":description" => $description,
    ":qty" => $qty,
    ":unit" => $unit,
    ":driver" => $driver,
    ":estimatedate" => date_format(date_create($loadingdate),'Y-m-d'),
    ":loadingdate" => date_format(date_create($loadingdate),'Y-m-d'),
    ":estimatetositedate" => date_format(date_create($ascurrentdate),'Y-m-d'),
    ":ascurrentdate" => date_format(date_create($ascurrentdate),'Y-m-d'),
    ":remark" => $remark,
    ":status" => $status,
    ":rvno" => "0",
    ":cby" => $user_name,
    ":eby" => $user_name,
    ":cdate" => date('Y-m-d H:i:s'),
    ":edate" => date('Y-m-d H:i:s'),
    ":pjcno" => strtolower($pjcno),
    ":pjcnoenc" => $pjcnoenc,
);

$p3 = array(
    ":st" => $date1,
    ":en" => $date2,
);

echo $mtbl->Save($s1,$s1,$p3);
exit;


