<div class="ism-pms-dialog" id="dia_edit_entry">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Material to Be Load
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_edit_entry').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="mtblinfo.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_new_mtblinfo_submit()" name="single_savefrm" id="single_save_new_mtblinfo" ng-show="!mtblinfo.isloading">
            <div class="ism-pms-dialog-body" style="max-width: 500px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{mtblinfo.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Project</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_loadproject" id="single_loadproject" ng-model="mtblinfo.data.loadproject" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Location</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_location" id="single_location" ng-model="mtblinfo.data.location" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="single_loaddate" id="single_loaddate" ng-model="mtblinfo.data.loaddate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Item</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_mattype" id="single_mattype" ng-model="mtblinfo.data.mattype" class="ism-dialog-rows-input-controller" required ng-focus="show_itemfilterss()" >
                            </input>
                            <item-list id="itemlist" style="display: none; position: absolute; width: 98%; top: -5px;;height: 300px;"></item-list>
                        </div>
                    </div> 
                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Description</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_description" id="single_description" ng-model="mtblinfo.data.description" class="ism-dialog-rows-input-controller" required>
                            </input>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Cutting List No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_cuttinglistno" id="single_cuttinglistno" ng-model="mtblinfo.data.cuttinglistno" class="ism-dialog-rows-input-controller" required>
                            </input>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_qty" id="single_qty" ng-model="mtblinfo.data.qty" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_area" id="single_area" ng-model="mtblinfo.data.area" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Unit</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_unit" id="single_unit" ng-model="mtblinfo.data.unit" class="ism-dialog-rows-input-controller" required />
                            <!-- <unit-list></unit-list> -->
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Loading Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_loadingdate" id="single_loadingdate" ng-model="mtblinfo.data.loadingdate" class="ism-dialog-rows-input-controller" required placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">As Site Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_ascurrentdate" id="single_ascurrentdate" ng-model="mtblinfo.data.ascurrentdate" class="ism-dialog-rows-input-controller" required placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Driver</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input list="driverlist" name="single_driver" id="single_driver" ng-model="mtblinfo.data.driver" class="ism-dialog-rows-input-controller" required />
                            <datalist id="driverlist">
                                <option ng-repeat="x in driverlist">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="single_status" id="single_status" ng-model="mtblinfo.data.status" class="ism-dialog-rows-input-controller" required>
                                <option value="">-select-</option>
                                <option value="Pending">Pending</option>
                                <option value="Delivered">Delivered</option>
                            </select>

                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" ng-show="mtblinfo.data.status === 'Delivered'">
                        <div class="ism-dialog-body-rows-input-container-lable">Actual Load Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_estimatedate" id="single_estimatedate" ng-model="mtblinfo.data.estimatedate" class="ism-dialog-rows-input-controller" ng-required="mtblinfo.data.status === 'Delivered'" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" ng-show="mtblinfo.data.status === 'Delivered'">
                        <div class="ism-dialog-body-rows-input-container-lable">Acutal At Site Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_estimatetositedate" id="single_estimatetositedate" ng-model="mtblinfo.data.estimatetositedate" class="ism-dialog-rows-input-controller" ng-required="mtblinfo.data.status === 'Delivered'" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container full-widht">
                        <div class="ism-dialog-body-rows-input-container-lable">Notes</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="single_remark" id="single_remark" ng-model="mtblinfo.data.remark" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="mtblinfo.isloading || single_savefrm.$invalid">
                    {{mtblinfo.btntitle}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_edit_entry').style.display='none'">
                    Close
                </button>
                <button  type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" style="margin-right: 222px;    display: none;" ng-click="removeItems(mtblinfo.data.loadid)" >
                    <i class="fa fa-trash"></i>
                    Remove
                </button>
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>
    </div>
</div>