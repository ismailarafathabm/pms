<div class="ism-dialogbox" id="myModal_terms">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{'Add New Terms' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('myModal_terms').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="add_new_terms" ng-submit="new_terms_add()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                S.No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="payment_terms_number" name="payment_terms_number" id="payment_terms_number" class="nafco-inputs" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Terms
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="terms_add_new" name="terms_add_new" id="terms_add_new" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('myModal_terms').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="add_new_terms.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="add_new_terms.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!add_new_terms.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="ism-dialogbox" id="myModal_termsedit">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-pencil"></span>
                    {{'Edit Terms' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('myModal_termsedit').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="edit_new_terms" ng-submit="new_terms_edit()">
                <div class="dialog-body">
                    <div class="dialog-row-sm nodis">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                id
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="editterms.payment_terms_id" name="payment_terms_id" id="payment_terms_id" class="nafco-inputs" required></input>
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
                                <input type="text" ng-model="editterms.payment_terms_number" name="payment_terms_number" id="payment_terms_number_edit" class="nafco-inputs" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Terms
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="editterms.payment_terms_descripton" name="payment_terms_descripton" id="payment_terms_descripton" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('myModal_termsedit').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="edit_new_terms.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="edit_new_terms.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!edit_new_terms.$invalid" class=" fa fa-pencil" style="color:#84cccf"></i>
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>