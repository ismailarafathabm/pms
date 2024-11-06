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
        } else if (!isset($data->newapproval->approvals_descriptions) || $data->newapproval->approvals_descriptions === '') {
            echo response("0", "Enter Approval description");
        } else {

            include_once("../../controller/DrawingApprovals.php");
            $DrawingApprovals = new DrawingApprovals($db);
            $date = date('Y-m-d');
            $token = $DrawingApprovals->token(75);

            $sql = "SELECT *FROM pms_draw_approvals";
            $cm = $db->prepare($sql);
            $cm->execute();
            $rowcnt = $cm->rowCount();

            for ($i = 0; $i < $rowcnt; $i++) {
                $sql = "SELECT *FROM pms_draw_approvals where approvals_token='$token'";
                $cm = $db->prepare($sql);
                $cm->execute();
                if ($cm->rowCount() === 0) {
                    break;
                } else {
                    $token = $DrawingApprovals->token(75);
                }
            }

            $_sv  = array(
                'approvals_token' => $token,
                'approvals_for' => $data->newapproval->approvals_for,
                'approvals_draw_no' => $data->newapproval->approvals_draw_no,
                'approvals_descriptions' => $data->newapproval->approvals_descriptions,
                'approvals_last_status' => '-',
                'approvals_last_revision_no' => '-',
                'approvals_cby' => $data->naf_user->user_name,
                'approvals_eby' => $data->naf_user->user_name,
                'approvals_cdate' => $date,
                'approvals_edate' => $date,
                'project_code' => $data->project_no
            );
            echo $DrawingApprovals->add_new_approvals($_sv);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
