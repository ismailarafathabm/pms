<div class="ism-pms-dialog" ng-if="prnewreceipt.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                New Receipt
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!prnewreceipt.isloading" ng-click="prnewreceipt.diashow = false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="prupdate.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="prnewreceipt_submit()" name="prnewreceiptx" id="newreceipt" ng-show="!prupdate.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-rows" style="width: 435px; align-items: center;">                    
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Receipt No </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceiptinvoiceno" id="goreceiptinvoiceno" ng-model="prnewreceipt.data.goreceiptinvoiceno" class="ism-dialog-rows-input-controller" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="goreceiptdate" id="goreceiptdate" ng-model="prnewreceipt.data.goreceiptdate" class="ism-dialog-rows-input-controller" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="procurement_orderdate" required />
                        </div>
                    </div>
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Qty </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceiptqty" id="goreceiptqty" ng-model="prnewreceipt.data.goreceiptqty" class="ism-dialog-rows-input-controller" required ng-change="calcpricesx()" />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Area</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceiptarea" id="goreceiptarea" ng-model="prnewreceipt.data.goreceiptarea" class="ism-dialog-rows-input-controller" required ng-change="calcpricesx()" />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 120px;display:none">
                        <div class="ism-dialog-body-rows-input-container-lable">Unit Price</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceiptunitprice" id="goreceiptunitprice" ng-model="prnewreceipt.data.goreceiptunitprice" class="ism-dialog-rows-input-controller" ng-change="calcpricesx()" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px;display:none">
                        <div class="ism-dialog-body-rows-input-container-lable">Other</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceiptotherprice" id="goreceiptotherprice" ng-model="prnewreceipt.data.goreceiptotherprice" class="ism-dialog-rows-input-controller" ng-change="calcpricesx()" required />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px;display:none">
                        <div class="ism-dialog-body-rows-input-container-lable">Total Price</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="goreceipttotalprice" id="goreceipttotalprice" ng-model="prnewreceipt.data.goreceipttotalprice" class="ism-dialog-rows-input-controller" readonly required />
                        </div>
                    </div>                  

                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="prnewreceipt.isloading || prnewreceiptx.$invalid">
                    Save
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="prnewreceipt.diashow = false">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>