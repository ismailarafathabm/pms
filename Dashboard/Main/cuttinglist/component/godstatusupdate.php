<div class="ism-pms-dialog" ng-if="updatestatusx.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               Glass Order status Update
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!updatestatusx.isloading" ng-click="changediastatusx(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="updatestatusx.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="updatestatusxSubmit()" name="statusupdatex" id="updatestatusx" ng-show="!updatestatusx.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 250px">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="flagstatus" id="flagstatus" ng-model="updatestatusx.data.flagstatus" class="ism-dialog-rows-input-controller">
                                <option value="">Select</option>
                                <option value="0">N/A</option>                                
                                <option value="1">Forword To Estimation</option>
                                <option value="2">Forward To Procurement</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+updatestatusx.data.flagstatus)<1">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To {{updatestatusxdep}}</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="issuedate_update" id="issuedate_update" ng-model="updatestatusx.data.issuedate_update" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" ng-required="(+updatestatusx.data.flagstatus)>=1" />
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="updatestatusx.isloading || statusupdate.$invalid">
                    {{updatestatusx.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="changediastatusx(false)">
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