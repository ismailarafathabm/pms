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

    $limit = !isset($_GET['limitr']) || trim($_GET['limitr']) === '' ? '' : trim($_GET['limitr']);
    
    if($limit === ''){
        header("HTTP/1.0 409 Input Missing");
        echo response("0", "Input Missing");
        exit; 
    }

    $sql = "SELECT *From pms_cuttinglistgoprocurement_receipt as gor inner join pms_cuttinglistgo as gos on gor.goreceiptgono = gos.goid limit $limit,500";
    include_once '../../controller/gos.php';
    $goc = new GoController($cn);
    header("HTTP/1.0 200 ok");
    echo $goc->getReceiptRpt($sql);
    exit;

?>