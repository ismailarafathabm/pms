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
    echo response("0", "Data's Not valid");
    exit;
}
$d = json_decode($_POST['payload']);
$goid = !isset($_GET['goid']) || trim($_GET['goid']) === '' ? '' : trim($_GET['goid']);
if($goid === ''){
    header("HTTP/1.0 400 bad request");
    echo response("0","Glass Order Id is not found");
    exit;
}
//echo $d->flagstatus;
$gostatus = !isset($d->flagstatus) || trim($d->flagstatus) === '' ? '0' : trim($d->flagstatus);
$gortopurchase = date('Y-m-d');
if((int)$gostatus >= 2){
    $gortopurchase = !isset($d->issuedate_update) || trim($d->issuedate_update) === "" ? '' : trim($d->issuedate_update);
    if($gortopurchase === ''){
        header('HTTP/1.0 400 bad request');
        echo response("0","Enter Forword To Purchase Date");
        exit;
    }
    if(!date_create($gortopurchase)){
        header('HTTP/1.0 400 bad request');
        echo response("0","Forword To Purchase Date is not valid Date");
        exit;
    }
    $gortopurchase = date_format(date_create($d->issuedate_update),'Y-m-d');
}

$gofrmpurchase = date('Y-m-d');
if((int)$gostatus === 3){
    $gofrmpurchase = !isset($d->reserved_update) || trim($d->reserved_update) === "" ? '' : trim($d->reserved_update);
    if($gofrmpurchase === ''){
        header('HTTP/1.0 400 bad request');
        echo response("0","Enter Forword To Purchase Date");
        exit;
    }
    if(!date_create($gofrmpurchase)){
        header('HTTP/1.0 400 bad request');
        echo response("0","Forword To Purchase Date is not valid Date");
        exit;
    }
    $gofrmpurchase = date_format(date_create($d->reserved_update),'Y-m-d');
}
$params = array(
    ":gostatus" => $gostatus,
    ":gortopurchase" => $gortopurchase,
    ":gofrmpurchase" => $gofrmpurchase,
    ":goid" => $goid,
);
$sql = "UPDATE pms_cuttinglistgo set gostatus = :gostatus, 
        gortopurchase = :gortopurchase,
        gofrmpurchase = :gofrmpurchase where goid = :goid";
$sqlx = "UPDATE pms_cuttinglistgo set gostatus = '$gostatus', 
gortopurchase = '$gortopurchase',
gofrmpurchase = '$gofrmpurchase' where goid = ".$goid."";
//echo $sqlx;
$cm = $cn->prepare($sql);
$sv = $cm->execute($params);
if(!$sv){
    header("HTTP/1.0 500 error");
    echo response("0","Error on saving Data");
    exit;
}
header("HTTP/1.0 200 ok");
echo response("1","Updated");
exit;

?>