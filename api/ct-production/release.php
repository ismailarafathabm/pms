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
if ($payload === "") {
    header('http/1.0 409 error input');
    echo response("0", "Payload Missing");
    exit();
}
$datas = json_decode($payload);
//print_r($datas);
$refno = !isset($_POST['refno']) || trim($_POST['refno']) === "" ? "" : trim($_POST['refno']);
if($refno === ""){
    header("http/1.0 409 input missing");
    echo response("0","Release Referance Number Missing");
    exit();
}

$outdate = !isset($_POST['outdate']) || trim($_POST['outdate']) === "" ? "" : trim($_POST['outdate']);
if($outdate === ""){
    header("http/1.0 409 input missing");
    echo response("0","Release Date Missing");
    exit();
}

if(!date_create($outdate)){
    header("http/1.0 409 not valid input");
    echo response("0","Data is Not Valid Format");
    exit();
}
//check file
if(!is_uploaded_file($_FILES['pdffile']['tmp_name'])){
    header("http/1.0 409 not valid input");
    echo response("0","Upload file Missing");
    exit();
}
$pdffile = $_FILES['pdffile']['name'];
$ext = strtolower(pathinfo($pdffile, PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    header("HTTP/1.0 400 bad request");
    echo response("0", "File Should Be PDF format");
    exit;
}
$outno = $refno;
$outdate = date_format(date_create($outdate),'Y-m-d');
$ftoken = $user->token(25) . "_" . $user->enc('enc',$uuser) . "_" . date('YmdHis');
foreach($datas as $d){
    $outqty = !isset($d->outqty) || trim($d->outqty) === "" ? "" : trim($d->outqty);
    if($outqty === ""){
        header("http/1.0 409 input missing");
        echo response("0","Enter Qty");
        exit();
    }
    if(!is_numeric($outqty)){
        header("http/1.0 409 not valid input");
        echo response("0","Qty Not valid format");
        exit();
    }
    if((double)$outqty === 0){
        header("http/1.0 409 check input value");
        echo response("0","Enter qty value should be more then 0");
        exit();
    }

    $outarea = !isset($d->outarea) || trim($d->outarea) === "" ? "" : trim($d->outarea);
    if($outarea === ""){
        header("http/1.0 409 input missing");
        echo response("0","Enter Area");
        exit();
    }
    if(!is_numeric($outarea)){
        header("http/1.0 409 not valid input");
        echo response("0","Area Not valid format");
        exit();
    }

    $outcno = !isset($d->outcno) || trim($d->outcno) === "" ? "" : trim($d->outcno);
    if($outcno === ""){
        header('http/1.0 409 input missing');
        echo response("0" , "some input missing");
        exit();
    }   
}

foreach($datas as $d){
    $outqty = !isset($d->outqty) || trim($d->outqty) === "" ? "" : trim($d->outqty);
    if($outqty === ""){
        header("http/1.0 409 input missing");
        echo response("0","Enter Qty");
        exit();
    }
    if(!is_numeric($outqty)){
        header("http/1.0 409 not valid input");
        echo response("0","Qty Not valid format");
        exit();
    }
    if((double)$outqty === 0){
        header("http/1.0 409 check input value");
        echo response("0","Enter qty value should be more then 0");
        exit();
    }

    $outarea = !isset($d->outarea) || trim($d->outarea) === "" ? "" : trim($d->outarea);
    if($outarea === ""){
        header("http/1.0 409 input missing");
        echo response("0","Enter Area");
        exit();
    }
    if(!is_numeric($outarea)){
        header("http/1.0 409 not valid input");
        echo response("0","Area Not valid format");
        exit();
    }

    $outcno = !isset($d->outcno) || trim($d->outcno) === "" ? "" : trim($d->outcno);
    if($outcno === ""){
        header('http/1.0 409 input missing');
        echo response("0" , "some input missing");
        exit();
    }
    $params = array(
        ":outno" => $outno,
        ":outdate" => $outdate,
        ":outqty" => $outqty,
        ":outarea" => $outarea,
        ":outcno" => $outcno,
        ":outcby" => $uuser,
        ":outeby" => $uuser,
        ":outcdate" => $ddate,
        ":outedate" => $ddate,
        ":outflag" => "1",
        ":deltoken" => $ftoken
    );
    $sql = "INSERT INTO pms_cuttinglist_productions_out values(
        null,
        :outno,
        :outdate,
        :outqty,
        :outarea,
        :outcno,
        :outcby,
        :outeby,
        :outcdate,
        :outedate,
        :outflag,
        :deltoken
    )";
    $cm = $cn->prepare($sql);
    $sv = $cm->execute($params);
    unset($cm,$sql,$rows);
    if(!$sv){
        header("http/1.0 500 error");
        echo response("0","Error on saving Data");
        exit();
    }
}
$loc = "../../assets/prodcution/deliver/" . $ftoken . ".pdf";
$mo = move_uploaded_file($_FILES['pdffile']['tmp_name'],$loc);
if(!$mo){
    header("http/1.0 500 error");
    echo response("0","Error on Uploading File");
    exit();
}
header("http/1.0 200 ok");
echo response("1","Data has saved");
exit();