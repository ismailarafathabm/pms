<?php 
    require_once 'mac.php';
    class MasterLog extends mac{
        private $cn,$cm,$sql,$response;
        function __construct($db)
        {
            $this->response = array("msg" => '0' , "data" => "_error");
            $this->cn = $db;
        }

        private function LoadRpt(){
            $data = [];
            $this->response = array("msg" => "0" , "data" => $data);
        }

        private function _AllUnits(){
            $this->sql = "SELECT *FROM pms_ml_units";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $units = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){                
                $unit = $this->unitcols($rows);
                $units[] = $unit;
            }
            return $units;
        }

        public function AllUnits(){
            $units = $this->_AllUnits();
            // $this->response = array("msg" => "1" , "data" => $units);
            return json_encode(array("msg" => "1" , "data" => $units));exit;
            
        }
        private function _UnitsCheck($unitdesc){
            $this->sql = "SELECT COUNT(unitdesc) as cnt FROM pms_ml_units WHERE unitdesc=:unitdesc";
            $this->cm = $this->cn->prepare($this->sql);
            $_unitdesc = strtolower($unitdesc);
            $this->cm->bindParam(":unitdesc",$_unitdesc);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        private function _UnitsCheckupdate($unitid,$unitdesc){
            $this->sql = "SELECT COUNT(unitdesc) as cnt FROM pms_ml_units WHERE unitdesc=:unitdesc and unitid<>:unitid";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ":unitdesc" => strtolower($unitdesc),
                ":unitid" => $unitid,
            );            
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        private function _SaveUnits($params){
            $this->sql = "INSERT INTO pms_ml_units values(
                null,
                :unitdesc,
                :calcby,
                :unitdisplay
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $s = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $s;
        }

        public function SaveUnits($params){
            $unitdesc = strtolower($params[":unitdesc"]);
            $cnt = $this->_UnitsCheck($unitdesc);
            if($cnt !== 0){$this->response = array("msg" => "0" , "data" => "Already Exist");return json_encode($this->response);exit;}
            $s = $this->_SaveUnits($params);
            if(!$s){$this->response = array("msg" => "0" , "data" => "Error On Saving Data");return json_encode($this->response);exit;}
            $units = $this->_AllUnits();
            return json_encode(array("msg" => "1" , "data" => $units));exit;
        }

        private function _UnitUpdate($params){
            $this->sql = "UPDATE pms_ml_units set 
            unitdesc=:unitdesc,
            calcby=:calcby,
            unitdisplay=:unitdisplay 
            where 
            unitid=:unitid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql,$rows);
            return $sv;
        }

        public function UnitUpdate($params){
            $unitid = $params[":unitid"];
            $unitdesc = $params[":unitdesc"];
            $cnt = $this->_UnitsCheckupdate($unitid,$unitdesc);
            if($cnt !== 0)  { return json_encode(array("msg" => "0" , "data" => "This Unit Already Exist"));exit; }
            $sv = $this->_UnitUpdate($params);
            if(!$sv){ return json_encode(array("msg" => "0" , "data" => "Error on Update Data"));exit; }
            return json_encode(array("msg" => "1", "data" => $this->_AllUnits()));exit;
        }

        private function unitcols($rows){
            extract($rows);
            $unit = array(
                "unitid" => $unitid,
                "unitdesc" => $unitdesc,
                "calcby" => $calcby,
                "unitdisplay" => $unitdisplay,
            );
            return $unit;
        }
        private function _UnitInfoGet($unitdesc){
            $this->sql = "SELECT * FROM pms_ml_units WHERE unitdesc=:unitdesc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":unitdesc",$unitdesc);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);            
            $unit = $this->unitcols($rows);
            unset($this->cm,$this->sql,$rows);
            return $unit;
        }

        public function UnitInfoGet($unitdesc){
            $cnt = $this->_UnitsCheck($unitdesc);
            if($cnt !== 1) {  return json_encode(array("msg" => "0" , "data" => "No Data Found"));exit; }
            return json_encode(array("msg" => "1" , "data" => $this->_UnitInfoGet($unitdesc)));exit;
        }


        private function SystemCols($rows){
            extract($rows);
            $system = array(
                "systemid" => $systemid,
                "systemname" => $systemname,
                "systemprocurement" => $systemprocurement,
                "systemesimation" => $systemesimation,
                "totaldays" => $totaldays,
                "systemnamedisplay" => $systemnamedisplay,
            );
            return $system;
        }
        private function _AllSystems(){
            $this->sql = "SELECT *FROM pms_ml_systems order by systemname asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $systems = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $system = $this->SystemCols($rows);
                $systems[] = $system;
            }
            return $systems;
        }

        public function AllSystems(){
            return json_encode(array("msg" => "1" , "data" => $this->_AllSystems()));exit;
        }

        private function _SystemCheck($systemname){
            $this->sql = "SELECT COUNT(systemname) as cnt FROM pms_ml_systems where systemname=:systemname";
            $this->cm = $this->cn->prepare($this->sql);
            $n = strtolower($systemname);
            $this->cm->bindParam(":systemname",$n);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        private function _SaveSystemInfo($params){
            $this->sql = "INSERT INTO pms_ml_systems values(
                null,
                :systemname,
                :systemprocurement,
                :systemesimation,
                :totaldays,
                :systemnamedisplay
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function SaveSystemInfo($params){
            $systemname = strtolower($params[':systemname']);
            $cnt = $this->_SystemCheck($systemname);
            if($cnt !== 0 ){ return json_encode(array("msg"=>"0" ,"data" => "This System Already Exist"));exit;}
            $sv = $this->_SaveSystemInfo($params);
            if(!$sv){return json_encode(array("msg" => "0","data" => "Error On Save New System"));exit;}
            $systems = $this->_AllSystems();
            return json_encode(array('msg' => '1','data' => $systems));exit;
        }

        private function _SystemCheckUpdate($systemid,$systemname){
            $this->sql = "SELECT COUNT(systemname) as cnt FROM pms_ml_systems where systemname=:systemname and systemid<>:systemid";
            $this->cm = $this->cn->prepare($this->sql);
            $params = array(
                ":systemname" => strtolower($systemname),
                ":systemid" => $systemid
            );
            
            $this->cm->execute($params);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = $rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;
        }

        private function _SystemUpdate($params){
            $this->sql = "UPDATE pms_ml_systems SET 
                systemname = :systemname,
                systemprocurement = :systemprocurement,
                systemesimation = :systemesimation,
                totaldays = :totaldays,
                systemnamedisplay = :systemnamedisplay 
                where 
                systemid = :systemid";
            $this->cm = $this->cn->prepare($this->sql);
            $s = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $s;
        }

        public function SystemUpdate($params){
            $systemid = $params[':systemid'];
            $systemname = $params[':systemname'];
            $cnt = $this->_SystemCheckUpdate($systemid,$systemname);
            if($cnt === 0){ return json_encode(array('msg' => '0' , 'data' => "This System Already Exist"));exit; }
            $sv = $this->_SystemUpdate($params);
            if(!$sv) { return json_encode(array("msg" => "0","data" => "Error On Update System"));exit; }
            $systems = $this->_AllSystems();return json_encode(array('msg'=>"1","data"=>$systems));exit;
        }

        private function _SystemInfoget($systemname){
            $this->sql = "SELECT *FROM pms_ml_systems WHERE systemname=:systemname";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":systemname",$systemname);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);            
            $system = $this->SystemCols($rows);
            unset($this->cm,$this->sql,$rows);
            return $system;
        }

        public function SystemGet($systemname){    
            $cnt = $this->_SystemCheck($systemname);
            if($cnt !== 1){ return json_encode(array('msg' => "0" , "data" => "No Result Found"));exit;}
            return json_encode(array("msg" => "1", "data" => $this->_SystemInfoget($systemname)));exit;
        }

        private function _CheckTradeGroup($tgroupname){
            $this->sql = "SELECT COUNT(*) as cnt FROM pms_ml_tradegroup where tgroupname=:tgroupname";
            $this->cm = $this->cn->prepare($this->sql);
            $params = strtolower($tgroupname);
            $this->cm->bindParam(":tgroupname",$params);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->sql,$this->cm,$rows);
            return $cnt;
        }

        private function _SaveTradeGroup($tgroupname){            
            $this->sql = "INSERT INTO pms_ml_tradegroup values(null,:tgroupname)";
            $this->cm = $this->cn->prepare($this->sql);
            $param = strtolower($tgroupname);
            $this->cm->bindParam(":tgroupname",$param);
            $this->cm->execute();
            unset($this->cm,$this->sql);
        }

        private function AutoSaveTradeGroup($tgroupname){
            $cnt = $this->_CheckTradeGroup($tgroupname);
            if($cnt === 0){$this->_SaveTradeGroup($tgroupname);}return;
        }

        private function _TradeGroupAll(){
            $this->sql = "SELECT *FROM pms_ml_tradegroup order by tgroupname asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $tradegroups =[];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $tradegroups[] = array(
                    "tgroupid" => $rows['tgroupid'],
                    "tgroupname" => $rows['tgroupname'],
                );
            }
            unset($this->cm,$this->sql,$rows);
            return $tradegroups;
        }

        public function TradeGroupAll(){
            return json_encode(array("msg" => "1" , "data" => $this->_TradeGroupAll()));exit;
        }

        private function TradeCols($rows){
            extract($rows);
            $trade = array(
                "tradeid" => $tradeid,
                "tradename" => $tradename,
                "tradedisplayname" => $tradedisplayname,
                "engperday" => $engperday,
                "productionperday" => $productionperday,
                "installperday" => $installperday,
                "unitkey" => $unitkey,
                "groupname" => $groupname,
                
                "unitid" => $unitid,
                "unitdesc" => $unitdesc,
                "calcby" => $calcby,
                "unitdisplay" => $unitdisplay, 
            );
            return $trade;
        }

        private function _TradesAll(){
            $this->sql = "SELECT *FROM pms_ml_trades as tr 
                        inner join unitdesc as un 
                        on tr.unitkey=un.unitid 
                        order by tradename asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $trades = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){                
                $trade = $this->TradeCols($rows);
                $trades [] = $trade;
            }
            return $trades;
        }

        public function TradesAll(){
            return json_encode(array("msg" => "1","data" => $this->_TradesAll()));exit;
        }

        private function _TradeCheck($tradename){
            $this->sql = "SELECT COUNT(tradename) as cnt FROM pms_ml_trades WHERE tradename=:tradename";
            $this->cm = $this->cn->prepare($this->sql);
            $params = strtolower($tradename);
            $this->cm->bindParam(":tradename",$params);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;exit;
        }

        private function _TradeCheckUpdate($tradeid,$tradename){            
            $this->sql = "SELECT COUNT(tradename) as cnt FROM pms_ml_trades WHERE tradename=:tradename and tradeid<>:tradeid";
            $this->cm = $this->cn->prepare($this->sql);
            $params = strtolower($tradename);
            $this->cm->bindParam(":tradename",$params);
            $this->cm->bindParam(":tradeid",$tradeid);
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $cnt = (int)$rows['cnt'];
            unset($this->cm,$this->sql,$rows);
            return $cnt;exit;
        }

        private function _TradeInfoGet($tradename){
            $this->sql = "SELECT * FROM pms_ml_trades WHERE tradename=:tradename";
            $this->cm = $this->cn->prepare($this->sql);
            $params = strtolower($tradename);
            $this->cm->bindParam(":tradename",$params);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $trade = $this->TradeCols($rows);
            unset($this->cm,$this->sql,$rows);
            return $trade;
        }

        public function TradeInfoGet($tradename){
            $cnt = $this->_TradeCheck($tradename);
            if($cnt === 0){ return json_encode(array("msg"=>"0","data"=>"No data Found"));exit; }
            return json_encode(array("msg" => "1", "data" => $this->_TradeInfoGet($tradename)));
        }

        private function _SaveTrade($params){
            $this->AutoSaveTradeGroup($params[':groupname']);
            $this->sql = "INSERT INTO pms_ml_trades values(
                null,
                :tradename,
                :tradedisplayname,
                :engperday,
                :productionperday,
                :installperday,
                :unitkey,
                :groupname
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function TradeSave($params){
            $tradename = $params[":tradename"];
            $cnt = $this->_TradeCheck($tradename);
            if($cnt !== 0){ return json_encode(array("msg" => '0' , "data" => "This Trade Name Already Exist")); exit; }
            $sv = $this->_SaveTrade($params);
            if(!$sv){ return json_encode(array("msg" => "0","data" => "Error On Save New Trade"));exit; }            
            return json_encode(array("msg" => "1", "data" => $this->_TradesAll()));exit;
        }

        private function _UpdateTrade($params){
            $this->AutoSaveTradeGroup($params[':groupname']);
            $this->sql = "UPDATE pms_ml_trades SET 
            tradename = :tradename,
            tradedisplayname = :tradedisplayname,
            engperday = :engperday,
            productionperday = :productionperday,
            installperday = :installperday,
            unitkey = :unitkey,
            groupname=:groupname 
            where 
            tradeid = :tradeid";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($params);
            unset($this->cm,$this->sql);
            return $sv;
        }

        public function UpdateTrade($params){
            $tradeid = $params[":tradeid"];
            $tradename = $params[":tradename"];
            $cnt = $this->_TradeCheckUpdate($tradeid,$tradename);
            if($cnt !== 0){ return json_encode(array("msg" => "0" , "data" => "This Trade Name Already Exist Another Row"));exit; }
            $update = $this->_UpdateTrade($params);
            if(!$update){ return json_encode(array("msg" => "0", "data" => "Error Found On Update Trade"));exit; }
            return json_encode(array("msg"=>"1","data"=>$this->_TradesAll()));exit;
        }
    }
