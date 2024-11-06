<?php
    require_once './../connection/connection.php';
    $con = new connection();
    $cn = $con->connect();

    require_once './../controller/mac.php';
    $enc = new mac();

    $sql = "SELECT *FROM pms_draw_approvals where approvals_token='6tWkiNGmutGiyswPPdjb9JD5SsBLQnMUoWhLn8H27q7WtL8dNDQ3V0QccldRsCzJ3iZ4Pl5A7eV'";
    $cm = $cn->prepare($sql);
    $cm->execute();
    while($rows = $cm->fetch(PDO::FETCH_ASSOC)){        
        echo $rows['approvals_token'];
        echo "|";
        echo $enc->enc('denc',$rows['approvals_draw_no']);
        echo "|";
        echo $enc->enc('denc',$rows['approvals_project_code']);
        echo "|";         
        echo "<br/>";
    }
    unset($cm,$rows);
?>