<div class="ism-pms-dialog" ng-if="prupdate.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                {{prupdate.title}}
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!prupdate.isloading" ng-click="prupdate.diashow  = false;">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="prupdate.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="procuremnetudpate_submit()" name="updateprocurement" id="procurementudpate" ng-show="!prupdate.isloading">
            <div class="ism-pms-dialog-body">

                <div class="ism-pms-dialog-body-rows">
                    <table class="naf-tables">
                        <tr>
                            <td style="background:#e7e7e7">Type</td>
                            <td colspan="5"><input type="radio" value="GO" ng-model="prupdate.data.goreceipttype" /> GO | <input type="radio" value="S" ng-model="prupdate.data.goreceipttype" />SAMPLE | <input type="radio" value="RO" ng-model="prupdate.data.goreceipttype" /> Re-Order | <input type="radio" value="BK" ng-model="prupdate.data.goreceipttype" />BROKEN | <input type="radio" value="Missing Item" ng-model="prupdate.data.goreceipttype" />Missing </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Order Placed Date</td>
                            <td>
                                <div>
                                    <input placeholder="dd-mm-YYYY" name="procurement_orderdate" id="procurement_orderdate" ng-model="prupdate.data.procurement_orderdate" class="old_page_inputs" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="procurement_orderdate" required />
                                </div>
                            </td>
                            <td style="background:#e7e7e7">Invoice Number</td>
                            <td><input name="invoiceno" id="invoiceno" ng-model="prupdate.data.invoiceno" class="old_page_inputs" required /></td>
                            <td style="background:#e7e7e7">Supplier</td>
                            <td>
                                <input list="gosuppliers" name="procurement_supplier" id="procurement_supplier" ng-model="prupdate.data.procurement_supplier" class="old_page_inputs" required />
                                <datalist id="gosuppliers">
                                    <option ng-repeat="x in autoCompleate.suppliers" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Specification</td>
                            <td colspan="5">
                                <textarea name="goglassspec" id="goglassspec" ng-model="prupdate.data.goglassspec" class="old_page_inputs" required readonly rows="3">
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">ETA</td>
                            <td><input name="proucrementeta" id="proucrementeta" ng-model="prupdate.data.proucrementeta" class="old_page_inputs" required /></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Coatings</td>
                            <td>
                                <input list="gocoatings" name="procurement_coating" id="procurement_coating" ng-model="prupdate.data.procurement_coating" class="old_page_inputs" required />
                                <datalist id="gocoatings">
                                    <option ng-repeat="x in autoCompleate.coatings" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>
                            <td style="background:#e7e7e7">Thickness</td>
                            <td>
                                <input list="gotikness" name="procurement_thickness" id="procurement_thickness" ng-model="prupdate.data.procurement_thickness" class="old_page_inputs" required />
                                <datalist id="gotikness">
                                    <option ng-repeat="x in autoCompleate.thikness" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>
                            <td style="background:#e7e7e7">U-Insert</td>
                            <td>
                                <input list="uinsers" name="uinsert" id="uinsert" ng-model="prupdate.data.uinsert" class="old_page_inputs" required />
                                <datalist id="uinsers">
                                    <option ng-repeat="x in autoCompleate.uinserts" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>

                        </tr>

                        <tr>

                            <td style="background:#e7e7e7">Outer</td>
                            <td colspan="2">
                                <input list="gooutter" name="procurement_out" id="procurement_out" ng-model="prupdate.data.procurement_out" class="old_page_inputs" required />
                                <datalist id="gooutter">
                                    <option ng-repeat="x in autoCompleate.outters" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>
                            <td style="background:#e7e7e7">Inner</td>
                            <td colspan="2">
                                <input list="goinners" name="procurement_inner" id="procurement_inner" ng-model="prupdate.data.procurement_inner" class="old_page_inputs" required />
                                <datalist id="goinners">
                                    <option ng-repeat="x in autoCompleate.inners" value="{{x}}">{{x}}</option>
                                </datalist>
                            </td>
                        </tr>
                        <tr>

                            <td style="background:#e7e7e7">
                                Qty
                            </td>
                            <td colspan="2">
                                <input name="goqty" id="goqty" ng-model="prupdate.data.procurement_qty" class="old_page_inputs" required ng-change="calcprices()" />
                            </td>
                            <td style="background:#e7e7e7">Area</td>
                            <td colspan="2">
                                <input name="goarea" id="goarea" ng-model="prupdate.data.procurement_area" class="old_page_inputs" required ng-change="calcprices()" />
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Unit Price</td>
                            <td>
                                <input name="procurment_orderunitprice" id="procurment_orderunitprice" ng-model="prupdate.data.procurment_orderunitprice" class="old_page_inputs" ng-change="calcprices()" required />
                            </td>
                            <td style="background:#e7e7e7">Others</td>
                            <td>
                                <input name="procurement_otherprice" id="procurement_otherprice" ng-model="prupdate.data.procurement_otherprice" class="old_page_inputs" ng-change="calcprices()" required />
                            </td>
                            <td style="background:#e7e7e7">Total</td>
                            <td>
                                <input name="procurement_totalprice" id="procurement_totalprice" ng-model="prupdate.data.procurement_totalprice" class="old_page_inputs" readonly required />
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Remarks</td>
                            <td colspan="5">
                                <textarea name="procurementremark" id="procurementremark" ng-model="prupdate.data.procurementremark" class="old_page_inputs" required rows="3">
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#e7e7e7">Location</td>
                            <td colspan="2">
                                <select name="dellocation" id="dellocation" ng-model="prupdate.data.dellocation" class="old_page_inputs" required>
                                    <option value="">-Select-</option>
                                    <option value="Factory">Factory</option>
                                    <option value="Site">Site</option>
                                </select>
                            </td>
                            <td style="background:#e7e7e7">Work Order No</td>
                            <td colspan="2">
                                <input name="workorderno" id="workorderno" ng-model="prupdate.data.workorderno" class="old_page_inputs" required />
                            </td>
                        </tr>

                        <tr ng-show="prupdate.data.goreceipttype === 'RO'">
                            <td style="background:#e7e7e7">Description</td>
                            <td colspan="5">
                                <input name="broken_description" id="broken_description" ng-model="prupdate.data.broken_description" class="old_page_inputs" ng-required="prupdate.data.goreceipttype === 'RO'" />
                            </td>
                        </tr>
                        <tr ng-show="prupdate.data.goreceipttype === 'RO'">
                            <td style="background:#e7e7e7">Engineer Name</td>
                            <td colspan="5">
                                <input name="broken_engg" id="broken_engg" ng-model="prupdate.data.broken_engg" class="old_page_inputs" ng-required="prupdate.data.goreceipttype === 'RO'" />
                            </td>
                        </tr>
                        <tr ng-show="prupdate.data.goreceipttype === 'BK' || prupdate.data.goreceipttype === 'Missing Item'">
                            <td style="background:#e7e7e7">
                                Where from {{prupdate.data.goreceipttype}}?
                            </td>
                            <td colspan="5">
                                <input type="radio" value="Supplier" ng-model="prupdate.data.broken_by" /> Customer | <input type="radio" value="Nafco" ng-model="prupdate.data.broken_by" /> Nafco
                            </td>
                        </tr>
                        <tr ng-show="(prupdate.data.goreceipttype === 'BK' || prupdate.data.goreceipttype === 'Missing Item') && prupdate.data.broken_by === 'Nafco'">
                            <td style="background:#e7e7e7">If Nafco then?</td>
                            <td colspan="5">
                                <input type="radio" value="Site" ng-model="prupdate.data.broken_naf_by" /> Site | <input type="radio" value="Factory" ng-model="prupdate.data.broken_naf_by" /> Factory
                            </td>
                        </tr>
                        <tr ng-show="prupdate.data.goreceipttype !== 'GO' && prupdate.data.goreceipttype !== 'S'">
                            <td style="background:#e7e7e7">Old GO#</td>
                            <td colspan="5">
                                <input name="broken_go_oldno" id="broken_go_oldno" gn-model="prupdate.data.broken_go_oldno" class="old_page_inputs" ng-required="prupdate.data.goreceipttype !== 'GO' && prupdate.data.goreceipttype !== 'S'" />
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="ism-pms-dialog-footer">

                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="prupdate.isloading || updateprocurement.$invalid">
                    Update
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="prupdate.diashow  = false;">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>