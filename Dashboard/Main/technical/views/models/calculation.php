<div class="ism-pms-dialog" ng-if="calculaton_dia_show">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Calculation Submittal
            </div>
            <div ng-show="!calculation_dialog.isloading" class="ism-pms-idalog-header-closebtn" ng-click="closeCalculationdialog(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="calculation_dialog.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="savecalculationSubmittal_submit()" id="savecalculationSubmittal" name="calculationSubmittalsave" ng-show="!calculation_dialog.isloading">
            <div class="ism-pms-dialog-body" style="min-width: 200px;max-width: 450px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{calculation_dialog.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Calculation Title</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmitall" id="tcsubmitall" ng-model="calculation_dialog.data.tcsubmitall" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Submittal No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmittalno" id="tcsubmittalno" ng-model="calculation_dialog.data.tcsubmittalno" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Revision No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmittalrv" id="tcsubmittalrv" ng-model="calculation_dialog.data.tcsubmittalrv" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmittedby" id="tcsubmittedby" ng-model="calculation_dialog.data.tcsubmittedby" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmittaldate" id="tcsubmittaldate" ng-model="calculation_dialog.data.tcsubmittaldate" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="tcstatus" id="tcstatus" ng-change="sample_calculations()" ng-model="calculation_dialog.data.tcstatus" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select</option>                                
                                <option ng-repeat="x in status_list" value="{{x.code}}">{{x.code_description}}</option>  
                            </select>
                        </div>                       
                    </div>

                    <div ng-if="calculation_dialog.data.tcstatus !== 'U' " class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">
                          Date
                        </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcapproveddate" id="tcapproveddate" ng-model="calculation_dialog.data.tcapproveddate" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>

                </div>
            </div>


            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="calculation_dialog.isloading || calculationSubmittalsave.$invalid">
                    {{calculation_dialog.btn}}
                </button>
                <button ng-show="!calculation_dialog.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="closeCalculationdialog(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button ng-show="calculation_dialog.mode === 2" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removeCalculation(
                    calculation_dialog.data.thid,
                    calculation_dialog.data.thproject                    
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