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

$mo = !isset($_GET['mo']) || trim($_GET['mo']) === '' ? '' : trim($_GET['mo']);
$project = !isset($_GET['project']) || trim($_GET['project']) === '' ? '' : trim($_GET['project']);

if ($mo === "") {
    header("HTTP/1.0 400 bad Request");
    echo response("0", "Mo Number Missing");
    exit;
}

if ($project === '') {
    header("HTTP/1.0 400 bad request");
    echo response("0", "Enter Project");
    exit;
}

if (!is_uploaded_file($_FILES['mopdf']['tmp_name'])) {
    header("HTTP/1.0 400 bad request");
    echo response("0", "Upload Missing");
    exit;
}
$mofile = $_FILES['mopdf']['name'];
$ext = strtolower(pathinfo($mofile, PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    header("HTTP/1.0 400 bad request");
    echo response("0", "File Should Be PDF format");
    exit;
}
$savefile = $mo."".$users->enc('enc',$project);
$location = "./../../assets/cuttinglists/mo/$savefile.pdf";
if (file_exists($location)) {
    unlink($location);
}
$sv = move_uploaded_file($_FILES['mopdf']['tmp_name'], $location);
if (!$sv) {
    header("HTTP/1.0 500 error");
    echo response("0", "Error on Upload PDF");
    exit;
}
header("HTTP/1.0 200 Ok");
echo response("1", "Updated");
exit;
