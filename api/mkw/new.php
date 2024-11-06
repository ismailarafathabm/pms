<?php 
     if(!isset($mkw)){
        include_once '../_error.php';
        exit;
    }

    if(!isset($mnt_pjcno) || trim($mnt_pjcno) === ""){
        echo response("0","Enter Project No");exit;
    }
    if(!isset($mnt_contractor) || trim($mnt_contractor) === ""){
        echo response("0","Enter Contractor Name");exit;
    }
    if(!isset($mnt_contactpersion) || trim($mnt_contactpersion) === ""){
        echo response("0","Enter Contact Persion");exit;
    }
    if(!isset($mnt_location) || trim($mnt_location) === ""){
        echo response("0","Enter Location");exit;
    }
    if(!isset($mnt_region) || trim($mnt_region) === ""){
        echo response("0","Enter Region");exit;
    }
    if(!isset($mnt_startdate) || trim($mnt_startdate) === ""){
        echo response("0","Enter Start Date");exit;
    }
    if(!date_create($mnt_startdate)){
        echo response("0","Start Date Not valid Format");exit;
    }
    if(!isset($mnt_enddate) || trim($mnt_enddate) === ""){
        echo response("0","Enter End Date");exit;
    }
    if(!date_create($mnt_enddate)){
        echo response("0","End Date Not valid Format");exit;
    }

    if(!isset($mnt_warrenty) || trim($mnt_warrenty) === ""){
        echo response("0","Enter warranty Informations");exit;
    }

    if(!isset($mnt_billingtype) || trim($mnt_billingtype) === ""){
        echo response("0","Enter Billing Informations");exit;
    }

    if(!isset($mnt_pjmanager) || trim($mnt_pjmanager) === ""){
        echo response("0","Enter Project Manger Name");exit;
    }

    if(!isset($mnt_project_foreman) || trim($mnt_project_foreman) === ""){
        echo response("0","Enter Project Foreman Name");exit;
    }

    if(!isset($mnt_project_eng) || trim($mnt_project_eng) === ""){
        echo response("0","Enter Project Engineer Name");exit;
    }

    if(!isset($projectname) || trim($projectname) === ""){
        echo response("0","Enter Project Name");exit;
    }

    if(!isset($sub) || trim($sub) === ""){
        echo response("0","Enter Scope Of work Informations");exit;
    }

    $_sub = json_decode($sub);

    $params = array(
        ":mnt_pjcno" => $mnt_pjcno,
        ":mnt_contractor" => $mnt_contractor,
        ":mnt_contactpersion" => $mnt_contactpersion,
        ":mnt_location" => $mnt_location,
        ":mnt_region" => $mnt_region,
        ":mnt_startdate" => date_format(date_create($mnt_startdate),"Y-m-d"),
        ":mnt_enddate" =>  date_format(date_create($mnt_enddate),"Y-m-d"),
        ":mnt_warrenty" => $mnt_warrenty,
        ":mnt_billingtype" => $mnt_billingtype,
        ":mnt_pjmanager" => $mnt_pjmanager,
        ":mnt_project_foreman" => $mnt_project_foreman,
        ":mnt_project_eng" => $mnt_project_eng,
        ":mnt_status" => "1",
        ":mnt_closed_reson" => "-",
        ":mnt_closed_date" => date('Y-m-d'),
        ":mnt_closed_by" => "-",
        ":mnt_cdate" => date("Y-m-d H:i:s"),
        ":mnt_edate" => date("Y-m-d H:i:s"),
        ":mnt_cby" => $user_name,
        ":mnt_eby" => $user_name,
        ":projectname" => $projectname,
    );

    echo $mkw->SaveProject($params,$_sub);
    exit;


?>