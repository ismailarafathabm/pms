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
            if(!isset($bomid) && $bomid === ""){
                echo response("0","ID MISSING");
            }else if(!isset($nqty) && $nqty === ""){
                echo response("0","Enter QTY");
            }else if(!isset($sdate) && $sdate === ""){
                echo response("0","Enter Date");
            }else{
                if(!is_numeric($nqty)){
                    echo response("0","Qty should be Number Format");
                }else{
                    if(!date_create($sdate)){
                        echo response("0","Not valid Date...");
                    }else{
                        require_once '../../controller/bom.php';
                        $bom = new Bom($cn);
                        $z = date_format(date_create($sdate),'Y-m-d');
                        echo $bom->AdditionBom($bomid,$nqty, $z,$projectno,$remark);
                    }                    
                }
            }
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
