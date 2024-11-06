<div class="ism-pms-dialog" id="dia_budget_glassorders">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Order
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_budget_glassorders').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newgo.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_glassbudgetglassorders_submit()" name="glassbudgetglassorders_save" id="save_glassbudgetglassorders" ng-show="!newgo.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newgo.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopdate" id="gopdate" ng-model="newgo.data.gopdate" class="ism-dialog-rows-input-controller calendar" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Ref</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopno" id="gopno" ng-model="newgo.data.gopno" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 4000px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                        <select class="ism-dialog-rows-input-controller" name="gopglasstype" id="gopglasstype" ng-model="newgo.data.gopglasstype" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in gdescription.glasstypes | orderBy : 'glasstype_name'" value="{{x.glasstype_name}}">{{x.glasstype_name}}</option>
                            </select>
                            <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewtype()">
                                <i class="fa fa-plus" style="margin-right:0 !important"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 4000px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Specification</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <textarea rows='3' name="gopglassdesc" id="gopglassdesc" ng-model="newgo.data.gopglassdesc" class="ism-dialog-rows-input-controller" required></textarea>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopglassqty" id="gopglassqty" ng-model="newgo.data.gopglassqty" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopglasstotalarea" id="gopglasstotalarea" ng-model="newgo.data.gopglasstotalarea" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">P/sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopglasspricepersqm" id="gopglasspricepersqm" ng-model="newgo.data.gopglasspricepersqm" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gopglasstotalamount" id="gopglasstotalamount" ng-model="newgo.data.gopglasstotalamount" class="ism-dialog-rows-input-controller" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newgo.isloading || glassbudgetglassorders_save.$invalid">
                    {{newgo.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_budget_glassorders').style.display='none'">
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