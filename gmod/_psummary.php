<?php 
     require_once '../connection/connection.php';
     require_once '../controller/mac.php';
      $con = new connection();
      $cn = $con->connect();    
      $enc = new mac();

      $sql = "SELECT *from pms_project_summary";
      $cm = $cn->prepare($sql);
      $cm->execute();
    $datas = [];
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        $data = array(
            ":project_id" => $rows['project_id'],
            ":nname" => strtoupper($enc->enc('denc',$rows['project_no']))
        );
        $datas[] = $data;
    }
    unset($cm,$sql,$rows);

    print_r($datas);

    // foreach($datas as $d){
    //     $sql = "UPDATE pms_project_summary set project_link = :nname where project_id = :project_id";
    //     $cm = $cn->prepare($sql);
    //     $issave = $cm->execute($d);
    //     echo $d[":nname"];
    //     echo $issave ? "YES" : "NO";
    //     echo "----------------------";
    //     unset($cm,$sql);
    // }
?>