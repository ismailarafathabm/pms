<?php
include_once('../../_def.php');
$auth = true;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    include_once('../../../connection/connection.php');
    $connection = new connection();
    $cn = $connection->connect();

    if (isset($user_name) && isset($user_token)) {
        $naf_user = array(
            'user_name' => $user_name,
            'user_token' => $user_token
        );
        $datas = array(
            'naf_user' => $naf_user
        );
        $s = json_encode($datas);
        $data = json_decode($s);

        include_once('../../../controller/User.php');
        $user = new User($cn);
        include_once('../../_auth.php');
    }
    if ($auth === true) {
        include_once('../../../controller/mac.php');
        $enc = new mac();
        $sql = "SELECT *FROM (pms_draw_approvals inner join pms_draw_approvals_types on pms_draw_approvals_types.types_id = pms_draw_approvals.approvals_for) inner join pms_project_summary on pms_project_summary.project_no = pms_draw_approvals.approvals_project_code LIMIT $ofs, 200";
        $cm = $cn->prepare($sql);
        $cm->execute();
        $_approvals = [];
        while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
        }
        echo response("1", $_approvals);
    } else {
        echo response("0", "Access Error");
    }
} else {
    echo response("0", "Request Error");
}
