<div class="ism-pms-dialog" id="dia_goprc_list">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Received Glass Orders
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_goprc_list').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="goprclist.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body" ng-show="!goprclist.isloading">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>{{goprclist.title}} </span>
            </div>

            <div class="ism-pms-dialog-body-rows" style="width: auto">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Invoice NO</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Date</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Qty</th>
                            <th class="ism-pms-dialog-tbale-header-cell">SQM</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Price/SQM</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Total Amount</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Extra</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Final Amount</th>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr ng-repeat="x in goprclist.data">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="color: #0082df;font-weight: 700;">{{x.gonrc_invoice}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.gonrc_date_d}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:center">{{                               
                                (+x.gonrc_qty) === 0 ? '-' : (+x.gonrc_qty).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:center">{{                                
                                (+x.gonrc_sqm) === 0 ? '-' : (+x.gonrc_sqm).toLocaleString(undefined,{maximumFractionDigits: 3})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{
                                (+x.gonrc_ppsqm) === 0 ? '-' : (+x.gonrc_ppsqm).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;font-weight:bold">{{                                
                                (+x.gonrc_totalprice) === 0 ? '-' : (+x.gonrc_totalprice).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{                                
                                (+x.gonrc_extra) === 0 ? '-' : (+x.gonrc_extra).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;font-weight:bold">{{                                
                                (+x.gonrc_finalprice) === 0 ? '-' : (+x.gonrc_finalprice).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="ism-table-dialog-table-body-cells" style="text-align:right">Total</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:center">{{
                                (+goprclist.sumoff.qty) === 0 ? '-' : (+goprclist.sumoff.qty).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:center">{{
                                (+goprclist.sumoff.area) === 0 ? '-' : (+goprclist.sumoff.area).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells"></td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;font-weight:bold">{{
                                (+goprclist.sumoff.totalamount) === 0 ? '-' : (+goprclist.sumoff.totalamount).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{
                                (+goprclist.sumoff.extraamount) === 0 ? '-' : (+goprclist.sumoff.extraamount).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;font-weight:bold">{{
                                (+goprclist.sumoff.finalamount) === 0 ? '-' : (+goprclist.sumoff.finalamount).toLocaleString(undefined,{maximumFractionDigits: 2})
                            }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>