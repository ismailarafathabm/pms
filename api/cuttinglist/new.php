<?php
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    if (isset($user_name) && isset($user_token)) {
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);

        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
    }

    $auth = true;

    if ($auth === true) {
        if (!isset($cuttinglist_project_id) || $cuttinglist_project_id === '') {
            echo response("0", "Choose any Project");
        } else if (!isset($cuttinglist_clrefno) || $cuttinglist_clrefno === '') {
            echo response("0", "Choose BOQ Item Number");
        } else if (!isset($cuttinglist_cldaterelease) || $cuttinglist_cldaterelease === '') {
            echo response("0", "Enter Glass Order Number");
        } else if (!isset($cuttinglist_morefno) || $cuttinglist_morefno === '') {
            echo response("0", "Enter Who was done by this order");
        } else if (!isset($cuttinglist_moreleasedtoacct) || $cuttinglist_moreleasedtoacct === '') {
            echo response("0", "Enter Date when this order Released to Purchase");
        } else if (!isset($cuttinglist_moreleasedtoproduction) || $cuttinglist_moreleasedtoproduction === '') {
            echo response("0", "Enter Date when this order Recived form Purchase");
        } else if (!isset($cuttinglist_releasedto) || $cuttinglist_releasedto === '') {
            echo response("0", "Choose Order Status");
        } else if (!isset($cuttinglist_doneby) || $cuttinglist_doneby === '') {
            echo response("0", "Choose Supplier");
        } else if (!isset($cuttinglist_markingtype) || $cuttinglist_markingtype === '') {
            echo response("0", "Choose Glass Type");
        } else if (!isset($cuttinglist_descripton) || $cuttinglist_descripton === '') {
            echo response("0", "Enter Glass Description");
        } else if (!isset($cuttinglist_location) || $cuttinglist_location === '') {
            echo response("0", "Enter Marking Location");
        } else if (!isset($cuttinglist_qty) || $cuttinglist_qty === '' || !is_numeric($cuttinglist_qty)) {
            echo response("0", "Enter Qty with Corrent Format");
        } else if (!isset($cuttinglist_height) || $cuttinglist_height === '') {
            echo response("0", "Ente Remark");
        } else if (!isset($cuttinglist_width) || $cuttinglist_width === '') {
            echo response("0", "Ente Remark");
        } else if (!isset($cuttinglist_area) || $cuttinglist_area === '') {
            echo response("0", "Ente Area");
        } else if (!isset($cuttinglist_classrefno) || $cuttinglist_classrefno === '') {
            echo response("0", "Choose Glass Order Ref NO.");
        } else if (!isset($cuttinglist_sheettp) || $cuttinglist_sheettp === '') {
            echo response("0", "Ente Sheet Type");
        } else if (!isset($cuttinglist_remarks) || $cuttinglist_remarks === '') {
            echo response("0", "Ente Remark");
        } else if (!isset($cuttinglist_section) || $cuttinglist_section === '') {
            echo response("0", "Enter Section.");
        } else if (!isset($cuttinglist_boqitem) || $cuttinglist_boqitem === '') {
            echo response("0", "Choose BOQ Item");
        } else {
            include_once('../../controller/cuttinglistmo.php');
            $cuttinglistmo = new CuttingListMo($db);
            $token = $cuttinglistmo->token(75);
            $sql = "SELECT *FROM pms_cutting_list";
            $cm = $db->prepare($sql);
            $cm->execute();
            $rc = $cm->rowCount();
            for ($i = 0; $i < $rc; $i++) {
                $sql = "SELECT *FROM pms_cutting_list where cuttinglist_token='$token'";
                $cm = $db->prepare($sql);
                $cm->execute();
                if ($cm->rowCount() === 0) {
                    break;
                } else {
                    $token = $cuttinglistmo->token(75);
                }
            }
            $_date = date('Y-m-d');
            $_user = $user_name;
            $_status = $cuttinglistmo->enc('enc', "1");
            $svdata = array(
                ':cuttinglist_token' => $token,
                ':cuttinglist_project_id' => $cuttinglistmo->enc('enc', $cuttinglist_project_id),
                ':cuttinglist_clrefno' => $cuttinglistmo->enc('enc', $cuttinglist_clrefno),
                ':cuttinglist_cldaterelease' => $cuttinglistmo->enc('enc', $cuttinglist_cldaterelease),
                ':cuttinglist_morefno' => $cuttinglistmo->enc('enc', $cuttinglist_morefno),
                ':cuttinglist_moreleasedtoacct' => $cuttinglistmo->enc('enc', $cuttinglist_moreleasedtoacct),
                ':cuttinglist_moreleasedtoproduction' => $cuttinglistmo->enc('enc', $cuttinglist_moreleasedtoproduction),
                ':cuttinglist_releasedto' => $cuttinglistmo->enc('enc', $cuttinglist_releasedto),
                ':cuttinglist_doneby' => $cuttinglistmo->enc('enc', $cuttinglist_doneby),
                ':cuttinglist_markingtype' => $cuttinglistmo->enc('enc', $cuttinglist_markingtype),
                ':cuttinglist_descripton' => $cuttinglistmo->enc('enc', $cuttinglist_descripton),
                ':cuttinglist_location' => $cuttinglistmo->enc('enc', $cuttinglist_location),
                ':cuttinglist_qty' => $cuttinglistmo->enc('enc', $cuttinglist_qty),
                ':cuttinglist_height' => $cuttinglistmo->enc('enc', $cuttinglist_height),
                ':cuttinglist_width' => $cuttinglistmo->enc('enc', $cuttinglist_width),
                ':cuttinglist_area' => $cuttinglistmo->enc('enc', $cuttinglist_area),
                ':cuttinglist_classrefno' => $cuttinglistmo->enc('enc', $cuttinglist_classrefno),
                ':cuttinglist_sheettp' => $cuttinglistmo->enc('enc', $cuttinglist_sheettp),
                ':cuttinglist_remarks' => $cuttinglistmo->enc('enc', $cuttinglist_remarks),
                ':cuttinglist_section' => $cuttinglistmo->enc('enc', $cuttinglist_section),
                ':cuttinglist_status' => $_status,
                ':cuttinglist_cby' => $cuttinglistmo->enc('enc', $_user),
                ':cuttinglist_eby' => $cuttinglistmo->enc('enc', $_user),
                ':cuttinglist_cdate' => $_date,
                ':cuttinglist_edate' => $_date,
                ':cuttinglist_boqitem' => $cuttinglistmo->enc('enc', $cuttinglist_boqitem),
                ':qty_types' => $cuttinglistqtytype,
                ":cuttinglistfor" => $cuttinglistmo->enc('enc', $cuttinglistfor),
                ":cuttinglist_totarea" => $cuttinglistmo->enc('enc', $cuttinglist_totarea),
            );

            $api = json_decode($cuttinglistmo->cuttinglist_new($svdata));

            if ($api->msg === '1') {
                $count = count($_FILES['pdffile']['tmp_name']);
                $erromsg = "Data SAVED";
                if ($count > 0) {
                    mkdir('../../assets/cuttinglist/' . $token, 0777, true);
                    $location = '../../assets/cuttinglist/' . $token . "/";
                    $i = 0;
                    for ($index = 0; $index < $count; $index++) {
                        $filename = $_FILES['pdffile']['name'][$index];
                        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if ($file_ext === "pdf") {
                            $ex_file = $location . $filename;
                            if (file_exists($ex_file)) {
                                unlink($ex_file);
                            }
                            move_uploaded_file($_FILES['pdffile']['tmp_name'][$index],  $location . $filename);
                        } else {
                            $erromsg =  "some upload file not PDF format";
                        }
                    }

                    echo response('1', $erromsg);
                } else {
                    echo response('1', "saved\nNo Upload file selected");
                }
            } else {
                echo response("0", $api->data);
            }
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
