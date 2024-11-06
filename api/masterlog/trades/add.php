<?php 
if(!isset($ml)) { include_once '../../_error.php';exit;  }
if(!isset($tradename) || trim($tradename) === "") { echo response("0","Enter Trade Name");  exit;}
if(!isset($engperday) || trim($engperday) === "") { echo response("0","Enter Engineering Per Day Value");  exit;}
if(!is_numeric($engperday)) { echo response("0","Engineering Per Day Value is Not Valid Number Format");  exit;  }
if(!isset($productionperday) || trim($productionperday) === "") { echo response("0","Enter Production Per Day Value");  exit;}
if(!is_numeric($productionperday)) { echo response("0","Production Per Day Value is Not Valid Number Format");  exit;  }
if(!isset($installperday) || trim($installperday) === "") { echo response("0","Enter Installation Per Day Value");  exit;}
if(!is_numeric($installperday)) { echo response("0","Installation Per Day Value is Not Valid Number Format");  exit;  }
if(!isset($unitkey) || trim($unitkey) === "") { echo response("0","Select Unit");  exit;}
if(!isset($groupname) || trim($groupname) === "") { echo response("0","Select Trade Group Name");  exit;}

$params = array(
    ":tradename" => strtolower($tradename),
    ":tradedisplayname" => $tradedisplayname,
    ":engperday" => $engperday,
    ":productionperday" => $productionperday,
    ":installperday" => $installperday,
    ":unitkey" => $unitkey,
    ":groupname" => $groupname,
);

echo $ml->TradeSave($params);exit;