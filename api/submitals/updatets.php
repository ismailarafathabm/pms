<?php 
    if(!isset($ts)){
        include_once '../_error.php';
        exit;
    }
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");

    $data = json_decode($payload);
    $list = $data->list;
    $commad = $data->commands;
    //print_r($data);

    if(!isset($data->data->techsub_id) || trim($data->data->techsub_id) === ''){
        header("HTTP/1.0 400 Bad Request");
        echo response("0","Choose Any Submittal");
    }
    $techsub_id = $data->data->techsub_id;
    $techsub_project = $data->data->techsub_project;
    $techsub_number = $data->data->techsub_number;
    $techsub_rvno = $data->data->techsub_rvno;
    $techsub_date = date_format(date_create($data->data->techsub_date),'Y-m-d');
    $techsub_purpose = $data->data->techsub_purpose;
    $techsub_remarks = $data->data->techsub_remarks;
    $techsub_submittedby = $data->data->techsub_submittedby;
    $techsub_subdate = date_format(date_create($data->data->techsub_subdate),'Y-m-d');
    $techsub_status = $data->data->techsub_status;
    $techsub_statusdate = date_format(date_create($data->data->techsub_date),'Y-m-d');
    $techsub_remarksdt = $data->data->techsub_remarksdt;
    $techsub_description = $data->data->techsub_description;
    $techsub_spctype = $data->data->techsub_spctype;
    $techsub_qty = $data->data->techsub_qty;
    $techsub_cby = $uuser;
    $techsub_eby = $uuser;
    $techsub_cdate = $ddate;
    $techsub_edate = $ddate;
    $techsub_extra = $data->data->techsub_extra;
    $svdata = array(        
        ':techsub_date' => $techsub_date,
        ':techsub_purpose' => json_encode($techsub_purpose),
        ':techsub_remarks' => json_encode($techsub_remarks),
        ':techsub_submittedby' => $techsub_submittedby,
        ':techsub_subdate' => $techsub_subdate,                
        ':techsub_remarksdt' => $techsub_remarksdt,
        ':techsub_description' => $techsub_description,
        ':techsub_spctype' => $techsub_spctype,
        ':techsub_qty' => $techsub_qty,        
        ':techsub_eby' => $techsub_eby,        
        ':techsub_edate' => $techsub_edate,
        ':techsub_extra' => $techsub_extra,//19
        ':techsub_id' => $techsub_id
    );
    $saveinfo = array(
        ':techsub_project' => $techsub_project,
        ':techsub_number' => $techsub_number,
        ':techsub_rvno' => $techsub_rvno,
        ':techsub_date' => $techsub_date,
        ':techsub_purpose' => json_encode($techsub_purpose),
        ':techsub_remarks' => json_encode($techsub_remarks),
        ':techsub_submittedby' => $techsub_submittedby,
        ':techsub_subdate' => $techsub_subdate,
        ':techsub_status' => $techsub_status,
        ':techsub_statusdate' => $techsub_statusdate,
        ':techsub_remarksdt' => $techsub_remarksdt,
        ':techsub_description' => $techsub_description,
        ':techsub_spctype' => $techsub_spctype,
        ':techsub_qty' => $techsub_qty,
        ':techsub_cby' => $techsub_cby,
        ':techsub_eby' => $techsub_eby,
        ':techsub_cdate' => $techsub_cdate,
        ':techsub_edate' => $techsub_edate,
        ':techsub_extra' => $techsub_extra,//19
    );
    // print_r($svdata);
    // exit;

    echo $ts->updateTechSubmital($svdata,$list,$commad,$saveinfo);
    exit;

?>