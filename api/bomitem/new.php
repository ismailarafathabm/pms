<?php 
    include_once('../_def.php');
    $auth = true;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        extract($_POST);
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);
        include_once('../../connection/connection.php');
        $connection = new connection();
        $cn = $connection->connect();
        include_once('../../controller/User.php');
        $user = new User($cn);
        include_once('../_auth.php');
        if($auth === true) {
            if(!isset($itemprofileno) || $itemprofileno === ''){
                echo response("0","Enter Item Profile No");
            }else if(!isset($itempartno) || $itempartno === ''){
                echo response("0","Enter Item Part No.");
            }else if(!isset($itemalloy) || $itemalloy === ''){
                echo response("0","Select Alloy");
            }else if(!isset($itemfinish) || $itemfinish === ''){
                echo response("0","Select Color finish");
            }else if(!isset($itemlength) || $itemlength === ''){
                echo response("0","Enter Item Length");
            }else if(!isset($itemdescription) || $itemdescription === ''){
                echo response("0","Enter Item Description.");
            }else if(!isset($itemdieweight) || $itemdieweight === ''){
                echo response("0","Enter Item Die Weight.");
            }else if(!isset($itemsystem) || $itemsystem === ''){
                echo response("0","Select System");
            }else if(!isset($itemtype) || $itemtype === ''){
                echo response("0","Select Material type");
            }else if(!isset($itemunit) || $itemunit === ''){
                echo response("0","Select Unit");
            }else if(!isset($itempartfunction) || $itempartfunction === ''){
                echo response("0","Select Part function");
            }else{
                if(!is_numeric($itemdieweight)){
                    echo response("0","Die Weight Should be a Number Value");
                }else if(!is_numeric($itemlength)){
                    echo response("0","Length Should be a Number Value");
                }else{
                    require_once '../../controller/bomitem.php';
                    $bomitems = new bomitem($cn);
                    $chinfo = array(
                        ':itemprofileno' => $itemprofileno,
                        ':itempartno' => $itempartno,
                        ':itemalloy' => $itemalloy,
                        ':itemfinish' => $itemfinish,
                        ':itemlength' => $itemlength,                        
                        ':itemunit' => $itemunit,  
                        ':itemdescription' => $itemdescription,
                        ':itemsystem' => $itemsystem,
                    );
                    $svinfo = array(
                        ':itemprofileno' => $itemprofileno,
                        ':itempartno' => $itempartno,
                        ':itemalloy' => $itemalloy,
                        ':itemfinish' => $itemfinish,
                        ':itemlength' => $itemlength,
                        ':itemunit' => $itemunit,
                        ':itemdieweight' => $itemdieweight,
                        ':itemsystem' => $itemsystem,
                        ':itemtype' => $itemtype,
                        ':itemavai' => "0",
                        ':itemtotweight' => "0",
                        ':itemprice' => "0",
                        ':itemtotprice' => "0",
                        ':itemdescription' => $itemdescription,
                        ':itempartfunction' => $itempartfunction
                    );
                    echo $bomitems->itemSave($chinfo,$svinfo);
                }
            }
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
