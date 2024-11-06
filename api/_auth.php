<?php 
    if(!isset($data->naf_user->user_name)){
        $auth = false;
        $_data = "user information Missing";
    }else if(!isset($data->naf_user->user_token)){
        $auth = false;
        $_data = "user information Missing";
    }else if($data->naf_user->user_name === ""){
        $auth = false;
        $_data = "user information Missing";
    }else if($data->naf_user->user_token == ""){
        $auth = false;
        $_data = "user information Missing";
    }else{

        $api_user_info = json_decode($user->api_login($data->naf_user->user_name,$data->naf_user->user_token));
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
