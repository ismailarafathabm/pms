<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';

$newcuttinglistusers = ['demo', 'engineering'];
$sv = in_array($user, $newcuttinglistusers);
?>
<style>
    .raidotables {
        width: 695;
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
        font-size: 0.90rem;
    }

    .old_page_inputs {
        font-weight: bold;
    }

    .ng-hg-datepicker {
        position: fixed;
        top: 246px;
    }



    .bulk-entry-table {
        display: table;
        border-collapse: separate;
        border-spacing: 0;
    }

    .bulk-entry-rows-header {
        display: table-row;
    }

    .bulk-entry-rows-header-cell {
        display: table-cell;
        font-size: 0.96rem;
        font-weight: 600;
        text-align: center;
        background: #c4d0d2;
        border: 1px solid #c9c9c9;
        line-height: 20px;
    }

    .bulk-entry-rows {
        display: table-row;
    }

    .bulk-entry-cells {
        display: table-cell;
        border: 1px solid #c3c3c3;
        padding: 0px;
        font-size: 0.85rem;

    }

    .bulk-entry-inputs {
        border: 1px solid #0000;
        border-radius: 0px;
        outline: 1px solid #fff0;
        font-family: 'owh';
        font-size: 0.85rem;
        padding: 2px 4px;
    }

    .bulk-entry-inputs:hover,
    .bulk-entry-inputs:focus,
    .bulk-entry-inputs:active {
        border: 1px solid #000
    }

    input[type='text']:read-only {
        background: #f1f1f1;
    }
</style>

<div class="sub-body" style="margin-top: 100px;height: calc(100vh - 125px);">
    <?php
    if (!$sv) {
        echo "You Can not Access This Page.....";
        exit;
    }
    ?>
    <div class="sub-body-container">
        <div class="sub-body-container-title" style="justify-content: space-between;">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                New Glass Orders
            </div>
            <div class="sub-container-right" style="display: flex;gap:5px;align-items: center;">
                <div>
                    <input type="text" class="old_page_inputs" ng-model="srcdic" placeholder="search...">
                </div>
                |
                <div style="display: flex;gap:2px;align-items: center;">
                    <div>
                        <input placeholder="0" type="text" ng-model="totnewrow" class="old_page_inputs" style="width: 60px;" />
                    </div>
                    <div>
                        <button type="button" ng-click="addmulirows()" class="ism-btns btn-normal">
                            Add Rows
                        </button>
                    </div>
                </div>
                {{isselected ? '|' : '' }}
                <div ng-show="isselected" style="display: flex;gap:2px;align-items: center;">
                    <button type="button" class="ism-btns btn-delete" ng-click="removeSelected()">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button type="button" class="ism-btns btn-normal">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="sub-body-container-contents" style="height: calc(100vh - 200px);">
            <div ng-show="isrptloading">Loading Data...</div>
            <div ng-show="!isrptloading">
                <div class="bulk-entry" style="width: 100%;
    overflow: auto;
    height: 100%;">
                    <table class="bulk-entry-table">
                        <tr class="bulk-entry-rows-header">

                            <td class="bulk-entry-rows-header-cell">
                                <div style="display: flex;">
                                    <input type="checkbox" ng-model="xallx" ng-change="selordel()">
                                    <div>Actions
                                    </div>
                                </div>
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                PDF
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                S.NO
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Type
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Order Type
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Go#
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Supplier
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Glass Type
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Spec
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Marking
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Qty
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Area
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Done By
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Date
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Remark
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Status - PRU
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                TO PRU
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                From PRU
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                Status - Estimate
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                TO EST
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                From EST
                            </td>
                            <td class="bulk-entry-rows-header-cell">
                                BGR#
                            </td>
                        </tr>
                        <tr class="bulk-entry-rows" ng-repeat="x in gosdata | filter:srcdic">
                            <td class="bulk-entry-cells" style="text-align: center;">
                                <div style="display:flex;gap:2px">
                                    <input type="checkbox" ng-model="x.goidstatus" ng-change="checkStatusall()">

                                    <button type="button" ng-click="removerow(x.goid)" class="ism-btns btn-delete" style="padding:2px 2px;margin-right:4px">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <button type="button" ng-click="copyrow(x)" class="ism-btns btn-normal" style="padding:2px 2px">
                                        <i class="fa fa-files-o"></i>
                                    </button>
                                    <button type="button" ng-click="fileupload(x)" class="ism-btns btn-normal" style="padding:2px 2px">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="bulk-entry-cells">
                                <div style="display: flex;gap:5px;" ng-if="(+x.filestatus)===1">
                                    <a href="http://172.0.100.17:8082/PMS/assets/cuttinglists/go/{{x.goid}}.pdf" download="Glass Order {{x.goprojectname}} _ NAF/ENGG/{{x.gonumber}}.pdf">
                                        <img src="http://172.0.100.17:8082/PMS/assets/pdfdownload.png?v=2.4.1.4" style="width:15px;">
                                    </a>
                                    <a target="_blank" href="http://172.0.100.17:8082/PMS/assets/cuttinglists/go/{{x.goid}}.pdf">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="bulk-entry-cells" style="text-align: center;">
                                {{$index+1}}
                            </td>
                            <td class="bulk-entry-cells">
                                <select class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gotype" id="gotype_{{$index+1}}_1" ng-keydown="focusothers($event,$index+1,1)">
                                    <option value="">-Select-</option>
                                    <option value="1">GO</option>
                                    <option value="2">Sample</option>
                                </select>
                            </td>
                            <td class="bulk-entry-cells">
                                <select class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gootype" id="gotype_{{$index+1}}_2" ng-keydown="focusothers($event,$index+1,2)">
                                    <option value="">-Select-</option>
                                    <option value="1">GO</option>
                                    <option value="2">RGO</option>
                                    <option value="3">BGO</option>
                                </select>
                            </td>
                            <td class="bulk-entry-cells" style="width:228">
                                <div style="display: flex;gap:2px;align-items:center">
                                    <div style="font-size:0.85rem">NAF/ENGG/</div>
                                    <div>
                                        <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gonumber" type="text" id="gotype_{{$index+1}}_3" ng-keydown="focusothers($event,$index+1,3)" />
                                    </div>
                                </div>
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gosupplier" type="text" id="gotype_{{$index+1}}_4" ng-keydown="focusothers($event,$index+1,4)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.goglasstype" type="text" id="gotype_{{$index+1}}_5" ng-keydown="focusothers($event,$index+1,5)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.goglassspec" type="text" id="gotype_{{$index+1}}_6" ng-keydown="focusothers($event,$index+1,6)" style="width:550px" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gomarking" type="text" id="gotype_{{$index+1}}_7" ng-keydown="focusothers($event,$index+1,7)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.goqty" type="text" id="gotype_{{$index+1}}_8" ng-keydown="focusothers($event,$index+1,8)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.goarea" type="text" id="gotype_{{$index+1}}_9" ng-keydown="focusothers($event,$index+1,9)" />
                            </td>

                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.godoneby" type="text" id="gotype_{{$index+1}}_10" ng-keydown="focusothers($event,$index+1,10)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.godate_d.normal" type="text" id="gotype_{{$index+1}}_11" ng-keydown="focusothers($event,$index+1,11)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.remarks" type="text" id="gotype_{{$index+1}}_12" ng-keydown="focusothers($event,$index+1,12)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <select class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gopflag" id="gotype_{{$index+1}}_13" ng-keydown="focusothers($event,$index+1,13)">
                                    <option value="">-Select-</option>
                                    <option value="0">N/A</option>
                                    <option value="1">Direct</option>
                                    <option value="2">TO Procurement</option>
                                    <option value="3">From Procurement</option>
                                </select>
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-readonly="(+x.gopflag) < 2" ng-blur="bulk_update(x)" ng-model="x.goprelease_d.normal" type="text" id="gotype_{{$index+1}}_14" ng-keydown="focusothers($event,$index+1,14)" />
                            </td>
                            <td class="bulk-entry-cells">
                            <!-- ng-readonly -->
                                <input class="bulk-entry-inputs" ng-readonly="(+x.gopflag) < 3" ng-blur="bulk_update(x)" ng-model="x.gopreturn_d.normal" type="text" id="gotype_{{$index+1}}_15" ng-keydown="focusothers($event,$index+1,15)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input type="text" ng-if="(+x.gootype) === 1" class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gocostingflag" id="gotype_{{$index+1}}_16" ng-keydown="focusothers($event,$index+1,16)" readonly />
                                <select ng-if="(+x.gootype) !== 1" class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-model="x.gocostingflag" id="gotype_{{$index+1}}_16" ng-keydown="focusothers($event,$index+1,16)">
                                    <option value="">-Select-</option>
                                    <option value="0">N/A</option>
                                    <option value="1">Direct</option>
                                    <option value="2">TO Estimation</option>
                                    <option value="3">From Estimation</option>
                                </select>
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-readonly="(+x.gocostingflag) < 2" ng-model="x.gocostingrelease_d.normal" type="text" id="gotype_{{$index+1}}_17" ng-keydown="focusothers($event,$index+1,17)">
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-readonly="(+x.gocostingflag) < 3" ng-model="x.gocosingreturn_d.normal" type="text" id="gotype_{{$index+1}}_18" ng-keydown="focusothers($event,$index+1,18)" />
                            </td>
                            <td class="bulk-entry-cells">
                                <input class="bulk-entry-inputs" ng-blur="bulk_update(x)" ng-readonly="(+x.gocostingflag) < 3" ng-model="x.rgono" type="text" id="gotype_{{$index+1}}_19" ng-keydown="focusothers($event,$index+1,19)" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once 'gos.file.dia.php';
?>