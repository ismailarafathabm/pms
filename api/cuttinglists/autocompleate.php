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


$project = !isset($_GET['pro']) || trim($_GET['pro']) === '' ? '' : trim($_GET['pro']);
if($project === 0){
    header("HTTP/1.0 400 bad Request");    
    $result = array();
    response("1",$result);
    exit;
}
$markings = [];
$descriptions = [];
$locations = [];
$donebys = [];
$uints = [];
$sheettypes = [];

//markings
$sql  = "SELECT ct_marking from pms_cuttinglist where ctprojectno = :project group by ct_marking order by ct_marking asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $markings[] = $rows['ct_marking'];
}

unset($cm, $sql, $rows);

//descriptions
$sql  = "SELECT ct_description from pms_cuttinglist where ctprojectno = :project group by ct_description order by ct_description asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $descriptions[] = $rows['ct_description'];
}
unset($cm, $sql, $rows);


//locations
$sql  = "SELECT ct_location from pms_cuttinglist where ctprojectno = :project group by ct_location order by ct_location asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $locations[] = $rows['ct_location'];
}
unset($cm, $sql, $rows);

//done by
$sql  = "SELECT ct_doneby from pms_cuttinglist where ctprojectno = :project group by ct_doneby order by ct_doneby asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $donebys[] = $rows['ct_doneby'];
}
unset($cm, $sql, $rows);


//sheet types
$sql  = "SELECT ctunit from pms_cuttinglist where ctprojectno = :project group by ctunit order by ctunit asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $uints[] = $rows['ctunit'];
}
unset($cm, $sql, $rows);


//done by
$sql  = "SELECT ct_mrefno from pms_cuttinglist where ctprojectno = :project group by ct_mrefno order by ct_mrefno asc";
$cm = $cn->prepare($sql);
$cm->bindParam(":project",$project);
$cm->execute();
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $sheettypes[] = $rows['ct_mrefno'];
}
unset($cm, $sql, $rows);


$datas = array(
    "markings" => $markings,
    "descriptions" => $descriptions,
    "locations" => $locations,
    "donebys" => $donebys,
    "uints" => $uints,
    "sheettypes" => $sheettypes,
);

header("HTTP/1.0 200 ok");
echo response("1",$datas);
exit;
