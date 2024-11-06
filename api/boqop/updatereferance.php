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
include_once '../../controller/boq.php';
$boq = new BOQ($cn);

$project_id = !isset($_GET['project_id']) || trim($_GET['project_id']) === '' ? '' : trim($_GET['project_id']);

$xboq_refno = !isset($_POST['refno']) || trim($_POST['refno']) === '' ? '' : trim($_POST['refno']);

$xboq_reviewno = !isset($_POST['rewno']) || trim($_POST['rewno']) === '' ? '' : trim($_POST['rewno']);
if($project_id === ''){
    header("http/1.0 409 input missing");
    echo response('0','Enter Project Number');
    exit;
}
if($xboq_refno === ''){
    header("http/1.0 409 input missing");
    echo response('0','Enter Boq Referance Number');
    exit;
}
if($xboq_reviewno === ''){
    header("http/1.0 409 input missing");
    echo response('0','Enter Boq Revision Number');
    exit;
}
$boq_refno = $boq->enc('enc',$xboq_refno);

$boq_reviewno = $boq->enc('enc',$xboq_reviewno);

$params = array(
    ":project_boq_refno" => $boq_refno,
    ":project_boq_revision" => $boq_reviewno,
    ":project_id" => $project_id,
);
//print_R($params);
//exit();
echo (string)$boq->UpdateProjectBoqReferanceNO($params);
exit();
