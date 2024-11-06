<?php
include_once '../../connection/connection.php';
$conn = new connection();
$cn = $conn->connect();
$payload = $_POST['payload'];

$datas = json_decode($payload);
//print_r($payload);
$response = [];
foreach ($datas as $d) {
    $adate = date_format(date_create($d->godate), 'Y-m-d');
    $uuser = "IMPORT";
    $ddate = date('Y-m-d h:i:s');
    $params = array(
        ':goprojectid' => '0',
        ':goproject' => $d->goproject,
        ':goprojectname' => $d->goprojectname,
        ':goprojectlocation' => '-',
        ':gonumber' => $d->gonumber,
        ':gosupplier' => $d->gosupplier,
        ':goglasstype' => '-',
        ':goglassspec' => '-',
        ':gomarking' => $d->gomarking,
        ':goqty' => $d->goqty,
        ':goarea' => $d->goarea,
        ':godoneby' => '-',
        ':godate' => $adate,
        ':gopflag' => '3',
        ':goprelease' => $adate,
        ':gopreturn' => $adate,
        ':remarks' => 'IMPORT DATA',
        ':gocostingflag' => '3',
        ':gocostingrelease' => $adate,
        ':gocosingreturn' => $adate,
        ':cby' => $uuser,
        ':eby' => $uuser,
        ':cdate' => $ddate,
        ':edate' => $ddate,
        ':othersdesc' => "EXCEL IMPORT DATA",
        ':gotype' => 1,
        ':gootype' => 2,
        ':rgono' => $d->gonumber,
        ':procurement_status' => 1,
        ':procurement_orderdate' => $adate,
        ':procurment_orderunitprice' => $d->procurment_orderunitprice,
        ':procurement_calby' => 'a',
        ':procurement_otherprice' => 0,
        ':procurement_totalprice' => $d->procurement_totalprice,
        ':procurement_supplier' => $d->gosupplier,
        ':procurement_coating' => '-',
        ':procurement_thickness' => '-',
        ':procurement_out' => '-',
        ':procurement_inner' => '-',
        ':procurement_qty' => $d->goqty,
        ':procurement_area' => $d->goarea,
        ':goreceipttype' => $d->goreceipttype,
        ':broken_by' => 'NAFCO',
        ':broken_naf_by' => $d->broken_naf_by,
        ':broken_go_oldno' => '-',
        ':broken_go_enggineer' => '-',
        ':broken_description' => '-',
        ':broken_engg' => '-',
        ':proucrementeta' => '-',
        ':invoiceno' => '-',
        ':uinsert' => '-',
        ':procurementremark' => "EXCEL IMPORT DATA",
        ':dellocation' => $d->dellocation,
        ':workorderno' => '-',
        ':goorderno' => ''



    );
    $sql = "INSERT INTO pms_cuttinglistgo values(
        null,
        :goprojectid,
        :goproject,
        :goprojectname,
        :goprojectlocation,
        :gonumber,
        :gosupplier,
        :goglasstype,
        :goglassspec,
        :gomarking,
        :goqty,
        :goarea,
        :godoneby,
        :godate,
        :gopflag,
        :goprelease,
        :gopreturn,
        :remarks,
        :gocostingflag,
        :gocostingrelease,
        :gocosingreturn,
        :cby,
        :eby,
        :cdate,
        :edate,
        :othersdesc,
        :gotype,
        :gootype,
        :rgono,
        :procurement_status,
        :procurement_orderdate,
        :procurment_orderunitprice,
        :procurement_calby,
        :procurement_otherprice,
        :procurement_totalprice,
        :procurement_supplier,
        :procurement_coating,
        :procurement_thickness,
        :procurement_out,
        :procurement_inner,
        :procurement_qty,
        :procurement_area,
        :goreceipttype,
        :broken_by,
        :broken_naf_by,
        :broken_go_oldno,
        :broken_go_enggineer,
        :broken_description,
        :broken_engg,
        :proucrementeta,
        :invoiceno,
        :uinsert,
        :procurementremark,
        :dellocation,
        :workorderno,
        :goorderno
    )";
    $cm = $cn->prepare($sql);
    $sv = $cm->execute($params);
    $oks = $sv ? "OK" : "ERROR";
    $res = array("gono" => $d->gonumber, "status" => $oks);
    $response[] = $res;
}
header("Content-type:application/json");
echo json_encode($response);
