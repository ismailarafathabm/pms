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
            if(!isset($data->terms_id) || $data->terms_id === ""){
                echo response("0","Project Informations Missing");
            }else if(!isset($data->projectname) || $data->projectname === ""){
                echo response("0","Enter Specification");
            }            
            else{      
                $xmsg = getOldTermsinfos($db,$data->terms_id,$user);    
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "TERMS REMOVE",
                    "ACTION" => "REMOVED TERMS AND CONDITIONS",
                    "API_PAGE" => "api/Project/terms_remove.php",
                    "msg" => $xmsg 
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "DELETE",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
                // $log->save_log($_log);

                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                echo $project->terms_delete($data->terms_id,$data->projectname);
            }           
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }


    function getOldTermsinfos($cn,$sno,$enc){
        $sql = "SELECT *FROM project_payment_terms where payment_terms_id=:payment_terms_id";
        $cm = $cn->prepare($sql);
        $params = array(
            ':payment_terms_id' => $sno,
        );
        $cm->execute($params);
        $rows = $cm->fetch(PDO::FETCH_ASSOC);

        $rt = $enc->enc('enc',$rows['payment_terms_id']);
        $rt .= "-";
        $rt .= $enc->enc('enc',$rows['payment_terms_descripton']);
        $rt .= "-";
        $rt .= $enc->enc('enc',$rows['payment_terms_project']);
        $rt .= "-";
        $rt .= $enc->enc('enc',$rows['payment_terms_number']);

        unset($cm,$sql,$rows);
        return $rt;
        
    }
?>