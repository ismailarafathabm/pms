<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
$update_access = ['superadmin', 'engineering'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'engineering', 'Management', 'engineeringuser'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once '../../menu.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
$username = $_SESSION['nafco_alu_user_name'];
?>
<style>
.totalinfo {
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 10px;

    margin-left: 25px;
    margin-right: 30px;
}

.budget_total {
    padding: 5px;
    background: #f6f8ff;
    margin-bottom: 5px;
    border: 1px solid #d7daff;
}
</style>
<style>
    .gen_autocompleate {
        position: absolute;
        margin-left: -12px;
        margin-top: 0px;
        z-index: 5;
    }

    .autocompleate-dia {
        position: fixed;
        width: 405px;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #dbdbdb;
        height: 400px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .autocompleate-container {
        display: block;
        background: #fff;
        margin-bottom: 5px;
        width: 100%;
    }

    .autocompleate-loads {
        position: relative;
        height: 100%;
        overflow: auto;
    }

    .autocompleate-table {
        position: relative;
        border-collapse: collapse;
        width: 100%;
    }

    .autocompleate-table th {
        border: 1px solid #d3d3d3;
        font-size: 13px;

    }

    .autocompleate-table td {
        font-size: 12px;
    }

    .xtable {
        position: relative;
        border-collapse: collapse;
    }

    .xtable th {
        border: 1px solid #d3d3d3;
        font-size: 1rem;
        padding: 5px;
        background: #d2e3e5;

    }

    .xtable td {
        font-size: 1rem;
        border: 1px solid #d3d3d3;
        padding: 5px;
    }

    @media (max-width: 1200px) {
        .autocompleate-dia {
            max-height: 220px;
            overflow: none;
        }
    }
</style>
<div class="sub-body">
    <div class="sub-body-container"
        style="margin-top: 100px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;height:calc(100vh - 140px)">
        <div class="ism-loaderdiv-new" ng-if="isrptloading">
            <div class="ism-loader-container" ng-if="isrptloading">
                <i class="fa fa-cog fa-spin" style="font-size:80px;color:darkblue"></i>
            </div>
        </div>
        <div class="ism-new-page-headers">
            <div class="ism-new-page-header-page-title">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
               MO Release </i>
            </div>
            <div class="ism-new-page-header-page-buttons">
                <button type="button" ng-click="excelexport()" class="ism-new-page-header-button normalbtn" ng-if="access.printbutton">
                    Export To Excel
                </button>
                <button type="button" ng-click="printrpt()" class="ism-new-page-header-button normalbtn" ng-if="access.printbutton">
                    <i class="fa fa-print"></i>
                    Print
                </button>               
                <button ng-if="access.newbutton" type="button" class="ism-new-page-header-button successbtn" ng-click="addnewRelease()" style="margin-left:20px">
                    <i class="fa fa-plus" style="margin-right:1px"></i>
                    Add
                </button>               
            </div>
        </div>
        <div style="height: calc(100vh - 175px);overflow: auto;border: 1px solid #d9d9d9;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>        
    </div>
</div>
<?php
include_once 'dia/newmo.dia.php';
?>