<?php
include_once 'gen.php';
if ($method !== "GET") {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once 'auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}

$goproject = !isset($_GET['goproject']) || trim($_GET['goproject']) === '' ? '' : trim($_GET['goproject']);
if($goproject === ''){
    header("HTTP/1.0 400 error bad request");
    echo response("0","Enter Project Number");
    exit;
}

$sql = "SELECT *FROM pms_cuttinglistgo where goproject = :goproject";
$cm = $cn->prepare($sql);
$cm->bindParam(":goproject",$goproject);
$cm->execute();
$rpts = [];
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $rpt = glassorder($rows);
    $rpts[] = $rpt;
}
unset($cm,$sql,$rows);
header("HTTP/1.0 200 ok");
echo response("1",$rpts);
exit;
?>