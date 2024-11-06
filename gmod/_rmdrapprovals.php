<?php 
require_once '../connection/connection.php';
require_once '../controller/mac.php';
$enc = new mac();

$conn = new connection();
$cn = $conn->connect();

$prj = $enc->enc('enc','p08/20');
$sql = "SELECT *FROM pms_draw_approvals where approvals_project_code=:approvals_project_code";
$cm = $cn->prepare($sql);
$cm->bindParam(":approvals_project_code",$prj);
$cm->execute();
$cnt = $cm->rowCount();
echo $cnt;

$sql = "DELETE FROM pms_draw_approvals where approvals_project_code=:approvals_project_code";
$cm = $cn->prepare($sql);
$cm->bindParam(":approvals_project_code",$prj);
$cm->execute();
$cnt = $cm->rowCount();

?>