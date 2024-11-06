<div class="ism-pms-dialog" id="assainproject">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Assign Autorization
            </div>
            <div class="ism-pms-idalog-header-closebtn" onclick="document.getElementById('assainproject').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" style="width: 600px;" ng-show="unitview.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <div class="ism-pms-dialog-body" style="width: 600px;" ng-show="!unitview.isloading">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>{{unitview.subtitle}}</span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="width: 550px;">
                    <label class="ism-dialog-body-rows-input-container-lable">Project</label>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input ng-keydown="showDiaproject($event)" id="projectSrc" name="projectSrc" ng-model="projectSrc" class="ism-dialog-rows-input-controller" required />
                    </div>
                    <div id="project_autocompleate" class="gen_autocompleate">
                        <?php
                        include_once 'projectauto.dia.php'
                        ?>
                    </div>
                </div>

            </div>

            <div class="ism-pms-dialog-body-rows">
                <div class="ism-pms-dialog-body-row-input-container half-widht" style="width: 550px;">
                    <label class="ism-dialog-body-rows-input-container-lable">User Name</label>
                    <div class="ism-dialog-body-rows-input-container-input ">
                        <input ng-keydown="showDiaUsers($event)" id="userSrc" name="userSrc" ng-model="userSrc" class="ism-dialog-rows-input-controller" required />
                    </div>
                    <div id="users_autocompleate" class="gen_autocompleate">
                        <?php
                        include_once 'usersauto.dia.php'
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" ng-click="authactionbtn()" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="updatebusy">
                Save
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('assainproject').style.display='none'">
                Close
            </button>
        </div>

    </div>
</div>