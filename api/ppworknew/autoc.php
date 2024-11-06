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

    $response = array(
        'materiallist' => _materialTypes($cn),
        'materiallistpp' => _materialTypePP($cn),
        'descriptionlist' => _descriptions($cn),
        'descriptionlistpp' => _descriptionsPP($cn),
        'colorlistPP' => _colorlistPP($cn),
        'colorlist' => _colorlist($cn),
        'unitlist' => ppnewunitlist($cn),
        'locationlist' => _locationlist($cn),
        'remarklist' => _Remarklist($cn)
    );

    echo json_encode($response);


    function _materialTypes($cn){
        $sql = "SELECT *FROM bom_type";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] = $rows['typename'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _materialTypePP($cn){
        $sql = "SELECT pptype from ppnewrpt group by pptype";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] = $rows['pptype'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _descriptionsPP($cn){
        $sql = "SELECT ppdescription from ppnewrpt group by ppdescription";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] = $rows['ppdescription'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _descriptions($cn){
        $sql = "SELECT itemdescription from bom_items group by itemdescription";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] = $rows['itemdescription'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _colorlistPP($cn){
        $sql = "SELECT ppcolor from ppnewrpt group by ppcolor";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] = $rows['ppcolor'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _colorlist($cn){
        $sql = "SELECT *FROM bom_finish";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] =$rows['finishcolor'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function ppnewunitlist($cn){
        $sql = "SELECT *FROM bom_units";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] =$rows['unitname'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _locationlist($cn){
        $sql = "SELECT location from ppnewrpt group by location";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] =$rows['location'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }

    function _Remarklist($cn){
        $sql = "SELECT remarks from ppnewrpt group by remarks";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $t = [];
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $t[] =$rows['remarks'];
        }
        unset($cm,$sql,$rows);
        return $t;
    }


    



    
?>