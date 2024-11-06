<?php
session_start();
include_once('../../../../conf.php');
include_once('../../menu1.php');
?>
<style>
    .ism-pms-dialog {
        position: fixed;
        width: 100%;
        height: 100vh;
        background-color: #b6cbff7d;
        top: 0;
        left: 0;
        z-index: 10000000;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
    }

    .ism-pms-dialog-container {
        position: relative;
        background-color: #fff;
        display: block;
        overflow: hidden;
        font-family: 'apple', 'roboto', sans-serif, ui-sans-serif;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #f5f4f4;
        box-shadow: 5px 20px 45px -10px #ccc;
    }

    .ism-pms-dialog-headers {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: row;
        gap: 40px;
        padding: 8px;
        border-bottom: 1px solid #d6d6d6;
    }

    .ism-pms-dialog-header-title {
        flex: 2;
        font-size: 1em;
        font-weight: bold;
        line-height: 1.4em;
        color: #444040;
    }

    .ism-pms-idalog-header-closebtn {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .ism-pms-dialog-body {
        max-height: 85vh;
        padding: 8px;
        font-size: 0.895em;
        color: #747474;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .ism-pms-dialog-footer {
        border-top: 1px solid #d6d6d6;
        position: relative;
        display: flex;
        gap: 3px;
        flex-direction: row-reverse;
        padding: 8px;
    }

    .ism-pms-dialog-body-rows {
        overflow: auto;
        max-height: calc(100vh - 50px);
        display: flex;
        gap: 5px;
        flex-direction: row;
        /* align-items: center; */
        justify-content: center;
        margin: 10px 0px;
        flex-wrap: wrap;
    }

    .ism-pms-dialog-body-row-input-container {
        padding: 6px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 5px;
        position: relative;
    }

    .ism-dialog-body-rows-input-container-lable {
        font-size: 0.845em;
        font-weight: 700;
        line-height: 1rem;
    }

    .ism-dialog-body-rows-input-container-input {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .ism-dialog-rows-input-controller {
        width: 100%;
        font-size: 1em;
        line-height: 1.2em;
        font-family: 'apple', 'roboto', sans-serif;
        padding: 6px 10px;
        border: 1px solid #8f8686;
        border-radius: 3px;
        font-weight: bolder;
        color: #655e5e;
        letter-spacing: 0.3px;
        outline: 1px solid transparent;
        background: #f9f9f9;
    }

    .ism-pms-dialog-btn {
        position: relative;
        display: block;
        font-family: 'menu', 'roboto', sans-serif;
        font-size: 0.85em;
        text-align: center;
        font-weight: 500;
        padding: 8px 16px;
        background: #0000;
        border: 1px solid #0000;
        outline: 1px solid #0000;
        line-height: 1em;
        border-radius: 4px;
        cursor: pointer;
    }

    .ism-btn-dialog-save {
        letter-spacing: 0.8;
        background: #06b;
        color: #fff;
    }

    .ism-btn-dialog-save:hover {
        background: #115d5e;
    }
</style>
 <style>
        .filterhide {
            display: none;
        }

        .ag-header-cell {
            border: 1px solid #bab9b9;
            font-size: 14px;
            font-family: segoeui;

        }

        .ag-header-container {

            /* background: #c4d0d2; */
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

        .numbers-cell {
            font-weight: bold;
            text-align: right;
        }

        .ag-header-cell-text {
            white-space: normal !important;
        }

        .green1 {
            background-color: #bdfbf6;
        }

        .green2 {
            background-color: #ace4df;
        }

        .red1 {
            background-color: #ffdede;
        }

        .red2 {
            background-color: #fbbdbd;
        }

        .yellow1 {
            background-color: #f2f1b1;
        }

        .yellow2 {
            background-color: #dad99e;
        }

        .blue1 {
            background-color: #cad9ff;
        }

        .filterhide {
            display: none;
        }

        .ag-header-cell {
            border: 1px solid #bab9b9;
            font-size: 14px;
            font-family: segoeui;

        }

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

        .numbers-cell {
            font-weight: bold;
            text-align: right;
        }
    </style>
<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 60px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title" style="justify-content: space-between;">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                MANPOWER REPORT
            </div>
            <div class="sub-container-right" style="display: flex;gap: 10px;align-items: center;justify-content: flex-start;">
                <button type="button" onclick="document.getElementById('rpt_src_dialog').style.display='flex'" class="ism-btns btn-normal" style="margin-left:5px;">
                    Get Report
                </button>
                <button ng-show="!isrptloading" ng-click="prints()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print By Project Head
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
include_once 'date.dia.php';
?>