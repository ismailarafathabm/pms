<div class="ism-pms-dialog" id="dia_suppliers">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Suppliers
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!suppliers.isloading" onclick="document.getElementById('dia_suppliers').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="suppliers.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_suppliers_submit()" name="suppliersave" id="save_suppliers" ng-show="!suppliers.isloading">
            <div class="ism-pms-dialog-body" style="width:600px">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{suppliers.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Name</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="glasssuppliername" id="glasssuppliername" ng-model="suppliers.data.glasssuppliername" class="ism-dialog-rows-input-controller" required ng-keyup="save_glasstype_keyup($event)" />
                        </div>

                        <div class="ism-dialog-input-error" ng-show="suppliersave.glasssuppliername.$invalid && suppliersave.glasssuppliername.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Name </span>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Contact Person</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="suppliercontact" id="suppliercontact" ng-model="suppliers.data.suppliercontact" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Contact Number</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="supplierphone" id="supplierphone" ng-model="suppliers.data.supplierphone" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">E-Mail</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="supplieremail" id="supplieremail" ng-model="suppliers.data.supplieremail" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Fax</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="supplierfax" id="supplierfax" ng-model="suppliers.data.supplierfax" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>                   
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Loation</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="glasssuppliercountry" id="glasssuppliercountry" ng-model="suppliers.data.glasssuppliercountry" class="ism-dialog-rows-input-controller" required ng-keyup="save_glasstype_keyup($event)" />
                        </div>

                        <div class="ism-dialog-input-error" ng-show="suppliersave.glasssuppliercountry.$invalid && suppliersave.glasssuppliercountry.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Location </span>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container" style="flex:1 1 300px">
                        <div class="ism-dialog-body-rows-input-container-lable">Address</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="supplieraddress" id="supplieraddress" ng-model="suppliers.data.supplieraddress" class="ism-dialog-rows-input-controller" />
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="suppliers.isloading || suppliersave.$invalid">
                    {{suppliers.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_suppliers').style.display='none'">
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