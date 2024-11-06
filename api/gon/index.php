<?php
if (!isset($gon)) {
    include_once '../_error.php';
    exit;
}

switch($fun){
    default:
        echo response("0","Function Not found");
    exit;
    case 'getprojectgo':
        if(!isset($gonproject) || trim($gonproject) === ""){
            echo response("0","Enter Project Id");
            exit;
        }
        echo $gon->getprojectgo($gonproject);
        exit;
    case 'savegon':
        include_once 'savego.php';
        exit;
    case 'getprojectgop':
        if(!isset($gonp_pjcno) || trim($gonp_pjcno) === ""){
            echo response("0","Enter Project Id");
            exit;
        }
        echo $gon->getallgopproject($gonp_pjcno);
        exit;
    case 'savegopn':
        include_once 'savegop.php';
        exit;
    case 'savegoprc':
        include_once 'savegoprc.php';
        exit;
    case 'getgopnrc':
        if(!isset($gonrc_gopnid) || trim($gonrc_gopnid) === ""){
            echo response("0","Enter Go Ref# Number");
            exit;
        }

        echo $gon->getgopnrc($gonrc_gopnid);
    exit;

}
