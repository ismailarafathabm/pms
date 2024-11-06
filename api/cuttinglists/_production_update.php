<?php
function productionupdate($cn, $updateinfo, $ct_id)
{


    $production_flag = !isset($updateinfo->production_flag) || trim($updateinfo->production_flag) === '' ? '0' : trim($updateinfo->production_flag);
    $production_release = date('Y-m-d');
    $production_accept = date('Y-m-d');

    if ((int)$production_flag >= 2) {
        $production_release = !isset($updateinfo->production_release) || trim($updateinfo->production_release) === '' ? '' : trim($updateinfo->production_release);
        if ($production_release === '') {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Enter Date"));
            die();
        }

        if (!date_create($production_release)) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
            die();
        }
        $production_release = date_format(date_create($updateinfo->production_release), 'Y-m-d');
    }

    if ((int)$production_flag === 3) {
        $production_accept = !isset($updateinfo->production_accept) || trim($updateinfo->production_accept) === '' ? '' : trim($updateinfo->production_accept);
        if ($production_accept === '') {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Enter Date"));
            die();
        }

        if (!date_create($production_accept)) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
            die();
        }
        $production_accept = date_format(date_create($updateinfo->production_accept), 'Y-m-d');
    }

    $sql = "UPDATE pms_cuttinglist set 
        production_flag = :production_flag,
        production_returnflag = :production_returnflag,
        production_release = :production_release,
        production_accept = :production_accept        
        where 
        ct_id = :ct_id";
    $cm = $cn->prepare($sql);
    $params = array(
        ':production_flag' => $production_flag,
        ':production_returnflag' => $production_flag,
        ':production_release' => $production_release,
        ':production_accept' => $production_accept,
        ':ct_id'  => $ct_id,
    );
    $isupdate = $cm->execute($params);
    unset($cm, $sql);

    if (!$isupdate) {
        header("HTTP/1.0 500 Server Error");
        echo response("0", "Error on Update Material Details");
        die();
    }
}
