<div class="ism-metro-project-dialog" id="ism_dia_metro_newapprovals">
    <div class="ism-metro-project-dialog-container md">
        <div class="ism-metro-project-dialog-container-titles">
            <div class="ism-metro-project-dialog-titles-title">
                <div class="ism-metro-project-dialog-title-main-headers">
                    METRO APPROVALS
                </div>
            </div>
            <div class="ism-metro-project-dialog-title-closebtn" onclick="document.getElementById('ism_dia_metro_newapprovals').style.display='none'">
                <i class='fa fa-times'></i>
            </div>
        </div>
        <div class="ism-metro-project-dialog-container-subtitle">
            <i class="fa fa-info-circle"></i>
            {{newtechapprovals.title}}
        </div>
        <form name="approvalnew" id="newapprovals" enctype="multipart/form-data" autocomplete="false">
            <div class="ism-metro-project-dialog-main-body">
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">Project</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <select class="ism-metro-inputs" id="approvals_projectid" name="approvals_projectid" ng-model="newtechapprovals.data.approvals_projectid" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in projects" value="{{x.project_no_enc}}">{{x.project_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Approval For</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <select class="ism-metro-inputs" id="afor" name="afor" ng-model="newtechapprovals.data.afor" required>
                                <option value="">-select-</option>
                                <option ng-repeat="x in approvalstypes | orderBy:'approval_type_name'" value="{{x.approval_type_id}}">{{x.approval_type_name}}</option>
                            </select>
                            <button type="button" class="ism-metro-new-addbutton" onclick="document.getElementById('ism_dia_metro_approvals_type').style.display='flex'">ADD</button>
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Approval Date</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="Adate" name="Adate" ng-model="newtechapprovals.data.Adate" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Given By</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input list="givenbylist" type="text" class="ism-metro-inputs" id="givenby" name="givenby" ng-model="newtechapprovals.data.givenby" required />
                            <datalist id="givenbylist">
                                <option ng-repeat="x in givenby" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Forwared To Tech</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="ftotech" name="ftotech" ng-model="newtechapprovals.data.ftotech" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Tech Manager</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="engmanager" name="engmanager" ng-model="newtechapprovals.data.engmanager" required />
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Return From Tech Manager</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="rfromeng" name="rfromeng" ng-model="newtechapprovals.data.rfromeng" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Tech Engineer</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="techengineer" name="techengineer" ng-model="newtechapprovals.data.techengineer" required />
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Return From Tech Engineer</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="rftengi" name="rftengi" ng-model="newtechapprovals.data.rftengi" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Sales Department</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="salesDep" name="salesDep" ng-model="newtechapprovals.data.salesDep" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Costing Department</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="costingDep" name="costingDep" ng-model="newtechapprovals.data.costingDep" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Materials Department</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="materialdep" name="materialdep" ng-model="newtechapprovals.data.materialdep" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Purchasing Department</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="purchasedep" name="purchasedep" ng-model="newtechapprovals.data.purchasedep" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Engineering Department</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="engDep" name="engDep" ng-model="newtechapprovals.data.engDep" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Release Date</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="text" class="ism-metro-inputs" id="release" name="release" ng-model="newtechapprovals.data.release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_aproveddate" />
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">
                    <div class="ism-metro-project-mainbody-controllers sm-ctrl">
                        <div class="ism-metro-project-mainbody-label">Remark</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <textarea rows='3' type="text" class="ism-metro-inputs" id="remark" name="remark" ng-model="newtechapprovals.data.remark" required>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="ism-metro-project-mainbody-row">                    
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Status</div>
                        <div class="ism-metro-project-mainbody-inputs">

                            <select class="ism-metro-inputs" id="astatus" name="astatus" ng-model="newtechapprovals.data.astatus" required>
                                <option value="a">Approval Not Released</option>
                                <option value="b">Approval Released</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-metro-project-mainbody-controllers">
                        <div class="ism-metro-project-mainbody-label">Document</div>
                        <div class="ism-metro-project-mainbody-inputs">
                            <input type="file" class="ism-metro-inputs" id="docu"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ism-metro-project-dialog-footer">
                <div class="ism-metro-project-dialog-footer-buttons">
                    <div class="ism-metro-left-button-group">
                        <button type="button" class="ism-metro-button ism-metro-danger" onclick="document.getElementById('ism_dia_metro_approvals_type').style.display='none'">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                    <div class="ism-metro-left-button-right">
                        <button type="submit" class="ism-metro-button ism-metro-success" ng-disabled="approvalnew.$invalid || newtechapprovals.isloading">
                            <i class="{{newtechapprovals.buttonicon}}"></i>
                            {{newtechapprovals.buttontitle}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>