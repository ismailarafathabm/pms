<?php
    date_default_timezone_set('Asia/Riyadh');
    include_once('mac.php');

    class Boqitems extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $rows;

        private $notesid;
        private $notestoken;
        private $notesdescription;
        private $notesimportats;
        private $notesprojectcode;
        private $delstatus;
        const del = "1";
        function __construct($db)
        {
            $this->cn = $db;
            $this->response = array("msg" => "0", "data" => "Error");
        }

        public function Boqitemsnew($iteminfo){
            $this->sql = "INSERT INTO psm_boqnotes values(
                null,
                :notestoken,
                :notesdescription,
                :notesimportats,
                :notesprojectcode,
                :delstatus
            )";
            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($iteminfo)){
                $this->response = array("msg"=> "1","data"=>"saved");
            }else{
                $this->response = array("msg"=> "0","data"=>"databse error");
            }
            return json_encode($this->response);
            exit();
        }

        public function BoqItemsAll($notesprojectcode){
            $this->delstatus = $this->enc('enc','1');
            $this->notesprojectcode = $this->enc('enc',$notesprojectcode);
            $this->sql = "SELECT *FROM psm_boqnotes where notesprojectcode=:notesprojectcode and delstatus='$this->delstatus'";            
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":notesprojectcode", $this->notesprojectcode);            
            $this->cm->execute();
            $_notes = [];
            while($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($this->rows);
                $_notes[] = array(
                    'notesid' => $notesid,
                    'notestoken' => $notestoken,
                    'notesdescription' => $this->enc('denc',$notesdescription),
                    'notesimportats' => $this->enc('denc',$notesimportats),
                    'notesprojectcode' => $this->enc('denc',$notesprojectcode),
                    'delstatus' => $this->enc('denc',$delstatus),
                );
            }
            $this->response = array("msg" => "1", "data" => $_notes);
            return json_encode($this->response);
            exit();
        }

        public function BoqitemEdit($itmss){
            $this->sql = "UPDATE psm_boqnotes set 
                    notesdescription=:notesdescription,
                    notesimportats=:notesimportats 
                    where 
                    notesid=:notesid";
            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($itmss)){
                $this->response = array("msg"=>"1","data" => "saved");
            }else{
                $this->response = array("msg" => "0", "data" => "Error in database");
            }
            return json_encode($this->response);
            exit();
        }

        public function BoqItemRemove($id){  
            $del = $this->enc("enc",'0');
            $this->sql = "UPDATE psm_boqnotes set delstatus='$del' where notesid=:notesid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":notesid",$id);
            if($this->cm->execute()){
                $this->response = array("msg" => "1" ,"data" => "Removed");
            }else{
                $this->response = array("msg" => "0", "data" => "Database Error");
            }
            return json_encode($this->response);
            exit();
        }
    }
?>