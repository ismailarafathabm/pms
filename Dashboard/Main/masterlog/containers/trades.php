<div class="ism-pms-dialog" id="dia_new_trades">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Master Log Trades
            </div>
            <div ng-show="!newstrades.isloading" class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_new_trades').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newstrades.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_trades_submit()" id="save_trades" name="trades_save" ng-show="!newstrades.isloading">
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
                </div>
            </div>
        </form>
    </div>
</div>