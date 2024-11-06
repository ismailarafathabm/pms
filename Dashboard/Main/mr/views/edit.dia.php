
<div class="ism-pms-dialog" ng-if="upatemr.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Edit
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!upatemr.isloading" ng-click="upatemr.diashow =false">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-body">
            <div class="ism-pms-dialog-body-rows" style="width: 435px;">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 400px">
                    <div class="ism-dialog-body-rows-input-container-lable">Item Description</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mritem" />
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Part#</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrpartno"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Part#. Taiseer</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrpartnotai"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Die Wight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrdieweight" ng-keyup="calNewAreas($event)"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Length</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrreqlength" ng-keyup="calNewAreas($event)"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 120px">
                    <div class="ism-dialog-body-rows-input-container-lable">Qty</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrreqqty" ng-keyup="calNewAreas($event)"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 120px">
                    <div class="ism-dialog-body-rows-input-container-lable">Unit</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrunit"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 120px">
                    <div class="ism-dialog-body-rows-input-container-lable">Total Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrreqtotweight">
                    </div>
                </div>

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Avai Qty</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mravaiqty" ng-keyup="calNewAreas($event)"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Avai Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mraviweight"/>
                    </div>
                </div>

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Require Qty</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrorderedqty" ng-keyup="calNewAreas($event)"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Require Weight</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrorderedweight"/>
                    </div>
                </div>

                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Finish</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrfinish"/>
                    </div>
                </div>
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                    <div class="ism-dialog-body-rows-input-container-lable">Remarks.</div>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input placeholder="DD-MM-YYYY" class="ism-dialog-rows-input-controller" ng-model="upatemr.data.mrremarks"/>
                    </div>
                </div>

            </div>
        </div>
        <div class="ism-pms-dialog-footer">
            <button type="button" ng-click="UpdateMr()" class="ism-pms-dialog-btn ism-btn-dialog-save">
                Update
            </button>
        </div>
    </div>
</div>