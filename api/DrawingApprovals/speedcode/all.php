<?php 
    include_once('../../_def.php');
    extract($_GET);

    if(!isset($kstart) || $kstart === ''){

    }else if(!isset($kend) || $kend === ''){

    }else{
        include_once('../../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();
        include_once('../../../controller/mac.php');
        $enc = new mac();

        $sql = "SELECT *FROM (pms_draw_approvals inner join pms_draw_approvals_types on pms_draw_approvals_types.types_id = pms_draw_approvals.approvals_for) inner join pms_project_summary on pms_project_summary.project_no = pms_draw_approvals.approvals_project_code LIMIT $kstart, 100";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $_approvals = [];
        while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $days = '-';
            if (date_create($enc->enc('denc', $approvals_infos_submitedon)) && date_create($enc->enc('denc', $approvals_infos_receivedon))) {
                $_x = date_create($enc->enc('denc', $approvals_infos_submitedon));
                $_y = date_create($enc->enc('denc', $approvals_infos_receivedon));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
            }

            $fs = "0";
            $fno = '../../../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $status = $enc->enc('enc', $approvals_last_status);
            $approvals_infos_submitedon = $enc->enc('denc', $approvals_infos_submitedon);
            $approvals_infos_receivedon = $enc->enc('denc', $approvals_infos_receivedon);
            $approvals_infos_clienton = $enc->enc('denc', $approvals_infos_clienton);
            $dif = 0;
            $approvals_infos_submitedon_d = $approvals_infos_submitedon;
            if (date_create($approvals_infos_submitedon)) {
                $date1 = date_create($approvals_infos_submitedon);
                $x_approvals_infos_submitedon = date_create($approvals_infos_submitedon);
                $approvals_infos_submitedon = date_format($x_approvals_infos_submitedon, 'Y-m-d');
                $approvals_infos_submitedon_d = date_format($x_approvals_infos_submitedon, 'd-M-Y');
            }
            $approvals_infos_receivedon_d = '-';
            if (date_create($approvals_infos_receivedon)) {
                $date2 = date_create($approvals_infos_receivedon);
                $x_approvals_infos_receivedon = date_create($approvals_infos_receivedon);
                $approvals_infos_receivedon = date_format($x_approvals_infos_receivedon, 'Y-m-d');
                $approvals_infos_receivedon_d = date_format($x_approvals_infos_receivedon, 'd-M-Y');
            }
            $approvals_infos_clienton_d = $approvals_infos_clienton;

            if (date_create($approvals_infos_clienton)) {

                $x_approvals_infos_clienton = date_create($approvals_infos_clienton);
                $approvals_infos_clienton = date_format($x_approvals_infos_clienton, 'Y-m-d');
                $approvals_infos_clienton_d = date_format($x_approvals_infos_clienton, 'd-M-Y');
            } else {
                $x_approvals_infos_clienton = date('Y-m-d');
                $approvals_infos_clienton = $x_approvals_infos_clienton;
                $approvals_infos_clienton_d = '-';
            }



            $project_infos = $enc->enc('denc', $project_name) . '(' . $enc->enc('denc', $approvals_project_code) . ')';
            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $enc->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $enc->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $enc->enc('denc', $approvals_last_status),
                
                'approvals_last_revision_no' => $approvals_last_revision_no,
                'approvals_cby' => $enc->enc('denc', $approvals_cby),
                'approvals_eby' => $enc->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'approvals_project_code' => $enc->enc('denc', $approvals_project_code),
                'types_id' =>  $types_id,
                'types_name' => $enc->enc('denc', $types_name),
                'approvals_infos_sub' => $enc->enc('denc', $approvals_infos_sub),
                'approvals_infos_submitedon' => $approvals_infos_submitedon,
                'approvals_infos_receivedon' => $approvals_infos_receivedon,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_last_revision_code' => $enc->enc('denc', $approvals_last_revision_code),
                'project_name' => $enc->enc('denc', $project_name),
                'project_cname' => $enc->enc('denc', $project_cname),
                'project_location' => $enc->enc('denc', $project_location),
                'delayclient' => $days,
                'f' => $fs,
                'approvals_infos_submitedon_d' => $approvals_infos_submitedon_d,
                'approvals_infos_receivedon_d' => $approvals_infos_receivedon_d,                
                'approvals_infos_clienton_d' => $approvals_infos_clienton_d,
                'project_infos' => $project_infos

            );
        }
        echo response("1", $_approvals);
    }
?>