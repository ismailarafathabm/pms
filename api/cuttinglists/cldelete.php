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
    header("HTTP/1.0 403 Authendication Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}

$del_permission = true;

if(!$del_permission){
    header("HTTP/1.0 403 Atorization  Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}


$id = !isset($_GET['id']) || trim($_GET['id']) === '' ? "" : trim($_GET['id']);

if($id === '') {
    header("HTTP/1.0 401 error input Missing");
    echo response("0","Input Missing");
    exit;
}

$sql = "DELETE FROM pms_cuttinglist where ct_id = :ct_id limit 1";
$cm = $cn->prepare($sql);
$cm->bindParam(":ct_id",$id);
$del = $cm->execute();
if(!$del){
    header("HTTP/1.0 500 error Error found On Deleteing Row");
    echo response("0","Error Found on Removeing Data");
    exit;
}

header("HTTP/1.0 200 ok");
echo response("1","Data has Removed");
exit;
?>