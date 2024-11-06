<?php 
    if (!isset($mtbl)) {
        include_once '../_error.php';
        exit;
    }
    if (!isset($loadid) || trim($loadid) === "") {
        echo response("0", "Select Any ID");
        exit;
    }
    echo $mtbl->getInfo($loadid);
    exit;
?>