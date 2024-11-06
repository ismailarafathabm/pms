<div class="ism-metro-project-dialog" id="dia_newshopdrawingApprovals">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    METRO APPROVALS
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" onclick="document.getElementById('dia_newshopdrawingApprovals').style.display='none'">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            ADD NEW SHOP DRAWING APPROVALS
        </div>
        <form name="save_new_d_approval" ng-submit="savedrawingapprovals_submit()">
            <div class="ism-metro-project-dialog-main-body">
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"> Project</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <select class="ism-metro-inputs" id="project_id" name="project_id" ng-model="newapproval.project_id" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in projects" value="{{x.project_no}}">{{x.project_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"> For</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <select class="ism-metro-inputs" id="approvals_for" name="approvals_for" ng-model="newapproval.approvals_for" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in drawapprovals | orderBy:'types_name'" value="{{x.types_id}}">{{x.types_name}}</option>
                            </select>
                            <button type="button" class="ism-metro-new-addbutton" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='flex'">ADD</button>
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">Drawing Number</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="approvals_draw_no" name="approvals_draw_no" ng-model="newapproval.approvals_draw_no" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">Description</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <textarea rows='3' type="text" class="ism-metro-inputs" id="approvals_descriptions" name="approvals_descriptions" ng-model="newapproval.approvals_descriptions" > </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-metro-project-dialog-footer">
                <div class="ism-metro-project-dialog-footer-buttons">
                    <div class="ism-metro-left-button-group">
                        <button type="button" class="ism-metro-button ism-metro-danger" onclick="document.getElementById('dia_newshopdrawingApprovals').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                    <div class="ism-metro-left-button-right">
                        <button type="submit" class="ism-metro-button ism-metro-success" ng-disabled="save_new_d_approval.$invalid">
                            <i class="fa fa-check"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>