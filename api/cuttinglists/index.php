<?php
include_once 'gen.php';

if ($method !== 'GET') {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once 'auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}
$scount = !isset($_GET['nrows']) || trim($_GET['nrows']) === '' ? 0 : (int)$_GET['nrows'];
include_once 'ctools.php';
$sql = "SELECT * FROM pms_cuttinglist limit  $scount,500";
$cm = $cn->prepare($sql);
$cm->execute();
$rpts = [];
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $rpt = ColsForCuttingList($rows);
    if ($rpt['ct_cby'] !== 'import') {
        $rpt['ctno'] = $rows["ctprojectno"] . "-" . $rows['ct_no'];
    } else {
        $rpt['ctno'] = $rows['ct_no'];
    }

    $mofile_flag = "0";
    $mofilename = $rows['ct_mono'] . "" . $users->enc('enc', $rows['ctprojectno']);
    $genlocation = "./../../assets/cuttinglists/";
    $molocation = "$genlocation/mo/$mofilename.pdf";
    if (file_exists($molocation)) {
        $mofile_flag = "1";
    }
    $rpt["mofilename"] =  $mofilename;
    $rpt["mofile"] = $mofile_flag;

    $current_department = "-";
    $current_status = "-";

    $issuedate = "-";
    $issuedate_d = datemethod(date('Y-m-d'));

    $returndate = "-";
    $returndate_d = datemethod(date('Y-m-d'));

    if ((string)$rpt['account_flag'] === "3") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_department = "Account";
        $current_status = "3";
        $returndate = $rpt['account_return'];
        $returndate_d = $rpt['account_return_l'];
        $issuedate = $rpt['account_release'];
        $issuedate_d = $rpt['account_release_l'];
    }
    if ((string)$rpt['account_flag'] === "2") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "2";
        $current_department = "Account";
        $issuedate = $rpt['account_release'];
        $issuedate_d = $rpt['account_release_l'];
    }

    //if it is material
    if ((string)$rpt['matterial_flag'] === "3") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "3";
        $current_department = "Material";
        $returndate = $rpt['material_return'];
        $returndate_d = $rpt['material_return_l'];
        $issuedate = $rpt['material_release'];
        $issuedate_d = $rpt['material_release_l'];
    }

    if ((string)$rpt['matterial_flag'] === "2") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "2";
        $current_department = "Material";
        $issuedate = $rpt['material_release'];
        $issuedate_d = $rpt['material_release_l'];
    }

    //if it is operation 
    if ((string)$rpt['operation_flag'] === "3") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "3";
        $current_department = "Operation";
        $returndate = $rpt['operation_return'];
        $returndate_d = $rpt['operation_return_l'];
        $issuedate = $rpt['operation_release'];
        $issuedate_d = $rpt['operation_release_l'];
    }

    if ((string)$rpt['operation_flag'] === "2") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "2";
        $current_department = "Operation";
        $issuedate = $rpt['operation_release'];
        $issuedate_d = $rpt['operation_release_l'];
    }

    //if is it production
    if ((string)$rpt['production_flag'] === "3") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "3";
        $current_department = "Production";
        $returndate = $rpt['production_accept'];
        $returndate_d = $rpt['production_accept_l'];

        $issuedate = $rpt['production_accept'];
        $issuedate_d = $rpt['production_accept_l'];
    }

    if ((string)$rpt['production_flag'] === "2") {
        $current_department = "-";
        $current_status = "-";
        $issuedate = "-";
        $issuedate_d = datemethod(date('Y-m-d'));
        $returndate = "-";
        $returndate_d = datemethod(date('Y-m-d'));

        $current_status = "2";
        $current_department = "Production";
        $issuedate = $rpt['production_accept'];
        $issuedate_d = $rpt['production_accept_l'];

        $issuedate = $rpt['production_accept'];
        $issuedate_d = $rpt['production_accept_l'];
    }






    $rpt['current_dep'] = $current_department;
    $rpt['issuedate'] =  $issuedate;
    $rpt['issuedate_d'] = $issuedate_d;
    $rpt['returndate'] = $returndate;
    $rpt['returndate_d'] = $returndate_d;
    $rpt['current_status'] = $current_status;

    $pjno = $rows['ctprojectno'];
    $ct_no = $users->enc('enc',$rows["ct_no"]);
    $mo_on = $users->enc('enc',$rows['ct_mono']);
    $ctfile = $users->enc('enc',$rows['ctprojectno']) . "-". $mo_on . "-" . $ct_no;

    $ctfilelocation = "$genlocation/cuttinglist/$ctfile.pdf";
    $ctfile_flag = file_exists($ctfilelocation) ? "1" : "0";
    $rpt['ctfilename'] = $ctfile;
    $rpt["ctfile"] = $ctfile_flag;
    $rpts[] = $rpt;
}
unset($cm, $sql, $rows);
header("HTTP/1.0 200 ok");
echo response("1", $rpts);
exit;
