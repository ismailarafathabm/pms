<?php
date_default_timezone_set('Asia/Riyadh');
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
    if ($auth === true) {
        if (!isset($revison_project) || $revison_project === "") {
            echo response("0", "Project Informations Missing project No");
        } else if (!isset($revison_project_name) || $revison_project_name === "") {
            echo response("0", "Project Informations Missing project Name");
        } else if (!isset($revison_project_location) || $revison_project_location === "") {
            echo response("0", "Project Informations Missing project Location");
        } else if (!isset($revison_refno_p1) || $revison_refno_p1 === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_refno_p2) || $revison_refno_p2 === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_refno_p3) || $revison_refno_p3 === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_refno_p4) || $revison_refno_p4 === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_refno) || $revison_refno === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_no) || $revison_no === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revison_atten) || $revison_atten === "") {
            echo response("0", "Enter Referance Number...");
        } else if (!isset($revision_date) || $revision_date === "") {
            echo response("0", "Enter Date");
        } else if (!isset($revision_to) || $revision_to === "") {
            echo response("0", "Enter Forwarding To");
        } else if (!isset($revision_subject) || $revision_subject === "") {
            echo response("0", "Choose Variation For...");
        } else if (!isset($revision_description) || $revision_description === "") {
            echo response("0", "Enter Description");
        } else if (!isset($revision_amount) || $revision_amount === "") {
            echo response("0", "Enter Amount");
        } else if (!isset($revision_remark) || $revision_remark === "") {
            echo response("0", "Enter Remark");
        } else if (!isset($revision_region) || $revision_region === "") {
            echo response("0", "Choose any region");
        } else if (!isset($revision_salesman) || $revision_salesman === "") {
            echo response("0", "Choose any Sales Man");
        } else {
            if (!is_numeric($revision_amount)) {
                echo response("0", "Check Amount format...");
            } else if (!date_create($revision_date)) {
                echo response("0", "Check Date Format...");
            } else {
                if (!is_uploaded_file($_FILES['pdffile']['tmp_name'])) {
                    echo response("0", "Choose This Variation PDF File");
                } else {
                    $filename = $_FILES['pdffile']['name'];
                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    if ($file_ext === "pdf") {
                        include_once('../../controller/vari.php');
                        $variation = new Variations($db);
                        $variation_createby = $user_name;
                        // $_date = date_create($variation_date);
                        $_revision_date = date_create($revision_date);
                        $revision_date  = date_format($_revision_date,'Y-m-d');
                        $svDate = date('Y-m-d h:i:s a');
                        $svDate2 = date('Y-m-d h:i:s a');
                        $token = $variation->token(85);
                        $token1 = $variation->token(85);

                        $sql = "SELECT *FROM nafco_variation where variation_token='$token'";
                        $cm  = $db->prepare($sql);
                        $cm->execute();

                        $cnt = $cm->rowCount();

                        unset($cm,$sql);

                        if($cnt !== 0){                            
                            for($i=0 ; $i< $cnt ;$i++){
                                $sql = "SELECT *FROM nafco_variation where variation_token='$token'";
                                $cm = $db->prepare($sql);
                                $cm->execute();
                                $cnt = $cm->rowCount();
                                unset($cm,$sql);
                                if($cnt === 0){
                                    break;
                                }else{
                                    $token = $variation->token(85);
                                }
                            }
                        }

                        $sql = "SELECT *FROM nafco_variation_revison where revison_token='$token1'";
                        $cm = $db->prepare($sql);
                        $cm->execute();
                        $rcnt = $cm->rowCount();
                        unset($cm,$sql);
                        if($rcnt !== 0){
                            for($i=0;$i<$rcnt;$i++){
                                $sql = "SELECT *FROM nafco_variation_revison where revison_token='$token1'";
                                $cm = $db->prepare($sql);
                                $cm->execute();
                                $_cnt = $cm->rowCount();
                                if($_cnt === 0){
                                    break;
                                }else{
                                    $token1 = $variation->token(85);
                                }
                            }
                        }
                        $ydate = date('Y-m-d');
                        $vairaionifno = array(
                            ':variation_token' => $token,
                            ':variation_project' => $variation->enc('enc',strtolower($revison_project)),
                            ':variation_project_name' => $variation->enc('enc',$revison_project_name),
                            ':variation_project_location' => $variation->enc('enc',$revison_project_location),
                            ':variation_refno_p1' => $variation->enc('enc',$revison_refno_p1),
                            ':variation_refno_p2' => $variation->enc('enc',$revison_refno_p2),
                            ':variation_refno_p3' => $variation->enc('enc',$revison_refno_p3),
                            ':variation_refno_p4' => $variation->enc('enc',$revison_refno_p4),
                            ':variation_refno' => $variation->enc('enc',$revison_refno),
                            ':variation_date' => $revision_date,
                            ':variation_to' => $variation->enc('enc',$revision_to),
                            ':variation_subject' => $revision_subject,
                            ':variation_description' => $variation->enc('enc',$revision_description),
                            ':variation_amount' => $variation->enc('enc',$revision_amount),
                            ':variation_remarks' => $variation->enc('enc',$revision_remark),
                            ':variation_region' => $revision_region,
                            ':variation_salesman' => $variation->enc('enc',$revision_salesman),
                            ':variation_status' => $variation->enc('enc','1'),
                            ':variation_createby' => $variation->enc('enc',$user_name),
                            ':variation_editby' => $variation->enc('enc',$user_name),
                            ':variation_cdate' =>  $svDate,
                            ':variation_edate' =>  $svDate,
                            ':revision_no' => $variation->enc('enc',$revison_no),
                            ':variation_atten' =>$variation->enc('enc',$revison_atten),
                            ':whochange' => $variation->enc('enc','-'),
                            ':datechange' => $ydate,
                            ':vno' => $variation->enc('enc','-'),
                            ':approvedate' => $ydate,
                            ':reldate' => $ydate,
                            ':caceldate' => $ydate,
                            ':cancelby' => $variation->enc('enc','-'),
                            ':amountrecviced' => $variation->enc('enc','-'),
                            ':recived_date' =>$ydate,
                            ':reftext' => $variation->enc('enc','-'),
                        );
                        $revisioninfo = array(
                            ':revison_token' => $token1,
                            ':revison_project' => $variation->enc('enc',strtolower($revison_project)),
                            ':revison_project_name' => $variation->enc('enc',$revison_project_name),
                            ':revison_project_location' => $variation->enc('enc',$revison_project_location),
                            ':revison_refno_p1' => $variation->enc('enc',$revison_refno_p1),
                            ':revison_refno_p2' => $variation->enc('enc',$revison_refno_p2),
                            ':revison_refno_p3' => $variation->enc('enc',$revison_refno_p3),
                            ':revison_refno_p4' => $variation->enc('enc',$revison_refno_p4),
                            ':revison_refno' => $variation->enc('enc',$revison_refno),
                            ':revison_no' => $variation->enc('enc',$revison_no),
                            ':revision_date' => $revision_date,
                            ':revision_to' => $variation->enc('enc',$revision_to),
                            ':revision_subject' => $revision_subject,
                            ':revision_description' => $variation->enc('enc',$revision_description),
                            ':revision_amount' => $variation->enc('enc',$revision_amount),
                            ':revision_region' =>$revision_region,
                            ':revision_salesman' => $variation->enc('enc',$revision_salesman),
                            ':revision_status' => $variation->enc('enc','1'),
                            ':revision_createdby' => $variation->enc('enc',$user_name),
                            ':revision_editby' => $variation->enc('enc',$user_name),
                            ':revision_cdate' => $svDate,
                            ':revision_edate' => $svDate,
                            ':variation_token' => $token,
                            ':revison_atten' => $variation->enc('enc',$revison_atten),
                            ':revision_remark' => $variation->enc('enc',$revision_remark),                            
                            ':whochange' => $variation->enc('enc','-'),
                            ':datechange' => $ydate,
                            ':vno' => $variation->enc('enc','-'),
                            ':approvedate' => $ydate,
                            ':reldate' => $ydate,
                            ':caceldate' => $ydate,
                            ':cancelby' => $variation->enc('enc','-'),
                            ':amountrecviced' => $variation->enc('enc','-'),
                            ':recived_date' => $ydate,
                            ':reftext' => $variation->enc('enc','-'),
                        );

                        $api = json_decode($variation->NewVariations($vairaionifno,$revisioninfo));
                        if($api->msg === '1'){
                            //upload actions
                            $location = "../../assets/variations/";
                            $location2 = "../../assets/v1/";
                            $filenamesxzy = $location . $token . ".pdf";
                            $filenamesxzy1 = $location2 . $token1 . ".pdf";
                            //echo $filenamesxzy1;
                            if (file_exists($filenamesxzy)) {
                                unlink($filenamesxzy);
                            }
    
                            move_uploaded_file($_FILES['pdffile']['tmp_name'], $filenamesxzy);
                            if (file_exists($filenamesxzy1)) {
                                unlink($filenamesxzy1);
                            }
                            copy($filenamesxzy, $filenamesxzy1);
                            echo response('1','saved');
                        }else{
                            echo response('0',$api->data);
                        }                       

                    } else {
                        echo response("0", "upload file not PDF FORMAT");
                    }
                }
            }
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}