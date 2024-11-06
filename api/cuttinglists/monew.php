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
$da = !isset($_POST["payload"]) || trim($_POST["payload"]) === '' ? '' : $_POST["payload"];
$d = json_decode($da);
//print_r($d);
if ($da === '') {
    header('HTTP/1.0 400 error bad request');
    echo response("0", "Error on Post datas");
    exit;
}

$c_moproject = !isset($d->c_moproject) || trim($d->c_moproject) === '' ? '0' : $d->c_moproject;
if ($c_moproject === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Project Id Missing");
    exit;
}

$c_mono = !isset($d->c_mono) || trim($d->c_mono) === '' ? '' : trim($d->c_mono);
if ($c_mono === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Mo Number Missing");
    exit;
}

$c_mo_boqid = !isset($d->c_mo_boqid) || trim($d->c_mo_boqid) === '' ? '' : trim($d->c_mo_boqid);
if ($c_mo_boqid === "") {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter BOQ Item No");
    exit;
}

$c_mo_accountfalg = !isset($d->c_mo_accountfalg) || trim($d->c_mo_accountfalg) === '' ? '1' : trim($d->c_mo_accountfalg);
$c_mo_account_issue = date('Y-m-d');
if ((int)$c_mo_accountfalg >= 2) {
    $xc_mo_account_issue = !isset($d->c_mo_account_issue) || trim($d->c_mo_account_issue) === '' ? '' : trim($d->c_mo_account_issue);
    if ($xc_mo_account_issue === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Account Forward Date");
        exit;
    }

    if(!date_create($xc_mo_account_issue)){
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Account Forward Date is Not Valid Format");
        exit;
    }

    $c_mo_account_issue = date_format(date_create($xc_mo_account_issue),'Y-m-d');
}
$c_mo_account_release = date('Y-m-d');
if ((int)$c_mo_accountfalg === 3) {
    $xc_mo_account_release = !isset($d->c_mo_account_release) || trim($d->c_mo_account_release) === '' ? '' : trim($d->c_mo_account_release);
    if ($xc_mo_account_release === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Received Date From Account");
        exit;
    }

    if(!date_create($xc_mo_account_release)){
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Received Date From Account is Not Valid Format");
        exit;
    }

    $c_mo_account_release = date_format(date_create($xc_mo_account_release),'Y-m-d');
}
$cttype = !isset($d->cttype) || trim($d->cttype) === '' ? '' : $d->cttype;
$ctprojectname = !isset($d->ctprojectname) || trim($d->ctprojectname) === '' ? '' : $d->ctprojectname;
$ctprojectlocation = !isset($d->ctprojectlocation) || trim($d->ctprojectlocation) === '' ? '' : $d->ctprojectlocation;
$ctprojectno = !isset($d->ctprojectno) || trim($d->ctprojectno) === '' ? '' : $d->ctprojectno;
if($cttype === '')
{
    header("HTTP/1.0 400 error");
    echo response("0","Enter Cutting List Type");
    exit;
}
if($ctprojectno === ""){
    header("HTTP/1.0 400 error");
    echo response("0","Enter Project Number");
    exit;
}
if($ctprojectname === ""){
    header("HTTP/1.0 400 error");
    echo response("0","Enter Project name");
    exit;
}

if($ctprojectlocation === ""){
    header("HTTP/1.0 400 error");
    echo response("0","Enter Project Location");
    exit;
}
$params = array(
    ":ctprojectno" => $ctprojectno,
    ":c_mono" => $c_mono,
);
$sql = "SELECT COUNT(c_mono) as cnt from pms_cuttinglist_mo where ctprojectno = :ctprojectno and c_mono = :c_mono";
$cm = $cn->prepare($sql);
$cm->execute($params);
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows["cnt"];
unset($cm, $sql, $rows);

if ($cnt !== 0) {
    header("HTTP/1.0 409 error dublicate found");
    echo response("0", "Already This Mo Registered");
    exit;
}


$svparams = array(
    ":c_mono" => $c_mono,
    ":c_moproject" => $c_moproject,
    ":c_mo_boqid" => $c_mo_boqid,
    ":c_mo_accountfalg" => $c_mo_accountfalg,    
    ":c_mo_account_issue" => $c_mo_account_issue,
    ":c_mo_account_release" => $c_mo_account_release,
    ":cttype" => $cttype,
    ":ctprojectname" => $ctprojectname,
    ":ctprojectlocation" => $ctprojectlocation,
    ":ctprojectno" => $ctprojectno,
);
try{
$sql = "INSERT INTO pms_cuttinglist_mo values(
    null,
    :c_mono,
    :c_moproject,
    :c_mo_boqid,
    :c_mo_accountfalg,
    :c_mo_account_issue,
    :c_mo_account_release,
    :cttype,
    :ctprojectname,
    :ctprojectlocation,
    :ctprojectno
    )";
$cm = $cn->prepare($sql);
$sv = $cm->execute($svparams);
}catch(Exception $e){
    header("HTTP/1.0 500 error internal server error");
    echo response("0","Error on Update Data reason is : ".$e);
}
unset($cm, $sql);
if (!$sv) {
    header("HTTP/1.0 500 error");
    echo response("0", "Error on saving Data");
    exit;
}

//file upload action    
include_once 'ctools.php';
$sql = "SELECT *FROM pms_cuttinglist_mo where ctprojectno = :ctprojectno";
$cm = $cn->prepare($sql);
$cm->bindParam(":ctprojectno", $ctprojectno);
$cm->execute();
$mos = [];
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $mo = array(
        "c_moid" => $rows["c_moid"],
        "c_mono" => $rows["c_mono"],
        "c_moproject" => $rows["c_moproject"],
        "c_mo_accountfalg" => $rows["c_mo_accountfalg"],
        "c_mo_accountfalg_txt" => _flagStatussTxt($rows["c_mo_accountfalg"]),
        "c_mo_account_issue" => $rows["c_mo_account_issue"],
        "c_mo_account_issue_d" => datemethod($rows["c_mo_account_issue"]),
        "c_mo_account_release" => $rows["c_mo_account_release"],
        "c_mo_account_release_d" => datemethod($rows["c_mo_account_release"]),
    );
    $mos[] = $mo;
}
unset($cm, $sql, $rows);
header("HTTP/1.0 200 ok");
echo response("1", $mos);
exit;
