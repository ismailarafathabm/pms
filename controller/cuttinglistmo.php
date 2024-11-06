<?php
date_default_timezone_set('Asia/Riyadh');
include_once('mac.php');
class CuttingListMo extends mac
{
    private $cn;
    private $cm;
    private $rows;
    private $sql;
    private $response;

    private $pms_markingtype;
    private $marking_type_id;
    private $marking_type_name;

    private $cuttinglist_qty_type;

    private $pms_cutting_list;
    function __construct($db)
    {
        $this->cn = $db;
        $this->response = array("msg" => "0", "data" => "_Error");
        $this->pms_markingtype = mac::pms_markingtype;
        $this->pms_cutting_list = mac::pms_cutting_list;
        $this->cuttinglist_qty_type = mac::cuttinglist_qty_type;
    }

    public function markingtype_new($marking_type_name)
    {
        $this->marking_type_name = $this->enc('enc', strtolower($marking_type_name));
        $this->sql = "SELECT *FROM $this->pms_markingtype where marking_type_name=:marking_type_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":marking_type_name", $this->marking_type_name);
        $this->cm->execute();
        $dub = $this->cm->rowCount() === 0 ? true : false;
        if ($dub === true) {
            $this->sql = "INSERT INTO $this->pms_markingtype(marking_type_name) values(:marking_type_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":marking_type_name", $this->marking_type_name);
            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Saved");
            } else {
                $this->response = array("msg" => "0", "data" => "DB Error");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "Already Exists");
        }
        return json_encode($this->response);
        exit();
    }
    public function markingtype_all()
    {
        $this->sql = "SELECT *FROM $this->pms_markingtype";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_markingtype = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_markingtype[] = array(
                "marking_type_id" => $marking_type_id,
                "marking_type_name" => $this->enc('denc', $marking_type_name)
            );
        }
        $this->response = array('msg' => "1", "data" => $_markingtype);
        return json_encode($this->response);
        exit();
    }

    public function cuttinglist_all($_project_no)
    {
        $cuttinglist_project_id = $this->enc('enc', $_project_no);

        $this->sql = "SELECT *FROM $this->pms_cutting_list            
            inner join 
            $this->cuttinglist_qty_type 
            on 
            $this->pms_cutting_list.qty_types=$this->cuttinglist_qty_type.qty_type_id 
            where 
            cuttinglist_project_id=:cuttinglist_project_id order by $this->pms_cutting_list.cuttinglist_morefno asc";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":cuttinglist_project_id", $cuttinglist_project_id);
        $this->cm->execute();
        $_cuttinglist = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_cuttinglist_cldaterelease = $this->enc('denc', $cuttinglist_cldaterelease);
            $_cuttinglist_moreleasedtoacct = $this->enc('denc', $cuttinglist_moreleasedtoacct);

            $_cuttinglist_moreleasedtoproduction = $this->enc('denc', $cuttinglist_moreleasedtoproduction);
            if (date_create($_cuttinglist_cldaterelease)) {
                $_date = date_create($_cuttinglist_cldaterelease);
                $cuttinglist_cldaterelease = date_format($_date, 'd-M-Y');
                $cuttinglist_cldaterelease_n = date_format($_date, 'd-m-Y');
            } else {
                $cuttinglist_cldaterelease = $_cuttinglist_cldaterelease;
                $cuttinglist_cldaterelease_n = $_cuttinglist_cldaterelease;
            }

            if (date_create($_cuttinglist_moreleasedtoacct)) {
                $_date = date_create($_cuttinglist_moreleasedtoacct);
                $cuttinglist_moreleasedtoacct = date_format($_date, 'd-M-Y');
                $cuttinglist_moreleasedtoacct_n = date_format($_date, 'd-m-Y');
            } else {
                $cuttinglist_moreleasedtoacct = $_cuttinglist_moreleasedtoacct;
                $cuttinglist_moreleasedtoacct_n = $_cuttinglist_moreleasedtoacct;
            }

            if (date_create($_cuttinglist_moreleasedtoproduction)) {
                $_date = date_create($_cuttinglist_moreleasedtoproduction);
                $cuttinglist_moreleasedtoproduction = date_format($_date, 'd-M-Y');
                $cuttinglist_moreleasedtoproduction_n = date_format($_date, 'd-m-Y');
            } else {
                $cuttinglist_moreleasedtoproduction = $_cuttinglist_moreleasedtoproduction;
                $cuttinglist_moreleasedtoproduction_n = $_cuttinglist_moreleasedtoproduction;
            }
            $fs = "0";
            $fno = '../../assets/cuttinglist/' . $cuttinglist_token . "/";
            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $_cuttinglist[] = array(
                "cuttinglist_id" => $cuttinglist_id,
                "cuttinglist_token" => $cuttinglist_token,
                "cuttinglist_project_id" => $this->enc('denc', $cuttinglist_project_id),
                "cuttinglist_clrefno" => $this->enc('denc', $cuttinglist_clrefno),
                "cuttinglist_cldaterelease" => $cuttinglist_cldaterelease,
                "cuttinglist_cldaterelease_n" => $cuttinglist_cldaterelease_n,
                "cuttinglist_morefno" => $this->enc('denc', $cuttinglist_morefno),
                "cuttinglist_moreleasedtoacct" => $cuttinglist_moreleasedtoacct,
                "cuttinglist_moreleasedtoacct_n" => $cuttinglist_moreleasedtoacct_n,
                "cuttinglist_moreleasedtoproduction" => $cuttinglist_moreleasedtoproduction,
                "cuttinglist_moreleasedtoproduction_n" => $cuttinglist_moreleasedtoproduction_n,
                "cuttinglist_releasedto" => $this->enc('denc', $cuttinglist_releasedto),
                "cuttinglist_doneby" => $this->enc('denc', $cuttinglist_doneby),
                "cuttinglist_markingtype" => $this->enc('denc', $cuttinglist_markingtype),
                "cuttinglist_descripton" => $this->enc('denc', $cuttinglist_descripton),
                "cuttinglist_location" => $this->enc('denc', $cuttinglist_location),
                "cuttinglist_qty" => $this->enc('denc', $cuttinglist_qty),
                "cuttinglist_height" => $this->enc('denc', $cuttinglist_height),
                "cuttinglist_width" => $this->enc('denc', $cuttinglist_width),
                "cuttinglist_area" => $this->enc('denc', $cuttinglist_area),
                "cuttinglist_classrefno" => $this->enc('denc', $cuttinglist_classrefno),
                "cuttinglist_sheettp" => $this->enc('denc', $cuttinglist_sheettp),
                "cuttinglist_remarks" => $this->enc('denc', $cuttinglist_remarks),
                "cuttinglist_section" => $this->enc('denc', $cuttinglist_section),
                "cuttinglist_status" => $this->enc('denc', $cuttinglist_status),
                "cuttinglist_cby" => $this->enc('denc', $cuttinglist_cby),
                "cuttinglist_eby" => $this->enc('denc', $cuttinglist_eby),
                "cuttinglist_cdate" => $cuttinglist_cdate,
                "cuttinglist_edate" => $cuttinglist_edate,
                "cuttinglist_boqitem" => $this->enc('denc', $cuttinglist_boqitem),
                "qty_types" => $qty_types,
                'cuttinglist_qty_type' =>  $this->enc('denc', $qty_type),
                "file" => $fs,
                'cuttinglistfor' => $this->enc('denc', $cuttinglistfor),
                'cuttinglist_totarea' => $this->enc('denc', $cuttinglist_totarea)
            );
        }
        $this->response = array("msg" => "1", "data" =>  $_cuttinglist);
        return json_encode($this->response);
        exit();
    }

    public function cuttinglist_new($cuttinginfo)
    {
        $this->sql = "INSERT INTO $this->pms_cutting_list values(
                null,                
                :cuttinglist_token,
                :cuttinglist_project_id,
                :cuttinglist_clrefno,
                :cuttinglist_cldaterelease,
                :cuttinglist_morefno,
                :cuttinglist_moreleasedtoacct,
                :cuttinglist_moreleasedtoproduction,
                :cuttinglist_releasedto,
                :cuttinglist_doneby,
                :cuttinglist_markingtype,
                :cuttinglist_descripton,
                :cuttinglist_location,
                :cuttinglist_qty,
                :cuttinglist_height,
                :cuttinglist_width,
                :cuttinglist_area,
                :cuttinglist_classrefno,
                :cuttinglist_sheettp,
                :cuttinglist_remarks,
                :cuttinglist_section,
                :cuttinglist_status,
                :cuttinglist_cby,
                :cuttinglist_eby,
                :cuttinglist_cdate,
                :cuttinglist_edate,
                :cuttinglist_boqitem,
                :qty_types,
                :cuttinglistfor,
                :cuttinglist_totarea
            )";

        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($cuttinginfo)) {
            $this->response = array("msg" => "1", "data" => "Saved");
        } else {
            $this->response = array("msg" => "0", "data" => "DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }

    public function cuttinglist_update($cuttinginfo)
    {
        $this->sql = "UPDATE $this->pms_cutting_list SET                 
                cuttinglist_clrefno=:cuttinglist_clrefno,
                cuttinglist_cldaterelease=:cuttinglist_cldaterelease,
                cuttinglist_morefno=:cuttinglist_morefno,
                cuttinglist_moreleasedtoacct=:cuttinglist_moreleasedtoacct,
                cuttinglist_moreleasedtoproduction=:cuttinglist_moreleasedtoproduction,
                cuttinglist_releasedto=:cuttinglist_releasedto,
                cuttinglist_doneby=:cuttinglist_doneby,
                cuttinglist_markingtype=:cuttinglist_markingtype,
                cuttinglist_descripton=:cuttinglist_descripton,
                cuttinglist_location=:cuttinglist_location,
                cuttinglist_qty=:cuttinglist_qty,
                cuttinglist_height=:cuttinglist_height,
                cuttinglist_width=:cuttinglist_width,
                cuttinglist_area=:cuttinglist_area,
                cuttinglist_classrefno=:cuttinglist_classrefno,
                cuttinglist_sheettp=:cuttinglist_sheettp,
                cuttinglist_remarks=:cuttinglist_remarks,
                cuttinglist_section=:cuttinglist_section,
                cuttinglist_status=:cuttinglist_status,                
                cuttinglist_eby=:cuttinglist_eby,                
                cuttinglist_edate=:cuttinglist_edate,
                cuttinglist_boqitem=:cuttinglist_boqitem,
                qty_types = :qty_types,
                cuttinglistfor=:cuttinglistfor,
                cuttinglist_totarea=:cuttinglist_totarea
                where
                cuttinglist_token = :cuttinglist_token and 
                cuttinglist_project_id =:cuttinglist_project_id
            ";

        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($cuttinginfo)) {
            $this->response = array("msg" => "1", "data" => "updated");
        } else {
            $this->response = array("msg" => "0", "data" => "DB ERROR");
        }
        return json_encode($this->response);
        exit();
    }

    public function RemoveCtmo($token, $project)
    {
        $cuttinglist_project_id = $this->enc('enc', $project);
        $cuttinglist_token = $token;

        $this->sql = "DELETE FROM $this->pms_cutting_list Where cuttinglist_token=:cuttinglist_token and cuttinglist_project_id=:cuttinglist_project_id LIMIT 1";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":cuttinglist_token", $cuttinglist_token);
        $this->cm->bindParam(":cuttinglist_project_id", $cuttinglist_project_id);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "removed");
        } else {
            $this->response = array("msg" => "0", "data" => "Database Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function GetCuttinglistInfo($projectno, $refon)
    {
        $this->cuttinglist_project_id = $this->enc('enc', $projectno);
        $this->cuttinglist_morefno = $this->enc('enc', $refon);
        $this->sql = "SELECT *FROM $this->pms_cutting_list                 
                inner join 
                $this->cuttinglist_qty_type 
                on 
                $this->pms_cutting_list.qty_types=$this->cuttinglist_qty_type.qty_type_id 
                where 
                cuttinglist_project_id=:cuttinglist_project_id and cuttinglist_morefno=:cuttinglist_morefno";
        $this->cm = $this->cn->prepare($this->sql);
        $_indata = array(
            ":cuttinglist_project_id" => $this->cuttinglist_project_id,
            ":cuttinglist_morefno" => $this->cuttinglist_morefno,
        );
        $this->cm->execute($_indata);
        $_ok = $this->cm->rowCount() !== 0 ? true : false;
        if ($_ok === true) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $_cuttinglist_cldaterelease = $this->enc('denc', $cuttinglist_cldaterelease);
            $_cuttinglist_moreleasedtoacct = $this->enc('denc', $cuttinglist_moreleasedtoacct);
            $_cuttinglist_moreleasedtoproduction = $this->enc('denc', $cuttinglist_moreleasedtoproduction);
            if (date_create($_cuttinglist_cldaterelease)) {
                $_date = date_create($_cuttinglist_cldaterelease);
                $cuttinglist_cldaterelease = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_cldaterelease = $_cuttinglist_cldaterelease;
            }

            if (date_create($_cuttinglist_moreleasedtoacct)) {
                $_date = date_create($_cuttinglist_moreleasedtoacct);
                $cuttinglist_moreleasedtoacct = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_moreleasedtoacct = $_cuttinglist_moreleasedtoacct;
            }

            if (date_create($_cuttinglist_moreleasedtoproduction)) {
                $_date = date_create($_cuttinglist_moreleasedtoproduction);
                $cuttinglist_moreleasedtoproduction = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_moreleasedtoproduction = $_cuttinglist_moreleasedtoproduction;
            }
            $fs = "0";
            $fno = '../../assets/cuttinglist/' . $cuttinglist_token . ".pdf";
            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $_cuttinglist = array(
                "cuttinglist_id" => $cuttinglist_id,
                "cuttinglist_token" => $cuttinglist_token,
                "cuttinglist_project_id" => $this->enc('denc', $cuttinglist_project_id),
                "cuttinglist_clrefno" => $this->enc('denc', $cuttinglist_clrefno),
                "cuttinglist_cldaterelease" => $cuttinglist_cldaterelease,
                "cuttinglist_morefno" => $this->enc('denc', $cuttinglist_morefno),
                "cuttinglist_moreleasedtoacct" => $cuttinglist_moreleasedtoacct,
                "cuttinglist_moreleasedtoproduction" => $cuttinglist_moreleasedtoproduction,
                "cuttinglist_releasedto" => $this->enc('denc', $cuttinglist_releasedto),
                "cuttinglist_doneby" => $this->enc('denc', $cuttinglist_doneby),
                "cuttinglist_markingtype" => $this->enc('denc', $cuttinglist_markingtype),
                "cuttinglist_descripton" => $this->enc('denc', $cuttinglist_descripton),
                "cuttinglist_location" => $this->enc('denc', $cuttinglist_location),
                "cuttinglist_qty" => $this->enc('denc', $cuttinglist_qty),
                "cuttinglist_height" => $this->enc('denc', $cuttinglist_height),
                "cuttinglist_width" => $this->enc('denc', $cuttinglist_width),
                "cuttinglist_area" => $this->enc('denc', $cuttinglist_area),
                "cuttinglist_classrefno" => $this->enc('denc', $cuttinglist_classrefno),
                "cuttinglist_sheettp" => $this->enc('denc', $cuttinglist_sheettp),
                "cuttinglist_remarks" => $this->enc('denc', $cuttinglist_remarks),
                "cuttinglist_section" => $this->enc('denc', $cuttinglist_section),
                "cuttinglist_status" => $this->enc('denc', $cuttinglist_status),
                "cuttinglist_cby" => $this->enc('denc', $cuttinglist_cby),
                "cuttinglist_eby" => $this->enc('denc', $cuttinglist_eby),
                "cuttinglist_cdate" => $cuttinglist_cdate,
                "cuttinglist_edate" => $cuttinglist_edate,
                "cuttinglist_boqitem" => $this->enc('denc', $cuttinglist_boqitem),
                "qty_types" => $qty_types,
                'cuttinglist_qty_type' =>  $this->enc('denc', $qty_type),
                "file" => $fs,
                'cuttinglistfor' => $this->enc('denc', $cuttinglistfor),
                'cuttinglist_totarea' => $this->enc('denc', $cuttinglist_totarea)
            );
            $this->response = array(
                "msg" => "1",
                "data" => $_cuttinglist
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "No Data found"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function GetCuttinglistInfo2($project_no, $boqitems)
    {
        $boq_cnt = 0;
        $old_cnt = 0;
        $mis_cnt = 0;
        $diff = 0;
        $no = $this->enc('enc', '2');
        $this->cuttinglist_project_id = $this->enc('enc', $project_no);
        $this->cuttinglist_morefno = $this->enc('enc', $boqitems);
        //get count of project 
        $this->sql = "SELECT *FROM pms_poq where poq_item_no=:poq_item_no and  poq_project_code=:poq_project_code";
        $this->cm = $this->cn->prepare($this->sql);
        $params = array(
            ":poq_item_no" => $this->cuttinglist_morefno,
            ":poq_project_code" => $this->cuttinglist_project_id
        );
        $this->cm->execute($params);
        $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
        extract($this->rows);
        $boq_cnt = (int) $this->enc('denc', $poq_qty);
        ///unset previous query and command and rows;        
        unset($this->sql, $this->cm, $this->rows);


        //count  actual release 
        $this->sql = "SELECT *FROM pms_cutting_list where cuttinglist_boqitem='$this->cuttinglist_morefno' and cuttinglist_project_id='$this->cuttinglist_project_id'";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $old_cnt = 0;
        $mis_cnt = 0;
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            if (is_numeric($this->enc('denc', $cuttinglist_qty)) && $cuttinglistfor !== $no) {
                $old_cnt += round((int)$this->enc('denc', $cuttinglist_qty));
            } else {
                $mis_cnt += round((int)$this->enc('denc', $cuttinglist_qty));
            }
        }

        $diff = (int)$boq_cnt - (int)$old_cnt;
        $response_data = array(
            'boq_cnt' => $boq_cnt,
            'old_cnt' => $old_cnt,
            'mis_cnt' => $mis_cnt,
            'diff' => $diff,
        );

        $this->response = array(
            "msg" => "1",
            "data" => $response_data
        );
        return json_encode($this->response);
        exit();
    }

    public function cuttinglistqtytype($qtytype)
    {
        $qty_sm = strtolower($qtytype);
        $c_qtytype = $this->enc('enc', $qty_sm);

        $this->sql = "SELECT *from $this->cuttinglist_qty_type where qty_type=:qty_type";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":qty_type", $c_qtytype);
        $this->cm->execute();

        $dub = $this->cm->rowcount() === 0 ? true : false;

        if ($dub === true) {
            $this->sql = "INSERT INTO $this->cuttinglist_qty_type values(null,:qty_type)";
            //echo $this->sql;
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":qty_type", $c_qtytype);
            if ($this->cm->execute()) {
                $this->response = array(
                    "msg" => "1",
                    "data" => "Saved"
                );
            } else {
                $this->response = array(
                    "msg" => "0",
                    "data" => "DB Error"
                );
            }
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Dublicate found"
            );
        }
        return json_encode($this->response);
        exit();
    }

    public function cuttinglistqtytypelist()
    {
        $this->sql = "SELECT *FROM $this->cuttinglist_qty_type";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $_list = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_list[] = [
                'qty_type_id' => $qty_type_id,
                'cuttinglist_qty_type' =>  $this->enc('denc', $qty_type),
            ];
        }
        $this->response = array(
            "msg" => "1",
            "data" => $_list
        );
        return json_encode($this->response);
        exit();
    }



    public function rpt_ct(){
        $this->sql = "SELECT cuttinglist_cldaterelease FROM `pms_cutting_list` GROUP BY cuttinglist_cldaterelease";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rcnt = $this->cm->rowCount();
        $ct = [];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $ct[] = $rows['cuttinglist_cldaterelease'];
        }
        
        $this->response = array("msg" => "1", "data" =>  $ct);
        return json_encode($this->response);
        unset($this->cm,$this->sql,$rows);
        exit();
    }

    public function rpt($cuttinglist_cldaterelease)
    {
        $this->sql = "SELECT *FROM ($this->pms_cutting_list             
            inner join 
            $this->cuttinglist_qty_type 
            on 
            $this->pms_cutting_list.qty_types=$this->cuttinglist_qty_type.qty_type_id) inner join pms_project_summary on pms_project_summary.project_no=$this->pms_cutting_list.cuttinglist_project_id where 
            $this->pms_cutting_list.cuttinglist_cldaterelease=:cuttinglist_cldaterelease 
            order by $this->pms_cutting_list.cuttinglist_id desc";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(':cuttinglist_cldaterelease',$cuttinglist_cldaterelease);
        $this->cm->execute();
        $_cuttinglist = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_cuttinglist_cldaterelease = $this->enc('denc', $cuttinglist_cldaterelease);
            $_cuttinglist_moreleasedtoacct = $this->enc('denc', $cuttinglist_moreleasedtoacct);
            $_cuttinglist_moreleasedtoproduction = $this->enc('denc', $cuttinglist_moreleasedtoproduction);
            $cuttinglist_cldaterelease_s = $_cuttinglist_cldaterelease;
            if (date_create($_cuttinglist_cldaterelease)) {
                $_date = date_create($_cuttinglist_cldaterelease);
                $cuttinglist_cldaterelease = date_format($_date, 'd-M-Y');
                $cuttinglist_cldaterelease_s = date_format($_date, 'Y-m-d');
            } else {
                $cuttinglist_cldaterelease = $_cuttinglist_cldaterelease;
            }
            $cuttinglist_moreleasedtoacct_s = $_cuttinglist_moreleasedtoacct;
            if (date_create($_cuttinglist_moreleasedtoacct)) {
                $_date = date_create($_cuttinglist_moreleasedtoacct);
                $cuttinglist_moreleasedtoacct = date_format($_date, 'd-M-Y');
                $cuttinglist_moreleasedtoacct_s = date_format($_date, 'Y-m-d');
            } else {
                $cuttinglist_moreleasedtoacct = $_cuttinglist_moreleasedtoacct;
            }
            $cuttinglist_moreleasedtoproduction_s = $_cuttinglist_moreleasedtoproduction;
            if (date_create($_cuttinglist_moreleasedtoproduction)) {
                $_date = date_create($_cuttinglist_moreleasedtoproduction);
                $cuttinglist_moreleasedtoproduction = date_format($_date, 'd-M-Y');
                $cuttinglist_moreleasedtoproduction_s = date_format($_date, 'Y-m-d');
            } else {
                $cuttinglist_moreleasedtoproduction = $_cuttinglist_moreleasedtoproduction;
            }
            $fs = "0";
            $fno = '../../assets/cuttinglist/' . $cuttinglist_token . "/";
            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }
            $projectby = $this->enc('denc', $project_name) . " [" . $this->enc('denc', $project_no) . "]";
            $cuttinglistfortext = $this->enc('denc', $cuttinglistfor) === '1' ? "BOQ ITEMS" : "MISCELLANEOUS ITEMS";
            $_cuttinglist[] = array(
                "cuttinglist_moreleasedtoacct_s" => $cuttinglist_moreleasedtoacct_s,
                'cuttinglist_moreleasedtoproduction_s' => $cuttinglist_moreleasedtoproduction_s,
                "cuttinglist_cldaterelease_s" => $cuttinglist_cldaterelease_s,
                "cuttinglist_id" => $cuttinglist_id,
                "cuttinglist_token" => $cuttinglist_token,
                "cuttinglist_project_id" => $this->enc('denc', $project_no),
                "cuttinglist_clrefno" => $this->enc('denc', $cuttinglist_clrefno),
                "cuttinglist_cldaterelease" => $cuttinglist_cldaterelease,
                "cuttinglist_morefno" => $this->enc('denc', $cuttinglist_morefno),
                "cuttinglist_moreleasedtoacct" => $cuttinglist_moreleasedtoacct,
                "cuttinglist_moreleasedtoproduction" => $cuttinglist_moreleasedtoproduction,
                "cuttinglist_releasedto" => $this->enc('denc', $cuttinglist_releasedto),
                "cuttinglist_doneby" => $this->enc('denc', $cuttinglist_doneby),
                "cuttinglist_markingtype" => $this->enc('denc', $cuttinglist_markingtype),
                "cuttinglist_descripton" => $this->enc('denc', $cuttinglist_descripton),
                "cuttinglist_location" => $this->enc('denc', $cuttinglist_location),
                "cuttinglist_qty" => $this->enc('denc', $cuttinglist_qty),
                "cuttinglist_height" => $this->enc('denc', $cuttinglist_height),
                "cuttinglist_width" => $this->enc('denc', $cuttinglist_width),
                "cuttinglist_area" => $this->enc('denc', $cuttinglist_area),
                "cuttinglist_classrefno" => $this->enc('denc', $cuttinglist_classrefno),
                "cuttinglist_sheettp" => $this->enc('denc', $cuttinglist_sheettp),
                "cuttinglist_remarks" => $this->enc('denc', $cuttinglist_remarks),
                "cuttinglist_section" => $this->enc('denc', $cuttinglist_section),
                "cuttinglist_status" => $this->enc('denc', $cuttinglist_status),
                "cuttinglist_cby" => $this->enc('denc', $cuttinglist_cby),
                "cuttinglist_eby" => $this->enc('denc', $cuttinglist_eby),
                "cuttinglist_cdate" => $cuttinglist_cdate,
                "cuttinglist_edate" => $cuttinglist_edate,
                "cuttinglist_boqitem" => $this->enc('denc', $cuttinglist_boqitem),
                "qty_types" => $qty_types,
                'cuttinglist_qty_type' =>  $this->enc('denc', $qty_type),
                "file" => $fs,
                'cuttinglistfor' => $this->enc('denc', $cuttinglistfor),
                'cuttinglist_totarea' => $this->enc('denc', $cuttinglist_totarea),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location),
                'projectby' => $projectby,
                'cuttinglistfortext' => $cuttinglistfortext,

            );
        }
        $this->response = array("msg" => "1", "data" =>  $_cuttinglist);
        return json_encode($this->response);
        exit();
    }

    public function Rpt_new()
    {

        $this->sql = "SELECT *FROM pms_poq inner join pms_project_summary on pms_poq.poq_project_code=pms_project_summary.project_no";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $rpt_data = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $projectno = $this->enc('denc', $poq_project_code);
            $boq_item = $this->enc('denc', $poq_item_no);
            $no = $this->enc('enc', '2');
            $sql = "SELECT *FROM pms_cutting_list where cuttinglist_boqitem='$poq_item_no' and cuttinglist_project_id='$poq_project_code'";
            $cm = $this->cn->prepare($sql);
            $cm->execute();
            $cnt = 0;
            $mis = 0;
            while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
                extract($rows);
                if (is_numeric($this->enc('denc', $cuttinglist_qty)) && $cuttinglistfor !== $no) {
                    $cnt += round((int)$this->enc('denc', $cuttinglist_qty));
                } else {
                    $mis += round((int)$this->enc('denc', $cuttinglist_qty));
                }
            }
            $disp = $this->enc('denc', $project_name) . "[" . $projectno . "]";
            $diff = $this->enc('denc', $poq_qty) - round((int)$cnt);
            $prs = 100 - ($diff * 100) / $this->enc('denc', $poq_qty);
            $rpt_data[] = array(
                'projectsort' => $disp,
                'poq_project_code' => $projectno,
                'poq_project_name' => $this->enc('denc', $project_name),
                'boq_itme' => $boq_item,
                'boq_qty' => $this->enc('denc', $poq_qty),
                'cnt' => round($cnt),
                'mis' => $mis,
                'diff' => $diff,
                'prs' => round($prs),
            );
        }
        $this->response = array(
            "msg" => "1",
            "data" => $rpt_data
        );
        return json_encode($this->response);
        exit();
    }



    public function cuttinglist_itemno($_project_no, $itemno)
    {
        $cuttinglist_project_id = $this->enc('enc', $_project_no);
        $cuttinglist_boqitem = $this->enc('enc', $itemno);

        $this->sql = "SELECT *FROM $this->pms_cutting_list            
            inner join 
            $this->cuttinglist_qty_type 
            on 
            $this->pms_cutting_list.qty_types=$this->cuttinglist_qty_type.qty_type_id 
            where 
            $this->pms_cutting_list.cuttinglist_project_id='$cuttinglist_project_id' and 
            $this->pms_cutting_list.cuttinglist_boqitem='$cuttinglist_boqitem' 
            order by $this->pms_cutting_list.cuttinglist_morefno asc";

        //echo $this->sql;        
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":cuttinglist_project_id", $cuttinglist_project_id);
        $this->cm->bindParam(":cuttinglist_boqitem", $cuttinglist_boqitem);
        $this->cm->execute();
        $_cuttinglist = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_cuttinglist_cldaterelease = $this->enc('denc', $cuttinglist_cldaterelease);
            $_cuttinglist_moreleasedtoacct = $this->enc('denc', $cuttinglist_moreleasedtoacct);
            $_cuttinglist_moreleasedtoproduction = $this->enc('denc', $cuttinglist_moreleasedtoproduction);
            if (date_create($_cuttinglist_cldaterelease)) {
                $_date = date_create($_cuttinglist_cldaterelease);
                $cuttinglist_cldaterelease = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_cldaterelease = $_cuttinglist_cldaterelease;
            }

            if (date_create($_cuttinglist_moreleasedtoacct)) {
                $_date = date_create($_cuttinglist_moreleasedtoacct);
                $cuttinglist_moreleasedtoacct = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_moreleasedtoacct = $_cuttinglist_moreleasedtoacct;
            }

            if (date_create($_cuttinglist_moreleasedtoproduction)) {
                $_date = date_create($_cuttinglist_moreleasedtoproduction);
                $cuttinglist_moreleasedtoproduction = date_format($_date, 'd-M-Y');
            } else {
                $cuttinglist_moreleasedtoproduction = $_cuttinglist_moreleasedtoproduction;
            }
            $fs = "0";
            $fno = '../../assets/cuttinglist/' . $cuttinglist_token . "/";
            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }

            $_cuttinglist[] = array(
                "cuttinglist_id" => $cuttinglist_id,
                "cuttinglist_token" => $cuttinglist_token,
                "cuttinglist_project_id" => $this->enc('denc', $cuttinglist_project_id),
                "cuttinglist_clrefno" => $this->enc('denc', $cuttinglist_clrefno),
                "cuttinglist_cldaterelease" => $cuttinglist_cldaterelease,
                "cuttinglist_morefno" => $this->enc('denc', $cuttinglist_morefno),
                "cuttinglist_moreleasedtoacct" => $cuttinglist_moreleasedtoacct,
                "cuttinglist_moreleasedtoproduction" => $cuttinglist_moreleasedtoproduction,
                "cuttinglist_releasedto" => $this->enc('denc', $cuttinglist_releasedto),
                "cuttinglist_doneby" => $this->enc('denc', $cuttinglist_doneby),
                "cuttinglist_markingtype" => $this->enc('denc', $cuttinglist_markingtype),
                "cuttinglist_descripton" => $this->enc('denc', $cuttinglist_descripton),
                "cuttinglist_location" => $this->enc('denc', $cuttinglist_location),
                "cuttinglist_qty" => $this->enc('denc', $cuttinglist_qty),
                "cuttinglist_height" => $this->enc('denc', $cuttinglist_height),
                "cuttinglist_width" => $this->enc('denc', $cuttinglist_width),
                "cuttinglist_area" => $this->enc('denc', $cuttinglist_area),
                "cuttinglist_classrefno" => $this->enc('denc', $cuttinglist_classrefno),
                "cuttinglist_sheettp" => $this->enc('denc', $cuttinglist_sheettp),
                "cuttinglist_remarks" => $this->enc('denc', $cuttinglist_remarks),
                "cuttinglist_section" => $this->enc('denc', $cuttinglist_section),
                "cuttinglist_status" => $this->enc('denc', $cuttinglist_status),
                "cuttinglist_cby" => $this->enc('denc', $cuttinglist_cby),
                "cuttinglist_eby" => $this->enc('denc', $cuttinglist_eby),
                "cuttinglist_cdate" => $cuttinglist_cdate,
                "cuttinglist_edate" => $cuttinglist_edate,
                "cuttinglist_boqitem" => $this->enc('denc', $cuttinglist_boqitem),
                "qty_types" => $qty_types,
                'cuttinglist_qty_type' =>  $this->enc('denc', $qty_type),
                "file" => $fs,
                'cuttinglistfor' => $this->enc('denc', $cuttinglistfor),
                'cuttinglist_totarea' => $this->enc('denc', $cuttinglist_totarea)
            );
        }
        $this->response = array("msg" => "1", "data" =>  $_cuttinglist);
        return json_encode($this->response);
        exit();
    }
}
// include_once('../connection/connection.php');
// $connection = new connection();
// $cn = $connection->connect();

// $CuttingListMo = new CuttingListMo($cn);
// echo $CuttingListMo->Rpt_new();
