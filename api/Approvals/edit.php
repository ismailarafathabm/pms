<?php
include_once('../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);    
    $naf_user = array(
        'user_name' => $user_name,
        'user_token' => $user_token
    );
    $datas = array(
        'naf_user' => $naf_user
    );
    $s = json_encode($datas);
    $data = json_decode($s);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {

        if (!isset($approvals_token) || $approvals_token === "") {
            echo response('0', 'Project Serial No Missing');
        } else if (!isset($approvals_adate) || $approvals_adate === "") {
            echo response('0', 'Enter Approval Date');
        } else if (!isset($approvals_rdate) || $approvals_rdate === "") {
            echo response('0', 'Enter Released Date');
        } else if (!isset($approvals_givenby) || $approvals_givenby === "") {
            echo response('0', 'Enter Who Give?');
        } else if (!isset($approvals_ftotech) || $approvals_ftotech === "") {
            echo response('0', 'Enter When Did you Forward to Techincal Department');
        } else if (!isset($approvals_remarks) || $approvals_remarks === "") {
            echo response('0', 'Enter Approval Remarks');
        } else if (!isset($approvals_tmanager) || $approvals_tmanager === "") {
            echo response('0', 'Enter Technical Manager Name');
        } else if (!isset($approvals_rftmanger) || $approvals_rftmanger === "") {
            echo response('0', 'Enter When did You Received From technical Manager');
        } else if (!isset($approvals_tengineer) || $approvals_tengineer === "") {
            echo response('0', 'Enter Technical Engineer Name');
        } else if (!isset($approvals_rftmanager) || $approvals_rftmanager === "") {
            echo response('0', 'Enter When did you Received From Technical Engineer');
        } else if (!isset($approvals_salse_dep) || $approvals_salse_dep === "") {
            echo response('0', 'Enter When did you Forward to Sales Department');
        } else if (!isset($approvals_costing_dep) || $approvals_costing_dep === "") {
            echo response('0', 'Enter When did you Forward to Costing Department');
        } else if (!isset($approvals_materials_dep) || $approvals_materials_dep === "") {
            echo response('0', 'Enter When did you Forward to Material Department');
        } else if (!isset($approvals_purchasing_dep) || $approvals_purchasing_dep === "") {
            echo response('0', 'Enter When did you Forward to purchasing Department');
        } else if (!isset($approvals_engineering_dep) || $approvals_engineering_dep === "") {
            echo response('0', 'Enter When did you Forward to Engineering Department');
        } else if (!isset($approvals_status) || $approvals_status === "") {
            echo response('0', 'Choose Status');
        } else if (!isset($approvals_projectid) || $approvals_projectid === "") {
            echo response('0', 'project Number Missing');
        } else if (!isset($approval_type) || $approval_type === "") {
            echo response('0', 'Enter Approval For');
        } else {
            $ddate = date('d-m-Y');
            $_svdata = array(
                'approvals_token' => $approvals_token,
                'approvals_adate' => $approvals_adate,
                'approvals_rdate' => $approvals_rdate,
                'approvals_givenby' => $approvals_givenby,
                'approvals_ftotech' => $approvals_ftotech,
                'approvals_remarks' => $approvals_remarks,
                'approvals_tmanager' => $approvals_tmanager,
                'approvals_rftmanger' => $approvals_rftmanger,
                'approvals_tengineer' => $approvals_tengineer,
                'approvals_rftmanager' => $approvals_rftmanager,
                'approvals_salse_dep' => $approvals_salse_dep,
                'approvals_costing_dep' => $approvals_costing_dep,
                'approvals_materials_dep' => $approvals_materials_dep,
                'approvals_purchasing_dep' => $approvals_purchasing_dep,
                'approvals_engineering_dep' => $approvals_engineering_dep,
                'approvals_status' => $approvals_status,
                'approvals_projectid' => $approvals_projectid,
                'approvals_edate' => $ddate,
                'approvals_eby' => $user_name,
                'approval_type' => $approval_type,
            );
            include_once('../../controller/Project_approvals.php');
            $ProjectApprovals = new ProjectApprovals($db);
            if ($approvals_status === 'a' ||$approvals_status === 'c') {
                echo $ProjectApprovals->update_approvals($_svdata);
            } else {
                if (
                    date_create($approvals_adate) &&
                    date_create($approvals_rdate) &&
                    date_create($approvals_ftotech) &&
                    date_create($approvals_rftmanger) &&
                    date_create($approvals_rftmanager) &&
                    date_create($approvals_salse_dep) &&
                    date_create($approvals_costing_dep) &&
                    date_create($approvals_materials_dep) &&
                    date_create($approvals_purchasing_dep) &&
                    date_create($approvals_engineering_dep)
                ) {
                    if (!is_uploaded_file($_FILES['docu']['tmp_name'])) {
                        $apis = json_decode($ProjectApprovals->update_approvals($_svdata));
                        echo response("1", "Data Saved\nNote : Upload File Missing.....");                    
                    }else{
                        $filename = $_FILES['docu']['name'];
                        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if ($file_ext !== "pdf") {
                            $apis = json_decode($ProjectApprovals->update_approvals($_svdata));
                            echo response("1", "Data Saved\nNote : your Update File not PDF FORMAT");  
                        }else{
                            $apis = json_decode($ProjectApprovals->update_approvals($_svdata));
                            //echo $apis->data;
                            $fileno = $apis->data;
                            $location = "../../assets/approvals/";
                            $filenamesxzy = $fileno;
                            move_uploaded_file($filename = $_FILES['docu']['tmp_name'], $location . $filenamesxzy . ".pdf");
                            echo response("1", "saved");
                        }
                    }                    
                } else {
                    echo response("0", "Invalid Date.");
                }
            }
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
