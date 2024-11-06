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
            if(!isset($data->project_no) || $data->project_no === "" ){
                echo response("0","Project Informations Missing");
            }else if(!isset($data->spec_id) || $data->spec_id === ""){
                echo response("0","Choose Any Specification");
            }else{

                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "SPECIFICATION",
                    "ACTION" => "ADD NEW SPECIFICATION TO PROJECT",
                    "API_PAGE" => "api/Project/remove_specification.php",
                    "msg" => getSpecification($db,$data->project_no,$data->spec_id,$user)
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
                $p = $project->enc('denc',$data->project_no);
                echo $project->remove_specification($data->project_no,$data->spec_id);
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }


    function getSpecification($cn,$prject,$no,$enc){
        $sql = "SELECT *FROM pms_project_specification where spec_id=:spec_id and spec_project=:spec_project";
        $cm = $cn->prepare($sql);
        $params = array(
            ':spec_id' => $no,
            ':spec_project' => $enc->enc('enc',$prject),
        );
        $cm->execute($params);
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $rt = $enc->enc('denc',$rows['spec_project']); 
        $rt .= "-";
        $rt = $enc->enc('denc',$rows['spec_remark']); 
        $rt .= "-";
        $rt .= $enc->enc('denc',$rows['spec_type']); 
        $rt .= "-";
        $rt .= $enc->enc('denc',$rows['spec_type_sub']); 
        unset($cm,$sql,$rows);
        return $rt;
    }
?>