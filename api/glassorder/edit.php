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
        if (!isset($project_id) || $project_id === '') {
            echo response("0", "Choose any Project");
        } else if (!isset($glassorder_token) || $glassorder_token === '') {
            echo response("0", "Choose BOQ Item Number");
        }
         else if (!isset($boq_itemno) || $boq_itemno === '') {
            echo response("0", "Choose BOQ Item Number");
        } else if (!isset($glassorderno) || $glassorderno === '') {
            echo response("0", "Enter Glass Order Number");
        } else if (!isset($doneby) || $doneby === '') {
            echo response("0", "Enter Who was done by this order");
        } else if (!isset($releasedtopurchase) || $releasedtopurchase === '') {
            echo response("0", "Enter Date when this order Released to Purchase");
        } else if (!isset($recivedfrompurchas) || $recivedfrompurchas === '') {
            echo response("0", "Enter Date when this order Recived form Purchase");
        } else if (!isset($orderstatus) || $orderstatus === '') {
            echo response("0", "Choose Order Status");
        } else if (!isset($supplier) || $supplier === '') {
            echo response("0", "Choose Supplier");
        } else if (!isset($glasstype) || $glasstype === '') {
            echo response("0", "Choose Glass Type");
        } else if (!isset($glassdescription) || $glassdescription === '') {
            echo response("0", "Enter Glass Description");
        } else if (!isset($markinglocation) || $markinglocation === '') {
            echo response("0", "Enter Marking Location");
        } else if (!isset($QTY) || $QTY === '' || !is_numeric($QTY)) {
            echo response("0", "Enter Qty with Corrent Format");
        } else if (!isset($remarks) || $remarks === '') {
            echo response("0", "Ente Remark");
        } else {
            include_once('../../controller/GlassOrder.php');
            $glassorder = new GlassOrder($db);
            //$token = $glassorder->token(25);
            $_date = date('Y-m-d');
            $_user = $user_name;
            $_sv = array(                
                'boq_itemno' => $glassorder->enc('enc', $boq_itemno),
                'glassorderno' => $glassorder->enc('enc', $glassorderno),
                'doneby' => $glassorder->enc('enc', $doneby),
                'releasedtopurchase' => $glassorder->enc('enc', $releasedtopurchase),
                'recivedfrompurchas' => $glassorder->enc('enc', $recivedfrompurchas),
                'orderstatus' => $glassorder->enc('enc', $orderstatus),
                'supplier' => $supplier,
                'glasstype' => $glasstype,
                'glassdescription' => $glassorder->enc('enc', $glassdescription),
                'markinglocation' => $glassorder->enc('enc', $markinglocation),
                'QTY' => $glassorder->enc('enc', $QTY),
                'remarks' => $glassorder->enc('enc', $remarks),                
                'edit_by' => $glassorder->enc('enc', $_user),                
                'edit_time' => $_date,
                'glassorder_token' => $glassorder_token,
                'project_id' => $glassorder->enc('enc', $project_id)
            );            
            $api = json_decode($glassorder->glassorder_update($_sv));
            if ($api->msg === '1') {
                $count = count($_FILES['pdffile']['tmp_name']);
                $erromsg = "Data SAVED";
                $token = $glassorder_token;
                if ($count > 0) {
                    $dirloca = '../../assets/glassorder/' . $token;   
                    if (file_exists($dirloca)) {
                    } else {
                        mkdir('../../assets/glassorder/' . $token, 0777, true);
                    }                   
                    $location = '../../assets/glassorder/' . $token . "/";
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
                }else{
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
