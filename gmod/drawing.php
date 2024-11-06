<?php 
require_once '../connection/connection.php';
require_once '../controller/mac.php';
$enc = new mac();

$conn = new connection();
$cn = $conn->connect();

$approvals_info_drawing_no = $enc->enc('enc','naf-alu-asf-ple01');
$approvals_info_reveision_no = $enc->enc('enc','01');
//w7Yci0najdbdLCmVpxnoqOcdyOjt0mFLvNJbgZul0fpjXrrGPU4zPufzGxtKDSGImRmy6luSAFv

// $sql = "SELECT *FROM pms_drawing_approvals_info where 
// approvals_info_drawing_no=:approvals_info_drawing_no";
$sql = "SELECT *FROM pms_drawing_approvals_info where 
approvals_info_id=15064";


// $p = array(
//     ':approvals_info_drawing_no' => $approvals_info_drawing_no,    
// );

// $sql = "SELECT *FROM pms_drawing_approvals_info where 
// approvals_info_token=:approvals_info_token";
// $p = array(
//     ':approvals_info_token' => 'B88XncJp5fybclP9G7gD1E6t9w22zQj9fcC9DHcTHUKJVWvugnbvdk0EInGgeCqaLEYILzxLbWPDwU4bJ1ZLhoMc8BbTd6djRsZjZ6WkFKYkF6SnNKaHNIZz0920230530020230'
// );
// $p = array(
//     ':approvals_info_drawing_no' => $approvals_info_drawing_no,
//     ':approvals_info_reveision_no' => $approvals_info_reveision_no,
// );
$cm = $cn->prepare($sql);
$cm->execute();

while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
    extract($rows);
    //echo $enc->enc('denc',$approvals_info_id);
    echo $approvals_info_id;
    echo "||";
    echo $enc->enc('denc',$approvals_info_project_id);
    echo "||";
    echo $enc->enc('denc',$approvals_info_drawing_no);
    echo "||";
    echo $enc->enc('denc',$approvals_info_reveision_no);
    echo "||";
    echo $enc->enc('denc',$approvals_info_code);
    //
}
?>