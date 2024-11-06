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

    $id = !isset($_GET['goreceiptid']) || trim($_GET['goreceiptid']) === '' ? '' : trim($_GET['goreceiptid']);
    if($id === ''){
        header("HTTP/1.0 401 bad Request");
        echo response("0","Check Inputs");
        exit;
    }
    include_once '../../controller/gos.php';
    $goc = new GoController($cn);
    echo (string)$goc->Removereceipt($id);   
    exit;