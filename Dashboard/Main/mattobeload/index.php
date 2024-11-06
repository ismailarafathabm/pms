<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
$update_access = ['superadmin', 'operation'];
$username = $_SESSION['nafco_alu_user_name'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'operation', 'Management', 'contract and operations'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once '../menu1.php';
include_once '../masterlog/st.php';
include_once 'st.php';
?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top: 75px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;">
        <div class="ism-new-page-headers">
            <div class="ism-new-page-header-page-title">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Production Delivery Schedule </i>
            </div>
            <div class="ism-new-page-header-page-buttons">
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="printrpt()" style="margin-right:50px">
                    <i class="fa fa-print" style="margin-right:1px"></i>
                    Print
                </button>
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="loadrpt()">
                    <i class="fa fa-download" style="margin-right:1px"></i>
                    Load Report
                </button>
                <?php
                if ($username === "demo" || $username === "ikramullah") {
                ?>
                    <button type="button" class="ism-new-page-header-button normalbtn" ng-click="add_new_mtbl()">
                        <i class="fa fa-plus" style="margin-right:1px"></i>
                        Add
                    </button>
                <?php
                }
                ?>

            </div>
        </div>

        <div>

            <div style="height: calc(100vh - 145px);overflow: auto;border: 1px solid #d9d9d9;">
                <i ng-show="unitdata.isloading" class="fa fa-cog fa-spin pageloader"></i>
                <div ng-show="!unitdata.isloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'containers/load.php';
include_once 'containers/indexn.php';
include_once 'containers/plist.php';
include_once 'containers/log.php';
include_once 'containers/index.php';
?>