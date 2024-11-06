<?php 
    session_start();
?>
<html>

<head>
    <title><?php echo 'NAFCO-PMS (BOQ PRINT)' ?></title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Teko&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Squada+One&display=swap" rel="stylesheet">
    
    <style>
        @page {
            size: A4;
            margin: 5px;
        }


        .tsummary {
            font-family: 'Roboto Slab', serif;
            font-size: 12px;
        }

        h1 {
            font-family: Fredoka One;
            letter-spacing: 2px;
            animation: erroanimations 5s infinite;
        }

        @keyframes erroanimations {
            0% {
                color: #2a21db;
                text-shadow: 0px -25px 18px #2a21db;
            }

            10% {
                color: #ff577f;
                text-shadow: 20px 25px 18px #ff577f;
            }

            45% {
                color: #c70039;
                text-shadow: -20px +35px 18px #c70039;
            }

            90% {
                color: #ff577f;
                text-shadow: -5px -35px 18px #ff577f;
            }

            100% {
                color: #2a21db;
                text-shadow: 0px 0px 18px #2a21db;
            }
        }

        .title_td {
            width: 20%;
            text-align: right;
            padding: 5px;
        }

        .body_td {
            width: 80%;
            padding: 2px;

        }

        .spcl {
            font-family: 'Fredoka One', cursive;
            font-weight: bold;
            font-size: 18px;
            letter-spacing: 3px;
        }

        ._title {
            font-family: 'Squada One', cursive;
            font-weight: bold;
            font-size: 16px;
            letter-spacing: 3px;
        }




        .table {
            border-collapse: collapse;
            font-family: 'Roboto Slab', serif;
            font-size: 12px;
            width: 100%;
        }

        .table,
        th,
        td {
            border: 1px solid black;
            font-size: 12px;
        }

        .td_others {
            font-weight: bold;
            text-align: center;
        }

        th {
            font-family: 'Fredoka One', cursive;
            font-size: 12px;
            background-color: #74a1e8;
            color: #000;
        }

        .td_onlyright {
            border-top: 0px solid #000;
            border-left: 0px solid #000;
            border-right: 1px solid #000;
            border-bottom: 0px solid #000;
            text-align: right;
            width: 10%;
        }

        @media print {
            #exportexcel {
                display: none;
            }

            .footer {
                position: fixed;
                width: 100%;
                bottom: 30;
                color: #000;
                counter-increment: page;
                content: counter(page);
            }

            .header {
                display: none;
                position: fixed;
                top: 0;
            }

            .bodya {
                position: relative;
            }

            ._left {
                position: relative;
                left: 0px;
                font-size: 8px;
            }

            ._right {
                position: relative;
                left: 60%;
                font-size: 8px;
            }
        }
    </style>
</head>
<?php

if (!isset($_SESSION['nafco_alu_user_name']) || !isset($_SESSION['nafco_alu_user_department'])) {
    echo '<h1 style="color:red">Access Error!</h1>';
} else {
    $userdep = $_SESSION['nafco_alu_user_department'];
    $price_access = ['superadmin', 'operation', 'Management', 'accounts', 'contract and operations', 'estimate'];
    $_price_acces = false;
    foreach ($price_access as $p) {
        if ($userdep === $p) {
            $_price_acces = true;
        }
    }
    if ($_price_acces || $_SESSION['nafco_alu_user_name'] === 'naser') {


        if (!isset($_GET['project_code']) || $_GET['project_code'] === "") {
            echo "Choose Any Project...";
            exit();
        }
        include_once('../conf.php');
        include_once('../connection/connection.php');
        $conn = new connection();
        $db = $conn->connect();

        include_once('../controller/Projects.php');
        $proj = new Projects($db);

        $project_name = $_GET['project_code'];
        //    echo $proj->getProjectinfo($project_name);
        $api = json_decode($proj->getProjectinfo($project_name));
        if ($api->msg !== "1") {
            echo "This Project Number Not Found .....";
            exit();
        }
        $infos = $api->data;

        $_boq = json_decode($proj->all_boqs($project_name, $infos->project_boq_refno, $infos->project_boq_revision));
        $_binfo = $_boq->data->boq;

        include_once('../controller/boqitems.php');
        $boqitems = new Boqitems($db);
        $boqspeicalnotes = json_decode($boqitems->BoqItemsAll($project_name));
        $boqspeicalnotesitems = $boqspeicalnotes->data;
        $havedata = count($boqspeicalnotes->data) === 0 ? false : true;

        //echo $proj->get_all_spc($project_name);
        //$_terms = json_decode($proj->get_terms($project_name));
        //echo json_encode($_boq->data->notes);

?>


        <body>
            <div style="position:absolute;width:95%;margin-top:0px">
                <div style="font-family: 'Ubuntu',sans-serif;color:#2a21db;top:0px">
                    <div class="header">
                        <table style="width:60%" style="border:0px">
                            <tr>
                                <td style="width:10%;border:0px">
                                    <img src="<?php echo $url_asset ?>/nafco_imgs/LOGO_PRINT.png" width="100px" height="100px" />
                                </td>
                                <td style="width:80%;border:0px">
                                    <p style="font-family: 'Anton', sans-serif;letter-spacing:5px;font-size:22px;font-weight:bold;color:#014011"><?php echo $project_name ?> - PROJECT BOQ</p>

                                </td>
                            </tr>
                        </table>
                    </div>


                    <button id="exportexcel" style="display: none;">Excel Export</button>
                    <div class="bodya" style="padding:10px;width:100%;top:20%">
                        <table id="boqtable" class="table" style="width:100%;height:85%;">
                            <thead>
                                <tr>
                                    <th style="width:5%">
                                        Item No.
                                    </th>
                                    <th style="width:60%">
                                        Description
                                    </th>
                                    <th style="width:5%">
                                        QTY
                                    </th>
                                    <th style="width:5%">
                                        Unit
                                    </th>
                                    <?php 
                                        if($_SESSION['nafco_alu_user_name'] !== 'naser'){
                                        
                                    ?>
                                    <th style="width:10%">
                                        Unit Price
                                    </th>
                                    <th style="width:10%">
                                        Total Price
                                    </th>
                                    <?php 
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totals = 0;
                                foreach ($_binfo as $_b) {

                                ?>
                                    <tr>
                                        <td class="td_others">
                                            <?php echo $_b->boq_info->poq_item_no ?>
                                        </td>
                                        <td>
                                            <table style="width:100%;" class='.table'>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        Type :
                                                    </td>
                                                    <td style="border:0px;">
                                                        <b><?php echo $_b->boq_info->ptype_name ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                    </td>
                                                    <td style="border:0px;">
                                                        <b><?php echo $_b->boq_info->poq_item_remark ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        LOCATION:
                                                    </td>
                                                    <td style="border:0px;">
                                                        <b><?php echo $_b->boq_info->poq_remark ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        DIM (MM) :
                                                    </td>
                                                    <td style="border:0px;">
                                                        <table style="border:0px;width:100%">
                                                            <tr>
                                                                <td style="width:30%;border:0px">WIDTH (MM) :</td>
                                                                <td style="width:30%;border:0px">HEIGHT (MM)</td>
                                                                <td style="width:30%;border:0px">AREA</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:30%;border:0px"><?php echo $_b->boq_info->poq_item_width ?></td>
                                                                <td style="width:30%;border:0px"><?php echo $_b->boq_info->poq_item_height ?></td>
                                                                <td style="width:30%;border:0px"><?php echo $_b->boq_info->area ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        Glass :
                                                    </td>
                                                    <td style="border:0px;">
                                                        <b><?php echo $_b->boq_info->poq_item_glass_spec ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                    </td>
                                                    <td style="border:0px;">
                                                        <table style="width:100%;" class='table'>
                                                            <tr>
                                                                <td style="width:25%;" class="text-right">SINGLE :</td>
                                                                <td style="width:25%;" class="text-center"><?php echo $_b->boq_info->poq_item_glass_single ?></td>
                                                                <td style="width:25%;" class="text-center"></td>
                                                                <td style="width:25%;" class="text-center"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">DOUBLE :</td>
                                                                <td class="text-center"><?php echo $_b->boq_info->poq_item_glass_double1 ?></td>
                                                                <td class="text-center"><?php echo $_b->boq_info->poq_item_glass_double2 ?></td>
                                                                <td class="text-center"><?php echo $_b->boq_info->poq_item_glass_double3 ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">LAMINATED :</td>
                                                                <td class="text-center"><?php echo $_b->boq_info->poq_item_glass_laminate1 ?></td>
                                                                <td class="text-center"><?php echo $_b->boq_info->poq_item_glass_laminate2 ?></td>
                                                                <td></td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        Drawing :
                                                    </td>
                                                    <td style="border:0px;" class="text-right">
                                                        <b><?php echo $_b->boq_info->poq_drawing ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        Finish :
                                                    </td>
                                                    <td style="border:0px;" class="text-right">
                                                        <b><?php echo $_b->boq_info->finish_name ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td_onlyright">
                                                        System :
                                                    </td>
                                                    <td style="border:0px;" class="text-right">
                                                        <b><?php echo $_b->boq_info->system_type_name ?></b>
                                                    </td>

                                                </tr>
                                                <?php
                                                if (count($_b->boq_info->notes) !== 0) {
                                                ?>
                                                    <tr>
                                                        <td class="td_onlyright">
                                                            Notes:
                                                        </td>
                                                        <td style="border:0px;" class="text-right">
                                                            <table>
                                                                <?php
                                                                foreach ($_b->boq_info->notes as $notes) {
                                                                ?>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <?php
                                                                            echo $notes->boq_note_notes
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </table>
                                        </td>
                                        <td class="td_others" style="text-align:right">
                                            <b><?php echo $_b->boq_info->poq_qty ?></b>
                                        </td>
                                        <td class="td_others">
                                            <b><?php echo $_b->boq_info->unit_name ?></b>
                                        </td>
                                        <?php 
                                            $totals += floor((float) $_b->boq_info->tot);
                                            if($_SESSION['nafco_alu_user_name'] !== 'naser'){
                                        ?>
                                        <td class="td_others" style="text-align:right">
                                            <b><?php echo $_b->boq_info->poq_uprice ?></b>
                                        </td>
                                        <?php
                                        
                                        ?>
                                        <td class="td_others" style="text-align:right">
                                            <b><?php echo floor($_b->boq_info->tot) ?></b>
                                        </td>
                                        <?php 
                                            }
                                        ?>
                                    </tr>

                                <?php

                                }
                                ?>
                                <?php 
                                if($_SESSION['nafco_alu_user_name'] !== 'naser'){
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Amount</td>
                                    <td style="color:#000000;font-weight: 600;font-size:14px !important;text-align:right">
                                        <?php
                                        echo $totals;
                                        ?>
                                        sar
                                    </td>
                                </tr>
                                <?php }?>

                                <?php
                                if ($havedata === true) {
                                    $i = 1;
                                    foreach ($boqspeicalnotesitems as $notes) {
                                ?>
                                        <tr>
                                            <td style="text-align:right">
                                                <?php echo $i; ?>
                                            </td>
                                            <?php
                                            if ($notes->notesimportats === '1') {
                                            ?>
                                                <td style="color:#2a21db;font-weight: 600;font-size:10px !important">
                                                    <?php echo $notes->notesdescription ?>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <?php echo $notes->notesdescription ?>
                                                </td>
                                            <?php
                                            }
                                            ?>

                                            <td></td>
                                            <td></td>
                                            <?php 
                                            if($_SESSION['nafco_alu_user_name'] !== 'naser'){
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <?php }?>
                                        </tr>
                                <?php
                                        $i += 1;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <br />
                        <div class="footer">
                            <div class="_left">
                                <?php echo $infos->project_name ?> REV- : <?php echo $infos->project_boq_revision ?>
                            </div>
                            <div class="_right">

                            </div>
                            <br />
                            <div class="_left">
                                <br />
                                <br />
                                <?php echo date('d-M-Y') ?>
                            </div>
                            <div class="_right">
                                <br />
                                <?php echo $infos->project_no ?> - <?php echo $infos->project_name ?> - <?php echo $infos->project_cname ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
       

        
</html>
<?php
    } else {
        echo '<h1 style="color:red">You Can not view this Page...</h1>';
    }
}
?>