<?php 
    if (!isset($budget)) {
        include_once '../_error.php';
    }

    $data = json_decode($ponew);
    
    $po = $data->po;
   // print_r($po);
    $dt = $data->dt;
    $paymentterms = $data->paymentterms;
    $deliveryterms = $data->deliveryterms;
    $totprice = $data->totprice;
    $vatval = $data->vatval;
    $subttoal = $data->subttoal;
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s ");
    $ponewproject = $ponewproject;
    $poinfo = array(
        ':ponewrefno' => $po->porefno,
        ':ponewsupplier' => $po->posupplier,
        ':ponewfrom' => $po->pofrm,
        ':ponewsubject' => $po->podescription,
        ':ponewvat' => $vatval,
        ':ponewtotval' => $subttoal,
        ':ponewtype' => $po->potype,
        ':ponewproject' => $ponewproject,
        ':ponewcby' => $uuser,
        ':poneweby' => $uuser,
        ':ponewcdate' => $ddate,
        ':ponewedate' => $ddate,
        ':ponewpostflag' => 'o',
        ':ponewdate' => date_format(date_create($po->podate),'Y-m-d'),
        ":ordertype" => $po->ordertype,
        ":suppliername" => $po->suppliername,
        ":projectno" => $po->projectno,
        ":projectname" => $po->projectname,
        ":projectlocation" => $po->projectlocation,
        ":supplieratt" => $po->atten,
        ":supplierfax" => $po->fax,
        ":supplierph" => $po->address,
    );

    echo $budget->saveponew($poinfo,$dt,$deliveryterms,$paymentterms);

    exit;
    


?>