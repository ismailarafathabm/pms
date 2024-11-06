<?php
require_once '../connection/connection.php';
require_once '../controller/mac.php';
$con = new connection();
$cn = $con->connect();
$enc = new mac();

$sql = "SELECT *FROM pms_glasstypes";
$cm = $cn->prepare($sql);
$cm->execute();
while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    echo $enc->enc('denc',$rows['glasstype_name']);
    echo "<br/>";
}
