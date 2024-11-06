<div class="ism-pms-dialog" ng-if="mrpreceipt.isshow">
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
            <button ng-click="savemprreceipt()" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="mrpreceipt.isloading">
                Save
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="mrpreceipt.isshow = false">
                Close
            </button>
        </div>
    </div>
</div>