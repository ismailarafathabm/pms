<?php 
    include_once('../_def.php');
    $auth = true;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents("php://input"));
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();
        include_once('../../controller/User.php');
        $user = new User($db);        
        include_once('../_auth.php');
        if($auth === true){           
            if(!isset($data->meas->meas_project) || $data->meas->meas_project === ""){
                echo response("0","Enter Project Informations");
            }else if(!isset($data->meas->meas_boq) || $data->meas->meas_boq === ""){
                echo response("0", "Choose Any BOQ ITME....");
            }else if (!isset($data->meas->meas_width) || $data->meas->meas_width === "" || !is_numeric($data->meas->meas_width)) {
                echo response("0", "Enter Width with Currect format....");  
            }else if (!isset($data->meas->meas_height) || $data->meas->meas_height === "" || !is_numeric($data->meas->meas_width)) {
                echo response("0", "Enter Height with Currect format....");  
            }else if (!isset($data->meas->meas_remark) || $data->meas->meas_remark === "") {
                echo response("0", "Fill All informations...");  
            }else{
                $_s = array(
                    'meas_project' => $data->meas->meas_project,
                    'meas_boq' => $data->meas->meas_boq,
                    'meas_width' => $data->meas->meas_width,
                    'meas_height' => $data->meas->meas_height,
                    'meas_remark' => $data->meas->meas_remark,
                );

                include_once('../../controller/Projects.php');
                $Projects = new Projects($db);
                echo $Projects->new_meas($_s);

            }
        }else{
            echo response('0',"Access Error");
        }
    }else{
        echo response("0","response error");
    }
?>