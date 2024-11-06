<?php 
    include_once '../_def.php';
    $auth = true;
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        echo response("0","Request Error");
        exit;
    }

    $data = json_decode(file_get_contents("php://input"));
    include_once('../../connection/connection.php');
    $connection = new connection();
    $cn = $connection->connect();
    include_once('../../controller/User.php');
    $user = new User($cn);
    include_once('../_auth.php');
    if(!$auth){
        echo response("0","Access Error");
        exit;
    }
    
    $approvals_for = !isset($data->newapproval->approvals_for) || trim($data->newapproval->approvals_for) === "" ? "" : trim($data->newapproval->approvals_for);
    if($approvals_for === ""){
        echo response("0","Select Approval Category ");
        exit;
    }
    $approvals_draw_no = !isset($data->newapproval->approvals_draw_no) || trim($data->newapproval->approvals_draw_no) === "" ? "" : trim($data->newapproval->approvals_draw_no);
    if($approvals_draw_no === ""){
        echo response("0", "Enter Drawing Number");
        exit;
    }
    $approvals_descriptions = !isset($data->newapproval->approvals_descriptions) || trim($data->newapproval->approvals_descriptions) === "" ? "" : trim($data->newapproval->approvals_descriptions);
    if($approvals_descriptions === ""){
        echo response("0", "Enter Approval description");
        exit;
    }
    include_once("../../controller/DrawingApprovals.php");
    $DrawingApprovals = new DrawingApprovals($cn);
    $date = date('Y-m-d');
    $username = $data->naf_user->user_name;
    $token = $DrawingApprovals->token(75) .".". $username . "." . date("Ymdhis");
    $checkparam = array(
        ":approvals_draw_no" => $user->enc('enc',$approvals_draw_no),
        ":approvals_project_code" => $user->enc('enc',$data->project_no),
    );
    $sql = "SELECT count(approvals_draw_no) as cnt from pms_draw_approvals where 
    approvals_draw_no=:approvals_draw_no 
    and 
    approvals_project_code=:approvals_project_code";
    $cm = $cn->prepare($sql);
    $cm->execute($checkparam);
    $rows = $cm->fetch(PDO::FETCH_ASSOC);
    $cnt = (int)$rows['cnt'];
    unset($cm,$sql,$rows);
    if($cnt !== 0){
        echo response("0","Aready This Drawing No Registered with This Project");
        exit;
    }

    $Idrawings = array(
        ":approvals_token" => $user->enc('enc',$token),
        ":approvals_for" => $approvals_for,
        ":approvals_draw_no" => $user->enc('enc',$approvals_draw_no),
        ":approvals_descriptions" => $user->enc('enc',$approvals_descriptions),
        ":approvals_last_status" => $user->enc('enc','-'),
        ":approvals_last_revision_no" => $user->enc('enc','-'),
        ":approvals_cby" => $username,
        ":approvals_eby" =>  $username,
        ":approvals_project_code" => $user->enc('enc',$data->project_no),
        ":approvals_infos_sub" => $user->enc('enc','-'),
        ":approvals_infos_submitedon" => $user->enc('enc','-'),
        ":approvals_infos_receivedon" => $user->enc('enc','-'),
        ":approvals_infos_clienton" => $user->enc('enc','='),
        ":approvals_last_revision_code" => $user->enc('enc','-'),
    );
    $sql = "INSERT INTO pms_draw_approvals values(
        null,
        :approvals_token,
        :approvals_for,
        :approvals_draw_no,
        :approvals_descriptions,
        :approvals_last_status,
        :approvals_last_revision_no,
        :approvals_cby,
        :approvals_eby,
        now(),
        now(),
        :approvals_project_code,
        :approvals_infos_sub,
        :approvals_infos_submitedon,
        :approvals_infos_receivedon,
        :approvals_infos_clienton,
        :approvals_last_revision_code
    )";
    $cm = $cn->prepare($sql);
    $isSaved = $cm->execute($Idrawings);
    unset($sql,$cm);

    if(!$isSaved){
        echo response("0","Error on saving Data");
        exit();
    }

    echo response("1","Data Has Saved");
    exit;
    
?>