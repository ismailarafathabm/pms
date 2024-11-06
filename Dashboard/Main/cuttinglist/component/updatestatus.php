<div class="ism-pms-dialog" ng-if="xupdatestatus.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                {{xupdatestatus.title}}
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!xupdatestatus.isloading" ng-click="changediastatusx(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="xupdatestatus.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="updatestatusSubmitx()" name="statusupdatex" id="xupdatestatusx" ng-show="!xupdatestatus.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 250px">
                        <div class="ism-dialog-body-rows-input-container-lable">Department</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="currentdepartment" id="currentdepartment" ng-model="currentdepartment" ng-change="choosedepartment()" class="ism-dialog-rows-input-controller">
                                <option value="">Select</option>
                                <option ng-repeat="x in updateType" value="{{x.flag}}">{{x.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 250px">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="flagstatus" id="flagstatus" ng-model="xupdatestatus.data.flagstatus" class="ism-dialog-rows-input-controller">
                                <option value="">Select</option>
                                <option value="0">N/A</option>
                                <option value="1">Direct</option>
                                <option value="2">Forword</option>
                                <option value="3">Received</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+xupdatestatus.data.flagstatus)<2">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To {{updatestatusdep}}</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="issuedate_update" id="issuedate_update" ng-model="xupdatestatus.data.issuedate_update" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" ng-required="(+xupdatestatus.data.flagstatus)>1" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px" ng-hide="(+xupdatestatus.data.flagstatus)<3">
                        <div class="ism-dialog-body-rows-input-container-lable">Forward To {{updatestatusdep}}</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="reserved_update" id="reserved_update" ng-model="xupdatestatus.data.reserved_update" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="vals_contractsign" ng-required="(+xupdatestatus.data.flagstatus)===3" />
                        </div>
                    </div>

                    <div ng-show="xupdatestatus.type==='matterial_flag' && (+xupdatestatus.data.flagstatus) === 3" class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Material Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">                            
                            <select name="materialstatus" id="materialstatus" ng-model="xupdatestatus.data.materialstatus" class="ism-dialog-rows-input-controller" ng-required="xupdatestatus.type==='matterial_flag' && (+xupdatestatus.data.flagstatus) === 3" >
                                <option value="">-</option>
                                <?php
                                foreach ($materialstatus as $mt) {
                                ?>
                                    <option value="<?php echo $mt ?>"><?php echo $mt ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div ng-show="xupdatestatus.type==='matterial_flag' && (+xupdatestatus.data.flagstatus) === 3" class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Material Ref NO#</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="materialrefno" id="materialrefno" ng-model="xupdatestatus.data.materialrefno" class="ism-dialog-rows-input-controller" ng-required="xupdatestatus.type==='matterial_flag' && (+xupdatestatus.data.flagstatus) === 3" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="xupdatestatus.isloading || statusupdatex.$invalid">
                    {{xupdatestatus.btn}}
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