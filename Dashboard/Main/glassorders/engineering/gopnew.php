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
                NEW GLASS ORDER SUMMARY
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
                                        <td colspan="3">
                                            <select name="gonp_goid" id="gonp_goid" ng-model="gopn.data.gonp_goid" required class="old_page_inputs" style="width:280px" ng-change="getgoinfo()">
                                                <option value="">-Select-</option>
                                                <option ng-repeat="x in golist" value="{{x.gonewid}}">{{x.gonorderno}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Glass Type</td>
                                        <td style="width:220px">{{currentglass.gonglasstype}}</td>
                                        <td>Glass Specification</td>
                                        <td style="width:220px">{{currentglass.gonglassspc}}</td>
                                    </tr>
                                    <tr>
                                        <td>Done By</td>
                                        <td style="width:220px">{{currentglass.gondoneby}}</td>
                                        <td>Released Date</td>
                                        <td style="width:220px">{{currentglass.gonrelesetopurcahse_d}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td style="width:120px">Date</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_date" name="gonp_date" id="gonp_date" autocomplete="off" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase" />
                                        </td>
                                        <td style="width:120px">Order Type</td>
                                        <td style="width:230px">
                                            <select name="gonp_type" id="gonp_type" ng-model="gopn.data.gonp_type" required class="old_page_inputs" style="width:86px">
                                                <option value="">-Select-</option>
                                                <option value="GO">GO</option>
                                                <option value="S">S</option>
                                                <option value="BK">BK</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td style="width:230px">
                                            <select name="gonp_supplier" id="gonp_supplier" ng-model="gopn.data.gonp_supplier" required class="old_page_inputs" ng-change="getsupplierinfo()">
                                                <option value="">-Select-</option>
                                                <option ng-repeat="x in supplierlist" value="{{x.glasssupplierid}}">{{x.glasssuppliername}}</option>
                                            </select>
                                        </td>
                                        <td style="width:120px">ETA</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_eta" name="gonp_eta" id="gonp_eta" autocomplete="off" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coatings</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_gcotting" name="gonp_gcotting" id="gonp_gcotting" autocomplete="off" />
                                        </td>
                                        <td>Thickness</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_gthk" name="gonp_gthk" id="gonp_gthk" autocomplete="off" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Out</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_gout" name="gonp_gout" id="gonp_gout" autocomplete="off" />
                                        </td>
                                        <td>Inner</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_gin" name="gonp_gin" id="gonp_gin" autocomplete="off" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_qty" name="gonp_qty" id="gonp_qty" autocomplete="off" />
                                        </td>
                                        <td>Sqm</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_area" name="gonp_area" id="gonp_area" autocomplete="off" ng-change="calsum()"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price Per Sqm</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_ppsqm" name="gonp_ppsqm" id="gonp_ppsqm" autocomplete="off" ng-change="calsum()"/>
                                        </td>
                                        <td>Total</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_pptotal" name="gonp_pptotal" id="gonp_pptotal" autocomplete="off" ng-change="calsum()" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Extra</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_ppextra" name="gonp_ppextra" id="gonp_ppextra" autocomplete="off" ng-change="calsum()"/>
                                        </td>
                                        <td>Final Price</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gofinal" name="gofinal" id="gofinal" autocomplete="off" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_location" name="gonp_location" id="gonp_location" autocomplete="off" />
                                        </td>
                                        <td>Remarks</td>
                                        <td style="width:230px">
                                            <input type="text" class="old_page_inputs" ng-model="gopn.data.gonp_remarks" name="gonp_remarks" id="gonp_remarks" autocomplete="off" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bottomsavebtn" style="width: 54.5%;">
                            <button ng-disabled="gopn.isloading" type="button" class="ism-btns btn-save" ng-click="save_ponew()">
                                <i ng-if="!gopn.isloading" class="fa fa-check"></i>
                                <i ng-if="gopn.isloading" class="fa fa-cog fa-spin"></i>
                                {{gopn.btn}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>