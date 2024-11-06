<?php
session_start();
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
?>
<style>
    .old_table th {
        padding: 3px;
    }
    .cutting_cell-red{
        background:#fdf5f5;
    }
    .cutting_cell-green{
        background:#f6fdf5;
        color :#018100;
        font-weight: bold;
    }
</style>
<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 155px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                MATERIAL REQUEST REPORT
            </div>
            <div class="sub-container-right">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
                <button ng-show="!isrptloading" ng-click="showDatefilter(true)" class="ism-btns btn-normal">              
                    Filter By Date
                </button>
                <button ng-click="exportExcel()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <button  ng-click="printrpt()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>

<?php 
    include_once 'boqinfo.dia.php';
    include_once 'datefilter.dia.php';
?>