<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'GET') {
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
include_once '../../controller/boq.php';
$boq = new BOQ($cn);
extract($_GET);
$poq_project_code = !isset($projectno) || trim($projectno) === '' ? '' : trim($projectno);

if($poq_project_code === ''){
    header("http/1.0 409 input missing");
    echo response('0','Enter Project Number');
    exit;
}


echo (string)$boq->ContractprojectBoq($poq_project_code);
exit;
