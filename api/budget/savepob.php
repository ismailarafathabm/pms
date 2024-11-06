<?php 
    if(!isset($budget)){
        include_once '../_error.php';
        exit;
    }
    if(!isset($pobdate) || trim($pobdate) === ""){
        echo response("0","Enter date");
        exit;
    }
    if(!date_create($pobdate)){
        echo response("0","Data is Not A valid Format");
        exit;
    }
    if(!isset($pobprefno) || trim($pobprefno) === ""){
        echo response("0","Enter Ref.NO");
        exit;
    }
    if(!isset($pobtype) || trim($pobtype) === ""){
        echo response("0","Enter Order Type");
        exit;
    }
    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $save = array(
        ':pobdate' => date_format(date_create($pobdate),'Y-m-d'),
        ':pobprefno' => $pobprefno,
        ':pobporefno' => $pobporefno,
        ':pobtype' => $pobtype,
        ':pobtotbudget' => $pobtotbudget,
        ':pobbmprice' => $pobbmprice,
        ':pobprvalue' => $pobprvalue,
        ':pobcvalue' => $pobcvalue,
        ':pobavailablebudget' => $pobavailablebudget,
        ':pobcby' => $uuser,
        ':pobeby' => $uuser,
        ':pobcdate' => $ddate,
        ':pobedate' => $ddate,
        ':pobstatus' => "1",
        ':pobqty' => $pobqty,
        ':pobproject' => $poproject,
    );

    $params = array(
        ":poproject" => $poproject,
        ":pobporefno" => $pobporefno,
        ":pobprefno" => $pobprefno,
    );

    echo $budget->savepbo($save,$params);
    exit;
   
?>