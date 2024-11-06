<div class="ism-dialogbox" id="dia_newTechApprovals">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New Approvals
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_newTechApprovals').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="save_approvals_new" name="save_approvals_new" enctype="multipart/form-data">
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
                            <select ng-model="newapprovals.afor" name="afor" id="afor" class="nafco-inputs" required style="width:100%;">
                                <option value="">-Select-</option>
                                <option ng-repeat="xs in approval_types" value='{{xs.approval_type_id}}'>{{xs.approval_type_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Approval Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.Adate" name="Adate" id="Adate" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate">
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
                            <input type="text" ng-model="newapprovals.givenby" name="givenby" id="givenby" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Forwared To Tech
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.ftotech" name="ftotech" id="ftotech" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_ftech">
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
                            <input type="text" ng-model="newapprovals.engmanager" name="engmanager" id="engmanager" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Return From Tech Manager
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.rfromeng" name="rfromeng" id="rfromeng" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="var_rftechmg">
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
                            <input type="text" ng-model="newapprovals.techengineer" name="techengineer" id="techengineer" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_techeng">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Return From Tech Engineer
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.rftengi" name="rftengi" id="rftengi" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_rftecheng">
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
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.salesDep" name="salesDep" id="salesDep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_salesdep">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Costing Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.costingDep" name="costingDep" id="costingDep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_costingdep">
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
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.materialdep" name="materialdep" id="materialdep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_materialdep">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Purchasing Department
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.purchasedep" name="purchasedep" id="purchasedep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_purchasedep">
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
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.engDep" name="engDep" id="engDep" class="nafco-inputs" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_engDep">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Release Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" placeholder="dd-mm-yyyy" ng-model="newapprovals.release" name="release" id="release" class="nafco-inputs" required 
                            ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_relesedate">
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
                            <textarea ng-model="newapprovals.remark" name="remark" id="remark" class="nafco-inputs" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Document
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" ng-model="newapprovals.docu" name="docu" id="docu" class="nafco-inputs">
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
                            <select ng-model="newapprovals.astatus" name="astatus" id="astatus" class="nafco-inputs" required style="width:100%;margin:0 auto;">
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
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_newTechApprovals').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_approvals_new.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_approvals_new.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_approvals_new.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>