<?php
    date_default_timezone_set('Asia/Riyadh');
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //print_r($_POST);
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

        //$auth = true;
        echo 'its working';

        if ($auth === true) {
            if(!isset($variation_project_code) || $variation_project_code === "" ){
                echo response("0","Project Informations Missing");

            }else if(!isset($variation_project_name) || $variation_project_name === ""){
                echo response("0", "Project Informations Missing");

            } else if (!isset($variation_project_location) || $variation_project_location === "") {
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_refno_p1) || $variation_refno_p1 === "") {
                echo response("0", "Enter Referance Number...");
            } else if (!isset($variation_refno_p2) || $variation_refno_p2 === "") {
                echo response("0", "Enter Referance Number...");
            } else if (!isset($variation_refno_p3) || $variation_refno_p3 === "") {
                echo response("0", "Enter Referance Number...");
            } else if (!isset($variation_refno_p4) || $variation_refno_p4 === "") {
                echo response("0", "Enter Referance Number...");
            } else if (!isset($variation_refno) || $variation_refno === "") {
                echo response("0", "Enter Referance Number...");
            } else if (!isset($variation_date) || $variation_date === "") {
                echo response("0", "Enter Date");
            } else if (!isset($variation_to) || $variation_to === "") {
                echo response("0", "Enter Forwarding To");
            } else if (!isset($variation_subjectn) || $variation_subjectn === "") {
                echo response("0", "Choose Variation For...");
            } else if (!isset($variation_description) || $variation_description === "") {
                echo response("0", "Enter Description");
            } else if (!isset($variation_amount) || $variation_amount === "") {
                echo response("0", "Enter Amount");
            } else if (!isset($variation_remarks) || $variation_remarks === "") {
                echo response("0", "Enter Remark");
            } else if (!isset($variation_region) || $variation_region === "") {
                echo response("0", "Choose any region");
            } else if (!isset($variation_salesman) || $variation_salesman === "") {
                echo response("0", "Choose any Sales Man");
            } else if (!isset($variation_status) || $variation_status === "") {
                echo response("0", "Choose any Variation Status");
            } else{
                if(!is_numeric($variation_amount)){
                    echo response("0", "Check Amount format...");
                }else if(!date_create($variation_date)){
                    echo response("0", "Check Date Format...");
                }else if(!is_uploaded_file($_FILES['pdffile']['tmp_name'])){
                    echo response("0", "Choose This Variation PDF File");
                }else{
                    $filename = $_FILES['pdffile']['name'];
                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    $fok1 = true;
                    if($file_ext !== "pdf"){
                        $_fok1 = false;
                    }
                    $_fok = true;
                    if($variation_status == '2' || $variation_status == '3' || $variation_status == '4'){
                        if(!is_uploaded_file($_FILES['pdffile1']['tmp_name'])){
                            $_fok = false;
                        }else{
                            $filename2= $_FILES['pdffile1']['name'];
                            $file_ext2 = strtolower(pathinfo($filename2, PATHINFO_EXTENSION));
                            if ($file_ext !== "pdf") {
                                $_fok = false;
                            }
                        }
                    }
                    if($_fok === true && $fok1 === true ){
                        include_once('../../controller/Variations.php');
                        $variation = new Variations($db);
                        $variation_createby = $user_name;
                        $_date = date_create($variation_date);
                        $svDate = date_format($_date, 'Y-m-d h:i:s a');
                        $svDate2 = date_format($_date, 'Y-m-d h:i:s a');
                        $token = $variation_token;
                        $token1 = $variation->token(25);
                        $sv_data = array(
                            "variation_token" => $token,
                            "revison_token" => $token1,
                            "variation_project" => strtolower($variation_project_code),
                            "variation_project_name" => $variation_project_name,
                            "variation_project_location" => $variation_project_location,
                            "variation_refno_p1" => $variation_refno_p1,
                            "variation_refno_p2" => $variation_refno_p2,
                            "variation_refno_p3" => $variation_refno_p3,
                            "variation_refno_p4" => $variation_refno_p4,
                            "variation_refno" => $variation_refno,
                            "variation_date" => $svDate,
                            "variation_to" => $variation_to,
                            "variation_subject" => $variation_subjectn,
                            "variation_description" => $variation_description,
                            "variation_amount" => $variation_amount,
                            "variation_remarks" => $variation_remarks,
                            "variation_region" => $variation_region,
                            "variation_salesman" => $variation_salesman,
                            "variation_status" => $variation_status,
                            "variation_createby" => $variation_createby,
                            "variation_editby" => $variation_createby,
                            "variation_cdate" => $svDate2,
                            "variation_edate" => $svDate2,
                            "revision_no" => $revision_no,
                            "variation_atten" => $variation_atten
                        );

                        $api =  json_decode($variation->NewRevision($sv_data));
                        if($api->msg == "1"){
                            $location = "../../assets/variations/";
                            $location2 = "../../assets/v1/";
                            $filenamesxzy = $location . $token . ".pdf";
                            $filenamesxzy1 = $location2 . $token1 . ".pdf";
                            //echo $filenamesxzy1;
                            if (file_exists($filenamesxzy)) {
                                unlink($filenamesxzy);
                            }

                            move_uploaded_file($_FILES['pdffile']['tmp_name'],$filenamesxzy);

                            if (file_exists($filenamesxzy1)) {
                                unlink($filenamesxzy1);
                            }
                            copy($filenamesxzy, $filenamesxzy1);
                            if ($variation_status == '2' || $variation_status == '3' || $variation_status == '4') {
                                $location = "../../assets/variation_status/";
                                $location2 = "../../assets/vs1/";
                                $filenamesxzy = $location . $token . ".pdf";
                                $filenamesxzy2 = $location2 . $token1 . ".pdf";
                                if (file_exists($filenamesxzy)) {
                                    unlink($filenamesxzy);
                                }

                                move_uploaded_file($_FILES['pdffile1']['tmp_name'], $filenamesxzy);
                                if (file_exists($filenamesxzy2)) {
                                    unlink($filenamesxzy2);
                                }
                                copy($filenamesxzy, $filenamesxzy2);

                                echo response("1", "Saved");
                            }else{
                                echo response("1", "Saved");
                            }
                        }else{
                            echo response("0", $api->data);
                        }
                    }else{
                        echo response("0", "Upload File Missing or upload file not PDF FORMAT");
                    }
                }
            }
        } else {
            echo response("0", "Access Error");
        }
    } else {
        echo response("0", "Request Error");
    }
