<?php
class bomitem
{
    private $cn;
    private $cm;
    private $sql;
    private $response;

    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array("msg" => "0", "data" => "_error");
    }

    public function getItemInfo($itemid){
        $this->sql = "SELECT *FROM bom_items where itemid=:itemid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":itemid",$itemid);
        $this->cm->execute();
        if($this->cm->rowCount() === 0){
            $this->response = array("msg" => "0" , "data" => "No Data Found");
        }else{
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($rows);
            $iteminfo = array(
                'itemid' => $itemid,
                'itemprofileno' => $itemprofileno,
                'itempartno' => $itempartno,
                'itemalloy' => $itemalloy,
                'itemfinish' => $itemfinish,
                'itemlength' => $itemlength,
                'itemunit' => $itemunit,
                'itemdieweight' => $itemdieweight,
                'itemsystem' => $itemsystem,
                'itemtype' => $itemtype,
                'itemavai' => $itemavai,
                'itemtotweight' => $itemtotweight,
                'itemprice' => $itemprice,
                'itemtotprice' => $itemtotprice,
                'itemdescription' => $itemdescription,
                
            );
            $this->response = array("msg" => "1" , "data" => $iteminfo);
        }

        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        //echo json_encode($this->response);
        exit();        
    }

    public function allItems(){
        $this->sql = "SELECT *FROM bom_items order by itempartno,itemalloy,itemlength,itemfinish asc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        if($this->cm->rowCount() === 0){
            $this->response = array("msg" => "0" , "data" => "No data found");
        }else{
            $iteminfo = [];
            while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
                $iteminfo[] = array(
                    'itemid' => $itemid,
                    'itemprofileno' => $itemprofileno,
                    'itempartno' => $itempartno,
                    'itemalloy' => $itemalloy,
                    'itemfinish' => $itemfinish,
                    'itemlength' => $itemlength,
                    'itemunit' => $itemunit,
                    'itemdieweight' => $itemdieweight,
                    'itemsystem' => $itemsystem,
                    'itemtype' => $itemtype,
                    'itemavai' => $itemavai,
                    'itemtotweight' => $itemtotweight,
                    'itemprice' => $itemprice,
                    'itemtotprice' => $itemtotprice,
                    'itemdescription' => $itemdescription,
                    
                );
            }
            $this->response = array("msg" => "1" , "data" => $iteminfo);
        }
        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        exit();
    }

    private function _checkItems($infos){
        $this->sql = "SELECT *FROM bom_items  
            where 
            itemprofileno=:itemprofileno and 
            itempartno=:itempartno and 
            itemalloy=:itemalloy and 
            itemfinish=:itemfinish and 
            itemlength=:itemlength and 
            itemunit=:itemunit and 
            itemdescription=:itemdescription and 
            itemsystem=:itemsystem
        ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($infos);
        $cnt = $this->cm->rowCount();
        unset($this->cm,$this->sql);
        return $cnt;
    }

    private function _itemAdd($infos){
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
        $issave = $this->cm->execute($infos);
        unset($this->sql,$this->cm);
        return $issave;
    }

    public function itemSave($checkinfo,$saveinfo){
        if($this->_checkItems($checkinfo) === 0){
            if($this->_itemAdd($saveinfo)){
                $this->response = array("msg" => "1","data" => "Saved");
            }else{
                $this->response = array("msg" => "0","data" => "Database Error");
            }
        }else{
            $this->response = array("msg" => "0","data" => "Already Exist");
        }

        return json_encode($this->response);
        exit();
    }
}
