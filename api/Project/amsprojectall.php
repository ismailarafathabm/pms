<?php 
    require_once '../_def.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();  
        include_once('../../controller/Projects.php');
        $project = new Projects($db);
        echo $project->getAllProjectlist();
    }else{
        echo response("0","CHECK REQUEST METHOD");
    }
?>