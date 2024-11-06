<div class="ism-pms-dialog" ng-if="datefilter.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Filter
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!datefilter.isloading" ng-click="datefilter.diashow = false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">From Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="datefilter.data.fromdate" id="fromdate" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsignx" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">To Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="datefilter.data.todate" id="todate" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                    </div>
                </div>
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button type="button" ng-click="filterbydate()" class="ism-pms-dialog-btn ism-btn-dialog-save">
                Filter
            </button>
        </div>
    </div>
</div>


