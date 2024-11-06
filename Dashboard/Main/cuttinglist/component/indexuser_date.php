<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';
include_once 'ctools.php'
?>

<style>
     .ag-cell {
        font-size: 0.85rem;
        font-family: 'apple';
    }

    .ism-btns {
        font-size: 0.85rem;
        font-family: 'apple';
    }


    .grid-delete-button:hover {
        color: #ff0000;
    }
    .ag-cell-wrap-text{
    white-space: normal;
    word-break: break-word;
    margin-top: 2px;
    line-height: 0.7rem;
}
</style>

<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Cutting List
            </div>
            <div class="sub-container-right" style="display: flex;gap:3">

                <!-- <div style="display: flex;flex-direction: column;gap: 3px;">
                    <div>
                        <input type="text" id="account_start" ng-model="filter.account_start" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdatex">
                    </div>
                    <div>
                        <input type="text" id="account_end" ng-model="filter.account_end" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdatey">
                    </div>
                    <div>
                        <button ng-click="filter_withdate" type="button">Filter</button>
                    </div>
                </div> -->
                <!-- <button ng-show="!isrptloading" ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>                    
                    Date
                </button> -->
                
                <button ng-show="!isrptloading" ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>

                <button ng-show="!isrptloading" ng-click="showDatefilter(true)" class="ism-btns btn-normal">              
                    Filter By Date
                </button>
                <button ng-show="!isrptloading" ng-click="printResult()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-show="!isrptloading" ng-click="exportExcel()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;background: #fff;">
            <div ng-show="isrptloading">Fetching data please Wait......</div>
            <div ng-show="!isrptloading" id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>

<?php 
    include_once 'datefilter.dia.php';
?>