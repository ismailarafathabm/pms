<?php 
   if(!isset($mtbl)) {include_once '../_error.php';exit;}
   if(!isset($project_no) || trim($project_no) === ""){ echo response("0", "Enter Project Name"); } 
   echo $mtbl->GetInfoOfProject($project_no);exit;
