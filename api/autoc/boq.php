<?php 

    header("Content-Type:text/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");


    require_once '../../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();

    require_once '../../controller/mac.php';
    $enc = new mac();

    //item number;
    
    $boq_autocom = array(
        'itemno' => _itemno($cn,$enc),
        'itemremark' => _itemRemark($cn,$enc),
        'description' => _itemDescripton($cn,$enc),
        'glassspecification' => _itemGlassSpecification($cn,$enc),
        'glasssingle' => _itemGlassSingle($cn,$enc),
        'double1' => _itemGlassDouble1($cn,$enc),
        'double2' => _itemGlassDouble2($cn,$enc),
        'double3' => _itemGlassDouble3($cn,$enc),
        'laminate1' => _itemGlassLaminate1($cn,$enc),
        'laminate2' => _itemGlassLaminate2($cn,$enc),
        'drawing' => _itemDrawing($cn,$enc),
        'notes' => _itemNotes($cn,$enc),
    );

    


    $response = array(
        'msg' => "1",
        'data' => $boq_autocom
    );

    echo json_encode($response);


    function _itemno($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_no from pms_poq group by poq_item_no";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_no']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemRemark($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_remark from pms_poq group by poq_remark";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_remark']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemDescripton($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_remark from pms_poq group by poq_item_remark";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_remark']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemGlassSpecification($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_spec from pms_poq  group by poq_item_glass_spec";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_spec']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }


    function _itemGlassSingle($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_single from pms_poq group by poq_item_glass_single";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_single']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemGlassDouble1($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_double1 from pms_poq group by poq_item_glass_double1";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_double1']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemGlassDouble2($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_double2 from pms_poq group by poq_item_glass_double2";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_double2']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemGlassDouble3($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_double3 from pms_poq group by poq_item_glass_double3";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_double3']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    
    function _itemGlassLaminate1($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_laminate1 from pms_poq group by poq_item_glass_laminate1";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_laminate1']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemGlassLaminate2($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_item_glass_laminate2 from pms_poq group by poq_item_glass_laminate2";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_item_glass_laminate2']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemDrawing($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT poq_drawing from pms_poq group by poq_drawing";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['poq_drawing']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }

    function _itemNotes($cn,$enc){
        $itemnolist = [];
        $sql = "SELECT boq_note_notes from pms_boq_notes group by boq_note_notes";
        $cm = $cn->prepare($sql);
        $cm->execute();
        while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
            $itemnolist[] = $enc->enc('denc',$rows['boq_note_notes']);
        }
        unset($cm,$sql,$rows);
        return $itemnolist;
    }
?>