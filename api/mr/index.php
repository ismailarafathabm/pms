<?php
if (!isset($mr)) {
    include_once '../_error.php';
    exit;
}

switch ($fun) {
    default:
        header('HTTP/1.0 404 error');
        echo response('0', "Page Not Found");
        exit;
    case 'autocomplete':
        echo $mr->Autocompleate();
        exit;
    case 'getboq':
        if (!isset($project_enc) || trim($project_enc) === "") {
            echo response("0", "Enter Project Number.");
            exit;
        }
        echo $mr->GetProjectBoq($project_enc);
        exit;
    case 'boqinfo':
        if (!isset($boqid) || trim($boqid) === "") {
            echo response("0", "Enter Project Number.");
            exit;
        }
        echo $mr->getBoqInfo($boqid);
        exit;
    case 'mrsave':
        include_once 'save.php';
        exit;
    case 'mrview':
        include_once 'mrinfo.php';
        exit;
    case 'mrget':
        if (!isset($mrproject) || trim($mrproject) === "") {
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $mr->getProjectMR($mrproject);
        exit;
    case 'mrboq':
        if (!isset($mrboqno) || trim($mrboqno) === '') {
            echo response("0", "Enter BOQ Number");
            exit;
        }
        echo $mr->GetmrforBoq($mrboqno);
        exit;
    case 'mritems':
        if (!isset($params)) {
            echo response("0", "Enter Params");
            exit;
        }
        echo $mr->GetAllItems(strtolower($params));
        exit;
    case 'removemr':
        include_once 'removemr.php';
        exit;
    case 'newmr':
        include_once 'new.php';
        exit;
    case 'getmiscellaneouse':
        if (!isset($mrproject)) {
            echo response("0", "Enter Project");
            exit;
        }
        echo $mr->GetMiscellaneouseItems($mrproject);
        exit;
    case 'getmiscellaneousecnt':
        if (!isset($mrproject)) {
            echo response("0", "Enter Project");
            exit;
        }
        echo $mr->countMiscellaeousItems($mrproject);
        exit;
    case 'mrrpt':
        $x = $mr->mrrpt();
        echo $x;
        exit;
    case 'mrpost':
        $project = !isset($project) || trim($project) === '' ? '' : trim($project);
        if ($project === '') {
            echo response("0", "Enter Project");
            exit;
        }
        $mrno = !isset($mrno) || trim($mrno) === '' ? '' : trim($mrno);
        if ($mrno === '') {
            echo response("0", "Enter MR Number");
            exit;
        }
        echo $mr->MrPost($project, $mrno,'P');
        exit;
    case 'mrupost':
        $project = !isset($project) || trim($project) === '' ? '' : trim($project);
        if ($project === '') {
            echo response("0", "Enter Project");
            exit;
        }
        $mrno = !isset($mrno) || trim($mrno) === '' ? '' : trim($mrno);
        if ($mrno === '') {
            echo response("0", "Enter MR Number");
            exit;
        }
        echo $mr->MrPost($project, $mrno,'N');
        exit;
    case 'updatemrx':
        include_once 'update.php';
        exit;
}
