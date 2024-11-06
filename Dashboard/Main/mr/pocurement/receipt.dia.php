<div class="ism-pms-dialog" ng-if="mrpreceipt.isshow" >
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               MR RECEIPT
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!mrpreceipt.isloading" ng-click="mrpreceipt.isshow = false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="mrpreceipt.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body">           
            <div ng-hide="(+selected_mr.balqty) === 0" class="ism-pms-dialog-body-rows" style="width: 435px;" ng-show="!mrpreceipt.isloading">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">Item#</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mritemdescription" id="mritemdescription" ng-model="mrpreceipt.data.mritemdescription" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Die Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mritemdieweight" id="mritemdieweight" ng-model="mrpreceipt.data.mritemdieweight" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Lenght</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mritemlength" id="mritemlength" ng-model="mrpreceipt.data.mritemlength" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Receipt#</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrreceiptid" id="mrreceiptid" ng-model="mrpreceipt.data.mrreceiptid" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Date </div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrreciptdate" id="mrreciptdate" ng-model="mrpreceipt.data.mrreciptdate" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">Supplier</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mrsupplier" id="mrsupplier" ng-model="mrpreceipt.data.mrsupplier" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>                              

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Received</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="mritemreceivedqty" id="mritemreceivedqty" ng-model="mrpreceipt.data.mritemreceivedqty" ng-change="caltoweightreceipt()" class="ism-dialog-rows-input-controller" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Received Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input name="totalweight" id="totalweight" ng-model="mrpreceipt.data.totalweight" class="ism-dialog-rows-input-controller" readonly />
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-body-rows" style="width: 500px;" ng-show="!mrpreceipt.isloading">
                <table class="old_table">
                    <thead>
                        <tr>
                            <th>#SNO</th>
                            <th>Receipt#</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Received Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in mr_receipts">
                            <td>{{$index+1}}</td>
                            <td>{{x.mrreceiptid}}</td>
                            <td>{{x.mrreciptdate_d.display}}</td>
                            <td>{{x.mrsupplier}}</td>
                            <td>{{x.mritemreceivedqty}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ism-pms-dialog-footer" ng-show="!mrpreceipt.isloading">
            <button ng-hide="(+selected_mr.balqty) === 0" ng-click="savemprreceipt()" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="mrpreceipt.isloading">
                Save
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="mrpreceipt.isshow = false">
                Close
            </button>
        </div>
    </div>
</div>