<?php 
    header("content-Type:text/json");
    include_once('../connection/connection.php');
    $conn = new connection();
    $cn = $conn->connect();

    // include_once('Projects.php');
    // $project = new Projects($cn);

    extract($_GET);
    if(!isset($values) || $values === ''){

    }else{
        include('DrawingApprovals/DrawingApprovals.php');
        $DrawingApprovals = new DrawingApprovals($cn);
        //echo $DrawingApprovals->new_typs('sdmoe');
        echo $DrawingApprovals->all_type();
    }
    
?>