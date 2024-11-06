<?php
include_once 'gen.php';
if ($method !== "POST") {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once 'auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}

if (!isset($_POST['payload']) || trim($_POST['payload']) === '') {
    header("HTTP/1.0 400 bad request");
    response("0", "Data's Not valid");
}
$d = json_decode($_POST['payload']);
$ct_no = !isset($d->ct_no) || trim($d->ct_no) === '' ? "" : trim($d->ct_no);
if ($ct_no === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter cutting list Number");
    exit;
}
$ct_mono = !isset($d->ct_mono) || trim($d->ct_mono) === '' ? "" : trim($d->ct_mono);
if ($ct_mono === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Mo Number");
    exit;
}

$ct_marking = !isset($d->ct_marking) || trim($d->ct_marking) === '' ? "" : trim($d->ct_marking);
if ($ct_marking === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Marking");
    exit;
}

$ct_description = !isset($d->ct_description) || trim($d->ct_description) === '' ? "" : trim($d->ct_description);
if ($ct_description === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Description");
    exit;
}

$ct_location = !isset($d->ct_location) || trim($d->ct_location) === '' ? "" : trim($d->ct_location);
if ($ct_location === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Location");
    exit;
}

$ct_qty = !isset($d->ct_qty) || trim($d->ct_qty) === '' ? "" : trim($d->ct_qty);
if ($ct_qty === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Qty");
    exit;
}
if (!is_numeric($ct_qty)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Qty Not valid Format");
    exit;
}

$ct_height = !isset($d->ct_height) || trim($d->ct_height) === '' ? "0" : trim($d->ct_height);
if ($ct_height === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Height");
    exit;
}
if (!is_numeric($ct_height)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Height valid Format");
    exit;
}

$ct_width = !isset($d->ct_width) || trim($d->ct_width) === '' ? "0" : trim($d->ct_width);
if ($ct_width === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Width");
    exit;
}
if (!is_numeric($ct_width)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Width valid Format");
    exit;
}

$ct_area = !isset($d->ct_area) || trim($d->ct_area) === '' ? "0" : trim($d->ct_area);
if ($ct_area === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Area Width");
    exit;
}
if (!is_numeric($ct_area)) {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Area valid Format");
    exit;
}


$ct_doneby = !isset($d->ct_doneby) || trim($d->ct_doneby) === '' ? "" : trim($d->ct_doneby);
if ($ct_doneby === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Done By");
    exit;
}


$ct_doneby = !isset($d->ct_doneby) || trim($d->ct_doneby) === '' ? "" : trim($d->ct_doneby);
if ($ct_doneby === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Done By");
    exit;
}
$ct_section = !isset($d->ct_section) || trim($d->ct_section) === '' ? "" : trim($d->ct_section);
if ($ct_section === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Sheet Type");
    exit;
}

$ct_mrefno = !isset($d->ct_mrefno) || trim($d->ct_mrefno) === '' ? "" : trim($d->ct_mrefno);
if ($ct_mrefno === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Glass Order Referace Number");
    exit;
}

$account_flag = !isset($d->account_flag) || trim($d->account_flag) === '' ? "0" : trim($d->account_flag);
if ($account_flag === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Enter Enter Account Status");
    exit;
}
$account_release = date("Y-m-d");
if ((int)$account_flag > 1) {
    $account_release = !isset($d->account_release) || trim($d->account_release) === "" ? "" : $d->account_release;
    if ($account_release === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Account Released Date");
        exit;
    }

    if (!date_create($account_release)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Account Release Date Not valid Format");
        exit;
    }
    $account_release = date_format(date_create($account_release), 'Y-m-d');
}

$account_return = date('Y-m-d');
if ((int)$account_flag === 3) {
    $account_return = !isset($d->account_return) || trim($d->account_return) === "" ? "" : $d->account_return;
    if ($account_return === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Account Return Date");
        exit;
    }

    if (!date_create($account_return)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Account Return Date Not valid Format");
        exit;
    }
    $account_return = date_format(date_create($account_return), 'Y-m-d');
}



$matterial_flag = !isset($d->matterial_flag) || trim($d->matterial_flag) === '' ? "0" : trim($d->matterial_flag);
$material_release = date('Y-m-d');
$material_return = date('Y-m-d');

if ((int)$matterial_flag > 2) {
    $material_release = !isset($d->material_release) || trim($d->material_release) === "" ? "" : $d->material_release;
    if ($material_release === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Released Date");
        exit;
    }

    if (!date_create($material_release)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Account Material Date Not valid Format");
        exit;
    }
    $material_release = date_format(date_create($material_release), 'Y-m-d');
}

if ((int)$matterial_flag === 3) {
    $material_return = !isset($d->material_return) || trim($d->material_return) === "" ? "" : $d->material_return;
    if ($material_return === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Return Date");
        exit;
    }

    if (!date_create($material_return)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Material Return Date Not valid Format");
        exit;
    }
    $material_return = date_format(date_create($material_return), 'Y-m-d');
}


$operation_flag = !isset($d->operation_flag) || trim($d->operation_flag) === '' ? "0" : trim($d->operation_flag);
$operation_release = date('Y-m-d');
$operation_return = date('Y-m-d');


if ((int)$operation_flag > 2) {
    $operation_release = !isset($d->operation_release) || trim($d->operation_release) === "" ? "" : $d->operation_release;
    if ($operation_release === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Released Date");
        exit;
    }

    if (!date_create($operation_release)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Account Material Date Not valid Format");
        exit;
    }
    $operation_release = date_format(date_create($operation_release), 'Y-m-d');
}

if ((int)$operation_flag === 3) {
    $operation_return = !isset($d->operation_return) || trim($d->operation_return) === "" ? "" : $d->operation_return;
    if ($operation_return === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Return Date");
        exit;
    }

    if (!date_create($operation_return)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Material Return Date Not valid Format");
        exit;
    }
    $operation_return = date_format(date_create($operation_return), 'Y-m-d');
}


$production_flag = !isset($d->production_flag) || trim($d->production_flag) === '' ? "1" : $d->production_flag;
$production_release = date('Y-m-d');
if ((int)$production_flag >= 2) {
    $production_release = !isset($d->production_release) || trim($d->production_release) === "" ? "" : $d->production_release;
    if ($production_release === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Return Date");
        exit;
    }

    if (!date_create($production_release)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Material Return Date Not valid Format");
        exit;
    }

    $production_release = date_format(date_create($production_release), 'Y-m-d');
}


$production_accept = date('Y-m-d');
if ((int)$production_flag === 3) {
    $production_accept = !isset($d->production_accept) || trim($d->production_accept) === "" ? "" : $d->production_accept;
    if ($production_accept === '') {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Material Return Date");
        exit;
    }

    if (!date_create($production_accept)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Material Return Date Not valid Format");
        exit;
    }

    $production_accept = date_format(date_create($production_accept), 'Y-m-d');
}



$ct_type = !isset($d->ct_type) || trim($d->ct_type) === "" ? "MO" : $d->ct_type;
$mgono = !isset($d->mgono) || trim($d->mgono) === "" ? "" : $d->mgono;
$materialstatus = !isset($d->materialstatus) || trim($d->materialstatus) === "" ? "" : $d->materialstatus;
$materialrefno = !isset($d->materialrefno) || trim($d->materialrefno) === "" ? "" : $d->materialrefno;
$forlocation = !isset($d->forlocation) || trim($d->forlocation) === "" ? "" : $d->forlocation;
$projectid = !isset($d->projectid) || trim($d->projectid) === "" ? "" : $d->projectid;
$ctunit = !isset($d->ctunit) || trim($d->ctunit) === "" ? "" : $d->ctunit;
$boqid = !isset($d->boqid) || trim($d->boqid) === "" ? "" : $d->boqid;
$ct_notes = !isset($d->ct_notes) || trim($d->ct_notes) === "" ? "" : $d->ct_notes;

$cttype = !isset($d->cttype) || trim($d->cttype) === '' ? '' : $d->cttype;
$ctprojectname = !isset($d->ctprojectname) || trim($d->ctprojectname) === '' ? '' : $d->ctprojectname;
$ctprojectlocation = !isset($d->ctprojectlocation) || trim($d->ctprojectlocation) === '' ? '' : $d->ctprojectlocation;
$ctprojectno = !isset($d->ctprojectno) || trim($d->ctprojectno) === '' ? '' : $d->ctprojectno;

//validation area
$params = array(
    ':ct_no' => $ct_no,
    ':ct_type' => $ct_type,
    ':ct_mono' => $ct_mono,
    ':ct_marking' => $ct_marking,
    ':ct_description' => $ct_description,
    ':ct_location' => $ct_location,
    ':ct_qty' => $ct_qty,
    ':ct_height' => $ct_height,
    ':ct_width' => $ct_width,
    ':ct_area' => $ct_area,
    ':ct_doneby' => $ct_doneby,
    ':ct_date' => date('Y-m-d'),
    ':ct_section' => $ct_section,
    ':ct_mrefno' => $ct_mrefno,
    ':ct_cddate' => $ddate,
    ':ct_eddate' => $ddate,
    ':ct_cby' => $uuser,
    ':ct_eby' => $uuser,
    ':account_flag' => $account_flag,
    ':matterial_flag' => $matterial_flag,
    ':operation_flag' => $operation_flag,
    ':production_flag' => $production_flag,
    ':production_returnflag' => "1",
    ':account_release' => $account_release,
    ':account_return' => $account_return,
    ':material_release' => $material_release,
    ':material_return' => $material_return,
    ':operation_release' => $operation_release,
    ':operation_return' => $operation_return,
    ':production_release' => $production_release,
    ':production_accept' => date('Y-m-d'),
    ':ctunit' => $ctunit,
    ':mgono' => $mgono,
    ':materialstatus' => $materialstatus,
    ':materialrefno' => $materialrefno,
    ':forlocation' => $forlocation,
    ':projectid' => $projectid,
    ':iscancelled' => "1",
    ':cancelreson' => "-",
    ':cancelledby' => "-",
    ':cancelleddate' => date('Y-m-d'),
    ':issupersede' => "1",
    ':supersededate' => date('Y-m-d'),
    ':supersedeby' => "-",
    ':supersededescription' => "-",
    ':supersedeoldctno' => "-",
    ':supersedemono' => "-",
    ':boqid' => $boqid,
    ":ct_notes" => $ct_notes,
    ":cttype" => $cttype,
    ":ctprojectname" => $ctprojectname,
    ":ctprojectlocation" => $ctprojectlocation,
    ":ctprojectno" => $ctprojectno

);
$sql = "INSERT INTO pms_cuttinglist values(
        null,
        :ct_no,
        :ct_type,
        :ct_mono,
        :ct_marking,
        :ct_description,
        :ct_location,
        :ct_qty,
        :ct_height,
        :ct_width,
        :ct_area,
        :ct_doneby,
        :ct_date,
        :ct_section,
        :ct_mrefno,
        :ct_cddate,
        :ct_eddate,
        :ct_cby,
        :ct_eby,
        :account_flag,
        :matterial_flag,
        :operation_flag,
        :production_flag,
        :production_returnflag,
        :account_release,
        :account_return,
        :material_release,
        :material_return,
        :operation_release,
        :operation_return,
        :production_release,
        :production_accept,
        :ctunit,
        :mgono,
        :materialstatus,
        :materialrefno,
        :forlocation,
        :projectid,       
        :iscancelled, 
        :cancelreson,
        :cancelledby,
        :cancelleddate,
        :issupersede,
        :supersededate,
        :supersedeby,
        :supersededescription,
        :supersedeoldctno,
        :supersedemono,
        :boqid,
        :ct_notes,
        :cttype,
        :ctprojectname,
        :ctprojectlocation,
        :ctprojectno
    )";

$cm = $cn->prepare($sql);
$issave = $cm->execute($params);

unset($cm, $sql);

if (!$issave) {
    header("HTTP/1.0 500 inertnal server error");
    echo response("0", "Error on saving Data");
    exit;
}
header("HTTP/1.0 201 ok saved");
echo response("1", "Data Has Saved");
sendmail($params);
exit;


function sendmail($rpt){

$current_department = "-";
$current_status = "-";

$issuedate = "-";
$issuedate_d =date('Y-m-d');

$returndate = "-";
$returndate_d = date('Y-m-d');

if ((string)$rpt[':account_flag'] === "3") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_department = "Account";
    $current_status = "3";
    $returndate = $rpt[':account_return'];
    $returndate_d = $rpt[':account_return'];
    $issuedate = $rpt[':account_release'];
    $issuedate_d = $rpt[':account_release'];
}
if ((string)$rpt[':account_flag'] === "2") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "2";
    $current_department = "Account";
    $issuedate = $rpt[':account_release'];
    $issuedate_d = $rpt[':account_release'];
}

//if it is material
if ((string)$rpt[':matterial_flag'] === "3") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "3";
    $current_department = "Material";
    $returndate = $rpt[':material_return'];
    $returndate_d = $rpt[':material_return'];
    $issuedate = $rpt[':material_release'];
    $issuedate_d = $rpt[':material_release'];
}

if ((string)$rpt[':matterial_flag'] === "2") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "2";
    $current_department = "Material";
    $issuedate = $rpt[':material_release'];
    $issuedate_d = $rpt[':material_release'];
}

//if it is operation 
if ((string)$rpt[':operation_flag'] === "3") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "3";
    $current_department = "Operation";
    $returndate = $rpt[':operation_return'];
    $returndate_d = $rpt[':operation_return'];
    $issuedate = $rpt[':operation_release'];
    $issuedate_d = $rpt[':operation_release'];
}

if ((string)$rpt[':operation_flag'] === "2") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "2";
    $current_department = "Operation";
    $issuedate = $rpt[':operation_release'];
    $issuedate_d = $rpt[':operation_release'];
}

//if is it production
if ((string)$rpt[':production_flag'] === "3") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "3";
    $current_department = "Production";
    $returndate = $rpt[':production_accept'];
    $returndate_d = $rpt[':production_accept'];

    $issuedate = $rpt[':production_accept'];
    $issuedate_d = $rpt[':production_accept'];
}

if ((string)$rpt[':production_flag'] === "2") {
    $current_department = "-";
    $current_status = "-";
    $issuedate = "-";
    $issuedate_d =date('Y-m-d');
    $returndate = "-";
    $returndate_d =date('Y-m-d');

    $current_status = "2";
    $current_department = "Production";
    $issuedate = $rpt[':production_accept'];
    $issuedate_d = $rpt[':production_accept'];

    $issuedate = $rpt[':production_accept'];
    $issuedate_d = $rpt[':production_accept'];
}

$cttype = (string)$rpt[":ct_type"] === "1" ? "GO" : "SAMPLE";
$pjno =$rpt[':ctprojectno'];;
$pjname = $rpt[':ctprojectname'];
$cuttinglistno = $rpt[':ct_no'];
$mono = $rpt[':ct_mono'];
$description = $rpt[':ct_description'];;
$qty = $rpt[':ct_qty'];
$area = $rpt[':ct_area'];
$units =$rpt[':ctunit'];
$engg = $rpt[':ct_doneby'];
$cdep = $current_department;
$cdepd = $issuedate;
$to = "it@alunafco.net, nafcoit@alunafco.net";
$subject = "CUTTING LIST ENTRY REPORT";
$message = "<!DOCTYPE html>
<html>
<head>
    <title>NAFCO - CUTTING LIST</title>
    <style>
        *{
            margin:0;
            padding:0;            
        }
        body{
            zoom : 95%;
            width: 100%;
            font-family: sans-serif;
            font-size: 0.70rem;
        }
        body div{
            margin: 10px 10px;
        }
        table{
            border-collapse: collapse;
            border:1px solid #e9e5e5;
        }
        table td,
        table th{
            border-bottom: 1px solid #c1c1c1;
            padding : 5px;
            font-size: 0.70rem;
        }
        .main{
            background-color: #e5e5e5;            
            font-size: 0.70rem;
        }
        .sub{
            font-weight: bold;
            font-size: 0.70rem;
        }
    </style>
</head>
<body>
    <div>
        <table>
            <thead>                
                <tr>
                    <td class='main'>Project</td>
                    <td class='sub'>".$pjname." [".$pjno."]</td>
                </tr>                
            </thead>
            <tbody>
             <tr>
                    <td class='main'>Type</td>
                    <td class='sub'>".$cttype."</tr>
                </tr>
                <tr>
                    <td class='main'>Cutting List#</td>
                    <td class='sub'>".$cuttinglistno."</tr>
                </tr>
                <tr>
                    <td class='main'>MO#</td>
                    <td class='sub'>".$mono."</tr>
                </tr>
                <tr>
                    <td class='main'>Description</td>
                    <td class='sub'>".$description."</tr>
                </tr>
                <tr>
                    <td class='main'>Qty</td>
                    <td class='sub'>".$qty." [".$units."]</tr>
                </tr>
                <tr>
                    <td class='main'>Area</td>
                    <td class='sub'>".$area."</tr>
                </tr>
                <tr>
                    <td class='main'>Drawing</td>
                    <td class='sub'>".$engg."</tr>
                </tr>
                <tr>
                    <td class='main'>Department</td>
                    <td class='sub'>".$cdep." </tr>
                </tr>
                <tr>
                    <td class='main'>Release Date</td>
                    <td class='sub'>".$cdepd." </tr>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <report@alunafco.net>' . "\r\n";
//$headers .= 'Cc: ismailarafath@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);
}