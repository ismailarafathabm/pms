<?php 
    if (!isset($gon)) {
        include_once '../_error.php';
        exit;
    }
    $uuser = $user_name;
    $date = date('Y-m-d H:i:s');

    $payload = json_decode($payload);
    $gondoneby = $payload->gondoneby;
    $gonrelesetopurcahse = $payload->gonrelesetopurcahse;
    $gonrecivedfrompurchase = $payload->gonrecivedfrompurchase;
    $gonstatus = "1";
    $gonsupplier = $payload->gonsupplier;
    $gonglasstype = $payload->gonglasstype;
    $gonglassspc = $payload->gonglassspc;
    $gonmakringlocation = $payload->gonmakringlocation;
    $gonlocation = $payload->gonlocation;
    $gonqty = $payload->gonqty;
    $gonremark = $payload->gonremark;
    $gonorderno = "NAF/ENGG/".$payload->gonorderno;
    $gonby = $uuser;
    $goeby = $uuser;
    $gocdate =  $date;
    $goedate =  $date;
    $gontype = "GO";
    $gonproject = $payload->gonproject;
    $savedata = array(
        ":gondoneby" => $gondoneby,
        ":gonrelesetopurcahse" => date_format(date_create($gonrelesetopurcahse),'Y-m-d'),
        ":gonrecivedfrompurchase" => date_format(date_create($gonrecivedfrompurchase),'Y-m-d'),
        ":gonstatus" => $gonstatus,
        ":gonsupplier" => $gonsupplier,
        ":gonglasstype" => $gonglasstype,
        ":gonglassspc" => $gonglassspc,
        ":gonmakringlocation" => $gonmakringlocation,
        ":gonlocation" => $gonmakringlocation,
        ":gonqty" => $gonqty,
        ":gonremark" => $gonremark,
        ":gonorderno" => $gonorderno,
        ":gonby" => $gonby,
        ":goeby" => $goeby,
        ":gocdate" => $gocdate,
        ":goedate" => $goedate,
        ":gontype" => $gontype,
        ":gonproject" => $gonproject
    ); //18

    echo $gon->Savego($savedata);
    exit;
?>