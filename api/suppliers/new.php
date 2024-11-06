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
        if (!isset($data->supplier_name) || $data->supplier_name === '') {
            echo response("0", "Enter Supplier Supplier");         
        }else{
            include_once('../../controller/Supplier.php');
            $suppliers = new Suppliers($db);
            echo $suppliers->supplier_new($data->supplier_name);  
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "request Error");
}
