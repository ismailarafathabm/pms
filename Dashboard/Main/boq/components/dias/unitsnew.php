<div class="ism-metro-project-dialog" id="show_new_unittype">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    Units
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" ng-click="hide_unitnew()">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            {{unittyp_model.mode === '1' ? 'Add New Units' : 'Edit Units'}}
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label">Units</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="unit_name" name="unit_name" ng-model="unittyp_model.data.unit_name" />
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
                    <button type="button" class="ism-metro-button ism-metro-success" ng-disabled="!unittyp_model.data.unit_name  || unittyp_model.data.unit_name === '' || isloading" ng-click="save_newunits()">
                        <i ng-show="unittyp_model.mode === '1'" class="fa fa-check"></i>
                        <i ng-show="unittyp_model.mode === '2'" class="fa fa-edit"></i>
                        {{unittyp_model.mode === '1' ? 'Save' : 'Update'}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>