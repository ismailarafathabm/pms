<?php 
    include_once('../../_def.php');
    $auth = true;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));        
        
        include_once('../../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();  
        include_once('../../../controller/User.php');
        $user = new User($db);
        include_once('../../_auth.php');
        if($auth === true){
            if(!isset($data->notesprojectcode) || $data->notesprojectcode === ''){
                echo response("0", "Select Any Project and try");
            }else{
                include_once('../../../controller/boqitems.php');
                $boqitems = new Boqitems($db);
                echo $boqitems->BoqItemsAll($data->notesprojectcode);
            }            
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
