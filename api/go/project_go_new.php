<?php 
    if (!isset($go)) {
        include_once '../_error.php';
        exit;
    }
    if(!isset($gono) || trim($gono) === ""){
        echo response('0',"Enter Glass Order Number");
        exit;
    }

    if(!isset($godoneby) || trim($godoneby) === ""){
        echo response('0',"Enter Glass Order Done By");
        exit;
    }

    if(!isset($goreldate) || trim($goreldate) === ""){
        echo response('0',"Enter Glass Order Released Date");
        exit;
    }

    if(!date_create($goreldate)){
        echo response("0","Released Date not valid date format");
        exit;
    }

    if(!isset($gosupplier) || trim($gosupplier) === ""){
        echo response('0',"Select Any Suppleir");
        exit;
    }

    if(!isset($goglasstype) || trim($goglasstype) === ""){
        echo response('0',"Enter Glass  Type");
        exit;
    }

    if(!isset($goglassspc) || trim($goglassspc) === ""){
        echo response('0',"Enter Glass Specification");
        exit;
    }

    if(!isset($goglassthickness) || trim($goglassthickness) === ""){
        echo response('0',"Enter Glass Thickness");
        exit;
    }

    if(!isset($gomarkinglocation) || trim($gomarkinglocation) === ""){
        echo response('0',"Enter Marking Location Informations");
        exit;
    }

    if(!isset($goglassqty) || trim($goglassqty) === ""){
        echo response('0',"Enter Glass Qty");
        exit;
    }

    if(!is_numeric($goglassqty)){
        echo response('0',"Qty Not valid format");
        exit;
    }

    if(!isset($goremark) || trim($goremark) === ""){
        echo response('0',"Enter Remark");
        exit;
    }

    if(!isset($gotype) || trim($gotype) === ""){
        echo response('0',"Enter Glass Order Type");
        exit;
    }

    if(!isset($goproject) || trim($goproject) === ""){
        echo response('0',"Select Any Project");
        exit;
    }

    if(!isset($gostatus) || trim($gostatus) === ""){
        echo response('0',"Select Status");
        exit;
    }
    $_gorcdate = date('Y-m-d');
    if($gostatus === 'ordered'){
        if(!isset($gorcdate) || trim($gorcdate) === ""){
            echo response('0',"Enter Return Date");
            exit;
        }
        if(!date_create($gorcdate)){
            echo response("0","Return Date not valid date format");
            exit;
        }

        $_gorcdate = date_format(date_create($gorcdate),'Y-m-d');
    }
    $username = $user_name;
    //echo $_gorcdate;
    $cdate = date('Y-m-d H:i:s');
    $params = array(
        ':gono' => $gono,
        ':godoneby' => $godoneby,
        ':goreldate' => date_format(date_create($goreldate),'Y-m-d'),
        ':gorcdate' => $_gorcdate,
        ':gosupplier' => $gosupplier,
        ':goglasstype' => $goglasstype,
        ':goglassspc' => $goglassspc,
        ':goglassthickness' => $goglassthickness,
        ':gomarkinglocation' => $gomarkinglocation,
        ':goglassqty' => $goglassqty,
        ':goremark' => $goremark,
        ':goby' => $username,
        ':goedit' => $username,
        ':gocdate' => $cdate,
        ':goeditdate' => $cdate,
        ':godate' => date("Y-m-d"),
        ':gotype' => $gotype,
        ':goproject' => $goproject,
        ':gostatus' => $gostatus,
    );

    echo $go->saveGo($params);
    exit;

?>