<?php 
if (!isset($budget)) {
    include_once '../_error.php';
    exit;
}

if(!isset($podate) || trim($podate) === ""){
    echo response("0","Enter date");
    exit;
}

if(!date_create($podate)){
    echo response("0","Date is Not Valid Format");
    exit;
}

if(!isset($porefno) || trim($porefno) === ""){
    echo response("0","Enter PO Referance Number");
    exit;
}

if(!isset($itemtype) || trim($itemtype) === ""){
    echo response("0","Enter Type");
    exit;
}

if(!isset($posupplier) || trim($posupplier) === ""){
    echo response("0","Select Supplier");
    exit;
}

if(!isset($posupplieraddress) || trim($posupplieraddress) === ""){
    echo response("0","Select Supplier Address");
    exit;
}

if(!isset($poattenby) || trim($poattenby) === ""){
    echo response("0","Enter Kind Attn");
    exit;
}


if(!isset($podescription) ||  trim($podescription)  === ""){
    echo response("0","Enter Description");
    exit;
}

if(!isset($poqty) ||  trim($poqty)  === ""){
    echo response("0","Enter Qty");
    exit;
}

if(!isset($povalue) ||  trim($povalue)  === ""){
    echo response("0","Enter Value");
    exit;
}

if(!isset($pounitprice) ||  trim($pounitprice)  === ""){
    echo response("0","Enter Unit Price");
    exit;
}

if(!isset($poarea) ||  trim($poarea)  === ""){
    echo response("0","Enter Area");
    exit;
}

if(!isset($ponotes) ||  trim($ponotes)  === ""){
    echo response("0","Enter Notes");
    exit;
}

if(!isset($popaymentterms) ||  trim($popaymentterms)  === ""){
    echo response("0","Enter Payment Terms");
    exit;
}

if(!isset($podeliveryterms) ||  trim($podeliveryterms)  === ""){
    echo response("0","Enter Delivery Terms");
    exit;
}

if(!is_numeric($poqty)){
    echo response("0","Qty is Not Valid Format");
    exit;
}

if(!is_numeric($povalue)){
    echo response("0","Value Is Not Valid Format");
    exit;
}

if(!is_numeric($pounitprice)){
    echo response("0","Unit Price Is Not Valid Format");
    exit;
}

if(!is_numeric($poarea)){
    echo response("0","Area Is Not Valid Format");
    exit;
}
$_poweight = !isset($poweight) || trim($poweight) === "" ? "0" : $poweight;
if(!is_numeric($_poweight)){
    echo response("0","Tonnage Is Not A valid Format");
    exit;
}
$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");

$save = array(
    ':podate' => date_format(date_create($podate),'Y-m-d'),
    ':porefno' => $porefno,
    ':itemtype' => $itemtype,
    ':posupplier' => $posupplier,
    ':posupplieraddress' => $posupplieraddress,
    ':poattenby' => $poattenby,
    ':podescription' => $podescription,
    ':poqty' => $poqty,
    ':povalue' => $povalue,
    ':pounitprice' => $pounitprice,
    ':ponotes' => $ponotes,
    ':popaymentterms' => $popaymentterms,
    ':podeliveryterms' => $podeliveryterms,
    ':poproject' => $poproject,
    ':pocby' => $uuser,
    ':poeby' => $uuser,
    ':pocdate' => $ddate,
    ':poedate' => $ddate,
    ':poiscurrent' => "1",
    ':poarea' => $poarea,
    ':poweight' => $poweight,
);
echo $budget->SavePo($save);
exit;

?>