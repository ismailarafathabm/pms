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
$price_access = ['superadmin', 'engineering','Management', 'engineeringuser'];
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
                Technical Submital
            </div>
            <div class="sub-container-right">

            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <!-- submital informations -->
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
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
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_number" name="techsub_number" id="techsub_number" autocomplete="off" />
                                        </td>
                                        <td style="width:135px">
                                            Revision No
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_rvno" name="techsub_rvno" id="techsub_rvno" autocomplete="off" />
                                        </td>
                                        <td style="width:135px">
                                            Date
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_date" name="techsub_date" id="techsub_date" autocomplete="off" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase" />
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
                            <table class="old_table itemlist">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th style="width:80px">Qty</th>
                                        <th style="width:150px">Dwg. / Spec. Reference</th>
                                        <th style="width:450px">Description</th>
                                        <th style="width:380px">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_qty" name="techsub_qty" id="techsub_qty" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_spctype" name="techsub_spctype" id="techsub_spctype" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_description" name="techsub_description" id="techsub_description" ng-keyup="addnewitemslist_keydown_maintable($event)" autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_remarksdt" name="techsub_remarksdt" id="techsub_remarksdt" autocomplete="off" ng-keyup="addnewitemslist_keydown_maintable($event)" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bottomsavebtn" style="width: 86.4%;">
                            <button type="button" class="ism-btns btn-save" ng-click="addsubitems()">
                                <i class="fa fa-plus"></i>
                                Add Items
                            </button>
                        </div>

                        <div class="old_pgm_fitbox">
                            <div ng-repeat="x in mainitemlist track by $index" style="border: 1px solid #cdcdcd;padding: 5px;margin-bottom: 2px;width: 86.4%;">
                                <div style="padding: 5px;margin-bottom: 2px;width: auto;border-bottom: 1px solid #595959;">
                                    {{$index+1}}  ).
                                    <span key="{{$index}}">
                                        <input type="text" ng-model="x.mainitem" class="old_page_inputs" style="width: 600px;color: #000;font-weight: 600;" ng-keyup="addcategoryforthisitem($event,x)"/>
                                    </span>
                                    <i class="fa fa-times" style="color:red;margin-left:10px" ng-click="removemainitem($index)"></i>
                                </div>
                                <div ng-repeat="y in x.categorylist track by $index">
                                    <div style="margin-left:50px;padding: 5px;margin-bottom: 2px;width: auto;border-bottom: 1px solid #595959;margin-bottom: 5px;">
                                        {{$index+1}}).
                                        <span key="{{$index}}">
                                            <input type="text" ng-model="y.categoryname" class="old_page_inputs" style="width: 600px;color: #00209d;font-weight: 600;" ng-keyup="addsubcategoryforthiscategory($event,x,y)"/>
                                        </span>
                                        <i class="fa fa-times" style="color:red;margin-left:10px" ng-click="removesubitemlist(x,$index)"></i>
                                    </div>
                                    <div ng-repeat="z in y.subcategorylist track by $index">
                                        <div style="margin-left:110px;padding: 5px;margin-bottom: 2px;width: auto;    border-bottom: 1px solid #595959;margin-bottom: 5px;">
                                            {{$index+1}}).                                            
                                            <span key="{{$index}}">
                                                <input type="text" ng-model="z.name" class="old_page_inputs" style="width: 600px;color: #e50000;font-weight: 600;" ng-keydown="addnewsubitemthiscategory($event,x,y)"/>
                                            </span>
                                            <i class="fa fa-times" style="color:red;margin-left:10px" ng-click="removesubcategroyitemlist(x,y,$index)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <ol>
                                <li ng-repeat="">
                                    {{x.mainitem}}
                                </li>
                                <li>
                                    <ol>
                                        <li ng-repeat="y in x.categorylist">
                                            {{y.categoryname}}
                                        </li>
                                        <li> 
                                            <ol ng-repeat="z in y.subitemsubsystemlist">
                                                <li>{{z.name}}</li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol> -->
                        </div>

                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td>Submitted By</td>
                                        <td style="width: 794px;">
                                            <input style="width: 300px;" type="text" class="old_page_inputs" ng-model="ts.data.techsub_submittedby" name="techsub_submittedby" id="techsub_submittedby" autocomplete="off" />
                                        </td>
                                        <td>Date</td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="ts.data.techsub_subdate" name="techsub_subdate" id="techsub_subdate" autocomplete="off" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist track by $index">
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

                        <div class="bottomsavebtn" style="width: 86.4%;">
                            <button ng-disabled="ts.isloading" type="button" class="ism-btns btn-save" ng-click="save_ts()">
                                <i ng-if="!ts.isloading" class="fa fa-check"></i>
                                <i ng-if="ts.isloading" class="fa fa-cog fa-spin"></i>
                                {{btntitle}}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'items.php';

?>