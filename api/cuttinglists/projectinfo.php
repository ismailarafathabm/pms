<?php 
include_once 'gen.php';
if($method !== 'GET'){
    header('HTTP/1.0 404 page not found');
    echo response("0","Request Method Not Acceptable");
    exit;
}

$auth = true;
include_once 'auth.php';

if(!$auth){
    header("HTTP/1.0 403 Authorization Error");
    echo response("0","You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}
$pjno = !isset($_GET["project"]) || trim($_GET["project"]) === "" ? "" : trim($_GET["project"]);
if($pjno === ""){
    header("HTTP/1.0 400 bad Request");
    echo response("0","Project Number Is missing");
    exit;
}
//$sql = "SELECT ctprojectno,ctprojectlocation,ctprojectname FROM pms_cuttinglist where ctprojectno=:project";
$sql = "SELECT count(ctprojectno) as cnt FROM pms_cuttinglist where ctprojectno=:project";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$pjno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);
$cnt = (int)$rows['cnt'];
unset($cm,$sql,$rows);



$sql = "SELECT count(ctprojectno) as cnt FROM pms_cuttinglist where ctprojectno=:project";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$pjno);
$cm->execute();
$rows = $cm->fetch(PDO::FETCH_ASSOC);




?>