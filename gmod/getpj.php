<?php 
    $sno = !isset($_GET["id"]) || trim($_GET["id"]) === "" ? "0" : $_GET["id"];
   require_once './../connection/connection.php';
    $con = new connection();
    $cn = $con->connect();

    require_once './../controller/mac.php';
    $enc = new mac();

    $sql = "SELECT *FROM pms_project_summary where project_id = :project_id";
    $cm = $cn->prepare($sql);
    $cm->bindParam(":project_id",$sno);
    $cm->execute();
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    echO $enc->enc('denc',$rows["project_no"]); 
    echo "<br/>";
    echo $enc->enc('denc',$rows["project_name"]);
    echo "<br/>";

    echo "------------------------------------------"
?>