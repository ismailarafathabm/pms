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


if (!isset($_POST['payload']) || trim($_POST['payload']) === '') {
    header("HTTP/1.0 400 bad request");
    response("0", "Data's Not valid");
}

$ctinfo = json_decode($_POST['ct']);
$updateinfo = json_decode($_POST['ctupdate']);
$updatetype = $_POST['updatetype'];
include_once '_account_update.php';
include_once '_material_update.php';
include_once '_operation_update.php';
include_once '_production_update.php';
//print_r($updateinfo);
foreach($ctinfo as $ct){
    $ct_id = trim($ct->ct_id);
    //echo $ct_id;
    $mo_no = trim($ct->ct_mono);
    $project = trim($ct->ctprojectno);
    if($updatetype === 'account'){       
        updateAccounts($cn,$updateinfo,$ct_id,$project,$mo_no);
    }
    if($updatetype === 'material'){
        updatematerial($cn,$updateinfo,$ct_id);
    }
    if($updatetype === 'operation'){
        operationupdate($cn,$updateinfo,$ct_id);
    }
    if($updatetype === 'production'){
        productionupdate($cn,$updateinfo,$ct_id);
    }    
}

header("HTTP/1.0 200 ok");
echo response("1","Data Has Updated");
exit;




