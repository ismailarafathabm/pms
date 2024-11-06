<?php 
   require_once './../connection/connection.php';
   $con = new connection();
   $cn = $con->connect();

   require_once './../controller/mac.php';
   $enc = new mac();
   $pjcno = $enc->enc('enc',"p07/22");
   $sql = "SELECT project_name From pms_project_summary where project_no='$pjcno'";
   // $cm = $cn->prepare($sql);
   // $cm->execute();
   // $rows = $cm->fetch();
   // echo "Projct Name : ". $enc->enc('denc',$rows['project_name']);
   // unset($cm,$sql,$rows);
   // $nwname = $enc->enc('enc',"Riyadh Metro Station 2E1, West Stabling , 1H2PRO");

   $sql = "UPDATE pms_project_summary set project_name='$nwname' where project_no='$pjcno' limit 1";
   // $cm = $cn->prepare($sql);
   // $sv = $cm->execute() ? "OK" : "ERROR";
   // echo "<br/>";
   // echo "UPDATE STATUS : ". $sv;
   // unset($cm,$sql,$rows);
?>