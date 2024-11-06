<?php
require_once 'mac.php';
class Bomn extends mac
{
    private $cn;
    private $sql;
    private $cm;
    private $response = [];
    function __construct($db)
    {
        $this->cn = $db;
    }

    private function _getProjectBoq($poq_project_code)
    {
        $this->sql = "SELECT boq.poq_id,
                                    boq.poq_item_no,
                                    boq.poq_item_type,
                                    boq.poq_project_code,                                    
                                    ptype.ptype_name,                                    
                                    ftype.finish_name 
            FROM pms_poq as boq 
            inner join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
            inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id   
            where boq.poq_project_code = :poq_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code", $poq_project_code);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $rpt = array(
                "poq_id" => $poq_id,
                "poq_item_no" => self::enc('denc', $poq_item_no),
                "poq_item_type" => $poq_item_type,
                "poq_project_code" => self::enc('denc', $poq_project_code),
                "ptype_name" => self::enc('denc', $ptype_name),
                "finish_name" => self::enc('denc', $finish_name)
            );
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }
    public function GetProjectBoq($poq_project_code)
    {
        $rpts = self::_getProjectBoq($poq_project_code);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

   

    private function _bomitems(){
        $this->sql = "SELECT 
        partno,description,partalloy,partlength,partcolor,matcatagory,syscatagory,partfunction,partuom,dieweight,sqm,partlength,partcolor 
        from bomitems group by partno,description,partalloy,partlength,partcolor,matcatagory,syscatagory,partfunction,partuom,dieweight,sqm,partlength,partcolor 
        order by partno,partalloy,partlength,partcolor";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $datas = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $datas[] = $rows;
        }
        unset($this->sql,$rows,$this->cm);
        return $datas;
    }

    public function Bomitems(){
        $rpt = self::_bomitems();
        $this->response = array("msg" => "1" , "data" => $rpt);
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    private function FlagTxt($flag){
        $flags = array(
            "0" => "NOT POST",
            "1" => "POST"
        );
        return $flags[$flag];
    }
    private function pms_bom($rows){        
        $cols = $rows;        
        $cols['bomfno'] = $rows['bom_prefixno'] . "/" . $rows['bom_no'];
        $cols['bom_date_s'] = self::datemethod($rows['bom_date']);
        $cols['bom_postflag_txt'] = self::FlagTxt((string)$rows['bom_postflag']);
        return $cols;
    }
    private function _GetBomInformations($bom_no,$bom_projectno){
        $this->sql = "SELECT *,boq.poq_item_no as boqitem FROM pms_bom as bom left join pms_poq as boq on bom.bom_boqid=boq.poq_id where bom_no = :bom_no and bom_projectno = :bom_projectno";
        //$this->sql = "SELECT *FROM pms_bom where bom_no = ".$bom_no." and bom_projectno = '". $bom_projectno ."'";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":bom_no" => $bom_no,
            ":bom_projectno" => $bom_projectno
        );
        $this->cm->execute($params);
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_bom($rows);
            //Miscellaneous
            $rpt['boqitem'] = is_null($rows['boqitem']) ? 'Miscellaneous' : self::enc('denc',$rows['boqitem']);
            $rpts[] = $rpt;
        }        
        unset($this->cm,$this->sql,$rows);
        return $rpts;        
    }


    public function GetBomInformations($bom_no,$bom_projectno){
        $datas = self::_GetBomInformations($bom_no,$bom_projectno);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $datas);
        return json_encode($this->response);
        exit;
    }

    private function _SaveBom($params){
        $this->sql = "INSERT INTO pms_bom values(
            null,
            :bom_projectid,
            :bom_projectno,
            :bom_projectname,
            :bom_boqid,
            :bom_profileno,
            :bom_description,
            :bom_dieweight,
            :bom_qrlenght,
            :bom_qrbar,
            :bom_qrtotweight,
            :bom_avilength,
            :bom_avaibar,
            :bom_orderlength,
            :bom_orderbar,
            :bom_orderweight,
            :bom_itemfinish,
            :bom_remarks,
            :bom_prefixno,
            :bom_no,
            :bom_cby,
            :bom_eby,
            :bom_cdate,
            :bom_edate,
            :bom_postflag,
            :bom_mflag,
            :bom_date,
            :bom_mdate,
            :bom_projectencno,
            :bom_registerno,
            :bom_checkedby,
            :bom_makeby,
            :alsowithlenght
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm,$this->sql);
        return $sv;
    }

    private function _bomstatus($bom_no,$bom_project){
        $this->sql = "SELECT COUNT(*) as cnt from pms_bom where bom_projectno = :bom_projectno and bom_no = :bom_no and bom_postflag = 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bom_projectno",$bom_project);
        $this->cm->bindParam(":bom_no",$bom_no);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm,$this->sql,$rows);
        return $cnt;
    }

    public function SaveBom($params){
        $bom_no = $params[':bom_no'];
        $bom_projectno = $params[':bom_projectno'];
        $cnt = (int)self::_bomstatus($bom_no,$bom_projectno);
        if($cnt !== 0){
            header("http/1.0 409 Already Posted");
            $this->response = array("msg" => "0", "data" => "POSTED");
            return json_encode($this->response);
            exit;
        }
        $sv = self::_SaveBom($params);
        if(!$sv){
            header("HTTP/1.0 500 Error");
            $this->response = array("msg" => "0" , "data" => "Error on Saving Data");
            return json_encode($this->response);
            exit;
        }
        
       

        $datas = self::_GetBomInformations($bom_no,$bom_projectno);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $datas);
        return json_encode($this->response);
        exit;
    }
    private function _canEditBom($bom_id){
        $this->sql = "SELECT COUNT(bom_id) as cnt FROM pms_bom where bom_id = :bom_id and bom_postflag = 0";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bom_id",$bom_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql,$this->cm,$rows);
        return $cnt;
    }

    private function _canedituser($bom_id,$bom_cby){
        $this->sql = "SELECT COUNT(bom_id) as cnt FROM pms_bom where bom_id = :bom_id and bom_cby = :bom_cby";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bom_id",$bom_id);
        $this->cm->bindParam(":bom_cby",$bom_cby);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql,$this->cm,$rows);
        return $cnt;
    }

    private function _updateBomItems($params){
        $this->sql = "UPDATE pms_bom set 
            bom_boqid = :bom_boqid,
            bom_profileno = :bom_profileno,
            bom_description =:bom_description,
            bom_dieweight =:bom_dieweight,
            bom_qrlenght =:bom_qrlenght,
            bom_qrbar =:bom_qrbar,
            bom_qrtotweight =:bom_qrtotweight,
            bom_avilength =:bom_avilength,
            bom_avaibar =:bom_avaibar,
            bom_orderlength =:bom_orderlength,
            bom_orderbar =:bom_orderbar,
            bom_orderweight =:bom_orderweight,
            bom_itemfinish =:bom_itemfinish,
            bom_remarks =:bom_remarks,
            bom_eby = :bom_eby,
            bom_edate = :bom_edate 
            where 
            bom_id = :bom_id";        
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql,$this->cm,$rows);
        return $sv;
    }

    public function EditItems($params,$bom_no,$bom_projectno){
        $bomid = $params[':bom_id'];
        $username = $params[':bom_eby'];
        $canedit = self::_canEditBom($bomid);
        //echo $canedit;
        if($canedit === 0){
            header("Http/1.0 400 error");
            $this->response = array("msg" => "0" , "data" => "You Could not Edit, becouse Already This Item Posted");
            return json_encode($this->response);
            exit;
        }
        //user can edit
        $ucanedit = self::_canedituser($bomid,$username);
        if($ucanedit === 0){
            header("Http/1.0 401 error");
            $this->response = array("msg" => "0" , "data" => "You Could not Edit, becouse This Entry By other user");
            return json_encode($this->response);
            exit;
        }
        $up = self::_updateBomItems($params);
        if(!$up){
            header("http/1.0 500 error on update");
            $this->response = array("msg" => "0", "data" => "Error on Update" );
            return json_encode($this->response);
            exit;
        }
        header("http/1.0 200 ok");
        $datas = self::_GetBomInformations($bom_no,$bom_projectno);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $datas);
        return json_encode($this->response);
        exit;
    }

    private function _deletebomitems($bomid){
        $this->sql = "DELETE FROM pms_bom where bom_id = :bom_id LIMIT 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bom_id",$bomid);
        $del = $this->cm->execute();
        unset($this->sql,$this->cm);
        return $del;        
    }

    public function DeleteBomItem($bomid,$user,$bom_no,$bom_projectno){
        $isposted = self::_canEditBom($bomid);
        if($isposted === 0){
            header("http/1.0 409 error");
            $this->response = array("msg" => "0", "data" => "This Already Posted");
            return json_encode($this->response);
            exit;
        }
        $usercan =  self::_canedituser($bomid,$user);
        if($usercan !== 1){
            header("http/1.0 409 error");
            $this->response = array("msg" => "0" , "data" => "You Can not Delete This Item, you can read only");
            return json_encode($this->response);
            exit;
        } 
       
        $del = self::_deletebomitems($bomid);
        if(!$del){
            header("http/1.0 500 error");
            $this->response = array("msg" => "0" , "data" => "Error on Remove Data");
            return json_encode($this->response);
            exit;
        }
        $datas = self::_GetBomInformations($bom_no,$bom_projectno);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $datas);
        return json_encode($this->response);
        exit;
    }

    


    //for reporting
    
    public function Bomgetcountp($project){
        $this->sql = "SELECT COUNT(*) as cnt from pms_bom where bom_projectno = :bom_projectno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bom_projectno",$project);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm,$this->sql,$rows);
        $this->response = array("msg" => "1" , "data" => $cnt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }
    public function Bomgetcount(){
        $this->sql = "SELECT COUNT(*) as cnt from pms_bom";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm,$this->sql,$rows);        
        $this->response = array("msg" => "1" , "data" => $cnt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }
    private function _bomRptall($limit){
        $this->sql = "SELECT *,boq.poq_item_no as boqitem FROM pms_bom as bom left join pms_poq as boq on bom.bom_boqid=boq.poq_id  limit ".$limit.",500";
        $this->cm = $this->cn->prepare($this->sql);        
        $this->cm->execute();
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_bom($rows);
            //Miscellaneous
            $rpt['boqitem'] = is_null($rows['boqitem']) ? 'Miscellaneous' : self::enc('denc',$rows['boqitem']);
            $rpts[] = $rpt;
        }        
        unset($this->cm,$this->sql,$rows);
        return $rpts;   
    }

    public function BoqRptAll($limit){
        $rpt = self::_bomRptall($limit);
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
    }

    private function _bomRptallp($limit,$project){
        $this->sql = "SELECT *,boq.poq_item_no as boqitem FROM pms_bom as bom left join pms_poq as boq on bom.bom_boqid=boq.poq_id where bom_projectno = :bom_projectno limit ".$limit.",500";
        $this->cm = $this->cn->prepare($this->sql);        
        $this->cm->bindParam(":bom_projectno",$project);
        $this->cm->execute();
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_bom($rows);
            //Miscellaneous
            $rpt['boqitem'] = is_null($rows['boqitem']) ? 'Miscellaneous' : self::enc('denc',$rows['boqitem']);
            $rpts[] = $rpt;
        }        
        unset($this->cm,$this->sql,$rows);
        return $rpts;   
    }

    public function BoqRptAllp($limit,$project){
        $rpt = self::_bomRptallp($limit,$project);
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
    }

    private function _postbom($bom_no,$bom_projectno,$post){
        $this->sql = "UPDATE pms_bom set bom_postflag = :post where bom_no = :bom_no and bom_projectno = :bom_projectno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":post",$post);
        $this->cm->bindParam(":bom_no",$bom_no);
        $this->cm->bindParam(":bom_projectno",$bom_projectno);
        $sv = $this->cm->execute();
        unset($this->cm,$this->sql,$rows);
        return $sv;
    }

    public function POSTBOM($bom_no,$bom_projectno){
        $up = self::_postbom($bom_no,$bom_projectno,'1');
        if(!$up){
            header("http/1.0 500 error");
            $this->response = array("msg" => "0" , "data" => "Error on POST");
            return json_encode($this->response);
            exit;
        }
        header("http/1.0 200 ok");
        $this->response = array("msg" => '1' , "data" => "BOM has posted");
        return json_encode($this->response);
        exit;

    }
    public function UNPOSTBOM($bom_no,$bom_projectno){
        $up = self::_postbom($bom_no,$bom_projectno,'0');
        if(!$up){
            header("http/1.0 500 error");
            $this->response = array("msg" => "0" , "data" => "Error on POST");
            return json_encode($this->response);
            exit;
        }
        header("http/1.0 200 ok");
        $this->response = array("msg" => '1' , "data" => "BOM has un-posted");
        return json_encode($this->response);
        exit;

    }
}
