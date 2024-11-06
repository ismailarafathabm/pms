<div class="ism-dialogbox" id="new-cuttinglist">
    <div class="ism-dialog-body" style="max-width:1200px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                New Cutting List & MO'Released To Prodcution Department
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-cuttinglist').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form enctype="multipart/form-data" name="save_new_cuttinglist" id="save_new_cuttinglist">
            <div class="dialog-body">
                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Contract Number
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_project_id" name="cuttinglist_project_id" id="cuttinglist_project_id" required readonly>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="newglassorder.cuttinglistfor" name="cuttinglistfor" id="cuttinglistfor" ng-change="qutycheck()">
                                <option value="">-Select-</option>
                                <option value="1">BOQ ITEMS</option>
                                <option value="2">{{'miscellaneous items' | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            BOQ Item No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="newglassorder.cuttinglist_boqitem" name="cuttinglist_boqitem" id="cuttinglist_boqitem" ng-change="getoldbalance()">
                                <option value="">-Select-</option>
                                <option ng-repeat="boqs in measurements.boq" value="{{boqs.item_no}}">
                                    {{boqs.item_no}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Cl.Ref No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_clrefno" name="cuttinglist_clrefno" id="cuttinglist_clrefno" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Cl.Date :
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_newcldate" type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_cldaterelease" name="cuttinglist_cldaterelease" id="cuttinglist_cldaterelease" required placeholder='dd-mm-yyyy'>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Mo.Ref.No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_morefno" name="cuttinglist_morefno" id="cuttinglist_morefno" required ng-blur="getrefnoinfos()">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            MO. Released TO Acct
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_moreleaseddate" type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_moreleasedtoacct" name="cuttinglist_moreleasedtoacct" id="cuttinglist_moreleasedtoacct" required placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            MO. Released TO Production
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtoproductionnew" type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_moreleasedtoproduction" name="cuttinglist_moreleasedtoproduction" id="cuttinglist_moreleasedtoproduction" required placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Released To
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_releasedto" name="cuttinglist_releasedto" id="cuttinglist_releasedto" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Done By
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_doneby" name="cuttinglist_doneby" id="cuttinglist_doneby" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Marking Type
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_markingtype" name="cuttinglist_markingtype" id="cuttinglist_markingtype" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Location
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea class="nafco-inputs" ng-model="newglassorder.cuttinglist_location" name="cuttinglist_location" id="cuttinglist_location" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Description
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea class="nafco-inputs" ng-model="newglassorder.cuttinglist_descripton" name="cuttinglist_descripton" id="cuttinglist_descripton" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            HEIGHT
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_height" name="cuttinglist_height" id="cuttinglist_height" required>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Width
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_width" name="cuttinglist_width" id="cuttinglist_width" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Area
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" ng-click="calculates_area()">
                                <i class="fa fa-calculator"></i>
                                Calculate
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_area" name="cuttinglist_area" id="cuttinglist_area" required ng-change='totaracalc()'>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_qty" name="cuttinglist_qty" id="cuttinglist_qty" required ng-change='totaracalc()'>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Qty Type
                            <button id="create_new_qtytype" type="button" class="ism-btns btn-save" style="padding:2px 4px;" onclick="document.getElementById('new-qtytype').style.display='block';document.getElementById('qtytypenew').focus();">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="newglassorder.qty_types" name="cuttinglistqtytype" id="cuttinglistqtytype" required>
                                <option value="">-select-</option>
                                <option ng-repeat="qx in ctqtytype" value="{{qx.qty_type_id}}">
                                    {{qx.cuttinglist_qty_type | uppercase}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Total Area
                            <button id="auto_calbtn" type="button" class="ism-btns btn-close" style="padding:2px 4px;" ng-click="calculates_totarea()">
                                <i class="fa fa-calculator"></i>
                                Calculate
                            </button>
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_totarea" name="cuttinglist_totarea" id="cuttinglist_totarea" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Glass Ref No.
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="newglassorder.cuttinglist_classrefno" name="cuttinglist_classrefno" id="cuttinglist_classrefno" required>
                                <option value="">-Select-</option>
                                <option ng-repeat="order in glassorder" value="{{order}}">{{order}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            SHEET TYPE
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_sheettp" name="cuttinglist_sheettp" id="cuttinglist_sheettp" required>
                        </div>
                    </div>
                </div>


                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Remark
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <textarea class="nafco-inputs" ng-model="newglassorder.cuttinglist_remarks" name="cuttinglist_remarks" id="cuttinglist_remarks" required></textarea>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            SECTION
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="newglassorder.cuttinglist_section" name="cuttinglist_section" id="cuttinglist_section" required>
                        </div>
                    </div>
                </div>

                <div class="dialog-row">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload (PDF File only)
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" class="nafco-inputs" name="pdffile[]" id="pdffile" multiple>
                        </div>
                    </div>
                    <div class="dialog-frm-ctrls" style="padding:3px;flex-direction: column;">
                        <div style="margin-bottom:3px;background: #baffe9;border: 1px solid #2f8132;color: #2f8132;display:flex;flex-direction: row;justify-content: space-between;width: 100%;padding: 5px;border-radius: 5px;">
                            <div class="nafco-label">
                                BOQ ITEM : <span style="font-weight:bold">{{oldinfos.boq_cnt}}</span>
                            </div>
                            <div class="nafco-label">
                                Old Released : <span style="font-weight:bold">{{oldinfos.old_cnt}}</span>
                            </div>
                            <div class="nafco-label">
                                Miscellaneous : <span style="font-weight:bold">{{oldinfos.mis_cnt}}</span>
                            </div>
                            <div class="nafco-label">
                                Balance : <span style="font-weight:bold">{{oldinfos.diff}}</span>
                            </div>
                            <div class="nafco-label">
                                Remaining Balance : <span style="font-weight:bold">{{rembalance}}</span>
                            </div>
                        </div>
                        <div>
                            <div ng-if="errordivscuttinglist" class="nafco-col-md-6" style="background: #ffc9c9;border: 1px solid #620202;color:maroon;text-align: center;width: 100%;padding: 5px;border-radius: 5px;"">
                                <p>Over qty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" dialog-foot">
                                <div class="dialog-foot-buttons">
                                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-cuttinglist').style.display='none'">
                                        <i class="fa fa-times"></i>
                                        Close
                                    </button>
                                    <button ng-disabled="save_new_cuttinglist.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                                        <i ng-if="save_new_cuttinglist.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                                        <i ng-if="!save_new_cuttinglist.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
        </form>

    </div>
</div>