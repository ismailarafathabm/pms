<?php
if (!isset($mr)) {
    include_once '../_error.php';
    exit;
}

$d = json_decode($params);
$uuser = $user_name;
$ddate = date("Y-m-d H:i:s");
$mrproject = !isset($d->mrproject) || trim($d->mrproject) === "" ? '' :  $d->mrproject;
$mrcode = !isset($d->mrcode) || trim($d->mrcode) === "" ? '' :  $d->mrcode;
$mrno = !isset($d->mrno) || trim($d->mrno) === "" ? '' :  $d->mrno;
$mrdate = !isset($d->mrdate) || trim($d->mrdate) === "" ? '' :  $d->mrdate;
$mritem = !isset($d->mritem) || trim($d->mritem) === "" ? '' :  $d->mritem;
$mrpartno = !isset($d->mrpartno) || trim($d->mrpartno) === "" ? '-' :  $d->mrpartno;
$mrpartnotai = !isset($d->mrpartnotai) || trim($d->mrpartnotai) === "" ? '-' :  $d->mrpartnotai;
$mrdieweight = !isset($d->mrdieweight) || trim($d->mrdieweight) === "" ? '0' :  $d->mrdieweight;
$mrreqlength = !isset($d->mrreqlength) || trim($d->mrreqlength) === "" ? '0' :  $d->mrreqlength;
$mrreqtotweight = !isset($d->mrreqtotweight) || trim($d->mrreqtotweight) === "" ? '0' :  $d->mrreqtotweight;
$mrreqqty = !isset($d->mrreqqty) || trim($d->mrreqqty) === "" ? '' :  $d->mrreqqty;
$mrboqno = !isset($d->mrboqno) || trim($d->mrboqno) === "" ? '' :  $d->mrboqno;
$mravaiqty = !isset($d->mravaiqty) || trim($d->mravaiqty) === "" ? '0' :  $d->mravaiqty;
$mraviweight = !isset($d->mraviweight) || trim($d->mraviweight) === "" ? '0' :  $d->mraviweight;
$mrorderedqty = !isset($d->mrorderedqty) || trim($d->mrorderedqty) === "" ? '0' :  $d->mrorderedqty;
$mrorderedweight = !isset($d->mrorderedweight) || trim($d->mrorderedweight) === "" ? '0' :  $d->mrorderedweight;
$mrfinish = !isset($d->mrfinish) || trim($d->mrfinish) === "" ? '-' :  $d->mrfinish;
$mrremarks = !isset($d->mrremarks) || trim($d->mrremarks) === "" ? '-' :  $d->mrremarks;
$mrcheckedby = !isset($d->mrcheckedby) || trim($d->mrcheckedby) === "" ? '' :  $d->mrcheckedby;
$mrapprovedby = !isset($d->mrapprovedby) || trim($d->mrapprovedby) === "" ? '' :  $d->mrapprovedby;
$releaseddate = !isset($d->releaseddate) || trim($d->releaseddate) === "" ? '' :  $d->releaseddate;
$mrunit = !isset($d->mrunit) || trim($d->mrunit) === "" ? '' :  $d->mrunit;
$preparedby = !isset($d->preparedby) || trim($d->preparedby) === "" ? '' :  $d->preparedby;

if($mrcode === ''){
    echo response("0","Enter MR Code");
    exit;
}

if($mrno === ''){
    echo response("0","Enter MR NO");
    exit;
}
if($mrdate === ''){
    echo response("0","Enter MR Date");
    exit;
}
if(!date_create($mrdate)){
    echo response("0","Date is not valid Format");
    exit;
}

if($mritem === ''){
    echo response("0","Enter Item name");
    exit;
}
if($mrpartno === ''){
    echo response("0","Enter Item Part No");
    exit;
}
if($mrdieweight === ''){
    echo response("0","EnterItem Die Weight");
    exit;
}
if($mrreqlength === ''){
    echo response("0"," Enter Item Length");
    exit;
}
if($mrreqqty === ''){
    echo response("0"," Enter Reqire Qty");
    exit;
}
if(!is_numeric($mrreqqty)){
    echo response("0"," Entered Reqire Qty Is not valid Number");
    exit;
}

if($mrboqno === ''){
    echo response("0","Enter BOQ Number");
    exit;
}
if($mravaiqty === ''){
    echo response("0"," Enter Available Qty");
    exit;
}

if(!is_numeric($mravaiqty)){
    echo response("0"," Entered Available Qty Is not valid Number");
    exit;
}

if($mraviweight === ''){
    echo response("0"," Enter Material Finish ");
    exit;
}

$x = array(
    ':mrproject' => $mrproject,
    ':mrcode' => $mrcode,
    ':mrno' => $mrno,
    ':mrdate' => date_format(date_create($d->mrdate),'Y-m-d'),
    ':mritem' => $mritem,
    ':mrpartno' => $mrpartno,
    ':mrpartnotai' => $mrpartnotai,
    ':mrdieweight' => $mrdieweight,
    ':mrreqlength' => $mrreqlength,
    ':mrreqqty' => $mrreqqty,
    ':mrreqtotweight' => $mrreqtotweight,
    ':mrboqno' => $mrboqno,
    ':mravaiqty' => $mravaiqty,
    ':mraviweight' => $mraviweight,
    ':mrorderedqty' => $mrorderedqty,
    ':mrorderedweight' => $mrorderedweight,
    ':mrcby' => $uuser,
    ':mreby' => $uuser,
    ':mrcdate' => $ddate,
    ':mredate' => $ddate,
    ':mrfinish' => $mrfinish,
    ':mrremarks' => $mrremarks,
    ':mrcheckedby' => $mrcheckedby,
    ':mrapprovedby' => $mrapprovedby,
    ':releaseddate' => $releaseddate,
    ':mrunit' => $mrunit,
    ':preparedby' => $preparedby
);

echo $mr->Savesinglemr($x);
exit;
