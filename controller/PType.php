<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once("mac.php");
    class PType extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        //table 
        private $pms_ptype;        
        //table columns
        private $ptype_id;
        private $ptype_name;

        function __construct($db){
            $this->cn = $db;
            $this->pms_ptype = mac::pms_ptype;
            $this->reponse = array("msg" => "0", "data" => "#_ERROR");
        }

        public function all_ptypes(){
            $this->sql = "SELECT *FROM $this->pms_ptype";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_ptype = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_ptype[] = array(
                    'ptype_id' => $ptype_id,
                    'ptype_name' => $this->enc('denc',$ptype_name),
                );
            }
            $this->response = array("msg" => "1", "data" => $_ptype);
            return json_encode($this->response);
            exit();
        }

        public function new_type($ptype){          
            $this->ptype_name = $this->enc('enc',$ptype);
            $this->sql = "INSERT INTO $this->pms_ptype values(null,:ptype_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ptype_name",$this->ptype_name);
            if($this->cm->execute()){
                $this->response = array("msg" => "1","data" => "Saved");
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Found..");
            }
            return json_encode($this->response);
            exit();
        }

    }
?>