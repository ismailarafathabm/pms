<div class="ism-pms-dialog" id="ism_dia_ml_units">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                MASTER LOG - UNITS
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('ism_dia_ml_units').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>

        </div>
        <div class="ism-pms-dialog-loader" style="max-width: 470px;" ng-show="unitview.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form id="save_uint" name="unitsave">
            <div class="ism-pms-dialog-body" style="max-width: 470px;" ng-show="!unitview.isloading">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{unitview.subtitle}}</span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <label for="unitdesc" class="ism-dialog-body-rows-input-container-lable">Unit Description</label>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input id="unitdesc" name="unitdesc" ng-model="unitview.data.unitdesc" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                        <div class="ism-dialog-input-error" ng-show="unitsave.unitdesc.$invalid">
                            <i class="fa fa-exclamation-circle"></i>Enter Unit Description
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <label for="unitdesc" class="ism-dialog-body-rows-input-container-lable">Calculation By</label>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select id="calcby" name="calcby" ng-model="unitview.data.calcby" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in calbytype" value="{{x.type}}">{{x.desc}}</option>
                            </select>
                        </div>
                        <div class="ism-dialog-input-error" ng-show="unitsave.calcby.$invalid">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Unit Calucation By </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer" ng-show="!unitview.isloading">
                <button type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newsystem.isloading || unitsave.$invalid" ng-click="savenewunit_click()">
                    {{unitview.btntitle}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('ism_dia_ml_units').style.display='none'">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>