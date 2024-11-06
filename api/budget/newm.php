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
if (!is_numeric($_bmdiscountprice)) {
    echo response("0", "Discount Price Is Not valid Format");
}
$_bmdiscountval = (float)$_bmeval - (float)$_bmdiscountprice;
//echo $_bmdiscountval;
// if($_bmdiscountval === "0" || $_bmdiscountval === 0){
//     //echo "working";
//     //echo $_bmeval;
//     $_bmdiscountval = $_bmeval;
// }

$_bmunit = !isset($bmunit) || trim($bmunit) === '' ? 'KG' : $bmunit;
$uuser = $user_name;
$ddate = date('Y-m-d');
$cdate = date('Y-m-d H:i:s');
$params = array(
    ":bmdate" => $ddate,
    ":bmrefno" => $bmrefno,
    ":bmproject" => $bmproject,
    ":bmtype" => $bmtype,
    ":bmqty" => $_bmqty,
    ":bmeprice" => $_bmeprice,
    ":bmeval" => $_bmeval,
    ":bmdiscountval" => $_bmdiscountval,
    ":bmunit" => $_bmunit,
    ":bmcby" => $uuser,
    ":bmeby" => $uuser,
    ":bmcdate" => $cdate,
    ":bmedate" => $cdate,
    ':bmmaterialtype' => !isset($bmmaterialtype) || trim($bmmaterialtype) === "" ? "Accessories" :  $bmmaterialtype,
    ":bmdiscountprice" => $_bmdiscountprice,
    ":budgettype" => $budgettype,
    ":budgettype" => $budgettype,
    ":budgetNo" => $budgetNo,
);

echo $budget->newBudgetMaterials($params);
exit;