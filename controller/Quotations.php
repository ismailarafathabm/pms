<?php 
    require_once 'mac.php';
    class Quotations extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $response;
        
        function __construct($db){
            $this->cn = $db;
            $this->response = array('msg'=>"0",'data'=>"_error");
        }

        public function GetNewQuotationsSno(){
            $this->sql = "SELECT qusno FROM pms_quotations order by quid desc limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();            
            $sno  = 0;
            if($this->cm->rowCount() > 0 ){
                $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                $sno = (int)$this->enc('denc',$rows['qusno'])+1; 
            }
            unset($this->sql,$this->cm,$rows);
            $this->response = array('msg' => "1", 'data' => $sno);
            return json_encode($this->response);
            exit();
        }

        public function CheckAlreadyProjectInList($quprojectname){
            //get last revision no 
            $qusno = "1";
            $this->sql = "SELECT qusno from pms_quotations order by quid desc limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $cnt = $this->cm->rowCount();
            if($cnt !== 0){
                $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                $xqusno = (int)$this->enc('denc',$rows['qusno']);
                $qusno += $xqusno;
            }
            unset($this->sql,$this->cm,$rows);
            
            $refno = "";
            $this->sql = "SELECT qurefno FROM pms_quotations where quprojectname = :quprojectname";
            //echo "SELECT qurefno FROM pms_quotations where quprojectname = '{$quprojectname}'";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":quprojectname",$quprojectname);
            $this->cm->execute();
           // echo $this->cm->rowCount();
            if($this->cm->rowCount() !== 0){
                $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                $refno = $this->enc('denc',$rows['qurefno']);
            }

            unset($this->sql,$this->cm,$rows);
            $d = array(
                'qusno' => $qusno,
                'refno' => $refno,
            );
            $this->response = array(
                'msg' => "1",
                'data' => $d,
            );

            return json_encode($this->response);
            exit();
        }

        public function NewQuotations($quinfos){
            $this->sql = "INSERT INTO pms_quotations values(
                null,
                :qusno,
                :qurefno,
                :qureceiveddate,
                :qusubmitaldate,
                :qusalesrep,
                :quprojectname,
                :qustatus,
                :qulocation,
                :quattention,
                :qucontact,
                :qurecivedthru,
                :quboq,
                :quspecification,
                :qudrawings,
                :quboqtoken,
                :quspecificationtoken,
                :qudrawingstoken,
                :quextra,
                :qureleasequno,
                :cby,
                :eby,
                :cdate,
                :edate
            )";

            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($quinfos)){
                $this->response = array(
                    'msg' => "1",
                    'data' => "Saved"
                );
            }else{
                $this->response = array(
                    'msg' => "0",
                    'data' => "Database Error"
                );
            }
            unset($this->sql,$this->cm);
            return json_encode($this->response);
            exit();
        }

        public function UpdateQuotations($quinfos){
            $this->sql = "UPDATE pms_quotations set 
            qurefno = :qurefno,
            qureceiveddate = :qureceiveddate,
            qusubmitaldate = :qusubmitaldate,
            qusalesrep = :qusalesrep,
            quprojectname = :quprojectname,
            qustatus = :qustatus,
            qulocation = :qulocation,
            quattention = :quattention,
            qucontact = :qucontact,
            qurecivedthru = :qurecivedthru,
            quboq = :quboq,
            quspecification = :quspecification,
            qudrawings = :qudrawings,
            quboqtoken = :quboqtoken,
            quspecificationtoken = :quspecificationtoken,
            qudrawingstoken = :qudrawingstoken,
            quextra = :quextra,
            eby = :eby,
            edate = :edate 
            where 
            quid = :quid";

            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($quinfos)){
                $this->response = array(
                    'msg' => "1",
                    'data' => "Updated"
                );
            }else{
                $this->response = array(
                    'msg' => "0",
                    'data' => "Database Error"
                );
            }
            return json_encode($this->response);
            exit();
        }

        public function AllQuotations(){
            $this->sql = "SELECT *FROM pms_quotations";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $_quotations = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                //get boq uploads 
                $loca = "../assets/quot/";
                $quboq = strtolower($this->enc('denc',$rows['quboq']));
                $quboqtoken = $rows['quboqtoken'];
                $boqfile = "{$loca}boq/{$quboqtoken}.{$quboq}";
                $boqok = file_exists($boqfile) ? "1" : "0";

                $quspecification = $this->enc('denc',$rows['quspecification']);
                $quspecificationtoken = $rows['quspecificationtoken'];
                $specfile = "{$loca}spec/{$quspecificationtoken}.{$quspecification}";
                $spcok = file_exists($specfile) ? "1" : "0";

                $qudrawings = $this->enc('enc',$rows['qudrawings']);
                $qudrawingstoken = $rows['qudrawingstoken'];
                $drawfile = "{$loca}draw/{$qudrawingstoken}.{$qudrawings}";

                $drawok = file_exists($drawfile) ? "1" : "0";

                $_qureceiveddate = date_create($rows['qureceiveddate']);
                $_qusubmitaldate = date_create($rows['qusubmitaldate']);
                $cont_s = json_decode($this->enc('denc',$rows['qucontact']));
                //print_r($cont_s);
                $qucontact = "-";
                $contact_infos = "-";
                $revision_no = "-";
                $rdate = date('Y-m-d');
                $rduration = "-";
                $ramount = "-";
                $rsystemtype = "-";
                $rcosingeng = "-";
                $rremarks = "-";
                $rdrawingno = "-";
                $l = $this->enc('denc',$rows['qureleasequno']);
                //echo $l;
                if($l !== '0'){
                    $r = json_decode($l);
                    $revision_no = $r->revision_no;
                    $rdate = $r->rdate;
                    $rduration = $r->rduration;
                    $ramount = $r->ramount;
                    $rsystemtype = $r->rsystemtype;
                    $rcosingeng = $r->rcosingeng;
                    $rremarks = $r->rremarks;
                    $rdrawingno = $r->rdrawingno;

                }
                $_quotations[] = array(
                    'quid' => $rows['quid'],
                    'qusno' => $this->enc('denc',$rows['qusno']),
                    'qurefno' => $this->enc('denc',$rows['qurefno']),
                    'qureceiveddate' => date_format($_qureceiveddate,'Y-m-d'),
                    'qureceiveddate_d' => date_format($_qureceiveddate,'d-M-Y'),
                    'qureceiveddate_n' => date_format($_qureceiveddate,'d-m-Y'),
                    'qureceiveddate_p' => date_format($_qureceiveddate,'d-m-y'),
                    'qusubmitaldate' => date_format($_qusubmitaldate,'Y-m-d'),
                    'qusubmitaldate_d' => date_format($_qusubmitaldate,'d-M-Y'),
                    'qusubmitaldate_n' => date_format($_qusubmitaldate,'d-m-Y'),
                    'qusubmitaldate_p' => date_format($_qusubmitaldate,'d-m-y'),
                    'qusalesrep' => ucwords(strtolower($this->enc('denc',$rows['qusalesrep']))),
                    'quprojectname' => ucwords(strtolower($this->enc('denc',$rows['quprojectname']))),
                    'qustatus' => $this->enc('denc',$rows['qustatus']),
                    'qulocation' => ucwords(strtolower($this->enc('denc',$rows['qulocation']))),
                    'quattention' => $this->enc('denc',$rows['quattention']),
                    'qucontact' => $this->enc('denc',$rows['qucontact']),
                    'qucontact' => $qucontact,
                    'contact_infos' => $contact_infos,
                    'qurecivedthru' => $this->enc('denc',$rows['qurecivedthru']),
                    'quboq' => $this->enc('denc',$rows['quboq']),
                    'quspecification' => $this->enc('denc',$rows['quspecification']),
                    'qudrawings' => $this->enc('denc',$rows['qudrawings']),
                    'quboqtoken' => $rows['quboqtoken'],
                    'quspecificationtoken' => $rows['quspecificationtoken'],
                    'qudrawingstoken' => $rows['qudrawingstoken'],
                    'quextra' => $this->enc('denc',$rows['quextra']),
                    'qureleasequno' => $this->enc('denc',$rows['qureleasequno']),
                    'cby' => $this->enc('denc',$rows['cby']),
                    'eby' => $this->enc('denc',$rows['eby']),
                    'cdate' => $rows['cdate'],
                    'edate' => $rows['edate'],
                    'drawok' => $drawok,
                    'spcok' => $spcok,
                    'boqok' => $boqok,
                    'revision_no' => $revision_no,
                    'rdate' => date_format(date_create($rdate),'Y-m-d'),
                    'rdate_d' => date_format(date_create($rdate),'d-M-Y'),
                    'rdate_n' => date_format(date_create($rdate),'d-m-Y'),
                    'rdate_p' => date_format(date_create($rdate),'d-m-y'),
                    'rduration' => $rduration,
                    'ramount' => $ramount,
                    'rsystemtype' => $rsystemtype,
                    'rcosingeng' => $rcosingeng,
                    'rremarks' => $rremarks,
                    'rdrawingno' => $rdrawingno,
                );
            }
            $this->response = array(
                'msg' => "1",
                'data' => $_quotations
            );
            return json_encode($this->response);
            exit();
        }

        private function UpdateRevisionQuotations($id,$updateinfos){
            $this->sql = "UPDATE pms_quotations set qureleasequno = :qureleasequno where quid = :quid";
            $this->cm = $this->cn->prepare($this->sql);
            $p = array(
                ':qureleasequno' => $updateinfos,
                ':quid' => $id,
            );
            $this->cm->execute($p);
            unset($this->cm,$this->sql);
        }
        private function RemoveAllCurrent($id){
            $iscurrent = $this->enc('enc','2');
            $this->sql = "UPDATE pms_quotations_revision set rcurrent = :rcurrent where rqno = :rqno";
            $this->cm  = $this->cn->prepare($this->sql);
            $p = array(
                ':rcurrent' => $iscurrent,
                ':rqno' => $id
            );
            $this->cm->execute($p);
            unset($this->cm,$this->sql);
        }
        public function NewRevisions($revisioninfo,$updateinfos,$id){
            $this->UpdateRevisionQuotations($id,$updateinfos);
            $this->RemoveAllCurrent($id);
            $this->sql = "INSERT INTO pms_quotations_revision values(
                null,
                :rdate,
                :rduration,
                :ramount,
                :rsystemtype,
                :rcosingeng,
                :rremarks,
                :rdrawingno,
                :rcurrent,
                :rqno,
                :cby,
                :eby,
                :cdate,
                :edate,
                :del,
                :revision_no
            )";

            $this->cm = $this->cn->prepare($this->sql);
            if($this->cm->execute($revisioninfo)){
                $this->response = array(
                    'msg' => "1",
                    'data' => "Saved"
                );
            }else{
                $this->response = array(
                    'msg' => "0",
                    'data' => "database Error"
                );
            }

            unset($this->cm,$this->sql);
            return json_encode($this->response);
            exit();
        }
      
        public function GetRevisionsList($id){
            $this->sql = "SELECT *FROM pms_quotations_revision where rqno = :rqno";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":rqno",$id);
            $this->cm->execute();
            $_revisions = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                $_revisions[] = array(
                    'rid' => $rows['rid'],
                    'rdate' => date_format(date_create($rows['rdate']),'Y-m-d'),
                    'rdate_d' => date_format(date_create($rows['rdate']),'d-M-Y'),
                    'rdate_n' => date_format(date_create($rows['rdate']),'d-m-Y'),
                    'rdate_p' => date_format(date_create($rows['rdate']),'d-m-y'),
                    'rduration' => $this->enc('denc',$rows['rduration']),
                    'ramount' => (float)$this->enc('denc',$rows['ramount']),
                    'rsystemtype' => ucwords(strtolower($this->enc('denc',$rows['rsystemtype']))),
                    'rcosingeng' => ucwords(strtolower($this->enc('denc',$rows['rcosingeng']))),
                    'rremarks' =>   $this->enc('denc',$rows['rremarks']),
                    'rdrawingno' => $this->enc('denc',$rows['rdrawingno']),
                    'rcurrent' => $this->enc('denc',$rows['rcurrent']),
                    'rqno' => $rows['rqno'],
                    'cby' => $this->enc('denc',$rows['cby']),
                    'eby' => $this->enc('denc',$rows['eby']),
                    'cdate' => date_format(date_create($rows['cdate']),'Y-m-d h:i:s a'),
                    'edate' => date_format(date_create($rows['edate']),'Y-m-d h:i:s a'),
                    'del' => $this->enc('denc',$rows['del']),
                    'revision_no' => $this->enc('denc',$rows['revision_no']),
                );
            }
            $this->response = array(
                'msg' => "1",
                'data' => $_revisions
            );
            
            unset($this->sql,$this->cm,$rows);
            return json_encode($this->response);
            exit();
        }
        
    }
?>