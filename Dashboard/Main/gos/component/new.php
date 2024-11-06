<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
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
</style>

<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                New Glass Order
            </div>
            <div class="sub-container-right">

            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <?php
            if (!$sv) {
                echo "You Can not Access This Page.....";
                exit;
            }
            ?>
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="margin-bottom: 10px;width:693px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Project Informations
                                                <div>
                                                    <input type="radio" value="1" ng-model="newgo.gotype">
                                                    <label>Glass Order</label>
                                                    <input type="radio" value="2" ng-model="newgo.gotype">
                                                    <label>Sample</label>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">
                                            Project No
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="goproject" id="goproject" ng-model="newgo.goproject" required ng-blur="getolddatas()" />
                                        </td>
                                        <td style="width:160px;text-align: right;">
                                            Location
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="goprojectlocation" id="goprojectlocation" ng-model="newgo.goprojectlocation" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">
                                            Project Name
                                        </td>
                                        <td colspan="3">
                                            <input class="old_page_inputs" type="text" name="goprojectname" id="goprojectname" ng-model="newgo.goprojectname" required />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Glass Order Type
                                                <div>
                                                    <input type="radio" value="1" ng-model="newgo.gootype">
                                                    <label>GO</label>
                                                    <input type="radio" value="2" ng-model="newgo.gootype">
                                                    <label>B.GO</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Go NO#</td>
                                        <td colspan="3">
                                            <div style="display: flex;gap:5px;align-items: center;">
                                                <div style="width: 80;font-weight: bold;color:blue;text-align:right">
                                                    NAF/ENGG/
                                                </div>
                                                <div>
                                                    <input class="old_page_inputs" type="text" name="gonumber" id="gonumber" ng-model="newgo.gonumber" required />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Supplier</td>
                                        <td colspan="3">
                                            <input list="gsupplierxz_list" class="old_page_inputs" type="text" name="gosupplier" id="gosupplier" ng-model="newgo.gosupplier" />
                                            <datalist id="gsupplierxz_list">
                                                <option ng-repeat="x in gosuppleirs" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Glass Type</td>
                                        <td colspan="3">
                                            <input list="goglasstypex" class="old_page_inputs" type="text" name="goglasstype" id="goglasstype" ng-model="newgo.goglasstype" required />
                                            <datalist id="goglasstypex">
                                                <option ng-repeat="x in goglasstype" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Glass Specification</td>
                                        <td colspan="3">
                                            <input list="goglassspecx" class="old_page_inputs" type="text" name="goglassspec" id="goglassspec" ng-model="newgo.goglassspec" required />
                                            <datalist id="goglassspecx">
                                                <option ng-repeat="x in goglassspec" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Marking</td>
                                        <td colspan="3">
                                            <input list="gomarkingx" class="old_page_inputs" type="text" name="gomarking" id="gomarking" ng-model="newgo.gomarking" required />
                                            <datalist id="gomarkingx">
                                                <option ng-repeat="x in gomarking" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">QTY</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="goqty" id="goqty" ng-model="newgo.goqty" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Area</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="goarea" id="goarea" ng-model="newgo.goarea" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Done By</td>
                                        <td>
                                            <input list="donebylist_list" class="old_page_inputs" type="text" name="godoneby" id="godoneby" ng-model="newgo.godoneby" required />
                                            <datalist id="donebylist_list">
                                                <option ng-repeat="x in godoneby" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                        <td style="width:160px;text-align: right;">Date</td>
                                        <td>
                                            <div>
                                                <input class="old_page_inputs" type="text" name="godate" id="godate" ng-model="newgo.godate" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate3" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Remark</td>
                                        <td colspan="3">
                                            <input list="remarksx" class="old_page_inputs" type="text" name="remarks" id="remarks" ng-model="newgo.remarks" />
                                            <datalist id="remarksx">
                                                <option ng-repeat="x in remarks" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <!-- if this go is RMO then neet to open -->
                         <div class="old_pgm_fitbox" ng-show="(+newgo.gootype) === 2">
                            <table class="old_table itemlist" style="width:686px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Estimation Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newgo.gocostingflag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="2" ng-model="newgo.gocostingflag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newgo.gocostingflag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td ng-show="(+newgo.gocostingflag) >= 2 " style="width:160px;text-align: right;">Fw Date</td>
                                        <td ng-show="(+newgo.gocostingflag) >= 2">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="gocostingrelease" id="gocostingrelease" ng-model="newgo.gocostingrelease" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate2" ng-required="(+newgo.gocostingflag) >= 2" />
                                            </div>
                                        </td>
                                        <td ng-show="(+newgo.gocostingflag) === 3" style="width:160px;text-align: right;">R.Date</td>
                                        <td ng-show="(+newgo.gocostingflag) === 3">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="gocosingreturn" id="gocosingreturn" ng-model="newgo.gocosingreturn" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate1" ng-required="(+newgo.gocostingflag) === 3" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;" ng-show="(+newgo.gocostingflag) === 3">
                                            BGR#
                                        </td>
                                        <td ng-show="(+newgo.gocostingflag) === 3" colspan="3">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="rgono" id="gocosingreturn" ng-model="newgo.rgono" ng-required="(+newgo.gocostingflag) === 3" />
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist" style="width:686px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Procurement Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newgo.gopflag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="2" ng-model="newgo.gopflag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newgo.gopflag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td ng-show="(+newgo.gopflag) >= 2" style="width:160px;text-align: right;">Fw Date</td>
                                        <td ng-show="(+newgo.gopflag) >= 2">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="goprelease" id="goprelease" ng-model="newgo.goprelease" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate2" ng-required="(+newgo.gopflag) >= 2" />
                                            </div>
                                        </td>
                                        <td ng-show="(+newgo.gopflag) === 3" style="width:160px;text-align: right;">R.Date</td>
                                        <td ng-show="(+newgo.gopflag) === 3">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="gopreturn" id="gopreturn" ng-model="newgo.gopreturn" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate1" ng-required="(+newgo.gopflag) === 3" />
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                       
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist">
                                <tr>
                                    <td colspan="4">
                                        <button class="ism-btns btn-normal" type="button" ng-click="saveCt()" style="margin-left: 604px;display:flex;gap:2px;align-items: center;">
                                            <i class="fa fa-check"></i>

                                            Save
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>