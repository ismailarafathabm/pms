<?php
    date_default_timezone_set('Asia/Riyadh');
    $date = date('Y-m-d h:s:t');
    include_once('../connection/connection.php');
    $connection = new connection();
    $cn = $connection->connect();
    include_once('cuttinglistmo.php');    
    $cuttinglistmo = new CuttingListMo($cn);
    //echo $cuttinglistmo->cuttinglist_all("p01/19");
    $svdata = array(
        ':cuttinglist_token' => $cuttinglistmo->token(25),
        ':cuttinglist_project_id' => $cuttinglistmo->enc('enc', 'p01/19'),
        ':cuttinglist_clrefno' => $cuttinglistmo->enc('enc', 'P07/18-001'),
        ':cuttinglist_cldaterelease' => $cuttinglistmo->enc('enc', '20-06-18'),
        ':cuttinglist_morefno' => $cuttinglistmo->enc('enc', '23225'),
        ':cuttinglist_moreleasedtoacct' => $cuttinglistmo->enc('enc', '13-06-18'),
        ':cuttinglist_moreleasedtoproduction' => $cuttinglistmo->enc('enc', '20-06-2018'),
        ':cuttinglist_releasedto' => $cuttinglistmo->enc('enc', "HA'IR"),
        ':cuttinglist_doneby' => $cuttinglistmo->enc('enc', 'FAIZAL'),
        ':cuttinglist_markingtype' => '1',
        ':cuttinglist_descripton' => $cuttinglistmo->enc('enc', 'EFP STRUCTURAL CURTAIN WALL-EFP STRUCTURAL SYSTEM P.C RAL 1035'),
        ':cuttinglist_location' => $cuttinglistmo->enc('enc', 'SAMPLE'),
        ':cuttinglist_qty' => $cuttinglistmo->enc('enc', '1'),
        ':cuttinglist_height' => $cuttinglistmo->enc('enc', '0.69'),
        ':cuttinglist_width' => $cuttinglistmo->enc('enc', '0.69'),
        ':cuttinglist_area' => $cuttinglistmo->enc('enc', '0.48'),
        ':cuttinglist_classrefno' => $cuttinglistmo->enc('enc', '0577/18'),
        ':cuttinglist_sheettp' => $cuttinglistmo->enc('enc', 'N/A'),
        ':cuttinglist_remarks' => $cuttinglistmo->enc('enc', 'SMAPLE REQUEST C023/18'),
        ':cuttinglist_section' => $cuttinglistmo->enc('enc', 'F'),
        ':cuttinglist_status' => $cuttinglistmo->enc('enc', '1'),
        ':cuttinglist_cby' => $cuttinglistmo->enc('enc', 'eng_demo'),
        ':cuttinglist_eby' => $cuttinglistmo->enc('enc', 'eng_demo'),
        ':cuttinglist_cdate' => $date,
        ':cuttinglist_edate' => $date,
        ':cuttinglist_boqitem' => $cuttinglistmo->enc('enc','T1')
    );
    $updatedata = array(
    
        ':cuttinglist_clrefno' => $cuttinglistmo->enc('enc', 'P07/18-001'),
        ':cuttinglist_cldaterelease' => $cuttinglistmo->enc('enc', '20-06-18'),
        ':cuttinglist_morefno' => $cuttinglistmo->enc('enc', '23225'),
        ':cuttinglist_moreleasedtoacct' => $cuttinglistmo->enc('enc', '13-06-18'),
        ':cuttinglist_moreleasedtoproduction' => $cuttinglistmo->enc('enc', '20-06-2018'),
        ':cuttinglist_releasedto' => $cuttinglistmo->enc('enc', "HA'IR"),
        ':cuttinglist_doneby' => $cuttinglistmo->enc('enc', 'FAIZAL'),
        ':cuttinglist_markingtype' => '2',
        ':cuttinglist_descripton' => $cuttinglistmo->enc('enc', 'EFP STRUCTURAL CURTAIN WALL-EFP STRUCTURAL SYSTEM P.C RAL 1035'),
        ':cuttinglist_location' => $cuttinglistmo->enc('enc', 'SAMPLE'),
        ':cuttinglist_qty' => $cuttinglistmo->enc('enc', '2'),
        ':cuttinglist_height' => $cuttinglistmo->enc('enc', '0.69'),
        ':cuttinglist_width' => $cuttinglistmo->enc('enc', '0.69'),
        ':cuttinglist_area' => $cuttinglistmo->enc('enc', '100.1'),
        ':cuttinglist_classrefno' => $cuttinglistmo->enc('enc', '0577/18'),
        ':cuttinglist_sheettp' => $cuttinglistmo->enc('enc', 'N/A'),
        ':cuttinglist_remarks' => $cuttinglistmo->enc('enc', 'SMAPLE REQUEST C023/18'),
        ':cuttinglist_section' => $cuttinglistmo->enc('enc', 'F'),
        ':cuttinglist_status' => $cuttinglistmo->enc('enc', '1'),        
        ':cuttinglist_eby' => $cuttinglistmo->enc('enc', 'eng_demo'),        
        ':cuttinglist_edate' => $date,
        ':cuttinglist_boqitem' => $cuttinglistmo->enc('enc', 'T1'),
        ':cuttinglist_token' => 'dvV9514S1vJTFsZDp2v5KUgvV',
        ':cuttinglist_project_id' => $cuttinglistmo->enc('enc', 'p01/19'),
    );

    
?>

<H1 style="color:red">Access Error</H1>
<?php 
    header("location:../index.php");
?>