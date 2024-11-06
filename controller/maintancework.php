<?php 
    class MaintanceWork{
        private $cn;
        private $cm;
        private $sql;        
        private $response = array("msg" => "1" , "data" => "empty response");

        function __construct($db)
        {
            $this->cn = $db;
        }

        private function _checkProjectno($pjcno){
            $this->sql = "SELECT COUNT(mnt_pjcno) as cnt from pms_project_maintanace where mnt_pjcno=:mnt_pjcno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":mnt_pjcno",$pjcno);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = $rows["cnt"];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }


        public function dublicateProject($pjcno){
            $cnt = (int)$this->_checkProjectno($pjcno);
            $this->response = array(
                "msg" => "1",
                "data" => $cnt
            );
            return json_encode($this->response);
            exit;
            
        }

        private function _datecheck($mdate,$fm){
            
            if(!date_create($mdate)){
                return date($fm);
            }
            return date_format(date_create($mdate),$fm);
        }

        private function _columns($rows){
            $cols = array();
            extract($rows);
            $cols["mnt_id"] = !isset($mnt_id) || trim($mnt_id) === "" ? "0" : $mnt_id;
            $cols['mnt_pjcno'] = !isset($mnt_pjcno) || trim($mnt_pjcno) === "" ? "0" : $mnt_pjcno;
            $cols['mnt_contractor'] = !isset($mnt_contractor) || trim($mnt_contractor) === "" ? "0" : $mnt_pjcno;
            $cols['mnt_contactpersion'] = !isset($mnt_contactpersion) || trim($mnt_contactpersion) === "" ? "0" : $mnt_contactpersion;
            $cols['mnt_location'] = !isset($mnt_location) || trim($mnt_location) === "" ? "0" : $mnt_location;
            $cols['mnt_region'] = !isset($mnt_region) || trim($mnt_region) === "" ? "0" : $mnt_region;
            $cols['mnt_startdate'] = !isset($mnt_startdate) || trim($mnt_startdate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_startdate,'Y-m-d');
            $cols['mnt_startdate_d'] = !isset($mnt_startdate) || trim($mnt_startdate) === "" ? date("d-M-Y") : $this->_datecheck($mnt_startdate,'d-M-Y');
            $cols['mnt_startdate_n'] = !isset($mnt_startdate) || trim($mnt_startdate) === "" ? date("d-m-Y") : $this->_datecheck($mnt_startdate,'d-m-Y');
            $cols['mnt_startdate_p'] = !isset($mnt_startdate) || trim($mnt_startdate) === "" ? date("d-m-y") : $this->_datecheck($mnt_startdate,'d-m-y');

            $cols['mnt_enddate'] =  !isset($mnt_enddate) || trim($mnt_enddate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_enddate,'Y-m-d');
            $cols['mnt_enddate_d'] =  !isset($mnt_enddate) || trim($mnt_enddate) === "" ? date("d-M-Y") : $this->_datecheck($mnt_enddate,'d-M-Y');
            $cols['mnt_enddate_n'] =  !isset($mnt_enddate) || trim($mnt_enddate) === "" ? date("d-m-Y") : $this->_datecheck($mnt_enddate,'d-m-Y');
            $cols['mnt_enddate_p'] =  !isset($mnt_enddate) || trim($mnt_enddate) === "" ? date("d-m-y") : $this->_datecheck($mnt_enddate,'d-m-y');

            $cols['mnt_warrenty'] = !isset($mnt_warrenty) || trim($mnt_warrenty) === "" ? "0" : $mnt_warrenty;
            $cols['mnt_billingtype'] = !isset($mnt_billingtype) || trim($mnt_billingtype) === "" ? "0" : $mnt_billingtype;
            $cols['mnt_pjmanager'] = !isset($mnt_pjmanager) || trim($mnt_pjmanager) === "" ? "0" : $mnt_pjmanager;
            $cols['mnt_project_foreman'] = !isset($mnt_project_foreman) || trim($mnt_project_foreman) === "" ? "0" : $mnt_project_foreman;
            $cols['mnt_project_eng'] = !isset($mnt_project_eng) || trim($mnt_project_eng) === "" ? "0" : $mnt_project_eng;
            $cols['mnt_status'] = !isset($mnt_status) || trim($mnt_status) === "" ? "0" : $mnt_status;
            $cols['mnt_closed_reson'] = !isset($mnt_closed_reson) || trim($mnt_closed_reson) === "" ? "0" : $mnt_closed_reson;

            $cols['mnt_closed_date'] = !isset($mnt_closed_date) || trim($mnt_closed_date) === "" ? date("Y-m-d") : $this->_datecheck($mnt_closed_date,'Y-m-d');
            $cols['mnt_closed_date_d'] = !isset($mnt_closed_date) || trim($mnt_closed_date) === "" ? date("d-M-Y") : $this->_datecheck($mnt_closed_date,'d-M-Y');
            $cols['mnt_closed_date_n'] = !isset($mnt_closed_date) || trim($mnt_closed_date) === "" ? date("d-m-Y") : $this->_datecheck($mnt_closed_date,'d-m-Y');
            $cols['mnt_closed_date_p'] = !isset($mnt_closed_date) || trim($mnt_closed_date) === "" ? date("d-m-y") : $this->_datecheck($mnt_closed_date,'d-m-y');

            $cols['mnt_closed_by'] = !isset($mnt_closed_by) || trim($mnt_closed_by) === "" ? "0" : $mnt_closed_by;
            $cols['mnt_cdate'] = !isset($mnt_cdate) || trim($mnt_cdate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_cdate,'Y-m-d H:I:s');
            $cols['mnt_edate'] = !isset($mnt_edate) || trim($mnt_edate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_edate,'Y-m-d H:I:s');
            $cols['mnt_cby'] = !isset($mnt_cby) || trim($mnt_cby) === "" ? "0" : $mnt_cby;
            $cols['mnt_eby'] = !isset($mnt_eby) || trim($mnt_eby) === "" ? "0" : $mnt_eby;
            $cols['projectname'] = !isset($projectname) || trim($projectname) === "" ? "0" : $projectname;
            
            return $cols;
        }

        private function _colsup($rows){
            extract($rows);
            $cols["mnt_sub_id"] = !isset($mnt_sub_id) || trim($mnt_sub_id) === "" ? "0" : $mnt_sub_id;
            $cols["mnt_sub_key"] = !isset($mnt_sub_key) || trim($mnt_sub_key) === "" ? "0" : $mnt_sub_key;
            $cols["mnt_sub_description"] = !isset($mnt_sub_description) || trim($mnt_sub_description) === "" ? "0" : $mnt_sub_description;
            $cols["mnt_sub_status"] = !isset($mnt_sub_status) || trim($mnt_sub_status) === "" ? "0" : $mnt_sub_status;
            $cols["mnt_sub_cby"] = !isset($mnt_sub_cby) || trim($mnt_sub_cby) === "" ? "0" : $mnt_sub_cby;
            $cols["mnt_sub_eby"] = !isset($mnt_sub_eby) || trim($mnt_sub_eby) === "" ? "0" : $mnt_sub_eby;

            $cols['mnt_sub_cdate'] = !isset($mnt_sub_cdate) || trim($mnt_sub_cdate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_sub_cdate,'Y-m-d H:I:s');
            $cols['mnt_sub_edate'] = !isset($mnt_sub_edate) || trim($mnt_sub_edate) === "" ? date("Y-m-d") : $this->_datecheck($mnt_sub_edate,'Y-m-d H:I:s');
            return $cols;
        }
        private function _getSubwork($sno){
            $this->sql = "SELECT *FROM pms_project_maintanace_sub where mnt_sub_key=:mnt_sub_key";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":mnt_sub_key",$sno);
            $this->cm->execute();
            $subworks = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $subwork = $this->_colsup($rows);
                $subworks[] = $subwork;
            }
            unset($this->cm,$this->sql,$rows);
            return $subworks;
        }
        private function _allProjects(){
            $this->sql = "SELECT *FROM pms_project_maintanace";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $infos = array();
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $mainwork = $this->_columns($rows);                
                $infos[] = $mainwork;
            }
            unset($this->cm,$this->sql,$rows);
            $mainworks = [];
            foreach($infos as $info){
                $work = $info;
                $sno = $info['mnt_id'];
                $work['subwork'] = $this->_getSubwork($sno);
                $mainworks[] = $work;
            }
            return $mainworks;   
        }

        public function allprojects(){
            $mainworks = $this->_allProjects();
            $this->response = array("msg" => "1","data" => $mainworks);
            return json_encode($this->response);
            exit;
        }
        
        private function _projectinfo($pjcno){
            $this->sql = "SELECT *FROM pms_project_maintanace where mnt_pjcno=:mnt_pjcno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":mnt_pjcno",$pjcno);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $infos = $this->_columns($rows);
            unset($this->cm,$this->sql,$rows);
            return $infos;
        }

        public function projecinfo($pjcno){
            $cnt = (int)$this->_checkProjectno($pjcno);
            if($cnt !== 1){
                $this->response = array(
                    "msg" => "0" , "data" => "This Project Not Found"
                );
                return json_encode($this->response);
                exit;
            }

            $mainwork = $this->_projectinfo($pjcno);
            $this->response = array("msg" => "1" , "data" => $mainwork);
            return json_encode($this->response);
            exit;
        }

        private function _addnewProject($params){
            $this->sql = "INSERT INTO pms_project_maintanace values(
                null,
                :mnt_pjcno,
                :mnt_contractor,
                :mnt_contactpersion,
                :mnt_location,
                :mnt_region,
                :mnt_startdate,
                :mnt_enddate,
                :mnt_warrenty,
                :mnt_billingtype,
                :mnt_pjmanager,
                :mnt_project_foreman,
                :mnt_project_eng,
                :mnt_status,
                :mnt_closed_reson,
                :mnt_closed_date,
                :mnt_closed_by,
                :mnt_cdate,
                :mnt_edate,
                :mnt_cby,
                :mnt_eby,
                :projectname
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $issave = $this->cm->execute($params);
            $id = 0;
            if($issave){
                $id = $this->cn->lastInsertId();
            }else{
                $id = 0;
            }
            unset($this->sql,$this->cm);
            return $id;
        }

        private function _saveProjectSup($infos,$id,$cby){
            $_date = date("Y-m-d");
            foreach($infos as $info){
                $params = array(
                    ":mnt_sub_key" => $id,
                    ":mnt_sub_description" => $info,
                    ":mnt_sub_status" => "1",
                    ":mnt_sub_cby" => $cby,
                    ":mnt_sub_eby" => $cby,
                    ":mnt_sub_cdate" => $_date,
                    ":mnt_sub_edate" => $_date
                );
                $this->sql = "INSERT INTO pms_project_maintanace_sub values(
                    null,
                    :mnt_sub_key,
                    :mnt_sub_description,
                    :mnt_sub_status,
                    :mnt_sub_cby,
                    :mnt_sub_eby,
                    :mnt_sub_cdate,
                    :mnt_sub_edate
                )";

                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->execute($params);
                unset($this->cm,$this->sql,$params);
            }
        }

        private function _singleSub($infos){
            $this->sql = "INSERT INTO pms_project_maintanace_sub values(
                null,
                :mnt_sub_key,
                :mnt_sub_description,
                :mnt_sub_status,
                :mnt_sub_cby,
                :mnt_sub_eby,
                :mnt_sub_cdate,
                :mnt_sub_edate
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $issave = $this->cm->execute($infos);
            unset($this->cm,$this->sql);
            return $issave;
        }

        public function SaveProject($infos,$sub){
            $pjcno = $infos[":mnt_pjcno"];
            $cnt = (int)$this->_checkProjectno($pjcno);
            if($cnt !== 0){
                $this->response = array("msg" =>"0" , "data" => "This Project Number Already We Have");
                return json_encode($this->response);
                exit;
            }
            $sno = (int)$this->_addnewProject($infos);
            if($sno === 0){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Save Data"
                );
                return json_encode($this->response);
                exit;
            }
            $uname = $infos[":mnt_cby"];
            $this->_saveProjectSup($sub,$sno,$uname);
            $this->response = array(
                "msg" => "1","data" => "Data has Saved"
            );
            return json_encode($this->response);
            exit;
        }

        public function saveProjectSub($infos){
            $sv = $this->_singleSub($infos);
            if(!$sv){
                $this->response = array("msg" => "0" , "data" => "Error in Save");
                return json_encode($this->response);
                exit;
            }
            $list = $this->_allProjects();
            $data = array(
                "msg" => "data has saved",
                "data" => $list
            );

            $this->response = array("msg" => "1", "data" => $data);
            return json_encode($this->response);
            exit;
        }

        private function _subUpdate($infos){
            $this->sql = "UPDATE pms_project_maintanace_sub set mnt_sub_status=:mnt_sub_status and mnt_sub_description=:mnt_sub_description where mnt_sub_id=:mnt_sub_id";
            $this->cm = $this->cn->prepare($this->sql);
            $isupdate = $this->cm->execute($infos);
            unset($this->sql,$this->cm);
            return $isupdate;
        }

        public function SubUpdate($infos){
            $sv = $this->_subUpdate($infos);
            if(!$sv){
                $this->response = array("msg" => "0" , "data" => "error on update");
                return json_encode($this->response);
                exit;
            }
            $list = $this->_allProjects();
            $data = array(
                "msg" => "data has Updated",
                "data" => $list
            );
            $this->response = array("msg" => "1" ,"data" => $data);
            return json_encode($this->response);
            exit;
        }

        private function _updateProject($infos){
            $this->sql = "UPDATE pms_project_maintanace set 
            mnt_contractor=:mnt_contractor,
            mnt_contactpersion=:mnt_contactpersion,
            mnt_location=:mnt_location,
            mnt_region=:mnt_region,
            mnt_startdate=:mnt_startdate,
            mnt_enddate=:mnt_enddate,
            mnt_warrenty=:mnt_warrenty,
            mnt_billingtype=:mnt_billingtype,
            mnt_pjmanager=:mnt_pjmanager,
            mnt_project_foreman=:mnt_project_foreman,
            mnt_project_eng=:mnt_project_eng,
            mnt_edate=:mnt_edate,
            mnt_eby=:mnt_eby,
            projectname=:projectname  
            where 
            mnt_id=:mnt_id";
            $this->cm = $this->cn->prepare($this->sql);
            $update = $this->cm->execute($infos);
            unset($this->cm,$this->sql);
            return $update;
        }

        public function UpdateProject($infos){
            $update = $this->_updateProject($infos);
            if(!$update){
                $this->response = array("msg" => "0" , "data" => "Error on Update");
                return json_encode($this->response);
                exit;
            }
            $list = $this->_allProjects();
            $res = array(
                "msg" => "Data has updated",
                "data" => $list
            );
            $this->response = array("msg" => "1" , "data" => $res);
            return json_encode($this->response);
            exit;
        }

        private function _closeStatus($infos){
            $this->sql = "UPDATE pms_project_maintanace set 
            mnt_status=:mnt_status,
            mnt_closed_reson=:mnt_closed_reson,
            mnt_closed_date=:mnt_closed_date,
            mnt_closed_by=:mnt_closed_by,
            mnt_edate=:mnt_edate,
            mnt_eby=:mnt_eby where mnt_id=:mnt_id";
            $this->cm = $this->cn->prepare($this->sql);
            $update = $this->cm->execute($infos);
            unset($this->cm,$this->sql);
            return $update;
        }

        public function CloseProjets($infos){
            $update = $this->_closeStatus($infos);
            if(!$update){
                $this->response = array(
                    "msg" =>"0",
                    "data" => "Error on Update"
                );
                return $this->response;
                exit;
            }
            $list = $this->_allProjects();
            $res = array(
                "msg" => "Data has updated",
                "data" => $list
            );
            $this->response = array("msg" => "1","data" => $res);
            return $this->response;
            exit;
        }
        
    }
?>