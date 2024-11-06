<div class="filterdialog" id="dia_edit_varation">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="filterheadertext">
                    EDIT VARIATIONS.
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_edit_varation').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="update_variation_edit" name="edit_update_variation" ng-submit="update_variation_edit_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Contract Number</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_project" ng-model="editvariations.revison_project" class="new-inputs-black" required readonly>
                            <input type="text" name="variation_id" ng-model="editvariations.variation_id" class="new-inputs-black" required style="display:none" readonly>
                            <input type="text" name="variation_token" ng-model="editvariations.variation_token" class="new-inputs-black" required style="display:none" readonly>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="new-lable">To Date</div>
                        <div class="inputitmes">
                            <input type="text" name="enddate" ng-model="x.enddate" class="new-inputs-black" required placeholder="d-M-Y" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="filtermanpower_estdate">
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="new-lable">Project Name</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_project_name" ng-model="editvariations.revison_project_name" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Location</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_project_location" ng-model="editvariations.revison_project_location" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Ref No P1</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_refno_p1" ng-model="editvariations.revison_refno_p1" class="new-inputs-black" required ng-keyup="refnojoin_edit($event)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Ref No P2</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_refno_p2" ng-model="editvariations.revison_refno_p2" class="new-inputs-black" required ng-keyup="refnojoin_edit($event)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Ref No P3</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_refno_p3" ng-model="editvariations.revison_refno_p3" class="new-inputs-black" required ng-keyup="refnojoin_edit($event)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Ref No P4</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_refno_p4" ng-model="editvariations.revison_refno_p4" class="new-inputs-black" required ng-keyup="refnojoin_edit($event)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Ref No</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_refno" ng-model="editvariations.revison_refno" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Revision no</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_no" ng-model="editvariations.revison_no" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Atten</div>
                        <div class="inputitmes">
                            <input type="text" name="revison_atten" ng-model="editvariations.revison_atten" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Date</div>
                        <div class="inputitmes">
                            <input type="text" ng-model="editvariations.variation_date_n" name="revision_date" class="new-inputs-black" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Contractor/Client</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_to" ng-model="editvariations.revision_to" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Subject</div>
                        <div class="inputitmes">
                            <select class="new-inputs-black" ng-model="editvariations.revision_subject" name="revision_subject" required>
                            <option value="">-Select-</option>
                                <option ng-repeat="y in sublist123" value="{{y.v_sub_id}}">{{y.v_sub_name | uppercase}}</option>
                            </select>
                            <button  type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-variationsubject').style.display='flex';document.getElementById('addnewsubjectname').focus();">
                                <i class="fa fa-plus" style="margin:0px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Description</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_description" ng-model="editvariations.revision_description" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Amount</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_amount" ng-model="editvariations.revision_amount" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Remarks</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_remark" ng-model="editvariations.revision_remark" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Region </div>
                        <div class="inputitmes">
                            <select class="new-inputs-black" name="revision_region" ng-model="editvariations.revision_region" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in listregion" value="{{x.region_id}}">{{x.region_name | uppercase}}</option>
                            </select>
                            <button type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-region').style.display='flex';document.getElementById('addnewregionname').focus();">
                                <i class="fa fa-plus" style="margin:0px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Sales Man</div>
                        <div class="inputitmes">
                            <select class="new-inputs-black" ng-model="editvariations.revision_salesman" name="revision_salesman" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in salesmanlist" value="{{x.salesman_code}}">{{x.salesman_code}} - {{x.salesman_name | uppercase}}</option>
                            </select>
                            <button type="button" class="ism-btns btn-save" style="padding:2px 5px" onclick="document.getElementById('new-salesmanadd').style.display='flex';document.getElementById('addsalesmancode').focus();">
                                <i class="fa fa-plus" style="margin:0px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Upload File</div>
                        <div class="inputitmes">
                            <input type="file" name="pdffile" class="new-inputs-black">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_edit_varation').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>

                <div class="leftbuttons">
                    <button ng-click="removevariations(editvariations.revison_project,editvariations.variation_token)" class="closenewbutton" type="button" style="margin-right:10px;color:red">
                    <i class="fa fa-trash"></i>
                        Remove
                    </button>
                    <button type="submit" class="savenewbutton" ng-disabled="edit_update_variation.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>