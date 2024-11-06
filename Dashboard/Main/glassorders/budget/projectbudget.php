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
include_once '../procurement/st.php';
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
<div class="sub-body">
    <div class="sub-body-container" style="margin-top: 100px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;height:calc(100vh - 140px)">
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
                Project Budget </i>
            </div>
            <div class="ism-new-page-header-page-buttons">
                <button type="button" ng-click="excelexport()" class="ism-new-page-header-button normalbtn" ng-if="access.priceaccess">
                    Export To Excel
                </button>
                <button type="button" ng-click="printrpt()" class="ism-new-page-header-button normalbtn" ng-if="access.priceaccess">
                    <i class="fa fa-print"></i>
                    Print
                </button>

                <button type="button" ng-click="printrpt_n()" class="ism-new-page-header-button normalbtn" ng-if="!access.priceaccess">
                    <i class="fa fa-print"></i>
                    Print
                </button>

            </div>
        </div>
        <div style="height: calc(100vh - 270px);overflow: auto;border: 1px solid #d9d9d9;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
        <div class='totalinfo' ng-if="access.priceaccess">
            <div class="budget_total" style="color: #a00;">Cost Total (SAR.): <span style="font-weight: 600;">{{(+sum.cost) === 0 ? '-' : (+sum.cost).toLocaleString(undefined,{maximumFractionDigits:2})}}</span> </div>
        </div>
    </div>
</div>