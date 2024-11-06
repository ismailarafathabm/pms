<?php 
    if(!isset($appt)){
        include_once '../_error.php';
        exit;
    };

    switch($fun){
        default : 
        header("HTTP/1.1 404 Function Not Found");
        echo response("0","Function Not Found");        
        die();
        case 'getall':
            echo $appt->all_approval_type();
        break;
        case 'new':
            if(!isset($approval_type_name) || trim($approval_type_name) === ""){
                echo response("0","Enter Approval Name");
                exit;
            }
            echo $appt->new_approval_type($approval_type_name);
            exit;
    }
?>