<?php
date_default_timezone_set('Asia/Riyadh');
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
        $_date = date_create('d-m-Y h:i:sa');
        $_cby = $data->naf_user->user_name;        
        if (!isset($data->new_boq->item_no) || $data->new_boq->item_no === "") {
            echo response("0", "Item Number Missing");
        } else if (!isset($data->new_boq->item_type) || $data->new_boq->item_type === "") {
            echo response("0", "Item type Missing");
        } else if (!isset($data->new_boq->item_description) || $data->new_boq->item_description === "") {
            echo response("0", "Item remark Missing");
        } else if (!isset($data->new_boq->item_width) || $data->new_boq->item_width === "" || !is_numeric($data->new_boq->item_width)) {
            echo response("0", "Item width Missing");
        } else if (!isset($data->new_boq->item_height) || $data->new_boq->item_height === "" || !is_numeric($data->new_boq->item_height)) {
            echo response("0", "Item height Missing");
        } else if (!isset($data->new_boq->glass_name) || $data->new_boq->glass_name === "") {
            echo response("0", "Glass Specification Missing");
        } else if (!isset($data->new_boq->glass_single) || $data->new_boq->glass_single === "") {
            echo response("0", "Enter Glass Size");
        } else if (!isset($data->new_boq->glass_double1) || $data->new_boq->glass_double1 === "") {
            echo response("0", "Enter Glass Inner Size");
        } else if (!isset($data->new_boq->glass_double2) || $data->new_boq->glass_double2 === "") {
            echo response("0", "Enter Glass S/A Value");
        } else if (!isset($data->new_boq->glass_double3) || $data->new_boq->glass_double3 === "") {
            echo response("0", "Enter Glass Outer Size");
        } else if (!isset($data->new_boq->glass_laminated1) || $data->new_boq->glass_laminated1 === "") {
            echo response("0", "Laminate Size");
        } else if (!isset($data->new_boq->glass_laminated2) || $data->new_boq->glass_laminated2 === "") {
            echo response("0", "Laminate Size");
        } else if (!isset($data->new_boq->drawing_refno) || $data->new_boq->drawing_refno === "") {
            echo response("0", "Drawing Informations Missing");
        } else if (!isset($data->new_boq->finish_type) || $data->new_boq->finish_type === "") {
            echo response("0", "Choose Any Finish Type");
        } else if (!isset($data->new_boq->system_type) || $data->new_boq->system_type === "") {
            echo response("0", "Choose Any System Type");
        } else if (!isset($data->new_boq->item_qty) || $data->new_boq->item_qty === "" || !is_numeric($data->new_boq->item_qty)) {
            echo response("0", "Enter Qty");
        } else if (!isset($data->new_boq->item_aras) || $data->new_boq->item_aras === "" || !is_numeric($data->new_boq->item_aras)) {
            echo response("0", "Enter area");
        }
         else if (!isset($data->new_boq->item_unit) || $data->new_boq->item_unit === "") {
            echo response("0", "Choose Any Qty");
        } else if (!isset($data->new_boq->item_Uprice) || $data->new_boq->item_Uprice === "" || !is_numeric($data->new_boq->item_Uprice)) {
            echo response("0", "Enter Unit Price");
        } else if (!isset($data->new_boq->item_remark) || $data->new_boq->item_remark === "") {
            echo response("0", "Enter Remark");
        } else if (!isset($data->ref_no) || $data->ref_no === "") {
            echo response("0", "Choose Project");
        } else if (!isset($data->rev_no) || $data->rev_no === "") {
            echo response("0", "Some Project Information Missing");
        } else if (!isset($data->poq_project_code) || $data->poq_project_code === "") {
            echo response("0", "Some Project Information Missing");
        }
        else {
            if ($data->new_boq->item_aras == '0' && $data->new_boq->item_qty == '0') {
                echo response("0", "Enter Qty Or Area Value");
            }else{
                $_svdata = array(
                    "poq_item_no" => $data->new_boq->item_no,
                    "poq_item_type" => $data->new_boq->item_type,
                    "poq_item_remark" => $data->new_boq->item_remark,
                    "poq_item_width" => $data->new_boq->item_width,
                    "poq_item_height" => $data->new_boq->item_height,
                    "poq_item_glass_spec" => $data->new_boq->glass_name,
                    "poq_item_glass_single" => $data->new_boq->glass_single,
                    "poq_item_glass_double1" => $data->new_boq->glass_double1,
                    "poq_item_glass_double2" => $data->new_boq->glass_double2,
                    "poq_item_glass_double3" => $data->new_boq->glass_double3,
                    "poq_item_glass_laminate1" => $data->new_boq->glass_laminated1,
                    "poq_item_glass_laminate2" => $data->new_boq->glass_laminated2,
                    "poq_drawing" => $data->new_boq->drawing_refno,
                    "poq_finish" => $data->new_boq->finish_type,
                    "poq_system_type" => $data->new_boq->system_type,
                    "poq_qty" => $data->new_boq->item_qty,
                    "poq_unit" => $data->new_boq->item_unit,
                    "poq_uprice" => $data->new_boq->item_Uprice,
                    "poq_remark" => $data->new_boq->item_description,
                    "poq_cby" => $_cby,
                    "poq_eby" => $_cby,
                    "poq_Cdate" => $_date,
                    "poq_Edate" => $_date,
                    "poq_project_code" => $data->poq_project_code,
                    "poq_status" => '1',
                    "boq_refno" => $data->ref_no,
                    "boq_reviewno" => $data->rev_no,
                    "boq_area" => $data->new_boq->item_aras,
                    "poq_id" => $data->new_boq->poq_id
                );

                include_once('../../controller/Projects.php');
                $project = new Projects($db);
                echo $project->update_boq($_svdata);
            }
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
