<?php
session_start();
$userdep = $_SESSION['nafco_alu_user_department'];
include_once '../../../../conf.php';
include_once '../../menu1.php';
include_once '../../glassorders/purchase/nst.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../cuttinglist/component/st.php';
$page_access_users = ['demo', 'byju'];
$page_access = in_array($user, $page_access_users);
include_once 'st.php';
?>


<div class="sub-body" style="margin-top: 75px;height: calc(100vh - 120px);">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                UPDATE CUTTING LIST
            </div>
            <div class="sub-container-right">
                <button ng-show="!isrptloading" ng-click="update_handler()" class="btn btn-save" style="width: auto;">
                    <i class="fa fa-edit"></i>
                    Recive All
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height:93%;background: #f3f3f3;">
            <?php
            if (!$page_access) {
            ?>
                <h1>You Can not Access This Page!</h1>
            <?php
                die();
            }

            ?>
            <div ng-show="isrptloading">Please Wait Loading....</div>
            <div ng-show="!isrptloading" class="ac-new-container">
                <div class="ac-new-row">
                    <div class="ac-new-cols tbl">
                        <table class="ac-table" style="width:max-content">
                            <thead class="ac-table-header">
                                <tr>
                                    <th class="ac-table-th"></th>
                                    <th class="ac-table-th">MO</th>
                                    <th class="ac-table-th">CT</th>
                                    <th class="ac-table-th">S.No</th>

                                    <th class="ac-table-th">MO#</th>
                                    <th class="ac-table-th">CL#</th>
                                    <th class="ac-table-th">Marking</th>
                                    <th class="ac-table-th">Description</th>
                                    
                                    <th class="ac-table-th">Date</th>
                                    <th class="ac-table-th">Material Status</th>
                                    <th class="ac-table-th">Trade</th>
                                    <th class="ac-table-th">Section</th>
                                    <th class="ac-table-th">Qty</th>
                                    <th class="ac-table-th">Area</th>
                                    <th class="ac-table-th">Remark</th>
                                    <th class="ac-table-th">Delivery</th>
                                </tr>
                                <tr>
                                    <th class="ac-table-td" style="background: #fff;"></th>
                                    <th class="ac-table-td" style="background: #fff;"></th>
                                    <th class="ac-table-td" style="background: #fff;"></th>
                                    <th class="ac-table-td" style="background: #fff;"></th>
                                    <th class="ac-table-td" colspan="12" style="background: #fff;">
                                        <input class="ac-new-frm-inputctrl" type="text" placeholder="search..." ng-model="srcitems" />
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="ac-table-tbody">
                                <tr ng-repeat="x in clitems | filter:srcitems">
                                    <td class="ac-table-td">
                                        <button ng-show="!isrptloading" ng-click="removeitem_handler($index)" class="btn btn-cancel" style="width: auto;padding:2px" >
                                            <i class="fa fa-trash"></i>                                            
                                        </button>
                                    </td>
                                    <td class="ac-table-td">
                                        <a ng-if="x.mofile.toString() !== '0'" href="<?php echo $url_base ?>assets/cuttinglists/mo/{{x.mofilename}}.pdf?version=<?php echo $v ?>" target="_blank">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="ac-table-td">
                                        <a ng-if="x.ctfile.toString() !== '0'" href="<?php echo $url_base ?>assets/cuttinglists/cuttinglist/{{x.ctfilename}}.pdf?version=<?php echo $v ?>" target="_blank">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="ac-table-td">{{$index+1}}</td>

                                    <td class="ac-table-td">{{x.ct_mono}}</td>
                                    <td class="ac-table-td">{{x.ctno}}</td>
                                    <td class="ac-table-td">{{x.ct_marking}}</td>
                                    <td class="ac-table-td">{{x.ct_description}}</td>
                                    
                                    <td class="ac-table-td" style="width:80px">{{x.ctrdate}}
                                        <!-- <input type="text" class="ac-new-frm-inputctrl" ng-value="{{x.ctrdate | date}}" id="{{$index}}_ctrdate" ng-keydown="gonext($event,$index,'ctrdate','ctmaterialstatus',null)" placeholder="dd-mm-yyyy"/>                                         -->
                                    </td>
                                    
                                    <td class="ac-table-td" style="width:200px">
                                        <input list="mstatuslist" type="text" class="ac-new-frm-inputctrl" ng-model="x.ctmaterialstatus" id="{{$index}}_ctmaterialstatus" ng-keydown="gonext($event,$index,'ctmaterialstatus','cttrade','ctrdate')">
                                    </td>
                                    <td class="ac-table-td" style="width:200px">
                                        <input list="tradelist" type="text" class="ac-new-frm-inputctrl" ng-model="x.cttrade" id="{{$index}}_cttrade" ng-keydown="gonext($event,$index,'cttrade','ctrequrieqty','ctmaterialstatus')">
                                        <datalist id="tradelist">
                                            <option ng-repeat="x in autoitems.cttrade" value="{{x}}">{{x}}</option>
                                        </datalist>
                                    </td>
                                    <td class="ac-table-td">
                                        
                                        <input list="sectionadelist" type="text" class="ac-new-frm-inputctrl" ng-model="x.currentsection" id="{{$index}}_currentsection" ng-keydown="gonext($event,$index,'currentsection','ctrequrieqty','cttrade')">
                                        <datalist id="sectionadelist">
                                            <option ng-repeat="x in autoitems.currentsection" value="{{x}}">{{x}}</option>
                                        </datalist>
                                    </td>
                                    <td class="ac-table-td" style="width:110px">
                                        <input type="text" class="ac-new-frm-inputctrl" ng-model="x.ctrequrieqty" id="{{$index}}_ctrequrieqty" ng-keydown="gonext($event,$index,'ctrequrieqty','ctreqarea','currentsection')">
                                    </td>
                                    <td class="ac-table-td" style="width:110px">
                                        <input type="text" class="ac-new-frm-inputctrl" ng-model="x.ctreqarea" id="{{$index}}_ctreqarea" ng-keydown="gonext($event,$index,'ctreqarea','ctremarks','ctrequrieqty')">
                                    </td>
                                    <td class="ac-table-td" style="width:350px">
                                        <input type="text" class="ac-new-frm-inputctrl" ng-model="x.ctremarks" id="{{$index}}_ctremarks" ng-keydown="gonext($event,$index,'ctremarks','deliverysh','ctreqarea')">
                                    </td>
                                    <td class="ac-table-td" style="width:120px">                                        
                                        <input type="text" placeholder="dd-mm-yyyy" class="ac-new-frm-inputctrl" ng-model="x.deliverysh" id="{{$index}}_deliverysh" ng-keydown="gonext($event,$index,'deliverysh',null,'ctremarks')" />
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- for list of datas -->
                    </div>
                    <div class="ac-new-cols frm" style="display:none">
                        <div class="ac-new-frm">
                            <div class="ac-new-frm-container">
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">CLNO#</div>
                                        <div class="ac-new-frm-inputs">
                                            <input type="text" class="ac-new-frm-inputctrl" name="ctno" id="ctno" ng-model="item.ctno" required readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">Date</div>
                                        <div class="ac-new-frm-inputs">
                                            <input type="text" class="ac-new-frm-inputctrl" name="ctrdate" id="ctrdate" ng-model="item.ctrdate" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate3" />
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">Material Status</div>
                                        <div class="ac-new-frm-inputs">
                                            <input list="mstatuslist" type="text" class="ac-new-frm-inputctrl" name="ctmaterialstatus" id="ctmaterialstatus" ng-model="item.ctmaterialstatus" required />
                                            <datalist id="mstatuslist">
                                                <option ng-repeat="x in autoitems.ctmaterialstatus" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">Trade</div>
                                        <div class="ac-new-frm-inputs">
                                            <input list="tradelist" type="text" class="ac-new-frm-inputctrl" name="cttrade" id="cttrade" ng-model="item.cttrade" required />
                                            <datalist id="tradelist">
                                                <option ng-repeat="x in autoitems.cttrade" value="{{x}}">{{x}}</option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">R.Qty</div>
                                        <div class="ac-new-frm-inputs">
                                            <input type="text" class="ac-new-frm-inputctrl" name="ctrequrieqty" id="ctrequrieqty" ng-model="item.ctrequrieqty" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">Area</div>
                                        <div class="ac-new-frm-inputs">
                                            <input type="text" class="ac-new-frm-inputctrl" name="ctreqarea" id="ctreqarea" ng-model="item.ctreqarea" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable">Remarks</div>
                                        <div class="ac-new-frm-inputs">
                                            <textarea rows="5" type="text" class="ac-new-frm-inputctrl" name="ctremarks" id="ctremarks" ng-model="item.ctremarks" required>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="ac-new-frm-row">
                                    <div class="ac-new-frm-cols">
                                        <div class="ac-new-frm-lable"></div>
                                        <div class="ac-new-frm-inputs" style="display: flex;align-items: center; justify-content: space-between;flex-direction:row">
                                            <button type="button" class="btn btn-cancel" style="width: auto;" ng-click="form_cancel_handler()">
                                                <i class="fa fa-times"></i>
                                                Cancel
                                            </button>
                                            <button type="button" class="btn btn-save" style="width: auto;" ng-click="form_save_handler()">
                                                <i class="fa fa-download"></i>
                                                Recive
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- for forms -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>