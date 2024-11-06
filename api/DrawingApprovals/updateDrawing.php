<?php
include_once('../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));    
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($data->newapproval->approvals_for) || $data->newapproval->approvals_for === '') {
            echo response("0", "Choose Approval Category");
        } else if (!isset($data->newapproval->approvals_draw_no) || $data->newapproval->approvals_draw_no === '') {
            echo response("0", "Enter Drawing Number");
        } else if (!isset($data->newapproval->approvals_token) || $data->newapproval->approvals_token === '') {
            echo response("0", "Enter Drawing Number");
        } else if (!isset($data->newapproval->approvals_descriptions) || $data->newapproval->approvals_descriptions === '') {
            echo response("0", "Enter Approval description");
        } else {

            include_once("../../controller/DrawingApprovals.php");
            $DrawingApprovals = new DrawingApprovals($db);
            $date = date('Y-m-d');
            $_sv  = array(
                'approvals_for' => $data->newapproval->approvals_for,
                'approvals_draw_no' => $DrawingApprovals->enc('enc',$data->newapproval->approvals_draw_no),
                'approvals_descriptions' => $DrawingApprovals->enc('enc',$data->newapproval->approvals_descriptions),
                'approvals_eby' => $DrawingApprovals->enc('enc',$data->naf_user->user_name),
                'approvals_edate' => $date,
                'approvals_token' => $data->newapproval->approvals_token,
                'project_code' => $DrawingApprovals->enc('enc',$data->newapproval->approvals_project_code),
            );
            $_s2 = array(
                "approvals_info_drawing_no" => $DrawingApprovals->enc('enc',$data->newapproval->approvals_draw_no),
                "approvals_info_drawing_token" => $data->newapproval->approvals_token,
                "approvals_info_project_id" => $DrawingApprovals->enc('enc',$data->newapproval->approvals_project_code)
            );
            echo $DrawingApprovals->update_drawing($_sv, $_s2);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
