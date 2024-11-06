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
include_once 'ctools.php';
$c_moproject = !isset($_GET["project"]) || trim($_GET["project"]) === "" ? "" : trim($_GET["project"]);
if($c_moproject === ""){
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Project Id Missing");
    exit;
}

$sql = "SELECT *FROM pms_cuttinglist_mo where ctprojectno = :ctprojectno";

$cm = $cn->prepare($sql);
$cm->bindParam(":ctprojectno", $c_moproject);
$cm->execute();
$mos = [];
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $mo = array(
        "c_moid" => $rows["c_moid"],
        "c_mono" => $rows["c_mono"],
        "c_moproject" => $rows["c_moproject"],
        "c_mo_accountfalg" => $rows["c_mo_accountfalg"],
        "c_mo_accountfalg_txt" => _flagStatussTxt($rows["c_mo_accountfalg"]),
        "c_mo_account_issue" => $rows["c_mo_account_issue"],
        "c_mo_account_issue_d" => datemethod($rows["c_mo_account_issue"]),
        "c_mo_account_release" => $rows["c_mo_account_release"],
        "c_mo_account_release_d" => datemethod($rows["c_mo_account_release"]),
    );
    $mos[] = $mo;
}
unset($cm, $sql, $rows);
header("HTTP/1.0 200 ok");
echo response("1", $mos);
exit;
