<?php

include_once('../_def.php');
$auth = true;

include_once('../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');

    if ($auth === true) {
        if (!isset(
            $data->_frmdata->project_no,
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
            $data->_frmdata->project_amount,
            $data->_frmdata->project_basicpayment,
            $data->_frmdata->project_first_advance_amount,
            $data->_frmdata->project_first_advance,
            $data->_frmdata->project_advacne_date,
            $data->_frmdata->advance_amount_remark,
            $data->_frmdata->project_type
        )) {
            _errorlog("_Basic Input Missing", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            echo response("0", "_Basic Input Missing");
           
        } else {
            if ($data->_frmdata->project_no === "") {
                _errorlog("Enter Project Numbe", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Project Number");
            } else if ($data->_frmdata->project_name === "") {
                _errorlog("Enter Project Name", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Project Name");
            } else if ($data->_frmdata->project_cname === "") {
                _errorlog("Enter Contract Name", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Contract Name");
            } else if ($data->_frmdata->project_location === "") {
                _errorlog("Enter Location", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Location");
            } else if ($data->_frmdata->project_singdate === "" || !date_create($data->_frmdata->project_singdate)) {
                _errorlog("Enter Sing in date", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Sing in date");
            } else if ($data->_frmdata->project_sing_description === "") {
                _errorlog("Enter Sign Description", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Sign Description");
            } else if ($data->_frmdata->project_contract_duration === "") {
                _errorlog("Enter Contract Duration", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Contract Duration");
            } else if ($data->_frmdata->project_contract_description === "") {
                _errorlog("Enter Contract Duration Description", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Contract Duration Description");
            } else if ($data->_frmdata->project_contact_person === "") {
                _errorlog("Enter Contact Persion", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Contact Persion");
            } else if ($data->_frmdata->project_contact_no === "") {
                _errorlog("Enter Contact Number", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Contact Number");
            } else if ($data->_frmdata->Sales_Representative === "") {
                _errorlog("Enter Salse Representative", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Salse Representative");
            } else if ($data->_frmdata->project_penalty === "") {
                _errorlog("Enter Penalty", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Penalty");
            } else if ($data->_frmdata->project_expiry_date === "" || !date_create($data->_frmdata->project_expiry_date)) {
                _errorlog("Enter Expiry Date", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Expiry Date");
            } else if ($data->_frmdata->project_remarks === "") {
                _errorlog("Enter Remarks", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Remarks");
            } else if ($data->_frmdata->project_amount === "") {
                _errorlog("Enter Project Amount", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Project Amount");
            } else if ($data->_frmdata->project_basicpayment === "") {
                _errorlog("Enter Basic Amount %", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Basic Amount %");
            } else if ($data->_frmdata->project_first_advance_amount === "") {
                _errorlog("Enter Client Paid Amount", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Client Paid Amount");
            } else if ($data->_frmdata->project_first_advance === "") {
                _errorlog("Enter Client Paid Amount", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Client Paid Amount");
            } else if ($data->_frmdata->project_advacne_date === "" || !date_create($data->_frmdata->project_advacne_date)) {
                _errorlog("Enter Paid Date", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Paid Date");
            } else if ($data->_frmdata->advance_amount_remark === "") {
                _errorlog("Enter Payment Remark", $data->naf_user->user_name, $data->naf_user->user_token, $db);
                echo response("0", "Enter Payment Remark");
            }  else if ($data->_frmdata->project_type === "") {
                echo response("0", "Select Project Type");
               // _errorlog("Enter Payment Remark", $data->naf_user->user_name, $data->naf_user->user_token, $db);
            }
             else {
                $_svdata = array(
                    "project_no" => $data->_frmdata->project_no,
                    "project_name" => $data->_frmdata->project_name,
                    "project_cname" => $data->_frmdata->project_cname,
                    "project_location" => $data->_frmdata->project_location,
                    "project_singdate" => $data->_frmdata->project_singdate,
                    "project_sing_description" => $data->_frmdata->project_sing_description,
                    "project_contract_duration" => $data->_frmdata->project_contract_duration,
                    "project_contract_description" => $data->_frmdata->project_contract_description,
                    "project_contact_person" => $data->_frmdata->project_contact_person,
                    "project_contact_no" => $data->_frmdata->project_contact_no,
                    "Sales_Representative" => $data->_frmdata->Sales_Representative,
                    "project_penalty" => $data->_frmdata->project_penalty,
                    "project_expiry_date" => $data->_frmdata->project_expiry_date,
                    "project_remarks" => $data->_frmdata->project_remarks,
                    "project_amount" => $data->_frmdata->project_amount,
                    "project_basicpayment" => $data->_frmdata->project_basicpayment,
                    "project_first_advance_amount" => $data->_frmdata->project_first_advance_amount,
                    "project_first_advance" => $data->_frmdata->project_first_advance,
                    "project_advacne_date" => $data->_frmdata->project_advacne_date,
                    "advance_amount_remark" => $data->_frmdata->advance_amount_remark,
                    "project_create_by" => $data->naf_user->user_name,
                    "projectRegion" => $data->_frmdata->projectRegion,
                    "project_type" => $data->_frmdata->project_type,
                );

                include_once('../../controller/Projects.php');


                $pro = new Projects($db);
                $_project_singdate = date_create($data->_frmdata->project_singdate);
                $project_singdate = date_format($_project_singdate, 'Y-m-d');
                $_project_expiry_date = date_create($data->_frmdata->project_expiry_date);
                $project_expiry_date = date_format($_project_expiry_date, 'Y-m-d');
                $ppstatus = $pro->enc('enc', '3');
                $datex = date('Y-m-d');
                $datef = date('Y-m-d h:i:s a');
                $cby = $pro->enc('enc', $data->naf_user->user_name);
                $newr = array(
                    ':ppcno' => $pro->enc('enc', strtolower($data->_frmdata->project_no)),
                    ':ppname' => $pro->enc('enc', strtolower($data->_frmdata->project_name)),
                    ':ppregion' => $pro->enc('enc', strtolower($data->_frmdata->projectRegion)),
                    ':pplocation' => $pro->enc('enc', strtolower($data->_frmdata->project_location)),
                    ':ppsign' => $project_singdate,
                    ':ppduration' => $pro->enc('enc', strtolower($data->_frmdata->project_contract_duration)),
                    ':ppexpiry' => $project_expiry_date,
                    ':ppstatus' => $ppstatus,
                    ':ppstatuschdate' => $datex,
                    ':ppstatusupby' => $cby,
                    ':ppcby' =>  $cby,
                    ':ppeby' =>  $cby,
                    ':ppcdate' => $datef,
                    ':ppedate' => $datef,
                );

                $_msg = array(
                    "status" => "OK",
                    "PAGEID" => "ADD NEW PROJECT",
                    "ACTION" => "ADDED NEW PROJECT",
                    "API_PAGE" => "api/Project/new.php",
                    "msg" => json_encode($newr)
                );
                $_log = array(
                    'log_user' => $data->naf_user->user_name,
                    'log_time' => date('Y-m-d H:i:s'),
                    'log_descripton' => json_encode($_msg),
                    'log_action' => "NEW",
                    'log_token' => $data->naf_user->user_token
                );
                // include_once '../../controller/log.php';
                // $log = new LOG($db);
                // $log->save_log($_log);


                $sql = "INSERT INTO pms_projects_info values (
                    null,
                    :ppcno,
                    :ppname,
                    :ppregion,
                    :pplocation,
                    :ppsign,
                    :ppduration,
                    :ppexpiry,
                    :ppstatus,
                    :ppstatuschdate,
                    :ppstatusupby,
                    :ppcby,
                    :ppeby,
                    :ppcdate,
                    :ppedate
                )";
                $cm = $db->prepare($sql);
                $cm->execute($newr);
                echo $pro->new_project($_svdata);
            }
        }
    } else {
        _errorlog( $_data, $data->naf_user->user_name, $data->naf_user->user_token, $db);
        echo response("0", $_data);
    }
} else {
    echo response("0", "Request Error");
}


function _errorlog($msg, $user_name, $user_token, $db)
{
    $_msg = array(
        "status" => "error",
        "PAGEID" => "ADD NEW PROJECT",
        "ACTION" => "ADDED NEW PROJECT",
        "API_PAGE" => "api/Project/new.php",
        "msg" => $msg
    );
    $_log = array(
        'log_user' => $user_name,
        'log_time' => date('Y-m-d H:i:s'),
        'log_descripton' => json_encode($_msg),
        'log_action' => "NEW",
        'log_token' => $user_token
    );
    // include_once '../../controller/log.php';
    // $log = new LOG($db);
    // $log->save_log($_log);
}
