<?php
include_once 'go_types.php';
class GO_DESCRIPTOINS extends GO_TYPES
{
    //-glass -Description
    private function pms_glass_descriptoins($rows)
    {
        extract($rows);
        $cols = [];
        $cols['glassdescriptoinsid'] = !isset($glassdescriptoinsid) || trim($glassdescriptoinsid) === "" ? "0" : $glassdescriptoinsid;
        $cols['glassdescriptoinstype'] = !isset($glassdescriptoinstype) || trim($glassdescriptoinstype) === "" ? "0" : $glassdescriptoinstype;
        $cols['glassdescriptoinsspec'] = !isset($glassdescriptoinsspec) || trim($glassdescriptoinsspec) === "" ? "0" : $glassdescriptoinsspec;
        $cols['gdesriptionsortfrm'] = !isset($gdesriptionsortfrm) || trim($gdesriptionsortfrm) === "" ? "0" : $gdesriptionsortfrm;
        return $cols;
    }

    private function _allglassdescriptions()
    {
        $this->sql = "SELECT *FROM pms_glass_descriptoins";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $lists = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $list = $this->pms_glass_descriptoins($rows);
            $lists[] = $list;
        }
        return $lists;
    }
    public function AllGlassDescriptions()
    {
        $lists = $this->_allglassdescriptions();
        $this->response = array("msg" => "1", "data" => $lists);
        return json_encode($this->response);
        exit;
    }

    private function _checkglassdescriptionid($glassdescriptoinsid)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_descriptoins where glassdescriptoinsid = :glassdescriptoinsid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':glassdescriptoinsid', $glassdescriptoinsid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows;
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    private function _getglassdescriptioninfo($glassdescriptoinsid)
    {
        $info = [];
        $this->sql = "SELECT *FROM pms_glass_descriptoins where glassdescriptoinsid = :glassdescriptoinsid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':glassdescriptoinsid', $glassdescriptoinsid);
        $this->cm->execute();
        $row = $this->cm->fetch(PDO::FETCH_ASSOC);
        $info = $this->pms_glass_descriptoins($row);
        unset($this->cm, $this->sql, $row);
        return $info;
    }

    public function getGlassDescriptioninfo($glassdescriptoinsid)
    {
        $cnt = $this->_checkglassdescriptionid($glassdescriptoinsid);
        if ($cnt !== 1) {
            $this->response = array("msg" => '0', "data" => "Record Not Found");
            return json_encode($this->response);
            exit;
        }
        $info = $this->_getglassdescriptioninfo($glassdescriptoinsid);
        $this->response = array("msg" => '1', "data" => $info);
        return json_encode($this->response);
        exit;
    }

    private function _checkglassdescription($params)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_descriptoins where 
                    glassdescriptoinstype = :glassdescriptoinstype 
                    and gdesriptionsortfrm = :gdesriptionsortfrm  
                    and glassdescriptoinsspec = :glassdescriptoinsspec";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $this->cm, $rows);
        return $cnt;
    }
    private function _addglassdescription($params)
    {
        $this->sql = "INSERT INTO pms_glass_descriptoins values(
        null,
        :glassdescriptoinstype,
        :glassdescriptoinsspec,
        :gdesriptionsortfrm
    )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function AddGlassDescription($params)
    {
        $cnt = $this->_checkglassdescription($params);
        if ($cnt !== 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "This Glass Already Exists"
            );
            return json_encode($this->response);
            exit;
        }

        $sv = $this->_addglassdescription($params);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error On Save");
            return json_encode($this->response);
            exit;
        }
        $lists = $this->_allglassdescriptions();
        $this->response = array("msg" => "1", "data" => $lists);
        return json_encode($this->response);
        exit;
    }

    private function _updateglassdesccheck($params)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_descriptoins 
                    where glassdescriptoinstype = :glassdescriptoinstype 
                    and glassdescriptoinsspec = :glassdescriptoinsspec 
                    and gdesriptionsortfrm = :gdesriptionsortfrm
                    and glassdescriptoinsid <> :glassdescriptoinsid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $this->cm, $rows);
        return $cnt;
    }

    private function _updateglassdesc($params)
    {
        $this->sql = "UPDATE pms_glass_descriptoins set 
                    glassdescriptoinstype = :glassdescriptoinstype,
                    glassdescriptoinsspec = :glassdescriptoinsspec,
                    gdesriptionsortfrm = :gdesriptionsortfrm  
                    where 
                    glassdescriptoinsid = :glassdescriptoinsid";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql, $this->cm);
        return $sv;
    }

    public function UpdateGlassDescription($params)
    {
        $cnt = $this->_updateglassdesccheck($params);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "Update Error : This Information Already Found In Our Data");
            return json_encode($this->response);
            exit;
        }
        $sv = $this->_updateglassdesc($params);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Update Error : Error Found On Update Data");
            return json_encode($this->response);
            exit;
        }
        $lists = $this->_allglassdescriptions();
        $this->response = array("msg" => "1", "data" => $lists);
        return json_encode($this->response);
        exit;
    }
}
