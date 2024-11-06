<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
$username = $_SESSION['nafco_alu_user_name'];

include_once '../../../../conf.php';
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
include_once '../../menu.php';
include_once '../purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../procurement/st.php';
?>

<div class="sub-body" style="margin-top: 100px;height: calc(100vh - 130px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                NEW GLASS ORDER RELEASE
            </div>
            <div class="sub-container-right">

            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td>Glass Order No</td>
                                        <td>
                                            <span>NAF/ENGG/</span>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonorderno" name="gonorderno" id="gonorderno" autocomplete="off" style="width:158px" />
                                        </td>
                                        <td>Done By</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gondoneby" name="gondoneby" id="gondoneby" autocomplete="off" style="width:230px" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Relesed To Purchase</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonrelesetopurcahse" name="gonrelesetopurcahse" id="gonrelesetopurcahse" autocomplete="off" style="width:230px" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase" />
                                        </td>
                                        <td>Received Form Purchase</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonrecivedfrompurchase" name="gonrecivedfrompurchase" id="gonrecivedfrompurchase" autocomplete="off" style="width:230px" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasefrompurcahse" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td colspan="3">
                                            <select name="gonsupplier" id="gonsupplier" ng-model="gonew.data.gonsupplier" required class="old_page_inputs" style="width:280px" ng-change="getsupplierinfo()">
                                                <option value="">-Select-</option>
                                                <option ng-repeat="x in supplierlist" value="{{x.glasssupplierid}}">{{x.glasssuppliername}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Glass Type</td>
                                        <td colspan="3">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonglasstype" name="gonglasstype" id="gonglasstype" autocomplete="off" style="width:400px" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Glass Description</td>
                                        <td colspan="3">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonglassspc" name="gonglassspc" id="gonglassspc" autocomplete="off" style="width:600px" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Marking Location</td>
                                        <td colspan="3">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonmakringlocation" name="gonmakringlocation" id="gonmakringlocation" autocomplete="off" style="width:600px" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonqty" name="gonqty" id="gonqty" autocomplete="off" style="width:230px" />
                                        </td>
                                        <td>Remarks</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="gonew.data.gonremark" name="gonremark" id="gonremark" autocomplete="off" style="width:230px" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bottomsavebtn" style="width: 60%;">
                            <button  ng-disabled="gonew.isloading" type="button" class="ism-btns btn-save" ng-click="save_ponew()">
                                <i ng-if="!gonew.isloading" class="fa fa-check"></i>
                                <i ng-if="gonew.isloading" class="fa fa-cog fa-spin"></i>
                                {{gonew.btn}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>