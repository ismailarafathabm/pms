<div class="ism-pms-dialog" id="dia_po_history">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Material  Purcahse Order [{{selectedmaterial}}]
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_po_history').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="polist.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell">PO.REF#</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Date</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Supplier</th>                                                        
                            <th class="ism-pms-dialog-tbale-header-cell">Sub Total</th>
                            <th class="ism-pms-dialog-tbale-header-cell">VAT</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Total Cost</th>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr ng-repeat="x in polist.data">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.ponewrefno}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.ponewdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.glasssuppliername | uppercase}}</td>                            
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{((+x.vatval).toFixed(2)).toLocaleString()}}</td>                            
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{((+x.itemval).toFixed(2)).toLocaleString()}}</td>                            
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{((+x.ponewtotval).toFixed(2)).toLocaleString()}}</td>                            
                        </tr>
                        <tr>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;color: #0051a2;font-weight: bold;" colspan="6">TOTAL</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right;color: #0051a2;font-weight: bold;">{{(+sumofpo).toFixed(2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>