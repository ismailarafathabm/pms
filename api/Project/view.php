<?php 
    include_once('../_def.php');
    $auth = true;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));
        //echo $data->_frmdata->project_no;
        //print_r($data);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();  
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
        if($auth === true){
            if($data->project_no){
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "DASHBOARD",
                    "ACTION" => "GER PROJECT INFROMATION - " . $user->enc('denc',$data->project_no),
                    "API_PAGE" => "api/Project/view.php",
                    "msg" => "-"
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "READ",
                    'log_token' => $data->naf_user->user_token
                );
                include_once '../../controller/log.php';
               


                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                $prno = $project->enc('denc',$data->project_no);
                echo $project->getProjectinfo($prno);
            }else{
                echo response("0","Enter Project Number");
            }            
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }
?>