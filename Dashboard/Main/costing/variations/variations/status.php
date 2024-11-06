<div class="filterdialog" id="update_status">
    <div class="filterdialog-conatiner" style="width:335px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <span class="fa fa-plus"></span>
                </div>
                <div class="filterheadertext">
                    UPDATE VARIATION STATUS
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('update_status').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="filterdialogbody">
            <div class="filterdialogbodycontainer">
                <div class="row">
                    <div class="new-lable">Status</div>
                    <div class="inputitmes">
                        <input type="text" class="nafco-inputs" ng-model="changestatus.token_variation" name="token_variation" id="token_variation" required style="display:none">
                        <input type="text" class="nafco-inputs" ng-model="changestatus.token_revison" name="token_revison" id="token_revison" required style="display:none">
                        <input type="text" class="nafco-inputs" ng-model="changestatus.project_no" name="project_no" id="project_no" required style="display:none">
                        <select ng-model="changeStatus_ctrl" name="variation_status" class="new-inputs-black">
                            <option value="">-Select-</option>
                            <option value="2">Approved</option>
                            <option value="5">Paid/Invoice</option>
                            <option value="3">Cancelled</option>
                            <!-- <option value="4">Dummy</option> -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <form autocomplete="off" ng-show="changeStatus_ctrl === '2' || changeStatus_ctrl === '5' " name="update_status_accept" id="status_update_accept" ng-submit="status_update_accept_submit()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">VO NO </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.vno" name="vno" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Approved Date </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.approvedate" name="approvedate" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Released Date</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.reldate" name="reldate" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Upload PDF : </div>
                        <div class="inputitmes">
                            <input type="file" class="new-inputs-black" name="pdffile" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('update_status').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="update_status_accept.$invalid">
                        <i ng-if="update_status_accept.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!update_status_accept.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

        <form autocomplete="off" ng-show="changeStatus_ctrl === '3'" name="update_status_cancel" id="status_update_cancel" ng-submit="status_update_cancel_submit()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Cancelled By </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.cancelby" name="cancelby" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Date </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.caceldate" name="caceldate" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="new-lable">Upload PDF : </div>
                        <div class="inputitmes">
                            <input type="file" class="new-inputs-black" name="pdffile">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('update_status').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="update_status_cancel.$invalid">
                        <i ng-if="update_status_cancel.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!update_status_cancel.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>



<div class="filterdialog" id="update_status_accept">
    <div class="filterdialog-conatiner" style="width:335px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <span class="fa fa-plus"></span>
                </div>
                <div class="filterheadertext">
                    UPDATE VARIATION STATUS
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('update_status').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        
        <form autocomplete="off" name="acceptstatus_change" id="change_acceptstatus" ng-submit="change_acceptstatus_submit()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">VO NO </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.vno" name="vno" required>
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_variation" name="token_variation" id="token_variation" required style="display:none">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_revison" name="token_revison" id="token_revison" required style="display:none">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.project_no" name="project_no" id="project_no" required style="display:none">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Approved Date </div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.approvedate" name="approvedate" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Released Date</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="accept.reldate" name="reldate" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_edutvariationdates" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Upload PDF : </div>
                        <div class="inputitmes">
                            <input type="file" class="new-inputs-black" name="pdffile" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('update_status').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="update_status_accept.$invalid">
                        <i ng-if="update_status_accept.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!update_status_accept.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>