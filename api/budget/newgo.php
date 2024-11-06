<?php
if (!isset($budget)) {
    include_once '../_error.php';
    exit;
}


if(!isset($bgodate) || trim($bgodate) === ""){
    echo response("0","Enter Date");
    exit;
}

if(!date_create($bgodate)){
    echo response("0","Date Is Not valid Format");
    exit;
}

if(!isset($bgotype) || trim($bgotype) === ""){
    echo response("0","Enter Order Type");
    exit;
}

if(!isset($bgoproject) || trim($bgoproject) === ""){
    echo response("0","Enter Project Name");
    exit;
}

if(!isset($bgogorefno) || trim($bgogorefno) === ""){
    echo response("0","Enter Glass Order Ref Number");
    exit;
}


if(!isset($bgogoqty) || trim($bgogoqty) === ""){
    echo response("0","Enter Area");
    exit;
}

if(!is_numeric($bgogoqty)){
    echo response("0","Area Not valid Format");
    exit;
}

if(!isset($bgoppsqm) || trim($bgoppsqm) === ""){
    echo response("0","Enter Price Per Sqm value");
    exit;
}

if(!is_numeric($bgoppsqm)){
    echo response("0","Price Per Sqm Not valid Format");
    exit;
}

if(!isset($bgoval) || trim($bgoval) === ""){
    echo response("0","Enter Total Cost value");
    exit;
}

if(!is_numeric($bgoval)){
    echo response("0"," Total Cost Not valid Format");
    exit;
}

if(!isset($suppliername) || trim($suppliername) === ""){
    echo response("0","Select Supplier Name");
    exit;
}
$uuser = $user_name;
$date = date("Y-m-d H:i:s");
$params = array(
    ":bgodate" => date_format(date_create($bgodate),'Y-m-d'),
    ":bgotype" => $bgotype,
    ":bgoproject" => $bgoproject,
    ":bgogorefno" => $bgogorefno,
    ":bgogoqty" => $bgogoqty,
    ":bgoval" => $bgoval,
    ":bgocby" => $uuser,
    ":bgoeby" => $uuser,
    ":bgocdate" => $date,
    ":bgoedate" => $date,
    ":bgoppsqm" => $bgoppsqm,
    ":suppliername" => $suppliername,
    ":bgopsqm" => $bgopsqm,
    ":bgobsqm" => $bgobsqm,
);

echo $budget->NewGoApprovals($params);
exit;

