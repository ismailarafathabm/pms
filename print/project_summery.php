<?php
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

$_conditions = json_decode($proj->get_conditions($project_name));
//echo $proj->get_conditions($project_name);
$_terms = json_decode($proj->get_terms($project_name));
//echo json_encode($_terms);

?>
<html>

<head>
    <title><?php echo $site_name ?></title>
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

        @page: right {
            @bottom-right {
                content: counter(page);
            }
        }

        @page: left {
            @bottom-left {
                content: "Page "counter(page) " of "counter(pages);
            }
        }

        @page: right {
            @bottom-left {
                margin: 10pt 0 30pt 0;
                border-top: .25pt solid #666;
                content: "Nafco..";
                font-size: 9pt;
                color: #333;
            }
        }


        .tsummary {
            font-family: 'Roboto Slab', serif;
            font-size: 12px;
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

        ._bottomsing {
            bottom: 5px;
        }

        ._left {
            position: absolute;
            left: 20px;
        }

        ._right {
            position: absolute;
            right: 20px;
        }
        @media print{
            button{
                display : none;
            }
        }
    </style>
</head>

<body>
<button id="exportexcel"  onclick="tableToExcel('sumamry', 'Prject Summary')">Excel Export</button>
    <div style="position:absolute;width:100%;margin-top:0px">
        <div style="font-family: 'Ubuntu',sans-serif;color:#2a21db;top:0px">
            <table style="width:70%">
                <tr>
                    <td style="width:10%">
                        <img src="<?php echo $url_asset ?>/nafco_imgs/LOGO_PRINT.png" width="100px" height="100px" />
                    </td>
                    <td style="width:80%">
                        <p style="text-align:center;font-family: 'Anton', sans-serif;letter-spacing:13px;font-size:22px;font-weight:bold;color:#014011">PROJECT SUMMARY</p>
                        <p style="text-align:center;letter-spacing:1px;font-size:18px;font-weight:bold;color:#154bed;text-decoration: underline;">CONTRACT TERMS & CONDITIONS</p>
                    </td>
                </tr>
            </table>


            <div style="padding:1%">
                <table class="tsummary" id="sumamry">
                    <tr>
                        <td class="title_td">
                            Contract No :
                        </td>
                        <td class="body_td spcl">
                            <?php echo strtoupper($infos->project_no) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Contract Name :
                        </td>
                        <td class="body_td _title">
                            <?php echo strtoupper($infos->project_cname) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Project Name :
                        </td>
                        <td class="body_td _title">
                            <?php echo strtoupper($infos->project_name) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Contract Sign Date :
                        </td>
                        <td class="body_td" style="font-weight:bold">
                            <?php echo strtoupper($infos->project_singdate) ?> | (<?php echo strtoupper($infos->project_sing_description) ?>)
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Payment Terms :
                        </td>
                        <td class="body_td">
                            Payment Terms As Follows :
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">

                        </td>
                        <td class="body_td">
                            <ul style="list-style-type: none;">
                                <?php
                                foreach ($_conditions->data as $_con) {
                                ?>
                                    <li>
                                        <?php echo $_con->project_conditions_number ?> -
                                        <?php echo $_con->project_conditions_remark ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Location :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_location) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Sales Representative :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->Sales_Representative) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Advance Payment :
                        </td>
                        <td class="body_td" style="font-size:13px;font-weight:bold">
                            (SAR) <?php echo strtoupper($infos->project_first_advance_amount) ?> | ( Date : <?php echo strtoupper($infos->project_advacne_date) ?>)
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Cont.Duration & Condition :
                        </td>
                        <td class="body_td">
                            A Duration Of <?php echo strtoupper($infos->project_contract_duration) ?> month as follows
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">

                        </td>
                        <td class="body_td">
                            <ul style="list-style-type: none;">
                                <?php
                                foreach ($_terms->data as $_con) {
                                ?>
                                    <li>
                                        <?php echo $_con->payment_terms_number ?> -
                                        <?php echo $_con->payment_terms_descripton ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Penalty :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_penalty) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Contact Person :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_contact_person) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Contact Number :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_contact_no) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Expiry Date :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_expiry_date) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="title_td">
                            Remarks :
                        </td>
                        <td class="body_td">
                            <?php echo strtoupper($infos->project_contract_description) ?>
                        </td>
                    </tr>
                </table>
                <br />
                <br />
                <div class="_bottomsing">
                    <div class="_left">
                        Prepared By : Khaja Mukhtar M
                    </div>
                    <div class="_right">
                        <?php echo date('d-M-Y') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
<script>
    window.print();
</script>

</html>