<?php 
    if (!isset($mtbl)) {
        include_once '../_error.php';
        exit;
    }
    if (!isset($loadid) || trim($loadid) === "") {
        echo response("0", "Enter Token");
        exit;
    }
    echo $mtbl->GetInfoWithToken($loadid);
    exit;
?>