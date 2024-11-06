<?php
    date_default_timezone_set('Asia/Riyadh');
    include_once('mac.php');
    class Suppliers extends mac{

        private $cn;
        private $cm;
        private $sql;
        private $rows;
        private $response;
        private $psm_suppliers;
        private $supplier_id;
        private $supplier_name;

        function __construct($db){
            $this->cn = $db;
            $this->psm_suppliers = mac::psm_suppliers;
            $this->response = array("msg" => "0","data" => "_Error");
        }

        public function suppliers_all(){
            $this->sql = "SELECT *FROM $this->psm_suppliers ORDER BY supplier_name ASC";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_suppliers = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_suppliers[] = array(
                    'supplier_id' => $supplier_id,
                    'supplier_name' => $this->enc('denc', $supplier_name)
                );
            }
            $this->response = array("msg" => "1", "data" => $_suppliers);
            return json_encode($this->response);
            exit();
        }

        public function supplier_new($supplier_name){
            $s = strtolower($supplier_name);
            $this->supplier_name = $this->enc('enc',$s);
            $this->sql = "SELECT *FROM $this->psm_suppliers where supplier_name=:supplier_name";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":supplier_name",$this->supplier_name);
            $this->cm->execute();
            $dub = $this->cm->rowCount() > 0 ? false : true;
            if($dub === true){
                $this->sql = "INSERT INTO $this->psm_suppliers(supplier_name) values(:supplier_name)";
                $this->cm = $this->cn->prepare($this->sql);
                $this->cm->bindParam(":supplier_name",$this->supplier_name);
                if($this->cm->execute() === true){
                     $this->response = array("msg" => "1","data" => "save");
                 }else{
                      $this->response = array("msg" => "0", "data" => "_Error in db");
                 }
            }else{
                $this->response = array("msg" => "0","data" => "Dublicate Found....");
            }
            return json_encode($this->response);
            exit();
        }
    }
?>