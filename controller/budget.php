<?php
require_once 'budget_po.php';
class Budget extends BudgetPO
{
    function __construct($db)
    {
        $this->cn = $db;
    }
    private function _projectmaterialbudgetSummary($project_id)
    {
        $this->sql = "SELECT bmtype,bmproject,sum(bmdiscountval) as dis from pms_budget_materials where bmproject = :bmproject  group by bmtype,bmproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bmproject", $project_id);
        $this->cm->execute();
        $budgets = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $budget = array(
                "bmmaterialtype" => $rows['bmtype'],
                "bmproject" => $rows['bmproject'],
                "val" => $rows["dis"]
            );
            $budgets[] = $budget;
        }
        unset($this->cm, $this->sql, $rows);
        return $budgets;
    }

    private function _projectglassbudgetsummary($project_id)
    {
        $this->sql = "SELECT SUM(bgtotalcost) as tot,sum(bgshapedtotalcost) as stot from pms_budget_glass where bgprojectid = :bgprojectid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bgprojectid", $project_id);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $tot = (float)$rows['tot'];
        $stot = (float)$rows['stot'];
        $gtot = $tot + $stot;
        unset($this->sql, $this->cm, $rows);
        return $gtot;
    }

    private function _budgetsummaryproject($project_id)
    {
        $material = $this->_projectmaterialbudgetSummary($project_id);
        $gtot = $this->_projectglassbudgetsummary($project_id);

        $material[] = array(
            "bmmaterialtype" => 'Glass',
            "bmproject" => $project_id,
            "val" => $gtot
        );
        $budgets = [];
        //print_r($material);
        foreach ($material as $m) {
            $mtype = $m['bmmaterialtype'];
            //echo $mtype;
            $this->sql = "SELECT round(COALESCE(sum(ponewtotval),0),2) as tp FROM pms_ponew where ponewproject = :ponewproject and ponewtype = :ponewtype";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":ponewproject", $project_id);
            $this->cm->bindParam(":ponewtype", $mtype);
            $this->cm->execute();
            $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            $bal = (float)$m['val'] - (float)$rows['tp'];
            $budgets[] = array(
                'materialtype' => $mtype,
                'budgetval' => $m['val'],
                'po' => $rows['tp'],
                'bal' => $bal
            );
            unset($this->cm, $this->sql, $rows);
        }

        return $budgets;
    }

    public function budgetsummaryproject($project_id)
    {
        $budgets = $this->_budgetsummaryproject($project_id);
        $this->response = array(
            "msg" => "1",
            "data" => $budgets
        );
        return json_encode($this->response);
        exit;
    }

    private function budgetsummaryrows($rows)
    {
        extract($rows);
        // print_r($rows);
        $cols = [];
        $cols['project_id'] = $project_id;
        $cols['project_no_enc'] = $project_no;
        $cols['project_no'] = $this->enc('denc', $project_no);
        $cols['project_name'] = ucwords(strtolower($this->enc('denc', $project_name)));
        $cols['project_cname'] =  ucwords(strtolower($this->enc('denc', $project_cname)));
        $cols['Sales_Representative'] = ucwords(strtolower($this->enc('denc', $Sales_Representative)));
        $cols['projectRegion'] = ucwords(strtolower($this->enc('denc', $projectRegion)));
        $cols['project_type'] = ucwords(strtolower($this->enc('denc', $project_type)));
        $cols['materialtotal'] = is_null($materialtotal) ? 0 :  $materialtotal;
        $cols['glasstotal'] = is_null($glasstotal) ? 0 :  $glasstotal;
        $cols['glassshapedtotal'] = is_null($glassshapedtotal) ? 0 :  $glassshapedtotal;
        $gtot = (float)$cols['glasstotal'] + (float)$cols['glassshapedtotal'];
        $totbudget = (float)$cols['materialtotal'] + $gtot;
        $cols['totbudget'] = $totbudget;
        $cols['gtot'] = $gtot;
        $cols['poamount'] = is_null($poamount) ? 0 : $poamount;
        $balancebudget = (float)$totbudget - (float)$cols['poamount'];
        $cols['balancebudget'] = $balancebudget;
        $cols['pomtotal'] = is_null($pomtotal) ? 0 : $pomtotal;
        $mbalance = (float)$cols['materialtotal'] - (float)$cols['pomtotal'];
        $cols['mbalance'] = $mbalance;
        $cols['pogtotal'] = is_null($pogtotal) ? 0 : $pogtotal;
        $gbalance = (float)$gtot - (float)$cols['pogtotal'];
        $cols['gbalance'] = $gbalance;
        return $cols;
    }
    public function budgetAllporject()
    {
        $this->sql = "SELECT *,
            mat.material as materialtotal,
            glass.gt as glasstotal,
            glass.gst as glassshapedtotal,
            po.p_totamount as poamount,
            pom.pm_totamount as pomtotal,
            pog.pg_totamount as pogtotal 
            from pms_project_summary as pj right join (
            select bmproject,sum(bmdiscountval) as material from pms_budget_materials group by bmproject
        ) as mat on pj.project_id = mat.bmproject left join (
            select bgprojectid,sum(bgtotalcost) as gt,sum(bgshapedtotalcost) as gst from pms_budget_glass group by bgprojectid
        ) as glass on pj.project_id = glass.bgprojectid 
        left join 
        ( select ponewproject,sum(ponewtotval) as p_totamount from pms_ponew group by ponewproject) as po on pj.project_id = po.ponewproject 
        left join 
        ( select ponewproject,sum(ponewtotval) as pm_totamount from pms_ponew where ponewtype <> 'Glass' group by ponewproject) as pom on pj.project_id = pom.ponewproject 
        left join 
        ( select ponewproject,sum(ponewtotval) as pg_totamount from pms_ponew where ponewtype = 'Glass' group by ponewproject) as pog on pj.project_id = pog.ponewproject 
        ";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $budgets = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $budget = $this->budgetsummaryrows($rows);
            $budgets[] = $budget;
        }

        $this->response = array(
            "msg" => "1",
            "data" => $budgets
        );
        return json_encode($this->response);
        exit;
    }
    // --query for get summary
    // SELECT mb.bmmaterialtype, mb.budgetval, po.poval, mb.bmproject
    // FROM (

    // SELECT bmmaterialtype, bmproject, SUM( bmdiscountval ) AS budgetval
    // FROM pms_budget_materials
    // GROUP BY bmmaterialtype, bmproject
    // ) AS mb
    // LEFT JOIN (

    // SELECT ponewtype, ponewproject, SUM( ponewtotval ) AS poval
    // FROM pms_ponew
    // GROUP BY ponewtype, ponewproject
    // ) AS po ON po.ponewtype = mb.bmmaterialtype
    // AND mb.bmproject = po.ponewproject
    // --query for get summary

    // private function _projectmaterialbudgetSummaryo($project_id)
    // {
    //     $this->sql = "SELECT bmmaterialtype,bmproject,sum(bmdiscountval) as dis FROM pms_budget_materials as bm left join (
    //             SELECT ponewtype,ponewproject,sum(ponewtotval) as poval from pms_ponew group by ponewtype,ponewproject
    //         ) as po on bm.bmproject = po.ponewproject and bm.bmmaterialtype = po.ponewtype where bm.bmproject=:poproject group by bm.bmmaterialtype,bm.bmproject";
    //     //echo $this->sql;
    //     $this->cm = $this->cn->prepare($this->sql);
    //     $this->cm->bindParam(":poproject", $project_id);
    //     $this->cm->execute();
    //     $mbudget = [];
    //     while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
    //         extract($rows);
    //         $x = array(
    //             'bmmaterialtype' => $bmmaterialtype,
    //             'bmdiscountval' => $dis,
    //             'poval' => is_null($poval) || $poval === null || $poval === 'null' ? '0' : $poval,
    //         );
    //         $mbudget[] = $x;
    //     }
    //     unset($this->sql, $this->cm, $rows);
    //     return $mbudget;
    // }



    // private function _projectglassbudgetsummaryx($project_id)
    // {
    //     $this->sql = "SELECT SUM(bgtotalcost) as tot,sum(bgshapedtotalcost) as stot from pms_budget_glass where bgprojectid = :bgprojectid";
    //     $this->cm = $this->cn->prepare($this->sql);
    //     $this->cm->bindParam(":bgprojectid", $project_id);
    //     $this->cm->execute();
    //     $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
    //     $tot = (float)$rows['tot'];
    //     $stot = (float)$rows['stot'];
    //     $gtot = $tot + $stot;

    //     unset($this->sql, $this->cm, $rows);

    //     $this->sql = "SELECT COALESCE(SUM(povalue),0) as potot from pms_po where poproject = :poproject and itemtype = 'Glass'";
    //     $this->cm = $this->cn->prepare($this->sql);
    //     $this->cm->bindParam(":poproject", $project_id);
    //     $this->cm->execute();
    //     $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
    //     $po = (float)$rows['potot'];

    //     $res = array(
    //         'bmmaterialtype' => "Glass",
    //         'bmdiscountval' => $gtot,
    //         'poval' => $po
    //     );

    //     unset($this->sql, $this->cm, $rows);

    //     return $res;
    // }



    // public function budgetsummaryproject($project_id)
    // {
    //     $mbudget = $this->_projectmaterialbudgetSummary($project_id);
    //     $gbudget = $this->_projectglassbudgetsummary($project_id);
    //     $data = array(
    //         "mbudget" => $mbudget,
    //         "gbudget" => $gbudget
    //     );
    //     $this->response = array(
    //         "msg" => "1",
    //         "data" => $data
    //     );
    //     return json_encode($this->response);
    //     exit;
    // }


    private function materialbudget($bmproject)
    {
        $this->sql = "SELECT bmtype,bmqty,bmeprice,bmeval,bmdiscountprice,bmdiscountval FROM pms_budget_materials where bmproject = :bmproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bmproject", $bmproject);
        $this->cm->execute();
        $budget = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $dt = array(
                "bmtype" => $bmtype,
                "bmqty" => $bmqty,
                "bmeprice" => $bmeprice,
                "bmeval" => $bmeval,
                "bmdiscountprice" => $bmdiscountprice,
                "bmdiscountval" => $bmdiscountval,
            );
            $budget[] = $dt;
        }
        unset($this->cm, $this->sql, $rows);
        return $budget;
    }

    private function glassbudget($bgprojectid)
    {
        $this->sql = "SELECT sum(bgarea) as totarea, sum(bgshapedarea) as totshapearea,sum(bgtotalcost) as totcost,sum(bgshapedtotalcost) as shaptotalcost from pms_budget_glass where bgprojectid = :bgprojectid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bgprojectid", $bgprojectid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $totcost = is_null($rows['totcost']) ? 0 : (float)$rows['totcost'];
        $shaptotalcost = is_null($rows['shaptotalcost']) ? 0 : (float)$rows['shaptotalcost'];

        $totarea = is_null($rows['totarea']) ? 0 : (float)$rows['totarea'];
        $totshapearea = is_null($rows['totshapearea']) ? 0 : (float)$rows['totshapearea'];

        $sumofarea = $totarea + $totshapearea;
        $sumofamount = $totcost +  $shaptotalcost;

        $mat = array(
            "bmqty" => $sumofarea,
            "bmdiscountval" => $sumofamount
        );

        unset($this->sql, $rows, $this->cm);
        return $mat;
    }
    public function projectsbudgetsummary($pjcno)
    {
        $budgetsummary = $this->materialbudget($pjcno);
        $glassummary = $this->glassbudget($pjcno);
        $rpt = $budgetsummary;
        $glass = array(
            "bmtype" => "Glass",
            "bmqty" => $glassummary['bmqty'],
            "bmeprice" => "0",
            "bmeval" => $glassummary['bmdiscountval'],
            "bmdiscountprice" => "0",
            "bmdiscountval" => $glassummary['bmdiscountval'],
        );

        $rpt[] = $glass;

        $this->response = array(
            "msg" => '1',
            "data" => $rpt
        );
        return json_encode($this->response);
        exit;
        //$this->sql = "SELECT *FROM "
    }

    private function _budgetMaterials($bmproject)
    {
        $this->sql = "SELECT bmtype FROM pms_budget_materials where bmproject = :bmproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":bmproject", $bmproject);
        $this->cm->execute();
        $materials = array();
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $materials[] = $rows['bmtype'];
        }
        unset($this->sql, $this->cm, $rows);
        return $materials;
    }
    public function  budgematerials($bmproject)
    {
        $materials = $this->_budgetMaterials($bmproject);
        $this->response = array(
            "msg" => "1",
            "data" => $materials
        );

        return json_encode($this->response);
        exit;
    }

    public function getposummaryforallproject()
    {
        $this->sql = "SELECT *,
        pom.pomval as glasstotal,
        pos.posval as materialtotal
        FROM pms_project_summary as pj right join 
        (
            select ponewproject,sum(ponewtotval) as pomval from pms_ponew where ponewtype='Glass' group by ponewproject
        ) as pom on pj.project_id = pom.ponewproject  left join 
        (
        select ponewproject,sum(ponewtotval) as posval from pms_ponew where ponewtype<>'Glass' group by ponewproject
        ) as pos on pj.project_id = pos.ponewproject ";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $cols['project_id'] = $project_id;
            $cols['project_no_enc'] = $project_no;
            $cols['project_no'] = $this->enc('denc', $project_no);
            $cols['project_name'] = ucwords(strtolower($this->enc('denc', $project_name)));
            $cols['project_cname'] =  ucwords(strtolower($this->enc('denc', $project_cname)));
            $cols['Sales_Representative'] = ucwords(strtolower($this->enc('denc', $Sales_Representative)));
            $cols['projectRegion'] = ucwords(strtolower($this->enc('denc', $projectRegion)));
            $cols['project_type'] = ucwords(strtolower($this->enc('denc', $project_type)));
            $cols['materialtotal'] = is_null($materialtotal) ? 0 :  $materialtotal;
            $cols['glasstotal'] = is_null($glasstotal) ? 0 :  $glasstotal;
            $totalpo = (float)$cols['glasstotal'] + (float)$cols['materialtotal'];
            $cols['totalpo'] = $totalpo;
            $rpts[] = $cols;
        }
        unset($this->cm, $this->sql, $rows);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );

        return json_encode($this->response);
        exit;
    }

    public function supplierwiseposummary()
    {
        $this->sql = "";
        $this->sql = "SELECT *,
           pom.pomval as glasstotal,
        pos.posval as materialtotal
        FROM pms_glass_suppliers sp right join 
        (
            select ponewsupplier,sum(ponewtotval) as pomval from pms_ponew where ponewtype='Glass' group by ponewsupplier
        ) as pom on sp.glasssupplierid = pom.ponewsupplier  left join 
        (
        select ponewsupplier,sum(ponewtotval) as posval from pms_ponew where ponewtype<>'Glass' group by ponewsupplier
        ) as pos on sp.glasssupplierid = pos.ponewsupplier 
        ";
        $this->cm = "";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        $rows = "";
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $cols['glasssupplierid'] = !isset($glasssupplierid) || trim($glasssupplierid) === "" ? "0" : $glasssupplierid;
            $cols['glasssuppliername'] = !isset($glasssuppliername) || trim($glasssuppliername) === "" ? "0" : ucwords(strtolower($glasssuppliername));
            $cols['glasssuppliercountry'] = !isset($glasssuppliercountry) || trim($glasssuppliercountry) === "" ? "0" : ucwords(strtolower($glasssuppliercountry));
            $cols['suppliercontact'] = !isset($suppliercontact) || trim($suppliercontact) === "" ? "0" : $suppliercontact;
            $cols['supplieraddress'] = !isset($supplieraddress) || trim($supplieraddress) === "" ? "0" : $supplieraddress;
            $cols['supplieremail'] = !isset($supplieremail) || trim($supplieremail) === "" ? "0" : $supplieremail;
            $cols['supplierphone'] = !isset($supplierphone) || trim($supplierphone) === "" ? "0" : $supplierphone;
            $cols['supplierfax'] = !isset($supplierfax) || trim($supplierfax) === "" ? "0" : $supplierfax;
            $cols['materialtotal'] = is_null($materialtotal) ? 0 :  $materialtotal;
            $cols['glasstotal'] = is_null($glasstotal) ? 0 :  $glasstotal;
            $totalpo = (float)$cols['glasstotal'] + (float)$cols['materialtotal'];
            $cols['totalpo'] = $totalpo;
            $rpts[] = $cols;
        }
        //unset($this->cm,$this->sql,$rows);
        $this->response = array(
            "msg" => '1',
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }
}
