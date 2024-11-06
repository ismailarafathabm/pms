<?php
function _flagStatussTxt($_status)
{
    //echo $_status;
    $flags = array(
        "0" => "N/A",
        "1" => "DIRECT",
        "2" => "F",
        "3" => "R",
        "4" => "RP"
    );
    return $flags[$_status];
}

function _glassordtype($status){
    $statusx = array(
        "1" => "GO",
        "2" => "SAMPLE",
    );
    return $statusx[$status];
}

function _glassordstatys($status){
    $statusx = array(
        "1" => "GLASS ORDER",
        "2" => "REPLACEMENT GLASS ",
    );
    return $statusx[$status];
}

function datemethod($date)
{
    return array(
        "sorting" => date_format(date_create($date), 'Y-m-d'),
        "display" => date_format(date_create($date), 'd-M-Y'),
        "normal" => date_format(date_create($date), 'd-m-Y'),
        "print" => date_format(date_create($date), 'd-m-y'),
    );
}

function _cuttinglistmode($status){
    $statusx = array(
        "1" => "c",
        "2" => "s",
        "3" => "m",
    );
    return $statusx[$status];
}


function ColsForCuttingList($rows)
{
    extract($rows);
    $cols = [];
    $cols['ct_id'] = (int)$ct_id;
    $cols['ct_no'] = $ct_no;
    $cols['ct_type'] = $ct_type;
    $cols['ct_mono'] = $ct_mono;
    $cols['ct_marking'] = $ct_marking;
    $cols['ct_description'] = $ct_description;
    $cols['ct_location'] = $ct_location;
    $cols['ct_qty'] = $ct_qty;
    $cols['ct_height'] = $ct_height;
    $cols['ct_width'] = $ct_width;
    $cols['ct_area'] = $ct_area;
    $cols['ctunit'] = $ctunit;
    $cols['ct_doneby'] = $ct_doneby;
    $cols['ct_date'] = $ct_date;
    $cols['ct_date_l'] = datemethod($ct_date);
    $cols['ct_section'] = $ct_section;
    $cols['ct_mrefno'] = $ct_mrefno;
    $cols['ct_cddate'] = $ct_cddate;
    $cols['ct_eddate'] = $ct_eddate;
    $cols['ct_cby'] = $ct_cby;
    $cols['ct_eby'] = $ct_eby;
    $cols['account_flag'] = (string)$account_flag;
    $cols['account_status'] = _flagStatussTxt($account_flag);
    $cols['matterial_flag'] =(string)$matterial_flag;
    $cols['matterial_status'] = _flagStatussTxt($matterial_flag);
    $cols['operation_flag'] = (string)$operation_flag;
    $cols['operation_status'] = _flagStatussTxt($operation_flag);
    $cols['production_flag'] = (string)$production_flag;
    $cols['production_status'] = _flagStatussTxt($production_flag);
    $cols['production_returnflag'] = (string)$production_returnflag;
    $cols['production_returnstatus'] = _flagStatussTxt($production_returnflag);

    $cols['account_release'] = (string)$account_release;
    $cols['account_release_l'] = datemethod($account_release);
    $cols['account_return'] = (string)$account_return;
    $cols['account_return_l'] = datemethod($account_return);
    $cols['material_release'] = (string)$material_release;
    $cols['material_release_l'] = datemethod($material_release);
    $cols['material_return'] = (string)$material_return;
    $cols['material_return_l'] = datemethod($material_return);
    $cols['operation_release'] = (string)$operation_release;
    $cols['operation_release_l'] = datemethod($operation_release);
    $cols['operation_return'] = (string)$operation_return;
    $cols['operation_return_l'] = datemethod($operation_return);
    $cols['production_release'] = (string)$production_release;
    $cols['production_release_l'] = datemethod($production_release);
    $cols['production_accept'] = (string)$production_accept;
    $cols['production_accept_l'] = datemethod($production_accept);
    $cols['mgono'] = $mgono;
    $cols['materialstatus'] = $materialstatus;
    $cols['materialrefno'] = $materialrefno;
    $cols['forlocation'] = $forlocation;
    $cols['projectid'] = $projectid;
    $cols['iscancelled'] = $iscancelled;
    $cols['cancelreson'] = $cancelreson;
    $cols['cancelledby'] = $cancelledby;
    $cols['cancelleddate'] = $cancelleddate;
    $cols['cancelleddate_d'] = datemethod($cancelleddate);
    $cols['issupersede'] = $issupersede;
    $cols['supersededate'] = $supersededate;
    $cols['supersededate_d'] = datemethod($supersededate);
    $cols['supersedeby'] = $supersedeby;
    $cols['supersededescription'] = $supersededescription;
    $cols['supersedeoldctno'] = $supersedeoldctno;
    $cols['supersedemono'] = $supersedemono;
    $cols['boqid'] = $boqid;
    $cols['ct_notes'] = $ct_notes;
    $cols['cttype'] = $cttype;
    //$cols['cttype'] = _cuttinglistmode($cttype);
  
    $cols['ctprojectname'] = $ctprojectname;
    $cols['ctprojectlocation'] = $ctprojectlocation;
    $cols['ctprojectno'] = $ctprojectno;
    
    return $cols;
}
function godepartmentstatus($status){
    $statusx = array(
        "0" => "N/A",
        "1" => "Estimation",
        "2" => "Procurement",
    );
    return $statusx[$status];
}
function glassorder($rows){
    extract($rows);
    $cols = [];
    $cols['goid'] = $goid;
    $cols['gono'] = $gono;
    $cols['gorefno'] = $gorefno;
    $cols['goproject'] = $goproject;
    $cols['goprojectname'] = $goprojectname;
    $cols['goprojectlocation'] = $goprojectlocation;
    $cols['gosupplier'] = $gosupplier;
    $cols['gogtype'] = $gogtype;
    $cols['gospec'] = $gospec;
    $cols['gomarking'] = $gomarking;
    $cols['goqty'] = $goqty;
    $cols['goarea'] = $goarea;
    $cols['gotype'] = $gotype;
    $cols['gotype_txt'] = _glassordstatys($gotype);
    $cols['godoneby'] = $godoneby;
    $cols['godoneby'] = $godoneby;
    $cols['goorddate'] = $goorddate;
    $cols['goorddate_l'] = datemethod($goorddate);
    $cols['gortopurchase'] = (string)$gortopurchase;
    $cols['gortopurchase_l'] = datemethod($gortopurchase);
    $cols['gofrmpurchase'] = (string)$gofrmpurchase;
    $cols['gofrmpurchase_l'] = datemethod($gofrmpurchase);
    $cols['gostatus'] = (string)$gostatus;
    $cols['gostatus_txt'] = _flagStatussTxt($gostatus);
    $cols['goremark'] = $goremark;
    $cols['cby'] = $cby;
    $cols['eby'] = $eby;
    $cols['cdate'] = $cdate;
    $cols['cedate'] = $cedate;  
    $cols['projectid'] = $projectid;
    $cols['gogotype'] = $gogotype;
    $cols['gogotype_txt'] = _glassordtype($gogotype);
    
    $cols['godepartmentflag'] = $godepartmentflag;
    $cols['godepartmentflag_txt'] = godepartmentstatus($godepartmentflag);

    $cols['godepforward'] = $godepforward;
    $cols['godepforward_l'] = datemethod($godepforward);
    
    $cols['godepreceived'] = $godepreceived;
    $cols['godepreceived_l'] = datemethod($godepreceived);

    return $cols;
}
