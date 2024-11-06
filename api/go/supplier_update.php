<?php 
if (!isset($go)) {
    include_once '../_error.php';
    exit;
}

if(!isset($glasssupplierid) || trim($glasssupplierid) === ""){
    echo response("0","Enter Supplier Id");
    exit;
}

if(!isset($glasssuppliername) || trim($glasssuppliername) === ""){
    echo response("0","Enter Supplier Name");
    exit;
}

if(!isset($glasssuppliercountry) || trim($glasssuppliercountry) === ""){
    echo response("0","Enter Supplier Location");
    exit;
}

$_suppliercontact = !isset($suppliercontact) || trim($suppliercontact) === "" ? '-' : $suppliercontact;
$_supplieraddress = !isset($supplieraddress) || trim($supplieraddress) === "" ? '-' : $supplieraddress;
$_supplieremail = !isset($supplieremail) || trim($supplieremail) === "" ? '-' : $supplieremail;
$_supplierphone = !isset($supplierphone) || trim($supplierphone) === "" ? '-' : $supplierphone;
$_supplierfax = !isset($supplierfax) || trim($supplierfax) === "" ? '-' : $supplierfax;

$params = array(
    ":glasssuppliername" => strtolower($glasssuppliername),
    ":glasssuppliercountry" => strtolower($glasssuppliercountry),
    ":suppliercontact" => $_suppliercontact,
    ":supplieraddress" => $_supplieraddress,
    ":supplieremail" => $_supplieremail,
    ":supplierphone" => $_supplierphone,
    ":supplierfax" => $_supplierfax,
    ":glasssupplierid" => $glasssupplierid,
);
echo $go->UpdateGlassSupplier($params);
exit;
?>