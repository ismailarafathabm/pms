<div class="ism-pms-dialog" id="dia_go_approvals">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Purchase Approval Form
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_go_approvals').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="pgonew.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="pgonew_save_submit()" name="pgonew_save" id="save_pgonew" ng-show="!pgonew.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{pgonew.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgodate" id="bgodate" ng-model="pgonew.data.bgodate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Order Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="bgotype" id="bgotype" ng-model="pgonew.data.bgotype" class="ism-dialog-rows-input-controller">
                                <option value="">-Select-</option>
                                <option value="international order">International Order</option>
                                <option value="local order">Local Order</option>
                                <option value="local purchase">Local purchase</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Go Ref.No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgogorefno" id="bgogorefno" ng-model="pgonew.data.bgogorefno" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="suppliername" id="suppliername" ng-model="pgonew.data.suppliername" class="ism-dialog-rows-input-controller" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in supplierlist" value="{{x.glasssuppliername}}">{{x.glasssuppliername}}</option>
                            </select>
                            <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewsupplier()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Previous Ordered Sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgopsqm" id="bgopsqm" ng-model="pgonew.data.bgopsqm" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Project Budget Sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgobsqm" id="bgobsqm" ng-model="pgonew.data.bgobsqm" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Area (sqm)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgogoqty" id="bgogoqty" ng-model="pgonew.data.bgogoqty" class="ism-dialog-rows-input-controller" required ng-change="calcarea()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Price/Sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgoppsqm" id="bgoppsqm" ng-model="pgonew.data.bgoppsqm" class="ism-dialog-rows-input-controller" required ng-change="calcarea()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgoval" id="bgoval" ng-model="pgonew.data.bgoval" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="areaover || pgonew.isloading || glassbudget_save.$invalid">
                    {{pgonew.btn}}
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