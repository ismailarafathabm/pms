<?php 
    class BomProps{
        private $cn;
        private $cm;
        private $sql;
        private $response;

        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array("msg" => "0","data" => "_error");
        }

        //alloy start======================================================================================================

        //check dublicate 

        private function _alloyCheck($alloy){
            $this->sql = "SELECT *FROM bom_alloy where alloyname=:alloyname";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":alloyname",$alloy);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;            
        }
        //save
        private function _alloyNew($alloy){
            $this->sql = "INSERT INTO bom_alloy values(null,:alloyname)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":alloyname",$alloy);
            $issave = $this->cm->execute();
            unset($this->cm,$this->sql);
            return $issave;
        }
        //save controller
        public function AlloySave($alloy){
            if($this->_alloyCheck($alloy) === 0){
                if($this->_alloyNew($alloy)){
                    $this->response = array("msg" => "1","data"=>"Saved");
                }else{
                    $this->response = array("msg" => "0","data"=>"Error In Database");
                }
            }else{
                $this->response = array("msg" => "0","data"=>"Dublicate Found");
            }

            return json_encode($this->response);
            exit();
        }
        //get all controller
        public function AlloyAll(){
            $this->sql = "SELECT *FROM bom_alloy order by alloyname asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $alloys = [];
            if($this->cm->rowCount() !== 0){
                while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                    extract($rows);
                    $alloys[] = array(
                        'alloyid' => $alloyid,
                        'alloyname' => strtoupper($alloyname),
                    );
                }
                $this->response = array("msg" => "1","data" => $alloys);
            }else{
                $this->response = array("msg" => "0","data" => "No Data Found");
            }
           
            unset($this->cm,$this->sql,$rows);
            return json_encode($this->response);
            exit();
        }

        //alloy end=============================================================================================

        //finish start==========================================================================================
        //get counts
        
        private function _finishCheck($finish){
            $this->sql = "SELECT *FROM bom_finish where finishcolor=:finishcolor";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":finishcolor",$finish);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;
        }
 //save
        private function _finishSave($finish){
            $this->sql = "INSERT INTO bom_finish values(null,:finishcolor)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":finishcolor",$finish);
            $issave = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $issave;
        }
 //save Controller
        public function finishSave($finish){
            if($this->_finishCheck($finish) === 0){
                if($this->_finishSave($finish)){
                    $this->response = array("msg" => "1","data" => "Saved");
                }else{
                    $this->response = array("msg" => "0","data" => "Database Error");
                }
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Found");
            }
            return json_encode($this->response);
            exit();
        }
 //get all Controller
        public function finishAll(){
            $this->sql="SELECT *FROM bom_finish order by finishcolor asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $finishcolors = [];
            if($this->cm->rowCount() !== 0){
                while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                    extract($rows);
                    $finishcolors[] = array(
                        "finishid" => $finishid,
                        "finishcolor" => strtoupper($finishcolor),
                    );
                }
                $this->response = array("msg" => "1","data" => $finishcolors);
            }else{
                $this->response = array("msg" => "0","data" => "No Data Found");
            }
            unset($rows,$this->cm,$this->sql);
            return json_encode($this->response);
            exit();
        }        
        //finish color end================================================================

        //material type====================================================================

        //check Qty

        private function _typeCheck($mtype){
            $this->sql = "SELECT *FROM bom_type where typename=:typename";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":typename",$mtype);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;
        }

        private function _typeAdd($mtype){
            $this->sql = "INSERT INTO bom_type values(null,:typename)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":typename",$mtype);
            $issave = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $issave;
        }

        public function typeSave($mtype){
            if($this->_typeCheck($mtype) === 0){
                if($this->_typeAdd($mtype)){
                    $this->response = array("msg" => "1","data" => "Saved");
                }else{
                    $this->response = array("msg" => "0","data" => "Database Error");
                }
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Found");
            }
            return json_encode($this->response);
            exit();
        }

        public function typeAll(){
            $this->sql = "SELECT *FROM bom_type order by typename asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $mtypes = [];
            if($this->cm->rowCount() !== 0){
                while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                    extract($rows);
                    $mtypes[] = array(
                        'typeid' => $typeid,
                        'typename' => ucwords(strtolower($typename)),
                    );
                }
                $this->response = array("msg" => "1","data" => $mtypes);
            }else{
                $this->response = array("msg" => "0","data" => "No Data Found");
            }
            unset($rows,$this->cm,$this->sql);
            return json_encode($this->response);
            exit();
        }

        //material type end ========================================================================

        //system
        private function _checksystemprofileno($profileno){
            $this->sql = "SELECT *FROM bom_systems where systemno=:systemno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":systemno",$profileno);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;
        }

        private function _checkSystemname($systemname){
            $this->sql = "SELECT *FROM bom_systems where systemname=:systemname";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":systemname",$systemname);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;
        }

        private function _systemNew($systemname){
            $this->sql = "INSERT INTO bom_systems values(null,:systemname)";
            $this->cm = $this->cn->prepare($this->sql);            
            $this->cm->bindParam(":systemname",$systemname);
            $issave = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $issave;
        }

        public function systemSave($systemname){
          
                if($this->_checkSystemname($systemname) === 0){
                    if($this->_systemNew($systemname)){
                        $this->response = array("msg" => "1", "data" => "Saved");
                    }else{
                        $this->response = array("msg" => "0", "data" => "Database Error");    
                    }
                }else{
                    $this->response = array("msg" => "0", "data" => "This Profile Name Already Exist");
                }
          
            return json_encode($this->response);
            exit();
        }

        private function _getProfileinfo($systemno){
            $this->sql = "SELECT *FROM bom_systems where systemno=:systemno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":systemno",$systemno);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($rows);
            $systeminfo = array(                
                "systemno" => $systemno,
                "systemname" => ucwords(strtolower($systemname)),
            );
            unset($this->cm,$this->sql,$rows);
            return $systeminfo;            
        }

        public function getSystem($systemno){
            if($this->_checksystemprofileno($systemno) === 1){
                $this->response = array("msg" => "1","data" => $this->_getProfileinfo($systemno));
            }else{
                $this->response = array("msg" => "0","data" => "No System found");
            }
            return json_encode($this->response);
            exit();
        }
        
        public function systemAll(){
            $this->sql = "SELECT *FROM bom_systems order by systemname asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            if($this->cm->rowCount() === 0){
                $this->response = array("msg" => "0", "data" => "No data found");            
            }else{
                $systems = [];
                while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                    extract($rows);
                    $systems[] = array(
                        "systemid" => $systemid,                        
                        "systemname" => ucwords(strtoupper($systemname)),
                    );
                }
                $this->response = array("msg" => "1","data" => $systems);
            }
            unset($this->cm,$this->sql,$rows);
            return json_encode($this->response);            
            exit();
        }
        //system end ===================================================================================================================

        //Unit Start ==================================================================================================================

        private function _unitCheck($unitname){
            $this->sql = "SELECT *FROM bom_units where unitname=:unitname";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":unitname",$unitname);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            unset($this->sql,$this->cm);
            return $cnt;
        }

        private function _unitAdd($unitname){
            $this->sql = "INSERT INTO bom_units values(null,:unitname)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":unitname",$unitname);
            $issave = $this->cm->execute();
            unset($this->cm,$this->sql);
            return $issave;
        }
        public function unitSave($unitname){
            if($this->_unitCheck($unitname) === 0){
                if($this->_unitAdd($unitname)){
                    $this->response = array("msg" => "1","data" => "Saved");
                }else{
                    $this->response = array("msg" => "0","data" => "Database Error");
                }
            }else{
                $this->response = array("msg" => "0","data" => "This Unit Already Exist");
            }
            return json_encode($this->response);
            exit();
        }

        public function unitsAll(){
            $this->sql = "SELECT *FROM bom_units order by unitname asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            if($this->cm->rowCount() === 0){
                $this->response = array("msg" => "0" , "data" => "No Data Found");
            }else{
                $units = [];
                while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                    extract($rows);
                    $units[] = array(
                        "unitid" => $unitid,
                        "unitname" => $unitname,
                    );
                }
                $this->response = array("msg" => "1","data" => $units);
            }

            unset($this->cm,$this->sql,$rows);
            return json_encode($this->response);
            exit();
        }

        //Unit end ==================================================================================================================

        //part function ============================================================================================================
        public function allpartfunctions(){
            $this->sql = "SELECT *FROM bom_partfunction";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $partfunction = [];

            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $partfunction[] = array(
                    'partfunction_id' => $rows['partfunction_id'],
                    'partfunction_name' => $rows['partfunction_name'],
                );
            }

            unset($this->cm,$this->sql,$rows);

            $this->response = array(
                'msg' => "1",
                'data' => $partfunction
            );
            return json_encode($this->response);
            exit();
        }
        //part function End=========================================================================================================
    }
