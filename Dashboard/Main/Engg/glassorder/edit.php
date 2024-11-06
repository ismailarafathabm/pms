<div class="ism-dialogbox" id="edit-glassorder">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Edit Glass Order
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('edit-glassorder').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form enctype="multipart/form-data" name="edit_new_glassorder" id="edit_new_glassorder">

            <div class="dialog-body">

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Order Token
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.glassorder_token" name="glassorder_token" id="glassorder_token" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contract Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.project_id" name="project_id" id="project_id" required readonly>
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
                            <select class="nafco-inputs" ng-model="edit_glassorders.boq_itemno" name="boq_itemno" id="boq_itemno">
                                <option value="">-Select-</option>
                                <option ng-repeat="boqs in measurements.boq" value="{{boqs.item_no}}">{{boqs.item_no}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Glass Order NO.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.glassorderno" name="glassorderno" id="glassorderno" required>
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
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.doneby" name="doneby" id="doneby" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Release To Purch.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_editReleasetopurchase" class="nafco-inputs" ng-model="edit_glassorders.releasedtopurchase_n" name="releasedtopurchase" id="releasedtopurchase" placeholder="dd-mm-yyyy" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Recived From Purch.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_editRecivedpurchase" class="nafco-inputs" ng-model="edit_glassorders.recivedfrompurchas_n" name="recivedfrompurchas" id="recivedfrompurchas" required placeholder="dd-mm-yyyy">
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
                            <select class="nafco-inputs" ng-model="edit_glassorders.orderstatus" name="orderstatus" id="orderstatus" required>
                                <option value="">-Select-</option>
                                <option value="1">ORDERED</option>
                                <option value="2">PENDING</option>
                                <option value="3">HOLD</option>
                                <option value="4">CANCELLED</option>
                                <option value="5">SUPERSEDED</option>
                                <option value="6">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Supplier
                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='engineering' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-supplier').style.display='block';document.getElementById('new_supplier_name').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>

                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="edit_glassorders.supplier" name="supplier" id="supplier" required>
                                <option value="">-select-</option>
                                <option ng-repeat="supplier in supplier_list" value="{{supplier.supplier_id}}">{{supplier.supplier_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Glass Type
                            <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='engineering' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" id="create_new_glasstype" type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-glasstype').style.display='block';document.getElementById('glasstype_name').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="edit_glassorders.glasstype" name="glasstype" id="glasstype" required>
                                <option value="">-select-</option>
                                <option ng-repeat="gtype in glasstypes" value="{{gtype.glasstype_id}}">{{gtype.glasstype_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Specification
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea type="text" class="nafco-inputs" ng-model="edit_glassorders.glassdescription" name="glassdescription" id="glassdescription" required></textarea>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Marking Location
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.markinglocation" name="markinglocation" id="markinglocation" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input placeholder="numbers only" type="text" class="nafco-inputs" ng-model="edit_glassorders.QTY" name="QTY" id="QTY" required placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remarks
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="edit_glassorders.remarks" name="remarks" id="remarks" required="required">
                        </div>
                    </div>
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
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('edit-glassorder').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='engineering' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'" ng-click="removeglassorder(edit_glassorders.glassorder_token,edit_glassorders.project_id)" type="button" name="remove-button" class="ism-btns btn-delete">
                        <i class="fa fa-trash"></i>
                        Remove
                    </button>
                    <button ng-disabled="edit_new_glassorder.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="edit_new_glassorder.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!edit_new_glassorder.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>