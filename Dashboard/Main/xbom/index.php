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

    .ag-pinned-left-header {
        background: #c4d0d2;
        font-family: 'roboto';
        font-size: 14px;
        font-weight: 600;
        color: #000 !important;
    }

    .ag-theme-balham {
        --ag-odd-row-background-color: #f6feff;
    }

    .ag-theme-balham .ag-row-odd {
        background-color: var(--ag-odd-row-background-color);
    }
</style>
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
        background: #d9d9d9;
        border-radius: 5px;
        color: #000;
        overflow: hidden;
        width: 350px;
        box-shadow: 20px 16px 20px #0000002b, -8px -4px 20px #ffffff2b;
    }


    .fitlerdialogheader {
        display: flex;
        justify-content: space-between;
        background: #bfbfbf;
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
        background-color: #cdb3b3;
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
        background-color: #efefef;
        color: #000;
        outline: 2px solid #b6bdff00;
        border-radius: 3px;
        line-height: 15px;
        font-size: 14px;
        transition: background-color 0.5s ease-out, color 0.5s ease-in, outline 0.4s ease;
    }

    .new-inputs-black:hover,
    .new-inputs-black:focus {
        outline: 2px solid #6c7fff;
        background-color: #ffffff;
    }

    .new-inputs-black:focus {
        box-shadow: 6px 6px 16px #00000070, 5px 8px 5px #ffffffd9;
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

    .savenewbutton:hover:disabled {
        background-color: #414141;
        border: 1px solid transparent;
        cursor: no-drop;
    }

    .old_pgm {
        width: 1300px;
        padding: 5px;
        display: block;
        overflow: auto;
        background-color: #f7f7f7;
    }

    .old_pgm_row {
        display: flex;
        padding: 3px;
        position: relative;
        margin: 4px 0px;
    }

    .old_pgm_column {
        width: 200px;
        padding: 2px;
        display: flex;
        flex-direction: column;
        margin: 10px;
    }

    .old_page_lable {
        padding: 3px 0px;
        font-weight: 100;
        font-size: 12px;
    }

    .old_page_inputs {
        width: 100%;
        /* padding: 3px 1px; */
        font-size: 12px;
        border: 1px solid #a7a7a7;
        font-size: 12px;
    }

    .old_page_inputs:focus {
        border: 1px solid #3d68db;
        outline: none;
    }


    .old_page_inputs:read-only {
        background-color: #fdf5f5;
        color: #ab0000;
    }

    .old_table {
        border-collapse: collapse;
        font-size: 13px;
    }

    .old_table th,
    td {
        border: 1px solid #a7a7a7;
        padding: 1px;

    }

    .old_table th {
        background-color: #f9f9f9;
        font-weight: 100;
        font-size: 12px;
    }

    .n_req {
        background-color: #fffdfd !important;
        color: #ab0000;
    }

    .n_avi {
        background-color: #ecfffc !important;
        color: #00440f;
    }

    .n_need {
        background-color: #edf6ff !important;
        color: #00262c;
    }

    .old_pgm_fitbox {
        display: block;
        max-height: 450px;
        overflow: auto;
    }

    .itemlist thead {
        position: sticky;
        top: 0px;
    }
    .systemhead{
        width : 1380px;
        background-color: #f1f1f1;
        padding: 4px;
        margin-top : 5px;
        margin-bottom : 5px;
        border: 1px dashed #015147;
        color : #015147;
        font-weight: bold;
        font-size: 14px;
    }
    .red-background{
        color : red;
        font-weight: bold;
    }
</style>
<?php
session_start();
include_once('../../../conf.php');
include_once('../menu.php');
?>


<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                BOM <span style="font-size:12px;margin-left:10px">(Bill of Materials)</span>
            </div>
            <div class="sub-container-right">
                <button onclick="document.getElementById('dia_filter_dates').style.display='flex'" class="ism-btns btn-normal">
                    <i class="fa fa-plus"></i>
                    NEW
                </button>
                <button ng-click="print_rpt()" class="ism-btns btn-normal" style="margin-right: 45px">
                    <i class="fa fa-print"></i>
                    Print
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
        <div class="sub-body-container-contents">
            <div class="naf-tables">
                <div class="oldmodeldiv">
                    <div class="systemdiv" ng-repeat="x in bomitems">
                        <div class="systemhead">
                            {{x.s}}
                        </div>
                        <div class="systemlist">
                            <table class="old_table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="6">Item</th>
                                        <th colspan="3" class="n_req">Required</th>
                                        <th colspan="3" class="n_avi">Available</th>
                                        <th colspan="3" class="n_need">QTY to Be Order</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th style="width:20px">S.No</th>
                                        <th style="width:85px">Date</th>
                                        <th style="width:100px">BOM NO.</th>
                                        <th style="width:70px">Item Type</th>
                                        <th style="width:65px">Proflie</th>
                                        <th style="width:65px">Part No.</th>
                                        <th style="width:150px">Description</th>
                                        <th style="width:40px">Unit</th>
                                        <th style="width:60px">Die Weight</th>
                                        <th class="n_req" style="width:70px">Length</th>
                                        <th class="n_req" style="width:70px">Bar Qty</th>
                                        <th class="n_req" style="width:70px">Total weight</th>
                                        <th class="n_avi" style="width:70px">Length</th>
                                        <th class="n_avi" style="width:70px">Bar Qty</th>
                                        <th class="n_avi" style="width:70px">Total weight</th>
                                        <th class="n_need" style="width:70px">Length</th>
                                        <th class="n_need" style="width:70px">Bar Qty</th>
                                        <th class="n_need" style="width:70px">Total weight</th>
                                        <th style="width:90px">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="items in x.a" class="{{items.ishaveR==='T' ? 'red-background' : ''}}">
                                        <td >{{$index+1}}</td>
                                        <td>{{items.bomdate_d}}</td>
                                        <td>
                                            <div style="display:flex">
                                                {{items.bomno}}
                                                <a ng-click="addrevision(items)">
                                                    <i class="fa fa-undo" style="margin-left: 3px;color: #ff7600;"></i>
                                                </a>
                                                <a ng-click="addtiondialog(items)">
                                                    <i class="fa fa-plus" style="margin-left: 3px;color: #ff7600;"></i>
                                                </a>
                                                <a ng-if="items.isaddtionalh==='Y'" ng-click="getAddtioninfos(items)">
                                                    <i class="fa fa-list" style="margin-left: 3px;color: #ff7600;"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td >{{items.mtype}}</td>
                                        <td>{{items.bomprofileno}}</td>
                                        <td>{{items.bompartno}}</td>
                                        <td>{{items.bomdescription}} - {{items.alloy}} - {{items.finish}}</td>
                                        <td>{{items.bomunit}}</td>
                                        <td>{{items.bomdieweight}}</td>
                                        <td class="n_req">{{items.bomreqlength}}</td>
                                        <td class="n_req">{{items.finalqty}}</td>
                                        <td class="n_req">{{items.finalwight}}</td>
                                        <td class="n_avi">{{items.bomavailength}}</td>
                                        <td class="n_avi">{{items.bomavaibarqty}}</td>
                                        <td class="n_avi">{{items.bomavaiweight}}</td>
                                        <td class="n_need">{{items.bomorderlength}}</td>
                                        <td class="n_need">{{items.bomorderbarqty}}</td>
                                        <td class="n_need">{{items.bomordertotweight}}</td>
                                        <td>{{items.bomremark}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './addtions.php';
include_once './addtionlist.php';
include_once './revision.php';

?>

<?php 
include_once './props.php';
?>