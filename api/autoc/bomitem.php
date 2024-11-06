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

    $sql = "SELECT itempartno FROM bom_items group by itempartno";
    $cm = $cn->prepare($sql);
    $cm->execute();
    $parno = [];
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        $parno[] = $rows['itempartno'];
    }
    unset($cm,$sql,$rows);
    $response = array(
        'msg' => "1",
        'data' => $parno
    );

    echo json_encode($response);
    
?>