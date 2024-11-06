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
$project = !isset($_GET['project']) || trim($_GET['project']) === '' ? '' : trim($_GET['project']);

if($project === ''){
    header("http/1.0 403 Input Missing");
    echo response("0","Enter Project Number");
    exit; 
}

$bomno = !isset($_GET['bomno']) || trim($_GET['bomno']) === '' ? '' : trim($_GET['bomno']);
if($bomno === ''){
    header("http/1.0 403 Input Missing");
    echo response("0","Enter Bom NUmber");
    exit;
}

include_once '../../controller/bomn.php';
$bom = new Bomn($cn);
echo $bom->UNPOSTBOM($bomno,$project);
exit;
?>