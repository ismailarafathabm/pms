<div class="ism-pms-dialog" id="dia_glassorders">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Add New Glass Order
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_glassorders').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="glassorder.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_glassorder_submit()" name="glassorder_save" id="save_glassorder" ng-show="!glassorder.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{glassorder.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Project</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goproject" id="goproject" ng-model="glassorder.data.goproject" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_project_list()" required ng-readonly="glassorder.mode === 'E'"/>
                            <project-listnew class="ism-new-pms-auto-dia" id="budget_auto_projects" style="width: 400px;left: -6px;top: -2px;">
                            </project-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gosupplier" id="gosupplier" ng-model="glassorder.data.gosupplier" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_supplier_list()" required />
                            <suppliers-listnew class="ism-new-pms-auto-dia" id="budget_auto_suppliers" style="width:300px;left:-60px">
                            </suppliers-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Order No</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gono" id="gono" ng-model="glassorder.data.gono" class="ism-dialog-rows-input-controller " required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Done By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="godoneby" id="godoneby" ng-model="glassorder.data.godoneby" class="ism-dialog-rows-input-controller " required/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 120px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Relesed to Purch.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreldate" id="goreldate" ng-model="glassorder.data.goreldate" class="ism-dialog-rows-input-controller calendar" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Specification</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goglassspc" id="goglassspc" ng-model="glassorder.data.goglassspc" class="ism-dialog-rows-input-controller srcico" ng-keydown="view_glass_list()" required />
                            <glass-listnew class="ism-new-pms-auto-dia" id="budget_auto_glass" style="width: 485px;left: -2px;top: -5px;">                                
                            </glass-listnew>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Glass Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goglasstype" id="goglasstype" ng-model="glassorder.data.goglasstype" class="ism-dialog-rows-input-controller " required readonly/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Thickness</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goglassthickness" id="goglassthickness" ng-model="glassorder.data.goglassthickness" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Marking Location</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gomarkinglocation" id="gomarkinglocation" ng-model="glassorder.data.gomarkinglocation" class="ism-dialog-rows-input-controller" required />                            
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goglassqty" id="goglassqty" ng-model="glassorder.data.goglassqty" class="ism-dialog-rows-input-controller" required ng-change="calculation()"/>
                        </div>
                    </div>
                    
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="gotype" id="gotype" ng-model="glassorder.data.gotype" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select-</option>
                                <option value="go">GO</option>
                                <option value="bk">BK</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="gostatus" id="gostatus" ng-model="glassorder.data.gostatus" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select-</option>
                                <option value="pending">Pending</option>
                                <option value="ordered">Ordered</option>
                            </select>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;" ng-show="glassorder.data.gostatus === 'ordered'">
                        <div class="ism-dialog-body-rows-input-container-lable">Received Form Purch.</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gorcdate" id="gorcdate" ng-model="glassorder.data.gorcdate" class="ism-dialog-rows-input-controller calendar" ng-required="glassorder.data.gostatus === 'ordered'" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_budgetdate" />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 450px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Remark</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goremark" id="goremark" ng-model="glassorder.data.goremark" class="ism-dialog-rows-input-controller"required />                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="glassorder.isloading || glassorder_save.$invalid">
                    {{glassorder.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_glassorders').style.display='none'">
                    Close
                </button>
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>
    </div>
</div>