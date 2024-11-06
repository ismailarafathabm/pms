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
            if(!isset($returndate) && $returndate === ""){
                echo response("0","Enter Date");
            }else if(!isset($ppid) && $ppid === ""){
                echo response("0","Some Inputs Missing, Contact Developer");
            }else if(!isset($returnqty) && $returnqty === ""){
                echo response("0","Enter QTY");
            }else if(!isset($rtno) && $rtno === ""){
                echo response("0","Enter Receipt No");
            }else if(!isset($rcpno) && $rcpno === ""){
                echo response("0","Enter PP Receipt No");
            }else if(!isset($remark)){
                echo response("0","Remark MISSING");
            }else{
                if(!is_numeric($returnqty)){
                    echo response("0","Qty Not valid Format");
                }
                else if(!is_numeric($rtno)){
                    echo response("0","Tot Weight Not valid Format");
                }else if(!date_create($returndate)){
                    echo response("0","Date Not valid Format");
                }else{
                require_once '../../controller/ppworks.php';
                $PPwork = new PPworks($cn);
                $d = date("Y-m-d H:i:s");
                $info = array(
                    ":returndate" => date_format(date_create($returndate),"Y-m-d"),
                    ":returnqty" => $returnqty,
                    ":rtno" => $rtno,
                    ":rcpno" => $rcpno,
                    ":remark" => $remark === "" ? '-' : $remark,
                    ":ppid" => $ppid,
                    ":pcby" => $user_name,
                    ":peby" => $user_name,
                    ":pcdate" => $d,
                    ":peditdate" => $d,
                    ":pextra" => "-"
                );
                $id = $ppid;
                echo $PPwork->NewRecieve($info,$id);
            }           
            }
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }
