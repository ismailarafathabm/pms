<?php
date_default_timezone_set('Asia/Riyadh');
require_once 'go_purchase.php';
class GlassOrders extends GOPurchase
{
    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array("msg" => "0", "data" => "Empty Error");
    }

    private function _projectlist()
    {
        $projectlist = [];
        $this->sql = "SELECT project_id,project_no,project_name,project_cname,project_location,projectRegion,Sales_Representative FROM pms_project_summary";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $project = array(
                "project_id" => $project_id,
                "project_no_e" => $project_no,
                "project_no" => $this->enc('denc', $project_no),
                "project_name" => $this->enc('denc', $project_name),
                "project_cname" => $this->enc('denc', $project_cname),
                "project_location" => $this->enc('denc', $project_location),
                "projectRegion" => $this->enc('denc', $projectRegion),
                "Sales_Representative" => $this->enc('denc', $Sales_Representative),
            );
            $projectlist[] = $project;
        }
        unset($this->cm, $this->sql, $rows);
        return $projectlist;
    }

    public function projectlist()
    {
        
        $projectlist = $this->_projectlist();
        $this->response = array("msg" => "1", "data" => $projectlist);
        return json_encode($this->response);
        exit;
    }

    private function pms_glass_order($rows)
    {
        extract($rows);
        //echo "working";
        $cols = array();
        $cols['goid'] = !isset($goid) || trim($goid) === '' ? '0' : $goid;
        $cols['gono'] = !isset($gono) || trim($gono) === '' ? '0' : $gono;
        $cols['godoneby'] = !isset($godoneby) || trim($godoneby) === '' ? '0' : $godoneby;

        $cols['goreldate'] = !isset($goreldate) || trim($goreldate) === '' ? '0' : $goreldate;
        $cols['goreldate_d'] = !isset($goreldate) || trim($goreldate) === '' ? date('d-M-Y') : $this->_date($goreldate, 'd-M-Y');
        $cols['goreldate_n'] = !isset($goreldate) || trim($goreldate) === '' ? date('d-m-Y') : $this->_date($goreldate, 'd-m-Y');
        $cols['goreldate_p'] = !isset($goreldate) || trim($goreldate) === '' ? date('d-m-y') : $this->_date($goreldate, 'd-m-y');

        $cols['gorcdate'] = !isset($gorcdate) || trim($gorcdate) === '' ? '0' : $gorcdate;
        $cols['gorcdate_d'] = !isset($gorcdate) || trim($gorcdate) === '' ? date('d-M-Y') : $this->_date($gorcdate, 'd-M-Y');
        $cols['gorcdate_n'] = !isset($gorcdate) || trim($gorcdate) === '' ? date('d-m-Y') : $this->_date($gorcdate, 'd-m-Y');
        $cols['gorcdate_p'] = !isset($gorcdate) || trim($gorcdate) === '' ? date('d-m-y') : $this->_date($gorcdate, 'd-m-y');

        $cols['gosupplier'] = !isset($gosupplier) || trim($gosupplier) === '' ? '0' : $gosupplier;
        $cols['goglasstype'] = !isset($goglasstype) || trim($goglasstype) === '' ? '0' : $goglasstype;
        $cols['goglassspc'] = !isset($goglassspc) || trim($goglassspc) === '' ? '0' : $goglassspc;
        $cols['goglassthickness'] = !isset($goglassthickness) || trim($goglassthickness) === '' ? '0' : $goglassthickness;
        $cols['gomarkinglocation'] = !isset($gomarkinglocation) || trim($gomarkinglocation) === '' ? '0' : $gomarkinglocation;
        $cols['goglassqty'] = !isset($goglassqty) || trim($goglassqty) === '' ? '0' : $goglassqty;
        $cols['goremark'] = !isset($goremark) || trim($goremark) === '' ? '0' : $goremark;
        $cols['goby'] = !isset($goby) || trim($goby) === '' ? '0' : $goby;
        $cols['goedit'] = !isset($goedit) || trim($goedit) === '' ? '0' : $goedit;

        $cols['gocdate'] = !isset($gocdate) || trim($gocdate) === '' ? '0' : $gocdate;
        $cols['gocdate_d'] = !isset($gocdate) || trim($gocdate) === '' ? date('d-M-Y H:i:s') : $this->_date($gocdate, 'd-M-Y H:i:s');
        $cols['gocdate_n'] = !isset($gocdate) || trim($gocdate) === '' ? date('d-m-Y H:i:s') : $this->_date($gocdate, 'd-m-Y H:i:s');
        $cols['gocdate_p'] = !isset($gocdate) || trim($gocdate) === '' ? date('d-m-y H:i:s') : $this->_date($gocdate, 'd-m-y H:i:s');

        $cols['goeditdate'] = !isset($goeditdate) || trim($goeditdate) === '' ? '0' : $goeditdate;
        $cols['goeditdate_d'] = !isset($goeditdate) || trim($goeditdate) === '' ? date('d-M-Y H:i:s') : $this->_date($goeditdate, 'd-M-Y H:i:s');
        $cols['goeditdate_n'] = !isset($goeditdate) || trim($goeditdate) === '' ? date('d-m-Y H:i:s') : $this->_date($goeditdate, 'd-m-Y H:i:s');
        $cols['goeditdate_p'] = !isset($goeditdate) || trim($goeditdate) === '' ? date('d-m-y H:i:s') : $this->_date($goeditdate, 'd-m-y H:i:s');

        $cols['godate'] = !isset($godate) || trim($godate) === '' ? '0' : $godate;
        $cols['godate_d'] = !isset($godate) || trim($godate) === '' ? date('d-M-Y') : $this->_date($godate, 'd-M-Y');
        $cols['godate_n'] = !isset($godate) || trim($godate) === '' ? date('d-m-Y') : $this->_date($godate, 'd-m-Y');
        $cols['godate_p'] = !isset($godate) || trim($godate) === '' ? date('d-m-y') : $this->_date($godate, 'd-m-y');

        $cols['gotype'] = !isset($gotype) || trim($gotype) === '' ? '0' : $gotype;
        $cols['goproject'] = !isset($goproject) || trim($goproject) === '' ? '0' : $goproject;
        $cols['gostatus'] = !isset($gostatus) || trim($gostatus) === '' ? '0' : $gostatus;

        return $cols;
    }

    private function pms_glass_purchase($rows)
    {
        extract($rows);
        $cols = array();
        $cols['gopid'] = !isset($gopid) || trim($gopid) === '' ? '0' : $gopid;

        $cols['gopdate'] = !isset($gopdate) || trim($gopdate) === '' ? '0' : $gopdate;
        $cols['gopdate_d'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-M-Y') : $this->_date($gopdate, 'd-M-Y');
        $cols['gopdate_n'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-Y') : $this->_date($gopdate, 'd-m-Y');
        $cols['gopdate_p'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-y') : $this->_date($gopdate, 'd-m-y');

        $cols['gopcoating'] = !isset($gopcoating) || trim($gopcoating) === '' ? '0' : $gopcoating;
        $cols['gopinner'] = !isset($gopinner) || trim($gopinner) === '' ? '0' : $gopinner;
        $cols['gopout'] = !isset($gopout) || trim($gopout) === '' ? '0' : $gopout;
        $cols['gopremark'] = !isset($gopremark) || trim($gopremark) === '' ? '0' : $gopremark;
        $cols['goprecdate'] = !isset($goprecdate) || trim($goprecdate) === '' ? '0' : $goprecdate;
        $cols['goprecdate_d'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-M-Y') : $this->_date($goprecdate, 'd-M-Y');
        $cols['goprecdate_n'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-Y') : $this->_date($goprecdate, 'd-m-Y');
        $cols['goprecdate_p'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-y') : $this->_date($goprecdate, 'd-m-y');

        $cols['gopapproveddate'] = !isset($gopapproveddate) || trim($gopapproveddate) === '' ? '0' : $gopapproveddate;
        $cols['gopuiinsert'] = !isset($gopuiinsert) || trim($gopuiinsert) === '' ? '0' : $gopuiinsert;
        $cols['gopcby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;
        $cols['gopeby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;

        $cols['gopcdate'] = !isset($gopcdate) || trim($gopcdate) === '' ? '0' : $gopcdate;
        $cols['gopcdate_d'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopcdate, 'd-M-Y H:i:s');
        $cols['gopcdate_n'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopcdate, 'd-m-Y H:i:s');
        $cols['gopcdate_p'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-y H:i:s') : $this->_date($gopcdate, 'd-m-y H:i:s');

        $cols['gopedate'] = !isset($gopedate) || trim($gopedate) === '' ? '0' : $gopedate;
        $cols['gopedate_d'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopedate, 'd-M-Y H:i:s');
        $cols['gopedate_n'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopedate, 'd-m-Y H:i:s');
        $cols['gopedate_p'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-y H:i:s') : $this->_date($gopedate, 'd-m-y H:i:s');

        $cols['gototsqm'] = !isset($gototsqm) || trim($gototsqm) === '' ? '0' : $gototsqm;
        $cols['goppricepersqm'] = !isset($goppricepersqm) || trim($goppricepersqm) === '' ? '0' : $goppricepersqm;
        $cols['goid'] = !isset($goid) || trim($goid) === '' ? '0' : $goid;
        return $cols;
    }

    private function _getGo($project)
    {
        $this->sql = "SELECT *,
                    pj.project_id,pj.project_name,pj.project_cname,pj.project_location,pj.project_no,pj.Sales_Representative 
                    FROM pms_glass_order as go inner join pms_project_summary as pj on go.goproject=pj.project_id where go.goproject = :goproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goproject", $project);

        $this->cm->execute();
        //echo $this->cm->rowCount();
        $gos = array();
        while ($rows = $this->cm->fetch()) {
            $go = $this->pms_glass_order($rows);

            $go['project_id'] = $rows['project_id'];
            $go['project_name'] = $this->enc('denc', $rows['project_name']);
            $go['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $go['project_location'] = $this->enc('denc', $rows['project_location']);
            $go['project_no'] = $this->enc('denc', $rows['project_no']);
            $go['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $go['project_no_e'] = $rows['project_no'];
            $gos[] = $go;
        }
        unset($this->cm, $this->sql, $rows);
        return $gos;
    }

    private function _getOrderedGo($goproject)
    {
        $this->sql = "SELECT *,
                    pj.project_id,pj.project_name,pj.project_cname,pj.project_location,pj.project_no,pj.Sales_Representative 
                    FROM (pms_glass_order as go inner join pms_project_summary as pj on go.goproject=pj.project_id)
                    right join pms_glass_purchase gop on go.goid=gop.goid where go.goproject = :goproject and go.gostatus='ordered'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goproject", $goproject);

        $this->cm->execute();
        //echo $this->cm->rowCount();
        $gos = array();
        while ($rows = $this->cm->fetch()) {
            $go = $this->pms_glass_order($rows);
            extract($rows);
            $go['project_id'] = $rows['project_id'];
            $go['project_name'] = $this->enc('denc', $rows['project_name']);
            $go['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $go['project_location'] = $this->enc('denc', $rows['project_location']);
            $go['project_no'] = $this->enc('denc', $rows['project_no']);
            $go['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $go['project_no_e'] = $rows['project_no'];
            $go['gopid'] = !isset($gopid) || trim($gopid) === '' ? '0' : $gopid;

            $go['gopdate'] = !isset($gopdate) || trim($gopdate) === '' ? '0' : $gopdate;
            $go['gopdate_d'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-M-Y') : $this->_date($gopdate, 'd-M-Y');
            $go['gopdate_n'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-Y') : $this->_date($gopdate, 'd-m-Y');
            $go['gopdate_p'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-y') : $this->_date($gopdate, 'd-m-y');

            $go['gopcoating'] = !isset($gopcoating) || trim($gopcoating) === '' ? '0' : $gopcoating;
            $go['gopinner'] = !isset($gopinner) || trim($gopinner) === '' ? '0' : $gopinner;
            $go['gopout'] = !isset($gopout) || trim($gopout) === '' ? '0' : $gopout;
            $go['gopremark'] = !isset($gopremark) || trim($gopremark) === '' ? '0' : $gopremark;
            $go['goprecdate'] = !isset($goprecdate) || trim($goprecdate) === '' ? '0' : $goprecdate;
            $go['goprecdate_d'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-M-Y') : $this->_date($goprecdate, 'd-M-Y');
            $go['goprecdate_n'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-Y') : $this->_date($goprecdate, 'd-m-Y');
            $go['goprecdate_p'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-y') : $this->_date($goprecdate, 'd-m-y');

            $go['gopapproveddate'] = !isset($gopapproveddate) || trim($gopapproveddate) === '' ? '0' : $gopapproveddate;
            $go['gopuiinsert'] = !isset($gopuiinsert) || trim($gopuiinsert) === '' ? '0' : $gopuiinsert;
            $go['gopcby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;
            $go['gopeby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;

            $go['gopcdate'] = !isset($gopcdate) || trim($gopcdate) === '' ? '0' : $gopcdate;
            $go['gopcdate_d'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopcdate, 'd-M-Y H:i:s');
            $go['gopcdate_n'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopcdate, 'd-m-Y H:i:s');
            $go['gopcdate_p'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-y H:i:s') : $this->_date($gopcdate, 'd-m-y H:i:s');

            $go['gopedate'] = !isset($gopedate) || trim($gopedate) === '' ? '0' : $gopedate;
            $go['gopedate_d'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopedate, 'd-M-Y H:i:s');
            $go['gopedate_n'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopedate, 'd-m-Y H:i:s');
            $go['gopedate_p'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-y H:i:s') : $this->_date($gopedate, 'd-m-y H:i:s');

            $go['gototsqm'] = !isset($gototsqm) || trim($gototsqm) === '' ? '0' : $gototsqm;
            $go['goppricepersqm'] = !isset($goppricepersqm) || trim($goppricepersqm) === '' ? '0' : $goppricepersqm;
            $go['goid'] = !isset($goid) || trim($goid) === '' ? '0' : $goid;

            $gos[] = $go;
        }
        unset($this->cm, $this->sql, $rows);
        return $gos;
    }


    public function getOrderedGo($goproject)
    {
        $gos = $this->_getOrderedGo($goproject);
        $this->response = array(
            "msg" => "1", "data" => $gos,
        );
        return json_encode($this->response);
    }

    public function getGo($goproject)
    {
        $gos = $this->_getGo($goproject);

        $this->response = array(
            "msg" => '1',
            "data" => $gos
        );

        return json_encode($this->response);
        exit;
    }
    private function unsetall()
    {
        unset($this->sql, $rows, $this->cm);
    }
    private function _checkgoinfo($goid)
    {
        $this->sql = "SELECT count(*) as cnt from pms_glass_order where goid = :goid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $goid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($rows, $this->cm, $this->sql);
        return $cnt;
    }

    private function _getGoinfo($goid)
    {
        $this->sql = "SELECT *,pj.project_id,pj.project_name,pj.project_cname,pj.project_location,pj.project_no,pj.Sales_Representative 
         from pms_glass_order as go inner join pms_project_summary as pj on go.goproject=pj.project_id where go.goid = :goid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $goid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $go = $this->pms_glass_order($rows);
        $go['project_id'] = $rows['project_id'];
        $go['project_name'] = $this->enc('denc', $rows['project_name']);
        $go['project_cname'] = $this->enc('denc', $rows['project_cname']);
        $go['project_location'] = $this->enc('denc', $rows['project_location']);
        $go['project_no'] = $this->enc('denc', $rows['project_no']);
        $go['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
        $go['project_no_e'] = $rows['project_no'];
        $this->unsetall();
        return $go;
    }

    public function getGoInfo($goid)
    {
        $cnt = $this->_checkgoinfo($goid);
        if ($cnt !== 1) {
            $this->response = array(
                "msg" => '0',
                "data" => "no data found"
            );
            return json_encode($this->response);
            exit;
        }
        $go = $this->_getGoinfo($goid);
        $this->response = array(
            'msg' => "1",
            'data' => $go
        );
        //print_r($this->response);
        return json_encode($this->response);
        exit;
    }

    private function _orderdGoInfo($goid)
    {
        $this->sql = "SELECT *,
        pj.project_id,pj.project_name,pj.project_cname,pj.project_location,pj.project_no,pj.Sales_Representative 
        FROM (pms_glass_order as go inner join pms_project_summary as pj on go.goproject=pj.project_id)
        right join pms_glass_purchase gop on go.goid=gop.goid where go.goid = :goid and go.gostatus='ordered'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $goid);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $go = $rows = $this->cm->fetch();
            $go = $this->pms_glass_order($rows);
            extract($rows);
            $go['project_id'] = $rows['project_id'];
            $go['project_name'] = $this->enc('denc', $rows['project_name']);
            $go['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $go['project_location'] = $this->enc('denc', $rows['project_location']);
            $go['project_no'] = $this->enc('denc', $rows['project_no']);
            $go['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $go['project_no_e'] = $rows['project_no'];
            $go['gopid'] = !isset($gopid) || trim($gopid) === '' ? '0' : $gopid;

            $go['gopdate'] = !isset($gopdate) || trim($gopdate) === '' ? '0' : $gopdate;
            $go['gopdate_d'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-M-Y') : $this->_date($gopdate, 'd-M-Y');
            $go['gopdate_n'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-Y') : $this->_date($gopdate, 'd-m-Y');
            $go['gopdate_p'] = !isset($gopdate) || trim($gopdate) === '' ? date('d-m-y') : $this->_date($gopdate, 'd-m-y');

            $go['gopcoating'] = !isset($gopcoating) || trim($gopcoating) === '' ? '0' : $gopcoating;
            $go['gopinner'] = !isset($gopinner) || trim($gopinner) === '' ? '0' : $gopinner;
            $go['gopout'] = !isset($gopout) || trim($gopout) === '' ? '0' : $gopout;
            $go['gopremark'] = !isset($gopremark) || trim($gopremark) === '' ? '0' : $gopremark;
            $go['goprecdate'] = !isset($goprecdate) || trim($goprecdate) === '' ? '0' : $goprecdate;
            $go['goprecdate_d'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-M-Y') : $this->_date($goprecdate, 'd-M-Y');
            $go['goprecdate_n'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-Y') : $this->_date($goprecdate, 'd-m-Y');
            $go['goprecdate_p'] = !isset($goprecdate) || trim($goprecdate) === '' ? date('d-m-y') : $this->_date($goprecdate, 'd-m-y');

            $go['gopapproveddate'] = !isset($gopapproveddate) || trim($gopapproveddate) === '' ? '0' : $gopapproveddate;
            $go['gopuiinsert'] = !isset($gopuiinsert) || trim($gopuiinsert) === '' ? '0' : $gopuiinsert;
            $go['gopcby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;
            $go['gopeby'] = !isset($gopeby) || trim($gopeby) === '' ? '0' : $gopeby;

            $go['gopcdate'] = !isset($gopcdate) || trim($gopcdate) === '' ? '0' : $gopcdate;
            $go['gopcdate_d'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopcdate, 'd-M-Y H:i:s');
            $go['gopcdate_n'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopcdate, 'd-m-Y H:i:s');
            $go['gopcdate_p'] = !isset($gopcdate) || trim($gopcdate) === '' ? date('d-m-y H:i:s') : $this->_date($gopcdate, 'd-m-y H:i:s');

            $go['gopedate'] = !isset($gopedate) || trim($gopedate) === '' ? '0' : $gopedate;
            $go['gopedate_d'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-M-Y H:i:s') : $this->_date($gopedate, 'd-M-Y H:i:s');
            $go['gopedate_n'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-Y H:i:s') : $this->_date($gopedate, 'd-m-Y H:i:s');
            $go['gopedate_p'] = !isset($gopedate) || trim($gopedate) === '' ? date('d-m-y H:i:s') : $this->_date($gopedate, 'd-m-y H:i:s');

            $go['gototsqm'] = !isset($gototsqm) || trim($gototsqm) === '' ? '0' : $gototsqm;
            $go['goppricepersqm'] = !isset($goppricepersqm) || trim($goppricepersqm) === '' ? '0' : $goppricepersqm;
            $go['goid'] = !isset($goid) || trim($goid) === '' ? '0' : $goid;
        
        unset($this->cm, $this->sql, $rows);
        return $go;
    }

    public function orderdGoInfo($goid){
        $cnt = $this->_checkgoinfo($goid);
        if($cnt !== 1){
            $this->response = array("msg" => '0' , "data" => "No Recoard Found");
            return json_encode($this->response);
            exit;
        }
        $go = $this->_orderdGoInfo($goid);
        $this->response = array("msg" => "1" , "data" => $go );
        return json_encode($this->response);
        exit;
        
    }

    private function _savego($params)
    {
        $this->sql = "INSERT into pms_glass_order values(
            null,
            :gono,
            :godoneby,
            :goreldate,
            :gorcdate,
            :gosupplier,
            :goglasstype,
            :goglassspc,
            :goglassthickness,
            :gomarkinglocation,
            :goglassqty,
            :goremark,
            :goby,
            :goedit,
            :gocdate,
            :goeditdate,
            :godate,
            :gotype,
            :goproject,
            :gostatus
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        $this->unsetall();
        return $sv;
    }

    public function saveGo($params)
    {
        $sv = $this->_savego($params);
        $project = $params[':goproject'];
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on saveing data"
            );
            return json_encode($this->response);
            exit;
        }
        $gos = $this->_getGo($project);
        $this->response = array(
            "msg" => '1',
            "data" => $gos
        );

        return json_encode($this->response);
        exit;
    }

    private function _goupdate($params)
    {
        $this->sql = "UPDATE pms_glass_order set 
        gono = :gono,
        godoneby = :godoneby,
        goreldate = :goreldate,
        gorcdate = :gorcdate,
        gosupplier = :gosupplier,
        goglasstype = :goglasstype,
        goglassspc = :goglassspc,
        goglassthickness = :goglassthickness,
        gomarkinglocation = :gomarkinglocation,
        goglassqty = :goglassqty,
        goremark = :goremark,
        goedit = :goedit,
        goeditdate = :goeditdate,
        gotype = :gotype,
        gostatus = :gostatus 
        where 
        goid = :goid";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        $this->unsetall();
        return $sv;
    }

    public function goUpdate($params, $project)
    {
        $sv = $this->_goupdate($params);

        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on update data"
            );
            return json_encode($this->response);
            exit;
        }
        $gos = $this->_getGo($project);
        $this->response = array(
            "msg" => '1',
            "data" => $gos
        );
        return json_encode($this->response);
        exit;
    }
}
