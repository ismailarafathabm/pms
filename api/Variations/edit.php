<?php
    include_once('../_def.php');
    $auth = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $db = $connection->connect();
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
        if ($auth === true){
            if(!isset($variation_token) || $variation_token === "" ){
                echo response("0","Project Informations Missing");
            }else if(!isset($variation_date) || $variation_date === "" ){
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_to) || $variation_to === "") {
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_subjectn) || $variation_subjectn === "") {
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_description) || $variation_description === "") {
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_amount) || $variation_amount === "") {
                echo response("0", "Project Informations Missing");
            } else if (!isset($variation_remarks) || $variation_remarks === "") {
                echo response("0", "Project Informations Missing");
            }else if (!isset($variation_region) || $variation_region === "") {
                echo response("0", "Project Informations Missing");            
            } else if (!isset($variation_salesman) || $variation_salesman === "") {
                echo response("0", "Project Informations Missing");
            }
            else{
                if(!date_create($variation_date)){
                    echo response("0", "Check Date Format...");
                }else if(!is_numeric($variation_amount)){
                    echo response("0", "Check Amount format...");
                }else{
                    include_once('../../controller/Variations.php');
                    $variation = new Variations($db);
                    $variation_createby = $user_name;
                    $_date = date_create($variation_date);
                    $svDate = date_format($_date, 'Y-m-d');
                    $variation_edate = date('Y-m-d h:i:s a');
                    $s_data = array(
                        "variation_refno_p1" => $variation->enc('enc',$variation_refno_p1),
                        "variation_refno_p2" => $variation->enc('enc',$variation_refno_p2),
                        "variation_refno_p3" => $variation->enc('enc',$variation_refno_p3),
                        "variation_refno_p4" => $variation->enc('enc',$variation_refno_p4),
                        "variation_refno" => $variation->enc('enc',$variation_refno),                    
                        "variation_date" => $svDate,
                        "variation_to" => $variation->enc('enc',$variation_to),
                        "variation_subject" => $variation_subjectn,
                        "variation_description" => $variation->enc('enc',$variation_description),
                        "variation_amount" => $variation->enc('enc',$variation_amount),
                        "variation_remarks" => $variation->enc('enc',$variation_remarks),
                        "variation_region" => $variation_region,
                        "variation_salesman" =>$variation->enc('enc',$variation_salesman),                        
                        "variation_editby" => $variation->enc('enc',$variation_createby),
                        "variation_edate" => $variation_edate,
                        "revision_no" => $variation->enc('enc',$revision_no),
                        "variation_atten" => $variation->enc('enc',$variation_atten),
                        "variation_id" => $variation_id                    
                    );
                    
                    $api = json_decode($variation->EditVariations($s_data));
                    if($api->msg == "1"){
                        if(is_uploaded_file($_FILES['pdffile']['tmp_name'])){
                            $filename = $_FILES['pdffile']['name'];
                            $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                            if ($file_ext !== "pdf") {
                                echo response("0", "Data saved\nnote : file upload Error Your Upload File is not a PDF Doucment");
                            }else{
                                $location = "../../assets/variation/";
                                $filenamesxzy = $location . $variation_token . ".pdf";
                                if (file_exists($filenamesxzy)) {
                                    unlink($filenamesxzy);
                                }
                                move_uploaded_file($_FILES['pdffile']['tmp_name'], $location . $filenamesxzy);
                                echo response("1", "Saved");
                            }
                        }else{
                            echo response("1", "Saved");
                        }
                    }else{
                        echo response("0", $api->data);
                    }
                }
            }
        }else{
            echo response("0", "Access Error");
        }
    } else {
        echo response("0", "Request Error");
    }
