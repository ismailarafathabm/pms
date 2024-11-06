<?php 
    include_once('../_def.php');
    $auth = false;
    $_date = "";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $data = json_decode(file_get_contents("php://input"));
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();        
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
        if($auth === true){
            if($data->user_id === ""){
                echo response("0","Enter User Id");
            }
            else if($data->newuser->user_id === ""){
                echo response("0","Enter User Id");
            }
            else if($data->newuser->user_password === ""){
                echo response("0","Enter Password");
            }
            else if($data->newuser->user_department === ""){
                echo response("0","Choose Department");
            }
            else if($data->newuser->user_type === ""){
                echo response("0","Choose Account Type");
            }
            else if($data->newuser->user_status === ""){
                echo response("0","Choose Account Status");
            }else{
                $_postdata = array(
                    "user_id" => $data->newuser->user_id,
                    "user_password" => $data->newuser->user_password,                
                    "user_department" => $data->newuser->user_department,
                    "user_type" => $data->newuser->user_type,
                    "user_status" => $data->newuser->user_status             
                );                
                echo $user->update_userinfo($_postdata);
            } 
        }else{
            echo response("0",$_data);
        }          
    }else{
        echo response("0","Request Error");
    }
