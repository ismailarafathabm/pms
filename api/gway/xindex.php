<?php 
  header("Content-Type:text/json");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
    include_once('../controller/Projects.php');
    $p = new Projects($cn);
    echo $p->Gway_Projects();
?>