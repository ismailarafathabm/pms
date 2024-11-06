<?php 
if (!isset($go)) {
    include_once '../_error.php';
    exit;
}

if(!isset($gopno) || trim($gopno) === ""){
    echo response("0","Enter Referance Number");
    exit;
}
if(!isset($gopdate) || trim($gopdate) === ""){
    echo response("0","Enter Date");
    exit;
}
if(!date_create($gopdate)){
    echo response("0","Date is not a valid format");exit;
}
if(!isset($gopglassdesc) || trim($gopglassdesc) === ""){
    echo response("0","Enter glass description");
    exit;
}
if(!isset($gopglasstype) || trim($gopglasstype) === ""){
    echo response("0","Enter Glass type");
    exit;
}
if(!isset($gopglasstotalarea) || trim($gopglasstotalarea) === ""){
    echo response("0","Enter Total Area");
    exit;
}
if(!is_numeric($gopglasstotalarea)){
    echo response("0","Area not a valid number format");
    exit;
}
if(!isset($gopglassqty) || trim($gopglassqty) === ""){
    echo response("0","Enter Qty");
    exit;
}
if(!is_numeric($gopglassqty)){
    echo response("0","Qty Not a valid Format");
    exit;
}
if(!isset($gopglasspricepersqm) || trim($gopglasspricepersqm) === ""){
    echo response("0","Enter Price per sqm value");
    exit;
}
if(!is_numeric($gopglasspricepersqm)){
    echo response("0","Price pre sqm Not a valid Format");
    exit;
}
if(!isset($gopglasstotalamount) || trim($gopglasstotalamount) === ""){
    echo response("0","Enter Total Glass Order Amount");
    exit;
}
if(!is_numeric($gopglasstotalamount)){
    echo response("0","Total Glass Order Amount is Not a valid Format");
    exit;
}
$username = $user_name;
$cdate = date('Y-m-d');
$params = array(
    ':gopno' => $gopno,
    ':gopdate' => date_format(date_create($gopdate),'Y-m-d'),
    ':gopproject' => $gopproject,
    ':gopsalesrep' => $gopsalesrep,
    ':gopglassdesc' => $gopglassdesc,
    ':gopglasstype' => $gopglasstype,
    ':gopglasstotalarea' => $gopglasstotalarea,
    ':gopglassqty' => $gopglassqty,
    ':gopglasspricepersqm' => $gopglasspricepersqm,
    ':gopglasstotalamount' => $gopglasstotalamount,
    ':gopcby' => $username,
    ':gopeby' => $username,
    ':gopcdate' => $cdate,
    ':gopedate' => $cdate,
    ':gopbudgetid' => $gopbudgetid,
);

echo $go->SaveGlassorders($params,$projectno);
?>