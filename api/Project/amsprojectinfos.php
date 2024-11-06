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

            include_once '../../controller/Projects.php';
            $pr = new Projects($cn);
           // $epjno = $pr->enc('enc',$pjno);
            $spec = json_decode($pr->get_all_spc($pjno));
            $condition = json_decode($pr->get_conditions($pjno));
            $terms =  json_decode($pr->get_terms($pjno));
            $infos = json_decode($pr->getProjectinfo($pjno));

            $res = array(
                'infos' => $infos,
                'condition' => $condition,
                'spec' => $spec,
                'terms' => $terms
            );
            echo response("1",$res);
        }
    }else{
        echo response("0","REQUEST METHOD ERROR.");
    }
   
?>