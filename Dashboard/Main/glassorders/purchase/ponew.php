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
include_once './nst.php';
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
                Purcahse Order
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
                                <thead>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">
                                           
                                            <input type="radio" value="1" ng-model="po.ordertype"/>
                                            <label>For Project</label>
                                            |
                                            <input type="radio" value="2" ng-model="po.ordertype"/>
                                            <label>Sample</label>
                                        </td>
                                    </tr>
                                    <tr ng-show="(+po.ordertype) !== 1">
                                        <td>Projet NO</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.projectno" name="projectno" id="projectno" autocomplete="off" style="width: 300px;" />
                                        </td>
                                        <td>Location</td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.projectlocation" name="projectlocation" id="projectlocation" autocomplete="off" style="width: 300px;" />
                                        </td>
                                    </tr>
                                    <tr ng-show="(+po.ordertype) !== 1">
                                        <td>Project</td>
                                        <td colspan="3">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.projectname" name="projectname" id="projectname" autocomplete="off"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Matierla Type</td>
                                        <td colspan="3">
                                            <select class="old_page_inputs" ng-model="po.potype" name="potype" id="potype" required style="width:230px" ng-change="selectsuppliers($event)">
                                                <option value="">-Select-</option>
                                                <option value="Glass">Glass</option>
                                                <option value="consumables">consumables</option>
                                                <option ng-repeat="x in materiallist" value="{{x}}">{{x}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ref</td>
                                        <td ng-if="po.potype === 'Glass'">
                                            <span ng-show="po.potype === 'Glass'">NAF/ENGG/</span><input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.porefno" name="porefno" id="porefno" autocomplete="off" style="width:230px" />
                                        </td>
                                        <td ng-if="po.potype !== 'Glass'">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.porefno" name="porefno" id="porefno" autocomplete="off" style="width:300px;" />
                                        </td>
                                        <td>Date</td>
                                        <td>
                                            <div>
                                                <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.podate" name="podate" id="podate" autocomplete="off" style="width: 175px;" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td style="width:400px">
                                            <div style="display:flex;gap:5px">
                                                <select name="posupplier" id="posupplier" ng-model="po.posupplier" required class="old_page_inputs" style="width:280px" ng-change="getsupplierinfo()">
                                                    <option value="">-Select-</option>
                                                    <option ng-repeat="x in supplierlist" value="{{x.glasssupplierid}}">{{x.glasssuppliername}}</option>
                                                </select>
                                                <button class="ism-btns btn-save" style="padding: 2px 2px;" ng-click="addnewsupplier()">
                                                    <i class="fa fa-plus" style="margin-right: 0 !important"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>Atten</td>
                                        <td style="width:400px">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.atten" name="atten" id="atten" autocomplete="off" style="width: 300px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td style="width:400px">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.address" name="address" id="address" autocomplete="off" style="width: 300px;" />
                                        </td>
                                        <td>Fax</td>
                                        <td style="width:400px">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.fax" name="fax" id="fax" autocomplete="off" style="width: 150px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>From</td>
                                        <td style="width:400px">
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.pofrm" name="pofrm" id="pofrm" autocomplete="off" style="width: 300px;" />
                                        </td>
                                        <td>Material Type</td>
                                        <td style="width:400px">

                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?php
                        include_once 'mat.php';
                        include_once 'glass.php';
                        ?>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td style="width:120px">Payment Terms</td>
                                        <td><input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="paymentterms" name="paymentterms" id="paymentterms" autocomplete="off" style="width: 741px;" /></td>
                                        <td>
                                            <button type="button" class="ism-btns btn-save" ng-click="addtopaymentterms()">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr ng-repeat="x in paymenttermslist">
                                        <td>{{$index+1}}</td>
                                        <td>{{x.terms}}</td>
                                        <td>
                                            <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removepaymenttermsItem($index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td style="width:120px">Delivery Terms</td>
                                        <td><input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="deliveryterms" name="deliveryterms" id="deliveryterms" autocomplete="off" style="width: 741px;" /></td>
                                        <td>
                                            <button type="button" class="ism-btns btn-save" ng-click="addtodeliveryterms()">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr ng-repeat="x in deliverytermslist">
                                        <td>{{$index+1}}</td>
                                        <td>{{x.terms}}</td>
                                        <td>
                                            <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removedeleiveryItem($index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bottomsavebtn">
                            <button type="button" class="ism-btns btn-save" ng-click="save_ponew()">
                                <i class="fa fa-check"></i>
                                Save
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once '../procurement/models/supplier.php'
?>