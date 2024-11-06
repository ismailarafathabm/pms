<?php
//echo "function page start";
if (!isset($go)) {
    include_once '../_error.php';
    exit;
}
//echo "function page validate";
if(!isset($gbudgettype) || trim($gbudgettype) === ""){
    echo response("0","Enter Type");
    exit;
}

if(!isset($gbudgetglasstype) || trim($gbudgetglasstype) === ""){
    echo response("0","Enter Glass Type");
    exit;
}

if(!isset($gbudgetspc) || trim($gbudgetspc) === ""){
    echo response("0","Enter Glass Specification");
    exit;
}

if(!isset($gbudgtickness) || trim($gbudgtickness) === ""){
    echo response("0","Enter Glass Tickness");
    exit;
}

if(!isset($gbudgetarea) || trim($gbudgetarea) === ""){
    echo response("0","Enter Total Area");
    exit;
}

if(!is_numeric($gbudgetarea)){
    echo response("0","Area Is Not Valid Format");
    exit;
}

if(!isset($gbudgetbprice) || trim($gbudgetbprice) === ""){
    echo response("0","Enter Price Per Sqm");
    exit;
}

if(!is_numeric($gbudgetbprice)){
    echo response("0","Price Is Not Valid Format");
    exit;
}

if(!isset($gbudgetbtotal) || trim($gbudgetbtotal) === ""){
    echo response("0","Enter Total Price");
    exit;
}

if(!is_numeric($gbudgetbtotal)){
    echo response("0","Total Price Is Not Valid Format");
    exit;
}

if(!isset($pupdate) || trim($pupdate) === ""){
    echo response("0","Enter Date");
    exit;
}

if(!date_create($pupdate)){
    echo response("0","Date is not valid Format");
    exit;
}

if(!isset($gbproject) || trim($gbproject) === ""){
    echo response("0","Enter Project name");
    exit;
}

if(!isset($gbsupplier) || trim($gbsupplier) === ""){
    echo response("0","Enter Supplier name");
    exit;
}

$cdate = date('Y-m-d H:i:s');

$params = array(
    ":gbudgettype" => $gbudgettype,
    ":gbudgetglasstype" => $gbudgetglasstype,
    ":gbudgetspc" => $gbudgetspc,
    ":gbudgtickness" => $gbudgtickness,
    ":gbudgetarea" => $gbudgetarea,
    ":gbudgetbprice" => $gbudgetbprice,
    ":gbudgetbtotal" => $gbudgetbtotal,
    ":gbudgcustomval" => "0",
    ":gbudgettotal" => "0",
    ":pricediff" => $pricediff,
    ":finalamount" => $finalamount,
    ":cby" => $user_name,
    ":eby" => $user_name,
    ":cdate" => $cdate,
    ":edate" => $cdate,
    ":pupdate" => date_format(date_create($pupdate),'Y-m-d'),
    ":gbproject" => $gbproject,
    ":gbprojectname" => $gbprojectname,
    ":gbsupplier" => $gbsupplier,
    ":sbsupplierlocation" => $sbsupplierlocation,
    ":estimationflag" => "O",
    ":procurementflag" => "0",
);

echo $go->Savebudget($params);
exit;




