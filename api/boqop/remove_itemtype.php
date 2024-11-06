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
$id = !isset($_GET['id']) || trim($_GET['id']) === '' ? '' : trim($_GET['id']);
if($id === ''){
    header("http/1.0 409 bad request");
    echo response("0","Id Missing");
    exit;
}
include_once '../../controller/boq.php';
$boq = new BOQ($cn);
echo (string)$boq->RemoveBoqItemType($id);
exit;