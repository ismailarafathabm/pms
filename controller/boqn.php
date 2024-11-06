<?php
require_once 'mac.php';
class BOQN extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response = [];

    function __construct($db)
    {
        $this->cn = $db;
    }
    private function pms_boqeng($rows)
    {
        $rpt = array(
            "boqeng_id" => (string)$rows['boqeng_id'],
            "boqeng_project_id" => (string)$rows['boqeng_project_id'],
            "boqeng_projectno" => $rows['boqeng_projectno'],
            "boqeng_projectnoenc" => $rows['boqeng_projectnoenc'],
            "boqeng_projectname" => $rows['boqeng_projectname'],
            "boqeng_projectlocation" => $rows['boqeng_projectlocation'],
            "boqeng_boqid" => (string)$rows['boqeng_boqid'],
            "boqeng_qty" => (string)$rows['boqeng_qty'],
            "boqeng_area" => (string)$rows['boqeng_area'],
            "boqeng_rdate" => $rows['boqeng_rdate'],
            "boqeng_rdate_d" => self::datemethod($rows['boqeng_rdate']),
            "boqeng_enggname" => $rows['boqeng_enggname'],
            "boqeng_cby" => $rows['boqeng_cby'],
            "boqeng_eby" => $rows['boqeng_eby'],
            "boqeng_cdate" => $rows['boqeng_cdate'],
            "boqeng_edate" => $rows['boqeng_edate'],
            "boqeng_postflag" => (string)$rows['boqeng_postflag'],
            
        );
        return $rpt;
    }

    private function _getengrelease($boqeng_boqid){
        $this->sql = "SELECT *FROM pms_boqeng where boqeng_boqid = :boqeng_boqid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boqeng_boqid", $boqeng_boqid);
        $this->cm->execute();
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_boqeng($rows);
            $rpts[] = $rpt;
        }
        unset($this->sql,$this->cm,$rows);
        return $rpts;
    }

    public function GetEngRelease($boqeng_boqid){
        $rpts = self::_getengrelease($boqeng_boqid);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    private function _BoqEngReleasedForProject($boqeng_project_id){
        $this->sql = "SELECT *FROM pms_boqeng as engboq inner join (pms_poq as boq 
        inner join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id
        inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
        inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id   
        inner join pms_units as utype on boq.poq_unit = utype.uint_id)  on engboq.boqeng_boqid = boq.poq_id 
        where engboq.boqeng_project_id = :boqeng_project_id order by boqeng_rdate desc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boqeng_project_id",$boqeng_project_id);
        $this->cm->execute();
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_boqeng($rows);
            extract($rpt);
            extract($rows);
            $tot = (float) self::enc('denc', $poq_qty) * (float) self::enc('denc', $poq_uprice);
            $area  = ((float) self::enc('denc', $poq_item_width)/1000) * ((float) self::enc('denc', $poq_item_height)/1000);
            $total_area = (float)$area*(float) self::enc('denc', $poq_qty);
            $rpt['poq_id'] = $poq_id;
            $rpt['poq_item_no'] = self::enc('denc', $poq_item_no);
            $rpt['poq_item_type'] = $poq_item_type;
            $rpt['poq_item_remark'] = self::enc('denc', $poq_item_remark);
            $rpt['poq_item_width'] = (string)((float)self::enc('denc', $poq_item_width)/1000);
            $rpt['poq_item_height'] = (string)((float)self::enc('denc', $poq_item_height)/1000);
            $rpt['poq_item_glass_spec'] = self::enc('denc', $poq_item_glass_spec);
            $rpt['poq_item_glass_single'] = self::enc('denc', $poq_item_glass_single);
            $rpt['poq_item_glass_double1'] = self::enc('denc', $poq_item_glass_double1);
            $rpt['poq_item_glass_double2'] = self::enc('denc', $poq_item_glass_double2);
            $rpt['poq_item_glass_double3'] = self::enc('denc', $poq_item_glass_double3);
            $rpt['poq_item_glass_laminate1'] = self::enc('denc', $poq_item_glass_laminate1);
            $rpt['poq_item_glass_laminate2'] = self::enc('denc', $poq_item_glass_laminate2);
            $rpt['poq_drawing'] = self::enc('denc', $poq_drawing);
            $rpt['poq_finish'] = $poq_finish;
            $rpt['poq_system_type'] = $poq_system_type;
            $rpt['poq_qty'] = (string)self::enc('denc', $poq_qty);
            $rpt['poq_unit'] = $poq_unit;
            $rpt['poq_uprice'] = self::enc('denc', $poq_uprice);
            $rpt['poq_remark'] = self::enc('denc', $poq_remark);
            $rpt['poq_cby'] = self::enc('denc', $poq_cby);
            $rpt['poq_eby'] = self::enc('denc', $poq_eby);
            $rpt['poq_Cdate'] = self::enc('denc', $poq_Cdate);
            $rpt['poq_Edate'] = self::enc('denc', $poq_Edate);
            $rpt['poq_project_code'] = self::enc('denc', $poq_project_code);
            $rpt['poq_status'] = self::enc('denc', $poq_status);
            $rpt['unit_name'] = self::enc('denc', $unit_name);
            $rpt['ptype_name'] = self::enc('denc', $ptype_name);
            $rpt['system_type_name'] = self::enc('denc', $system_type_name);
            $rpt['finish_name'] = self::enc('denc', $finish_name);
            $rpt['tot'] = (string)$tot;
            $rpt['area'] = (string)$area;
            $rpt['item_aras'] = self::enc('denc', $boq_area);
            $rpt['totalarea'] = (string)$total_area;
            $boq = array(
                
            );
            $rpt['boqinfo'] = $boq;
            $rpts[] = $rpt;
        }
        unset($this->cm,$this->sql,$rows);
        return $rpts;
    }

    public function BoqEngReleasedForProject($boqeng_project_id){
        $rpts = self::_BoqEngReleasedForProject($boqeng_project_id);
        $this->response = array("msg" => "1" , "data" => $rpts);
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }


    
    private function _getoldrelease($boqeng_boqid)
    {
        //pms_boqeng
        $this->sql = "SELECT SUM(boqeng_qty) as totqty , SUM(boqeng_area) as totarea from 
                            pms_boqeng where boqeng_boqid = :boqeng_boqid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boqeng_boqid", $boqeng_boqid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $tot_qty = is_null($rows['totqty']) ? '0' : (string)$rows['totqty'];
        $tot_area = is_null($rows['totarea']) ? '0' : (string)$rows['totarea'];
        $result = array(
            "tot_qty" => $tot_qty,
            "tot_area" => $tot_area,
        );
        unset($this->cm, $this->sql, $rows);
        return $result;
    }

    public function GetTotalRelease($boqeng_boqid)
    {
        $datas = self::_getoldrelease($boqeng_boqid);
        $this->response = array(
            "msg" => "1",
            "data" => $datas
        );
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    private function _saveBoqeng($params)
    {
        $this->sql = "INSERT INTO pms_boqeng values(
                null,
                :boqeng_project_id,
                :boqeng_projectno,
                :boqeng_projectnoenc,
                :boqeng_projectname,
                :boqeng_projectlocation,
                :boqeng_boqid,
                :boqeng_qty,
                :boqeng_area,
                :boqeng_rdate,
                :boqeng_enggname,
                :boqeng_cby,
                :boqeng_eby,
                :boqeng_cdate,
                :boqeng_edate,
                :boqeng_postflag
            )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql, $rows, $this->cm);
        return $sv;
    }

    public function SaveBoqEng($params)
    {
        $sv = self::_saveBoqeng($params);
        if (!$sv) {
            header("HTTP/1.0 500 error");
            $this->response = array("msg" => "0", "data" => "Error on Saving Data");
            return json_encode($this->response);
            exit;
        }

        header("http/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "saved");
        return json_encode($this->response);
        exit;
    }

    private function _ProjectBoq($projectno)
    {
        $this->sql = "SELECT *,engboq.totqty as eng_qty,engboq.totarea as eng_area FROM pms_poq as boq 
            inner join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id
            inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
            inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id   
            inner join pms_units as utype on boq.poq_unit = utype.uint_id left join (
                SELECT boqeng_boqid,SUM(boqeng_qty) as totqty , SUM(boqeng_area) as totarea from pms_boqeng group by boqeng_boqid                            
            ) as engboq on boq.poq_id = engboq.boqeng_boqid where boq.poq_project_code = :poq_project_code";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code", $projectno);
        $this->cm->execute();
        $boqs = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $tot = (float) self::enc('denc', $poq_qty) * (float) self::enc('denc', $poq_uprice);
            $area  = ((float) self::enc('denc', $poq_item_width)/1000) * ((float) self::enc('denc', $poq_item_height)/1000);
            $total_area = (float)$area*(float) self::enc('denc', $poq_qty);
            $eng_qty = is_null($eng_qty) ? '0' : (string)$eng_qty;
            $eng_area = is_null($eng_area) ? '0' : (string)$eng_area;
            $eng_balance_qty = (double)self::enc('denc', $poq_qty) - (double) $eng_qty;
            $eng_balance_area = (double)$total_area- (double) $eng_area;
            $prs = 0;
            if((double)self::enc('denc', $poq_qty) === 0){
                $prs = 0;
            }else{
                $prs = (double)$eng_qty / (double)self::enc('denc', $poq_qty) * 100;
            }
            $boq = array(
                'poq_id' => $poq_id,
                'poq_item_no' => self::enc('denc', $poq_item_no),
                'poq_item_type' => $poq_item_type,
                'poq_item_remark' => self::enc('denc', $poq_item_remark),
                'poq_item_width' => (string)((float)self::enc('denc', $poq_item_width)/1000),
                'poq_item_height' => (string)((float)self::enc('denc', $poq_item_height)/1000),
                'poq_item_glass_spec' => self::enc('denc', $poq_item_glass_spec),
                'poq_item_glass_single' => self::enc('denc', $poq_item_glass_single),
                'poq_item_glass_double1' => self::enc('denc', $poq_item_glass_double1),
                'poq_item_glass_double2' => self::enc('denc', $poq_item_glass_double2),
                'poq_item_glass_double3' => self::enc('denc', $poq_item_glass_double3),
                'poq_item_glass_laminate1' => self::enc('denc', $poq_item_glass_laminate1),
                'poq_item_glass_laminate2' => self::enc('denc', $poq_item_glass_laminate2),
                'poq_drawing' => self::enc('denc', $poq_drawing),
                'poq_finish' => $poq_finish,
                'poq_system_type' => $poq_system_type,
                'poq_qty' => (string)self::enc('denc', $poq_qty),
                'poq_unit' => $poq_unit,
                'poq_uprice' => self::enc('denc', $poq_uprice),
                'poq_remark' => self::enc('denc', $poq_remark),
                'poq_cby' => self::enc('denc', $poq_cby),
                'poq_eby' => self::enc('denc', $poq_eby),
                'poq_Cdate' => self::enc('denc', $poq_Cdate),
                'poq_Edate' => self::enc('denc', $poq_Edate),
                'poq_project_code' => self::enc('denc', $poq_project_code),
                'poq_status' => self::enc('denc', $poq_status),
                'unit_name' => self::enc('denc', $unit_name),
                'ptype_name' => self::enc('denc', $ptype_name),
                'system_type_name' => self::enc('denc', $system_type_name),
                'finish_name' => self::enc('denc', $finish_name),
                'tot' => (string)$tot,
                'area' => (string)$area,
                'totalarea' => (string)$total_area,
                "item_aras" => self::enc('denc', $boq_area),
                "eng_qty" => (string)$eng_qty,
                "eng_area" => (string)$eng_area,
                "eng_balance_qty" => (string)$eng_balance_qty,
                "eng_balance_area" => (string)$eng_balance_area,
                "prs" => (string)$prs
            );
            $boqs[] = $boq;
        }
        unset($this->sql, $this->cm, $rows);
        return $boqs;
    }

    public function ProjectBoq($projectno)
    {
        $boqs = self::_ProjectBoq($projectno);
        header("http/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => $boqs);
        return json_encode($this->response);
        exit;
    }

    private function _checkboquser($boqid,$username){
        $this->sql = "SELECT boqeng_id,boqeng_enggname from pms_boqeng where boqeng_id = :boqeng_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boqeng_id",$boqid);
        $this->cm->execute();
        $cnt = $this->cm->rowCount();
        if((int)$cnt === 0){
            return 0;
        }
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $engg = $rows['boqeng_enggname'];
        if($engg !== $username){
            return 1;
        }
        unset($this->sql,$this->cm,$sql);
        return 2;

    }
    private function _remove_boq($boqid){
        $this->sql = "DELETE FROM pms_boqeng where boqeng_id = :boqeng_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":boqeng_id",$boqid);        
        $rm = $this->cm->execute();
        unset($this->sql,$this->cm,$sql);
        return $rm;
    }

    public function RemoveBoqEntry($boqid,$username){
        $_ifa = self::_checkboquser($boqid,$username);
        if($_ifa !== 2){
            $rtext = $_ifa === 0 ? "BOQ ID NOT FOUND" : "YOU CAN NOT REMOVE THIS BOQ RELEASE.";
            $this->response = array("msg" => "0" , "data" => $rtext);
            header("http/1.0 500 Error on update");
            return json_encode($this->response);
            exit;
        }
        $rm = self::_remove_boq($boqid);
        if(!$rm){
            $this->response = array("msg" => "0" , "data" => "Error On Remove BOQ Release");
            header("http/1.0 500 Error");
            return json_encode($this->response);
            exit;
        }
        $this->response = array("msg" => "1"  , "data" => "Data Has Removed");
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }
}

