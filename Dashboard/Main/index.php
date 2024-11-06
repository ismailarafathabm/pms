<?php
session_start();
include_once('../../conf.php');
if(!isset($_SESSION['nafco_alu_user_name'])){
    ?>
    <script>
        location.href = "<?php echo $url_base?>/logout.php";
    </script>
    <?php
}

include_once('../auth.php');
?>
<html>

<head>
    <title>NAFCO - Project Management System</title>
    
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> -->
    <link rel="icon" type="image/x-icon" href="<?php echo $url_base ?>favicon.ico">
    <link rel="stylesheet" href="<?php echo $url_base ?>script/node_modules/ng-hijri-gregorian-datepicker/dist/ng-hijri-gregorian-datepicker.css?v=<?php echo $v ?>">
    <link rel="stylesheet" href="<?php echo $url_base ?>/themes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css.css?v=<?php echo $v ?>">   
    <link rel="stylesheet" href="cssn.css">


    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'none' ; 

    font-src 'self' 'unsafe-inline'
                    http://172.0.0.1:8082
                    https://fonts.googleapis.com 
                    https://fonts.gstatic.com ;

    img-src 'self' 'unsafe-inline' 
                    http://172.0.0.1:8082
                    https://ir-na.amazon-adsystem.com 
                    https://images-na.ssl-images-amazon.com ;

    style-src 'self' 'unsafe-inline' 
                    https://fonts.googleapis.com ;

    script-src 'self' 'unsafe-inline'      
                    https://www.projectseven.net 
                    https://projectseven.net ; 

    connect-src 'self' 'unsafe-inline';
    child-src 'self' 'unsafe-inline'; 
    object-src 'self' 'unsafe-inline';">         -->
    <style>
        @font-face {
            font-family: lato;
            src: url('../../themes/fonts/Lato-Regular.ttf');
        }

        @font-face {
            font-family: 'owh';
            src: url('../../themes/fonts/so/trebuc.ttf');
        }

        .filterdialog {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000000;
            background: #00000099;
            backdrop-filter: blur(3px) saturate(180%);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .filterdialog-conatiner {
            font-family: 'roboto', sans-serif;
            font-size: 14px;
            background: #e3e3e3;
            border-radius: 5px;
            color: #383838;
            overflow: hidden;
            width: 1045px;
            box-shadow: 20px 17px 20px #0000002b;
        }

        .fitlerdialogheader {
            display: flex;
            justify-content: space-between;
            background: #c8c8c8;
            padding: 5px 10px;
            align-items: center;
        }

        .filterheadertitle {
            display: flex;
            align-items: center;
            padding: 5px;
        }

        .filterheadericons {
            margin-right: 5px;
        }

        .filterheadertext {
            font-size: 16px;
        }

        .filterheaderclosebtn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1eded;
            color: #f00;
            padding: 5px;
            transition: background-color 0.4s ease;
            border-radius: 5px;
        }

        .filterheaderclosebtn:hover {
            background-color: #f00;
            color: #fff;
        }

        .filterheaderclosebtn .fa {
            margin-right: 0px;
        }

        .filterdialogbody {
            display: flex;
            position: relative;
            /* justify-content: center; */
            align-items: center;
            border-bottom: 1px solid #504e4e;
            padding: 10px;

        }

        .filterdialogbodycontainer {
            display: flex;
            flex-direction: row;
            margin-top: 5px;
            flex-wrap: wrap;
        }

        .row {
            width: 320px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            margin: 5px 10px;
        }

        .new-lable {
            margin-bottom: 3px;
        }

        .inputitmes {
            width: 300px;
            display: flex;

        }

        .new-inputs-black {
            width: 100%;
            border: none;
            padding: 8px 5px;
            background-color: #c4cbce;
            color: #000;
            outline: 2px solid transparent;
            border-radius: 3px;
            line-height: 15px;
            font-size: 14px;
            transition: background-color 0.5s ease-out, color 0.5s ease-in, outline 0.4s ease;
        }

        .new-inputs-black:hover,
        .new-inputs-black:focus {
            outline: 2px solid #404148;
            background-color: #abc3ce;
        }

        .filterdialogfooter {
            display: flex;
            padding: 5px;
            margin: 5px 4px;
            justify-content: space-between;
            align-items: center;
        }

        .rightbutton {
            display: flex;
        }

        .leftbuttons {
            display: flex;
        }

        .closenewbutton {
            background-color: #00000003;
            color: #ff8484;
            border: 1px solid transparent;
            font-size: 14px;
            padding: 5px 15px;
            border-radius: 4px;
            letter-spacing: 1px;
            margin-left: 16px;
            transition: color 0.5s ease, background-color 0.6s ease;

        }

        .closenewbutton:hover {
            color: #ffffff;
            background: #504f4f;
        }


        .savenewbutton {
            background-color: #356659;
            color: #ffffff;
            border: 1px solid transparent;
            font-size: 14px;
            padding: 5px 15px;
            border-radius: 4px;
            /* letter-spacing: 1px; */
            margin-right: 15px;
            transition: color 0.5s ease, background-color 0.6s ease;
        }

        .savenewbutton:hover {
            color: #ffffff;
            background: #35665940;
        }

        .savenewbutton:disabled {
            background-color: #414141;
            border: 1px solid transparent;
            cursor: no-drop;
        }

        .savenewbutton:hover:disabled {
            background-color: #414141;
            border: 1px solid transparent;
            cursor: no-drop;
        }

        .numcells {
            text-align: right;
        }
    </style>
</head>

<body ng-app='nafco' style="
    overflow: hidden;">
    <header class="ism-headers">
        <div class="header-main">
            <div class="headers-left">
                <div class="headers-logo">
                    <img src="<?php echo $url_base ?>/assets/main_logo.png" height="30px">
                </div>
                <div class="headers-title" style="font-family:'m1'">
                    PROJECT MANAGEMENT SYSTEM
                </div>
                <div class="chagne-project" style="margin-left:20px;display:none">
                    Change Projects
                    <select ng-model="currentproject" ng-change="changecurrentproject()" style="width:200px;">
                        <option value="">-Select-</option>
                        <option ng-repeat="x in projects | orderBy:'project_name'" value="{{x.project_no}}">{{x.project_name}}</option>
                    </select>
                </div>
            </div>
            <div class="header-right">
                <div class="header-buttons">
                    <a class="headbtn">
                        <i class="fa fa-user"></i> <?php echo strtoupper($_SESSION['nafco_alu_user_name']) ?>
                    </a>
                    <?php
                    if ($_SESSION['nafco_alu_user_name'] === 'demo') {
                    ?>
                        <a class="headbtn changepass" type="button" href="<?php echo $url_base ?>userslist.php">
                            <i class="fa fa-users"></i> Users
                        </a>
                    <?php
                    }
                    ?>
                    
                    <a class="headbtn changepass" type="button" href="<?php echo $url_base ?>changepass.php" style="display:none">
                        <i class="fa fa-key"></i> Change Password
                    </a>
                    <a class="headbtn logout" type="button" href="<?php echo $url_base ?>logout.php">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </header>
    <article class="ism-bodys" ng-view>

    </article>
    <footer class="ism-footers">
        <div class="footerinfos">
            Developed By NAFCO IT Department @ v<?php echo $v ?>
        </div>
    </footer>
    <script src="<?php echo $url_loginscreen ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $url_base ?>/Dashboard/Main/excelnn.js"></script>
    <script src="<?php echo $url_base ?>/themes/scripts/html2pdf.bundle.min.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-route.js"></script>
    <script src="<?php echo $url_theme ?>/angular/angular-ui-router.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-cookie/4.1.0/angular-cookie.js" integrity="sha256-+acwL+Yen2ErC/wtAaCfON4Hp9YrBYtiBrPMPJpn3UY=" crossorigin="anonymous"></script>-->
    <script src="<?php echo $url_theme ?>/angular/angularfilter.js"></script>
    <script src="<?php echo $url_base ?>script/node_modules/moment/moment.js"></script>
    <script src="<?php echo $url_base ?>script/node_modules/moment/locale/ar-sa.js"></script>
    <script src="<?php echo $url_base ?>script/node_modules/moment-hijri/moment-hijri.js"></script>
    <!-- <script src="http://172.0.0.1:8082/EMS/ag-grid.js"></script> -->
    <script src="ag-grid.js"></script>

    <script>
        var userinfo = {
            user_name: "<?php echo $_SESSION['nafco_alu_user_name'] ?>",
            user_token: "<?php echo $_SESSION['nafco_alu_user_token'] ?>",
            user_dep: "<?php echo $_SESSION['nafco_alu_user_department'] ?>"
        };
        var _username = "<?php echo $_SESSION['nafco_alu_user_name'] ?>";
        var v = "<?php echo $v ?>";
        var api_url = "<?php echo $url_base?>/api/";
        var api_pms = "<?php echo $emsurl?>/"
        var api_gway = "<?php echo $emsurl?>/api/gway/";
        var print_location = "<?php echo $url_base ?>";
    </script>
    <!-- <link rel="stylesheet" href="<?php echo $url_theme ?>/angular/angularjs-datetime-picker/angularjs-datetime-picker.css"/>    
    <script src="<?php echo $url_theme ?>/angular/angularjs-datetime-picker/angularjs-datetime-picker.min.css"></script> -->
    <script src="<?php echo $url_dep_operation ?>js/demo.ts"></script>
    <script>
        // var x = prompt("enter Your Name","wleoc");
        // if(x == null){
        //     console.log("error")
        // }else{
        //     console.log(x);
        // }
        console.log("WOrking partno1")
        var app = angular.module('nafco', ['ngRoute', 'angular.filter', 'ngHijriGregorianDatepicker']);
        console.log(app);
        app.filter('StatusFilter', () => {
            return function(code) {
                switch (code) {
                    case 'A':
                        return 'A - Approved as Submitted';
                    case 'B':
                        return 'B - Approved as Noted';
                    case 'BC':
                        return 'BC - Approved with Conditions';
                    case 'C':
                        return 'C - Revise and resubmit';
                    case 'D':
                        return 'D - Rejected';
                    case 'U':
                        return 'U - Under review';
                    case 'E':
                        return 'E - For Information';
                    case 'F':
                        return 'F - Cancelled';
                    default : return "NO CODE....";
                }
            }
        })

        function search_projectshow() {
            document.getElementById("projectfilter").style.display = 'flex';
        }
        app.factory('get_projectinfo', ['$http', function($http) {
            return {
                get: function(post_data) {
                    return "ok"
                }
            }
        }]);

        
    </script>
    <script>
        function newProjectpage() {
            location.href = "<?php echo $url_dep_operation ?>admin/dashboard/index.php#!/newtlist";
        }

        function projectlist() {
            location.href = "<?php echo $url_dep_operation ?>admin/dashboard/index.php#!/";
        }

        function _logout() {
            location.href = "<?php echo $url_base ?>logout.php";
        }


        function _reload() {
            location.reload(true);
        }

        function _gettoday() {
            let da = new Date();
            let _day = da.getDate();
            let _month = da.getMonth();
            let _year = da.getFullYear();

            return `${_day}-${_month+1}-${_year}`;
        }
    </script>
    <script src="_access.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_base ?>script/node_modules/ng-hijri-gregorian-datepicker/dist/ng-hijri-gregorian-datepicker.js"></script>
    <script src="<?php echo $url_dep_operation ?>js/router.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/dashboard.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/dashboardnew.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/dashboardnewhv.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/newproject.js?v=<?php echo $v ?>"></script>
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/viewproject.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/spec.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/term.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/conditions.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/newspec.js?v=<?php echo $v ?>"></script>
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/boq.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/boqadd.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/boqEdit.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/approvals.js?v=<?php echo $v ?>" type="module"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/approvalsadd.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/approvalview.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/approvalsedit.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/drawingApprovals/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/drawingApprovals/addnew.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/cuttinglist.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/glassorders.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/Variations.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/cuttinglist/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/glassorder/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/measurement/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/Variations.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/rpt_techapprovals.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ctrl_rptdrawings.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ctrl_rptcuttinglist.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ctrl_drawingapprovals1x.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ctrl_shopdrawingApprovalsrpt.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ctrl_techApprovalsrpt.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/cuttinglist/ctrl_cutting.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/cuttinglist/ctrl_engglassorders.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/cuttinglist/ctrl_estvariation.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_dailyrpt.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_summary.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_summarysp.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_summaryabs.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_summaryrent.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_fulldt.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/dashboard/ctrl_projectdashboard.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/manpower/ctrl_pwomanpower.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/variations/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/sales/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/bom/index.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/bom/add.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/pp/factorytopp.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/pp/whtopp.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/pp/rcwh.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/pp/rcfac.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ppworknew/ppworknew.js?v=<?php echo $v ?>"></script>
    <script src="<?php echo $url_dep_operation ?>js/controllers/ppworknew/ppworknewrc.js?v=<?php echo $v ?>"></script>
    <!-- ems  -->
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/ems/index.js?v=<?php echo $v ?>"></script>
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/ems/vacation.js?v=<?php echo $v ?>"></script>
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/ems/exit.js?v=<?php echo $v ?>"></script>

    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/maintancework/index.js?v=<?php echo $v ?>"></script>
    <!--metrho work -->
    <script type="module" src="<?php echo $url_dep_operation ?>js/controllers/metrowork/index.js?v=<?php echo $v ?>"></script>




    <!-- masterlog -->
    <script type="module" src="./masterlog/js/index.js"></script>
    <script type="module" src="./glassorders/js/index.js"></script>


    <!-- submital forms -->
    <script type="module" src="./approvals/js/index.js"></script>

    <!-- project comprehensive  Report -->
    <script type="module" src="./technical/js/index.js"></script>

    <!-- project Material Request -->
    <script type="module" src="./mr/js/index.js"></script>

    <!-- project bom -->
    <script type="module" src="./bom/js/index.js"></script>

    <!-- Autorization for boq -->
    <script type="module" src="./boqnew/index.js"></script>
    <!-- cuttinglist -->
    <script type="module" src="./cuttinglist/js/index.js"></script>
    <!-- glass order engg -->
    <script type="module" src="./gos/js/index.js"></script>
    
      <!-- BOM Bill of Materials -->
    <script type="module" src="./bomn/js/index.js"></script>
    
        <!-- boq release in Engineering -->
    <script type="module" src="./enggboq/js/index.js"></script>
       <!-- boq for operations -->
    <script type="module" src="./boq/js/index.js"></script>
     <!-- cuttinglist production -->
    <script type="module" src="./ct-production/js/index.js"></script>
    
       <!-- For New Project list -->
    <script type="module" src="./project/js/index.js"></script>

    <!-- for installation -->
    <script type="module" src="./installation/js/index.js"></script>
         <!-- for ems manpower -->
      <script type="module" src="./ems-manpower/index.js"></script>
    <script>
        getVersion()

        function getVersion() {
            let _appversion = localStorage.getItem('naf_pms_version');
            if (_appversion === null || _appversion === "") {
                localStorage.setItem("naf_pms_version", v);
            }
            _appversion = localStorage.getItem('naf_pms_version');
            if (_appversion !== v) {
                console.log("Need Hot Reload");
                localStorage.setItem("naf_pms_version", v);
                location.reload(true);
            }
        }

        function _viewproject() {
            location.href = "<?php echo $url_dep_operation ?>index.php#!/viewproject";
        }
    </script>
    


</body>

</html>