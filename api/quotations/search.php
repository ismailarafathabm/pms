<?php 
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();   
        if(isset($user_name) && isset($user_token)){    
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
            $user = new User($cn);
            include_once('../_auth.php');
        } 
        if ($auth === true) {
            if(!isset($seach_projectname) || $seach_projectname === ''){
                echo response("0", "Enter Project Name");  
            }else{
                include_once '../../controller/Quotations.php';
                $quot = new Quotations($cn);
                $_seach_projectname = $quot->enc('enc',strtolower($seach_projectname));
                echo $quot->CheckAlreadyProjectInList($_seach_projectname);
            }
        }else{
            echo response("404", "Access Error");    
        }
    }else{
        echo response("0","Request Error");
    }
    
?>