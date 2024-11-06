<?php
session_start();
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../gos/component/st.php';
include_once './st.php';
?>



<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                BILL OF MATERIALS REPORT
            </div>
            <div class="sub-container-right">
                <button type='button' class="ism-btns btn-normal" ng-click="print_bomrpt()">
                    <i class="fa fa-print"></i>
                    Print Report
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>