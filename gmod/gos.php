<?php 
    require_once '../connection/connection.php';
    $con = new connection();
    $cn = $con->connect();    
    $sql = "SELECT * FROM pms_cuttinglistgo where godate <= '2023-12-31' and `procurement_status`=1";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $gos = [];
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        $go = $rows;
        $gos[] = $go;
    }

    unset($cm,$sql,$rows);
    ?>
    <table>
        <thead>
            <tr>
                <td>S.NO</td>
                <td>GOID</td>
                <td>date</td>
                <td>GO NO</td>
                <td>Procurement Status</td>
                <td>Qty</td>
                <td>Area</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
    <?php
    $index = 1;
    $status = "-";
    foreach($gos as $go){
        $params = array(
            ":goreceiptgono" => $go["goid"],
            ":goreceiptgoprno" => $go["goprojectid"],
            ":goreceiptdate" =>  "2023-12-31",
            ":goreceiptinvoiceno" => "31.12.2023",
            ":goreceiptsupplier" => $go["procurement_supplier"],
            ":goreceiptqty" => $go["procurement_qty"],
            ":goreceiptarea" => $go["procurement_area"],
            ":goreceiptcby" => "import",
            ":goreceipteby" => "import",
            ":goreceiptcdate" => date('Y-m-d H:i:s'),
            ":goreceiptedate" => date('Y-m-d H:i:s'),
            ":goreceipt_flag" => "1",
            ":goreceipt_project" => $go["goproject"],
            ":goreceipt_projectname" => $go["goprojectname"],
            ":goreceipt_projectlocation" => $go["goprojectlocation"],
            ":goreceiptunitprice" => "0",
            ":goreceiptcalby" => "0",
            ":goreceiptotherprice" => "0",
            ":goreceipttotalprice" => "0",
        );
        $sql = "";
        $sql = "INSERT INTO pms_cuttinglistgoprocurement_receipt values(
            null,
            :goreceiptgono,
            :goreceiptgoprno,
            :goreceiptdate,
            :goreceiptinvoiceno,
            :goreceiptsupplier,
            :goreceiptqty,
            :goreceiptarea,
            :goreceiptcby,
            :goreceipteby,
            :goreceiptcdate,
            :goreceiptedate,
            :goreceipt_flag,
            :goreceipt_project,
            :goreceipt_projectname,
            :goreceipt_projectlocation,
            :goreceiptunitprice,
            :goreceiptcalby,
            :goreceiptotherprice,
            :goreceipttotalprice
        )";
        $cm = $cn->prepare($sql);
        $sv = $cm->execute($params);
        $status = $sv ? "DONE" : "ERROR";
        echo "<tr>";
        echo "<td>". $index ."</td>";
        echo "<td>". $go['goid'] ."</td>";
        echo "<td>". $go['godate'] ."</td>";
        echo "<td>". $go['gonumber'] ."</td>";
        echo "<td>". $go['procurement_status'] ."</td>";
        echo "<td>". $go['procurement_qty'] ."</td>";
        echo "<td>". $go['procurement_area'] ."</td>";
        echo "<td>". $status ."</td>";       
        echo "</tr>";
        $index += 1;
    }
?>
</tbody>
</table>