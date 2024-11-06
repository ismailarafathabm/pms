<div class="filterdialog" id="dia_add_bom_items">
    <div class="filterdialog-conatiner" style="width:670px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <i class="fa fa-plus"></i>
                </div>                
                <div class="filterheadertext">
                    ITEM INTRODUCTION
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('dia_add_bom_items').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form id="newitem_bom" name="bom_newitem" ng-submit="newitem_bom_submit()" autocomplete="off">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer" style="flex-direction:row">
                    <div class="row">
                        <div class="new-lable">Material Type</div>
                        <div class="inputitmes">
                            <select name="itemtype" ng-model="newitem.itemtype" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in mtypelist" value="{{x.typename}}">{{x.typename}}</option>
                            </select>
                            <button type="button" class="savenewbutton" id="btnMtype" onclick="document.getElementById('dia_props_types').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Profile NO.</div>
                        <div class="inputitmes">
                            <input  type="text" name="itemprofileno" ng-model="newitem.itemprofileno" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">System</div>
                        <div class="inputitmes">
                            <select type="text" name="itemsystem" ng-model="newitem.itemsystem" class="new-inputs-black">
                                <option value="">-Select-</option>
                                <option ng-repeat="s in systemprofilelist" value="{{s.systemname}}"> {{s.systemname}}</option>
                            </select>        
                            <button type="button" class="savenewbutton" id="btnMtype" onclick="document.getElementById('dia_props_system').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>                   
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="new-lable">Part NO</div>
                        <div class="inputitmes">
                            <input type="text" name="itempartno" ng-model="newitem.itempartno" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Description</div>
                        <div class="inputitmes">
                            <input type="text" name="itemdescription" ng-model="newitem.itemdescription" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Die Weight</div>
                        <div class="inputitmes">
                            <input type="text" name="itemdieweight" ng-model="newitem.itemdieweight" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Length</div>
                        <div class="inputitmes">
                            <input type="text" name="itemlength" ng-model="newitem.itemlength" class="new-inputs-black" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Alloy</div>
                        <div class="inputitmes">
                            <select name="itemalloy" ng-model="newitem.itemalloy" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in alloylist" value="{{x.alloyname}}">{{x.alloyname}}</option>
                            </select>
                            <button type="button" class="savenewbutton" id="btnAlloy" onclick="document.getElementById('dia_props_alloy').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable">Finish</div>
                        <div class="inputitmes">
                            <select name="itemfinish" ng-model="newitem.itemfinish" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in finishcolorlist" value="{{x.finishcolor}}">{{x.finishcolor}}</option>
                            </select>
                            <button type="button" class="savenewbutton" id="btnFinish" onclick="document.getElementById('dia_props_finsih').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="new-lable">Unit</div>
                        <div class="inputitmes">
                            <select name="itemunit" ng-model="newitem.itemunits" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in unitlist" value="{{x.unitname}}">{{x.unitname}}</option>
                            </select>
                            <button type="button" class="savenewbutton" id="btnUnit" onclick="document.getElementById('dia_props_units').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="new-lable">Part Function</div>
                        <div class="inputitmes">
                            <select name="itempartfunction" ng-model="newitem.itempartfunction" class="new-inputs-black" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="x in partfunctionlist" value="{{x.partfunction_name}}">{{x.partfunction_name}}</option>
                            </select>
                            <button type="button" class="savenewbutton" id="btnUnit" onclick="document.getElementById('dia_props_units').style.display='flex'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('dia_add_bom_items').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="bom_newitem.$invalid || is_start_getrepott">
                        <i ng-show="!is_start_getrepott" class="fa fa-check"></i>
                        <i ng-show="is_start_getrepott" class="fa fa-spinner fa-pulse  fa-fw"></i>
                        Adds
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

