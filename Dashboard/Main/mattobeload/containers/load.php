<div class="ism-pms-dialog" id="dia_load_rpt">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Load Report
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!mtblrpt.isloading" onclick="document.getElementById('dia_load_rpt').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="mtblrpt.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="load_rpt_submit()" name="rptload" id="load_rpt" ng-show="!mtblrpt.isloading">
            <div class="ism-pms-dialog-body" style="max-width: 300px;">
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 85px">
                        <div class="ism-dialog-body-rows-input-container-lable">Form Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="stdate" id="stdate" ng-model="mtblrpt.data.stdate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 85px">
                        <div class="ism-dialog-body-rows-input-container-lable">To Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input placeholder="dd-mm-YYYY" name="endate" id="endate" ng-model="mtblrpt.data.endate" class="ism-dialog-rows-input-controller" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_contractsign" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="mtblrpt.isloading || rptload.$invalid">
                    Load
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_load_rpt').style.display='none'">
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