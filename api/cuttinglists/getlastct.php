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
$project = !isset($_GET["projectno"]) || trim($_GET["projectno"]) === "" ? '' : $_GET["projectno"];
if($project === ""){
    header("HTTP/1.0 400 bad Request");
    echo response("0","Select Any Project");
    exit;
}
//check this cutting list id is available or not
$sql = "SELECT COUNT(ctprojectno) as cnt FROM pms_cuttinglist where ctprojectno = :ctprojectno";
$cm = $cn->prepare($sql);
$cm->bindParam(":ctprojectno",$project);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows['cnt'];
unset($cm,$sql,$rows);
// echo $cnt;
// exit;
if($cnt === 0){
    header("HTTP/1.0 404 error id not found");
    echo response("0","No data Found");
    exit;
}
include_once 'ctools.php';
$sql = "SELECT * FROM pms_cuttinglist where ctprojectno = :projectno order by ct_id desc limit 1";
$cm = $cn->prepare($sql);
$cm->bindParam(":projectno",$project);
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