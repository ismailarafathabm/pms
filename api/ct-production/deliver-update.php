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
$outid = !isset($_GET['outid']) || trim($_GET['outid']) === "" ? "" : trim($_GET['outid']);
if ($outid === "") {
    header("http/1.0 409 input missing");
    echo response("0", "ID IS MISSING");
    exit();
}
$refno = !isset($_POST['refno']) || trim($_POST['refno']) === "" ? "" : trim($_POST['refno']);
if ($refno === "") {
    header("http/1.0 409 input missing");
    echo response("0", "Release Referance Number Missing");
    exit();
}

$outdate = !isset($_POST['outdate']) || trim($_POST['outdate']) === "" ? "" : trim($_POST['outdate']);
if ($outdate === "") {
    header("http/1.0 409 input missing");
    echo response("0", "Release Date Missing");
    exit();
}

if (!date_create($outdate)) {
    header("http/1.0 409 not valid input");
    echo response("0", "Data is Not Valid Format");
    exit();
}

$outqty = !isset($_POST['outqty']) || trim($_POST['outqty']) === "" ? "" : trim($_POST['outqty']);
if ($outqty === "") {
    header("http/1.0 409 input missing");
    echo response("0", "Enter Qty");
    exit();
}
if (!is_numeric($outqty)) {
    header("http/1.0 409 not valid input");
    echo response("0", "Qty Not valid format");
    exit();
}
if ((float)$outqty === 0) {
    header("http/1.0 409 check input value");
    echo response("0", "Enter qty value should be more then 0");
    exit();
}

$outarea = !isset($_POST['outarea']) || trim($_POST['outarea']) === "" ? "" : trim($_POST['outarea']);
if ($outarea === "") {
    header("http/1.0 409 input missing");
    echo response("0", "Enter Area");
    exit();
}
if (!is_numeric($outarea)) {
    header("http/1.0 409 not valid input");
    echo response("0", "Area Not valid format");
    exit();
}

$updateparams = array(
    ":outno" => $refno,
    ":outdate" => date_format(date_create($outdate),'Y-m-d'),
    ":outqty" => $outqty,
    ":outarea" => $outarea,
    ":outeby" => $uuser,
    ":outedate" => $ddate,
    ":outid" => $outid

);
$sql = "UPDATE pms_cuttinglist_productions_out set 
outno = :outno,
outdate = :outdate,
outqty = :outqty,
outarea = :outarea,
outeby = :outeby,
outedate = :outedate 
where outid = :outid";

$cm = $cn->prepare($sql);
$up = $cm->execute($updateparams);
if(!$up){
    header("http/1.0 500 error");
    echo response("0","Error on Updating data...");
    exit();    
}

header("http/1.0 200 ok");
echo response("1","Data has updated");
exit();
