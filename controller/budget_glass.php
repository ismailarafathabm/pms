<?php 
    require_once 'mac.php';
    class BudgetGlass extends mac{
        protected $cn;
        protected $sql;
        protected $cm;
        protected $response = [];

        private function pms_budget_glass($rows){
            extract($rows);
            $cols = [];
            $cols['bgid'] = !isset($bgid) || trim($bgid) === "" ? "0" : $bgid;
            $cols['bgglass'] = !isset($bgglass) || trim($bgglass) === "" ? "0" : $bgglass;
            $cols['bgarea'] = !isset($bgarea) || trim($bgarea) === "" ? "0" : $bgarea;
            $cols['bgcost'] = !isset($bgcost) || trim($bgcost) === "" ? "0" : $bgcost;
            $cols['bgtotalcost'] = !isset($bgtotalcost) || trim($bgtotalcost) === "" ? "0" : $bgtotalcost;
            $cols['bgshapedarea'] = !isset($bgshapedarea) || trim($bgshapedarea) === "" ? "0" : $bgshapedarea;
            $cols['bgshapedcost'] = !isset($bgshapedcost) || trim($bgshapedcost) === "" ? "0" : $bgshapedcost;
            $cols['bgshapedtotalcost'] = !isset($bgshapedtotalcost) || trim($bgshapedtotalcost) === "" ? "0" : $bgshapedtotalcost;
            $cols['bgprojectid'] = !isset($bgprojectid) || trim($bgprojectid) === "" ? "0" : $bgprojectid;
            $cols['bgcby'] = !isset($bgcby) || trim($bgcby) === "" ? "0" : $bgcby;
            $cols['bgeby'] = !isset($bgeby) || trim($bgeby) === "" ? "0" : $bgeby;

            $cols['bgcdate'] = !isset($bgcdate) || trim($bgcdate) === "" ? date('Y-m-d') : $bgcdate;            
            $cols['bgcdate_d'] = !isset($bgcdate) || trim($bgcdate) === '' ? date('d-M-Y') : $this->_date($bgcdate,'d-M-Y');
            $cols['bgcdate_n'] = !isset($bgcdate) || trim($bgcdate) === '' ? date('d-m-Y') : $this->_date($bgcdate,'d-m-Y');
            $cols['bgcdate_p'] = !isset($bgcdate) || trim($bgcdate) === '' ? date('d-m-y') : $this->_date($bgcdate,'d-m-y');

            $cols['bgrevisionno'] = !isset($bgrevisionno) || trim($bgrevisionno) === "" ? "0" : $bgrevisionno;            
            $cols['gbudgetglassno'] = !isset($gbudgetglassno) || trim($gbudgetglassno) === "" ? "0" : $gbudgetglassno;

            $cols["bgtype"] = !isset($bgtype) || trim($bgtype) === "" ? "0" : $bgtype;
            $txt = "Contract";
            if((string)$cols["bgtype"] !== "1"){
                $txt = "Additionals";
            }
            $cols["bgtypetxt"] = $txt;
            $cols["bgcode"] = !isset($bgcode) || trim($bgcode) === "" ? "0" : $bgcode;       
            
            return $cols;
        }
        public function AutoCompleteGlass(){
            $this->sql = "SELECT bgglass from pms_budget_glass group by bgglass";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $glass = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $glass[] = $rows['bgglass'];
            }
            unset($this->cm,$this->sql,$rows);
            $this->response = array(
                'msg' => "1",
                'data' => $glass
            );
            return json_encode($this->response);
            exit;
        }
        
        private function _getProjectGlassbudget($bgprojectid){
            $this->sql = "SELECT *FROM pms_budget_glass where bgprojectid = :bgprojectid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgprojectid",$bgprojectid);
            $this->cm->execute();
            $bgs = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $bg = $this->pms_budget_glass($rows);
                $bgs[] = $bg;
            } 
            unset($this->sql,$this->cm,$rows);
            return $bgs;
        }

        public function getProjectGlassProject($bgprojectid){
            $bgs = $this->_getProjectGlassbudget($bgprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $bgs
            );
            return json_encode($this->response);
            exit;
        }

        private function _checkprojectglassbudget($bgid){
            $this->sql = "SELECT Count(*) as cnt from pms_budget_glass where bgid = :bgid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgid",$bgid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($rows,$this->cm,$this->sql);
            return $cnt;
        }
        

        private function _getinfoProjectGlassBudget($bgid){
            $this->sql = "SELECT *FROM pms_budget_glass where bgid = :bgid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgid",$bgid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $bgs = $this->pms_budget_glass($rows);
            unset($this->sql,$this->cm,$rows);
            return $bgs;
        }

        public function GetInfoProjectGlassBudget($bgid){
            $cnt = $this->_checkprojectglassbudget($bgid);
            if($cnt !== 1){
                $this->response = array(
                    "msg" => "0",
                    "data" => "No Data Found"
                );
                return json_encode($this->response);
                exit;
            }
            $bgs = $this->_getinfoProjectGlassBudget($bgid);
            $this->response = array(
                "msg" => "1",
                "data" => $bgs
            );
            return json_encode($this->response);
            exit;
        }

        private function changeotherold($bgprojectid){
            $this->sql = "UPDATE pms_budget_glass SET bgrevisionno='O' where bgprojectid = :bgprojectid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgprojectid",$bgprojectid);
            $this->cm->execute();            
        }

        private function newglassbudget($params){
            $this->sql = "INSERT INTO pms_budget_glass values(
                null,
                :bgglass,
                :bgarea,
                :bgcost,
                :bgtotalcost,
                :bgshapedarea,
                :bgshapedcost,
                :bgshapedtotalcost,
                :bgprojectid,
                :bgcby,
                :bgeby,
                :bgcdate,
                :bgedate,
                'C',
                :gbudgetglassno,
                :bgtype,
                :bgcode
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        

        public function Saveglassbudget($params){
            $bgprojectid = $params[':bgprojectid'];
            $sv = $this->newglassbudget($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Save Data"
                );
                return json_encode($this->response);
                exit;
            }
            $bgs = $this->_getProjectGlassbudget($bgprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $bgs
            );
            return json_encode($this->response);
            exit;

        }

        private function _updateglassbudget($params){
            $this->sql = "UPDATE pms_budget_glass set 
            bgglass = :bgglass,
            bgarea = :bgarea,
            bgcost = :bgcost,
            bgtotalcost = :bgtotalcost,
            bgshapedarea = :bgshapedarea,
            bgshapedcost = :bgshapedcost,
            bgshapedtotalcost = :bgshapedtotalcost,
            bgeby = :bgeby,
            bgedate = :bgedate,
            gbudgetglassno = :gbudgetglassno,
            bgcode = :bgcode 
            where 
            bgid = :bgid";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function UpdateGlassBudget($params,$bgprojectid){
            $update = $this->_updateglassbudget($params);
            if(!$update){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Udpate"
                );
                return json_encode($this->response);
                exit;
            }
            $bgs = $this->_getProjectGlassbudget($bgprojectid);
            $this->response = array(
                "msg" => "1",
                "data" => $bgs
            );
            return json_encode($this->response);
            exit;
        }

        // private function _getGlassinfo($bgid){
        //     $this->sql = "SELECT *FROM pms_budget_glass where bgid = :bgid";
        //     $this->cm = $this->cn->prepare($this->sql);
        //     $this->cm->bindParam(":bgid",$bgid);
        //     $this->cm->execute();
        //     $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        // }


        //update 0 Pending 

        public function gobudgettotalarea($bgprojectid){
            $this->sql = "SELECT COALESCE(SUM(bgarea),0) as area,COALESCE(sum(bgshapedarea),0) as sarea from pms_budget_glass where bgprojectid = :bgprojectid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgprojectid",$bgprojectid);            
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $area = (float)$rows['area'];
            $sarea = (float)$rows['sarea'];
            $tarea = $area + $sarea;
            unset($this->sql,$this->cm,$rows);
            $this->response = array(
                "msg" => '1',
                "data" => $tarea
            );
            return json_encode($this->response);
            exit;
            
        }
        //glass order approvals 

        private function pms_budget_glassorder($rows){
            extract($rows);
            $cols = [];
            $cols['bgoid'] = !isset($bgoid) || trim($bgoid) === '' ? '0' : $bgoid;
            
            $cols['bgodate'] = !isset($bgodate) || trim($bgodate) === '' ? '0' : $bgodate;
            $cols['bgodate_d'] = !isset($bgodate) || trim($bgodate) === '' ? date('d-M-Y') : $this->_date($bgodate,'d-M-Y');
            $cols['bgodate_n'] = !isset($bgodate) || trim($bgodate) === '' ? date('d-m-Y') : $this->_date($bgodate,'d-m-Y');
            $cols['bgodate_p'] = !isset($bgodate) || trim($bgodate) === '' ? date('d-m-y') : $this->_date($bgodate,'d-m-y');

            $cols['bgotype'] = !isset($bgotype) || trim($bgotype) === '' ? '0' : $bgotype;
            $cols['bgoproject'] = !isset($bgoproject) || trim($bgoproject) === '' ? '0' : $bgoproject;
            $cols['bgogorefno'] = !isset($bgogorefno) || trim($bgogorefno) === '' ? '0' : $bgogorefno;
            $cols['bgogoqty'] = !isset($bgogoqty) || trim($bgogoqty) === '' ? '0' : $bgogoqty;
            $cols['bgoval'] = !isset($bgoval) || trim($bgoval) === '' ? '0' : $bgoval;            
            $cols['bgocby'] = !isset($bgocby) || trim($bgocby) === '' ? '0' : $bgocby;
            $cols['bgoeby'] = !isset($bgoeby) || trim($bgoeby) === '' ? '0' : $bgoeby;
            $cols['bgocdate'] = !isset($bgocdate) || trim($bgocdate) === '' ? date('d-M-Y H:i:s') : $this->_date($bgocdate,'d-M-Y H:i:s');
            $cols['bgoedate'] = !isset($bgoedate) || trim($bgoedate) === '' ? date('d-M-Y H:i:s') : $this->_date($bgoedate,'d-M-Y H:i:s');
            $cols['bgoppsqm'] = !isset($bgoppsqm) || trim($bgoppsqm) === '' ? '0' : $bgoppsqm;
            $cols['suppliername'] = !isset($suppliername) || trim($suppliername) === '' ? '0' : $suppliername;
            $cols['bgopsqm'] = !isset($bgopsqm) || trim($bgopsqm) === '' ? '0' : $suppliername;
            $cols['bgobsqm'] = !isset($bgobsqm) || trim($bgobsqm) === '' ? '0' : $bgobsqm;

            $cols['refno'] = date_format(date_create($bgodate),'Ymd') . "-" .$bgoid; 
            return $cols;
        }

        private function _allGoApprovalsForProject($bgoproject){
            $this->sql = "SELECT *FROM pms_budget_glassorder where bgoproject = :bgoproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgoproject",$bgoproject);
            $this->cm->execute();
            $bgos = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $bgo = $this->pms_budget_glassorder($rows);
                $bgos[] = $bgo;
            }
            unset($this->sql,$this->cm,$rows);
            return $bgos;
        }

        public function AllGoApprovalsForProject($bgoproject){
            $bgos = $this->_allGoApprovalsForProject($bgoproject);
            $this->response = array(
                "msg" => "1",
                "data" => $bgos
            );
            return json_encode($this->response);
            exit;
        }

        public function sumgobudgetotalarea($bgoproject){
            $this->sql = "SELECT COALESCE(SUM(bgogoqty),0) as totsqm from pms_budget_glassorder where bgoproject = :bgoproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgoproject",$bgoproject);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $totsqm = $rows['totsqm'];
            unset($this->sql,$this->cm,$rows);
            $this->response = array(
                "msg" => "1",
                "data" => $totsqm
            );
            return json_encode($this->response);
            exit;
        }

        private function _newGoApprovals($params){
            $this->sql = "INSERT INTO pms_budget_glassorder values(
                null,
                :bgodate,
                :bgotype,
                :bgoproject,
                :bgogorefno,
                :bgogoqty,
                :bgoval,
                :bgocby,
                :bgoeby,
                :bgocdate,
                :bgoedate,
                :bgoppsqm,
                :suppliername,
                :bgopsqm,
                :bgobsqm
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm);
            return $sv;
        }

        public function NewGoApprovals($params){
            $bgoproject = $params[':bgoproject'];
            $sv = $this->_newGoApprovals($params);
            if(!$sv){
                $this->response = array("msg" => "0" , "data" => "Error on Save Data");
                return json_encode($this->response);                
                exit;
            }

            $bgos = $this->_allGoApprovalsForProject($bgoproject);
            $this->response = array(
                "msg" => "1",
                "data" => $bgos
            );
            return json_encode($this->response);
            exit;
        }


        public function glassapprovalsprint($bgoid){
            $this->sql = "SELECT *FROM pms_budget_glassorder where bgoid = :bgoid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bgoid",$bgoid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $bgo = $this->pms_budget_glassorder($rows);
            $cid = $bgo['bgoid'];
            unset($rows,$this->sql,$this->cm);
            $project_id = $bgo['bgoproject'];
            $this->sql = "SELECT project_no,project_name,project_cname,
                                    project_location,Sales_Representative from
                                    pms_project_summary where project_id= '$project_id'";
            //echo $this->sql;
            $this->cm = $this->cn->prepare($this->sql);

            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $projectinfo = array(
                "project_no" => $this->enc('denc',$rows['project_no']),
                "project_name" => $this->enc('denc',$rows['project_name']),
                "project_cname" => $this->enc('denc',$rows['project_cname']),
                "project_location" => $this->enc('denc',$rows['project_location']),
                "Sales_Representative" => $this->enc('denc',$rows['Sales_Representative']),
            );
            unset($rows,$this->sql,$this->cm);

            $this->sql = "SELECT COALESCE(SUM(bgarea),0) as area,COALESCE(SUM(bgshapedarea),0) as sarea,
                        COALESCE(SUM(bgtotalcost),0) as total,COALESCE(SUM(bgshapedtotalcost),0) as stotal from pms_budget_glass where bgprojectid = '$project_id'";
           // echo $this->sql;
            $this->cm = $this->cn->prepare($this->sql);
            
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $budget = array(
                'area' => $rows['area'],
                'sarea' => $rows['sarea'],
                'total' => $rows['total'],
                'stotal' => $rows['stotal'],
            );
            unset($rows,$this->sql,$this->cm);

            //previous orders 

            $this->sql = "SELECT COALESCE(SUM(bgoval),0) as topv from pms_budget_glassorder where bgoproject = '$project_id' and bgoid < '$cid'";
            
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $prev = $rows['topv'];
            $bgo['topv'] = $prev;
            $totbudget = (float)$budget['total'] + (float)$budget['stotal'];
            $budget['totbudget'] = $totbudget;
            $balance = $totbudget - ((float) $prev + (float)$bgo['bgoval']);
            $bgo['balance'] = $balance;
            $data = array(
                "bgo" => $bgo,
                "project" => $projectinfo,
                "budget"  => $budget
            );

            $this->response = array(
                "msg" => "1",
                "data" => $data
            );

            return json_encode($this->response);
            exit;            
        }

        
    }
?>