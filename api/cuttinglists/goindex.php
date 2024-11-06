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
include_once 'ctools.php';
$sql = "SELECT *FROM pms_cuttinglistgo";
$cm = $cn->prepare($sql);
$cm->execute();
$rpts = [];
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $rpt = glassorder($rows);
    $fno = $rows['goid'];
    $fstatus = "0";
    $location = "./../../assets/cuttinglists/go/";
    $file = $location . $fno . ".pdf";
    if(file_exists($file)){
        $fstatus = "1";
    }
    $rpt["filestatus"] = $fstatus;
    $rpts[] = $rpt;
}
unset($cm,$sql,$rows);
header("HTTP/1.0 200 ok");
echo response("1",$rpts);
exit;
?>