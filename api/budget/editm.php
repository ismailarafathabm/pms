<?php
if (!isset($budget)) {
    include_once '../_error.php';
    exit;
}

if (!isset($bmtype) || trim($bmtype) === '') {
    echo response("0", "Enter Material Type");
    exit;
}

$_bmqty = !isset($bmqty) || trim($bmqty) === "" ? 0 : $bmqty;


if (!is_numeric($_bmqty)) {
    echo response("0", "Material Qty Is Not A Valid Format");
    exit;
}

$_bmeprice = !isset($bmeprice) || trim($bmeprice) === "" ? 0 : $bmeprice;

if (!is_numeric($_bmeprice)) {
    echo response("0", "Estimate Price Is Not A Valid Format");
    exit;
}

$_bmeval = !isset($bmeval) || trim($bmeval) === "" ? 0 : $bmeval;

if (!is_numeric($bmeval)) {
    echo response("0", "Estimate Price Is Not A Valid Format");
    exit;
    //5165767
}


$_bmdiscountval = !isset($bmdiscountval) || trim($bmdiscountval) === "" ? 0 : $bmdiscountval;

if (!is_numeric($_bmdiscountval)) {
    echo response("0", "Discount Price Is Not A Valid Format");
    exit;
    //5165767
}
$_bmdiscountprice  = !isset($bmdiscountprice) || trim($bmdiscountprice) === "" ? 0 : $bmdiscountprice;
if(!is_numeric($_bmdiscountprice)){
    echo response("0","Discount Price Is Not valid Format");
}
$_bmdiscountval = (float)$_bmeval - (float)$_bmdiscountprice;



$_bmunit = !isset($bmunit) || trim($bmunit) === '' ? 'KG' : $bmunit;

$uuser = $user_name;

$cdate = date('Y-m-d H:i:s');

$params = array(    
    ":bmtype" => $bmtype,
    ":bmqty" => $_bmqty,
    ":bmeprice" => $_bmeprice,
    ":bmeval" => $_bmeval,
    ":bmdiscountval" => $_bmdiscountval,
    ":bmunit" => $_bmunit,    
    ":bmeby" => $uuser,    
    ":bmedate" => $cdate,
    ':bmmaterialtype' => $bmmaterialtype,
    ":bmdiscountprice" => $_bmdiscountprice,
    ":budgetNo" => $budgetNo,
    ":bmid" => $bmid
);

echo $budget->updatebudgetmaterial($params,$bmproject);
exit;
