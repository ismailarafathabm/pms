<?php
session_start();
include_once '../../../../conf.php';
include_once '../../menu.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../gos/component/st.php';
?>
<style>
    .raidotables {
        width: 695;
    }

    td {
        font-size: 0.85rem;
    }

    .groupccelss {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
        justify-content: space-between;
    }

    .old_page_inputs {
        background-color: #fdfdfd;
        transition: all 0.2s;
        font-size: 0.85rem;
    }

    .old_page_inputs:hover,
    .old_page_inputs:active,
    .old_page_inputs:focus {
        background-color: #fff;
        color: #07293d;
        border: 1px solid #000;
    }

    .itemlist,
    label,
    .old_page_inputs {
        font-family: 'apple';
        font-size: 0.85rem;
    }

    .old_page_inputs {
        font-weight: bold;
    }

    .ng-hg-datepicker {
        position: fixed;
        top: 246px;
    }

    .old_table {
        border: 1px solid #000;
        border-collapse: collapse;
        font-size: 0.87rem;
        width: 1450px;
    }

    .old_table td,
    .old_table th {
        padding: 2px;
        font-size: 0.87rem;
    }

    .old_page_inputs {
        width: 100%;
        padding: 3px 3px;
        border: 1px solid #a7a7a7;
        font-size: 1em;
        line-height: 1em;
        font-weight: 500;
        font-family: 'apple';
        outline: 1px solid transparent;

    }

    .old_page_inputs:hover,
    .old_page_inputs:focus {
        outline: 1px solid transparent;
        border: 1px solid orangered;
    }

    .bomsrcbtn {
        color: orangered;
    }

    .danger {
        background: #ffd8d8;
    }

    @media (width < 1400px) {
        .old_table {
            zoom: 93%;
            width: 1300px;
        }

        .old_page_inputs {
            width: 100%;
            padding: 3px 3px;
            border: 1px solid #a7a7a7;
            font-size: 0.90rem;
            line-height: 1em;
            font-weight: 500;
        }
    }
</style>

<div class="sub-body" style="margin-top: 100px;">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                BOQ SUMMARY
            </div>
            <div class="sub-container-right" style="display: flex;">
                <button ng-show="!isrptloading" ng-click="printResult()" class="ism-btns btn-normal">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <div style="display: flex;align-items: center;font-size: 0.85rem; margin-left: 70px">
                    <input type="radio" value="1" ng-model="rpttype" ng-change="filterData()" /> ALL
                    <input type="radio" value="2" ng-model="rpttype" ng-change="filterData()" /> Balance Only
                    <input type="radio" value="3" ng-model="rpttype" ng-change="filterData()" /> Partial Released
                    <input type="radio" value="4" ng-model="rpttype" ng-change="filterData()" /> Full Released
                </div>


                <div style="display: flex;align-items: center;font-size: 0.85rem; margin-left: 70px">
                    <input type="radio" value="1" ng-model="withdetails" /> Full Details
                    <input type="radio" value="2" ng-model="withdetails" /> Summary
                </div>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height: calc(100vh - 185px);">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="margin-top: 10px;">
                                <thead>
                                    <tr>
                                        <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;padding:5px;">BOQ Qty</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;padding:5px;">BOQ Area</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#cadfca;padding:5px;">Rel Qty</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#cadfca;padding:5px;">Rel Area</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#ffe0e0;padding:5px;">Bal Qty</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#ffe0e0;padding:5px;">Bal Area</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;padding:5px;">Rel %</td>
                                        <td style="font-weight: bold;text-align:center;background-color:#e7e8e9;padding:5px;">Bal %</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;font-weight:bold;padding:17px;font-size: 0.95rem;">
                                        {{
                                        (+boqsummary.totqty).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;font-size: 0.95rem;">
                                        {{
                                        (+boqsummary.totarea).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;background:#cadfca;font-size: 0.95rem;">{{
                                        (+boqsummary.eng_qty).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;background:#cadfca;font-size: 0.95rem;">{{
                                        (+boqsummary.eng_area).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;background:#ffe0e0;font-size: 0.95rem;">
                                        {{(+boqsummary.eng_bal_qty) < 0 ? '+' :''}} {{
                                            (+boqsummary.eng_bal_qty) < 0 ?  (+boqsummary.eng_bal_qty*1).toLocaleString(undefined,{maximumFractionDigits:2}) : (+boqsummary.eng_bal_qty).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;background:#ffe0e0;font-size: 0.95rem;">
                                        {{(+boqsummary.eng_bal_area) < 0 ? '+' : ''}}
                                        {{
                                            (+boqsummary.eng_bal_area) < 0 ? (+boqsummary.eng_bal_area*-1).toLocaleString(undefined,{maximumFractionDigits:2}) : (+boqsummary.eng_bal_area).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }}</td>
                                      
                                        <td style="text-align: center;font-weight:bold;padding:17px;font-size: 0.95rem;">{{
                                        (+boqsummary.pres).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }} %</td>
                                        <td style="text-align: center;font-weight:bold;padding:17px;font-size: 0.95rem;">{{
                                        (+boqsummary.presbal).toLocaleString(undefined,{maximumFractionDigits:2})
                                        }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="overflow: auto;max-height: 87%;margin-bottom:10px">
                                <table class="old_table itemlist" style="margin-top: 10px;">
                                    <thead>
                                        <tr>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Item</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;width: 650px;">Description</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">QTY</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Unit</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Area</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Rel Qty</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Rel Area</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Bal Qty</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Bal Area</th>
                                            <th style="font-weight: bold;text-align:center;background-color:#e7e8e9;">Rel %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="10">
                                                <span>Search : </span><input type="text" ng-model="srcboq" class="ism-dialog-rows-input-controller" style="width: 20%;padding: 3px;" />
                                            </td>
                                        </tr>
                                        <tr ng-repeat="x in boqitemssummary | filter:srcboq">
                                            <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_no}}</td>
                                            <td ng-if="withdetails === '2'" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.ptype_name}}</td>
                                            <td style="padding : 0" ng-if="withdetails === '1'" ng-class="{danger:(+x.eng_balance_qty)<0}">
                                                <div style="width: 100%;">
                                                    <table class="old_table itemlist" style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Type</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.ptype_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_remark}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Location</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_remark}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Area</td>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Width </td>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Height </td>
                                                                <td class='hed' colspan="2" ng-class="{danger:(+x.eng_balance_qty)<0}">Area </td>
                                                            </tr>
                                                            <tr>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                                        (+x.poq_item_width) === 0 ? 
                                                                        '-' : 
                                                                        (+x.poq_item_width).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                                        (+x.poq_item_height) === 0 ?
                                                                        '-'
                                                                        :
                                                                        (+x.poq_item_height).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                <td colspan="2" ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                                        (+x.area) === 0 ?
                                                                        '-' :
                                                                        (+x.area).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Glass</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_spec}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">Single</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_single}}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">DOUBLE</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_double1}}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_double2}}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_double3}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">LAMINATED</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_laminate1}}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_item_glass_laminate2}}</td>
                                                                <td ng-class="{danger:(+x.eng_balance_qty)<0}"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Drawing</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.poq_drawing}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">Finish</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.finish_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed' ng-class="{danger:(+x.eng_balance_qty)<0}">System</td>
                                                                <td colspan="4" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.system_type_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                            <td style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                    (+x.poq_qty) === 0 ? "-" : 
                                                    (+x.poq_qty).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            <td style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{x.unit_name}}</td>

                                            <td style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{(+x.totalarea) === 0 ? '-' :  (+x.totalarea).toLocaleString(undefined,{maximumFractionDigits : 2})}}</td>


                                            <!-- engg  -->
                                            <td style="text-align: center;" ng-if="(+x.eng_qty) === 0" ng-class="{danger:(+x.eng_balance_qty)<0}">-</td>
                                            <td style="text-align: center;" ng-if="(+x.eng_qty) !== 0" ng-class="{danger:(+x.eng_balance_qty)<0}">
                                                <button type="button" class="ism-btns btn-normal" style="padding:2px;" ng-click="getreleaseinfo(x.poq_id)">
                                                    {{(+x.eng_qty).toLocaleString(undefined,{maximumFractionDigits : 2})}}
                                                </button>
                                            </td>

                                            <td style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                    (+x.totarea) === 0 ? "-" : 
                                                    (+x.totarea).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            
                                            <td ng-if="(+x.eng_balance_qty)<0" style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">+{{
                                                    (+x.eng_balance_qty) === 0 ? "-" : 
                                                    (+x.eng_balance_qty*-1).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            <td ng-if="(+x.eng_balance_qty)<0" style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">+{{
                                                    (+x.eng_balance_area) === 0 ? "-" : 
                                                    (+x.eng_balance_area*-1).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                                <td ng-if="(+x.eng_balance_qty)>=0" style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                    (+x.eng_balance_qty) === 0 ? "-" : 
                                                    (+x.eng_balance_qty).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            <td  ng-if="(+x.eng_balance_qty)>=0" style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">{{
                                                    (+x.eng_balance_area) === 0 ? "-" : 
                                                    (+x.eng_balance_area).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            <td style="text-align: center;" ng-class="{danger:(+x.eng_balance_qty)<0}">
                                                {{ (+x.prs).toLocaleString(undefined,{maximumFractionDigits:2})}}%
                                            </td>
                                            <!-- engg -->

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'releasedia.php';
?>