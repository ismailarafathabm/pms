<?php 
    //header("Content-Type:application/json");
    $cont = file_get_contents("fx.json");
   // echo $cont;
    $datas = json_decode($cont);
    require_once '../../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();
    //echo count($datas);
    $k = 0;
    for($i=0;$i< count($datas);$i++){
        $gono = $datas[$i]->Order;
        $sql = "SELECT COUNT(goorderno) as cnt from pms_cuttinglistgo where goorderno = '".$gono."'";
        //echo $sql;
        $cm = $cn->prepare($sql);
        $cm->execute();
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $cnt = $rows['cnt'];        
        
        unset($rows,$cm,$sql);
        if((int)$cnt === 1){
            $k += 1;
            echo $k ."-";
            echo $gono ."-". $cnt;
            echo "</br>";

            $sql = "UPDATE pms_cuttinglistgo set 
            procurement_status = :procurement_status,
            procurement_orderdate = :procurement_orderdate,
            procurement_supplier = :procurement_supplier,
            procurement_coating = :procurement_coating,
            procurement_thickness = :procurement_thickness,
            procurement_out = :procurement_out,
            procurement_inner = :procurement_inner,
            procurement_qty = :procurement_qty,
            procurement_area = :procurement_area,
            goreceipttype = :goreceipttype,
            proucrementeta = :proucrementeta,
            uinsert = :uinsert,
            procurementremark = :procurementremark,
            dellocation = :dellocation,
            workorderno = :workorderno
            where goorderno = :goorderno";

            $procurement_status = "1";
            $procurement_orderdate = $datas[$i]->Date;
            $procurement_supplier = $datas[$i]->supplier;
            $procurement_coating = $datas[$i]->Coating;
            $procurement_thickness = $datas[$i]->Thickness;
            $procurement_out = $datas[$i]->Out;
            $procurement_inner = $datas[$i]->Inner;
            $procurement_qty = $datas[$i]->Qty;
            $procurement_area = $datas[$i]->sqm;
            $goreceipttype = $datas[$i]->Type;
            $proucrementeta = $datas[$i]->DeliverySchedule;
            $uinsert = $datas[$i]->Uinserts;
            $procurementremark = $datas[$i]->Remarks;
            $dellocation = $datas[$i]->Location;
            $workorderno = $datas[$i]->WorkOrderRef;
            $goorderno = $datas[$i]->Order;
            $pararams = array(
                ":procurement_status" => $procurement_status,
                ":procurement_orderdate" => $procurement_orderdate,
                ":procurement_supplier" => $procurement_supplier,
                ":procurement_coating" => $procurement_coating,
                ":procurement_thickness" => $procurement_thickness,
                ":procurement_out" => $procurement_out,
                ":procurement_inner" => $procurement_inner,
                ":procurement_qty" => $procurement_qty,
                ":procurement_area" => $procurement_area,
                ":goreceipttype" => $goreceipttype,
                ":proucrementeta" => $proucrementeta,
                ":uinsert" => $uinsert,
                ":procurementremark" => $procurementremark,
                ":dellocation" => $dellocation,                
                ":workorderno" => $workorderno,
                ":goorderno" => $goorderno,
            );

            $cm = $cn->prepare($sql);
            $k = $cm->execute($pararams);            
            unset($cm,$sql);

            if($k){
                echo "ok";
            }else{
                echo "ERROR";
            }
        
        }
        
        
    }
    exit();
?>