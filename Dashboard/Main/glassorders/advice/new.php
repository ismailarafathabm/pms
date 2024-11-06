<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
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
include_once './../purchase/nst.php';
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
                PAYMENT ADVICE
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" ng-show="!refok">
                                <tbody>
                                    <tr>
                                        <td>
                                            PO REF NO #
                                        </td>
                                        <td style="width:250px">
                                            <select class="old_page_inputs" ng-model="srcrefno" id="src_refno" name="src_refno" required>
                                                <option value="">-Select-</option>
                                                <option ng-repeat="x in porefnolist" value="{{x}}">{{x}}</option>
                                            </select>

                                        <td>
                                            <button class="ism-btns btn-save" style="padding: 0.5em;" ng-click="loadponewinfo()" ng-disabled=" srcrefno === undefined || srcrefno === ''">
                                                <i class="fa fa-search">
                                                </i>
                                                Search
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div ng-show="isloading" style="
                                    width: 100%;
                                    height: 100px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                <i class="fa fa-cog fa-spin" style="font-size: 50px"></i>
                            </div>
                            <div ng-show="refok">
                                <table class="old_table itemlist">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" style="font-weight:bold">
                                                PO - INFORMATIONS
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:160px;text-align: right;">Ref#</td>
                                            <td style="width:240px;font-style:italic;font-weight:bold;color:#d30000">{{po.ponewrefno}}</td>
                                            <td style="width:160px;text-align: right;">Date</td>
                                            <td style="width:240px">{{po.ponewdate_d}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;text-align: right;">Supplier</td>
                                            <td style="width:240px;font-style:italic;">{{po.glasssuppliername | uppercase}}</td>
                                            <td style="width:100px;text-align: right;">Attn</td>
                                            <td style="width:240px">{{po.suppliercontact}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;text-align: right;">From</td>
                                            <td colspan="3">{{po.ponewfrom}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="font-weight:bold">PAYMENT ADVICE</td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;text-align: right;">Date</td>
                                            <td>
                                                <input class="old_page_inputs" type="text" name="padvancedate" id="padvancedate" ng-model="padvice.padvancedate" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" required />
                                            </td>
                                            <td style="width:100px;text-align: right;">To</td>
                                            <td>
                                                <input class="old_page_inputs" type="text" name="padviceto" id="padviceto" ng-model="padvice.padviceto" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;text-align: right;">Payment By</td>
                                            <td>
                                                <select class="old_page_inputs" type="text" name="paymenttype" id="paymenttype" ng-model="padvice.paymenttype" required>
                                                    <option value="">Select</option>
                                                    <option value="Payment By Cheque">Payment By Cheque</option>
                                                    <option value="Cash Payment">Cash Payment</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </td>
                                            <td style="width:100px;text-align: right;">Payment Amount</td>
                                            <td>
                                                <input class="old_page_inputs" type="text" name="paymentamount" id="paymentamount" ng-model="padvice.paymentamount" required />
                                            </td>
                                        </tr>
                                        <tr ng-show="padvice.paymenttype === 'Others'">
                                            <td style="width:160px;text-align: right;">
                                                Payment Description
                                            </td>
                                            <td colspan="3">
                                                <input class="old_page_inputs" type="text" name="padvicetypedescription" id="padvicetypedescription" ng-model="padvice.padvicetypedescription" ng-required="padvice.paymenttype === 'Others'" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;text-align: right;">Currency Type</td>
                                            <td>
                                                <input class="old_page_inputs" type="text" name="paymentcountry" id="paymentcountry" ng-model="padvice.paymentcountry" required />
                                            </td>
                                            <td style="width:100px;text-align: right;">
                                                %
                                            </td>
                                            <td>
                                                <input class="old_page_inputs" type="text" name="paymentpersent" id="paymentpersent" ng-model="padvice.paymentpersent" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:130px;text-align: right;">Notes</td>
                                            <td colspan="3">
                                                <input class="old_page_inputs" type="text" name="paydescriptions" id="paydescriptions" ng-model="padvice.paydescriptions" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="bottomsavebtn" style="margin-top:10px">
                                    <button type="button" class="ism-btns btn-save" ng-click="save_ponew()" style="margin-right: 130px;">
                                        <i class="fa fa-check"></i>
                                        Save & Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>