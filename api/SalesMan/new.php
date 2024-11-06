<?php
include_once('../_def.php');
$auth = true;
include_once('../../connection/connection.php');
$connection = new connection();
$db = $connection->connect();
include_once('../../controller/User.php');
$user = new User($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($data->sales_code) || $data->sales_code === '') {
            echo response("0", "Enter Sales Man Code");
        }else if(!isset($data->sales_name) || $data->sales_name === ''){
            echo response("0", "Enter Sales Man Name");
        } else {
            include_once('../../controller/SalesMans.php');
            $SalesMans = new SalesMans($db);
            $scode = strtolower($data->sales_code);
            $rename = strtolower($data->sales_name);
            echo $SalesMans->NewSalesMan($scode,$rename);
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
