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
            else if(!isset($data->boq_item_no) || $data->boq_item_no === ""){
                echo response("0","Choose Boq ITEM Number");
            }
            else if(!isset($data->boq_notes) || $data->boq_notes === ""){
                echo response("0", "Enter BOQ Notes");
            }
            else{
                include_once('../../controller/Projects.php');
                $Projects = new Projects($db);
                $specifiction_info = array(
                    'boq_note_project' => $data->project_no,
                    'boq_note_itemno' => $data->boq_item_no,
                    'boq_note_notes' => $data->boq_notes
                );
                echo $Projects->new_boq_notes($specifiction_info);            
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
