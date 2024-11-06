<div class="ism-pms-dialog" id="dia_glasstype">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Glass Type
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('dia_glasstype').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="gtype.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-submit="save_glasstype_submit()" name="glasstype_save" id="save_glasstype" ng-show="!gtype.isloading">
            <div class="ism-pms-dialog-body">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{gtype.title}} </span>
                </div>
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container" style="width:300px">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="glasstype_name" id="glasstype_name" ng-model="gtype.data.glasstype_name" class="ism-dialog-rows-input-controller" required ng-keyup="save_glasstype_keyup($event)"/>
                        </div>
                        
                        <div class="ism-dialog-input-error" ng-show="glasstype_save.glasstype_name.$invalid && glasstype_save.glasstype_name.$touched">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Enter Type </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="gtype.isloading || glasstype_save.$invalid">
                    {{gtype.btn}}
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_glasstype').style.display='none'">
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