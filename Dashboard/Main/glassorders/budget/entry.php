<div class="ism-pms-dialog" id="dia_glass_budget">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Budget
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_glass_budget').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newglassbudget.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_budgetglass_submit()" name="budgetglass_save" id="save_budgetglass" ng-show="!newglassbudget.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newglassbudget.title}} - <strong>{{viewproject.project_name}} [{{viewproject.project_no}}]</strong></span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Code</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgcode" id="bgcode" ng-model="newglassbudget.data.bgcode" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass No.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gbudgetglassno" id="gbudgetglassno" ng-model="newglassbudget.data.gbudgetglassno" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Specification</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input list="glist" name="bgglass" id="bgglass" ng-model="newglassbudget.data.bgglass" class="ism-dialog-rows-input-controller" required />
                            <datalist id="glist">
                                <option ng-repeat="x in autoglass" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Area (m<sup>2</sup>)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgarea" id="bgarea" ng-model="newglassbudget.data.bgarea" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Cost (S.R)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgcost" id="bgcost" ng-model="newglassbudget.data.bgcost" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Cost (S.R)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgtotalcost" id="bgtotalcost" ng-model="newglassbudget.data.bgtotalcost" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Shaped Area (m<sup>2</sup>)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgshapedarea" id="bgshapedarea" ng-model="newglassbudget.data.bgshapedarea" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Cost (S.R)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgshapedcost" id="bgshapedcost" ng-model="newglassbudget.data.bgshapedcost" class="ism-dialog-rows-input-controller" ng-change="calcactions()" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Shaped Total Cost (S.R)</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="bgshapedtotalcost" id="bgshapedtotalcost" ng-model="newglassbudget.data.bgshapedtotalcost" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newglassbudget.isloading || budgetglass_save.$invalid">
                    {{newglassbudget.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_glass_budget').style.display='none'">
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