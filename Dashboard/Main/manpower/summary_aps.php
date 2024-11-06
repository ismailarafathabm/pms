<style>
    .ag-header-container {

        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-header-cell-text {
        color: #000 !important;

    }

    .ag-cell {
        font-family: 'roboto';
        font-size: 14px;
        white-space: nowrap;
        border: 1px solid #00000012 !important;
    }

    .td-ok {
        color: #015147;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-green {
        background-color: #e7fffc;
        color: #000;
    }

    .td-yellow {
        background: #fff6dc;
        color: #000;
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
        background: #414141;
        border-radius: 5px;
        color: #fff;
        overflow: hidden;
        width: 350;
        box-shadow: 20px 17px 20px #0000002b;
    }

    .fitlerdialogheader {
        display: flex;
        justify-content: space-between;
        background: #2b2b2b;
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
        background-color: #292424;
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
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #504e4e;

    }

    .filterdialogbodycontainer {
        display: flex;
        flex-direction: column;
        margin-top: 5px;
    }

    .row {
        margin-bottom: 10px;
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .new-lable {
        margin-bottom: 3px;
    }

    .inputitmes {
        width: 300px;
    }

    .new-inputs-black {
        width: 100%;
        border: none;
        padding: 8px 5px;
        background-color: #2f2d2d;
        color: #fff;
        outline: 2px solid transparent;
        border-radius: 3px;
        line-height: 15px;
        font-size: 14px;
        transition: background-color 0.5s ease-out, color 0.5s ease-in, outline 0.4s ease;
    }

    .new-inputs-black:hover,
    .new-inputs-black:focus {
        outline: 2px solid #404148;
        background-color: #0e0e0e;
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
    .savenewbutton:hover:disabled{
        background-color: #414141;
        border: 1px solid transparent;
        cursor: no-drop;
    }
</style>
<?php
session_start();
include_once('../../../conf.php');
include_once('../menu1.php');
?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Project With Date Wise Absent Summary {{_filtertitle}}
            </div>
            <div class="sub-container-right">
                <button onclick="document.getElementById('dia_filter_dates').style.display='flex'" class="ism-btns btn-normal">
                    <i class="fa fa-filter"></i>
                    Get Report
                </button>
                <button ng-click="excelexport()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filter
                </button>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>
<div class="filterdialog" id="dia_filter_dates">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-filter"></i>
                </div>
                <div class="filterheadertext">
                    Get Daily Manpower Report
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_filter_dates').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="getreport_dialog" name="dialog_getreport" ng-submit="getreport_dialog_submit()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">From Date</div>
                        <div class="inputitmes">
                            <input type="text" name="startdate" ng-model="x.startdate" class="new-inputs-black" required placeholder="d-M-Y" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="filtermanpower_stdate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">To Date</div>
                        <div class="inputitmes">
                            <input type="text" name="enddate" ng-model="x.enddate" class="new-inputs-black" required placeholder="d-M-Y" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="filtermanpower_estdate">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_filter_dates').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="dialog_getreport.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

