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
    $mrproject = !isset($_GET['mrproject']) || trim($_GET['mrproject']) === '' ? '' : trim($_GET['mrproject']);
    if($mrproject === ''){
        header("HTTP/1.0 401 error");
        echo response("0","Enter Project Number");
        exit;
    }
    include_once '../../controller/mr.php';
    $mr = new MR($cn);
    echo $mr->ProjectMrs($mrproject);
    exit;
?>