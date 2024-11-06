<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../menu1.php';
include_once '../../masterlog/st.php';
?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top: 75px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;">
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
                Glass Description </i>
            </div>
            <div class="ism-new-page-header-page-buttons">
                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewunit_click()">
                    <i class="fa fa-plus" style="margin-right:1px"></i>
                    Add
                </button>
            </div>
        </div>
        <div style="height: calc(100vh - 145px);overflow: auto;border: 1px solid #d9d9d9;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>
<?php 
    include_once './models/index.php';
    include_once './models/gtype.php';
?>