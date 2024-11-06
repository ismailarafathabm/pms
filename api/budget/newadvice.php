<?php 
    if(!isset($budget)){
        include_once '../_error.php';
        exit;
    }

    


    $advice = json_decode($advice);
    if(!isset($advice->padvancedate) || trim($advice->padvancedate) === ""){
        echo response("0","Enter Date");
        exit;
    }

    if(!isset($advice->paymenttype) || trim($advice->paymenttype) === ""){
        echo response("0","Enter Payment Type");
        exit;
    }

    if(!isset($advice->paymentamount) || trim($advice->paymentamount) === ""){
        echo response("0","Enter Payment Amount");
        exit;
    }

    if(!is_numeric($advice->paymentamount)){
        echo response("0","Enter Payment Amount Not Valid Format");
        exit;
    }

    
    if(!isset($advice->paymentcountry) || trim($advice->paymentcountry) === ""){
        echo response("0","Enter Currency Type");
        exit;
    }

    if(!isset($advice->paymentpersent) || trim($advice->paymentpersent) === ""){
        echo response("0","Enter Current Payment %");
        exit;
    }

    if(!isset($advice->paydescriptions) || trim($advice->paydescriptions) === ""){
        echo response("0","Enter Payment Description");
        exit;
    }

    if(!isset($advice->padviceto) || trim($advice->padviceto) === ""){
        echo response("0","Enter TO infromations");
        exit;
    }
    $adivcepaymentdescription = "-";
    if($advice->paymenttype === 'Others'){
        if(!isset($advice->padvicetypedescription) || trim($advice->padvicetypedescription) === ""){
            echo response("0","Enter Payment Descriptions");
            exit;
        }else{
            $adivcepaymentdescription = $advice->padvicetypedescription;
        }
    }
    


    $uuser = $user_name;
    $ddate = date("Y-m-d H:i:s");
    $save = array(
        ':padvancedate' => date_format(date_create($advice->padvancedate),'Y-m-d'),
        ':padvancesno' => "-",
        ':ponewid' => $ponewid,
        ':paymenttype' => $advice->paymenttype,
        ':paymentamount' => $advice->paymentamount,
        ':paymentcountry' => $advice->paymentcountry,
        ':paymentpersent' => $advice->paymentpersent,
        ':paymentnotes' => '-',
        ':paydescriptions' => $advice->paydescriptions,
        ':pacby' => $uuser,
        ':paeby' => $uuser,
        ':pacdate' => $ddate,
        ':paedate' => $ddate,
        ':padviceto' => $advice->padviceto,
        ':padvicetypedescription' => $adivcepaymentdescription,
        ':padviceproject' => $padviceproject
    );

    echo $budget->advicenew($save);
    exit;
?>