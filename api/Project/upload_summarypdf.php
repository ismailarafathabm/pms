<?php
include_once('../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);    
    $naf_user = array(
        'user_name' => $user_name,
        'user_token' => $user_token
    );
    $datas = array(
        'naf_user' => $naf_user
    );
    $s = json_encode($datas);
    $data = json_decode($s);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if (isset($project_project_no) && $project_project_no !== '') {
            if (is_uploaded_file($_FILES['pdffile']['tmp_name'])) {                
                $filename = $_FILES['pdffile']['name'];
                $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if($file_ext === 'pdf'){
                    $_msg = array(
                        "status" => "OK",
                        "PAGEID" => "SUMMARY PDF",
                        "ACTION" => "FOR UPDATE SUMMARY PDF",
                        "API_PAGE" => "api/Project/upload_summarypdf.php",
                        "msg" => "-"
                    );
                    $_log = array(
                        'log_user' => $data->naf_user->user_name,
                        'log_time' => date('Y-m-d H:i:s'),
                        'log_descripton' => json_encode($_msg),
                        'log_action' => "EDIT",
                        'log_token' => $data->naf_user->user_token
                    );
                    // include_once '../../controller/log.php';
                    // $log = new LOG($db);
                    // $log->save_log($_log);
                    
                    $fileno = $project_project_no;
                    $location = "../../assets/contract/";
                    $filenamesxzy = $location . $fileno . ".pdf";
                    if (file_exists($filenamesxzy)) {
                        unlink($filenamesxzy);
                    }
                    move_uploaded_file($filename = $_FILES['pdffile']['tmp_name'], $location . $filenamesxzy);
                    echo response("1", "saved");
                }else{
                    echo response("0", "Upload support only PDF Format");
                }
                
            }else{
                echo response("0", "Choose Upload File");
            }
        } else {
            echo response("0", "Project Code Missing");
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
