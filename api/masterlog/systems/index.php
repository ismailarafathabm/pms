<?php 
    if(!isset($ml)) { include_once '../../_error.php';exit;  }
    if(!isset($systemname) || trim($systemname) === "") { echo response("0","Select Any System");  exit;}
    echo $ml->SystemGet($systemname);
?>