<div class="ism-dialogbox" id="diaconditionsnew">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{'Add New Conditions' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('diaconditionsnew').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="add_new_conditions" ng-submit="new_conditions_add()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                S.No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="conditions_add_new_number" name="conditions_add_new_number" id="conditions_add_new_number" class="nafco-inputs" required>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Conditions
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="conditions_add_new" name="conditions_add_new" id="conditions_add_new" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('diaconditionsnew').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="add_new_conditions.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="add_new_conditions.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!add_new_conditions.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="ism-dialogbox" id="myModal_con_edit">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{'Edit Conditions' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('myModal_con_edit').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="add_edit_conditions" ng-submit="new_conditions_edit()">
                <div class="dialog-body">
                    <div class="dialog-row-sm nodis">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                id
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="editinfoscon.project_conditions_id" name="project_conditions_id" id="project_conditions_id" class="nafco-inputs" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                S.No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="editinfoscon.project_conditions_number" name="conditions_add_edit_number" id="conditions_add_edit_number" class="nafco-inputs" required>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Conditions
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="editinfoscon.project_conditions_remark" name="conditions_add_edit" id="conditions_add_edit" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('myModal_con_edit').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="add_edit_conditions.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="add_edit_conditions.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!add_edit_conditions.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>