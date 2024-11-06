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
        if(!isset($variation_id) || $variation_id === ''){
            echo response("0", "Selec Any Revvision");
        }else if(!isset($revison_project) || $revison_project === ''){
            echo response("0", "Project Informations Missing project No");
        }else if(!isset($revison_project_name) || $revison_project_name === ''){
            echo response("0", "Project Informations Missing project Name");
        }else if(!isset($revison_project_location) || $revison_project_location === ''){
            echo response("0", "Project Informations Missing project Location");
        }else if(!isset($revison_refno_p1) || $revison_refno_p1 === ''){
            echo response("0", "Enter Referance Number...1");
        }else if(!isset($revison_refno_p2) || $revison_refno_p2 === ''){
            echo response("0", "Enter Referance Number...2");
        }else if(!isset($revison_refno_p3) || $revison_refno_p3 === ''){
            echo response("0", "Enter Referance Number...3");
        }else if(!isset($revison_refno_p4) || $revison_refno_p4 === ''){
            echo response("0", "Enter Referance Number...4");
        }else if(!isset($revison_refno) || $revison_refno === ''){
            echo response("0", "Enter Referance Number...");
        }else if(!isset($revison_no) || $revison_no === ''){
            echo response("0", "Enter Revision Number...");
        }else if(!isset($revison_atten) || $revison_atten === ''){
            echo response("0", "Enter Atten...");
        }else if(!isset($revision_date) || $revision_date === ''){
            echo response("0", "Enter Date");
        }else if(!isset($revision_to) || $revision_to === ''){
            echo response("0", "Enter Forwarding To");
        }
        else if(!isset($revision_subject) || $revision_subject === ''){
            echo response("0", "Choose Variation For...");
        }
        else if(!isset($revision_description) || $revision_description === ''){
            echo response("0", "Enter Description");
        }else if(!isset($revision_amount) || $revision_amount === ''){
            echo response("0", "Enter Amount");
        }else if(!isset($revision_remark) || $revision_remark === ''){
            echo response("0", "Enter Remark");
        }else if(!isset($revision_region) || $revision_region === ''){
            echo response("0", "Choose any region");
        }else if(!isset($revision_salesman) || $revision_salesman === ''){
            echo response("0", "Choose any Sales Man");
        }else{
            
            if(!date_create($revision_date)){
                echo response("0", "Check Date Format...");
            }else if( !is_numeric($revision_amount) ){
                echo response("0", "Check Amount format...");
            }else{
                $fileok = true;

                if(is_uploaded_file($_FILES['pdffile']['tmp_name'])){
                    $ext = strtolower(pathinfo($_FILES['pdffile']['name'],PATHINFO_EXTENSION));
                    if($ext !== 'pdf'){
                        $fileok = false;
                    }
                }

                if($fileok){
                    $_revision_date = date_create($revision_date);
                    $revision_date = date_format($_revision_date,'Y-m-d');
                    $date = date('Y-m-d h:i:s a');

                    require_once '../../controller/vari.php';
                    $variation = new Variations($db);
                    
                    $svdata = array(
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
                        ':variation_editby' => $variation->enc('enc',$user_name),
                        ':variation_edate' => $date,
                        ':revision_no' => $variation->enc('enc',$revison_no),
                        ':variation_atten' => $variation->enc('enc',$revison_atten),
                        ':variation_id' => $variation_id                        
                    );
                    //print_r($svdata);

                    $api = json_decode($variation->UpdateVariationsInfos($svdata));
                    if($api->msg === '1'){
                        if(is_uploaded_file($_FILES['pdffile']['tmp_name'])){
                            $location = "../../assets/variations/";
                            
                            $filenamesxzy = $location . $variation_token . ".pdf";
                            if (file_exists($filenamesxzy)) {
                                unlink($filenamesxzy);
                            }
                            move_uploaded_file($_FILES['pdffile']['tmp_name'], $location . $filenamesxzy);
                           // echo response("1", "Saved");
                        }
                        echo response("1","saved");
                    }else{
                        echo response('0',$api->data);
                    }
                }else{
                    echo response("0", "Choose This Variation PDF File");
                }
            }
        }
    }else{
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
