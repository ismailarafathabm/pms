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
            if(isset($ppid) && $ppid !== ""){
                include_once '../../controller/deleterc.php';
                $delr = new DeleteRec($cn);
                $delr->_save_pp_infodelet($ppid,$user_name);
                if(_removePP($cn,$ppid)){
                    if(_removePPS($cn,$ppid)){                        
                       echo response("1","Removed");
                    }else{
                        echo response("0","Error On Delete ITEMS2");
                    }
                }else{
                    echo response("0","Error On Delete ITEMS1");
                }
            }else{
                echo response("0","Select Any Data");
            }
        }
        else{
            echo response("0", "Access Error");
        }
    }else{
        echo response("0", "Request Error");
    }


function _removePP($cn,$id){
    $sql = "DELETE FROM ppreports where pprid=:pprid";
    $cm = $cn->prepare($sql);
    $cm->bindParam(":pprid",$id);
    $sv = $cm->execute();
    unset($cm,$sql);
    return $sv;
}

function _removePPS($cn,$id){
    $sql = "DELETE FROM ppsubreport where ppid=:pprid";
    $cm = $cn->prepare($sql);
    $cm->bindParam(":pprid",$id);
    $sv = $cm->execute();
    unset($cm,$sql);
    return $sv;
}