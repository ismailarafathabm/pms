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
$gtype = [];
$gspec = [];
$gmk = [];
$gsupplier = [];
$gremark = [];

//suppliers
$sql = "SELECT gosupplier from pms_cuttinglistgo group by gosupplier order by gosupplier asc";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $gsupplier[] = $rows['gosupplier'];
}
unset($cm,$sql,$rows);


//glass type
$sql = "SELECT gogtype from pms_cuttinglistgo group by gogtype order by gogtype asc";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $gtype[] = $rows['gogtype'];
}
unset($cm,$sql,$rows);


//glass specifications
$sql = "SELECT gospec from pms_cuttinglistgo group by gospec order by gospec asc";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $gspec[] = $rows['gospec'];
}
unset($cm,$sql,$rows);


//marking 
$sql = "SELECT gomarking from pms_cuttinglistgo group by gomarking order by gomarking asc";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $gmk[] = $rows['gomarking'];
}
unset($cm,$sql,$rows);

//remarks
$sql = "SELECT goremark from pms_cuttinglistgo group by goremark order by goremark asc";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    $gremark[] = $rows['goremark'];
}
unset($cm,$sql,$rows);

$data = array(
    "gtype" => $gtype,
    "gspec" => $gspec,
    "gmk" => $gmk,
    "gsupplier" => $gsupplier,
    "gremark" => $gremark,
);

header("HTTP/1.0 200 ok");
echo response("1",$data);
exit;
?>