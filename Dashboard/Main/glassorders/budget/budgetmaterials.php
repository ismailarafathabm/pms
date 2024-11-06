<div class="ism-pms-dialog" id="dia_budget_items">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Budget Material [{{selectedmaterial}}]
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_budget_items').style.display='none'">
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
                            <th class="ism-pms-dialog-tbale-header-cell">S.NO</th>
                            <th class="ism-pms-dialog-tbale-header-cell">ITEM</th>
                            <th class="ism-pms-dialog-tbale-header-cell">QTY</th>
                            <th class="ism-pms-dialog-tbale-header-cell">ESTIMATED PRICE</th>
                            <th class="ism-pms-dialog-tbale-header-cell">ESTIMATED AMOUNT</th>
                            <th class="ism-pms-dialog-tbale-header-cell">DISCOUNT AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr ng-repeat="x in materialbudgets">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.bmtype | uppercase}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:center">{{x.bmqty}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{x.bmeprice}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{((+x.bmeval).toFixed(2)).toLocaleString()}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{((+x.bmdiscountval).toFixed(2)).toLocaleString()}}</td>
                        </tr>
                        <tr>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right" colspan="5">
                                TOTAL
                            </td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right">{{(+mtotal).toFixed(2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>