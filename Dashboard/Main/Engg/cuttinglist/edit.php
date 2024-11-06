<div class="ism-dialogbox" id="edit-cuttinglist">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Cutting List & MO'Released To Prodcution Department - Edit
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('edit-cuttinglist').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form enctype="multipart/form-data" name="edit_new_cuttinglist" id="save_edit_cuttinglist">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contract Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_token" name="cuttinglist_token" id="cuttinglist_token" required readonly style="display:none;">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_project_id" name="cuttinglist_project_id" id="cuttinglist_project_id" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editcuttinglist.cuttinglistfor" name="cuttinglistfor" id="cuttinglistfor">
                                <option value="">-Select-</option>
                                <option value="1">BOQ ITEMS</option>
                                <option value="2">{{'miscellaneous items' | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            BOQ Item No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_boqitem" name="cuttinglist_boqitem" id="cuttinglist_boqitem">
                                <option value="">-Select-</option>
                                <option ng-repeat="boqs in measurements.boq" value="{{boqs.item_no}}">{{boqs.item_no}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Cl.Ref No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_clrefno" name="cuttinglist_clrefno" id="cuttinglist_clrefno" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Cl.Date :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_editcldate" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_cldaterelease_n" name="cuttinglist_cldaterelease" id="cuttinglist_cldaterelease" required placeholder='dd-mm-yyyy'>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Mo.Ref.No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_morefno" name="cuttinglist_morefno" id="cuttinglist_morefno" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            MO. Released TO Acct
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasetoact" type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_moreleasedtoacct_n" name="cuttinglist_moreleasedtoacct" id="cuttinglist_moreleasedtoacct" required placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            MO. Released TO Production
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_moreleasetoproductions" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_moreleasedtoproduction_n" name="cuttinglist_moreleasedtoproduction" id="cuttinglist_moreleasedtoproduction" required placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Released To
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_releasedto" name="cuttinglist_releasedto" id="cuttinglist_releasedto" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Done By
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_doneby" name="cuttinglist_doneby" id="cuttinglist_doneby" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Marking Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_markingtype" name="cuttinglist_markingtype" id="cuttinglist_markingtype" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Location
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_location" name="cuttinglist_location" id="cuttinglist_location" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_descripton" name="cuttinglist_descripton" id="cuttinglist_descripton" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            HEIGHT
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_height" name="cuttinglist_height" id="cuttinglist_height_edit" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Width
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_width" name="cuttinglist_width" id="cuttinglist_width_edit" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Area
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" ng-click="calculates_area2()">
                                <i class="fa fa-calculator"></i>
                                Calculate
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_area" name="cuttinglist_area" id="cuttinglist_area_edit" required ng-change='totaracalc1()'>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_qty" name="cuttinglist_qty" id="cuttinglist_qty" required ng-change='totaracalc1()'>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty Type
                            <button id="create_new_qtytype" type="button" class="ism-btns btn-save" style="padding:2px 4px;" onclick="document.getElementById('new-qtytype').style.display='block';document.getElementById('qtytypenew').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editcuttinglist.qty_types" name="cuttinglistqtytype" id="cuttinglistqtytype" required>
                                <option value="">-select-</option>
                                <option ng-repeat="qx in ctqtytype" value="{{qx.qty_type_id}}">
                                    {{qx.cuttinglist_qty_type | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Total Area
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" ng-click="calculates_totarea()">
                                <i class="fa fa-calculator"></i>
                                Calculate
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_totarea" name="cuttinglist_totarea" id="cuttinglist_totarea" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Glass Ref No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_classrefno" name="cuttinglist_classrefno" id="cuttinglist_classrefno" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="order in glassorder" value="{{order}}">{{order}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            SHEET TYPE
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_sheettp" name="cuttinglist_sheettp" id="cuttinglist_sheettp" required>
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
                            <textarea class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_remarks" name="cuttinglist_remarks" id="cuttinglist_remarks" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            SECTION
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editcuttinglist.cuttinglist_section" name="cuttinglist_section" id="cuttinglist_section" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload (PDF File only)
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" class="nafco-inputs" name="pdffile[]" id="pdffile" multiple>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('edit-cuttinglist').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button type="button" name="remove-button" ng-click="remove_items(editcuttinglist.cuttinglist_token,editcuttinglist.cuttinglist_project_id)" class="ism-btns btn-delete">
                        <i class="fa fa-trash"></i>
                        Remove
                    </button>
                    <button ng-disabled="edit_new_cuttinglist.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="edit_new_cuttinglist.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!edit_new_cuttinglist.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>