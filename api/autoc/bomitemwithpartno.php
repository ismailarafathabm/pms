<?php
header("Content-Type:text/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

require_once '../../connection/connection.php';
$conn = new connection();
$cn = $conn->connect();

require_once '../../controller/mac.php';
$enc = new mac();

$alloylist = _alloylist($cn, $enc);
$res = array(
    'alloy' => $alloylist,
    'description' => _description($cn, $enc),
    'units' => _unitlist($cn, $enc),
    'lenghts' => _lenghtlist($cn, $enc),
    'deiweight' => _dieweightlist($cn, $enc),
    'parfunctionlist' => _parfunctionlist($cn, $enc),
    'itemtypelist' => _itemtypelist($cn,$enc)
);

$response = array("msg" => "1", "data" => $res);
echo json_encode($response);

function _parfunctionlist($cn, $enc)
{
    $sql = "SELECT itempartfunction FROM bom_items  group by itempartfunction";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['itempartfunction'];
    }
    return $alloy;
}

function _alloylist($cn, $enc)
{
    $sql = "SELECT alloyname FROM bom_alloy group by alloyname";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['alloyname'];
    }
    unset($cm, $sql, $rows);
    return $alloy;
}

function _description($cn, $enc)
{
    $sql = "SELECT itemdescription FROM bom_items group by itemdescription";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['itemdescription'];
    }
    return $alloy;
}

function _unitlist($cn, $enc)
{
    $sql = "SELECT unitname FROM bom_units group by unitname";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['unitname'];
    }
    return $alloy;
}

function _lenghtlist($cn, $enc)
{
    $sql = "SELECT itemlength FROM bom_items group by itemlength";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['itemlength'];
    }
    return $alloy;
}

function _dieweightlist($cn, $enc)
{
    $sql = "SELECT itemdieweight FROM bom_items group by itemdieweight";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['itemdieweight'];
    }
    return $alloy;
}

function _itemtypelist($cn, $enc)
{
    $sql = "SELECT typename FROM bom_type group by typename";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $alloy = [];
    while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        $alloy[] = $rows['typename'];
    }
    return $alloy;
}
