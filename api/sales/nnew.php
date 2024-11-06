<?php 
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
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
        if(!isset($quid) || $quid === ''){
            echo response("0","Some Input Missing");
        }else if(!isset($qusno) || $qusno === ''){
            echo response("0","Enter S.I number");
        }else if(!isset($qurefno) || $qurefno === ''){
            echo response("0","Enter Ref# No");
        }else if(!isset($qureceiveddate) || $qureceiveddate === ''){
            echo response("0","Enter Received Date");
        }else if(!isset($qusubmitaldate) || $qusubmitaldate === ''){
            echo response("0","Enter Submited Date");
        }else if(!isset($qusalesrep) || $qusalesrep === ''){
            echo response("0","Enter Sales Rep");
        }else if(!isset($quprojectname) || $quprojectname === ''){
            echo response("0","Enter Project Name");
        }else if(!isset($qustatus) || $qustatus === ''){
            echo response("0","Enter Status");
        }else if(!isset($qucontact) || $qucontact === '') {
            echo response("0","Enter Contact persion");
        }else if(!isset($contact_infos) || $contact_infos === '') {
            echo response("0","Enter Contact Number");
        }else if(!isset($contact_infos) || $contact_infos === '') {
            echo response("0","Enter Contact Number");
        }
        
        
        
    }else{
        echo response("404", "Access Error");
    }
}
else{
    echo response("0","Request Error");
}
?>