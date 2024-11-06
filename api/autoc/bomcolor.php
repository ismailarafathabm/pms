<?php
    header("Content-Type:text/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

    include_once '../../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();

    include_once '../../controller/mac.php';
    $enc = new mac();

   

    $res = array(
        'colors' => _colors($cn,$enc),
        'colnew' => _colorsN($cn,$enc),
        'system' => _systems($cn,$enc),
        'remarks' => _remarksAutocompleate($cn,$enc),
        'location' => _locationAutoCompleate($cn,$enc),
    );

    $response = array(
        "msg" => "1",
        "data" => $res
    );

    echo json_encode($response);


    function _colors($cn,$enc){

        $sql = "SELECT itemfinish from bom_items group by itemfinish";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $colors = [];
        
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $colors[] = $rows['itemfinish'];
        }
    
        unset($cm,$sql,$rows);
        return $colors;
    }

    function _colorsN($cn,$enc){
        $sql = "SELECT pp_color FROM ppreports GROUP BY pp_color";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $colors = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $colors[] = $rows['pp_color'];
        }
    
        unset($cm,$sql,$rows);
        return $colors;
    }

    function _systems($cn,$enc){

        $sql = "SELECT itemsystem from bom_items group by itemsystem";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $colors = [];
        
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $colors[] = $rows['itemsystem'];
        }
    
        unset($cm,$sql,$rows);
        return $colors;
    }

    function _remarksAutocompleate($cn,$enc){
        $sql = "SELECT pp_remarks from ppreports group by pp_remarks";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $rm = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $rm[] = $rows['pp_remarks'];
        }
        unset($cm,$sql,$rows);
        return $rm;
    }

    function _locationAutoCompleate($cn,$enc){
        $sql = "SELECT pp_location from ppreports group by pp_location";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $rm = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $rm[] = $rows['pp_location'];
        }
        unset($cm,$sql,$rows);
        return $rm;
    }
?>