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

    $payload = $_POST['payload'];
    $data = json_decode($payload);
    $mrid = $data->mrid;
    $mrpid = $data->mrpid;
    $mrproject = $data->mrproject;
    $mrprojectname = $data->mrprojectname;
    $mritem = $data->mritem;
    $mritemdescription = $data->mritemdescription;
    $mritemdieweight = $data->mritemdieweight;
    $mritemlength = $data->mritemlength;
    $mritemreceivedqty = $data->mritemreceivedqty;
    $mrreceiptid = $data->mrreceiptid;
    $mrreciptdate = $data->mrreciptdate;
    $mrsupplier = $data->mrsupplier;
    $mrcby = $uuser;
    $mreby =  $uuser;
    $mrrcdate = $ddate;
    $mredate = $ddate;

    $params = array(
        ":mrid" => $mrid,
        ":mrpid" => $mrpid,
        ":mrproject" => $mrproject,
        ":mrprojectname" => $mrprojectname,
        ":mritem" => $mritem,
        ":mritemdescription" => $mritemdescription,
        ":mritemdieweight" => $mritemdieweight,
        ":mritemlength" => $mritemlength,
        ":mritemreceivedqty" => $mritemreceivedqty,
        ":mrreceiptid" => $mrreceiptid,
        ":mrreciptdate" => date_format(date_create($mrreciptdate),'Y-m-d'),
        ":mrsupplier" => $mrsupplier,
        ":mrcby" => $mrcby,
        ":mreby" => $mreby,
        ":mrrcdate" => $mrrcdate,
        ":mredate" => $mredate,
    );
    include_once '../../controller/mr.php';
    $mr = new MR($cn);
    echo $mr->SavePrReceipt($params);
    exit;
?>