<div class="ism-pms-dialog" id="dia_new_system">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Master Log System
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_new_system').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newsystem.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_system_submit()" id="save_system" name="system_save" ng-show="!newsystem.isloading">
            <div class="ism-pms-dialog-body" style="max-width: 500px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newsystem.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">

                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">System</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="systemname" id="systemname" ng-model="newsystem.data.systemname" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="system_save.systemname.$invalid">
                            <i class="fa fa-exclamation-circle"></i>Enter System Name
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Procurement</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="systemprocurement" id="systemprocurement" ng-model="newsystem.data.systemprocurement" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="system_save.systemprocurement.$invalid">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Procurement Duration </span>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Estimation</div>
                        <div class="ism-dialog-body-rows-input-container-input">
                            <input name="systemesimation" id="systemesimation" ng-model="newsystem.data.systemesimation" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="system_save.systemesimation.$invalid">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Procurement Duration </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newsystem.isloading || system_save.$invalid">
                    Save
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_new_system').style.display='none'">
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