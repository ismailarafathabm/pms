<div class="ism-pms-dialog" id="dia_material_orders">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Purcashe Order Material Form
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_material_orders').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newmaterial.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_material_order_submit()" name="materialorder_save" id="save_material_orde" ng-show="!newmaterial.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newmaterial.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Ref.No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmorefno" id="bmorefno" ng-model="newmaterial.data.bmorefno" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Order Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="bmotype" id="bmotype" ng-model="newmaterial.data.bmotype" class="ism-dialog-rows-input-controller">
                                <option value="">-Select-</option>
                                <option value="international order">International Order</option>
                                <option value="local order">Local Order</option>
                                <option value="local purchase">Local purchase</option>
                            </select>
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmodate" id="bmodate" ng-model="newmaterial.data.bmodate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Po.Ref</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmoorefno" id="bmoorefno" ng-model="newmaterial.data.bmoorefno" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Material Types.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input list="materiallists" name="bmomtype" id="bmomtype" ng-model="newmaterial.data.bmomtype" class="ism-dialog-rows-input-controller" required />
                            <datalist id="materiallists">
                                <option ng-repeat='x in itemlist' value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="bmospplier" id="bmospplier" ng-model="newmaterial.data.bmospplier" class="ism-dialog-rows-input-controller" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in supplierlist" value="{{x.glasssuppliername}}">{{x.glasssuppliername}}</option>
                            </select>
                            <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewsupplier()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Area/Qty/sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmoqty" id="bmoqty" ng-model="newmaterial.data.bmoqty" class="ism-dialog-rows-input-controller" required ng-change="calcarea()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Units</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmounit" id="bmounit" ng-model="newmaterial.data.bmounit" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Price/Sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmoppunit" id="bmoppunit" ng-model="newmaterial.data.bmoppunit" class="ism-dialog-rows-input-controller" required ng-change="calcarea()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmoval" id="bmoval" ng-model="newmaterial.data.bmoval" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newmaterial.isloading || glassbudgetglassorders_save.$invalid">
                    {{newmaterial.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_material_orders').style.display='none'">
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