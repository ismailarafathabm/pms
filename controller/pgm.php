<style>
    table {
        border-collapse: collapse;
    }

    table td,
    th {
        border: 1px solid #000;
        padding: 5px
    }

    table th {
        background-color: #000;
        color: #fff;
    }
</style>
<?php
require_once('../connection/connection.php');
$conn = new connection();
$cn = $conn->connect();

require_once('../controller/mac.php');
$enc = new mac();

$sql = "SELECT approvals_last_revision_no,COUNT(approvals_last_revision_no) as totals FROM pms_draw_approvals group by approvals_last_revision_no having COUNT(approvals_last_revision_no) > 1";
$cm = $cn->prepare($sql);
$cm->execute();
$ex_a = [];

$sno = 0;
while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
    $sno += 1;
    $token = $rows['approvals_last_revision_no'];
    $total = $rows['totals'];
    $ex_a[] =  $token;
}





$to = implode("','", $ex_a);
$sql = "SELECT *FROM pms_draw_approvals where approvals_last_revision_no in ('" . $to . "') order by approvals_last_revision_no asc";
$cm = $cn->prepare($sql);
$cm->execute();
?>

<table style="display:none">
    <thead>
        <tr>
            <th>S.NO</th>
            <th>Row Id</th>
            <th>Project NO</th>
            <th>token</th>
            <th>Drawing No</th>
            <th>Date</th>
            <th>Code</th>
            <th>Go File</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sno = 0;
        $arr = [];
        $info = [];
        while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {

            $sno += 1;
            $projectno = $enc->enc('denc', $rows['approvals_project_code']);
            $token = $rows['approvals_last_revision_no'];
            $fok = '0';

            $drawingno = $enc->enc('denc', $rows['approvals_draw_no']);
            $approvals_info_cdate = $rows['approvals_cdate'];
            $rowid = $rows['approvals_id'];
            $code = $enc->enc('denc', $rows['approvals_last_revision_code']);
            $arr[] = array(
                'approvals_info_token' => $token,
            );
            $info[] = array(
                'projectno' => $projectno,
                'approvals_info_token' => $token,
                'drawingno' => $drawingno,
                'rowid' => $rowid,
                'code' => $code
            );
            echo "<tr>
            <td>{$sno}</td>
            <td>{$rowid}</td>
            <td>{$projectno}</td>
            <td>{$token}</td>
            <td>{$drawingno}</td>
            <td>{$approvals_info_cdate}</td>";

            $files = '';
            if (file_exists("../assets/drawingapprovals/{$token}.pdf")) {
                $files = "../assets/drawingapprovals/{$token}.pdf";
            }
            echo "<td><a target='_blank' href='{$files}'>View</a></td>";
            echo "<td>{$code}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
$_sarry = array_map('unserialize', array_unique(array_map('serialize', $arr)));

foreach ($_sarry as $ar) {

?>
    <table style='margin-top:12px'>
        <tr>
            <th colspan="5">
                <?php echo $ar['approvals_info_token'] ?>
            </th>
        </tr>
        <?php
        $sno = 0;
        foreach ($info as $in) {
            if ($ar['approvals_info_token'] === $in['approvals_info_token']) {
                $sno += 1;
                $rowid = $in['rowid'];
                $projectno = $in['projectno'];
                $token = $in['approvals_info_token'];
                $drawingno = $in['drawingno'];
                $code = $in['code'];

                echo "<tr>
                <td>{$sno}</td>
                <td>{$rowid}</td>
                <td>{$projectno}</td>                
                <td>{$drawingno}</td>";
                $files = '';
                if (file_exists("../assets/drawingapprovals/{$token}.pdf")) {
                    $files = "../assets/drawingapprovals/{$token}.pdf";
                    echo "<td><a target='_blank' href='{$files}'>View</a></td>";
                } else {
                    echo "-";
                }
                echo "<td>{$code}</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
<?php
}
?>