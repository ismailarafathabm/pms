<?php
if (!isset($budget)) {
    include_once '../_error.php';
}

switch ($fun) {
    default:
        header("HTTP/1.0 400 Bad Request");
        echo response("0", "function not found");
        exit;
    case 'glassautocompleate':
        echo $budget->AutoCompleteGlass();
        exit;
    case 'allglassbudgetbyproject':
        if (!isset($bgprojectid) || trim($bgprojectid) === '') {
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $budget->getProjectGlassProject($bgprojectid);
        exit;
    case 'addglassbudgetbyproject':
        include_once 'new.php';
        exit;
    case 'getglass':
        if (!isset($bgid) || trim($bgid) === '') {
            echo response("0", "Select Any Project");
            exit;
        }
        echo $budget->GetInfoProjectGlassBudget($bgid);
        break;
    case 'updateglassbudget':
        include_once 'updateglassbudget.php';
        break;
    case 'gobudgettotalarea':
        if (!isset($bgprojectid) || trim($bgprojectid) === '') {
            echo response("0", "Select Project");
            exit;
        }
        echo $budget->gobudgettotalarea($bgprojectid);
        exit;
    case 'sumgobudgetotalarea':
        if (!isset($bgoproject) || trim($bgoproject) === '') {
            echo response("0", "Select Project");
            exit;
        }
        echo $budget->sumgobudgetotalarea($bgoproject);
        exit;
    case 'newbudgetgoorder':
        include_once 'newgo.php';
        exit;
    case 'projectpurcahsego':
        if (!isset($bgoproject) || trim($bgoproject) === '') {
            echo response("0", "Select Project");
            exit;
        }
        echo $budget->AllGoApprovalsForProject($bgoproject);
        exit;
    case 'printgo':
        if (!isset($bgoid) || trim($bgoid) === '') {
            echo response("0", "Select Any Glass Order");
            exit;
        }
        echo $budget->glassapprovalsprint($bgoid);
        exit;
    case 'newbudgetmaterials':
        include_once 'newm.php';
        exit;
    case 'autocompleatematerials':
        echo $budget->automaterials();
        exit;
    case 'budgetmaterialsbyproject':
        if (!isset($bmproject) || trim($bmproject) === "") {
            echo response("0", "Enter Project Name");
            exit;
        }
        echo $budget->getbudgetMaterialsbyProjects($bmproject);
        exit;
    case 'budgetmaterialsbybmid':
        if (!isset($bmid) || trim($bmid) === "") {
            echo response("0", "Enter Project Name");
            exit;
        }
        echo $budget->getbudgetmaterialbyid($bmid);
        exit;
    case 'updatebudgetmaterials':
        include_once 'editm.php';
        exit;
    case 'bmos':
        if (!isset($bmoproject) || trim($bmoproject) === "") {
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $budget->getbmos($bmoproject);
        exit;
    case 'bmo':
        if (!isset($bmoid) || trim($bmoid) === '') {
            echo response("0", "Select material order Id");
            exit;
        }
        echo $budget->bmo($bmoid);
        exit;
    case 'savebmo':
        include_once 'savebmo.php';
        exit;
    case 'updatebmo':
        include_once 'updatebmo.php';
        exit;
    case 'bmoprint':
        if (!isset($bmoid) || trim($bmoid) === "") {
            echo response("0", "Select material order Id");
            exit;
        }
        echo $budget->bmoprint($bmoid);
        exit;
    case 'materialtype':        
        echo $budget->materialtypes();
        exit;
    case 'pos':
        if (!isset($poproject) || trim($poproject) === '') {
            echo response("0", "Project Is Missing");
            exit;
        }
        echo $budget->Pos($poproject);
        exit;
    case 'savepo':
        include_once 'savepo.php';
        exit;
    case 'searchpo':
        if (!isset($poproject) || trim($poproject) === "") {
            echo response("0", "Project Is Missing");
            exit;
        }
        if (!isset($porefno) || trim($porefno) === "") {
            echo response("0", "Referance no Is Missing");
            exit;
        }
        echo $budget->searchpo($poproject, $porefno);
        exit;
    case 'savepob':
        include_once 'savepob.php';
        exit;
    case 'pobprintinfo':
        if (!isset($pobproject) || trim($pobproject) === "") {
            echo response("0", "Project Is Missing");
            exit;
        }
        if (!isset($pobporefno) || trim($pobporefno) === "") {
            echo response("0", "Referance no Is Missing");
            exit;
        }
        if (!isset($pobprefno) || trim($pobprefno) === "") {
            echo response("0", "Po Budget Referance no Is Missing");
            exit;
        }
        echo $budget->pobprintinfo($pobproject, $pobporefno, $pobprefno);
        exit;
    case 'pobs':
        if (!isset($poproject) || trim($poproject) === "") {
            echo response("0", "Project Is Missing");
            exit;
        }
        echo $budget->pobsall($poproject);
        exit;

    case 'refnos':
        if (!isset($poproject) || trim($poproject) === "") {
            echo response("0", "Referance no Is Missing");
            exit;
        }
        echo $budget->projectreferancenoall($poproject);
        exit;
    case 'bsp':
        //echo "workin";
        if (!isset($projectid) || trim($projectid) === "") {
            echo response("0", "Project Is Missing");
            exit;
        }
        echo $budget->budgetsummaryproject($projectid);
        exit;
    case 'bipo':
        if (!isset($itemtype) || trim($itemtype) === "") {
            echo response("0", "Item  Type Is Missing");
            exit;
        }
        if (!isset($poproject) || trim($poproject) === "") {
            echo response("0", "Project Is Missing");
            exit;
        }

        echo $budget->bipo($itemtype, $poproject);
        exit;
    case 'ponewsave':
        include_once "ponew.php";
        exit;
    case 'ponewinfo':
        if (!isset($ponewid) || trim($ponewid) === '') {
            echo response("0", "Enter Id");
            exit;
        }
        echo $budget->getinfoponew($ponewid);
        exit;
    case 'ponview':
        if (!isset($ponewproject) || trim($ponewproject) === "") {
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $budget->ponewall($ponewproject);
        exit;
    case 'bmbt':
        if (!isset($bmproject) || trim($bmproject) === "") {
            echo response("0", "Project Informations Missing");
            exit;
        }
        if (!isset($bmmaterialtype) || trim($bmmaterialtype) === "") {
            echo response("0", "Material Type Missing");
            exit;
        }
        echo $budget->getbudgetMaterialsbyType($bmproject, $bmmaterialtype);
        exit;
    case 'newadvice':
        include_once 'newadvice.php';
        exit;
    case 'padvice':
        if (!isset($padviceproject) || trim($padviceproject) === '') {
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $budget->paymentadvicebyproject($padviceproject);
        exit;
    case 'getadvice':
        if (!isset($padvanceid) || trim($padvanceid) === '') {
            echo response("0", "Enter Id");
            exit;
        }
        echo $budget->getAdviceproject($padvanceid);
        exit;
    case 'delbudget':
        include_once 'mdelete.php';
        exit;
    case 'budgetsummary':
        echo $budget->budgetAllporject();
        exit;
    case 'porpt':
        echo $budget->rptpoall();
        exit;
    case 'projectbudgetsummary':
        if(!isset($pjcno) || trim($pjcno) === ''){
            echo response("0", "Enter Project Number");
            exit;
        }
        echo $budget->projectsbudgetsummary($pjcno);
        exit;
    case 'pomaterialtypes':
        if(!isset($bmproject) || trim($bmproject) === ""){
            echo response("0","Enter Project");
            exit;
        }
        echo $budget->budgematerials($bmproject);
        exit;
    case "posummaryallproject":
        echo $budget->getposummaryforallproject();
        exit;
    case 'posummarybysupplier':
        echo $budget->supplierwiseposummary();
        exit;
}