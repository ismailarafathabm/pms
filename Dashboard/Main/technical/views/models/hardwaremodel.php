<div class="ism-pms-dialog" ng-if="show_hardware_dialog">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Hardware Approvals
            </div>
            <div ng-show="!hardwareapprovals_model.isloading" class="ism-pms-idalog-header-closebtn" ng-click="closeHardwaredialog(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="hardwareapprovals_model.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="savehardware_submit()" id="savehardware" name="hardwaresave" ng-show="!hardwareapprovals_model.isloading">
            <div class="ism-pms-dialog-body" style="min-width: 200px;max-width: 450px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{hardwareapprovals_model.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">System</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thsystem" id="thsystem" ng-model="hardwareapprovals_model.data.thsystem" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Accessories</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thdescriptions" id="thdescriptions" ng-model="hardwareapprovals_model.data.thdescriptions" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Remarks</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thnotes" id="thnotes" ng-model="hardwareapprovals_model.data.thnotes" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thsubmittedby" id="thsubmittedby" ng-model="hardwareapprovals_model.data.thsubmittedby" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thsubmitteddate" id="thsubmitteddate" ng-model="hardwareapprovals_model.data.thsubmitteddate" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="thstatus" id="thstatus" ng-change="sample_hardwares()" ng-model="hardwareapprovals_model.data.thstatus" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select</option>                                
                                <option ng-repeat="x in status_list" value="{{x.code}}">{{x.code_description}}</option>  
                            </select>
                        </div>                       
                    </div>

                    <div ng-if="hardwareapprovals_model.data.thstatus !== 'U' " class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">
                           Date
                        </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="thsapprovedate" id="thsapprovedate" ng-model="hardwareapprovals_model.data.thsapprovedate" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>

                </div>
            </div>


            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="hardwareapprovals_model.isloading || hardwaresave.$invalid">
                    {{hardwareapprovals_model.btn}}
                </button>
                <button ng-show="!hardwareapprovals_model.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="closeHardwaredialog(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button ng-show="hardwareapprovals_model.mode === 2" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removeHardwares(
                    hardwareapprovals_model.data.thid,
                    hardwareapprovals_model.data.thproject                    
                )" style="margin-right:125px;">
                    <i class="fa fa-trash"></i>
                    Remove
                </button>
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>

    </div>
</div>