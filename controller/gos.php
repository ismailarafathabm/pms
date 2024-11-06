<?php
include_once '../../controller/mac.php';
class GoController extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response = [];

    function __construct($db)
    {
        $this->cn = $db;
    }

    private function gtype($gotype)
    {
        $g = array(
            "1" => "Glass Order",
            "2" => "Sample"
        );
        return $g[$gotype];
    }

    private function statusTxt($gotype)
    {
        $g = array(
            "0" => "N/A",
            "1" => "Direct",
            "2" => "F",
            "3" => "R"
        );
        return $g[$gotype];
    }
    private function gotype($gotype)
    {
        $g = array(
            "1" => "GO",
            "2" => "RMO",
            "3" => "BMO"
        );
        return $g[$gotype];
    }
    private function pms_cuttinglistgo($rows)
    {
        extract($rows);
        $cols = [];
        $cols['goid'] = $goid;

        $cols['goprojectid'] = $goprojectid;
        $cols['goproject'] = $goproject;
        $cols['goprojectname'] = $goprojectname;
        $cols['goprojectlocation'] = $goprojectlocation;
        $cols['gonumber'] = $gonumber;
        $cols['gonodisp'] = "NAF/ENGG/$gonumber";
        $cols['gosupplier'] = $gosupplier;
        $cols['goglasstype'] = $goglasstype;
        $cols['goglassspec'] = $goglassspec;
        $cols['gomarking'] = $gomarking;
        $cols['goqty'] = $goqty;
        $cols['goarea'] = $goarea;
        $cols['godoneby'] = $godoneby;
        $cols['godate'] = $godate;
        $cols['godate_d'] = self::datemethod($godate);
        $cols['gopflag'] = (string)$gopflag;
        $cols['goflag_txt'] = self::statusTxt($gopflag);
        $cols['goprelease'] = $goprelease;
        $cols['goprelease_d'] = self::datemethod($goprelease);
        $cols['gopreturn'] = $gopreturn;
        $cols['gopreturn_d'] = self::datemethod($gopreturn);
        $cols['remarks'] = $remarks;
        $cols['gocostingflag'] = (string)$gocostingflag;
        $cols['gocostingflag_txt'] = self::statusTxt($gocostingflag);
        $cols['gocostingrelease'] = $gocostingrelease;
        $cols['gocostingrelease_d'] = self::datemethod($gocostingrelease);
        $cols['gocosingreturn'] = $gocosingreturn;
        $cols['gocosingreturn_d'] = self::datemethod($gocosingreturn);
        $cols['cby'] = $cby;
        $cols['eby'] = $eby;
        $cols['cdate'] = $cdate;
        $cols['edate'] = $edate;
        $cols['othersdesc'] = $othersdesc;
        $cols['gotype'] = (string)$gotype;
        $cols['gotype_txt'] = self::gtype((string)$gotype);
        $cols['gootype'] = (string)$gootype;
        $cols['gootype_txt'] = self::gotype($gootype);
        $coss['goidstatus'] = false;
        $cols['rgono'] = $rgono;

        $cols['godepartment'] = "";
        $cols['godeparmentdate'] = "";
        $cols['godeparmentdate_d'] = "";
        if ((+$gocostingflag) >= 2) {
            $cols['godepartment'] = "Costing";
            $cols['godeparmentdate'] = $gocostingrelease;
            $cols['godeparmentdate_d'] = self::datemethod($gocostingrelease);
        }

        if ((+$gopflag) >= 2) {
            $cols['godepartment'] = "Procurement";
            $cols['godeparmentdate'] = $goprelease;
            $cols['godeparmentdate_d'] = self::datemethod($goprelease);
        }

        //file status 

        $fstatus = "0";
        if (file_exists("./../../assets/cuttinglists/go/" . $goid . ".pdf")) {
            $fstatus = "1";
        }
        $cols["filestatus"] = $fstatus;
        $cols['gofilestatus'] = $fstatus === '1' ? 'Yes' : 'No';

        $cols['procurement_status'] = $procurement_status;
        $cols['procurement_orderdate'] = $procurement_orderdate;
        $cols['procurement_orderdate_d'] = self::datemethod($procurement_orderdate);
        $cols['procurment_orderunitprice'] = $procurment_orderunitprice;
        $cols['procurement_calby'] = $procurement_calby;
        $cols['procurement_otherprice'] = $procurement_otherprice;
        $cols['procurement_totalprice'] = $procurement_totalprice;
        $cols['procurement_supplier'] = $procurement_supplier;

        $cols['procurement_coating'] = $procurement_coating;
        $cols['procurement_thickness'] = $procurement_thickness;
        $cols['procurement_out'] = $procurement_out;
        $cols['procurement_inner'] = $procurement_inner;
        $cols['procurement_qty'] = $rows['procurement_qty'];
        $cols['procurement_area'] = $rows['procurement_area'];
        $cols['procurement_totalprice'] = ((double)$rows['procurement_area'] * (double)$cols['procurment_orderunitprice']) + (double)$cols['procurement_otherprice']; 
        $pfstatus = "0";
        if (file_exists("./../../assets/cuttinglists/gosp/" . $goid . ".pdf")) {
            $pfstatus = "1";
        }
        $cols["pfstatus"] = $pfstatus;

        $cols["goreceipttype"] = $goreceipttype;
        $cols["broken_by"] = $broken_by;
        $cols["broken_naf_by"] = $broken_naf_by;
        $cols["broken_go_oldno"] = $broken_go_oldno;
        $cols["broken_go_enggineer"] = $broken_go_enggineer;
        $cols["broken_description"] = $broken_description;
        $cols["broken_engg"] = $broken_engg;
        $cols["proucrementeta"] = $proucrementeta;
        $cols["invoiceno"] = $invoiceno;

        $cols["uinsert"] = $uinsert;
        $cols["procurementremark"] = $procurementremark;
        $cols["dellocation"] = $dellocation;
        $cols["workorderno"] = $workorderno;
        $cols["goorderno"] = $goorderno;

        return $cols;
    }

    private function _checkprojectgos($pjno)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_cuttinglistgo where goproject = :goproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goproject", $pjno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    private function _getlastgoforproject($pjno)
    {
        $this->sql = "SELECT *FROM pms_cuttinglistgo where goproject = :goproject ORDER BY goid DESC limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goproject", $pjno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $rpt = self::pms_cuttinglistgo($rows);
        unset($this->sql, $this->cm, $rows);
        return $rpt;
    }

    public function getlastgoformproject($pjno)
    {
        $cnt = self::_checkprojectgos($pjno);
        if ($cnt === 0) {
            header("HTTP/1.0 200 no found");
            $this->response = array("msg" => "0", "data" => "Does not have any datas");
            return json_encode($this->response);
            exit;
        }
        $rpt = self::_getlastgoforproject($pjno);
        $this->response = array("msg" => "1", "data" => $rpt);
        return json_encode($this->response);
        exit;
    }

    private function _getRecords($sql)
    {
        $this->sql = $sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_cuttinglistgo($rows);
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function GetReports($sql)
    {
        $rpts = self::_getRecords($sql);
        header("HTTP/1.0 200 ok");
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }


    private function _getRecordsprcourement($sql)
    {
        $this->sql = $sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_cuttinglistgo($rows);
            $receipt_qty = is_null($rows['receiptqty']) ? 0 : (float)$rows['receiptqty'];
            $receipt_area = is_null($rows['receiptarea']) ? 0 : (float)$rows['receiptarea'];
            $receipt_amount = is_null($rows['receipttotprice']) ? 0 : (float)$rows['receipttotprice'];
            $go_qty =  (float)$rows['procurement_qty'];
            $go_area = (float)$rows['procurement_area'];
            $go_totalamount = (float)$rpt['procurement_totalprice'];
            $rpt['procurement_qty'] = $rows['procurement_qty'];
            $rpt['procurement_area'] = $rows['procurement_area'];
            //for balance 
            $go_balance_qty =   $go_qty - $receipt_qty;
            $go_balance_area =  $go_area -  $receipt_area;
            $go_balance_amount = $go_totalamount - $receipt_amount;

            //rept 
            $rpt['receipt_qty'] = $receipt_qty;
            $rpt['receipt_area'] = $receipt_area;
            $rpt['receipt_amount'] = $receipt_amount;

            $rpt['go_balance_qty'] = $go_balance_qty;
            $rpt['go_balance_area'] = $go_balance_area;
            $rpt['go_balance_amount'] = $go_balance_amount;

            $rpt['broken_by'] = $rows['broken_by'] === 'Supplier' ? 'Customer' : $rows['broken_by'];




            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function GetReportsprcourement($sql)
    {
        $rpts = self::_getRecordsprcourement($sql);
        header("HTTP/1.0 200 ok");
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    public function getRowCount($sql)
    {
        $this->cm = $this->cn->prepare($sql);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    private function _checkgoid($id)
    {
        $this->sql = "SELECT COUNT(goid) as cnt FROM pms_cuttinglistgo where goid = :goid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $this->cm, $rows);
        return $cnt;
    }

    private function _getGo($id)
    {
        $this->sql = "SELECT *FROM pms_cuttinglistgo as go left join (select goreceiptgono,sum(goreceiptqty) as receiptqty,sum(goreceiptarea) as receiptarea,sum(goreceipttotalprice) as receipttotprice from `pms_cuttinglistgoprocurement_receipt` group by goreceiptgono) as gor on go.goid=gor.goreceiptgono where goid = :goid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);

        $rpt = self::pms_cuttinglistgo($rows);
        $receipt_qty = is_null($rows['receiptqty']) ? 0 : (float)$rows['receiptqty'];
        $receipt_area = is_null($rows['receiptarea']) ? 0 : (float)$rows['receiptarea'];
        $receipt_amount = is_null($rows['receipttotprice']) ? 0 : (float)$rows['receipttotprice'];
        $go_qty =  (float)$rows['procurement_qty'];
        $go_area = (float)$rows['procurement_area'];
        $go_totalamount = (float)$rows['procurement_totalprice'];
        $rpt['procurement_qty'] = $rows['procurement_qty'];
        $rpt['procurement_area'] = $rows['procurement_area'];
        //for balance 
        $go_balance_qty =   $go_qty - $receipt_qty;
        $go_balance_area =  $go_area -  $receipt_area;
        $go_balance_amount = $go_totalamount - $receipt_amount;

        //rept 
        $rpt['receipt_qty'] = $receipt_qty;
        $rpt['receipt_area'] = $receipt_area;
        $rpt['receipt_amount'] = $receipt_amount;

        $rpt['go_balance_qty'] = $go_balance_qty;
        $rpt['go_balance_area'] = $go_balance_area;
        $rpt['go_balance_amount'] = $go_balance_amount;
        unset($this->cm, $this->sql, $rows);
        return $rpt;
    }

    public function GetGO($id)
    {
        $cnt = self::_checkgoid($id);
        if ($cnt === 0) {
            header("HTTP/1.0 409 error No Data found");
            $this->response = array(
                "msg" => '0',
                "data" => "No Data Found"
            );
            return json_encode($this->response);
            exit;
        }

        $infos = self::_getGo($id);
        header("HTTP/1.0 200 ok");
        $this->response = array(
            "msg" => '1',
            "data" => $infos
        );
        return json_encode($this->response);
        exit;
    }

    private function _savego($go)
    {
        $gonox = $go[':gonumber'];
        $gono =  explode("-", $gonox);
        $gopno = $gono[1];
        $this->sql = "INSERT INTO pms_cuttinglistgo values(
                null,
                :goprojectid,
                :goproject,
                :goprojectname,
                :goprojectlocation,
                :gonumber,
                :gosupplier,
                :goglasstype,
                :goglassspec,
                :gomarking,
                :goqty,
                :goarea,
                :godoneby,
                :godate,
                :gopflag,
                :goprelease,
                :gopreturn,
                :remarks,
                :gocostingflag,
                :gocostingrelease,
                :gocosingreturn,
                :cby,
                :eby,
                :cdate,
                :edate,
                :othersdesc,
                :gotype,
                :gootype,
                :rgono,
                '0',
                '" . date('Y-m-d') . "',
                '0',
                '',
                '0',
                '0',
                '',
                '',
                '',
                '',
                '',
                :goqty,
                :goarea,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '" . date('Y-m-d') . "',
                '',
                '','','','','$gopno'               
                
            )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($go);
        unset($this->sql, $this->cm);
        return $sv;
    }


    public function SaveGo($go)
    {
        $sv = self::_savego($go);
        if (!$sv) {
            header("HTTP/1.0 500 error error on Insert Data");
            $this->response = array("msg" => "0", "data" => "Error On Saveing Data");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "data has Saved");
        return json_encode($this->response);
        exit;
    }


    public function SaveGos($gos)
    {
        foreach ($gos as  $go) {
            $this->sql = "INSERT INTO pms_cuttinglistgo values(
                null,
                :goprojectid,
                :goproject,
                :goprojectname,
                :goprojectlocation,
                :gonumber,
                :gosupplier,
                :goglasstype,
                :goglassspec,
                :gomarking,
                :goqty,
                :goarea,
                :godoneby,
                :godate,
                :gopflag,
                :goprelease,
                :gopreturn,
                :remarks,
                :gocostingflag,
                :gocostingrelease,
                :gocosingreturn,
                :cby,
                :eby,
                :cdate,
                :edate,
                :othersdesc,
                :gotype,
                :gootype,
                :rgono         
            )";

            $this->cm = $this->cn->prepare($this->sql);
            $sv = $this->cm->execute($go);
            unset($this->sql, $this->cm);
            if (!$sv) {
                header("HTTP/1.0 500 error error on Insert Data");
                $this->response = array("msg" => "0", "data" => "Error On Saveing Data");
                return json_encode($this->response);
                exit;
            }
        }



        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "data has Saved");
        return json_encode($this->response);
        exit;
    }

    public function _updaetGo($go)
    {
        $this->sql = "UPDATE pms_cuttinglistgo set 
        gonumber = :gonumber,
        gosupplier = :gosupplier,
        goglasstype = :goglasstype,
        goglassspec = :goglassspec,
        gomarking = :gomarking,
        goqty = :goqty,
        goarea = :goarea,
        godoneby = :godoneby,
        godate = :godate,
        gopflag = :gopflag,
        goprelease = :goprelease,
        gopreturn = :gopreturn,
        remarks = :remarks,
        gocostingflag = :gocostingflag,
        gocostingrelease = :gocostingrelease,
        gocosingreturn = :gocosingreturn,
        eby = :eby,
        edate = :edate,
        othersdesc = :othersdesc,
        gotype = :gotype,
        gootype = :gootype,
        rgono = :rgono  where 
        goid = :goid";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($go);
        unset($this->cm, $this->sql, $rows);
        return $sv;
    }

    public function Updatego($go)
    {
        //$permission = self::_checkgoProcurementstatus($go[':goid']);
        // if ($permission === 1) {
        //     header("HTTP/1.0 409 Permission Error");
        //     $this->response = array("msg" => "0", "data" => "You Can not update This GO, This GO Already Posted To Prcourement");
        //     return json_encode($this->response);
        //     exit;
        // }
        $is_update = self::_updaetGo($go);
        if (!$is_update) {
            header("HTTP/1.0 500 error Updateing Error");
            $this->response = array("msg" => "0", "data" => "Error On Update GO#");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "Data Has Updated");
        return json_encode($this->response);
        exit;
    }



    private function _checkgoProcurementstatus($goid)
    {
        $this->sql = "SELECT count(gopgoid) as cnt FROM pms_cuttinglistgoprocurement where gopgoid=:gopgoid and procurementflg=1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gopgoid", $goid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $rows, $this->cm);
        return $cnt;
    }

    private function _removeGo($goid)
    {
        $this->sql = "DELETE FROM pms_cuttinglistgo where goid = :goid limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goid", $goid);
        $del = $this->cm->execute();
        unset($this->sql, $rows, $this->cm);
        return $del;
    }

    private function _removegofrmprc($goid)
    {
        $this->sql = "DELETE FROM pms_cuttinglistgoprocurement where gopgoid = :gopgoid";
        $this->cm  = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gopgoid", $goid);
        $del = $this->cm->execute();
        unset($this->cm, $this->sql, $rows);
        return $del;
    }

    public function Removeitem($goid)
    {

        $del = self::_removeGo($goid);
        if (!$del) {
            header("HTTP/1.0 500 error");
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Remove Data"
            );
            echo json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");

        $this->response = array(
            "msg" => "1",
            "data" => "Data has Removed"
        );
        echo json_encode($this->response);
        exit;
    }


    public function Removeitems($goids)
    {
        foreach ($goids as $goid) {
            $this->sql = "DELETE FROM pms_cuttinglistgo where goid = :goid limit 1";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":goid", $goid);
            $del = $this->cm->execute();
            unset($this->sql, $rows, $this->cm);
            if (!$del) {
                header("HTTP/1.0 500 error");
                $this->response = array(
                    "msg" => "0",
                    "data" => "Error on Remove Data"
                );
                echo json_encode($this->response);
                exit;
            }
        }
        header("HTTP/1.0 200 ok");

        $this->response = array(
            "msg" => "1",
            "data" => "Data has Removed"
        );
        echo json_encode($this->response);
        exit;
    }

    private function _updategosProcurement($updates)
    {
        $this->sql = "UPDATE pms_cuttinglistgoprocurement 
        set 
        gotikness = :gotikness,
        goout = :goout,
        goinner = :goinner,
        gouinsert = :gouinsert,
        goremarks = :goremarks,
        gocoatings = :gocoatings,
        golocation = :golocation,
        goeta = :goeta,
        goperiority = :goperiority,
        gosqm = :gosqm,
        goeby = :goeby,
        goedate = :goedate,
        procurement_qty = :procurement_qty,
        procurement_area = :procurement_area,
        goreceipttype = :goreceipttype,
        broken_by = :broken_by,
        broken_naf_by = :broken_naf_by,
        broken_go_oldno = :broken_go_oldno,
        broken_go_enggineer = :broken_go_enggineer,
        broken_description = :broken_description,
        broken_engg = :broken_engg, 
        proucrementeta = :proucrementeta,
        invoiceno = :invoiceno 
        where gopid = :gopid";
        $this->cm = $this->cn->prepare($this->sql);
        $up = $this->cm->exeucte($updates);
        unset($this->sql, $this->cm);
        return $up;
    }

    public function UpdateGosProcurement($update)
    {
        $ok = self::_updategosProcurement($update);
        if (!$ok) {
            header("HTTP/1.0 500 error");
            $this->response = array(
                "msg" => "0",
                "data" => "Error on update data"
            );
            return json_encode($this->response);
            exit;
        }

        header("HTTP/1.0 200 ok");
        $this->response = array(
            "msg" => "1", "data" => "data has updated"
        );
        return json_encode($this->response);
        exit;
    }




    //procurement receipt

    private function _saveNewProcrementRecipe($save)
    {
        $this->sql = "INSERT INTO pms_cuttinglistgoprocurement_receipt values(
            null,
            :goreceiptgono,
            :goreceiptgoprno,
            :goreceiptdate,
            :goreceiptinvoiceno,
            :goreceiptsupplier,
            :goreceiptqty,
            :goreceiptarea,
            :goreceiptcby,
            :goreceipteby,
            :goreceiptcdate,
            :goreceiptedate,
            :goreceipt_flag,
            :goreceipt_project,
            :goreceipt_projectname,
            :goreceipt_projectlocation,
            :goreceiptunitprice,
            :goreceiptcalby,
            :goreceiptotherprice,
            :goreceipttotalprice
        )";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function SaveNewProcurementReceiptGO($save)
    {
        $sv = self::_saveNewProcrementRecipe($save);
        if (!$sv) {
            header("HTTP/1.0 500 error");
            $this->response = array("msg" => "0", "data" => "Error on saveing data");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "Data Has Saved");
        echo json_encode($this->response);
        exit;
    }
    private function pms_cuttinglistgoprocurement_receipt($rows)
    {
        $cols = [];
        extract($rows);
        $cols['goreceiptid'] = $goreceiptid;
        $cols['goreceiptgono'] = $goreceiptgono;
        $cols['goreceiptgoprno'] = $goreceiptgoprno;
        $cols['goreceiptdate'] = $goreceiptdate;
        $cols['goreceiptdate_d'] = self::datemethod($goreceiptdate);
        $cols['goreceiptinvoiceno'] = $goreceiptinvoiceno;
        $cols['goreceiptsupplier'] = $goreceiptsupplier;
        $cols['goreceiptqty'] = $goreceiptqty;
        $cols['goreceiptarea'] = $goreceiptarea;
        $cols['goreceiptcby'] = $goreceiptcby;
        $cols['goreceipteby'] = $goreceipteby;
        $cols['goreceiptcdate'] = $goreceiptcdate;
        $cols['goreceiptedate'] = $goreceiptedate;
        $cols['goreceipt_flag'] = $goreceipt_flag;
        $cols['goreceipt_project'] = $goreceipt_project;
        $cols['goreceipt_projectname'] = $goreceipt_projectname;
        $cols['goreceipt_projectlocation'] = $goreceipt_projectlocation;
        $cols['goreceiptunitprice'] = $goreceiptunitprice;
        $cols['goreceiptcalby'] = $goreceiptcalby;
        $cols['goreceiptotherprice'] = $goreceiptotherprice;
        $cols['goreceipttotalprice'] = $goreceipttotalprice;
        $cols['procurement_qty'] = $procurement_qty;
        $cols['procurement_area'] = $procurement_area;
        $cols['goreceipttype'] = $goreceipttype;


        return $cols;
    }

    private function _go_receipt_history($goid)
    {
        $this->sql = "SELECT *FROM pms_cuttinglistgoprocurement_receipt as gor inner join pms_cuttinglistgo as go on gor.goreceiptgono=go.goid where goreceiptgono = :goreceiptgono";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':goreceiptgono', $goid);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_cuttinglistgoprocurement_receipt($rows);
            extract($rows);
            $rpt['gonumber'] = $gonumber;
            $rpt['gonodisp'] = "NAF/ENGG/$gonumber";
            $rpt['goglasstype'] = $goglasstype;
            $rpt['goglassspec'] = $goglassspec;
            $rpt['gomarking'] = $gomarking;
            $rpt['godoneby'] = $godoneby;
            $rpt['procurement_orderdate'] = $procurement_orderdate;
            $rpt['procurement_orderdate_d'] = self::datemethod($procurement_orderdate);
            $rpt['procurment_orderunitprice'] = $procurment_orderunitprice;
            $rpt['procurement_calby'] = $procurement_calby;
            $rpt['procurement_otherprice'] = $procurement_otherprice;
            $rpt['procurement_totalprice'] = $procurement_totalprice;
            $rpt['procurement_supplier'] = $procurement_supplier;
            $rpt['procurement_coating'] = $procurement_coating;
            $rpt['procurement_thickness'] = $procurement_thickness;
            $rpt['procurement_out'] = $procurement_out;
            $rpt['procurement_inner'] = $procurement_inner;
            $rpt['procurement_qty'] = $procurement_qty;
            $rpt['procurement_area'] = $procurement_area;

            $fstatus = "0";
            if (file_exists("./../../assets/cuttinglists/go/" . $goid . ".pdf")) {
                $fstatus = "1";
            }
            $rcfile = "0";
            if (file_exists("./../../assets/cuttinglists/gor/" . $rows['goreceiptid'] . ".pdf")) {
                $rcfile = "1";
            }
            $rpt["filestatus"] = $fstatus;
            $rpt["rcfile"] = $rcfile;
            $rpts[] = $rpt;
        }
        unset($this->sql, $rows, $this->cm);
        return $rpts;
    }

    public function go_receipt_history($goid)
    {
        $rpts = self::_go_receipt_history($goid);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => $rpts);
        return json_encode($this->response);
        exit;
    }

    private function _checkreceipt($goreceiptid)
    {
        $this->sql = "SELECT COUNT(goreceiptid) as cnt FROM pms_cuttinglistgoprocurement_receipt where goreceiptid = :goreceiptid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goreceiptid", $goreceiptid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows["cnt"];
        unset($this->sql, $rows, $this->cm);
        return $cnt;
    }

    private function _get_goreceiptno($goreceiptid)
    {
        $this->sql = "SELECT * FROM pms_cuttinglistgoprocurement_receipt where goreceiptid = :goreceiptid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goreceiptid", $goreceiptid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $rpt = self::pms_cuttinglistgoprocurement_receipt($rows);
        unset($this->sql, $rows, $this->cm);
        return $rpt;
    }

    public function GetGoReceipt($goreceiptid)
    {
        $cnt = self::_checkreceipt($goreceiptid);
        if ($cnt !== 1) {
            header("HTTP/1.0 409 error No result Found");
            $this->response = array("msg" => "0", "data" => "No result Found");
            return json_encode($this->response);
            exit;
        }
        $rpt = self::_get_goreceiptno($goreceiptid);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => $rpt);
        return json_encode($this->response);
        exit;
    }

    //check receiptModifiyactions

    private function _checkModifyAction($goreceiptid)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_cuttinglistgoprocurement_receipt 
        where goreceiptid = :goreceiptid and goreceipt_flag = 'N'";
        $this->cm = $this->cn->prpeare($this->sql);
        $this->cm->bindParam(":goreceiptid", $goreceiptid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $rows, $this->cm);
        return $cnt;
    }

    public function _udpategoreceipt($update)
    {
        $this->sql = "UPDATE pms_cuttinglistgoprocurement_receipt set 
        goreceiptdate = :goreceiptdate,
        goreceiptinvoiceno = :goreceiptinvoiceno,
        goreceiptsupplier = :goreceiptsupplier,
        goreceiptqty = :goreceiptqty,
        goreceiptarea = :goreceiptarea,
        goreceipteby = :goreceipteby,
        goreceiptedate = :goreceiptedate 
        where 
        goreceiptid = :goreceiptid";
        $this->cm = $this->cn->prepare($this->sql);
        $up = $this->cm->execute($update);
        unset($this->cm, $this->sql);
        return $up;
    }

    public function UpdateGoReceiptInfo($update)
    {
        $cnt = self::_checkModifyAction($update[':goreceiptid']);
        if ($cnt !== 1) {
            header("HTTP/1.0 409 error No Result Found");
            $this->response = array("msg" => "0", "data" => "This Receipt Already Posted. You Could not Update.");
            return json_encode($this->response);
            exit;
        }

        $up = self::_udpategoreceipt($update);

        if (!$up) {
            header("HTTP/1.0 500 Error Server Error");
            $this->response = array("msg" => "0", "data" => "Error On Updating Data");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "Data has updated");
        return json_encode($this->response);
        exit;
    }

    private function _deleteGoReceipt($goreceiptid)
    {
        $this->sql = "DELETE FROM pms_cuttinglistgoprocurement_receipt where goreceiptid = :goreceiptid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goreceiptid", $goreceiptid);
        $del = $this->cm->execute();
        unset($this->cm, $this->sql);
        return $del;
    }

    public function DeleteGoReceipt($goreceiptid)
    {
        $cnt = self::_checkModifyAction($goreceiptid);
        if ($cnt !== 1) {
            header("HTTP/1.0 409 error No Result Found");
            $this->response = array("msg" => "0", "data" => "This Receipt Already Posted. You Could not Delete.");
            return json_encode($this->response);
            exit;
        }

        $del = self::deleteGoReceipt($goreceiptid);
        if (!$del) {
            header("HTTP/1.0 500 Error Server Error");
            $this->response = array("msg" => "0", "data" => "Error On Removeing Data");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "Data has Removed");
        return json_encode($this->response);
        exit;
    }

    private function _procurementupdate($params)
    {
        $this->sql = "UPDATE pms_cuttinglistgo set 
        procurement_orderdate = :procurement_orderdate,
        procurement_supplier = :procurement_supplier,
        procurement_coating = :procurement_coating,
        procurement_thickness = :procurement_thickness,
        procurement_out = :procurement_out,
        procurement_inner = :procurement_inner,
        procurment_orderunitprice = :procurment_orderunitprice,
        procurement_otherprice = :procurement_otherprice,
        procurement_totalprice = :procurement_totalprice,
        procurement_calby = :procurement_calby,
        procurement_qty = :procurement_qty,
        procurement_area = :procurement_area,
        goreceipttype = :goreceipttype,
        broken_by = :broken_by,
        broken_naf_by = :broken_naf_by,
        broken_go_oldno = :broken_go_oldno,
        broken_go_enggineer = :broken_go_enggineer,
        broken_description = :broken_description,
        broken_engg = :broken_engg,
        proucrementeta = :proucrementeta,
        invoiceno = :invoiceno,
        uinsert = :uinsert,
        procurementremark = :procurementremark,
        dellocation = :dellocation,
        workorderno = :workorderno,
        procurement_status = 1
        where 
        goid = :goid";

        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function ProcurementUpdate($params)
    {
        $sv = self::_procurementupdate($params);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Update"
            );
            return json_encode($this->response);
            exit;
        }
        $this->response = array(
            "msg" => "1",
            "data" => "Data has updated"
        );
        return json_encode($this->response);
        exit;
    }

    private function _gogroups($fileds)
    {
        $this->sql = "SELECT " . $fileds . " from pms_cuttinglistgo group by " . $fileds . "";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $grp = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            if ($rows[$fileds] !== "") {
                $grp[] = $rows[$fileds];
            }
        }
        unset($this->cm, $this->sql, $rows);
        return $grp;
    }
    public function GoAutoCompleates()
    {
        $suppliers = self::_gogroups("procurement_supplier");
        $coatings = self::_gogroups("procurement_coating");
        $thikness = self::_gogroups("procurement_thickness");
        $outters = self::_gogroups("procurement_out");
        $inners = self::_gogroups("procurement_inner");
        $lcoations = self::_gogroups("dellocation");
        $uinserts = self::_gogroups("uinsert");

        $gosuppleirs = self::_gogroups("gosupplier");
        $goglasstype = self::_gogroups("goglasstype");
        $goglassspec = self::_gogroups("goglassspec");
        $gomarking = self::_gogroups("gomarking");
        $remarks = self::_gogroups("remarks");
        $godoneby = self::_gogroups('godoneby');

        $autocm = array(
            "suppliers" => $suppliers,
            "coatings" => $coatings,
            "thikness" => $thikness,
            "outters" => $outters,
            "inners" => $inners,
            "lcoations" => $lcoations,
            "uinserts" => $uinserts,

            "gosuppleirs" => $gosuppleirs,
            "goglasstype" => $goglasstype,
            "goglassspec" => $goglassspec,
            "gomarking" => $gomarking,
            "remarks" => $remarks,
            "godoneby" => $godoneby,

        );
        $this->response = array("msg" => "1", "data" => $autocm);
        header("http/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    public function getcountreceipts($sql)
    {
        $this->cm = $this->cn->prepare($sql);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = $rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    public function getReceiptRpt($sql)
    {
        $this->cm = $this->cn->prepare($sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            //check file 
            $pfstatus = "0";
            if (file_exists("./../../assets/cuttinglists/gor/" . $goreceiptid . ".pdf")) {
                $pfstatus = "1";
            }
            $rpt = array(
                "goreceiptid" => $goreceiptid,
                "goreceiptgono" => $goreceiptgono,
                "goreceiptgoprno" => $goreceiptgoprno,
                "goreceiptdate" => $goreceiptdate,
                "goreceiptdate_s" => self::datemethod($goreceiptdate),
                "goreceiptinvoiceno" => $goreceiptinvoiceno,
                "goreceiptsupplier" => $goreceiptsupplier,
                "goreceiptqty" => $goreceiptqty,
                "goreceiptarea" => $goreceiptarea,
                "goreceiptcby" => $goreceiptcby,
                "goreceipteby" => $goreceipteby,
                "goreceiptcdate" => $goreceiptcdate,
                "goreceiptedate" => $goreceiptedate,
                "goreceipt_flag" => $goreceipt_flag,
                "goreceipt_project" => $goreceipt_project,
                "goreceipt_projectname" => $goreceipt_projectname,
                "goreceipt_projectlocation" => $goreceipt_projectlocation,
                "goreceiptunitprice" => $goreceiptunitprice,
                "goreceiptcalby" => $goreceiptcalby,
                "goreceiptotherprice" => $goreceiptotherprice,
                "goreceipttotalprice" => $goreceipttotalprice,

                "gonumber" => $gonumber,
                "gonumber" => $gonumber,
                "goglasstype" => $goglasstype,
                "goglassspec" => $goglassspec,
                "gomarking" => $gomarking,
                "goqty" => $goqty,
                "goarea" => $goarea,
                "godoneby" => $godoneby,
                "invoiceno" => $invoiceno,
                "uinsert" => $uinsert,
                "goreceipttype" => $goreceipttype,
                "gonumber" => $gonumber,
                "procurement_coating" => $procurement_coating,
                "procurement_thickness" => $procurement_thickness,
                "procurement_out" => $procurement_out,
                "procurement_inner" => $procurement_inner,
                "procurement_qty" => $procurement_qty,
                "procurement_area" => $procurement_area,
                "goreceipttype" => $goreceipttype,
                "procurementremark" => $procurementremark,
                "pfstatus" => $pfstatus,
                "pfstatusx" => $pfstatus === "1" ? 'YES' : 'NO',
            );
            $rpts[] = $rpt;
        }
        unset($this->sql, $this->cm, $rows);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _removeReceipt($goreceiptid):bool{
        $this->sql = "DELETE FROM pms_cuttinglistgoprocurement_receipt where goreceiptid = :goreceiptid limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":goreceiptid",$goreceiptid);
        $del = $this->cm->execute();
        unset($this->cm, $this->sql, $rows);
        return $del;
    }

    public function Removereceipt($goreceiptid):string{
        $del = (bool)self::_removeReceipt($goreceiptid);
        if(!$del){
            $this->response = array("msg" => "0" , "data" => "Error on Remove Receipt");
            header('http/1.0 500 error');
            return json_encode($this->response);
            exit();
        }
        header("http/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => "Removed");
        return json_encode($this->response);
        exit();        
    }
}
