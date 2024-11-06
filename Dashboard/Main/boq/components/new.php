<?php
session_start();
include_once '../../../../conf.php';
include_once '../../menu.php';
include_once '../../masterlog/st.php';
include_once '../../glassorders/procurement/st.php';
include_once '../../gos/component/st.php';
include_once './st.php';
?>
<div class="sub-body" style="margin-top: 100px;">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" onclick="window.history.back();">
                    <i class="fa fa-arrow-left"></i>
                </div>
                Add New BOQ
            </div>
            <div class="sub-container-right" style="display: flex;">
                <div style="display: flex;;gap:15px;align-items: center;" ng-if="viewproject.project_boq_refno !== ''">
                    <div>Reference# : <span style="font-weight: bold;font-size:15px;color :#c520b7;">{{viewproject.project_boq_refno}}</span></div>
                    <div>Revision# : <span style="font-weight: bold;font-size:15px;color :#e30000;">{{viewproject.project_boq_revision}}</span></div>
                    <div>
                        <button ng-show="!isrptloading" ng-click="add_boqrefno('2')" class="ism-btns btn-delete" style="padding:3px;display:none" >
                            <i class="fa fa-edit"></i>                            
                        </button>
                    </div>
                </div>
                <div style="display: flex;;gap:15px" ng-if="viewproject.project_boq_refno === ''">
                    <button ng-show="!isrptloading" ng-click="add_boqrefno()" class="ism-btns btn-normal">
                        <i class="fa fa-plus"></i>
                        Add Referance
                    </button>
                </div>
            </div>
        </div>
        <div class="sub-body-container-contents" style="height: calc(100vh - 185px);">
            <div class="naf-tables" ng-hide="viewproject.project_boq_refno === ''">
                <div class="old_pgm">
                    <div class="old_pgm_row" style="flex-direction:column;gap:20px">
                        <div class="old_pgm_fitbox">
                            <div ng-show="isloading">
                                <i class="fa fa-cog fa-spin"></i> <span style="margin-left: 5px;">Fetching Data.</span>
                            </div>
                            <div ng-show="!ispageloading">
                                <table class="old_table itemlist">
                                    <thead>
                                        <tr>
                                            <th style="width : 110px">Item</th>
                                            <th style="width: 750px;">Description</th>
                                            <th style="width : 110px">
                                                QTY
                                                <span>
                                                    <input type='radio' ng-model="calcmode" value="qty" ng-change="calcnew()">
                                                </span>
                                            </th>
                                            <th style="width : 110px">Unit</th>
                                            <th style="width : 110px">
                                                Area (sqm)
                                                <span>
                                                    <input type='radio' ng-model="calcmode" value="area" ng-change="calcnew()">
                                                </span>
                                            </th>
                                            <th style="width : 110px">Unit Price</th>
                                            <th style="width : 110px">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width : 110px">
                                                <input list="auto_boqitemnos" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_no" name="poq_item_no" id="poq_item_no" />
                                                <datalist id="auto_boqitemnos">
                                                    <option ng-repeat="x in autocompleate.poq_item_nos track by $index" value="{{x}}">{{x}}</option>
                                                </datalist>
                                            </td>
                                            <td style="padding : 0">
                                                <div style="width: 100%;">
                                                    <table class="old_table itemlist" style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td class='hed'>Type</td>
                                                                <td colspan="4">
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_item_type" name="poq_item_type" id="poq_item_type" ng-keydown="showitemtype($event)" />
                                                                    <div class="autocompleate_search" id="auto_itemtypes">
                                                                        <?php include_once './dias/items.php' ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'></td>
                                                                <td colspan="4">
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_item_remark" name="poq_item_remark" id="poq_item_remark" ng-keydown="addtolist($event)"> </input>

                                                                    <ul>

                                                                        <li ng-repeat="x in descriptionlist">
                                                                            <div style="display: flex;gap:2px">
                                                                                <input type="text" ng-model="x" class="old_page_inputs" /><span><button type="button" ng-click="remove_description($index)"><i class="fa fa-trash"></i></button></span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Location</td>
                                                                <td colspan="4">
                                                                    <input list="auto_boqremarks" type="text" class="old_page_inputs" ng-model="boqeng.poq_remark" name="poq_remark" id="poq_remark" />
                                                                    <datalist id="auto_boqremarks">
                                                                        <option ng-repeat="x in autocompleate.poq_remarks track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Area (MM)</td>
                                                                <td class='hed'> Width (MM)</td>
                                                                <td class='hed'>Height (MM)</td>
                                                                <td class='hed' colspan="2">Tot.Area (MM) <span><input type='checkbox' ng-model="totareamode" ng-change="calcnews()" /></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_item_width" name="poq_item_width" id="poq_item_width" ng-change="calc_item_area()" />
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_item_height" name="poq_item_height" id="poq_item_height" ng-change="calc_item_area()" />
                                                                </td>
                                                                <td colspan="2">
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.area" name="area" id="area" ng-change="calc_item_area()" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Glass</td>
                                                                <td colspan="4">
                                                                    <input list="auto_boqitemglassspecs" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_spec" name="poq_item_glass_spec" id="poq_item_glass_spec" />
                                                                    <datalist id="auto_boqitemglassspecs">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_specs track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Single</td>
                                                                <td>
                                                                    <input list="auto_boqitemglasssingles" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_single" name="poq_item_glass_single" id="poq_item_glass_single" />
                                                                    <datalist id="auto_boqitemglasssingles">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_singles track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>DOUBLE</td>
                                                                <td>
                                                                    <input list="auto_boqitemglassdouble1s" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_double1" name="poq_item_glass_double1" id="poq_item_glass_double1" />
                                                                    <datalist id="auto_boqitemglassdouble1s">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_double1s track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                                <td>
                                                                    <input list="auto_boqitemglassdouble2s" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_double2" name="poq_item_glass_double2" id="poq_item_glass_double2" />
                                                                    <datalist id="auto_boqitemglassdouble2s">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_double2s track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                                <td>
                                                                    <input list="auto_boqitemglassdouble3s" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_double3" name="poq_item_glass_double3" id="poq_item_glass_double3" />
                                                                    <datalist id="auto_boqitemglassdouble3s">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_double3s track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>LAMINATED</td>
                                                                <td>
                                                                    <input list="auto_boqitemglasslaminated1s" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_laminate1" name="poq_item_glass_laminate1" id="poq_item_glass_laminate1" />
                                                                    <datalist id="auto_boqitemglasslaminated1s">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_laminate1s track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                                <td>
                                                                    <input list="auto_boqitemglasslaminated2s" type="text" class="old_page_inputs" ng-model="boqeng.poq_item_glass_laminate2" name="poq_item_glass_laminate2" id="poq_item_glass_laminate2" />
                                                                    <datalist id="auto_boqitemglasslaminated2s">
                                                                        <option ng-repeat="x in autocompleate.poq_item_glass_laminate2s track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Drawing</td>
                                                                <td colspan="4">
                                                                    <input list="auto_boqitemdrawings" type="text" class="old_page_inputs" ng-model="boqeng.poq_drawing" name="poq_drawing" id="poq_drawing" />
                                                                    <datalist id="auto_boqitemdrawings">
                                                                        <option ng-repeat="x in autocompleate.poq_drawings track by $index" value="{{x}}">{{x}}</option>
                                                                    </datalist>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>Finish</td>
                                                                <td colspan="4">
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_finish" name="poq_finish" id="poq_finish" ng-keydown="showfinishtype($event)" />
                                                                    <div class="autocompleate_search" id="auto_finsish">
                                                                        <?php include_once './dias/finishs.php' ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='hed'>System</td>
                                                                <td colspan="4">
                                                                    <input type="text" class="old_page_inputs" ng-model="boqeng.poq_system_type" name="poq_system_type" id="poq_system_type" ng-keydown="showsystemtype($event)" />
                                                                    <div class="autocompleate_search" id="auto_systems">
                                                                        <?php include_once './dias/systems.php' ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.poq_qty" name="poq_qty" id="poq_qty" ng-change="cal_item_qty()" />
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.poq_unit" name="poq_unit" id="poq_unit" ng-keydown="showunitstype($event)" />
                                                <div class="autocompleate_search" id="auto_units">
                                                    <?php include_once './dias/units.php' ?>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.boq_area" name="boq_area" id="boq_area" ng-change="calc_item_area()" />
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.poq_uprice" name="poq_uprice" id="poq_uprice" ng-change="cal_item_qty()" />
                                            </td>
                                            <td>
                                                <input type="text" class="old_page_inputs" ng-model="boqeng.totprice" name="totprice" id="totprice" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                <button ng-hide="isloading" class="ism-btns btn-normal" type="button" ng-click="save_boq()">
                                                    <i class="fa fa-check"></i>
                                                    Save
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
</div>
<?php
include_once './dias/referanceupdate.php';
include_once './dias/itemnew.php';
include_once './dias/finishnew.php';
include_once './dias/systemnew.php';
include_once './dias/unitsnew.php';
?>