<?php 
    require_once 'mac.php';
    class DeleteRec extends mac{
        private $cn;
        private $cm;
        private $sql;
        private $response;
        function __construct($db)
        {
            $this->cn = $db;
        }

        private function _getPPinfos($id){
            $this->sql = "SELECT *FROM ppreports where pprid=:pprid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":pprid",$id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($rows);
            $infos = array(
                'pprid' => $pprid,
                'ppdate' => date_format(date_create($ppdate),'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate),'d-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate),'d-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate),'d-m-y'),
                'pp_project' => $pp_project,
                'pp_projectname' => $pp_projectname,
                'pp_mtype' => $pp_mtype,
                'pp_mdescription' => $pp_mdescription,
                'pp_color' => $pp_color,
                'pp_qty' => $pp_qty,
                'pp_units' => $pp_units,
                'pp_delno' => $pp_delno,
                'pp_dta' => $pp_dta,
                'pp_location' => $pp_location,
                'pp_remarks' => $pp_remarks,
                'pp_type' => $pp_type,
                'pp_cdate' => $pp_cdate,
                'pp_edate' => $pp_edate,
                'pp_cby' => $pp_cby,
                'pp_eby' => $pp_eby,
                'pp_extra' => $pp_extra,
                'pp_dieweight' => $pp_dieweight,
                'ppbalancedie' => $ppbalancedie,
                'pppartno' => $pppartno,
                'pplenght' => $pplenght,
                'ppalloy' => $ppalloy,
                'ppitemtype' => $ppitemtype
            );
            unset($this->sql,$this->cm,$rows);
            $infos['moreinfos'] = $this->_getPPSubInfoLIST($id);    
            
            return $infos;
            
        }
        private function _getPPSubInfoLIST($id){
            $this->sql = "SELECT *FROM ppsubreport where ppid=:ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid",$id);
            $this->cm->execute();
            $ppsublist = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $ppsublist[] = array(
                    'returnid' => $returnid,
                    'returndate' => date_format(date_create($returndate),'Y-m-d'),
                    'returndate_d' => date_format(date_create($returndate),'d-M-Y'),
                    'returndate_n' => date_format(date_create($returndate),'d-m-Y'),
                    'returndate_p' => date_format(date_create($returndate),'d-m-y'),
                    'returnqty' => $returnqty,
                    'rtno' => $rtno,
                    'rcpno' => $rcpno,
                    'remark' => $remark,
                    'ppid' => $ppid,
                    'pcby' => $pcby,
                    'peby' => $peby,
                    'pcdate' => $pcdate,
                    'peditdate' => $peditdate,
                    'pextra' => $pextra,
                );
            }
            unset($this->sql,$this->cm,$rows);
            return $ppsublist;
        }

        

        public function _save_pp_infodelet($id,$_username){
            $_kinfos = $this->_getPPinfos($id);
            $i = $this->enc('enc',json_encode($_kinfos));
            $date = date('Y-m-d H:i:s');
            $page = $this->enc('enc','PPREPORT');
            $username = $this->enc('enc',$_username);

            $this->sql = "INSERT INTO ppdeletelog values(null,:del_type,:del_page,:del_date,:delusername)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":del_type",$i);
            $this->cm->bindParam(":del_page",$page);
            $this->cm->bindParam(":del_date",$date);
            $this->cm->bindParam(":delusername",$username);
            $this->cm->execute();
        }

        //delete receipt

        private function GetReceiptInfo($id){
           // echo $id;
            $this->sql = "SELECT *FROM ppsubreport where returnid=:returnid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":returnid",$id);
            $this->cm->execute();
            $cnt =$this->cm->rowCount();
            //echo $cnt;
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($rows);
            $infos = array(
                'returnid' => $returnid,
                'returndate' => $returndate,
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => $pcdate,
                'peditdate' => $peditdate,
                'pextra' => $pextra
            );

            unset($this->sql,$this->cm,$rows);
            return $infos;
        }

        private function _savePPretrunDelete($infos){            
            $this->sql = "INSERT INTO ppdeletelog values(null,:del_type,:del_page,:del_date,:delusername)";
            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($infos);
            unset($this->sql,$this->cm);
            return $sv;
        }

        private function _SavePPReturnDelete($id,$_username){
            $i = $this->enc('enc',json_encode($this->GetReceiptInfo($id)));
            $username = $this->enc('enc',$_username);
            $page = $this->enc('enc','PPRECEIPT');
            $date = date('Y-m-d H:i:s');

            $infodata = array(
                ":del_type" => $i,
                ":del_page" => $page,
                ":del_date" => $date,
                ":delusername" => $username
            );
            $rc = $this->_savePPretrunDelete($infodata);
            return $rc;
        }

        private function _RemovePPRc($id){
            $this->sql = "DELETE FROM ppsubreport where returnid=:returnid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":returnid",$id);
            $s = $this->cm->execute();
            unset($this->sql,$this->cm);
            return $s;
        }

        public function RemovePPAction($id,$user){
            if($this->_SavePPReturnDelete($id,$user)){
                if($this->_RemovePPRc($id)){
                    $this->response = array(
                        "msg" => "1",
                        "data" => "Saved"
                    );
                }else{
                    $this->response = array(
                        "msg" => "0",
                        "data" => "DATABASE ERROR ON DELETE"
                    );
                }
            }else{
                $this->response = array(
                    "msg" => "0",
                    "data" => "DATABASE ERROR"
                );
            }

            return json_encode($this->response);
            exit();
        }

        
    }
?>
