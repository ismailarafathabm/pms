<?php 
    if(!isset($tech)){
        include_once '../_error.php';
        exit;
    }

    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $data = json_decode($payload);

    $tcmaterial = !isset($data->tcmaterial) || trim($data->tcmaterial) === "" ? "" : $data->tcmaterial;
    $tecdescription = !isset($data->tecdescription) || trim($data->tecdescription) === "" ? "" : $data->tecdescription;
    $tcsubmittedby = !isset($data->tcsubmittedby) || trim($data->tcsubmittedby) === "" ? "" : $data->tcsubmittedby;
    $tcsubmitteddate = !isset($data->tcsubmitteddate) || trim($data->tcsubmitteddate) === "" ? "" : $data->tcsubmitteddate;
    $tcapprovedstatus = !isset($data->tcapprovedstatus) || trim($data->tcapprovedstatus) === "" ? "" : $data->tcapprovedstatus;        
    $tcprojectid = !isset($data->tcprojectid) || trim($data->tcprojectid) === "" ? "" : $data->tcprojectid;
    $tccby = $uuser;
    $tceby =  $uuser;
    $tccdate = $ddate;
    $tcedate = $ddate;

    if($tcmaterial === ""){
        echo response("0","Enter Type");
        exit;
    }

    if($tecdescription === ""){
        echo response("0","Enter Description");
        exit;
    }

    
    if($tcsubmittedby === ""){
        echo response("0","Enter Submitted By");
        exit;
    }

    if($tcsubmitteddate === ""){
        echo response("0","Enter Submitted Date");
        exit;
    }

    if(!date($tcsubmitteddate)){
        echo response("0","Submitted Date is Not valid Format");
        exit;
    }
    
    if($tcprojectid === ""){
        echo response("0","Select Any Project");
        exit;
    }
    $tcapproveddate = date('Y-m-d');
    if($tcapprovedstatus !== "U"){
        $tcapproveddate = !isset($data->tcapproveddate) || trim($data->tcapproveddate) === "" ? "" : $data->tcapproveddate;
        if($tcapproveddate === ""){
            echo response("0","Enter Approved Date");
            exit;
        }

        if(!date_create($tcapproveddate)){
            echo response("0","Date is Not Valid Format");
            exit;
        }

        $tcapproveddate = date_format(date_create($tcapproveddate),'Y-m-d');
    }

    $params = array(
        ':tcmaterial' => $tcmaterial,
        ':tecdescription' => $tecdescription,
        ':tcsubmittedby' => $tcsubmittedby,
        ':tcsubmitteddate' => date_format(date_create($tcsubmitteddate),'Y-m-d'),
        ':tcapprovedstatus' => $tcapprovedstatus,
        ':tcapproveddate' => $tcapproveddate,
        ':tcprojectid' => $tcprojectid,
        ':tccby' => $tccby,
        ':tceby' => $tceby,
        ':tccdate' => $tccdate,
        ':tcedate' => $tcedate,
    );
    echo $tech->saveProjectColorsApprovals($params);
    exit;
    
?>