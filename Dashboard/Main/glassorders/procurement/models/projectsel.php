<div class="ism-pms-dialog" id="dia_projectselector">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project List
            </div>            
        </div>        
        <form autocomplete="off" ng-submit="select_project_submit()" name="project_select" id="select_project">
            <div class="ism-pms-dialog-body">                
                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container" style="width:300px">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input ng-keydown="show_project_select()" name="current_select_project" id="current_select_project" ng-model="current_select_project_mo" class="ism-dialog-rows-input-controller" required />
                            <project-listnew class="ism-new-pms-auto-dia" id="select_auto_projects" style="width: 400px;left: -6px;top: -2px;position:fixed">                                
                            </project-listnew>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="gtype.isloading || project_select.$invalid">
                    Search
                </button>
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_projectselector').style.display='none'">
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