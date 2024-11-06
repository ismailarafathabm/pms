<div class="ism-dialogbox" id="new_contract_pdf">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{'Upload Contract PDF File' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('new_contract_pdf').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form id="save_contract_pdf" name="contract_save">
                <div class="dialog-body">
                    <div class="dialog-row-sm nodis">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Project ID
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="viewproject.project_no_enc" name="project_project_no" class="nafco-inputs" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Project No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="viewproject.project_no" name="project_project_dummy" class="nafco-inputs" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Upload File
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="file" ng-model="drawing_types_new" name="pdffile" class="nafco-inputs">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new_contract_pdf').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="contract_save.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="contract_save.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!contract_save.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>