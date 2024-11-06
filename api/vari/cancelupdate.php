<?php
include_once('../_def.php');
$auth = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    include_once('../../connection/connection.php');
    $connection = new connection();
    $db = $connection->connect();
    $naf_user = array(
        'user_name' => $user_name,
        'user_token' => $user_token
    );
    $datas = array(
        'naf_user' => $naf_user
    );
    $s = json_encode($datas);
    $data = json_decode($s);
    include_once('../../controller/User.php');
    $user = new User($db);
    include_once('../_auth.php');
    if ($auth === true) {
        if (!isset($status) || $status === '') {
            echo response('0', 'Select Status');
        } else if (!isset($caceldate) || $caceldate === '' || !date_create($caceldate)) {
            echo response('0', 'Select Cancelled Date and/or Cancelled Date is Not a date format');
        } else if (!isset($cancelby) || $cancelby === '') {
            echo response('0', 'Enter Who was Cancelled?');
        } else if (!isset($variation_project) || $variation_project === '') {
            echo response('0', 'Select Project');
        } else if (!isset($variation_token) || $variation_token === '') {
            echo response('0', 'Select Variations');
        } else if (!isset($revison_token) || $revison_token === '') {
            echo response('0', 'Select Revision');
        } else {

            include_once '../../controller/vari.php';
            $variations = new Variations($db);
            $_caceldate = date_create($caceldate);
            $caceldate = date_format($_caceldate, 'Y-m-d');


            $variation = array(
                ':variation_status' => $variations->enc('enc', $status),
                ':caceldate' => $caceldate,
                ':cancelby' => $variations->enc('enc', $cancelby),
                ':variation_project' => $variations->enc('enc', strtolower($variation_project)),
                ':variation_token' => $variation_token,
            );

            $revision = array(
                ':revision_status' => $variations->enc('enc', $status),
                ':caceldate' => $caceldate,
                ':cancelby' => $variations->enc('enc', $cancelby),
                ':revison_token' => $revison_token,
                ':revison_project' => $variations->enc('enc', strtolower($variation_project)),
                ':variation_token' => $variation_token,
            );

            echo $variations->CancelVariations($variation, $revision);
            exit;           
        }
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
