<?php 
   require_once '../connection/connection.php';
   require_once '../controller/mac.php';
    $con = new connection();
    $cn = $con->connect();    
    $enc = new mac();
    //$prcode = $enc->enc('enc','p12/22');
    $sql = "SELECT poq_project_code,poq_item_no,COUNT(*) as num from  pms_poq  group by poq_project_code,poq_item_no having num > 1";
    $cm = $cn->prepare($sql);
    //$cm->bindParam(":poq_project_code",$prcode);
    $cm->execute();
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        echo $enc->enc('denc',$rows['poq_project_code']);
        echo "||";
        echo $enc->enc('denc',$rows['poq_item_no']);
        echo "||";
        echo $rows['num'];
        echo "||";
        echo "</br>";
    }
    unset($cm,$sql,$rows);
    unset($cn);

?>