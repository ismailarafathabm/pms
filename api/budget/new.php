<?php 
    if(!isset($budget)){
        include_once '../_error.php';
        exit;
    }

    if(!isset($bgglass) || trim($bgglass) === ""){
        echo response("0","Enter Glass Specs");
        exit;
    }
    
    $_bgarea = !isset($bgarea) || trim($bgarea) === "" ? 0 : $bgarea;

    if(!is_numeric($_bgarea)){
        echo response("0","Area Is Not Valid Format");
        exit;
    }

    $_bgcost = !isset($bgcost) || trim($bgcost) === "" ? 0 : $bgcost;

    if(!is_numeric($_bgcost)){
        echo response("0","Cost Is Not Valid Format");
        exit;
    }

    $_bgtotalcost = !isset($bgtotalcost) || trim($bgtotalcost) === "" ? 0 : $bgtotalcost;

    if(!is_numeric($_bgtotalcost)){
        echo response("0","Total Cost Is Not Valid Format");
        exit;
    }

    $_bgshapedarea = !isset($bgshapedarea) || trim($bgshapedarea) === "" ? 0 : $bgshapedarea;

    if(!is_numeric($_bgshapedarea)){
        echo response("0","Shaped Area Is Not Valid Format");
        exit;
    }

    
    $_bgshapedcost = !isset($bgshapedcost) || trim($bgshapedcost) === "" ? 0 : $bgshapedcost;

    if(!is_numeric($_bgshapedcost)){
        echo response("0","Shaped Area Cost Is Not Valid Format");
        exit;
    }

    $_bgshapedtotalcost = !isset($bgshapedtotalcost) || trim($bgshapedtotalcost) === "" ? 0 : $bgshapedtotalcost;

    if(!is_numeric($_bgshapedtotalcost)){
        echo response("0","Shaped Area Toal Cost Is Not Valid Format");
        exit;
    }
    $uusr = $user_name;
    $date = date('Y-m-d H:i:s');
    $params = array(
        ":bgglass" => $bgglass,
        ":bgarea" => $bgarea,
        ":bgcost" => $bgcost,
        ":bgtotalcost" => $bgtotalcost,
        ":bgshapedarea" => $bgshapedarea,
        ":bgshapedcost" => $bgshapedcost,
        ":bgshapedtotalcost" => $bgshapedtotalcost,
        ":bgprojectid" => $bgprojectid,
        ":bgcby" => $uusr,
        ":bgeby" => $uusr,
        ":bgcdate" => $date,
        ":bgedate" => $date,       
        ":gbudgetglassno" => $gbudgetglassno,
        ":bgtype" => $bgtype,
        ":bgcode" => $bgcode,
    );
    echo $budget->Saveglassbudget($params);
    exit;
    
?>