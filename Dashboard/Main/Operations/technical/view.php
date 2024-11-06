<div class="ism-dialogbox" id="dia_viewTechApprovals">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                View Approval Informations.....
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_viewTechApprovals').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <div class="dialog-row">
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Approval For
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input type="text" ng-model="viewapprovalsx.approval_type_name" name="approvals_adate" id="approvals_adate" class="nafco-inputs" required readonly>
                        <input type="text" ng-model="viewapprovalsx.approvals_token" name="approvals_token" id="approvals_token" class="nafco_inputs cell-inputs" style="display:none">
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Approval Date
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_adate" name="approvals_adate" id="approvals_adate" class="nafco-inputs" required>
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
                        <input readonly type="text" ng-model="viewapprovalsx.approvals_givenby" name="approvals_givenby" id="approvals_givenby" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Forwared To Tech
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_ftotech" name="approvals_ftotech" id="approvals_ftotech" class="nafco-inputs" required>
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
                        <input readonly type="text" ng-model="viewapprovalsx.approvals_tmanager" name="approvals_tmanager" id="approvals_tmanager" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Return From Tech Manager
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_rftmanger" name="approvals_rftmanger" id="approvals_rftmanger" class="nafco-inputs" required>
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
                        <input readonly type="text" ng-model="viewapprovalsx.approvals_tengineer" name="approvals_tengineer" id="approvals_tengineer" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Return From Tech Engineer
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_rftmanager" name="approvals_rftmanager" id="approvals_rftmanager" class="nafco-inputs" required>
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
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_salse_dep" name="approvals_salse_dep" id="approvals_salse_dep" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Costing Department
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_costing_dep" name="approvals_costing_dep" id="approvals_costing_dep" class="nafco-inputs" required>
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
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_materials_dep" name="approvals_materials_dep" id="approvals_materials_dep" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Purchasing Department
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_purchasing_dep" name="approvals_purchasing_dep" id="approvals_purchasing_dep" class="nafco-inputs" required>
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
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_engineering_dep" name="approvals_engineering_dep" id="approvals_engineering_dep" class="nafco-inputs" required>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Release Date
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" placeholder="dd-mm-yyyy" ng-model="viewapprovalsx.approvals_rdate" name="approvals_rdate" id="approvals_rdate" class="nafco-inputs" required>
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
                        <textarea readonly ng-model="viewapprovalsx.approvals_remarks" name="approvals_remarks" id="approvals_remarks" class="nafco-inputs" required></textarea>
                    </div>
                </div>
                <div class="dialog-frm-ctrls">
                    <div class="dialog-frm-lable">
                        Status
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input readonly type="text" ng-model="viewapprovalsx.approvals_status" name="docu" id="docu" class="nafco-inputs">                        
                    </div>
                </div>
            </div>
        </div>
        <div class="dialog-foot">
            <div class="dialog-foot-buttons" style="float:right">
                <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_viewTechApprovals').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>