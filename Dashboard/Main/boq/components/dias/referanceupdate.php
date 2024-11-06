<div class="ism-metro-project-dialog" id="show_new_referance">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    BOQ Reference Number
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" ng-click="hide_newreferance()">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            {{Reference.mode === '1' ? 'Update Reference' : 'Update Reference'}}
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label">Reference#</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="refno" name="refno" ng-model="referance.data.refno" />
                    </div>
                </div>
            </div>
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label">Revsion#</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="revisionno" name="revisionno" ng-model="referance.data.revisionno" />
                    </div>
                </div>
            </div>

        </div>
        <div class="ism-metro-project-dialog-footer">
            <div class="ism-metro-project-dialog-footer-buttons">
                <div class="ism-metro-left-button-group">
                    <button type="button" class="ism-metro-button ism-metro-danger" ng-click="hide_newreferance()">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="ism-metro-left-button-right">
                    <button type="button" class="ism-metro-button ism-metro-success" ng-disabled="!referance.data.refno  || !referance.data.revisionno || isloading" ng-click="update_referace()">
                        <i ng-show="referance.mode === '1'" class="fa fa-check"></i>
                        <i ng-show="referance.mode === '2'" class="fa fa-edit"></i>
                        {{referance.mode === '1' ? 'Save' : 'Update'}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>