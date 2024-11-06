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

     $boqid = !isset($_GET['boqid']) || trim($_GET['boqid']) === '' ? '' : trim($_GET['boqid']);
     if($boqid === ''){
        header("HTTP/1.0 403 Input Missing");
        echo response("0","Enter Boq Item Id");
        return;
     }

     include_once '../../controller/boqn.php';
     $eng = new BOQN($cn);
     echo $eng->GetEngRelease($boqid);
     exit;
?>