<?php 
 header("Content-Type:text/json");
 header("Access-Control-Allow-Origin: *");
 $res = array(
     "msg" => "0",
     "data" => "406 - Access Error - Invalid Entry"
 );
 echo json_encode($res);
 
?>