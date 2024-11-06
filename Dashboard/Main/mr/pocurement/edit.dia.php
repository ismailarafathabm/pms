<div class="ism-pms-dialog" ng-if="newmrp.isshow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               Receipt
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!newmrp.isloading" ng-click="newmrp.isshow = false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="newmrp.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">Item#</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mritem" id="mritem" ng-model="newmrp.data.mritem" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Die Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrdieweight" id="mrdieweight" ng-model="newmrp.data.mrdieweight" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Lenght</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrreqlength" id="mrreqlength" ng-model="newmrp.data.mrreqlength" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Receipt#</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_orderno" id="mrp_orderno" ng-model="newmrp.data.mrp_orderno" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_okdate" id="mrp_okdate" ng-model="newmrp.data.mrp_okdate" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_supplier" id="mrp_supplier" ng-model="newmrp.data.mrp_supplier" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">System</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_system" id="mrp_system" ng-model="newmrp.data.mrp_system" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">ETA</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_eta" id="mrp_eta" ng-model="newmrp.data.mrp_eta" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Total Ordered</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrp_totorder" id="mrp_totorder" ng-model="newmrp.data.mrp_totorder" ng-change="caltoweight()" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Total Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="totalweight" id="totalweight" ng-model="newmrp.data.totalweight" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button ng-click="updatemrp()" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="newmrp.isloading">
                Save
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="newmrp.isshow = false">
                Close
            </button>
        </div>
    </div>
</div>