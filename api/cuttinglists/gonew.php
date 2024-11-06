<?php
include_once 'gen.php';
if ($method !== "POST") {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once 'auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}

if (!isset($_POST['payload']) || trim($_POST['payload']) === '') {
    header("HTTP/1.0 400 error bad request");
    response("0", "Data's Not valid");
    exit;
}

$d = json_decode($_POST['payload']);
$gono = !isset($d->gono) || trim($d->gono) === "" ? "" : $d->gono;
if ($gono === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order No");
    exit;
}
$gorefno = !isset($d->gorefno) || trim($d->gorefno) === "" ? "" : $d->gorefno;
if ($gorefno === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Referance No");
    exit;
}
$goproject = !isset($d->goproject) || trim($d->goproject) === "" ? "" : $d->goproject;
if ($goproject === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Project Number");
    exit;
}

$goprojectname = !isset($d->goprojectname) || trim($d->goprojectname) === "" ? "" : $d->goprojectname;
if ($goprojectname === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Project Name");
    exit;
}

$goprojectlocation = !isset($d->goprojectlocation) || trim($d->goprojectlocation) === "" ? "" : $d->goprojectlocation;
if ($goprojectlocation === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Project Location");
    exit;
}

$gosupplier = !isset($d->gosupplier) || trim($d->gosupplier) === "" ? "-" : $d->gosupplier;
$gogtype = !isset($d->gogtype) || trim($d->gogtype) === "" ? "-" : $d->gogtype;
if ($gogtype === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Type");
    exit;
}
$gospec = !isset($d->gospec) || trim($d->gospec) === "" ? "-" : $d->gospec;
if ($gospec === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Specification");
    exit;
}

$gomarking = !isset($d->gomarking) || trim($d->gomarking) === "" ? "-" : $d->gomarking;
if ($gomarking === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Marking Informations");
    exit;
}

$goqty = !isset($d->goqty) || trim($d->goqty) === "" ? "-" : $d->goqty;
if ($goqty === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Qty");
    exit;
}
if (!is_numeric($goqty)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Qty Is Not A valid Format");
    exit;
}

$goarea = !isset($d->goarea) || trim($d->goarea) === "" ? "-" : $d->goarea;
if ($goarea === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Area");
    exit;
}
if (!is_numeric($goarea)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Area Is Not A valid Format");
    exit;
}

$gotype = !isset($d->gotype) || trim($d->gotype) === "" ? "-" : $d->gotype;
if ($gotype === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Type");
    exit;
}

$godoneby = !isset($d->godoneby) || trim($d->godoneby) === "" ? "-" : $d->godoneby;
if ($godoneby === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Done By Engineer Name");
    exit;
}

$goorddate = !isset($d->goorddate) || trim($d->goorddate) === "" ? "-" : $d->goorddate;
if ($goorddate === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Date");
    exit;
}
if (!date_create($goorddate)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Glass Order Date is Not A Valid Date Format");
    exit;
}
$goorddate = date_format(date_create($d->goorddate),'Y-m-d');
$gostatus = !isset($d->gostatus) || trim($d->gostatus) === "" ? "-" : $d->gostatus;
if ($gostatus === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Status");
    exit;
}
$gortopurchase = date('Y-m-d');
if ((int)$gostatus >= 2) {
    $gortopurchase = !isset($d->gortopurchase) || trim($d->gortopurchase) === "" ? "-" : $d->gortopurchase;
    if ($gortopurchase === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Forward To Purhcase Date");
        exit;
    }
    if(!date_create($gortopurchase)){
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Forward To Purhcase Date is not a Valid Date Format");
        exit;
    }
    $gortopurchase = date_format(date_create($d->gortopurchase),'Y-m-d');
}

$gofrmpurchase = date('Y-m-d');
if ((int)$gostatus >= 3) {
    $gofrmpurchase = !isset($d->gofrmpurchase) || trim($d->gofrmpurchase) === "" ? "-" : $d->gofrmpurchase;
    if ($gofrmpurchase === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Return From Purhcase Date");
        exit;
    }
    if(!date_create($gofrmpurchase)){
        header("HTTP/1.0 400 error bad request");
        echo response("0", " Return From  Date is not a Valid Date Format");
        exit;
    }
    $gofrmpurchase = date_format(date_create($d->gofrmpurchase),'Y-m-d');
}
$goremark = !isset($d->goremark) || trim($d->goremark) === "" ? "-" : $d->goremark;
$cby = $uuser;
$eby = $uuser;
$cdate = $ddate;
$cedate = $ddate;
$projectid = !isset($d->projectid) || trim($d->projectid) === "" ? "0" : $d->projectid;
$gogotype = !isset($d->gogotype) || trim($d->gogotype) === "" ? "0" : $d->gogotype;
$godepartmentflag = "0";
$godepforward = date('Y-m-d');
$godepreceived = date('Y-m-d');

$params = array(
    ':gono' => $gono,
    ':gorefno' => $gorefno,
    ':goproject' => $goproject,
    ':goprojectname' => $goprojectname,
    ':goprojectlocation' => $goprojectlocation,
    ':gosupplier' => $gosupplier,
    ':gogtype' => $gogtype,
    ':gospec' => $gospec,
    ':gomarking' => $gomarking,
    ':goqty' => $goqty,
    ':goarea' => $goarea,
    ':gotype' => $gotype,
    ':godoneby' => $godoneby,
    ':goorddate' => $goorddate,
    ':gortopurchase' => $gortopurchase,
    ':gofrmpurchase' => $gofrmpurchase,
    ':gostatus' => $gostatus,
    ':goremark' => $goremark,
    ':cby' => $cby,
    ':eby' => $eby,
    ':cdate' => $cdate,
    ':cedate' => $cedate,
    ':projectid' => $projectid,
    ':gogotype' => $gogotype,
    ':godepartmentflag' => $godepartmentflag,
    ':godepforward' => $godepforward,
    ':godepreceived' => $godepreceived,    
);
$sql = "INSERT INTO pms_cuttinglistgo values(
    null,
    :gono,
    :gorefno,
    :goproject,
    :goprojectname,
    :goprojectlocation,
    :gosupplier,
    :gogtype,
    :gospec,
    :gomarking,
    :goqty,
    :goarea,
    :gotype,
    :godoneby,
    :goorddate,
    :gortopurchase,
    :gofrmpurchase,
    :gostatus,
    :goremark,
    :cby,
    :eby,
    :cdate,
    :cedate,
    :projectid,
    :gogotype,
    :godepartmentflag,
    :godepforward,
    :godepreceived   
    
)";
$cm = $cn->prepare($sql);
$sv = $cm->execute($params);
unset($cm, $sql);
if (!$sv) {
    header("HTTP/1.0 500 error");
    echo response("0", "Error on Saving Data");
    exit;
}

header("HTTP/1.0 200 ok");
echo response("1", "Saved");
exit;
