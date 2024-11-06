<?php 
    if(!isset($ml)) { include_once '../../_error.php';exit;  }
    if(!isset($tradename) || trim($tradename) === "") { echo response("0","Select Any System");  exit;}
    echo $ml->TradeInfoGet($systemname);
?>