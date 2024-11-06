<div class="ism-metro-project-dialog" id="show_new_systemtype">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    System
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" ng-click="hide_systemtype()">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            {{systemtype_model.mode === '1' ? 'Add New System Type' : 'Edit System Type'}}
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label">Finish</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="system_type_name" name="system_type_name" ng-model="systemtype_model.data.system_type_name" />
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-metro-project-dialog-footer">
            <div class="ism-metro-project-dialog-footer-buttons">
                <div class="ism-metro-left-button-group">
                    <button type="button" class="ism-metro-button ism-metro-danger" ng-click="hide_systemtype()">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="ism-metro-left-button-right">
                    <button type="button" class="ism-metro-button ism-metro-success" ng-disabled="!systemtype_model.data.system_type_name  || systemtype_model.data.system_type_name === '' || isloading" ng-click="save_newsystem()">
                        <i ng-show="systemtype_model.mode === '1'" class="fa fa-check"></i>
                        <i ng-show="systemtype_model.mode === '2'" class="fa fa-edit"></i>
                        {{systemtype_model.mode === '1' ? 'Save' : 'Update'}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>