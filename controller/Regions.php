<?php
    include_once('mac.php');
    date_default_timezone_set('Asia/Riyadh');

    class Region extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $rows;
        private $response;

        private $pms_region;
        private $region_id;
        private $region_name;
    
        function __construct($db){
            $this->pms_region = mac::pms_region;
            $this->cn = $db;
            $this->response = array("msg" => "0", "data" => "Error");
        }

        public function NewRegion($region_name){
            $this->region_name = $this->enc('enc',$region_name);
            $this->sql = "SELECT *FROM $this->pms_region where region_name=:region_name";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":region_name",$this->region_name);
            $this->cm->execute();
            $dub = $this->cm->rowCount() === 0 ? true : false;

            if($dub === true){
                $this->sql = "INSERT INTO $this->pms_region values(null,:region_name)";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":region_name", $this->region_name);
                if($this->cm->execute()){
                    $this->response = array("msg" => "1", "data" => "Saved");
                }else{
                    $this->response = array("msg" => "0", "data" => "Error In DB");    
                }

            }else{
                $this->response = array("msg" => "0", "data" => "Dublicate Found");
            }

            return json_encode($this->response);
            exit();
        }
        public function ListRegion(){
            $this->sql = "SELECT *FROM $this->pms_region";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_regions = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_regions[] = array(
                    "region_id" => $region_id,
                    "region_name" => $this->enc('denc',$region_name),
                );
            }
            $this->response = array("msg" => "1" , "data" => $_regions);
            return json_encode($this->response);
            exit();
        }
    }

// include_once('../connection/connection.php');
// $conn = new connection();
// $db = $conn->connect();

// $region = new Region($db);
// //$reg_name = strtolower('center region');
// echo $region->ListRegion();

?>