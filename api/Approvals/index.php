<?php
    include_once('../_def.php');
    $auth = true;
    
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = json_decode(file_get_contents("php://input"));
       
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
        if ($auth === true) {
            $_msg = array(

                "status" => "OK",
                "PAGEID" => "APPROVEL",
                "ACTION" => "GET ALL APPROVALS",
                "API_PAGE" => "api/Approvals/index.php",
                "msg" => "USER GET ALL APPROVALS"
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "READ",
                'log_token' => $data->naf_user->user_token
            );
            include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);

            include_once('../../controller/Project_approvals.php');
            $ProjectApprovals = new ProjectApprovals($db);
            echo $ProjectApprovals->all_approvals();
        } else {
            _errorlog("Access Error",$data->naf_user->user_name,$data->naf_user->user_token,$db);
            echo response("0", "Access Error");
        }
    } else {
        _errorlog("Request Error",'','',$db);
        echo response("0", "Request Error");
    }


    function _errorlog($msg,$user_name,$user_token,$db){
        $_msg = array(
            "status" => "error",
            "PAGEID" => "APPROVEL",
            "ACTION" => "TRY TO GET ALL APPROVALS",
            "API_PAGE" => "api/Approvals/index.php",
            "msg" => $msg
        );
        $_log = array(
            'log_user' => $user_name,
            'log_time' => date('Y-m-d H:i:s'),
            'log_descripton' => json_encode($_msg),
            'log_action' => "READ",
            'log_token' => $user_token
        );
        include_once '../../controller/log.php';
        // $log = new LOG($db);
        // $log->save_log($_log);
    }