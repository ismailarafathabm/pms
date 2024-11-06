<?php 
    $file = "pgs12.json";
    $content = file_get_contents($file);
    $datas = json_decode($content);
    include_once '../../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();
    foreach($datas as $d){
        //print_r($d);
        $gno = $d->Order;
        $params = array(
            ":procurement_orderdate" => date_format(date_create($d->Datex), 'Y-m-d'),
            ":procurement_supplier" => $d->Supplier,
            ":procurement_coating" => $d->Coating,
            ":procurement_thickness" => $d->Thickness,
            ":procurement_out" => $d->Out,
            ":procurement_inner" => $d->Inner,
            ":procurment_orderunitprice" => !isset($d->PriceSqm) ? '0' : $d->PriceSqm,
            ":procurement_otherprice" => $d->Extra,
            ":procurement_totalprice" => $d->Total,
            ":procurement_calby" => 'a',
            ":procurement_qty" => $d->Qty,
            ":procurement_area" => $d->Sqm,
            ":goreceipttype" => $d->Type,
            ":broken_by" => $d->Type === 'GO' ? '' : "-",
            ":broken_naf_by" => $d->Type === 'GO' ? '' :"-",
            ":broken_go_oldno" => $d->Type === 'GO' ? '' : "-",
            ":broken_go_enggineer" => $d->Type === 'GO' ? '' : "-",
            ":broken_description" => $d->Type === 'GO' ? '' : "-",
            ":broken_engg" => $d->Type === 'GO' ? '' : "-",
            ":proucrementeta" => !isset($d->DeliverySchedule) ? '' : $d->DeliverySchedule,
            ":invoiceno" => !isset($d->PI) ? '' : $d->PI,
            ":uinsert" => !isset($d->Uinserts) ? '' : $d->Uinserts,
            ":procurementremark" => $d->Remarks,
            ":dellocation" => !isset($d->Location) ? '' : $d->Location,
            ":workorderno" => !isset($d->WorkOrderRef) ? '' : $d->WorkOrderRef, 
            ":goorderno" => $gno
        );
       
        $sql = "SELECT COUNT(goorderno) as cnt from pms_cuttinglistgo where goorderno = '".$gno."'";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $cnt = $rows['cnt'];        
        unset($rows,$cm,$sql);
        echo $gno;
        echo "----";
        echo $cnt;
        echo "</br>";
        // if((int)$cnt !== 0){
        // echo $gno;
        // echo "----";
        // echo $cnt;
        // echo "</br>";
        // }
        // $sql = "UPDATE pms_cuttinglistgo set
        // procurement_orderdate = :procurement_orderdate,
        // procurement_supplier = :procurement_supplier,
        // procurement_coating = :procurement_coating,
        // procurement_thickness = :procurement_thickness,
        // procurement_out = :procurement_out,
        // procurement_inner = :procurement_inner,
        // procurment_orderunitprice = :procurment_orderunitprice,
        // procurement_otherprice = :procurement_otherprice,
        // procurement_totalprice = :procurement_totalprice,
        // procurement_calby = :procurement_calby,
        // procurement_qty = :procurement_qty,
        // procurement_area = :procurement_area,
        // goreceipttype = :goreceipttype,
        // broken_by = :broken_by,
        // broken_naf_by = :broken_naf_by,
        // broken_go_oldno = :broken_go_oldno,
        // broken_go_enggineer = :broken_go_enggineer,
        // broken_description = :broken_description,
        // broken_engg = :broken_engg,
        // proucrementeta = :proucrementeta,
        // invoiceno = :invoiceno,
        // uinsert = :uinsert,
        // procurementremark = :procurementremark,
        // dellocation = :dellocation,
        // workorderno = :workorderno,
        // procurement_status = 1
        // where goorderno = :goorderno";
        // $cm = $cn->prepare($sql);
        // $up = $cm->execute($params);
        // unset($sql, $cm);
       // print_r($params);
    }


    //readfile($content);
?>