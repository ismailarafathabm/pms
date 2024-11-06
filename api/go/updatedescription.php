<?php 
    if(!isset($go)){
        include_once '../_error.php';
        exit;
    }
    if(!isset($glassdescriptoinsid) || trim($glassdescriptoinsid) === ""){
        echo response("0","Enter Id");
        exit;
    }

    if(!isset($glassdescriptoinstype) || trim($glassdescriptoinstype) === ""){
        echo response("0","Enter Type");
        exit;
    }
    if(!isset($glassdescriptoinsspec) || trim($glassdescriptoinsspec) === ""){
        echo response("0","Enter Specification");
        exit;
    }
    if(!isset($gdesriptionsortfrm) || trim($gdesriptionsortfrm) === ""){
        echo response("0","Enter Thickness");
        exit;
    }

    $params = array(
        ":glassdescriptoinstype" => $glassdescriptoinstype,
        ":glassdescriptoinsspec" => $glassdescriptoinsspec,
        ":gdesriptionsortfrm" => $gdesriptionsortfrm,
        ":glassdescriptoinsid" => $glassdescriptoinsid,
    );

    echo $go->UpdateGlassDescription($params);
    exit;
?>