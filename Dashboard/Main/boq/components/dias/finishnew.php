<div class="ism-metro-project-dialog" id="show_new_finishtype">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    Finish
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" ng-click="hide_finishnew()">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            {{finishtype_model.mode === '1' ? 'Add New Finish' : 'Edit Finish'}}
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label">Finish</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="finish_name" name="finish_name" ng-model="finishtype_model.data.finish_name" />
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-metro-project-dialog-footer">
            <div class="ism-metro-project-dialog-footer-buttons">
                <div class="ism-metro-left-button-group">
                    <button type="button" class="ism-metro-button ism-metro-danger" ng-click="hide_finishnew()">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="ism-metro-left-button-right">
                    <button type="button" class="ism-metro-button ism-metro-success" ng-disabled="!finishtype_model.data.finish_name  || finishtype_model.data.finish_name === '' || isloading" ng-click="save_newfinish()">
                        <i ng-show="finishtype_model.mode === '1'" class="fa fa-check"></i>
                        <i ng-show="finishtype_model.mode === '2'" class="fa fa-edit"></i>
                        {{finishtype_model.mode === '1' ? 'Save' : 'Update'}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>