<?php 
    //print_r($_POST);
    if(!isset($user_name) || trim($user_name) === ""){
        $auth = false;
        $_data = "user information Missing";
    }
    else if(!isset($user_token) || trim($user_token) === ""){
        $auth = false;
        $_data = "user information Missing";
    }else{        
        $api_user_info = json_decode($user->api_login($user_name,$user_token));
        if($api_user_info->msg === "0"){
            $auth = false;
            $_data = "Authorization  Error";
        }else{
            if($api_user_info->data->user_status !== "active"){
                $auth = false;
                $_data = "Your Account Blocked";
            }else{
                $auth = true;
            }
           
        }
    }
    
