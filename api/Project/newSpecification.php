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
            if(!isset($data->new_spec->spec_project) || $data->new_spec->spec_project === ""){
                echo response("0","Project Informations Missing");
            }else if(!isset($data->new_spec->spec_remark) || $data->new_spec->spec_remark === ""){
                echo response("0","Enter Specification");
            }            
            else if(!isset($data->new_spec->spec_type) || $data->new_spec->spec_type === ""){
                echo response("0","Some Inputs Error contact Developer");
            }            
            else if(!isset($data->new_spec->spec_type_sub) || $data->new_spec->spec_type_sub === ""){
                echo response("0","Some Inputs Error contact Developer");
            }else{
                
                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                $_p = $project->enc('denc', $data->new_spec->spec_project);
                $_svdata = array(
                    "spec_project" =>$_p ,
                    "spec_remark" => $data->new_spec->spec_remark,
                    "spec_type" => $data->new_spec->spec_type,
                    "spec_type_sub" => $data->new_spec->spec_type_sub
                );

                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "SPECIFICATION",
                    "ACTION" => "ADDED NEW PROJECT SPECIFICATION",
                    "API_PAGE" => "api/Project/newSpecification.php",
                    "msg" => json_encode($_svdata)
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


                echo $project->new_specification($_svdata);
            }           
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>