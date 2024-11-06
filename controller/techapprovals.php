<?php 
    require_once 'mac.php';
    class TechApprovals extends mac{
        private $cn;
        private $sql;
        private $cm;
        private $response;

        function __construct($db){        
            $this->cn = $db;
            $this->response = array("msg" => "0", "data" => "Empty Error");
        }
        function __destruct(){        
            unset($this->cn);
        }
        private function pms_tech_submital($rows){            
            extract($rows);
            $cols = [];
            $cols['techsub_id'] = $techsub_id;
            $cols['techsub_project'] = $techsub_project;
            $cols['techsub_number'] = $techsub_number;
            $cols['techsub_rvno'] = $techsub_rvno;

            $cols['techsub_date'] = $techsub_date;            
            $cols['techsub_date_d'] = date_format(date_create($techsub_date),'d-M-Y');
            $cols['techsub_date_n'] = date_format(date_create($techsub_date),'d-m-Y');
            $cols['techsub_date_p'] = date_format(date_create($techsub_date),'d-m-y');

            $cols['techsub_purpose'] = $techsub_purpose;
            $cols['techsub_remarks'] = $techsub_remarks;
            $cols['techsub_submittedby'] = $techsub_submittedby;

            $cols['techsub_subdate'] = $techsub_subdate;
            $cols['techsub_subdate_d'] = date_format(date_create($techsub_subdate),'d-M-Y');
            $cols['techsub_subdate_n'] = date_format(date_create($techsub_subdate),'d-m-Y');
            $cols['techsub_subdate_p'] = date_format(date_create($techsub_subdate),'d-m-y');

            $cols['techsub_status'] = $techsub_status;

            $cols['techsub_statusdate'] = $techsub_statusdate;
            $cols['techsub_statusdate_d'] = date_format(date_create($techsub_statusdate),'d-M-Y');
            $cols['techsub_statusdate_n'] = date_format(date_create($techsub_statusdate),'d-m-Y');
            $cols['techsub_statusdate_p'] = date_format(date_create($techsub_statusdate),'d-m-y');

            $cols['techsub_remarksdt'] = $techsub_remarksdt;
            $cols['techsub_description'] = $techsub_description;
            $cols['techsub_spctype'] = $techsub_spctype;
            $cols['techsub_qty'] = $techsub_qty;
            $cols['techsub_cby'] = $techsub_cby;
            $cols['techsub_eby'] = $techsub_eby;
            $cols['techsub_cdate'] = $techsub_cdate;
            $cols['techsub_edate'] = $techsub_edate;            
            $cols['techsub_extra'] = $techsub_extra;
            return $cols;
        }

        private function pms_tech_submital_list($rows){
            extract($rows);
            $cols = [];
            $cols['tsl_id'] = $tsl_id;
            $cols['tsl_project'] = $tsl_project;
            $cols['tsl_submitalid'] = $tsl_submitalid;
            $cols['tsl_description'] = $tsl_description;
            $cols['tsl_cby'] = $tsl_cby;
            $cols['tsl_eby'] = $tsl_eby;
            $cols['tsl_cdate'] = $tsl_cdate;
            $cols['tsl_edate'] = $tsl_edate;
            return $cols;
        }

        private function pms_tech_submital_ccommands($rows){
            extract($rows);
            $cols = [];
            $cols['tscc_id'] = $tscc_id;
            $cols['tscc_project'] = $tscc_project;
            $cols['tscc_submitno'] = $tscc_submitno;
            $cols['tscc_notes'] = $tscc_notes;
            $cols['tscc_cby'] = $tscc_cby;
            $cols['tscc_eby'] = $tscc_eby;
            $cols['tscc_cdate'] = $tscc_cdate;
            $cols['tscc_edate'] = $tscc_edate;
            return $cols;
        }

        private function _techsubmitalrpt(){
            $this->sql = "SELECT *            
            pj.project_id,
            pj.project_no,
            pj.project_name,
            pj.project_cname,
            pj.project_location,
            pj.project_contact_person,
            pj.Sales_Representative,
            pj.projectRegion,
            pj.project_type FROM pms_tech_submital as ts
                        inner join pms_project_summary as pj 
                        on ts.techsub_project = pj.project_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = $this->pms_tech_submital($rows);
                $rpt['project_id'] = $rows['project_id'];
                $rpt['project_no_enc'] = $rows['project_no'];
                $rpt['project_no'] = $this->enc('denc',$rows['project_no']);
                $rpt['project_name'] = $this->enc('denc',$rows['project_name']);
                $rpt['project_cname'] = $this->enc('denc',$rows['project_cname']);
                $rpt['project_location'] = $this->enc('denc',$rows['project_location']);
                $rpt['project_contact_person'] = $this->enc('denc',$rows['project_contact_person']);
                $rpt['Sales_Representative'] = $this->enc('denc',$rows['Sales_Representative']);
                $rpt['projectRegion'] = $this->enc('denc',$rows['projectRegion']);
                $rpt['project_type'] = $this->enc('denc',$rows['project_type']); 
                $rpts[] = $rpt;               
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        public function techsubmitalrpt(){
            $rpts = $this->_techsubmitalrpt();
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        private function _techsubmitalbyproject($techsub_project){
            $this->sql = "SELECT *,
            pj.project_id,
            pj.project_no,
            pj.project_name,
            pj.project_cname,
            pj.project_location,
            pj.project_contact_person,
            pj.Sales_Representative,
            pj.projectRegion,
            pj.project_type FROM pms_tech_submital as ts
                        inner join pms_project_summary as pj 
                        on ts.techsub_project = pj.project_id 
                        where ts.techsub_project = :techsub_project";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":techsub_project",$techsub_project);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = $this->pms_tech_submital($rows);
                $rpt['project_id'] = $rows['project_id'];
                $rpt['project_no_enc'] = $rows['project_no'];
                $rpt['project_no'] = $this->enc('denc',$rows['project_no']);
                $rpt['project_name'] = $this->enc('denc',$rows['project_name']);
                $rpt['project_cname'] = $this->enc('denc',$rows['project_cname']);
                $rpt['project_location'] = $this->enc('denc',$rows['project_location']);
                $rpt['project_contact_person'] = $this->enc('denc',$rows['project_contact_person']);
                $rpt['Sales_Representative'] = $this->enc('denc',$rows['Sales_Representative']);
                $rpt['projectRegion'] = $this->enc('denc',$rows['projectRegion']);
                $rpt['project_type'] = $this->enc('denc',$rows['project_type']); 
                $rpts[] = $rpt;               
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        public function techsubmitalbyproject($techsub_project){
            $rpts = $this->_techsubmitalbyproject($techsub_project);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        private function _gettechsubmitaldt($techsub_id){
            //echo $techsub_id;
            $this->sql = "SELECT *,
            pj.project_id,
            pj.project_no,
            pj.project_name,
            pj.project_cname,
            pj.project_location,
            pj.project_contact_person,
            pj.Sales_Representative,
            pj.projectRegion,
            pj.project_type 
            FROM pms_tech_submital as ts
            inner join pms_project_summary as pj 
            on ts.techsub_project = pj.project_id 
            where ts.techsub_id = :techsub_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":techsub_id",$techsub_id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            //echo $this->cm->rowCount();
            $rpt = $this->pms_tech_submital($rows);
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = $this->enc('denc',$rows['project_no']);
            $rpt['project_name'] = $this->enc('denc',$rows['project_name']);
            $rpt['project_cname'] = $this->enc('denc',$rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc',$rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc',$rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc',$rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc',$rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc',$rows['project_type']); 

            unset($this->cm,$this->sql,$rows);
            return $rpt;
        }

        private function _gettechapprovals_speclist($tsl_submitalid){
            $this->sql = "SELECT *FROM pms_tech_submital_list where tsl_submitalid = :tsl_submitalid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tsl_submitalid",$tsl_submitalid);
            $this->cm->execute();
            $lists = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $list = $this->pms_tech_submital_list($rows);
                $lists[] = $list;
            }
            unset($this->sql,$this->cm,$rows);
            return $lists;
        }

        private function _gettechnicalapprovals_commands($tscc_submitno){
            $this->sql = "SELECT *FROM pms_tech_submital_ccommands where tscc_submitno = :tscc_submitno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tscc_submitno",$tscc_submitno);
            $this->cm->execute();
            $commads = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $command = $this->pms_tech_submital_ccommands($rows);
                $commads[] = $command;
            }
            unset($this->cm,$this->sql,$rows);
            return $commads;
        }

        private function _getsubmitalinfo($techsub_id){
            $submital = $this->_gettechsubmitaldt($techsub_id);
            $lists = $this->_gettechapprovals_speclist($techsub_id);
            $commands = $this->_gettechnicalapprovals_commands($techsub_id);
            $datas = array(
                "submital" => $submital,
                "lists" => $lists,
                "commands" => $commands,
            );
            return $datas;
        }

        public function getsubmitalinfo($techsub_id){
            $datas = $this->_getsubmitalinfo($techsub_id);
            $this->response = array(
                "msg" => '1',
                "data" => $datas
            );
            return json_encode($this->response);
            exit;
        }
        private function _checkrevision($techsub_number,$techsub_rvno,$techsub_project){
            $this->sql = "SELECT COUNT(techsub_number) as cnt from pms_tech_submital where 
            techsub_number = :techsub_number and techsub_rvno = :techsub_rvno and techsub_project=:techsub_project";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":techsub_number",$techsub_number);
            $this->cm->bindParam(":techsub_rvno",$techsub_rvno);
            $this->cm->bindParam(":techsub_project",$techsub_project);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->sql,$this->cm,$rows);
            return $cnt;
        }

        private function _savesubmital($svdata){           
            $this->sql = "INSERT INTO pms_tech_submital values(
                null,
                :techsub_project,
                :techsub_number,
                :techsub_rvno,
                :techsub_date,
                :techsub_purpose,
                :techsub_remarks,
                :techsub_submittedby,
                :techsub_subdate,
                :techsub_status,
                :techsub_statusdate,
                :techsub_remarksdt,
                :techsub_description,
                :techsub_spctype,
                :techsub_qty,
                :techsub_cby,
                :techsub_eby,
                :techsub_cdate,
                :techsub_edate,
                :techsub_extra
               
            )"; //19
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($svdata);
            unset($this->cm,$this->sql);
                     
            if(!$sv){
                return 0;
            }
            $id = $this->cn->LastInsertId();
            return $id;            
        }
       
        private function _save_tech_submitallist($datas){
            $this->sql = "INSERT INTO pms_tech_submital_list values(
                null,
                :tsl_project,
                :tsl_submitalid,
                :tsl_description,
                :tsl_cby,
                :tsl_eby,
                :tsl_cdate,
                :tsl_edate
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($datas);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        private function _save_tech_submital_commands($datas){
            $this->sql = "INSERT INTO pms_tech_submital_ccommands values(
                null,
                :tscc_project,
                :tscc_submitno,
                :tscc_notes,
                :tscc_cby,
                :tscc_eby,
                :tscc_cdate,
                :tscc_edate
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($datas);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function saveTechSubmital($save,$list,$commands){
            $techsub_number = $save[':techsub_number'];
            $techsub_rvno = $save[':techsub_rvno'];
            $techsub_project = $save[':techsub_project'];
            $cnt = $this->_checkrevision($techsub_number,
                    $techsub_rvno,
                    $techsub_project
                );
            if($cnt !== 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Already This Submital Number and Revision Number Exists"
                );
                return json_encode($this->response);
                exit;
            }
            $sv = $this->_savesubmital($save);
            if($sv === 0){ 
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Submitting data"
                );
                return json_encode($this->response);
                exit;
            }

            foreach($list as $l){
                $listdata = array(
                    ":tsl_project" => $save[':techsub_project'],
                    ":tsl_submitalid" => $sv,
                    ":tsl_description" => $l->tsspclistdescription,
                    ":tsl_cby" => $l->tsspclistnotes,
                    ":tsl_eby" => $save[':techsub_cby'],
                    ":tsl_cdate" => $save[':techsub_cdate'],
                    ":tsl_edate" => $save[':techsub_cdate'],
                );
                $this->_save_tech_submitallist($listdata);
            }

            foreach($commands as $l){
                $listdata = array(
                    ":tscc_project" => $save[':techsub_project'],
                    ":tscc_submitno" => $sv,
                    ":tscc_notes" => $l,
                    ":tscc_cby" => $save[':techsub_cby'],
                    ":tscc_eby" => $save[':techsub_cby'],
                    ":tscc_cdate" => $save[':techsub_cdate'],
                    ":tscc_edate" => $save[':techsub_cdate'],
                );
                $this->_save_tech_submital_commands($listdata);
            }
            $datas = $this->_getsubmitalinfo($sv);
            $this->response = array(
                "msg" => '1',
                "data" => $datas
            );
            return json_encode($this->response);
            exit;
        }


        //update technical submital
        private function _updateTechnicalSubmittalStatus($datas){
            $this->sql = "UPDATE pms_tech_submital set 
            techsub_status = :techsub_status,
            techsub_subdate = :techsub_subdate,
            techsub_eby = :techsub_eby,
            techsub_edate = :techsub_edate 
            where techsub_id = :techsub_id";
            $this->cm = $this->cn->prepare($this->sql);
            $sv =  $this->cm->execute($datas);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function UpdateTechnicalApprovalsStatus($datas,$projectcode){
            $sv = self::_updateTechnicalSubmittalStatus($datas);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Updating status"
                );
                return json_encode($this->response);
                exit;
            }

            $projectsubmittals = self::techsubmitalbyproject($projectcode);
            // $this->response = array(
            //     "msg" => "1",
            //     "data" => $projectsubmittals
            // );
            return $projectsubmittals;
            exit;
            
        }
        private function _updatetechsubmitall($save){
            $this->sql = "UPDATE pms_tech_submital set 
            techsub_date = :techsub_date,
            techsub_purpose = :techsub_purpose,
            techsub_remarks = :techsub_remarks,
            techsub_submittedby = :techsub_submittedby,
            techsub_subdate = :techsub_subdate,
            techsub_remarksdt = :techsub_remarksdt,
            techsub_description = :techsub_description,
            techsub_spctype = :techsub_spctype,
            techsub_qty = :techsub_qty,
            techsub_eby = :techsub_eby,
            techsub_edate = :techsub_edate,
            techsub_extra = :techsub_extra 
            where techsub_id = :techsub_id";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->cm,$this->sql);
            return $sv;
        }
        private function _removeoldlist($id){
            $this->sql = "DELETE FROM pms_tech_submital_list where 
            tsl_submitalid = :tsl_submitalid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tsl_submitalid",$id);
            $this->cm->execute();
        }
        private function _removeoldcommands($id){
            $this->sql = "DELETE FROM pms_tech_submital_ccommands where 
            tscc_submitno = :tscc_submitno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tscc_submitno",$id);
            $this->cm->execute();
        }
        public function updateTechSubmital($save,$list,$commands,$saveinfo){
            $sv = $save[':techsub_id'];
            $svx = $this->_updatetechsubmitall($save);
            if($svx === 0){ 
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Update Submittal Data data"
                );
                return json_encode($this->response);
                exit;
            }

            self::_removeoldlist($sv);
            self::_removeoldcommands($sv);

            foreach($list as $l){
                $listdata = array(
                    ":tsl_project" => $saveinfo[':techsub_project'],
                    ":tsl_submitalid" => $sv,
                    ":tsl_description" => $l->tsspclistdescription,
                    ":tsl_cby" => $l->tsspclistnotes,
                    ":tsl_eby" => $saveinfo[':techsub_cby'],
                    ":tsl_cdate" => $saveinfo[':techsub_cdate'],
                    ":tsl_edate" => $saveinfo[':techsub_cdate'],
                );
                $this->_save_tech_submitallist($listdata);
            }

            foreach($commands as $l){
                $listdata = array(
                    ":tscc_project" => $saveinfo[':techsub_project'],
                    ":tscc_submitno" => $sv,
                    ":tscc_notes" => $l,
                    ":tscc_cby" => $saveinfo[':techsub_cby'],
                    ":tscc_eby" => $saveinfo[':techsub_cby'],
                    ":tscc_cdate" => $saveinfo[':techsub_cdate'],
                    ":tscc_edate" => $saveinfo[':techsub_cdate'],
                );
                $this->_save_tech_submital_commands($listdata);
            }
            $datas = $this->_getsubmitalinfo($sv);
            $this->response = array(
                "msg" => '1',
                "data" => $datas
            );
            return json_encode($this->response);
            exit;
        }
        //update technical submital

        public function getTechnicalSubmittalinfo($id){
            $datas = $this->_getsubmitalinfo($id);
            $this->response = array(
                "msg" => '1',
                "data" => $datas
            );
            return json_encode($this->response);
            exit;
        }

        //shopdrowing Submittal
        private function pms_drawing_submital($rows){
            extract($rows);
            $cols = [];
            $cols['ds_id'] = $ds_id;
            $cols['ds_project'] = $ds_project;
            $cols['ds_submitalno'] = $ds_submitalno;
            $cols['ds_rvno'] = $ds_rvno;
            $cols['ds_date'] = $ds_date;
            $cols['ds_purpose'] = $ds_purpose;
            $cols['ds_remark'] = $ds_remark;
            $cols['ds_submittedby'] = $ds_submittedby;
            $cols['ds_submitteddate'] = $ds_submitteddate;
            $cols['ds_status'] = $ds_status;
            $cols['ds_remarks'] = $ds_remarks;        
            return $cols;

        }
        private function _get_drawing_submit($ds_id){
            $this->sql = "SELECT *,
              pj.project_id,
                pj.project_no,
                pj.project_name,
                pj.project_cname,
                pj.project_location,
                pj.project_contact_person,
                pj.Sales_Representative,
                pj.projectRegion,
                pj.project_type 
            FROM pms_drawing_submital as ds inner join pms_project_summary as pj on ds.ds_project = pj.project_id where ds.ds_id = :ds_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ds_id",$ds_id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $rpt = $this->pms_drawing_submital($rows);
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = $this->enc('denc',$rows['project_no']);
            $rpt['project_name'] = $this->enc('denc',$rows['project_name']);
            $rpt['project_cname'] = $this->enc('denc',$rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc',$rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc',$rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc',$rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc',$rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc',$rows['project_type']); 
            unset($this->cm,$this->sql,$rows);
            return $rpt;
        }

        private static function pms_drawing_submital_dt($rows){
            extract($rows);
            $cols = [];
            $cols['dsdt_id'] = $dsdt_id;
            $cols['dsdt_project'] = $dsdt_project;
            $cols['dsdt_dsid'] = $dsdt_dsid;
            $cols['dsdt_dsqty'] = $dsdt_dsqty;
            $cols['dsdt_drawingno'] = $dsdt_drawingno;
            $cols['dsdt_remarks'] = $dsdt_remarks;
            $cols['dsdt_editby'] = $dsdt_editby;
            $cols['dsdt_editdate'] = $dsdt_editdate;
            $cols['dsdt_description'] = $dsdt_description;
            
            return $cols;
        }
        private function _get_drawing_submital_dt($ds_id){
            $this->sql = "SELECT *,
                pj.project_id,
                pj.project_no,
                pj.project_name,
                pj.project_cname,
                pj.project_location,
                pj.project_contact_person,
                pj.Sales_Representative,
                pj.projectRegion,
                pj.project_type 
            FROM pms_drawing_submital_dt as ds 
            inner join pms_project_summary as pj 
            on ds.dsdt_project = pj.project_id 
            where ds.dsdt_dsid = :dsdt_dsid";

            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":dsdt_dsid",$ds_id);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = $this::pms_drawing_submital_dt($rows);
                $rpt['project_id'] = $rows['project_id'];
                $rpt['project_no_enc'] = $rows['project_no'];
                $rpt['project_no'] = $this->enc('denc',$rows['project_no']);
                $rpt['project_name'] = $this->enc('denc',$rows['project_name']);
                $rpt['project_cname'] = $this->enc('denc',$rows['project_cname']);
                $rpt['project_location'] = $this->enc('denc',$rows['project_location']);
                $rpt['project_contact_person'] = $this->enc('denc',$rows['project_contact_person']);
                $rpt['Sales_Representative'] = $this->enc('denc',$rows['Sales_Representative']);
                $rpt['projectRegion'] = $this->enc('denc',$rows['projectRegion']);
                $rpt['project_type'] = $this->enc('denc',$rows['project_type']); 
                $rpts[] = $rpt;
            }

            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        private function _getdrawingsubmital($submitalid){
            $submitalinfo = $this->_get_drawing_submit($submitalid);
            $submitaldt = $this->_get_drawing_submital_dt($submitalid);
            $data = array(
                "submitalinfo" => $submitalinfo,
                "submitaldt" => $submitaldt
            );
            return $data;
        }

        public function getDrawingSubmitalinfo($submitalid){
            $data = $this->_getdrawingsubmital($submitalid);
            $this->response = array(
                "msg" => '1',
                "data" => $data,
            );
            return json_encode($this->response);
            exit;
        }
        private function _checksubmitalno($params){
            $this->sql = "SELECT COUNT(ds_project) as cnt from pms_drawing_submital where ds_project = :ds_project 
            and 
            ds_submitalno = :ds_submitalno 
            and 
            ds_rvno = :ds_rvno";
            $this->cm =  $this->cn->prepare($this->sql);
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->sql,$this->cm,$rows);
            return $cnt;
        }
        private function _savedrawingsubmitals($save){
            $this->sql = "INSERT INTO pms_drawing_submital values(
                null,
                :ds_project,
                :ds_submitalno,
                :ds_rvno,
                :ds_date,
                :ds_purpose,
                :ds_remark,
                :ds_submittedby,
                :ds_submitteddate,
                :ds_status,
                :ds_remarks,
                :ds_cby,
                :ds_eby,
                :ds_cdate,
                :ds_edate,
                :ds_extra
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->sql,$this->cm);
            if(!$sv){
                return 0;
            }

            $sno = (int)$this->cn->LastInsertId();
            return $sno;
        }

        private function save_pms_drawing_submital_dt($save){
            $this->sql = "INSERT INTO pms_drawing_submital_dt values(
                null,
                :dsdt_project,
                :dsdt_dsid,
                :dsdt_dsqty,
                :dsdt_drawingno,
                :dsdt_remarks,
                :dsdt_editby,
                :dsdt_editdate,
                :dsdt_description
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function save_drawing_submital($submital,$dtails){
            $project = $submital[':ds_project'];
            $chckboar = array(
                ":ds_project" =>  $project,
                ":ds_submitalno" => $submital[':ds_submitalno'],
                ":ds_rvno" => $submital[':ds_rvno'],
            );
            $cnt = self::_checksubmitalno($chckboar);
            if($cnt !== 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Already This submital number and revision Number found"
                );
                return json_encode($this->response);
                exit;
            }
            $sno = $this->_savedrawingsubmitals($submital);
           
            $cby = $submital[':ds_cby'];
            $etime = $submital[':ds_edate'];
            if($sno === 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Saveing Submitall"
                );
                return json_encode($this->response);
                exit;
            }

            foreach($dtails as $dt){
                $params = array(
                    ":dsdt_project" => $project,
                    ":dsdt_dsid" => $sno,
                    ":dsdt_dsqty" => $dt->dsdt_dsqty,
                    ":dsdt_drawingno" => $dt->dsdt_drawingno,
                    ":dsdt_remarks" => $dt->dsdt_remarks,
                    ":dsdt_editby" => $cby,
                    ":dsdt_editdate" => $etime,
                    ":dsdt_description" => $dt->dsdt_description
                );
               
                $sv = $this->save_pms_drawing_submital_dt($params);
                //echo $sv ? "k" : "E";
            }
            //echo $sno;
            $data = $this->_getdrawingsubmital($sno);
            $this->response = array(
                "msg" => '1',
                "data" => $data,
            );
            return json_encode($this->response);
            exit;

        }

        public function getShopdrwingsubmittalinfo($sno){
            $data = $this->_getdrawingsubmital($sno);
            $this->response = array(
                "msg" => '1',
                "data" => $data,
            );
            return json_encode($this->response);
            exit;
        }

        private function getAllDrawingSubmittals($ds_project){
            $this->sql = "SELECT *FROM pms_drawing_submital where ds_project = :ds_project";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ds_project",$ds_project);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $rpt = array(
                    "ds_id" => $ds_id,
                    "ds_project" => $ds_project,
                    "ds_submitalno" => $ds_submitalno,
                    "ds_rvno" => $ds_rvno,
                    "ds_date" => $ds_date,
                    "ds_status" => $ds_status,
                    "ds_date_f" => self::_datef($ds_date),                    
                    "ds_submittedby" => $ds_submittedby,
                    "ds_submitteddate" => $ds_submitteddate,
                    "ds_submitteddate_f" => self::_datef($ds_submitteddate),
                );

                $rpts[] = $rpt;
            }
            unset($this->sql,$this->cm,$rows);
            return $rpts;
        }

        public function GetAllProjectDrawingSubmittals($ds_project){
            $rpts = self::getAllDrawingSubmittals($ds_project);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        private function dgupdateStatus($params){
            $this->sql = "UPDATE pms_drawing_submital set 
            ds_submitteddate = :ds_submitteddate,
            ds_status = :ds_status,
            ds_eby = :ds_eby,
            ds_edate = :ds_edate where ds_id = :ds_id";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm);
            return $sv;
        }

        public function DgStatusUpdate($params,$ds_project){
            $isupdate = self::dgupdateStatus($params);
            if(!$isupdate){ 
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Update Status"
                );
                return json_encode($this->response);
                exit;
            }

            $rpts = self::getAllDrawingSubmittals($ds_project);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }
    }
?>