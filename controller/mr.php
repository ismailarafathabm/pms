<?php
include_once 'mac.php';
class MR extends mac
{
    private $cn;
    private $cm;
    private $sql;
    private $response = [];

    function __construct($db)
    {
        $this->cn = $db;
    }

    //auto compeate 

    private function _itemautocompleate()
    {
        $this->sql = "SELECT mritem from pms_materials_materialrequest group by mritem";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $items = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $rows['mritem'];
        }
        unset($this->sql, $this->cm, $rows);
        return $items;
    }
    private function _itemnoautocompleate()
    {
        $this->sql = "SELECT mrpartno FROM pms_materials_materialrequest group by mrpartno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $partnos = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $partnos[] = $rows['mrpartno'];
        }
        unset($this->sql, $this->cm, $rows);
        return $partnos;
    }
    private function _itemnotaiseerautocompleate()
    {
        $this->sql = "SELECT mrpartnotai FROM pms_materials_materialrequest group by mrpartnotai";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $mrpartnotais = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $mrpartnotais[] = $rows['mrpartnotai'];
        }
        unset($this->sql, $this->cm, $rows);
        return $mrpartnotais;
    }
    private function _finishautocompleate()
    {
        $this->sql = "SELECT mrfinish FROM pms_materials_materialrequest group by mrfinish";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $finshlist = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $finshlist[] = $rows['mrfinish'];
        }
        unset($this->sql, $this->cm, $rows);
        return $finshlist;
    }


    public function Autocompleate()
    {
        $items = self::_itemautocompleate();
        $itemnos = self::_itemnoautocompleate();
        $itemalthaiseer = self::_itemnotaiseerautocompleate();
        $finish = self::_finishautocompleate();

        $datas = array(
            "items" => $items,
            "itemnos" => $itemnos,
            "itemalthaiseer" => $itemalthaiseer,
            "finish" => $finish,
        );

        $this->response = array(
            "msg" => "1",
            "data" => $datas
        );

        return json_encode($this->response);
        exit;
    }
    //get boq items for projects

    private function _getProjectBoq($poq_project_code)
    {
        $this->sql = "SELECT boq.poq_id,
                                    boq.poq_item_no,
                                    boq.poq_item_type,
                                    boq.poq_project_code,                                    
                                    ptype.ptype_name,                                    
                                    ftype.finish_name 
            FROM pms_poq as boq 
            inner join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
            inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id   
            where boq.poq_project_code = :poq_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_project_code", $poq_project_code);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $rpt = array(
                "poq_id" => $poq_id,
                "poq_item_no" => self::enc('denc', $poq_item_no),
                "poq_item_type" => $poq_item_type,
                "poq_project_code" => self::enc('denc', $poq_project_code),
                "ptype_name" => self::enc('denc', $ptype_name),
                "finish_name" => self::enc('denc', $finish_name)
            );
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function GetProjectBoq($poq_project_code)
    {
        $rpts = self::_getProjectBoq($poq_project_code);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _getBoqInfo($boqid)
    {
        $this->sql = "SELECT *
                            FROM pms_poq as boq 
                            inner join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id
                            inner join pms_systemtype as stype on boq.poq_system_type = stype.system_type_id 
                            inner join pms_finish as ftype on boq.poq_finish = ftype.finish_id   
                            inner join pms_units as utype on boq.poq_unit = utype.uint_id 
                            where poq_id = :poq_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":poq_id", $boqid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        extract($rows);
        $tot = (float) self::enc('denc', $poq_qty) * (float) self::enc('denc', $poq_uprice);
        //$_total += (float) $tot;
        $area  = ((float) self::enc('denc', $poq_item_width)/1000) * ((float) self::enc('denc', $poq_item_height)/1000);
        $totalarea = (float) self::enc('denc', $poq_qty) * $area ;
        $boq = array(
            'poq_id' => $poq_id,
            'poq_item_no' => self::enc('denc', $poq_item_no),
            'poq_item_type' => $poq_item_type,
            'poq_item_remark' => self::enc('denc', $poq_item_remark),
            'poq_item_width' => (string)((float)self::enc('denc', $poq_item_width)/1000),
            'poq_item_height' => (string)((float)self::enc('denc', $poq_item_height)/1000),
            'poq_item_glass_spec' => self::enc('denc', $poq_item_glass_spec),
            'poq_item_glass_single' => self::enc('denc', $poq_item_glass_single),
            'poq_item_glass_double1' => self::enc('denc', $poq_item_glass_double1),
            'poq_item_glass_double2' => self::enc('denc', $poq_item_glass_double2),
            'poq_item_glass_double3' => self::enc('denc', $poq_item_glass_double3),
            'poq_item_glass_laminate1' => self::enc('denc', $poq_item_glass_laminate1),
            'poq_item_glass_laminate2' => self::enc('denc', $poq_item_glass_laminate2),
            'poq_drawing' => self::enc('denc', $poq_drawing),
            'poq_finish' => $poq_finish,
            'poq_system_type' => $poq_system_type,
            'poq_qty' => self::enc('denc', $poq_qty),
            'poq_unit' => $poq_unit,
            'poq_uprice' => self::enc('denc', $poq_uprice),
            'poq_remark' => self::enc('denc', $poq_remark),
            'poq_cby' => self::enc('denc', $poq_cby),
            'poq_eby' => self::enc('denc', $poq_eby),
            'poq_Cdate' => self::enc('denc', $poq_Cdate),
            'poq_Edate' => self::enc('denc', $poq_Edate),
            'poq_project_code' => self::enc('denc', $poq_project_code),
            'poq_status' => self::enc('denc', $poq_status),
            'unit_name' => self::enc('denc', $unit_name),
            'ptype_name' => self::enc('denc', $ptype_name),
            'system_type_name' => self::enc('denc', $system_type_name),
            'finish_name' => self::enc('denc', $finish_name),
            'tot' => (string)$tot,
            'area' => (string)$area,
            "item_aras" => self::enc('denc', $boq_area),
            "totalarea" => (string)$totalarea,
        );

        unset($this->cm, $this->sql, $rows);
        return $boq;
    }

    private function _getBoqnotes($params)
    {
        $this->sql = "SELECT *FROM pms_boq_notes 
                        where boq_note_project = :boq_note_project 
                        and boq_note_itemno = :boq_note_itemno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $notes = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $notes[] = array(
                'boq_note_id' => $boq_note_id,
                'boq_note_project' => self::enc('denc', $boq_note_project),
                'boq_note_itemno' => self::enc('denc', $boq_note_itemno),
                'boq_note_notes' => self::enc('denc', $boq_note_notes),
            );
        }

        unset($this->cm, $this->sql, $rows);
        return $notes;
    }

    public function getBoqInfo($boqid)
    {
        $boq = self::_getBoqInfo($boqid);
        $params = array(
            "boq_note_project" => self::enc('enc', $boq['poq_project_code']),
            "boq_note_itemno" => self::enc('enc', $boq['poq_item_no']),
        );
        $notes = self::_getBoqnotes($params);
        $data = array(
            "boq" => $boq,
            "notes" => $notes
        );

        $this->response = array(
            "msg" => "1",
            "data" => $data,
        );
        return json_encode($this->response);
        exit;
    }


    // material request actions

    // material request columns 
    private function _prepareby($pp)
    {
    }
    private function pms_materials_materialrequest($rows)
    {
        extract($rows);
        $cols = [];
        $cols['mrid']  = $mrid;
        $cols['mrproject']  = $mrproject;
        $cols['mrcode']  = $mrcode;
        $cols['mrno']  = $mrno;
        $cols['mrdate']  = $mrdate;
        $cols['mrdates']  = self::_datef($mrdate);
        $cols['mritem']  = $mritem;
        $cols['mrpartno']  = $mrpartno;
        $cols['mrpartnotai']  = $mrpartnotai;
        $cols['mrdieweight']  = $mrdieweight;
        $cols['mrreqlength']  = $mrreqlength;
        $cols['mrreqqty']  = $mrreqqty;
        $cols['mrreqtotweight']  = $mrreqtotweight;
        $cols['mrreqtotweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrreqqty) / 1000;
        $cols['mrboqno']  = $mrboqno;
        $cols['mravaiqty']  = $mravaiqty;
        $cols['mraviweight']  = $mraviweight;
        $cols['mraviweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mravaiqty) / 1000;
        $cols['mrorderedqty']  = $mrorderedqty;
        $cols['mrorderedweight']  = $mrorderedweight;
        $cols['mrorderedweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrorderedqty) / 1000;
        $cols['mrcby']  = $mrcby;
        $cols['mreby']  = $mreby;
        $cols['mrcdate']  = $mrcdate;
        $cols['mredate']  = $mredate;
        $cols['mrfinish']  = $mrfinish;
        $cols['mrremarks']  = $mrremarks;
        $cols['mrcheckedby']  = $mrcheckedby;
        $cols['mrapprovedby']  = $mrapprovedby;
        $cols['releaseddate'] = $releaseddate;
        $cols['releaseddates'] = self::_datef($releaseddate);
        $cols['mrunit'] = $mrunit;
        $cols['preparedby'] = $preparedby === '' || $preparedby === '-' ? 'JOHN' : strtoupper($preparedby);
        $cols['mrflags'] = $mrflags;

        $cols['mrp_orderno'] = $mrp_orderno;
        $cols['mrp_supplier'] = $mrp_supplier;
        $cols['mrp_okdate'] = $mrp_okdate;
        $cols['mrp_okdate_d'] = self::datemethod($mrp_okdate);
        $cols['mrp_eta'] = $mrp_eta;
        $cols['mrp_system'] = $mrp_system;
        $cols['mrp_datereceive'] = $mrp_datereceive;
        $cols['mrp_datereceived'] = self::datemethod($mrp_datereceive);
        $cols['mrp_totorder'] = $mrp_totorder;
        $cols['mrp_status'] = $mrp_status;
        $cols['unitcost'] = $unitcost;
        $cols['totalcost'] = $totalcost;
        $cols['costby'] = $costby;

        $cols['totalweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrp_totorder) / 1000;
        return $cols;
    }
    private function _getmrprint($params)
    {
        $this->sql = "SELECT 
            mr.mrproject,
            mr.mrcode,
            mr.mrno,
            mr.mrdate,       
            mr.mrcheckedby,
            mr.mrapprovedby, 
            mr.releaseddate,
            mr.preparedby,
            mr.mrflags,
            pj.project_no,
            pj.project_name,
            pj.project_location,
            pj.Sales_Representative,
            pj.project_status             
            FROM pms_materials_materialrequest as mr inner join pms_project_summary as pj on mr.mrproject = pj.project_id  where 
            mr.mrproject = :mrproject and mr.mrcode = :mrcode and mr.mrno = :mrno limit 1";


        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        //echo $this->cm->rowCount();
        extract($rows);
        $rpt = array(
            'mrproject'  => $mrproject,
            'mrcode' => $mrcode,
            'mrno'  => $mrno,
            'mrdate'  => $mrdate,
            'mrdates'  => self::_datef($mrdate),
            'mrcheckedby' => $mrcheckedby,
            'mrapprovedby' => $mrapprovedby,
            'releaseddate' => $releaseddate,
            'releaseddates' => self::_datef($releaseddate),
            'preparedby' => $preparedby,
            'mrflags' => $mrflags,
            'project_no_enc' => $project_no,
            'project_no' => self::enc('denc', $project_no),
            'project_name' => self::enc('denc', $project_name),
            'project_location' => self::enc('denc', $project_location),
            'Sales_Representative' => self::enc('denc', $Sales_Representative),
            'project_status' => self::enc('denc', $project_status),
        );

        unset($this->cm, $this->sql, $rows);
        return $rpt;
    }

    private function _getmrprintdt($params)
    {
        $this->sql = "SELECT *,boq.poq_item_no,
            boq.poq_item_type,
            boq.poq_item_remark,
            boq.poq_item_width,
            boq.poq_item_height,
            boq.poq_finish,
            ptype.ptype_name  
            FROM pms_materials_materialrequest as mr 
            left join pms_poq as boq on mr.mrboqno = boq.poq_id 
            left join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
             where 
            mr.mrproject = :mrproject and mr.mrcode = :mrcode and mr.mrno = :mrno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute($params);
        //echo $this->cm->rowCount();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpt['poq_item_no'] = self::enc('denc', $rows['poq_item_no']);
            $rpt['ptype_name'] = self::enc('denc', $rows['ptype_name']);
            $rpt['poq_item_remark'] = self::enc('denc', $rows['poq_item_remark']);
            $rpt['poq_item_width'] = self::enc('denc', $rows['poq_item_width']);
            $rpt['poq_item_height'] = self::enc('denc', $rows['poq_item_height']);
            $rpt['poq_finish'] = self::enc('denc', $rows['poq_finish']);
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function Getmrinfos($params)
    {
        $mrinfo = self::_getmrprint($params);
        $mrdetails = self::_getmrprintdt($params);
        $mr = array(
            "infos" =>  $mrinfo,
            "dt" =>  $mrdetails,
        );
        $this->response = array(
            "msg" => "1",
            "data" => $mr,
        );
        return json_encode($this->response);
        exit;
    }
    // get project mr
    private function _getprojectmr($mrproject)
    {
        $this->sql = "SELECT *,
            boq.poq_item_no,
            boq.poq_item_type,
            boq.poq_item_remark,
            boq.poq_item_width,
            boq.poq_item_height,
            boq.poq_finish,
            ptype.ptype_name 
            FROM pms_materials_materialrequest as mr 
            left join pms_poq as boq on mr.mrboqno = boq.poq_id 
            left join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
            where 
            mr.mrproject = :mrproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $mrproject);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpt['poq_item_no'] = is_null($rows['poq_item_no']) ? '0' : self::enc('denc', $rows['poq_item_no']);
            $rpt['poq_item_type'] = is_null($rows['poq_item_type']) ? 'Miscellaneous' : self::enc('denc', $rows['ptype_name']);
            $rpt['poq_item_remark'] = self::enc('denc', $rows['poq_item_remark']);
            $rpt['poq_item_width'] = self::enc('denc', $rows['poq_item_width']);
            $rpt['poq_item_height'] = self::enc('denc', $rows['poq_item_height']);
            $rpt['poq_finish'] = is_null(self::enc('denc', $rows['poq_finish']));
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        ///print_r($rpts);
        return $rpts;
    }

    //rpt mr


    private function _mrrpt()
    {
        $this->sql = "SELECT *,
            boq.poq_item_no,
            boq.poq_item_type,
            boq.poq_item_remark,
            boq.poq_item_width,
            boq.poq_item_height,
            boq.poq_finish,
            ptype.ptype_name,
            pj.project_id,
            pj.project_no,
            pj.project_name,
            pj.project_cname,
            pj.project_location,
            pj.Sales_Representative,
            pj.project_status,
            pj.projectRegion,
            pj.project_type 
            FROM pms_materials_materialrequest as mr 
            left join pms_poq as boq on mr.mrboqno = boq.poq_id 
            left join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
            left join pms_project_summary as pj on 
            mr.mrproject = pj.project_id";


        $this->cm = $this->cn->prepare($this->sql);

        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpt['poq_item_no'] = is_null($rows['poq_item_no']) ? '0' : self::enc('denc', $rows['poq_item_no']);
            $rpt['poq_item_type'] = is_null($rows['poq_item_type']) ? 'Miscellaneous' : self::enc('denc', $rows['ptype_name']);
            $rpt['poq_item_remark'] = self::enc('denc', $rows['poq_item_remark']);
            $rpt['poq_item_width'] = self::enc('denc', $rows['poq_item_width']);
            $rpt['poq_item_height'] = self::enc('denc', $rows['poq_item_height']);
            $rpt['poq_finish'] = is_null(self::enc('denc', $rows['poq_finish']));
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = self::enc('denc', $rows['project_no']);
            $rpt['project_name'] = self::enc('denc', $rows['project_name']);
            $rpt['project_cname'] = self::enc('denc', $rows['project_cname']);
            $rpt['project_location'] = self::enc('denc', $rows['project_location']);
            $rpt['Sales_Representative'] = self::enc('denc', $rows['Sales_Representative']);
            $rpt['project_status'] = self::enc('denc', $rows['project_status']);
            $rpt['projectRegion'] = self::enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = self::enc('denc', $rows['project_type']);
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        ///print_r($rpts);
        return $rpts;
    }

    public function mrrpt()
    {
        $rpts = self::_mrrpt();
        return json_encode(array("msg" => '1', "data" => $rpts));
        exit;
    }

    public function getProjectMR($mrproject)
    {
        $rpts = self::_getprojectmr($mrproject);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts,
        );
        return json_encode($this->response);
        exit;
    }
    //Insert new mr
    private function _savemr($save)
    {
        $xdate = date('Y-m-d');
        //print_r($save);
        $this->sql = "INSERT INTO pms_materials_materialrequest values(
                null,
                :mrproject,
                :mrcode,
                :mrno,
                :mrdate,                
                :mritem,
                :mrpartno,
                :mrpartnotai,
                :mrdieweight,
                :mrreqlength,
                :mrreqqty,
                :mrreqtotweight,
                :mrboqno,
                :mravaiqty,
                :mraviweight,
                :mrorderedqty,
                :mrorderedweight,
                :mrcby,
                :mreby,
                :mrcdate,
                :mredate,
                :mrfinish,
                :mrremarks,
                :mrcheckedby,
                :mrapprovedby,
                :releaseddate,
                :mrunit,
                :preparedby,
                'N',
                '-',
                '-',
                '$xdate',
                '-', 
                '-',
                '$xdate',
                '-',
                '-',
                '0',
                '0',
                'qty'
            )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($save);
        unset($this->cm, $this->sql);
        return $sv;
    }

    public function saveMr($params)
    {
        $sv  = true;
        $x = 1;
        $getparams = array(
            ":mrproject" => $params[0][":mrproject"],
            ":mrcode" => $params[0][":mrcode"],
            ":mrno" => $params[0][":mrno"],
        );
        foreach ($params as $save) {
            $sv = self::_savemr($save);
            if (!$sv) {
                break;
            }
        }
        //print_r($xdata);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error Has found Saving Data"
            );
            return json_encode($this->response);
            exit;
        }

        //print_r($getparams);
        $mrinfo = self::_getmrprint($getparams);
        $mrdetails = self::_getmrprintdt($getparams);
        $mr = array(
            "infos" =>  $mrinfo,
            "dt" =>  $mrdetails,
        );
        $this->response = array(
            "msg" => "1",
            "data" => $mr,
        );
        return json_encode($this->response);
        exit;
    }

    private function _getmrforboq($mrboqno)
    {
        $this->sql = "SELECT *FROM pms_materials_materialrequest where mrboqno = :mrboqno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrboqno", $mrboqno);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpts[] = $rpt;
        }
        return $rpts;
    }

    public function GetmrforBoq($mrboqno)
    {
        $rpts = self::_getmrforboq($mrboqno);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }



    private function getItemList($params)
    {
        $this->sql = "SELECT *FROM bom_items where 
            lower(itemdescription) like '$params%' or 
            LOWER(itempartno) like '$params%' or
            LOWER(itemalloy) like '$params%' or
            LOWER(itemdieweight) like '$params%' or
            LOWER(itemsystem) like '$params%' or
            LOWER(itempartfunction) like '$params%' order by itemdescription desc
            limit 50";
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $items = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = array(
                "itemid" => $rows['itemid'],
                "itemprofileno" => $rows['itemprofileno'],
                "itempartno" => $rows['itempartno'],
                "itemalloy" => $rows['itemalloy'],
                "itemfinish" => $rows['itemfinish'],
                "itemlength" => $rows['itemlength'],
                "itemunit" => $rows['itemunit'],
                "itemdieweight" => $rows['itemdieweight'],
                "itemsystem" => $rows['itemsystem'],
                "itemtype" => $rows['itemtype'],
                "itemdescription" => $rows['itemdescription'],
                "itempartfunction" => $rows['itempartfunction'],
            );

            $items[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $items;
    }

    public function GetAllItems($params)
    {
        $rpts = self::getItemList($params);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _mrTrash($id)
    {
        $this->sql = "INSERT INTO pms_materials_materialrequest_removed (                    
                    `mrid`,
                    `mrproject`,
                    `mrcode`,
                    `mrno`,
                    `mrdate`,
                    `mritem`,
                    `mrpartno`,
                    `mrpartnotai`,
                    `mrdieweight`,
                    `mrreqlength`,
                    `mrreqqty`,
                    `mrreqtotweight`,
                    `mrboqno`,
                    `mravaiqty`,
                    `mraviweight`,
                    `mrorderedqty`,
                    `mrorderedweight`,
                    `mrcby`,
                    `mreby`,
                    `mrcdate`,
                    `mredate`,
                    `mrfinish`,
                    `mrremarks`,
                    `mrcheckedby`,
                    `mrapprovedby`,
                    `releaseddate`,
                    `mrunit`,
                    `preparedby`

        )
            select *from pms_materials_materialrequest where mrid = :mrid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrid", $id);
        $this->cm->execute();
        unset($this->cm, $this->sql);
    }
    private function _removeMR($mrid)
    {
        $this->sql = "DELETE FROM pms_materials_materialrequest where mrid = :mrid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrid", $mrid);
        $rm = $this->cm->execute();
        unset($this->cm, $this->sql);
        return $rm;
    }
    public  function RemoveMr($mrid, $params)
    {
        //self::_mrTrash($mrid);
        $rm = self::_removeMR($mrid);
        if (!$rm) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Removeing Data"
            );
            return json_encode($this->response);
        }



        $mrinfo = self::_getmrprint($params);
        $mrdetails = self::_getmrprintdt($params);
        $mr = array(
            "infos" =>  $mrinfo,
            "dt" =>  $mrdetails,
        );
        $this->response = array(
            "msg" => "1",
            "data" => $mr,
        );
        return json_encode($this->response);
    }

    public function Savesinglemr($params)
    {
        $sv = self::_savemr($params);
        if (!$sv) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Save Data"
            );
            return json_encode($this->response);
            exit;
        }

        $getparams = array(
            ":mrproject" => $params[":mrproject"],
            ":mrcode" => $params[":mrcode"],
            ":mrno" => $params[":mrno"],
        );

        //print_r($getparams);

        $mrinfo = self::_getmrprint($getparams);
        $mrdetails = self::_getmrprintdt($getparams);
        $mr = array(
            "infos" =>  $mrinfo,
            "dt" =>  $mrdetails,
        );
        $this->response = array(
            "msg" => "1",
            "data" => $mr,
        );
        return json_encode($this->response);
        exit;
    }

    private function _getMiscellaneouseItems($mrproject)
    {
        $this->sql = "SELECT *FROM pms_materials_materialrequest where mrboqno = 0 and mrproject = :mrproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $mrproject);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $row = self::pms_materials_materialrequest($rows);
            $rpts[] = $row;
        }

        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    public function GetMiscellaneouseItems($mrproject)
    {
        $rpts = self::_getMiscellaneouseItems($mrproject);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );

        return json_encode($this->response);
        exit;
    }

    private function _countMiscellaeousItems($mrproject)
    {
        $this->sql = "SELECT COUNT(mrproject) as cnt from  pms_materials_materialrequest where mrboqno = 0 and mrproject = :mrproject";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $mrproject);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->cm, $this->sql, $rows);
        return $cnt;
    }

    public function countMiscellaeousItems($mrproject)
    {
        $cnt = self::_countMiscellaeousItems($mrproject);
        $this->response = array(
            "msg" => "1",
            "data" => $cnt
        );
        return json_encode($this->response);
        exit;
    }

    private function _postmr($project, $mrno, $post)
    {
        $this->sql = "UPDATE pms_materials_materialrequest  set mrflags='$post' 
        where 
        mrproject = :mrproject and mrno = :mrno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $project);
        $this->cm->bindParam(":mrno", $mrno);
        $sv = $this->cm->execute();
        unset($this->cm, $this->sql);
        return $sv;
    }

    private function _getmrinfox($project, $mrno)
    {
        $this->sql = "SELECT *,boq.poq_item_no,
            boq.poq_item_type,
            boq.poq_item_remark,
            boq.poq_item_width,
            boq.poq_item_height,
            boq.poq_finish,
            ptype.ptype_name  
            FROM pms_materials_materialrequest as mr 
            left join pms_poq as boq on mr.mrboqno = boq.poq_id 
            left join pms_ptype as ptype on boq.poq_item_type = ptype.ptype_id 
             where 
            mr.mrproject = :mrproject and mr.mrno = :mrno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $project);
        $this->cm->bindParam(":mrno", $mrno);
        $this->cm->execute();
        //echo $this->cm->rowCount();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpt['poq_item_no'] = self::enc('denc', $rows['poq_item_no']);
            $rpt['ptype_name'] = self::enc('denc', $rows['ptype_name']);
            $rpt['poq_item_remark'] = self::enc('denc', $rows['poq_item_remark']);
            $rpt['poq_item_width'] = self::enc('denc', $rows['poq_item_width']);
            $rpt['poq_item_height'] = self::enc('denc', $rows['poq_item_height']);
            $rpt['poq_finish'] = self::enc('denc', $rows['poq_finish']);
            $rpts[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $rpts;
    }

    private function _getmrprintx($project, $mrno)
    {
        $this->sql = "SELECT 
            mrproject,
            mrcode,
            mrno,
            mrdate,       
            mrcheckedby,
            mrapprovedby, 
            releaseddate,
            preparedby,
            mrflags 
            FROM pms_materials_materialrequest where 
            mrproject = :mrproject and mrno = :mrno limit 1";


        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $project);
        $this->cm->bindParam(":mrno", $mrno);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        //echo $this->cm->rowCount();
        extract($rows);
        $rpt = array(
            'mrproject'  => $mrproject,
            'mrcode' => $mrcode,
            'mrno'  => $mrno,
            'mrdate'  => $mrdate,
            'mrdates'  => self::_datef($mrdate),
            'mrcheckedby' => $mrcheckedby,
            'mrapprovedby' => $mrapprovedby,
            'releaseddate' => $releaseddate,
            'releaseddates' => self::_datef($releaseddate),
            'preparedby' => $preparedby,
            'mrflags' => $mrflags,
        );

        unset($this->cm, $this->sql, $rows);
        return $rpt;
    }
    //check before unpost

    public function MrPost($project, $mrno, $post)
    {
        $sv = self::_postmr($project, $mrno, $post);
        if (!$sv) {
            $this->response = array("msg" => '0', "data" => "Error on Posting MR");
            return json_encode($this->response);
            exit;
        }


        $mrinfo = self::_getmrinfox($project, $mrno);
        $mrdetails = self::_getmrprintx($project, $mrno);
        $mr = array(
            "infos" =>  $mrdetails,
            "dt" =>  $mrinfo,
        );
        $this->response = array("msg" => '1', "data" => $mr);
        return json_encode($this->response);
        exit;
    }

    private function _updateMR($updateinfo)
    {
        $this->sql = "UPDATE pms_materials_materialrequest set 
        mritem = :mritem,
        mrpartno = :mrpartno,
        mrpartnotai = :mrpartnotai,
        mrdieweight = :mrdieweight,
        mrreqlength = :mrreqlength,
        mrreqqty = :mrreqqty,
        mrreqtotweight = :mrreqtotweight,
        mravaiqty = :mravaiqty,
        mraviweight = :mraviweight,
        mrorderedqty = :mrorderedqty,
        mrorderedweight = :mrorderedweight,
        mreby = :mreby,
        mredate = :mredate,
        mrfinish = :mrfinish,
        mrremarks = :mrremarks,
        mrunit = :mrunit 
        where 
        mrid = :mrid";
        $this->cm = $this->cn->prepare($this->sql);
        $upd = $this->cm->execute($updateinfo);
        unset($this->sql, $this->cm, $rows);
        return $upd;
    }

    public function UpdateMR($updateinfo, $project, $mrno)
    {
        $update = self::_updateMR($updateinfo);
        if (!$update) {
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Update"
            );
            return json_encode($this->response);
            exit;
        }
        $mrinfo = self::_getmrinfox($project, $mrno);
        $mrdetails = self::_getmrprintx($project, $mrno);
        $mr = array(
            "infos" =>  $mrdetails,
            "dt" =>  $mrinfo,
        );
        $this->response = array("msg" => '1', "data" => $mr);
        return json_encode($this->response);
        exit;
    }

    //mr for procurement

    private function _getMrProcurement($mrproject, $mrno)
    {
        $this->sql = "SELECT *FROM pms_materials_materialrequest where mrproject=:mrproject and mrno=:mrno and mrflags='P'";
        $this->cm  = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrproject", $mrproject);
        $this->cm->bindParam(":mrno", $mrno);
        $this->cm->execute();
        $mrs = array();

        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $mr = self::pms_materials_materialrequest($rows);
            $mrs[] = $mr;
        }
        unset($this->sql, $rows, $this->cm);
        return $mrs;
    }

    public function GetMrProcurement($mrproject, $mrno)
    {
        $mrs = self::_getMrProcurement($mrproject, $mrno);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => $mrs);
        return json_encode($this->response);
        exit;
    }


    private function status_txt($status)
    {
        $st = array(
            "0" => "N",
            "1" => 'P',
        );
        return $st[(string)$status];
    }
    private function pms_mr_procurement($rows)
    {
        $cols = [];
        extract($rows);
        $cols['mrp_id'] = $mrp_id;
        $cols['mr_id'] = $mr_id;
        $cols['mrp_partno'] = $mrp_partno;
        $cols['mrp_description'] = $mrp_description;
        $cols['mrp_diewight'] = $mrp_diewight;
        $cols['mrp_length'] = $mrp_length;
        $cols['mr_qty'] = $mr_qty;
        $cols['mrp_system'] = $mrp_system;
        $cols['mrp_qty'] = $mrp_qty;
        $cols['mrp_supplier'] = $mrp_supplier;
        $cols['mrp_orderno'] = $mrp_orderno;
        $cols['mrp_date'] = $mrp_date;
        $cols['mrp_date_d'] = self::datemethod($mrp_date);
        $cols['mrp_project_id'] = $mrp_project_id;
        $cols['mrp_project_no'] = $mrp_project_no;
        $cols['mrp_project_name'] = $mrp_project_name;
        $cols['mrp_project_location'] = $mrp_project_location;
        $cols['mrp_eta_st'] = $mrp_eta_st;
        $cols['mrp_eta_st_date'] = $mrp_eta_st_date;
        $cols['mrp_eta_st_date_d'] = self::datemethod($mrp_eta_st_date);
        $cols['mrp_total_order_qty'] = $mrp_total_order_qty;
        $cols['mrp_cby'] = $mrp_cby;
        $cols['mrp_eby'] = $mrp_eby;
        $cols['mrp_cdate'] = $mrp_cdate;
        $cols['mrp_edate'] = $mrp_edate;
        $cols['mrp_status'] = $mrp_status;
        $cols['mrp_status_txt'] = self::status_txt($mrp_status);
        return $cols;
    }


    private function _saveMRP($params)
    {
        $this->sql = "INSERT INTO pms_mr_procurement values(
            null,
            :mr_id,
            :mrp_partno,
            :mrp_description,
            :mrp_diewight,
            :mrp_length,
            :mr_qty,
            :mrp_system,
            :mrp_qty,
            :mrp_supplier,
            :mrp_orderno,
            :mrp_date,
            :mrp_project_id,
            :mrp_project_no,
            :mrp_project_name,
            :mrp_project_location,
            :mrp_eta_st,
            :mrp_eta_st_date,
            :mrp_total_order_qty,
            :mrp_cby,
            :mrp_eby,
            :mrp_cdate,
            :mrp_edate,
            :mrp_status,

        )";
        $this->cm = $this->cn->prepare($this->sql);
        $save = $this->cm->execute($params);
        unset($this->cm, $this->sql, $rows);
        return $save;
    }
    public function SaveMRP($save)
    {
        $sv = self::_saveMRP($save);
        if (!$sv) {
            $this->response = array("msg" => "0", "data" => "Error on Saveing Data");
            header("HTTP/1.0 500 error");
            return json_encode($this->response);
            exit;
        }
        $this->response = array("msg" => "1", "data" => "Data Has been Saved");
        return json_encode($this->response);
        exit;
    }

    private function _updateMRP($params)
    {
        $this->sql = "UPDATE pms_mr_procurement set 
        mrp_partno = :mrp_partno,
        mrp_description = :mrp_description,
        mrp_diewight = :mrp_diewight,
        mrp_length = :mrp_length,
        mr_qty = :mr_qty,
        mrp_system = : mrp_system,
        mrp_qty= :mrp_qty,
        mrp_supplier = :mrp_supplier,
        mrp_orderno = :mrp_orderno,
        mrp_date = :mrp_date,
        mrp_eta_st = :mrp_eta_st,
        mrp_eta_st_date = :mrp_eta_st_date,
        mrp_total_order_qty = :mrp_total_order_qty,
        mrp_eby = :mrp_eby,
        mrp_edate = :mrp_edate 
        where mrp_id = :mrp_id";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->cm, $this->sql);
        return $sv;
    }

    // public function UpdateMRP($update){
    //     $up = self::_updateMRP($update);
    //     if(!$up){
    //         $this->response = array("msg" => "0" , "data" => "Error on Update");
    //         header("HTTP/1.0 500 Error on update");
    //         return json_encode($this->response);
    //         exit;
    //     }
    //     $this->response = array("msg" => "1", "data" => "Data has been udpated");
    //     header("HTTP/1.0 200 ok");
    //     return json_encode($this->response);
    //     exit;        
    // }

    private function _allMRP($query)
    {
        $this->sql = $query;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $mrps = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            $rpt = self::pms_materials_materialrequest($rows);
            $rpt['poq_item_no'] = is_null($rows['poq_item_no']) ? '0' : self::enc('denc', $rows['poq_item_no']);
            $rpt['poq_item_type'] = is_null($rows['poq_item_type']) ? 'Miscellaneous' : self::enc('denc', $rows['ptype_name']);
            $rpt['poq_item_remark'] = self::enc('denc', $rows['poq_item_remark']);
            $rpt['poq_item_width'] = self::enc('denc', $rows['poq_item_width']);
            $rpt['poq_item_height'] = self::enc('denc', $rows['poq_item_height']);
            $rpt['poq_finish'] = is_null(self::enc('denc', $rows['poq_finish']));
            $rpt['project_id'] = $rows['project_id'];
            $rpt['project_no_enc'] = $rows['project_no'];
            $rpt['project_no'] = strtoupper(self::enc('denc', $rows['project_no']));
            $rpt['project_name'] = self::enc('denc', $rows['project_name']);
            $rpt['project_cname'] = self::enc('denc', $rows['project_cname']);
            $rpt['project_location'] = self::enc('denc', $rows['project_location']);
            $rpt['Sales_Representative'] = self::enc('denc', $rows['Sales_Representative']);
            $rpt['project_status'] = self::enc('denc', $rows['project_status']);
            $rpt['projectRegion'] = self::enc('denc', $rows['projectRegion']);
            $rpt['project_type'] = self::enc('denc', $rows['project_type']);
            $rcqty = is_null($rows['rcqty']) ? (float)'0' : (float)$rows['rcqty'];
            $rpt['rcqty'] = $rcqty;
            $rcweight = ((float)$rows['mrdieweight'] * (float)$rows['mrreqlength'] * (float)$rpt['rcqty']) / 1000;
            $rpt['rcweight'] = $rcweight;
            //for balance calc

            $mrqty = (float)$rpt['mrorderedqty'];
            $mrwg = (float)$rpt['mrorderedweight'];
            $balqty = $mrqty - $rcqty;
            $balwt = $mrwg - $rcweight;
            $rpt['balqty'] = $balqty;
            $rpt['balwt'] = $balwt;
            $rpt['status_mrp'] = (float)$balqty === 0 ? 'Closed' : '-';
            $mrps[] = $rpt;
        }
        unset($this->cm, $this->sql, $rows);
        return $mrps;
    }

    public function AllMrp($query)
    {
        $mrps = self::_allMRP($query);
        $this->response = array("msg" => "1", "data" => $mrps);
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    public function getmrcount($query)
    {
        $this->sql = $query;
        //echo $this->sql;
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        $this->response = array("msg" => "1", "data" => $cnt);
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }

    private function _udpateMrp($updates)
    {
        $this->sql = "UPDATE pms_materials_materialrequest set 
        mrp_orderno = :mrp_orderno,
        mrp_supplier = :mrp_supplier,
        mrp_okdate = :mrp_okdate,
        mrp_eta = :mrp_eta,
        mrp_system = :mrp_system,
        mrp_datereceive = :mrp_datereceive,
        mrp_totorder = :mrp_totorder         
        where mrid = :mrid";
        $this->cm = $this->cn->prepare($this->sql);
        $update = $this->cm->execute($updates);
        unset($this->sql, $this->cm, $rows);
        return $update;
    }

    public function UpdateMrp($params)
    {
        $upd = self::_udpateMrp($params);
        if (!$upd) {
            $this->response = array("msg" => "0", "data" => "Error on udpate");
            header("HTTP/1.0 500 error");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1", "data" => "Data Has Updated");
        return json_encode($this->response);
        exit;
    }

    //get mr receipt for fidel   

    //get project only mr

    private function ProjectListForMR()
    {
        $this->sql = "SELECT *FROM (select mrproject from pms_materials_materialrequest where mrflags = 'P' group by mrproject) as mr inner join pms_project_summary as pj on mr.mrproject = pj.project_id";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $rpt = array(
                "project_id" => $project_id,
                "project_no_enc" => $project_no,
                "project_no" => self::enc('denc', $project_no),
                "project_name" => self::enc('denc', $project_name),
                "project_cname" => self::enc('denc', $project_cname),
                "project_location" => self::enc('denc', $project_location),
                "project_type" => self::enc('denc', $project_type),
            );
            $rpts[] = $rpt;
        }
        unset($this->sql, $this->cm, $rows);
        return $rpts;
    }

    public function Mrprojects()
    {
        $projects = self::ProjectListForMR();
        $this->response = array(
            "msg" => "1",
            "data" => $projects
        );
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }


    private function _ProjectMrs($mrproject)
    {
        $this->sql = "SELECT *FROM pms_materials_materialrequest where mrproject = :mrproject and mrflags='P'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':mrproject', $mrproject);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $cols = [];
            $cols['mrid']  = $mrid;
            $cols['mrproject']  = $mrproject;
            $cols['mrcode']  = $mrcode;
            $cols['mrno']  = $mrno;
            $cols['mrdate']  = $mrdate;
            $cols['mrdates']  = self::_datef($mrdate);
            $cols['mritem']  = $mritem;
            $cols['mrpartno']  = $mrpartno;
            $cols['mrpartnotai']  = $mrpartnotai;
            $cols['mrdieweight']  = $mrdieweight;
            $cols['mrreqlength']  = $mrreqlength;
            $cols['mrreqqty']  = $mrreqqty;
            $cols['mrreqtotweight']  = $mrreqtotweight;
            $cols['mrreqtotweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrreqqty) / 1000;
            $cols['mrboqno']  = $mrboqno;
            $cols['mravaiqty']  = $mravaiqty;
            $cols['mraviweight']  = $mraviweight;
            $cols['mraviweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mravaiqty) / 1000;
            $cols['mrorderedqty']  = $mrorderedqty;
            $cols['mrorderedweight']  = $mrorderedweight;
            $cols['mrorderedweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrorderedqty) / 1000;
            $cols['mrcby']  = $mrcby;
            $cols['mreby']  = $mreby;
            $cols['mrcdate']  = $mrcdate;
            $cols['mredate']  = $mredate;
            $cols['mrfinish']  = $mrfinish;
            $cols['mrremarks']  = $mrremarks;
            $cols['mrcheckedby']  = $mrcheckedby;
            $cols['mrapprovedby']  = $mrapprovedby;
            $cols['releaseddate'] = $releaseddate;
            $cols['releaseddates'] = self::_datef($releaseddate);
            $cols['mrunit'] = $mrunit;
            $cols['preparedby'] = $preparedby === '' || $preparedby === '-' ? 'JOHN' : strtoupper($preparedby);
            $cols['mrflags'] = $mrflags;

            $rpts[] = $cols;
        }
        unset($this->cm,$this->sql,$rows);
        return $rpts;
    }
    
    public function ProjectMrs($mrproject){
        $rpts = self::_ProjectMrs($mrproject);
        $this->response = array(
            "msg" => "1",
            "data" => $rpts
        );
        return json_encode($this->response);
        exit;
    }

    private function _mrItems($mrno,$mrproject){        
        $this->sql = "SELECT 
        mr.mrid,
        mr.mrproject,
        mr.mrcode,
        mr.mrno,
        mr.mritem,
        mr.mrpartno,
        mr.mrdieweight,
        mr.mrorderedqty,
        mr.mrreqlength,
        mr.mrorderedqty,
        mr.mrorderedweight,
        mr.mrfinish,
        mr.mrremarks,
        mr.mrunit,        
        mrr.mrreceiptqty as mrqty FROM pms_materials_materialrequest as mr left join 
        (select mrid,sum(mrrqty) as mrreceiptqty from pms_mr_receipt group by mrid) as mrr 
        on mr.mrid = mrr.mrid where mr.mrproject = :mrproject and mr.mrno = :mrno";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':mrproject', $mrproject);
        $this->cm->bindParam(':mrno', $mrno);
        $this->cm->execute();
        $rpts = [];
        while ($rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $cols = [];
            $cols['mrid']  = $mrid;
            $cols['mrproject']  = $mrproject;
            $cols['mrcode']  = $mrcode;
            $cols['mrno']  = $mrno;            
            $cols['mritem']  = $mritem;
            $cols['mrpartno']  = $mrpartno;            
            $cols['mrdieweight']  = $mrdieweight;            
            $cols['mrorderedqty']  = $mrorderedqty;                        
            $cols['mrreqlength']  = $mrreqlength;                                    
            $cols['mrorderedweight']  = $mrorderedweight;
            $cols['mrorderedweight'] =  ((float)$mrdieweight * (float)$mrreqlength * (float)$mrorderedqty) / 1000;                        
            $cols['mrfinish']  = $mrfinish;
            $cols['mrremarks']  = $mrremarks;            
            $cols['mrunit'] = $mrunit;
            $mrqty = is_null($mrqty) ? 0 : (float)$mrqty;
            $cols['mrreceiptqty'] =  $mrqty;
            $cols['mrreceiptweght'] = ((float)$mrdieweight * (float)$mrreqlength * (float)$mrqty) / 1000;                        
            $rpts[] = $cols;
        }
        unset($this->cm,$this->sql,$rows);
        return $rpts;
    }

    public function MrItem($mrno,$mrproject){
        $rpt = self::_mrItems($mrno,$mrproject);
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => $rpt );
        return json_encode($this->response);
        exit;
    }
    

    public function oldreceiptmr($mrid){
        $this->sql = "SELECT SUM(mrrqty) as qty from pms_mr_receipt where mrid = :mrid";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrid",$mrid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (float)$rows['qty'];
        unset($this->cm,$this->sql,$rows);

        $this->response = array(
            "msg" => '1',
            "data" => $cnt
        );
        header('HTTP/1.0 200 ok');
        return json_encode($this->response);
        exit;
    }

    private function _saveMrReceipt($params){
        $this->sql = "INSERT INTO pms_mr_receipt values(
            null,
            :mrid,
            :mrreciptno,
            :mrrdate,
            :mrrsupplier,
            :mrrpartno,
            :mrrdescription,
            :mrrdieweight,
            :mrritemlength,
            :mrrqty,
            :mrrweight,
            :mrrpricecal,
            :mrrunitprice,
            :mrrtprice,
            :mrrothers,
            :mrrectipsubtotal,
            :mreby,
            :mrcby,
            :mredate,
            :mrcdate,
            :mrreceiptflag,
            :mrrprojectid
        )";
        $this->cm = $this->cn->prepare($this->sql);
        $sv = $this->cm->execute($params);
        unset($this->sql,$this->cm,$rows);
        return $sv;
    }
    public function savemrReceipt($params){
        $sav = self::_saveMrReceipt($params);
        if(!$sav){
            $this->response = array("msg" => "0" , "data" => "Error on Saveing data");
            header("HTTP/1.0 500 error");
            return json_encode($this->response);
            exit;
        }
        header("HTTP/1.0 200 ok");
        $this->response = array("msg" => "1" , "data" => "data has Saved");
        return json_encode($this->response);
        exit;
    }
    private function pms_mr_receipt($rows){
        extract($rows);
        $cols = [];
        $cols['mrrid'] = $mrrid;
        $cols['mrid'] = $mrid;
        $cols['mrreciptno'] = $mrreciptno;
        $cols['mrrdate'] = $mrrdate;
        $cols['mrrdate_d'] = self::datemethod($mrrdate);
        $cols['mrrsupplier'] = $mrrsupplier;
        $cols['mrrpartno'] = $mrrpartno;
        $cols['mrrdescription'] = $mrrdescription;
        $cols['mrrdieweight'] = $mrrdieweight;
        $cols['mrritemlength'] = $mrritemlength;        
        $cols['mrrqty'] = $mrrqty;
        $cols['mrrweight'] = $mrrweight;
        $cols['mrrpricecal'] = $mrrpricecal;
        $cols['mrrunitprice'] = $mrrunitprice;
        $cols['mrrtprice'] = $mrrtprice;
        $cols['mrrothers'] = $mrrothers;
        $cols['mrrectipsubtotal'] = $mrrectipsubtotal;
        $cols['mreby'] = $mreby;
        $cols['mrcby'] = $mrcby;
        $cols['mredate'] = $mredate;
        $cols['mrcdate'] = $mrcdate;
        $cols['mrreceiptflag'] = $mrreceiptflag;
        $cols['mrrprojectid'] = $mrrprojectid;
        return $cols;
    }
    public function LoadPreviousReceipt($mrreciptno,$mrrsupplier){
        $this->sql = "SELECT *FROM pms_mr_receipt where mrreciptno = :mrreciptno and mrrsupplier = :mrrsupplier";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrreciptno",$mrreciptno);
        $this->cm->bindParam(":mrrsupplier",$mrrsupplier);
        $this->cm->execute();
        $rpts = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $rpt = self::pms_mr_receipt($rows);
            $rpts[] = $rpt;
        }

        $this->response = array("msg" => "1" , "data" => $rpts);
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);
        exit;
    }
    private function _checkpost($mrrid){
        $this->sql = "SELECT COUNT(mrreceiptflag) as cnt FROM pms_mr_receipt where  mrrid = :mrrid and mrreceiptflag='P'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindparam(":mrrid",$mrrid);
        $this->cm->execute();
        $rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($this->sql,$this->cm,$rows);      
        return $cnt;
    }

    private function _removeMrReceipt($mrrid){
        $this->sql = "DELETE FROM pms_mr_receipt where mrrid = :mrrid limit 1";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":mrrid",$mrrid);
        $del = $this->cm->execute();
        unset($this->cm,$this->sql,$rows);
        return $del;
    }
    public function RemoveItem($mrrid){
        $cnt = self::_checkpost($mrrid);
        if($cnt !== 1){
            $this->response = array(
                "msg" => "0",
                "data" => "This MR Receipt Already Posted"
            );
            header("HTTP/1.0 409 dublicate");
            return json_encode($this->response);
            exit;
        }

        $del = self::_removeMrReceipt($mrrid);
        if(!$del){
            $this->response = array(
                "msg" => "0",
                "data" => "Error on Removeing Data",
            );
            header("HTTP/1.0 500 Operation Error");
            return json_encode($this->response);
            exit;
        }

        $this->response = array("msg" => "1" , "data" => "Data Has Removed");
        header("HTTP/1.0 200 ok");
        return json_encode($this->response);        
        exit;


    }




    
}
