<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once('mac.php');
    class ApprovalType extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        private $pms_approval_types;
        private $approval_type_id;
        private $approval_type_name;

        function __construct($db){
            $this->cn = $db;
            $this->pms_approval_types = mac::pms_approval_types;
            $this->response = array("msg" => "0", "data" => "#_ERROR");
        }

        public function new_approval_type($approval_name){
            $this->approval_type_name = $this->enc('enc',strtolower($approval_name));

            $this->sql = "INSERT INTO $this->pms_approval_types values(null,:approval_type_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(':approval_type_name',$this->approval_type_name);
            if($this->cm->execute()){
                $this->response = array("msg" => "1", "data" => "saved");
            }else{
                $this->response = array("msg" => "0", "data" => "Dublicate Found");
            }
            return json_encode($this->response);
            exit();
        }

        public function all_approval_type(){
            $this->sql = "SELECT *From $this->pms_approval_types order by approval_type_id asc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_approval_types = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);               

                $_approval_types[] = array(
                    "approval_type_id" => $approval_type_id,
                    "approval_type_name" =>ucwords(strtolower($this->enc('denc',$approval_type_name))),
                );
            }
            $this->response = array("msg" => "1", "data" => $_approval_types);
            return json_encode($this->response);
            exit();
        }

        public function update_approval_type($approval_id,$approval_type){
            $this->approval_type_id = $approval_id;
            $this->approval_type_name = $this->enc('enc',strtolower($approval_type));
            $this->sql = "UPDATE $this->pms_approval_types SET approval_type_name=:approval_type_name where approval_type_id=:approval_type_id";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":approval_type_name",$this->approval_type_name);
            $this->cm->bindParam(":approval_type_id",$this->approval_type_id);
            if($this->cm->execute()){
                $this->response = array("msg" => "1", "data" => "Updated...");
            }else{
                $this->response = array("msg" => "0", "data" => "Dublicate Found");
            }
            return json_encode($this->response);
            exit();
        }
    }
