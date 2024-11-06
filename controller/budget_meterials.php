<?php 
  
    require_once 'budget_glass.php';
    class BudgetMaterials extends BudgetGlass {
        private function pms_budget_materials($rows){
            extract($rows);
            $cols = [];
            $cols['bmid'] = !isset($bmid) || trim($bmid) === "" ? '0' : $bmid;
            $cols['bmdate'] = !isset($bmdate) || trim($bmdate) === "" ? date('Y-m-d') : $bmdate;
            $cols['bmdate_d'] = !isset($bmdate) || trim($bmdate) === '' ? date('d-M-Y') : $this->_date($bmdate,'d-M-Y');
            $cols['bmdate_n'] = !isset($bmdate) || trim($bmdate) === '' ? date('d-m-Y') : $this->_date($bmdate,'d-m-Y');
            $cols['bmdate_p'] = !isset($bmdate) || trim($bmdate) === '' ? date('d-m-y') : $this->_date($bmdate,'d-m-y');
            $cols['bmrefno'] = !isset($bmrefno) || trim($bmrefno) === "" ? '0' : $bmrefno;
            $cols['bmproject'] = !isset($bmproject) || trim($bmproject) === "" ? '0' : $bmproject;
            $cols['bmtype'] = !isset($bmtype) || trim($bmtype) === "" ? '0' : $bmtype;
            $cols['bmqty'] = !isset($bmqty) || trim($bmqty) === "" ? '0' : $bmqty;
            $cols['bmeprice'] = !isset($bmeprice) || trim($bmeprice) === "" ? '0' : $bmeprice;
            $cols['bmeval'] = !isset($bmeval) || trim($bmeval) === "" ? '0' : $bmeval;
            $cols['bmdiscountval'] = !isset($bmdiscountval) || trim($bmdiscountval) === "" ? '0' : $bmdiscountval;
            $cols['bmunit'] = !isset($bmunit) || trim($bmunit) === "" ? '0' : $bmunit;
            $cols['bmcby'] = !isset($bmcby) || trim($bmcby) === "" ? '0' : $bmcby;
            $cols['bmeby'] = !isset($bmeby) || trim($bmeby) === "" ? '0' : $bmeby;            
            $cols['bmcdate'] = !isset($bmcdate) || trim($bmcdate) === '' ? date('d-M-Y') : $this->_date($bmcdate,'d-M-Y');            
            $cols['bmedate'] = !isset($bmedate) || trim($bmedate) === '' ? date('d-M-Y') : $this->_date($bmedate,'d-M-Y');
            $cols['bmmaterialtype'] = !isset($bmmaterialtype) || trim($bmmaterialtype) === "" ? '0' : $bmmaterialtype;      
            $cols['bmdiscountprice'] = !isset($bmdiscountprice) || trim($bmdiscountprice) === "" ? '0' : $bmdiscountprice;           
            $cols['budgettype'] = !isset($budgettype) || trim($budgettype) === "" ? '0' : $budgettype;          
            $txt = "Contract";
            if($cols['budgettype'] !== "1") {
                $txt = "Additionals";
            }
            $cols['budgettypetxt'] = $txt;          
            $cols['budgetNo'] = !isset($budgetNo) || trim($budgetNo) === "" ? '0' : $budgetNo;           
            
            return $cols;
        }

        private function _getbudgetmaterialsbyproject($bmproject){
            $this->sql = "SELECT *FROM pms_budget_materials where bmproject = :bmproject";
            $this->cm = $this->cn->prepare($this->sql);            
            $this->cm->bindParam(":bmproject",$bmproject);
            $this->cm->execute();
            $bms = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $bm = $this->pms_budget_materials($rows);
                $bms[] = $bm;
            }
            unset($this->sql,$this->cm,$rows);
            return $bms;
        }

        public function getbudgetMaterialsbyProjects($bmproject){
            $bms = $this->_getbudgetmaterialsbyproject($bmproject);
            $this->response = array(
                "msg" => "1",
                "data" => $bms,
            );
            return json_encode($this->response);
            exit;
        }
        
        private function _getbudgetMaterialsbyType($bmproject,$bmmaterialtype){
            $this->sql = "SELECT *FROM pms_budget_materials where bmproject = :bmproject and bmmaterialtype = :bmmaterialtype";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmproject",$bmproject);
            $this->cm->bindParam(":bmmaterialtype",$bmmaterialtype);
            $this->cm->execute();
            $budgets = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $budget = $this->pms_budget_materials($rows);
                $budgets[] = $budget;
            }
            unset($this->cm,$this->sql,$rows);
            return $budgets;
        }

        public function getbudgetMaterialsbyType($bmproject,$bmmaterialtype){
            $budgets = $this->_getbudgetMaterialsbyType($bmproject,$bmmaterialtype);
            $this->response = array(
                "msg" => "1",
                "data" => $budgets
            );
            return json_encode($this->response);
            exit();
        }
        private function _checkmbid($bmid){
            $this->sql = "SELECT COUNT(*) as cnt From pms_budget_materials where bmid = :bmid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmid",$bmid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);            
            return $cnt;
        }

        private function _getinfobudgetmaterialinfo($bmid){
            $this->sql = "SELECT *FROM pms_budget_materials where bmid = :bmid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmid",$bmid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $bms = $this->pms_budget_materials($rows);
            unset($this->cm,$this->sql,$rows);
            return $bms;
        }
        public function getbudgetmaterialbyid($bmid){
            $cnt = $this->_checkmbid($bmid);
            if($cnt !== 1){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Not Found"
                );
                return json_encode($this->response);
                exit;
            }
            $bms = $this->_getinfobudgetmaterialinfo($bmid);
            $this->response = array("msg" => "1" , "data" => $bms);
            return json_encode($this->response);
            exit;
        }

        public function automaterials(){
            $this->sql = "SELECT bmtype from pms_budget_materials group by bmtype";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $autocm = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $autocm[] = $rows['bmtype'];
            }
            unset($this->cm,$this->sql,$rows);
            $this->sql = "SELECT itemdescription FROM bom_items group by itemdescription";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $autocm[] = $rows['itemdescription'];
            }
            unset($this->cm,$this->sql,$rows);
            $this->response = array(
                "msg" => "1",
                "data" => $autocm,
            );

            return json_encode($this->response);
            exit;
        }

        private function _newBudgetmaterials($params){
            $this->sql = "INSERT INTO pms_budget_materials values(
                null,
                :bmdate,
                :bmrefno,
                :bmproject,
                :bmtype,
                :bmqty,
                :bmeprice,
                :bmeval,
                :bmdiscountval,
                :bmunit,
                :bmcby,
                :bmeby,
                :bmcdate,
                :bmedate,
                :bmmaterialtype,
                :bmdiscountprice,
                :budgettype,
                :budgetNo
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm);
            return $sv;
        }

        public function newBudgetMaterials($params) {
            $bmproject = $params[':bmproject'];

            $sv = $this->_newBudgetmaterials($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Save Data"
                );
                return json_encode($this->response);
                exit;
            }
            $bms = $this->_getbudgetmaterialsbyproject($bmproject);
            $this->response = array(
                "msg" => "1",
                "data" => $bms,
            );
            return json_encode($this->response);
            exit;
        }

        private function _updatebudgetmaterial($params){
            $this->sql = "UPDATE pms_budget_materials set 
                        bmtype = :bmtype,
                        bmqty = :bmqty,
                        bmeprice = :bmeprice,
                        bmeval = :bmeval,
                        bmdiscountval = :bmdiscountval,
                        bmunit = :bmunit,
                        bmeby = :bmeby,
                        bmedate = :bmedate,
                        bmmaterialtype = :bmmaterialtype,
                        bmdiscountprice = :bmdiscountprice,
                        budgetNo = :budgetNo  
                        where 
                        bmid = :bmid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm);
            return $sv;
        }
        public function updatebudgetmaterial($params,$bmproject){
            $sv = $this->_updatebudgetmaterial($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On updateing data"
                );
                return json_encode($this->response);
                exit;
            }

            $bms = $this->_getbudgetmaterialsbyproject($bmproject);
            $this->response = array(
                "msg" => "1",
                "data" => $bms,
            );
            return json_encode($this->response);
            exit;
            
        }

        private function pms_budget_materialorder($rows){
            extract($rows);
            $cols = [];
            $cols['bmoid'] = !isset($bmoid) || trim($bmoid) === "" ? '0' : $bmoid;
            $cols['bmodate'] = !isset($bmodate) || trim($bmodate) === "" ? date('Y-m-d'): $bmodate;
            $cols['bmodate_d'] = !isset($bmodate) || trim($bmodate) === '' ? date('d-M-Y') : $this->_date($bmodate,'d-M-Y');
            $cols['bmodate_n'] = !isset($bmodate) || trim($bmodate) === '' ? date('d-m-Y') : $this->_date($bmodate,'d-m-Y');
            $cols['bmodate_p'] = !isset($bmodate) || trim($bmodate) === '' ? date('d-m-y') : $this->_date($bmodate,'d-m-y');

            $cols['bmospplier'] = !isset($bmospplier) || trim($bmospplier) === "" ? '0' : $bmospplier;
            $cols['bmotype'] = !isset($bmotype) || trim($bmotype) === "" ? '0' : $bmotype;
            $cols['bmomtype'] = !isset($bmomtype) || trim($bmomtype) === "" ? '0' : $bmomtype;
            $cols['bmoqty'] = !isset($bmoqty) || trim($bmoqty) === "" ? '0' : $bmoqty;
            $cols['bmounit'] = !isset($bmounit) || trim($bmounit) === "" ? '0' : $bmounit;
            $cols['bmoppunit'] = !isset($bmoppunit) || trim($bmoppunit) === "" ? '0' : $bmoppunit;
            $cols['bmoval'] = !isset($bmoval) || trim($bmoval) === "" ? '0' : $bmoval;
            $cols['bmopqty'] = !isset($bmopqty) || trim($bmopqty) === "" ? '0' : $bmopqty;
            $cols['bmopval'] = !isset($bmopval) || trim($bmopval) === "" ? '0' : $bmopval;
            $cols['bmocby'] = !isset($bmocby) || trim($bmocby) === "" ? '0' : $bmocby;
            $cols['bmoeby'] = !isset($bmoeby) || trim($bmoeby) === "" ? '0' : $bmoeby;
            $cols['bmocdate'] = !isset($bmocdate) || trim($bmocdate) === '' ? date('d-M-Y H:i:s') : $this->_date($bmocdate,'d-M-Y H:i:s');
            $cols['bmoedate'] = !isset($bmoedate) || trim($bmoedate) === '' ? date('d-M-Y H:i:s') : $this->_date($bmoedate,'d-M-Y H:i:s');
            $cols['bmorefno'] = !isset($bmorefno) || trim($bmorefno) === "" ? '0' : $bmorefno;
            $cols['bmoproject'] = !isset($bmoproject) || trim($bmoproject) === "" ? '0' : $bmoproject;
            $cols['bmoorefno'] = !isset($bmoorefno) || trim($bmoorefno) === "" ? '0' : $bmoorefno;
        
            return $cols;
        }
        public function materialtypes(){
            $this->sql = "SELECT *FROM bom_type";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $types = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $types[] = $rows['typename'];
            }
            unset($this->sql,$this->cm,$rows);
            $this->response = array(
                "msg" => "1",
                "data" => $types
            );
            return json_encode($this->response);
            exit;
        }
        private function _getallmaterialorderbyproject($bmoproject){
            $this->sql = "SELECT *FROM pms_budget_materialorder where bmoproject = :bmoproject";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmoproject",$bmoproject);
            $this->cm->execute();
            $bmos = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $bmo = $this->pms_budget_materialorder($rows);
                $bmos[] = $bmo;
            }
            unset($this->sql,$this->cm,$rows);
            return $bmos;
        }

        public function getbmos($bmoproject){
            $bmos = $this->_getallmaterialorderbyproject($bmoproject);
            $this->response = array(
                "msg" => '1',
                "data" => $bmos,
            );
            return json_encode($this->response);
            exit;
        }

        private function _checkmaterialorderid($bmoid){
            $this->sql = "SELECT COUNT(*) as cnt from pms_budget_materialorder where bmoid = :bmoid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmoid",$bmoid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->sql,$this->cm,$rows);
            return $cnt;
        }

        private function _getmaterialorderinfo($bmoid){
            $this->sql = "SELECT *FROM pms_budget_materialorder where bmoid = :bmoid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":bmoid",$bmoid);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $bmo =  $this->pms_budget_materialorder($rows);
            unset($this->sql,$this->cm,$rows);
            return $bmo;
        }

        public function getbmo($bmoid){
            $cnt = $this->_checkmaterialorderid($bmoid);
            if($cnt !== 1){
                $this->response = array("msg" => "0" , "data" => "No Data Found");
                return json_encode($this->response);
                exit;
            }
            $bmo = $this->_getmaterialorderinfo($bmoid);
            $this->response = array(
                "msg" => "1",
                "data" => $bmo,
            );
            return json_encode($this->response);
            exit;
        }

        private function _savematerialorder($params){
            $this->sql = "INSERT INTO pms_budget_materialorder values(
                null,
                :bmodate,
                :bmospplier,
                :bmotype,
                :bmomtype,
                :bmoqty,
                :bmounit,
                :bmoppunit,
                :bmoval,
                :bmopqty,
                :bmopval,
                :bmocby,
                :bmoeby,
                :bmocdate,
                :bmoedate,
                :bmorefno,
                :bmoproject,
                :bmoorefno
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->sql,$this->cm,$rows);
            return $sv;
        }

        public function savebmo($params){
            $bmoproject = $params[':bmoproject'];
            $sv = $this->_savematerialorder($params);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Saving Data",
                );
                return json_encode($this->response);
                exit;
            }
            $bmos = $this->_getallmaterialorderbyproject($bmoproject);
            $this->response = array(
                "msg" => '1',
                "data" => $bmos,
            );
            return json_encode($this->response);
            exit;
        }

        private function _updatebmo($update){
            $this->sql = "UPDATE pms_budget_materialorder set 
            bmospplier = :bmospplier,
            bmotype = :bmotype,            
            bmomtype = :bmomtype,
            bmoqty = :bmoqty,
            bmounit = :bmounit,
            bmoppunit = :bmoppunit,
            bmoval = :bmoval,
            bmoeby = :bmoeby,     
            bmoedate = :bmoedate 
            where 
            bmoid = :bmoid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($update);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function UpdateBmo($update,$bmoproject){
            $sv = $this->_updatebmo($update);
            if(!$sv){
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error On update"
                );
                return json_encode($this->response);
                exit;
            }

            $bmos = $this->_getallmaterialorderbyproject($bmoproject);
            $this->response = array(
                "msg" => '1',
                "data" => $bmos,
            );
            return json_encode($this->response);
            exit;
        }

        public function bmoprint($bmoid){
            $bmo = $this->_getmaterialorderinfo($bmoid);
            $project_id = $bmo['bmoproject'];
            
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

            //sum of budget
            $this->sql = "SELECT COALESCE(SUM(bmdiscountval),0) as totbudget from pms_budget_materials where bmproject = '$project_id'";
            //echo $this->sql;
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $totbudget = $rows['totbudget'];
            $balance = (float)$totbudget - ((float)$bmo['bmoval'] + (float)$bmo['bmopval']) ;
            $sumoff = array(
                "totbudget" => $totbudget,
                'balance' => $balance
            );

            $data = array(
                "bmo" => $bmo,
                "project" => $projectinfo,
                "sumoff" => $sumoff
            );

            $this->response = array(
                "msg" => '1',
                "data" => $data
            );

            return json_encode($this->response);
            exit;
            
        }

        
       


    }
?>