<?php 
    date_default_timezone_set('Asia/Riyadh');
    include_once("mac.php");
    class SystemFinish extends mac{
        private $cn;
        private $cm;
        private $rows;
        private $sql;
        private $response;

        //table name
        private $pms_finish;
        //table column
        private $finish_id;
        private $finish_name;

        function __construct($db){
            $this->cn = $db;
            $this->pms_finish = mac::pms_finish;
            $this->reponse = array("msg" => "0", "data" => "#_ERROR");
        }

        public function all_sysFinish(){
            $this->sql = "SELECT *FROM $this->pms_finish";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_sysFinish = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_sysFinish[] = array(
                    'finish_id' => $finish_id,
                    'finish_name' => $this->enc('denc',$finish_name),
                );  
            }
            $this->response = array("msg" => "1", "data" => $_sysFinish);
            return json_encode($this->response);
            exit();
        }

        public function save_sysFinish($sysfinish){
            $this->finish_name = $this->enc('enc',$sysfinish);
            $this->sql = "INSERT INTO $this->pms_finish values(null,:finish_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":finish_name",$this->finish_name);
            if($this->cm->execute()){
                $this->response = array("msg" => "1","data" => "saved.");
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Entry....");
            }
            return json_encode($this->response);
            exit();
        }
    }
?>