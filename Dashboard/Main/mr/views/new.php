<?php
session_start();
include_once('../../../../conf.php');
include_once('../../menu.php');
include_once '../../glassorders/purchase/nst.php';
include_once('../../masterlog/st.php');
include_once '../../glassorders/procurement/st.php';
$editusers = ['john', 'materials', 'roberto', 'demo'];
$canedit = in_array($xusername, $editusers);
?>

<style>
    .old_table {
        font-family: 'owh';
        font-size: 0.80rem;
    }

    .old_table th {
        padding: 3px;
        font-family: 'owh';
        font-size: 0.80rem;
    }

    #show_auto_complete_items {
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        background: #47474752;
        z-index: 9999999;

    }

    .auto-complete-model {
        width: 600px;
        background: #fbfbfb;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px #d5d5d5;
    }

    .auto-complete-model-container {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }

    .auto-complete-model-search {
        padding: 3px;
        position: sticky;
        top: 0px;
    }

    .search-list-input {
        width: 100%;
        padding: 3px;
        line-height: 18px;
        border-radius: 3px;
        border: 1px solid #c3c3c3;
        font-family: 'abel';
    }

    .auto-complete-model-result-box {
        position: relative;
        display: flex;
        flex-direction: column;
        max-height: 300px;
        overflow: auto;
        padding: 5px;
        gap: 10px;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .auto-complete-model-result {
        border: 1px solid #e7e7e7;
        width: 100%;
        border-radius: 5px;
        padding: 5px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .auto-complete-model-result:hover {
        border: 1px solid #6d6d6d;
        background: linear-gradient(360deg, #f2f5ff, transparent);
    }

    .auto-compleate-itemsinfo-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-family: 'muli';
    }

    .item-info-group {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between;
    }

    .item-info-group>span {
        font-weight: bold;
    }

    .old_page_inputs {
        font-family: 'owh';
        font-weight: bold;
    }
</style>

<div class="sub-body" style="margin-top: 100px;height: calc(100vh - 130px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Material Request
            </div>
            <div class="sub-container-right">
                <?php
                if ($canedit) {
                ?>
                    <?php
                    if ($xusername === 'john' || $xusername === 'demo') {
                    ?>
                        <button ng-show="mode === 'E' && mrinpust.mrflags === 'N'" type="button" ng-click="postmr()" class="ism-btns btn-normal">
                            <i class="fa fa-envelope"></i>
                            POST
                        </button>
                    <?php
                    }
                    if($xusername === 'fidel' || $xusername === 'demo'){
                        ?>
                        <button ng-show="mode === 'E' && mrinpust.mrflags === 'P'" type="button" ng-click="unpostmr()" class="ism-btns btn-normal">
                            <i class="fa fa-envelope"></i>
                            UNPOST
                        </button>
                        <?php
                    }
                    ?>

                    <button type="button" ng-click="savedata()" class="ism-btns btn-normal">
                        <i class="fa fa-check"></i>
                        Save & Print
                    </button>
                <?php
                } else {
                ?>
                    <button type="button" ng-click="printdata()" class="ism-btns btn-normal">
                        <i class="fa fa-check"></i>
                        Print
                    </button>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm" style="width: 1540px;">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="width: 1500px;">
                                <tbody>
                                    <tr>
                                        <td style="width:135px">Date</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <div>
                                                <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.mrdate" name="mrdate" id="mrdate" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrcode')" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                                            </div>
                                        </td>
                                        <td style="width:135px">Ref NO#</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.mrcode" name="mrcode" id="mrcode" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrno')" />
                                        </td>
                                        <td style="width:135px">Mr No</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.mrno" name="mrno" id="mrno" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'preparedby')" />
                                        </td>
                                        <td style="width:135px">Prepare By</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.preparedby" name="preparedby" id="preparedby" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrcheckedby')" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:135px">Checked By</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.mrcheckedby" name="mrcheckedby" id="mrcheckedby" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrapprovedby')" />
                                        </td>
                                        <td style="width:135px">Approved By</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.mrapprovedby" name="mrapprovedby" id="mrapprovedby" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'releaseddate')" />
                                        </td>
                                        <td style="width:135px">Release Date</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">
                                            <div>
                                                <input ng-readonly="mode === 'E'" type="text" class="old_page_inputs" ng-model="mrinpust.releaseddate" name="releaseddate" id="releaseddate" autocomplete="off" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedateactsign" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox" style="max-height: calc(100vh - 334px);">
                            <table class="old_table itemlist" style="width: 100%; zoom :95%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">S.NO</th>
                                        <th rowspan="2">Item Description</th>
                                        <th rowspan="2">Part NO</th>
                                        <th rowspan="2">Supplier</th>
                                        <th rowspan="2" style="width: 90px;">DIE Weight (KG/M)</th>
                                        <th colspan="4">QUANTITY REQUIRED</th>
                                        <th rowspan="2" style="width: 90px;">Contract BOQ</th>
                                        <th rowspan="2" style="width: 220px;">Contract Item Description</th>
                                        <th colspan="2">Stock Available</th>
                                        <th colspan="2">QTY. TO BE ORDERED</th>
                                        <th rowspan="2">Finish</th>
                                        <th rowspan="2">Remark</th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 90px;">Lenght In mm</th>
                                        <th style="width: 90px;">QTY</th>
                                        <th style="width: 90px;">Unit</th>
                                        <th style="width: 90px;">Total Weight</th>
                                        <th style="width: 90px;">Stock Qty</th>
                                        <th style="width: 90px;">Stock Weight</th>
                                        <th style="width: 90px;">Balance of Order</th>
                                        <th style="width: 90px;">Balance Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-hide="mode === 'E' && mrinpust.mrflags === 'P'">
                                        <td>

                                        </td>
                                        <td style="width: 220px;">

                                            <div style="display:flex;gap:10px
                                            ;align-items:center">
                                                <input type="text" class="old_page_inputs" ng-model="mrinpust.mritem" name="mritem" id="mritem" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrpartno')" />
                                                <i class="fa fa-search" ng-click="show_search_dialogs()"></i>
                                            </div>
                                            <div id="show_auto_complete_items">
                                                <wh-items></wh-items>
                                            </div>
                                        </td>
                                        <td style="width: 100px;">
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrpartno" name="mrpartno" id="mrpartno" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrpartnotai')" />
                                        </td>
                                        <td style="width: 100px;">
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrpartnotai" name="mrpartnotai" id="mrpartnotai" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrdieweight')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrdieweight" ng-change="calcu()" name="mrdieweight" id="mrdieweight" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrreqlength')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrreqlength" ng-change="calcu()" name="mrreqlength" id="mrreqlength" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrreqqty')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrreqqty" ng-change="calcu()" name="mrreqqty" id="mrreqqty" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrunit')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrunit" name="mrunit" id="mrunit" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrboqno')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrreqtotweight" name="mrreqtotweight" id="mrreqtotweight" autocomplete="off" />
                                        </td>
                                        <td>
                                            <select type="text" class="old_page_inputs" ng-model="mrinpust.mrboqno" name="mrboqno" id="mrboqno" autocomplete="off" ng-change="getInfoboqiteminfo()" ng-keyup="moveTOnxtContrl($event,'mravaiqty')">
                                                <option value="">-Select-</option>
                                                <option value='0'>Miscellaneous</option>
                                                <option ng-repeat="x in boqlist" value="{{x.poq_id}}">
                                                    {{x.poq_item_no}}
                                                </option>
                                            </select>


                                        </td>
                                        <td>
                                            <div style="display:flex;gap:10px;align-items:center">
                                                <input type="text" class="old_page_inputs" ng-model="boqiteminfo" name="boqiteminfo" id="boqiteminfo" autocomplete="off" readonly />
                                                <i ng-hide="!mrinpust.mrboqno || mrinpust.mrboqno === '' || mrinpust.mrboqno.toString() === '0'" class="fa fa-info" ng-click="getboqinfo(mrinpust.mrboqno)"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mravaiqty" ng-change="calcu()" name="mravaiqty" id="mravaiqty" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mraviweight')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mraviweight" ng-change="calcu()" name="mraviweight" id="mraviweight" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrfinish')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrorderedqty" ng-change="calcu()" name="mrorderedqty" id="mrorderedqty" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrorderedweight" name="mrorderedweight" id="mrorderedweight" autocomplete="off" />
                                        </td>
                                        <td style="width: 220px;">
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrfinish" name="mrfinish" id="mrfinish" autocomplete="off" ng-keyup="moveTOnxtContrl($event,'mrremarks')" />
                                        </td>
                                        <td style="width: 220px;">
                                            <input type="text" class="old_page_inputs" ng-model="mrinpust.mrremarks" name="mrremarks" id="mrremarks" autocomplete="off" ng-keydown="insert_data($event)" ng-keyup="moveTOnxtContrl($event,'mrfinishr')" />
                                        </td>
                                        <td>
                                            <?php
                                            if ($canedit) {
                                            ?>

                                                <button type="button" class="ism-btns btn-normal" ng-click="add_new_item_click()" style="padding:2px">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
                                    include_once 'editmode.php';
                                    include_once 'newmode.php';
                                    ?>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:5px">

                                            </div>
                                        </td>
                                        <td ng-show="mode === 'N'" style="text-align: right;"> Total </td>
                                        <td ng-show="mode === 'E'" style="text-align: right;"> Total </td>
                                        <td style="color:red;font-weight:bold">{{totalinfos.stavi}}</td>
                                        <td style="color:red;font-weight:bold">{{(+totalinfos.sttotwt).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
                                        <td style="color:red;font-weight:bold">{{totalinfos.rqqty}}</td>
                                        <td style="color:red;font-weight:bold">{{(+totalinfos.reqwt).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
                                        <td style="color:red;font-weight:bold"></td>
                                        <td style="color:red;font-weight:bold"></td>
                                        <td ng-if="mode === 'N'">

                                        </td>
                                        <td ng-if="mode === 'E'">

                                        </td>
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
include_once 'boqinfo.dia.php';
include_once 'edit.dia.php';
include_once '../../bom/components/reserve.dia.php';
include_once '../../bom/components/reserveproject.dia.php';
include_once '../../bom/components/reserveitems.dia.php';

?>