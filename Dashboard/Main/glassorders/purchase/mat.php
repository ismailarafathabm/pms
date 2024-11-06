<div class="old_pgm_fitbox" ng-show="po.potype !== 'Glass'">
    <table class="old_table itemlist">
        <thead>
            <tr>
                <th> Remove </th>
                <th> S.NO </th>
                <th style="width:350px"> Description </th>
                <th style="width:100px">QTY <input type="checkbox" ng-model="calcbyqty" ng-change="changecalcmethod('q')"></th>
                <th style="width:100px"> Tonnage <input type="checkbox" ng-model="calcbywt" ng-change="changecalcmethod('w')"></th>
                <th style="width:100px"> Area <input type="checkbox" ng-model="calcbyarea" ng-change="changecalcmethod('a')"></th>
                <th style="width:100px"> Unit Price </th>
                <th style="width:100px"> Total Price </th>
                <th style="width:100px">Extra </th>
                <th style="width:100px">Sub Total </th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input list="autocompleateitemswh" type="text" ng-keydown="getallitems($event)" class="old_page_inputs" ng-model="additem.description" name="description" id="description" autocomplete="off" ng-keydown="foucschange($event,'d')" />
                    <datalist id="autocompleateitemswh">
                        <option ng-repeat="x in autocompleateitemswh" value="{{x.description}}">{{x.partno}}</option>
                    </datalist>
                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.qty" name="qty" id="qty" autocomplete="off" ng-keydown="foucschange($event,'q')" />

                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.weight" name="weight" id="weight" autocomplete="off" ng-keydown="foucschange($event,'w')" />

                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.area" name="area" id="area" autocomplete="off" ng-keydown="foucschange($event,'a')" />

                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.unitprice" name="unitprice" id="unitprice" autocomplete="off" ng-change="calc_unitprice()" ng-keydown="foucschange($event,'u')" />
                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.totalprice" name="totalprice" id="totalprice" autocomplete="off" ng-keydown="foucschange($event,'t')" />
                </td>

                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.extraamount" name="extraamount" id="extraamount" autocomplete="off" ng-keydown="foucschange($event,'t')" />
                </td>
                <td>
                    <input type="text" class="old_page_inputs" ng-model="additem.currentamount" name="currentamount" id="currentamount" autocomplete="off" ng-keydown="foucschange($event,'t')" />
                </td>

            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in polist">
                <td>
                    <button class="ism-btns btn-delete" style="padding: 2px 2px;" ng-click="removeItem($index)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td>{{$index+1}}</td>
                <td>{{x.description}}</td>

                <td style="text-align:center">{{(+x.qty) === 0 ? '-' : x.qty}}</td>
                <td style="text-align:center">{{(+x.weight) === 0 ? '-' : (+x.weight).toLocaleString(3)}}</td>
                <td style="text-align:center">{{(+x.area) === 0 ? '-' : (+x.area).toLocaleString(3)}}</td>
                <td style="text-align:right">{{(+x.unitprice) === 0 ? '-' : (+x.unitprice).toLocaleString(2)}}</td>
                <td style="text-align:right">{{(+x.totalprice) === 0 ? '-' : (+x.totalprice).toLocaleString(2)}}</td>

                <td style="text-align:right">{{(+x.extraamount) === 0 ? '-' : (+x.extraamount).toLocaleString(2)}}</td>
                <td style="text-align:right">{{(+x.currentamount) === 0 ? '-' : (+x.currentamount).toLocaleString(2)}}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right">Total</td>
                <td style="text-align:center">{{(+itemtotqty) === 0 ? '-' : itemtotqty}}</td>
                <td style="text-align:center">{{(+itemtotwgt) === 0 ? '-' : (+itemtotwgt).toLocaleString(3)}}</td>
                <td style="text-align:center">{{(+itemtotarea) === 0 ? '-' : (+itemtotarea).toLocaleString(3)}}</td>
                <td></td>
                <td style="text-align:right">{{(+itemstotal) === 0 ? '-' : (+itemstotal).toLocaleString(2)}}</td>

                <td style="text-align:right">{{(+itemstotalextra) === 0 ? '-' : (+itemstotalextra).toLocaleString(2)}}</td>
                <td style="text-align:right">{{(+itemstotalsubtotal) === 0 ? '-' : (+itemstotalsubtotal).toLocaleString(2)}}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align:right">VAT</td>
                <td>
                    <div style="
                                            display: flex;
                                            flex-direction: row;
                                            align-items: center;
                                            justify-content: flex-start;
                                            gap: 3px;
                                            ">
                        <input type="text" class="old_page_inputs" ng-model="povatval" name="povatval" id="povatval" ng-change="povatvalcalc()" autocomplete="off" style="width:30px" />%
                    </div>
                </td>
                <td style="text-align:right">{{(+vatval) === 0 ? '-' : (+vatval).toLocaleString(2)}}</td>
            </tr>
            <tr>
                <td colspan="9" style="text-align:right">Total Amount</td>

                <td style="text-align:right">{{(+itemssubttotal) === 0 ? '-' : (+itemssubttotal).toLocaleString(2)}}</td>
            </tr>
            <tr>
                <td style="text-align:right">NOTE </td>
                <td colspan="9">
                    <input list="bomsrcitemlista" type="text" class="old_page_inputs" ng-model="po.podescription" name="podescription" id="podescription" autocomplete="off" />
                </td>
            </tr>
        </tbody>
    </table>
</div>