<?php
session_start();
include_once('../conf.php');

if (
    !isset($_SESSION["nafco_alu_user_name"],
    $_SESSION["nafco_alu_user_token"],
    $_SESSION["nafco_alu_user_department"],
    $_SESSION["nafco_alu_user_type"])
    ||
    $_SESSION["nafco_alu_user_name"] === '' &&
    $_SESSION["nafco_alu_user_token"] === '' &&
    $_SESSION["nafco_alu_user_department"] === '' &&
    $_SESSION["nafco_alu_user_type"] === ''
) {
?>
    Login And Try Again
<?php
    exit();
}

if (!isset($_GET['project_code']) || $_GET['project_code'] === "") {
    echo "Choose Any Project...";
    exit();
}


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

        .table {
            border-collapse: collapse;
        }

        .table,
        th,
        td {
            border: 1px solid black;
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
    </style>
</head>

<body ng-app="nafco" ng-controller="nafcoctrl">
    <div style="position:absolute;width:100%;margin-top:0px">
        <div style="font-family: 'Ubuntu',sans-serif;color:#2a21db;top:0px">
            <table style="width:70%" style="border:0px">
                <tr style="border:0px">
                    <td style="width:10%;border:0px">
                        <img src="<?php echo $url_asset ?>/nafco_imgs/LOGO_PRINT.png" width="100px" height="100px" />
                    </td>
                    <td style="width:80%;border:0px">
                        <p style="font-family: 'Anton', sans-serif;letter-spacing:5px;font-size:22px;font-weight:bold;color:#014011">PROJECT SPECIFICATIONS</p>

                    </td>
                </tr>
            </table>


            <div style="padding:1%">
                <table class="tsummary table" style="width:100%;height:100%;">
                    <tr>
                        <td class="text-center" style="width: 15%;text-align:center">Aluminium</td>
                        <td style="padding:10px;">
                            <ul>
                                <li ng-repeat="a_s in _aluminiumspc">
                                    {{a_s.spec_remark}}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 15%;text-align:center">Finish</td>
                        <td style="padding:10px">
                            <ul>
                                <li ng-repeat="a_s in _finishspc">
                                    {{a_s.spec_remark}}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 15%;text-align:center">Glass</td>
                        <td style="padding:10px">
                            <div ng-repeat="(key,val) in _glass | groupBy:'spec_type_sub'" style="width:100%;position:relative;padding:10px;border-bottom:0px solid #6e5773">
                                <h3 style="text-align:left;border-bottom:1px solid #001">{{key | uppercase}}</h3>
                                <div ng-repeat="a_s in val" style="border-bottom:1px solid #f1f1f1">
                                    <div style="width:60%;display:inline-block">
                                        {{a_s.spec_remark}}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 15%;text-align:center">Hardware</td>
                        <td style="padding:10px">
                            <ul>
                                <li ng-repeat="a_s in _hardware">
                                    {{a_s.spec_remark}}
                                </li>
                            </ul>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<?php echo $url_theme ?>/angular/angular.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-route.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-ui-router.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-cookie/4.1.0/angular-cookie.js" integrity="sha256-+acwL+Yen2ErC/wtAaCfON4Hp9YrBYtiBrPMPJpn3UY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.4.7/angular-filter.js"></script>
    <script>
        var userinfo = {
            user_name: "<?php echo $_SESSION['nafco_alu_user_name'] ?>",
            user_token: "<?php echo $_SESSION['nafco_alu_user_token'] ?>"
        }
        var api_url = "<?php echo $url_base ?>api/";
        var project = "<?php echo $_GET['project_code'] ?>";
        var app = angular.module('nafco', ['ngRoute', 'angular.filter']);
        app.controller('nafcoctrl', ['$scope', '$http', function($scope, $http) {
            let post_data = {
                naf_user: userinfo,
                project_no: project
            }
            var req = $http.post(api_url + "Project/printspce.php", post_data);
            req.then(
                function(res) {
                    console.log(res.data);
                    //$scope._aluminiumspc = [];
                    $scope._aluminiumspc = res.data.data._aluminium;
                    $scope._finishspc = res.data.data._finish;
                    $scope._hardware = res.data.data._hardware;
                    $scope._glass = res.data.data._glass;

                    //$scope._terms = res.data.data;
                }
            );
        }])
    </script>
</body>
<script>
    //window.print();
</script>


</html>