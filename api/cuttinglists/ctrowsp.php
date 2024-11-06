<?php 
    include_once 'gen.php';
    if($method !== 'GET'){
        header('HTTP/1.0 404 page not found');
        echo response("0","Request Method Not Acceptable");
        exit;
    }
    $auth = true;
    include_once 'auth.php';

    if(!$auth){
        header("HTTP/1.0 403 Authorization Error");
        echo response("0","You Cannot Access This Page right Now Please Re-Login your Account");
        exit;
    }
    include_once 'ctools.php';
    $pjno = !isset($_GET['projectno']) || trim($_GET['projectno']) === '' ? '' : trim($_GET['projectno']);
    if($pjno === "")
    {
        header("HTTP/1.0 400 bad Request");
        echo response("0","Enter Project Number");
        exit;
    }
    $sql = "SELECT count(ct_id) as totcount FROM pms_cuttinglist where ctprojectno= :ctprojectno";
    $cm = $cn->prepare($sql);
    $cm->bindParam(':ctprojectno',$pjno);
    $cm->execute();
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    $cnt = $rows['totcount'];
    unset($cm,$sql,$rows);
    header("HTTP/1.0 200 ok");
    echo response("1",$cnt);
    exit;
?>