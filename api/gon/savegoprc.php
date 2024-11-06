<?php 
    if(!isset($gon)){
        include_once '../_error.php';
        exit;
    }
    $uuser = $user_name;
    $date = date('Y-m-d H:i:s');
    $payload = json_decode($payload);
    $gonrc_date = $payload->gonrc_date;
    $gonrc_invoice = $payload->gonrc_invoice;
    $gonrc_qty = $payload->gonrc_qty;
    $gonrc_sqm = $payload->gonrc_sqm;
    $gonrc_ppsqm = $payload->gonrc_ppsqm;
    $gonrc_totalprice = $payload->gonrc_totalprice;
    $gonrc_extra = $payload->gonrc_extra;
    $gonrc_finalprice = $payload->gonrc_finalprice;
    $gonrc_remark = $payload->gonrc_remark;
    $gonrc_project = $payload->gonrc_project;
    $gonrc_gopnid = $payload->gonrc_gopnid;
    $gonrc_gonid = $payload->gonrc_gonid;
    $gonrc_cby = $uuser;
    $gonrc_eby = $uuser;
    $gonrc_cdate =  $date;
    $gonrc_edate =  $date;

    $save = array(
        ':gonrc_date' => date_format(date_create($gonrc_date),'Y-m-d'),
        ':gonrc_invoice' => $gonrc_invoice,
        ':gonrc_qty' => $gonrc_qty,
        ':gonrc_sqm' => $gonrc_sqm,
        ':gonrc_ppsqm' => $gonrc_ppsqm,
        ':gonrc_totalprice' => $gonrc_totalprice,
        ':gonrc_extra' => $gonrc_extra,
        ':gonrc_finalprice' => $gonrc_finalprice,
        ':gonrc_remark' => $gonrc_remark,
        ':gonrc_project' => $gonrc_project,
        ':gonrc_gopnid' => $gonrc_gopnid,
        ':gonrc_gonid' => $gonrc_gonid,
        ':gonrc_cby' => $gonrc_cby,
        ':gonrc_eby' => $gonrc_eby,
        ':gonrc_cdate' => $gonrc_cdate,
        ':gonrc_edate' => $gonrc_edate,
    );

    echo $gon->Savegopnrc($save);
    exit;
    
?>