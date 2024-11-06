<?php
require_once 'mac.php';
class GON extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response;

    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array("msg" => "0", "Empty Error");
    }

    private function pms_gon($rows)
    {
        extract($rows);
        $cols = [];
        $cols['gonewid'] = $gonewid;
        $cols['gondoneby'] = $gondoneby;
        $cols['gonrelesetopurcahse'] = $gonrelesetopurcahse;
        $cols['gonrelesetopurcahse_d'] = date_format(date_create($gonrelesetopurcahse), 'd-M-Y');
        $cols['gonrecivedfrompurchase'] = $gonrecivedfrompurchase;
        $cols['gonrecivedfrompurchase_d'] = date_format(date_create($gonrecivedfrompurchase), 'd-M-Y');
        $cols['gonstatus'] = $gonstatus;
        $cols['gonsupplier'] = $gonsupplier;
        $cols['gonglasstype'] = $gonglasstype;
        $cols['gonglassspc'] = $gonglassspc;
        $cols['gonmakringlocation'] = $gonmakringlocation;
        $cols['gonlocation'] = $gonlocation;
        $cols['gonqty'] = $gonqty;
        $cols['gonremark'] = $gonremark;
        $cols['gonorderno'] = $gonorderno;
        $cols['gonby'] = $gonby;
        $cols['goeby'] = $goeby;
        $cols['gocdate'] = $gocdate;
        $cols['goedate'] = $goedate;
        $cols['gontype'] = $gontype;
        $cols['gonproject'] = $gonproject;
        $cols['statustxt'] = $gonstatus === "1" ? "PENDING" : "ORDERED";
        return $cols;
    }

    private function _gorpt()
    {
        $this->sql = "SELECT *FROM pms_gon as go inner join pms_glass_suppliers as sup on go.gonsupplier = sup.glasssupplierid 
            inner join pms_project_summary as pj on go.gonproject = pj.project_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = $this->pms_gon($rows);
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_name'] = $this->enc('denc', $rows['project_name']);
            $rpt['project_no'] = $this->enc('denc', $rows['project_no']);
            $rpt['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc', $rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc', $rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc', $rows['project_type']);

            $rpt['glasssupplierid'] = $rows['glasssupplierid'];
            $rpt['glasssuppliername'] = $rows['glasssuppliername'];
            $rpt['glasssuppliercountry'] = $rows['glasssuppliercountry'];
            $rpt['suppliercontact'] = $rows['suppliercontact'];
            $rpt['supplieraddress'] = $rows['supplieraddress'];
            $rpt['supplieremail'] = $rows['supplieremail'];
            $rpt['supplierphone'] = $rows['supplierphone'];
            $rpt['supplierfax'] = $rows['supplierfax'];
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function gorpt()
    {
        $rpt = $this->_gorpt();
        $this->response = array(
            "msg" => "1",
            "data" => $rpt
        );
        return json_encode($this->response);
        exit;
    }

    private function _getprojectgo($gonproject)
    {
        $this->sql = "SELECT *FROM pms_gon as go inner join pms_glass_suppliers as sup on go.gonsupplier = sup.glasssupplierid 
            inner join pms_project_summary as pj on go.gonproject = pj.project_id 
            where go.gonproject = :gonproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonproject", $gonproject);
        $this->cm->execute();
        $rpts = array();
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = $this->pms_gon($rows);
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = $this->enc('denc', $rows['project_no']);
            $rpt['project_name'] = $this->enc('denc', $rows['project_name']);
            $rpt['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc', $rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc', $rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc', $rows['project_type']);

            $rpt['glasssupplierid'] = $rows['glasssupplierid'];
            $rpt['glasssuppliername'] = $rows['glasssuppliername'];
            $rpt['glasssuppliercountry'] = $rows['glasssuppliercountry'];
            $rpt['suppliercontact'] = $rows['suppliercontact'];
            $rpt['supplieraddress'] = $rows['supplieraddress'];
            $rpt['supplieremail'] = $rows['supplieremail'];
            $rpt['supplierphone'] = $rows['supplierphone'];
            $rpt['supplierfax'] = $rows['supplierfax'];
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function getprojectgo($gonproject)
    {
        $gos = $this->_getprojectgo($gonproject);
        $this->response = array(
            "msg" => "1",
            "data" => $gos
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkgo($gonewid)
    {
        $this->sql = "SELECT COUNT(gonewid) as cnt FROM pms_gon where gonewid = :gonewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonewid", $gonewid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $this->cm, $rows);
        return $cnt;
    }

    private function _getgoinfo($gonewid)
    {
        $this->sql = "SELECT *FROM pms_gon as go inner join pms_glass_suppliers as sup on go.gonsupplier = sup.glasssupplierid 
            inner join pms_project_summary as pj on go.gonproject = pj.project_id where go.gonewid = :gonewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonewid", $gonewid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $rpt = $this->pms_gon($rows);
        $rpt['project_id'] = $rows['project_id'];
        $rpt['project_no_enc'] = $rows['project_no'];
        $rpt['project_no'] = $this->enc('denc', $rows['project_no']);
        $rpt['project_name'] = $this->enc('denc', $rows['project_name']);
        $rpt['project_cname'] = $this->enc('denc', $rows['project_cname']);
        $rpt['project_location'] = $this->enc('denc', $rows['project_location']);
        $rpt['project_contact_person'] = $this->enc('denc', $rows['project_contact_person']);
        $rpt['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
        $rpt['projectRegion'] = $this->enc('denc', $rows['projectRegion']);
        $rpt['project_type'] = $this->enc('denc', $rows['project_type']);

        $rpt['glasssupplierid'] = $rows['glasssupplierid'];
        $rpt['glasssuppliername'] = $rows['glasssuppliername'];
        $rpt['glasssuppliercountry'] = $rows['glasssuppliercountry'];
        $rpt['suppliercontact'] = $rows['suppliercontact'];
        $rpt['supplieraddress'] = $rows['supplieraddress'];
        $rpt['supplieremail'] = $rows['supplieremail'];
        $rpt['supplierphone'] = $rows['supplierphone'];
        $rpt['supplierfax'] = $rows['supplierfax'];
        unset($this->sql, $this->cm, $rows);
        return $rpt;
    }

    public function getgoinfo($gonewid)
    {
        $cnt = $this->_checkgo($gonewid);
        if ($cnt !== 1) {
            $this->response = array(
                "msg" => "0",
                "data" => "Data has not found"
            );
            return json_encode($this->response);
            exit;
        }

        $rpt = $this->_getgoinfo($gonewid);
        $this->response = array(
            "msg" => "1",
            "data" => $rpt
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkgono($gonorderno)
    {
        $this->sql = "SELECT COUNT(gonorderno) as cnt from pms_gon where gonorderno = :gonorderno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonorderno", $gonorderno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    private function _savego($params)
    {
        $this->sql = "INSERT INTO pms_gon values(
                null,
                :gondoneby,
                :gonrelesetopurcahse,
                :gonrecivedfrompurchase,
                :gonstatus,
                :gonsupplier,
                :gonglasstype,
                :gonglassspc,
                :gonmakringlocation,
                :gonlocation,
                :gonqty,
                :gonremark,
                :gonorderno,
                :gonby,
                :goeby,
                :gocdate,
                :goedate,
                :gontype,
                :gonproject
            )"; //18
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function Savego($save)
    {
        // $gonorderno = $save[':gonorderno'];
        // $cnt = $this->_checkgono($gonorderno);
        // if ($cnt !== 0) {
        //     $this->response = array(
        //         "msg" => "0",
        //         "data" => "This Go Ref No Already Exists"
        //     );
        //     return json_encode($this->response);
        //     exit;
        // }

        $sv = $this->_savego($save);
        if (!$sv) {
            $this->response = array(
                "msg" => "1",
                "data" => "Error has found on Saving Data"
            );
            return json_encode($this->response);
            exit;
        }
        $gonproject = $save[':gonproject'];
        $gos = $this->_getprojectgo($gonproject);
        $this->response = array(
            "msg" => "1",
            "data" => $gos
        );
        return json_encode($this->response);
        exit;
    }

    private function _updategonstatus($update)
    {
        $this->sql = "UPDATE pms_gon set gonstatus = :gonstatus,
        gonrecivedfrompurchase = :gonrecivedfrompurchase  
        where 
        gonewid = :gonewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($update);
        unset($this->sql, $this->cm);
    }

    private function _updatego($params)
    {
        $this->sql = "UPDATE pms_gon set 
            gondoneby = :gondoneby,
            gonrelesetopurcahse = :gonrelesetopurcahse,
            gonrecivedfrompurchase = :gonrecivedfrompurchase,            
            gonsupplier = :gonsupplier,
            gonglasstype = :gonglasstype,
            gonglassspc = :gonglassspc,
            gonmakringlocation = :gonmakringlocation,
            gonlocation = :gonlocation,
            gonqty = :gonqty,
            gonremark = :gonremark,            
            gonby = :gonby,
            goeby = :goeby,
            gocdate = :gocdate,
            goedate = :goedate,
            gontype = :gontype,
            gonproject = :gonproject 
            where 
            gonewid = :gonewid
        ";
        $this->cm = $this->cn->prepare($this->sql);
        $update = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $update;
    }

    public function updatego($update)
    {
        $sv = $this->_updatego($update);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error Has found on Updateing Data"
            );
            return json_encode($this->response);
            exit;
        }

        $gonproject = $update[':gonproject'];
        $gos = $this->_getprojectgo($gonproject);
        $this->response = array(
            "msg" => "1",
            "data" => $gos
        );
        return json_encode($this->response);
        exit;
    }

    private function pms_gon_purchase($rows)
    {
        extract($rows);
        $cols = [];
        $cols["gonp_id"] = $gonp_id;
        $cols["gonp_type"] = $gonp_type;
        $cols["gonp_date"] = $gonp_date;
        $cols["gonp_date_d"] = date_format(date_create($gonp_date), 'd-M-Y');
        $cols["gonp_gorefno"] = $gonp_gorefno;
        $cols["gonp_supplier"] = $gonp_supplier;
        $cols["gonp_gthk"] = $gonp_gthk;
        $cols["gonp_gout"] = $gonp_gout;
        $cols["gonp_gin"] = $gonp_gin;
        $cols["gonp_gcotting"] = $gonp_gcotting;
        $cols["gonp_qty"] = $gonp_qty;
        $cols["gonp_area"] = $gonp_area;
        $cols["gonp_remarks"] = $gonp_remarks;
        $cols["gonp_location"] = $gonp_location;
        $cols["gonp_eta"] = $gonp_eta;
        $cols["gonp_eta_d"] = date_format(date_create($gonp_eta), 'd-M-Y');
        $cols["gonp_ppsqm"] = $gonp_ppsqm;
        $cols["gonp_pptotal"] = $gonp_pptotal;
        $cols["gonp_ppextra"] = $gonp_ppextra;
        $cols["gonp_pjcno"] = $gonp_pjcno;
        $cols["gonp_eby"] = $gonp_eby;
        $cols["gonp_cdate"] = $gonp_cdate;
        $cols["gonp_edate"] = $gonp_edate;
        $cols["gonp_status"] = $gonp_status;
        $cols["gonp_goid"] = $gonp_goid; //22
        $cols['finalprice'] = (float)$cols["gonp_pptotal"] + (float)$cols["gonp_ppextra"];
        return $cols;
    }

    private function _getallgop()
    {
        $this->sql = "SELECT *,
        gorc.rcqty as rcqty,
        gorc.rcsqm as rcsqm,
        gorc.rctotprice as rctotprice,
        gorc.rcfinalprice as rcfinalprice,
        gorc.rcextra as rcextra 
        FROM pms_gon_purchase as gop 
    inner join pms_project_summary as pj  
    on gop.gonp_pjcno = pj.project_id 
    inner join pms_glass_suppliers as gs 
    on gop.gonp_supplier = gs.glasssupplierid 
    left join 
    (
        select gonrc_gopnid,
        sum(gonrc_qty) as rcqty,
        sum(gonrc_sqm) as rcsqm,
        sum(gonrc_totalprice) as rctotprice,
        sum(gonrc_extra) as rcextra,
        sum(gonrc_finalprice) as rcfinalprice 
        from pms_gon_rc group by gonrc_gopnid
    ) as gorc on
    gop.gonp_id = gorc.gonrc_gopnid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = $this->pms_gon_purchase($rows);

            $rpt['rcqty'] = is_null($rows['rcqty'])? 0 : $rows['rcqty'];
            $rpt['rcsqm'] = is_null($rows['rcsqm']) ? 0 : $rows['rcsqm'];
            $rpt['rctotprice'] = is_null($rows['rctotprice']) ? 0 : $rows['rctotprice'];
            $rpt['rcextra'] = is_null($rows['rcextra']) ? 0 : $rows['rcextra'];
            $rpt['rcfinalprice'] = is_null($rows['rcfinalprice']) ? 0 : $rows['rcfinalprice'];

            $balanceqty = (double)$rpt['gonp_qty'] - (double)$rpt['rcqty'];
            $rpt['balanceqty'] = $balanceqty;

            $balancesqm = (double)$rpt['gonp_area'] - (double)$rpt['rcsqm'];
            $rpt['balancesqm'] = $balancesqm;


            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = $this->enc('denc', $rows['project_no']);
            $rpt['project_name'] = $this->enc('denc', $rows['project_name']);
            $rpt['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc', $rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc', $rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc', $rows['project_type']);

            $rpt['glasssupplierid'] = $rows['glasssupplierid'];
            $rpt['glasssuppliername'] = $rows['glasssuppliername'];
            $rpt['glasssuppliercountry'] = $rows['glasssuppliercountry'];
            $rpt['suppliercontact'] = $rows['suppliercontact'];
            $rpt['supplieraddress'] = $rows['supplieraddress'];
            $rpt['supplieremail'] = $rows['supplieremail'];
            $rpt['supplierphone'] = $rows['supplierphone'];
            $rpt['supplierfax'] = $rows['supplierfax'];
            $rpts[] = $rpt;
        }
        unset($this->sql, $this->cm, $rows);
        return $rpts;
    }

    public function getallgop()
    {
        $rpts = $this->_getallgop();
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );

        return json_encode($this->response);
        exit;
    }

    private function _getallgopproject($gonp_pjcno)
    {
        $this->sql = "SELECT *,
                gorc.rcqty as rcqty,
                gorc.rcsqm as rcsqm,
                gorc.rctotprice as rctotprice,
                gorc.rcfinalprice as rcfinalprice,
                gorc.rcextra as rcextra 
                FROM pms_gon_purchase as gop 
            inner join pms_project_summary as pj  
            on gop.gonp_pjcno = pj.project_id 
            inner join pms_glass_suppliers as gs 
            on gop.gonp_supplier = gs.glasssupplierid 
            left join 
            (
                select gonrc_gopnid,
                sum(gonrc_qty) as rcqty,
                sum(gonrc_sqm) as rcsqm,
                sum(gonrc_totalprice) as rctotprice,
                sum(gonrc_extra) as rcextra,
                sum(gonrc_finalprice) as rcfinalprice 
                from pms_gon_rc group by gonrc_gopnid
            ) as gorc on
            gop.gonp_id = gorc.gonrc_gopnid
             where gop.gonp_pjcno = :gonp_pjcno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonp_pjcno", $gonp_pjcno);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = $this->pms_gon_purchase($rows);

            $rpt['rcqty'] = is_null($rows['rcqty'])? 0 : $rows['rcqty'];
            $rpt['rcsqm'] = is_null($rows['rcsqm']) ? 0 : $rows['rcsqm'];
            $rpt['rctotprice'] = is_null($rows['rctotprice']) ? 0 : $rows['rctotprice'];
            $rpt['rcextra'] = is_null($rows['rcextra']) ? 0 : $rows['rcextra'];
            $rpt['rcfinalprice'] = is_null($rows['rcfinalprice']) ? 0 : $rows['rcfinalprice'];

            $balanceqty = (double)$rpt['gonp_qty'] - (double)$rpt['rcqty'];
            $rpt['balanceqty'] = $balanceqty;

            $balancesqm = (double)$rpt['gonp_area'] - (double)$rpt['rcsqm'];
            $rpt['balancesqm'] = $balancesqm;

            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = $this->enc('denc', $rows['project_no']);
            $rpt['project_name'] = $this->enc('denc', $rows['project_name']);
            $rpt['project_cname'] = $this->enc('denc', $rows['project_cname']);
            $rpt['project_location'] = $this->enc('denc', $rows['project_location']);
            $rpt['project_contact_person'] = $this->enc('denc', $rows['project_contact_person']);
            $rpt['Sales_Representative'] = $this->enc('denc', $rows['Sales_Representative']);
            $rpt['projectRegion'] = $this->enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = $this->enc('denc', $rows['project_type']);

            $rpt['glasssupplierid'] = $rows['glasssupplierid'];
            $rpt['glasssuppliername'] = $rows['glasssuppliername'];
            $rpt['glasssuppliercountry'] = $rows['glasssuppliercountry'];
            $rpt['suppliercontact'] = $rows['suppliercontact'];
            $rpt['supplieraddress'] = $rows['supplieraddress'];
            $rpt['supplieremail'] = $rows['supplieremail'];
            $rpt['supplierphone'] = $rows['supplierphone'];
            $rpt['supplierfax'] = $rows['supplierfax'];
            $rpts[] = $rpt;
        }
        unset($this->sql, $this->cm, $rows);
        return $rpts;
    }

    public function getallgopproject($gonp_pjcno)
    {
        $rpts = $this->_getallgopproject($gonp_pjcno);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkgoid($gonp_goid)
    {
        $this->sql = "SELECT COUNT(gonp_goid) as cnt from pms_gon_purchase where gonp_goid = :gonp_goid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonp_goid", $gonp_goid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    private function _savegop($params)
    {
        $this->sql = "INSERT INTO pms_gon_purchase values(
            null,
            :gonp_type,
            :gonp_date,
            :gonp_gorefno,
            :gonp_supplier,
            :gonp_gthk,
            :gonp_gout,
            :gonp_gin,
            :gonp_gcotting,
            :gonp_qty,
            :gonp_area,
            :gonp_remarks,
            :gonp_location,
            :gonp_eta,
            :gonp_ppsqm,
            :gonp_pptotal,
            :gonp_ppextra,
            :gonp_pjcno,
            :gonp_cby,
            :gonp_eby,
            :gonp_cdate,
            :gonp_edate,
            :gonp_status,
            :gonp_goid 
        )"; //22
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function savegop($save)
    {
        $gonp_goid = $save[':gonp_goid'];
        //check
        $cnt = $this->_checkgoid($gonp_goid);

        if ($cnt !== 0) {
            $this->response = array(
                "msg" => '0',
                "data" => "Already This Data Found"
            );
            return json_encode($this->response);
            exit;
        }

        $sv = $this->_savegop($save);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error Has Found On Saving Data"
            );
            return json_encode($this->response);
            exit;
        }

        //update go

        $params = array(
            ":gonstatus" => "2",
            ":gonrecivedfrompurchase" => $save[':gonp_date'],
            ":gonewid" => $save[':gonp_goid']
        );
        $this->_updategonstatus($params);
        $this->response = array(
            "msg" => "1",
            "data" => "Data Has Saved"
        );
        return json_encode($this->response);
        exit;
    }


    private function pms_gon_rc($rows)
    {
        extract($rows);
        $cols = [];
        $cols['gonrc_id'] = $gonrc_id;
        $cols['gonrc_date'] = $gonrc_date;
        $cols['gonrc_date_d'] = date_format(date_create($gonrc_date),'d-M-Y');
        $cols['gonrc_invoice'] = $gonrc_invoice;
        $cols['gonrc_qty'] = $gonrc_qty;
        $cols['gonrc_sqm'] = $gonrc_sqm;
        $cols['gonrc_ppsqm'] = $gonrc_ppsqm;
        $cols['gonrc_totalprice'] = $gonrc_totalprice;
        $cols['gonrc_extra'] = $gonrc_extra;
        $cols['gonrc_finalprice'] = $gonrc_finalprice;
        $cols['gonrc_remark'] = $gonrc_remark;
        $cols['gonrc_project'] = $gonrc_project;
        $cols['gonrc_gopnid'] = $gonrc_gopnid;
        $cols['gonrc_gonid'] = $gonrc_gonid;
        $cols['gonrc_cby'] = $gonrc_cby;
        $cols['gonrc_eby'] = $gonrc_eby;
        $cols['gonrc_cdate'] = $gonrc_cdate;
        $cols['gonrc_edate'] = $gonrc_edate;
        return $cols;
    }

    private function _getgopnrc($gonrc_gopnid)
    {
        $this->sql = "SELECT *FROM pms_gon_rc where gonrc_gopnid = :gonrc_gopnid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":gonrc_gopnid", $gonrc_gopnid);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = $this->pms_gon_rc($rows);
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function getgopnrc($gonrc_gopnid)
    {
        $rpts = $this->_getgopnrc($gonrc_gopnid);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _savegopnrc($params)
    {
        $this->sql = "INSERT INTO pms_gon_rc values(
            null,
            :gonrc_date,
            :gonrc_invoice,
            :gonrc_qty,
            :gonrc_sqm,
            :gonrc_ppsqm,
            :gonrc_totalprice,
            :gonrc_extra,
            :gonrc_finalprice,
            :gonrc_remark,
            :gonrc_project,
            :gonrc_gopnid,
            :gonrc_gonid,
            :gonrc_cby,
            :gonrc_eby,
            :gonrc_cdate,
            :gonrc_edate
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function Savegopnrc($save)
    {
        $sv = self::_savegopnrc($save);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Data Has Error on Saving Data"
            );
            return json_encode($this->response);
            exit;
        }
        $gonp_pjcno = $save[':gonrc_project'];
        $rpts = self::_getallgopproject($gonp_pjcno);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }
}
