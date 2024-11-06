<div class="ism-pms-dialog" id="rpt_src_dialog">
    <div class="ism-pms-dialog-container" style="width:340px">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Filter
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!datefilter.isloading" onclick="document.getElementById('rpt_src_dialog').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 225px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Date</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="payroll.startdate" name="startdate"  ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfig" selected-date="val_contractsignx" />
                    </div>
                </div>                
            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button  ng-click="filterdata_submit()" type="button" class="ism-pms-dialog-btn ism-btn-dialog-save">
                Get
            </button>
        </div>
    </div>
</div>


