<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once('mac.php');
    class Units extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        //unit table

        private $pms_units;

        //columns
        private $uint_id;
        private $unit_name;
        
        //constructor 

        function __construct($db){
            $this->cn = $db;
            $this->pms_units = mac::pms_units;
            $this->response = array("msg" => "0", "data" => "#_ERROR");
        }

        public function new_unit($unit_name){            
            $this->unit_name = $this->enc('enc',$unit_name);
            $this->sql = "insert into $this->pms_units values(
                null,
                :unit_name
            )";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":unit_name",$this->unit_name);
            if($this->cm->execute()){
                $this->response = array("msg" => "1", "data" => "saved");
            }else{
                $this->response = array("msg" => "0", "data" => "#_Dublicate Found");
            }
            return json_encode($this->response);
            exit();
        }

        public function all_units(){
            $this->sql = "select *from $this->pms_units";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_unit = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_unit[] = array(
                    "uint_id" => $uint_id,
                    "unit_name" => $this->enc('denc',$unit_name),
                );
            }
            $this->response = array("msg" => "1", "data" => $_unit);
            return json_encode($this->response);
            exit();
        }
    }
?>