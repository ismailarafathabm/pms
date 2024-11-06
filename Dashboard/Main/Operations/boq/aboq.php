<div class="ism-dialogbox" id="dianewboqadd">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Add New BOQS
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('dianewboqadd').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_boq" ng-submit="boq_new_save()">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            #Item Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemNoAutoCompleate" type="text" ng-model="new_boq.item_no" name="item_no" id="item_no" class="nafco-inputs" required onkeyup="this.value = this.value.toUpperCase();">
                            <datalist id="boqItemNoAutoCompleate">
                                <option ng-repeat="x in boqItemNoAutoCompleate | orderBy">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            LOCATION
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemRemarkAutoCompleate" type="text" ng-model="new_boq.item_remark" name="item_remark" id="item_remark" class="nafco-inputs" required>
                            <datalist id="boqItemRemarkAutoCompleate">
                                <option ng-repeat="x in boqItemRemarkAutoCompleate | orderBy">{{x}}</option>
                            </datalist>
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
                            <select ng-model="new_boq.item_type" name="item_type" id="item_type" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="_pt in _ptype | orderBy:'ptype_name'" value="{{_pt.ptype_id}}">{{_pt.ptype_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemDescription" type="text" ng-model="new_boq.item_description" name="item_description" id="item_description" class="nafco-inputs" required>
                            <datalist id="boqItemDescription">
                            <option ng-repeat="x in boqItemDescription | orderBy">{{x}}</option>
                            </datalist>
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
                            <input type="text" ng-model="new_boq.item_width" name="item_width" id="item_width" class="nafco-inputs" required ng-keyup="area_cal($event)">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Height
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" ng-model="new_boq.item_height" name="item_height" id="item_height" class="nafco-inputs" required ng-keyup="area_cal($event)">
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
                            <input type="text" name="item_area" id="item_area" class="nafco-inputs" required readonly value="{{_item_area|number:2}}">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Glass specification' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemGlassSpecification" type="text" ng-model="new_boq.glass_name" name="glass_name" id="glass_name" class="nafco-inputs" required>
                            <datalist id="boqItemGlassSpecification">
                            <option ng-repeat="x in boqItemGlassSpecification | orderBy">{{x}}</option>
                            </datalist>
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
                            <input list="boqItemGlassSingle" type="text" ng-model="new_boq.glass_single" name="glass_single" id="glass_single" class="nafco-inputs" required>
                            <datalist id="boqItemGlassSingle">
                            <option ng-repeat="x in boqItemGlassSingle | orderBy">{{x}}</option>
                            </datalist>
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
                            <input list="boqItemGlassDouble1" type="text" ng-model="new_boq.glass_double1" name="glass_double1" id="glass_double1" class="nafco-inputs" required>
                            <datalist id="boqItemGlassDouble1">
                            <option ng-repeat="x in boqItemGlassDouble1 | orderBy">{{x}}</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">

                        </div>
                        <div class="dialog-frm-cemi"></div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemGlassDouble2" type="text" ng-model="new_boq.glass_double2" name="glass_double2" id="glass_double2" class="nafco-inputs" required>
                            <datalist id="boqItemGlassDouble2">
                            <option ng-repeat="x in boqItemGlassDouble2 | orderBy">{{x}}</option>
                            </datalist>
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
                            <input list="boqItemGlassDouble3" type="text" ng-model="new_boq.glass_double3" name="glass_double3" id="glass_double3" class="nafco-inputs" required>
                            <datalist id="boqItemGlassDouble3">
                            <option ng-repeat="x in boqItemGlassDouble3 | orderBy">{{x}}</option>
                            </datalist>
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
                            <input list="boqItemGlassLaminate1" type="text" ng-model="new_boq.glass_laminated1" name="glass_laminated1" id="glass_laminated1" class="nafco-inputs" required>
                            <datalist id="boqItemGlassLaminate1">
                                <option ng-repeat="x in boqItemGlassLaminate1 | orderBy">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">

                        </div>
                        <div class="dialog-frm-cemi"></div>
                        <div class="dialog-frm-controls">
                            <input list="boqItemGlassLaminate2" type="text" ng-model="new_boq.glass_laminated2" name="glass_laminated2" id="glass_laminated2" class="nafco-inputs" required>
                            <datalist id="boqItemGlassLaminate2">
                            <option ng-repeat="x in boqItemGlassLaminate2 | orderBy">{{x}}</option>
                            </datalist>
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
                            <select ng-model="new_boq.finish_type" name="finish_type" id="finish_type" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="_fin in _sysFinish | orderBy : 'finish_name'" value="{{_fin.finish_id}}">{{_fin.finish_name}}</option>
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
                            <select ng-model="new_boq.system_type" name="system_type" id="system_type" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="k in _systype | orderBy:'system_type_name'" value="{{k.system_type_id}}">{{k.system_type_name}}</option>
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
                            <input list="boqItemDrawing" type="text" ng-model="new_boq.drawing_refno" name="drawing_refno" id="drawing_refno" class="nafco-inputs" required>
                            <datalist id="boqItemDrawing">
                                <option ng-repeat="x in boqItemDrawing | orderBy">{{x}}</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Qty' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" ng-model="new_boq.item_qty" name="item_qty" id="item_qty" class="nafco-inputs" required ng-keyup="price_calc($event)">
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
                            <select ng-model="new_boq.item_unit" name="item_unit" id="item_unit" class="nafco-inputs" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="_u in _units | orderBy : 'unit_name'" ng-value="{{_u.uint_id}}">{{_u.unit_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'Area' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" ng-model="new_boq.item_aras" name="item_aras" id="item_aras" class="nafco-inputs" required ng-keyup="price_calc($event)">
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
                            <input type="text" style="font-weight:bold" ng-model="new_boq.item_Uprice" name="item_Uprice" id="item_Uprice" class="nafco-inputs" required ng-keyup="price_calc($event)">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            {{'total Price' | uppercase}}
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" style="font-weight:bold" name="item_Tprice" id="item_Tprice" class="nafco-inputs" required readonly value="{{_itemTprice | number:2}}">
                        </div>
                    </div>
                </div>

                <div class="dialog-row" style="background:#e3e2e2">
                    <table class="table-boq">
                        <tr>
                            <td>Add Notes</td>
                            <td>
                                <input list="boqItemNotes" type="text" name="notesnew" id="notesnew" class="nafco-inputs">
                                <datalist id="boqItemNotes">
                                <option ng-repeat="x in boqItemNotes | orderBy">{{x}}</option>
                            </datalist>
                            </td>
                            <td>
                                <button id="auto_calbtn" type="button" class="ism-btns btn-save" style="padding:2px 4px;" ng-click="addnewnotes()">
                                    <i class=" fa fa-plus"></i>
                                    New
                                </button>
                            </td>
                        </tr>
                        <tr ng-repeat="x in _notess">
                            <td></td>
                            <td>
                                <input type="text" name="newitemsnotes[]" class="nafco-inputs" value="{{x}}" readonly>
                            </td>
                            <td>
                                <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" ng-click="remove(x)">
                                    <i class=" fa fa-minus"></i>
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class=" dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('dianewboqadd').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_boq.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_boq.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_boq.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>