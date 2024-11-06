<div class="ism-pms-dialog" id="delivery_update_diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Production Deliver Edit
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-click="delivery_update_hide()">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="isrptloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="ism-pms-dialog-body" style="max-height: 80vh;" ng-hide="isrptloading">
            <div class="ism-pms-dialog-body-sub">
                <div class="ac-new-row">
                    <div class="ac-new-cols tbl">
                        <div style="width: 400px;">
                            <div class="ac-new-frm-row">
                                <div class="ac-new-frm-cols">
                                    <div class="ac-new-frm-lable">Delivery Ref#</div>
                                    <div class="ac-new-frm-inputs">
                                        <input type="text" class="ac-new-frm-inputctrl" name="outno" id="outno" ng-model="update_deliver.outno" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ac-new-frm-row">
                                <div class="ac-new-frm-cols">
                                    <div class="ac-new-frm-lable">Delivery Date</div>
                                    <div class="ac-new-frm-inputs">
                                        <input type="text" class="ac-new-frm-inputctrl" name="outdate" id="outdate" ng-model="update_deliver.outdate" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ac-new-frm-row">
                                <div class="ac-new-frm-cols">
                                    <div class="ac-new-frm-lable">Qty</div>
                                    <div class="ac-new-frm-inputs">
                                        <input type="text" class="ac-new-frm-inputctrl" name="outqty" id="outqty" ng-model="update_deliver.outqty" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ac-new-frm-row">
                                <div class="ac-new-frm-cols">
                                    <div class="ac-new-frm-lable">Area</div>
                                    <div class="ac-new-frm-inputs">
                                        <input type="text" class="ac-new-frm-inputctrl" name="outarea" id="outarea" ng-model="update_deliver.outarea" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button type="button" class="ism-pms-dialog-btn ism-btn-dialog-save " ng-click="update_delivery_handler()" ng-disabled="isrptloading">
                <i class="fa fa-edit"></i>
                Update
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="remove_delivery(update_deliver.outid)"  ng-disabled="isrptloading">
                <i class="fa fa-trash"></i>
                Remove
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="delivery_update_hide()"  ng-disabled="isrptloading">
                Close
            </button>
        </div>
    </div>
</div>