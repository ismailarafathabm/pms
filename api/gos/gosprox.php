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

 $sql = "SELECT * FROM pms_cuttinglistgo as go left join (select goreceiptgono,sum(goreceiptqty) as receiptqty,sum(goreceiptarea) as receiptarea,sum(goreceipttotalprice) as receipttotprice from `pms_cuttinglistgoprocurement_receipt` group by goreceiptgono) as gor on go.goid=gor.goreceiptgono where (gopflag='2' or gopflag='3') and procurement_status<>0 limit $mcount,500"; 
 include_once '../../controller/gos.php';
 $goc = new GoController($cn);
 echo $goc->GetReportsprcourement($sql);  
 exit;
?>