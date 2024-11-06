<div class="ism-dialogbox" id="edit_drawinginfo">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Edit Drawing Information
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('edit_drawinginfo').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form ng-submit="ed_save_new_approval()" name="esave_new_d_approval">
            <div class="dialog-body">
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Token
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input autocomplete="off" type="text" ng-model="enewapproval.approvals_token" class="nafco-inputs" name="approvals_draw_no" required readonly>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Project Id
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input autocomplete="off" type="text" ng-model="enewapproval.approvals_project_code" class="nafco-inputs" name="approvals_draw_no" required readonly>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Category
                            <button type="button" onclick="document.getElementById('dia_newdrawingapprovalsfor').style.display='block';" class="ism-btns btn-close" style="margin-left:0px; padding:2px 3px">
                                <i class="fa fa-plus">
                                </i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <Select type="text" ng-model="enewapproval.approvals_for" class="nafco-inputs" name="approvals_for" ng-model="newapp.drawing_for" required>
                                <option value=''>-Select-</option>
                                <option ng-repeat="x in drawapprovals" value="{{x.types_id}}">{{x.types_name}}</option>
                            </Select>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Drawing Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="enewapproval.approvals_draw_no" class="nafco-inputs" name="approvals_draw_no" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">

                            <input type="text" ng-model="enewapproval.approvals_descriptions" class="nafco-inputs" name="approvals_descriptions" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('edit_drawinginfo').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="esave_new_d_approval.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="esave_new_d_approval.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!esave_new_d_approval.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>