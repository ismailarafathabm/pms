<?php 
    include_once 'mac.php';
    class Technical extends mac{
        private $cn;
        private $cm;
        private $response;
        private $sql;

        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array("msg" => "1", "data" => "_empty Error");
        }

        private function pms_technical_systems($rows){
            extract($rows);
            $cols['techsysteid'] = $techsysteid;
            $cols['techsyssystem'] = $techsyssystem;
            $cols['techsyseby'] = $techsyseby;
            $cols['techsysecby'] = $techsysecby;
            $cols['techsyscdate'] = $techsyscdate;
            $cols['techsysedate'] = $techsysedate;
            $cols['techsysprojectid'] = $techsysprojectid;
            return $cols;            

        }
        private function _getprojectSystem($techsysprojectid){     
            //echo $techsysprojectid;
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
            FROM pms_technical_systems as tsy
            inner join pms_project_summary as pj on tsy.techsysprojectid = pj.project_id
             where tsy.techsysprojectid = :techsysprojectid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":techsysprojectid",$techsysprojectid);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = $this->pms_technical_systems($rows);
                $rpt['project_id'] = $rows['project_id'];
                $rpt['project_no_enc'] = $rows['project_no'];
                $rpt['project_no'] = self::enc('denc',$rows['project_no']);
                $rpt['project_name'] = self::enc('denc',$rows['project_name']);
                $rpt['project_cname'] = self::enc('denc',$rows['project_cname']);
                $rpt['project_location'] = self::enc('denc',$rows['project_location']);
                $rpt['project_contact_person'] = self::enc('denc',$rows['project_contact_person']);
                $rpt['Sales_Representative'] = self::enc('denc',$rows['Sales_Representative']);
                $rpt['projectRegion'] = self::enc('denc',$rows['projectRegion']);
                $rpt['project_type'] = self::enc('denc',$rows['project_type']); 
                $rpts[] = $rpt;
            }            
            return $rpts;
        }

        public function getprojectSystem($techsysprojectid){
            $rpt = self::_getprojectSystem($techsysprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        private function _checkprojectsystem($params){
            $this->sql = "SELECT count(techsysprojectid) as cnt FROM pms_technical_systems where 
            techsysprojectid = :techsysprojectid and techsyssystem = :techsyssystem";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            return $cnt;
        }

        private function _saveProjectTechnicalSystem($params){
            //print_r($params);
            $this->sql = "INSERT INTO pms_technical_systems values(
                null,
                :techsyssystem,
                :techsyseby,
                :techsysecby,
                :techsyscdate,
                :techsysedate,
                :techsysprojectid
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params) ;
            return $sv;
        }

        public function saveProjectTechincalSystems($params){
            $ck = array(
                ":techsysprojectid" => $params[":techsysprojectid"],
                ":techsyssystem" => $params[":techsyssystem"],
            );
            $cnt = self::_checkprojectsystem($ck);
            if($cnt !== 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "dublicate Found"
                );
                return json_encode($this->response);
                exit;
            }

            $sv = self::_saveProjectTechnicalSystem($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Saving Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = $this->_getprojectSystem($params[':techsysprojectid']);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;

        }

        private function _checksystemforupdate($params){
            $this->sql = "SELECT COUNT(techsysprojectid) as cnt from 
            pms_technical_systems where 
            techsysteid <> :techsysteid and 
            techsyssystem = :techsyssystem and 
            techsysprojectid = :techsysprojectid
            ";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->sql,$this->cm,$rows);
            return $cnt;
        }

        private function _updateSystem($update){            
            $this->sql = "UPDATE pms_technical_systems set 
            techsyssystem = :techsyssystem,
            techsysecby = :techsysecby,
            techsysedate = :techsysedate 
            where 
            techsysteid = :techsysteid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->sql,$this->cm,$rows);
            return $sv;
        }

        public function UpdateSystem($params,$chck){
            // $chck = array(
            //     ":techsysteid" => $params[':techsysteid'],
            //     ":techsyssystem" => $params[':techsyssystem'],
            //     ":techsysprojectid" => $params[':techsysprojectid'],
            // );

            $cnt = self::_checksystemforupdate($chck);
            if($cnt !== 0){
                $this->response = array("msg" => "0" , "data" => "This System Already Exists");
                return json_encode($this->response);
                exit;
            }

            $sv = self::_updateSystem($params);
            if(!$sv){
                $this->response = array("msg" => "0", "data" => "Error has found on updating Data");
                return json_encode($this->response);
                exit;
            }

            $rpt = $this->_getprojectSystem($chck[':techsysprojectid']);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;

        }

        private function _removeSystem($techsysteid){
            $this->sql = "DELETE FROM pms_technical_systems where techsysteid = :techsysteid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":techsysteid",$techsysteid);
            $rm = $this->cm->execute();
            unset($this->cm,$this->sql);
            return $rm;
        }

        public function RemoveSystem($techsysteid,$techsysprojectid){
            $rm = self::_removeSystem($techsysteid);
            if(!$rm){
                $this->response = array("msg" => "0" , "data" => "Error On Remove Data");
                return json_encode($this->response);
                exit;
            }
            $rpt = self::_getprojectSystem($techsysprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }
        ///?colors
        private function color_approval_status($status){
            
            switch($status){
                default:
                case '1':
                    return 'submitted';
                break;
                case '2': return 'Approved'; break;
                case '3' : return 'Cancelled' ; break;
            };
           
        }
        private function pms_technical_colors($rows) {
            extract($rows);
            $cols['tcid'] = $tcid;
            $cols['tcmaterial'] = $tcmaterial;
            $cols['tecdescription'] = $tecdescription;
            $cols['tcsubmittedby'] = $tcsubmittedby;

            $cols['tcsubmitteddate'] = $tcsubmitteddate;
            $cols['tcsubmitteddate_d'] = self::_date($tcsubmitteddate,'d-M-Y');
            $cols['tcsubmitteddate_n'] = self::_date($tcsubmitteddate,'d-m-Y');
            $cols['tcsubmitteddate_p'] = self::_date($tcsubmitteddate,'d-m-y');

            $cols['tcapprovedstatus'] = $tcapprovedstatus;
            $cols['tcapprovedstatus_txt'] = self::color_approval_status((string)$tcapprovedstatus);

            $cols['tcapproveddate'] = $tcapproveddate;
            $cols['tcapproveddate_d'] = self::_date($tcapproveddate,'d-M-Y');
            $cols['tcapproveddate_n'] = self::_date($tcapproveddate,'d-m-Y');
            $cols['tcapproveddate_p'] = self::_date($tcapproveddate,'d-m-y');

            $cols['tcprojectid'] = $tcprojectid;
            $cols['tccby'] = $tccby;
            $cols['tceby'] = $tceby;
            $cols['tccdate'] = $tccdate;
            $cols['tcedate'] = $tcedate;
            return $cols;
        }

        private function _getProjectColorsApprovals($tcprojectid){
            $this->sql ="SELECT *FROM pms_technical_colors where tcprojectid = :tcprojectid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tcprojectid",$tcprojectid);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = self::pms_technical_colors($rows);
                $rpts[] = $rpt;
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;            
        }

        public function getProjectColorApprovals($tcprojectid){
            $rpt = self::_getProjectColorsApprovals($tcprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt,
            );
            return json_encode($this->response);
            exit;
        }

        private function _saveProjectColorApprovals($save){
            $this->sql = "INSERT INTO pms_technical_colors values(
                null,
                :tcmaterial,
                :tecdescription,
                :tcsubmittedby,
                :tcsubmitteddate,
                :tcapprovedstatus,
                :tcapproveddate,
                :tcprojectid,
                :tccby,
                :tceby,
                :tccdate,
                :tcedate
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function saveProjectColorsApprovals($params){
            $tcprojectid = $params[':tcprojectid'];
            $sv = self::_saveProjectColorApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error has found in Saving Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectColorsApprovals($tcprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt,
            );
            return json_encode($this->response);
            exit;
        }

        private function _updateProjectColorsApprovals($update){
            $this->sql = "UPDATE pms_technical_colors set 
            tcmaterial = :tcmaterial,
            tecdescription = :tecdescription,
            tcsubmittedby = :tcsubmittedby,
            tcsubmitteddate = :tcsubmitteddate,
            tcapprovedstatus = :tcapprovedstatus,
            tcapproveddate = :tcapproveddate,
            tceby = :tceby,
            tcedate = :tcedate 
            where tcid = :tcid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function UpdateProjectColorsApprovals($params,$tcprojectid){
            $sv = self::_updateProjectColorsApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "1",
                    "data" => "Error Has found in Updating Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectColorsApprovals($tcprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt,
            );
            return json_encode($this->response);
            exit;
        }

        private function _removeProjectColorApprovals($tcid){
            $this->sql = "DELETE FROM pms_technical_colors where tcid = :tcid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tcid",$tcid);
            $del = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $del;            
        }

        public function RemoveProjectColorApprovals($tcid,$tcprojectid){
            $del = self::_removeProjectColorApprovals($tcid);
            if(!$del){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error has found on Removeing Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectColorsApprovals($tcprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt,
            );
            return json_encode($this->response);
            exit;
        }

        ///?colors

        //?hardwares

        private function pms_technical_hardware($rows){
            extract($rows);
            $cols['thid'] = $thid;
            $cols['thproject'] = $thproject;
            $cols['thsystem'] = $thsystem;
            $cols['thdescriptions'] = $thdescriptions;
            $cols['thnotes'] = $thnotes;
            $cols['thsubmittedby'] = $thsubmittedby;

            $cols['thsubmitteddate'] = $thsubmitteddate;
            $cols['thsubmitteddate_d'] = self::_date($thsubmitteddate,'d-M-Y');
            $cols['thsubmitteddate_n'] = self::_date($thsubmitteddate,'d-m-Y');
            $cols['thsubmitteddate_p'] = self::_date($thsubmitteddate,'d-m-y');

            $cols['thstatus'] = $thstatus;
            $cols['thstatus_txt'] = self::color_approval_status((string)$thstatus);

            $cols['thsapprovedate'] = $thsapprovedate;            
            $cols['thsapprovedate_d'] = self::_date($thsapprovedate,'d-M-Y');
            $cols['thsapprovedate_n'] = self::_date($thsapprovedate,'d-m-Y');
            $cols['thsapprovedate_p'] = self::_date($thsapprovedate,'d-m-y');
            
            $cols['thcby'] = $thcby;
            $cols['theby'] = $theby;
            $cols['thcdate'] = $thcdate;
            $cols['thedate'] = $thedate;
            return $cols;
        }

        private function _getProjectHardwareApprovals($thproject){
            $this->sql = "SELECT *FROM pms_technical_hardware where thproject = :thproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":thproject",$thproject);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = self::pms_technical_hardware($rows);
                $rpts[] = $rpt;
            }
            unset($this->sql,$this->cm,$rows);
            return $rpts;
        }

        public function getProjetHardwareApprovals($thproject){
            $rpt = self::_getProjectHardwareApprovals($thproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        private function _addnewProjectHardWareApprovals($params){
            $this->sql = "INSERT INTO pms_technical_hardware values(
                null,
                :thproject,
                :thsystem,
                :thdescriptions,
                :thnotes,
                :thsubmittedby,
                :thsubmitteddate,
                :thstatus,
                :thsapprovedate,
                :thcby,
                :theby,
                :thcdate,
                :thedate
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm);
            return $sv;
        }

        public function addnewProjectHardWareApprovals($params){
            $sv = self::_addnewProjectHardWareApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error Has Found On Saving Data"
                );
                return json_encode($this->response);
                exit;
            }

            $thproject = $params[":thproject"];
            $rpt = self::_getProjectHardwareApprovals($thproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        private function _udpateProjectHardWareApprovals($params){
            $this->sql = "UPDATE pms_technical_hardware set 
            thsystem = :thsystem,
            thdescriptions = :thdescriptions,
            thnotes = :thnotes,
            thsubmittedby = :thsubmittedby,
            thsubmitteddate = :thsubmitteddate,
            thstatus = :thstatus,
            thsapprovedate = :thsapprovedate,
            theby = :theby,
            thedate = :thedate 
            where 
            thid = :thid";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function UpdateProjectHardwareApprovals($params,$thproject){
            $sv = self::_udpateProjectHardWareApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error Has found on Update data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectHardwareApprovals($thproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
            
        }

        private function _removeProjectHardWareApprovals($thid){
            $this->sql = "DELETE FROM pms_technical_hardware where thid = :thid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":thid",$thid);
            $del = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $del;
        }

        public function RemoveProjectHardWareApprovals($thid,$thproject){
            $del = self::_removeProjectHardWareApprovals($thid);
            if(!$del){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error Has found on updateing Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectHardwareApprovals($thproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        //?hardwares

        //? technical approvals

        
        // Table Name : pms_technical_approvals
        /* CRUD OPERATION Function */

        // @read technical approvals columns
        private function pms_technical_approvals($rows){
            extract($rows);
            $cols['taid'] = $taid;
            $cols['taproject'] = $taproject;
            $cols['taapproval'] = $taapproval;
            $cols['tadescription'] = $tadescription;
            $cols['taremarks'] = $taremarks;
            $cols['tasubmittedby'] = $tasubmittedby;

            $cols['tasubmitteddate'] = $tasubmitteddate;
            $cols['tasubmitteddate_d'] = self::_date($tasubmitteddate,'d-M-Y');
            $cols['tasubmitteddate_n'] = self::_date($tasubmitteddate,'d-m-Y');
            $cols['tasubmitteddate_p'] = self::_date($tasubmitteddate,'d-m-y');

            $cols['tastatus'] = $tastatus;
            $cols['tastatus_txt'] = self::color_approval_status((string)$tastatus);

            $cols['taapproveddate'] = $taapproveddate;
            $cols['taapproveddate_d'] = self::_date($taapproveddate,'d-M-Y');
            $cols['taapproveddate_n'] = self::_date($taapproveddate,'d-m-Y');
            $cols['taapproveddate_p'] = self::_date($taapproveddate,'d-m-y');

            $cols['tacby'] = $tacby;
            $cols['taeby'] = $taeby;
            $cols['tacdate'] = $tacdate;
            $cols['taedate'] = $taedate;
            return $cols;
        }
        // @read Technical Approvals for Selected Project
        private function _getProjectTechnicalApprovals($taproject){
            $this->sql = "SELECT *FROM pms_technical_approvals where taproject = :taproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":taproject",$taproject);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = self::pms_technical_approvals($rows);
                $rpts[] = $rpt;
            }
            unset($this->sql,$this->cm,$rows);
            return $rpts;            
        }

        public function ProjectTechnicalApprovals($taproject){
            $rpt = self::_getProjectTechnicalApprovals($taproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        //@insert Tehnical Approvals For Selected Project
        private function _insertProjectTechnicalApprovals($save){
            $this->sql = "INSERT INTO pms_technical_approvals values(
                null,
                :taproject,
                :taapproval,
                :tadescription,
                :taremarks,
                :tasubmittedby,
                :tasubmitteddate,
                :tastatus,
                :taapproveddate,
                :tacby,
                :taeby,
                :tacdate,
                :taedate
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function InsertProjectTechnicalApprovals($params){
            $sv = self::_insertProjectTechnicalApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error Has found on Saveing Data"
                );
                return json_encode($this->response);
                exit;
            }
            $taproject = $params[':taproject'];
            $rpt = self::_getProjectTechnicalApprovals($taproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        //@update Technical Approvals Selected project
        private function _updateProjectTechnicalApprovals($update){
            //print_r($update);
            $this->sql = "UPDATE pms_technical_approvals set 
            taapproval = :taapproval,
            tadescription = :tadescription,
            taremarks = :taremarks,
            tasubmittedby = :tasubmittedby,
            tasubmitteddate = :tasubmitteddate,
            tastatus = :tastatus,
            taapproveddate = :taapproveddate,
            taeby = :taeby,
            taedate = :taedate 
            where 
            taid = :taid";
            
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->sql,$this->cm);
            return $sv;
        }


        public function UpdateProjectTechnicalApprovals($params,$taproject){
            $sv = self::_updateProjectTechnicalApprovals($params);
            if(!$sv){
                $this->response = array(
                    "msg" => '0',
                    "data" => "Error has found on Update Data"
                );
                return json_encode($this->response);
                exit;
            }
            $rpt = self::_getProjectTechnicalApprovals($taproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }

        //@delete Selected Technical Approvals Form Selected Project
        private function _removeProjectTechnicalApprovals($taid){
            $this->sql = "DELETE FROM pms_technical_approvals where taid = :taid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':taid',$taid);
            $sv = $this->cm->execute();
            unset($this->cm,$this->sql);
            return $sv;            
        }

        public function RemoveProjectTechnicalApprovals($taid,$taproject){
            $del = self::_removeProjectTechnicalApprovals($taid);
            if(!$del){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error has found on removeing Data"
                );
                return json_encode($this->response);
                exit;
            }

            $rpt = self::_getProjectTechnicalApprovals($taproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpt
            );
            return json_encode($this->response);
            exit;
        }
        //? Technical Approvals End

        //? Technical Calculation Submittal
        //@table init
        private function pms_technical_calculations($rows){
            extract($rows);
            $cols['tcid'] = $tcid;
            $cols['tcproject'] = $tcproject;
            $cols['tcsubmitall'] = $tcsubmitall;
            $cols['tcsubmittedby'] = $tcsubmittedby;

            $cols['tcsubmittaldate'] = $tcsubmittaldate;
            $cols['tcsubmittaldate_d'] = self::_date($tcsubmittaldate,'d-M-Y');
            $cols['tcsubmittaldate_n'] = self::_date($tcsubmittaldate,'d-m-Y');
            $cols['tcsubmittaldate_p'] = self::_date($tcsubmittaldate,'d-m-y');

            $cols['tcstatus'] = $tcstatus;
            $cols['tcstatus_txt'] = self::color_approval_status((string)$tcstatus);
            
            $cols['tcapproveddate'] = $tcapproveddate;
            $cols['tcapproveddate_d'] = self::_date($tcapproveddate,'d-M-Y');
            $cols['tcapproveddate_n'] = self::_date($tcapproveddate,'d-m-Y');
            $cols['tcapproveddate_p'] = self::_date($tcapproveddate,'d-m-y');

            $cols['tcsubmittalno'] = $tcsubmittalno;
            $cols['tcsubmittalrv'] = $tcsubmittalrv;
            $cols['tccby'] = $tccby;
            $cols['tceby'] = $tceby;
            $cols['tccdate'] = $tccdate;
            $cols['tcedate'] = $tcedate;
            return $cols;
        }

        //@select Command For Get Project Calculation Approvals
        private function _getProjectCalucationsApprovals($tcproject){
            $this->sql = "SELECT *FROM pms_technical_calculations where tcproject = :tcproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tcproject",$tcproject);
            $this->cm->execute();
            $rpts = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $rpt = self::pms_technical_calculations($rows);
                $rpts[] = $rpt;
            }
            unset($this->cm,$this->sql,$rows);
            return $rpts;
        }

        public function GetProjectCalculationApprovals($tcproject){
            $rpts = self::_getProjectCalucationsApprovals($tcproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        //@ Insert New Technical Calculation Approvals
        private function _newProjectCalculationApprovals($save){
            $this->sql = "INSERT INTO pms_technical_calculations values(
                null,
                :tcproject,
                :tcsubmitall,
                :tcsubmittedby,
                :tcsubmittaldate,
                :tcstatus,
                :tcapproveddate,
                :tcsubmittalno,
                :tcsubmittalrv,
                :tccby,
                :tceby,
                :tccdate,
                :tcedate
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($save);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        private function _checkCalculation($tcproject,$tcsubmittalno,$tcsubmittalrv){
            $this->sql = "SELECT COUNT(tcsubmittalno) as cnt from 
            pms_technical_calculations where tcproject = :tcproject and tcsubmittalno = :tcsubmittalno and 
            tcsubmittalrv = :tcsubmittalrv";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ':tcproject' => $tcproject,
                ':tcsubmittalno' => $tcsubmittalno,
                ':tcsubmittalrv' => $tcsubmittalrv,
            );
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        public function SaveNewCalculationApprovals($data){
            $tcproject = $data[':tcproject'];
            $tcsubmittalno = $data[':tcsubmittalno'];
            $tcsubmittalrv = $data[':tcsubmittalrv'];
            $cnt = self::_checkCalculation($tcproject,$tcsubmittalno,$tcsubmittalrv);
            if($cnt !== 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Already Revision No Exists"
                );
                return json_encode($this->response);
                exit;
            }
            $sv = self::_newProjectCalculationApprovals($data);
            if(!$sv){
                $this->response = array(
                    "msg" => '0',
                    "data" => "Error Has found on Saving data"
                );
                return json_encode($this->response);
                exit;
            }
            $rpts = self::_getProjectCalucationsApprovals($tcproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        private function _calculationsubmitall_updatecheck($tcproject,$tcsubmittalno,$tcsubmittalrv,$tcid){
            $this->sql = "SELECT count(tcid) as cnt FROM pms_technical_calculations 
            where tcproject = :tcproject and tcsubmittalno = :tcsubmittalno and 
            tcsubmittalrv = :tcsubmittalrv and tcid <> :tcid";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ':tcproject' => $tcproject,
                ':tcsubmittalno' => $tcsubmittalno,
                ':tcsubmittalrv' => $tcsubmittalrv,
                ':tcid' => $tcid,
            );
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        private function _updateCalculationApprovals($update){
            $this->sql = "UPDATE pms_technical_calculations set 
            tcsubmitall = :tcsubmitall,
            tcsubmittedby = :tcsubmittedby,
            tcsubmittaldate = :tcsubmittaldate,
            tcstatus = :tcstatus,
            tcapproveddate = :tcapproveddate,
            tcsubmittalno = :tcsubmittalno,
            tcsubmittalrv = :tcsubmittalrv,
            tceby = :tceby,
            tcedate = :tcedate 
            where 
            tcid = :tcid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->sql,$this->cm,$rows);
            return $sv;
        }

        public function UpdateCalculations($data,$tcproject){           
            $tcsubmittalno = $data[':tcsubmittalno'];
            $tcsubmittalrv = $data[':tcsubmittalrv'];
            $tcid = $data[':tcid'];
            $cnt = self::_calculationsubmitall_updatecheck($tcproject,$tcsubmittalno,$tcsubmittalrv,$tcid);
            if($cnt !== 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Already Revision No Exists"
                );
                return json_encode($this->response);
                exit;
            }

            $sv = self::_updateCalculationApprovals($data);
            if(!$sv){
                $this->response = array(
                    "msg" => '0',
                    "data" => "Error Has found on Update data"
                );
                return json_encode($this->response);
                exit;
            }
            $rpts = self::_getProjectCalucationsApprovals($tcproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        private function _removeCalculationApprovals($tcid){
            $this->sql = "DELETE FROM pms_technical_calculations where tcid = :tcid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tcid",$tcid);
            $sv = $this->cm->execute();
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function RemoveCalculationApprovals($tcid,$tcproject){
            $rm = self::_removeCalculationApprovals($tcid);
            if(!$rm){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error Has Found Remove Data"
                );
                return json_encode($this->response);
            }
            $rpts = self::_getProjectCalucationsApprovals($tcproject);
            $this->response = array(
                "msg" => "1",
                "data" => $rpts
            );
            return json_encode($this->response);
            exit;
        }

        //? Technical Calculation Submittal End

    }
?>