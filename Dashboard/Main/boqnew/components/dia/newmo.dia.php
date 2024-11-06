<div class="ism-pms-dialog" id="moreleasedia">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Mo Release
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('moreleasedia').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" style="width: 400px;" ng-show="unitview.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <div class="ism-pms-dialog-body" style="width: 400px;" ng-show="!unitview.isloading">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>{{unitview.subtitle}}</span>
            </div>

            <div class="ism-pms-dialog-body-rows">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="width: 380px;">
                    <label class="ism-dialog-body-rows-input-container-lable">Select BOQ</label>
                </div>
                <div class="ism-dialog-body-rows-input-container-input ">
                    <input ng-keydown="showBoqList($event)" id="boqsrc" name="boqsrc" ng-model="boqsrc" class="ism-dialog-rows-input-controller" required />
                    <div id="boq_selectauto" class="gen_autocompleate" style="margin-top:-45px;margin-left:-12px">
                    <?php
                    include_once 'boqlist.dia.php';
                    ?>
                </div>
                </div>
                
            </div>

        </div>

    </div>

</div>