<?php
if (!isset($mtbl)) {
    include_once '../_error.php';
    exit;
}
switch ($fun) {
    default:
        echo response("0", "Page Not found - 404-B");
        exit;
    case 'loadprojects':
        include_once 'gway/xindex.php';
        exit;
    case 'loadallunits':
        echo $mtbl->LoadAllUnits();
        exit;
    case 'getinfoproject':
        include_once 'project/index.php';
        exit;
    case 'loadrpt':
        include_once 'mtbl/index.php';
        exit;
    case 'loadrptbyproject':
        include_once 'mtbl/rpt_by_project.php';
        exit;
    case 'getinfo':
        include_once 'mtbl/get.php';
        break;
    case 'getinfotoken':
        include_once 'mtbl/getinfotoken.php';
        break;
    case 'save':
        include_once 'mtbl/new.php';
        exit;
    case 'updateall':
        include_once 'mtbl/allupdate.php';
        exit;
    case 'update':
        include_once 'mtbl/update.php';
        exit;
    case 'logs':
        include_once 'mtbl/logs.php';
        exit;
    case 'remove':
        include_once 'mtbl/remove.php';
        exit;
    case 'items':
        echo $mtbl->mtblitems();
        exit;
    case 'backlog':
        echo $mtbl->MtblBacklogRpt();
        exit;
    case 'loadthisweek':
        $weeks = array();
        $fday = date('d-m-Y', strtotime('next friday'));
        $stday = date('d-m-Y', strtotime('last Saturday'));
        $weeks = array(
            'fday' => $stday,
            "fd" => $fday,
        );
        echo response("1", $weeks);
        exit;
        break;
}
