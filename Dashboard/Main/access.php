<?php 
    $crrentuser = $_SESSION['nafco_alu_user_name'];
    $access_mr_users = ['demo','sam','nabil','hani','john','barakth','materials','sharabathi','fidel','vonn'];
    $access_mr_menu = in_array($crrentuser,$access_mr_users);
    
    //report pages 
    
    //for user access
?>