<?php 
    if(!isset($ml)){include_once '../_error.php';exit;}
    switch($fun){
        default: echo response("0","Page Not found - 404-B");exit;
        case 'loadrpt':echo $ml->LoadRpt();exit;
        //get all
        case 'unitsall': echo $ml->AllUnits() ; exit;
        case 'systemsall' : echo $ml->AllSystems(); exit;
        case 'tradegroupsall' : echo $ml->TradeGroupAll(); exit;
        case 'tradesall' : echo $ml->TradesAll();exit;
        //get info
        case 'unitinfoget' : include_once 'mlunits/index.php' ; exit;
        case 'systeminfoget' : include_once 'systems/index.php' ; exit;
        case 'tradeinfoget' : include_once 'trades/index.php' ; exit;
        //save 
        case 'unitsave' : include_once 'mlunits/add.php' ; exit;
        case 'systemsave' : include_once 'systems/add.php';exit;
        case 'tradesave' : include_once 'trades/add.php';exit;
        //update
        case 'unitupdate' : include_once 'mlunits/edit.php';exit;
        case 'systemsedit' : include_once 'systems/edit.php';exit;
        case 'tradesedit' : include_once 'trades/edit.php';exit;

    }
