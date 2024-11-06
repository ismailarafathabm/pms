<div class="filterdialog" id="dia_props_types">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    Add Material Type
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_props_types').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newprops_type" name="type_newprops" ng-submit="newprops_type_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Material Type</div>
                        <div class="inputitmes">
                            <input type="text" name="typename" ng-model="newtype.typename" class="new-inputs-black" required tabindex="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_props_types').style.display='none'">
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




<div class="filterdialog" id="dia_props_system">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    Add System Profile
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_props_system').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newprops_profiletype" name="profiletype_newprops" ng-submit="newprops_profiletype_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">                  
                    <div class="row">
                        <div class="new-lable">System</div>
                        <div class="inputitmes">
                            <input type="text" name="systemname" ng-model="profilesystem.systemname" class="new-inputs-black" required tabindex="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_props_system').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="profiletype_newprops.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="filterdialog" id="dia_props_alloy">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    Add Alloy
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_props_alloy').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newprops_alloy" name="alloy_newprops" ng-submit="newprops_alloy_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Alloy</div>
                        <div class="inputitmes">
                            <input type="text" name="alloyname" ng-model="newalloy.alloyname" class="new-inputs-black" required tabindex="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_props_alloy').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="alloy_newprops.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="filterdialog" id="dia_props_finsih">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    Add Finish (COLOR)
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_props_finsih').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newprops_finsih" name="finsih_newprops" ng-submit="newprops_finsih_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Finish</div>
                        <div class="inputitmes">
                            <input type="text" name="finishcolor" ng-model="newcolor.finishcolor" class="new-inputs-black" required tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_props_finsih').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="finsih_newprops.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>




<div class="filterdialog" id="dia_props_units">
    <div class="filterdialog-conatiner">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="filterheadertext">
                    Add UNIT
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_props_units').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newprops_units" name="units_newprops" ng-submit="newprops_units_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Unit</div>
                        <div class="inputitmes">
                            <input type="text" name="unitname" ng-model="newcolor.unitname" class="new-inputs-black" required tabindex="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_props_units').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="units_newprops.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
