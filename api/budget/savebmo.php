<?php
if (!isset($budget)) {
    include_once '../_error.php';
}

if(!isset($bmospplier) || trim($bmospplier) === ""){
    echo response("0","Enter Supplier Name");
    exit;
}

if(!isset($bmotype) || trim($bmotype) === ""){
    echo response("0","Enter Material Order Type");
    exit;
}


if(!isset($bmomtype) || trim($bmomtype) === ""){
    echo response("0","Enter Material Type");
    exit;
}

$_bmoqty = !isset($bmoqty) || trim($bmoqty) === "" ? 0 : $bmoqty;

if(!is_numeric($_bmoqty)){
    echo response("0","Qty Not Valid Format");
    exit;
}

$_bmounit = !isset($bmounit) || trim($bmounit) === "" ? "KG" : $bmounit;


$_bmoppunit = !isset($bmoppunit) || trim($bmoppunit) === "" ? 0 : $bmoppunit;

if(!is_numeric($_bmoppunit)){
    echo response("0","Price Per Unit Not Valid Format");
    exit;
}

$_bmoval = !isset($bmoval) || trim($bmoval) === "" ? 0 : $bmoval;

if(!is_numeric($_bmoval)){
    echo response("0","Total Price Not Valid Format");
    exit;
}

$uuser = $user_name;
$ddate = date('Y-m-d');
$cdate = date('Y-m-d H:i:s');


$save = array(
    ":bmodate" => $ddate,
    ":bmospplier" => $bmospplier,
    ":bmotype" => $bmotype,
    ":bmomtype" => $bmomtype,
    ":bmoqty" => $_bmoqty,
    ":bmounit" => $_bmounit,
    ":bmoppunit" => $_bmoppunit,
    ":bmoval" => $_bmoval,
    ":bmopqty" => '0',
    ":bmopval" => $bmopval,
    ":bmocby" => $uuser,
    ":bmoeby" => $uuser,
    ":bmocdate" => $cdate,
    ":bmoedate" => $cdate,
    ":bmorefno" => $bmorefno,
    ":bmoproject" => $bmoproject,
    ":bmoorefno" => $bmoorefno,    
);

echo $budget->savebmo($save);
exit;