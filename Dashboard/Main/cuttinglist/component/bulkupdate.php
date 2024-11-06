<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
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

        table {
            width: 708px;
        }
    }
</style>

<div class="sub-body" style="margin-top: 40px;height: calc(100vh - 70px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Update
            </div>
            <div class="sub-container-right">

            </div>
        </div>
        <div class="sub-body-container-contents" style="height:96%;overflow:auto">
            <div class="naf-tables">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>S.No</th>
                                        <th>CL#</th>
                                        <th>MO#</th>
                                        <th>PJ#</th>
                                        <th>PJN</th>
                                        <th>Marking</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Qty</th>
                                        <th>Area</th>
                                        <th>Engg</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="x in listitems track by $index">
                                        <td>
                                            <div>
                                                <button type="button" ng-click="remove_item($index)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>{{$index+1}}</td>
                                        <td>{{x.ct_no}}</td>
                                        <td>{{x.ct_mono}}</td>
                                        <td>{{x.ctprojectno}}</td>
                                        <td>{{x.ctprojectname}}</td>
                                        <td>{{x.ct_marking}}</td>
                                        <td style="font-size:0.80rem;">{{x.ct_description}}</td>
                                        <td>{{x.ct_location}}</td>
                                        <td>{{x.ct_qty}}</td>
                                        <td>{{x.ct_area}}</td>
                                        <td>{{x.ct_doneby}}</td>
                                    </tr>
                                </tbody>
                            </table>


                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px"">
                                <tbody>
                                    <tr>
                                        <td colspan=" 4" style="font-weight:bold">
                                <div class="groupccelss">
                                    For Update ?
                                    <div>
                                        <input type="radio" value="account" ng-model="updatetype">
                                        <label>Account</label>
                                        <input type="radio" value="material" ng-model="updatetype">
                                        <label>Material</label>
                                        <input type="radio" value="operation" ng-model="updatetype">
                                        <label>Operation</label>
                                        <input type="radio" value="production" ng-model="updatetype">
                                        <label>Production</label>
                                    </div>
                                </div>
                                </td>
                                </tr>
                                </tbody>
                            </table>


                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px" ng-show="updatetype === 'account'">
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
                                                <input class="old_page_inputs" type="text" name="account_release" id="account_release" ng-model="newct.account_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.account_flag) > 3"/>
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.account_flag || (+newct.account_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.account_flag || (+newct.account_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="account_return" id="account_return" ng-model="newct.account_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.account_flag) === 3"/>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px" ng-show="updatetype === 'material'">
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
                                                <input class="old_page_inputs" type="text" name="material_release" id="material_release" ng-model="newct.material_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.matterial_flag) > 1"/>
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.matterial_flag || (+newct.matterial_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="material_return" id="material_return" ng-model="newct.material_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.matterial_flag) === 3"/>
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
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px" ng-show="updatetype === 'operation'">
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
                                                <input class="old_page_inputs" type="text" name="operation_release" id="operation_release" ng-model="newct.operation_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.operation_flag) > 1"/>
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.operation_flag || (+newct.operation_flag) < 3" style="width:160px;text-align: right;">Receive Date</td>
                                        <td ng-hide="!newct.operation_flag || (+newct.operation_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="operation_return" id="operation_return" ng-model="newct.operation_return" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.operation_flag) === 3"/>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px" ng-show="updatetype === 'production'">
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
                                                <input class="old_page_inputs" type="text" name="production_release" id="production_release" ng-model="newct.production_release" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.production_flag) === 2"/>
                                            </div>
                                        </td>
                                        <td ng-hide="!newct.production_flag || (+newct.production_flag) < 3" style="width:160px;text-align: right;">Return Date</td>
                                        <td ng-hide="!newct.production_flag || (+newct.production_flag) < 3">
                                            <div>
                                                <input class="old_page_inputs" type="text" name="production_accept" id="production_accept" ng-model="newct.production_accept" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" ng-required="(+newct.production_flag) === 3"/>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="old_table itemlist raidotables" style="margin-top: 5px;width:1200px">
                                <tbody>
                                    <tr>
                                        <td>
                                            <button class="ism-btns btn-normal" type="button" ng-click="saveCt()" style="margin-left: 1107px;display:flex;gap:2px;align-items: center;" ng-disabled='isupdateing'>
                                                <i ng-show="!isupdateing" class="fa fa-check"></i>
                                                <i ng-show="isupdateing" class="fa fa-cog fa-spin"></i>
                                                Update
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