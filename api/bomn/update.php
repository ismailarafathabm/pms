<?php
include_once '../cuttinglists/gen.php';
if ($method !== "POST") {
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

$payload = !isset($_POST['payload']) || trim($_POST['payload']) === '' ? '' : $_POST['payload'];
if ($payload === '') {
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Form Datas");
    exit;
}

$d = json_decode($payload);

$bom_projectno = !isset($d->bom_projectno) || trim($d->bom_projectno) === '' ? '' : trim($d->bom_projectno);
if($bom_projectno === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Project Number");
    exit;
}

$bom_boqid = !isset($d->bom_boqid) || trim($d->bom_boqid) === '' ? '' : trim($d->bom_boqid);
if($bom_boqid === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Select BOQ ");
    exit;
}

$bom_profileno = !isset($d->bom_profileno) || trim($d->bom_profileno) === '' ? '-' : trim($d->bom_profileno);

$bom_description = !isset($d->bom_description) || trim($d->bom_description) === '' ? '' : trim($d->bom_description);
if($bom_description === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Item Description");
    exit;
}
$bom_dieweight = !isset($d->bom_dieweight) || trim($d->bom_dieweight) === '' ? '' : trim($d->bom_dieweight);
if($bom_dieweight === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Item Die Weight");
    exit;
}
if(!is_numeric($bom_dieweight)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Die Weight Not a number Format");
    exit;
}
$bom_qrlenght = !isset($d->bom_qrlenght) || trim($d->bom_qrlenght) === '' ? '' : trim($d->bom_qrlenght);
if($bom_qrlenght === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Item Length Weight");
    exit;
}
if(!is_numeric($bom_qrlenght)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Length Weight Not a number Format");
    exit;
}
$bom_qrbar = !isset($d->bom_qrbar) || trim($d->bom_qrbar) === '' ? '' : trim($d->bom_qrbar);
if($bom_qrbar === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Reqired Bar Qty");
    exit;
}
if(!is_numeric($bom_qrbar)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Reqired Bar Qty Not a number Format");
    exit;
}
$bom_qrtotweight = !isset($d->bom_qrtotweight) || trim($d->bom_qrtotweight) === '' ? '' : trim($d->bom_qrtotweight);
if($bom_qrtotweight === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Reqired Bar Qty");
    exit;
}
if(!is_numeric($bom_qrtotweight)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Reqired Bar Qty Not a number Format");
    exit;
}
$bom_avilength = !isset($d->bom_avilength) || trim($d->bom_avilength) === '' ? '' : trim($d->bom_avilength);
if($bom_avilength === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Available Length");
    exit;
}
if(!is_numeric($bom_avilength)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Available Length Not a number Format");
    exit;
}
$bom_avaibar = !isset($d->bom_avaibar) || trim($d->bom_avaibar) === '' ? '' : trim($d->bom_avaibar);
if($bom_avaibar === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Available Bar qty");
    exit;
}
if(!is_numeric($bom_avaibar)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Available Bar qty Not a number Format");
    exit;
}
$bom_orderlength = !isset($d->bom_orderlength) || trim($d->bom_orderlength) === '' ? '' : trim($d->bom_orderlength);
if($bom_orderlength === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Ordered Length");
    exit;
}
if(!is_numeric($bom_orderlength)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Ordered Length Not a number Format");
    exit;
}
$bom_orderbar = !isset($d->bom_orderbar) || trim($d->bom_orderbar) === '' ? '' : trim($d->bom_orderbar);

if($bom_orderbar === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Ordered Bar");
    exit;
}
if(!is_numeric($bom_orderbar)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Ordered Bar Not a number Format");
    exit;
}
$bom_orderweight = !isset($d->bom_orderweight) || trim($d->bom_orderweight) === '' ? '' : trim($d->bom_orderweight);
if($bom_orderweight === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter Ordered Weight");
    exit;
}
if(!is_numeric($bom_orderweight)){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Ordered Weight Not a number Format");
    exit;
}
$bom_itemfinish = !isset($d->bom_itemfinish) || trim($d->bom_itemfinish) === '' ? '-' : trim($d->bom_itemfinish);
$bom_remarks = !isset($d->bom_remarks) || trim($d->bom_remarks) === '' ? '-' : trim($d->bom_remarks);
$bom_no = !isset($d->bom_no) || trim($d->bom_no) === '' ? '' : trim($d->bom_no);
if($bom_no === ''){
    header("HTTP/1.0 400 Some Input missing");
    echo response("0", "Enter BOM Number");
    exit;
}
$bom_id = !isset($_GET['bom_id']) || trim($_GET['bom_id']) === '' ? '' : trim($_GET['bom_id']);
$bom_eby = $uuser;
$bom_edate = $ddate;
$params = array(    
    ':bom_boqid' => $bom_boqid,
    ':bom_profileno' => $bom_profileno,
    ':bom_description' => $bom_description,
    ':bom_dieweight' => $bom_dieweight,
    ':bom_qrlenght' => $bom_qrlenght,
    ':bom_qrbar' => $bom_qrbar,
    ':bom_qrtotweight' => $bom_qrtotweight,
    ':bom_avilength' => $bom_avilength,
    ':bom_avaibar' => $bom_avaibar,
    ':bom_orderlength' => $bom_orderlength,
    ':bom_orderbar' => $bom_orderbar,
    ':bom_orderweight' => $bom_orderweight,
    ':bom_itemfinish' => $bom_itemfinish,
    ':bom_remarks' => $bom_remarks,   
    ':bom_eby' => $bom_eby,    
    ':bom_edate' => $bom_edate,      
    ':bom_id' => $bom_id,
);

include_once '../../controller/bomn.php';
$bom = new Bomn($cn);
echo $bom->EditItems($params,$bom_no,$bom_projectno);
exit;