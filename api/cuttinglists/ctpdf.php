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

$ctno = !isset($_GET['ctno']) || trim($_GET['ctno']) === '' ? '' : trim($_GET['ctno']);
$ct_no = !isset($_GET['ct_no']) || trim($_GET['ct_no']) === '' ? '' : trim($_GET['ct_no']);
$ctprojectno = !isset($_GET['ctprojectno']) || trim($_GET['ctprojectno']) === '' ? '' : trim($_GET['ctprojectno']);
$ctmono = !isset($_GET['ctmono']) || trim($_GET['ctmono']) === '' ? '' : trim($_GET['ctmono']);
if ($ctno === "") {
    header("HTTP/1.0 400 bad Request");
    echo response("0", "Cutting list Number Missing");
    exit;
}

if($ct_no === ''){
    header("HTTP/1.0 400 bad request");
    echo response("0", "Cutting list Number Missing");
    exit;
}

if($ctprojectno === ''){
    header("HTTP/1.0 400 bad request");
    echo response("0", "Cutting list Number Missing");
    exit;
}



if($ctmono === ''){
    header("HTTP/1.0 400 bad request");
    echo response("0", "MO Number Number Missing");
    exit;
}
if(!isset($_FILES['ctpdf']['tmp_name'])){
    header("HTTP/1.0 400 bad request");
    echo response("0", "Upload Missing");
    exit;
}

if (!is_uploaded_file($_FILES['ctpdf']['tmp_name'])) {
    header("HTTP/1.0 400 bad request");
    echo response("0", "Upload Missing");
    exit;
}
$mofile = $_FILES['ctpdf']['name'];
$ext = strtolower(pathinfo($mofile, PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    header("HTTP/1.0 400 bad request");
    echo response("0", "File Should Be PDF format");
    exit;
}
$ct_no =  $users->enc('enc',$ct_no);
$mono = $users->enc('enc',$ctmono);
$filename = $users->enc('enc',$ctprojectno) . "-" . $mono . "-".  $ct_no;
$location = "./../../assets/cuttinglists/cuttinglist/$filename.pdf";
if (file_exists($location)) {
    unlink($location);
}
$sv = move_uploaded_file($_FILES['ctpdf']['tmp_name'], $location);
if (!$sv) {
    header("HTTP/1.0 500 error");
    echo response("0", "Error on Upload PDF");
    exit;
}
header("HTTP/1.0 200 Ok");
echo response("1", "Updated");
exit;
