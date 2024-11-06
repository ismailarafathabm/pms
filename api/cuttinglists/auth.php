<?php 
    $req_headers = apache_request_headers();
    $req_token = !isset($req_headers['Token']) || trim($req_headers['Token']) === '' ? '' : trim($req_headers['Token']);
    $auth_info = explode(' ',$req_token);
    if(count($auth_info) !== 2){
        header("http/1.0 401 Authendication Error");
        echo response('0',"UNAUTHORIZED");
        exit;
    }
    $uuser = $auth_info[0];
    include_once '../../controller/User.php';
    $user = new User($cn);
    $api_user_info = json_decode($user->api_login($auth_info[0],$auth_info[1]));
    if($api_user_info->msg === "0"){
        header("http/1.0 401 Authendication Error");
        echo response('0',"UNAUTHORIZED");
        exit;
    }
    if($api_user_info->data->user_status !== "active"){
        header("http/1.0 401 Authendication Error");
        echo response('0',"UNAUTHORIZED - You Account Not Active.");
        exit;        
    }
    //$apiuser = 

?>