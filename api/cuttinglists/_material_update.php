<?php 
function updatematerial($cn,$updateinfo,$ct_id){

$matterial_flag = !isset($updateinfo->matterial_flag) || trim($updateinfo->matterial_flag) === '' ? '0' : trim($updateinfo->matterial_flag);
$material_release = date('Y-m-d');
$material_return = date('Y-m-d');
$materialstatus = '-';
$materialrefno = '-';

if ((int)$matterial_flag >= 2) {
    $material_release = !isset($updateinfo->material_release) || trim($updateinfo->material_release) === '' ? '' : trim($updateinfo->material_release);
    if ($material_release === '') {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Date"));
        die();
    }

    if(!date_create($material_release)){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
        die();
    }
    $material_release = date_format(date_create($updateinfo->material_release),'Y-m-d');

}

if((int)$matterial_flag === 3){
    $material_return = !isset($updateinfo->material_return) || trim($updateinfo->material_return) === '' ? '' : trim($updateinfo->material_return);
    if ($material_return === '') {
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Date"));
        die();
    }

    if(!date_create($material_return)){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Date Is Not A Valid Format"));
        die();
    }
    $material_return = date_format(date_create($updateinfo->material_return),'Y-m-d');

    $materialstatus = !isset($updateinfo->materialstatus) || trim($updateinfo->materialstatus) === '' ? '' : trim($updateinfo->materialstatus);
    if($materialstatus === ''){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Material status"));
        die();
    }

    $materialrefno = !isset($updateinfo->materialrefno) || trim($updateinfo->materialrefno) === '' ? '' : trim($updateinfo->materialrefno);
    if($materialrefno === ''){
        header("HTTP/1.0 400 Bad Request");
        echo json_encode(array("msg" => "0", "data" => "Enter Material Ref No#"));
        die();
    }
}


$sql = "UPDATE pms_cuttinglist set 
        matterial_flag = :matterial_flag,
        material_release = :material_release,
        material_return = :material_return,
        materialstatus = :materialstatus,
        materialrefno = :materialrefno 
        where 
        ct_id = :ct_id";
    $cm = $cn->prepare($sql);

    $params = array(
        ':matterial_flag' => $matterial_flag,
        ':material_release' => $material_release,
        ':material_return' => $material_return,
        ':materialstatus' => $materialstatus,
        ':materialrefno' => $materialrefno,
        ':ct_id' => $ct_id
    );
    $isupdate = $cm->execute($params);
    if(!$isupdate){
        header("HTTP/1.0 500 Server Error");
        echo response("0", "Error on Update Material Details");
        die();
    }
}
?>