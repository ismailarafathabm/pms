<?php 
    require_once '../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();

    require_once '../controller/mac.php';
    $enc = new mac();

    //bom_finish

    $sql = "SELECT itemunit from bom_items group by itemunit";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        $alloy[] = $rows['itemunit'];
    }
    unset($cm,$sql,$rows);

    foreach($alloy as $a){
        echo $a;
        // $sql = "INSERT INTO bom_units  values(null,:unitname)";
        // $cm = $cn->prepare($sql);
        // $cm->bindParam(":unitname",$a);
        // //$cm->execute();
        echo "-OK - <br/>";
        //unset($cm,$sql);
    }
?>