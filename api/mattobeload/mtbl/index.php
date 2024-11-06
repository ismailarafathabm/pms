<?php
if (!isset($mtbl)) {
    include_once '../_error.php';
    exit;
}
if(!isset($fromdate) || trim($fromdate) === ""){
    echo response("0","Enter Form Date");
    exit;
}
if(!isset($todate) || trim($todate) === ""){
    echo response("0","Enter Form Date");
    exit;
}
if(!date_create($fromdate)){
    echo response("0","From Date is not valid Date format");
    exit;
}
if(!date_create($todate)){
    echo response("0","To Date is not valid Date format");
    exit;
}
$date1 = date_format(date_create($fromdate),"Y-m-d");
$date2 = date_format(date_create($todate),"Y-m-d");

$param = array(
    ":st" => $date1,
    ":en" => $date2,
);

echo $mtbl->GetReport($param);
exit;