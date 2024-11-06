<div class="filterdialog" id="dia_bom_revisions">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    {{_bom.bomno}} REVISION
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_bom_revisions').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="new_revision" name="revision_new" ng-submit="new_revision_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Date</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomdate" ng-model="revision.bomdate" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">PROFILE NO</div>
                        <div class="inputitmes">
                            <input list="bomsrcitemlist" type="text" name="revision_bomprofileno" ng-model="revision.bomprofileno" class="new-inputs-black" required>
                            <datalist id="bomsrcitemlist">
                                <option ng-repeat="x in bomitemslist" value="{{x.itemid}}">{{x.itemtype}} | {{x.itemprofileno}} | {{x.itempartno}} | {{x.itemalloy}} | {{x.itemfinish}} | {{x.itemlength}} | {{x.itemunit}} | {{x.itemdieweight}} | {{x.itemsystem}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">PART NO</div>
                        <div class="inputitmes">
                            <input list="bomsrcitemlist" type="text" name="revision_bompartno" ng-model="revision.bompartno" class="new-inputs-black" required>
                            <datalist id="bomsrcitemlist">
                                <option ng-repeat="x in bomitemslist" value="{{x.itemid}}">{{x.itemtype}} | {{x.itemprofileno}} | {{x.itempartno}} | {{x.itemalloy}} | {{x.itemfinish}} | {{x.itemlength}} | {{x.itemunit}} | {{x.itemdieweight}} | {{x.itemsystem}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">DESCRIPTION</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomdescription" ng-model="revision.bomdescription" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">UNIT</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomunit" ng-model="revision.bomunit" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">DIE WEIGHT</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomdieweight" ng-model="revision.bomdieweight" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">REQUIRE LENGTH</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomreqlength" ng-model="revision.bomreqlength" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">REQUIRE QTY</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomreqbarqty" ng-model="revision.bomreqbarqty" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">TOTAL WEIGHT</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomreqtotweight" ng-model="revision.bomreqtotweight" class="new-inputs-black" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">REMARKS</div>
                        <div class="inputitmes">
                            <input type="text" name="revision_bomremark" ng-model="revision.bomremark" class="new-inputs-black">
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <input type="text" name="revision_itemid" ng-model="revision.itemid" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_bomid" ng-model="revision.bomid" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_alloy" ng-model="revision.revision_alloy" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_finish" ng-model="revision.revision_finish" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_ssystem" ng-model="revision.revision_ssystem" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_mtype" ng-model="revision.revision_mtype" class="new-inputs-black" required readonly>
                        <input type="text" name="revision_ogdiscription" ng-model="revision.revision_ogdiscription" class="new-inputs-black" required readonly>
                        
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_bom_revisions').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="type_newprops.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>