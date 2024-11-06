<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'POST') {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once '../cuttinglists/auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}
$goid = !isset($_GET['goid']) || trim($_GET['goid']) === '' ? '' : trim($_GET['goid']);
if ($goid === "") {
    header("HTTP/1.0 402 error");
    echo response("0", "Go Id Missing");
    exit;
}
$payload = json_decode($_POST['payload']);
//print_r($payload);
$procurement_orderdate = !isset($payload->procurement_orderdate) || trim($payload->procurement_orderdate) === '' ? '' : $payload->procurement_orderdate;
if ($procurement_orderdate === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Order Date");
    exit;
}
if (!date_create($procurement_orderdate)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Order Date Is Not A valid Format");
    exit;
}
$procurement_supplier = !isset($payload->procurement_supplier) || trim($payload->procurement_supplier) === '' ? '' : $payload->procurement_supplier;
if ($procurement_supplier === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Supplier Name");
    exit;
}
$procurement_coating = !isset($payload->procurement_coating) || trim($payload->procurement_coating) === '' ? '' : $payload->procurement_coating;
if ($procurement_coating === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Glass Coatting");
    exit;
}
$procurement_thickness = !isset($payload->procurement_thickness) || trim($payload->procurement_thickness) === '' ? '' : $payload->procurement_thickness;
if ($procurement_thickness === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Glass Thickness");
    exit;
}
$procurement_out = !isset($payload->procurement_out) || trim($payload->procurement_out) === '' ? '' : $payload->procurement_out;
if ($procurement_out === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Glass Outter Informations");
    exit;
}
$procurement_inner = !isset($payload->procurement_inner) || trim($payload->procurement_inner) === '' ? '' : $payload->procurement_inner;
if ($procurement_inner === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Glass Inner Informations");
    exit;
}
$procurment_orderunitprice = !isset($payload->procurment_orderunitprice) || trim($payload->procurment_orderunitprice) === '' ? '' : $payload->procurment_orderunitprice;
if ($procurment_orderunitprice === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Unit Price");
    exit;
}
if (!is_numeric($procurment_orderunitprice)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Unit Price is Not valid Number Format");
    exit;
}
$procurement_otherprice = !isset($payload->procurement_otherprice) || trim($payload->procurement_otherprice) === '' ? '' : $payload->procurement_otherprice;
if ($procurement_otherprice === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Other Price");
    exit;
}
if (!is_numeric($procurement_otherprice)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Other Price is Not valid Number Format");
    exit;
}
$procurement_calby = $payload->procurement_calby;
$procurement_totalprice = !isset($payload->procurement_totalprice) || trim($payload->procurement_totalprice) === '' ? '' : $payload->procurement_totalprice;
if ($procurement_totalprice === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Total Price");
    exit;
}
if (!is_numeric($procurement_otherprice)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Total Price is Not valid Number Format");
    exit;
}


$procurement_qty = !isset($payload->procurement_qty) || trim($payload->procurement_qty) === '' ? '' : $payload->procurement_qty;
if ($procurement_qty === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Qty");
    exit;
}
if (!is_numeric($procurement_qty)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Qty is Not valid Number Format");
    exit;
}

$procurement_area = !isset($payload->procurement_area) || trim($payload->procurement_area) === '' ? '' : $payload->procurement_area;
if ($procurement_area === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Area");
    exit;
}
if (!is_numeric($procurement_area)) {
    header("HTTP/1.0 402 error");
    echo response("0", "Area Not valid Number Format");
    exit;
}

$goreceipttype = !isset($payload->goreceipttype) || trim($payload->goreceipttype) === '' ? '' : trim($payload->goreceipttype);
$broken_by = !isset($payload->broken_by) || trim($payload->broken_by) === '' ? '' : trim($payload->broken_by);
$broken_naf_by = !isset($payload->broken_naf_by) || trim($payload->broken_naf_by) === '' ? '' : trim($payload->broken_naf_by);
$broken_go_oldno = !isset($payload->broken_go_oldno) || trim($payload->broken_go_oldno) === '' ? '-' : trim($payload->broken_go_oldno);
$broken_go_enggineer = !isset($payload->broken_go_enggineer) || trim($payload->broken_go_enggineer) === '' ? '' : trim($payload->broken_go_enggineer);
$broken_description = !isset($payload->broken_description) || trim($payload->broken_description) === '' ? '' : trim($payload->broken_description);
$broken_engg = !isset($payload->broken_go_enggineer) || trim($payload->broken_go_enggineer) === '' ? '' : trim($payload->broken_go_enggineer);

$proucrementeta = !isset($payload->proucrementeta) || trim($payload->proucrementeta) === '' ? '' : trim($payload->proucrementeta);
$invoiceno = !isset($payload->invoiceno) || trim($payload->invoiceno) === '' ? '' : trim($payload->invoiceno);

$uinsert = !isset($payload->uinsert) || trim($payload->uinsert) === '' ? '' : trim($payload->uinsert);
$procurementremark = !isset($payload->procurementremark) || trim($payload->procurementremark) === '' ? '' : trim($payload->procurementremark);
$dellocation = !isset($payload->dellocation) || trim($payload->dellocation) === '' ? '' : trim($payload->dellocation);
$workorderno = !isset($payload->workorderno) || trim($payload->workorderno) === '' ? '' : trim($payload->workorderno);




if ($goreceipttype === '') {
    header("HTTP/1.0 402 error");
    echo response("0", "Enter Go Type");
    exit;
}
if ($goreceipttype !== 'GO') {
    if ($broken_go_oldno === '') {
        header("HTTP/1.0 402 error");
        echo response("0", "Enter Old GO#");
        exit;
    }
    if ($goreceipttype === 'Re Order') {
        if ($broken_description === '') {
            header("HTTP/1.0 402 error");
            echo response("0", "Enter Re Order Description");
            exit;
        }
        if ($broken_go_enggineer === '') {
            header("HTTP/1.0 402 error");
            echo response("0", "Enter Re Order Engineer Name");
            exit;
        }
    }    
}
$params = array(
    ":procurement_orderdate" => date_format(date_create($procurement_orderdate), 'Y-m-d'),
    ":procurement_supplier" => $procurement_supplier,
    ":procurement_coating" => $procurement_coating,
    ":procurement_thickness" => $procurement_thickness,
    ":procurement_out" => $procurement_out,
    ":procurement_inner" => $procurement_inner,
    ":procurment_orderunitprice" => $procurment_orderunitprice,
    ":procurement_otherprice" => $procurement_otherprice,
    ":procurement_totalprice" => $procurement_totalprice,
    ":procurement_calby" => $procurement_calby,
    ":procurement_qty" => $procurement_qty,
    ":procurement_area" => $procurement_area,
    ":goreceipttype" => $goreceipttype,
    ":broken_by" => $goreceipttype === 'GO' ? '' : $broken_by,
    ":broken_naf_by" => $goreceipttype === 'GO' ? '' : $broken_naf_by,
    ":broken_go_oldno" => $goreceipttype === 'GO' ? '' : $broken_go_oldno,
    ":broken_go_enggineer" => $goreceipttype === 'GO' ? '' : $broken_go_enggineer,
    ":broken_description" => $goreceipttype === 'GO' ? '' : $broken_description,
    ":broken_engg" => $goreceipttype === 'GO' ? '' : $broken_engg,
    ":proucrementeta" => $proucrementeta,
    ":invoiceno" => $invoiceno,
    ":uinsert" => $uinsert,
    ":procurementremark" => $procurementremark,
    ":dellocation" => $dellocation,
    ":workorderno" => $workorderno,    
    ":goid" => $goid
);

include_once '../../controller/gos.php';
$goc = new GoController($cn);
echo $goc->ProcurementUpdate($params);
exit;
