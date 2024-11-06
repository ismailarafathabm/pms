<?php 
    require_once 'go_descriptions.php';
    class GO_BUDGET extends GO_DESCRIPTOINS{
        private function pms_glass_budget($rows){
            extract($rows);
            $cols = array();
            $cols['gbudgetid'] = !isset($gbudgetid) || trim($gbudgetid) === "" ? "0" : $gbudgetid;
            $cols['gbudgettype'] = !isset($gbudgettype) || trim($gbudgettype) === "" ? "0" : $gbudgettype;
            $cols['gbudgetglasstype'] = !isset($gbudgetglasstype) || trim($gbudgetglasstype) === "" ? "0" : $gbudgetglasstype;
            $cols['gbudgetspc'] = !isset($gbudgetspc) || trim($gbudgetspc) === "" ? "0" : $gbudgetspc;
            $cols['gbudgtickness'] = !isset($gbudgtickness) || trim($gbudgtickness) === "" ? "0" : $gbudgtickness;
            $cols['gbudgetarea'] = !isset($gbudgetarea) || trim($gbudgetarea) === "" ? "0" : $gbudgetarea;
            $cols['gbudgetbprice'] = !isset($gbudgetbprice) || trim($gbudgetbprice) === "" ? "0" : $gbudgetbprice;
            $cols['gbudgetbtotal'] = !isset($gbudgetbtotal) || trim($gbudgetbtotal) === "" ? "0" : $gbudgetbtotal;
            
            $cols['gbudgcustomval'] = !isset($gbudgcustomval) || trim($gbudgcustomval) === "" ? "0" : $gbudgcustomval;
            $cols['gbudgettotal'] = !isset($gbudgettotal) || trim($gbudgettotal) === "" ? "0" : $gbudgettotal;
            $cols['pricediff'] = !isset($pricediff) || trim($pricediff) === "" ? "0" : $pricediff;
            $cols['finalamount'] = !isset($finalamount) || trim($finalamount) === "" ? "0" : $finalamount;
            $cols['cby'] = !isset($cby) || trim($cby) === "" ? "0" : $cby;
            $cols['eby'] = !isset($eby) || trim($eby) === "" ? "0" : $eby;
            $cols['cdate'] = !isset($cdate) || trim($cdate) === "" ? date('d-M-Y') : date_format(date_create($cdate),'d-M-Y H:i:s');
            $cols['edate'] = !isset($edate) || trim($edate) === "" ? date('d-M-Y') : date_format(date_create($edate),'d-M-Y H:i:s');

            $cols['pupdate'] = !isset($pupdate) || trim($pupdate) === "" ? date('Y-m-d') : date_format(date_create($pupdate),'Y-m-d');
            $cols['pupdate_d'] = !isset($pupdate) || trim($pupdate) === "" ? date('d-M-Y') : date_format(date_create($pupdate),'d-M-Y');
            $cols['pupdate_n'] = !isset($pupdate) || trim($pupdate) === "" ? date('d-m-Y') : date_format(date_create($pupdate),'d-m-Y');
            $cols['pupdate_p'] = !isset($pupdate) || trim($pupdate) === "" ? date('d-m-y') : date_format(date_create($pupdate),'d-m-y');

            $cols['gbproject'] = !isset($gbproject) || trim($gbproject) === "" ? "0" : $gbproject;
            $cols['gbprojectname'] = !isset($gbprojectname) || trim($gbprojectname) === "" ? "0" : $gbprojectname;
            $cols['gbsupplier'] = !isset($gbsupplier) || trim($gbsupplier) === "" ? "0" : $gbsupplier;
            $cols['sbsupplierlocation'] = !isset($sbsupplierlocation) || trim($sbsupplierlocation) === "" ? "0" : $sbsupplierlocation;
            $cols['estimationflag'] = !isset($estimationflag) || trim($estimationflag) === "" ? "0" : $estimationflag;
            $cols['procurementflag'] = !isset($procurementflag) || trim($procurementflag) === "" ? "0" : $procurementflag;
            return $cols;
        }

        private function _loadprojectglassbudget($gbproject){
            $this->sql = "SELECT *FROM pms_glass_budget as gb
            left join (SELECT gopbudgetid,sum(gopglassqty) as rcqty,
            sum(gopglasstotalarea) as rcarea,
            sum(gopglasstotalamount) as totrcamount from pms_glass_order_purchase group by gopbudgetid) as go on gb.gbudgetid = go.gopbudgetid
             where gbproject = :gbproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":gbproject",$gbproject);
            $this->cm->execute();
            $gbprojectbudget = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $budget = $this->pms_glass_budget($rows);
                extract($rows);
                $budget['rcqty'] = $rcqty;
                $budget['rcarea'] = $rcarea;
                $budget['totrcamount'] = $totrcamount;
                $gbprojectbudget[] = $budget;
            }
            unset($this->cm,$this->sql,$rows);
            return $gbprojectbudget;
        }

        public function Loadprojectglassbudget($gbproject){
            $budget = $this->_loadprojectglassbudget($gbproject);
            $this->response = array(
                "msg" => "1",
                "data" => $budget,
            );
            return json_encode($this->response);
            exit;
        }

        private function _checkbudgetinfo($gbudgetid){
            $this->sql = "SELECT COUNT(gbudgetid) as cnt from pms_glass_budget where gbudgetid = :gbudgetid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":gbudgetid",$gbudgetid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($rows,$this->sql,$this->cm);
            return $cnt;
        }

        private function _budgetinfo($gbudgetid){
            $this->sql = "SELECT * from pms_glass_budget as gb inner join pms_project_summary as pr on gb.gbproject = pr.project_no where gbudgetid = :gbudgetid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":gbudgetid",$gbudgetid);
            $this->cm->execute();
            $budget = [];
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $budget = $this->pms_glass_budget($rows);
            extract($rows);
            $budget['project_id'] = $project_id;
            $budget['project_no_e'] = $project_no;
            $budget['project_no'] = $this->enc('denc',$project_no);
            $budget['project_name'] = $this->enc('denc',$project_name);
            $budget['project_cname'] = $this->enc('denc',$project_cname);
            $budget['project_location'] = $this->enc('denc',$project_location);
            $budget['Sales_Representative'] = $this->enc('denc',$Sales_Representative);
            unset($this->cm,$this->sql,$rows);
            return $budget;
        }

        public function Budgetinfo($gbudgetid){
            $cnt = $this->_checkbudgetinfo($gbudgetid);
            if($cnt !== 1){
                $this->response = array(
                    "msg" => "0",
                    "data" => "No Records Found",
                );
                return json_encode($this->response);
                exit;
            }
            $butget = $this->_budgetinfo($gbudgetid);
            $this->response = array("msg" => "1" , "data" => $butget);
            return json_encode($this->response);
            exit;
        }

        private function _savebudget($infos){
            $this->sql = "INSERT INTO pms_glass_budget values(
                null,
                :gbudgettype,
                :gbudgetglasstype,
                :gbudgetspc,
                :gbudgtickness,
                :gbudgetarea,
                :gbudgetbprice,
                :gbudgetbtotal,                
                :gbudgcustomval,
                :gbudgettotal,
                :pricediff,
                :finalamount,
                :cby,
                :eby,
                :cdate,
                :edate,
                :pupdate,
                :gbproject,
                :gbprojectname,
                :gbsupplier,
                :sbsupplierlocation,
                :estimationflag,
                :procurementflag              
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $s = $this->cm->execute($infos);
            unset($this->cm,$this->sql);
            return $s;
        }

        public function Savebudget($infos){
            //echo "main functio called";
            $gbproject = $infos[':gbproject'];
            //echo $gbproject;
            $sv = $this->_savebudget($infos);
             //echo $sv ? "ok" : "false";
            if(!$sv){
                $this->response = array("msg" => "0" , "data" => "Error on Saving Data");
                return json_encode($this->response);
                exit;
            }
            $budget = $this->_loadprojectglassbudget($gbproject);
            $this->response = array(
                "msg" => "1",
                "data" => $budget,
            );
            //print_r($this->response);
            return json_encode($this->response);
            exit;
        }

        private function _savelog($info){
            $this->sql = "INSERT INTO pms_glass_budget_log values(                
                null,
                :gbudgettype,
                :gbudgetglasstype,
                :gbudgetspc,
                :gbudgtickness,
                :gbudgetarea,
                :gbudgetbprice,
                :gbudgetbtotal,                
                :gbudgcustomval,
                :gbudgettotal,
                :pricediff,
                :finalamount,
                :cby,
                :eby,
                :cdate,
                :edate,
                :pupdate,
                :gbproject,
                :gbprojectname,
                :gbsupplier,
                :sbsupplierlocation,
                :estimationflag,
                :procurementflag,
                :budgetid
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute($info);
            unset($this->cm,$this->sql);
            return;
        }

        private function SaveLog($gbudgetid){
            $butget = $this->_budgetinfo($gbudgetid);
            $params = array(
                ':gbudgettype' => $butget['gbudgettype'],
                ':gbudgetglasstype' => $butget['gbudgetglasstype'],
                ':gbudgetspc' => $butget['gbudgetspc'],
                ':gbudgtickness' => $butget['gbudgtickness'],
                ':gbudgetarea' => $butget['gbudgetarea'],
                ':gbudgetbprice' => $butget['gbudgetbprice'],
                ':gbudgetbtotal' => $butget['gbudgetbtotal'],                
                ':gbudgcustomval' => $butget['gbudgcustomval'],
                ':gbudgettotal' => $butget['gbudgettotal'],
                ':pricediff' => $butget['pricediff'],
                ':finalamount' => $butget['finalamount'],
                ':cby' => $butget['cby'],
                ':eby' => $butget['eby'],
                ':cdate' => $butget['cdate'],
                ':edate' => $butget['edate'],
                ':pupdate' => $butget['pupdate'],
                ':gbproject' => $butget['gbproject'],
                ':gbprojectname' => $butget['gbprojectname'],
                ':sbsupplierlocation' => $butget['sbsupplierlocation'],
                ':estimationflag' => $butget['estimationflag'],
                ':procurementflag' => $butget['procurementflag'],
                ':budgetid ' => $gbudgetid,
            );
            $this->_savelog($params);
            exit;
        }

        private function _updatebudget($params){
            $this->sql = "UPDATE pms_glass_budget set 
                        gbudgettype = :gbudgettype,
                        gbudgetglasstype = :gbudgetglasstype,
                        gbudgetspc = :gbudgetspc,
                        gbudgtickness = :gbudgtickness,
                        gbudgetarea = :gbudgetarea,
                        gbudgetbprice = :gbudgetbprice,
                        gbudgetbtotal = :gbudgetbtotal,                        
                        gbudgcustomval = :gbudgcustomval,
                        gbudgettotal = :gbudgettotal,
                        pricediff = :pricediff,
                        finalamount = :finalamount,
                        eby = :eby,
                        edate = :edate,
                        pupdate = :pupdate,
                        gbsupplier = :gbsupplier,
                        sbsupplierlocation = :sbsupplierlocation 
                        where 
                        gbudgetid = :gbudgetid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function UpdateBudget($params,$gbproject){
            //save log 
            $gbudgetid = $params[':gbudgetid'];            
            //$this->SaveLog($gbudgetid);

            //update actions
            $sv = $this->_updatebudget($params);
            //echo $sv ? "ok" : "error";
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On Update",
                );
                return json_encode($this->response);
                exit;
            }

            $budget = $this->_loadprojectglassbudget($gbproject);
            $this->response = array(
                "msg" => "1",
                "data" => $budget,
            );
            return json_encode($this->response);
            exit;
        }

        private function _postEsitmationFlag($params){            
            $this->sql = "UPDATE pms_glass_budget set 
            estimationflag = :estimationflag,
            eby = :eby,
            edate = :edate,
            where 
            gbudgetid = :gbudgetid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function postEsitmationFlag($params,$gbproject){
            $this->SaveLog($params[':gbudgetid']);
            $sv = $this->_postEsitmationFlag($params);
            if(!$sv){
                $this->response = array("msg" => "0", "data" => "Error On Update Status");
                return json_encode($this->response);
                exit;
            }            
            $budget = $this->_loadprojectglassbudget($gbproject);
            $this->response = array(
                "msg" => "1",
                "data" => $budget,
            );
            return json_encode($this->response);
            exit;

        }

        private function _postProcurementFlag($params){
            $this->sql = "UPDATE pms_glass_budget set 
            procurementflag = :procurementflag,
            eby = :eby,
            edate = :edate,
            where 
            gbudgetid = :gbudgetid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function postProcurementFlag($params,$gbproject){
            $this->SaveLog($params[':gbudgetid']);
            $s = $this->_postProcurementFlag($params);
            if(!$s){
                $this->response = array("msg" => "0" , "data" => "Error on Update Status");
                return json_encode($this->response);
                exit;
            }
            $budget = $this->_loadprojectglassbudget($gbproject);
            $this->response = array(
                "msg" => "1",
                "data" => $budget,
            );
            return json_encode($this->response);
            exit;
        }
    }
?>