<div class="ism-dia-box" id="update_project_status">
    <div class="ism-dia-conatiner ism-dia-md">
        <div class="dia-container-header">
            <div class="ism-dia-conatiner-header-txt">MAINTENANCE WORK</div>
            <div class="ism-dia-conatiner-header-closeicon" ng-show="!statusupdate.isload" onclick="document.getElementById('update_project_status').style.display='none'">
                <i class="fa fa-times" style="margin-right:0 !important"></i>
            </div>
        </div>
        <div class="dia-container-subhead">
            <i class="fa fa-info"></i>
            {{statusupdate.title}}
        </div>        
        <form id="update_mworkstatus" ng-submit="update_mworkstatus_submit()" name="mworkstatus_update" autocomplete="off" style="width:100%">
            <div class="dia-container-body loaderdiv" ng-show="statusupdate.isloading">
                <i class="fa fa-cog fa-spin"></i>
            </div>
            <div class="dia-container-body" ng-show="!statusupdate.isloading">
                <div class="dia-body-conatiner gp-10">
                    <div class="ism-dia-body-inputs">
                        <div class="ism-new-project-search-controllers c-h">
                            <div class="ism-new-project-search-controllers-lable">
                                Status
                            </div>
                            <div class="ism-new-project-new-input-controller-controlls">
                                <select class="ism-body-inputs input-new" ng-model="statusupdate.data.mnt_status" name="mnt_status" id="mnt_status" required>
                                    <option value="">-</option>
                                    <option value="2">Close</option>
                                </select>
                            </div>
                        </div>
                        <div class="ism-new-project-search-controllers c-h">
                            <div class="ism-new-project-search-controllers-lable">
                                Date
                            </div>
                            <div class="ism-new-project-new-input-controller-controlls">
                                <input type="text" class="ism-body-inputs input-new" ng-model="statusupdate.data.mnt_closed_date" name="mnt_closed_date" id="mnt_closed_date" required placeholder="dd-mm-yyyy" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val2_paymentdate"/>
                            </div>
                        </div>
                    </div>
                    <div class="ism-dia-body-inputs">
                        <div class="ism-new-project-search-controllers c-f">
                            <div class="ism-new-project-search-controllers-lable">
                                Descrption
                            </div>
                            <div class="ism-new-project-new-input-controller-controlls">
                                <input type="text" class="ism-body-inputs input-new" ng-model="statusupdate.data.mnt_closed_reson" name="mnt_closed_reson" id="mnt_closed_reson" required />
                            </div>
                        </div>
                    </div>
                    <div class="ism-dia-body-inputs">
                        <div class="ism-new-project-search-controllers c-f">
                            <div class="ism-new-project-search-controllers-lable">
                                Closed By
                            </div>
                            <div class="ism-new-project-new-input-controller-controlls">
                                <input type="text" class="ism-body-inputs input-new" ng-model="statusupdate.data.mnt_closed_by" name="mnt_closed_by" id="mnt_closed_by" required />
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="dia-container-footer">
                <div class="dia-container-footer-container">
                    <button type="submit" class="dia-buttons ism-dia-save-button" ng-disabled="mworkstatus_update.$invalid || lcmethoddialog.isloading">
                        <i ng-show="!statusupdate.isloading" class="fa fa-check"></i>
                        <i ng-show="statusupdate.isloading" class="fa fa-cog fa-spin"></i>
                        {{statusupdate.buttontitle}}
                    </button>
                    <button ng-show="!statusupdate.isloading" type="button" class="dia-buttons ism-dia-close-button" onclick="document.getElementById('update_project_status').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>