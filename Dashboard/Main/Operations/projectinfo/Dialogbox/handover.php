<div class="ism-dialogbox" id="handovler_dia">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{'Handing Over' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('handovler_dia').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="handover_new" id="new_handover" ng-submit="new_handover_submit()">
                <div class="dialog-body">

                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Date of Handing Over
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" name="project_handover_date" id="project_handover_date" class="nafco-inputs" placeholder="dd-mm-yyyy" required>

                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                File
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="file" name="pjpdf" id="pjpdf" class="nafco-inputs" accept=".pdf" required>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('handovler_dia').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="handover_new.$invalid || isloading_status" type="submit" class="ism-btns btn-save">
                            <i ng-if="!isloading_status" class=" fa fa-check" style="color:#84cccf"></i>
                            <i ng-if="isloading_status" class="fa fa-cog fa-spin"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>