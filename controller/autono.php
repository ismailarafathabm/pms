<?php 
    class AutoNum{
        private $cn;
        private $cm;
        private $sql;
        private $response;
        
        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array(
                "msg" => "0",
                "data" => "_Error"
            );
        }

        private function _getRow($tablename){
            //echo "SELECT *FROM auto_num where tablename='".$tablename."'";
            $this->sql = "SELECT *FROM auto_num where tablename=:tablename";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tablename",$tablename);
            $this->cm->execute();           
            $cnt = $this->cm->rowCount();
            unset($this->cm,$this->sql);
            return $cnt;
        }

        private function _getLastno($tablename){
            $this->sql = "SELECT *FROM auto_num where tablename=:tablename";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":tablename",$tablename);
            $this->cm->execute();            
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $rcnt = $rows['lastno'];
            unset($this->rows,$this->cm);
            return $rcnt;
        }

        public function updateLastno($tablename,$rcnt){
            $this->sql = "UPDATE auto_num set lastno=:lastno where tablename=:tablename";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":lastno",$rcnt);
            $this->cm->bindParam(":tablename",$tablename);           
            $this->cm->execute();            
        }
        private function _newTableadd($tablename){
            $this->sql = "INSERT INTO auto_num values(
                null,
                :auto_num,
                :tablename,
                :f
            )";

            $params = array(
                ":auto_num" => "1",
                ":tablename" => $tablename,
                ":f" => 'P'
            );

            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute($params);
            unset($this->cm,$this->sql,$params);
        }

        public function getNewNumber($tablename){
           // echo $this->_getRow($tablename);
            if($this->_getRow($tablename) === 0){
                $no = 1;
                $this->_newTableadd($tablename);                              
            }else {
                $_no = $this->_getLastno($tablename);
                $no = (int)$_no + 1;
                $this->updateLastno($tablename,$no);
                $this->response = array(
                    'msg' => "1",
                    'data' => $no,
                );  
            }
            return $no;            
        }
    }
?>