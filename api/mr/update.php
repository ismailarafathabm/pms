<?php 
    if(!isset($mr)){
        include_once '../_error.php';
        exit;
    }    
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $payload = json_decode($_POST['payload']);
    $project = $_POST['projectno'];
    $mrno = $_POST['mrno'];
    $params = array(
        ":mritem" => $payload->mritem,
        ":mrpartno" => $payload->mrpartno,
        ":mrpartnotai" => $payload->mrpartnotai,
        ":mrdieweight" => $payload->mrdieweight,
        ":mrreqlength" => $payload->mrreqlength,
        ":mrreqqty" => $payload->mrreqqty,
        ":mrreqtotweight" => $payload->mrreqtotweight,
        ":mravaiqty" => $payload->mravaiqty,
        ":mraviweight" => $payload->mraviweight,
        ":mrorderedqty" => $payload->mrorderedqty,
        ":mrorderedweight" => $payload->mrorderedweight,
        ":mreby" =>  $uuser,
        ":mredate" => $ddate,
        ":mrfinish" => $payload->mrfinish,
        ":mrremarks" => $payload->mrremarks,
        ":mrunit" => $payload->mrunit,
        ":mrid" => $payload->mrid,
    );

    echo $mr->UpdateMR($params,$project,$mrno);
?>