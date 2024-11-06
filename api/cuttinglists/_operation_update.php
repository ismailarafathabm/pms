<?php
function operationupdate($cn, $updateinfo, $ct_id)
{


    $operation_flag = !isset($updateinfo->operation_flag) || trim($updateinfo->operation_flag) === '' ? '0' : trim($updateinfo->operation_flag);
    $operation_release = date('Y-m-d');
    $operation_return = date('Y-m-d');

    if ((int)$operation_flag >= 2) {
        $operation_release = !isset($updateinfo->operation_release) || trim($updateinfo->operation_release) === '' ? '' : trim($updateinfo->operation_release);
        if ($operation_release === '') {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Enter Date"));
            die();
        }

        if (!date_create($operation_release)) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
            die();
        }
        $operation_release = date_format(date_create($updateinfo->operation_release), 'Y-m-d');
    }

    if ((int)$operation_flag === 3) {
        $operation_return = !isset($updateinfo->operation_return) || trim($updateinfo->operation_return) === '' ? '' : trim($updateinfo->operation_return);
        if ($operation_return === '') {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Enter Date"));
            die();
        }

        if (!date_create($operation_return)) {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
            die();
        }
        $operation_return = date_format(date_create($updateinfo->operation_return), 'Y-m-d');
    }
    $sql = "UPDATE pms_cuttinglist set 
operation_flag = :operation_flag,
operation_release = :operation_release,
operation_return = :operation_return        
where 
ct_id = :ct_id";
    $cm = $cn->prepare($sql);
    $params = array(
        ':operation_flag' => $operation_flag,
        ':operation_release' => $operation_release,
        ':operation_return' => $operation_return,
        ':ct_id'  => $ct_id,
    );
    $isupdate = $cm->execute($params);

    if (!$isupdate) {
        header("HTTP/1.0 500 Server Error");
        echo response("0", "Error on Update Material Details");
        die();
    }
}
