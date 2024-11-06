<?php
include_once 'st.html';
session_start();
include_once '../../../../conf.php';
include_once '../../menu1.php';
?>

<div class="sub-body">
    <div class="sub-body-container" style="
        margin-top:75px;
        height: calc(100vh - 165px);"
        >
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div classs="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Supplier wise PO's Summary
            </div>
            <div class="sub-container-right" style="    
                                        width: 698px;
                                        display: flex;
                                        flex-direction: row;
                                        align-items: center;
                                        gap: 10px;
                                        position: relative;
                                        justify-content: flex-end;
                ">
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>                
                <button ng-click="printaction('a')" class="ism-btns btn-normal">
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