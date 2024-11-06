<?php
//echo "called";
if (!isset($go)) {
    include_once '../_error.php';
    exit;
}

switch ($fun) {
    case 'glasstypes':
        echo $go->AllGlassTypes();
        exit;
    case 'addglasstype':
        if (!isset($glasstype_name) || trim($glasstype_name) === "") {
            echo response("0", "Enter Glass Type");
            exit;
        }
        echo $go->AddGlassType($glasstype_name);
        exit;
    case 'glassdescriptionsall':
        echo $go->AllGlassDescriptions();
        exit;
    case 'addglassdescription':
        include_once 'newdescription.php';
        exit;
    case 'getinfoglassdescription':
        if (!isset($glassdescriptoinsid) || trim($glassdescriptoinsid) === "") {
            echo response("0", "Glass Description Id Missing");
            exit;
        }
        echo $go->getGlassDescriptioninfo($glassdescriptoinsid);
        exit;
    case 'updateglassdescription':
        include_once 'updatedescription.php';
        exit;
    case 'allglasssuppliers':
        echo $go->GetAllGlassSuppliers();
        exit;
    case 'newsupplier':
        include_once 'supplier_new.php';
        exit;
    case 'getinfo';
        if (!isset($glasssupplierid) || trim($glasssupplierid) === "") {
            echo response("0", "Select Any Supplier");
            exit;
        }
        echo $go->GetGlassSupplierinfo($glasssupplierid);
        exit;
    case 'updatesupplier':
        include_once 'supplier_update.php';
        exit;
    case 'projectlist' : 
        echo $go->projectlist();
        exit;
    case 'savebudget':
        //echo "function called";
        include_once 'budget_new.php';
        exit;
    case 'loadbudget':
        if(!isset($gbproject) || trim($gbproject) === ""){
            echo response("0" , "Enter Project");
        }
        echo $go->Loadprojectglassbudget($gbproject);
        exit;
    case 'updatebudget':
        include_once 'budget_update.php';
        exit;  
    case 'budgetinfo':

        if(!isset($gbudgetid) || trim($gbudgetid) === ""){
            echo response("0", "Enter Budget Id");
            exit;
        }
        echo $go->Budgetinfo($gbudgetid);
        exit;
    case 'projectgo':
        if(!isset($goproject) || trim($goproject) == ""){
            echo response("0", "Enter Project");
            exit;
        }
        echo $go->getGo($goproject);exit;
       
    case 'projectgoinfo':
        //echo "code working";
        if(!isset($goid) || trim($goid) === ""){
            echo response("0", "Select Glass Order");
            exit;
        }
        echo $go->getGoInfo($goid);
        exit;
    case 'projectgonew':
        include_once 'project_go_new.php';
        break;
    case 'projectgoupdate':
        include_once 'project_go_update.php';
        break;
    
    case 'savebudgetgo':
        include_once 'budget_go_new.php';
        break;
    case 'bugetglassorderhistory':
        if(!isset($gobudgetid) || trim($gobudgetid) === ''){
            echo response("0","Select any Budget id");
            exit;
        }
        echo $go->glassorderbybugetid($gobudgetid);
        exit;
}
