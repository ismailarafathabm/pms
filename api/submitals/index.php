<?php 
    if(!isset($ts)){
        include_once '../_error.php';
        exit;
    }

    switch($fun){
        default:
        header("HTTP/1.0 400 Bad Request");
        echo response("0","Page Not found");
        exit;
        case 'savets':
            include_once 'savets.php';
            exit;
        case 'saveds':
            include_once 'saveds.php';
            exit;
        case 'updatets':
            include_once 'updatets.php';
            exit;
        case 'getts_p':
            if(!isset($techsub_project) || trim($techsub_project) === ''){
                echo response("0","Select Any Projects");
                exit;
            }
            echo $ts->techsubmitalbyproject($techsub_project);
            exit;
        case 'printts':
            if(!isset($techsub_id) || trim($techsub_id) === ''){
                echo response("0","Input Missing");
                exit;
            }
            echo $ts->getTechnicalSubmittalinfo($techsub_id);
        exit;
        
        case 'updatetsstatus':
            include_once 'updatetsstatus.php';
            exit;
        case 'getds':
            if(!isset($ds_project) || trim($ds_project) === ""){
                echo response("0","Enter Project Name");
                exit;
            }
            echo $ts->GetAllProjectDrawingSubmittals($ds_project);
            exit;
        case 'sd_update':
            include_once './updatestatus_sd.php';
            exit;
        case 'getinfods':
            if(!isset($sno) || trim($sno) === ""){
                header("HTTP/1.0 400 bad request");
                echo response("0","Select Any Data");
            }
            echo $ts->getShopdrwingsubmittalinfo($sno);
            exit;
    }
