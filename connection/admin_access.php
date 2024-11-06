<?php
    include_once('../controller/mac.php');
    $mac = new mac();
    extract($_GET);
    //print_r($_GET);
    if(isset($method,$values)){
        switch($method){
            case 'enc':
                echo $mac->enc('enc',$values);
            break;
            case 'denc':
                echo $mac->enc('denc',$values);
            break;
        }
    }

    // $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    // echo $hostname; 
    
?>