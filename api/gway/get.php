<?php
  header("Content-Type:text/json");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
include_once('../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();
//print_r($_GET);
include_once('../../controller/Projects.php');
$p = new Projects($db);
if(isset($_GET['projectno']) && $_GET['projectno']!==''){
  echo $p->Gway_Project_infos($_GET['projectno'],$_GET['pname']);
}else{
    $response = array("msg" => "0" , "data" => "Select Any Project");
    echo json_encode($response);
}
