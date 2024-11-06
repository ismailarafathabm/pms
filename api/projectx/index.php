<?php 
    include_once '../cuttinglists/gen.php';
    if ($method !== 'POST') {
        header('HTTP/1.0 404 page not found');
        echo response("0", "Request Method Not Acceptable");
        exit;
    }
    $auth = true;    
    include_once '../cuttinglists/auth.php';
    if (!$auth) {
        header("HTTP/1.0 403 Authorization Error");
        echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
        exit;
    }

    extract($_POST);
    $project_id = !isset($project_id) || trim($project_id) === '' ? '' : trim($project_id);
    $project_handover_date = !isset($project_handover_date) || trim($project_handover_date) === '' ? '': trim($project_handover_date);
    if($project_handover_date === ''){
        header('http/1.0 409 bad request');
        echo response("0","Enter Handing Over Date");
        exit();
    }
    if(!date_create($project_handover_date)){
        header("http/1.0 409 bad request");
        echo response("0","Check Hadning Over Date");
        exit();
    }
    if($project_id === ""){
        header("http/1.0 409 bad request");
        echo response("0","Enter Project Informations");
        exit();
    }

    if(!isset($_FILES['pjpdf']['tmp_name'])){
        header("http/1.0 409 bad request");
        echo response("0","Upload File missing");
        exit();
    }

    if(!is_uploaded_file($_FILES['pjpdf']['tmp_name'])){
        header("http/1.0 409 bad request");
        echo response("0","PDF file missing");
        exit();
    }
    $pfile = $_FILES['pjpdf']['name'];
    $ext = strtolower(pathinfo($pfile,PATHINFO_EXTENSION));
    if($ext !== 'pdf'){
        header('http/1.0 409 bad request');
        echo response("0","Upload File should be PDF format file");
        exit();
    }

    $savelocation = "./../../assets/project/".$project_id.".pdf";
    if(file_exists($savelocation)){
        unlink($savelocation);
    }
    
    $hadingoverdate = date_format(date_create($project_handover_date),'Y-m-d');
    $status = $users->enc('enc','5');
    $project_hadnover = $users->enc('enc','3');
    $sql = "UPDATE pms_project_summary set project_status = '". $status ."',project_hadnover='". $project_hadnover ."', project_handover_date = :project_handover_date where project_id = :project_id";
    $cm = $cn->prepare($sql);
    $cm->bindParam(":project_id",$project_id);
    $cm->bindParam(":project_handover_date",$hadingoverdate);
    $sv = $cm->execute();
    if(!$sv){
        header('http/1.0 500 error');
        echo response("0","Error on update status");
        exit();
    }
    $upload = move_uploaded_file($_FILES['pjpdf']['tmp_name'],$savelocation);
    if(!$upload){
        header("http/1.0 500 error");
        echo response("0","Error on upload File");
        exit();
    }

    header('http/1.0 200 ok');
    echo response("1","Status Updated");
    exit();
    //$sql = "INSERT INTO project_status="
