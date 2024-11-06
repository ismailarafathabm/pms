<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once("mac.php");
    class SystemType extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        //table name 
        private $pms_systemtype;

        //table columns
        private $system_type_id;
        private $system_type_name;

        function __construct($db){
            $this->cn = $db;
            $this->pms_systemtype = mac::pms_systemtype;
            $this->reponse = array("msg" => "0", "data" => "#_ERROR");
        }

        public function all_systemtype(){
            $this->sql = "SELECT *FROM $this->pms_systemtype";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_sysType = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_sysType[] = array(
                    'system_type_id' => $system_type_id,
                    'system_type_name' => $this->enc('denc',$system_type_name),
                );
            }   
            $this->response = array("msg" => "1", "data" => $_sysType);
            return json_encode($this->response);
            exit();
        }

        public function new_systemType($sysType){
            $this->system_type_name = $this->enc('enc',$sysType);
            $this->sql = "INSERT INTO $this->pms_systemtype values(
                null,
                :system_type_name
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":system_type_name",$this->system_type_name);
            if($this->cm->execute()){
                $this->response = array("msg" => "1","data" => "Saved");
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Entry....");
            }

            return json_encode($this->response);
            exit();
        }
    }
?>