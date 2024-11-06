<div class="filterdialog" id="dia_bomaddtionals">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    ADDITIONALS
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_bomaddtionals').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="addtionupdate" name="addtionupdate_add" ng-submit="addtionupdate_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                <div class="row">
                        <div class="new-lable">Project No</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_projectno" ng-model="addtion.addtion_projectno" class="new-inputs-black" required tabindex="0" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">BOM SNO</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_bomsno" ng-model="addtion.addtion_bomsno" class="new-inputs-black" required tabindex="0" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">BOM ID</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_bomid" ng-model="addtion.addtion_bomid" class="new-inputs-black" required tabindex="1" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">DATE</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_bomdate" ng-model="addtion.addtion_bomdate" class="new-inputs-black" required tabindex="2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Addtional QTY</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_addqty" ng-model="addtion.addtion_addqty" class="new-inputs-black" required tabindex="3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Remark</div>
                        <div class="inputitmes">
                            <input type="text" name="addtion_remark" ng-model="addtion.addtion_remark" class="new-inputs-black" required tabindex="2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_bomaddtionals').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>