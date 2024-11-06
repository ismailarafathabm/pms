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
                echo response("0","Enter terms");
            }else if(!isset($data->payment_terms_number) || $data->payment_terms_number === ""){
                echo response("0","Enter Terms Number");
            }            
            else{         

                $nw = $data->terms_add_new;
                $nw .= "-";
                $nw = $data->payment_terms_number;
                $nw .= "-";

                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "TERMS & CONDITIONS",
                    "ACTION" => "EDIT PROJECT TERM",
                    "API_PAGE" => "api/Project/term_edit.php",
                    "msg" => "OLD : ". getOldTermsinfos($db,$data->payment_terms_id,$user) . ", NEW : " .$nw
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "EDIT",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
                // $log->save_log($_log);


                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                echo $project->terms_edit($data->terms_add_new,$data->payment_terms_number, $data->payment_terms_id);
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
