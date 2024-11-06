<?php 
    if (!isset($mtbl)) {
        include_once '../_error.php';
        exit;
    }

    if(!isset($loadproject) || trim($loadproject) === ""){
        echo response("0","Enter Project name");exit;
    }

    echo $mtbl->getRptByProject($loadproject);
    exit;
?>