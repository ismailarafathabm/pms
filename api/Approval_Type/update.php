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
        if (!isset($data->approval_typeName) || $data->approval_typeName === '') {           
            echo response("0","Enter Approval Name");
        }else if (!isset($data->approvaltype_id_edit) || $data->approvaltype_id_edi === '') {
            echo response("0","Enter Approval Type Id");
        }
        else {
            $oldname = $user->enc('denc',_getOldApprovalName($db,$data->approvaltype_id_edi));
            $_msg = array(
                "status" => "OK",
                "PAGEID" => "APPROVEL TYPES",
                "ACTION" => "USER UPDATE APPROVAL TYPE",
                "API_PAGE" => "api/Approval_Type/new.php",
                "msg" => "UPDATED APPROVAL TYPE OLD TYPE NAME ". $oldname . " From ". $data->approval_typeName
            );
            $_log = array(
                'log_user' => $data->naf_user->user_name,
                'log_time' => date('Y-m-d H:i:s'),
                'log_descripton' => json_encode($_msg),
                'log_action' => "UPDATE",
                'log_token' => $data->naf_user->user_token
            );

            // include_once '../../controller/log.php';
            // $log = new LOG($db);
            // $log->save_log($_log);

            include_once("../../controller/ApprovalTypes.php");
            $approval_type = new ApprovalType($db);
            echo $approval_type->update_approval_type($data->approvaltype_id_edit,$data->approval_typeName);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}

function _getOldApprovalName($cn,$id){
    $sql = "SELECT *FROM pms_approval_types where pproval_type_id=:approval_type_id";
    $cm = $cn->prepare($sql);
    $cm->bindParam(":approval_type_id",$id);
    $cm->execute();
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    $oldType = $rows['approval_type_name'];
    unset($rows,$cm,$sql);
    return $oldType;
}
