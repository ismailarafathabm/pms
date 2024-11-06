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
$payload = !isset($_POST['payload']) || trim($_POST['payload']) === '' ? '' : trim($_POST['payload']);
if($payload === ''){
    header("http/1.0 409 bad request");
    echo response("0","Input Missing");
    exit;
}
$d = json_decode($payload);
$poq_item_no = !isset($d->poq_item_no) || trim($d->poq_item_no) === '' ? '' : trim($d->poq_item_no);
if($poq_item_no === ''){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ Item No#");
    exit;
}
$poq_item_type = !isset($d->poq_item_type) || trim($d->poq_item_type) === '' ? '' : trim($d->poq_item_type);
if($poq_item_type === ''){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ item Type");
    exit;
}
$poq_item_remark = !isset($d->poq_item_remark) || trim($d->poq_item_remark) === '' ? '' : trim($d->poq_item_remark);
$poq_item_width = !isset($d->poq_item_width) || trim($d->poq_item_width) === '' ? '0' : trim($d->poq_item_width);

$poq_item_height = !isset($d->poq_item_height) || trim($d->poq_item_height) === '' ? '0' : trim($d->poq_item_height);
$poq_item_glass_spec = !isset($d->poq_item_glass_spec) || trim($d->poq_item_glass_spec) === '0' ? '' : trim($d->poq_item_glass_spec);
$poq_item_glass_single = !isset($d->poq_item_glass_single) || trim($d->poq_item_glass_single) === '' ? '-' : trim($d->poq_item_glass_single);
$poq_item_glass_double1 = !isset($d->poq_item_glass_double1) || trim($d->poq_item_glass_double1) === '' ? '-' : trim($d->poq_item_glass_double1);
$poq_item_glass_double2 = !isset($d->poq_item_glass_double2) || trim($d->poq_item_glass_double2) === '' ? '-' : trim($d->poq_item_glass_double2);
$poq_item_glass_double3 = !isset($d->poq_item_glass_double3) || trim($d->poq_item_glass_double3) === '' ? '-' : trim($d->poq_item_glass_double3);
$poq_item_glass_laminate1 = !isset($d->poq_item_glass_laminate1) || trim($d->poq_item_glass_laminate1) === '' ? '-' : trim($d->poq_item_glass_laminate1);
$poq_item_glass_laminate2 = !isset($d->poq_item_glass_laminate2) || trim($d->poq_item_glass_laminate2) === '' ? '-' : trim($d->poq_item_glass_laminate2);
$poq_drawing = !isset($d->poq_drawing) || trim($d->poq_drawing) === '' ? '-' : trim($d->poq_drawing);
$poq_finish = !isset($d->poq_finish) || trim($d->poq_finish) === '' ? '' : trim($d->poq_finish);
if($poq_finish === ""){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ item Finish");
    exit;
}
$poq_system_type = !isset($d->poq_system_type) || trim($d->poq_system_type) === '' ? '' : trim($d->poq_system_type);
if($poq_system_type === ""){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ System Type");
    exit;
}
$poq_qty = !isset($d->poq_qty) || trim($d->poq_qty) === '' ? '' : trim($d->poq_qty);
if($poq_qty === ""){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ Qty");
    exit;
}
if(!is_numeric($poq_qty)){
    header("http/1.0 409 Input Error");
    echo response("0","BOQ Qty Not Valid Number Format");
    exit;
}
$poq_unit = !isset($d->poq_unit) || trim($d->poq_unit) === '' ? '' : trim($d->poq_unit);
if($poq_system_type === ""){
    header("http/1.0 409 Input Missing");
    echo response("0","Enter BOQ unit");
    exit;
}
$poq_uprice = !isset($d->poq_uprice) || trim($d->poq_uprice) === '' ? '0' : trim($d->poq_uprice);
if(!is_numeric($poq_uprice)){
    header("http/1.0 409 Input Error");
    echo response("0","BOQ Unit Price Not Valid Number Format");
    exit;
}
$poq_remark = !isset($d->poq_remark) || trim($d->poq_remark) === '' ? '-' : trim($d->poq_remark);
$poq_cby = $uuser;
$poq_eby = $uuser;
$poq_Cdate = $ddate;
$poq_Edate = $ddate;
$poq_project_code = !isset($d->poq_project_code) || trim($d->poq_project_code) === '' ? '' : trim($d->poq_project_code);
$poq_status = "1";
$boq_refno = !isset($d->boq_refno) || trim($d->boq_refno) === '' ? '' : trim($d->boq_refno);
$boq_reviewno = !isset($d->boq_reviewno) || trim($d->boq_reviewno) === '' ? '' : trim($d->boq_reviewno);
$boq_area = !isset($d->boq_area) || trim($d->boq_area) === '' ? '0' : trim($d->boq_area);
if(!is_numeric($boq_area)){
    header("http/1.0 409 Input Error");
    echo response("0","BOQ Area Not Valid Number Format");
    exit;
}
$boq_type = !isset($d->boq_type) || trim($d->boq_type) === '' ? 'boq' : trim($d->boq_type);
$boq_type_refno = !isset($d->boq_type_refno) || trim($d->boq_type_refno) === '' ? '' : trim($d->boq_type_refno);
$boq_type_rno = !isset($d->boq_type_rno) || trim($d->boq_type_rno) === '' ? '' : trim($d->boq_type_rno);
$boq_calby = !isset($d->boq_calby) || trim($d->boq_calby) === '' ? '' : trim($d->boq_calby);
$issupersede = !isset($d->issupersede) || trim($d->issupersede) === '' ? '' : trim($d->issupersede);
$oldboqid = !isset($d->oldboqid) || trim($d->oldboqid) === '' ? '0' : trim($d->oldboqid);
$totprice = !isset($d->totprice) || trim($d->totprice) === '' ? '0' : trim($d->totprice);
if(!is_numeric($totprice)){
    header("http/1.0 409 Input Error");
    echo response("0","BOQ Total Value Not Valid Number Format");
    exit;
}

include_once '../../controller/boq.php';
$boq = new BOQ($cn);
$params = array(
    ':poq_item_no' => $boq->enc('enc',$poq_item_no),
    ':poq_item_type' => $poq_item_type,
    ':poq_item_remark' => $boq->enc('enc',$poq_item_remark),
    ':poq_item_width' => $boq->enc('enc',$poq_item_width),
    ':poq_item_height' => $boq->enc('enc',$poq_item_height),
    ':poq_item_glass_spec' => $boq->enc('enc',$poq_item_glass_spec),
    ':poq_item_glass_single' => $boq->enc('enc',$poq_item_glass_single),
    ':poq_item_glass_double1' => $boq->enc('enc',$poq_item_glass_double1),
    ':poq_item_glass_double2' => $boq->enc('enc',$poq_item_glass_double2),
    ':poq_item_glass_double3' => $boq->enc('enc',$poq_item_glass_double3),
    ':poq_item_glass_laminate1' => $boq->enc('enc',$poq_item_glass_laminate1),
    ':poq_item_glass_laminate2' => $boq->enc('enc',$poq_item_glass_laminate2),
    ':poq_drawing' => $boq->enc('enc',$poq_drawing),
    ':poq_finish' => $poq_finish,
    ':poq_system_type' => $poq_system_type,
    ':poq_qty' => $boq->enc('enc',$poq_qty),
    ':poq_unit' => $poq_unit,
    ':poq_uprice' => $boq->enc('enc',$poq_uprice),
    ':poq_remark' => $boq->enc('enc',$poq_remark),
    ':poq_cby' => $boq->enc('enc',$poq_cby),
    ':poq_eby' => $boq->enc('enc',$poq_eby),
    ':poq_Cdate' => $boq->enc('enc',$poq_Cdate),
    ':poq_Edate' => $boq->enc('enc',$poq_Edate),
    ':poq_project_code' => $poq_project_code,
    ':poq_status' => $boq->enc('enc',$poq_status),
    ':boq_refno' => $boq->enc('enc',$boq_refno),
    ':boq_reviewno' => $boq->enc('enc',$boq_reviewno),
    ':boq_area' => $boq->enc('enc',$boq_area),
    ':boq_type' => $boq_type,
    ':boq_type_refno' => $boq_refno,
    ':boq_type_rno' => $boq_reviewno,
    ':boq_calby' => $boq_calby,
    ':issupersede' => $issupersede,
    ':oldboqid' => $oldboqid,
    ':totprice' => $totprice,
    ':enc_mode' => '0'
);

echo (string)$boq->SaveBoq($params);
exit;