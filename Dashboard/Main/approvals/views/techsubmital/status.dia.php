<style>
    .hed {
        background: #dbdbdb;
        font-weight: 600;
    }
</style>
<div class="ism-pms-dialog" ng-if="statusupdate.status">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Technical Approvals Status Change
            </div>
            <div ng-show="!boqinfo_dia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setdiastatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="boqinfo_dia.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form ng-submit="update_technical_submital()">
            <div class="ism-pms-dialog-body" style="width: auto;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>New Status </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 400px;">
                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 0 200px;width: 400px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="ds_status" id="ds_status" ng-model="statusupdate.data.ds_status" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in statuslist" value={{x.code}}>{{x.code_description}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 0 200px;width: 400px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="ds_submitteddate" id="ds_submitteddate" ng-model="statusupdate.data.ds_submitteddate" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                </div>
            </div>


            <div class="ism-pms-dialog-footer">
                <button ng-show="!boqinfo_dia.isloading" type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save">
                    <i class="fa fa-check"></i>
                    Update
                </button>
                <button ng-show="!calculation_dialog.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setdiastatus(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>

            </div>
        </form>
    </div>
</div>