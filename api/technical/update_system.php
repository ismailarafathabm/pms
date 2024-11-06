<?php 
    if(!isset($tech)){
        include_once '../_error.php';
        exit;
    }

    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $data = json_decode($payload);

    $techsyssystem = !isset($data->techsyssystem) || trim($data->techsyssystem) === "" ? "" :$data->techsyssystem;
    $techsysteid = !isset($data->techsysteid) || trim($data->techsysteid) === "" ? "" :$data->techsysteid;
    $techsysprojectid = !isset($data->techsysprojectid) || trim($data->techsysprojectid) === "" ? "" :$data->techsysprojectid;

    if($techsyssystem === ""){
        echo response("0","Enter System");
        exit;
    }
    if($techsysteid === ""){
        echo response("0","Select Any System");
        exit;
    }
    if($techsysprojectid === ""){
        echo response("0","Select Any Project");
        exit;
    }

    $chck = array(
        ":techsysteid" => $techsysteid,
        ":techsyssystem" => $techsyssystem,
        ":techsysprojectid" => $techsysprojectid,
    );

    $params = array(
        ":techsyssystem" => $techsyssystem,
        ":techsysecby" => $uuser,
        ":techsysedate" => $ddate,
        ":techsysteid" => $techsysteid
    );

    echo $tech->UpdateSystem($params,$chck);
    exit;
?>