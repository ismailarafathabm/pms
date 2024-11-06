<?php
include_once 'gen.php';
if ($method !== 'GET') {
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

$ctno = !isset($_GET["ctno"]) || trim($_GET["ctno"]) === "" ? '' : $_GET["ctno"];
$ctprojectno = !isset($_GET["projects"]) || trim($_GET["projects"]) === "" ? '' : $_GET["projects"];

$sql = "SELECT COUNT(ct_no) as ct_no FROM pms_cuttinglist where ct_no = :ct_no and ctprojectno=:ctprojectno limit 1";
$cm = $cn->prepare($sql);
$cm->bindParam(":ct_no",$ctno);
$cm->bindParam(":ctprojectno",$ctprojectno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows['ct_no'];
unset($cm,$sql,$rows);

if($cnt === 0){
    header("HTTP/1.0 200 ok error");
    echo response("0","NO data found");
    exit;
}

include_once 'ctools.php';

$sql = "SELECT *FROM pms_cuttinglist where ct_no = :ct_no and ctprojectno=:ctprojectno limit 1";
$cm = $cn->prepare($sql);
$cm->bindParam(":ct_no",$ctno);
$cm->bindParam(":ctprojectno",$ctprojectno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$rpt = ColsForCuttingList($rows);       
$rpt['ctno'] = $rows["ctprojectno"] . "-" . $rows['ct_no'];
echo response("1",$rpt);
exit;

?>