<?php
require_once 'mac.php';
class GO_SUPPLIERS extends mac
{
    protected $cn;
    protected $cm;
    protected $sql;
    protected $response = [];
        
    private function pms_glass_suppliers($rows)
    {
        extract($rows);
        $cols['glasssupplierid'] = !isset($glasssupplierid) || trim($glasssupplierid) === "" ? "0" : $glasssupplierid;
        $cols['glasssuppliername'] = !isset($glasssuppliername) || trim($glasssuppliername) === "" ? "0" : ucwords(strtolower($glasssuppliername));
        $cols['glasssuppliercountry'] = !isset($glasssuppliercountry) || trim($glasssuppliercountry) === "" ? "0" : ucwords(strtolower($glasssuppliercountry));
        $cols['suppliercontact'] = !isset($suppliercontact) || trim($suppliercontact) === "" ? "0" : $suppliercontact;
        $cols['supplieraddress'] = !isset($supplieraddress) || trim($supplieraddress) === "" ? "0" : $supplieraddress;
        $cols['supplieremail'] = !isset($supplieremail) || trim($supplieremail) === "" ? "0" : $supplieremail;
        $cols['supplierphone'] = !isset($supplierphone) || trim($supplierphone) === "" ? "0" : $supplierphone;
        $cols['supplierfax'] = !isset($supplierfax) || trim($supplierfax) === "" ? "0" : $supplierfax;
        return $cols;
    }
    private function _allglasssuppliers()
    {
        $this->sql = "SELECT *FROM pms_glass_suppliers";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $suppliers = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $supplier = $this->pms_glass_suppliers($rows);
            $suppliers[] = $supplier;
        }
        unset($this->cm, $this->sql, $rows);
        return $suppliers;
    }
    public function GetAllGlassSuppliers()
    {
        $suppliers = $this->_allglasssuppliers();
        $this->response = array(
            "msg" => "1",
            "data" => $suppliers
        );
        return json_encode($this->response);
        exit;
    }
    private function _checksupplierwithid($glasssupplierid)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_suppliers where glasssupplierid = :glasssupplierid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasssupplierid", $glasssupplierid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }
    private function _getSupplierInfo($glasssupplierid)
    {
        $this->sql = "SELECT * FROM pms_glass_suppliers where glasssupplierid = :glasssupplierid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasssupplierid", $glasssupplierid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $supplier = $this->pms_glass_suppliers($rows);
        unset($this->cm, $this->sql, $rows);
        return $supplier;
    }

    public function GetGlassSupplierinfo($glasssupplierid)
    {
        $cnt = $this->_checksupplierwithid($glasssupplierid);
        if ($cnt !== 1) {
            $this->response = array("msg" => "0", "data" => "No Record Found");
            return json_encode($this->response);
            return;
        }
        $supplier = $this->_getSupplierInfo($glasssupplierid);
        $this->response = array("msg" => "1", "data" => $supplier);
        return json_encode($this->response);
        exit;
    }

    private function _checksupplier($glasssuppliername, $glasssuppliercountry)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_suppliers where glasssuppliername = :glasssuppliername and glasssuppliercountry = :glasssuppliercountry";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasssuppliername", $glasssuppliername);
        $this->cm->bindParam(":glasssuppliercountry", $glasssuppliercountry);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }
    private function _addsupplier($save)
    {
        $this->sql = "INSERT INTO pms_glass_suppliers 
        values(
            null,
            :glasssuppliername,
            :glasssuppliercountry,
            :suppliercontact,
            :supplieraddress,
            :supplieremail,
            :supplierphone,
            :supplierfax
            )";
        $this->cm = $this->cn->prepare($this->sql);        
        $sv = $this->cm->execute($save);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function AddnewGlassSupplier($save)
    {
        $name = strtolower($save[':glasssuppliername']);
        $country = strtolower($save[':glasssuppliercountry']);
        $cnt = $this->_checksupplier($name, $country);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "Already This Supplier Information Exists");
            return json_encode($this->response);
            exit;
        }
        $sv = $this->_addsupplier($save);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error On Save Data");
            return json_encode($this->response);
            exit;
        }
        $suppliers = $this->_allglasssuppliers();
        $this->response = array(
            "msg" => "1",
            "data" => $suppliers
        );
        return json_encode($this->response);
        exit;
    }

    private function _checksupplierupdate($glasssuppliername, $glasssuppliercountry, $glasssupplierid)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_glass_suppliers where glasssuppliername = :glasssuppliername and glasssuppliercountry = :glasssuppliercountry and glasssupplierid <> :glasssupplierid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasssuppliername", $glasssuppliername);
        $this->cm->bindParam(":glasssuppliercountry", $glasssuppliercountry);
        $this->cm->bindParam(":glasssupplierid", $glasssupplierid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }
    private function _updatesupplier($params)
    {
        $this->sql = "UPDATE pms_glass_suppliers set 
        glasssuppliername = :glasssuppliername,        
        glasssuppliercountry = :glasssuppliercountry,
        suppliercontact = :suppliercontact,
        supplieraddress = :supplieraddress,
        supplieremail = :supplieremail,
        supplierphone = :supplierphone, 
        supplierfax = :supplierfax 
        where glasssupplierid = :glasssupplierid";
        $this->cm = $this->cn->prepare($this->sql);  
        $up = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $up;
    }
    public function UpdateGlassSupplier($save)
    {
        $glasssuppliername = $save[':glasssuppliername'];
        $glasssuppliercountry = $save[':glasssuppliercountry'];
        $glasssupplierid = $save[':glasssupplierid'];
        $name = strtolower($glasssuppliername);
        $country = strtolower($glasssuppliercountry);
        $cnt = $this->_checksupplierupdate($name, $country, $glasssupplierid);
        if ($cnt !== 0) {
            $this->response = array("msg" => "0", "data" => "Already This Supplier Information Exists");
            return json_encode($this->response);
            exit;
        }

        $update = $this->_updatesupplier($save);
        if (!$update) {
            $this->response = array("msg" => "0", "data" => "Error On Update Data");
            return json_encode($this->response);
            exit;
        }
        $suppliers = $this->_allglasssuppliers();
        $this->response = array(
            "msg" => "1",
            "data" => $suppliers
        );
        return json_encode($this->response);
        exit;
    }
    //supplier End
}
