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
//check this cutting list id is available or not
$sql = "SELECT COUNT(ct_id) as cnt FROM pms_cuttinglist where ct_id = :ct_id";
$cm = $cn->prepare($sql);
$cm->bindParam(":ct_id",$ctno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows['cnt'];
unset($cm,$sql,$rows);

if($cnt === 0){
    header("HTTP/1.0 404 error id not found");
    echo response("0","No data Found");
}
include_once 'ctools.php';
$sql = "SELECT * FROM pms_cuttinglist where ct_id = :ct_id";
$cm = $cn->prepare($sql);
$cm->bindParam(":ct_id",$ctno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$rpt = ColsForCuttingList($rows);      
$rpt['ctno'] = $rows["ctprojectno"] . "-" . $rows['ct_no'];
$rpt['projectenc'] = $users->enc('enc',$rows["ctprojectno"]);
unset($sql,$rows,$cm);
header("HTTP/1.0 200 ok");
echo response("1",$rpt);
exit;

?>