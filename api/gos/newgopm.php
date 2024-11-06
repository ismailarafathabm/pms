<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'POST') {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once '../cuttinglists/auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}
$goprojectid = !isset($_POST['goprojectid']) || trim($_POST['goprojectid']) === '' ? '' : trim($_POST['goprojectid']);
if ($goprojectid === "") {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Enter Project Id");
    exit;
}

$goproject = !isset($_POST['goproject']) || trim($_POST['goproject']) === '' ? '' : trim($_POST['goproject']);
if ($goproject === "") {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Enter Contract Number");
    exit;
}
$goprojectname = !isset($_POST['goprojectname']) || trim($_POST['goprojectname']) === '' ? '' : trim($_POST['goprojectname']);
if ($goprojectname === "") {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Enter Project Name");
    exit;
}

$goprojectlocation = !isset($_POST['goprojectlocation']) || trim($_POST['goprojectlocation']) === '' ? '' : trim($_POST['goprojectlocation']);
if ($goprojectlocation === "") {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Enter Project Location");
    exit;
}

$totrows = !isset($_POST['totrows']) || trim($_POST['totrows']) === '' ? '' : trim($_POST['totrows']);
if ($totrows === "") {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Enter Contract Number");
    exit;
}

$params = [];
$cby = $uuser;
$eby = $uuser;
$cdate = $ddate;
$edate = $ddate;
//echo $totrows;
for ($i = 0; $i < $totrows; $i++) {
    $param = array(
        ":goprojectid" => $goprojectid,
        ":goproject" => $goproject,
        ":goprojectname" => $goprojectname,
        ":goprojectlocation" => $goprojectlocation,
        ":gonumber" => "",
        ":gosupplier" => "",
        ":goglasstype" => "",
        ":goglassspec" => "",
        ":gomarking" => "",
        ":goqty" => "0",
        ":goarea" => "0",
        ":godoneby" => "",
        ":godate" => date('Y-m-d'),
        ":gopflag" => "0",
        ":goprelease" => date('Y-m-d'),
        ":gopreturn" => date('Y-m-d'),
        ":remarks" => "",
        ":gocostingflag" => "0",
        ":gocostingrelease" => date('Y-m-d'),
        ":gocosingreturn" => date('Y-m-d'),
        ":cby" => $cby,
        ":eby" => $eby,
        ":cdate" => $cdate,
        ":edate" => $edate,
        ":othersdesc" => "",
        ":gotype" => "1",
        ":gootype" => "1",
        ":rgono" => ""        
    );
    $params[] = $param;
}

//print_r($params);

include_once '../../controller/gos.php';
$goc = new GoController($cn);
echo $goc->SaveGos($params);
exit;
