<?php 
 include_once '../cuttinglists/gen.php';
 if ($method !== 'GET') {
     header('HTTP/1.0 404 page not found');
     echo response("0", "Request Method Not Acceptable");
     exit;
 }
 $auth = true;    
 include_once '../cuttinglists/auth.php';

 if (!$auth) {
     header("HTTP/1.0 403 Authorization Error");
     echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
     exit;
 }

 $mcount = !isset($_GET['limitr']) || trim($_GET['limitr']) === '' ? '' : trim($_GET['limitr']);
 if($mcount === ''){
    header("HTTP/1.0 402 bad request");
    echo response("0","Some Inputs Missing");
    exit;
 }
 if(!is_numeric($mcount)){
    header("HTTP/1.0 402 bad request");
    echo response("0","Some Inputs are not valid Format");
    exit;
 }
 $projectid = $_GET['goproject'];
 $sql = "SELECT * From pms_cuttinglistgo where goproject='$projectid' limit $mcount,500";
 include_once '../../controller/gos.php';
 $goc = new GoController($cn);
 echo $goc->GetReports($sql);  
 exit;
?>