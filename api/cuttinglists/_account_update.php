<?php
function updateAccounts($cn,$updateinfo,$ct_id,$project,$mo_no){
$account_flag = !isset($updateinfo->account_flag) || trim($updateinfo->account_flag) === '' ? '0' : trim($updateinfo->account_flag);
$account_release = date('Y-m-d');
$account_return = date('Y-m-d');
if ((int)$account_flag >= 2) {
    $account_release = !isset($updateinfo->account_release) || trim($updateinfo->account_release) === '' ? '' : trim($updateinfo->account_release);
    if ($account_release === '') {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Date"));
        die();
    }

    if(!date_create($account_release)){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
        die();
    }
    $account_release = date_format(date_create($updateinfo->account_release),'Y-m-d');

}

if((int)$account_flag === 3){
    $account_return = !isset($updateinfo->account_return) || trim($updateinfo->account_return) === '' ? '' : trim($updateinfo->account_return);
    if ($account_return === '') {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Date"));
        die();
    }

    if(!date_create($account_return)){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
        die();
    }
    $account_return = date_format(date_create($updateinfo->account_return),'Y-m-d');
}

//update mo status
$params_mo = array(
    ":c_mo_accountfalg" => $account_flag,
    ":c_mo_account_issue" => $account_release,
    ":c_mo_account_release" => $account_return,
    ":c_mono" => $mo_no,
    ":ctprojectno" => $project,
);
$sql = "" ;
$sql = "UPDATE pms_cuttinglist_mo set c_mo_accountfalg=:c_mo_accountfalg,
            c_mo_account_issue = :c_mo_account_issue,
            c_mo_account_release = :c_mo_account_release where c_mono = :c_mono and ctprojectno = :ctprojectno";
$cm = $cn->prepare($sql);
$okmo = $cm->execute($params_mo);
if (!$okmo) {
    header("HTTP/1.0 500 Server Error");
    echo response("0", "Error on Updating Mo");
    die();
}

$sql = "" ;
//update ct status
$sql = "UPDATE pms_cuttinglist set account_flag = :account_flag,
    account_release = :account_release,
    account_return = :account_return 
    where ct_id = :ct_id";

$params = array(
    ":account_flag" => $account_flag,
    ":account_release" => $account_release,
    ":account_return" => $account_return,
    ":ct_id" => $ct_id,    
);
$cm = $cn->prepare($sql);
$okcl = $cm->execute($params);
if (!$okcl) {
    header("HTTP/1.0 500 Server Error");
    echo response("0", "Error on Update Account Details");
    die();
}

//echo $ct_id . "DONE";
}
