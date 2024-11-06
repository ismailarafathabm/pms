<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once 'st.php';
include_once 'ctools.php'
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

    .ng-hg-datepicker {
        position: fixed;
        top: 246px;
    }

    .itemlist,
    label,
    .old_page_inputs {       
        font-family: 'owh';
        font-size: 0.75rem;
    }

    .old_page_inputs {
        font-weight: bold;
    }

    @media (min-width:1400px) {
        .itemlist,
        label,
        .old_page_inputs {
            font-family: 'owh';
            font-size: 0.85rem;
        }
        table{
            width:708px;
        }
    }
</style>

<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 100px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                New Cutting List
            </div>
            <div class="sub-container-right">

            </div>
        </div>

        <div class="sub-body-container-contents" style="height:94%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">

                            <table class="old_table itemlist" style="margin-bottom: 10px;width:708px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Project Informations
                                                <div>
                                                    <input ng-disabled="pagetype !== 'N' || isnproject" type="radio" value="1" ng-model="newct.cttype" ng-change="setctype('1')">
                                                    <label>Cutting List</label>
                                                    <input ng-disabled="pagetype !== 'N' || isnproject" type="radio" value="2" ng-model="newct.cttype" ng-change="setctype('2')">
                                                    <label>Sample</label>
                                                    <input ng-disabled="pagetype !== 'N' || isnproject" type="radio" value="3" ng-model="newct.cttype" ng-change="setctype('3')">
                                                    <label>Mockup Sample</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr ng-show="newct.cttype === 'c'">
                                        <td style="width:160px;text-align: right;">
                                            Project
                                        </td>
                                        <td colspan="3">
                                            <input class="old_page_inputs" type="text" name="srcprojects" ng-readonly="pagetype !== 'N' || isnproject" id="srcprojects" ng-model="src.project" required ng-keydown="showprojectsearchbox()" />
                                            <div id="project_autocompleate" class="gen_autocompleate">
                                                <?php
                                                include_once 'projectauto.dia.php'
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-show="newct.cttype !== 'c'">
                                        <td style="width:160px;text-align: right;">
                                            Project No
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" ng-blur="sampleprojects()" type="text" name="ctprojectno" id="ctprojectno" ng-model="newct.ctprojectno" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">
                                            Location
                                        </td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="ctprojectlocation" id="ctprojectlocation" ng-model="newct.ctprojectlocation" required />
                                        </td>
                                    </tr>
                                    <tr ng-if="newct.cttype !== 'c'">
                                        <td style="width:160px;text-align: right;">
                                            Project Name
                                        </td>
                                        <td colspan="3">
                                            <input class="old_page_inputs" type="text" name="ctprojectname" id="ctprojectname" ng-model="newct.ctprojectname" required />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="old_table itemlist">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Enter Cutting List Informaitons
                                                <div>
                                                    <input type="radio" value="MO" ng-model="newct.ct_type">
                                                    <label>N/A</label>
                                                    <input type="radio" value="Account MO" ng-model="newct.ct_type">
                                                    <label>Accounting MO</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Mo No#</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="ct_mono" id="ct_mono" ng-model="newct.ct_mono" required ng-keydown="showMoItems($event)" />
                                            <div id="mo_autocompleate" class="gen_autocompleate">
                                                <?php
                                                include_once 'mo.dia.php'
                                                ?>
                                            </div>
                                        </td>
                                        <td style="width:160px;text-align: right;">Cutting list No</td>
                                        <td>
                                            <div style="display: flex;gap:5px;align-items: center;">
                                                <div style="width: 105px;font-weight: bold;color:blue;text-align:right">{{newct.ctprojectno}} - </div>
                                                <input ng-keyup="getCTno()" class="old_page_inputs" type="text" name="ct_no" id="ct_no" ng-model="newct.ct_no" required style="width: 110px;" ng-blur="getoldcuttinglistinfo($event)" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Marking</td>
                                        <td colspan="3">
                                            <input list="markings" class="old_page_inputs" type="text" name="ct_marking" id="ct_marking" ng-model="newct.ct_marking" required />
                                            <datalist id="markings">
                                                <option ng-repeat="x in markings" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Description</td>
                                        <td colspan="3">
                                            <input list="descriptions" class="old_page_inputs" type="text" name="ct_description" id="ct_description" ng-model="newct.ct_description" required />
                                            <datalist id="descriptions">
                                                <option ng-repeat="x in descriptions" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Location</td>
                                        <td colspan="3">
                                            <input list="locations" class="old_page_inputs" type="text" name="ct_location" id="ct_location" ng-model="newct.ct_location" required />
                                            <datalist id="locations">
                                                <option ng-repeat="x in locations" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Qty</td>
                                        <td>
                                            <input ng-change="calc_area()" class="old_page_inputs" type="text" name="ct_qty" id="ct_qty" ng-model="newct.ct_qty" ng-blur="checknovalue('ct_qty')" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Height</td>
                                        <td>
                                            <input ng-change="calc_area()" class="old_page_inputs" type="text" name="ct_height" id="ct_height" ng-model="newct.ct_height" ng-blur="checknovalue('ct_height')" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Width</td>
                                        <td>
                                            <input ng-change="calc_area()" class="old_page_inputs" type="text" name="ct_width" id="ct_width" ng-model="newct.ct_width" ng-blur="checknovalue('ct_width')" required />
                                        </td>
                                        <td style="width:160px;text-align: right;">Area</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="ct_area" id="ct_area" ng-model="newct.ct_area" ng-blur="checknovalue('ct_area')" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Done By</td>
                                        <td>
                                            <input list="donebys" class="old_page_inputs" type="text" name="ct_doneby" id="ct_doneby" ng-model="newct.ct_doneby" required />
                                            <datalist id="donebys">
                                                <option ng-repeat="x in donebys" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                        <td style="width:160px;text-align: right;">Glass Order Ref NO</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="mgono" id="mgono" ng-model="newct.mgono" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Unit </td>
                                        <td>
                                            <input list="uints" class="old_page_inputs" type="text" name="ctunit" id="ctunit" ng-model="newct.ctunit" required />
                                            <datalist id="uints">
                                                <option ng-repeat="x in uints" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                        <td style="width:160px;text-align: right;">Sheet Type </td>
                                        <td>
                                            <input list="sheettypes" class="old_page_inputs" type="text" name="ct_mrefno" id="ct_mrefno" ng-model="newct.ct_mrefno" required />
                                            <datalist id="sheettypes">
                                                <option ng-repeat="x in sheettypes" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:160px;text-align: right;">Section</td>
                                        <td>
                                            <!-- <input class="old_page_inputs" type="text" name="ct_section" id="ct_section" ng-model="newct.ct_section" required /> -->
                                            <select class="old_page_inputs" name="ct_section" id="ct_section" ng-model="newct.ct_section" required>
                                                <option value=''>-Select-</option>
                                                <option value="F">Fabrication</option>
                                                <option value="G">Cladding</option>
                                                <option value="M">Machinery</option>
                                                <option value="S">Steel Section</option>
                                            </select>
                                        </td>
                                        <td style="width:160px;text-align: right;">Notes</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="ct_notes" id="ct_notes" ng-model="newct.ct_notes" required />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:708px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Account Department Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newct.account_flag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="1" ng-model="newct.account_flag">
                                                    <label>Direct</label>
                                                    <input type="radio" value="2" ng-model="newct.account_flag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newct.account_flag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-hide="!newct.account_flag || (+newct.account_flag) < 2">
                                        <td style="width:160px;text-align: right;">Forward Date </td>
                                        <td>
                                            <div>
                                                <input class="old_page_inputs" type="text" name="account_release" id="account_release" ng-model="newct.account_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.account_flag) > 3" />
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.account_flag || (+newct.account_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.account_flag || (+newct.account_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="account_return" id="account_return" ng-model="newct.account_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.account_flag) === 3" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:708px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Material Department Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newct.matterial_flag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="1" ng-model="newct.matterial_flag">
                                                    <label>Direct</label>
                                                    <input type="radio" value="2" ng-model="newct.matterial_flag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newct.matterial_flag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 2">
                                        <td style="width:160px;text-align: right;">Forward Date </td>
                                        <td>
                                            <div>
                                                <input class="old_page_inputs" type="text" name="material_release" id="material_release" ng-model="newct.material_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.matterial_flag) > 1" />
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="material_return" id="material_return" ng-model="newct.material_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.matterial_flag) === 3" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 3">
                                        <td style="width:160px;text-align: right;">Material Status </td>
                                        <td>
                                            <select class="old_page_inputs" name="materialstatus" id="materialstatus" ng-model="newct.materialstatus" ng-required="(+newct.matterial_flag) === 3">
                                                <option value="">-</option>
                                                <?php
                                                foreach ($materialstatus as $mt) {
                                                ?>
                                                    <option value="<?php echo $mt ?>"><?php echo $mt ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width:160px;text-align: right;">Material Ref# NO</td>
                                        <td>
                                            <input class="old_page_inputs" type="text" name="materialrefno" id="materialrefno" ng-model="newct.materialrefno" ng-required="(+newct.matterial_flag) === 3" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:708px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Operation Department Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newct.operation_flag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="1" ng-model="newct.operation_flag">
                                                    <label>Direct</label>
                                                    <input type="radio" value="2" ng-model="newct.operation_flag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newct.operation_flag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-hide="!newct.operation_flag || (+newct.operation_flag) < 2">
                                        <td style="width:160px;text-align: right;">Forward Date </td>
                                        <td>
                                            <div>
                                                <input class="old_page_inputs" type="text" name="operation_release" id="operation_release" ng-model="newct.operation_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.operation_flag) > 1" />
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.operation_flag || (+newct.operation_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.operation_flag || (+newct.operation_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="operation_return" id="operation_return" ng-model="newct.operation_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.operation_flag) === 3" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:708px">
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">
                                            <div class="groupccelss">
                                                Production Status
                                                <div>
                                                    <input type="radio" value="0" ng-model="newct.production_flag">
                                                    <label>N/A</label>
                                                    <input type="radio" value="1" ng-model="newct.production_flag">
                                                    <label>Direct</label>
                                                    <input type="radio" value="2" ng-model="newct.production_flag">
                                                    <label>Forward</label>
                                                    <input type="radio" value="3" ng-model="newct.production_flag">
                                                    <label>Received</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr ng-hide="!newct.production_flag || (+newct.production_flag) < 2">
                                        <td style="width:160px;text-align: right;">Forward Date </td>
                                        <td>
                                            <div>
                                                <input class="old_page_inputs" type="text" name="production_release" id="production_release" ng-model="newct.production_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.production_flag) === 2" />
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.production_flag || (+newct.production_flag) < 3" style="width:160px;text-align: right;">Return Date</td>
                                        <td ng-hide="!newct.production_flag || (+newct.production_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="production_accept" id="production_accept" ng-model="newct.production_accept" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.production_flag) === 3" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <button class="ism-btns btn-normal" type="button" ng-click="saveCt()" style="margin-left: 592px;display:flex;gap:2px;align-items: center;">
                                                <i ng-show="pagetype === 'N'" class="fa fa-check"></i>
                                                <i ng-show="pagetype === 'S'" class="fa fa-upload"></i>
                                                <i ng-show="pagetype === 'E'" class="fa fa-edit"></i>
                                                {{btntxt}}
                                            </button>
                                        </td>
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
<?php
include_once 'monew.dia.php';
?>