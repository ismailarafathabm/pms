<div class="ism-dialogbox" id="dia_supersedeTechApprovals">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Approval Supersede
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_supersedeTechApprovals').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="edit_sede_approval" id="sede_edit_approvals" ng-submit="supersedenow()">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Approval For
                            <button type="button" onclick="document.getElementById('dia_newApprovalsType').style.display='block';" class="ism-btns btn-close" style="margin-left:0px; padding:2px 3px">
                                <i class="fa fa-plus">
                                </i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="viewapprovalssede.approval_type" name="approval_type" id="approval_type" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="xs in approval_types" value='{{xs.approval_type_id}}'>{{xs.approval_type_name}}</option>
                            </select>
                            <input type="text" ng-model="viewapprovalssede.approvals_token" name="approvals_token" id="approvals_token" class="nafco_inputs cell-inputs" style="display:none">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Approval Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_adate" name="approvals_adate" id="approvals_adate" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_approveddate">
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Given By
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="viewapprovalssede.approvals_givenby" name="approvals_givenby" id="approvals_givenby" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Forwared To Tech
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_ftotech" name="approvals_ftotech" id="approvals_ftotech" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_forwaredtotech">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Tech Manager
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="viewapprovalssede.approvals_tmanager" name="approvals_tmanager" id="approvals_tmanager" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Return From Tech Manager
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_rftmanger" name="approvals_rftmanger" id="approvals_rftmanger" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_rtnfrmtechmanager">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Tech Engineer
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="viewapprovalssede.approvals_tengineer" name="approvals_tengineer" id="approvals_tengineer" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Return From Tech Engineer
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_rftmanager" name="approvals_rftmanager" id="approvals_rftmanager" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_retunfromtechengr">
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sales Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_salse_dep" name="approvals_salse_dep" id="approvals_salse_dep" class="nafco-inputs" required sng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_salesdepartments">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Costing Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_costing_dep" name="approvals_costing_dep" id="approvals_costing_dep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_costingdepartments">
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Materials Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_materials_dep" name="approvals_materials_dep" id="approvals_materials_dep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_meterialdeparment">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Purchasing Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_purchasing_dep" name="approvals_purchasing_dep" id="approvals_purchasing_dep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_purchasedep">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Engineering Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_engineering_dep" name="approvals_engineering_dep" id="approvals_engineering_dep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aprovalsengdep">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Release Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalssede.approvals_rdate" name="approvals_rdate" id="approvals_rdate" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_approvals_rdate">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea ng-model="viewapprovalssede.approvals_remarks" name="approvals_remarks" id="approvals_remarks" class="nafco-inputs" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Document
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" ng-model="viewapprovalssede.docu" name="docu" id="docu" class="nafco-inputs" ng-if='viewapprovalssede.approvals_status === "b"'>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Status
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="viewapprovalssede.approvals_status" name="approvals_status" id="approvals_status" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option value="a">{{'approval not released' | uppercase}}</option>
                                <option value="c">{{'approval under process' | uppercase}}</option>
                                <option value="b">{{'approval released' | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_supersedeTechApprovals').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="edit_sede_approval.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="edit_sede_approval.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!edit_sede_approval.$invalid" class=" fa fa-upload" style="color:#84cccf"></i>
                        Supersede Now
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>