<?php
require_once 'mac.php';
class PPWorkNew extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response;

    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array(
            "msg" => "0",
            "date" => "_Error"
        );
    }

    private function _save($infos)
    {
        $this->sql = "INSERT INTO ppnewrpt values(
                null,
                :ppproject,
                :pptype,
                :ppdescription,
                :ppcolor,
                :qty,
                :totkg,
                :delno,
                :rckg,
                :rcqty,
                :eta,
                :location,
                :remarks,
                :cdate,
                :edate,
                :cby,
                :eby,
                :type,
                :pjno,
                :ppdate
                )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($infos);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function saveAction($infos)
    {
        if ($this->_save($infos)) {
            $this->response = array(
                "msg" => "1",
                "data" => "Saved"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "database Error"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function GetAll($type)
    {
        
        $this->sql = "SELECT *FROM ppnewrpt where type=:type";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":type", $type);
        $this->cm->execute();
        $ppworks = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $ppworks[] = array(
                'ppid' => $ppid,
                'ppproject' => $ppproject,
                'pptype' => $pptype,
                'ppdescription' => $ppdescription,
                'ppcolor' => $ppcolor,
                'qty' => (float)$qty,
                'totkg' => $totkg,
                'delno' => $delno,
                'rckg' => $rckg,
                'rcqty' => $rcqty,
                'eta' => $eta,
                'location' => $location,
                'remarks' => $remarks,
                'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:S'),
                'edate' => date_format(date_create($edate), 'd-M-Y H:i:S'),
                'cby' => $cby,
                'eby' => $eby,
                'type' => $type,
                'typef' => $type === 'whtopp' ?'WAREHOSUE TO PAINT PLANT' : 'FACTORY TO PAINT PLANT',
                'pjno' => $pjno,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),
            );
        }
        $res = [];
        foreach ($ppworks as $p) {
            $id = $p['ppid'];
            $this->sql = "SELECT sum(returnqty) as rtn FROM ppsubreport where ppid=:ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid", $id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $trc = 0;
            if (!is_null($rows['rtn'])) {
                $trc = $rows['rtn'];
            }
            unset($this->sql, $this->cm, $rows);
            $tisue = (float)$p['qty'];
            $balance = $tisue - $trc;
            $p['receiptqty'] = (float)$trc;
            $p['balance'] = (float)$balance;
            $res[] = $p;
        }
        $this->response = array(
            "msg" => "1",
            "data" => $res,
        );
        unset($this->cm, $this->sql, $rows);
        return json_encode($this->response);
        exit();
    }


    public function GetAllWo()
    {
        $this->sql = "SELECT *FROM ppnewrpt  order by ppdate desc";
        $this->cm = $this->cn->prepare($this->sql);        
        $this->cm->execute();
        $ppworks = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $ppworks[] = array(
                'ppid' => $ppid,
                'ppproject' => $ppproject,
                'pptype' => $pptype,
                'ppdescription' => $ppdescription,
                'ppcolor' => $ppcolor,
                'qty' => $qty,
                'totkg' => $totkg,
                'delno' => $delno,
                'rckg' => $rckg,
                'rcqty' => $rcqty,
                'eta' => $eta,
                'location' => $location,
                'remarks' => $remarks,
                'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:S'),
                'edate' => date_format(date_create($edate), 'd-M-Y H:i:S'),
                'cby' => $cby,
                'eby' => $eby,
                'type' => $type,
                'typef' => $type === 'whtopp' ?'WAREHOSUE TO PAINT PLANT' : 'FACTORY TO PAINT PLANT',
                'pjno' => $pjno,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),
            );
        }
        $res = [];
        foreach ($ppworks as $p) {
            $id = $p['ppid'];
            $this->sql = "SELECT sum(returnqty) as rtn FROM ppsubreport where ppid=:ppid";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ppid", $id);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $trc = 0;
            if (!is_null($rows['rtn'])) {
                $trc = $rows['rtn'];
            }
            unset($this->sql, $this->cm, $rows);
            $tisue = (float)$p['qty'];
            $balance = $tisue - $trc;
            $p['receiptqty'] = $trc;
            $p['balance'] = $balance;
            $res[] = $p;
        }
        $this->response = array(
            "msg" => "1",
            "data" => $res,
        );
        unset($this->cm, $this->sql, $rows);
        return json_encode($this->response);
        exit();
    }

    private function _idCheck($id)
    {
        $this->sql = "SELECT *FROM ppnewrpt where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $cnt = $this->cm->rowCount();
        unset($this->cm, $this->sql);
        return $cnt;
    }

    private function _idinfos($id)
    {
        $this->sql = "SELECT *FROM ppnewrpt where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        extract($rows);
        $ppworks = array(
            'ppid' => $ppid,
            'ppproject' => $ppproject,
            'pptype' => $pptype,
            'ppdescription' => $ppdescription,
            'ppcolor' => $ppcolor,
            'qty' => $qty,
            'totkg' => $totkg,
            'delno' => $delno,
            'rckg' => $rckg,
            'rcqty' => $rcqty,
            'eta' => $eta,
            'location' => $location,
            'remarks' => $remarks,
            'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:s'),
            'edate' => date_format(date_create($edate), 'd-M-Y H:i:s'),
            'cby' => $cby,
            'eby' => $eby,
            'type' => $type,
            'pjno' => $pjno,
            'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
            'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
            'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
            'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),         

        );

        unset($this->cm, $this->sql, $rows);
        return $ppworks;
    }

    public function GetInfo($id)
    {
        if ($this->_idCheck($id) === 1) {
            $this->response = array(
                'msg' => "1",
                'data' =>  $this->_idinfos($id)
            );
        } else {
            $this->response = array(
                'msg' => "0",
                'data' => "No Data Found"
            );
        }
        return json_encode($this->response);
        exit();
    }

    private function _update($infos)
    {
        $this->sql = "UPDATE ppnewrpt set 
        qty = :qty,
        totkg = :totkg,
        eta = :eta,
        location = :location,
        remarks = :remarks,
        edate = :edate,
        eby = :eby,
        ppcolor = :ppcolor
        where 
        ppid = :ppid";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($infos);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function UpdateData($infos)
    {
        if ($this->_update($infos)) {
            $this->response = array(
                "msg" => "1",
                "data" => "Update"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Update Error"
            );
        }
        return json_encode($this->response);
        exit();
    }

    private function _saveDeleteinfo($id, $user, $type)
    {
        $del_type = $this->enc('enc', json_encode($this->_idinfos($id)));
        $del_page = $this->enc('enc', $type);
        $del_date = date('Y-m-d h:i:s');
        $delusername = $this->enc('enc', $user);

        $this->sql = "INSERT INTO ppdeletelog values(
            null,
            :del_type,
            :del_page,
            :del_date,
            :delusername
        )";
        $svdata = array(
            'del_type' => $del_type,
            'del_page' => $del_page,
            'del_date' => $del_date,
            'delusername' => $delusername,
        );
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($svdata);

        unset($this->cm, $this->sql);
        return $sv;
    }
    private function _delete($id)
    {
        $this->sql = "DELETE FROM ppnewrpt where ppid=:ppid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $sv = $this->cm->execute();
        unset($this->sql, $this->cm);
        return $sv;
    }

    public function Delete($id, $user, $type)
    {
        if ($this->_saveDeleteinfo($id, $user, $type)) {
            if ($this->_delete($id)) {
                $this->response = array(
                    "msg" => "1",
                    "data" => "Saved"
                );
            } else {
                $this->response = array(
                    "msg" => "0",
                    "data" => "ERROR ON REMOVE."
                );
            }
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "LOG SAVE ERROR"
            );
        }

        return json_encode($this->response);
        exit();
    }




    private function _saveReceipt($infos)
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
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function SaveReceipt($infos)
    {
        $qtyok = true;
        if ($qtyok) {
            if ($this->_saveReceipt($infos)) {
                $this->response = array(
                    'msg' => "1",
                    'data' => "Saved"
                );
            } else {
                $this->response = array(
                    'msg' => "0",
                    'data' => "Database Error"
                );
            }
        } else {
            $this->response = array(
                'msg' => "0",
                'data' => "out of qty"
            );
        }

        return json_encode($this->response);
        exit();
    }

    public function GetReceiptByid($id)
    {
        $this->sql = "SELECT * FROM ppsubreport inner join ppnewrpt on ppsubreport.ppid=ppnewrpt.ppid where ppsubreport.ppid=:ppid  order by ppsubreport.returndate desc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ppid", $id);
        $this->cm->execute();
        $rec = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $rec[] = array(
                'ppid' => $ppid,
                'ppproject' => $ppproject,
                'pptype' => $pptype,
                'ppdescription' => $ppdescription,
                'ppcolor' => $ppcolor,
                'qty' => $qty,
                'totkg' => $totkg,
                'delno' => $delno,
                'rckg' => $rckg,
                'rcqty' => $rcqty,
                'eta' => $eta,
                'location' => $location,
                'remarks' => $remarks,
                'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:s'),
                'edate' => date_format(date_create($edate), 'd-M-Y H:i:s'),
                'cby' => $cby,
                'eby' => $eby,
                'type' => $type,
                'typef' => $type === 'whtopp' ?'WAREHOSUE TO PAINT PLANT' : 'FACTORY TO PAINT PLANT',
                'pjno' => $pjno,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),

                'returnid' => $returnid,
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => date_format(date_create($pcdate),'d-M-Y H:i:s'),
                'peditdate' => date_format(date_create($peditdate),'d-M-Y H:i:s'),
                'pextra' => $pextra,
                'returndate' => date_format(date_create($returndate), 'Y-m-d'),
                'returndate_d' => date_format(date_create($returndate), 'd-M-Y'),
                'returndate_n' => date_format(date_create($returndate), 'd-m-Y'),
                'returndate_p' => date_format(date_create($returndate), 'd-m-y'),
            );
        }

        $this->response = array(
            'msg' => "1",
            'data' => $rec
        );
        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        exit();
    }

    public function AllReceipt()
    {
        $this->sql = "SELECT * FROM ppsubreport inner join ppnewrpt on ppsubreport.ppid=ppnewrpt.ppid  order by returndate desc";
        $this->cm = $this->cn->prepare($this->sql);        
        $this->cm->execute();
        $rec = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $weight = !is_numeric($totkg) ? 0 : (float)$totkg;
            $wt = 0;
            if($weight === 0){
                $wt = 0;
            }else{
                $qty = (float)$qty;
                $oneweight = $weight/$qty;
                $rcqty = (float)$returnqty;
                $wt = $rcqty * $oneweight;
            }
            $rec[] = array(
                'ppid' => $ppid,
                'ppproject' => $ppproject,
                'pptype' => $pptype,
                'ppdescription' => $ppdescription,
                'ppcolor' => $ppcolor,
                'qty' => $qty,
                'totkg' => $totkg,
                'delno' => $delno,
                'rckg' => $rckg,
                'rcqty' => $rcqty,
                'eta' => $eta,
                'location' => $location,
                'remarks' => $remarks,
                'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:s'),
                'edate' => date_format(date_create($edate), 'd-M-Y H:i:s'),
                'cby' => $cby,
                'eby' => $eby,
                'type' => $type,
                'typef' => $type === 'whtopp' ?'WAREHOSUE TO PAINT PLANT' : 'FACTORY TO PAINT PLANT',
                'pjno' => $pjno,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),

                'returnweight' => $wt,
                'returnid' => $returnid,
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => date_format(date_create($pcdate),'d-M-Y H:i:s'),
                'peditdate' => date_format(date_create($peditdate),'d-M-Y H:i:s'),
                'pextra' => $pextra,
                'returndate' => date_format(date_create($returndate), 'Y-m-d'),
                'returndate_d' => date_format(date_create($returndate), 'd-M-Y'),
                'returndate_n' => date_format(date_create($returndate), 'd-m-Y'),
                'returndate_p' => date_format(date_create($returndate), 'd-m-y'),
            );
        }

        $this->response = array(
            'msg' => "1",
            'data' => $rec
        );
        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        exit();
    }

    public function AllReceiptwt($type)
    {
        $this->sql = "SELECT * FROM ppsubreport inner join ppnewrpt on ppsubreport.ppid=ppnewrpt.ppid  where ppnewrpt.type=:type  order by returndate desc";
        $this->cm = $this->cn->prepare($this->sql);        
        $this->cm->bindParam("type",$type);
        $this->cm->execute();
        $rec = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $rec[] = array(
                'ppid' => $ppid,
                'ppproject' => $ppproject,
                'pptype' => $pptype,
                'ppdescription' => $ppdescription,
                'ppcolor' => $ppcolor,
                'qty' => $qty,
                'totkg' => $totkg,
                'delno' => $delno,
                'rckg' => $rckg,
                'rcqty' => $rcqty,
                'eta' => $eta,
                'location' => $location,
                'remarks' => $remarks,
                'cdate' => date_format(date_create($cdate), 'd-M-Y H:i:s'),
                'edate' => date_format(date_create($edate), 'd-M-Y H:i:s'),
                'cby' => $cby,
                'eby' => $eby,
                'type' => $type,
                'typef' => $type === 'whtopp' ?'WAREHOSUE TO PAINT PLANT' : 'FACTORY TO PAINT PLANT',
                'pjno' => $pjno,
                'ppdate' => date_format(date_create($ppdate), 'Y-m-d'),
                'ppdate_d' => date_format(date_create($ppdate), 'd-M-Y'),
                'ppdate_n' => date_format(date_create($ppdate), 'd-m-Y'),
                'ppdate_p' => date_format(date_create($ppdate), 'd-m-y'),

                'returnid' => $returnid,
                'returnqty' => $returnqty,
                'rtno' => $rtno,
                'rcpno' => $rcpno,
                'remark' => $remark,
                'ppid' => $ppid,
                'pcby' => $pcby,
                'peby' => $peby,
                'pcdate' => date_format(date_create($pcdate),'d-M-Y H:i:s'),
                'peditdate' => date_format(date_create($peditdate),'d-M-Y H:i:s'),
                'pextra' => $pextra,
                'returndate' => date_format(date_create($returndate), 'Y-m-d'),
                'returndate_d' => date_format(date_create($returndate), 'd-M-Y'),
                'returndate_n' => date_format(date_create($returndate), 'd-m-Y'),
                'returndate_p' => date_format(date_create($returndate), 'd-m-y'),
            );
        }

        $this->response = array(
            'msg' => "1",
            'data' => $rec
        );
        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        exit();
    }
}
