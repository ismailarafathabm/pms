<?php 
    require_once '../_def.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){   
        extract($_POST);
        if(!isset($projectno) || $projectno === ""){
            echo response("0","PORJECT NUMBER IS MISSING");
        }else if(!isset($project_refno) || $project_refno === ""){
            echo response("0","PORJECT REFERANCE NUMBER IS MISSING");
        }else if(!isset($project_reviewno) || $project_reviewno === ""){
            echo response("0","PORJECT REVISION NUMBER IS MISSING");
        }else{
            $project_no = strtolower($projectno);
            include_once '../../connection/connection.php';
            $conn = new connection();
            $cn = $conn->connect();
            include_once('../../controller/Projects.php');
            $Projects = new Projects($cn);
            echo $Projects->all_boqs($project_no,$project_refno,$project_reviewno);     
        }
    }else{
        echo response("0","REQUEST METHOD ERROR.");
    }
     
?>