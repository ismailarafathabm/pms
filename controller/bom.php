<?php
require_once 'autono.php';
class Bom extends AutoNum
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

    public function getLastNo($projectno, $type)
    {
        $this->sql = "SELECT max(bomsno) as lno from bomnew where bomtype=:bomtype and bomproject=:bomproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bomtype", $type);
        $this->cm->bindParam(":bomproject", $projectno);
        $this->cm->execute();
        $sno = 1;
        if ($this->cm->rowCount() !== 0) {
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $_sno =  $rows['lno'];
            $sno = (int)$_sno + 1;
        }
        $_p = strtoupper($projectno);
        $x = strlen($sno);
        $y = $sno;
        if ($x === 1) {
            $y = "00" . $sno;
        } else if ($x === 2) {
            $y = "0" . $sno;
        } else {
            $y = $sno;
        }

        $ssno = "BOM/$_p/$y";
        $bomsno = $sno;
        $dispx = array(
            "bomno" => $ssno,
            "bomsno" => $bomsno
        );
        $this->response = array(
            "msg" => "1",
            "data" => $dispx
        );
        unset($this->cm, $this->sql, $rows);
        return json_encode($this->response);
        exit();
    }

    private function getSno($project)
    {
        $rno = 1;
        $this->sql = "SELECT *FROM bomnew where bomtype='O' and bomproject=:bomproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bomproject", $project);
        $this->cm->execute();
        if ($this->cm->rowCount() !== 0) {
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $rno += (int)$rows['bomsno'];
        }
        unset($this->cm, $this->sql, $rows);
        return $rno;
    }
    public function Addnew($infos, $project)
    {
        $this->sql = "SELECT MAX(bomid)as lid from bomnew";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $sno = 1;
        if (!is_null($rows['lid'])) {
            $sno = (int)$rows['lid'] + 1;
        }
        foreach ($infos as $i) {
            $bomtype = "O";
            $para = array(
                ":bomdate" => $i["bomdate"],
                ":bomproject" => $i["bomproject"],
                ":bomcontract" => $i["bomcontract"],
                ":bomcolor" => $i["bomcolor"],
                ":bomno" => $i["bomno"],
                ":bomsystem" => $i["bomsystem"],
                ":bomprofileno" => $i["bomprofileno"],
                ":bompartno" => $i["bompartno"],
                ":bomdescription" => $i["bomdescription"],
                ":bomdieweight" => $i["bomdieweight"],
                ":bomunit" => $i["bomunit"],
                ":bomreqlength" => $i["bomreqlength"],
                ":bomreqbarqty" => $i["bomreqbarqty"],
                ":bomreqtotweight" => $i["bomreqtotweight"],
                ":bomavailength" => $i["bomavailength"],
                ":bomavaibarqty" => $i["bomavaibarqty"],
                ":bomavaiweight" => $i["bomavaiweight"],
                ":bomorderlength" => $i["bomorderlength"],
                ":bomorderbarqty" => $i["bomorderbarqty"],
                ":bomordertotweight" => $i["bomordertotweight"],
                ":bomremark" => $i["bomremark"],
                ":flagprepare" => $i["flagprepare"],
                ":prepareupdate" => $i["prepareupdate"],
                ":prepareby" => $i["prepareby"],
                ":flagchecked" => $i["flagchecked"],
                ":checkedupdate" => $i["checkedupdate"],
                ":checkedby" => $i["checkedby"],
                ":flagapproved" => $i["flagapproved"],
                ":approvedupdate" => $i["approvedupdate"],
                ":approvedby" => $i["approvedby"],
                ":bomitemid" => $i["bomitemid"],
                ":mtype" => $i["mtype"],
                ":alloy" => $i["alloy"],
                ":finish" => $i["finish"],
                ":length" => $i["length"],
                ":bomtype" => $bomtype,
                ":bomsno" => $i["bomsno"],
                ":bomlastno" => "L"
            );

            $this->sql = "INSERT INTO bomnew values(
                    null,
                    :bomdate,
                    :bomproject,
                    :bomcontract,
                    :bomcolor,
                    :bomno,
                    :bomsystem,
                    :bomprofileno,
                    :bompartno,
                    :bomdescription,
                    :bomdieweight,
                    :bomunit,
                    :bomreqlength,
                    :bomreqbarqty,
                    :bomreqtotweight,
                    :bomavailength,
                    :bomavaibarqty,
                    :bomavaiweight,
                    :bomorderlength,
                    :bomorderbarqty,
                    :bomordertotweight,
                    :bomremark,
                    :flagprepare,
                    :prepareupdate,
                    :prepareby,
                    :flagchecked,
                    :checkedupdate,
                    :checkedby,
                    :flagapproved,
                    :approvedupdate,
                    :approvedby,
                    :bomitemid,
                    :mtype,
                    :alloy,
                    :finish,
                    :length,
                    :bomtype,
                    :bomsno,
                    :bomlastno,
                    $sno
                )";
            $this->cm = $this->cn->prepare($this->sql);
            //$r =
            $this->cm->execute($para);

            ///$y = $r===true ? "OK" : "Error";
            ///echo  $y;
            unset($this->cm, $this->sql, $para);
            $sno += 1;
        }
        $this->response = array("msg" => "1", "data" => "Saved");
        return json_encode($this->response);
        exit();
    }

    public function allBOm($projectno)
    {
        $this->sql = "SELECT *FROM bomnew where bomproject=:bomproject and bomtype=:bomtype";
        $this->cm = $this->cn->prepare($this->sql);
        $x = "O";
        $this->cm->bindParam(":bomproject", $projectno);
        $this->cm->bindParam(":bomtype", $x);
        $this->cm->execute();

        $boms = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $boms[] = array(
                'bomid' => $bomid,
                'bomdate' => date_format(date_create($bomdate), 'Y-m-d'),
                'bomdate_d' => date_format(date_create($bomdate), 'd-M-Y'),
                'bomdate_n' => date_format(date_create($bomdate), 'd-m-Y'),
                'bomdate_p' => date_format(date_create($bomdate), 'd-m-y'),
                'bomproject' => strtoupper($bomproject),
                'bomcontract' => $bomcontract,
                'bomcolor' => $bomcolor,
                'bomno' => $bomno,
                'flagprepare' => $flagprepare,
                'prepareupdate' => date_format(date_create($prepareupdate), 'd-M-Y h:i:s a'),
                'prepareby' => $prepareby,
                'flagchecked' => $flagchecked,
                'checkedupdate' => date_format(date_create($checkedupdate), 'd-M-Y h:i:s a'),
                'checkedby' => $checkedby,
                'flagapproved' => $flagapproved,
                'approvedupdate' => date_format(date_create($approvedupdate), 'd-M-Y h:i:s a'),
                'approvedby' => $approvedby,
                'bomsystem' => $bomsystem,
                'bomprofileno' => $bomprofileno,
                'bompartno' => $bompartno,
                'bomdescription' => $bomdescription,
                'bomdieweight' => $bomdieweight,
                'bomunit' => $bomunit,
                'bomreqlength' => $bomreqlength,
                'bomreqbarqty' => $bomreqbarqty,
                'bomreqtotweight' => $bomreqtotweight,
                'bomavailength' => $bomavailength,
                'bomavaibarqty' => $bomavaibarqty,
                'bomavaiweight' => $bomavaiweight,
                'bomorderlength' => $bomorderlength,
                'bomorderbarqty' => $bomorderbarqty,
                'bomordertotweight' => $bomordertotweight,
                'bomremark' => $bomremark,
                'bomitemid' => $bomitemid,
                'mtype' => $mtype,
                'alloy' => $alloy,
                'finish' => $finish,
                'length' => $length,
                'bomtype' => $bomtype,
                'bomsno' => $bomsno,
                'bomlastno' => $bomlastno,
                'rwid' => $rwid,
            );
        }
        unset($this->cm, $this->sql, $rows);
        $responsex = [];

        foreach ($boms as $b) {
            $haveR = "F";
            //check it already Revision 
            $xrwid = $b['rwid'];
            $this->sql = "SELECT *FROM bomnew where rwid=$xrwid and bomtype='R' order by bomid desc";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->execute();
            $hvadd = "N";
            if($this->cm->rowCount() !== 0 ){
                $haveR = "T";
                $row = $this->cm->fetch(PDO::FETCH_ASSOC);
                extract($row);
                $b = array(
                    'bomid' => $bomid,
                    'bomdate' => date_format(date_create($bomdate), 'Y-m-d'),
                    'bomdate_d' => date_format(date_create($bomdate), 'd-M-Y'),
                    'bomdate_n' => date_format(date_create($bomdate), 'd-m-Y'),
                    'bomdate_p' => date_format(date_create($bomdate), 'd-m-y'),
                    'bomproject' => strtoupper($bomproject),
                    'bomcontract' => $bomcontract,
                    'bomcolor' => $bomcolor,
                    'bomno' => $bomno,
                    'flagprepare' => $flagprepare,
                    'prepareupdate' => date_format(date_create($prepareupdate), 'd-M-Y h:i:s a'),
                    'prepareby' => $prepareby,
                    'flagchecked' => $flagchecked,
                    'checkedupdate' => date_format(date_create($checkedupdate), 'd-M-Y h:i:s a'),
                    'checkedby' => $checkedby,
                    'flagapproved' => $flagapproved,
                    'approvedupdate' => date_format(date_create($approvedupdate), 'd-M-Y h:i:s a'),
                    'approvedby' => $approvedby,
                    'bomsystem' => $bomsystem,
                    'bomprofileno' => $bomprofileno,
                    'bompartno' => $bompartno,
                    'bomdescription' => $bomdescription,
                    'bomdieweight' => $bomdieweight,
                    'bomunit' => $bomunit,
                    'bomreqlength' => $bomreqlength,
                    'bomreqbarqty' => $bomreqbarqty,
                    'bomreqtotweight' => $bomreqtotweight,
                    'bomavailength' => $bomavailength,
                    'bomavaibarqty' => $bomavaibarqty,
                    'bomavaiweight' => $bomavaiweight,
                    'bomorderlength' => $bomorderlength,
                    'bomorderbarqty' => $bomorderbarqty,
                    'bomordertotweight' => $bomordertotweight,
                    'bomremark' => $bomremark,
                    'bomitemid' => $bomitemid,
                    'mtype' => $mtype,
                    'alloy' => $alloy,
                    'finish' => $finish,
                    'length' => $length,
                    'bomtype' => $bomtype,
                    'bomsno' => $bomsno,
                    'bomlastno' => $bomlastno,
                    'rwid' => $rwid,
                );
                $tot = 0;
                $b['addqty'] = (string)$tot;
                $finalqty = (int)$tot + (int)$b['bomreqbarqty'];
                $finalwight = (int)$finalqty * (float) $b['bomdieweight'] * (float)$b['bomreqlength'];
                $b['finalqty'] = $finalqty;
                $b['finalwight'] = number_format((float)$finalwight, 3, '.', '');
                
                $hvadd = "Y";
                $b['isaddtionalh'] = $hvadd;
                $b['ishaveR'] = $haveR;
                unset($this->cm, $this->sql, $rows);
                $responsex[] = $b;

            }
          
            
            if ($haveR === "F") {
                $bomid = $b['bomid'];
                $hvadd = "N";
                $this->sql = "SELECT SUM(bomreqbarqty) as Tt from bomnew where rwid=$bomid and bomtype='A'";
                $this->cm = $this->cn->prepare($this->sql);
                $tot = 0;
                $this->cm->execute();
                if ($this->cm->rowCount() !== 0) {

                    $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
                    if (!is_null($rows['Tt'])) {
                        $hvadd = "Y";
                        $tot = $rows['Tt'];
                    }
                }

                $b['addqty'] = (string)$tot;
                $finalqty = (int)$tot + (int)$b['bomreqbarqty'];
                $finalwight = (int)$finalqty * (float) $b['bomdieweight'] * (float)$b['bomreqlength'];

                $b['finalqty'] = $finalqty;
                $b['finalwight'] = number_format((float)$finalwight, 3, '.', '');
                $b['isaddtionalh'] = $hvadd;
                $b['ishaveR'] = $haveR;

              
                unset($this->cm, $this->sql, $rows);
                $responsex[] = $b;
            }
          
        }

        $this->response = array(
            "msg" => "1",
            "data" => $responsex
        );

        return json_encode($this->response);
        exit();
    }

    public function getbom($projectno)
    {
        $this->sql = "SELECT bomdate,
                        bomproject,
                        bomcontract,
                        bomcolor,
                        bomno,
                        flagprepare,
                        prepareupdate,
                        prepareby,
                        flagchecked,
                        checkedupdate,
                        checkedby,
                        flagapproved,
                        approvedupdate,
                        approvedby,
                        sum(bomreqbarqty) as rqty,
                        sum(bomreqtotweight) as rweight,
                        sum(bomavaibarqty) as avgqty,
                        sum(bomavaiweight) as aviweight,
                        sum(bomorderbarqty) as ordqty,
                        sum(bomordertotweight) as ordweight
                        FROM `bomnew` where bomproject=:bomproject group by bomno order by bomno desc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bomproject", $projectno);
        $this->cm->execute();
        $r = [];

        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $r[] = array(
                'bomdate' => date_format(date_create($bomdate), 'Y-m-d'),
                'bomdate_d' => date_format(date_create($bomdate), 'd-M-Y'),
                'bomdate_n' => date_format(date_create($bomdate), 'd-m-Y'),
                'bomdate_p' => date_format(date_create($bomdate), 'd-m-y'),
                'bomproject' => strtoupper($bomproject),
                'bomcontract' => $bomcontract,
                'bomcolor' => $bomcolor,
                'bomno' => $bomno,
                'flagprepare' => $flagprepare,
                'prepareupdate' => date_format(date_create($prepareupdate), 'd-M-Y h:i:s a'),
                'prepareby' => $prepareby,
                'flagchecked' => $flagchecked,
                'checkedupdate' => date_format(date_create($checkedupdate), 'd-M-Y h:i:s a'),
                'checkedby' => $checkedby,
                'flagapproved' => $flagapproved,
                'approvedupdate' => date_format(date_create($approvedupdate), 'd-M-Y h:i:s a'),
                'approvedby' => $approvedby,
                'rqty' => $rqty,
                'rweight' => $rweight,
                'avgqty' => $avgqty,
                'aviweight' => $aviweight,
                'ordqty' => $ordqty,
                'ordweight' => $ordweight
            );
        }

        $this->response = array(
            "msg" => "1",
            "data" => $r
        );

        return json_encode($this->response);
        exit();
    }

    public function AdditionBom($id, $nwqty, $date, $projectno, $remark)
    {
        $this->sql = "INSERT INTO `bomnew` (
                `bomdate` ,
                `bomproject` ,
                `bomcontract` ,
                `bomcolor` ,
                `bomno` ,
                `bomsystem` ,
                `bomprofileno` ,
                `bompartno` ,
                `bomdescription` ,
                `bomdieweight` ,
                `bomunit` ,
                `bomreqlength` ,
                `bomreqbarqty` ,
                `bomreqtotweight` ,
                `bomavailength` ,
                `bomavaibarqty` ,
                `bomavaiweight` ,
                `bomorderlength` ,
                `bomorderbarqty` ,
                `bomordertotweight` ,
                `bomremark` ,
                `flagprepare` ,
                `prepareupdate` ,
                `prepareby` ,
                `flagchecked` ,
                `checkedupdate` ,
                `checkedby` ,
                `flagapproved` ,
                `approvedupdate` ,
                `approvedby` ,
                `bomitemid` ,
                `mtype` ,
                `alloy` ,
                `finish` ,
                `length` ,
                `bomtype` ,
                `bomsno` ,
                `bomlastno`,
                `rwid`
                ) select `bomdate` ,
                `bomproject` ,
                `bomcontract` ,
                `bomcolor` ,
                `bomno` ,
                `bomsystem` ,
                `bomprofileno` ,
                `bompartno` ,
                `bomdescription` ,
                `bomdieweight` ,
                `bomunit` ,
                `bomreqlength` ,
                `bomreqbarqty` ,
                `bomreqtotweight` ,
                `bomavailength` ,
                `bomavaibarqty` ,
                `bomavaiweight` ,
                `bomorderlength` ,
                `bomorderbarqty` ,
                `bomordertotweight` ,
                `bomremark` ,
                `flagprepare` ,
                `prepareupdate` ,
                `prepareby` ,
                `flagchecked` ,
                `checkedupdate` ,
                `checkedby` ,
                `flagapproved` ,
                `approvedupdate` ,
                `approvedby` ,
                `bomitemid` ,
                `mtype` ,
                `alloy` ,
                `finish` ,
                `length` ,
                `bomtype` ,
                `bomsno` ,
                `bomlastno`,
                `rwid`
                from  bomnew where bomid=:bomid
                ";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':bomid', $id);
        if ($this->cm->execute()) {
            $xid = $this->cn->lastInsertId();
            $this->updateInfos($xid, $nwqty, $date, $projectno, $remark);
            $this->response = array("msg" => "1", "data" => "saved");
        } else {
            $this->response = array("msg" => "0", "data" => "Error");
        }
        unset($this->cm, $this->sql);
        return json_encode($this->response);
        exit();
    }
    private function updateInfos($id, $cnt, $date, $projectno, $remark)
    {
        //get last N ID
        $xyz = strtolower($projectno);
        $this->sql = "SELECT MAX(bomsno) as lno 
                        from bomnew 
                        where bomtype='A' and 
                        bomproject=:bomproject";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bomproject", $xyz);
        $this->cm->execute();
        $sno = 1;
        if ($this->cm->rowCount() !== 0) {
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $_sno =  $rows['lno'];
            $sno = (int)$_sno + 1;
        }
        $_p = strtoupper($projectno);
        $x = strlen($sno);
        $y = $sno;
        if ($x === 1) {
            $y = "A0" . $sno;
        } else {
            $y = "A" . $sno;
        }

        $ssno = "BOM/$_p/$y";

        unset($this->cm, $this->sql, $rows);

        //update 
        $this->sql = "UPDATE bomnew set 
                            bomdate=:bomdate,
                            bomno=:bomno,
                            bomremark=:bomremark,
                            bomtype='A',
                            bomsno=:bomsno,
                            bomlastno=:bomlastno,
                            bomreqbarqty=:bomreqbarqty 
                            where 
                            bomid=:bomid";
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ':bomdate' => $date,
            ':bomno' => $ssno,
            ':bomremark' => $remark,
            ':bomsno' => $sno,
            ':bomlastno' => 'H',
            ':bomreqbarqty' => $cnt,
            ':bomid' => $id
        );
        $this->cm->execute($params);
    }

    public function getAdditionalList($id)
    {
        $this->sql = "SELECT *FROM bomnew where rwid=:rwid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":rwid", $id);
        $this->cm->execute();
        $boms = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $boms[] = array(
                'bomid' => $bomid,
                'bomdate' => date_format(date_create($bomdate), 'Y-m-d'),
                'bomdate_d' => date_format(date_create($bomdate), 'd-M-Y'),
                'bomdate_n' => date_format(date_create($bomdate), 'd-m-Y'),
                'bomdate_p' => date_format(date_create($bomdate), 'd-m-y'),
                'bomproject' => strtoupper($bomproject),
                'bomcontract' => $bomcontract,
                'bomcolor' => $bomcolor,
                'bomno' => $bomno,
                'flagprepare' => $flagprepare,
                'prepareupdate' => date_format(date_create($prepareupdate), 'd-M-Y h:i:s a'),
                'prepareby' => $prepareby,
                'flagchecked' => $flagchecked,
                'checkedupdate' => date_format(date_create($checkedupdate), 'd-M-Y h:i:s a'),
                'checkedby' => $checkedby,
                'flagapproved' => $flagapproved,
                'approvedupdate' => date_format(date_create($approvedupdate), 'd-M-Y h:i:s a'),
                'approvedby' => $approvedby,
                'bomsystem' => $bomsystem,
                'bomprofileno' => $bomprofileno,
                'bompartno' => $bompartno,
                'bomdescription' => $bomdescription,
                'bomdieweight' => $bomdieweight,
                'bomunit' => $bomunit,
                'bomreqlength' => $bomreqlength,
                'bomreqbarqty' => $bomreqbarqty,
                'bomreqtotweight' => $bomreqtotweight,
                'bomavailength' => $bomavailength,
                'bomavaibarqty' => $bomavaibarqty,
                'bomavaiweight' => $bomavaiweight,
                'bomorderlength' => $bomorderlength,
                'bomorderbarqty' => $bomorderbarqty,
                'bomordertotweight' => $bomordertotweight,
                'bomremark' => $bomremark,
                'bomitemid' => $bomitemid,
                'mtype' => $mtype,
                'alloy' => $alloy,
                'finish' => $finish,
                'length' => $length,
                'bomtype' => $bomtype,
                'bomsno' => $bomsno,
                'bomlastno' => $bomlastno,
                'rwid' => $rwid,
            );
        }
        unset($this->cm, $this->sql, $rows);
        $this->response = array(
            "msg" => "1",
            "data" => $boms
        );

        return json_encode($this->response);
        exit();
    }

    public function _getRevisionNo($project)
    {
        $this->sql = "SELECT max(bomsno) as lno from bomnew where bomtype=:bomtype and bomproject=:bomproject";
        $this->cm = $this->cn->prepare($this->sql);
        $type = "R";
        $this->cm->bindParam(":bomtype", $type);
        $this->cm->bindParam(":bomproject", $project);
        $this->cm->execute();
        $sno = 1;
        if ($this->cm->rowCount() !== 0) {
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $_sno =  $rows['lno'];
            $sno = (int)$_sno + 1;
        }
        $_p = strtoupper($project);
        $x = strlen($sno);
        $y = $sno;
        if ($x === 1) {
            $y = "R0" . $sno;
        } else {
            $y = "R" . $sno;
        }

        $ssno = "BOM/$_p/$y";
        $no = array(
            'Y' => $sno,
            'ssno' => $ssno
        );
        unset($this->cm, $this->sql, $rows);

        return $no;
    }

    private function _copydataforRevision($id)
    {
        $this->sql = "INSERT INTO `bomnew` (
                `bomdate` ,
                `bomproject` ,
                `bomcontract` ,
                `bomcolor` ,
                `bomno` ,
                `bomsystem` ,
                `bomprofileno` ,
                `bompartno` ,
                `bomdescription` ,
                `bomdieweight` ,
                `bomunit` ,
                `bomreqlength` ,
                `bomreqbarqty` ,
                `bomreqtotweight` ,
                `bomavailength` ,
                `bomavaibarqty` ,
                `bomavaiweight` ,
                `bomorderlength` ,
                `bomorderbarqty` ,
                `bomordertotweight` ,
                `bomremark` ,
                `flagprepare` ,
                `prepareupdate` ,
                `prepareby` ,
                `flagchecked` ,
                `checkedupdate` ,
                `checkedby` ,
                `flagapproved` ,
                `approvedupdate` ,
                `approvedby` ,
                `bomitemid` ,
                `mtype` ,
                `alloy` ,
                `finish` ,
                `length` ,
                `bomtype` ,
                `bomsno` ,
                `bomlastno`,
                `rwid`
                ) select `bomdate` ,
                `bomproject` ,
                `bomcontract` ,
                `bomcolor` ,
                `bomno` ,
                `bomsystem` ,
                `bomprofileno` ,
                `bompartno` ,
                `bomdescription` ,
                `bomdieweight` ,
                `bomunit` ,
                `bomreqlength` ,
                `bomreqbarqty` ,
                `bomreqtotweight` ,
                `bomavailength` ,
                `bomavaibarqty` ,
                `bomavaiweight` ,
                `bomorderlength` ,
                `bomorderbarqty` ,
                `bomordertotweight` ,
                `bomremark` ,
                `flagprepare` ,
                `prepareupdate` ,
                `prepareby` ,
                `flagchecked` ,
                `checkedupdate` ,
                `checkedby` ,
                `flagapproved` ,
                `approvedupdate` ,
                `approvedby` ,
                `bomitemid` ,
                `mtype` ,
                `alloy` ,
                `finish` ,
                `length` ,
                `bomtype` ,
                `bomsno` ,
                `bomlastno`,
                `rwid`
                from  bomnew where bomid=:bomid
                ";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':bomid', $id);
        $xid = 0;
        if ($this->cm->execute()) {
            $xid = $this->cn->lastInsertId();
        } else {
            $xid = 0;
        }
        unset($this->cm, $this->sql);
        return $xid;
    }

    private function _checkBomId($id)
    {
        $this->sql = "SELECT *FROM bomnew where bomid=:bomid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bomid", $id);
        $this->cm->execute();
        $cnt = $this->cm->rowCount();
        unset($this->sql, $this->cm);
        return $cnt;
    }

    private function updateRevision($id, $infos)
    {
        $this->sql = "UPDATE bomnew set 
            bomdate=:bomdate,
            bomno=:bomno,
            bomsystem=:bomsystem,
            bomprofileno=:bomprofileno,
            bompartno=:bompartno,
            bomdescription=:bomdescription,
            bomdieweight=:bomdieweight,
            bomunit=:bomunit,
            bomreqlength=:bomreqlength,
            bomreqbarqty=:bomreqbarqty,
            bomreqtotweight=:bomreqtotweight,
            bomremark=:bomremark,
            bomitemid=:bomitemid,
            mtype=:mtype,
            alloy=:alloy,
            finish=:finish,            
            length=:length,
            bomtype=:bomtype,
            bomsno=:bomsno,
            bomlastno=:bomlastno,
            rwid=:rwid,
            prepareby=:prepareby 
            where 
            bomid=$id";
        $this->cm = $this->cn->prepare($this->sql);
        $issave = $this->cm->execute($infos);
        unset($this->sql, $this->cm);
        return $issave;
    }

    public function Revision($id, $rupdate)
    {
        if ($this->_checkBomId($id) === 1) {
            $updateid = $this->_copydataforRevision($id);
            if ($updateid !== 0) {
                if ($this->updateRevision($updateid, $rupdate)) {
                    $this->response = array(
                        'msg' => "1",
                        'data' => "UPDATED"
                    );
                } else {
                    $this->response = array(
                        'msg' => "0",
                        'data' => "Update Error _ COPY DATA"
                    );
                }
            } else {
                $this->response = array(
                    'msg' => "0",
                    'data' => "Update Error _ UPDATE DATA"
                );
            }
        } else {
            $this->response = array(
                'msg' => "0",
                'data' => "This Id Not Available In database"
            );
        }
        return json_encode($this->response);
        exit();
    }
}

    
    // INSERT INTO `bomnew` (
    //     `bomdate` ,
    //     `bomproject` ,
    //     `bomcontract` ,
    //     `bomcolor` ,
    //     `bomno` ,
    //     `bomsystem` ,
    //     `bomprofileno` ,
    //     `bompartno` ,
    //     `bomdescription` ,
    //     `bomdieweight` ,
    //     `bomunit` ,
    //     `bomreqlength` ,
    //     `bomreqbarqty` ,
    //     `bomreqtotweight` ,
    //     `bomavailength` ,
    //     `bomavaibarqty` ,
    //     `bomavaiweight` ,
    //     `bomorderlength` ,
    //     `bomorderbarqty` ,
    //     `bomordertotweight` ,
    //     `bomremark` ,
    //     `flagprepare` ,
    //     `prepareupdate` ,
    //     `prepareby` ,
    //     `flagchecked` ,
    //     `checkedupdate` ,
    //     `checkedby` ,
    //     `flagapproved` ,
    //     `approvedupdate` ,
    //     `approvedby` ,
    //     `bomitemid` ,
    //     `mtype` ,
    //     `alloy` ,
    //     `finish` ,
    //     `length` ,
    //     `bomtype` ,
    //     `bomsno` ,
    //     `bomlastno`
    //     ) select `bomdate` ,
    //     `bomproject` ,
    //     `bomcontract` ,
    //     `bomcolor` ,
    //     `bomno` ,
    //     `bomsystem` ,
    //     `bomprofileno` ,
    //     `bompartno` ,
    //     `bomdescription` ,
    //     `bomdieweight` ,
    //     `bomunit` ,
    //     `bomreqlength` ,
    //     `bomreqbarqty` ,
    //     `bomreqtotweight` ,
    //     `bomavailength` ,
    //     `bomavaibarqty` ,
    //     `bomavaiweight` ,
    //     `bomorderlength` ,
    //     `bomorderbarqty` ,
    //     `bomordertotweight` ,
    //     `bomremark` ,
    //     `flagprepare` ,
    //     `prepareupdate` ,
    //     `prepareby` ,
    //     `flagchecked` ,
    //     `checkedupdate` ,
    //     `checkedby` ,
    //     `flagapproved` ,
    //     `approvedupdate` ,
    //     `approvedby` ,
    //     `bomitemid` ,
    //     `mtype` ,
    //     `alloy` ,
    //     `finish` ,
    //     `length` ,
    //     `bomtype` ,
    //     `bomsno` ,
    //     `bomlastno`
    //     from  bomnew where bomid=1
