<?php
date_default_timezone_set('Asia/Riyadh');
include_once('mac.php');
class ProjectApprovals extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $rows;
    private $response;

    private $pms_approval_types;
    private $approval_type_id;
    private $approval_type_name;



    private $pms_approvals;
    private $approvals_id;
    private $approvals_token;
    private $approvals_adate;
    private $approvals_rdate;
    private $approvals_givenby;
    private $approvals_ftotech;
    private $approvals_remarks;
    private $approvals_tmanager;
    private $approvals_rftmanger;
    private $approvals_tengineer;
    private $approvals_rftmanager;
    private $approvals_salse_dep;
    private $approvals_costing_dep;
    private $approvals_materials_dep;
    private $approvals_purchasing_dep;
    private $approvals_engineering_dep;
    private $approvals_status;
    private $approvals_projectid;
    private $approvals_cdate;
    private $approvals_cby;
    private $approvals_edate;
    private $approvals_eby;
    private $approval_type;

    private $pms_project_summary;
    private $project_no;
    private $project_name;
    private $project_cname;
    private $project_location;


    function __construct($db)
    {
        $this->cn = $db;
        $this->pms_approvals = mac::pms_approvals;
        $this->pms_approval_types = mac::pms_approval_types;
        $this->pms_project_summary = mac::pms_project_summary;
        $this->response = array("msg" => "1", "data" => "Error");
    }

    public function all_approvals()
    {
        $this->sql = "SELECT *FROM ($this->pms_approvals 
            inner join 
            $this->pms_approval_types on 
            $this->pms_approvals.approval_type = $this->pms_approval_types.approval_type_id) 
            inner join $this->pms_project_summary 
            on $this->pms_approvals.approvals_projectid = $this->pms_project_summary.project_no
            order by $this->pms_approvals.approvals_id";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();


        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $s = $this->enc('enc', $approvals_status);
            if ($s !== 'x') {

                $approvals_adate = $this->enc('denc', $approvals_adate);
                $approvals_rdate = $this->enc('denc', $approvals_rdate);
                $approvals_ftotech = $this->enc('denc', $approvals_ftotech);
                $approvals_rftmanger = $this->enc('denc', $approvals_rftmanger);
                $approvals_rftmanager = $this->enc('denc', $approvals_rftmanager);
                $approvals_salse_dep = $this->enc('denc', $approvals_salse_dep);
                $approvals_costing_dep = $this->enc('denc', $approvals_costing_dep);
                $approvals_materials_dep = $this->enc('denc', $approvals_materials_dep);
                $approvals_purchasing_dep = $this->enc('denc', $approvals_purchasing_dep);
                $approvals_engineering_dep = $this->enc('denc', $approvals_engineering_dep);
                if ($this->enc('denc', $approvals_status) == 'b') {
                    $_d_approvals_adate = date_create($approvals_adate);
                    $approvals_adate = date_format($_d_approvals_adate, 'd-M-Y');
                    $approvals_adate_s = date_format($_d_approvals_adate, 'Y-m-d');

                    $_d_approvals_rdate = date_create($approvals_rdate);
                    $approvals_rdate = date_format($_d_approvals_rdate, 'd-M-Y');
                    $approvals_rdate_s = date_format($_d_approvals_rdate, 'Y-m-d');

                    $_d_approvals_ftotech = date_create($approvals_ftotech);
                    $approvals_ftotech = date_format($_d_approvals_ftotech, 'd-M-Y');

                    $_d_approvals_rftmanger = date_create($approvals_rftmanger);
                    $approvals_rftmanger = date_format($_d_approvals_rftmanger, 'd-M-Y');

                    $_d_approvals_rftmanager = date_create($approvals_rftmanager);
                    $approvals_rftmanager = date_format($_d_approvals_rftmanager, 'd-M-Y');

                    $_d_approvals_salse_dep = date_create($approvals_salse_dep);
                    $approvals_salse_dep = date_format($_d_approvals_salse_dep, 'd-M-Y');

                    $_d_approvals_costing_dep = date_create($approvals_costing_dep);
                    $approvals_costing_dep = date_format($_d_approvals_costing_dep, 'd-M-Y');

                    $_d_approvals_materials_dep = date_create($approvals_materials_dep);
                    $approvals_materials_dep = date_format($_d_approvals_materials_dep, 'd-M-Y');

                    $_d_approvals_purchasing_dep = date_create($approvals_purchasing_dep);
                    $approvals_purchasing_dep = date_format($_d_approvals_purchasing_dep, 'd-M-Y');

                    $_d_approvals_engineering_dep = date_create($approvals_engineering_dep);
                    $approvals_engineering_dep = date_format($_d_approvals_engineering_dep, 'd-M-Y');
                }
                $project_filters = $this->enc('denc', $project_name) . "[" . $this->enc('denc', $project_no) . "]";
                $_approvals[] = array(
                    'approvals_adate_s' => $approvals_adate_s,
                    'approvals_rdate_s' => $approvals_rdate_s,
                    'approvals_id' => $approvals_id,
                    'approvals_token' => $approvals_token,
                    'approvals_adate' => $approvals_adate,
                    'approvals_rdate' => $approvals_rdate,
                    'approvals_givenby' => $this->enc('denc', $approvals_givenby),
                    'approvals_ftotech' => $approvals_ftotech,
                    'approvals_remarks' => $this->enc('denc', $approvals_remarks),
                    'approvals_tmanager' => $this->enc('denc', $approvals_tmanager),
                    'approvals_rftmanger' => $approvals_rftmanger,
                    'approvals_tengineer' => $this->enc('denc', $approvals_tengineer),
                    'approvals_rftmanager' => $approvals_rftmanager,
                    'approvals_salse_dep' => $approvals_salse_dep,
                    'approvals_costing_dep' => $approvals_costing_dep,
                    'approvals_materials_dep' => $approvals_materials_dep,
                    'approvals_purchasing_dep' => $approvals_purchasing_dep,
                    'approvals_engineering_dep' => $approvals_engineering_dep,
                    'approvals_status' => $this->enc('denc', $approvals_status),
                    'approvals_projectid' => $this->enc('denc', $approvals_projectid),
                    'approvals_cdate' => $this->enc('denc', $approvals_cdate),
                    'approvals_cby' => $this->enc('denc', $approvals_cby),
                    'approvals_edate' => $this->enc('denc', $approvals_edate),
                    'approvals_eby' => $this->enc('denc', $approvals_eby),
                    'approval_type' => $approval_type,
                    'project_no' => $this->enc('denc', $project_no),
                    'project_name' => $this->enc('denc', $project_name),
                    'project_cname' => $this->enc('denc', $project_cname),
                    'project_location' => $this->enc('denc', $project_location),
                    'approval_type_id' => $approval_type_id,
                    'approval_type_name' => $this->enc('denc', $approval_type_name),
                    'project_filters' => $project_filters,
                );
            }
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }

    public function all_project_approvals($project_id)
    {
        $this->approvals_projectid = $this->enc('enc', $project_id);
        $this->sql = "SELECT *FROM ($this->pms_approvals 
            inner join 
            $this->pms_approval_types on 
            $this->pms_approvals.approval_type = $this->pms_approval_types.approval_type_id) 
            inner join $this->pms_project_summary 
            on $this->pms_approvals.approvals_projectid = $this->pms_project_summary.project_no 
            where 
            $this->pms_approvals.approvals_projectid = :approvals_projectid             
            order by $this->pms_approvals.approvals_id";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":approvals_projectid", $this->approvals_projectid);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $s = $this->enc('denc', $approvals_status);
            if ($s !== 'x') {
                $approvals_adate = $this->enc('denc', $approvals_adate);
                $approvals_rdate = $this->enc('denc', $approvals_rdate);
                $approvals_ftotech = $this->enc('denc', $approvals_ftotech);
                $approvals_rftmanger = $this->enc('denc', $approvals_rftmanger);
                $approvals_rftmanager = $this->enc('denc', $approvals_rftmanager);
                $approvals_salse_dep = $this->enc('denc', $approvals_salse_dep);
                $approvals_costing_dep = $this->enc('denc', $approvals_costing_dep);
                $approvals_materials_dep = $this->enc('denc', $approvals_materials_dep);
                $approvals_purchasing_dep = $this->enc('denc', $approvals_purchasing_dep);
                $approvals_engineering_dep = $this->enc('denc', $approvals_engineering_dep);

                if ($this->enc('denc', $approvals_status) == 'b') {
                    $_d_approvals_adate = date_create($approvals_adate);
                    $approvals_adate = date_format($_d_approvals_adate, 'd-M-Y');

                    $_d_approvals_rdate = date_create($approvals_rdate);
                    $approvals_rdate = date_format($_d_approvals_rdate, 'd-M-Y');

                    $_d_approvals_ftotech = date_create($approvals_ftotech);
                    $approvals_ftotech = date_format($_d_approvals_ftotech, 'd-M-Y');

                    $_d_approvals_rftmanger = date_create($approvals_rftmanger);
                    $approvals_rftmanger = date_format($_d_approvals_rftmanger, 'd-M-Y');

                    $_d_approvals_rftmanager = date_create($approvals_rftmanager);
                    $approvals_rftmanager = date_format($_d_approvals_rftmanager, 'd-M-Y');

                    $_d_approvals_salse_dep = date_create($approvals_salse_dep);
                    $approvals_salse_dep = date_format($_d_approvals_salse_dep, 'd-M-Y');

                    $_d_approvals_costing_dep = date_create($approvals_costing_dep);
                    $approvals_costing_dep = date_format($_d_approvals_costing_dep, 'd-M-Y');

                    $_d_approvals_materials_dep = date_create($approvals_materials_dep);
                    $approvals_materials_dep = date_format($_d_approvals_materials_dep, 'd-M-Y');

                    $_d_approvals_purchasing_dep = date_create($approvals_purchasing_dep);
                    $approvals_purchasing_dep = date_format($_d_approvals_purchasing_dep, 'd-M-Y');

                    $_d_approvals_engineering_dep = date_create($approvals_engineering_dep);
                    $approvals_engineering_dep = date_format($_d_approvals_engineering_dep, 'd-M-Y');
                }
                $_approvals[] = array(
                    'approvals_id' => $approvals_id,
                    'approvals_token' => $approvals_token,
                    'approvals_adate' => $approvals_adate,
                    'approvals_rdate' => $approvals_rdate,
                    'approvals_givenby' => $this->enc('denc', $approvals_givenby),
                    'approvals_ftotech' => $approvals_ftotech,
                    'approvals_remarks' => $this->enc('denc', $approvals_remarks),
                    'approvals_tmanager' => $this->enc('denc', $approvals_tmanager),
                    'approvals_rftmanger' => $approvals_rftmanger,
                    'approvals_tengineer' => $this->enc('denc', $approvals_tengineer),
                    'approvals_rftmanager' => $approvals_rftmanager,
                    'approvals_salse_dep' => $approvals_salse_dep,
                    'approvals_costing_dep' => $approvals_costing_dep,
                    'approvals_materials_dep' => $approvals_materials_dep,
                    'approvals_purchasing_dep' => $approvals_purchasing_dep,
                    'approvals_engineering_dep' => $approvals_engineering_dep,
                    'approvals_status' => $this->enc('denc', $approvals_status),
                    'approvals_projectid' => $this->enc('denc', $approvals_projectid),
                    'approvals_cdate' => $this->enc('denc', $approvals_cdate),
                    'approvals_cby' => $this->enc('denc', $approvals_cby),
                    'approvals_edate' => $this->enc('denc', $approvals_edate),
                    'approvals_eby' => $this->enc('denc', $approvals_eby),
                    'approval_type' => $approval_type,
                    'project_no' => $this->enc('denc', $project_no),
                    'project_name' => $this->enc('denc', $project_name),
                    'project_cname' => $this->enc('denc', $project_cname),
                    'project_location' => $this->enc('denc', $project_location),
                    'approval_type_id' => $approval_type_id,
                    'approval_type_name' => $this->enc('denc', $approval_type_name),
                );
            }
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }


    public function all_project_approvals_s($project_id)
    {
        $this->approvals_projectid = $this->enc('enc', $project_id);
        $this->sql = "SELECT *FROM ($this->pms_approvals 
            inner join 
            $this->pms_approval_types on 
            $this->pms_approvals.approval_type = $this->pms_approval_types.approval_type_id) 
            inner join $this->pms_project_summary 
            on $this->pms_approvals.approvals_projectid = $this->pms_project_summary.project_no 
            where 
            $this->pms_approvals.approvals_projectid = :approvals_projectid             
            order by $this->pms_approvals.approvals_id";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":approvals_projectid", $this->approvals_projectid);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $s = $this->enc('denc', $approvals_status);
            if ($s === 'x') {
                $approvals_adate = $this->enc('denc', $approvals_adate);
                $approvals_rdate = $this->enc('denc', $approvals_rdate);
                $approvals_ftotech = $this->enc('denc', $approvals_ftotech);
                $approvals_rftmanger = $this->enc('denc', $approvals_rftmanger);
                $approvals_rftmanager = $this->enc('denc', $approvals_rftmanager);
                $approvals_salse_dep = $this->enc('denc', $approvals_salse_dep);
                $approvals_costing_dep = $this->enc('denc', $approvals_costing_dep);
                $approvals_materials_dep = $this->enc('denc', $approvals_materials_dep);
                $approvals_purchasing_dep = $this->enc('denc', $approvals_purchasing_dep);
                $approvals_engineering_dep = $this->enc('denc', $approvals_engineering_dep);

                if ($this->enc('denc', $approvals_status) == 'b') {
                    $_d_approvals_adate = date_create($approvals_adate);
                    $approvals_adate = date_format($_d_approvals_adate, 'd-M-Y');

                    $_d_approvals_rdate = date_create($approvals_rdate);
                    $approvals_rdate = date_format($_d_approvals_rdate, 'd-M-Y');

                    $_d_approvals_ftotech = date_create($approvals_ftotech);
                    $approvals_ftotech = date_format($_d_approvals_ftotech, 'd-M-Y');

                    $_d_approvals_rftmanger = date_create($approvals_rftmanger);
                    $approvals_rftmanger = date_format($_d_approvals_rftmanger, 'd-M-Y');

                    $_d_approvals_rftmanager = date_create($approvals_rftmanager);
                    $approvals_rftmanager = date_format($_d_approvals_rftmanager, 'd-M-Y');

                    $_d_approvals_salse_dep = date_create($approvals_salse_dep);
                    $approvals_salse_dep = date_format($_d_approvals_salse_dep, 'd-M-Y');

                    $_d_approvals_costing_dep = date_create($approvals_costing_dep);
                    $approvals_costing_dep = date_format($_d_approvals_costing_dep, 'd-M-Y');

                    $_d_approvals_materials_dep = date_create($approvals_materials_dep);
                    $approvals_materials_dep = date_format($_d_approvals_materials_dep, 'd-M-Y');

                    $_d_approvals_purchasing_dep = date_create($approvals_purchasing_dep);
                    $approvals_purchasing_dep = date_format($_d_approvals_purchasing_dep, 'd-M-Y');

                    $_d_approvals_engineering_dep = date_create($approvals_engineering_dep);
                    $approvals_engineering_dep = date_format($_d_approvals_engineering_dep, 'd-M-Y');
                }
                $_approvals[] = array(
                    'approvals_id' => $approvals_id,
                    'approvals_token' => $approvals_token,
                    'approvals_adate' => $approvals_adate,
                    'approvals_rdate' => $approvals_rdate,
                    'approvals_givenby' => $this->enc('denc', $approvals_givenby),
                    'approvals_ftotech' => $approvals_ftotech,
                    'approvals_remarks' => $this->enc('denc', $approvals_remarks),
                    'approvals_tmanager' => $this->enc('denc', $approvals_tmanager),
                    'approvals_rftmanger' => $approvals_rftmanger,
                    'approvals_tengineer' => $this->enc('denc', $approvals_tengineer),
                    'approvals_rftmanager' => $approvals_rftmanager,
                    'approvals_salse_dep' => $approvals_salse_dep,
                    'approvals_costing_dep' => $approvals_costing_dep,
                    'approvals_materials_dep' => $approvals_materials_dep,
                    'approvals_purchasing_dep' => $approvals_purchasing_dep,
                    'approvals_engineering_dep' => $approvals_engineering_dep,
                    'approvals_status' => $this->enc('denc', $approvals_status),
                    'approvals_projectid' => $this->enc('denc', $approvals_projectid),
                    'approvals_cdate' => $this->enc('denc', $approvals_cdate),
                    'approvals_cby' => $this->enc('denc', $approvals_cby),
                    'approvals_edate' => $this->enc('denc', $approvals_edate),
                    'approvals_eby' => $this->enc('denc', $approvals_eby),
                    'approval_type' => $approval_type,
                    'project_no' => $this->enc('denc', $project_no),
                    'project_name' => $this->enc('denc', $project_name),
                    'project_cname' => $this->enc('denc', $project_cname),
                    'project_location' => $this->enc('denc', $project_location),
                    'approval_type_id' => $approval_type_id,
                    'approval_type_name' => $this->enc('denc', $approval_type_name),
                );
            }
        }

        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }


    public function project_approvals($project_id, $approvals_token)
    {
        $this->approvals_projectid = $this->enc('enc', $project_id);
        $this->approvals_token = $approvals_token;
        $this->sql = "SELECT *FROM ($this->pms_approvals 
            inner join 
            $this->pms_approval_types on 
            $this->pms_approvals.approval_type = $this->pms_approval_types.approval_type_id) 
            inner join $this->pms_project_summary 
            on $this->pms_approvals.approvals_projectid = $this->pms_project_summary.project_no 
            where 
            $this->pms_approvals.approvals_projectid = :approvals_projectid 
            and 
            $this->pms_approvals.approvals_token = :approvals_token             
            order by $this->pms_approvals.approvals_id";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":approvals_projectid", $this->approvals_projectid);
        $this->cm->bindParam(":approvals_token", $this->approvals_token);
        $this->cm->execute();
        if ($this->cm->rowCount() === 1) {

            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $approvals_adate = $this->enc('denc', $approvals_adate);
            $approvals_rdate = $this->enc('denc', $approvals_rdate);
            $approvals_ftotech = $this->enc('denc', $approvals_ftotech);
            $approvals_rftmanger = $this->enc('denc', $approvals_rftmanger);
            $approvals_rftmanager = $this->enc('denc', $approvals_rftmanager);
            $approvals_salse_dep = $this->enc('denc', $approvals_salse_dep);
            $approvals_costing_dep = $this->enc('denc', $approvals_costing_dep);
            $approvals_materials_dep = $this->enc('denc', $approvals_materials_dep);
            $approvals_purchasing_dep = $this->enc('denc', $approvals_purchasing_dep);
            $approvals_engineering_dep = $this->enc('denc', $approvals_engineering_dep);

            if ($this->enc('denc', $approvals_status) == 'b') {
                $_d_approvals_adate = date_create($approvals_adate);
                $approvals_adate = date_format($_d_approvals_adate, 'd-M-Y');

                $_d_approvals_rdate = date_create($approvals_rdate);
                $approvals_rdate = date_format($_d_approvals_rdate, 'd-M-Y');

                $_d_approvals_ftotech = date_create($approvals_ftotech);
                $approvals_ftotech = date_format($_d_approvals_ftotech, 'd-M-Y');

                $_d_approvals_rftmanger = date_create($approvals_rftmanger);
                $approvals_rftmanger = date_format($_d_approvals_rftmanger, 'd-M-Y');

                $_d_approvals_rftmanager = date_create($approvals_rftmanager);
                $approvals_rftmanager = date_format($_d_approvals_rftmanager, 'd-M-Y');

                $_d_approvals_salse_dep = date_create($approvals_salse_dep);
                $approvals_salse_dep = date_format($_d_approvals_salse_dep, 'd-M-Y');

                $_d_approvals_costing_dep = date_create($approvals_costing_dep);
                $approvals_costing_dep = date_format($_d_approvals_costing_dep, 'd-M-Y');

                $_d_approvals_materials_dep = date_create($approvals_materials_dep);
                $approvals_materials_dep = date_format($_d_approvals_materials_dep, 'd-M-Y');

                $_d_approvals_purchasing_dep = date_create($approvals_purchasing_dep);
                $approvals_purchasing_dep = date_format($_d_approvals_purchasing_dep, 'd-M-Y');

                $_d_approvals_engineering_dep = date_create($approvals_engineering_dep);
                $approvals_engineering_dep = date_format($_d_approvals_engineering_dep, 'd-M-Y');
            }
            $_approvals = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_adate' => $approvals_adate,
                'approvals_rdate' => $approvals_rdate,
                'approvals_givenby' => $this->enc('denc', $approvals_givenby),
                'approvals_ftotech' => $approvals_ftotech,
                'approvals_remarks' => $this->enc('denc', $approvals_remarks),
                'approvals_tmanager' => $this->enc('denc', $approvals_tmanager),
                'approvals_rftmanger' => $approvals_rftmanger,
                'approvals_tengineer' => $this->enc('denc', $approvals_tengineer),
                'approvals_rftmanager' => $approvals_rftmanager,
                'approvals_salse_dep' => $approvals_salse_dep,
                'approvals_costing_dep' => $approvals_costing_dep,
                'approvals_materials_dep' => $approvals_materials_dep,
                'approvals_purchasing_dep' => $approvals_purchasing_dep,
                'approvals_engineering_dep' => $approvals_engineering_dep,
                'approvals_status' => $this->enc('denc', $approvals_status),
                'approvals_projectid' => $this->enc('denc', $approvals_projectid),
                'approvals_cdate' => $this->enc('denc', $approvals_cdate),
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_edate' => $this->enc('denc', $approvals_edate),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approval_type' => $approval_type,
                'project_no' => $this->enc('denc', $project_no),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location),
                'approval_type_id' => $approval_type_id,
                'approval_type_name' => $this->enc('denc', $approval_type_name),
            );
            $this->response = array("msg" => "1", "data" => $_approvals);
        } else {
            $this->response = array("msg" => "1", "data" => "No data Found");
        }
        return json_encode($this->response);
        exit();
    }

    public function new_approvals($newapprovals)
    {
        $this->approvals_token = $this->token('25');
        $this->approvals_adate = $this->enc('enc', $newapprovals['approvals_adate']);
        $this->approvals_rdate = $this->enc('enc', $newapprovals['approvals_rdate']);
        $this->approvals_givenby = $this->enc('enc', $newapprovals['approvals_givenby']);
        $this->approvals_ftotech = $this->enc('enc', $newapprovals['approvals_ftotech']);
        $this->approvals_remarks = $this->enc('enc', $newapprovals['approvals_remarks']);
        $this->approvals_tmanager = $this->enc('enc', $newapprovals['approvals_tmanager']);
        $this->approvals_rftmanger = $this->enc('enc', $newapprovals['approvals_rftmanger']);
        $this->approvals_tengineer = $this->enc('enc', $newapprovals['approvals_tengineer']);
        $this->approvals_rftmanager = $this->enc('enc', $newapprovals['approvals_rftmanager']);
        $this->approvals_salse_dep = $this->enc('enc', $newapprovals['approvals_salse_dep']);
        $this->approvals_costing_dep = $this->enc('enc', $newapprovals['approvals_costing_dep']);
        $this->approvals_materials_dep = $this->enc('enc', $newapprovals['approvals_materials_dep']);
        $this->approvals_purchasing_dep = $this->enc('enc', $newapprovals['approvals_purchasing_dep']);
        $this->approvals_engineering_dep = $this->enc('enc', $newapprovals['approvals_engineering_dep']);
        $this->approvals_status = $this->enc('enc', $newapprovals['approvals_status']);
        $this->approvals_projectid = $this->enc('enc', $newapprovals['approvals_projectid']);
        $this->approvals_cdate = $this->enc('enc', $newapprovals['approvals_cdate']);
        $this->approvals_cby = $this->enc('enc', $newapprovals['approvals_cby']);
        $this->approvals_edate = $this->enc('enc', $newapprovals['approvals_edate']);
        $this->approvals_eby = $this->enc('enc', $newapprovals['approvals_eby']);
        $this->approval_type = $newapprovals['approval_type'];

        $this->sql = "INSERT INTO $this->pms_approvals values(
                null,
                :approvals_token,
                :approvals_adate,
                :approvals_rdate,
                :approvals_givenby,
                :approvals_ftotech,
                :approvals_remarks,
                :approvals_tmanager,
                :approvals_rftmanger,
                :approvals_tengineer,
                :approvals_rftmanager,
                :approvals_salse_dep,
                :approvals_costing_dep,
                :approvals_materials_dep,
                :approvals_purchasing_dep,
                :approvals_engineering_dep,
                :approvals_status,
                :approvals_projectid,
                :approvals_cdate,
                :approvals_cby,
                :approvals_edate,
                :approvals_eby,
                :approval_type
            )";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":approvals_token", $this->approvals_token);
        $this->cm->bindParam(":approvals_adate", $this->approvals_adate);
        $this->cm->bindParam(":approvals_rdate", $this->approvals_rdate);
        $this->cm->bindParam(":approvals_givenby", $this->approvals_givenby);
        $this->cm->bindParam(":approvals_ftotech", $this->approvals_ftotech);
        $this->cm->bindParam(":approvals_remarks", $this->approvals_remarks);
        $this->cm->bindParam(":approvals_tmanager", $this->approvals_tmanager);
        $this->cm->bindParam(":approvals_rftmanger", $this->approvals_rftmanger);
        $this->cm->bindParam(":approvals_tengineer", $this->approvals_tengineer);
        $this->cm->bindParam(":approvals_rftmanager", $this->approvals_rftmanager);
        $this->cm->bindParam(":approvals_salse_dep", $this->approvals_salse_dep);
        $this->cm->bindParam(":approvals_costing_dep", $this->approvals_costing_dep);
        $this->cm->bindParam(":approvals_materials_dep", $this->approvals_materials_dep);
        $this->cm->bindParam(":approvals_purchasing_dep", $this->approvals_purchasing_dep);
        $this->cm->bindParam(":approvals_engineering_dep", $this->approvals_engineering_dep);
        $this->cm->bindParam(":approvals_status", $this->approvals_status);
        $this->cm->bindParam(":approvals_projectid", $this->approvals_projectid);
        $this->cm->bindParam(":approvals_cdate", $this->approvals_cdate);
        $this->cm->bindParam(":approvals_cby", $this->approvals_cby);
        $this->cm->bindParam(":approvals_edate", $this->approvals_edate);
        $this->cm->bindParam(":approvals_eby", $this->approvals_eby);
        $this->cm->bindParam(":approval_type", $this->approval_type);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => $this->approvals_token);
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }
    public function update_supersheet($token)
    {
        $this->approvals_token = $token;
        $s = $this->enc('enc', 'x');
        $this->sql = "UPDATE $this->pms_approvals 
            set 
            approvals_status=:approvals_status 
            where 
            approvals_token=:approvals_token";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":approvals_status", $s);
        $this->cm->bindParam(":approvals_token", $this->approvals_token);
        $this->cm->execute();
    }
    public function update_approvals($newapprovals)
    {
        $this->approvals_token = $newapprovals['approvals_token'];
        $this->approvals_adate = $this->enc('enc', $newapprovals['approvals_adate']);
        $this->approvals_rdate = $this->enc('enc', $newapprovals['approvals_rdate']);
        $this->approvals_givenby = $this->enc('enc', $newapprovals['approvals_givenby']);
        $this->approvals_ftotech = $this->enc('enc', $newapprovals['approvals_ftotech']);
        $this->approvals_remarks = $this->enc('enc', $newapprovals['approvals_remarks']);
        $this->approvals_tmanager = $this->enc('enc', $newapprovals['approvals_tmanager']);
        $this->approvals_rftmanger = $this->enc('enc', $newapprovals['approvals_rftmanger']);
        $this->approvals_tengineer = $this->enc('enc', $newapprovals['approvals_tengineer']);
        $this->approvals_rftmanager = $this->enc('enc', $newapprovals['approvals_rftmanager']);
        $this->approvals_salse_dep = $this->enc('enc', $newapprovals['approvals_salse_dep']);
        $this->approvals_costing_dep = $this->enc('enc', $newapprovals['approvals_costing_dep']);
        $this->approvals_materials_dep = $this->enc('enc', $newapprovals['approvals_materials_dep']);
        $this->approvals_purchasing_dep = $this->enc('enc', $newapprovals['approvals_purchasing_dep']);
        $this->approvals_engineering_dep = $this->enc('enc', $newapprovals['approvals_engineering_dep']);
        $this->approvals_status = $this->enc('enc', $newapprovals['approvals_status']);
        $this->approvals_projectid = $this->enc('enc', $newapprovals['approvals_projectid']);
        $this->approvals_edate = $this->enc('enc', $newapprovals['approvals_edate']);
        $this->approvals_eby = $this->enc('enc', $newapprovals['approvals_eby']);
        $this->approval_type = $newapprovals['approval_type'];

        $this->sql = "UPDATE $this->pms_approvals set                                
                approvals_adate= '$this->approvals_adate',
                approvals_rdate='$this->approvals_rdate',
                approvals_givenby='$this->approvals_givenby',
                approvals_ftotech='$this->approvals_ftotech',
                approvals_remarks='$this->approvals_remarks',
                approvals_tmanager='$this->approvals_tmanager',
                approvals_rftmanger='$this->approvals_rftmanger',
                approvals_tengineer='$this->approvals_tengineer',
                approvals_rftmanager='$this->approvals_rftmanager',
                approvals_salse_dep='$this->approvals_salse_dep',
                approvals_costing_dep='$this->approvals_costing_dep',
                approvals_materials_dep='$this->approvals_materials_dep',
                approvals_purchasing_dep='$this->approvals_purchasing_dep',
                approvals_engineering_dep='$this->approvals_engineering_dep',
                approvals_status='$this->approvals_status',                               
                approvals_edate='$this->approvals_edate',
                approvals_eby='$this->approvals_eby',
                approval_type=$this->approval_type
                where 
                approvals_projectid='$this->approvals_projectid' and approvals_token='$this->approvals_token'";

        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => $this->approvals_token);
        } else {
            $this->response = array("msg" => "0", "data" => "DB Errors");
        }
        return json_encode($this->response);
        exit();
    }
}
