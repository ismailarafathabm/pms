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

$mcount = !isset($_GET['mrid']) || trim($_GET['mrid']) === '' ? '' : trim($_GET['mrid']);
include_once '../../controller/mr.php';
$mr = new MR($cn);
echo $mr->GetMRP($mcount);
exit;
