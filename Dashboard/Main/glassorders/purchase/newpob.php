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
include_once '../../masterlog/st.php';
include_once '../procurement/st.php';
?>
<div class="sub-body">
    <div class="sub-body-container" style="margin-top: 100px;padding:0;overflow:hidden; font-family: 'roboto',sans-serif;font-size : 1rem;height:calc(100vh - 140px)">
        <div class="ism-loaderdiv-new" ng-show="isrptloading">
            <div class="ism-loader-container">
                <i class="fa fa-cog fa-spin" style="font-size:80px;color:darkblue"></i>
            </div>
        </div>
        <div class="ism-new-page-headers">
            <div class="ism-new-page-header-page-title">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Purchase Order Budget Form
                </i>
            </div>
            <div class="ism-new-page-header-page-buttons">

            </div>
        </div>
        <div style="overflow: auto;border: 1px solid #d9d9d9;    height: 100%;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <div ng-show="!refok">
                <form autocomplete="off" ng-submit="search_refno_submit()" name="search_refno" id="refno_search" ng-show="!posrc.isloading" style="margin-bottom:50px;">
                    <div class="ism-pms-dialog-body">
                        <div class="ism-pms-dialog-body-rows" style="width: 500px;overflow:hidden;margin:5px 0 20px 0;height:auto;max-height:100%">
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Ref.No</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <select name="porefno" id="porefno" ng-model="posrc.data.porefno" class="ism-dialog-rows-input-controller" required>
                                        <option value="">-Select-</option>
                                        <option ng-repeat="x in porefnolist" value="{{x}}">{{x}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ism-pms-dialog-footer" style="width: 500px">

                        <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="posrc.isloading || search_refno.$invalid">
                            Search
                        </button>
                        <div class="{{res.theme}}" ng-show="res.display">
                            <i class="{{res.icon}}"></i>
                            <span>{{res.msg}}</span>
                        </div>
                    </div>

                </form>
            </div>
            <div ng-show="refok">
                <form autocomplete="off" ng-submit="pob_submit()" name="save_pob" id="pob_save" ng-show="!pob.isloading" style="margin-bottom:50px;">
                    <div class="ism-pms-dialog-body">
                        <div class="ism-pms-dialog-body-rows" style="width: 500px;overflow:hidden;margin:5px 0 20px 0;height:auto;max-height:100%">
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Ref.No</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobprefno" id="pobprefno" ng-model="pob.data.pobprefno" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobdate" id="pobdate" ng-model="pob.data.pobdate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="supplier" id="supplier" ng-model="pob.data.supplier" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Address</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="supplierarray" id="supplierarray" ng-model="pob.data.supplierarray" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Order Type</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <select name="pobtype" id="pobtype" ng-model="pob.data.pobtype" class="ism-dialog-rows-input-controller">
                                        <option value="">-Select-</option>
                                        <option value="international po">International PO</option>
                                        <option value="local po">Local PO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Material Type</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobtypet" id="pobtypet" ng-model="pob.data.pobtypet" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Qty /Area/ Tonnage</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobqty" id="pobqty" ng-model="pob.data.pobqty" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Budget Total</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobtotbudget" id="pobtotbudget" ng-model="pob.data.pobtotbudget" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Previous Order</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobprvalue" id="pobprvalue" ng-model="pob.data.pobprvalue" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Value Of This Order</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobcvalue" id="pobcvalue" ng-model="pob.data.pobcvalue" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                            <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                                <div class="ism-dialog-body-rows-input-container-lable">Balance Available Budget</div>
                                <div class="ism-dialog-body-rows-input-container-input ">
                                    <input name="pobbmprice" id="pobbmprice" ng-model="pob.data.pobbmprice" class="ism-dialog-rows-input-controller" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-footer" style="width: 500px">
                       
                        <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="posrc.isloading || save_po.$invalid">
                            Save & Print
                        </button>
                        <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="location.reload()">
                            Close
                        </button>
                        <div class="{{res.theme}}" ng-show="res.display">
                            <i class="{{res.icon}}"></i>
                            <span>{{res.msg}}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>