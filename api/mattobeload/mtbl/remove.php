<?php 
    if (!isset($mtbl)) {
        include_once '../_error.php';
        exit;
    }
    if(!isset($loadid) || trim($loadid) === ""){
        echo response("0","Enter Load Id");
        exit;
    }

    $date1 = date_format(date_create($fromdate),"Y-m-d");
    $date2 = date_format(date_create($todate),"Y-m-d");
    
    $p3 = array(
        ":st" => $date1,
        ":en" => $date2,
    );

    echo $mtbl->Remove($loadid,$p3);
