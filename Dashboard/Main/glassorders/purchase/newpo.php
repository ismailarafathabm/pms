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
                Purchase Form
                </i>
            </div>
            <div class="ism-new-page-header-page-buttons">

            </div>
        </div>
        <div style="overflow: auto;border: 1px solid #d9d9d9;    height: 100%;">
            <i ng-show="isrptloading" class="fa fa-cog fa-spin pageloader"></i>
            <form autocomplete="off" ng-submit="posave_submit()" name="save_po" id="po_save" ng-show="!pgonew.isloading" style="margin-bottom:50px;">
                <div class="ism-pms-dialog-body">
                    <div class="ism-pms-dialog-body-rows" style="width: 900px;overflow:hidden;margin:5px 0 20px 0;height:auto;max-height:100%">
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Ref.No</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="porefno" id="porefno" ng-model="po.data.porefno" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="podate" id="podate" ng-model="po.data.podate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Material Type</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <select name="itemtype" id="itemtype" ng-model="po.data.itemtype" class="ism-dialog-rows-input-controller" required >
                                    <option value="">-select-</option>
                                    <option ng-repeat="x in materiallist" value="{{x}}">{{x}}</option>
                                    <option value="Glass">Glass</option>
                                </select>                               
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 300px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <select name="posupplier" id="posupplier" ng-model="search.posupplier" class="ism-dialog-rows-input-controller" required ng-change="getsupplierinfo()">
                                    <option value="">-select-</option>
                                    <option ng-repeat="x in supplierlist" value="{{x.glasssupplierid}}">{{x.glasssuppliername}}</option>
                                   
                                </select>
                                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewsupplier()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 300px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Address</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="posupplieraddress" id="posupplieraddress" ng-model="po.data.posupplieraddress" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Kind Attn:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="poattenby" id="poattenby" ng-model="po.data.poattenby" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Description:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="podescription" id="podescription" ng-model="po.data.podescription" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 160px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Qty:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="poqty" id="poqty" ng-model="po.data.poqty" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 160px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Tonnage:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="poweight" id="poweight" ng-model="po.data.poweight" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 160px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Area:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="poarea" id="poarea" ng-model="po.data.poarea" class="ism-dialog-rows-input-controller" required  ng-change="calc()"/>
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 160px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Unit Price:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="pounitprice" id="pounitprice" ng-model="po.data.pounitprice" class="ism-dialog-rows-input-controller" required  ng-change="calc()"/>
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 160px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Value :</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <input name="povalue" id="povalue" ng-model="po.data.povalue" class="ism-dialog-rows-input-controller" required />
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Notes:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <textarea name="ponotes" rows="3" id="ponotes" ng-model="po.data.ponotes" class="ism-dialog-rows-input-controller">
                                </textarea>
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Payment Terms:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <textarea name="popaymentterms" rows="3" id="popaymentterms" ng-model="po.data.popaymentterms" class="ism-dialog-rows-input-controller">
                                </textarea>
                            </div>
                        </div>
                        <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                            <div class="ism-dialog-body-rows-input-container-lable">Delivery Terms:</div>
                            <div class="ism-dialog-body-rows-input-container-input ">
                                <textarea name="podeliveryterms" rows="3" id="podeliveryterms" ng-model="po.data.podeliveryterms" class="ism-dialog-rows-input-controller">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ism-pms-dialog-footer"  style="width: 900px">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="po.isloading || save_po.$invalid">
                    {{po.btn}} & Print
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_glassbudget').style.display='none'">
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

<?php
include_once '../procurement/models/supplier.php';
?>