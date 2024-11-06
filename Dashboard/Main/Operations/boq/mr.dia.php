<style>
    .table-boqs {
        border-collapse: collapse;
        border: 1px solid #c1c1c1;
        font-size: 0.9rem;
        font-family: 'roboto', sans-serif;
        background: #fff;
    }

    .table-boqs td,
    .table-boqs th {
        border: 1px solid #c1c1c1;
        padding: 3px;
    }

    .table-boqs th {
        background: linear-gradient(0deg, #f3f3f3, transparent);
    }
</style>
<div class="ism-dialogbox" id="mr_dia" style="align-items: center;
    justify-content: center;">
    <div class="ism-dialog-body" style="width:1200px;max-height:80vh">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                {{mr_title}}
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('mr_dia').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>

        <div class="dialog-body">
            <table class="table-boqs">
                <thead>
                    <tr>
                        <th rowspan="2">S.NO#</th>
                        <th rowspan="2">Item Description</th>
                        <th rowspan="2">Part NO</th>
                        <th rowspan="2">Part NO Taiseer</th>
                        <th rowspan="2">Die WT (KG/M)</th>
                        <th colspan="3">Qunatity Required</th>
                        <th colspan="2">Stock Available</th>
                        <th colspan="2">Qty Be Ordered</th>
                        <th rowspan="2">Finish</th>
                        <th rowspan="2">Remarks</th>
                    </tr>
                    <tr>
                        <th>Length in Metters</th>
                        <th>QTY</th>
                        <th>Total Weight</th>
                        <th>Stock QTY</th>
                        <th>Stock Weight(KG)</th>
                        <th>Blance to Order</th>
                        <th>Balance Weight(KG)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in mrlist">
                        <td>{{$index+1}}</td>
                        <td>{{x.mritem}}</td>
                        <td>{{x.mrpartno}}</td>
                        <td>{{x.mrpartnotai}}</td>
                        <td>{{
                            (+x.mrdieweight) === 0 ? ''  : (+x.mrdieweight).toLocaleString(undefined,{
                                maximumFractionDigits:2
                            })
                        }}</td>
                        <td>{{
                            (+x.mrreqlength) === 0 ? '' : (+x.mrreqtotweight).toLocaleString(undefined,{ maximumFractionDigits:2})
                        }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#001687
                                "> {{
                                    (+x.mrreqqty) === 0 ? '' : (+x.mrreqqty).toLocaleString(undefined,{
                                maximumFractionDigits:2
                            })
                                }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#001687
                                ">{{
                                    (+x.mrreqtotweight) === 0 ? '' : (+x.mrreqtotweight).toLocaleString(undefined,{ maximumFractionDigits:2})
                                }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#268700
                                ">{{
                                    (+x.mravaiqty) === 0 ? '' : (+x.mravaiqty).toLocaleString(undefined,{ maximumFractionDigits:2})
                                }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#268700
                                ">{{
                                    (+x.mraviweight) === 0 ? '' : (+x.mraviweight).toLocaleString(undefined,{ maximumFractionDigits:2})
                                }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#df0000
                                ">{{
                                    (+x.mrorderedqty) === 0 ? '' : (+x.mrorderedqty).toLocaleString(undefined,{ maximumFractionDigits:2})
                                }}</td>
                        <td style="
                                text-align: center;
                                font-weight: bold;
                                color :#df0000
                                ">{{
                                    (+x.mrorderedweight) === 0 ? '' : (+x.mrorderedweight).toLocaleString(undefined,{ maximumFractionDigits:2})
                                }}</td>
                        <td>{{
                            x.mrfinish
                        }}</td>
                        <td>{{x.mrremarks}}</td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class=" dialog-foot">
            <div class="dialog-foot-buttons">
                <button type="button" class="ism-btns btn-close" onclick="document.getElementById('mr_dia').style.display='none'">
                    <i class="fa fa-times"></i>
                    Close
                </button>

            </div>
        </div>

    </div>
</div>