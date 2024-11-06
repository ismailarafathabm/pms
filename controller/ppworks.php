<?php
require_once 'mac.php';
class PPworks extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response;


    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array('msg' => "0", 'data' => "Error");
    }

    private function _save($infos,$iteminfos)
    {   
        
        $this->sql = "INSERT INTO ppreports values(
                null,
                :ppdate,
                :pp_project,
                :pp_projectname,
                :pp_mtype,
                :pp_mdescription,
                :pp_color,
                :pp_qty,
                :pp_units,
                :pp_delno,
                :pp_dta,
                :pp_location,
                :pp_remarks,
                :pp_type,
                :pp_cdate,
                :pp_edate,
                :pp_cby,
                :pp_eby,
                :pp_extra,
                :pp_dieweight,
                :ppbalancedie,
                :pppartno,
                :pplenght,
                :ppalloy,
                :ppitemtype
            )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($infos);
        unset($this->sql, $this->cm);
        return $sv;
    }

    public function SaveNewPP($infos,$iteminfos)
    {
        $this->_saveItemsFunction($iteminfos);
        if ($this->_save($infos,$iteminfos)) {
            $this->response = array('msg' => "1", "data" => "Saved");
        } else {
            $this->response = array('msg' => "0", "data" => "Error in Save");
        }
        return json_encode($this->response);
        exit();
    }

    public function Alllist($type)
    {
        //echo $type;
        $this->sql = "SELECT *FROM ppreports where pp_type=:pp_type";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pp_type", $type);
        $this->cm->execute();
        $ppwork = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $_totdeiweight = (float)$pplenght * (float)$pp_dieweight * (float)$pp_qty;
            $ppwork[] = array(
                'pprid' => $pprid,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),
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
                'ppbalancedie' => $_totdeiweight,
                'pppartno' => $pppartno,
                'pplenght' => $pplenght,
                'ppalloy' => $ppalloy,
                'ppitemtype' => $ppitemtype,
                'balancewieght' => $_totdeiweight,
                'totrecivedweight' => "0",
            );
        }
        unset($this->sql, $this->cm, $rows);
        $resp = [];
        foreach ($ppwork as $p) {
            $id = $p['pprid'];

            $this->sql = "SELECT SUM(returnqty) as rc from ppsubreport where ppid=:ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid", $id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $trc = 0;
            if (!is_null($rows['rc'])) {
                $trc = $rows['rc'];
            }
            unset($this->sql, $this->cm, $rows);
            $tissue = (float)$p['pp_qty'];
            $tbalance = $tissue - (float)$trc;
            $weg = (float)$tbalance * (float)$p['pplenght'] * (float)$p['pp_dieweight'];
            $wegs = (float)$trc * (float)$p['pplenght'] * (float)$p['pp_dieweight'];
            $p['tot_recive'] = $trc;
            $p['tot_balance'] = $tbalance;
            $p['balancewieght'] = $weg;
            $p['totrecivedweight'] = $wegs;

            $resp[] = $p;
        }
        $this->response = array('msg' => "1", "data" => $resp);
        unset($this->sql, $this->cm, $rows);
        return json_encode($this->response);
        exit();
    }

    private function _update($infos)
    {
        $this->sql = "UPDATE ppreports set 
                ppdate = :ppdate, 
                pp_project = :pp_project, 
                pp_projectname = :pp_projectname, 
                pp_mtype = :pp_mtype, 
                pp_mdescription = :pp_mdescription, 
                pp_color = :pp_color, 
                pp_qty = :pp_qty, 
                pp_units = :pp_units, 
                pp_delno = :pp_delno, 
                pp_dta = :pp_dta, 
                pp_location = :pp_location, 
                pp_remarks = :pp_remarks, 
                pp_edate = :pp_edate, 
                pp_eby = :pp_eby, 
                pp_extra = :pp_extra,
                pp_dieweight = :pp_dieweight,
                ppbalancedie = :ppbalancedie 
                where 
                pprid=:pprid
                ";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($infos);
        unset($this->sql, $this->cm);
        return $sv;
    }

    public function UpdatePP($infos)
    {
        if ($this->_update($infos)) {
            $this->response = array('msg' => "1", 'data' => "Updated");
        } else {
            $this->response = array('msg' => "0", 'data' => "Error in Update");
        }

        return json_encode($this->response);
        exit();
    }

    private function _checkId($id)
    {
        $this->sql  = "SELECT *FROM ppreports where pprid=:pprid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pprid", $id);
        $this->cm->execute();
        $cnt = $this->cm->rowCount();
        unset($this->cm, $this->sql);
        return $cnt;
    }
    /*working on this */
    public function getAllReceipt($type)
    {
        $this->sql = "SELECT *FROM ppreports inner join ppsubreport on ppreports.pprid = ppsubreport.ppid where pp_type=:pp_type";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pp_type", $type);
        $this->cm->execute();
        $ppwork = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $ppwork[] = array(
                'pprid' => $pprid,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),
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
                'returnid' => $returnid,
                'returndate' => date_format(date_create($returndate), 'Y-m-d'),
                'returndate_d' => date_format(date_create($returndate), 'd-M-Y'),
                'returndate_n' => date_format(date_create($returndate), 'd-m-Y'),
                'returndate_p' => date_format(date_create($returndate), 'd-m-y'),
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => date_format(date_create($pcdate), 'd-M-Y H:i:s'),
                'peditdate' => date_format(date_create($peditdate), 'd-M-Y H:i:s'),
                'pextra' => $pextra,
                'pp_dieweight' => $pp_dieweight,
                'ppbalancedie' => $ppbalancedie,
            );
        }
        unset($this->sql, $this->cm, $rows);
        $this->response = array('msg' => "1", "data" => $ppwork);
        return $this->response = json_encode($this->response);
        exit();
    }

    private function _getInfos($id)
    {
        $this->sql  = "SELECT *FROM ppreports where pprid=:pprid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pprid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        extract($rows);
        $infos = array(
            'pprid' => $pprid,
            'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
            'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
            'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
            'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),
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
            'ppitemtype' => $ppitemtype,
            'balancewieght' => $ppbalancedie
        );
        unset($this->cm, $this->sql, $rows);

        $this->sql = "SELECT SUM(returnqty) as rc from ppsubreport where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $trc = 0;
        if (!is_null($rows['rc'])) {
            $trc = $rows['rc'];
        }
        unset($this->sql, $this->cm, $rows);
        $tissue = (float)$infos['pp_qty'];
        $tbalance = $tissue - (float)$trc;
        $infos['tot_recive'] = $trc;
        $infos['tot_balance'] = $tbalance;

        unset($this->cm, $this->sql, $rows);
        return $infos;
    }

    public function GetInfos($id)
    {
        if ((int)$this->_checkId($id) === 1) {
            $infos = $this->_getInfos($id);
            $this->response = array('msg' => "1", 'data' => $infos);
        } else {
            $this->response = array('msg' => "0", 'data' => "No data Found");
        }
        return json_encode($this->response);
        exit();
    }

    public function getAllProjects()
    {
        $this->sql = "SELECT project_no,project_name FROM pms_project_summary";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $projects = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $projects[] = array(
                'project_no' => strtoupper($this->enc('denc', $project_no)),
                'project_name' => ucwords(strtolower($this->enc('denc', $project_name))),
            );
        }
        $this->response = array("msg" => "1", "data" => $projects);
        unset($this->cm, $this->sql, $rows);
        return json_encode($this->response);
        exit();
    }

    private function _getTotalIssue($id)
    {
        $this->sql = "SELECT pp_qty from pms_project_summary where pprid=:pprid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pprid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $qty = $rows['pp_qty'];
        unset($this->cm, $this->sql, $rows);
        return $qty;
    }

    private function _checkTotalRecived($id)
    {
        $this->sql = "SELECT SUM(returnqty) as rc from ppsubreport where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $trc = 0;
        if (!is_null($rows['rc'])) {
            $trc = $rows['rc'];
        }
        unset($this->sql, $this->cm, $rows);
        return $trc;
    }

    private function _saveNewRecive($infos)
    {
        $this->sql = "INSERT INTO ppsubreport values(
                null,
                :returndate,
                :returnqty,
                :rtno,
                :rcpno,
                :remark,
                :ppid,
                :pcby,
                :peby,
                :pcdate,
                :peditdate,
                :pextra
            )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($infos);
        unset($this->sql, $this->cm);
        return $sv;
    }

    private function _updateDieWeight($id, $diewg)
    {
        $this->sql = "UPDATE ppreports set ppbalancedie=:ppbalancedie where pprid=:pprid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppbalancedie", $diewg);
        $this->cm->bindParam(":pprid", $id);
        //$this->cm->execute();
    }

    public function NewRecieve($infos, $id)
    {
        $issue = $this->_getTotalIssue($id);
        $recive = $this->_checkTotalRecived($id);
        if ((float)$issue <= (float)$recive) {
            if ($this->_saveNewRecive($infos)) {
                $this->_updateDieWeight($id, $infos[':rtno']);
                $this->response = array('msg' => "1", "data" => "Updated");
            } else {
                $this->response = array('msg' => "0", "data" => "Database Error - Save Data");
            }
        } else {
            $this->response = array('msg' => "0", "data" => "Check Recive QTY");
        }
        return json_encode($this->response);
        exit();
    }


    public function GetAllRecived($id)
    {
        $this->sql = "SELECT *FROM ppsubreport where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $recived = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $recived[] = array(
                'returnid' => $returnid,
                'returndate' => date_format(date_create($returndate), 'Y-m-d'),
                'returndate_d' => date_format(date_create($returndate), 'd-M-Y'),
                'returndate_n' => date_format(date_create($returndate), 'd-m-Y'),
                'returndate_p' => date_format(date_create($returndate), 'd-m-y'),
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => date_format(date_create($pcdate), 'd-M-Y H:i:s'),
                'peditdate' => date_format(date_create($peditdate), 'd-M-Y H:i:s'),
                'pextra' => $pextra,
            );
        }

        $ppwork = $this->_getInfos($id);
        $infos = array(
            'ppwork' => $ppwork,
            'recived' => $recived
        );
        $this->response = array('msg' => "1", "data" => $infos);
        unset($this->cm, $this->sql, $rows);
        return json_encode($this->response);
        exit();
    }

    public function AllDescription()
    {
        $_res = [];
        $this->sql = "SELECT `pp_mdescription` FROM `ppreports` GROUP by `pp_mdescription`";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_descriptions = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $_descriptions[] = array(
                "description" => $rows['pp_mdescription'],
            );
        }
        unset($rows, $this->cm, $this->sql);

        $this->sql = "SELECT `pp_mtype` FROM `ppreports` GROUP by `pp_mtype`";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_types = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $_types[] = array(
                "types" => $rows['pp_mtype'],
            );
        }
        unset($rows, $this->cm, $this->sql);

        $this->sql = "SELECT `pp_units` FROM `ppreports` GROUP by `pp_units`";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_units = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $_units[] = array(
                "units" => $rows['pp_units'],
            );
        }
        unset($rows, $this->cm, $this->sql);

        $this->sql = "SELECT `pp_color` FROM `ppreports` GROUP by `pp_color`";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_colors = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $_colors[] = array(
                "colors" => $rows['pp_color'],
            );
        }
        unset($rows, $this->cm, $this->sql);

        $_res = array(
            'colors' => $_colors,
            'units' => $_units,
            'types' => $_types,
            'descriptions' => $_descriptions
        );

        $this->response = array('msg' => "1", "data" => $_res);

        return json_encode($this->response);
        exit();
    }

    private function _checkItem($infos){
        $this->sql = "SELECT *FROM bom_items where 
        itempartno=:itempartno and 
        itemalloy=:itemalloy and 
        itemfinish=:itemfinish and 
        itemlength=:itemlength and 
        itemunit=:itemunit and 
        itemdieweight=:itemdieweight and 
        itemsystem=:itemsystem and 
        itemtype = :itemtype and 
        itemdescription = :itemdescription and 
        itempartfunction = :itempartfunction";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($infos);
        $rcnt = $this->cm->rowCount();
        unset($this->cm,$this->sql);        
        return $rcnt;
    }

    private function _saveItemInfos($infos){
        //echo "called save function...";
        $this->sql = "INSERT INTO bom_items values(
            null,
            :itemprofileno,
            :itempartno,
            :itemalloy,
            :itemfinish,
            :itemlength,
            :itemunit,
            :itemdieweight,
            :itemsystem,
            :itemtype,
            :itemavai,
            :itemtotweight,
            :itemprice,
            :itemtotprice,
            :itemdescription,
            :itempartfunction
        )";

        $this->cm = $this->cn->prepare($this->sql);
        if($this->cm->execute($infos))
        {
           // echo"SAVE";
        }
        else{
            //echo "ITem ERROR";
        }

        unset($this->cm,$this->sql);
    }

    private function _saveItemsFunction($infos){
        $chk = array(
            ":itempartno" => $infos[':itempartno'],
            ":itemalloy" => $infos[':itemalloy'],
            ":itemfinish" => $infos[':itemfinish'],
            ":itemlength" => $infos[':itemlength'],
            ":itemunit" => $infos[':itemunit'],
            ":itemdieweight" => $infos[':itemdieweight'],
            ":itemsystem" => $infos[':itemsystem'],
            ":itemtype" => $infos[':itemtype'],
            ":itemdescription" => $infos[':itemdescription'],
            ":itempartfunction" => $infos[':itempartfunction'],
        );
        $itme = $this->_checkItem($chk);        
        if($itme === 0 || $itme === "0"){
           // echo "calling save function...";
            $this->_saveItemInfos($infos);
        }
    }
}
