<?php 
date_default_timezone_set('Asia/Riyadh');
header("Content-Type: application/json");
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:POST");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,X-Auth-Token');
    $gdate = $_GET['datex'];
    
    $weekday = date('l', strtotime($gdate)); // note: first arg to date() is lower-case L 


    $dip = date_create($gdate);
    $dip_d = date_format($dip,'d-M-Y');
    header('content-type:text/json');
    $r['datefull'] = $weekday;
    $r['datefr'] = $dip_d;
    echo json_encode($r);
?>