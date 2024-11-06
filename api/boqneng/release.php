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

$payload = $_POST['payload'];
$d = json_decode($payload);
$boqeng_project_id = !isset($d->boqeng_project_id) || trim($d->boqeng_project_id) === '' ? '' : trim($d->boqeng_project_id);
if($boqeng_project_id === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Project Id");
    return;
}
$boqeng_projectno = !isset($d->boqeng_projectno) || trim($d->boqeng_projectno) === '' ? '' : trim($d->boqeng_projectno);
if($boqeng_projectno === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Project Number");
    return;
}
$boqeng_projectnoenc = !isset($d->boqeng_projectnoenc) || trim($d->boqeng_projectnoenc) === '' ? '' : trim($d->boqeng_projectnoenc);
if($boqeng_projectnoenc === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Project Number (Encripted)");
    return;
}
$boqeng_projectname = !isset($d->boqeng_projectname) || trim($d->boqeng_projectname) === '' ? '' : trim($d->boqeng_projectname);
if($boqeng_projectname === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Project Name");
    return;
}
$boqeng_projectlocation = !isset($d->boqeng_projectlocation) || trim($d->boqeng_projectlocation) === '' ? '' : trim($d->boqeng_projectlocation);
if($boqeng_projectlocation === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Project Location");
    return;
}
$boqeng_boqid = !isset($d->boqeng_boqid) || trim($d->boqeng_boqid) === '' ? '' : trim($d->boqeng_boqid);
if($boqeng_boqid === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Select BOQ");
    return;
}
$boqeng_qty = !isset($d->boqeng_qty) || trim($d->boqeng_qty) === '' ? '' : trim($d->boqeng_qty);
if($boqeng_qty === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Qty");
    return;
}
if(!is_numeric($boqeng_qty)){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Qty is Not Valid Format");
    return;
}
$boqeng_area = !isset($d->boqeng_area) || trim($d->boqeng_area) === '' ? '' : trim($d->boqeng_area);
if($boqeng_area === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Area");
    return;
}
if(!is_numeric($boqeng_area)){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Area is Not Valid Format");
    return;
}
$boqeng_rdate = !isset($d->boqeng_rdate) || trim($d->boqeng_rdate) === '' ? '' : trim($d->boqeng_rdate);
if($boqeng_rdate === ''){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Enter Release Date");
    return;
}
if(!date_create($boqeng_rdate)){
    header("HTTP/1.0 403 Input Missing");
    echo response("0","Release Date Not Valid Format");
    return;
}
$boqeng_enggname = $uuser;


$params = array(
    ":boqeng_project_id" => $boqeng_project_id,
    ":boqeng_projectno" => $boqeng_projectno,
    ":boqeng_projectnoenc" => $boqeng_projectnoenc,
    ":boqeng_projectname" => $boqeng_projectname,
    ":boqeng_projectlocation" => $boqeng_projectlocation,
    ":boqeng_boqid" => $boqeng_boqid,
    ":boqeng_qty" => $boqeng_qty,
    ":boqeng_area" => $boqeng_area,
    ":boqeng_rdate" => date_format(date_create($boqeng_rdate),'Y-m-d'),
    ":boqeng_enggname" => $boqeng_enggname,
    ":boqeng_cby" => $uuser,
    ":boqeng_eby" => $uuser,
    ":boqeng_cdate" => $ddate,
    ":boqeng_edate" => $ddate,
    ":boqeng_postflag" => '1',
);
include_once '../../controller/boqn.php';
$eng = new BOQN($cn);
echo $eng->SaveBoqEng($params);
exit;

?>