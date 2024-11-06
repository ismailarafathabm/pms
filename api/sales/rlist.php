<?php 
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    //print_r($_POST);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();    
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
        $user = new User($db);
        include_once('../_auth.php');
    }

    if($auth){
        include_once '../../controller/Quotations.php';
        $qu = new Quotations($db);
        if(!isset($qid) || $qid === ''){
            echo response("0","Enter Quotation ID");
        }else{
            echo $qu->GetRevisionsList($qid);
        }
        
    }else{
        echo response("404", "Access Error");
    }
}else{
    echo response("0","Request Error");
}
?>