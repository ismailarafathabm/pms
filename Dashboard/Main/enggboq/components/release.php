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
        font-size: 0.90rem;
        width: 990px;
    }

    .old_table td,
    .old_table th {
        padding: 2px;
        font-size: 0.90rem;
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

    @media (width < 1400px) {
        .old_table {
            zoom: 93%;
            width: 990px;
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
                BOQ RELEASE
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents" style="height: calc(100vh - 185px);">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table" style="margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 150px;text-align:right">Project</td>
                                        <td colspan="3">
                                            <input type="text" class="old_page_inputs" ng-model="boqeng.boqeng_projectname" name="boqeng_projectname" id="boqeng_projectname" style="width: 400px;" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px;text-align:right">Location</td>
                                        <td>
                                            <input type="text" class="old_page_inputs" ng-model="boqeng.boqeng_projectlocation" name="boqeng_projectlocation" id="boqeng_projectlocation" style="width: 220px;" readonly />
                                        </td>
                                        <td style="width: 150px;">Date</td>
                                        <td>
                                            <div>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.boqeng_rdate" name="boqeng_rdate" id="boqeng_rdate" style="width: 150px;" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate3"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px;text-align:right">BOQ</td>
                                        <td colspan="3">
                                            <select class="old_page_inputs" ng-model="boqeng.boqeng_boqid" name="boqeng_boqid" id="boqeng_boqid" ng-change="getBoqinfo()">
                                                <option value="">-Select-</option>
                                                <option ng-repeat="x in boqitems" value="{{x.poq_id}}"> {{x.poq_item_no}} - {{x.ptype_name}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div ng-show="ispageloading">
                                <i class="fa fa-cog fa-spin"></i> <span style="margin-left: 5px;">Fetching Data.</span>
                            </div>
                            <div ng-show="!ispageloading">
                                <table class="old_table itemlist" ng-show="isloaded">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 650px;">Description</th>
                                            <th>QTY</th>
                                            <th>Unit</th>
                                            <th>Area</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{boqinfo_dia.data.poq_item_no}}</td>
                                            <td style="padding : 0">
                                                <div style="width: 100%;">
                                                    <table class="old_table itemlist" style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td class='hed'>Type</td>
                                                                <td colspan="4">{{boqinfo_dia.data.ptype_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'></td>
                                                                <td colspan="4">{{boqinfo_dia.data.poq_item_remark}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Location</td>
                                                                <td colspan="4">{{boqinfo_dia.data.poq_remark}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Area</td>
                                                                <td class='hed'>Width</td>
                                                                <td class='hed'>Height</td>
                                                                <td class='hed' colspan="2">Area</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>{{
                                                                        (+boqinfo_dia.data.poq_item_width) === 0 ? 
                                                                        '-' : 
                                                                        (+boqinfo_dia.data.poq_item_width).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                <td>{{
                                                                        (+boqinfo_dia.data.poq_item_height) === 0 ?
                                                                        '-'
                                                                        :
                                                                        (+boqinfo_dia.data.poq_item_height).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                                <td colspan="2">{{
                                                                        (+boqinfo_dia.data.area) === 0 ?
                                                                        '-' :
                                                                        (+boqinfo_dia.data.area).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                                    }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Glass</td>
                                                                <td colspan="4">{{boqinfo_dia.data.poq_item_glass_spec}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Single</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_single}}</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>DOUBLE</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_double1}}</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_double2}}</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_double3}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>LAMINATED</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_laminate1}}</td>
                                                                <td>{{boqinfo_dia.data.poq_item_glass_laminate2}}</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Drawing</td>
                                                                <td colspan="4">{{boqinfo_dia.data.poq_drawing}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Finish</td>
                                                                <td colspan="4">{{boqinfo_dia.data.finish_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>System</td>
                                                                <td colspan="4">{{boqinfo_dia.data.system_type_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">{{
                                                    (+boqinfo_dia.data.poq_qty) === 0 ? "-" : 
                                                    (+boqinfo_dia.data.poq_qty).toLocaleString(
                                                        undefined,
                                                        {
                                                            maximumFractionDigits : 2
                                                        }
                                                    )
                                                }}</td>
                                            <td style="text-align: center;">{{boqinfo_dia.data.unit_name}}</td>

                                            <td style="text-align: center;">{{
                                                    (+boqinfo_dia.data.totalarea) === 0 ? 
                                                    '-' :  (+boqinfo_dia.data.totalarea).toLocaleString(undefined,{maximumFractionDigits : 2})
                                                }}</td>

                                        </tr>

                                    </tbody>
                                </table>
                                <div class="old_pgm_fitbox" ng-show="isloaded" ng-if="boqinfo_dia.notes.length !== 0">
                                    <table class="old_table itemlist">
                                        <thead>
                                            <tr>
                                                <th>S.No#</th>
                                                <th>Description</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="x in boqinfo_dia.notes">
                                                <td style="width: 75px;">{{$index+1}}</td>
                                                <td>{{x.boq_note_notes}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="old_pgm_fitbox" ng-show="isloaded">
                                    <table class="old_table itemlist" style="margin-top: 10px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 150px;">Released Qty</td>
                                                <td>
                                                    {{previous_release.qty}}

                                                </td>
                                                <td style="width: 150px;">Released Area</td>
                                                <td>
                                                    {{previous_release.area}}

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 150px;">Qty</td>
                                                <td style="width: 150px;color:red;font-weight:bold">
                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.boqeng_qty" name="boqeng_qty" id="boqeng_qty" style="width: 150px;color:red;font-weight:bold" ng-change="calcbal()"/>
                                                </td>
                                                <td style="width: 150px;">Area</td>
                                                <td style="width: 150px;color:red;font-weight:bold">
                                                    
                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.boqeng_area" name="boqeng_area" id="boqeng_area" style="width: 150px;color:red;font-weight:bold" ng-change="calcbal()" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Balance</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>QTY</td>
                                                <td>{{(+bal.qty).toLocaleString(undefined,{maximumFractionDigits:2})}}</td>
                                                <td>Area</td>
                                                <td>{{(+bal.area).toLocaleString(undefined,{maximumFractionDigits:3})}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="old_table itemlist" style="margin-top: 10px;">
                                        <tbody>
                                            <td colspan="4" style="text-align: right;">
                                                <button class="ism-btns btn-normal" type="button" ng-click="saveRelease()">
                                                    <i class="fa fa-check"></i>
                                                    Save
                                                </button>
                                            </td>
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
</div>