<div class="ism-pms-dialog" id="dia_glassbudget">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Glass Summary
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_glassbudget').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="budget.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_glassbudget_submit()" name="glassbudget_save" id="save_glassbudget" ng-show="!budget.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{budget.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Project</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbproject" id="gbproject" ng-model="budget.data.gbproject" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_project_list()" required ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                            <project-listnew class="ism-new-pms-auto-dia" id="budget_auto_projects" style="width: 400px;left: -6px;top: -2px;">                                
                            </project-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbsupplier" id="gbsupplier" ng-model="budget.data.gbsupplier" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_supplier_list()" required ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                            <suppliers-listnew class="ism-new-pms-auto-dia" id="budget_auto_suppliers" style="width:300px;left:-60px">                                
                            </suppliers-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="gbudgettype" id="gbudgettype" ng-model="budget.data.gbudgettype" class="ism-dialog-rows-input-controller" required ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'">
                                <option value="">-Select-</option>
                                <option value="contract">Contract</option>
                                <option value="additional">Additional</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="pupdate" id="pupdate" ng-model="budget.data.pupdate" class="ism-dialog-rows-input-controller calendar" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetspc" id="gbudgetspc" ng-model="budget.data.gbudgetspc" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_glass_list()" required  ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                            <glass-listnew class="ism-new-pms-auto-dia" id="budget_auto_glass" style="width: 485px;left: -2px;top: -5px;">                                
                            </glass-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetglasstype" id="gbudgetglasstype" ng-model="budget.data.gbudgetglasstype" class="ism-dialog-rows-input-controller " required readonly ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Thickness</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgtickness" id="gbudgtickness" ng-model="budget.data.gbudgtickness" class="ism-dialog-rows-input-controller" required readonly ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetarea" id="gbudgetarea" ng-model="budget.data.gbudgetarea" class="ism-dialog-rows-input-controller" required ng-change="calculation()" ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Budget Price</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetbprice" id="gbudgetbprice" ng-model="budget.data.gbudgetbprice" class="ism-dialog-rows-input-controller" required ng-change="calculation()" ng-readonly="budget.mode === 'PN' || budget.mode === 'PE'"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetbtotal" id="gbudgetbtotal" ng-model="budget.data.gbudgetbtotal" class="ism-dialog-rows-input-controller" required readonly />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;" ng-if="budget.mode === 'PN' || budget.mode === 'PE'">
                        <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input ng-model="budget.data.gbudgetarea" class="ism-dialog-rows-input-controller" readonly />
                        </div>
                    </div>


                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;" ng-if="budget.mode === 'PN' || budget.mode === 'PE'">
                        <div class="ism-dialog-body-rows-input-container-lable">Actual Price (with VAT)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgcustomval" id="gbudgcustomval" ng-model="budget.data.gbudgcustomval" class="ism-dialog-rows-input-controller" required ng-change="calculation()"/>
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;" ng-if="budget.mode === 'PN' || budget.mode === 'PE'">
                        <div class="ism-dialog-body-rows-input-container-lable">Total</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgettotal" id="gbudgettotal" ng-model="budget.data.gbudgettotal" class="ism-dialog-rows-input-controller" required readonly />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Price Diffrent</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="pricediff" id="pricediff" ng-model="budget.data.pricediff" class="ism-dialog-rows-input-controller" required readonly />
                        </div>

                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Diffrent</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="finalamount" id="finalamount" ng-model="budget.data.finalamount" class="ism-dialog-rows-input-controller" required readonly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="budget.isloading || glassbudget_save.$invalid">
                    {{budget.btn}}
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