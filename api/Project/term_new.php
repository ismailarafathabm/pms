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
            if(!isset($data->terms_add_new) || $data->terms_add_new === ""){
                echo response("0","Project Informations Missing");
            }else if(!isset($data->projectname) || $data->projectname === ""){
                echo response("0","Enter Specification");
            }            
            else{           
                $a = array(
                    'descriptioin' => $data->terms_add_new,
                    'projectname' => $data->projectname,
                    'id' => $data->payment_terms_number,
                );
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "PROJECT TERMS",
                    "ACTION" => "NEW PROJECT TERMS",
                    "API_PAGE" => "api/Project/term_new.php",
                    "msg" => json_encode($a)
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "NEW",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
                // $log->save_log($_log);

                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                echo $project->terms_save($data->terms_add_new,$data->projectname,$data->payment_terms_number);
            }           
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>