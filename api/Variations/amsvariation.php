<?php 
    require_once '../_def.php';
    if($_SERVER['REQUEST_METHOD'] === "POST"){       
        extract($_POST);
        if(!isset($projectno) || $projectno === ""){
            echo response("0","PORJECT NUMBER IS MISSING");
        }else{  
            $pjno = strtolower($projectno);
            include_once '../../connection/connection.php';
            $conn = new connection();
            $cn = $conn->connect();

            include_once('../../controller/Variations.php');
            $variation = new Variations($cn);
            $res = json_decode($variation->AllVariations($projectno));
           // $epjno = $pr->enc('enc',$pjno);
          
            echo response("1",$res);
        }
    }else{
        echo response("0","REQUEST METHOD ERROR.");
    }
   
?>