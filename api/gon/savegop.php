<?php 
if (!isset($gon)) {
    include_once '../_error.php';
    exit;
}
$uuser = $user_name;
$date = date('Y-m-d H:i:s');

$payload = json_decode($payload);

$gonp_type = $payload->gonp_type;
$gonp_date = $payload->gonp_date;
$gonp_gorefno = $payload->gonp_gorefno;
$gonp_supplier = $payload->gonp_supplier;
$gonp_gthk = $payload->gonp_gthk;
$gonp_gout = $payload->gonp_gout;
$gonp_gin = $payload->gonp_gin;
$gonp_gcotting = $payload->gonp_gcotting;
$gonp_qty = $payload->gonp_qty;
$gonp_area = $payload->gonp_area;
$gonp_remarks = $payload->gonp_remarks;
$gonp_location = $payload->gonp_location;
$gonp_eta = $payload->gonp_eta;
$gonp_ppsqm = $payload->gonp_ppsqm;
$gonp_pptotal = $payload->gonp_pptotal;
$gonp_ppextra = $payload->gonp_ppextra;
$gonp_pjcno = $payload->gonp_pjcno;
$gonp_cby = $uuser;
$gonp_eby = $uuser;
$gonp_cdate = $date;
$gonp_edate = $date;
$gonp_status = "1";
$gonp_goid = $payload->gonp_goid;

$params = array(
    ':gonp_type' => $gonp_type,
    ':gonp_date' => date_format(date_create($gonp_date),'Y-m-d'),
    ':gonp_gorefno' => $gonp_gorefno,
    ':gonp_supplier' => $gonp_supplier,
    ':gonp_gthk' => $gonp_gthk,
    ':gonp_gout' => $gonp_gout,
    ':gonp_gin' => $gonp_gin,
    ':gonp_gcotting' => $gonp_gcotting,
    ':gonp_qty' => $gonp_qty,
    ':gonp_area' => $gonp_area,
    ':gonp_remarks' => $gonp_remarks,
    ':gonp_location' => $gonp_location,
    ':gonp_eta' => date_format(date_create($gonp_eta),'Y-m-d'),
    ':gonp_ppsqm' => $gonp_ppsqm,
    ':gonp_pptotal' => $gonp_pptotal,
    ':gonp_ppextra' => $gonp_ppextra,
    ':gonp_pjcno' => $gonp_pjcno,
    ':gonp_cby' => $gonp_cby,
    ':gonp_eby' => $gonp_eby,
    ':gonp_cdate' => $gonp_cdate,
    ':gonp_edate' => $gonp_edate,
    ':gonp_status' => $gonp_status,
    ':gonp_goid' => $gonp_goid,
);

echo $gon->savegop($params);
exit;

