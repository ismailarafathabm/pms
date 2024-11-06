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
$limit = !isset($_GET['limit']) || trim($_GET['limit']) === '' ? '' : trim($_GET['limit']);

if($limit === ''){
    header("http/1.0 403 Input Missing");
    echo response("0","Enter Limit");
    exit; 
}
include_once '../../controller/bomn.php';
$bom = new Bomn($cn);
echo $bom->BoqRptAll($limit);
exit;
