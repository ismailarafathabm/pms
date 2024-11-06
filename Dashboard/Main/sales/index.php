<?php
session_start();
include_once('../../../conf.php');
include_once('../menu1.php');
?>
<style>
    .ag-theme-balham .ag-root-wrapper {
        border: 1px solid #bdc3c7;
        border-color: #e6e6e6;
    }

    .ag-theme-balham .ag-header {
        background-color: #e9e9e9;
        border-bottom: 1px solid #bdc3c7;
        border-bottom-color: #e6e6e6;
    }

    .ag-header-container {
        background: #e9e9e9;
        font-family: 'se', sans-serif;
        font-size: 14px;
        font-weight: 600;
        border: none;
        color: #000 !important;
    }

    .ag-cell {
        font-size: 1rem;
        color: #585858;
        font-family: 'sfpro', -apple-system, BlinkMacSystemFont, 'se', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        /* background: rgb(208,208,208); */
        /* background: rgb(235,234,234); */
        background: linear-gradient(180deg, rgba(235, 234, 234, 1) 0%, rgba(238, 238, 238, 1) 35%, rgba(249, 249, 249, 1) 100%);
    }

    .moneycellheaders {
        font-weight: bold;
        color: #bb0e0e;
    }

    .moneycell,
    .moneycell-tot {
        text-align: right;
        color: #000;
    }

    .moneycell-tot {
        font-weight: bold;
        color: #bb0e0e;
    }


    .moneycellheaders-downpayments {
        font-weight: bold;
        color: #3A6351;
    }

    .moneycell-tot-downpayments,
    .moneycell-tot-downpayments-total {
        text-align: right;
        color: #000;
    }

    .moneycell-tot-downpayments-total {
        font-weight: bold;
        color: #3A6351;
    }

    .green-leaves {
        background: rgb(4 102 70 / 10%);
        font-size: 0.9rem;
        color: #000;
    }

    .naf-ams-tablediv {
        position: relative;
        display: table;

        background: #efefef;
        border: 1px solid #e1e1e1;
        border-collapse: collapse;
    }

    .naf-asm-table-row {
        display: table-row;
        border: 1px solid #e3e1e1;
    }

    .naf-ams-table-cell {
        display: table-cell;
        padding: 5px;
    }

    .head-cell {
        font-size: 1.01rem;
        color: #000;
        font-weight: bold;
    }

    .decrip-cell {
        width: 350px;
    }

    .pre-cell {
        width: 120px;
    }

    .pval-cell {
        width: 200px;
    }

    .cval-cell {
        width: 200px;
    }

    .totval-cell {
        width: 200px;
    }

    .cell-normal {
        color: #272727;
        font-weight: 500;


    }

    .table-lable {
        text-align: right;
        width: 158.4px;
        font-weight: 600;
    }

    .cl-red {
        color: red;
    }

    .table-inputs {
        width: 225px;
    }

    .subtotal-row {
        border-top: 2px solid #a747472e !important;
        border-bottom: 2px solid #a747472e !important;
    }

    .sub-total {
        font-weight: 600;
        color: #a74747;
        font-size: 1.0rem;
    }

    .row-group-title {
        border-bottom: 2px solid #1f72762e !important
    }

    .row-title {
        font-weight: 600;
        color: #000000;
        text-align: center;
        background: rgb(4 102 70 / 10%);
    }

    .cell-group-title {
        font-weight: bolder;
        color: #1f7276;
        font-size: 1.0rem;
    }

    .naf-btn-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: start;
    }

    .naf-btn-adds {
        padding: 5px 15px;
        background: #2e6980;
        border: 1px solid transparent;
        border-radius: 3px;
        color: #fff;
        letter-spacing: 0px;
        line-height: 1rem;
        transition: background-color 0.6s ease;
        font-family: 'sfpro', -apple-system, BlinkMacSystemFont, 'se', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        margin: 10px 5px;
    }

    .naf-btn-adds:hover {
        background: #0287bc;
    }

    .lable-cell {
        width: 220px;

    }

    .input-cell {
        width: 300px;
    }

    .naf-asm-new-input {
        padding: 6px 8px;
        background: #e3e3e3;
        border: 1px solid #c5c3c3;
        width: 100%;
        line-height: 1.3rem;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
        font-family: 'sfpro', -apple-system, BlinkMacSystemFont, 'se', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .naf-asm-new-input:focus {
        background-color: #d4d4d4;
    }

    .naf-asm-new-input:read-only {
        background-color: #ffdede;
        color: #ad0423;
    }

    .naf-asm-new-input:focus:read-only {
        background-color: #ffdede;
        color: #ad0423;
    }

    .arnewinput {
        border: 1px solid #a9a8a8 !important;
        /* text-align: right; */
        /* line-height: 0px !important; */
    }

    .subtotal_workdone {
        color: #000;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .subtotal_cl1 {
        background: #a1b385;
    }

    .subtotal_cl3 {
        background: #fff0a9;
    }

    .subtotal_cl2 {
        background: #c5a5cd;
    }

    .table-input-numbers {
        text-align: right;
        font-weight: 600;
    }

    .tbl-view {
        border: 1px solid #cbcaca;
    }

    .yellow-leaves {
        color: #8f4900;
        font-weight: 600;
    }

    ._green1 {
        background-color: #ddffe0;
        color: #194e1d;
    }
</style>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top:75px">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                QUOTATIONS
            </div>
            <div class="sub-container-right">
                <button ng-click="print_rpt()" class="ism-btns btn-normal" style="margin-right: 5px">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-click="print_rpt_salesrep()" class="ism-btns btn-normal" style="margin-right: 45px">
                    <i class="fa fa-print"></i>
                    Print By Sales
                </button>
                <button ng-click="excelexport()" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <button class="ism-btns btn-normal" type="button" onclick="document.getElementById('dia_new_quotation').style.display='flex'" ;>
                    <i class="fa fa-plus"></i>
                    New
                </button>
                <button ng-click="clearFilters()" class="ism-btns btn-delete">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Clear Filte
                </button>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:100%;background: #fff;">
            <div id="myGrid" class="ag-theme-balham" style="height:100%;"></div>
        </div>
    </div>
</div>

<div class="filterdialog" id="dia_new_quotation">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    ADD NEW QUOTATION
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_new_quotation').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form ng-init="document.getElementsByName('seach_projectname')[0].focus()" ng-if="!search_old_cmpl" id="getreport_dialog" name="dialog_getreport" ng-submit="getreport_dialog_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Contract Name</div>
                        <div class="inputitmes">
                            <input type="text" name="seach_projectname" ng-model="seach_projectname" class="new-inputs-black" required>
                            <button type='submit' class="savenewbutton" ng-disabled="dialog_getreport.$invalid" style="margin-left:10px">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form ng-if="search_old_cmpl" id="save_quotations" name="quotations_save" ng-submit="save_quotations_submit()" autocomplete="off">
            <div class="filterdialogbody" style='flex-direction:column;    align-items: flex-start;'>
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">SI.NO</div>
                        <div class="inputitmes">
                            <input type="text" name="qusno" ng-model="newquotations.qusno" readonly class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">REF.No#</div>
                        <div class="inputitmes">
                            <input type="text" name="qurefno" ng-model="newquotations.qurefno" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">RECEIVED DATE</div>
                        <div class="inputitmes">
                            <input type="text" name="qureceiveddate" ng-model="newquotations.qureceiveddate" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">SUBMITEAL DUE DATE</div>
                        <div class="inputitmes">
                            <input type="text" name="qusubmitaldate" ng-model="newquotations.qusubmitaldate" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">SALES REP</div>
                        <div class="inputitmes">
                            <input list="list_srep" type="text" name="qusalesrep" ng-model="newquotations.qusalesrep" class="new-inputs-black" required>
                            <datalist id="list_srep">
                                <option ng-repeat="x in list_srep" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">PROJECT NAME</div>
                        <div class="inputitmes">
                            <input type="text" name="quprojectname" ng-model="newquotations.quprojectname" class="new-inputs-black" readonly required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">STATUS</div>
                        <div class="inputitmes">
                            <select name="qustatus" ng-model="newquotations.qustatus" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option value="TENDER">TENDER</option>
                                <option value="ONGOING">ONGOING</option>
                                <option value="VILLA">VILLA</option>
                                <option value="RUSH PROJECT">RUSH PROJECT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">LOCATION</div>
                        <div class="inputitmes">
                            <input list="list_location" type="text" name="qulocation" ng-model="newquotations.qulocation" class="new-inputs-black" required>
                            <datalist id="list_location">
                                <option ng-repeat="x in list_location" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">CONTRACTOR/CLIENT</div>
                        <div class="inputitmes">
                            <input list="list_client" type="text" name="qucontact" ng-model="newquotations.qucontact" class="new-inputs-black" required>
                            <datalist id="list_client">
                                <option ng-repeat="x in list_client" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">CONTACT</div>
                        <div class="inputitmes">
                            <input type="text" name="contact_infos" ng-model="newquotations.contact_infos" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">ATTENTION TO</div>
                        <div class="inputitmes">
                            <input type="text" name="quattention" ng-model="newquotations.quattention" class="new-inputs-black" required>
                        </div>
                    </div>

                </div>
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">DOCUMENT RECEIVED THRU</div>
                        <div class="inputitmes">
                            <select name="qurecivedthru" ng-model="newquotations.qurecivedthru" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option value="NO DOCS">NO DOCS</option>
                                <option value="Downloaded">Downloaded</option>
                                <option value="Attachment">Attachment</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">BOQ</div>
                        <div class="inputitmes">
                            <select name="quboq" ng-model="newquotations.quboq" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option value="XLS">XLS</option>
                                <option value="PDF">PDF</option>
                                <option value="JPEG">JPEG</option>
                                <option value="OTHERS">Others</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">SPECIFICATION</div>
                        <div class="inputitmes">
                            <select class="new-inputs-black" name="quspecification" ng-model="newquotations.quspecification" required>
                                <option value="">-Select-</option>
                                <option value="CAD">CAD</option>
                                <option value="PDF">PDF</option>
                                <option value="JPEG">JPEG</option>
                                <option value="OTHERS">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">DRAWINGS</div>
                        <div class="inputitmes">
                            <select class="new-inputs-black" name="qudrawings" ng-model="newquotations.qudrawings" required>
                                <option value="">-Select-</option>
                                <option value="CAD">DOC</option>
                                <option value="PDF">PDF</option>
                                <option value="JPEG">JPEG</option>
                                <option value="OTHERS">Others</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Noted</div>
                        <div class="inputitmes">
                            <input type="text" name="newquotations" ng-model="newquotations.newquotations" class="new-inputs-black" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" ng-click="cancel_seach()">
                        Cancel
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="dialog_getreport.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once 'new.php' ?>
<?php include_once 'rlist.php' ?>