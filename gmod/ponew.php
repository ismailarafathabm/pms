<?php 
    require_once '../connection/connection.php';
    require_once '../controller/mac.php';
    $con = new connection();
    $cn = $con->connect();
    $enc = new mac();

    $sql = "SELECT ponewproject from pms_ponew where ponewtype = 'Glass' group by ponewproject";
    $projects = [];
    $cm = $cn->prepare($sql);
    $cm->execute();
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        $projects[] = $rows['ponewproject'];        
    }
    unset($cm,$sql,$rows);

    //print_r($projects);
    foreach($projects as $p){
        $sql = "SELECT *FROM pms_project_summary where project_id = $p";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $project_no = strtoupper($enc->enc('denc',$rows['project_no']));
        $project_name = ucwords(strtolower($enc->enc('denc',$rows['project_name'])));
        $project_location = ucwords(strtolower($enc->enc('denc',$rows['project_location'])));

        //start update actions

        $sql = "UPDATE pms_ponew set projectno='$project_no',projectname='$project_name',projectlocation='$project_location' where ponewproject=$p";
        $cm = $cn->prepare($sql);
        $sv= $cm->execute();

        unset($rows,$cm,$sql);  
        echo $project_no ;
        echo "-";
        echo $project_name ;
        echo "-";
        echo $project_location ;
        echo "-";
        echo $sv ? "UPDATED" : "ERROR";
        echo "<br/>";
        
    }
    
    exit();

?>