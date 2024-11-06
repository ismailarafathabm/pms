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

    $sql = "SELECT COUNT(goprojectid) as cnt From pms_cuttinglistgo where (gopflag='2' or gopflag='3') and procurement_status<>0";
    include_once '../../controller/gos.php';
    $goc = new GoController($cn);
    $cnt = $goc->getRowCount($sql);
    header("HTTP/1.0 200 ok");
    echo response("1",$cnt);
    exit;

?>