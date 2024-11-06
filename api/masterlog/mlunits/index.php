<?php 
       if(!isset($ml)) { include_once '../../_error.php';exit;  }
    if(!isset($unitdesc) || trim($unitdesc) === "") { echo response("0","Select Any Units");exit; }
    echo $ml->UnitInfoGet($unitdesc);
?>