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
            }
            else if(!isset($data->project_refno) || $data->project_refno === ""){
                echo response("0","Enter BOQ Ref-No");
            }
            else if(!isset($data->project_reviewno) || $data->project_reviewno === ""){
                echo response("0","Enter BOQ Review No.");
            }else{
                include_once('../../controller/Projects.php');
                $Projects = new Projects($db);
                echo $Projects->all_boqs($data->project_no,$data->project_refno,$data->project_reviewno);            
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>