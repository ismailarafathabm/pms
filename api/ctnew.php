<?php
header("Access-Control-Allow-Origin: *");
$payload = json_decode($_POST["import"]);
$sno = 0;
include_once '../connection/connection.php';
$conn = new connection();
$cn = $conn->connect();
foreach ($payload as $p) {
    $sno += 1;
    if ($sno > 14000) {
        $ct_no = $p->cuttinglistno;
        $production_flag = "0";
        $rproecution = $p->rproecution;
        if ($rproecution === "-----" || trim($rproecution) === '' || !is_numeric($rproecution)) {
            $production_flag = "0";
            $production_release = date('Y-m-d');
            $production_accept = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $rproecution;
            $date->modify("+$dayval day -1 day");
            $production_release = $date->format('Y-m-d');
            $production_accept = $date->format('Y-m-d');
            $production_flag = "3";
            
        }
        $params = array(
            ":ct_no" =>  $ct_no,
            ":production_flag" =>  $production_flag,
            ":production_returnflag" =>  $production_flag,
            ":production_release" => $production_release,
            ":production_accept" => $production_accept,
            ':ct_id' => $sno
        );
        $sql = "UPDATE pms_cuttinglist set ct_no=:ct_no,production_flag=:production_flag,production_returnflag=:production_returnflag,production_release=:production_release,production_accept =:production_accept where ct_id = :ct_id";
        $cm = $cn->prepare($sql);
        $sv = false;
        //$sv = $cm->execute($params);
        echo $sno . "-". $production_accept . "-" .$production_flag ."-";
        echo $sv ? "OK" : "ERROR ON UPDATE";
        echo "<br/>";
        //echo $sno . " - ". $production_accept 
        if($sno ===16000){
            exit;
        }
    }
    
   
}
