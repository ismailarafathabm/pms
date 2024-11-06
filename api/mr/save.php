<?php 
    if(!isset($mr)){
        include_once '../_error.php';
        exit;
    }

    $datas = json_decode($params);
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");

    $paramslist = [];
    //print_r($datas);
    foreach($datas as $d){
        $x = array(
            ':mrproject' => $d->mrproject,
            ':mrcode' => $d->mrcode,
            ':mrno' => $d->mrno,
            ':mrdate' => date_format(date_create($d->mrdate),'Y-m-d'),
            ':mritem' => $d->mritem,
            ':mrpartno' => $d->mrpartno,
            ':mrpartnotai' => $d->mrpartnotai,
            ':mrdieweight' => $d->mrdieweight,
            ':mrreqlength' => $d->mrreqlength,
            ':mrreqqty' => $d->mrreqqty,
            ':mrreqtotweight' => $d->mrreqtotweight,
            ':mrboqno' => $d->mrboqno,
            ':mravaiqty' => $d->mravaiqty,
            ':mraviweight' => $d->mraviweight,
            ':mrorderedqty' => $d->mrorderedqty,
            ':mrorderedweight' => $d->mrorderedweight,
            ':mrcby' => $uuser,
            ':mreby' => $uuser,
            ':mrcdate' => $ddate,
            ':mredate' => $ddate,
            ':mrfinish' => $d->mrfinish,
            ':mrremarks' => $d->mrremarks,
            ':mrcheckedby' => $d->mrcheckedby,
            ':mrapprovedby' => $d->mrapprovedby,
            ':releaseddate' => date_format(date_create($d->releaseddate),'Y-m-d'),
            ':mrunit' => $d->mrunit,
            ':preparedby' =>  $d->preparedby
        );

        $paramslist[] = $x;
    }
    //print_r($paramslist);
    echo $mr->saveMr($paramslist);
    exit;
?>