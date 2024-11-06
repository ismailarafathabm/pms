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
        if (!isset($data->_frmdata->project_no,
        $data->_frmdata->project_name,
        $data->_frmdata->project_cname,
        $data->_frmdata->project_location,
        $data->_frmdata->project_singdate,
        $data->_frmdata->project_sing_description,
        $data->_frmdata->project_contract_duration,
        $data->_frmdata->project_contract_description,
        $data->_frmdata->project_contact_person,
        $data->_frmdata->project_contact_no,
        $data->_frmdata->Sales_Representative,
        $data->_frmdata->project_penalty,
        $data->_frmdata->project_expiry_date,
        $data->_frmdata->project_remarks,
        $data->_frmdata->projectRegion)) {
            echo response("0", "_Basic Input Missing");
        } else {
            if ($data->_frmdata->project_no === "") {
                echo response("0", "Enter Project Number");
            } else if ($data->_frmdata->project_name === "") {
                echo response("0", "Enter Project Name");
            } else if ($data->_frmdata->project_cname === "") {
                echo response("0", "Enter Contract Name");
            } else if ($data->_frmdata->project_location === "") {
                echo response("0", "Enter Location");
            } else if ($data->_frmdata->project_singdate === "") {
                echo response("0", "Enter Sing in date");
            } else if ($data->_frmdata->project_sing_description === "") {
                echo response("0", "Enter Sign Description");
            } else if ($data->_frmdata->project_contract_duration === "") {
                echo response("0", "Enter Contract Duration");
            } else if ($data->_frmdata->project_contract_description === "") {
                echo response("0", "Enter Contract Duration Description");
            } else if ($data->_frmdata->project_contact_person === "") {
                echo response("0", "Enter Contact Persion");
            } else if ($data->_frmdata->project_contact_no === "") {
                echo response("0", "Enter Contact Number");
            } else if ($data->_frmdata->Sales_Representative === "") {
                echo response("0", "Enter Salse Representative");
            } else if ($data->_frmdata->project_penalty === "") {
                echo response("0", "Enter Penalty");
            } else if ($data->_frmdata->project_expiry_date === "") {
                echo response("0", "Enter Expiry Date");
            } else if ($data->_frmdata->project_remarks === "") {
                echo response("0", "Enter Remarks");
            } else if ($data->_frmdata->projectRegion === '') {
                echo response("0", "Select Region");
            } else if($data->_frmdata->project_type === ""){
                echo response("0", "Select Project Type");
            }else {
                include_once('../../controller/Projects.php');
                $pro = new Projects($db);
                //echo $data->_frmdata->project_singdate;
                $_project_singdate = date_create($data->_frmdata->project_singdate);
                $project_singdate = date_format($_project_singdate, 'Y-m-d');

                $_project_expiry_date = date_create($data->_frmdata->project_expiry_date);
                $project_expiry_date = date_format($_project_expiry_date, 'Y-m-d');

                $_project_advacne_date = date_create($data->_frmdata->project_advacne_date);
                $project_advacne_date = date_format($_project_advacne_date, 'Y-m-d');
                $_svdata = array(
                    ":project_name" => $pro->enc('enc', $data->_frmdata->project_name),
                    ":project_cname" => $pro->enc('enc', $data->_frmdata->project_cname),
                    ":project_location" => $pro->enc('enc', $data->_frmdata->project_location),
                    ":project_singdate" => $project_singdate,
                    ":project_sing_description" => $pro->enc('enc', $data->_frmdata->project_sing_description),
                    ":project_contract_duration" => $pro->enc('enc', $data->_frmdata->project_contract_duration),
                    ":project_contract_description" => $pro->enc('enc', $data->_frmdata->project_contract_description),
                    ":project_contact_person" => $pro->enc('enc', $data->_frmdata->project_contact_person),
                    ":project_contact_no" => $pro->enc('enc', $data->_frmdata->project_contact_no),
                    ":Sales_Representative" => $pro->enc('enc', $data->_frmdata->Sales_Representative),
                    ":project_penalty" => $pro->enc('enc', $data->_frmdata->project_penalty),
                    ":project_expiry_date" => $project_expiry_date,
                    ":project_remarks" => $pro->enc('enc', $data->_frmdata->project_remarks),
                    ":project_create_by" => $pro->enc('enc', $data->naf_user->user_name),
                    ":projectRegion" => $pro->enc('enc', $data->_frmdata->projectRegion),
                    ":project_amount" => $pro->enc('enc', $data->_frmdata->project_amount),
                    ":project_first_advance_amount" => $pro->enc('enc', $data->_frmdata->project_first_advance_amount),
                    ":advance_amount_remark" => $pro->enc('enc', $data->_frmdata->advance_amount_remark),
                    ":project_advacne_date" => $project_advacne_date,
                    ':project_type' => $pro->enc('enc',$data->_frmdata->project_type),
                    ":project_no" => $pro->enc('enc', strtolower($data->_frmdata->project_no)),
                );
                // print_r($_svdata);
                $xxmgs = "PREVIOUS INFO : " . json_encode(getOldInfos($db,strtolower($data->_frmdata->project_no),$user));
                $xxmgs .= "  UPDATED INFO : " . json_encode($_svdata);
                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "PROJECT SUMMARY",
                    "ACTION" => "EDIT PROJECT SUMMARY",
                    "API_PAGE" => "api/Project/update.php",
                    "msg" => $xxmgs
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "EDIT",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
               // $log->save_log($_log);

                echo $pro->update_project($_svdata);
            }
        }
    } else {
        echo response("0", $_data);
    }
} else {
    echo response("0", "Request Error");
}

function getOldInfos($cn,$pjno,$enc){
    $sql = "SELECT *FROM pms_project_summary where project_no=:project_no";
    $cm = $cn->prepare($sql);
    $param = array(
        ':project_no' => $enc->enc('enc',$pjno)
    );
    $cm->execute($param);
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    $k = array(
        'project_id' => $rows['project_id'],
        'project_no' => $enc->enc('denc',$rows['project_no']),
        'project_name' => $enc->enc('denc',$rows['project_name']),
        'project_cname' => $enc->enc('denc',$rows['project_cname']),
        'project_location' => $enc->enc('denc',$rows['project_location']),
        'project_singdate' => $rows['project_singdate'],
        'project_sing_description' => $enc->enc('denc',$rows['project_sing_description']),
        'project_contract_duration' => $enc->enc('denc',$rows['project_contract_duration']),
        'project_contract_description' => $enc->enc('denc',$rows['project_contract_description']),
        'project_contact_person' => $enc->enc('denc',$rows['project_contact_person']),
        'project_contact_no' => $enc->enc('denc',$rows['project_contact_no']),
        'Sales_Representative' => $enc->enc('denc',$rows['Sales_Representative']),
        'project_penalty' => $enc->enc('denc',$rows['project_penalty']),
        'project_expiry_date' => $rows['project_expiry_date'],
        'project_remarks' => $enc->enc('denc',$rows['project_remarks']),
        'project_amount' => $enc->enc('denc',$rows['project_amount']),
        'project_basicpayment' => $enc->enc('denc',$rows['project_basicpayment']),
        'project_first_advance_amount' => $enc->enc('denc',$rows['project_first_advance_amount']),
        'project_first_advance' => $enc->enc('denc',$rows['project_first_advance']),
        'project_advacne_date' => $rows['project_advacne_date'],
        'advance_amount_remark' => $enc->enc('denc',$rows['advance_amount_remark']),
        'project_enter_date' => $rows['project_enter_date'],
        'project_edit_date' => $rows['project_edit_date'],
        'project_status' => $enc->enc('denc',$rows['project_status']),
        'project_create_by' => $enc->enc('denc',$rows['project_create_by']),
        'project_ledit_by' => $enc->enc('denc',$rows['project_ledit_by']),
        'project_boq_refno' => $enc->enc('denc',$rows['project_boq_refno']),
        'project_boq_revision' => $enc->enc('denc',$rows['project_boq_revision']),        
        'project_hadnover' => $enc->enc('denc',$rows['project_hadnover']),
        'project_handover_date' => $rows['project_handover_date'],
        'projectRegion' => $enc->enc('denc',$rows['projectRegion'])
    );

    unset($cm,$sql,$rows);
    return $k;
}



