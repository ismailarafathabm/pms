<div class="ism-pms-dialog" ng-if="show_print_filter">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Print Settings
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-click="hidefilter(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-body" style="width: autopx;">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>Select Options </span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <table class="naf-tables">
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_odate" name="filter_odate" ng-model="viewprint.odate" />
                        </td>
                        <td>Date</td>
                        <td>
                            <input type="checkbox" id="filter_otype" name="filter_otype" ng-model="viewprint.otype" />
                        </td>
                        <td>Type</td>
                        <td>
                            <input type="checkbox" id="filter_supplier" name="filter_supplier" ng-model="viewprint.supplier" />
                        </td>
                        <td>Supplier</td>
                        <td>
                            <input type="checkbox" id="filter_coatting" name="filter_coatings" ng-model="viewprint.coatting" />
                        </td>
                        <td>Coattings</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_contract" name="filter_contract" ng-model="viewprint.contract" />
                        </td>
                        <td>Contract #</td>
                        <td>
                            <input type="checkbox" id="filter_projectname" name="filter_projectname" ng-model="viewprint.projectname" />
                        </td>
                        <td>Project</td>
                        <td>
                            <input type="checkbox" id="filter_gono" name="filter_gono" ng-model="viewprint.gono" />
                        </td>
                        <td>GO#</td>
                        <td>
                            <input type="checkbox" id="filter_pino" name="filter_pino" ng-model="viewprint.pino" />
                        </td>
                        <td>P.I</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_thikenss" name="filter_thikenss" ng-model="viewprint.thikenss" />
                        </td>
                        <td>Thikenss</td>
                        <td>
                            <input type="checkbox" id="filter_outter" name="filter_outter" ng-model="viewprint.outter" />
                        </td>
                        <td>Outter</td>
                        <td>
                            <input type="checkbox" id="filter_inner" name="filter_inner" ng-model="viewprint.inner" />
                        </td>
                        <td>Inner</td>
                        <td>
                            <input type="checkbox" id="filter_qty" name="filter_qty" ng-model="viewprint.qty" disabled />
                        </td>
                        <td>Qty</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_qtyreceived" name="filter_qtyreceived" ng-model="viewprint.qtyreceived" />
                        </td>
                        <td>Qty Received</td>
                        <td>
                            <input type="checkbox" id="filter_qtybalance" name="filter_qtybalance" ng-model="viewprint.qtybalance" />
                        </td>
                        <td>Qty Balance</td>
                        <td>
                            <input type="checkbox" id="filter_uinsert" name="filter_uinsert" ng-model="viewprint.uinsert" />
                        </td>
                        <td>U-Insert</td>
                        <td>
                            <input type="checkbox" id="filter_remarks" name="filter_remarks" ng-model="viewprint.remarks" />
                        </td>
                        <td>Remarks</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_adlocation" name="filter_dlocation" ng-model="viewprint.dlocation" />
                        </td>
                        <td>Location</td>
                        <td>
                            <input type="checkbox" id="filter_eta" name="filter_eta" ng-model="viewprint.eta" />
                        </td>
                        <td>Delivery Schedule</td>
                        <td>
                            <input type="checkbox" id="filter_wkrno" name="filter_wkrno" ng-model="viewprint.wkrno" />
                        </td>
                        <td>Work Order Ref</td>
                        <td>
                            <input type="checkbox" id="filter_area" name="filter_area" ng-model="viewprint.area" />
                        </td>
                        <td>Sqm</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="filter_areabalance" name="filter_areabalance" ng-model="viewprint.areabalance" />
                        </td>
                        <td>Area Balance</td>
                        <td>
                            <input type="checkbox" id="filter_unitprice" name="filter_unitprice" ng-model="viewprint.unitprice" />
                        </td>
                        <td>Unit Price</td>
                        <td>
                            <input type="checkbox" id="filter_otherprice" name="filter_otherprice" ng-model="viewprint.otherprice" />
                        </td>
                        <td>Other Price</td>
                        <td>
                            <input type="checkbox" id="filter_totalprice" name="filter_totalprice" ng-model="viewprint.totalprice" />
                        </td>
                        <td>Total Price</td>
                    </tr>

                    <tr style="display: none;">                        
                        <td>
                            <input type="checkbox" id="filter_recivedarea" name="filter_recivedarea" ng-model="viewprint.recivedarea" />
                        </td>
                        <td>Received Sqm</td>
                        <td>
                            <input type="checkbox" id="filter_balancearea" name="filter_balancearea" ng-model="viewprint.balancearea" />
                        </td>
                        <td>Balance Sqm</td>
                        <td>
                            <input type="checkbox" id="filter_glasstype" name="filter_glasstype" ng-model="viewprint.glasstype" />
                        </td>
                        <td>Glass Type</td>
                        <td>
                            <input type="checkbox" id="filter_glassspec" name="filter_glassspec" ng-model="viewprint.glassspec" />
                        </td>
                        <td>Glass Specification</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button type="button"  ng-click="startfilter()" class="ism-pms-dialog-btn ism-btn-dialog-save">
                Print
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" >
                <i class="fa fa-times"></i>
                Close
            </button>
        </div>
    </div>
</div>