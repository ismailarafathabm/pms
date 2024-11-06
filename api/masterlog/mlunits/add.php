<?php 
    if(!isset($ml)) { include_once '../../_error.php';exit;  }
    if(!isset($unitdesc) || trim($unitdesc) === "") { echo response("0","Enter Unit Description");  exit;}
    if(!isset($calcby) || trim($calcby) === "") { echo response("0","Enter Calculation By");  exit;}    
    $params = array(
        ":unitdesc" => strtolower($unitdesc),
        ":calcby" => $calcby,
        ":unitdisplay" => $unitdesc,
    );
    echo $ml->SaveUnits($params);exit;
?>