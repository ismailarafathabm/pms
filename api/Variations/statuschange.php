<?php
    include_once('../_def.php');
    $auth = false;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        extract($_POST);
        //print_r($_POST);
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
            if(!isset($token_variation) || $token_variation === ""){
                echo response("0", "Project Informations missing");
            }else if(!isset($token_revison) || $token_revison === ""){
                echo response("0", "Change Status");
            } else if (!isset($amount) || $amount === "") {
                echo response("0", "Enter Amount");
             }
            else if (!isset($status) || $status === "") {
                echo response("0", "Change Status");
            } else if (!isset($project_no) || $project_no === "") {
                echo response("0", "Change Status");
            }else{
                if(!is_uploaded_file($_FILES['pdffile']['tmp_name'])){
                    echo response("0", "Upload PDF document missing");                   
                }else{
                    $filename = $_FILES['pdffile']['name'];
                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    if($file_ext !== "pdf"){
                        echo response("0", "PDF file only Support");  
                    }else{
                        include_once('../../controller/Variations.php');
                        $v = new Variations($db);
                        $api = json_decode($v->update_revision_approve($token_variation, $token_revison, $project_no, $status,$amount));

                        if($api->msg === "1"){
                            $location = "../../assets/variation_status/";
                            $location1 = "../../assets/vs1/";
                            $filenamesxzy = $location . $token_variation . ".pdf";
                            $filenamesxzy1 = $location1 . $token_revison . ".pdf";
                            if (file_exists($filenamesxzy)) {
                                unlink($filenamesxzy);
                            }
                            move_uploaded_file($_FILES['pdffile']['tmp_name'], $filenamesxzy);
                            if (file_exists($filenamesxzy1)) {
                                unlink($filenamesxzy1);
                            }
                            copy($filenamesxzy, $filenamesxzy1);
                            echo response("1", "Status Updated");
                        }else{
                            echo response("0", $api->data);
                        }
                    }
                }
            }
        }else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
?>