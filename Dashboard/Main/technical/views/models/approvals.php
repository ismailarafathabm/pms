<div class="ism-pms-dialog" ng-if="technicalapproval_showdialog">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Technical Submittals
            </div>
            <div ng-show="!technicalaprpovals_dialog.isloading" class="ism-pms-idalog-header-closebtn" ng-click="close_technicalsubmittal_click(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="technicalaprpovals_dialog.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="savetehnicalsubmittal_submit()" id="savetehnicalsubmittal" name="savetehnicalsubmittalsave" ng-show="!technicalaprpovals_dialog.isloading">
            <div class="ism-pms-dialog-body" style="min-width: 200px;max-width: 450px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{technicalaprpovals_dialog.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Submittal Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="taapproval" id="taapproval" ng-model="technicalaprpovals_dialog.data.taapproval" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Description</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tadescription" id="tadescription" ng-model="technicalaprpovals_dialog.data.tadescription" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Remarks</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="taremarks" id="taremarks" ng-model="technicalaprpovals_dialog.data.taremarks" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tasubmittedby" id="tasubmittedby" ng-model="technicalaprpovals_dialog.data.tasubmittedby" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tasubmitteddate" id="tasubmitteddate" ng-model="technicalaprpovals_dialog.data.tasubmitteddate" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="tastatus" id="tastatus" ng-change = "smaple_techsubmittal()" ng-model="technicalaprpovals_dialog.data.tastatus" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select</option> 
                                <option ng-repeat="x in status_list" value="{{x.code}}">{{x.code_description}}</option>                                
                            </select>
                        </div>                       
                    </div>

                    <div ng-if="technicalaprpovals_dialog.data.tastatus !== 'U' " class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">
                           Date
                        </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="taapproveddate" id="taapproveddate" ng-model="technicalaprpovals_dialog.data.taapproveddate" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>

                </div>
            </div>


            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="technicalaprpovals_dialog.isloading || savetehnicalsubmittalsave.$invalid">
                    {{technicalaprpovals_dialog.btn}}
                </button>
                <button ng-show="!technicalaprpovals_dialog.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="close_technicalsubmittal_click(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button ng-show="technicalaprpovals_dialog.mode === 2" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removeTechnicalSubmittals()" style="margin-right:125px;">
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