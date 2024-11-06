<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'GET') {
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

$project_hadnoverx = $user->enc('enc', '3');

$sql = "SELECT *FROM pms_project_summary as project left join 
    (SELECT `approvals_projectid`,count(approvals_projectid) as cnt_techapprovals FROM `pms_approvals` group by approvals_projectid) as approvals on project.project_no = approvals.approvals_projectid left join
    (SELECT approvals_project_code,count(approvals_project_code) as cnt_drawapprovals FROM  pms_draw_approvals group by approvals_project_code) as drawings on project.project_no = drawings.approvals_project_code left join 
    (SELECT mrproject,count(mrproject) as cnt_mr from pms_materials_materialrequest group by mrproject) as mr on project.project_id = mr.mrproject left join 
    (SELECT bom_projectid,count(bom_projectid) as cnt_bom from pms_bom group by bom_projectid) as bom on project.project_id = bom.bom_projectid left join 
    (SELECT projectid,count(projectid) as cl_cnt from pms_cuttinglist group by projectid) as cl on project.project_id = cl.projectid left join 
    (SELECT goprojectid,count(goprojectid) as go_cnt from pms_cuttinglistgo group by goprojectid) as gos on project.project_id = gos.goprojectid left join 
    (SELECT projectid,count(projectid) as clp_cnt from pms_cuttinglist where production_accept = 4 group by projectid) as clp on project.project_id = clp.projectid 
    where project.project_hadnover <>'" . $project_hadnoverx . "'";
$cm = $cn->prepare($sql);
$cm->execute();
$_projects = [];
include_once 'cols.php';

while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    extract($rows);
    $project_x = $user->enc('denc', $project_no);
    $ex_project = explode('/', $project_x);
    if (count($ex_project) === 1) {
    } else {
        $projectF = $ex_project[1];
        $ptx = $ex_project[0];
        $pt = $ptx[0];
        if ($pt === 'p') {
            $projectB = explode('p', $ex_project[0]);
        } else {
            $projectB = explode('v', $ex_project[0]);
        }
        $projectBA =  $projectB[1];
        $filelocation = "../../assets/contract/" . $project_no . ".pdf";
        $f = '0';
        if (file_exists($filelocation)) {
            $f = '1';
        }
        $status =  $user->enc('denc', $project_status);
        $projectsnodisp = $projectF . "-" . $projectBA . "P";

        $techapprovals_cnt = is_null($cnt_techapprovals) ? '0' : $cnt_techapprovals;
        $techapprovals_status = (int)$techapprovals_cnt === 0 ? "NO" : "YES";

        $drawingapprovals_cnt = is_null($cnt_drawapprovals) ? '0' : $cnt_drawapprovals;
        $drawingapprovals_status = (int)$drawingapprovals_cnt === 0 ? "NO" : "YES";

        $mr_cnt = is_null($cnt_mr) ? '0' : $cnt_mr;
        $mr_status = (int)$mr_cnt === 0 ? "NO" : "YES";

        $bom_cnt = is_null($cnt_bom) ? '0' : $cnt_bom;
        $bom_status = (int)$bom_cnt === 0 ? "NO" : "YES";

        $cl_cnt = is_null($cl_cnt) ? '0' : $cl_cnt;
        $cl_status = (int)$cl_cnt === 0 ? "NO" : "YES";

        $gos_cnt = is_null($go_cnt) ? '0' : $go_cnt;
        $gos_status = (int)$gos_cnt === 0 ? "NO" : "YES";


        $clp_cnt = is_null($clp_cnt) ? '0' : $clp_cnt;
        $clp_status = (int)$clp_cnt === 0 ? "NO" : "YES";


        if ($pt === 'p') {
            $_projects[] = array(
                "project_id" => $project_id,
                "project_no_enc" => $project_no,
                "projectsnodisp" =>  $projectsnodisp,
                "project_no" => $user->enc('denc', $project_no),
                "project_name" => $user->enc('denc', $project_name),
                "project_cname" => $user->enc('denc', $project_cname),
                "project_location" => strtoupper($user->enc('denc', $project_location)),
                "project_singdate" => $project_singdate,
                "project_singdate_d" => datemethod($project_singdate),
                "project_sing_description" => $user->enc('denc', $project_sing_description),
                "project_contract_duration" => $user->enc('denc', $project_contract_duration),
                "project_contract_description" => $user->enc('denc', $project_contract_description),
                "project_contact_person" => $user->enc('denc', $project_contact_person),
                "project_contact_no" => $user->enc('denc', $project_contact_no),
                "Sales_Representative" => $user->enc('denc', $Sales_Representative),
                "project_penalty" => $user->enc('denc', $project_penalty),
                "project_expiry_date" => $project_expiry_date,
                "project_expiry_date_d" => datemethod($project_expiry_date),
                "project_remarks" => $user->enc('denc', $project_remarks),
                "project_amount" => (float) $user->enc('denc', $project_amount),
                "project_basicpayment" => (float) $user->enc('denc', $project_basicpayment),
                "project_first_advance_amount" => (float) $user->enc('denc', $project_first_advance_amount),
                "project_first_advance" => (float) $user->enc('denc', $project_first_advance),
                "project_advacne_date" => $project_advacne_date,
                "advance_amount_remark" => $user->enc('denc', $advance_amount_remark),
                "project_enter_date" => $project_enter_date,
                "project_edit_date" => $project_edit_date,
                "project_status" => $status,
                "project_create_by" => $user->enc('denc', $project_create_by),
                "project_ledit_by" => $user->enc('denc', $project_ledit_by),
                "project_boq_refno" => $user->enc('denc', $project_boq_refno),
                "project_boq_revision" => $user->enc('denc', $project_boq_revision),
                "project_handover_date" => $project_handover_date,
                "project_handover_date_d" => datemethod($project_handover_date),
                "project_hadnover" => $user->enc('denc', $project_hadnover),
                "projectRegion" => $user->enc('denc', $projectRegion),
                "project_type" => $user->enc('denc', $project_type),
                "f" => $f,
                "f_status" => (string)$f === "1" ? "YES" : "NO",
                'lo' => $filelocation,
                "techapprovals_cnt" => $techapprovals_cnt,
                "techapprovals_status" => $techapprovals_status,
                "drawingapprovals_cnt" => $drawingapprovals_cnt,
                "drawingapprovals_status" => $drawingapprovals_status,
                "mr_cnt" => $mr_cnt,
                "mr_status" => $mr_status,
                "bom_cnt" => $bom_cnt,
                "bom_status" => $bom_status,
                "cl_cnt" => $cl_cnt,
                "cl_status" => $cl_status,
                "gos_cnt" => $gos_cnt,
                "gos_status" => $gos_status,
                "clp_cnt" => $clp_cnt,
                "clp_status" => $clp_status,
            );
        }
    }
}
header('http/1.0 200 ok');
echo response("1", $_projects);
exit();
