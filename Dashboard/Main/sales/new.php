<div class="filterdialog" id="new_revision_add">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                <strong>PROJECT : {{pjname}}</strong>'s  New Revision
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('new_revision_add').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="save_revision" name="revision_save" ng-submit="save_revision_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Revision No</div>
                        <div class="inputitmes">
                            <input type="text" name="rqno" ng-model="newrevision.rqno" readonly class="new-inputs-black" style='display:none'>
                            <input type="text" name="revision_no" ng-model="newrevision.revision_no" class="new-inputs-black">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Relesed Date</div>
                        <div class="inputitmes">
                            <input type="text" name="rdate" ng-model="newrevision.rdate" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Duration</div>
                        <div class="inputitmes">
                            <input type="text" name="rduration" ng-model="newrevision.rduration" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Amount (SR.)</div>
                        <div class="inputitmes">
                            <input type="text" name="ramount" ng-model="newrevision.ramount" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Proposed System</div>
                        <div class="inputitmes">
                            <input list="list_ppsystem" type="text" name="rsystemtype" ng-model="newrevision.rsystemtype" class="new-inputs-black" required>
                            <datalist id="list_ppsystem">
                                <option ng-repeat="x in list_ppsystem" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Cost Eng.</div>
                        <div class="inputitmes">
                            <input list="list_costeng" type="text" name="rcosingeng" ng-model="newrevision.rcosingeng" class="new-inputs-black" required>
                            <datalist id="list_costeng">
                                <option ng-repeat="x in list_costeng" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Remark</div>
                        <div class="inputitmes">
                            <input list="list_remark" type="text" name="rremarks" ng-model="newrevision.rremarks" class="new-inputs-black" required>
                            <datalist id="list_remark">
                                <option ng-repeat="x in list_remark" value="{{x}}">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Drawing No.</div>
                        <div class="inputitmes">
                            <input type="text" name="rdrawingno" ng-model="newrevision.rdrawingno" class="new-inputs-black" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('new_revision_add').style.display = 'block'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="revision_save.$invalid || is_start_newrevision">
                        <i ng-show="!is_start_newrevision" class="fa fa-check"></i>
                        <i ng-show="is_start_newrevision" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>