<?php
session_start();
include_once '../../../../conf.php';
include_once '../../menu.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../gos/component/st.php';
include_once './st.php';
?>


<div class="sub-body" style="margin-top: 100px;">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                NEW BILL OF MATERIALS
            </div>
            <div class="sub-container-right">
                <button type='button' class="ism-btns btn-normal" ng-click="print_bom()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
        </div>
        <!-- main body start form here -->
        <div class="sub-body-container-contents" style="height: calc(100vh - 185px);">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table" style="margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 150px;text-align:right">Contract#</td>
                                        <td colspan="3">
                                            <div>
                                                <span>{{newbom.bom_prefixno | uppercase}}/</span>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_no" name="bom_no" id="bom_no" style="width: 80px;" ng-keyup="getOldInfo($event)" ng-readonly="!canedit_dtinfo" ng-blur="getOldDatas()" />
                                                <button type="button" class="bomsrcbtn" ng-click="searchBomInfo()">
                                                    <i class='fa fa-search'></i>
                                                </button>
                                                <span style="margin-left: 50px;text-decoration:underline;font-style: italic;">{{mode === '1' ? "NEW BOM" : "EDIT BOM INFORMATIONS"}}</span>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px;text-align:right">Client</td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="newbom.clientname" name="clientname" id="clientname" style="width: 300px;" readonly />
                                        </td>
                                        <td style="width: 150px;text-align:right">Date</td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_date" name="bom_date" id="bom_date" style="width: 150px;" ng-readonly="!canedit_dtinfo"  placeholder="DD-MM-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px;text-align:right">Project</td>
                                        <td colspan="3">
                                            <input type="text" class="old_page_inputs" ng-model="newbom.bom_projectname" name="bom_projectname" id="bom_projectname" style="width: 400px;" readonly />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div ng-show="ispageloading">
                                <i class="fa fa-cog fa-spin"></i> <span style="margin-left: 5px;">Fetching Data.</span>
                            </div>
                            <div ng-show="issubmitted">
                                <table class="old_table itemlist" style="margin-bottom: 10px;" ng-hide="ispageloading">
                                    <thead>
                                        <tr>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:50px" rowspan="2">S.NO</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:120px" rowspan="2">Profile#</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:100px" rowspan="2">BOQ</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:230px" rowspan="2">Item Description</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9" rowspan="2">Die Weight</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9" colspan="3">Quantity Reqired</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9" colspan="2">Stock Available</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9" colspan="3">QTY.To Be Ordered</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:120px" rowspan="2">Finish</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:120px" rowspan="2">Remarks</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;width:55px" rowspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">Lenght (Mtr) <span><input type="checkbox" ng-change="handlerchange_checkboxlenght()" ng-model="newbom.alsowithlenght" style="display: none;"></span></td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">No.Of Bar</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">Total Weight</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">Lenght (Mtr)</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">No.Of Bar</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">Lenght (Mtr)</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">No.Of Bar</td>
                                            <td style="font-weight: bold;text-align:center;background-color:#e7e8e9">Total Weight</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-if="postflag === '0' && currentuser === newbomcurrentuser">
                                            <td></td>
                                            <td>
                                                <input list="whitemslist" type="text" class="old_page_inputs" ng-model="newbom.bom_profileno" name="bom_profileno" id="bom_profileno" ng-keydown="inputnavigator($event,'bom_boqid','')" ng-blur="selectwhitems()" />
                                                <datalist id="whitemslist">
                                                    <option ng-repeat="x in whitems_partno" ng-click="selectwhitems()" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <select class="old_page_inputs" ng-model="newbom.bom_boqid" name="bom_boqid" id="bom_boqid" ng-keydown="inputnavigator($event,'bom_description','bom_profileno')">
                                                    <option value="">-Select-</option>
                                                    <option value="0">Miscellaneous</option>
                                                    <option ng-repeat="x in boqitems" value="{{x.poq_id}}"> {{x.poq_item_no}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input list="whselecteddescriptions" type="text" class="old_page_inputs" ng-model="newbom.bom_description" name="bom_description" id="bom_description" ng-keydown="inputnavigator($event,'bom_dieweight','bom_boqid')" />
                                                <datalist id="whselecteddescriptions">
                                                    <option ng-repeat="x in whselected_descriptions" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input list="whitemsdiewights" type="text" class="old_page_inputs" ng-model="newbom.bom_dieweight" name="bom_dieweight" id="bom_dieweight" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_qrlenght','bom_description')" />
                                                <datalist id="whitemsdiewights">
                                                    <option ng-repeat="x in whselected_dieweights" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input list="whseelctedlengths" type="text" class="old_page_inputs" ng-model="newbom.bom_qrlenght" name="bom_qrlenght" id="bom_qrlenght" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_qrbar','bom_dieweight')" />
                                                <datalist id="whseelctedlengths">
                                                    <option ng-repeat="x in whseelcted_lengths" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_qrbar" name="bom_qrbar" id="bom_qrbar" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_qrtotweight','bom_qrlenght')" />
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_qrtotweight" name="bom_qrtotweight" id="bom_qrtotweight" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_avilength','bom_qrbar')" />
                                            </td>
                                            <td>
                                                <input list="whseelctedlengths" type="text" class="old_page_inputs" ng-model="newbom.bom_avilength" name="bom_avilength" id="bom_avilength" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_avaibar','bom_qrtotweight')" />
                                                <datalist id="whseelctedlengths">
                                                    <option ng-repeat="x in whseelcted_lengths" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_avaibar" name="bom_avaibar" id="bom_avaibar" ng-change="calc()" ng-keydown="inputnavigator($event,'bom_orderlength','bom_avilength')" />
                                            </td>
                                            <td>
                                                <input list="whseelctedlengths" type="text" class="old_page_inputs" ng-model="newbom.bom_orderlength" name="bom_orderlength" id="bom_orderlength" ng-keydown="inputnavigator($event,'bom_orderbar','bom_avaibar')" />
                                                <datalist id="whseelctedlengths">
                                                    <option ng-repeat="x in whseelcted_lengths" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_orderbar" name="bom_orderbar" id="bom_orderbar" ng-keydown="inputnavigator($event,'bom_orderweight','bom_orderlength')" />
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_orderweight" name="bom_orderweight" id="bom_orderweight" ng-keydown="inputnavigator($event,'bom_itemfinish','bom_orderbar')" />
                                            </td>
                                            <td>
                                                <input list="selectedcolors" type="text" class="old_page_inputs" ng-model="newbom.bom_itemfinish" name="bom_itemfinish" id="bom_itemfinish" ng-keydown="inputnavigator($event,'bom_remarks','bom_orderweight')" />
                                                <datalist id="selectedcolors">
                                                    <option ng-repeat="x in selected_colors" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_remarks" name="bom_remarks" id="bom_remarks" ng-keydown="inputnavigator($event,'','bom_itemfinish')" />
                                            </td>
                                            <td>
                                                <div style="display: flex;gap:2px">
                                                <button type="button" ng-if="postflag === '0' && currentuser === newbomcurrentuser" id="buttonsave" class="ism-btns btn-normal" style="padding: 2px;font-size: 11px;" ng-click="addtolist()">
                                                    <i ng-if="mode === '1'" class="fa fa-plus"></i>
                                                    {{itemmdoe == "1" ? 'Save' : 'Update'}}
                                                </button>
                                                <button type='button' ng-if="itemmdoe == '2'" ng-click="cancelEdit()">
                                                    <i class='fa fa-times'></i>
                                                </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr ng-repeat="x in bomlist">
                                            <td>{{$index+1}}</td>
                                            <td>{{x.bom_profileno}}</td>
                                            <td>{{x.boqitem}}</td>
                                            <td>{{x.bom_description}}</td>
                                            <td style="text-align: center;">{{x.bom_dieweight}}</td>
                                            <td style="text-align: center;">{{x.bom_qrlenght}}</td>
                                            <td style="text-align: center;">{{x.bom_qrbar}}</td>
                                            <td style="text-align: center;">{{(+x.bom_qrtotweight).toLocaleString(undefined,{maximumFractionDigits:3})}}</td>
                                            <td style="text-align: center;">{{x.bom_avilength}}</td>
                                            <td style="text-align: center;">{{x.bom_avaibar}}</td>
                                            <td style="text-align: center;">{{x.bom_orderlength}}</td>
                                            <td style="text-align: center;">{{x.bom_orderbar}}</td>
                                            <td style="text-align: center;">{{(+x.bom_orderweight).toLocaleString(undefined,{maximumFractionDigits:3})}}</td>
                                            <td>{{x.bom_itemfinish}}</td>
                                            <td>{{x.bom_remarks}}</td>
                                            <td>
                                                <div style="display: flex;gap:4px;">
                                                <button ng-if="newbom.bom_postflag === '0' && currentuser === newbom.bom_cby" type="button"  class="ism-btn btn-normal" ng-click="editBomItem(x)" style="padding: 2px;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button ng-if="newbom.bom_postflag === '0' && currentuser === newbom.bom_cby" type="button"  class="ism-btn btn-delete" ng-click="removeBomitem(x)" style="padding: 2px;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align:center;background-color:yellow;font-weight:bold'>{{sumofrowx._req_bar}}</td>
                                            <td style='text-align:center;background-color:yellow;font-weight:bold'>{{sumofrowx._req_wt}}</td>
                                            <td></td>
                                            <td style='text-align:center;background-color:yellow;font-weight:bold'>{{sumofrowx._avi_bar}}</td>
                                            <td></td>
                                            <td style='text-align:center;background-color:yellow;font-weight:bold'>{{sumofrowx._ord_bar}}</td>
                                            <td style='text-align:center;background-color:yellow;font-weight:bold'>{{sumofrowx._ord_wt}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="old_table itemlist" style="margin-bottom: 10px;" ng-hide="ispageloading">
                                    <tbody>
                                        <tr>
                                            <td style="width: 180px;" colspan="2">
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_registerno" name="bom_registerno" id="bom_registerno" style="width: 150px;color:red;font-weight:bold" readonly />
                                            </td>
                                            <td style="width: 150px;">PREPARED BY</td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_makeby" name="bom_makeby" id="bom_makeby" style="width: 150px;" />
                                            </td>
                                            <td style="width: 150px;">APPROVED BY</td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="newbom.bom_checkedby" name="bom_checkedby" id="bom_checkedby" style="width: 150px;color:red;font-weight:bold" readonly />
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
</div>