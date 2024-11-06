<?php 
    include_once('../_def.php');
    $auth = true;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));        
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();  
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
        if($auth === true){
            if(!isset($data->project_no) || $data->project_no === ""){
                echo response("0","Choose Any Project");
            }else{                
                include_once('../../controller/Project_approvals.php');
                $ProjectApprovals = new ProjectApprovals($db);
                echo $ProjectApprovals->all_project_approvals($data->project_no);            
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>