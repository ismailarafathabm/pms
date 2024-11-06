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
                ADD NEW BOM <span style="font-size:12px;margin-left:10px">(Bill of Materials)</span>
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row">
                        <div class="old_pgm_column" style="display:block">
                            <div class="old_page_lable">BOM NO </div>
                            <div class="old_page_controllers">
                                <input type="text" class="old_page_inputs" name="bomsno" readonly/>
                            </div>
                        </div>
                        <div class="old_pgm_column">
                            <div class="old_page_lable">Date </div>
                            <div class="old_page_controllers">
                                <input type="text" ng-model="lcsigndate" class="old_page_inputs" name="bomdate" placeholder="dd-mm-YYYY" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="lcsigndate" />
                            </div>
                        </div>
                        <div class="old_pgm_column">
                            <div class="old_page_lable">Contract</div>
                            <div class="old_page_controllers">
                                <input type="text" class="old_page_inputs" name="bomcontract" />
                            </div>
                        </div>
                        <div class="old_pgm_column">
                            <div class="old_page_lable">Color </div>
                            <div class="old_page_controllers">
                                <input type="text" class="old_page_inputs" name="bomcolor" />
                            </div>
                        </div>
                       
                        <div class="old_pgm_column">
                            <div>
                                <button type="button" class="ism-btns btn-save" ng-click="saveBom()" style="margin-top:8px">
                                    <i class="fa fa-check"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="old_pgm_row">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <thead>
                                    <tr>
                                        <th colspan="5"> ITEM LIST</th>
                                        <th></th>
                                        <th colspan="4" class="n_req"> QUANTITY REQURED </th>
                                        <th colspan="3" class="n_avi"> STOCK AVAILABLE </th>
                                        <th colspan="3" class="n_need"> QTY. TO BE ORDERED </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th> Remove </th>
                                        <th> S.NO </th>
                                        <th style="width:100px"> Profiile </th>
                                        <th style="width:90px"> Partno </th>
                                        <th style="width:250px"> Description </th>
                                        <th> Die Weight </th>
                                        <th class="n_req"> Length In.Mtr </th>
                                        <th class="n_req"> No. of Bar </th>
                                        <th class="n_req"> UNIT </th>
                                        <th class="n_req"> Total Weight </th>
                                        <th class="n_avi"> Length In.Mtr </th>
                                        <th class="n_avi"> No. of Bar </th>
                                        <th class="n_avi"> Total Weight </th>
                                        <th class="n_need"> Length In.Mtr </th>
                                        <th class="n_need"> No. of Bar </th>
                                        <th class="n_need"> Total Weight </th>
                                        <th style="width:140px"> Remark </th>

                                    </tr>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                        <td>
                                            <div style="display:flex">
                                                <input list="bomsrcitemlist" type="text" class="old_page_inputs" name="itemid" tabindex="0" style="display:none" />
                                                <input list="bomsrcitemlist" type="text" class="old_page_inputs" name="profileno" tabindex="0" />
                                                <datalist id="bomsrcitemlist">
                                                    <option ng-repeat="x in bomitemslist" value="{{x.itemid}}">{{x.itemtype}} | {{x.itemprofileno}} |  {{x.itempartno}} | {{x.itemdescription}} | {{x.itemalloy}} | {{x.itemfinish}} | {{x.itemlength}} | {{x.itemunit}} | {{x.itemdieweight}} | {{x.itemsystem}}</option>
                                                </datalist>
                                                <button type="button" style="font-size:8px" onclick='document.getElementById("dia_add_bom_items").style.display = "flex"'>
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" name="partno" tabindex="1" />
                                            <datalist id="bomsrcitemlista">
                                            <option ng-repeat="x in bomitemslist" value="{{x.itemid}}">{{x.itemtype}} | {{x.itemprofileno}} |  {{x.itempartno}} | {{x.itemdescription}} | {{x.itemalloy}} | {{x.itemfinish}} | {{x.itemlength}} | {{x.itemunit}} | {{x.itemdieweight}} | {{x.itemsystem}}</option>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="description" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="dieweight" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="reqlenght" tabindex="2" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="reqbarqty" tabindex="3" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="itemunits" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="totweightreq" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="availenght" tabindex="4" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="avaibarqty" tabindex="5" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="avaitotweight" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="needlenght" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="needbarqty" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="needweight" readonly />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" name="remarks" tabindex="6" />
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in itemslist">
                                        <td>
                                            <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removeItem($index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{$index+1}}</td>
                                        <td>{{item.profileno}}</td>
                                        <td>{{item.partno}}</td>
                                        <td>{{item.description}}</td>
                                        <td>{{item.dieweight}}</td>
                                        <td>{{item.reqlenght}}</td>
                                        <td>{{item.reqbarqty}}</td>
                                        <td>{{item.itemunits}}</td>
                                        <td>{{item.totweightreq}}</td>
                                        <td>{{item.availenght}}</td>
                                        <td>{{item.avaibarqty}}</td>
                                        <td>{{item.avaitotweight}}</td>
                                        <td>{{item.needlenght}}</td>
                                        <td>{{item.needbarqty}}</td>
                                        <td>{{item.needweight}}</td>
                                        <td>{{item.remarks}}</td>
                                    </tr>
                                </tbody>
                                <!-- <tbody ng-repeat="x in itemslist">
                                    <tr>
                                        <td colspan="17">System : <span style="color:red;font-weight:bold">{{x.xsystem}}</span> </td>
                                    </tr>
                                    <tr ng-repeat="item in x.arr">
                                        <td>
                                            <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removeItem(item.$index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{$index+1}}</td>
                                        <td>{{item.profileno}}</td>
                                        <td>{{item.partno}}</td>
                                        <td>{{item.description}}</td>
                                        <td>{{item.dieweight}}</td>
                                        <td>{{item.reqlenght}}</td>
                                        <td>{{item.reqbarqty}}</td>
                                        <td>{{item.itemunits}}</td>
                                        <td>{{item.totweightreq}}</td>
                                        <td>{{item.availenght}}</td>
                                        <td>{{item.avaibarqty}}</td>
                                        <td>{{item.avaitotweight}}</td>
                                        <td>{{item.needlenght}}</td>
                                        <td>{{item.needbarqty}}</td>
                                        <td>{{item.needweight}}</td>
                                        <td>{{item.remarks}}</td>
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once './additem.php';
include_once './props.php';
?>