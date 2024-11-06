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

    $goid = !isset($_GET['goid']) || trim($_GET['goid']) === '' ? '' : trim($_GET['goid']);
    if($goid === ''){
        header("HTTP/1.0 401 error bad request");
        echo response("0","enter Go ID");
        exit;
    }
    include_once '../../controller/gos.php';
    $goc = new GoController($cn);
    $cnt = $goc->GetGO($goid);
    echo $cnt;    
    exit;

?>