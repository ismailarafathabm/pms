<div class="ism-dialogbox" id="type_add">
    <div class="ism-dialog-body" style="max-width:650px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                BOQ - ADD NEW TYPE
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('type_add').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="new_type" ng-submit="type_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="ptype_name" ng-model="ptype_name" id="ptype_name" class='nafco-inputs' required>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('type_add').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="new_type.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="new_type.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!new_type.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="ism-dialogbox" id="finish_add">
    <div class="ism-dialog-body" style="max-width:650px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                BOQ - ADD NEW Finish
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('finish_add').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="new_finish" ng-submit="finish_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Finish
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="finish_name" ng-model="finish_name" id="finish_name" class='nafco-inputs' required>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('finish_add').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="new_finish.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="new_finish.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!new_finish.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="ism-dialogbox" id="systype_add">
    <div class="ism-dialog-body" style="max-width:650px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                BOQ - ADD NEW SYSTEM
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('systype_add').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="new_system" ng-submit="system_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            System Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="system_name" ng-model="system_name" id="system_name" class='nafco-inputs' required>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('systype_add').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="new_system.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="new_system.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!new_system.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="ism-dialogbox" id="units_add">
    <div class="ism-dialog-body" style="max-width:650px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                BOQ - ADD NEW UNITS
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('units_add').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="new_unit" ng-submit="unit_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Unit Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="unit_name" ng-model="unit_name" id="unit_name" class='nafco-inputs' required>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('units_add').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="new_unit.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="new_unit.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!new_unit.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="ism-dialogbox" id="boq_notes_new">
    <div class="ism-dialog-body" style="max-width:650px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                BOQ NOTES
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('boq_notes_new').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="notes_boq_new" ng-submit="boq_notes_new()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            BOQ NO
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="boq_item_no" ng-model="boq_item_no_notes" id="boq_item_no" class='nafco-inputs' required readonly>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Notes
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemNotes" type="text" name="boq_notes" ng-model="boq_notes" id="boq_notes" class='nafco-inputs' required>
                            <datalist id="boqItemNotes">
                                <option ng-repeat="x in boqItemNotes">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('boq_notes_new').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="notes_boq_new.$invalid" type="submit" class="ism-btns btn-save">
                        <i ng-if="notes_boq_new.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!notes_boq_new.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>