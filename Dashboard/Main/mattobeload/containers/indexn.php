<div class="ism-pms-dialog" id="dia_new_entry">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Material to Be Load
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_new_entry').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="mtbl.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_new_mtbl_submit()" name="savefrm" id="save_new_mtbl" ng-show="!mtbl.isloading" style="width: 850px;">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{mtbl.title}} </span>
                </div>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <div class="ism-pms-dialog-body-row-input-container full-widht" style="flex: 1 1 500px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Project</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input ng-focus="show_project_finder()" name="loadproject" id="loadproject" ng-model="mtbl.data.loadproject" class="ism-dialog-rows-input-controller" required />
                        <project-list id="projectfilters"></project-list>
                    </div>
                    <div class="ism-dialog-input-error" ng-show="savefrm.loadproject.$invalid">
                        <i class="fa fa-exclamation-circle"></i>
                        <span>Enter Project Name </span>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 1 250px">
                    <div class="ism-dialog-body-rows-input-container-lable">Location</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="location" id="location" ng-model="mtbl.data.location" class="ism-dialog-rows-input-controller" required />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="dd-mm-YYYY" name="loaddate" id="loaddate" ng-model="mtbl.data.loaddate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Loading Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="loadingdate" id="loadingdate" ng-model="mtbl.data.loadingdate" class="ism-dialog-rows-input-controller" required placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                    <div class="ism-dialog-body-rows-input-container-lable">As Site Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="ascurrentdate" id="ascurrentdate" ng-model="mtbl.data.ascurrentdate" class="ism-dialog-rows-input-controller" required placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Driver</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input list="driverlist" name="driver" id="driver" ng-model="mtbl.data.driver" class="ism-dialog-rows-input-controller" required />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Status</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <select name="status" id="status" ng-model="mtbl.data.status" class="ism-dialog-rows-input-controller" required>
                            <option value="">-select-</option>
                            <option value="Pending">Pending</option>
                            <option value="Delivered">Delivered</option>
                        </select>

                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;" ng-if="mtbl.data.status === 'Delivered'">
                    <div class="ism-dialog-body-rows-input-container-lable">Actual Load Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="estimatedate" id="estimatedate" ng-model="mtbl.data.estimatedate" class="ism-dialog-rows-input-controller" ng-required="mtbl.data.status === 'Delivered'" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;" ng-if="mtbl.data.status === 'Delivered'">
                    <div class="ism-dialog-body-rows-input-container-lable">Acutal At Site Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="estimatetositedate" id="estimatetositedate" ng-model="mtbl.data.estimatetositedate" class="ism-dialog-rows-input-controller" ng-required="mtbl.data.status === 'Delivered'" placeholder="dd-mm-YYYY" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container full-widht">
                    <div class="ism-dialog-body-rows-input-container-lable">Notes</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="remark" id="remark" ng-model="mtbl.data.remark" class="ism-dialog-rows-input-controller" required />
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-body-rows-single" ng-show="mtbl.mode === 'N'">
                <div class="ism-pms-dialog-body-rows-single-cols" style="flex: 1 1 300px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Item</div>
                    <input type="text" name="mattype" id="mattype" ng-model="mtbl.listadd.data.mattype" class="ism-dialog-rows-input-controller" ng-focus="show_itemfilters()" />
                    <item-list id="itemlistmain" style="display: block;position: absolute;width: 40%;height: 200px;top: -8px;"></item-list>
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="flex: 1 1 450px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Description</div>
                    <input type="text" name="description" id="description" ng-model="mtbl.listadd.data.description" class="ism-dialog-rows-input-controller" />
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="flex: 1 1 100px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Cutting List No</div>
                    <input type="text" name="cuttinglistno" id="cuttinglistno" ng-model="mtbl.listadd.data.cuttinglistno" class="ism-dialog-rows-input-controller" />
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="flex: 1 1 100px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                    <input type="text" name="area" id="area" ng-model="mtbl.listadd.data.area" class="ism-dialog-rows-input-controller" />
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="flex: 1 1 100px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                    <input type="text" name="qty" id="qty" ng-model="mtbl.listadd.data.qty" class="ism-dialog-rows-input-controller" />
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="position:relative;flex: 1 1 100px;">
                    <div class="ism-dialog-body-rows-input-container-lable">Units</div>
                    <input type="text" name="units" id="units" ng-model="mtbl.listadd.data.units" class="ism-dialog-rows-input-controller" readonly/>
                    <!-- <unit-list></unit-list> -->
                </div>
                <div class="ism-pms-dialog-body-rows-single-cols" style="align-items: center;justify-content: flex-end;">
                    <button type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-click="itemaddintolist()">
                        {{mtbl.listadd.btntitle}}
                    </button>
                </div>
            </div>
            <table class="ism-pms-dialog-table" style="width:100%">
                <thead class="ism-pms-dialog-table-headers">
                    <tr>
                        <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                        <th class="ism-pms-dialog-tbale-header-cell">C.L.No.,</th>
                        <th class="ism-pms-dialog-tbale-header-cell">Item</th>
                        <th class="ism-pms-dialog-tbale-header-cell" style="width:300px">Description</th>
                        <th class="ism-pms-dialog-tbale-header-cell">Area</th>
                        <th class="ism-pms-dialog-tbale-header-cell">Qty</th>
                        <th class="ism-pms-dialog-tbale-header-cell">Unit</th>
                        <th class="ism-pms-dialog-tbale-header-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in mtbl.mtbllist">
                        <td>{{$index+1}}</td>
                        <td>{{x.cuttinglistno}}</td>
                        <td>{{x.mattype}}</td>
                        <td>{{x.description}}</td>
                        <td>{{x.area}}</td>
                        <td>{{x.qty}}</td>
                        <td>{{x.units}}</td>
                        <td>
                            <input type="checkbox" ng-model="x._check" ng-show="mtbl.mode === 'E'" />
                            <div class="inidebutton" ng-show="mtbl.mode === 'N'">
                                <button type="button" ng-click="edititem(x)">
                                    <i class='fa fa-pencil'></i>
                                </button>
                                <button type="button" ng-click="removeitem($index)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="mtbl.isloading || savefrm.$invalid || mtbl.mtbllist.length===0">
                    {{mtbl.btntitle}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_new_entry').style.display='none'">
                    Close
                </button>
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>
    </div>
</div>