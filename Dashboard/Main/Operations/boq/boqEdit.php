<div class="ism-dialogbox" id="dianewboqEdit">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                EDIT BOQ INFORMATION
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dianewboqEdit').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_edit_boq" ng-submit="boq_edit_save()">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            #Item Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.item_no" name="item_no" id="edit_item_no" class="nafco-inputs" required onkeyup="this.value = this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            LOCATION
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.item_remark" name="item_remark" id="edit_item_remark" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Type
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" onclick="document.getElementById('type_add').style.display='block'">
                                <i class="fa fa-plus"></i>
                                New
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="edit_boq.item_type" name="item_type" id="edit_item_type" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="_pt in _ptype" value="{{_pt.ptype_id}}">{{_pt.ptype_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.item_description" name="item_description" id="edit_item_description" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Width
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.item_width" name="item_width" id="edit_item_width" class="nafco-inputs" required ng-keyup="area_cal1($event)">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Height
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.item_height" name="item_height" id="edit_item_height" class="nafco-inputs" required ng-keyup="area_cal1($event)">
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Area
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" name="item_area" id="edit_item_area_edit" class="nafco-inputs" required readonly value="{{_item_area_edit|number:2}}">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Glass specification' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_name" name="glass_name" id="edit_glass_name" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row" style="
                 margin-top: 2px;
                margin-bottom: 2px;
                border-radius: 6px;
                background: #e3e2e2;
                ">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            SINGLE
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_single" name="glass_single" id="edit_glass_single" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row" style=" 
                        margin-bottom: 2px;
                        border-radius: 6px;
                        margin-top: 10px;
                        padding: 5px;
                        background: #e3e2e2;
                ">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Double
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_double1" name="glass_double1" id="edit_glass_double1" class="nafco-inputs" required>
                        </div>
                    </div>

                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">

                        </div>
                        <div class="dialog-frm-cemi"></div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_double2" name="glass_double2" id="edit_glass_double2" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row" style="
                    margin-bottom: 10px;
                    border-radius: 6px;
                    padding: 5px;
                    background: #e3e2e2;
                    margin-top: -10px;
                ">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">

                        </div>
                        <div class="dialog-frm-cemi"></div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_double3" name="glass_double3" id="edit_glass_double3" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row" style="
                margin-top: 2px;
                margin-bottom: 2px;
                border-radius: 6px;
                background: #e3e2e2;
                ">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Laminated
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_laminated1" name="glass_laminated1" id="edit_glass_laminated1" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">

                        </div>
                        <div class="dialog-frm-cemi"></div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.glass_laminated2" name="glass_laminated2" id="edit_glass_laminated2" class="nafco-inputs" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'finish' | uppercase}}
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" onclick="document.getElementById('finish_add').style.display='block'">
                                <i class="fa fa-plus"></i>
                                New
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="edit_boq.finish_type" name="finish_type" id="edit_finish_type" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="_fin in _sysFinish" value="{{_fin.finish_id}}">{{_fin.finish_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'System type' | uppercase}}
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" onclick="document.getElementById('systype_add').style.display='block'">
                                <i class="fa fa-plus"></i>
                                New
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="edit_boq.system_type" name="system_type" id="edit_system_type" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="k in _systype" value="{{k.system_type_id}}">{{k.system_type_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'drawing' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="edit_boq.drawing_refno" name="drawing_refno" id="edit_drawing_refno" class="nafco-inputs" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Qty' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" ng-model="edit_boq.item_qty" name="item_qty" id="edit_item_qty" class="nafco-inputs" required ng-keyup="price_calc1($event)">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'UNIT' | uppercase}}
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" onclick="document.getElementById('units_add').style.display='block'">
                                <i class=" fa fa-plus"></i>
                                New
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select ng-model="edit_boq.item_unit" name="item_unit" id="edit_item_unit" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="_u in _units" ng-value="{{_u.uint_id}}">{{_u.unit_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Area' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" ng-model="edit_boq.item_aras" name="item_aras" id="edit_item_aras" class="nafco-inputs" required ng-keyup="price_calc1($event)">
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'unit price' | uppercase}}

                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" ng-model="edit_boq.item_Uprice" name="item_Uprice" id="edit_item_Uprice" class="nafco-inputs" required ng-keyup="price_calc1($event)">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'total Price' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" name="item_Tprice_edit" id="edit_item_Tprice" class="nafco-inputs" required readonly value="{{_itemTprice_edit | number:2}}">
                        </div>
                    </div>
                </div>

            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dianewboqEdit').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_edit_boq.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_edit_boq.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_edit_boq.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>