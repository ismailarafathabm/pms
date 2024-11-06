<?php
include_once 'gen.php';
if ($method !== 'POST') {
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

$flagtype = !isset($_GET['ftype']) || trim($_GET['ftype']) === '' ? '' : $_GET["ftype"];
if ($flagtype === '') {
    header("HTTP/1.0 400 error bad Request");
    echo response("0", "Flag Type Is Missing");
    exit;
}


$ct_id = !isset($_GET['ct_no']) || trim($_GET['ct_no']) === '' ? '' : $_GET["ct_no"];

if ($ct_id === '') {
    header("HTTP/1.0 400 error bad request");
    echo response("0", "Cutting List Id Missing");
    exit;
}

$payload = !isset($_POST['payload']) || trim($_POST['payload']) === '' ? '' : $_POST['payload'];
//print_r($payload);
if ($payload === '') {
    header("HTTP/1.0 400 bad Request");
    echo response("0", "POST Data missing");
    exit;
}

$d = json_decode($payload);

$status = !isset($d->flagstatus) || trim($d->flagstatus) === "" ? '0' : $d->flagstatus;


$cid = !isset($d->ct_no) || trim($d->ct_no) === "" ? '' : $d->ct_no;
$moid = !isset($d->moid) || trim($d->moid) === "" ? '' : $d->moid;
$mono = !isset($d->ct_mono) || trim($d->ct_mono) === "" ? '' : $d->ct_mono;
$project = !isset($d->project) || trim($d->project) === "" ? '' : $d->project;

$agdate = date("Y-m-d");
if ((int)$status >= 2) {
    $agdate = !isset($d->issuedate_update) || trim($d->issuedate_update) === "" ? '' : $d->issuedate_update;
    if ($agdate === "") {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Enter Released Date");
        exit;
    }

    if (!date_create($agdate)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Release Date Not valid Format");
        exit;
    }
    $agdate = date_format(date_create($agdate), 'Y-m-d');
}
$redate = date("Y-m-d");
if ((int)$status >= 3) {
    $redate = !isset($d->reserved_update) || trim($d->reserved_update) === "" ? '' : $d->reserved_update;
    if ($redate === "") {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Return Released Date");
        exit;
    }

    if (!date_create($redate)) {
        header("HTTP/1.0 400 error bad request");
        echo response("0", "Return Date Not valid Format");
        exit;
    }
    $redate = date_format(date_create($redate), 'Y-m-d');
}


switch ($flagtype) {
    case 'account_flag':
        //update flag status 
        $updated = UpdateAccountFlage($cn, $status, $agdate, $redate, $moid, $mono, $project);
        if (!$updated) {
            header("HTTP/1.0 500 error");
            echo response("0", "Error On Update");
            exit;
        } else {
            header("HTTP/1.0 200 Error");
            echo response("1", "Updated");
            exit;
        }
        break;
    case 'matterial_flag':
        $materialstatus = !isset($d->materialstatus) || trim($d->materialstatus) === "" ? '' : $d->materialstatus;
        $materialrefno = !isset($d->materialrefno) || trim($d->materialrefno) === "" ? '' : $d->materialrefno;
        if ((int)$status >= 3) {
            if ($materialstatus === "") {
                header("HTTP/1.0 400 error");
                echo response("0", "Enter Material Status");
                exit;
            }
            if ($materialrefno === "") {
                header("HTTP/1.0 400 error");
                echo response("0", "Enter Material Ref No");
                exit;
            }
        }
        $updated = updatematerialstatus($cn, $status, $agdate, $redate, $materialstatus, $materialrefno, $cid);

        if (!$updated) {
            header("HTTP/1.0 500 error");
            echo response("0", "Error On Update");
            exit;
        } else {
            header("HTTP/1.0 200 Error");
            echo response("1", "Updated");
            exit;
        }
        break;
    case 'operation_flag':
        $updated = updateoperationstatus($cn, $status, $agdate, $redate, $cid);

        if (!$updated) {
            header("HTTP/1.0 500 error");
            echo response("0", "Error On Update");
            exit;
        } else {
            header("HTTP/1.0 200 Error");
            echo response("1", "Updated");
            exit;
        }
        break;
    case 'production_flag':
        $updated = updateproductionupdate($cn, $status, $agdate, $redate, $cid);

        if (!$updated) {
            header("HTTP/1.0 500 error");
            echo response("0", "Error On Update");
            exit;
        } else {
            header("HTTP/1.0 200 Error");
            echo response("1", "Updated");
            exit;
        }
        break;
}





$flagmode = !isset($flagmode) || trim($flagmode) === '' ? '1' : $d->flagmode;




function UpdateAccountFlage(
    $cn,
    $status,
    $agdate,
    $redate,
    $moid,
    $mono,
    $project
) {
    //update mo 
    $sql = "UPDATE pms_cuttinglist_mo set c_mo_accountfalg = :c_mo_accountfalg,
        c_mo_account_issue = :c_mo_account_issue,
        c_mo_account_release = :c_mo_account_release where mono = :mono and c_moproject = :c_moproject";
    $params = array(
        ":c_mo_accountfalg" => $status,
        ":c_mo_account_issue" => $agdate,
        ":c_mo_account_release" => $redate,
        ":mono" => $mono,
        ":c_moproject" => $project,
    );
    $cm = $cn->prepare($sql);
    $cm->execute($params);
    unset($sql, $cm, $params);
    //update cuttinglist
    $sql = "UPDATE pms_cuttinglist set account_flag = :account_flag,
        account_release = :account_release,
        account_return = :account_return 
        where ct_mono = :ct_mono and projectid = :projectid";
    $params = array(
        ":account_flag" => $status,
        ":account_release" => $agdate,
        ":account_return" => $redate,
        ":ct_mono" => $mono,
        ":projectid" => $project
    );
    $cm = $cn->prepare($sql);
    $isupdate = $cm->execute($params);
    unset($cm, $sql);
    return $isupdate;
}

function updatematerialstatus($cn, $status, $agdate, $redate, $materialstatus, $materialrefno, $ct_id)
{
    $sql = "UPDATE pms_cuttinglist set 
        matterial_flag = :matterial_flag,
        material_release = :material_release,
        material_return = :material_return,
        materialstatus = :materialstatus,
        materialrefno = :materialrefno 
        where 
        ct_id = :ct_id";
    $cm = $cn->prepare($sql);
    $params = array(
        ':matterial_flag' => $status,
        ':material_release' => $agdate,
        ':material_return' => $redate,
        ':materialstatus' => $materialstatus,
        ':materialrefno' => $materialrefno,
        ':ct_id' => $ct_id
    );
    $isupdate = $cm->execute($params);
    unset($cm, $sql);
    return $isupdate;
}

function updateoperationstatus($cn, $status, $agdate, $redate, $ct_id)
{
    $sql = "UPDATE pms_cuttinglist set 
        operation_flag = :operation_flag,
        operation_release = :operation_release,
        operation_return = :operation_return        
        where 
        ct_id = :ct_id";
    $cm = $cn->prepare($sql);
    $params = array(
        ':operation_flag' => $status,
        ':operation_release' => $agdate,
        ':operation_return' => $redate,
        ':ct_id'  => $ct_id,
    );
    $isupdate = $cm->execute($params);
    unset($cm, $sql);
    return $isupdate;
}


function updateproductionupdate($cn, $status, $agdate, $redate, $ct_id)
{
    $sql = "UPDATE pms_cuttinglist set 
        production_flag = :production_flag,
        production_release = :production_release,
        production_accept = :production_accept        
        where 
        ct_id = :ct_id";
    $cm = $cn->prepare($sql);
    $params = array(
        ':production_flag' => $status,
        ':production_release' => $agdate,
        ':production_accept' => $redate,
        ':ct_id'  => $ct_id,
    );
    $isupdate = $cm->execute($params);
    unset($cm, $sql);
    return $isupdate;
}
