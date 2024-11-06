<?php 
    if(!isset($fun)){
        include_once '../_error.php';
        exit;
    }

    switch($fun){
        default:
            header("HTTP/1.0 400 OK");
            echo response("0","Invaid Entry");
        exit;

        case 'projectsystems':            
            if(!isset($techsysprojectid) || trim($techsysprojectid) === ""){
                echo response("0" , "Missing Project Number");
                exit;
            }
            echo $tech->getprojectSystem($techsysprojectid);
        exit;
        case 'newsystem':
            include_once 'new_system.php';
        exit;
        case 'updatesystem':
            include_once 'update_system.php';
        exit;
        case 'removesystem':
            $data = json_decode($payload);
            //print_r($data->techsysprojectid);
            $techsysteid = !isset($data->techsysteid) || trim($data->techsysteid) === "" ? "" : $data->techsysteid;
            $techsysprojectid = !isset($data->techsysprojectid) || trim($data->techsysprojectid) === "" ? "" : $data->techsysprojectid;
            if($techsysteid === ""){
                echo response('0',"Select Any System");
                exit;
            }
            if($techsysprojectid === ''){
                echo response("0","Select Any Project");
                exit;
            }
            echo $tech->RemoveSystem($techsysteid,$techsysprojectid);
            exit;
        //? colors
        case 'colorapprovals':
            if(!isset($tcprojectid) || trim($tcprojectid) === ""){
                echo response("0","Select Any Project");
                exit;
            }
            echo $tech->getProjectColorApprovals($tcprojectid);
            exit;
        case 'colorremove':
            if(!isset($tcid) || trim($tcid) === ""){
                echo response("0","Select Any Approvals");
                exit;
            }
            if(!isset($tcprojectid) || trim($tcprojectid) === ""){
                echo response("0","Enter Any Project");
                exit;
            }
            echo $tech->RemoveProjectColorApprovals($tcid,$tcprojectid);
        exit;
        case 'colornew':
                include_once 'colornew.php';
            exit;
        case 'colorupdate':
                include_once 'colorupdate.php';
            exit;
        //?colors

        //? Hardwares
        case 'hardwarenew':
            include_once 'hardwarenew.php';
            exit;
        case 'hardwareupdate':
            include_once 'hardwareupdate.php';
            exit;
        case 'hardwareall':
            if(!isset($thproject) || trim($thproject) === ""){
                echo response("0","Select Any Project");
                exit;
            }
            echo $tech->getProjetHardwareApprovals($thproject);
            exit;
        case 'hardwareremove':
            if(!isset($thid) || trim($thid) === ""){
                echo response("0","Select Any Hardware Approvals");
                exit;
            }
            if(!isset($thproject) || trim($thproject) === ""){
                echo response("0","Select Any Project");
                exit;
            }
            echo $tech->RemoveProjectHardWareApprovals($thid,$thproject);
            exit;
        //? Hardwares

        //? Technical Approvals
        case 'approvalsnew':
            include_once 'technicalnew.php';
            exit;
        case 'approvalsupdate':
            include_once 'technicalupdate.php';
            exit;
        case 'approvalsall':
            if(!isset($taproject) || trim($taproject) === "") {
                echo response("0" , "Enter Project ID");
                exit;
            }
            echo $tech->ProjectTechnicalApprovals($taproject);
            exit;
        case 'approvalsremove':
            if(!isset($taid) || trim($taid) === "") {
                echo response("0" , "Enter Technical Approval ID");
                exit;
            }
              if(!isset($taproject) || trim($taproject) === "") {
                echo response("0" , "Enter Project ID");
                exit;
            }
            echo $tech->RemoveProjectTechnicalApprovals($taid,$taproject);
            exit;
        //? Technical Approvals End

        //? Calculation Approvals
        case 'newcalculation':
            include_once 'newcalculation.php';
            exit;
        case 'updatecalculation':
            include_once 'updatecalculation.php';
            exit;
        case 'getcalculations':
            if(!isset($tcproject) || trim($tcproject) === ""){
                echo response("0","Enter Project ID");
                exit;
            }
            echo $tech->GetProjectCalculationApprovals($tcproject);
            exit;
        case 'removecalculation':
            if(!isset($tcproject) || trim($tcproject) === ""){
                echo response("0","Enter Project ID");
                exit;
            }
            if(!isset($tcid) || trim($tcid) === ""){
                echo response("0","Enter ID");
                exit;
            }
            echo $tech->RemoveCalculationApprovals($tcid,$tcproject);
            exit;
        //? Calculation Approvals End
    }
?>