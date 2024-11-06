<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'GET') {
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

$mcount = !isset($_GET['limitr']) || trim($_GET['limitr']) === '' ? '' : trim($_GET['limitr']);
if ($mcount === '') {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Some Inputs Missing");
    exit;
}
if (!is_numeric($mcount)) {
    header("HTTP/1.0 402 bad request");
    echo response("0", "Some Inputs are not valid Format");
    exit;
}
$sql = "SELECT *, boq.poq_item_no, boq.poq_item_type, boq.poq_item_remark, boq.poq_item_width, boq.poq_item_height, boq.poq_finish, ptype.ptype_name, pj.project_id, pj.project_no, pj.project_name, pj.project_cname, pj.project_location, pj.Sales_Representative, pj.project_status, pj.projectRegion, pj.project_type, recp.rcv as rcqty FROM pms_materials_materialrequest as mr left join pms_poq as boq on mr.mrboqno = boq.poq_id left join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id left join pms_project_summary as pj on mr.mrproject = pj.project_id left join (select mrid as rmrid,sum(mrrqty) as rcv from pms_mr_receipt group by mrid) as recp on mr.mrid=recp.rmrid where mr.mrflags='P' limit $mcount,500;";
include_once '../../controller/mr.php';
$mr = new MR($cn);
echo $mr->AllMrp($sql);
exit;
