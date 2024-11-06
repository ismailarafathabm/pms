<div class="ism-pms-dialog" ng-if="ctuploads.diashow">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               Cutting List
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-show="!ctuploads.isloading" ng-click="ctuploadsx(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="ctuploads.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="uploadctpdfsubmit()" name="uploadctpdf" id="uploadctpdf" ng-show="!ctuploads.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-rows" style="width: 435px;">                    
                    <div class="ism-pms-dialog-body-row-input-container half-widht" style="flex:1 0 200px">
                        <div class="ism-dialog-body-rows-input-container-lable">Cuttinglist FILE</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input type="file" name="ctpdf" id="ctpdf" required style="color: #e70000;font-weight: 800;text-decoration: underline;"/>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="ctuploads.isloading">
                   Upload
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="ctuploadsx(false)">
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