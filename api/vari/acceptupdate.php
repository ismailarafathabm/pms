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
    if ($auth === true) {
        if (!isset($status) || $status === '') {
            echo response('0', 'Select Status');
        } else if(!isset($vno) || $vno === ''){
            echo response('0','Enter VO NO');
        }else if (!isset($approvedate) || $approvedate === '' || !date_create($approvedate)) {
            echo response('0', 'Select Approved Date and/or Approved Date is Not a date format');
        } else if (!isset($reldate) || $reldate === '' || !date_create($approvedate)) {
            echo response('0', 'Select Released Date and/or Released Date is Not a date format');
        } else if (!isset($variation_project) || $variation_project === '') {
            echo response('0', 'Select Project');
        } else if (!isset($variation_token) || $variation_token === '') {
            echo response('0', 'Select Variations');
        } else if (!isset($revison_token) || $revison_token === '') {
            echo response('0', 'Select Revision');
        } else {
            if (!is_uploaded_file($_FILES['pdffile']['tmp_name'])) {
                echo response('0', 'Select Upload File');
            } else {
                $ext = strtolower(
                    pathinfo(
                        $_FILES['pdffile']['name'],
                        PATHINFO_EXTENSION
                    )
                );

                if ($ext === "pdf") {
                    include_once '../../controller/vari.php';
                    $variations = new Variations($db);
                    $_approvedate = date_create($approvedate);
                    $approvedate = date_format($_approvedate, 'Y-m-d');
                    $_reldate = date_create($reldate);
                    $reldate = date_format($_reldate, 'Y-m-d');
                    $variation = array(
                        ':variation_status' => $variations->enc('enc', $status),
                        ':vno' => $variations->enc('enc',$vno),
                        ':approvedate' => $approvedate,
                        ':reldate' => $reldate,
                        ':variation_project' => $variations->enc('enc', strtolower($variation_project)),
                        ':variation_token' => $variation_token,
                    );
                    $revision = array(
                        ':revision_status' => $variations->enc('enc', $status),
                        ':vno' => $variations->enc('enc',$vno),
                        ':approvedate' => $approvedate,
                        ':reldate' => $reldate,
                        ':revison_token' => $revison_token,
                        ':revison_project' => $variations->enc('enc', strtolower($variation_project)),
                        ':variation_token' => $variation_token,
                    );

                    $api = json_decode($variations->UpdateVariationApproved($variation, $revision));
                    if ($api->msg === "1") {
                        
                        $location = "../../assets/variation_status/";
                        $location1 = "../../assets/vs1/";
                        $filenamesxzy = $location . $variation_token . ".pdf";
                        $filenamesxzy1 = $location1 . $revison_token . ".pdf";
                        if (file_exists($filenamesxzy)) {
                            unlink($filenamesxzy);
                        }
                        move_uploaded_file($_FILES['pdffile']['tmp_name'], $filenamesxzy);
                        if (file_exists($filenamesxzy1)) {
                            unlink($filenamesxzy1);
                        }
                        copy($filenamesxzy, $filenamesxzy1);
                        echo response("1", "Status Updated");
                    } else {
                        echo response('0', $api->data);
                    }
                } else {
                    echo response("0", "{$ext} format Not support,Please Choose PDF FORMAT FILES");
                }
            }
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
