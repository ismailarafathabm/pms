<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
$username = $_SESSION['nafco_alu_user_name'];

include_once '../../../../../conf.php';
$update_access = ['superadmin', 'engineering'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'engineering', 'Management', 'engineeringuser'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once '../../../menu.php';
include_once '../../../glassorders/purchase/nst.php';
include_once '../../../masterlog/st.php';
include_once '../../../glassorders/procurement/st.php';
?>
<div class="sub-body" style="margin-top: 100px;height: calc(100vh - 130px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Shop Drawing Submital
            </div>
            <div class="sub-container-right">

            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="width: 1200px;">
                                <tbody>
                                    <tr>
                                        <td style="width:135px">To</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">{{viewproject.project_cname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Project</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">{{viewproject.project_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td colspan="5" style="font-size: 14px;font-weight: bold;">{{viewproject.project_location}} [{{viewproject.projectRegion}}]</td>
                                    </tr>
                                    <tr>
                                        <td style="width:135px">
                                            Submital No
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.ds_submitalno" name="ds_submitalno" id="ds_submitalno" autocomplete="off" />
                                        </td>
                                        <td style="width:135px">
                                            Revision No
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.ds_rvno" name="ds_rvno" id="ds_rvno" autocomplete="off" />
                                        </td>
                                        <td style="width:135px">
                                            Date
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="ts.data.ds_date" name="ds_date" id="ds_date" autocomplete="off" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="background: #dbdbdb;font-style: italic;font-weight: 700;">Purpose</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="width: 1109px;">
                                            <div style="display: flex;flex-direction:column;gap:5px;">
                                                <div style="display: flex;flex-direction:row;align-items:center;justify-content:space-between;">
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.approval" /> For Approvals
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.furtheractions" /> For Futher actions
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.review" /> For Review
                                                    </div>
                                                </div>
                                                <div style="display: flex;flex-direction:row;align-items:center;justify-content:space-between;">
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.comments" /> For comments
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.informations" /> For Information
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="purpose.sample" /> For Sample
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="background: #dbdbdb;font-style: italic;font-weight: 700;">Remarks</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div style="display: flex;flex-direction:column;gap:5px;">
                                                <div style="display: flex;flex-direction:row;align-items:center;justify-content:space-between;">
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.drawing" /> SHOP DRAWING
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.technicalsubmital" /> TECHNICAL SUBMITAL
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.hardwaresubmital" /> HARDWARE SUBMITAL
                                                    </div>
                                                </div>
                                                <div style="display: flex;flex-direction:row;align-items:center;justify-content:space-between;">
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.calculation" /> CALCULATIONS
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.prequalification" /> PRE-QUALIFICATION
                                                    </div>
                                                    <div style="width: 220px;">
                                                        <input type="checkbox" ng-model="remarks.sample" /> SAMPLE
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="width: 1200px;">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th style="width:80px">Qty</th>
                                        <th style="width:200px">Dwg. / Spec. Reference</th>
                                        <th style="width:450px">Description</th>
                                        <th style="width:380px">Remarks</th>
                                        <th style="width:90"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="background: #ffe0e0;"></td>
                                        <td style="background: #ffe0e0;">
                                            <input type="text" class="old_page_inputs" ng-model="tsdt.dsdt_dsqty" name="techsub_qty" id="techsub_qty" autocomplete="off" />
                                        </td>
                                        <td style="background: #ffe0e0;">
                                            <input type="text" class="old_page_inputs" ng-model="tsdt.dsdt_drawingno" name="dsdt_drawingno" id="dsdt_drawingno" autocomplete="off" />
                                        </td>
                                        <td style="background: #ffe0e0;">
                                            <input type="text" class="old_page_inputs" ng-model="tsdt.dsdt_description" name="dsdt_description" id="dsdt_description"  />
                                        </td>
                                        <td style="background: #ffe0e0;">
                                            <input type="text" class="old_page_inputs" ng-model="tsdt.dsdt_remarks" name="dsdt_remarks" id="dsdt_remarks" autocomplete="off"/>
                                        </td>
                                        <td style="background: #ffe0e0;">
                                            <button ng-click="addtolist_click()" class="ism-btns btn-save">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </button>
                                        </td>

                                    </tr>
                                    <tr ng-repeat="x in tsdt_list">
                                        <td>{{$index+1}} </td>
                                        <td>
                                            <input  type="text" class="old_page_inputs" ng-model="x.dsdt_dsqty" name="itemlistdsdt" id="dsdt_dsqty_{{$index+1}}" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="x.dsdt_drawingno" name="itemlistdsdt" id="dsdt_drawingno_{{$index+1}}" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="x.dsdt_description" name="itemlistdsdt" id="dsdt_description_{{$index+1}}" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="x.dsdt_remarks" name="itemlistdsdt" id="dsdt_remarks_{{$index+1}}" autocomplete="off" />
                                        </td>
                                        <td>
                                            <i class="fa fa-times" style="color:red" ng-click="remove_items($index)"></i>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="width: 1200px;">
                                <tbody>
                                    <tr>
                                        <td>Submitted By</td>
                                        <td style="width: 794px;">
                                            <input style="width: 300px;" type="text" class="old_page_inputs" ng-model="ts.data.ds_submittedby" name="ds_submittedby" id="ds_submittedby" autocomplete="off" />
                                        </td>
                                        <td>Date</td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="ts.data.ds_submitteddate" name="ds_submitteddate" id="ds_submitteddate" autocomplete="off" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist track by $index" style="width: 1200px;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="width: 1107px;background: #dbdbdb;font-style: italic;font-weight: 700;">Customer Remarks</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" class="old_page_inputs" ng-model="tscommands" name="tscommands" id="tscommands" autocomplete="off" ng-keydown="tscommands_keydown($event)" />
                                        </td>
                                    </tr>
                                    <tr ng-repeat="x in ts.commands">
                                        <td style="width:80px">
                                            <div>
                                                <i class="fa fa-trash" style="color:red" ng-click="removecommand($index)"></i>
                                                {{$index+1}}
                                            </div>
                                        </td>
                                        <td>
                                            {{x}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bottomsavebtn" style="width: 93.4%;">
                            <button ng-disabled="ts.isloading" type="button" class="ism-btns btn-save" ng-click="save_ts()">
                                <i ng-if="!ts.isloading" class="fa fa-check"></i>
                                <i ng-if="ts.isloading" class="fa fa-cog fa-spin"></i>
                                Save & Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
