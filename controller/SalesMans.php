<?php 
    include_once('mac.php');
    date_default_timezone_set('Asia/Riyadh');
    class SalesMans extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $rows;
        private $response;

        private $pms_salesmans;
        private $salesman_id;
        private $salesman_code;
        private $salesman_name; 

        function __construct($db){
            $this->cn = $db;
            $this->response = array("msg" => "0","data" => "Error");
            $this->pms_salesmans = mac::pms_salesmans;
        }

        public function NewSalesMan($salesmancode,$salesmanname){
            $this->salesman_code = $this->enc('enc', $salesmancode);
            $this->salesman_name = $this->enc('enc', $salesmanname);
            $this->sql = "select *from $this->pms_salesmans where salesman_code=:salesmanname";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":salesmanname",$this->salesman_code);
            $this->cm->execute();
            $dub = $this->cm->rowCount() === 0 ? true : false;
            if($dub === true){
                $this->sql = "INSERT INTO $this->pms_salesmans values(
                    null,
                    :salesman_code,
                    :salesman_name
                )";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":salesman_code",$this->salesman_code);
                $this->cm->bindParam(":salesman_name",$this->salesman_name);
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

        public function AllSalesMan(){
            $this->sql = "SELECT *FROM $this->pms_salesmans";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_salesmans = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_salesmans[] = array(
                    "salesman_id" => $salesman_id,
                    "salesman_code" => $this->enc('denc',$salesman_code),
                    "salesman_name" => $this->enc('denc',$salesman_name)
                );
            }
            $this->response = array("msg" => "1", "data" => $_salesmans);
            return json_encode($this->response);
            exit();
        }

        public function UpdateSalesmaninfo($salesmancode, $salesmanname){
            $this->salesman_code = $this->enc('enc', $salesmancode);
            $this->salesman_name = $this->enc('enc', $salesmanname);
            $this->sql = "UPDATE $this->pms_salesmans Set salesman_name=:salesman_name where salesman_code=:salesman_code";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":salesman_name", $this->salesman_name);
            $this->cm->bindParam(":salesman_code", $this->salesman_code);            
            if($this->cm->execute()){
                $this->response = array("msg" => "1", "data" => "Updated");
            }else{
                $this->response = array("msg" => "0", "data" => "Error In Database");
            }

            return json_encode($this->response);
            exit();
        }
    }


    // include_once('../connection/connection.php');
    // $conn = new connection();
    // $db = $conn->connect();

    // $salesmans = new SalesMans($db);
    // $scode = strtolower('001a');
    // $sname = strtolower("Demo Sales Man new");
    // //echo $salesmans->NewSalesMan($scode,$sname);
    // echo $salesmans->AllSalesMan();
    // //echo $salesmans->UpdateSalesmaninfo($scode,$sname);
    
?>