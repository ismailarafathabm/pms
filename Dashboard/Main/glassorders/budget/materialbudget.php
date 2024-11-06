<div class="ism-pms-dialog" id="dia_material_budget">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Material Budget
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_material_budget').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newmaterialbudget.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_budgetmaterial_save_submit()" name="budgetmaterial_save" id="save_budgetmaterial_save" ng-show="!newmaterialbudget.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newmaterialbudget.title}} - <strong>{{viewproject.project_name}} [{{viewproject.project_no}}]</strong></span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 600px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Budget NO.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input  name="budgetNo" id="budgetNo" ng-model="newmaterialbudget.data.budgetNo" class="ism-dialog-rows-input-controller" required />                           
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 300px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Types.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input list="materiallists" name="bmtype" id="bmtype" ng-model="newmaterialbudget.data.bmtype" class="ism-dialog-rows-input-controller" required />
                            <datalist id="materiallists">
                                <option ng-repeat='x in materialslist' value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 220px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Material Category</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="bmmaterialtype" id="bmmaterialtype" ng-model="newmaterialbudget.data.bmmaterialtype" class="ism-dialog-rows-input-controller">
                                <option value="">-select-</option>
                                <option ng-repeat="x in bgmtypes" value="{{x}}">{{x}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 130px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Unit</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmunit" id="bmunit" ng-model="newmaterialbudget.data.bmunit" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 100px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmqty" id="bmqty" ng-model="newmaterialbudget.data.bmqty" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 100px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Estimate Price</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmeprice" id="bmeprice" ng-model="newmaterialbudget.data.bmeprice" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 100px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Estimate Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmeval" id="bmeval" ng-model="newmaterialbudget.data.bmeval" class="ism-dialog-rows-input-controller" readonly />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 100px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Discount Price</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmdiscountprice" id="bmdiscountprice" ng-model="newmaterialbudget.data.bmdiscountprice" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 100px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Discount Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bmdiscountval" id="bmdiscountval" ng-model="newmaterialbudget.data.bmdiscountval" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newmaterialbudget.isloading || budgetmaterial_save.$invalid">
                    {{newmaterialbudget.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_material_budget').style.display='none'">
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