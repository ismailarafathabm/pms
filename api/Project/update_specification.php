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
            if(!isset($data->edit_info->spec_project) || $data->edit_info->spec_project === "" ){
                echo response("0","Project Informations Missing");
            }else if(!isset($data->edit_info->spec_id) || $data->edit_info->spec_id === ""){
                echo response("0","Choose Any Specification");
            }
            else if(!isset($data->edit_info->spec_remark) || $data->edit_info->spec_remark === ""){
                echo response("0","Input Missing");
            }else{
                $xxmsg = "PREVIOUS : " . json_encode(getSpecification($cn,$data->edit_info->spec_id,$user));
                $n = array(
                    'spec_project' => $spec_project,
                    'spec_id' => $spec_id,
                    'spec_remark' => $spec_remark,
                );
                $xxmsg .= " CURRENT : " . json_encode($n);
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "DASHBOARD",
                    "ACTION" => "GET ALL PROJECT INFORMATIONS",
                    "API_PAGE" => "api/Project/index.php",
                    "msg" => $xxmsg 
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "READ",
                    'log_token' => $data->naf_user->user_token
                );
                
                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                $_p = $project->enc('denc', $data->edit_info->spec_project);
                echo $project->update_specification($data->edit_info->spec_id, $data->edit_info->spec_project,$data->edit_info->spec_remark);
            }
        }else{
            echo response("0","Access Error");
        }
    }else{
        echo response("0","Request Error");
    }

    function getSpecification($cn,$id,$enc){
        $sql = "SELECT *FROM pms_project_specification where spec_id=:spec_id";
        $cm = $cn->prepare($sql);
        $params = array(
            ':spec_id' => $id
        );
        $cm->execute($params);
        
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $infos = array(
            'spec_id' => $rows['spec_id'],
            'spec_project' => $enc->enc('denc',$rows['spec_project']),
            'spec_remark' => $enc->enc('denc',$rows['spec_remark']),
            'spec_type' => $enc->enc('denc',$rows['spec_type']),
            'spec_type_sub' => $enc->enc('denc',$rows['spec_type_sub']),
        );
        unset($cm,$sql);
        return $infos;

    }
?>