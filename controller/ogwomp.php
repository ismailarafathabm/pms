<?php 
    require_once 'mac.php';

    class Ogwomp extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $response;
        
        function __construct($db){
            $this->cn = $db;
            $this->response = array('msg' => "0" , 'data' => "_Error");
        }

        public function OgNewEntery($newprojects){
            $this->sql = "INSERT INTO pms_ogpwmp values(
                null,
                :pno,
                :pname,
                :plocation,
                :pregion,
                :psigndate,
                :pduratioin,
                :expirydate,
                :exteneddate,
                :reson,
                :cdate,
                :edate,
                :cby,
                :eby,
                :mdate
            )";

            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($newprojects)){
                $this->response = array('msg' => "1",'data' => "Saved");
            }else{
                $this->response = array('msg' => "0", 'data' => "Database Error");
            }

            return json_encode($this->response);
            exit();
        }

        public function OgGetInfo($mdate){
            $this->sql = "SELECT *FROM pms_ogpwmp where mdate=:mdate";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":mdate",$mdate);
            $this->cm->execute();
            $_plist = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $_mdate = date_create($rows['mdate']);
                $mdate = date_format($_mdate,'Y-m-d');
                $mdate_d = date_format($_mdate,'d-M-Y');
                $mdate_n = date_format($_mdate,'d-m-Y');

                $_psigndate = date_create($rows['psigndate']);
                $psigndate = date_format($_psigndate,'Y-m-d');
                $psigndate_n = date_format($_psigndate,'d-m-Y');
                $psigndate_d = date_format($_psigndate,'d-M-Y');

                $_exteneddate = date_create($rows['exteneddate']);
                $exteneddate = date_format($_exteneddate,'Y-m-d');
                $exteneddate_n = date_format($_exteneddate,'d-m-Y');
                $exteneddate_d = date_format($_exteneddate,'d-M-Y');

                $_expirydate = date_create($rows['expirydate']);
                $expirydate = date_format($_expirydate,'Y-m-d');
                $expirydate_d = date_format($_expirydate,'d-M-Y');
                $expirydate_n = date_format($_expirydate,'d-m-Y');

                $_plist[] = array(
                    'pid' => $rows['pid'],
                    'pno' => $this->enc('denc',$rows['pno']),
                    'pname' => $this->enc('denc',$rows['pname']),
                    'plocation' => $this->enc('denc',$rows['plocation']),
                    'pregion' => $this->enc('denc',$rows['pregion']),
                    'psigndate' => $psigndate,
                    'psigndate_d' => $psigndate_d,
                    'psigndate_n' => $psigndate_n,
                    'pduratioin' => $this->enc('denc',$rows['pduratioin']),                    
                    'expirydate' => $expirydate,
                    'expirydate_d' => $expirydate_d,
                    'expirydate_n' => $expirydate_n,
                    'exteneddate' => $exteneddate,
                    'exteneddate_d' => $exteneddate_d,
                    'exteneddate_n' => $exteneddate_n,
                    'reson' => $this->enc('denc',$rows['reson']),
                    'cdate' => $rows['cdate'],
                    'edate' => $rows['edate'],
                    'cby' => $rows['cby'],
                    'eby' => $rows['eby'],
                    'mdate' => $mdate,
                    'mdate_d' => $mdate_d,
                    'mdate_n' => $mdate_n,
                );

            }
            $this->response= array('msg' => "1",'data' => $_plist);
            return json_encode($this->response);
            exit();
        }
    }


?>