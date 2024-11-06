<style>
    @font-face {
        font-family: pop;
        src: url('../themes/fonts/roboto/Roboto-Regular.ttf');
    }

    * {
        font-family: pop, sans-serif;
        font-size: 14px;
    }

    table {
        border-collapse: collapse;
    }

    table td,
    th {
        border: 1px solid #000;
    }
</style>
<?php
require_once '../connection/connection.php';
require_once '../controller/mac.php';
$enc = new mac();

$conn = new connection();
$cn = $conn->connect();
$cm = $cn->prepare("select *from pms_drawing_approvals_info where approvals_info_id=9168");
$cm->execute();
while($row = $cm->fetch(PDO::FETCH_ASSOC)){
    echo $enc->enc('denc',$row['approvals_info_project_id']);
    echo "</br>";
    echo $enc->enc('denc',$row['approvals_info_drawing_no']);
    echo "</br>";
    echo $enc->enc('denc',$row['approvals_info_reveision_no']);
    echo "</br>";
   
}
unset($cm,$row);
