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

    .savenewbutton:hover:disabled {
        background-color: #414141;
        border: 1px solid transparent;
        cursor: no-drop;
    }



    .armodal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #181818c0;
        backdrop-filter: blur(3px) saturate(190%);
        z-index: 10000004;
        overflow: auto;
    }

    .armodal .armodel-container {
        position: relative;
        font-family: 'roboto', sans-serif;
        font-size: 14px;
        background-color: #fff;
        width: 1020px;
        margin: 10px auto;
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
        overflow: hidden;
    }

    .armodal .armodel-container .armodelhead {
        position: relative;
        background-color: #d7e0e2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        line-height: 1.1rem;
        padding: 12px 8px;
    }

    .armodal .armodel-container .armodelhead .armodel-title {
        position: relative;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .armodal .armodel-container .armodelhead .armodel-title .left-titles {
        margin-left: 10px;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn {
        border: 1px solid transparent;
        padding: 3px;
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
        cursor: pointer;
        font-size: 18px;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn:hover {
        background-color: #ff9c9c;
        box-shadow: 3px 3px 6px #ffa8a8;
        border: 1px solid #ff5b5b;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn:hover i {
        color: #481919;
    }

    .armodal .armodel-container .armodelhead .armodel-closebtn .fa {
        margin: 0px !important
    }

    .armodal .armodel-container .armodelbody {
        position: relative;
        overflow: auto;
        margin: 5px 0px 5px 0px;
        padding: 10px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: start;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .arbodyheader {
        /* background-color: #cde8f4; */
        padding: 3px 3px;
        font-weight: 600;
        color: #076994;
        border-bottom: 1px solid #0591cf;
        /* border-radius: 5px; */
        margin-bottom: 2px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row {
        display: flex;
        flex-wrap: wrap;
        box-sizing: border-box;
        padding: 5px;
        justify-content: center;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm {
        display: flex;
        width: 180px;
        flex-direction: column;
        justify-content: start;
        align-items: flex-start;
    }



    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmlable {
        font-weight: bold;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .frm .frmcontraollers-entry {
        display: flex;
        width: 160px;
        margin: 2px 0;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 {
        width: 450px;
        margin-right: 2px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row {
        display: flex;
        flex-wrap: wrap;
        box-sizing: border-box;
        padding: 5px;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .frm {
        display: flex;
        width: 220px;
        flex-direction: column;
        justify-content: start;
        align-items: flex-start;
    }

    .armodal .armodel-container .armodelbody .armodelbodywarper .row .col2 .row .frm .frmcontraollers-entry {
        display: flex;
        width: 200px;
        margin: 2px 0;
    }

    .arnewinput {
        border: 1px solid #020202;
        /* border-radius: 3px; */
        font-family: 'roboto', sans-serif;
        font-size: 14px;
        line-height: 1.4rem;
        align-items: center;
        width: 100%;
        outline: 1px solid transparent !important;
    }

    .arnewinput:disabled {
        background-color: #ffdcdc !important;
        cursor: no-drop !important;
        border: 1px solid transparent !important;
        outline: none !important;
    }

    .nomal:hover,
    .nomal:focus,
    .nomal:active {
        background: #fff;
        /* box-shadow: 1px 1px 12px #c3e9fb; */
        border: 1px solid #0085c1;
    }

    .danger:hover,
    .danger:focus,
    .danger:active {
        background: #fff;

        border: 1px solid #861d1d;
    }

    .danger:read-only {
        background-color: #fff3f3;
        /* box-shadow: 1px 1px 12px #fbc3c3; */
        border: 1px solid #ad7676;
    }

    .nomal:read-only {
        background: #eaf4f8;
        /* box-shadow: 1px 1px 12px #c3e9fb; */
        border: 1px solid #2a5163;
    }

    .dangerhead {

        color: #940707 !important;
        border-bottom: 1px solid #cf0505 !important;


    }

    .armodal .armodel-container .arfoot {
        position: relative;
        margin: 5px 0px;
        padding: 5px 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .armodal .armodel-container .arfoot .button-list-right .cancelbutn {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #ffcbcb;
        border: 1px solid #f14c4ca3;
        color: #c70000;


    }

    .armodal .armodel-container .arfoot .button-list-left {
        position: relative;
        display: flex;
        align-items: center;
    }

    .armodal .armodel-container .arfoot .button-list-left .printpayslip {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #1b87b1;
        border: 1px solid #1b87b1;
        color: #e1f0ff;
        margin-right: 10px;
        text-decoration: none;
        padding: 3px;

    }

    .armodal .armodel-container .arfoot .button-list-left .submitbutton {
        line-height: 1.3rem;
        box-sizing: border-box;
        background: #2c7575;
        border: 1px solid #2c7575;
        color: #9cf3dd;
        padding: 3px;

    }

    .armodal .armodel-container .arfoot .button-list-left .submitbutton:disabled {
        background-color: #aaaaaa;
        color: #000;
        cursor: no-drop;
    }


    .armodal .armodel-container .arfoot .button-list-right .cancelbutn:hover,
    .armodal .armodel-container .arfoot .button-list-left .printpayslip:hover,
    .armodal .armodel-container .arfoot .button-list-left .submitbutton:hover {
        color: #fff9f9;
        background: #2d2b2b;
        border: 1px solid #2d2b2b;
        transition: all 0.3s;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
    }

    .divtable {
        margin: 0 auto;
        background: #f1f3fa;
        padding: 6px;
        border: 1px solid #d1d1d1;
        border-collapse: collapse;
        overflow: auto;
    }

    .divrow {
        display: table-row;
    }

    .divcells {
        display: table-cell;
        white-space: nowrap;
    }

    .headersdivrow {
        padding: 8px 5px;
        justify-content: start;
        align-items: start;
        background: #d4d9ea;
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid #999daa;
        border-top: 1px solid #999daa;
        border-right: 1px solid #999daa;
    }

    .divcellbody {
        padding: 2px 5px;
        border-bottom: 1px solid #999daa;
        border-right: 1px solid #999daa;
        font-size: 14px;

    }

    .divcellfirst {
        border-left: 1px solid #999daa;
    }
</style>
<?php
session_start();
include_once('../../../conf.php');
include_once('../menu1.php');
?>
<div class="sub-body">
    <div id="_ispageloading" style="       
       position: fixed;
        width : 100%;
        height : 100%;
        background-color: #eaeaea;
        z-index: 10000005;  
        font-family:'roboto',sans-serif;   
        left : 0px;
        top : 0px; 
    
    ">
        <div style="
         width : 100%;
        height : 100%;
        align-items: center;
        display: flex;
        justify-content: center;">
            <i class="fa fa-spinner fa-pulse  fa-fw"></i>
            Loading.....
        </div>
    </div>
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Project Wise Summary With Cost {{_filtertitle}}
            </div>
            <div class="sub-container-right">
                <button onclick="document.getElementById('dia_filter_dates').style.display='flex'" class="ism-btns btn-normal">
                    <i class="fa fa-filter"></i>
                    Get Report
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


<div class="armodal" id="rpt_emp_dialog">
    <div class="armodel-container" style="width:850px;">
        <div class="armodelhead">
            <div class="armodel-title">
                <div class="left-logo">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="left-titles">Employee Details {{_empinfomanpower}}</div>
            </div>
            <div class="armodel-closebtn" onclick="document.getElementById('rpt_emp_dialog').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="armodelbody">
            <button type="button" ng-click="print_myinfos()">Print</button>
            <div class="armodelbodywarper">
                <div class="row" style="justify-content: flex-start;">
                    <div class="divtable">
                        <div class="divrow headers">
                            <div class="divcells headersdivrow divcellfirst" style="width: 55px;">S.No</div>
                            <div class="divcells headersdivrow" style="width: 57px;">File NO</div>
                            <div class="divcells headersdivrow" style="width: 220px;">Name</div>
                            <div class="divcells headersdivrow" style="width: 120px;">Nationality</div>
                            <div class="divcells headersdivrow" style="width: 140px;">Designation</div>
                            <div class="divcells headersdivrow">Present</div>
                            <div class="divcells headersdivrow">Absent</div>
                            <div class="divcells headersdivrow">Total</div>
                            <div class="divcells headersdivrow">Amount</div>
                        </div>
                        <div class="divrow">
                            <div class="divcells divcellbody divcellfirst">

                            </div>
                            <div class="divcells divcellbody divcellfirst">
                                <input ng-model="src.fileno" class="arnewinput nomal" placeholder="Search file no" ng-change="filter_fileno()">
                            </div>
                            <div class="divcells divcellbody divcellfirst">
                                <input ng-model="src.ename" class="arnewinput nomal" placeholder="Search Name" ng-change="filter_name()">
                            </div>
                            <div class="divcells divcellbody divcellfirst">
                                <select ng-model="src.enationality" class="arnewinput nomal" ng-change="filter_nationality()">
                                    <option value="">-Select-</option>
                                    <option ng-repeat="x in _empinfomanpowerdet.countrys" value="{{x}}">{{x}}</option>
                                </select>
                            </div>
                            <div class="divcells divcellbody divcellfirst">
                                <select ng-model="src.eposition" class="arnewinput nomal" ng-change="filter_category()">
                                    <option value="">-Select-</option>
                                    <option ng-repeat="x in _empinfomanpowerdet.positions" value="{{x}}">{{x}}</option>
                                </select>
                            </div>
                            <div class="divcells divcellbody divcellfirst">

                            </div>
                            <div class="divcells divcellbody divcellfirst">

                            </div>
                            <div class="divcells divcellbody divcellfirst">

                            </div>
                            <div class="divcells divcellbody divcellfirst">

                            </div>
                        </div>
                        <div ng-repeat="emp in (flist=(_empinfomanpowerdet.employsees|filter :src))" class="divrow">
                            <div class="divcells divcellbody divcellfirst">
                                {{$index+1}}
                            </div>
                            <div class="divcells divcellbody">
                                {{emp.fileno}}
                            </div>
                            <div class="divcells divcellbody">
                                {{emp.ename}}
                            </div>
                            <div class="divcells divcellbody">
                                {{emp.enationality}}
                            </div>

                            <div class="divcells divcellbody">
                                {{emp.eposition}}
                            </div>
                            <div class="divcells divcellbody">
                                {{emp.pres}}
                            </div>
                            <div class="divcells divcellbody" style='color :red'>
                                {{emp.abse}}
                            </div>
                            <div class="divcells divcellbody">
                                {{emp.totalemp}}
                            </div>
                            <div class="divcells divcellbody" style="font-weight:bold">
                                {{emp.amount}}
                            </div>
                        </div>

                        <div class="divrow headers">
                            <div class="divcells headersdivrow divcellfirst" style="width: 55px;"></div>
                            <div class="divcells headersdivrow" style="width: 57px;"></div>
                            <div class="divcells headersdivrow" style="width: 220px;"></div>
                            <div class="divcells headersdivrow" style="width: 120px;"></div>
                            <div class="divcells headersdivrow" style="width: 140px;"></div>

                            <!-- <div class="divcells headersdivrow">{{_empinfomanpowerdet._tot_present}}</div> -->
                            <div class="divcells headersdivrow">{{flist |  sumrow : 'pres'}}</div>
                            <div class="divcells headersdivrow">{{flist |  sumrow : 'abse'}}</div>
                            <div class="divcells headersdivrow">{{flist |  sumrow : 'totalemp'}}</div>
                            <div class="divcells headersdivrow">{{flist |  sumrow : 'amount'}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="arfoot">
            <div class="button-list-right">
                <button class="cancelbutn" type="button" onclick="document.getElementById('rpt_emp_dialog').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>