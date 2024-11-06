<?php 
include_once 'gen.php';
if ($method !== "POST") {
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

if(!is_uploaded_file($_FILES['gopdate']['tmp_name'])){
    header("HTTP/1.0 400 bad request");
    echo response("0","File Missing");
    exit;
}
$file = $_FILES['gopdate']['name'];
$ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
if($ext !== 'pdf'){ 
    header("HTTP/1.0 400 error Bad Request");
    echo json_encode(array("msg" => "0", "data"=>"Please Upload Pdf Format Files"));
    exit;
}
$location = "./../../assets/cuttinglists/gor/$goid.pdf";
if(file_exists($location)){
    unlink($location);
}
$sv = move_uploaded_file($_FILES['gopdate']['tmp_name'],$location);
if(!$sv){
    header("HTTP/1.0 500 error");
    echo response("0","Error on uploading PDF");
    exit;
}

header("HTTP/1.0 200 Ok");
echo response("1","Updated");
exit;

?>