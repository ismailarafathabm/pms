<div class="ism-dialogbox" id="dia_editvairations">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Edit Variation Entry
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dia_editvairations').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form enctype="multipart/form-data" name="edit_new_variations" id="edit_new_variations">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contract Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_project" name="variation_project_code" id="variation_project_code" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Project Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_project_name" name="variation_project_name" id="variation_project_name" required readonly>
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
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_project_location" name="variation_project_location" id="variation_project_location" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Ref No P1
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_refno_p1" name="variation_refno_p1" id="variation_refno_p1" ng-keyup="refnojoin($event)" required readonly>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Ref No P2
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_refno_p2" name="variation_refno_p2" id="variation_refno_p2" ng-keyup="refnojoin($event)" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Ref No P3
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_refno_p3" name="variation_refno_p3" id="variation_refno_p3" ng-keyup="refnojoin($event)" required ng-blur="GetOldinfo()" readonly>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Ref No P4
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_refno_p4" name="variation_refno_p4" id="variation_refno_p4" ng-keyup="refnojoin($event)" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Ref No
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_refno" name="variation_refno" id="variation_refno" required readonly>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Revision no
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.revision_no" name="revision_no" id="revision_no" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Atten
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_atten" name="variation_atten" id="variation_atten" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_newvariationdates" type="text" class="nafco-inputs" ng-model="editvariations.variation_date" name="variation_date" id="variation_date" placeholder="dd-mm-yyyy" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contractor/Client
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_to" name="variation_to" id="variation_to" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Subject
                            <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-variationsubject').style.display='block';document.getElementById('addnewsubjectname').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editvariations.variation_subject" name="variation_subjectn" id="variation_subjectn" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="y in sublist123" value="{{y.v_sub_id}}">{{y.v_sub_name | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_description" name="variation_description" id="variation_description" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Amount
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_amount" name="variation_amount" id="variation_amount" required="required">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remarks
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="editvariations.variation_remarks" name="variation_remarks" id="variation_remarks" required="required">
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Region
                            <button id="create_new_regiondialog" type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-region').style.display='block';document.getElementById('addnewregionname').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editvariations.variation_region" name="variation_region" id="variation_region" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in listregion" value="{{x.region_id}}">{{x.region_name | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sales Man
                            <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-salesmanadd').style.display='block';document.getElementById('addsalesmancode').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>

                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="editvariations.variation_salesman" name="variation_salesman" id="variation_salesman" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in salesmanlist" value="{{x.salesman_code}}">{{x.salesman_code}} - {{x.salesman_name | uppercase}}</option>
                            </select>
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
                            <input type="file" class="nafco-inputs" name="pdffile" id="pdffile">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Status
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select disabled class="nafco-inputs" ng-model="editvariations.variation_status" name="variation_status" id="variation_status" required>
                                <option value="">-Select-</option>
                                <option value="1">ISSUED FOR APPROVAL</option>
                                <option value="2">APPROVED</option>
                                <option value="3">{{'cancelled' | uppercase}}</option>
                                <option value="4">{{'dummy' | uppercase}}</option>
                                <option value="5">{{'Paid/Invoice' | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="dialog-row" ng-show="editvariations.variation_status !== '1' || editvariations.variation_status !== ''">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload (PDF File only)
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" class="nafco-inputs" name="pdffile" id="pdffile">
                        </div>
                    </div>
                </div>



            </div>
            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-delete" ng-click="removevariations(editvariations.variation_project,editvariations.variation_token)">
                        <i class="fa fa-trash">
                        </i>
                        Delete
                    </button>
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dia_editvairations').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="edit_new_variations.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="edit_new_variations.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!edit_new_variations.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>