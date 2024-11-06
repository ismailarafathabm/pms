<div class="ism-pms-dialog" id="dia_load_rptproject">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Material to Be Load - <strong style="text-decoration:underline">{{projectmat.title}}</strong>
            </div>
            <i class="fa fa-list" id="ismx" ng-click="changedisplaymodesummary()"></i>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!mtblrpt.isloading" onclick="document.getElementById('dia_load_rptproject').style.display='none'">

                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="projectmat.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-show="!projectmat.isloading">
            <div class="ism-pms-dialog-body" style="width: auto;max-width:1260px" ng-show="!materialssummary">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Description</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Qty</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Area/Qty</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Unit</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Loading Date</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">At Site</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Driver</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Status</th>
                            <th class="ism-pms-dialog-tbale-header-cell" rowspan="2">Note</th>
                            <th class="ism-pms-dialog-tbale-header-cell" colspan="3">Delay</th>
                        </tr>
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">Delay</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Loading</th>
                            <th class="ism-pms-dialog-tbale-header-cell">As Site</th>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr>
                            <td></td>
                            <td>
                                <input list="matautoa" type="text" ng-model="searchsummarydatax.description" class="ism-dialog-rows-input-controller" style="padding: 1px;line-height: 1rem;font-size: 0.9rem;" placeholder="Search..."/>
                                <datalist id="matautoa">
                                    <option ng-repeat="x in materialssummarydata" value="{{x.dname}}">{{x.dname}}</option>
                                </datalist>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            <input type="text" ng-model="searchsummarydatax.driver" class="ism-dialog-rows-input-controller" style="padding: 1px;line-height: 1rem;font-size: 0.9rem;" placeholder="Search..."/>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr ng-repeat="x in projectmat.data | filter:searchsummarydatax">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="color: #0082df;font-weight: 700;">{{x.description}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right"><strong>{{x.qty}}</strong></td>
                            <td class="ism-table-dialog-table-body-cells" style="text-align:right"><strong>{{x.area}}</strong></td>
                            <td class="ism-table-dialog-table-body-cells">{{x.unit}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.loadingdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.ascurrentdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.driver}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{errortheme:x.status!=='Delivered'}" ng-class="{successtheme:x.status==='Delivered'}">{{x.status}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.remark}}</td>
                            <td class="ism-table-dialog-table-body-cells">
                                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="loadprevious(x.loadid)">
                                    {{x.delay}}
                                </button>
                            </td>
                            <td class="ism-table-dialog-table-body-cells">{{x.load_diff}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.atsite_diff}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="ism-pms-dialog-body" style="width: auto;max-width:1260px" ng-show="materialssummary">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Description</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Unit</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Issued</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Delivered</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Balance</th>
                            <th class="ism-pms-dialog-tbale-header-cell"></th>
                        </tr>
                    </thead>
                    <tbody class="ism-pms-dialog-table-body">
                        <tr>
                            <td></td>
                            <td>
                                <input list="matauto" type="text" ng-model="searchsummarydata" class="ism-dialog-rows-input-controller" style="padding: 1px;line-height: 1rem;font-size: 0.9rem;" placeholder="Search..."/>
                                <datalist id="matauto">
                                    <option ng-repeat="x in materialssummarydata" value="{{x.dname}}">{{x.dname}}</option>
                                </datalist>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr ng-repeat="x in materialssummarydata | filter:searchsummarydata">
                            <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="color: #0082df;font-weight: 700;">{{x.dname}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.dunit}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.dtotal}}</td>
                            <td class="ism-table-dialog-table-body-cells">{{x.ddele}}</td>
                            <td class="ism-table-dialog-table-body-cells" style="color:red">{{x.dpend}}</td>
                            <td>
                                <div class="bar">
                                    <div class="bar-container">
                                        <div class="bar-main-total">
                                            <div class="bar-main-value" style="width:{{x.pres}}%"></div>
                                        </div>
                                        <div style="font-size: 0.6rem;text-align: center;margin-top: 3px;">
                                            {{x.pres}} %
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="ism-pms-dialog-footer">

                <button type="button" class="ism-new-page-header-button normalbtn" ng-click="printsummary()">
                    <i class="fa fa-print"></i>
                    Print
                </button>

                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_load_rptproject').style.display='none'">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>