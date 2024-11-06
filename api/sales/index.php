<?php 
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    //print_r($_POST);
    // foreach($_POST as $k=>$p){
    //     echo $k;
    //     echo ">>";

    //     if($_POST[$k] === ''){
    //         echo "input mius";
    //     }
    // }
    
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();    
    if(isset($user_name) && isset($user_token)){    
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);
        
        include_once('../../controller/User.php');
        $user = new User($db);
        include_once('../_auth.php');
    }

    if($auth){
        if(!isset($qusno) || $qusno === ''){
            echo response("0","Enter Serial No");
        }else if(!isset($qurefno) || $qurefno === ''){
            echo response("0","Enter Ref No");
        }else if(!isset($qureceiveddate) || $qureceiveddate === ''){
            echo response("0","Enter Received Date");
        }else if(!isset($qusubmitaldate) || $qusubmitaldate === ''){
            echo response("0","Enter Submital Date");
        }else if(!isset($qusalesrep) || $qusalesrep === ''){
            echo response("0","Enter Sales Rep Name");
        }else if(!isset($quprojectname) || $quprojectname === ''){
            echo response("0","Enter Project Name");
        }else if(!isset($qustatus) || $qustatus === ''){
            echo response("0","Enter STATUS");
        }else if(!isset($qulocation) || $qulocation === ''){
            echo response("0","Enter Location");
        }else if(!isset($qucontact) || $qucontact === ''){
            echo response("0","Enter Contact Person Name");
        }else if(!isset($contact_infos) || $contact_infos === ''){
            echo response("0","Enter Contact Informations");
        }else if(!isset($quattention) || $quattention === ''){
            echo response("0","Enter Attention to Informations");
        }else if(!isset($qurecivedthru) || $qurecivedthru === ''){
            echo response("0","Enter Documents Received Informations");
        }else if(!isset($quboq) || $quboq === ''){
            echo response("0","Enter BOQ Document Type");
        }else if(!isset($quspecification) || $quspecification === ''){
            echo response("0","Enter Project Specification Document Informations");
        }else if(!isset($qudrawings) || $qudrawings === ''){
            echo response("0","Enter Drawing Document Informations");
        }else if(!isset($newquotations) || $newquotations === ''){
            echo response("0","Enter Notes");
        }else{
            if(!date_create($qureceiveddate)){
                echo response("0","Quotations Received Date not valid format");
            }else if(!date_create($qusubmitaldate)){
                echo response("0","Quotation Submited Date not valid format");
            }else{
                include_once '../../controller/Quotations.php';
                $qu = new Quotations($db);
                $quboqtoken = $qu->token(150);
                $quspecificationtoken = $qu->token(150);
                $qudrawingstoken = $qu->token(150);
                $contact = array(
                    'qucontact' => $qucontact,
                    'contact_infos' => $contact_infos,
                );
                $contact_s = json_encode($contact);
                $qureleasequno = "0";
                $sv = array(
                    ':qusno' => $qu->enc('enc',$qusno),
                    ':qurefno' => $qu->enc('enc',$qurefno),
                    ':qureceiveddate' => date_format(date_create($qureceiveddate),'Y-m-d'),
                    ':qusubmitaldate' => date_format(date_create($qusubmitaldate),'Y-m-d'),
                    ':qusalesrep' => $qu->enc('enc',$qusalesrep),
                    ':quprojectname' => $qu->enc('enc',$quprojectname),
                    ':qustatus' => $qu->enc('enc',$qustatus),
                    ':qulocation' => $qu->enc('enc',$qulocation),
                    ':quattention' => $qu->enc('enc',$quattention),
                    ':qucontact' => $qu->enc('enc',$contact_s),
                    ':qurecivedthru' => $qu->enc('enc',$qurecivedthru),
                    ':quboq' => $qu->enc('enc',$quboq),
                    ':quspecification' => $qu->enc('enc',$quspecification),
                    ':qudrawings' => $qu->enc('enc',$qudrawings),
                    ':quboqtoken' => $quboqtoken,
                    ':quspecificationtoken' => $quspecificationtoken,
                    ':qudrawingstoken' => $qudrawingstoken,
                    ':quextra' => $qu->enc('enc',$newquotations),
                    ':qureleasequno' => $qu->enc('enc',$qureleasequno),
                    ':cby' => $qu->enc('enc',$user_name),
                    ':eby' => $qu->enc('enc',$user_name),
                    ':cdate' => date('Y-m-d h:i:s a'),
                    ':edate' => date('Y-m-d h:i:s a'),
                );

                echo $qu->NewQuotations($sv);
            }
        }
    }else{
        echo response("404", "Access Error");
    }
}else{
    echo response("0","Request Error");
}
?>