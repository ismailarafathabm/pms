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
            else if(!isset($data->token) || $data->token === ""){
                echo response("0","Approval Number Missing...");
            }
            else{
                $_msg = array(

                    "status" => "OK",
                    "PAGEID" => "APPROVEL",
                    "ACTION" => "GET ALL APPROVALS FOR PROJECT",
                    "API_PAGE" => "api/Approvals/index.php",
                    "msg" => "USER GET ALL APPROVALS FOR PROJECT " . $data->project_no
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

                include_once('../../controller/Project_approvals.php');
                $ProjectApprovals = new ProjectApprovals($db);
                echo $ProjectApprovals->project_approvals($data->project_no,$data->token);            
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>