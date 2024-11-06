<?php 
    require_once '../_def.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        extract($_POST);
        if(!isset($projectno) || $projectno === ""){
            echo response("0","Project Number Missing");
        }else{
            
            require_once '../../connection/connection.php';
            $conn = new connection();
            $cn = $conn->connect();
            
            require_once '../../controller/Project_approvals.php';
            $approvals = new ProjectApprovals($cn);
            echo $approvals->all_project_approvals($projectno);
            
        }
    }else{  
        echo response("0","REQUEST METHOD ERROR.");
    }
?>