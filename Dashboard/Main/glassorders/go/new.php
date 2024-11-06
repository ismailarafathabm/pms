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
                NEW GLASS ORDER
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
                                        <td>Ref</td>
                                        <td>
                                            <span style="
                                            font-weight: bold;
                                            color: #af0000;
                                            margin-right: 7px;
                                            ">NAF/ENGG/</span><input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.porefno" name="porefno" id="porefno" autocomplete="off" style="width: 223px;" />
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
                                            <select class="old_page_inputs" ng-model="po.potype" name="potype" id="potype" required style="width: 180px;">
                                            <option value="">-Select-</option>
                                            <option value="Glass">Glass</option>
                                              
                                            </select>
                                        </td>
                                    </tr>                                    
                                </thead>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <thead>
                                    <tr>
                                        <th> Remove </th>
                                        <th> S.NO </th>
                                        <th style="width:200px"> Thickness </th>
                                        <th style="width:200px"> out </th>
                                        <th style="width:200px"> Inner </th>
                                        <th style="width:150px"> Coating </th>                                                                                
                                        <th style="width:100px"> Area <input type="checkbox" ng-model="calcbyarea" ng-change="changecalcmethod('a')"></th>
                                        <th style="width:100px">QTY <input type="checkbox" ng-model="calcbyqty" ng-change="changecalcmethod('q')"></th>
                                        <th style="width:100px"> Unit Price </th>
                                        <th style="width:100px"> Total Price </th>
                                    </tr>
                                    <tr>
                                        <td></td> 
                                        <td></td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="additem.description" name="description" id="description" autocomplete="off" ng-keydown="foucschange($event,'d')" />
                                        </td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="additem.description" name="description" id="description" autocomplete="off" ng-keydown="foucschange($event,'d')" />
                                        </td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="additem.description" name="description" id="description" autocomplete="off" ng-keydown="foucschange($event,'d')" />
                                        </td>
                                        <td>
                                            <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="additem.description" name="description" id="description" autocomplete="off" ng-keydown="foucschange($event,'d')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="additem.qty" name="qty" id="qty" autocomplete="off" ng-keydown="foucschange($event,'q')" />

                                        </td>                             
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="additem.area" name="area" id="area" autocomplete="off" ng-keydown="foucschange($event,'a')" />

                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="additem.unitprice" name="unitprice" id="unitprice" autocomplete="off" ng-change="calc_unitprice()" ng-keydown="foucschange($event,'u')" />
                                        </td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="additem.totalprice" name="totalprice" id="totalprice" autocomplete="off" ng-keydown="foucschange($event,'t')" />
                                        </td>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="x in polist">
                                        <td>
                                            <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removeItem($index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{$index+1}}</td>
                                        <td>{{x.description}}</td>
                                        <td style="text-align:center">{{(+x.qty) === 0 ? '-' : x.qty}}</td>                                        
                                        <td style="text-align:center">{{(+x.area) === 0 ? '-' : (+x.area).toLocaleString(3)}}</td>
                                        <td style="text-align:right">{{(+x.unitprice) === 0 ? '-' : (+x.unitprice).toLocaleString(2)}}</td>
                                        <td style="text-align:right">{{(+x.totalprice) === 0 ? '-' : (+x.totalprice).toLocaleString(2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:right">Total</td>
                                        <td style="text-align:center">{{(+itemtotqty) === 0 ? '-' : itemtotqty}}</td>                                        
                                        <td style="text-align:center">{{(+itemtotarea) === 0 ? '-' : (+itemtotarea).toLocaleString(3)}}</td>
                                        <td></td>
                                        <td style="text-align:right">{{(+itemstotal) === 0 ? '-' : (+itemstotal).toLocaleString(2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align:right">VAT</td>
                                        <td>
                                            <div style="
                                            display: flex;
                                            flex-direction: row;
                                            align-items: center;
                                            justify-content: flex-start;
                                            gap: 3px;
                                            ">
                                                <input type="text" class="old_page_inputs" ng-model="povatval" name="povatval" id="povatval" ng-change="povatvalcalc()" autocomplete="off" style="width:30px" />%
                                            </div>
                                        </td>
                                        <td style="text-align:right">{{(+vatval) === 0 ? '-' : (+vatval).toLocaleString(2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align:right">Total Amount</td>

                                        <td style="text-align:right">{{(+itemssubttotal) === 0 ? '-' : (+itemssubttotal).toLocaleString(2)}}</td>
                                    </tr>
                                    <tr>
                                    <td style="text-align:right">NOTE </td>
                                    <td colspan="7">
                                        <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.podescription" name="podescription" id="podescription" autocomplete="off" />
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                        <div class="bottomsavebtn" >
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