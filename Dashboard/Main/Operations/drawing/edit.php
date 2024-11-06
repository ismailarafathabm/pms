<div class="ism-dialogbox" id="editRevision">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                # Drawing Number : <strong style="color:#235952">{{editrelease.approvals_info_drawing_no}}</strong> - Edit Revision New Revision
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('editRevision').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="edit_drawing_approvals" name="drawing_approvals_edit" enctype="multipart/form-data">
            <div class="dialog-body">
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            # Project :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_project_id" name="project_code" id="project_code" class="nafco-inputs" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            # R.A.Code :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_drawing_token" name="approvals_token" id="approvals_token" class="nafco-inputs" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Revision Token :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_token" name="approvals_info_token" id="approvals_info_token" class="nafco-inputs" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            # Drawing No
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_drawing_no" id="approvals_draw_no" name="approvals_draw_no" class="nafco-inputs" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            # Revision No
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_reveision_no" name="approvals_info_reveision_no" class="nafco-inputs naf" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sub . #
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_sub" name="approvals_info_sub" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Submited On
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_submited_on" name="approvals_info_submited_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_rsubmitedon">
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Received on
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_received_on" name="approvals_info_received_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_editrecivedon">
                        </div>
                    </div>
                </div>


                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Client Approved Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_client_on" name="approvals_info_client_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_clientapproveddateedit">
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Code
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editrelease.approvals_info_code" id="editreleaseapprovals_info_code" name="approvals_info_code" required ng-change="edit_approvals_info_code_change($event)">
                                <option value="">-All-</option>
                                <option value="U">U - Under Review </option>
                                <option value="A">A - Approved</option>
                                <option value="B">B - Approved As noted</option>
                                <option value="C">C - Approved as noted Resubmit</option>
                                <option value="H">H - ON Hold</option>
                                <option value="X">X - Canceled</option>
                                <option value="F">F - FOR INFORMATION</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload PDF
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" ng-model="editrelease.pdffile" name="pdffile" class="nafco-inputs">
                        </div>
                    </div>
                </div>

                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="editrelease.approvals_info_remarks" name="approvals_info_remarks" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>


            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('editRevision').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="drawing_approvals_edit.$invalid" type="submit" class="ism-btns btn-save" id="update_d_approvals_btn">
                        <i ng-if="drawing_approvals_edit.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!drawing_approvals_edit.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>