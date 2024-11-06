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


$mrid = !isset($_GET['mrid']) || trim($_GET['mrid']) === '' ? '' : trim($_GET['mrid']);
$data = json_decode($_POST['payload']);
$mrp_orderno = !isset($data->mrp_orderno) || trim($data->mrp_orderno) === '' ? '-' : trim($data->mrp_orderno);
$mrp_supplier = !isset($data->mrp_supplier) || trim($data->mrp_supplier) === '' ? '-' : trim($data->mrp_supplier);
$mrp_system = !isset($data->mrp_system) || trim($data->mrp_system) === '' ? '-' : trim($data->mrp_system);
$mrp_okdate = !isset($data->mrp_okdate) || trim($data->mrp_okdate) === '' || !date_create($data->mrp_okdate) ? date('Y-m-d') : trim($data->mrp_okdate);
$mrp_eta = !isset($data->mrp_eta) || trim($data->mrp_eta) === '' ? '-' : trim($data->mrp_eta);
$mrp_datereceive = !isset($data->mrp_datereceive) || trim($data->mrp_datereceive) === '' || !date_create($data->mrp_datereceive) ? date('Y-m-d') : trim($data->mrp_datereceive);
$mrp_totorder = !isset($data->mrp_totorder) || trim($data->mrp_totorder) === '' ? '-' : trim($data->mrp_totorder);
///$mrp_orderno = $data->

$params = array(
    ":mrp_orderno" => $mrp_orderno,
    ":mrp_supplier" => $mrp_supplier,
    ":mrp_okdate" => date_format(date_create($mrp_okdate),'Y-m-d'),
    ":mrp_eta" => $mrp_eta,
    ":mrp_system" => $mrp_system,
    ":mrp_datereceive" => date_format(date_create($mrp_datereceive),'Y-m-d'),
    ":mrp_totorder" => $mrp_totorder,
    ":mrid" => $mrid,
);
include_once '../../controller/mr.php';
$mr = new MR($cn);
echo $mr->UpdateMrp($params);
exit();
?>