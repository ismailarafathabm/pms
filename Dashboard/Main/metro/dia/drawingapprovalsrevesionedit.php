<div class="ism-metro-project-dialog" id="editRevision">
    <div class="ism-metro-project-dialog-container sm">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    METRO APPROVALS
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" onclick="document.getElementById('editRevision').style.display='none'">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            # Drawing Number : {{editrelease.approvals_info_drawing_no}} - Edit Revision
        </div>
        <form id="edit_drawing_approvals" name="drawing_approvals_edit" enctype="multipart/form-data" autocomplete="off">
            <div class="ism-metro-project-dialog-main-body">

                <div class="ism-metro-project-mainbody-row nodis">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"># Project </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_project_id" name="project_code" id="project_code" required readonly/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row nodis">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"># R.A.Code  </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_drawing_token" name="approvals_token" id="approvals_token" required readonly/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row nodis">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">Revision Token </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_token" name="approvals_info_token" id="approvals_info_token" required readonly/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row nodis">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"># Drawing No </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_drawing_no" id="approvals_draw_no" name="approvals_draw_no" required readonly/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label"> # Revision No </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_reveision_no" name="approvals_info_reveision_no" class="nafco-inputs naf" required/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">  # Sub </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_sub" name="approvals_info_sub" class="nafco-inputs" required/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">  Submited On</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_submited_on" name="approvals_info_submited_on" placeholder="dd-mm-yyyy"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_rsubmitedon" required/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">  Received on </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_received_on" name="approvals_info_received_on" placeholder="dd-mm-yyyy"   placeholder="dd-mm-yyyy"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_editrecivedon" required/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">   Client Approved Date</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_client_on" name="approvals_info_client_on" placeholder="dd-mm-yyyy"   placeholder="dd-mm-yyyy"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_clientapproveddateedit" required/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">  Code</div>
                        <div class="ism-metro-project-mainbody-inputs">
                        <select class="ism-metro-inputs" ng-model="editrelease.approvals_info_code" name="approvals_info_code" required>
                                <option value="">-select-</option>                                
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

                
                
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">    Upload PDF</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="file" class="ism-metro-inputs" ng-model="editrelease.pdffile" name="pdffile"/>
                        </div>
                    </div>
                </div>

                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">  Remark </div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <textarea rows='3' type="text" class="ism-metro-inputs"  ng-model="editrelease.approvals_info_remarks" name="approvals_info_remarks" required>
                            </textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ism-metro-project-dialog-footer">
                <div class="ism-metro-project-dialog-footer-buttons">
                    <div class="ism-metro-left-button-group">
                        <button type="button" class="ism-metro-button ism-metro-danger" onclick="document.getElementById('editRevision').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                    <div class="ism-metro-left-button-right">
                        <button type="submit" class="ism-metro-button ism-metro-success" ng-disabled="drawing_approvals_edit.$invalid || isloadingsave">
                            <i class="fa fa-check"></i>
                            Save
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>