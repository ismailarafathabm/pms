<?php
require_once 'mac.php';
class MattoBeLoad extends mac
{
    private $cn, $cm, $sql;
    function __construct($db)
    {
        $this->cn = $db;
    }
    private function pms_project_summary($rows)
    {
        extract($rows);
        $cos = [];
        $cos['project_no'] = !isset($project_no) || trim($project_no) === "" ? "0" : $this->enc('denc', $project_no);
        $cos['project_name'] = !isset($project_name) || trim($project_name) === "" ? "0" : $this->enc('denc', $project_name);
        $cos['project_location'] = !isset($project_location) || trim($project_location) === "" ? "0" : $this->enc('denc', $project_location);
        return $cos;
    }
    private function _loadAllProjects()
    {
        $this->sql = "SELECT project_no,project_name,project_location FROM pms_project_summary";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $projects = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $project = $this->pms_project_summary($rows);
            $projects[] = $project;
        }
        unset($this->sql, $this->cm, $rows);
        return $projects;
    }
    public function LoadAllProjects()
    {
        return json_encode(array("msg" => "1", "data" => $this->_loadAllProjects()));
        exit;
    }

    private function _checkProject($project_no)
    {
        $this->sql = "SELECT COUNT(*) as cnt from pms_project_summary where project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_no", $project_no);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows;
        unset($rows, $this->sql, $this->cm);
        return $cnt;
    }

    private function _getInfoOfProject($project_no)
    {
        $this->sql = "SELECT project_no,project_name,project_location FROM pms_project_summary  where project_no=:project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_no", $project_no);
        $this->cm->execute();
        $rows = $this->cm->prepare($this->sql);
        $project = $this->pms_project_summary($rows);
        unset($this->cm, $this->sql, $rows);
        return $project;
    }

    public function GetInfoOfProject($project_no)
    {
        $enc_project_no = $this->enc('enc', $project_no);
        $cnt = $this->_checkProject($enc_project_no);
        if ($cnt !== 1) {
            return json_encode(array("msg" => "0", "data" => "This Project Not Found"));
            exit;
        }
        return json_encode(array("msg" => "1", "data" => $this->_getInfoOfProject($enc_project_no)));
        exit;
    }

    private function _LoadAllUnits()
    {
        $this->sql = "SELECT *FROM bom_units";
        $this->cm  = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $units = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $unit = array(
                "unitid" => $rows['unitid'],
                "unitname" => $rows['unitname'],
            );
            $units[] = $unit;
        }
        unset($this->cm, $this->sql, $rows);
        return $units;
    }

    public function LoadAllUnits()
    {
        return json_encode(array("msg" => "1", "data" => $this->_LoadAllUnits()));
        exit;
    }

    private function pms_mat_tobeloaded($rows)
    {
        extract($rows);
        $cols = [];
        $cols['loadid'] = !isset($loadid) || trim($loadid) === "" ? "0" : $loadid;

        $cols['loaddate'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "Y-m-d");
        $cols['loaddate_n'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-m-Y");
        $cols['loaddate_d'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-M-Y");
        $cols['loaddate_p'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-m-Y");


        $cols['loadproject'] = !isset($loadproject) || trim($loadproject) === "" ? "0" : $loadproject;
        $cols['location'] = !isset($location) || trim($location) === "" ? "0" : $location;
        $cols['description'] = !isset($description) || trim($description) === "" ? "0" : $description;

        $cols['qty'] = !isset($qty) || trim($qty) === "" ? "0" : $qty;
        $cols['unit'] = !isset($unit) || trim($unit) === "" ? "0" : $unit;
        $cols['driver'] = !isset($driver) || trim($driver) === "" ? "0" : $driver;

        $cols['estimatedate'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "Y-m-d");
        $cols['estimatedate_n'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-m-Y");
        $cols['estimatedate_d'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-M-Y");
        $cols['estimatedate_p'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-m-Y");

        $cols['loadingdate'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "Y-m-d");
        $cols['loadingdate_n'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-m-Y");
        $cols['loadingdate_d'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-M-Y");
        $cols['loadingdate_p'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-m-Y");

        $cols['estimatetositedate'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "Y-m-d");
        $cols['estimatetositedate_n'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-m-Y");
        $cols['estimatetositedate_d'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-M-Y");
        $cols['estimatetositedate_p'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-m-Y");


        $cols['ascurrentdate'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "Y-m-d");
        $cols['ascurrentdate_n'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-m-Y");
        $cols['ascurrentdate_d'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-M-Y");
        $cols['ascurrentdate_p'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-m-Y");

        $cols['remark'] = !isset($remark) || trim($remark) === "" ? "0" : $remark;
        $cols['status'] = !isset($status) || trim($status) === "" ? "" : $status;
        $cols['rvno'] = !isset($rvno) || trim($rvno) === "" ? "" : $rvno;
        $cols['cby'] = !isset($cby) || trim($cby) === "" ? "" : $cby;
        $cols['eby'] = !isset($eby) || trim($eby) === "" ? "" : $eby;
        $cols['cdate'] = !isset($cdate) || trim($cdate) === "" ? date('Y-m-d') : $this->_date($cdate, "Y-m-d H:i:s");
        $cols['edate'] = !isset($edate) || trim($edate) === "" ? date('Y-m-d') : $this->_date($edate, "Y-m-d H:i:s");

        $cols['pjcno'] = !isset($pjcno) || trim($pjcno) === "" ? "0" : $pjcno;
        $cols['pjcnoenc'] = !isset($pjcnoenc) || trim($pjcnoenc) === "" ? "0" : $pjcnoenc;

        $cols['project_type'] = !isset($project_type) || trim($project_type) === "" ? "0" : $this->enc('denc', $project_type);
        $cols['project_status'] = !isset($project_status) || trim($project_status) === "" ? "0" : $this->enc('denc', $project_status);
        $cols['Sales_Representative'] = !isset($Sales_Representative) || trim($Sales_Representative) === "" ? "0" : $this->enc('denc', $Sales_Representative);
        $cols['projectRegion'] = !isset($projectRegion) || trim($projectRegion) === "" ? "0" : $this->enc('denc', $projectRegion);
        $cols['area'] = !isset($area) || trim($area) === "" ? "0" : $area;
        $cols['invno'] = !isset($invno) || trim($invno) === "" ? "0" : $invno;

        //deley calc
        $delay = 0;
        $a = date_create($loadingdate);
        $b = date_create($ascurrentdate);
        $diffn=date_diff($a,$b);
        $delay = $diffn->format("%R%a");
        $cols['delay'] = $delay;

        $load_diff = 0;
        $_e_l = date_create($estimatedate);
        $_c_l = date_create($loadingdate);
        $diff=date_diff($_e_l,$_c_l);
        $load_diff = $diff->format("%R%a");
        $cols['load_diff'] = $load_diff;
        
        $atsite_diff = 0;
        $_e_s = date_create($estimatetositedate);
        $_c_s = date_create($ascurrentdate);
        $diffx=date_diff($_e_s,$_c_s);
        $atsite_diff = $diffx->format("%R%a");
        $cols['atsite_diff'] = $atsite_diff;

        return $cols;
    }

    
    private function pms_mat_tobeloaded_sub($rows)
    {
        extract($rows);
        $cols = [];
        $cols['loadid'] = !isset($loadid) || trim($loadid) === "" ? "0" : $loadid;

        $cols['loaddate'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "Y-m-d");
        $cols['loaddate_n'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-m-Y");
        $cols['loaddate_d'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-M-Y");
        $cols['loaddate_p'] = !isset($loaddate) || trim($loaddate) === "" ? date('Y-m-d') : $this->_date($loaddate, "d-m-Y");


        $cols['loadproject'] = !isset($loadproject) || trim($loadproject) === "" ? "0" : $loadproject;
        $cols['location'] = !isset($location) || trim($location) === "" ? "0" : $location;
        $cols['description'] = !isset($description) || trim($description) === "" ? "0" : $description;

        $cols['qty'] = !isset($qty) || trim($qty) === "" ? "0" : $qty;
        $cols['unit'] = !isset($unit) || trim($unit) === "" ? "0" : $unit;
        $cols['driver'] = !isset($driver) || trim($driver) === "" ? "0" : $driver;

        $cols['estimatedate'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "Y-m-d");
        $cols['estimatedate_n'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-m-Y");
        $cols['estimatedate_d'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-M-Y");
        $cols['estimatedate_p'] = !isset($estimatedate) || trim($estimatedate) === "" ? date('Y-m-d') : $this->_date($estimatedate, "d-m-Y");

        $cols['loadingdate'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "Y-m-d");
        $cols['loadingdate_n'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-m-Y");
        $cols['loadingdate_d'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-M-Y");
        $cols['loadingdate_p'] = !isset($loadingdate) || trim($loadingdate) === "" ? date('Y-m-d') : $this->_date($loadingdate, "d-m-Y");

        $cols['estimatetositedate'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "Y-m-d");
        $cols['estimatetositedate_n'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-m-Y");
        $cols['estimatetositedate_d'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-M-Y");
        $cols['estimatetositedate_p'] = !isset($estimatetositedate) || trim($estimatetositedate) === "" ? date('Y-m-d') : $this->_date($estimatetositedate, "d-m-Y");


        $cols['ascurrentdate'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "Y-m-d");
        $cols['ascurrentdate_n'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-m-Y");
        $cols['ascurrentdate_d'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-M-Y");
        $cols['ascurrentdate_p'] = !isset($ascurrentdate) || trim($ascurrentdate) === "" ? date('Y-m-d') : $this->_date($ascurrentdate, "d-m-Y");

        $cols['remark'] = !isset($remark) || trim($remark) === "" ? "0" : $remark;
        $cols['status'] = !isset($status) || trim($status) === "" ? "" : $status;
        $cols['rvno'] = !isset($rvno) || trim($rvno) === "" ? "" : $rvno;
        $cols['cby'] = !isset($cby) || trim($cby) === "" ? "" : $cby;
        $cols['eby'] = !isset($eby) || trim($eby) === "" ? "" : $eby;
        $cols['cdate'] = !isset($cdate) || trim($cdate) === "" ? date('Y-m-d') : $this->_date($cdate, "Y-m-d H:i:s");
        $cols['edate'] = !isset($edate) || trim($edate) === "" ? date('Y-m-d') : $this->_date($edate, "Y-m-d H:i:s");
        $cols['iscurrent'] = !isset($iscurrent) || trim($iscurrent) === "" ? "0" : $iscurrent;
        $cols['pjcno'] = !isset($pjcno) || trim($pjcno) === "" ? "0" : $pjcno;
        $cols['main_load_id'] = !isset($main_load_id) || trim($main_load_id) === "" ? "0" : $main_load_id;
        $cols['pjcnoenc'] = !isset($pjcnoenc) || trim($pjcnoenc) === "" ? "0" : $pjcnoenc;        
        $cols['area'] = !isset($area) || trim($area) === "" ? "0" : $area;
        $cols['invno'] = !isset($invno) || trim($invno) === "" ? "0" : $invno;
        return $cols;
    }
    private function _GetReport($params)
    {
        // $st = $params[':st'];
        // $en = $params[":en"];
        // $sql = "SELECT *FROM pms_mat_tobeloaded where loaddate>= '$st' and loaddate<= '$en'";
        // echo $sql;
        $this->sql = "SELECT *,pj.project_type,pj.project_status,pj.Sales_Representative,pj.projectRegion FROM pms_mat_tobeloaded as ml inner join pms_project_summary as pj on ml.pjcnoenc=pj.project_no where loaddate>= :st and loaddate<= :en";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $mtbls = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $mtbl = $this->pms_mat_tobeloaded($rows);
            $mtbls[] = $mtbl;
        }

        unset($this->cm, $this->sql, $rows);
        return $mtbls;
    }

    public function GetReport($params)
    {
        return json_encode(array("msg" => "1", "data" => $this->_GetReport($params)));
        exit;
    }

    private function _getRptByProject($pjcno)
    {
        $this->sql = "SELECT *,pj.project_type,pj.project_status,pj.Sales_Representative,pj.projectRegion 
                    FROM pms_mat_tobeloaded as ml inner join pms_project_summary as pj on ml.pjcnoenc=pj.project_no where loadproject=:loadproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":loadproject", $pjcno);
        $this->cm->execute();
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $mtbl = $this->pms_mat_tobeloaded($rows);
            $mtbls[] = $mtbl;
        }
        unset($this->sql, $this->cm, $sql);
        return $mtbls;
    }

    public function getRptByProject($loadproject)
    {
        return json_encode(array("msg" => "1", "data" => $this->_getRptByProject($loadproject)));
        exit;
    }


    private function _checkInfo($loadid)
    {
        $this->sql = "SELECT COUNT(loadid) as cnt from pms_mat_tobeloaded where loadid=:loadid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":loadid", $loadid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }
    private function _getInfoByid($loadid)
    {
        $this->sql = "SELECT *,pj.project_type,pj.project_status,pj.Sales_Representative,pj.projectRegion 
        FROM pms_mat_tobeloaded as ml inner join pms_project_summary as pj on ml.pjcnoenc=pj.project_no where loadid=:loadid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":loadid", $loadid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $mtbl = $this->pms_mat_tobeloaded($rows);
        unset($this->cm, $this->sql, $rows);
        return $mtbl;
    }

    public function getInfo($loadid){
        //check load id 
        $cnt = $this->_checkinfo($loadid);
        if($cnt !== 1) {
            return json_encode(array("msg" => "0" , "data" => "This Details Not Availble"));
            exit;
        }
        $info = $this->_getInfoByid($loadid);
        return json_encode(array("msg" => "1" , "data" => $info));
        exit;
    }



    private function _GetSupReport($main_load_id)
    {
        $this->sql = "SELECT 
        *FROM pms_mat_tobeloaded_sub where main_load_id=:main_load_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":main_load_id", $main_load_id);
        $this->cm->execute();
        $subitems = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $subitem = $this->pms_mat_tobeloaded_sub($rows);
            $subitems[] = $subitem;
        }

        unset($this->cm, $this->sql, $rows);
        return $subitems;
    }

    public function GetSupReport($main_load_id)
    {
        return json_encode(array("msg" => "1", "data" => $this->_GetSupReport($main_load_id)));
        exit;
    }

    private function revisionnoget($main_load_id)
    {
        $this->sql = "SELECT COUNT(main_load_id) as cnt FROM pms_mat_tobeloaded_sub where main_load_id=:main_load_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":main_load_id", $main_load_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql);
        return $cnt;
    }

    private function noncurrent($main_load_id)
    {
        $this->sql = "UPDATE pms_mat_tobeloaded_sub set iscurrent='0' where main_load_id=:main_load_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":main_load_id", $main_load_id);
        $this->cm->execute();
        unset($this->cm, $this->sql);
    }

    private function _save($params)
    {
        //print_r($params);
        $this->sql = "INSERT INTO pms_mat_tobeloaded values(
            null,
            :loaddate,
            :loadproject,
            :location,
            :description,
            :qty,
            :unit,
            :driver,
            :estimatedate,
            :loadingdate,
            :estimatetositedate,
            :ascurrentdate,
            :remark,
            :status,
            :rvno,
            :cby,
            :eby,
            :cdate,
            :edate,
            :pjcno,
            :pjcnoenc
        )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);

        unset($this->cm, $this->sql);
        if (!$sv) {
            $cuno = 0;
            return $cuno;
        }

        $cuno = $this->cn->lastInsertId();
        return $cuno;
    }

    private function _SaveSub($p2)
    {
        //print_r($p2);
        $this->sql = "INSERT INTO pms_mat_tobeloaded_sub values(
            null,
            :loaddate,
            :loadproject,
            :location,
            :description,
            :qty,
            :unit,
            :driver,
            :estimatedate,
            :loadingdate,
            :estimatetositedate,
            :ascurrentdate,
            :remark,
            :status,
            :rvno,
            :cby,
            :eby,
            :cdate,
            :edate,
            :iscurrent,
            :pjcno,
            :main_load_id,
            :pjcnoenc
        )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($p2);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function Save($p1, $p2, $loadparams)
    {
        $sno = $this->_save($p1);
        if ($sno === 0) {
            return json_encode(array("msg" => "0", "data" => "Error found On Saving Data"));
            exit;
        }
        $p2[':main_load_id'] = $sno;
        $p2[':iscurrent'] = "1";

        $sv = $this->_SaveSub($p2);
        if (!$sv) {
            return json_encode(array("msg" => "0", "data" => "Error Found on Saveing Sub Table"));
            exit;
        }
        $datas = $this->_GetReport($loadparams);
        return json_encode(array("msg" => "1", "data" => $datas));
        exit;
    }

    private function _update($params)
    {
        $this->sql = "UPDATE pms_mat_tobeloaded set 
                    qty=:qty,
                    unit = :unit,
                    driver = :driver,        
                    loadingdate = :loadingdate,
                    ascurrentdate = :ascurrentdate,
                    remark = :remark,
                    status = :status,
                    rvno = :rvno,
                    eby = :eby,
                    edate = :edate 
                    where loadid = :loadid";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function update($p1, $p2, $p3)
    {
        //get revision nos 
        $id = $p1[':loadid'];
        $rno = $this->revisionnoget($id);
        $p1[':rvno'] = $rno;
        $p2[':rvno'] = $rno;
        $p2[':main_load_id'] = $id;
        $p2[':iscurrent'] = "1";
        $this->noncurrent($id);

        $sv = $this->_update($p1);

        if (!$sv) {
            return json_encode(array("msg" => "0", "data" => "Error on Update data."));
            exit;
        }

        $svb = $this->_SaveSub($p2);

        if (!$sv) {
            return json_encode(array("msg" => "0", "data" => "Error on Saving data."));
            exit;
        }
        $datas = $this->_GetReport($p3);
        return json_encode(array("msg" => "1", "data" => $datas));        
    }





}
