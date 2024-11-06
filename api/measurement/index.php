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
            if(!isset($data->porject_id) || $data->porject_id ===''){
                echo response("0","Enter Project ID...");
            }else{
                include_once("../../controller/Projects.php");
                $Projects = new Projects($db);
                echo $Projects->get_all_boq_meas($data->porject_id);
            }
            
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
