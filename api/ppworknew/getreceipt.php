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
            if(isset($ppid) && $ppid !== ""){
                
                require_once '../../controller/ppworknew.php';
                $PPwork = new PPWorkNew($cn);
                echo $PPwork->GetReceiptByid($ppid);
            }else{
                echo response("0","Some Inputs Missing, Contact Developer");
            }
        }
        else{
            echo response("404", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
