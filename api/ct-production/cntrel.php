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

     $sql = "SELECT COUNT(outid) as cnt FROM pms_cuttinglist_productions_out";
     $cm = $cn->prepare($sql);
     $cm->execute();
     $rows = $cm->fetch(PDO::FETCH_ASSOC);
     $cnt = (int)$rows['cnt'];
     unset($cm,$sql,$rows);
     header("http/1.0 200 ok");
     echo response("1",$cnt);
     exit();
    
?>