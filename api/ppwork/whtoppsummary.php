<?php 
    header('content-type:text/json');
    include_once './../../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();

    $sql = "SELECT pp_project, pp_mtype ,pppartno,pplenght,ppalloy,ppitemtype,pp_dieweight  FROM `ppreports` where pp_type='pptowh'  GROUP BY pp_project, pp_mtype ,pppartno,pplenght,ppalloy,ppitemtype,pp_dieweight";
    $cm = $cn->prepare($sql);
    $cm->execute();

    $pro = [];

    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
        extract($rows);
        $pro[] = array(
            'pp_project' => $pp_project,                        
            'pp_mtype' => $pp_mtype,    
            'pppartno' => $pppartno,
            'pplenght' => $pplenght,
            'ppalloy' => $ppalloy,
            'ppitemtype' => $ppitemtype,
            'pp_dieweight' => $pp_dieweight,          
        );
    }
    unset($cm,$sql);
    
    $res = $pro;

    $response = array(
        'msg' => "1",
        'data' => $res
    );
    echo json_encode($response);
?>