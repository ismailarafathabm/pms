<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMOD - NAFCO</title>
    <style>
        @font-face {
            src: url('../themes/fonts/roboto/Roboto-Regular.ttf');
            font-family: roboto;
        }

        * {
            padding: 0px;
            margin: 0px;
        }

        body {

            font-family: 'roboto', sans-serif;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .conatiner {
            margin-top: 25px;
            width: 700px;
            background: #f1f1f1;
            border-radius: 15px;
            padding: 30px;
            border: 1px solid #e8e6e6;
            margin-bottom: 25px;
        }

        .table-row {
            display: flex;
            margin-bottom: 23px;
            background: #e9e7e7;
            padding: 10px;
            border-radius: 15px;
        }

        .table-row:hover {
            background-color: #0384FB;
            color: #fff;
        }

        .table-cell {

            padding: 5px 3px;
        }
    </style>
</head>

<body>
    <div class="conatiner">
        <div class="table-div">
            <?php
            $plist = [];
            require_once '../connection/connection.php';
            $conn = new connection();
            $cn = $conn->connect();

            ///$sqlx = "INSERT INTO pms_projects_info values( null, 'S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09', 'bFpEbmQzMmhaRUZPZkJ0ZmU4Umh2Rlg3UnpVZll0WW1sRllxY3B4TlFyRT0=', 'TXBEOWpsNjZCZ09ld3JGQTA4OTg3UT09', 'eVU5MWxXNmpmWUpyS0huRGpDdU43UT09', '2018-12-30', 'QUNOM3FseE5JZldjRldnOUJ4U21EQT09', '2020-02-28', 'dlJiQjdySVVrRktYUXNiZHlndW5YQT09', '2021-06-09', 'YzRxSjIxWU90clJiOW5OS3BLbFFvUT09', 'd2xXTnZqSXJEc2dyaWVYdVpYa2N1UT09', 'd2xXTnZqSXJEc2dyaWVYdVpYa2N1UT09', '2021-06-09', '2021-06-09' )";
            

            require_once '../controller/mac.php';
            $enc = new mac();

            $sql = "SELECT *FROM pms_projects_info";
            $cm = $cn->prepare($sql);
            $cm->execute();

            while ($rows = $cm->fetch(PDO::FETCH_ASSOC)) {
                $plist[] = array(
                    'ppcno' => strtolower($enc->enc('denc', $rows['ppcno'])),
                    'ppname' => strtolower($enc->enc('denc', $rows['ppname'])),
                    'ppregion' => strtolower($enc->enc('denc', $rows['ppregion'])),
                    'pplocation' => strtolower($enc->enc('denc', $rows['pplocation'])),
                    'ppsign' => $rows['ppsign'],
                    'ppduration' => strtolower($enc->enc('denc', $rows['ppduration'])),
                    'ppstatus' => strtolower($enc->enc('denc',$rows['ppstatus'])),
                );
            }
            unset($cm, $rows, $sql);
            $sno = 0;
            $colch = 1;


            // require_once '../../EMS/connections/connect.php';
            // $ems_conn = new connect();
            // $ems_cn = $ems_conn->conn();


            // require_once '../../EMS/controllers/gwaymac.php';
            // $ems_enc = new gmacmac();

            
            // $sql = "SELECT projectno,mdate from ems_manpower where mdate='2021-06-09' GROUP BY projectno";

            // $cm = $ems_cn->prepare($sql);
            // $cm->execute();

            // $manpprojects = [];
            // while($row = $cm->fetch(PDO::FETCH_ASSOC)){
            //     $manpprojects[] = array(
            //         'projectno' => strtolower($ems_enc->enc('denc',$row['projectno']))
            //     );
            // }

           // print_r($manpprojects);

            foreach ($plist as $p) {
                $sno += 1;
                
                // foreach($manpprojects as $m){
                //     if($m['projectno'] === $p['ppcno']){
                //         $pno = $enc->enc('enc',$p['ppcno']);
                //         $upby = $enc->enc('enc','irfan');
                //         $x = date('Y-m-d');
                //         $status = $enc->enc('enc',"1");
                //         $sql = "UPDATE pms_projects_info set 
                //         ppstatus='$status',
                //         ppstatuschdate='$x',
                //         ppstatusupby='$upby' where ppcno='$pno'";
                //         $cm =$cn->prepare($sql);
                //         $cm->execute();
                //     }
                // }
                // $sqlx = "INSERT INTO pms_projects_info values(
                //     null,
                //     '$ppcno',
                //     '$ppname',
                //     '$ppregion',
                //     '$pplocation',
                //     '$ppsign',
                //     '$ppduration',
                //     '$ppexpiry',
                //     '$ppstatus',
                //     '$ppstatuschdate',
                //     '$ppstatusupby',
                //     '$ppcby',
                //     '$ppeby',
                //     '$ppcdate',
                //     '$ppedate'
                // )";

                // $cm = $cn->prepare($sqlx);

                // if ($cm->execute()) {
                //     echo "saved";
                // } else {
                //     echo "error";
                // }

                // echo $sqlx;

                $col = $p['ppstatus'] === '1' ? 'font-weight:bold' : '';

            ?>
                <div class="table-row" style="<?php echo $col?>">
                    <div class="table-cell" style="margin-right: 10px;">
                        <?php echo $sno ?>
                    </div>
                    <div class="table-cell" style="width:100px">
                        <?php echo $p['ppcno'] ?>
                    </div>
                    <div class="table-cell" style="width:400px">
                        <?php echo $p['ppname'] ?>
                    </div>
                    <div class="table-cell" style="width:150px">
                        <?php echo $p['ppregion'] ?>
                    </div>
                    <div class="table-cell" style="width:100px">
                        <?php echo $p['pplocation'] ?>
                    </div>
                    <div class="table-cell" style="width:120px">
                        <?php echo $p['ppsign'] ?>
                    </div>
                    <div class="table-cell" style="width:20px">
                        <?php echo $p['ppduration'] ?>
                    </div>
                    <div class="table-cell" style="width:120px">
                        <?php 
                            if($p['ppstatus'] === '1'){
                                echo "RUNNING WITH MANPOWER";
                            }else if($p['ppstatus'] === '2'){
                                echo "RUNNING WITH OUT MANPOWER";
                            }
                            else if($p['ppstatus'] === '3'){
                                echo "NOT STARTED PROJECT WITHO OUT MANPOWER";
                            }else if($p['ppstatus'] === '4'){
                                echo "HAND OVER PROJECTS";
                            }
                            else{
                                echo "-";
                            }
                        ?>                        
                    </div>
                </div>
            <?php
            }


            function random_color_part()
            {
                return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
            }

            function random_color()
            {
                return random_color_part() . random_color_part() . random_color_part();
            }
            ?>



        </div>
    </div>
</body>

</html>