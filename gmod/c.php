<?php 
    include_once '../connection/connection.php';
    $conn = new connection();
    $cn = $conn->connect();
    include_once '../controller/mac.php';
    $enc = new mac();
    $pojectno = $enc->enc('enc','p26/22');
    $drwingno = $enc->enc('enc',strtolower("NAF-ALU-P05-TB-300"));
    echo $pojectno;
    $sql = "SELECT *FROM pms_draw_approvals where approvals_project_code = '$pojectno' and approvals_draw_no = '$drwingno'";
    echo $sql;
    $cm = $cn->prepare($sql);
    $cm->execute();    
?>
<table>
    <thead>
        <tr>
            <th>S.NO</th>
            <th>Token</th>
            <th>For</th>
            <th>Drawing No</th>
            <th>Last Status</th>
            <th>Revision Number</th>
            <th>Revison Code</th>            
        </tr>
    </thead>
    <tbody>
        <?php 
            $sno = 0;
            while($rows = $cm->fetch(PDO::FETCH_ASSOC)){
                $sno += 1;
                extract($rows);
                ?>
                <tr>
                    <td><?php echo $sno?></td>
                    <td><?php echo $approvals_token;?></td>
                    <td><?php echo $enc->enc('denc',$approvals_for);?></td>
                    <td><?php echo $enc->enc('denc',$approvals_draw_no);?></td>
                    <td><?php echo $enc->enc('denc',$approvals_descriptions);?></td>
                    <td><?php echo $enc->enc('denc',$approvals_last_status);?></td>
                    <td><?php echo $enc->enc('denc',$approvals_last_revision_code);?></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>