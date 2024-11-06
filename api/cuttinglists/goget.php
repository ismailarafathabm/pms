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
$goid = !isset($_GET['goid']) || trim($_GET['goid']) === '' ? '' : trim($_GET['goid']);
if($goid === ""){
    header("HTTP/1.0 400 bad request");
    echo response("0","Enter Go Referanace Id");
    exit;
}

$sql = "SELECT COUNT(goid) as cnt FROM pms_cuttinglistgo where goid = :goid";
$cm = $cn->prepare($sql);
$cm->bindParam(":goid",$goid);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows['cnt'];
unset($cm,$sql,$rows);
if($cnt === 0){
    header("HTTP/1.0 404 result not found");
    echo response("0","Data Not Found");
    exit;
}
include_once 'ctools.php';
$sql = "SELECT * FROM pms_cuttinglistgo where goid = :goid";
$cm = $cn->prepare($sql);
$cm->bindParam(":goid",$goid);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$rpt = glassorder($rows);
unset($cm,$sql,$rows);
header("HTTP/1.0 200 ok");
echo response("1",$rpt);
exit;
?>