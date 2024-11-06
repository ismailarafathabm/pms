<?php
date_default_timezone_set('Asia/Riyadh');
include_once('mac.php');
class DrawingApprovals extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $rows;
    //approvals types
    private $pms_draw_approvals_types;
    private $types_id;
    private $types_name;
    //approvals
    private $pms_draw_approvals;
    private $approvals_id;
    private $approvals_token;
    private $approvals_for;
    private $approvals_draw_no;
    private $approvals_descriptions;
    private $approvals_last_status;
    private $approvals_last_revision_no;
    private $approvals_cby;
    private $approvals_eby;
    private $approvals_cdate;
    private $approvals_edate;
    private $approvals_project_code;
    private $approvals_infos_sub;
    private $approvals_infos_submitedon;
    private $approvals_infos_receivedon;
    private $approvals_infos_clienton;


    //approvals infos
    private $pms_drawing_approvals_info;
    private $approvals_info_id;
    private $approvals_info_token;
    private $approvals_info_project_id;
    private $approvals_info_drawing_no;
    private $approvals_info_drawing_token;
    private $approvals_info_reveision_no;
    private $approvals_info_sub;
    private $approvals_info_submited_on;
    private $approvals_info_received_on;
    private $approvals_info_client_on;
    private $approvals_info_code;
    private $approvals_info_last_revision;
    private $approvals_info_cby;
    private $approvals_info_eby;
    private $approvals_info_cdate;
    private $approvals_info_edate;
    private $approvals_info_remarks;
    private $response;

    function __construct($db)
    {
        $this->cn = $db;
        $this->pms_draw_approvals_types = mac::pms_draw_approvals_types;
        $this->pms_draw_approvals = mac::pms_draw_approvals;
        $this->pms_drawing_approvals_info = mac::pms_drawing_approvals_info;
        $this->response = array("msg" => "0", "data" => "-Error");
    }

    public function new_typs($typename)
    {
        $this->types_name = $this->enc('enc', $typename);
        $this->sql = "INSERT INTO $this->pms_draw_approvals_types values(
                null,
                :types_name
            )";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":types_name", $this->types_name);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "saved");
        } else {
            $this->response = array("msg" => "0", "data" => "'$typename' - Already Exists..");
        }
        return json_encode($this->response);
        exit();
    }

    public function all_type()
    {
        $this->sql = "SELECT *FROM $this->pms_draw_approvals_types";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_approvals_types = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_approvals_types[] = array(
                "types_id" => $types_id,
                "types_name" => $this->enc('denc', $types_name)
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals_types);
        return json_encode($this->response);
        exit();
    }

    public function add_new_approvals($approvalsinfo)
    {

        $this->approvals_token = $approvalsinfo['approvals_token'];
        $this->approvals_for = $approvalsinfo['approvals_for'];
        $this->approvals_draw_no = $this->enc('enc', strtolower($approvalsinfo['approvals_draw_no']));

        $this->approvals_descriptions = $this->enc('enc', $approvalsinfo['approvals_descriptions']);
        $this->approvals_last_status = $this->enc('enc', $approvalsinfo['approvals_last_status']);
        $this->approvals_last_revision_no = $this->enc('enc', $approvalsinfo['approvals_last_revision_no']);
        $this->approvals_cby = $this->enc('enc', $approvalsinfo['approvals_cby']);
        $this->approvals_eby = $this->enc('enc', $approvalsinfo['approvals_eby']);
        $this->approvals_cdate = $approvalsinfo['approvals_cdate'];
        $this->approvals_edate = $approvalsinfo['approvals_edate'];
        $this->approvals_project_code = $this->enc('enc', $approvalsinfo['project_code']);
        $this->approvals_infos_sub = $this->enc('enc', '-');
        $this->approvals_infos_submitedon = $this->enc('enc', '-');
        $this->approvals_infos_receivedon = $this->enc('enc', '-');
        $this->approvals_infos_clienton = $this->enc('enc', '-');
        $this->approvals_last_revision_code = $this->enc('enc', '-');

        $x = false;
        $this->sql = "SELECT *from $this->pms_draw_approvals where approvals_draw_no=:approvals_draw_no and approvals_project_code=:approvals_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':approvals_draw_no', $this->approvals_draw_no);
        $this->cm->bindParam(':approvals_project_code', $this->approvals_project_code);
        $this->cm->execute();
        if ($this->cm->rowCount() === 0) {
            $x = true;
        }

        if ($x === true) {
            $this->sql = "INSERT INTO $this->pms_draw_approvals values(
                null,
                :approvals_token,
                :approvals_for,
                :approvals_draw_no,
                :approvals_descriptions,
                :approvals_last_status,
                :approvals_last_revision_no,
                :approvals_cby,
                :approvals_eby,
                :approvals_cdate,
                :approvals_edate,
                :approvals_project_code,
                :approvals_infos_sub,
                :approvals_infos_submitedon,
                :approvals_infos_receivedon,
                :approvals_infos_clienton,
                :approvals_last_revision_code
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':approvals_token', $this->approvals_token);
            $this->cm->bindParam(':approvals_for', $this->approvals_for);
            $this->cm->bindParam(':approvals_draw_no', $this->approvals_draw_no);
            $this->cm->bindParam(':approvals_descriptions', $this->approvals_descriptions);
            $this->cm->bindParam(':approvals_last_status', $this->approvals_last_status);
            $this->cm->bindParam(':approvals_last_revision_no', $this->approvals_last_revision_no);
            $this->cm->bindParam(':approvals_cby', $this->approvals_cby);
            $this->cm->bindParam(':approvals_eby', $this->approvals_eby);
            $this->cm->bindParam(':approvals_cdate', $this->approvals_cdate);
            $this->cm->bindParam(':approvals_edate', $this->approvals_edate);
            $this->cm->bindParam(':approvals_project_code', $this->approvals_project_code);
            $this->cm->bindParam(':approvals_infos_sub', $this->approvals_infos_sub);
            $this->cm->bindParam(':approvals_infos_submitedon', $this->approvals_infos_submitedon);
            $this->cm->bindParam(':approvals_infos_receivedon', $this->approvals_infos_receivedon);
            $this->cm->bindParam(':approvals_infos_clienton', $this->approvals_infos_clienton);
            $this->cm->bindParam(':approvals_last_revision_code', $this->approvals_last_revision_code);
         

            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Saved");
            } else {
                $this->response = array("msg" => "0", "data" => "DB Error");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "This Drawing Number Already Exists.");
        }
        return json_encode($this->response);
        exit();
    }
    public function all_approvals($project_no)
    {
        $project_code = $this->enc('enc', $project_no);
        $this->sql = "SELECT *FROM $this->pms_draw_approvals 
        inner join 
        $this->pms_draw_approvals_types 
        on 
        $this->pms_draw_approvals_types.types_id=$this->pms_draw_approvals.approvals_for where 
        approvals_project_code = :approvals_project_code";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':approvals_project_code', $project_code);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $days = '-';
            if (date_create($this->enc('denc', $approvals_infos_submitedon)) && date_create($this->enc('denc', $approvals_infos_receivedon))) {
                $_x = date_create($this->enc('denc', $approvals_infos_submitedon));
                $_y = date_create($this->enc('denc', $approvals_infos_receivedon));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
            }

            $fs = "0";
            $fno = '../../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $status = $this->enc('enc', $approvals_last_status);
            $approvals_infos_submitedon = $this->enc('denc', $approvals_infos_submitedon);
            $approvals_infos_receivedon = $this->enc('denc', $approvals_infos_receivedon);
            $approvals_infos_clienton = $this->enc('denc', $approvals_infos_clienton);
            $dif = 0;

            if (date_create($approvals_infos_submitedon)) {
                $date1 = date_create($approvals_infos_submitedon);
                $x_approvals_infos_submitedon = date_create($approvals_infos_submitedon);
                $approvals_infos_submitedon = date_format($x_approvals_infos_submitedon, 'd-M-Y');
            }
            if (date_create($approvals_infos_receivedon)) {
                $date2 = date_create($approvals_infos_receivedon);
                $x_approvals_infos_receivedon = date_create($approvals_infos_receivedon);
                $approvals_infos_receivedon = date_format($x_approvals_infos_receivedon, 'd-M-Y');
                $date2 = date_format($x_approvals_infos_receivedon, 'd/m/Y');
            }
            if (date_create($approvals_infos_clienton)) {
                $x_approvals_infos_clienton = date_create($approvals_infos_clienton);
                $approvals_infos_clienton = date_format($x_approvals_infos_clienton, 'd-M-Y');
            }
            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $this->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $this->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $this->enc('denc', $approvals_last_status),
                'approvals_last_revision_no' => $approvals_last_revision_no,
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'approvals_project_code' => $this->enc('denc', $approvals_project_code),
                'types_id' =>  $types_id,
                'types_name' => $this->enc('denc', $types_name),
                'approvals_infos_sub' => $this->enc('denc', $approvals_infos_sub),
                'approvals_infos_submitedon' => $approvals_infos_submitedon,
                'approvals_infos_receivedon' => $approvals_infos_receivedon,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_last_revision_code' => $this->enc('denc', $approvals_last_revision_code),
                'delayclient' => $days,
                'f' => $fs
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }

    public function approval_rpt()
    {
        $this->sql = "SELECT *FROM ($this->pms_draw_approvals 
            inner join 
            $this->pms_draw_approvals_types 
            on 
            $this->pms_draw_approvals_types.types_id=$this->pms_draw_approvals.approvals_for) inner join pms_project_summary on pms_project_summary.project_no=$this->pms_draw_approvals.approvals_project_code limit 0,10";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $days = '-';
            if (date_create($this->enc('denc', $approvals_infos_submitedon)) && date_create($this->enc('denc', $approvals_infos_receivedon))) {
                $_x = date_create($this->enc('denc', $approvals_infos_submitedon));
                $_y = date_create($this->enc('denc', $approvals_infos_receivedon));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
            }

            $fs = "0";
            $fno = '../../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $status = $this->enc('enc', $approvals_last_status);
            $approvals_infos_submitedon = $this->enc('denc', $approvals_infos_submitedon);
            $approvals_infos_receivedon = $this->enc('denc', $approvals_infos_receivedon);
            $approvals_infos_clienton = $this->enc('denc', $approvals_infos_clienton);
            $dif = 0;

            if (date_create($approvals_infos_submitedon)) {
                $date1 = date_create($approvals_infos_submitedon);
                $x_approvals_infos_submitedon = date_create($approvals_infos_submitedon);
                $approvals_infos_submitedon = date_format($x_approvals_infos_submitedon, 'Y-m-d');
            }
            if (date_create($approvals_infos_receivedon)) {
                $date2 = date_create($approvals_infos_receivedon);
                $x_approvals_infos_receivedon = date_create($approvals_infos_receivedon);
                $approvals_infos_receivedon = date_format($x_approvals_infos_receivedon, 'Y-m-d');
                $date2 = date_format($x_approvals_infos_receivedon, 'd/m/Y');
            }
            if (date_create($approvals_infos_clienton)) {
                $x_approvals_infos_clienton = date_create($approvals_infos_clienton);
                $approvals_infos_clienton = date_format($x_approvals_infos_clienton, 'Y-m-d');
            } else {
                $x_approvals_infos_clienton = date('Y-m-d');
                $approvals_infos_clienton = $x_approvals_infos_clienton;
            }



            if ($this->enc('denc', $approvals_last_status) === 'U') {
                $ustatus = 'U';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) === 'A') {
                $astatus = 'A';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) === 'B') {
                $bstatus = 'B';
                $ustatus = '';
                $astatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) === 'C') {
                $cstatus = 'C';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) === 'D') {
                $dstatus = 'D';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
            }
            $project_infos = $this->enc('denc', $project_name) . '(' . $this->enc('denc', $approvals_project_code) . ')';
            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $this->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $this->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $this->enc('denc', $approvals_last_status),
                'approvals_last_statusu' => $ustatus,
                'approvals_last_statusa' => $astatus,
                'approvals_last_statusb' => $bstatus,
                'approvals_last_statusc' => $cstatus,
                'approvals_last_statusd' => $dstatus,
                'approvals_last_revision_no' => $approvals_last_revision_no,
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'approvals_project_code' => $this->enc('denc', $approvals_project_code),
                'types_id' =>  $types_id,
                'types_name' => $this->enc('denc', $types_name),
                'approvals_infos_sub' => $this->enc('denc', $approvals_infos_sub),
                'approvals_infos_submitedon' => $approvals_infos_submitedon,
                'approvals_infos_receivedon' => $approvals_infos_receivedon,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_last_revision_code' => $this->enc('denc', $approvals_last_revision_code),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location),
                'delayclient' => $days,
                'f' => $fs,

                'project_infos' => $project_infos
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }

    public function DrawingApprovals_rpt_new()
    {
        $this->sql = "SELECT *FROM ($this->pms_draw_approvals 
            inner join 
            $this->pms_draw_approvals_types 
            on 
            $this->pms_draw_approvals_types.types_id=$this->pms_draw_approvals.approvals_for) inner join pms_project_summary on pms_project_summary.project_no=$this->pms_draw_approvals.approvals_project_code";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $days = '-';
            if (date_create($this->enc('denc', $approvals_infos_submitedon)) && date_create($this->enc('denc', $approvals_infos_receivedon))) {
                $_x = date_create($this->enc('denc', $approvals_infos_submitedon));
                $_y = date_create($this->enc('denc', $approvals_infos_receivedon));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
                $daysn = $diff->format("%a");
            }

            $fs = "0";
            $fno = '../../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $status = $this->enc('enc', $approvals_last_status);

            $approvals_infos_submitedon = $this->enc('denc', $approvals_infos_submitedon);
            $approvals_infos_receivedon = $this->enc('denc', $approvals_infos_receivedon);
            $approvals_infos_clienton = $this->enc('denc', $approvals_infos_clienton);

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
            $project_infos = $this->enc('denc', $project_name) . '[' . $this->enc('denc', $approvals_project_code) . ']';
            // if()
            // $c_y = $approvals_infos_clienton;
            // // $delayclients = '0';
            // // $delayclient = '0';            
            // $_y = date_create($c_y);

            // $diffx =  date_diff($_y, $_x);
            // $delayclients = $diffx->format("%a days");
            // $delayclientn = $diffx->format("%a");

            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $this->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $this->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $this->enc('denc', $approvals_last_status),
                'approvals_last_revision_no' => $approvals_last_revision_no,
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'approvals_project_code' => $this->enc('denc', $approvals_project_code),
                'types_id' =>  $types_id,
                'types_name' => $this->enc('denc', $types_name),
                'approvals_infos_sub' => $this->enc('denc', $approvals_infos_sub),
                'approvals_infos_submitedon' => $approvals_infos_submitedon,
                'approvals_infos_receivedon' => $approvals_infos_receivedon,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_last_revision_code' => $this->enc('denc', $approvals_last_revision_code),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location),
                'f' => $fs,
                'daysn' => $daysn,
                'delayclient' => $days,
                'project_infos' => $project_infos,
                'approvals_infos_submitedon_d' => $approvals_infos_submitedon_d,
                'approvals_infos_receivedon_d' => $approvals_infos_receivedon_d,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_infos_clienton_d' => $approvals_infos_clienton_d,
                // 'delayclients' => $delayclients,
                // 'delayclientn' => $delayclientn
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }


    public function get_drawing_revisions($projectno, $drawingno)
    {
        $this->approvals_info_project_id = $this->enc('enc', $projectno);
        $this->approvals_info_drawing_no =  $drawingno;
        $this->sql = "SELECT *from $this->pms_drawing_approvals_info 
                    where 
                    approvals_info_project_id=:approvals_info_project_id  
                    and 
                    approvals_info_drawing_token=:approvals_info_drawing_no
                    ";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':approvals_info_project_id', $this->approvals_info_project_id);
        $this->cm->bindParam(':approvals_info_drawing_no', $this->approvals_info_drawing_no);
        $this->cm->execute();
        $_revison = [];
        while ($row = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $days = '-';
            if (date_create($this->enc('denc', $approvals_info_submited_on)) && date_create($this->enc('denc', $approvals_info_received_on))) {
                $_x = date_create($this->enc('denc', $approvals_info_submited_on));
                $_y = date_create($this->enc('denc', $approvals_info_received_on));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
            }

            $fs = "0";
            $fno = '../../assets/drawingapprovals/' . $approvals_info_token . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }
            $_revison[] = array(
                'approvals_info_id' => $approvals_info_id,
                'approvals_info_token' => $approvals_info_token,
                'approvals_info_project_id' => $this->enc('denc', $approvals_info_project_id),
                'approvals_info_drawing_no' => $this->enc('denc', $approvals_info_drawing_no),
                'approvals_info_drawing_token' => $approvals_info_drawing_token,
                'approvals_info_reveision_no' => $this->enc('denc', $approvals_info_reveision_no),
                'approvals_info_sub' => $this->enc('denc', $approvals_info_sub),
                'approvals_info_submited_on' => $this->enc('denc', $approvals_info_submited_on),
                'approvals_info_received_on' => $this->enc('denc', $approvals_info_received_on),
                'approvals_info_client_on' => $this->enc('denc', $approvals_info_client_on),
                'approvals_info_code' => $this->enc('denc', $approvals_info_code),
                'approvals_info_last_revision' => $this->enc('denc', $approvals_info_last_revision),
                'approvals_info_cby' => $this->enc('denc', $approvals_info_cby),
                'approvals_info_eby' => $this->enc('denc', $approvals_info_eby),
                'approvals_info_cdate' => $approvals_info_cdate,
                'approvals_info_edate' => $approvals_info_edate,
                'approvals_info_remarks' => $this->enc('denc', $approvals_info_remarks),
                'delay' => $days,
                'files' => $fs
            );
        }

        $this->response = array("msg" => "1", "data" => $_revison);
        return json_encode($this->response);
        exit();
    }

    public function all_approvals_revision($project_no)
    {
        $this->project_code = $this->enc('enc', $project_no);
        $this->sql = "SELECT *FROM $this->pms_draw_approvals inner join $this->pms_draw_approvals_types on $this->pms_draw_approvals.approvals_for=$this->pms_draw_approvals_types.types_id  WHERE project_code=:project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':project_code', $this->project_code);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $sql = "SELECT *from $this->pms_drawing_approvals_info 
                    where 
                    approvals_info_project_id=:approvals_info_project_id  
                    and 
                    approvals_info_drawing_no=:approvals_info_drawing_no
                    ";
            $cm = $this->cn->prepare($sql);
            $cm->bindParam(':approvals_info_project_id', $project_code);
            $cm->bindParam(':approvals_info_drawing_no', $approvals_draw_no);
            $cm->execute();
            $_revison = [];
            while ($row = $cm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $_revison[] = array(
                    'approvals_info_id' => $approvals_info_id,
                    'approvals_info_token' => $approvals_info_token,
                    'approvals_info_project_id' => $this->enc('denc', $approvals_info_project_id),
                    'approvals_info_drawing_no' => $this->enc('denc', $approvals_info_drawing_no),
                    'approvals_info_drawing_token' => $approvals_info_drawing_token,
                    'approvals_info_reveision_no' => $this->enc('denc', $approvals_info_reveision_no),
                    'approvals_info_sub' => $this->enc('denc', $approvals_info_sub),
                    'approvals_info_submited_on' => $this->enc('denc', $approvals_info_submited_on),
                    'approvals_info_received_on' => $this->enc('denc', $approvals_info_received_on),
                    'approvals_info_client_on' => $this->enc('denc', $approvals_info_client_on),
                    'approvals_info_code' => $this->enc('denc', $approvals_info_code),
                    'approvals_info_last_revision' => $this->enc('denc', $approvals_info_last_revision),
                    'approvals_info_cby' => $this->enc('denc', $approvals_info_cby),
                    'approvals_info_eby' => $this->enc('denc', $approvals_info_eby),
                    'approvals_info_cdate' => $approvals_info_cdate,
                    'approvals_info_edate' => $approvals_info_edate,
                    'approvals_info_remarks' => $this->enc('denc', $approvals_info_remarks)
                );
            }
            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $this->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $this->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $this->enc('denc', $approvals_last_status),
                'approvals_last_revision_no' => $this->enc('denc', $approvals_last_revision_no),
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'project_code' => $this->enc('denc', $project_code),
                'types_id' =>  $types_id,
                'types_name' => $this->enc('denc', $types_name),
                'revisions' => $_revison
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }

    public function new_approvals_info($approvalsInfos)
    {
        $this->approvals_info_token  = $approvalsInfos['approvals_info_token'];
        $this->approvals_info_project_id  = $this->enc('enc', $approvalsInfos['approvals_info_project_id']);
        $this->approvals_info_drawing_no  = $this->enc('enc', $approvalsInfos['approvals_info_drawing_no']);
        $this->approvals_info_drawing_token  = $approvalsInfos['approvals_info_drawing_token'];
        $this->approvals_info_reveision_no  = $this->enc('enc', $approvalsInfos['approvals_info_reveision_no']);
        $this->approvals_info_sub = $this->enc('enc', $approvalsInfos['approvals_info_sub']);
        $this->approvals_info_submited_on  = $this->enc('enc', $approvalsInfos['approvals_info_submited_on']);
        $this->approvals_info_received_on  = $this->enc('enc', $approvalsInfos['approvals_info_received_on']);
        $this->approvals_info_client_on  = $this->enc('enc', $approvalsInfos['approvals_info_client_on']);
        $this->approvals_info_code  = $this->enc('enc', $approvalsInfos['approvals_info_code']);
        $this->approvals_info_last_revision  = $this->enc('enc', $approvalsInfos['approvals_info_last_revision']);
        $this->approvals_info_cby  = $this->enc('enc', $approvalsInfos['approvals_info_cby']);
        $this->approvals_info_eby  = $this->enc('enc', $approvalsInfos['approvals_info_eby']);
        $this->approvals_info_cdate  = $approvalsInfos['approvals_info_cdate'];
        $this->approvals_info_edate  = $approvalsInfos['approvals_info_edate'];
        $this->approvals_info_remarks  = $this->enc('enc', $approvalsInfos['approvals_info_remarks']);

        $s = false;
        $this->sql = "SELECT *FROM $this->pms_drawing_approvals_info 
                    where 
                    approvals_info_project_id=:approvals_info_project_id 
                    and 
                    approvals_info_drawing_no=:approvals_info_drawing_no 
                    and 
                    approvals_info_reveision_no=:approvals_info_reveision_no";
        // echo $approvalsInfos['approvals_info_reveision_no'];
        // echo "SELECT *FROM $this->pms_drawing_approvals_info 
        // where 
        // approvals_info_project_id='$this->approvals_info_project_id' 
        // and 
        // approvals_info_drawing_no='$this->approvals_info_drawing_no' 
        // and 
        // approvals_info_reveision_no='$this->approvals_info_reveision_no'";

        
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':approvals_info_project_id', $this->approvals_info_project_id);
        $this->cm->bindParam(':approvals_info_drawing_no', $this->approvals_info_drawing_no);
        $this->cm->bindParam(':approvals_info_reveision_no', $this->approvals_info_reveision_no);
        $this->cm->execute();
        if ($this->cm->rowCount() === 0) {
            $s = true;
        }
        if ($s === true) {
            $this->sql = "INSERT INTO $this->pms_drawing_approvals_info values(
                null,
                :approvals_info_token,
                :approvals_info_project_id,
                :approvals_info_drawing_no,
                :approvals_info_drawing_token,
                :approvals_info_reveision_no,
                :approvals_info_sub,
                :approvals_info_submited_on,
                :approvals_info_received_on,
                :approvals_info_client_on,
                :approvals_info_code,
                :approvals_info_last_revision,
                :approvals_info_cby,
                :approvals_info_eby,
                :approvals_info_cdate,
                :approvals_info_edate,
                :approvals_info_remarks
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':approvals_info_token', $this->approvals_info_token);
            $this->cm->bindParam(':approvals_info_project_id', $this->approvals_info_project_id);
            $this->cm->bindParam(':approvals_info_drawing_no', $this->approvals_info_drawing_no);
            $this->cm->bindParam(':approvals_info_drawing_token', $this->approvals_info_drawing_token);
            $this->cm->bindParam(':approvals_info_reveision_no', $this->approvals_info_reveision_no);
            $this->cm->bindParam(':approvals_info_sub', $this->approvals_info_sub);
            $this->cm->bindParam(':approvals_info_submited_on', $this->approvals_info_submited_on);
            $this->cm->bindParam(':approvals_info_received_on', $this->approvals_info_received_on);
            $this->cm->bindParam(':approvals_info_client_on', $this->approvals_info_client_on);
            $this->cm->bindParam(':approvals_info_code', $this->approvals_info_code);
            $this->cm->bindParam(':approvals_info_last_revision', $this->approvals_info_last_revision);
            $this->cm->bindParam(':approvals_info_cby', $this->approvals_info_cby);
            $this->cm->bindParam(':approvals_info_eby', $this->approvals_info_eby);
            $this->cm->bindParam(':approvals_info_cdate', $this->approvals_info_cdate);
            $this->cm->bindParam(':approvals_info_edate', $this->approvals_info_edate);
            $this->cm->bindParam(':approvals_info_remarks', $this->approvals_info_remarks);

            if ($this->cm->execute()) {

                $updateinfo = array(
                    ":approvals_last_revision_no" => $this->approvals_info_token,
                    ":approvals_infos_sub" => $this->approvals_info_sub,
                    ":approvals_infos_submitedon" => $this->approvals_info_submited_on,
                    ":approvals_infos_receivedon" => $this->approvals_info_received_on,
                    ":approvals_infos_clienton" => $this->approvals_info_client_on,
                    ":approvals_last_status" => $this->approvals_info_code,
                    ":approvals_token" => $this->approvals_info_drawing_token,
                    ":approvals_draw_no" => $this->approvals_info_drawing_no,
                    ":project_code" => $this->approvals_info_project_id,
                    ':approvals_last_revision_code' => $this->approvals_info_reveision_no

                );
                $this->update_current_revision($updateinfo);
                $this->response = array("msg" => "1", "data" => "saved");
            } else {

                $this->response = array("msg" => "0", "data" => "DB _Error");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "This Reveision Number Already Exists");
        }
        return json_encode($this->response);
        exit();
    }

    private function update_current_revision($updateinfo)
    {
        $approvals_last_revision_no = $updateinfo[':approvals_last_revision_no'];
        $approvals_infos_sub = $updateinfo[':approvals_infos_sub'];
        $approvals_infos_submitedon = $updateinfo[':approvals_infos_submitedon'];
        $approvals_infos_receivedon = $updateinfo[':approvals_infos_receivedon'];
        $approvals_infos_clienton = $updateinfo[':approvals_infos_clienton'];
        $approvals_last_status = $updateinfo[':approvals_last_status'];
        $approvals_token = $updateinfo[':approvals_token'];
        $approvals_draw_no = $updateinfo[':approvals_draw_no'];
        $project_code = $updateinfo[':project_code'];
        $approvals_last_revision_code = $updateinfo[':approvals_last_revision_code'];

        $this->sql = "UPDATE $this->pms_draw_approvals 
                set 
                approvals_last_revision_no='$approvals_last_revision_no',                
                approvals_infos_sub='$approvals_infos_sub',
                approvals_infos_submitedon='$approvals_infos_submitedon',
                approvals_infos_receivedon='$approvals_infos_receivedon',
                approvals_infos_clienton='$approvals_infos_clienton',
                approvals_last_status='$approvals_last_status',
                approvals_last_revision_code = '$approvals_last_revision_code'
                where approvals_token='$approvals_token' and approvals_draw_no='$approvals_draw_no' and approvals_project_code='$project_code'";


        $this->cm = $this->cn->prepare($this->sql);

        $this->cm->execute();
    }



    public function update_drawing($updateinfo, $updatedrawinginfo)
    {
        $approvals_for = $updateinfo['approvals_for'];
        $approvals_draw_no = $updateinfo['approvals_draw_no'];
        $approvals_descriptions = $updateinfo['approvals_descriptions'];
        $approvals_eby = $updateinfo['approvals_eby'];
        $approvals_edate = $updateinfo['approvals_edate'];
        $approvals_token = $updateinfo['approvals_token'];
        $approvals_project_code = $updateinfo['project_code'];

        $approvals_info_drawing_no = $updatedrawinginfo['approvals_info_drawing_no'];
        $approvals_info_drawing_token = $updatedrawinginfo['approvals_info_drawing_token'];
        $approvals_info_project_id = $updatedrawinginfo['approvals_info_project_id'];

        $this->sql = "UPDATE $this->pms_draw_approvals set 
        approvals_for=$approvals_for,
        approvals_draw_no='$approvals_draw_no',
        approvals_descriptions='$approvals_descriptions',
        approvals_eby='$approvals_eby',
        approvals_edate='$approvals_edate'  
        where approvals_token='$approvals_token' 
        and 
        approvals_project_code='$approvals_project_code'";
        $this->cm = $this->cn->prepare($this->sql);

        if ($this->cm->execute()) {
            $sql = "UPDATE $this->pms_drawing_approvals_info set approvals_info_drawing_no='$approvals_info_drawing_no' where approvals_info_drawing_token='$approvals_info_drawing_token' and approvals_info_project_id='$approvals_info_project_id'";
            $cm = $this->cn->prepare($sql);
            $cm->execute();
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function update_revision_info($revisioninfos)
    {

        $this->sql = "UPDATE $this->pms_drawing_approvals_info set 
                            approvals_info_reveision_no=:approvals_info_reveision_no,
                            approvals_info_sub=:approvals_info_sub,
                            approvals_info_submited_on=:approvals_info_submited_on,
                            approvals_info_received_on=:approvals_info_received_on,
                            approvals_info_client_on=:approvals_info_client_on,
                            approvals_info_code=:approvals_info_code,
                            approvals_info_eby=:approvals_info_eby,
                            approvals_info_edate=:approvals_info_edate,
                            approvals_info_remarks=:approvals_info_remarks 
                            where 
                            approvals_info_token=:approvals_info_token 
                            and 
                            approvals_info_project_id=:approvals_info_project_id 
                            and 
                            approvals_info_drawing_token=:approvals_info_drawing_token";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($revisioninfos)) {
            $sql = "UPDATE $this->pms_draw_approvals 
            set 
            approvals_last_status=:approvals_last_status,
            approvals_infos_sub=:approvals_infos_sub,
            approvals_infos_submitedon=:approvals_infos_submitedon,
            approvals_infos_receivedon=:approvals_infos_receivedon,
            approvals_infos_clienton=:approvals_infos_clienton 
            where 
            approvals_token=:approvals_token 
            and 
            approvals_project_code=:approvals_project_code 
            and 
            approvals_last_revision_no=:approvals_last_revision_no";
            $approvals_last_status = $revisioninfos[':approvals_info_code'];
            $approvals_infos_sub = $revisioninfos[':approvals_info_sub'];
            $approvals_infos_submitedon = $revisioninfos[':approvals_info_submited_on'];
            $approvals_infos_receivedon = $revisioninfos[':approvals_info_received_on'];
            $approvals_infos_clienton = $revisioninfos[':approvals_info_client_on'];
            $approvals_token = $revisioninfos[':approvals_info_drawing_token'];
            $approvals_project_code = $revisioninfos[':approvals_info_project_id'];
            $approvals_last_revision_no = $revisioninfos[':approvals_info_token'];
            $this->response = array("msg" => "1", "data" => "Updated");
            $cm = $this->cn->prepare($sql);
            $cm->bindParam(":approvals_last_status", $approvals_last_status);
            $cm->bindParam(":approvals_infos_sub", $approvals_infos_sub);
            $cm->bindParam(":approvals_infos_submitedon", $approvals_infos_submitedon);
            $cm->bindParam(":approvals_infos_receivedon", $approvals_infos_receivedon);
            $cm->bindParam(":approvals_infos_clienton", $approvals_infos_clienton);
            $cm->bindParam(":approvals_token", $approvals_token);
            $cm->bindParam(":approvals_project_code", $approvals_project_code);
            $cm->bindParam(":approvals_last_revision_no", $approvals_last_revision_no);
            $cm->execute();
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function Rpt_New()
    {
        $this->sql = "SELECT *FROM pms_project_summary";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();

        $_rpts = [];

        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no'";
            $cm = $this->cn->prepare($sql);
            $cm->execute();
            $cnt_approvals =  0;
            $cnt_approvals = $cm->rowCount();
            if ($cnt_approvals != 0) {

                $cnt_revision = 0;

                $cnt_u = 0;
                $cnt_a = 0;
                $cnt_b = 0;
                $cnt_c = 0;
                $cnt_h = 0;
                $cnt_f = 0;
                $cnt_x = 0;



                $code_u = $this->enc('enc', "U");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_u'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_u = $cm->rowCount();

                $code_a = $this->enc('enc', "A");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_a'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_a = $cm->rowCount();

                $code_b = $this->enc('enc', "B");
                $code_u = $this->enc('enc', "U");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_b'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_b = $cm->rowCount();

                $code_c = $this->enc('enc', "C");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_c'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_c = $cm->rowCount();

                $code_h = $this->enc('enc', "H");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_h'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_h = $cm->rowCount();

                $code_x = $this->enc('enc', "X");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_x'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_x = $cm->rowCount();

                $code_f = $this->enc('enc', "F");
                $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code='$project_no' and approvals_last_status='$code_f'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_x = $cm->rowCount();
                $pr = 0;
                $compleated = (int)$cnt_a + (int)$cnt_b;
                // echo "Complete". $compleated; 
                // echo "</br>";
                $balance = (int)$cnt_approvals - (int) $compleated;
                // echo "Balance" . $balance;
                // echo "</br>";
                $c1 = (int) $balance * 100;
                $c2 = (int)$c1 / $cnt_approvals;
                $pr = 100 - (int)$c2;
                // echo "Presentage" . $pr;
                // echo "</br>";
                //$pr = ((((int)$cnt_approvals - (int)$compleated)*100)/ (int)$cnt_approvals)-100;



                $sql = "SELECT *FROM pms_drawing_approvals_info where approvals_info_project_id='$project_no'";
                $cm = $this->cn->prepare($sql);
                $cm->execute();
                $cnt_revision = $cm->rowCount();

                $projectsort = $this->enc('denc', $project_name) . "[" . $this->enc('denc', $project_no) . "]";
                $_rpts[] = array(
                    "projectsort" => $projectsort,
                    "projectx" =>  $project_no,
                    "project" => $this->enc('denc', $project_no),
                    "projectname" => $this->enc('denc', $project_name),
                    "cnt_approvals" => $cnt_approvals,
                    "cnt_revision" => $cnt_revision,
                    "cnt_u" => $cnt_u,
                    "cnt_a" => $cnt_a,
                    "cnt_b" => $cnt_b,
                    "cnt_c" => $cnt_c,
                    "cnt_h" => $cnt_h,
                    "cnt_x" => $cnt_x,
                    "cnt_f" => $cnt_f,
                    "compleated" => $compleated,
                    "pr" =>  $pr
                );
            }
        }
        $this->response = array(
            "msg" => "1",
            "data" => $_rpts
        );
        return json_encode($this->response);
        exit();
    }


    public function approval_rptn($ofs, $limst)
    {
        $this->sql = "SELECT *FROM ($this->pms_draw_approvals 
            inner join 
            $this->pms_draw_approvals_types 
            on 
            $this->pms_draw_approvals_types.types_id=$this->pms_draw_approvals.approvals_for) inner join pms_project_summary on pms_project_summary.project_no=$this->pms_draw_approvals.approvals_project_code LIMIT $ofs,$limst";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_approvals = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $days = '-';
            if (date_create($this->enc('denc', $approvals_infos_submitedon)) && date_create($this->enc('denc', $approvals_infos_receivedon))) {
                $_x = date_create($this->enc('denc', $approvals_infos_submitedon));
                $_y = date_create($this->enc('denc', $approvals_infos_receivedon));

                $diff =  date_diff($_y, $_x);
                $days = $diff->format("%a days");
            }

            $fs = "0";
            $fno = '../../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $status = $this->enc('enc', $approvals_last_status);
            $approvals_infos_submitedon = $this->enc('denc', $approvals_infos_submitedon);
            $approvals_infos_receivedon = $this->enc('denc', $approvals_infos_receivedon);
            $approvals_infos_clienton = $this->enc('denc', $approvals_infos_clienton);
            $dif = 0;

            if (date_create($approvals_infos_submitedon)) {
                $date1 = date_create($approvals_infos_submitedon);
                $x_approvals_infos_submitedon = date_create($approvals_infos_submitedon);
                $approvals_infos_submitedon = date_format($x_approvals_infos_submitedon, 'Y-m-d');
            }
            if (date_create($approvals_infos_receivedon)) {
                $date2 = date_create($approvals_infos_receivedon);
                $x_approvals_infos_receivedon = date_create($approvals_infos_receivedon);
                $approvals_infos_receivedon = date_format($x_approvals_infos_receivedon, 'Y-m-d');
                $date2 = date_format($x_approvals_infos_receivedon, 'd/m/Y');
            }
            if (date_create($approvals_infos_clienton)) {
                $x_approvals_infos_clienton = date_create($approvals_infos_clienton);
                $approvals_infos_clienton = date_format($x_approvals_infos_clienton, 'Y-m-d');
            } else {
                $x_approvals_infos_clienton = date('Y-m-d');
                $approvals_infos_clienton = $x_approvals_infos_clienton;
            }
            $src_approvals_info_project_id =    $approvals_project_code;
            $src_approvals_info_drawing_no =  $approvals_token;
            $ustatus = 'U';
            if ($this->enc('denc', $approvals_last_status) == 'U') {
                $ustatus = 'U';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) == 'A') {
                $astatus = 'A';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) == 'B') {
                $bstatus = 'B';
                $ustatus = '';
                $astatus = '';
                $cstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) == 'C') {
                $cstatus = 'C';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $dstatus = '';
            }
            if ($this->enc('denc', $approvals_last_status) == 'D') {
                $dstatus = 'D';
                $ustatus = '';
                $astatus = '';
                $bstatus = '';
                $cstatus = '';
            }
            $project_infos = $this->enc('denc', $project_name) . '(' . $this->enc('denc', $approvals_project_code) . ')';
            $_approvals[] = array(
                'approvals_id' => $approvals_id,
                'approvals_token' => $approvals_token,
                'approvals_for' => $approvals_for,
                'approvals_draw_no' => $this->enc('denc', $approvals_draw_no),
                'approvals_descriptions' => $this->enc('denc', $approvals_descriptions),
                'approvals_last_status' => $this->enc('denc', $approvals_last_status),
                'approvals_last_statusu' => $ustatus,
                'approvals_last_statusa' => $astatus,
                'approvals_last_statusb' => $bstatus,
                'approvals_last_statusc' => $cstatus,
                'approvals_last_statusd' => $dstatus,
                'approvals_last_revision_no' => $approvals_last_revision_no,
                'approvals_cby' => $this->enc('denc', $approvals_cby),
                'approvals_eby' => $this->enc('denc', $approvals_eby),
                'approvals_cdate' => $approvals_cdate,
                'approvals_edate' => $approvals_edate,
                'approvals_project_code' => $this->enc('denc', $approvals_project_code),
                'types_id' =>  $types_id,
                'types_name' => $this->enc('denc', $types_name),
                'approvals_infos_sub' => $this->enc('denc', $approvals_infos_sub),
                'approvals_infos_submitedon' => $approvals_infos_submitedon,
                'approvals_infos_receivedon' => $approvals_infos_receivedon,
                'approvals_infos_clienton' => $approvals_infos_clienton,
                'approvals_last_revision_code' => $this->enc('denc', $approvals_last_revision_code),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location),
                'delayclient' => $days,
                'f' => $fs,
                'project_infos' => $project_infos
            );
        }
        $this->response = array("msg" => "1", "data" => $_approvals);
        return json_encode($this->response);
        exit();
    }

    public function GetTotalApprovals()
    {
        $this->sql = "SELECT *FROM $this->pms_draw_approvals";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $cnt = $this->cm->rowCount();
        $this->response = array(
            'msg' => '1',
            'data' => $cnt
        );
        return json_encode($this->response);
        exit();
    }
}

// include_once('../connection/connection.php');
// $connection = new connection();
// $cn = $connection->connect();

// $rpts = new DrawingApprovals($cn);
// echo $rpts->Rpt_New();
