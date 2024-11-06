<?php 
    header("Content-Type:text/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");
    extract($_GET);
    if(!isset($partno) || $partno === ""){
        $response = array(
            'msg' => "0",
            'data' => "Enter Part No And try Again..."
        );
        echo json_encode($response);
    }else{
        require_once '../../connection/connection.php';
        $conn = new connection();
        $cn = $conn->connect();

        require_once '../../controller/mac.php';
        $enc = new mac();

        if(_checkItem($cn,$enc,$partno) !== 0){
            $response = array(
                'msg' => "1",
                'data' => _getinfo($cn,$enc,$partno)
            );
            echo json_encode($response);
        }else{
            $response = array(
                'msg' => "0",
                'data' => "NO Data found"
            );
            echo json_encode($response);
        }
    }

    function _checkItem($cn,$enc,$partno){
        $sql = "SELECT *FROM bom_items where itempartno=:itempartno";
        $cm = $cn->prepare($sql);
        $cm->bindParam(":itempartno",$partno);
        $cm->execute();
        $rw = $cm->rowCount();
        unset($cm,$sql);
        return $rw;
    }

    function _getinfo($cn,$enc,$partno){
        $sql = "SELECT *FROM bom_items where itempartno=:itempartno limit 1";
        $cm = $cn->prepare($sql);
        $cm->bindParam(":itempartno",$partno);
        $cm->execute();
        $rows = $cm->fetch(PDO::FETCH_ASSOC);
        extract($rows);
        $infos = array(
            'itempartno' => $itempartno,
            'itemalloy' => $itemalloy,
            'itemfinish' => $itemfinish,
            'itemlength' => $itemlength,
            'itemunit' => $itemunit,
            'itemdieweight' => $itemdieweight,
            'itemtype' => $itemtype,
            'itemdescription' => $itemdescription,            
            'itempartfunction' => $itempartfunction,
        );

        unset($cm,$sql,$rows);
        return $infos;
    }
?>