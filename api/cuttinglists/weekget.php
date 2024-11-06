<?php 
include_once 'gen.php';
if ($method !== 'GET') {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}

$weeks = array();
$fday = date('d-m-Y', strtotime('next friday'));
$stday = date('d-m-Y', strtotime('last Saturday'));
$weeks = array(
    'fday' => $stday,
    "fd" => $fday,
);
echo response("1", $weeks);
?>