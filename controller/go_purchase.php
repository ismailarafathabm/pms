<?php
require_once 'go_budget.php';
class GOPurchase extends GO_BUDGET
{
    private function pms_glass_order_purchase($rows)
    {
        extract($rows);
        $cols = [];
        
        $cols['gopid'] = !isset($gopid) || trim($gopid) === "" ? "0" : $gopid;
        $cols['gopno'] = !isset($gopno) || trim($gopno) === "" ? "0" : $gopno;

        $cols['gopdate'] = !isset($gopdate) || trim($gopdate) === "" ? "0" : $gopdate;
        $cols['gopdate_d'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-M-Y') : $this->_date($gopdate,'d-M-Y');
        $cols['gopdate_n'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-Y') : $this->_date($gopdate,'d-m-Y');
        $cols['gopdate_p'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-y') : $this->_date($gopdate,'d-m-y');

        $cols['gopproject'] = !isset($gopproject) || trim($gopproject) === "" ? "0" : $gopproject;
        $cols['gopsalesrep'] = !isset($gopsalesrep) || trim($gopsalesrep) === "" ? "0" : $gopsalesrep;
        $cols['gopglassdesc'] = !isset($gopglassdesc) || trim($gopglassdesc) === "" ? "0" : $gopglassdesc;
        $cols['gopglasstype'] = !isset($gopglasstype) || trim($gopglasstype) === "" ? "0" : $gopglasstype;
        $cols['gopglasstotalarea'] = !isset($gopglasstotalarea) || trim($gopglasstotalarea) === "" ? "0" : $gopglasstotalarea;
        $cols['gopglassqty'] = !isset($gopglassqty) || trim($gopglassqty) === "" ? "0" : $gopglassqty;
        $cols['gopglasspricepersqm'] = !isset($gopglasspricepersqm) || trim($gopglasspricepersqm) === "" ? "0" : $gopglasspricepersqm;
        $cols['gopglasstotalamount'] = !isset($gopglasstotalamount) || trim($gopglasstotalamount) === "" ? "0" : $gopglasstotalamount;
        $cols['gopcby'] = !isset($gopcby) || trim($gopcby) === "" ? "0" : $gopcby;
        $cols['gopeby'] = !isset($gopeby) || trim($gopeby) === "" ? "0" : $gopeby;
        $cols['gopcdate'] = !isset($gopcdate) || trim($gopcdate) === "" ? "0" : $gopcdate;
        $cols['gopedate'] = !isset($gopedate) || trim($gopedate) === "" ? "0" : $gopedate;
        $cols['gopbudgetid'] = !isset($gopbudgetid) || trim($gopbudgetid) === "" ? "0" : $gopbudgetid;
        return $cols;
    }

    private function _glassorderhistory($gopbudgetid)
    {
        $this->sql = "SELECT * FROM (pms_glass_order_purchase as go inner join pms_project_summary as pj on go.gopproject = pj.project_id) 
        inner join pms_glass_budget as gp on go.gopbudgetid = gp.gbudgetid where go.gopbudgetid = :gopbudgetid ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':gopbudgetid', $gopbudgetid);
        $this->cm->execute();
        $gosp = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $go = $this->pms_glass_order_purchase($rows);
            
            $go['project_id'] = $project_id;
            $go['project_no_e'] = $project_no;
            $go['project_no'] = $this->enc('denc', $project_no);
            $go['project_cname'] = $this->enc('denc', $project_cname);
            $go['Sales_Representative'] = $this->enc('denc', $Sales_Representative);
            $go['gbudgetarea'] = $gbudgetarea;
            $go['gbudgetbtotal'] = $gbudgetbtotal;
            $gosp[] = $go;
        }
        unset($this->cm, $this->sql, $rows);
        return $gosp;
    }

    public function glassorderbybugetid($gopbudgetid){
        $gosp = $this->_glassorderhistory($gopbudgetid);
        $this->response = array(
            'msg' => '1',
            'data' => $gosp
        );

        return json_encode($this->response);
        exit;
    }

    private function _glassorderproject($gopproject)
    {
        $this->sql = "SELECT * FROM (pms_glass_order_purchase as go inner join pms_project_summary as pj on go.gopproject = pj.project_id) 
        inner join pms_glass_budget as gp on go.gopbudgetid = gp.gbudgetid where go.gopproject = :gopproject ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':gopproject', $gopproject);
        $this->cm->execute();
        $gosp = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $go = $this->pms_glass_order_purchase($rows);
            extract($rows);
            $go['project_id'] = $project_id;
            $go['project_no_e'] = $project_no;
            $go['project_no'] = $this->enc('denc', $project_no);
            $go['project_cname'] = $this->enc('denc', $project_cname);
            $go['Sales_Representative'] = $this->enc('denc', $Sales_Representative);
            $go['gbudgetarea'] = $gbudgetarea;
            $go['gbudgetbtotal'] = $gbudgetbtotal;
            $gosp[] = $go;
        }
        unset($this->cm, $this->sql, $rows);
        return $gosp;
    }

    public function Glassorderpurchase($gopproject)
    {
        $gosp = $this->_glassorderproject($gopproject);
        $this->response = array(
            "msg" => "1",
            "data" => $gosp
        );

        return json_encode($this->response);
        exit;
    }

    private function _checkglassorderinfo($gopid){
        $this->sql = "SELECT count(*) as cnt from pms_glass_order_purchase where gopid = :gopid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gopid",$gopid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        return $cnt;
    }
    private function _getglassorderinfo($gopid)
    {
        $this->sql = "SELECT * FROM (pms_glass_order_purchase as go inner join pms_project_summary as pj on go.gopproject = pj.project_id) 
        inner join pms_glass_budget as gp on go.gopbudgetid = gp.gbudgetid where go.gopid = :gopid ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':gopid', $gopid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $go = $this->pms_glass_order_purchase($rows);
        extract($rows);
        $go['project_id'] = $project_id;
        $go['project_no_e'] = $project_no;
        $go['project_no'] = $this->enc('denc', $project_no);
        $go['project_cname'] = $this->enc('denc', $project_cname);
        $go['Sales_Representative'] = $this->enc('denc', $Sales_Representative);
        $go['gbudgetarea'] = $gbudgetarea;
        $go['gbudgetbtotal'] = $gbudgetbtotal;
        unset($this->cm,$this->sql,$rows);
        return $go;
    }

    public function getGlassorderinfo($gopid){
        $cnt = $this->_checkglassorderinfo($gopid);
        if($cnt !== 1){
            $this->response = array("msg" => "0" , "data" => "Error on save data");
            return json_encode($this->response);
            exit;
        }
        $goinfo = $this->_getglassorderinfo($gopid);
        $this->response = array("msg" => "1", "data" => $goinfo);
        return json_encode($this->response);
        exit;
    }

    private function _saveglassorder($params){
        $this->sql = "insert into pms_glass_order_purchase values(
            null,
            :gopno,
            :gopdate,
            :gopproject,
            :gopsalesrep,
            :gopglassdesc,
            :gopglasstype,
            :gopglasstotalarea,
            :gopglassqty,
            :gopglasspricepersqm,
            :gopglasstotalamount,
            :gopcby,
            :gopeby,
            :gopcdate,
            :gopedate,
            :gopbudgetid
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql,$this->cm);
        return $sv;
    }

    public function SaveGlassorders($params,$projectno){
        $sv = $this->_saveglassorder($params);
        if(!$sv){
            $this->response = array("msg" => "0", "data" => "no data found");
            return json_encode($this->response);
            exit;
        }
        $gopproject = $projectno;
        $gosp = $this->_glassorderproject($gopproject);
        $this->response = array("msg" => "1", "data" => $gosp);
        return json_encode($this->response);
        exit;
    }

    private function _updateglassorder($params){
        $this->sql = "UPDATE pms_glass_order_purchase set 
        gopno = :gopno,
        gopdate = :gopdate,
        gopglassdesc = :gopglassdesc,
        gopglasstype = :gopglasstype,
        gopglasstotalarea = :gopglasstotalarea,
        gopglassqty = :gopglassqty,
        gopglasspricepersqm = :gopglasspricepersqm,
        gopglasstotalamount = :gopglasstotalamount,
        gopeby = :gopeby,
        gopedate = :gopedate,
        gopbudgetid = :gopbudgetid 
        where 
        gopid = :gopid
        ";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql,$this->cm);
        return $sv;
    }

    public function UpdateGlassorders($params,$gopproject){
        $sv = $this->_updateglassorder($params);
        if(!$sv){
            $this->response = array("msg" => "0", "data" => "Error on save data");
            return json_encode($this->response);
            exit;
        }
        
        $gosp = $this->_glassorderproject($gopproject);
        $this->response = array("msg" => "1", "data" => $gosp);
        return json_encode($this->response);
        exit;
    }
    
}
