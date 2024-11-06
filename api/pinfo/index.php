<?php 
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();
        if (isset($user_name) && isset($user_token)) {
            $naf_user = array(
                'user_name' => $user_name,
                'user_token' => $user_token
            );
            $datas = array(
                'naf_user' => $naf_user
            );
            $s = json_encode($datas);
            $data = json_decode($s);
    
            include_once('../../controller/User.php');
            $user = new User($db);
            include_once('../_auth.php');
        }

        if($auth){
            require_once '../../controller/projectinfos.php';
            $pr = new ProjectInfo($db);
            echo $pr->ProjectDashboard();
        }else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
?>