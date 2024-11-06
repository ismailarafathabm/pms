<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';
include_once 'ctools.php';
$newcuttinglistusers = ['demo', 'eng_carlo'];
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
    .itemlist,label,.old_page_inputs{
        font-family: 'owh';
        font-size: 0.90rem;
    }
    .old_page_inputs{
        font-weight: bold;        
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
                                                    <input ng-disabled="pagetype !== 'N'" type="radio" value="1" ng-model="newgo.gogotype" ng-change="setctype('1')">
                                                    <label>Glass Order</label>
                                                    <input ng-disabled="pagetype !== 'N'" type="radio" value="2" ng-model="newgo.gogotype" ng-change="setctype('2')">
                                                    <label>Sample</label>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr ng-show="newgo.gogotype === '1'">
                                        <td style="width:160px;text-align: right;">
                                            Project
                                        </td>
                                        <td colspan="3">
                                            <input class="old_page_inputs" type="text" name="srcprojects" id="srcprojects" ng-model="src.project" required ng-keydown="showprojectsearchbox()" />
                                            <div id="project_autocompleate" class="gen_autocompleate">
                                                <?php
                                                include_once 'projectauto.dia.php'
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-show="newgo.gogotype === '2'">
                                        <td style="width:160px;text-align: right;">
                                            Project No
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" ng-blur="sampleprojects()" type="text" name="goproject" id="goproject" ng-model="newgo.goproject" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">
                                            Location
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="goprojectlocation" id="goprojectlocation" ng-model="newgo.goprojectlocation" required />
                                        </td>
                                    </tr>
                                    <tr ng-if="newgo.gogotype === '2'">
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
                                                    <input type="radio" value="1" ng-model="newgo.gotype">
                                                    <label>GO</label>
                                                    <input type="radio" value="2" ng-model="newgo.gotype">
                                                    <label>R.GO</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Go NO#</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="gono" id="gono" ng-model="newgo.gono" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Go Ref NO</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="gorefno" id="gorefno" ng-model="newgo.gorefno" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Supplier</td>
                                        <td colspan="3">
                                            <input list="gsupplier" class="old_page_inputs" type="text" name="gosupplier" id="gosupplier" ng-model="newgo.gosupplier" />
                                            <datalist id="gsupplier">
                                                <option ng-repeat="x in gsupplier" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Glass Type</td>
                                        <td colspan="3">
                                            <input list="gtype" class="old_page_inputs" type="text" name="gogtype" id="gogtype" ng-model="newgo.gogtype" required />
                                            <datalist id="gtype">
                                                <option ng-repeat="x in gtype" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Glass Specification</td>
                                        <td colspan="3">
                                            <input list="gspec" class="old_page_inputs" type="text" name="gospec" id="gospec" ng-model="newgo.gospec" required />
                                            <datalist id="gspec">
                                                <option ng-repeat="x in gspec" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Marking</td>
                                        <td colspan="3">
                                            <input list="gmk" class="old_page_inputs" type="text" name="gomarking" id="gomarking" ng-model="newgo.gomarking" required />
                                            <datalist id="gmk">
                                                <option ng-repeat="x in gmk" values="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">QTY</td>
                                        <td>
                                            <input list="markings" class="old_page_inputs" type="text" name="goqty" id="goqty" ng-model="newgo.goqty" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Area</td>
                                        <td>
                                            <input list="markings" class="old_page_inputs" type="text" name="goarea" id="goarea" ng-model="newgo.goarea" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Done By</td>
                                        <td>
                                            <input list="markings" class="old_page_inputs" type="text" name="godoneby" id="godoneby" ng-model="newgo.godoneby" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Date</td>
                                        <td>
                                            <div>
                                            <input list="markings" class="old_page_inputs" type="text" name="goorddate" id="goorddate" ng-model="newgo.goorddate" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate3"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Remark</td>
                                        <td colspan="3">
                                            <input list="gremark" class="old_page_inputs" type="text" name="goremark" id="goremark" ng-model="newgo.goremark" />
                                            <datalist id="gremark">
                                                <option ng-repeat="x in gremark" values="{{x}}">{{x}}</option>
                                            </datalist>
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
                                                Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newgo.gostatus">
                                                    <label>N/A</label>
                                                    <input type="radio" value="2" ng-model="newgo.gostatus">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newgo.gostatus">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td ng-show="(+newgo.gostatus) >= 2" style="width:160px;text-align: right;">Fw Date</td>
                                        <td ng-show="(+newgo.gostatus) >= 2">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="gortopurchase" id="gortopurchase" ng-model="newgo.gortopurchase" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate2" ng-required="(+newgo.gostatus) >= 2" />
                                            </div>
                                        </td>
                                        <td ng-show="(+newgo.gostatus) === 3" style="width:160px;text-align: right;">R.Date</td>
                                        <td ng-show="(+newgo.gostatus) === 3">
                                            <div>
                                                <input list="markings" class="old_page_inputs" type="text" name="gofrmpurchase" id="gofrmpurchase" ng-model="newgo.gofrmpurchase" ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate1" ng-required="(+newgo.gostatus) === 3" />
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
                                            <i ng-show="pagetype === 'N'" class="fa fa-check"></i>
                                            <i ng-show="pagetype === 'S'" class="fa fa-upload"></i>
                                            <i ng-show="pagetype === 'E'" class="fa fa-edit"></i>
                                            {{btntxt}}
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