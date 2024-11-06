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

    $playload = json_decode($_POST['payload']);
    //echo $playload->goprojectid;
    $goprojectid = !isset($playload->goprojectid) || trim($playload->goprojectid) === '' ? '' : trim($playload->goprojectid);
  //  echo  $goprojectid ;
    if($goprojectid === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Project Id");
        exit;
    }
    $goproject = !isset($playload->goproject) || trim($playload->goproject) === '' ? '' : trim($playload->goproject);
    if($goproject === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Contract Number");
        exit;
    }
    $goprojectname = !isset($playload->goprojectname) || trim($playload->goprojectname) === '' ? '' : trim($playload->goprojectname);
    if($goprojectname === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Project Name");
        exit;
    }


    $goprojectlocation = !isset($playload->goprojectlocation) || trim($playload->goprojectlocation) === '' ? '' : trim($playload->goprojectlocation);
    if($goprojectlocation === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Project Location");
        exit;
    }

    

    $gonumber = !isset($playload->gonumber) || trim($playload->gonumber) === '' ? '' : trim($playload->gonumber);
    if($gonumber === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Glass Order Ref No");
        exit;
    }

    $gosupplier = !isset($playload->gosupplier) || trim($playload->gosupplier) === '' ? '' : trim($playload->gosupplier);
    if($gosupplier === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Supplier Name");
        exit;
    }


    $goglasstype = !isset($playload->goglasstype) || trim($playload->goglasstype) === '' ? '' : trim($playload->goglasstype);
    if($goglasstype === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Glass Type");
        exit;
    }

    $goglassspec = !isset($playload->goglassspec) || trim($playload->goglassspec) === '' ? '' : trim($playload->goglassspec);

    if($goglassspec === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Glass Specification");
        exit;
    }


    $gomarking = !isset($playload->gomarking) || trim($playload->gomarking) === '' ? '' : trim($playload->gomarking);
    if($gomarking === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Marking Informaitons");
        exit;
    }


    $goqty = !isset($playload->goqty) || trim($playload->goqty) === '' ? '' : trim($playload->goqty);
    if($goqty === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Order Qty");
        exit;
    }

    if(!is_numeric($goqty)){
        header("HTTP/1.0 402 bad request");
        echo response("0","Qty Not Valid Format");
        exit;
    }


    $goarea = !isset($playload->goarea) || trim($playload->goarea) === '' ? '' : trim($playload->goarea);
    if($goarea === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Area");
        exit;
    }

    if(!is_numeric($goarea)){
        header("HTTP/1.0 402 bad request");
        echo response("0","Area Not Valid Format");
        exit;
    }


    $godoneby = !isset($playload->godoneby) || trim($playload->godoneby) === '' ? '' : trim($playload->godoneby);
    if($godoneby === ""){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter Done By Value");
        exit;
    }


    $godate = !isset($playload->godate) || trim($playload->godate) === '' ? '' : trim($playload->godate);
    if($godate === ''){
        header("HTTP/1.0 402 bad request");
        echo response("0","Enter GO Date");
        exit;
    }

    if(!date_create($godate)){
        header("HTTP/1.0 402 bad request");
        echo response("0","GO Date Is Not Valid Format");
        exit;
    }
    $gopflag = !isset($playload->gopflag) || trim($playload->gopflag) === '' ? '0' : trim($playload->gopflag);
    $goprelease = date('Y-m-d');
    if((int)$gopflag >= 2){
        $goprelease = !isset($playload->goprelease) || trim($playload->goprelease) === '' ? '' : trim($playload->goprelease);        
        if($goprelease === ''){
            header("HTTP/1.0 402 bad request");
            echo response("0","Enter Procurement Forwared Date");
            exit;
        }

        if(!date_create($goprelease)){
            header("HTTP/1.0 402 bad request");
            echo response("0","Procurement Forwared Date Is not Valid Format");
            exit;
        }

        $goprelease = date_format(date_create($playload->goprelease),'Y-m-d');
    }
    $gopreturn = date('Y-m-d');
    if((int)$gopflag === 3){
        $gopreturn = !isset($playload->gopreturn) || trim($playload->gopreturn) === '' ? '' : trim($playload->gopreturn);
        if($gopreturn === ''){
            header("HTTP/1.0 402 bad request");
            echo response("0","Enter Procurement Release Date");
            exit;
        }

        if(!date_create($gopreturn)){
            header("HTTP/1.0 402 bad request");
            echo response("0","Procurement Release Date Is not Valid Format");
            exit;
        }
        $gopreturn = date_format(date_create($playload->gopreturn),'Y-m-d');
    }

  
    $remarks = !isset($playload->remarks) || trim($playload->remarks) === '' ? '-' : trim($playload->remarks);



    $gocostingflag =!isset($playload->gocostingflag) || trim($playload->gocostingflag) === '' ? '0' : trim($playload->gocostingflag);
    $gocostingrelease = date('Y-m-d');
    if((int)$gocostingflag >= 2){
        $gocostingrelease = !isset($playload->gocostingrelease) || trim($playload->gocostingrelease) === '' ? '' : trim($playload->gocostingrelease);
        if($gocostingrelease === ''){
            header("HTTP/1.0 402 bad request");
            echo response("0","Enter Costing Forwared Date");
            exit;
        }

        if(!date_create($gocostingrelease)){
            header("HTTP/1.0 402 bad request");
            echo response("0","Costing Forwared Date Is not Valid Format");
            exit;
        }

        $gocostingrelease = date_format(date_create($playload->gocostingrelease),'Y-m-d');
    }
    $gocosingreturn = date("Y-m-d");
    if((int)$gocostingflag >= 3){
        $gocosingreturn = !isset($playload->gocosingreturn) || trim($playload->gocosingreturn) === '' ? '' : trim($playload->gocosingreturn);
        if($gocosingreturn === ''){
            header("HTTP/1.0 402 bad request");
            echo response("0","Enter Costing Return Date");
            exit;
        }

        if(!date_create($gocosingreturn)){
            header("HTTP/1.0 402 bad request");
            echo response("0","Costing Return Date Is not Valid Format");
            exit;
        }

        $gocosingreturn = date_format(date_create($playload->gocosingreturn),'Y-m-d');
    }    
    
    $cby = $uuser;
    $eby = $uuser;
    $cdate = $ddate;
    $edate = $ddate;
    $othersdesc =  !isset($playload->othersdesc) || trim($playload->othersdesc) === '' ? '-' : trim($playload->othersdesc);
    $gotype = !isset($playload->gotype) || trim($playload->gotype) === '' ? '1' : trim($playload->gotype);
    $gootype = !isset($playload->gootype) || trim($playload->gootype) === '' ? '1' : trim($playload->gootype);
    $rgono = !isset($playload->rgono) || trim($playload->rgono) === '' ? '' : trim($playload->rgono);
   
    $params = array(
        ":goprojectid" => $goprojectid,
        ":goproject" => $goproject,
        ":goprojectname" => $goprojectname,
        ":goprojectlocation" => $goprojectlocation,
        ":gonumber" => $gonumber,
        ":gosupplier" => $gosupplier,
        ":goglasstype" => $goglasstype,
        ":goglassspec" => $goglassspec,
        ":gomarking" => $gomarking,
        ":goqty" => $goqty,
        ":goarea" => $goarea,
        ":godoneby" => $godoneby,
        ":godate" => date_format(date_create($godate),'Y-m-d'),
        ":gopflag" => $gopflag,
        ":goprelease" =>$goprelease,
        ":gopreturn" => $gopreturn,
        ":remarks" => $remarks,
        ":gocostingflag" => $gocostingflag,
        ":gocostingrelease" => $gocostingrelease,
        ":gocosingreturn" => $gocosingreturn,
        ":cby" => $cby,
        ":eby" => $eby,
        ":cdate" => $cdate,
        ":edate" => $edate,
        ":othersdesc" => $othersdesc,
        ":gotype" => $gotype,
        ":gootype" => $gootype,
        ":rgono" => $rgono
    );
    include_once '../../controller/gos.php';
    $goc = new GoController($cn);
    echo $goc->SaveGo($params);
    exit;
?>