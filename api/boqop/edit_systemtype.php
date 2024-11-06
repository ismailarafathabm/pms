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
$system_type_name = !isset($d->system_type_name) || trim($d->system_type_name) === '' ? '' : trim($d->system_type_name);

if($system_type_name === ''){
    header('http/1.0 409 bad request');
    echo response("0","Enter Type");
    exit;
}

$system_type_id = !isset($d->system_type_id) || trim($d->system_type_id) === '' ? '' : trim($d->system_type_id);
if($system_type_id === ''){
    header('http/1.0 409 bad request');
    echo response("0","Missing Type id");
    exit;
}

include_once '../../controller/boq.php';
$boq = new BOQ($cn);
$xsystem_type_name = $boq->enc('enc',$system_type_name);
echo (string)$boq->UpdateBoqSystemType($xsystem_type_name,$system_type_id);
exit;