<div class="ism-pms-dialog" id="dia_load_newmo">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                New MO
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!newMo.isloading" onclick="document.getElementById('dia_load_newmo').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newMo.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="saveMoSubmit()" name="mosave" id="saveMo" ng-show="!newMo.isloading">
            <div class="ism-pms-dialog-body" style="max-width: 450px;">
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">M.O Number</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="c_mono" id="c_mono" ng-model="newMo.data.c_mono" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 150px">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">                            
                            <select name="c_mo_accountfalg" id="c_mo_accountfalg" ng-model="newMo.data.c_mo_accountfalg" class="ism-dialog-rows-input-controller">
                                <option value="0">N/A</option>
                                <option value="1">Direct</option>
                                <option value="2">Forword to Account</option>
                                <option value="3">Received From Account</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 350px">
                        <div class="ism-dialog-body-rows-input-container-lable">BOQ ID</div>
                        <div class="ism-dialog-body-rows-input-container-input ">                            
                            <select name="c_mo_boqid" id="c_mo_boqid" ng-model="newMo.data.c_mo_boqid" class="ism-dialog-rows-input-controller">
                                <option value="">-</option>
                                <option value="0">Miscellaneous</option>                                
                                <option ng-repeat="x in boqlist" value="{{x.poq_id}}">{{x.poq_item_no}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+newMo.data.c_mo_accountfalg)<2">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To Account</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="c_mo_account_issue" id="c_mo_account_issue" ng-model="newMo.data.c_mo_account_issue" class="ism-dialog-rows-input-controller"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" ng-required="(+newMo.data.c_mo_accountfalg)>=2"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+newMo.data.c_mo_accountfalg)<3">
                        <div class="ism-dialog-body-rows-input-container-lable">Received From Account</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="c_mo_account_release" id="c_mo_account_release" ng-model="newMo.data.c_mo_account_release" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" ng-required="(+newMo.data.c_mo_accountfalg)===3"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newMo.isloading || mosave.$invalid">
                    {{newMo.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_load_newmo').style.display='none'">
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