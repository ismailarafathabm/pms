<div class="ism-pms-dialog" id="dia_new_tradesgroup">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Master Log Trades Group
            </div>
            <div ng-show="!newtradegroup.isloading" class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_new_tradesgroup').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newtradegroup.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_tradesgroup_submit()" id="save_tradesgroup" name="tradesgroup_save" ng-show="!newstrades.isloading">
            <div class="ism-pms-dialog-body" style="width: 270px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{newsystem.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width:100%">
                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Trade Group Name</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tgroupname" id="tgroupname" ng-model="newtradegroup.data.tgroupname" class="ism-dialog-rows-input-controller" required />
                        </div>
                        <div class="ism-dialog-input-error" ng-show="tradesgroup_save.tgroupname.$touched && tradesgroup_save.tgroupname.$invalid">
                            <i class="fa fa-exclamation-circle"></i>Enter Trade group name
                        </div>
                    </div>
                </div>
            </div>
            <!-- {{tradesgroup_save|json}} -->
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newtradegroup.isloading || tradesgroup_save.$invalid">
                    Save
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_new_tradesgroup').style.display='none'">
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