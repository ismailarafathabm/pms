<div class="ism-dialogbox" id="newRevision">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                # Drawing Number : <strong style="color:#235952" id="_drawingno"></strong> - Add New Revision
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('newRevision').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="save_drawing_approvals" name="save_drawing_approvals" enctype="multipart/form-data" autocomplete='off'>
            <div class="dialog-body">
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            # Project  :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" readonly ng-model="newrevisions.project_code" name="project_code" id="project_code" class="nafco-inputs" required>
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
                            <input type="text" readonly ng-model="newrevisions.approvals_token" name="approvals_token" id="approvals_token" class="nafco-inputs" required>
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
                            <input autocomplete="off" readonly type="text" ng-model="newrevisions.approvals_draw_no" id="approvals_draw_no" name="approvals_draw_no" class="nafco-inputs" required>
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
                            <input autocomplete="off" type="text" ng-model="newrevisions.approvals_info_reveision_no" name="approvals_info_reveision_no" id="approvals_info_reveision_no" class="nafco-inputs naf" required>
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
                            <input autocomplete="off" type="text" ng-model="newrevisions.approvals_info_sub" name="approvals_info_sub" id="approvals_info_sub" class="nafco-inputs" required>
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
                            <input autocomplete="off" type="text" ng-model="newrevisions.approvals_info_submited_on" name="approvals_info_submited_on" id="approvals_info_submited_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required 
                            ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_submitedon">
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
                            <input autocomplete="off" type="text" ng-model="newrevisions.approvals_info_received_on" name="approvals_info_received_on" id="approvals_info_received_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_recivedon">
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
                            <input autocomplete="off" type="text" ng-model="newrevisions.approvals_info_client_on" name="approvals_info_client_on" id="approvals_info_client_on" class="nafco-inputs" placeholder="dd-mm-yyyy" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_clientapproveddate">
                        </div>
                    </div>
                </div>

                <div class=" dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Code
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="newrevisions.approvals_info_code" name="approvals_info_code" id="approvals_info_code" required>
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
                            <input type="file" ng-model="newrevisions.pdffile" name="pdffile" class="nafco-inputs">
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
                            <input type="text" ng-model="newrevisions.approvals_info_remarks" name="approvals_info_remarks" id="approvals_info_remarks" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>

               
            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('newRevision').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <!-- <i ng-if="save_drawing_approvals.$invalid" class="fa fa-times" style="color:#cf84c2"></i> -->
                        <i class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>