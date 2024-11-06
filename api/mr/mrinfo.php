<?php 
    if(!isset($mr)){
        include_once '../_error.php';
        exit;
    }

    $data = json_decode($params);
    $mrproject = !isset($data->mrproject) || trim($data->mrproject) === "" ? '' : $data->mrproject;
    $mrcode = !isset($data->mrcode) || trim($data->mrcode) === "" ? '' : $data->mrcode;
    $mrno = !isset($data->mrno) || trim($data->mrno) === "" ? '' : $data->mrno;

    if($mrproject === ""){
        echo response('0',"Select Any Project");
        exit;
    }
    if($mrcode === ""){
        echo response('0',"Enter MR Code");
        exit;
    }
    if($mrno === ""){
        echo response('0',"Enter MR NO");
        exit;
    }

    $params = array(
        ":mrproject" => $mrproject,
        ":mrcode" => $mrcode,
        ":mrno" => $mrno,
    );
    

    echo $mr->Getmrinfos($params);
    exit;

?>