<div class="ism-metro-project-dialog" id="dia_newdrawingapprovalsfor">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    METRO APPROVALS
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='none'">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            ADD NEW DRAWING APPROVALS CATEGORY
        </div>
        <div class="ism-metro-project-dialog-main-body">
            <div class="ism-metro-project-mainbody-row">
                <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                    <div class="ism-metro-project-mainbody-label"> Approval Category</div>
                    <div class="ism-metro-project-mainbody-inputs">
                        <input type="text" class="ism-metro-inputs" id="drawing_type_new" name="drawing_type_new" ng-model="drawingapprovalstype.drawing_type_new"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-metro-project-dialog-footer">
            <div class="ism-metro-project-dialog-footer-buttons">
                <div class="ism-metro-left-button-group">
                    <button type="button" class="ism-metro-button ism-metro-danger" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="ism-metro-left-button-right">
                    <button type="button" class="ism-metro-button ism-metro-success" ng-disabled="drawingapprovalstype.drawing_type_new === ''" ng-click="save_new_approvaltype_click()">
                        <i class="fa fa-check"></i>
                        Save
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>