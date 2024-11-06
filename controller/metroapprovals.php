<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once 'mac.php';

    class MetroApprovals extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $response = array("msg" => "0" , "data" => "empty");

        function __construct($db)
        {
            $this->cn = $db;
        }

        private function getmetro(){
            $pjtype = $this->enc("enc",'metro project');
            $pjlist = [];
            $this->sql = "SELECT *FROM pms_project_summary where project_type='$pjtype'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $pjinfos = [];
            $pjnos = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);                
                $pjinfos[] = array(
                    "project_id" => $project_id,
                    "project_no_enc" => $project_no,                    
                    "project_no" => $this->enc('denc', $project_no),
                    "project_name" => $this->enc('denc', $project_name),
                );
                $pjnos[] = $project_no;
            }
            unset($rows,$this->sql,$this->cm);
            $infos = array(
                "pjlist" => $pjinfos,
                "pjnos" => $pjnos
            );
            return $infos;
        }

        public function GetMetroProject(){
            $metroprojects = $this->getmetro();
            $this->response = array(
                "msg" => "1",
                "data" => $metroprojects['pjlist'],
            );

            return json_encode($this->response);
            exit;
        }

        private function metroTechnicalApprovals($pjlist){
            $mstring = implode("','",$pjlist);
            $this->sql = "SELECT *FROM (pms_approvals as app inner join pms_approval_types as appt on app.approval_type=appt.approval_type_id) inner join pms_project_summary as pj on app.approvals_projectid=pj.project_no where app.approvals_projectid in ('$mstring')";
            // echo $this->sql;
            // break;
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
            unset($rows,$this->cm,$this->sql);
            return $_approvals;
            exit;
            //echo $this->sql;
            
        }

        public function AllMetroTechnicalApprovals(){
            $metroprojects = $this->getmetro();
            $mtrop = $metroprojects['pjnos'];
            $approvals = $this->metroTechnicalApprovals($mtrop);
            $this->response = array(
                "msg" => "1",
                "data" => $approvals
            );
            return json_encode($this->response);
            exit;
        }

        private function getallmetrodrawingapprovals($pjlist){
            $mstring = implode("','",$pjlist);
            $this->sql = "SELECT *FROM (pms_draw_approvals as da inner join pms_draw_approvals_types as dat on da.approvals_for=dat.types_id) inner join pms_project_summary as pj on da.approvals_project_code=pj.project_no where da.approvals_project_code in ('". $mstring ."')";
            //echo $this->sql;
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_approvals = [];
            while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
                extract($rows);
                $days = '-';
                if (date_create($this->enc('denc', $approvals_infos_submitedon)) && date_create($this->enc('denc', $approvals_infos_receivedon))) {
                    $_x = date_create($this->enc('denc', $approvals_infos_submitedon));
                    $_y = date_create($this->enc('denc', $approvals_infos_receivedon));
    
                    $diff =  date_diff($_y, $_x);
                    $days = $diff->format("%a days");
                }
    
                $fs = "0";
                
                $fno = '../assets/drawingapprovals/' . $approvals_last_revision_no . ".pdf";
    
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
    
    
    
                $project_infos = $this->enc('denc', $project_name) . '(' . $this->enc('denc', $approvals_project_code) . ')';
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
                    'delayclient' => $days,
                    'f' => $fs,
                    'approvals_infos_submitedon_d' => $approvals_infos_submitedon_d,
                    'approvals_infos_receivedon_d' => $approvals_infos_receivedon_d,                
                    'approvals_infos_clienton_d' => $approvals_infos_clienton_d,
                     'project_infos' => $project_infos
    
                );
            }
            unset($this->cm,$this->sql,$rows);
            return  $_approvals;            
        }

        public function MetroDrawingApprovals()  {
            $metroprojects = $this->getmetro();
            $mtrop = $metroprojects['pjnos'];
            $approvals = $this->getallmetrodrawingapprovals($mtrop);
            $this->response = array(
                "msg" => "1",
                "data" => $approvals
            );
            return json_encode($this->response);
            exit;
        }
    }
?>