<?php
require_once 'go_supplier.php';
class GO_TYPES extends GO_SUPPLIERS
{
       //-glass -type
    private function _allglasstypes()
    {
        $this->sql = "SELECT *FROM pms_glasstypes";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $types = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $type = array(
                "glasstype_id" => $rows['glasstype_id'],
                "glasstype_name" => $this->enc('denc', $rows['glasstype_name']),
            );
            $types[] = $type;
        }
        unset($this->cm, $this->sql, $rows);
        return $types;
    }

    public function AllGlassTypes()
    {
        $types = $this->_allglasstypes();
        $this->response = array(
            "msg" => "1",
            "data" => $types
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkglasstype($glasstype_name)
    {
        $this->sql = "SELECT COUNT(*) as cnt from pms_glasstypes where glasstype_name = :glasstype_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasstype_name", $glasstype_name);
        $this->cm->execute();
        $row = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$row['cnt'];
        unset($this->cm, $this->sql, $row);
        return $cnt;
    }

    private function _addglasstype($glasstype_name)
    {
        $this->sql = "INSERT INTO pms_glasstypes values(null,:glasstype_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasstype_name", $glasstype_name);
        $sv = $this->cm->execute();
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function AddGlassType($glasstype_name)
    {
        $gt = $this->enc('enc', strtolower($glasstype_name));
        if ($this->_checkglasstype($gt) !== 0) {
            $this->response = array("msg" => "0", "data" => "This Glass Type Already Exists");
            return json_encode($this->response);
            exit;
        }
        if (!$this->_addglasstype($gt)) {
            $this->response = array("msg" => "0", "data" => "Database Error on Saving Data");
            return json_encode($this->response);
            exit;
        }
        $datas = $this->_allglasstypes();
        $this->response = array("msg" => "1", "data" => $datas);
        return json_encode($this->response);
        exit;
    }
}
