<!-- <?php
header("Access-Control-Allow-Origin: *");
$payload = json_decode($_POST["import"]);
$sno = 0;
include_once '../connection/connection.php';
$conn = new connection();
$cn = $conn->connect();
foreach ($payload as $p) {
    $sno += 1;

    if ($sno > 12000) {
      
        $ct_no = $p->cuttinglistno;

        $sql = "UPDATE pms_cuttinglist set ct_no=:ct_no where ct_id = :ct_id";
        $params = array(
            ":ct_no" => $ct_no,
            ":ct_id" => $sno,
        );
        $faccount = $p->faccount;
        $raccount = $p->raccount;
        $account_flag = "0";

        if ($faccount === "-----" || trim($faccount) === '' || !is_numeric($faccount)) {
            $account_release = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $faccount;
            $date->modify("+$dayval day -1 day");
            $account_release = $date->format('Y-m-d');
            $account_flag = "2";
        }

        if ($raccount === "-----" || trim($raccount) === '' || !is_numeric($raccount)) {
            $account_return = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $raccount;
            $date->modify("+$dayval day -1 day");
            $account_return = $date->format('Y-m-d');
            $account_flag = "3";
        }


        $ct_no = $p->cuttinglistno;
        //$ct_no = "1";
        $ct_mono = $p->monumber;
        $ct_marking = $p->marking;
        $ct_description = $p->description;
        $ct_location = $p->location;
        $ct_qty = $p->qty;
        $ct_height = $p->height;
        $ct_width = $p->width;
        $ct_area = $p->area;
        $ct_doneby = '-';
        $ct_section = '-';
        $ct_mrefno = "-";
        $ddate = date('Y-m-d H:i:s');
        $uuser = "import";

        $matterial_flag = "0";
        $fmaterial = $p->fmaterial;
        $rmaterial = $p->rmaterial;

        if ($fmaterial === "-----" || trim($fmaterial) === '' || !is_numeric($fmaterial)) {
            $material_release = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $fmaterial;
            $date->modify("+$dayval day -1 day");
            $material_release = $date->format('Y-m-d');
            $matterial_flag = "2";
        }

        if ($rmaterial === "-----" || trim($rmaterial) === '' || !is_numeric($rmaterial)) {
            $material_return = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $rmaterial;
            $date->modify("+$dayval day -1 day");
            $material_return = $date->format('Y-m-d');
            $matterial_flag = "3";
        }

        $operation_flag = "0";
        $foperation = $p->foperation;
        $roperation = $p->roperation;

        if ($foperation === "-----" || trim($foperation) === '' || !is_numeric($foperation)) {
            $operation_release = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $foperation;
            $date->modify("+$dayval day -1 day");
            $operation_release = $date->format('Y-m-d');
            $operation_flag = "2";
        }

        if ($roperation === "-----" || trim($roperation) === '' || !is_numeric($roperation)) {
            $operation_return = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $roperation;
            $date->modify("+$dayval day -1 day");
            $operation_return = $date->format('Y-m-d');
            $operation_flag = "3";
        }

        $production_flag = "0";
        $rproecution = $p->rproecution;


        if ($rproecution === "-----" || trim($rproecution) === '' || !is_numeric($rproecution)) {
            $production_release = date('Y-m-d');
            $production_accept = date('Y-m-d');
        } else {
            $date = new DateTime('1899-12-31');
            $dayval = $rproecution;
            $date->modify("+$dayval day -1 day");
            $production_release = $date->format('Y-m-d');
            $production_accept = $date->format('Y-m-d');
            $operation_flag = "3";
        }

        $ctunit = "";
        $mgono = "-";
        $materialstatus = $p->mstatus;
        $materialrefno = $p->mstatus;
        $forlocation = "-";
        $projectid = "0";
        $boqid = "0";
        $ct_notes = "IMPORT FROM EXCEL";
        $cttype = "1";
        $ctprojectname = $p->projectname;
        $ctprojectlocation = '-';
        $ctprojectno = $p->projectcode;
        $params = array(
            ':ct_no' => $ct_no,
            ':ct_type' => "1",
            ':ct_mono' => $ct_mono,
            ':ct_marking' => $ct_marking,
            ':ct_description' => $ct_description,
            ':ct_location' => $ct_location,
            ':ct_qty' => $ct_qty,
            ':ct_height' => $ct_height,
            ':ct_width' => $ct_width,
            ':ct_area' => $ct_area,
            ':ct_doneby' => $ct_doneby,
            ':ct_date' => date('Y-m-d'),
            ':ct_section' => $ct_section,
            ':ct_mrefno' => $ct_mrefno,
            ':ct_cddate' => $ddate,
            ':ct_eddate' => $ddate,
            ':ct_cby' => $uuser,
            ':ct_eby' => $uuser,
            ':account_flag' => $account_flag,
            ':matterial_flag' => $matterial_flag,
            ':operation_flag' => $operation_flag,
            ':production_flag' => $production_flag,
            ':production_returnflag' => "1",
            ':account_release' => $account_release,
            ':account_return' => $account_return,
            ':material_release' => $material_release,
            ':material_return' => $material_return,
            ':operation_release' => $operation_release,
            ':operation_return' => $operation_return,
            ':production_release' => $production_release,
            ':production_accept' => date('Y-m-d'),
            ':ctunit' => $ctunit,
            ':mgono' => $mgono,
            ':materialstatus' => $materialstatus,
            ':materialrefno' => $materialrefno,
            ':forlocation' => $forlocation,
            ':projectid' => $projectid,
            ':iscancelled' => "1",
            ':cancelreson' => "-",
            ':cancelledby' => "-",
            ':cancelleddate' => date('Y-m-d'),
            ':issupersede' => "1",
            ':supersededate' => date('Y-m-d'),
            ':supersedeby' => "-",
            ':supersededescription' => "-",
            ':supersedeoldctno' => "-",
            ':supersedemono' => "-",
            ':boqid' => $boqid,
            ":ct_notes" => $ct_notes,
            ":cttype" => $cttype,
            ":ctprojectname" => $ctprojectname,
            ":ctprojectlocation" => $ctprojectlocation,
            ":ctprojectno" => $ctprojectno

        );
        // print_r($params);
        // exit;

        $sql = "INSERT INTO pms_cuttinglist Values(
                null,
                :ct_no,
                :ct_type,
                :ct_mono,
                :ct_marking,
                :ct_description,
                :ct_location,
                :ct_qty,
                :ct_height,
                :ct_width,
                :ct_area,
                :ct_doneby,
                :ct_date,
                :ct_section,
                :ct_mrefno,
                :ct_cddate,
                :ct_eddate,
                :ct_cby,
                :ct_eby,
                :account_flag,
                :matterial_flag,
                :operation_flag,
                :production_flag,
                :production_returnflag,
                :account_release,
                :account_return,
                :material_release,
                :material_return,
                :operation_release,
                :operation_return,
                :production_release,
                :production_accept,
                :ctunit,
                :mgono,
                :materialstatus,
                :materialrefno,
                :forlocation,
                :projectid,       
                :iscancelled, 
                :cancelreson,
                :cancelledby,
                :cancelleddate,
                :issupersede,
                :supersededate,
                :supersedeby,
                :supersededescription,
                :supersedeoldctno,
                :supersedemono,
                :boqid,
                :ct_notes,
                :cttype,
                :ctprojectname,
                :ctprojectlocation,
                :ctprojectno
            )";

        $cm = $cn->prepare($sql);
        // $issave = $cm->execute($params);
        // if ($issave) {
        //     echo "ok";
        // } else {
        //     echo "error";
        // }
        // unset($cm, $sql);


        if ($sno === 14503) {
            exit;
        }
    }

    // exit;
}


// SELECT `c_moproject` , `c_mo_boqid` , `c_mo_accountfalg` , `c_mo_account_issue` , `c_mo_account_release` , `cttype` , `ctprojectname` , `ctprojectlocation` , `ctprojectno` , COUNT( c_mono ) AS cnt
// FROM `pms_cuttinglist_mo`
// GROUP BY `c_moproject` , `c_mo_boqid` , `c_mo_accountfalg` , `c_mo_account_issue` , `c_mo_account_release` , `cttype` , `ctprojectname` , `ctprojectlocation` , `ctprojectno`
// LIMIT 0 , 30 -->
