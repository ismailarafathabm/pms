<?php 
if (!isset($mtbl)) {
    include_once '../_error.php';
    exit;
}

if (!isset($loaddate) || trim($loaddate) === "") {
    echo response("0", "Enter Run Date");
    exit;
}
if (!date_create($loaddate)) {
    echo response("0", "Enter Run Date is Not Valid Date Format");
    exit;
}
if (!isset($loadproject) || trim($loadproject) === "") {
    echo response("0", "Enter Project");
    exit;
}
if (!isset($location) || trim($location) === "") {
    echo response("0", "Enter Location");
    exit;
}
if (!isset($driver) || trim($driver) === "") {
    echo response("0", "Enter Driver Name");
    exit;
}
if (!isset($loadingdate) || trim($loadingdate) === "") {
    echo response("0", "Enter Loading Date");
    exit;
}
if (!date_create($loadingdate)) {
    echo response("0", "Enter Loading Date is Not Valid Date Format");
    exit;
}

if (!isset($ascurrentdate) || trim($ascurrentdate) === "") {
    echo response("0", "Enter At Site Date");
    exit;
}
if (!date_create($ascurrentdate)) {
    echo response("0", "Enter At Site Date is Not Valid Date Format");
    exit;
}

if (!isset($remark) || trim($remark) === "") {
    echo response("0", "Enter Remark");
    exit;
}

if (!isset($status) || trim($status) === "") {
    echo response("0", "Enter status");
    exit;
}

if (!isset($pjcno) || trim($pjcno) === "") {
    echo response("0", "Enter Project Number");
    exit;
}
if ($status === "Delivered") {
    if (!isset($estimatetositedate) || trim($estimatetositedate) === "") {
        echo response("0", "Enter At Site Date");
        exit;
    }
    if (!date_create($estimatetositedate)) {
        echo response("0", "Enter At Site Date is Not Valid Date Format");
        exit;
    }

    if (!isset($estimatedate) || trim($estimatedate) === "") {
        echo response("0", "Enter Acutal Loading Date");
        exit;
    }
    if (!date_create($estimatedate)) {
        echo response("0", "Enter Actual Loading Date is Not Valid Date Format");
        exit;
    }
}

$date1 = date_format(date_create($fromdate), "Y-m-d");
$date2 = date_format(date_create($todate), "Y-m-d");

$arr = json_decode($items);
$zmsg = "1";
$zdata = "";
$s1 = [];


foreach($arr as $a){
    if (!is_numeric($a->qty)) {
        $zmsg = "0";
        $zdata = "Some Qty Not A valid Number format";
        break;
    }

    
    if (!is_numeric($a->area)) {
        $zmsg = "0";
        $zdata = "Some Area Not A valid Number format";
        break;
    }
    
    $s1[] = array(
        ":loaddate" => date_format(date_create($loaddate),'Y-m-d'),
        ":loadproject" => $loadproject,
        ":location" => $location,
        ":description" => $a->description,
        ":qty" => $a->qty,
        ":unit" => $a->units,
        ":driver" => $driver,
        ":estimatedate" => date_format(date_create($loadingdate),'Y-m-d'),
        ":loadingdate" =>  $status !== "Delivered" ?date_format(date_create($loadingdate),'Y-m-d') : date_format(date_create($estimatedate),'Y-m-d'),
        ":estimatetositedate" => date_format(date_create($ascurrentdate),'Y-m-d'),
        ":ascurrentdate" => $status !== "Delivered" ? date_format(date_create($ascurrentdate),'Y-m-d') : date_format(date_create($estimatetositedate),'Y-m-d'),
        ":remark" => $remark,
        ":status" => $status,   
        ":rvno" => "0",
        ":cby" => $user_name,
        ":eby" => $user_name,
        ":cdate" => date('Y-m-d H:i:s'),
        ":edate" => date('Y-m-d H:i:s'),        
        ":pjcno" => strtolower($pjcno),
        ":main_load_id" => $a->id,
        ":pjcnoenc" => $pjcnoenc,
        ":area" => $a->area,
        ":invno" => $invno,
    );
   
}

$p3 = array(
    ":st" => $date1,
    ":en" => $date2,
);
// print_r($s1);
echo $mtbl->UpdateAll($s1,$p3);
exit;

?>