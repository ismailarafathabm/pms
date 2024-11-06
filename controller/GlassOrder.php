<?php
include_once('mac.php');
date_default_timezone_set('Asia/Riyadh');
class GlassOrder extends mac
{
    private $cn;
    private $cm;
    private $rows;
    private $response;
    private $pms_glasstypes;
    private $glasstype_id;
    private $glasstype_name;

    private $pms_glassorders;
    private $glassorder_id;
    private $glassorder_token;
    private $project_id;
    private $boq_itemno;
    private $doneby;
    private $releasedtopurchase;
    private $recivedfrompurchas;
    private $orderstatus;
    private $supplier;
    private $glasstype;
    private $glassdescription;
    private $QTY;
    private $remarks;
    private $create_by;
    private $edit_by;
    private $create_time;
    private $edit_time;

    private $psm_suppliers;
    private $supplier_id;
    private $supplier_name;
    function __construct($db)
    {
        $this->cn = $db;
        $this->pms_glasstypes = mac::pms_glasstypes;
        $this->pms_glassorders = mac::pms_glassorders;
        $this->psm_suppliers = mac::psm_suppliers;
        $this->response = array("msg" => "0", "data" => "_Error");
    }

    public function glasstype_all()
    {
        $_glasstypes = [];
        $this->sql = "SELECT *FROM $this->pms_glasstypes ORDER BY glasstype_name ASC";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_glasstypes[] = array(
                "glasstype_id" => $glasstype_id,
                "glasstype_name" => strtoupper($this->enc('denc', $glasstype_name)),
            );
        }
        $this->response = array("msg" => "1", "data" => $_glasstypes);
        return json_encode($this->response);
        exit();
    }

    public function glasstype_new($glasstype_name)
    {
        $_glasstypename = strtolower($glasstype_name);
        $this->glasstype_name = $this->enc("enc", $_glasstypename);
        $this->sql = "SELECT *FROM $this->pms_glasstypes where glasstype_name=:glasstype_name";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glasstype_name", $this->glasstype_name);
        $this->cm->execute();
        $dub = $this->cm->rowCount() > 0 ? false : true;

        if ($dub === true) {
            $this->sql = "INSERT INTO $this->pms_glasstypes(glasstype_name) values(:glasstype_name)";
            $this->cm = $this->cn->prepare($this->sql);
            $this->cm->bindParam(":glasstype_name", $this->glasstype_name);
            if ($this->cm->execute()) {
                $this->response = array("msg" => "1", "data" => "Saved");
            } else {
                $this->response = array("msg" => "0", "data" => "Error In Database");
            }
        } else {
            $this->response = array("msg" => "0", "data" => "Already Exists");
        }
        return json_encode($this->response);
        exit();
    }

    public function glassorder_new($saveitems)
    {
        $this->sql = "INSERT INTO $this->pms_glassorders(                
                glassorder_token,
                project_id,
                boq_itemno,
                glassorderno,
                doneby,
                releasedtopurchase,
                recivedfrompurchas,
                orderstatus,
                supplier,
                glasstype,
                glassdescription,
                markinglocation,
                QTY,
                remarks,
                create_by,
                edit_by,
                create_time,
                edit_time
            ) values(                
                :glassorder_token,
                :project_id,
                :boq_itemno,
                :glassorderno,
                :doneby,
                :releasedtopurchase,
                :recivedfrompurchas,
                :orderstatus,
                :supplier,
                :glasstype,
                :glassdescription,
                :markinglocation,
                :QTY,
                :remarks,
                :create_by,
                :edit_by,
                :create_time,
                :edit_time
            )";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute($saveitems)) {
            $this->response = array("msg" => "1", "data" => "Saved");
        } else {
            $this->response = array("msg" => "0", "data" => "Db Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function glassorder_all($project_no)
    {
        $this->project_id = $this->enc('enc', $project_no);
        $this->sql = "SELECT *FROM ($this->pms_glassorders 
            inner join $this->pms_glasstypes 
            on 
            $this->pms_glassorders.glasstype = $this->pms_glasstypes.glasstype_id) 
            inner join 
            $this->psm_suppliers 
            on 
            $this->pms_glassorders.supplier = $this->psm_suppliers.supplier_id 
            where 
            $this->pms_glassorders.project_id = :project_id";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_id", $this->project_id);
        $this->cm->execute();
        $_glassorders = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_date = $this->enc('denc', $releasedtopurchase);
            $_releasedtopurchase = $_date;
            $_releasedtopurchase_n = $_date;

            $_date1 = $this->enc('denc', $recivedfrompurchas);
            $_recivedfrompurchas = $_date1;
            $_recivedfrompurchas_n = $_date1;
            if (date_create($_date)) {
                $__date = date_create($_date);
                $_releasedtopurchase = date_format($__date, 'd-M-Y');
                $_releasedtopurchase_n = date_format($__date, 'd-m-Y');
            }

            if (date_create($_date1)) {
                $__date1 = date_create($_date1);
                $_recivedfrompurchas = date_format($__date1, 'd-M-Y');
                $_recivedfrompurchas_n = date_format($__date1, 'd-m-Y');
            }
            $fs = "0";
            $fno = '../../assets/glassorder/' . $glassorder_token . "/";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }
            $items = [];
            $sql = "SELECT *FROM psm_glassorder_boqitems where boqitems_project=:boqitems_project and boqitems_glassorder_token=:boqitems_glassorder_token";
            $cm = $this->cn->prepare($sql);
            $_barams = array(
                ":boqitems_project" => $project_id,
                ":boqitems_glassorder_token" => $glassorder_token
            );
            $cm->execute($_barams);
            while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
                extract($rows);
                $items[] = array(
                    'boqitems_project' => $this->enc('denc', $boqitems_project),
                    'boqitems_glassorder_token' => $boqitems_glassorder_token,
                    'boqitems_itemid' => $this->enc('denc', $boqitems_itemid)
                );
            }
            $_glassorders[] = array(
                'glassorder_id' => $glassorder_id,
                'glassorder_token' => $glassorder_token,
                'project_id' => $this->enc('denc', $project_id),
                'boq_itemno' => $this->enc('denc', $boq_itemno),
                'glassorderno' => $this->enc('denc', $glassorderno),
                'doneby' => $this->enc('denc', $doneby),
                'releasedtopurchase' => $_releasedtopurchase,
                'releasedtopurchase_n' => $_releasedtopurchase_n,
                'recivedfrompurchas' => $_recivedfrompurchas,
                'recivedfrompurchas_n' => $_recivedfrompurchas_n,
                'orderstatus' => $this->enc('denc', $orderstatus),
                'supplier' => $supplier,
                'glasstype' => $glasstype,
                'glassdescription' => $this->enc('denc', $glassdescription),
                'markinglocation' => $this->enc('denc', $markinglocation),
                'QTY' => $this->enc('denc', $QTY),
                'remarks' => $this->enc('denc', $remarks),
                'create_by' => $this->enc('denc', $create_by),
                'edit_by' => $this->enc('denc', $edit_by),
                'create_time' => $create_time,
                'edit_time' => $edit_time,
                'glasstype_id' => $glasstype_id,
                'glasstype_name' => $this->enc('denc', $glasstype_name),
                'supplier_id' => $supplier_id,
                'supplier_name' => $this->enc('denc', $supplier_name),
                'file' => $fs,
                'items_list' => $items
            );
        }
        $this->response = array("msg" => '1', "data" => $_glassorders);
        return json_encode($this->response);
        exit();
    }

    public function glassorder_get($project_id, $glassorderno)
    {
        $this->project_id = $this->enc('enc', $project_id);
        $this->glassorderno  = $this->enc('enc', $glassorderno);
        $this->sql = "SELECT *FROM ($this->pms_glassorders 
            inner join $this->pms_glasstypes 
            on 
            $this->pms_glassorders.glasstype = $this->pms_glasstypes.glasstype_id) 
            inner join 
            $this->psm_suppliers 
            on 
            $this->pms_glassorders.supplier = $this->psm_suppliers.supplier_id 
            where 
            $this->pms_glassorders.project_id = :project_id and $this->pms_glassorders.glassorderno=:glassorderno";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_id", $this->project_id);
        $this->cm->bindParam(":glassorderno", $this->glassorderno);
        $this->cm->execute();
        $_glassorders = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_date = $this->enc('denc', $releasedtopurchase);
            $_releasedtopurchase = $_date;

            $_date1 = $this->enc('denc', $recivedfrompurchas);
            $_recivedfrompurchas = $_date1;
            if (date_create($_date)) {
                $__date = date_create($_date);
                $_releasedtopurchase = date_format($__date, 'd-M-Y');
            }

            if (date_create($_date1)) {
                $__date1 = date_create($_date1);
                $_recivedfrompurchas = date_format($__date1, 'd-M-Y');
            }
            $fs = "0";
            $fno = '../../assets/glassorder/' . $glassorder_token . ".pdf";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }
            $_glassorders[] = array(
                'glassorder_id' => $glassorder_id,
                'glassorder_token' => $glassorder_token,
                'project_id' => $this->enc('denc', $project_id),
                'boq_itemno' => $this->enc('denc', $boq_itemno),
                'glassorderno' => $this->enc('denc', $glassorderno),
                'doneby' => $this->enc('denc', $doneby),
                'releasedtopurchase' => $_releasedtopurchase,
                'recivedfrompurchas' => $_recivedfrompurchas,
                'orderstatus' => $this->enc('denc', $orderstatus),
                'supplier' => $supplier,
                'glasstype' => $glasstype,
                'glassdescription' => $this->enc('denc', $glassdescription),
                'markinglocation' => $this->enc('denc', $markinglocation),
                'QTY' => $this->enc('denc', $QTY),
                'remarks' => $this->enc('denc', $remarks),
                'create_by' => $this->enc('denc', $create_by),
                'edit_by' => $this->enc('denc', $edit_by),
                'create_time' => $create_time,
                'edit_time' => $edit_time,
                'glasstype_id' => $glasstype_id,
                'glasstype_name' => $this->enc('denc', $glasstype_name),
                'supplier_id' => $supplier_id,
                'supplier_name' => $this->enc('denc', $supplier_name),
                'file' => $fs
            );
        }
        $this->response = array("msg" => '1', "data" => $_glassorders);
        return json_encode($this->response);
        exit();
    }



    public function glassorder_update($upinfo)
    {
        extract($upinfo);
        $this->sql = "UPDATE $this->pms_glassorders set 
                boq_itemno='$boq_itemno',
                glassorderno='$glassorderno',
                doneby='$doneby',
                releasedtopurchase='$releasedtopurchase',
                recivedfrompurchas='$recivedfrompurchas',
                orderstatus='$orderstatus',
                supplier=$supplier,
                glasstype=$glasstype,
                glassdescription='$glassdescription',
                markinglocation='$markinglocation',
                QTY='$QTY',
                remarks='$remarks',                
                edit_by='$edit_by',                
                edit_time='$edit_time' 
                where 
                glassorder_token='$glassorder_token'
                and
                project_id='$project_id'
                ";
        $this->cm = $this->cn->prepare($this->sql);
        if ($this->cm->execute()) {
            $this->response = array("msg" => "1", "data" => "Updated");
        } else {
            $this->response = array("msg" => "0", "data" => "DB Error");
        }
        return json_encode($this->response);
        exit();
    }

    public function GetGlassorderInforusingRefno($project_no, $orderno)
    {
        $this->project_id = $this->enc('enc', $project_no);
        $this->glassorderno =  $this->enc('enc', $orderno);
        $this->sql = "SELECT *FROM ($this->pms_glassorders 
            inner join $this->pms_glasstypes 
            on 
            $this->pms_glassorders.glasstype = $this->pms_glasstypes.glasstype_id) 
            inner join 
            $this->psm_suppliers 
            on 
            $this->pms_glassorders.supplier = $this->psm_suppliers.supplier_id 
            where 
            $this->pms_glassorders.project_id = :project_id and $this->pms_glassorders.glassorderno=:glassorderno";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":glassorderno", $this->glassorderno);
        $this->cm->bindParam(":project_id", $this->project_id);
        $this->cm->execute();
        $_ok = $this->cm->rowCount() > 0 ? true : false;

        if ($_ok === true) {
            $this->rows = $this->cm->fetch(PDO::FETCH_ASSOC);
            extract($this->rows);
            $_date = $this->enc('denc', $releasedtopurchase);
            $_releasedtopurchase = $_date;

            $_date1 = $this->enc('denc', $recivedfrompurchas);
            $_recivedfrompurchas = $_date1;
            if (date_create($_date)) {
                $__date = date_create($_date);
                $_releasedtopurchase = date_format($__date, 'd-M-Y');
            }

            if (date_create($_date1)) {
                $__date1 = date_create($_date1);
                $_recivedfrompurchas = date_format($__date1, 'd-M-Y');
            }

            $_glassorders = array(
                'glassorder_id' => $glassorder_id,
                'glassorder_token' => $glassorder_token,
                'project_id' => $this->enc('denc', $project_id),
                'boq_itemno' => $this->enc('denc', $boq_itemno),
                'glassorderno' => $this->enc('denc', $glassorderno),
                'doneby' => $this->enc('denc', $doneby),
                'releasedtopurchase' => $_releasedtopurchase,
                'recivedfrompurchas' => $_recivedfrompurchas,
                'orderstatus' => $this->enc('denc', $orderstatus),
                'supplier' => $supplier,
                'glasstype' => $glasstype,
                'glassdescription' => $this->enc('denc', $glassdescription),
                'markinglocation' => $this->enc('denc', $markinglocation),
                'QTY' => $this->enc('denc', $QTY),
                'remarks' => $this->enc('denc', $remarks),
                'create_by' => $this->enc('denc', $create_by),
                'edit_by' => $this->enc('denc', $edit_by),
                'create_time' => $create_time,
                'edit_time' => $edit_time,
                'glasstype_id' => $glasstype_id,
                'glasstype_name' => $this->enc('denc', $glasstype_name),
                'supplier_id' => $supplier_id,
                'supplier_name' => $this->enc('denc', $supplier_name)
            );
            $this->response = array("msg" => "1", "data" => $_glassorders);
        } else {
            $this->response = array("msg" => "0", "data" => "no data found");
        }
        return json_encode($this->response);
        exit();
    }

    public function RemoveGlassOrder($project_no, $token)
    {
        $this->project_id = $this->enc('enc', $project_no);
        $this->glassorder_token = $token;
        $this->sql = "Delete from $this->pms_glassorders where project_id=:project_id and glassorder_token=:glassorder_token";
        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->bindParam(":project_id", $this->project_id);
        $this->cm->bindParam(":glassorder_token", $this->glassorder_token);
        if ($this->cm->execute()) {
            $this->response = array(
                "msg" => "1",
                "data" => "Removed"
            );
        } else {
            $this->response = array(
                "msg" => "0",
                "data" => "Database error"
            );
        }

        return json_encode($this->response);
        exit();
    }

    public function getRpt(){
        $this->sql = "SELECT releasedtopurchase
        FROM `pms_glassorders`
        GROUP BY releasedtopurchase";

        $this->cm = $this->cn->prepare($this->sql);
        $this->cm->execute();
        $gr =[];
        while($rows = $this->cm->fetch(PDO::FETCH_ASSOC)){
            $gr[] = $rows['releasedtopurchase'];            
        }

        $this->response = array(
            "msg" => "1",
            "data" => $gr
        );

        unset($this->cm,$this->sql,$rows);
        return json_encode($this->response);
        exit();
    }

    public function rpt($releasedtopurchase)
    {
        $this->sql = "SELECT *FROM (($this->pms_glassorders 
            inner join $this->pms_glasstypes 
            on 
            $this->pms_glassorders.glasstype = $this->pms_glasstypes.glasstype_id) 
            inner join 
            $this->psm_suppliers 
            on 
            $this->pms_glassorders.supplier = $this->psm_suppliers.supplier_id) 
            inner join pms_project_summary on pms_project_summary.project_no=$this->pms_glassorders.project_id 
            where $this->pms_glassorders.releasedtopurchase = :releasedtopurchase 
            order by $this->pms_glassorders.glassorder_id desc
            ";

        $this->cm = $this->cn->prepare($this->sql);
        // $this->cm->bindParam(":project_id", $this->project_id);
        $this->cm->bindParam(":releasedtopurchase", $releasedtopurchase);
        $this->cm->execute();
        $_glassorders = [];
        while ($this->rows = $this->cm->fetch(PDO::FETCH_ASSOC)) {
            extract($this->rows);
            $_date = $this->enc('denc', $releasedtopurchase);
            $_releasedtopurchase = $_date;

            $_date1 = $this->enc('denc', $recivedfrompurchas);
            $_recivedfrompurchas = $_date1;

            $releasedtopurchase_s = $_date;
            if (date_create($_date)) {
                $__date = date_create($_date);
                $_releasedtopurchase = date_format($__date, 'd-M-Y');
                $releasedtopurchase_s = date_format($__date, 'Y-m-d');
            }

            $recivedfrompurchas_s = $_date1;
            if (date_create($_date1)) {
                $__date1 = date_create($_date1);
                $_recivedfrompurchas = date_format($__date1, 'd-M-Y');
                $recivedfrompurchas_s = date_format($__date1, 'Y-m-d');
            }
            $fs = "0";
            $fno = '../../assets/glassorder/' . $glassorder_token . "/";

            if (file_exists($fno)) {
                $fs = "1";
            } else {
                $fs = "0";
            }
            $items = [];
            $sql = "SELECT *FROM psm_glassorder_boqitems where boqitems_project=:boqitems_project and boqitems_glassorder_token=:boqitems_glassorder_token";
            $cm = $this->cn->prepare($sql);
            $_barams = array(
                ":boqitems_project" => $project_id,
                ":boqitems_glassorder_token" => $glassorder_token
            );
            $cm->execute($_barams);
            while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
                extract($rows);
                $items[] = array(
                    'boqitems_project' => $this->enc('denc', $boqitems_project),
                    'boqitems_glassorder_token' => $boqitems_glassorder_token,
                    'boqitems_itemid' => $this->enc('denc', $boqitems_itemid)
                );
            }

            $projectby = $this->enc('denc', $project_name) . " [" . $this->enc('denc', $project_no) . "]";
            $orderstatustxt = "";
            switch ($this->enc('denc', $orderstatus)) {
                case '1':
                    $orderstatustxt = 'ORDERED';
                    break;
                case '2':
                    $orderstatustxt = 'PENDING';
                    break;
                case '3':
                    $orderstatustxt = 'HOLD';
                    break;
                case '4':
                    $orderstatustxt = 'CANCELLED';
                    break;
                case '5':
                    $orderstatustxt = 'SUPERSEDED';
                    break;
                case '6':
                    $orderstatustxt = 'Others';
                    break;
            };
            $_glassorders[] = array(
                'orderstatustxt' => $orderstatustxt,
                'recivedfrompurchas_s' => $recivedfrompurchas_s,
                'releasedtopurchase_s' => $releasedtopurchase_s,
                'projectby' => $projectby,
                'glassorder_id' => $glassorder_id,
                'glassorder_token' => $glassorder_token,
                'project_id' => $this->enc('denc', $project_no),
                'boq_itemno' => $this->enc('denc', $boq_itemno),
                'glassorderno' => $this->enc('denc', $glassorderno),
                'doneby' => $this->enc('denc', $doneby),
                'releasedtopurchase' => $_releasedtopurchase,
                'recivedfrompurchas' => $_recivedfrompurchas,
                'orderstatus' => $this->enc('denc', $orderstatus),
                'supplier' => $supplier,
                'glasstype' => $glasstype,
                'glassdescription' => $this->enc('denc', $glassdescription),
                'markinglocation' => $this->enc('denc', $markinglocation),
                'QTY' => $this->enc('denc', $QTY),
                'remarks' => $this->enc('denc', $remarks),
                'create_by' => $this->enc('denc', $create_by),
                'edit_by' => $this->enc('denc', $edit_by),
                'create_time' => $create_time,
                'edit_time' => $edit_time,
                'glasstype_id' => $glasstype_id,
                'glasstype_name' => $this->enc('denc', $glasstype_name),
                'supplier_id' => $supplier_id,
                'supplier_name' => $this->enc('denc', $supplier_name),
                'file' => $fs,
                'items_list' => $items,
                'project_no' => $this->enc('denc', $project_no),
                'project_name' => $this->enc('denc', $project_name),
                'project_cname' => $this->enc('denc', $project_cname),
                'project_location' => $this->enc('denc', $project_location)
            );
        }
        $this->response = array("msg" => '1', "data" => $_glassorders);
        return json_encode($this->response);
        exit();
    }
}
