<?php
include_once 'st.html';
session_start();
include_once '../../../../conf.php';
include_once '../../menu1.php';
?>
<style>
    .ag-header-group-cell-label{
        justify-content: center !important;
    }
</style>

<div class="sub-body">
    <div class="sub-body-container" style="
        margin-top:75px;
        height: calc(100vh - 165px);">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Budget Summary
            </div>
            <div class="sub-container-right">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>

                <input type="checkbox" ng-model="avoidpo" style="margin-left: 10px;"/> <span style="
                font-size: 12px;
                font-weight:200
                ">Avoid PO '0'</span> 
                <button ng-click="printResult()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>


                <button ng-click="exportExcel()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>