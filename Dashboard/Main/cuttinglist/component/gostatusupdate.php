<div class="ism-pms-dialog" ng-if="updatestatus.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               Glass Order status Update
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!updatestatus.isloading" ng-click="changediastatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="updatestatus.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="updatestatusSubmit()" name="statusupdate" id="updatestatus" ng-show="!updatestatus.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 250px">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="flagstatus" id="flagstatus" ng-model="updatestatus.data.flagstatus" class="ism-dialog-rows-input-controller">
                                <option value="">Select</option>
                                <option value="0">N/A</option>                                
                                <option value="2">Forword to Purchaseing</option>
                                <option value="3">Received From Purchaseing</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+updatestatus.data.flagstatus)<2">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To {{updatestatusdep}}</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="issuedate_update" id="issuedate_update" ng-model="updatestatus.data.issuedate_update" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" ng-required="(+updatestatus.data.flagstatus)>1" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+updatestatus.data.flagstatus)<3">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To {{updatestatusdep}}</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="reserved_update" id="reserved_update" ng-model="updatestatus.data.reserved_update" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="vals_contractsign" ng-required="(+updatestatus.data.flagstatus)===3" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="updatestatus.isloading || statusupdate.$invalid">
                    {{updatestatus.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="changediastatus(false)">
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