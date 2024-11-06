<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'GET') {
    header('HTTP/1.0 404 page not found');
    echo response("0", "Request Method Not Acceptable");
    exit;
}
$auth = true;
include_once '../cuttinglists/auth.php';

if (!$auth) {
    header("HTTP/1.0 403 Authorization Error");
    echo response("0", "You Cannot Access This Page right Now Please Re-Login your Account");
    exit;
}

$ctmaterialstatus = autolist('ctmaterialstatus', $cn);
$cttrade = autolist('cttrade', $cn);
$currentsection = autolist('currentsection', $cn);

$datas = array(
    "ctmaterialstatus" => $ctmaterialstatus,
    "cttrade" => $cttrade,
    "currentsection" => $currentsection,
);
header("http/1.0 200 ok");
echo response("1", $datas);
exit();
function autolist($col, $cn)
{
    $sql = "SELECT $col from pms_cuttinglist_productions group by $col";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $gitem = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $item = $rows[$col];
        $gitem[] = $item;
    }
    unset($cm, $sql, $rows);
    return $gitem;
}
