<div class="ism-pms-dialog" ng-if="show_system_new">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Systems
            </div>
            <div ng-show="!systemnewdia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setSystemNewStatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="systemnewdia.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="save_system_submit()" id="save_system" name="system_save" ng-show="!systemnewdia.isloading">

            <div class="ism-pms-dialog-body" style="width: autopx;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{systemnewdia.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 0 200px;width: 400px;">
                        <div class="ism-dialog-body-rows-input-container-lable">System</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="techsyssystem" id="techsyssystem" ng-model="systemnewdia.data.techsyssystem" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="system_save.techsyssystem.$invalid">
                            <i class="fa fa-exclamation-circle"></i>Enter System Name
                        </div>
                    </div>
                </div>
            </div>

            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="systemnewdia.isloading || system_save.$invalid">
                    {{systemnewdia.btn}}
                </button>
                <button ng-show="!systemnewdia.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setSystemNewStatus(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button ng-show="systemnewdia.mode === 2" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removesystem()" style="margin-right:125px;">
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