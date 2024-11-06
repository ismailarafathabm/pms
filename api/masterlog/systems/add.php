<?php 
    if(!isset($ml)) { include_once '../../_error.php';exit;  }
    if(!isset($systemname) || trim($systemname) === "") { echo response("0","Enter System Name");  exit;}
    if(!isset($systemprocurement) || trim($systemprocurement) === "") { echo response("0","Enter Procurement Duration Days");  exit;}
    if(!is_numeric($systemprocurement)) { echo response("0","Procurement Duration Days is Not Valid Number Format");  exit;  }
    if(!isset($systemesimation) || trim($systemesimation) === "") { echo response("0","Enter Estimation Duration Days");  exit;}    
    if(!is_numeric($systemesimation)) { echo response("0","Estimation Duration Days is Not Valid Number Format");  exit;  }
    $totaldays = (double)$systemprocurement + (double)$systemesimation;
    $params = array(
        ":systemname" => strtolower($systemname),
        ":systemprocurement" => $systemprocurement,
        ":systemesimation" => $systemesimation,
        ":totaldays" => $totaldays,
        ":systemnamedisplay" => $systemname,
    );
    echo $ml->SaveSystemInfo($params);exit;
?>