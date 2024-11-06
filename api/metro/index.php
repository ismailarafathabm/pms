<?php 
    if(!isset($metro)){
        include_once '../_error.php';
        exit;
    }

    switch($fun){
        default : 
        header("HTTP/1.0 404 Function not found");
        echo response("0","Page Not Found");
        die();
        case 'techapprovals':
            echo $metro->AllMetroTechnicalApprovals();
            exit;
        case 'metroprojects':
            echo $metro->GetMetroProject();
            exit;
        case 'drawingapprovals':
            echo $metro->MetroDrawingApprovals();
            exit;

    }
?>