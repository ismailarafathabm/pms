<?php 
    include_once('../_def.php');
    $auth = true;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();
        include_once('../../controller/User.php');
        $user = new User($cn);
        include_once('../_auth.php');
        if($auth === true) {
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "PPWORK",
                "ACTION" => "GET ALL PAINT PALANT REPORT",
                "API_PAGE" => "api/ppworknew/allpp.php",
                "msg" => "-"
            );
            $_log = array(
                'log_user' => $user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "READ",
                'log_token' => $data->naf_user->user_token
            );
            // include_once '../../controller/log.php';
            // $log = new LOG($cn);
            // $log->save_log($_log);

            require_once '../../controller/ppworknew.php';
            $PPwork = new PPWorkNew($cn);
            echo $PPwork->GetAllWo();
        }
        else{
            echo response("404", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
