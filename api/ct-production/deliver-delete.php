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

$sql = "DELETE FROM pms_cuttinglist_productions_out where outid = :outid limit 1";
$cm = $cn->prepare($sql);
$cm->bindParam(":outid", $id);
$sv = $cm->execute();
if (!$sv) {
    header("http/1.0 500 error");
    echo response("0", "Error on Removeing Data");
    exit();
}

header("http/1.0 200 ok");
echo response("1", "Data Has Removed");
exit();
