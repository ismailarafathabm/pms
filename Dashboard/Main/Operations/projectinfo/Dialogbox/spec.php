<!-- edit dialogs -->
<div class="ism-dialogbox" id="myModal_spec">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    {{dialog_title}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('myModal_spec').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="edit_aluminium_spec" ng-submit="aluminium_spec_edit()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Specification
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea name="edit_spec_remark_aluminium" ng-model="edit_spec_remark_aluminium" id="edit_spec_remark_aluminium" class="nafco-inputs" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('myModal_spec').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="edit_aluminium_spec.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="edit_aluminium_spec.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!edit_aluminium_spec.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit dialogs -->


<!-- add new spec -->
<div class="ism-dialogbox" id="diaNewspec">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:820px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-plus"></span>
                    Project Specifications
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('diaNewspec').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <div class="dialog-body">
                <div class="dia-row-spec">
                    <form name="save_aluminium_spec" ng-submit="aluminium_spec_save()">
                        <div class="dia-col-spec">
                            <div class="dia-col-spec-lable">
                                Aluminium
                            </div>
                            <div class="dia-col-spec-semi">
                                :
                            </div>
                            <div class="dia-col-spec-frmctrlgroup">
                                <textarea class="nafco-inputs spec-inputs" name="spec_remark_aluminium" ng-model="spec_remark_aluminium" id="spec_remark_aluminium" required></textarea>
                            </div>
                            <div class="dia-col-spec-savebtn">
                                <button ng-disabled="save_aluminium_spec.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                                    <i ng-if="save_aluminium_spec.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                                    <i ng-if="!save_aluminium_spec.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="dia-row-spec">
                    <form name="save_finish_spec" ng-submit="finish_spec_save()">
                        <div class="dia-col-spec">
                            <div class="dia-col-spec-lable">
                                Finish
                            </div>
                            <div class="dia-col-spec-semi">
                                :
                            </div>
                            <div class="dia-col-spec-frmctrlgroup">
                                <textarea class="nafco-inputs" name="spec_remark_finish" ng-model="spec_remark_finish" id="spec_remark_finish" required></textarea>
                            </div>
                            <div class="dia-col-spec-savebtn">
                                <button ng-disabled="save_finish_spec.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                                    <i ng-if="save_finish_spec.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                                    <i ng-if="!save_finish_spec.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="dia-row-spec">
                    <form name="save_hardware_spec" ng-submit="hardware_spec_save()">
                        <div class="dia-col-spec">
                            <div class="dia-col-spec-lable">
                                Hardwares
                            </div>
                            <div class="dia-col-spec-semi">
                                :
                            </div>
                            <div class="dia-col-spec-frmctrlgroup">
                                <textarea type="text" class="nafco-inputs" name="spec_remark_hardware" ng-model="spec_remark_hardware" id="spec_remark_hardware" required></textarea>
                            </div>
                            <div class="dia-col-spec-savebtn">
                                <button ng-disabled="save_hardware_spec.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                                    <i ng-if="save_hardware_spec.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                                    <i ng-if="!save_hardware_spec.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <form name="save_glass_spec" ng-submit="glass_spec_save()">
                    <div class="dia-row-spec">
                        <div class="dia-col-spec">
                            <div class="dia-col-spec-lable">
                                Glass
                            </div>
                            <div class="dia-col-spec-semi">
                                :
                            </div>
                            <div class="dia-col-spec-frmctrlgroup">
                                <select id="glass_types" name="glass_type" ng-model="project.glass_type" class="nafco-inputs" required>
                                    <option value="">-Select-</option>
                                    <option ng-repeat="g in glass_types" value="{{g.class_type_name | lowercase}}">{{g.class_type_name | uppercase}}</option>
                                </select>
                                <button onclick="document.getElementById('dianewglasstypeadd').style.display='block'" id="open_new_glassType" class="ism-btns btn-close" type="button" style="margin-left:3px;padding: 5px 5px;"><i class="fa fa-plus"></i></button>
                            </div>


                        </div>
                    </div>
                    <div class="dia-row-spec">
                        <div class="dia-col-spec">
                            <div class="dia-col-spec-lable">
                                Specification
                            </div>
                            <div class="dia-col-spec-semi">
                                :
                            </div>
                            <div class="dia-col-spec-frmctrlgroup">
                                <textarea id="glass_spec" name="glass_spec" ng-model="project.glass_spce" class='nafco-inputs' required></textarea>

                            </div>
                            <div class="dia-col-spec-savebtn">
                                <button ng-disabled="save_glass_spec.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                                    <i ng-if="save_glass_spec.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                                    <i ng-if="!save_glass_spec.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('diaNewspec').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add new spec -->


<!-- glass spec type new -->
<div class="ism-dialogbox" id="dianewglasstypeadd">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:620px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-pencil"></span>
                    {{'Edit Terms' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('dianewglasstypeadd').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form name="add_glassType" ng-submit="glassType_add()">
                <div class="dialog-body">
                    <div class="dialog-row-sm">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Glass Type
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" name="glassType" ng-model="glassType" id="glassType" class="nafco-inputs" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dianewglasstypeadd').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                        <button ng-disabled="add_glassType.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="add_glassType.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!add_glassType.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- glass spec type new -->