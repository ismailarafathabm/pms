<div class="ism-pms-dialog" id="dia_goprc_new">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Receive Glass Order
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_goprc_new').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="goprc.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="save_new_goprc_submit()" name="save_goprc_new" id="save_new_goprc" ng-show="!goprc.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{goprc.title}} </span>
                </div>

                <div class="ism-pms-dialog-body-rows" style="width: 500px">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Invoice No </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_invoice" id="gonrc_invoice" ng-model="goprc.data.gonrc_invoice" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 200px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Invoice Date </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_date" id="gonrc_date" ng-model="goprc.data.gonrc_date" class="ism-dialog-rows-input-controller calendar" required ng-hijri-gregorian-datepicker="" datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_releasedtopurchase"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_qty" id="gonrc_qty" ng-model="goprc.data.gonrc_qty" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_sqm" id="gonrc_sqm" ng-model="goprc.data.gonrc_sqm" class="ism-dialog-rows-input-controller" required ng-change="calcactions()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Pirce / sqm</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_ppsqm" id="gonrc_ppsqm" ng-model="goprc.data.gonrc_ppsqm" class="ism-dialog-rows-input-controller" required ng-change="calcactions()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Total</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_totalprice" id="gonrc_totalprice" ng-model="goprc.data.gonrc_totalprice" class="ism-dialog-rows-input-controller" required readonly/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Extra</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_extra" id="gonrc_extra" ng-model="goprc.data.gonrc_extra" class="ism-dialog-rows-input-controller" required ng-change="calcactions()"/>
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 150px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Final Amount</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_finalprice" id="gonrc_finalprice" ng-model="goprc.data.gonrc_finalprice" class="ism-dialog-rows-input-controller" required readonly />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex: 1 1 400px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Remark </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="gonrc_remark" id="gonrc_remark" ng-model="goprc.data.gonrc_remark" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>

                </div>

            </div>

            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="goprc.isloading || save_goprc_new.$invalid">
                    {{goprc.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_goprc_new').style.display='none'">
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