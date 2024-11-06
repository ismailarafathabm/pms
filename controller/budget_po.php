<?php
require_once 'budget_meterials.php';
class BudgetPO extends BudgetMaterials
{
    private function pms_po($rows)
    {
        extract($rows);
        $cols = [];
        $cols['poid'] = !isset($poid) || trim($poid) === "" ? "0" : $poid;
        $cols['podate'] = !isset($podate) || trim($podate) === "" ? date('Y-m-d') : $podate;
        $cols['podate_d'] = !isset($podate) || trim($podate) === '' ? date('d-M-Y') : $this->_date($podate, 'd-M-Y');
        $cols['podate_n'] = !isset($podate) || trim($podate) === '' ? date('d-m-Y') : $this->_date($podate, 'd-m-Y');
        $cols['podate_p'] = !isset($podate) || trim($podate) === '' ? date('d-m-y') : $this->_date($podate, 'd-m-y');
        $cols['porefno'] = !isset($porefno) || trim($porefno) === "" ? "0" : $porefno;
        $cols['itemtype'] = !isset($itemtype) || trim($itemtype) === "" ? "0" : $itemtype;
        $cols['posupplier'] = !isset($posupplier) || trim($posupplier) === "" ? "0" : $posupplier;
        $cols['posupplieraddress'] = !isset($posupplieraddress) || trim($posupplieraddress) === "" ? "0" : $posupplieraddress;
        $cols['poattenby'] = !isset($poattenby) || trim($poattenby) === "" ? "0" : $poattenby;
        $cols['podescription'] = !isset($podescription) || trim($podescription) === "" ? "0" : $podescription;
        $cols['poqty'] = !isset($poqty) || trim($poqty) === "" ? "0" : $poqty;
        $cols['povalue'] = !isset($povalue) || trim($povalue) === "" ? "0" : $povalue;
        $cols['pounitprice'] = !isset($pounitprice) || trim($pounitprice) === "" ? "0" : $pounitprice;
        $cols['ponotes'] = !isset($ponotes) || trim($ponotes) === "" ? "0" : $ponotes;
        $cols['popaymentterms'] = !isset($popaymentterms) || trim($popaymentterms) === "" ? "0" : $popaymentterms;
        $cols['podeliveryterms'] = !isset($podeliveryterms) || trim($podeliveryterms) === "" ? "0" : $podeliveryterms;
        $cols['poproject'] = !isset($poproject) || trim($poproject) === "" ? "0" : $poproject;
        $cols['pocby'] = !isset($pocby) || trim($pocby) === "" ? "0" : $pocby;
        $cols['poeby'] = !isset($poeby) || trim($poeby) === "" ? "0" : $poeby;
        $cols['pocdate'] = !isset($pocdate) || trim($pocdate) === '' ? date('d-M-Y') : $this->_date($pocdate, 'd-M-Y');
        $cols['poedate'] = !isset($poedate) || trim($poedate) === '' ? date('d-M-Y') : $this->_date($poedate, 'd-M-Y');
        $cols['poiscurrent'] = !isset($poiscurrent) || trim($poiscurrent) === "" ? "0" : $poiscurrent;
        $cols['poarea'] = !isset($poarea) || trim($poarea) === "" ? "0" : $poarea;
        $cols['poweight'] = !isset($poweight) || trim($poweight) === "" ? "0" : $poweight;
        return $cols;
    }

    private function _pos($poproject)
    {
        $this->sql = "SELECT *FROM pms_po where poproject = :poproject";
        $this->cm  = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poproject", $poproject);
        $this->cm->execute();
        $pos = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $po = $this->pms_po($rows);
            $pos[] = $po;
        }
        unset($this->sql, $this->cm, $rows);
        return $pos;
    }

    public function Pos($poproject)
    {
        $pos = $this->_pos($poproject);
        $this->response = array(
            "msg" => "1",
            "data" => $pos
        );
        return json_encode($this->response);
        exit;
    }

    public function bipo($itemtype, $poproject)
    {
        $this->sql = "SELECT *,gs.glasssuppliername FROM pms_ponew as po inner join pms_glass_suppliers as gs on 
        po.ponewsupplier = gs.glasssupplierid where ponewtype = :ponewtype and ponewproject = :ponewproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewtype", $itemtype);
        $this->cm->bindParam(":ponewproject", $poproject);
        $this->cm->execute();
        $ponews = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $val = (float)$rows['ponewtotval'];
            $vat = (float)$rows['ponewvat'];
            $x = $val * $vat / 100;
            $y = 1 * $vat / 100;
            $y1 = 1 + $y;
            $z = $x / $y1;
            $vatval = $val - $z;
            $itemval = $val - $vatval;
            $po = array(
                'glasssuppliername' => $rows['glasssuppliername'],
                'ponewrefno' => $rows['ponewrefno'],
                'ponewid' => $rows['ponewid'],
                'ponewvat' => $rows['ponewvat'],
                'ponewtotval' => $rows['ponewtotval'],
                'ponewdate' => $rows['ponewdate'],
                'vatval' => $vatval,
                'itemval' => $itemval,
                "ponewdate" => date_format(date_create($rows['ponewdate']), 'Y-m-d'),
                "ponewdate_d" => date_format(date_create($rows['ponewdate']), 'd-M-Y'),
                "ponewdate_n" => date_format(date_create($rows['ponewdate']), 'd-m-Y'),
                "ponewdate_p" => date_format(date_create($rows['ponewdate']), 'd-m-y'),
            );
            $ponews[] = $po;
        }

        $this->response = array(
            "msg" => "1",
            "data" => $ponews
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkpo($params)
    {
        // print_r($params);
        $this->sql = "SELECT COUNT(*) as cnt from pms_po where poproject = :poproject and porefno = :porefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        //echo $cnt;
        return $cnt;
    }
    private function _po($params)
    {
        $this->sql  = "SELECT *FROM from pms_po where poproject = :poproject and porefno = :porefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $po = $this->pms_po($rows);
        unset($this->cm, $this->sql, $rows);
        return $po;
    }

    public function Po($poproject, $porefno)
    {
        $params = array(
            ":poproject" => $poproject,
            ":porefno" => $porefno,
        );

        $cnt = $this->_checkpo($params);
        if ($cnt !== 1) {
            $this->response = array(
                "msg" => "0",
                "data" => "No Data found"
            );
            return json_encode($this->response);
            exit;
        }

        $po = $this->_po($params);
        $this->response = array(
            "msg" => "1",
            "data" => $po
        );
        return json_encode($this->response);
        exit;
    }

    private function _savepo($save)
    {
        $this->sql = "INSERT INTO pms_po values(
            null,
            :podate,
            :porefno,
            :itemtype,
            :posupplier,
            :posupplieraddress,
            :poattenby,
            :podescription,
            :poqty,
            :povalue,
            :pounitprice,
            :ponotes,
            :popaymentterms,
            :podeliveryterms,
            :poproject,
            :pocby,
            :poeby,
            :pocdate,
            :poedate,
            :poiscurrent,
            :poarea,
            :poweight
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function SavePo($save)
    {
        $project = $save[':poproject'];
        $porefno = $save[':porefno'];

        $params = array(
            ":poproject" => $project,
            ":porefno" => $porefno,
        );

        $cnt = $this->_checkpo($params);

        if ($cnt !== 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "This Ref#no Already Found in this Project"
            );
            return json_encode($this->response);
            exit;
        }


        $sv = $this->_savepo($save);
        if (!$sv) {
            $this->response = array(
                "msg" => '0',
                "data" => "Error on saveing Data"
            );
            return json_encode($this->response);
            exit;
        }

        $pos = $this->_pos($project);
        $this->response = array(
            "msg" => "1",
            "data" => $pos
        );
        return json_encode($this->response);
        exit;
    }

    private function pms_po_budget($rows)
    {
        extract($rows);
        $cols = [];
        $cols['pobno'] = !isset($pobno) || trim($pobno) === "" ? "0" : $pobno;
        $cols['pobdate'] = !isset($pobdate) || trim($pobdate) === "" ? date('Y-m-d') : $pobdate;
        $cols['pobdate_d'] = !isset($pobdate) || trim($pobdate) === '' ? date('d-M-Y') : $this->_date($pobdate, 'd-M-Y');
        $cols['pobdate_n'] = !isset($pobdate) || trim($pobdate) === '' ? date('d-m-Y') : $this->_date($pobdate, 'd-m-Y');
        $cols['pobdate_p'] = !isset($pobdate) || trim($pobdate) === '' ? date('d-m-y') : $this->_date($pobdate, 'd-m-y');

        $cols['pobprefno'] = !isset($pobprefno) || trim($pobprefno) === "" ? "0" : $pobprefno;
        $cols['pobporefno'] = !isset($pobporefno) || trim($pobporefno) === "" ? "0" : $pobporefno;
        $cols['pobtype'] = !isset($pobtype) || trim($pobtype) === "" ? "0" : $pobtype;
        $cols['pobtotbudget'] = !isset($pobtotbudget) || trim($pobtotbudget) === "" ? "0" : $pobtotbudget;
        $cols['pobbmprice'] = !isset($pobbmprice) || trim($pobbmprice) === "" ? "0" : $pobbmprice;
        $cols['pobprvalue'] = !isset($pobprvalue) || trim($pobprvalue) === "" ? "0" : $pobprvalue;
        $cols['pobcvalue'] = !isset($pobcvalue) || trim($pobcvalue) === "" ? "0" : $pobcvalue;
        $cols['pobavailablebudget'] = !isset($pobavailablebudget) || trim($pobavailablebudget) === "" ? "0" : $pobavailablebudget;
        $cols['pobcby'] = !isset($pobcby) || trim($pobcby) === "" ? "0" : $pobcby;
        $cols['pobeby'] = !isset($pobeby) || trim($pobeby) === "" ? "0" : $pobeby;
        $cols['pobcdate'] = !isset($pobcdate) || trim($pobcdate) === "" ? "0" : $pobcdate;
        $cols['pobedate'] = !isset($pobedate) || trim($pobedate) === "" ? "0" : $pobedate;
        $cols['pobstatus'] = !isset($pobstatus) || trim($pobstatus) === "" ? "0" : $pobstatus;
        $cols['pobqty'] = !isset($pobqty) || trim($pobqty) === "" ? "0" : $pobqty;
        $cols['pobproject'] = !isset($pobproject) || trim($pobproject) === "" ? "0" : $pobproject;

        return $cols;
    }

    private function _pobs($poproject)
    {
        $this->sql = "SELECT *FROM pms_po_budget as pob inner join pms_po as po on pop.pobporefno = po.porefno where po.poproject = :poproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poproject", $poproject);
        $this->cm->execute();
        $bops = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $pob = $this->pms_po_budget($rows);
            $po = $this->pms_po($rows);
            $bops[] = (object) array_merge((array) $pob, (array) $po);
        }
        unset($this->sql, $this->cm, $rows);
        return $bops;
    }

    public function pobs($poproject)
    {
        $pobs = $this->_pobs($poproject);
        $this->response = array(
            "msg" => "1",
            "data" => $pobs
        );
        return json_encode($this->response);
        exit;
    }

    private function _checkboprefno($params)
    {
        $this->sql = "SELECT COUNT(*) as cnt FROM pms_po_budget as pob inner join pms_po as po on pop.pobporefno = po.porefno where po.poproject = :poproject and pob.pobporefno = :pobporefno and pob.pobprefno = :pobprefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql, $rows, $this->cm);
        return $cnt;
    }

    private function _pob($params)
    {
        $this->sql = "SELECT *FROM pms_po_budget as pob inner join pms_po as po on pop.pobporefno = po.porefno where po.poproject = :poproject and pob.pobporefno = :pobporefno and pob.pobprefno = :pobprefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $pob = $this->pms_po_budget($rows);
        $po = $this->pms_po($rows);
        $bops[] = (object) array_merge((array) $pob, (array) $po);
        unset($this->sql, $rows, $this->cm);
        return $bops;
    }

    public function pop($params)
    {
        $cnt = $this->_checkboprefno($params);
        if ($cnt !== 1) {
            $this->response = array(
                "msg" => "1",
                "data" => "No Data Found"
            );
            return json_encode($this->response);
            exit;
        }

        $pob = $this->_pob($params);
        $this->response = array(
            "msg" => "1",
            "data" => $pob
        );
        return json_encode($this->response);
        exit;
    }

    private function _savepob($params)
    {
        $this->sql = "INSERT INTO pms_po_budget values(
            null,
            :pobdate,
            :pobprefno,
            :pobporefno,
            :pobtype,
            :pobtotbudget,
            :pobbmprice,
            :pobprvalue,
            :pobcvalue,
            :pobavailablebudget,
            :pobcby,
            :pobeby,
            :pobcdate,
            :pobedate,
            :pobstatus,
            :pobqty,
            :pobproject
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql, $rows);
        return $sv;
    }

    public function savepbo($save, $params)
    {
        $cnt = $this->_checkboprefno($params);
        if ($cnt !== 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "Already This Referance Number Found"
            );
            return json_encode($this->response);
            exit;
        }

        $sv = $this->_savepob($save);
        if (!$sv) {
            $this->response = array(
                "msg" => '0',
                "data" => "Error on Saving Data"
            );
            return json_encode($this->response);
            exit;
        }

        $pobs = $this->_pobs($params[':poproject']);
        $this->response = array(
            "msg" => "1",
            "data" => $pobs
        );
        return json_encode($this->response);
        exit;
    }
    private function poinfo($poproject, $porefno)
    {
        $this->sql = "SELECT *FROM pms_po where porefno = :porefno and poproject = :poproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":porefno", $porefno);
        $this->cm->bindParam(":poproject", $poproject);
        $this->cm->execute();
        if ($this->cm->rowCount() === 0) {
            return 0;
        }

        $info = array();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $info = $this->pms_po($rows);
        unset($this->sql, $this->cm, $rows);
        return $info;
    }
    private function sumoffprevious($poproject, $porefno, $itemtype)
    {
        $this->sql = "SELECT COALESCE(SUM(povalue),0) as tot from pms_po where porefno <> :porefno and poproject = :poproject and itemtype = :itemtype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":porefno", $porefno);
        $this->cm->bindParam(":poproject", $poproject);
        $this->cm->bindParam(":itemtype", $itemtype);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $amount = $rows['tot'];
        unset($this->cm, $this->sql, $rows);
        return $amount;
    }
    private function budgetamountglass($project)
    {
        $this->sql = "SELECT COALESCE(SUM(bgtotalcost),0) as total,COALESCE(SUM(bgshapedtotalcost),0) as stotal FROM pms_budget_glass where bgprojectid = :bgprojectid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bgprojectid", $project);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $tot = (float)$rows['total'];
        $stot = (float)$rows['stotal'];
        $sum = $tot + $stot;
        unset($this->sql, $this->cm, $rows);
        return $sum;
    }
    private function budgetamountmaterial($project, $type)
    {
        $this->sql = "SELECT COALESCE(SUM(bmdiscountval),0) as total from pms_budget_materials where bmproject = :bmproject and bmmaterialtype = :bmmaterialtype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bmproject", $project);
        $this->cm->bindParam(":bmmaterialtype", $type);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $totamount = $rows['total'];
        unset($this->cm, $this->sql, $rows);
        return $totamount;
    }


    private function getpobinfo($pobproject, $pobporefno, $pobprefno)
    {
        $this->sql = "SELECT *FROM pms_po_budget 
                    where pobproject = :pobproject 
                    and pobporefno = :pobporefno 
                    and pobprefno = :pobprefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pobproject", $pobproject);
        $this->cm->bindParam(":pobporefno", $pobporefno);
        $this->cm->bindParam(":pobprefno", $pobprefno);
        $this->cm->execute();
        if ($this->cm->rowCount() === 0) {
            return 0;
        }

        $rows =  $this->cm->fetch(PDO::FETCH_ASSOC);
        $pob = $this->pms_po_budget($rows);
        unset($this->cm, $this->sql, $rows);
        return $pob;
    }

    private function bugetqty($project, $item)
    {
        $this->sql = "SELECT COALESCE(SUM(bmqty),0) as totsqm,bmunit from pms_budget_materials 
        where bmproject = :bmproject and bmmaterialtype = :bmmaterialtype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bmproject", $project);
        $this->cm->bindParam(":bmmaterialtype", $item);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $qty = (float)$rows['totsqm'];
        $unit = $rows['bmunit'];
        $infos = array(
            "qty" => $qty,
            "bmunit" => strtolower(($unit)),
        );

        unset($this->sql, $rows, $this->cm);
        return $infos;
    }

    private function tonnage($pobproject, $type)
    {
        $this->sql = "SELECT COALESCE(SUM(),0) as cnt from pms_po where itemtype = :itemtype and poproject = :poproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poproject", $pobproject);
        $this->cm->bindParam(":itemtype", $type);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $val = (float)$rows['cnt'];
        unset($this->sql, $rows, $this->cm);
        return $val;
    }
    public function pobprintinfo($pobproject, $pobporefno, $pobprefno)
    {
        $pob = $this->getpobinfo($pobproject, $pobporefno, $pobprefno);
        // echo "project '{$pobproject}'";
        // echo "po ref '{$pobporefno}'";
        // echo "pob ref '{$pobprefno}'";
        if ($pob === 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "No Data found"
            );
            return json_encode($this->response);
            exit;
        }

        $this->sql = "SELECT ponewid FROM pms_ponew where ponewproject = :ponewproject and ponewrefno = :ponewrefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewproject", $pobproject);
        $this->cm->bindParam(":ponewrefno", $pobporefno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $ponewid = $rows['ponewid'];
        unset($this->cm, $this->sql, $rows);

        $po = $this->_getinfo($ponewid);

        //$po = $this->poinfo($pobproject, $pobporefno);
        $potype = $po['ponewtype'];
        $budgetinfos = $this->bugetqty($pobproject, $potype);
        if ($po === 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "Po Information Not Found"
            );
            return json_encode($this->response);
            exit;
        }
        $pval = 0;
        if ($budgetinfos['bmunit'] === 'ton' || $budgetinfos['bmunit'] === 'kg') {
            $pval = $this->tonnage($pobproject, $potype);
        }

        $budgetinfos['pval'] = $pval;

        $data = array(
            "po" => $po,
            "pob" => $pob,
            "budget" => $budgetinfos,
        );
        $this->response = array(
            "msg" => "1",
            "data" => $data
        );
        return json_encode($this->response);
        exit;
    }


    public function pobsall($pobproject)
    {
        $this->sql = "SELECT *FROM pms_po_budget as pob left join pms_po as po on pob.pobproject = po.poproject and pob.pobporefno = po.porefno where pob.pobproject = :pobproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":pobproject", $pobproject);
        $this->cm->execute();
        $res = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $po = $this->pms_po($rows);
            $pob = $this->pms_po_budget($rows);
            $x = (object) array_merge((array) $pob, (array) $po);
            $res[] = $x;
        }
        unset($this->sql, $this->cm, $rows);
        $this->response = array(
            "msg" => '1',
            "data" => $res,
        );
        return json_encode($this->response);
        exit;
    }

    public function projectreferancenoall($poproject)
    {
        $this->sql = "SELECT ponewrefno FROM pms_ponew where ponewproject = :poproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poproject", $poproject);
        $this->cm->execute();
        $porefnos = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $porefnos[] = $rows['ponewrefno'];
        }

        unset($this->sql, $this->cm, $rows);
        $this->response = array(
            "msg" => "1",
            "data" => $porefnos
        );
        return json_encode($this->response);
        exit;
    }

    private function _getdeliveryTerms($ponewid)
    {
        $this->sql = "SELECT *FROM pms_ponew_deliveryterms where ponewid = :ponewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewid", $ponewid);
        $this->cm->execute();
        $deliveryterms = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $terms = array(
                'ponewdtid' => $rows['ponewdtid'],
                'ponewdtdescription' => $rows['ponewdtdescription'],
                'ponewdtproject' => $rows['ponewdtproject'],
                'ponewid' => $rows['ponewid'],
                'ponewrefno' => $rows['ponewrefno'],
            );
            $deliveryterms[] = $terms;
        }
        unset($this->sql, $this->cm, $rows);
        return $deliveryterms;
    }

    private function addDeliveryTerms($sve)
    {
        $this->sql = "INSERT INTO pms_ponew_deliveryterms values(
            null,
            :ponewdtdescription,
            :ponewdtproject,
            :ponewid,
            :ponewrefno
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($sve);
        unset($this->cm, $this->sql);
        return $sv;
    }

    private function _getpaymentterms($ponewid)
    {
        $this->sql = "SELECT *FROM pms_ponew_paymentterms where ponewid = :ponewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewid", $ponewid);
        $this->cm->execute();
        $paymentterms = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $terms = array(
                "ponewptid" => $rows['ponewptid'],
                "ponewptdesc" => $rows['ponewptdesc'],
                "ponewptproject" => $rows['ponewptproject'],
                "ponewptrefno" => $rows['ponewptrefno'],
                "ponewid" => $rows['ponewid'],
            );
            $paymentterms[] = $terms;
        }
        unset($this->sql, $this->cm, $rows);
        return $paymentterms;
    }


    private function addPaymentTerms($save)
    {
        $this->sql = "INSERT INTO pms_ponew_paymentterms values(
            null,
            :ponewptdesc,
            :ponewptproject,
            :ponewptrefno,
            :ponewid
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        unset($this->sql, $this->cm);
        return $sv;
    }

    private function addPaymentdt($sv)
    {
        $this->sql = "INSERT INTO pms_ponew_dt values(
            null,
            :ponewid,
            :ponewdtdescription, 
            :ponewdtcalcby,
            :ponewdtqty,
            :ponewdtwgt,
            :ponewdtarea,
            :ponewdtunitprice,
            :ponewdtwgttotprice,
            :ponewdtwgtpjno,
            :ponewdtwgtrefno,
            :glasscoatings,
            :glassthickness,
            :glassout,
            :glassinner,
            :extraamount,
            :currentamount,
            :ordertype,
            :suppliername,
            :projectno,
            :projectname,
            :projectlocation,
            :supplieratt,
            :supplierfax,
            :supplierph
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($sv);
        unset($this->sql, $this->cm);
        return $sv;
    }

    private function _checkporefno($refno, $pjcno)
    {

        $this->sql = "SELECT COUNT(ponewrefno) as cnt from pms_ponew where ponewrefno = :ponewrefno and ponewproject = :ponewproject";
        // $sql = "SELECT COUNT(refno) as cnt from pms_ponew where ponewrefno = '{$refno}' and ponewproject = '{$pjcno}'";
        // echo $sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewrefno", $refno);
        $this->cm->bindParam(":ponewproject", $pjcno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        //echo $cnt;
        return  $cnt;
    }

    private function savepms_ponew($save)
    {
        $this->sql = "INSERT INTO pms_ponew values(
            null,
            :ponewrefno,
            :ponewsupplier,
            :ponewfrom,
            :ponewsubject,
            :ponewvat,
            :ponewtotval,
            :ponewtype,
            :ponewproject,
            :ponewcby,
            :poneweby,
            :ponewcdate,
            :ponewedate,
            :ponewpostflag,
            :ponewdate,
            :ordertype,
            :suppliername,
            :projectno,
            :projectname,
            :projectlocation,
            :supplieratt,
            :supplierfax,
            :supplierph
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        if ($sv) {
            return $this->cn->lastInsertId();
        } else {
            return 0;
        }
    }

    private function po_info($rows)
    {
        $dt = array(
            "ponewid" => $rows['ponewid'],
            "ponewrefno" => $rows['ponewrefno'],
            "ponewsupplier" => $rows['ponewsupplier'],
            "ponewfrom" => $rows['ponewfrom'],
            "ponewsubject" => $rows['ponewsubject'],
            "ponewvat" => $rows['ponewvat'],
            "ponewtotval" => $rows['ponewtotval'],
            "ponewtype" => $rows['ponewtype'],
            "ponewproject" => $rows['ponewproject'],
            "ponewcby" => $rows['ponewcby'],
            "poneweby" => $rows['poneweby'],
            "ponewcdate" => date_format(date_create($rows['ponewcdate']), 'd-M-Y H:i:s'),
            "ponewedate" => date_format(date_create($rows['ponewedate']), 'd-M-Y H:i:s'),
            "ponewpostflag" => $rows['ponewpostflag'],
            "ponewdate" => date_format(date_create($rows['ponewdate']), 'Y-m-d'),
            "ponewdate_d" => date_format(date_create($rows['ponewdate']), 'd-M-Y'),
            "ponewdate_n" => date_format(date_create($rows['ponewdate']), 'd-m-Y'),
            "ponewdate_p" => date_format(date_create($rows['ponewdate']), 'd-m-y'),
            "qty" => $rows['qty'],
            "wght" => $rows['wt'],
            "area" => $rows['area'],
            "totalprice" => $rows['totprice'],
            "project_no" => $this->enc('denc', $rows['project_no']),
            "project_no_enc" => $rows['project_no'],
            "project_name" => $this->enc('denc', $rows['project_name']),
            "project_cname" => $this->enc('denc', $rows['project_cname']),
            "project_location" => $this->enc('denc', $rows['project_location']),
            "Sales_Representative" => $this->enc('denc', $rows['Sales_Representative']),
            "projectRegion" => $this->enc('denc', $rows['projectRegion']),
            "project_id" => $rows['project_id'],

            "glasssupplierid" => $rows['glasssupplierid'],
            "glasssuppliername" => $rows['glasssuppliername'],
            "glasssuppliercountry" => $rows['glasssuppliercountry'],
            "suppliercontact" => $rows['suppliercontact'],
            "supplieraddress" => $rows['supplieraddress'],
            "supplieremail" => $rows['supplieremail'],
            "supplierphone" => $rows['supplierphone'],
            "supplierfax" => $rows['supplierfax'],
        
        );
        $totalprice = (float)$dt['totalprice'];
        $ponewvat = (float)$dt['ponewvat'];
        $vatval = $totalprice *  $ponewvat / 100;
        $dt['vatvalue'] = $vatval;

        return $dt;
    }
    private function getponewall($ponewproject)
    {
        $this->sql = "SELECT 
                        *,
                        podt.qty as qty,
                        podt.wght as wt,
                        podt.area as area,
                        podt.totalprice as totprice,
                        pj.project_no,
                        pj.project_name,
                        pj.project_cname,
                        pj.project_location,
                        pj.Sales_Representative,
                        pj.projectRegion,
                        pj.project_id  
                        FROM ((pms_ponew as po left join (
            select ponewid,
            sum(ponewdtqty) as qty,
            sum(ponewdtwgt) as wght,
            sum(ponewdtarea) as area,
            sum(ponewdtwgttotprice) as totalprice            
            from pms_ponew_dt group by ponewid
        ) as podt on po.ponewid = podt.ponewid) left join pms_project_summary as pj 
        on po.ponewproject = pj.project_id) left join pms_glass_suppliers as gs 
        on po.ponewsupplier = gs.glasssupplierid 
        where po.ponewproject = :poproject";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poproject", $ponewproject);
        $this->cm->execute();

        $dts = [];
        // print_r($this->cm);
        // $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        // print_r($rows);
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {

            // $dt['paymentterms'] = $this->_getpaymentterms($rows['ponewid']);
            // $dt['deliveryterms'] = $this->_getdeliveryTerms($rows['ponewid']);
            $dt = $this->po_info($rows);
            $dts[] = $dt;
        }

        unset($this->cm, $this->sql, $this->cm);
        return $dts;
    }
    private function _rptpoall()
    {
        $this->sql = "SELECT 
                    *,
                    podt.qty as qty,
                    podt.wght as wt,
                    podt.area as area,
                    podt.totalprice as totprice,
                    pj.project_no,
                    pj.project_name,
                    pj.project_cname,
                    pj.project_location,
                    pj.Sales_Representative,
                    pj.projectRegion,
                    pj.project_id 
                    FROM ((pms_ponew as po left join (
            select ponewid,
            sum(ponewdtqty) as qty,
            sum(ponewdtwgt) as wght,
            sum(ponewdtarea) as area,
            sum(ponewdtwgttotprice) as totalprice            
            from pms_ponew_dt group by ponewid
            ) as podt on po.ponewid = podt.ponewid) left join pms_project_summary as pj 
            on po.ponewproject = pj.project_id) left join pms_glass_suppliers as gs 
            on po.ponewsupplier = gs.glasssupplierid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $dts = [];
        // print_r($this->cm);
        // $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        // print_r($rows);
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {

            // $dt['paymentterms'] = $this->_getpaymentterms($rows['ponewid']);
            // $dt['deliveryterms'] = $this->_getdeliveryTerms($rows['ponewid']);
            $dt = $this->po_info($rows);
            $dts[] = $dt;
        }

        unset($this->cm, $this->sql, $this->cm);
        return $dts;
    }

    public function rptpoall(){
        $rpts = $this->_rptpoall();
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }
    public function ponewall($ponewproject)
    {
        $dts = $this->getponewall($ponewproject);
        $this->response = array(
            "msg" => "1",
            "data" => $dts
        );
        return json_encode($this->response);
        exit;
    }



    public function getDeliveryTerms($ponewid)
    {
        $terms = $this->_getdeliveryTerms($ponewid);
        $this->response = array(
            "msg" => "1",
            "data" => $terms
        );
        return json_encode($this->response);
        exit;
    }

    public function getpaymentterms($ponewid)
    {
        $terms = $this->_getpaymentterms($ponewid);
        $this->response = array(
            "msg" => "1",
            "data" => $terms
        );
        return json_encode($this->response);
        exit;
    }

    private function _getponewdt($ponewid)
    {
        $this->sql  = "SELECT *FROM pms_ponew_dt where ponewid = :ponewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewid", $ponewid);
        $this->cm->execute();
        $podts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $podt = array(
                'ponewdtid' => $rows['ponewdtid'],
                'ponewid' => $rows['ponewid'],
                'ponewdtdescription' => $rows['ponewdtdescription'],
                'ponewdtcalcby' => $rows['ponewdtcalcby'],
                'ponewdtqty' => $rows['ponewdtqty'],
                'ponewdtwgt' => $rows['ponewdtwgt'],
                'ponewdtarea' => $rows['ponewdtarea'],
                'ponewdtunitprice' => $rows['ponewdtunitprice'],
                'ponewdtwgttotprice' => $rows['ponewdtwgttotprice'],
                'ponewdtwgtpjno' => $rows['ponewdtwgtpjno'],
                'ponewdtwgtrefno' => $rows['ponewdtwgtrefno'],

                'glasscoatings' => $rows['glasscoatings'],
                'glassthickness' => $rows['glassthickness'],
                'glassout' => $rows['glassout'],
                'glassinner' => $rows['glassinner'],
                'extraamount' => $rows['extraamount'],
                'currentamount' => $rows['currentamount'],

                "suppliername" => $rows['suppliername'],
                "supplieratt" => $rows['supplieratt'],
                "supplierfax" => $rows['supplierfax'],
                "supplierph" => $rows['supplierph'],
    
                "projectno" => $rows['projectno'],
                "projectname" => $rows['projectname'],
                "projectlocation" => $rows['projectlocation'],
            );
            $podts[] = $podt;
        }
        unset($this->sql, $this->cm, $rows);
        return $podts;
    }

    public function getponewdt($ponewid)
    {
        $dts = $this->_getponewdt($ponewid);
        $this->response = array(
            "msg" => "1",
            "data" => $dts
        );
        return json_encode($this->response);
        exit;
    }

    public function saveponew($params, $dt, $delt, $payt)
    {
        $refno = $params[':ponewrefno'];
        $project = $params[':ponewproject'];
        $cnt = $this->_checkporefno($refno, $project);
        if ($cnt !== 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "This Referance Number Already Found",
            );
            return json_encode($this->response);
            exit;
        }
        $sv = $this->savepms_ponew($params);
        if ($sv === 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error On Save PO"
            );
            return json_encode($this->response);
            exit;
        }

        foreach ($dt as $d) {
            //$dtparams = [];
           // print_r($d);
            $dtparam = array(
                ":ponewid" => $sv,
                ":ponewdtdescription" => $d->description,
                ":ponewdtcalcby" => $d->calcby,
                ":ponewdtqty" => $d->qty,
                ":ponewdtwgt" => $d->weight,
                ":ponewdtarea" => $d->area,
                ":ponewdtunitprice" => $d->unitprice,
                ":ponewdtwgttotprice" => $d->totalprice,
                ":ponewdtwgtpjno" => $project,
                ":ponewdtwgtrefno" => $refno,
                ":glasscoatings" => $d->glasscoatings,
                ":glassthickness" => $d->glassthickness,
                ":glassout" => $d->glassout,
                ":glassinner" => $d->glassinner,
                ":extraamount" => $d->extraamount,
                ":currentamount" => $d->currentamount,
                ":ordertype" => $d->ordertype,
                ":suppliername" => $d->suppliername,
                ":projectno" => $d->projectno,
                ":projectname" => $d->projectname,
                ":projectlocation" => $d->projectlocation,
                ":supplieratt" => $d->supplieratt,
                ":supplierfax" => $d->supplierfax,
                ":supplierph" => $d->supplierph,                
            );
            //$dtparam[] = $dtparam;
            $this->addPaymentdt($dtparam);
        }

        //save terms 

        foreach ($payt as $p) {
            $payparams = array(
                ":ponewptdesc" => $p->terms,
                ":ponewptproject" => $project,
                ":ponewptrefno" => $refno,
                ":ponewid" => $sv,
            );
            $this->addPaymentTerms($payparams);
        }

        foreach ($delt as $d) {
            $delterms = array(
                ":ponewdtdescription" => $d->terms,
                ":ponewdtproject" => $project,
                ":ponewid" => $sv,
                ":ponewrefno" => $refno,
            );
            $this->addDeliveryTerms($delterms);
        }

        $this->response = array(
            "msg" => "1",
            "data" => $sv
        );
        return json_encode($this->response);
        exit;
    }
    private function _getinfo($ponewid)
    {
        $this->sql = "SELECT *,
        pj.project_no,
        pj.project_name,
        pj.project_cname,
        pj.project_location,
        pj.Sales_Representative,
        pj.projectRegion 
        FROM 
        (pms_ponew as po left join pms_project_summary as pj
        on po.ponewproject = pj.project_id) left join 
        pms_glass_suppliers as sp on 
        po.ponewsupplier = sp.glasssupplierid 
        where po.ponewid = :ponewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewid", $ponewid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $poinfo = array(
            "ponewid" => $rows['ponewid'],
            "ponewrefno" => $rows['ponewrefno'],
            "ponewsupplier" => $rows['ponewsupplier'],
            "ponewfrom" => $rows['ponewfrom'],
            "ponewsubject" => $rows['ponewsubject'],
            "ponewvat" => $rows['ponewvat'],
            "ponewtotval" => $rows['ponewtotval'],
            "ponewtype" => $rows['ponewtype'],
            "ponewproject" => $rows['ponewproject'],
            "ponewcby" => $rows['ponewcby'],
            "poneweby" => $rows['poneweby'],
            "ponewcdate" => date_format(date_create($rows['ponewcdate']), 'd-M-Y H:i:s'),
            "ponewedate" => date_format(date_create($rows['ponewedate']), 'd-M-Y H:i:s'),
            "ponewpostflag" => $rows['ponewpostflag'],
            "ponewdate" => date_format(date_create($rows['ponewdate']), 'Y-m-d'),
            "ponewdate_d" => date_format(date_create($rows['ponewdate']), 'd-M-Y'),
            "ponewdate_n" => date_format(date_create($rows['ponewdate']), 'd-m-Y'),
            "ponewdate_p" => date_format(date_create($rows['ponewdate']), 'd-m-y'),
            "project_no" => $this->enc('denc', $rows['project_no']),
            "project_no_enc" => $rows['project_no'],
            "project_name" => $this->enc('denc', $rows['project_name']),
            "project_cname" => $this->enc('denc', $rows['project_cname']),
            "project_location" => $this->enc('denc', $rows['project_location']),
            "Sales_Representative" => $this->enc('denc', $rows['Sales_Representative']),
            "projectRegion" => $this->enc('denc', $rows['projectRegion']),
            "glasssupplierid" => $rows['glasssupplierid'],
            "glasssuppliername" => $rows['glasssuppliername'],
            "glasssuppliercountry" => $rows['glasssuppliercountry'],
            "suppliercontact" => $rows['suppliercontact'],
            "supplieraddress" => $rows['supplieraddress'],
            "supplieremail" => $rows['supplieremail'],
            "supplierphone" => $rows['supplierphone'],
            "supplierfax" => $rows['supplierfax'],

            "suppliername" => $rows['suppliername'],
            "supplieratt" => $rows['supplieratt'],
            "supplierfax" => $rows['supplierfax'],
            "supplierph" => $rows['supplierph'],

            "projectno" => $rows['projectno'],
            "projectname" => $rows['projectname'],
            "projectlocation" => $rows['projectlocation'],
        );
        $poinfo['paymentterms'] = $this->_getpaymentterms($ponewid);
        $poinfo['deliveryterms'] = $this->_getdeliveryTerms($ponewid);
        $poinfo['dt'] = $this->_getponewdt($ponewid);

        $dt = $this->_getponewdt($ponewid);
        $ton = 0;
        foreach ($dt as $x) {
            $ton += (float)$x['ponewdtwgt'];
        }
        $poinfo['totweight'] = $ton;
        unset($this->cm, $this->sql, $rows);
        return $poinfo;
    }
    public function getinfoponew($ponewid)
    {
        $poinfo = $this->_getinfo($ponewid);
        $this->response = array(
            "msg" => "1",
            "data" => $poinfo
        );
        return json_encode($this->response);
        exit;
    }

    private function previousordertotal($type, $project, $cid)
    {
        $this->sql = "SELECT COALESCE(SUM(ponewtotval),0) as tot from pms_ponew 
        where 
        ponewproject = :ponewproject and 
        ponewtype = :ponewtype and 
        ponewid < :id
        order by ponewid desc";
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":ponewproject" => $project,
            ":ponewtype" => $type,
            ":id" => $cid,
        );
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $tot = (float)$rows['tot'];
        unset($this->sql, $this->cm, $rows);
        return $tot;
    }

    private function getsumoffsponewdt($ponewid)
    {
        $this->sql = "SELECT 
        COALESCE(sum(ponewdtqty),0) as qty,
        COALESCE(sum(ponewdtwgt),0) as weight,
        COALESCE(sum(ponewdtarea),0) as area 
        from pms_ponew_dt where ponewid = :ponewid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewid", $ponewid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $a = array(
            "qty" => $rows['qty'],
            "weight" => $rows['weight'],
            "area" => $rows['area'],
        );
        unset($this->sql, $this->cm, $rows);
        return $a;
    }

    public function searchpo($poproject, $porefno)
    {
        $this->sql = "SELECT ponewid FROM pms_ponew where ponewproject = :ponewproject and ponewrefno = :ponewrefno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":ponewproject", $poproject);
        $this->cm->bindParam(":ponewrefno", $porefno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $ponewid = $rows['ponewid'];
        unset($this->cm, $this->sql, $rows);
        $getinfo = $this->_getinfo($ponewid);
        $type = $getinfo['ponewtype'];
        $budget = 0;
        if ($type === 'Glass') {
            $budget = $this->budgetamountglass($poproject);
        } else {
            $budget = $this->budgetamountmaterial($poproject, $type);
        }
        //get privious 
        $previousordertotal = $this->previousordertotal($type, $poproject, $ponewid);
        $gettotorder = (float)$getinfo['ponewtotval'] + (+$previousordertotal);
        $getbalanceofbudget = (float)$budget - (float)$gettotorder;
        $dt = $this->getsumoffsponewdt($ponewid);

        $getinfo['projectbudget'] = $budget;
        $getinfo['prvtotal'] = $previousordertotal;
        $getinfo['gettotorder'] = $gettotorder;
        $getinfo['getbalanceofbudget'] = $getbalanceofbudget;
        $getinfo['sumofqty'] = $dt['qty'];
        $getinfo['sumofweight'] = $dt['weight'];
        $getinfo['sumofarea'] = $dt['area'];

        $this->response = array(
            "msg" => "1",
            "data" => $getinfo
        );
        return json_encode($this->response);
        exit;
    }

    private function _updateadviceno($id)
    {
        $date = date('d');
        $month = date('m');
        $year = date('Y');
        $adviceno = "NAF/POA/{$id}-{$date}{$month}/{$year}";
        $this->sql = "UPDATE pms_ponew_paymentadvice set padvancesno = :padvancesno where padvanceid = :padvanceid";
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":padvancesno" => $adviceno,
            ":padvanceid" => $id
        );
        $upd = $this->cm->execute($params);
        unset($this->sql, $this->cm);
        return $upd;
    }

    private function newAdvice($save)
    {
        $this->sql = "INSERT INTO pms_ponew_paymentadvice values(
            null,
            :padvancedate,
            :padvancesno,
            :ponewid,
            :paymenttype,
            :paymentamount,
            :paymentcountry,
            :paymentpersent,
            :paymentnotes,
            :paydescriptions,
            :pacby,
            :paeby,
            :pacdate,
            :paedate,
            :padviceto,
            :padvicetypedescription,
            :padviceproject
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        unset($this->cm, $this->sql);

        if (!$sv) {
            return 0;
        }

        return $this->cn->lastInsertId();
    }

    private function pms_ponew_paymentadvice($rows)
    {
        extract($rows);
        $cols = [];
        $cols['padvanceid'] = !isset($padvanceid) || trim($padvanceid) === "" ? '0' : $padvanceid;
        $cols['padvancedate'] = !isset($padvancedate) || trim($padvancedate) === "" ? date('Y-m-d') : $padvancedate;
        $cols['padvancedate_d'] = !isset($padvancedate) || trim($padvancedate) === "" ? date('Y-m-d') : $this->_date($padvancedate, 'd-M-Y');
        $cols['padvancedate_n'] = !isset($padvancedate) || trim($padvancedate) === "" ? date('Y-m-d') : $this->_date($padvancedate, 'd-m-Y');
        $cols['padvancedate_p'] = !isset($padvancedate) || trim($padvancedate) === "" ? date('Y-m-d') : $this->_date($padvancedate, 'd-m-y');
        $cols['padvancesno'] =  !isset($padvancesno) || trim($padvancesno) === "" ? '0' : $padvancesno;
        $cols['ponewid'] =  !isset($ponewid) || trim($ponewid) === "" ? '0' : $ponewid;
        $cols['paymenttype'] = !isset($paymenttype) || trim($paymenttype) === "" ? '0' : $paymenttype;
        $cols['paymentamount'] = !isset($paymentamount) || trim($paymentamount) === "" ? '0' : $paymentamount;
        $cols['paymentcountry'] = !isset($paymentcountry) || trim($paymentcountry) === "" ? '0' : $paymentcountry;
        $cols['paymentpersent'] = !isset($paymentpersent) || trim($paymentpersent) === "" ? '0' : $paymentpersent;
        $cols['paymentnotes'] = !isset($paymentnotes) || trim($paymentnotes) === "" ? '0' : $paymentnotes;
        $cols['paydescriptions'] = !isset($paydescriptions) || trim($paydescriptions) === "" ? '-' : $paydescriptions;
        $cols['pacby'] = !isset($pacby) || trim($pacby) === "" ? '0' : $pacby;
        $cols['paeby'] = !isset($paeby) || trim($paeby) === "" ? '0' : $paeby;
        $cols['pacdate'] = !isset($pacdate) || trim($pacdate) === "" ? '0' : $pacdate;
        $cols['paedate'] = !isset($paedate) || trim($paedate) === "" ? '0' : $paedate;
        $cols['padviceto'] = !isset($padviceto) || trim($padviceto) === "" ? '0' : $padviceto;
        $cols['padvicetypedescription'] = !isset($padvicetypedescription) === "" || trim($padvicetypedescription) ? '0' : $padvicetypedescription;
        $cols['padviceproject'] = !isset($padviceproject) === "" || trim($padviceproject) ? '0' : $padviceproject;

        return $cols;
    }

    private function getadvice($id)
    {
        $this->sql = "SELECT *FROM pms_ponew_paymentadvice where padvanceid = :padvanceid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":padvanceid", $id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $infos = $this->pms_ponew_paymentadvice($rows);
        unset($this->cm, $this->sql, $rows);
        return $infos;
    }

    public function getAdviceproject($id)
    {
        $infos = $this->getadvice($id);
        $this->response = array(
            "msg" => "1",
            "data" => $infos
        );
        return json_encode($this->response);
        exit;
    }
    public function advicenew($save)
    {
        $id = $this->newAdvice($save);
        if ($id === 0) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Saving Data"
            );
            return json_encode($this->response);
            exit;
        }

        $update = $this->_updateadviceno($id);
        if (!$update) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error On Update REF Number"
            );
            return json_encode($this->response);
            exit;
        }
        $infos = $this->getadvice($id);
        $this->response = array(
            "msg" => "1",
            "data" => $infos
        );
        return json_encode($this->response);
        exit;
    }

    private function _getprojectpaymentadvice($padviceproject)
    {
        $this->sql = "SELECT *,
                            pj.project_no,
                            pj.project_name,
                            pj.project_cname,
                            pj.project_location,
                            pj.Sales_Representative,
                            pj.projectRegion 
                        from pms_ponew_paymentadvice as pa
                        inner join pms_ponew as po 
                        on pa.ponewid = po.ponewid 
                        inner join pms_project_summary as pj 
                        on po.ponewproject = pj.project_id 
                        inner join pms_glass_suppliers as sp 
                        on po.ponewsupplier = sp.glasssupplierid 
                     where padviceproject = :padviceproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":padviceproject", $padviceproject);
        $this->cm->execute();
        $poadvices = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $poadvice = $this->pms_ponew_paymentadvice($rows);
            $poadvice["ponewid"] = $rows['ponewid'];
            $poadvice["ponewrefno"] = $rows['ponewrefno'];
            $poadvice["ponewsupplier"] = $rows['ponewsupplier'];
            $poadvice["ponewfrom"] = $rows['ponewfrom'];
            $poadvice["ponewsubject"] = $rows['ponewsubject'];
            $poadvice["ponewvat"] = $rows['ponewvat'];
            $poadvice["ponewtotval"] = $rows['ponewtotval'];
            $poadvice["ponewtype"] = $rows['ponewtype'];
            $poadvice["ponewproject"] = $rows['ponewproject'];
            $poadvice["ponewcby"] = $rows['ponewcby'];
            $poadvice["poneweby"] = $rows['poneweby'];
            $poadvice["ponewcdate"] = date_format(date_create($rows['ponewcdate']), 'd-M-Y H:i:s');
            $poadvice["ponewedate"] = date_format(date_create($rows['ponewedate']), 'd-M-Y H:i:s');
            $poadvice["ponewpostflag"] = $rows['ponewpostflag'];
            $poadvice["ponewdate"] = date_format(date_create($rows['ponewdate']), 'Y-m-d');
            $poadvice["ponewdate_d"] = date_format(date_create($rows['ponewdate']), 'd-M-Y');
            $poadvice["ponewdate_n"] = date_format(date_create($rows['ponewdate']), 'd-m-Y');
            $poadvice["ponewdate_p"] = date_format(date_create($rows['ponewdate']), 'd-m-y');
            $poadvice["project_no"] = $this->enc('denc', $rows['project_no']);
            $poadvice["project_no_enc"] = $rows['project_no'];
            $poadvice["project_name"] = $this->enc('denc', $rows['project_name']);
            $poadvice["project_cname"] = $this->enc('denc', $rows['project_cname']);
            $poadvice["project_location"] = $this->enc('denc', $rows['project_location']);
            $poadvice["Sales_Representative"] = $this->enc('denc', $rows['Sales_Representative']);
            $poadvice["projectRegion"] = $this->enc('denc', $rows['projectRegion']);
            $poadvice["glasssupplierid"] = $rows['glasssupplierid'];
            $poadvice["glasssuppliername"] = $rows['glasssuppliername'];
            $poadvice["glasssuppliercountry"] = $rows['glasssuppliercountry'];
            $poadvice["suppliercontact"] = $rows['suppliercontact'];
            $poadvice["supplieraddress"] = $rows['supplieraddress'];
            $poadvice["supplieremail"] = $rows['supplieremail'];
            $poadvice["supplierphone"] = $rows['supplierphone'];
            $poadvice["supplierfax"] = $rows['supplierfax'];
            $poadvices[] = $poadvice;
        }
        unset($this->cm, $this->sql, $rows);
        return $poadvices;
    }

    public function paymentadvicebyproject($padviceproject)
    {
        $advices = $this->_getprojectpaymentadvice($padviceproject);
        $this->response = array(
            "msg" => "1",
            "data" => $advices
        );
        return json_encode($this->response);
        exit;
    }
}
