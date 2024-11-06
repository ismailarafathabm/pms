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

$payload = !isset($_POST['payload']) || trim($_POST['payload']) === '' ? '' : trim($_POST['payload']);
if($payload === ''){
    header("http/1.0 409 bad request");
    echo response("0","Input Missing");
    exit;
}
$d = json_decode($payload);
$ptype_name = !isset($d->ptype_name) || trim($d->ptype_name) === '' ? '' : trim($d->ptype_name);
if($ptype_name === ''){
    header('http/1.0 409 bad request');
    echo response("0","Enter Type");
    exit;
}
$ptype_id = !isset($d->ptype_id) || trim($d->ptype_id) === '' ? '' : trim($d->ptype_id);
if($ptype_name === ''){
    header('http/1.0 409 bad request');
    echo response("0","Missing Type id");
    exit;
}
include_once '../../controller/boq.php';
$boq = new BOQ($cn);
$xptype_name = $boq->enc('enc',$ptype_name);
echo (string)$boq->UpdateBoqItemtype($xptype_name,$ptype_id);
exit;