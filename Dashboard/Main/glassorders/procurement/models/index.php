<div class="ism-pms-dialog" id="dia_glassdescription">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Description
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_glassdescription').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="gdescription.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_glassdescription_submit()" name="glassdescription_save" id="save_glassdescription" ng-show="!gdescription.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{gdescription.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" >
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 150px">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select class="ism-dialog-rows-input-controller" name="glassdescriptoinstype" id="glassdescriptoinstype" ng-model="gdescription.data.glassdescriptoinstype" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in gdescription.glasstypes | orderBy : 'glasstype_name'" value="{{x.glasstype_name}}">{{x.glasstype_name}}</option>
                            </select>
                            <button type="button" class="ism-new-page-header-button normalbtn" ng-click="addnewtype()">
                                <i class="fa fa-plus" style="margin-right:0 !important"></i>
                            </button>
                        </div>
                        
                        <div class="ism-dialog-input-error" ng-show="glassdescription_save.glassdescriptoinstype.$invalid && glassdescription_save.glassdescriptoinstype.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Select Type </span>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Thickness</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gdesriptionsortfrm" id="gdesriptionsortfrm" ng-model="gdescription.data.gdesriptionsortfrm" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="glassdescription_save.gdesriptionsortfrm.$invalid && glassdescription_save.gdesriptionsortfrm.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Thickness </span>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Specification</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="glassdescriptoinsspec" id="glassdescriptoinsspec" ng-model="gdescription.data.glassdescriptoinsspec" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="glassdescription_save.glassdescriptoinsspec.$invalid && glassdescription_save.glassdescriptoinsspec.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Specification </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="gdescription.isloading || glassdescription_save.$invalid">
                    {{gdescription.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_glassdescription').style.display='none'">
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