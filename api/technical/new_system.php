<?php 
    if(!isset($fun)){
        include_once '../_error.php';
        exit;
    }
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $data = json_decode($payload);
    //print_r($data);
    $techsyssystem = !isset($data->techsyssystem) || trim($data->techsyssystem) === "" ? "" : $data->techsyssystem;
    $techsyseby = $uuser;
    $techsysecby = $uuser;
    $techsyscdate =  $ddate;
    $techsysedate =  $ddate;
    $techsysprojectid = !isset($data->techsysprojectid) || trim($data->techsysprojectid) === "" ? "" : $data->techsysprojectid;

    if($techsyssystem === ""){
        echo response("0","Enter System");
        exit;
    }
    if($techsysprojectid === ""){
        echo response("0","Enter Project Informations");
        exit;
    }

    $params = array(
        ":techsyssystem" => $techsyssystem,
        ":techsyseby" => $techsyseby,
        ":techsysecby" => $techsysecby,
        ":techsyscdate" => $techsyscdate,
        ":techsysedate" => $techsysedate,
        ":techsysprojectid" => $techsysprojectid,
    );

    echo $tech->saveProjectTechincalSystems($params);

?>