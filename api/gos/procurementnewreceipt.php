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
$d = json_decode($_POST['payload']);
$goreceiptgono = $goid;
$goreceiptgoprno = !isset($d->goreceiptgoprno) || trim($d->goreceiptgoprno) === '' ? '' : trim($d->goreceiptgoprno);
$goreceiptdate = !isset($d->goreceiptdate) || trim($d->goreceiptdate) === '' ? '' : trim($d->goreceiptdate);
$goreceiptinvoiceno = !isset($d->goreceiptinvoiceno) || trim($d->goreceiptinvoiceno) === '' ? '' : trim($d->goreceiptinvoiceno);
$goreceiptsupplier = !isset($d->goreceiptsupplier) || trim($d->goreceiptsupplier) === '' ? '' : trim($d->goreceiptsupplier);
$goreceiptqty = !isset($d->goreceiptqty) || trim($d->goreceiptqty) === '' ? '' : trim($d->goreceiptqty);
$goreceiptarea = !isset($d->goreceiptarea) || trim($d->goreceiptarea) === '' ? '' : trim($d->goreceiptarea);
$goreceipt_project = !isset($d->goreceipt_project) || trim($d->goreceipt_project) === '' ? '' : trim($d->goreceipt_project);
$goreceipt_projectname = !isset($d->goreceipt_projectname) || trim($d->goreceipt_projectname) === '' ? '' : trim($d->goreceipt_projectname);
$goreceipt_projectlocation = !isset($d->goreceipt_projectlocation) || trim($d->goreceipt_projectlocation) === '' ? '' : trim($d->goreceipt_projectlocation);
$goreceiptunitprice = !isset($d->goreceiptunitprice) || trim($d->goreceiptunitprice) === '' ? '' : trim($d->goreceiptunitprice);
$goreceiptcalby = !isset($d->goreceiptcalby) || trim($d->goreceiptcalby) === '' ? '' : trim($d->goreceiptcalby);
$goreceiptotherprice = !isset($d->goreceiptotherprice) || trim($d->goreceiptotherprice) === '' ? '' : trim($d->goreceiptotherprice);
$goreceipttotalprice = !isset($d->goreceipttotalprice) || trim($d->goreceipttotalprice) === '' ? '' : trim($d->goreceipttotalprice);


$params = array(
    ":goreceiptgono" => $goreceiptgono,
    ":goreceiptgoprno" => $goreceiptgoprno,
    ":goreceiptdate" => date_format(date_create($goreceiptdate),'Y-m-d'),
    ":goreceiptinvoiceno" => $goreceiptinvoiceno,
    ":goreceiptsupplier" => $goreceiptsupplier,
    ":goreceiptqty" => $goreceiptqty,
    ":goreceiptarea" => $goreceiptarea,
    ":goreceiptcby" => $uuser,
    ":goreceipteby" => $uuser,
    ":goreceiptcdate" => $ddate,
    ":goreceiptedate" => $ddate,
    ":goreceipt_flag" => '0',
    ":goreceipt_project" => $goreceipt_project,
    ":goreceipt_projectname" => $goreceipt_projectname,
    ":goreceipt_projectlocation" => $goreceipt_projectlocation,
    ":goreceiptunitprice" => $goreceiptunitprice,
    ":goreceiptcalby" => $goreceiptcalby,
    ":goreceiptotherprice" => $goreceiptotherprice,
    ":goreceipttotalprice" => $goreceipttotalprice,    
);
include_once '../../controller/gos.php';
$goc = new GoController($cn);
echo $goc->SaveNewProcurementReceiptGO($params);  
exit;
?>