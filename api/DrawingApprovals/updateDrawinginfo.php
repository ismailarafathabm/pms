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
        $_r = "";
        $_s = '0';
        if (!isset($project_code) || $project_code === "") {
            $_r = "Choose Any Project";
        } else if (!isset($approvals_token) || $approvals_token === "") {
            $_r = "Choose Any Approvals";
        } else if (!isset($approvals_draw_no) || $approvals_draw_no === "") {
            $_r = "Choose Any Approvals";
        } else if (!isset($approvals_info_reveision_no) || $approvals_info_reveision_no === "") {
            $_r = "Enter Revevison Number..";
        } else if (!isset($approvals_info_sub) || $approvals_info_sub === "") {
            $_r = "Enter SUB #";
        } else if (!isset($approvals_info_submited_on) || $approvals_info_submited_on === "") {
            $_r = "Enter Date of Submited";
        } else if (!isset($approvals_info_received_on) || $approvals_info_received_on === "") {
            $_r = "Enter Date of Received";
        } else if (!isset($approvals_info_client_on) || $approvals_info_client_on === "") {
            $_r = "Enter Date of Client Approved";
        } else if (!isset($approvals_info_code) || $approvals_info_code === "") {
            $_r = "Choose Code";
        } else if (!isset($approvals_info_remarks) || $approvals_info_remarks === "") {
            $_r = "Enter Remark.";
        } else {            
            if ($approvals_info_code !== 'U') {
                if (!date_create($approvals_info_submited_on)) {
                    $_r = "Date Format Is Wrong...";
                } else if (!date_create($approvals_info_received_on)) {
                    $_r = "Date Format Is Wrong...";
                } else if (!date_create($approvals_info_client_on)) {
                    $_r = "Date Format Is Wrong...";
                } else {
                    if (is_uploaded_file($_FILES['pdffile']['tmp_name'])) {                        
                        $filename = $_FILES['pdffile']['name'];
                        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if ($file_ext !== "pdf") {
                            $_r =  "its not pdf - 001";
                        } else {
                            $_s = '1';
                        }
                    } else {
                        $_s = '1';
                    }
                }
            } else {
                if (is_uploaded_file($_FILES['pdffile']['tmp_name'])) {                    
                    $filename = $_FILES['pdffile']['name'];
                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    if ($file_ext !== "pdf") {
                        $_r =  "its not pdf --003";
                    } else {
                        $_s = '1';
                    }
                } else {
                    $_s = '1';
                }
            }
        }        
        if ($_s === '1') {
            include_once("../../controller/DrawingApprovals.php");
            $DrawingApprovals = new DrawingApprovals($db);
            $date = date('Y-m-d');                     
            $sdata = array(
                ':approvals_info_reveision_no' => $DrawingApprovals->enc('enc',$approvals_info_reveision_no),
                ':approvals_info_sub' => $DrawingApprovals->enc('enc',$approvals_info_sub),
                ':approvals_info_submited_on' => $DrawingApprovals->enc('enc',$approvals_info_submited_on),
                ':approvals_info_received_on' => $DrawingApprovals->enc('enc',$approvals_info_received_on),
                ':approvals_info_client_on' => $DrawingApprovals->enc('enc',$approvals_info_client_on),
                ':approvals_info_code' => $DrawingApprovals->enc('enc',$approvals_info_code),
                ':approvals_info_eby' => $DrawingApprovals->enc('enc',$user_name),
                ':approvals_info_edate' => date('Y-m-d'),
                ':approvals_info_remarks' => $DrawingApprovals->enc('enc',$approvals_info_remarks),
                ':approvals_info_token' => $approvals_info_token,
                ':approvals_info_project_id' => $DrawingApprovals->enc('enc',$project_code),
                ':approvals_info_drawing_token' => $approvals_token,                              
            );            

            if (is_uploaded_file($_FILES['pdffile']['tmp_name'])) {
                $filename = $_FILES['pdffile']['name'];
                $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $fileno = $approvals_info_token;              
                $location = "../../assets/drawingapprovals/";
                $filenamesxzy = $location . $fileno . ".pdf";                
                move_uploaded_file($filename = $_FILES['pdffile']['tmp_name'], $location . $filenamesxzy);
            } 
            echo $DrawingApprovals->update_revision_info($sdata);
        } else {
            echo response("0", $_r);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
