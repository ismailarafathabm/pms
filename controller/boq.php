<?php
require_once 'mac.php';
class BOQ extends mac
{
    private $cn;
    private $sql;
    private $cm;
    private $response = [];

    function __construct($db)
    {
        $this->cn = $db;
    }

    private function _unset()
    {
        unset($this->sql, $this->cm, $rows);
    }

    private function _boqitemtypedeletecheck($filed, $value): int
    {
        $this->sql = "SELECT COUNT(" . $filed . ") as cnt from pms_poq where " . $filed . " = :param";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':param', $value);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }
    /*========================================start Item type===============================*/
    private function pms_ptype($rows): array
    {
        extract($rows);
        $cols = [];
        $cols['ptype_id'] = $ptype_id;
        $cols['ptype_name'] = self::enc('denc', $ptype_name);
        return $cols;
    }

    private function _getboqtypes(): array
    {
        $this->sql = "SELECT *FROM pms_ptype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rows = [];
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_ptype($rows);
            $rpts[] = $rpt;
        }
        self::_unset();
        return $rpts;
    }

    public function GetBoqTypes(): string
    {
        $rpt = self::_getboqtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //save boq item type
    private function _checkBoqItemForNew($ptype_name): int
    {
        $this->sql = "SELECT COUNT(ptype_name) as cnt from pms_ptype where ptype_name = :ptype_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ptype_name", $ptype_name);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }



    private function _saveNewBoqType($ptype_name): bool
    {
        $this->sql = "INSERT INTO pms_ptype values(null,:ptype_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ptype_name", $ptype_name);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function SaveNewBoqType($ptype_name): string
    {
        $cnt = (int)self::_checkBoqItemForNew($ptype_name);
        if ($cnt !== 0) {
            header("http/1.0 409 dublicate");
            $this->response = array("msg" => "0", "data" => "This Data Already Found");
            return json_encode($this->response);
            exit();
        }
        $sv = self::_saveNewBoqType($ptype_name);
        if (!$sv) {
            header("http/1.0 500 error");
            $this->response = array("msg" => "0", "data" => "Error On saving Data");
            return json_encode($this->response);
            exit();
        }
        $rpt = self::_getboqtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }
    //update boq items type
    private function _checkBoqItemForupdate($ptype_name, $ptype_id): int
    {
        $this->sql = "SELECT COUNT(ptype_name) as cnt from pms_ptype where ptype_name = :ptype_name and ptype_id <> :ptype_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ptype_name", $ptype_name);
        $this->cm->bindParam(":ptype_id", $ptype_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _updateBoqItem($ptype_name, $ptype_id): bool
    {
        $this->sql = "UPDATE pms_ptype set ptype_name = :ptype_name where ptype_id = :ptype_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ptype_name", $ptype_name);
        $this->cm->bindParam(":ptype_id", $ptype_id);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function UpdateBoqItemtype($ptype_name, $ptype_id): string
    {
        $cnt = (int)self::_checkBoqItemForupdate($ptype_name, $ptype_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", 'data' => "This Item Already Found With other Id");
            header('http/1.0 409 dublicate');
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_updateBoqItem($ptype_name, $ptype_id);
        if (!$sv) {
            $this->response = array("msg" => "0", 'data' => "Error on Updating Data.");
            header('http/1.0 409 error');
            return json_encode($this->response);
            exit();
        }

        $rpt = self::_getboqtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //delete boq item type



    private function _removeBoqItemType($ptype_id): bool
    {
        $this->sql = "DELETE FROM pms_ptype where ptype_id = :ptype_id limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ptype_id", $ptype_id);
        $rm = $this->cm->execute();
        unset($this->sql, $this->cm);
        return $rm;
    }

    public function RemoveBoqItemType($ptype_id): string
    {
        $cnt = self::_boqitemtypedeletecheck('poq_item_type', $ptype_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "You could not remove this boq Item Type, Bcz This Boq Item Type Already Configuration With Boq");
            header("http/1.0 409 foreignkey");
            return json_encode($this->response);
            exit();
        }
        $del = self::_removeBoqItemType($ptype_id);
        if (!$del) {
            $this->response = array("msg" => "0", "data" => "Error on Deleting data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $rpt = self::_getboqtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    /*========================================start system type===============================*/

    private function pms_systemtype($rows): array
    {
        extract($rows);
        $cols = [];
        $cols['system_type_id'] = $system_type_id;
        $cols['system_type_name'] = self::enc('denc', $system_type_name);
        return $cols;
    }

    private function _boq_systemtypes(): array
    {
        $this->sql = "SELECT *FROM pms_systemtype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_systemtype($rows);
            $rpts[] = $rpt;
        }
        self::_unset();
        return $rpts;
    }

    public function BoqSystemTypes(): string
    {
        $rpt = self::_boq_systemtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //new boq system type
    private function _checkboqsystemtypeforsave($system_type_name): int
    {
        $this->sql = "SELECT COUNT(system_type_name) as cnt FROM pms_systemtype where system_type_name = :system_type_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":system_type_name", $system_type_name);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _saveBoqSystemType($system_type_name): bool
    {
        $this->sql = "INSERT INTO pms_systemtype values(null,:system_type_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":system_type_name", $system_type_name);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function SaveBoqSystemTypes($system_type_name): string
    {
        $cnt = (int)self::_checkboqsystemtypeforsave($system_type_name);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "This System Type Already Found");
            header("http/1.0 409 dublicate");
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_saveBoqSystemType($system_type_name);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error On Saving data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $rpt = self::_boq_systemtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //update boq system types
    private function _checkboqsystemtypeforupdate($system_type_name, $system_type_id): int
    {
        $this->sql = "SELECT COUNT(system_type_name) as cnt FROM pms_systemtype where system_type_name = :system_type_name and system_type_id <> :system_type_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":system_type_name", $system_type_name);
        $this->cm->bindParam(":system_type_id", $system_type_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _updateBoqsystemtype($system_type_name, $system_type_id): bool
    {
        $this->sql = "UPDATE pms_systemtype set system_type_name = :system_type_name where system_type_id = :system_type_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":system_type_name", $system_type_name);
        $this->cm->bindParam(":system_type_id", $system_type_id);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function UpdateBoqSystemType($system_type_name, $system_type_id): string
    {
        $cnt = (int)self::_checkboqsystemtypeforupdate($system_type_name, $system_type_id);
        if ($cnt !== 0) {
            header("http/1.0 409 dublicate");
            $this->response = array("msg" => "0", "data" => "This Data Already Found");
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_updateBoqsystemtype($system_type_name, $system_type_id);
        if (!$sv) {
            header("http/1.0 500 error");
            $this->response = array("msg" => "0", "data" => "Error On Updating Data");
            return json_encode($this->response);
            exit();
        }
        $rpt = self::_boq_systemtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //for delete boq system types
    private function _removeBoqsystemtype($system_type_id): bool
    {
        $this->sql = "DELETE FROM pms_systemtype where system_type_id = :system_type_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":system_type_id", $system_type_id);
        $rm = $this->cm->execute();
        self::_unset();
        return $rm;
    }

    public function RemoveBoqSystemType($system_type_id): string
    {
        $cnt = (int)self::_boqitemtypedeletecheck('poq_system_type', $system_type_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "You could not remove this boq System Type, Bcz This Boq System Type Already Configuration With Boq");
            header("http/1.0 409 foreignkey");
            return json_encode($this->response);
            exit();
        }
        $rm = (bool)self::_removeBoqsystemtype($system_type_id);
        if (!$rm) {
            $this->response = array("msg" => "0", "data" => "Error on Deleting data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $rpt = self::_boq_systemtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    /*========================================BOQ FINISH===============================*/

    private function pms_finish($rows): array
    {
        extract($rows);
        $cols = [];
        $cols['finish_id'] = $finish_id;
        $cols['finish_name'] = self::enc('denc', $finish_name);
        return $cols;
    }

    private function _boqfinishtypes(): array
    {
        $this->sql = "SELECT *FROM pms_finish";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_finish($rows);
            $rpts[] = $rpt;
        }
        self::_unset();
        return $rpts;
    }

    public function BoqFinishtypes(): string
    {
        $rpt = (array)self::_boqfinishtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    ///save finsh types

    private function _checkboqfinishtypeforsave($finish_name): int
    {
        $this->sql = "SELECT COUNT(finish_name) as cnt from pms_finish where finish_name = :finish_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":finish_name", $finish_name);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _savenewBoqFinishType($finish_name): bool
    {
        $this->sql = "INSERT INTO pms_finish values(null,:finish_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":finish_name", $finish_name);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function SaveFinishType($finish_name): string
    {
        $cnt = (int)self::_checkboqfinishtypeforsave($finish_name);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", 'data' => "This Item Already Found With other Id");
            header('http/1.0 409 dublicate');
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_savenewBoqFinishType($finish_name);
        if (!$sv) {
            $this->response = array("msg" => "0", 'data' => "Error on Saving Data.");
            header('http/1.0 409 error');
            return json_encode($this->response);
            exit();
        }
        $rpt = (array)self::_boqfinishtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    ///boq finish items

    private function _checkboqfinishtypeforupdate($finish_name, $finish_id): int
    {
        $this->sql = "SELECT COUNT(finish_name) as cnt from pms_finish where finish_name = :finish_name and finish_id <> :finish_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":finish_name", $finish_name);
        $this->cm->bindParam(":finish_id", $finish_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _updateboqfinishtype($finish_name, $finish_id): bool
    {
        $this->sql = "UPDATE pms_finish set finish_name = :finish_name where finish_id = :finish_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":finish_name", $finish_name);
        $this->cm->bindParam(":finish_id", $finish_id);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function UpdateBoqFinishType($finish_name, $finish_id): string
    {
        $cnt = (int)self::_checkboqfinishtypeforupdate($finish_name, $finish_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", 'data' => "This Item Already Found With other Id");
            header('http/1.0 409 dublicate');
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_updateboqfinishtype($finish_name, $finish_id);
        if (!$sv) {
            $this->response = array("msg" => "0", 'data' => "Error on Saving Data.");
            header('http/1.0 409 error');
            return json_encode($this->response);
            exit();
        }
        $rpt = (array)self::_boqfinishtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //for delete

    private function _removeboqfinishtype($finish_id): bool
    {
        $this->sql = "DELETE FROM pms_finish where finish_id = :finish_id limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":finish_id", $finish_id);
        $rm = $this->cm->execute();
        self::_unset();
        return $rm;
    }

    public function RemoveBomFinishType($finish_id): string
    {
        $cnt = (int)self::_boqitemtypedeletecheck('poq_finish', $finish_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "You could not remove this boq Finish , Bcz This Boq Finish Type Already Configuration With Boq");
            header("http/1.0 409 foreignkey");
            return json_encode($this->response);
            exit();
        }
        $rm = (bool)self::_removeboqfinishtype($finish_id);
        if (!$rm) {
            $this->response = array("msg" => "0", "data" => "Error on Deleting data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $rpt = (array)self::_boqfinishtypes();
        $this->response = array("msg" => "1", "data" => $rpt);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }


    /*========================================BOQ UNITS===============================*/

    private function pms_units($rows): array
    {
        extract($rows);
        $cols = [];
        $cols['uint_id'] = $uint_id;
        $cols['unit_name'] = self::enc('denc', $unit_name);
        return $cols;
    }

    private function _rptBoqunits(): array
    {
        $this->sql = "SELECT *FROM pms_units";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = (array)self::pms_units($rows);
            $rpts[] = $rpt;
        }
        self::_unset();
        return $rpts;
    }

    public function RptBoqUnits(): string
    {
        $units = (array)self::_rptBoqunits();
        $this->response = array("msg" => "1", "data" => $units);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //save boq unit

    private function _checkboqunitforsave($unit_name): int
    {
        $this->sql = "SELECT COUNT(unit_name) as cnt from pms_units where unit_name = :unit_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":unit_name", $unit_name);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _saveboqunit($unit_name): bool
    {
        $this->sql = "INSERT INTO pms_units values(null,:unit_name)";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":unit_name", $unit_name);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function SaveBoqunit($unit_name): string
    {
        $cnt = (int)self::_checkboqunitforsave($unit_name);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "Already Found");
            header("http/1.0 409 dublicate");
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_saveboqunit($unit_name);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error on Saving Data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $units = (array)self::_rptBoqunits();
        $this->response = array("msg" => "1", "data" => $units);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //boq unit update


    private function _checkboqunitforupdate($unit_name, $uint_id): int
    {
        $this->sql = "SELECT COUNT(unit_name) as cnt from pms_units where unit_name = :unit_name and uint_id <> :uint_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":unit_name", $unit_name);
        $this->cm->bindParam(":uint_id", $uint_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _updateboqunits($unit_name, $uint_id): bool
    {
        $this->sql = "UPDATE pms_units set unit_name = :unit_name where uint_id = :uint_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":unit_name", $unit_name);
        $this->cm->bindParam(":uint_id", $uint_id);
        $sv = $this->cm->execute();
        self::_unset();
        return $sv;
    }

    public function UpdateBoqUnits($unit_name, $uint_id): string
    {
        $cnt = (int)self::_checkboqunitforupdate($unit_name, $uint_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", 'data' => "This Unit Already Found With other Id");
            header('http/1.0 409 dublicate');
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_updateboqunits($unit_name, $uint_id);
        if (!$sv) {
            $this->response = array("msg" => "0", 'data' => "Error on Saving Data.");
            header('http/1.0 409 error');
            return json_encode($this->response);
            exit();
        }
        $units = (array)self::_rptBoqunits();
        $this->response = array("msg" => "1", "data" => $units);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //remove boq units

    private function _removeboqUnits($uint_id): bool
    {
        $this->sql = "DELETE FROM pms_units where uint_id = :uint_id limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":uint_id", $uint_id);
        $rm = $this->cm->execute();
        self::_unset();
        return $rm;
    }

    public function RemoveBoqUnit($uint_id): string
    {
        $cnt = (int)self::_boqitemtypedeletecheck('poq_unit', $uint_id);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "You could not remove this boq Unit , Bcz This Boq Unit Already Configuration With Boq");
            header("http/1.0 409 foreignkey");
            return json_encode($this->response);
            exit();
        }
        $rm = (bool)self::_removeboqUnits($uint_id);
        if (!$rm) {
            $this->response = array("msg" => "0", "data" => "Error on Deleting data");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $units = (array)self::_rptBoqunits();
        $this->response = array("msg" => "1", "data" => $units);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    ///auto compleate

    private function _boqautocompleate($filed): array
    {
        $this->sql = "SELECT " . $filed . ",enc_mode from pms_poq group by " . $filed . "";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $groupitems = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            if ((int)$rows['enc_mode'] === 0) {
                $item = self::enc('denc', $rows[$filed]);
            } else {
                $item = $rows[$filed];
            }
            $groupitems[] = $item;
        }
        self::_unset();
        return $groupitems;
    }
    public function boqautocompleate(): string
    {
        $poq_item_nos = (array)self::_boqautocompleate('poq_item_no');
        // $poq_item_remarks = (array)self::_boqautocompleate('poq_item_remark');
        $poq_item_glass_specs = (array)self::_boqautocompleate('poq_item_glass_spec');
        $poq_item_glass_singles = (array)self::_boqautocompleate('poq_item_glass_single');
        $poq_item_glass_double1s = (array)self::_boqautocompleate('poq_item_glass_double1');
        $poq_item_glass_double2s = (array)self::_boqautocompleate('poq_item_glass_double2');
        $poq_item_glass_double3s = (array)self::_boqautocompleate('poq_item_glass_double3');
        $poq_item_glass_laminate1s = (array)self::_boqautocompleate('poq_item_glass_laminate1');
        $poq_item_glass_laminate2s = (array)self::_boqautocompleate('poq_item_glass_laminate2');
        $poq_drawings = (array)self::_boqautocompleate('poq_drawing');
        $poq_remarks = (array)self::_boqautocompleate('poq_remark');
        $datas = array(
            'poq_item_nos' => (array)$poq_item_nos,
            // 'poq_item_remarks' => $poq_item_remarks,
            'poq_item_glass_specs' => (array)$poq_item_glass_specs,
            'poq_item_glass_singles' => (array)$poq_item_glass_singles,
            'poq_item_glass_double1s' => (array)$poq_item_glass_double1s,
            'poq_item_glass_double1s' => (array)$poq_item_glass_double1s,
            'poq_item_glass_double2s' => (array)$poq_item_glass_double2s,
            'poq_item_glass_double3s' => (array)$poq_item_glass_double3s,
            'poq_item_glass_laminate1s' => (array)$poq_item_glass_laminate1s,
            'poq_item_glass_laminate2s' => (array)$poq_item_glass_laminate2s,
            'poq_drawings' => (array)$poq_drawings,
            'poq_remarks' => (array)$poq_remarks,

        );
        $this->response = array("msg" => "1", "data" => $datas);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    ///============================boq acations==================================//
    public function _checkboq($params): int
    {
        $this->sql = "SELECT COUNT(poq_item_no) as cnt from pms_poq where poq_item_no = :poq_item_no and 
                    poq_project_code = :poq_project_code and boq_type = :boq_type and boq_refno = :boq_refno and 
                    boq_reviewno = :boq_reviewno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        self::_unset();
        return $cnt;
    }

    private function _saveboq($params): bool
    {
        $this->sql = "INSERT INTO pms_poq values(
            null,
            :poq_item_no,
            :poq_item_type,
            :poq_item_remark,
            :poq_item_width,
            :poq_item_height,
            :poq_item_glass_spec,
            :poq_item_glass_single,
            :poq_item_glass_double1,
            :poq_item_glass_double2,
            :poq_item_glass_double3,
            :poq_item_glass_laminate1,
            :poq_item_glass_laminate2,
            :poq_drawing,
            :poq_finish,
            :poq_system_type,
            :poq_qty,
            :poq_unit,
            :poq_uprice,
            :poq_remark,
            :poq_cby,
            :poq_eby,
            :poq_Cdate,
            :poq_Edate,
            :poq_project_code,
            :poq_status,
            :boq_refno,
            :boq_reviewno,
            :boq_area,
            :boq_type,
            :boq_type_refno,
            :boq_type_rno,
            :boq_calby,
            :issupersede,
            :oldboqid,
            :totprice,
            :enc_mode         
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        self::_unset();
        return $sv;
    }

    private function supersedeboq($id){
        $this->sql = "UPDATE pms_poq set  issupersede = 1 where poq_id = :poq_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_id",$id);
        $up = $this->cm->execute();
        self::_unset();
        return $up;
    }
    public function SaveBoqn($params){
        $dub = array(
            ":poq_item_no" => $params[":poq_item_no"],
            ":poq_project_code" => $params[":poq_project_code"],
            ":boq_type" => $params[":boq_type"],
            ":boq_refno" => $params[":boq_refno"],
            ":boq_reviewno" => $params[":boq_reviewno"],
        );
        $cnt = (int)self::_checkboq($dub);
        if ($cnt !== 0) {
            header("http/1.0 409 dublciate");
            $this->response = array('msg' => "0", "data" => "This Boq Item Alreay Found");
            return json_encode($this->response);
            exit();
        }

        //supersade
        $oldboqid = $params[':oldboqid'];
        $up = self::supersedeboq($oldboqid);
        if(!$up){
            header('http/1.0 500 error');
            $this->response = array("msg" => "0" , "data" => "Error on supersede Old Boq");
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_saveboq($params);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error On Saving Boq");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $this->response = array("msg" => "1", "data" => "Boq Has Saved");
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
        


    }
    public function SaveBoq($params)
    {
        $dub = array(
            ":poq_item_no" => $params[":poq_item_no"],
            ":poq_project_code" => $params[":poq_project_code"],
            ":boq_type" => $params[":boq_type"],
            ":boq_refno" => $params[":boq_refno"],
            ":boq_reviewno" => $params[":boq_reviewno"],
        );
        $cnt = (int)self::_checkboq($dub);
        if ($cnt !== 0) {
            header("http/1.0 409 dublciate");
            $this->response = array('msg' => "0", "data" => "This Boq Item Alreay Found");
            return json_encode($this->response);
            exit();
        }
        $sv = (bool)self::_saveboq($params);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error On Saving Boq");
            header("http/1.0 500 error");
            return json_encode($this->response);
            exit();
        }
        $this->response = array("msg" => "1", "data" => "Boq Has Saved");
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    private function pms_poq($rows): array
    {
        extract($rows);
        $cols = [];
        $cols['poq_id'] = $poq_id;
        $cols['poq_item_no'] = self::enc('denc', $poq_item_no);
        $cols['poq_item_type'] = $poq_item_type;
        $cols['poq_item_remark'] = self::enc('denc', $poq_item_remark);
        $cols['poq_item_width'] = (string)self::enc('denc', $poq_item_width);
        $cols['poq_item_height'] = (string)self::enc('denc', $poq_item_height);
        //area cal
        $width = (float)self::enc('denc', $poq_item_width);
        $height = (float)self::enc('denc', $poq_item_height);
        $area = $width * $height;
        $cols['poq_item_area'] = (string) $area;

        $cols['poq_item_glass_spec'] = self::enc('denc', $poq_item_glass_spec);
        $cols['poq_item_glass_single'] = self::enc('denc', $poq_item_glass_single);
        $cols['poq_item_glass_double1'] = self::enc('denc', $poq_item_glass_double1);
        $cols['poq_item_glass_double2'] = self::enc('denc', $poq_item_glass_double2);
        $cols['poq_item_glass_double3'] = self::enc('denc', $poq_item_glass_double3);
        $cols['poq_item_glass_laminate1'] = self::enc('denc', $poq_item_glass_laminate1);
        $cols['poq_item_glass_laminate2'] = self::enc('denc', $poq_item_glass_laminate2);
        $cols['poq_drawing'] = self::enc('denc', $poq_drawing);
        $cols['poq_finish'] = $poq_finish;
        $cols['poq_system_type'] = $poq_system_type;
        $cols['poq_qty'] = self::enc('denc', $poq_qty);
        $cols['poq_unit'] = $poq_unit;
        $cols['poq_uprice'] = self::enc('denc',$poq_uprice);
        $cols['poq_remark'] = self::enc('denc', $poq_remark);
        $cols['poq_cby'] = self::enc('denc', $poq_cby);
        $cols['poq_eby'] = self::enc('denc', $poq_eby);
        $cols['poq_Cdate'] = self::enc('denc', $poq_Cdate);
        $cols['poq_Edate'] = self::enc('denc', $poq_Edate);
        $cols['poq_project_code'] = $poq_project_code;
        $cols['poq_status'] = self::enc('denc', $poq_status);
        $cols['boq_refno'] = self::enc('denc', $boq_refno);
        $cols['boq_reviewno'] = self::enc('denc', $boq_reviewno);
        $cols['boq_area'] = self::enc('denc', $boq_area);
        $cols['boq_type'] = $boq_type;
        $cols['boq_type_refno'] = $boq_type_refno;
        $cols['boq_type_rno'] = $boq_type_rno;
        $cols['boq_calby'] = $boq_calby;
        $cols['issupersede'] = $issupersede;
        $cols['oldboqid'] = $oldboqid;
        $cols['totprice'] = $totprice;
        $cols['enc_mode'] = $enc_mode;

        $cols['ptype_name'] = self::enc('denc', $ptype_name);
        $cols['system_type_name'] = self::enc('denc', $system_type_name);
        $cols['finish_name'] = self::enc('denc', $finish_name);
        $cols['unit_name'] = self::enc('denc', $unit_name);

        $cols['project_id'] = $project_id;
        $cols['project_no'] = self::enc('denc', $project_no);
        $cols['project_name'] = self::enc('denc', $project_name);
        $cols['project_cname'] = self::enc('denc', $project_cname);
        $cols['project_location'] = self::enc('denc', $project_location);
        $cols['project_singdate'] = self::enc('denc', $project_singdate);
        $cols['Sales_Representative'] = self::enc('denc', $Sales_Representative);
        $cols['project_boq_refno'] = self::enc('denc', $project_boq_refno);
        $cols['project_boq_revision'] = self::enc('denc', $project_boq_revision);
        $totprice = "0";
        if($boq_calby === 'qty'){
            $toprice = (double)self::enc('denc', $poq_qty) *self::enc('denc',$poq_uprice);
        }else{
            $toprice = (double)self::enc('denc', $boq_area) *self::enc('denc',$poq_uprice);
        }
        $cols['totprice'] = (string)$toprice;
        //calc actions 
        return $cols;
    }
    private function _projectBoq($poq_project_code, $boq_refno, $boq_reviewno): array
    {
        $this->sql = "SELECT *FROM pms_poq as boq inner join 
        pms_ptype as itype on boq.poq_item_type = itype.ptype_id 
        inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
        inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id 
        inner join pms_units as utype on boq.poq_unit = utype.uint_id 
        inner join pms_project_summary as prj on boq.poq_project_code = prj.project_no where 
        boq.poq_project_code = :poq_project_code and 
        boq.boq_refno = :boq_refno and 
        boq.boq_reviewno = :boq_reviewno";

        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":poq_project_code" => $poq_project_code,
            ":boq_refno" => $boq_refno,
            ":boq_reviewno" => $boq_reviewno,
        );
        $this->cm->execute($params);
        $boqs = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {

            $boq = (array)self::pms_poq($rows);
            $boq_notes = self::boqnotes(
                $rows['poq_project_code'],
                $rows['poq_item_no']
            );
            $boq['notes'] = (array)$boq_notes;
            $boqs[] = $boq;
        }
        self::_unset();
        return $boqs;
    }

    public function ProjectBoq($poq_project_code, $boq_refno, $boq_reviewno): string
    {
        $boqs  = (array)self::_projectBoq($poq_project_code, $boq_refno, $boq_reviewno);
        $this->response = array("msg" => "1", "data" => $boqs);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    //all boq
    private function _allprojectBoq($poq_project_code): array
    {
        $this->sql = "SELECT *FROM pms_poq as boq inner join 
        pms_ptype as itype on boq.poq_item_type = itype.ptype_id 
        inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
        inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id 
        inner join pms_units as utype on boq.poq_unit = utype.uint_id 
        inner join pms_project_summary as prj on boq.poq_project_code = prj.project_no where 
        boq.poq_project_code = :poq_project_code ";

        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":poq_project_code" => $poq_project_code,
         
        );
        $this->cm->execute($params);
        $boqs = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {

            $boq = (array)self::pms_poq($rows);
            $boq_notes = self::boqnotes(
                $rows['poq_project_code'],
                $rows['poq_item_no']
            );
            $boq['notes'] = (array)$boq_notes;
            $boqs[] = $boq;
        }
        self::_unset();
        return $boqs;
    }

    public function AllProjectBoq($poq_project_code,): string
    {
        $boqs  = (array)self::_allprojectBoq($poq_project_code);
        $this->response = array("msg" => "1", "data" => $boqs);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    private function _contractprojectBoq($poq_project_code): array
    {
        $this->sql = "SELECT *FROM pms_poq as boq inner join 
        pms_ptype as itype on boq.poq_item_type = itype.ptype_id 
        inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
        inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id 
        inner join pms_units as utype on boq.poq_unit = utype.uint_id 
        inner join pms_project_summary as prj on boq.poq_project_code = prj.project_no where 
        boq.poq_project_code = :poq_project_code and boq.boq_type = 'boq'";

        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":poq_project_code" => $poq_project_code,
         
        );
        $this->cm->execute($params);
        $boqs = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {

            $boq = (array)self::pms_poq($rows);
            $boq_notes = self::boqnotes(
                $rows['poq_project_code'],
                $rows['poq_item_no']
            );
            $boq['notes'] = (array)$boq_notes;
            $boqs[] = $boq;
        }
        self::_unset();
        return $boqs;
    }

    public function ContractprojectBoq($poq_project_code,): string
    {
        $boqs  = (array)self::_contractprojectBoq($poq_project_code);
        $this->response = array("msg" => "1", "data" => $boqs);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    private function boqnotes($boq_note_project, $poq_item_no): array
    {
        $sql = "SELECT *FROM pms_boq_notes where 
         boq_note_project=:boq_note_project and boq_note_itemno=:boq_note_itemno";
        $cm = $this->cn->prepare($sql);

        $cm->bindParam(":boq_note_project", $boq_note_project);
        $cm->bindParam(":boq_note_itemno", $poq_item_no);
        $notes = [];
        while ($rowss = $cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rowss);
            $note = array(
                "boq_note_id" => $boq_note_id,
                "boq_note_project" => self::enc('denc', $boq_note_project),
                "boq_note_itemno" => self::enc('denc', $boq_note_itemno),
                "boq_note_notes" => self::enc('denc', $boq_note_notes),
            );
            $notes[] = $note;
        }
        unset($cm, $sqll);
        return $notes;
    }
    

    


    private function _BoqInfo($poq_id): array
    {
        $this->sql = "SELECT *FROM pms_poq as boq inner join 
        pms_ptype as itype on boq.poq_item_type = itype.ptype_id 
        inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
        inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id 
        inner join pms_units as utype on boq.poq_unit = utype.uint_id 
        inner join pms_project_summary as prj on boq.poq_project_code = prj.project_no where 
        boq.poq_id = :poq_id";
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":poq_id" => $poq_id,
        );
        $this->cm->execute($params);
        $boqs = [];
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);

        $boqs = (array)self::pms_poq($rows);
        self::_unset();
        return $boqs;
    }

    public function BoqInfo($poq_id): string
    {
        $boq = (array)self::_Boqinfo($poq_id);
        $this->response = array("msg" => "1", "data" => $boq);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit();
    }

    private function _removeBoq($poq_id):bool{
        $this->sql = "DELETE FROM pms_poq where poq_id = :poq_id limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_id",$poq_id);
        $rm = (bool)$this->cm->execute();
        self::_unset();
        return $rm;
    }

    public function RemoveBoq($poq_id){
        $permission = true;
        if(!$permission){
            header('http/1.0 409 permission error');
            $this->response = array("msg" => "0" , "data" => "Permission Error");
            return json_encode($this->response);
            exit();
        }
        $rm = (bool)self::_removeBoq($poq_id);
        if(!$rm){
            header('http/1.0 500 permission error');
            $this->response = array("msg" => "0" , "data" => "Error on Delete");
            return json_encode($this->response);
            exit();
        }
        header('http/1.0 200 ok');
        $this->response = array("msg" => "1" , "data" => "Remove");
        return json_encode($this->response);
        exit();        
    }

    //get all boq for project 

    private function _boqforselectinput($poq_project_code):array{
        $this->sql = "SELECT poq_id,poq_item_no from pms_poq where poq_project_code = :poq_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code",$poq_project_code);
        $this->cm->execute();
        $boqs = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $boq = array(
                'poq_id' => $rows['poq_id'],
                'poq_item_no' => self::enc('denc',$rows['poq_item_no'])
            );
            $boqs[] = $boq;
        }
        self::_unset();
        return $boqs;
    }

    public function BoqForSelectInput($poq_project_code):string{
        $boqs = (array)self::_boqforselectinput($poq_project_code);
        header("http/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $boqs);
        return json_encode($this->response);
        exit();
    }


    private function _updatereferaceno($params):bool{
        $this->sql = "UPDATE pms_project_summary set project_boq_refno = :project_boq_refno,project_boq_revision = :project_boq_revision where project_id = :project_id";
        $this->cm = $this->cn->prepare($this->sql);
        $up = $this->cm->execute($params);
        self::_unset();
        return $up;
    }
    public function UpdateProjectBoqReferanceNO($params):string{
        $sv = (bool)self::_updatereferaceno($params);
        if(!$sv){
            header('http/1.0 500 error');
            $this->response = array("msg" => "0" , "data" => "Error on update");
            return json_encode($this->response);
            exit();
        }
        header('http/1.0 200 ok');
        $this->response = array("msg" => "1" , "data" => "Updated");
        return json_encode($this->response);
        exit();
    }
}
