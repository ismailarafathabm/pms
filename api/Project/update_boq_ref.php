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
                echo response("0","Enter Project Number");
            }
            else if(!isset($data->boq_refno) || $data->boq_refno === ""){
                echo response("0","Enter Project Number");
            }else if(!isset($data->boq_revision) || $data->boq_revision === ""){
                echo response("0","Enter Project Number");
            }else{

                $xmsg = "$data->project_no";
                $xmsg .= "REFERANCE NO : $data->boq_refno";
                $xmsg .= "REVISION NUMBER : $data->boq_revision";
                
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "TERMS",
                    "ACTION" => "GET ALL ",
                    "API_PAGE" => "api/Project/update_boq_ref.php",
                    "msg" => $xmsg
                );

                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "READ",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
                // $log->save_log($_log);
                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                echo $project->boq_ref_update($data->project_no,$data->boq_refno,$data->boq_revision);
            }                    
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>