<?php 
    if(!isset($tech)){
        include_once '../_error.php';
        exit;
    }

    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $data = json_decode($payload);
    $thproject =  !isset($data->thproject) || trim($data->thproject) === "" ? "" : $data->thproject; 
    $thsystem = !isset($data->thsystem) || trim($data->thsystem) === "" ? "" : $data->thsystem; 
    $thdescriptions = !isset($data->thdescriptions) || trim($data->thdescriptions) === "" ? "" : $data->thdescriptions;
    $thnotes = !isset($data->thnotes) || trim($data->thnotes) === "" ? "" : $data->thnotes; 
    $thsubmittedby = !isset($data->thsubmittedby) || trim($data->thsubmittedby) === "" ? "" : $data->thsubmittedby; 
    $thsubmitteddate = !isset($data->thsubmitteddate) || trim($data->thsubmitteddate) === "" ? "" : $data->thsubmitteddate;
    $thstatus =!isset($data->thstatus) || trim($data->thstatus) === "" ? "" : $data->thstatus;
    $thsapprovedate = date('Y-m-d');
    $thcby =  $uuser;
    $theby =  $uuser;
    $thcdate = $ddate;
    $thedate = $ddate;

    if($thproject === ""){
        echo response("0","Select Any projects");
        exit;
    }
    if($thsystem === ""){
        echo response("0","Enter System");
        exit;
    }

    if($thdescriptions === ""){
        echo response("0","Enter Submitted Accessories");
        exit;
    }

    if($thnotes === ""){
        echo response("0","Enter Remarks");
        exit;
    }

    if($thsubmittedby === ""){
        echo response("0","Enter Submitted by");
        exit;
    }

    if($thsubmitteddate === ""){
        echo response("0","Enter Submitted Date");
        exit;
    }

    if(!date_create($thsubmitteddate)){
        echo response("0","Submitted Date is Not valid Format");
        exit;
    }

    if($thstatus === ""){
        echo response("0","Enter Status");
        exit;
    }

    if($thstatus !== "U"){
        $thsapprovedate = !isset($data->thsapprovedate) || trim($data->thsapprovedate) === "" ? "" : $data->thsapprovedate;

        if($thsapprovedate === ""){
            echo response("0","Enter Approved Date");
            exit;
        }

        if(!date_create($thsubmitteddate)){
            echo response("0","Approved Date is Not valid Format");
            exit;
        }

        $thsapprovedate = date_format(date_create($thsapprovedate),'Y-m-d');
    }

    $params = array(
    ':thproject' => $thproject,
    ':thsystem' => $thsystem,
    ':thdescriptions' => $thdescriptions,
    ':thnotes' => $thnotes,
    ':thsubmittedby' => $thsubmittedby,
    ':thsubmitteddate' => date_format(date_create($thsubmitteddate),'Y-m-d'),
    ':thstatus' => $thstatus,
    ':thsapprovedate' => $thsapprovedate,
    ':thcby' => $thcby,
    ':theby' => $theby,
    ':thcdate' => $thcdate,
    ':thedate' => $thedate,
    );

    echo $tech->addnewProjectHardWareApprovals($params);
    exit;

?>