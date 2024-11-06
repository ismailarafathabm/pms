<div class="ism-dialogbox" id="diaeditprojectinformations">
    <div class="dia_main-bodyinfos">
        <div class="ism-dialog-body" style="max-width:1200px">
            <div class="dialog-head">
                <div class="dialog-head-title">
                    <span class="fa fa-pencil"></span>
                    {{'Edit Project Informations...' | uppercase}}
                </div>
                <div class="dialog-closebutton" onclick="document.getElementById('diaeditprojectinformations').style.display='none'">
                    <i class="fa fa-times"></i>
                </div>
            </div>
            <form ng-submit="updateprojectinfo()" name="newprojectAdd">
                <div class="dialog-body">
                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                #Contract No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_no" name="project_no" id="project_no" class="nafco-inputs" required readonly>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Project Name
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_name" name="project_name" id="project_name" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Contractor Name
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_cname" name="project_cname" id="project_cname" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Location
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_location" name="project_location" id="project_location" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Contract Sign Date
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_singdate" name="project_singdate" id="project_singdate" class="nafco-inputs" style="width:100%" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_csigdate">
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Remark
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <select ng-model="newproject.project_sing_description" name="project_sing_description" id="project_sing_description" class="nafco-inputs" style="width:100%" required>
                                    <option value="">-Select-</option>
                                    <option value="NAFCO Signed">NAFCO Signed</option>
                                    <option value="Client Signed">Client Signed</option>
                                    <option value="Released by finance">Released by finance</option>
                                    <option value="Letter Of intent">Letter Of intent</option>
                                    <option value="Released by Management">Released by Management</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Duration (in Months)
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input ng-model="newproject.project_contract_duration" name="project_contract_duration" id="project_contract_duration" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Remark
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="newproject.project_contract_description" name="project_contract_description" id="project_contract_description" class="nafco-inputs" style="width:100%" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Contact Person
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_contact_person" name="project_contact_person" id="project_contact_person" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Contact No
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_contact_no" name="project_contact_no" id="project_contact_no" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Sales Representative
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.Sales_Representative" name="Sales_Representative" id="Sales_Representative" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Penalty
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <textarea ng-model="newproject.project_penalty" name="project_penalty" id="project_penalty" class="nafco-inputs" style="width:100%" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Expiry Date
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_expiry_date" name="project_expiry_date" id="project_expiry_date" class="nafco-inputs" style="width:100%" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_cnexpdate">
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Remark
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.project_remarks" name="project_remarks" id="project_remarks" class="nafco_inputs" style="width:100%" required>
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Project Amount
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="number" ng-model="newproject.project_amount" name="project_expiry_date" id="project_expiry_date" class="nafco-inputs" style="width:100%" required placeholder="dd-mm-yyyy" style="color:red">
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                First Paid Amount
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="number" ng-model="newproject.project_first_advance_amount" name="project_remarks" id="project_remarks" class="nafco-inputs" style="width:100%" required style="color:green">
                            </div>
                        </div>
                    </div>

                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Payment Date
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" data-week-start="1" ng-model="newproject.project_advacne_date" name="project_advacne_date" id="project_advacne_date" class="nafco-inputs" style="width:100%" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_paymentdate">
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Remark
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-model="newproject.advance_amount_remark" name="advance_amount_remark" id="advance_amount_remark" class="nafco-inputs" style="width:100%" required>
                            </div>
                        </div>
                    </div>



                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Handover Status
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-if="newproject.project_hadnover === '0'" name="project_hadnover" id="project_hadnover" class="nafco-inputs" style="width:100%" value="-" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '1'" name="project_hadnover" id="project_hadnover" class="nafco-inputs" style="width:100%" value="INITIAL HANDING OVER" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '2'" name="project_hadnover" id="project_hadnover" class="nafco-inputs" style="width:100%" value="PARTIAL HANDING OVER" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '3'" name="project_hadnover" id="project_hadnover" class="nafco-inputs" style="width:100%" value="FINAL HANDING OVER" readonly>
                            </div>
                        </div>
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Handover Date
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <input type="text" ng-if="newproject.project_hadnover === '0'" name="project_handover_date" id="project_handover_date" class="nafco-inputs" style="width:100%" value="-" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '1'" name="project_handover_date" id="project_handover_date" class="nafco-inputs" style="width:100%" value="{{newproject.project_handover_date}}" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '2'" name="project_handover_date" id="project_handover_date" class="nafco-inputs" style="width:100%" value="{{newproject.project_handover_date}}" readonly>
                                <input type="text" ng-if="newproject.project_hadnover === '3'" name="project_handover_date" id="project_handover_date" class="nafco-inputs" style="width:100%" value="{{newproject.project_handover_date}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="dialog-row">
                        <div class="dialog-frm-ctrls">
                            <div class="dialog-frm-lable">
                                Region
                            </div>
                            <div class="dialog-frm-cemi">:</div>
                            <div class="dialog-frm-controls">
                                <select ng-model="newproject.projectRegion" name="projectRegion" id="projectRegion" class="nafco-inputs" style="width:100%" required>
                                    <option value="">-Select-</option>
                                    <option value="center region">Center Region</option>
                                    <option value="western region">Western Region</option>
                                </select>
                            </div>
                        </div>

                        <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="newproject.project_type" name="project_type" id="project_type" class="nafco-inputs" style="width:100%" required>
                                <option value="">-Select-</option>
                                <option value="project">Project</option>
                                <option value="villa project">Villa Project</option>
                                <option value="maintenance work">Maintenance Work</option>
                                <option value="metro project">Metro Project</option>
                            </select>
                        </div>
                    </div>

                    </div>
                </div>

                <div class=" dialog-foot">
                    <div class="dialog-foot-buttons">
                        <button type="button" class="ism-btns btn-close" onclick="document.getElementById('diaeditprojectinformations').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>

                        <button ng-if="newproject.project_hadnover !=='3'" ng-disabled="newprojectAdd.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                            <i ng-if="edit_new_cuttinglist.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                            <i ng-if="!edit_new_cuttinglist.$invalid" class=" fa fa-pencil" style="color:#84cccf"></i>
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>