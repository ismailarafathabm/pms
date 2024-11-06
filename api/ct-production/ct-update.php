<?php
include_once '../cuttinglists/gen.php';
if ($method !== 'POST') {
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
$payload = !isset($_POST['payload']) || trim($_POST['payload']) === '' ? '' : trim($_POST['payload']);
if ($payload === "") {
    header('http/1.0 409 error input');
    echo response("0", "Payload Missing");
    exit();
}
$datas = json_decode($payload);

foreach ($datas as $d) {
    $ctprid = !isset($d->ctprid) || trim($d->ctprid) === "" ? '0' : trim($d->ctprid);
    $ctid = !isset($d->ctid) || trim($d->ctid) === "" ? '0' : trim($d->ctid);
    if ($ctid === '0') {
        header("http/1.0 409 input missing");
        echo response("0", "Cutting list Id missing");
        exit();
    }

    $ctrdate = !isset($d->ctrdate) || trim($d->ctrdate) === "" ? '' : trim($d->ctrdate);
    if ($ctrdate === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Date");
        exit();
    }
    if (!date_create($ctrdate)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Date is not valid format");
        exit();
    }

    $ctmaterialstatus = !isset($d->ctmaterialstatus) || trim($d->ctmaterialstatus) === "" ? '' : trim($d->ctmaterialstatus);
    $cttrade = !isset($d->cttrade) || trim($d->cttrade) === "" ? '' : trim($d->cttrade);
    $ctrequrieqty = !isset($d->ctrequrieqty) || trim($d->ctrequrieqty) === "" ? '' : trim($d->ctrequrieqty);

    if ($ctrequrieqty === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Required Qty");
        exit();
    }
    if (!is_numeric($ctrequrieqty)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Required Qty is not valid number format");
        exit();
    }
    $ctreqarea = !isset($d->ctreqarea) || trim($d->ctreqarea) === "" ? '' : trim($d->ctreqarea);
    if ($ctreqarea === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Required Area");
        exit();
    }
    if (!is_numeric($ctreqarea)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Required Area is not valid number format");
        exit();
    }
    $deliverysh = !isset($d->deliverysh) || trim($d->deliverysh) === "" ? '' : trim($d->deliverysh);
    if ($deliverysh === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Delivery Date");
        exit();
    }
    if (!date_create($deliverysh)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Delivery Date is not valid format");
        exit();
    }
    $ctcby = $uuser;
    $cteby = $uuser;
    $ctcdate = $ddate;
    $ctedate = $ddate;

    // $ctedate = "0";
    $ctremarks = !isset($d->ctremarks) || trim($d->ctremarks) === "" ? '' : trim($d->ctremarks);    
    $currentsection = !isset($d->currentsection) || trim($d->currentsection) === "" ? '' : trim($d->currentsection);    
}



foreach ($datas as $d) {
    $ctprid = !isset($d->ctprid) || trim($d->ctprid) === "" ? '0' : trim($d->ctprid);
    $ctid = !isset($d->ctid) || trim($d->ctid) === "" ? '0' : trim($d->ctid);
    if ($ctid === '0') {
        header("http/1.0 409 input missing");
        echo response("0", "Cutting list Id missing");
        exit();
    }

    $ctrdate = !isset($d->ctrdate) || trim($d->ctrdate) === "" ? '' : trim($d->ctrdate);
    if ($ctrdate === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Date");
        exit();
    }
    if (!date_create($ctrdate)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Date is not valid format");
        exit();
    }

    $ctmaterialstatus = !isset($d->ctmaterialstatus) || trim($d->ctmaterialstatus) === "" ? '' : trim($d->ctmaterialstatus);
    $cttrade = !isset($d->cttrade) || trim($d->cttrade) === "" ? '' : trim($d->cttrade);
    $ctrequrieqty = !isset($d->ctrequrieqty) || trim($d->ctrequrieqty) === "" ? '' : trim($d->ctrequrieqty);

    if ($ctrequrieqty === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Required Qty");
        exit();
    }
    if (!is_numeric($ctrequrieqty)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Required Qty is not valid number format");
        exit();
    }
    $ctreqarea = !isset($d->ctreqarea) || trim($d->ctreqarea) === "" ? '' : trim($d->ctreqarea);
    if ($ctreqarea === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Required Area");
        exit();
    }
    if (!is_numeric($ctreqarea)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Required Area is not valid number format");
        exit();
    }
    $deliverysh = !isset($d->deliverysh) || trim($d->deliverysh) === "" ? '' : trim($d->deliverysh);
    if ($deliverysh === "") {
        header("http/1.0 409 input missing");
        echo response("0", "Enter Delivery Date");
        exit();
    }
    if (!date_create($deliverysh)) {
        header("http/1.0 409 input invalid");
        echo response("0", "Entered Delivery Date is not valid format");
        exit();
    }
    $ctcby = $uuser;
    $cteby = $uuser;
    $ctcdate = $ddate;
    $ctedate = $ddate;

    // $ctedate = "0";
    $ctremarks = !isset($d->ctremarks) || trim($d->ctremarks) === "" ? '' : trim($d->ctremarks);    
    $currentsection = !isset($d->currentsection) || trim($d->currentsection) === "" ? '' : trim($d->currentsection);
    if ((int)$ctprid === 0) {
        //save action
        //update cl 
        $sql = "UPDATE pms_cuttinglist set production_returnflag = 4 ,production_accept = :production_accept where ct_id = :ct_id";
        $cm = $cn->prepare($sql);
        // echo $ctid;
        $params_update = array(
            ":production_accept" => date_format(date_create($ctrdate), "Y-m-d"),
            ":ct_id" => $ctid
        );
        $up = $cm->execute($params_update);
        unset($cm, $sql, $rows);
        if (!$up) {
            header('http/1.0 500 error');
            echo response("0", "Error on update Cutting list datas");
            exit();
        }

        //cnt 
        $sql = "SELECT COUNT(ctid) as cnt FROM pms_cuttinglist_productions where ctid = :ctid";
        $cm = $cn->prepare($sql);
        $cm->bindParam(':ctid', $ctid);
        $cm->execute();
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        $cnt = (int)$rows['cnt'];
        unset($cm, $sql, $rows);
        if ($cnt === 0) {
            //save data 
            $save_params = array(
                ":ctid" => $ctid,
                ":ctrdate" => date_format(date_create($ctrdate), "Y-m-d"),
                ":ctmaterialstatus" => $ctmaterialstatus,
                ":cttrade" => $cttrade,
                ":ctrequrieqty" => $ctrequrieqty,
                ":ctreqarea" => $ctreqarea,
                ":ctcby" => $ctcby,
                ":cteby" => $cteby,
                ":ctcdate" => $ctcdate,
                ":ctedate" => $ctedate,
                ":ctflag" => "0",
                ":ctremarks" => $ctremarks,
                ":deliverysh" => date_format(date_create($deliverysh), "Y-m-d"),
                ":currentsection" => $currentsection,
            );
            $sql = "INSERT INTO pms_cuttinglist_productions values(
                null,
                :ctid,
                :ctrdate,
                :ctmaterialstatus,
                :cttrade,
                :ctrequrieqty,
                :ctreqarea,
                :ctcby,
                :cteby,
                :ctcdate,
                :ctedate,
                :ctflag,
                :ctremarks,
                :deliverysh,
                :currentsection
            )";
            $cm = $cn->prepare($sql);
            $sv = $cm->execute($save_params);
            unset($cm, $sql, $rows);
            if (!$sv) {
                header("http/1.0 500 error");
                echo response("0", "Error on Saveing Data");
                exit();
            }
        } else {
            $update_paramsx = array(
                ":ctmaterialstatus" => $ctmaterialstatus,
                ":cttrade" => $cttrade,
                ":ctrequrieqty" => $ctrequrieqty,
                ":ctreqarea" => $ctreqarea,
                ":cteby" => $cteby,
                ":ctedate" => $ctedate,
                ":ctremarks," => $ctremarks,
                ':deliverysh' => date_format(date_create($deliverysh), "Y-m-d"),
                ":currentsection" => $currentsection,
                ":ctprid" => $ctprid
            );

            $xdate = date_format(date_create($deliverysh), "Y-m-d");
            $sqlx = "UPDATE pms_cuttinglist_productions set 
            ctmaterialstatus = '$ctmaterialstatus',
            cttrade = '$cttrade',
            ctrequrieqty =  '$ctrequrieqty',
            ctreqarea = '$ctreqarea',
            cteby = '$cteby',
            ctedate =  '$ctedate',
            ctremarks = '$ctremarks',
            deliverysh = '$xdate',
            currentsection = '$currentsection' 
            where 
            ctprid = $ctprid";
           // echo $sqlx;
            $sqla = "UPDATE pms_cuttinglist_productions set 
                    ctmaterialstatus = :ctmaterialstatus,
                    cttrade = :cttrade,
                    ctrequrieqty = :ctrequrieqty,
                    ctreqarea = :ctreqarea,
                    cteby = :cteby,
                    ctedate = :ctedate,
                    ctremarks = :ctremarks,
                    deliverysh = :deliverysh,
                    currentsection = :currentsection 
                    where 
                    ctprid = :ctprid";
            
            $cma = $cn->prepare($sqlx);
            $up = $cma->execute();
            unset($cma, $sql, $rows);
            if (!$up) {
                header("http/1.0 500 error");
                echo response("0", "Error on updating Data");
                exit();
            }
        }
    } else {
        //update action
        $update_paramsa = array(
            ":ctmaterialstatus" => $ctmaterialstatus,
            ":cttrade" => $cttrade,
            ":ctrequrieqty" => $ctrequrieqty,
            ":ctreqarea" => $ctreqarea,
            ":cteby" => $cteby,
            ":ctedate" => $ctedate,
            ":ctremarks," => $ctremarks,
            ':deliverysh' => date_format(date_create($deliverysh), "Y-m-d"),
            ":currentsection" => $currentsection,
             ":ctprid" => $ctprid
        );

        $xdate = date_format(date_create($deliverysh), "Y-m-d");
        $sqlx = "UPDATE pms_cuttinglist_productions set 
        ctmaterialstatus = '$ctmaterialstatus',
        cttrade = '$cttrade',
        ctrequrieqty =  '$ctrequrieqty',
        ctreqarea = '$ctreqarea',
        cteby = '$cteby',
        ctedate =  '$ctedate',
        ctremarks = '$ctremarks',
        deliverysh = '$xdate',
        currentsection = '$currentsection' 
        where 
        ctprid = $ctprid";
       // echo $sqlx;
        $sqla = "UPDATE pms_cuttinglist_productions set 
                ctmaterialstatus = :ctmaterialstatus,
                cttrade = :cttrade,
                ctrequrieqty = :ctrequrieqty,
                ctreqarea = :ctreqarea,
                cteby = :cteby,
                ctedate = :ctedate,
                ctremarks = :ctremarks,
                deliverysh = :deliverysh,
                currentsection = :currentsection 
                where 
                ctprid = :ctprid";
        
        $cma = $cn->prepare($sqlx);
        $up = $cma->execute();
        unset($cma, $sql, $rows);
        if (!$up) {
            header("http/1.0 500 error");
            echo response("0", "Error on updating Data");
            exit();
        }
    }
}
header('http/1.0 200 ok');
echo response("1", "Updated");
exit();
