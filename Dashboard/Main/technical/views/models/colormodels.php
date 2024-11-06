<div class="ism-pms-dialog" ng-if="show_tech_color_model">
    <div class="ism-pms-dialog-container">

        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Material / Glass Color Approvals
            </div>
            <div ng-show="!technical_colors_model.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setColorshowStatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="technical_colors_model.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>

        <form autocomplete="off" ng-submit="colorsave_submit()" id="colorsave" name="savecolor" ng-show="!technical_colors_model.isloading">
            <div class="ism-pms-dialog-body" style="min-width: 200px;max-width: 450px;">
                <div class="ism-pms-dialog-body-group-title">
                    <i class="fa fa-info-circle active"></i> <span>{{technical_colors_model.title}} </span>
                </div>

                <div class="ism-pms-dialog-body-rows">
                    <div class="ism-pms-dialog-body-row-input-container"  style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Type</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcmaterial" id="tcmaterial" ng-model="technical_colors_model.data.tcmaterial" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 370px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Description</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tecdescription" id="tecdescription" ng-model="technical_colors_model.data.tecdescription" class="ism-dialog-rows-input-controller" required />
                        </div>                     
                    </div>


                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmittedby" id="tcsubmittedby" ng-model="technical_colors_model.data.tcsubmittedby" class="ism-dialog-rows-input-controller" required />
                        </div>                       
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted Date</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcsubmitteddate" id="tcsubmitteddate" ng-model="technical_colors_model.data.tcsubmitteddate" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>

                    <div class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;" >
                        <div class="ism-dialog-body-rows-input-container-lable">Submitted By</div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <select name="tcapprovedstatus" id="tcapprovedstatus" ng-change = "smaple()" ng-model="technical_colors_model.data.tcapprovedstatus" class="ism-dialog-rows-input-controller" required>
                                <option value="">-Select</option>                                
                                <option ng-repeat="x in status_list" value="{{x.code}}">{{x.code_description}}</option>  
                            </select>
                        </div>                       
                    </div>
                   
                    <div ng-if="technical_colors_model.data.tcapprovedstatus !== 'U' " class="ism-pms-dialog-body-row-input-container" style="flex: 1 1 170px;">
                        <div class="ism-dialog-body-rows-input-container-lable">
                           Date
                        </div>
                        <div class="ism-dialog-body-rows-input-container-input ">
                            <input name="tcapproveddate" id="tcapproveddate" ng-model="technical_colors_model.data.tcapproveddate" class="ism-dialog-rows-input-controller" required />
                        </div>                        
                    </div>
                </div>
            </div>    
            
            
            <div class="ism-pms-dialog-footer">
                <button type="submit" class="ism-pms-dialog-btn ism-btn-dialog-save" ng-disabled="technical_colors_model.isloading || savecolor.$invalid">
                    {{technical_colors_model.btn}}
                </button>
                <button ng-show="!technical_colors_model.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setColorshowStatus(false)">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button ng-show="technical_colors_model.mode === 2" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="removecolor(
                    technical_colors_model.data.tcid,
                    technical_colors_model.data.tcprojectid                    
                )" style="margin-right:125px;">
                    <i class="fa fa-trash"></i>
                    Remove
                </button>
                <div class="{{res.theme}}" ng-show="res.display">
                    <i class="{{res.icon}}"></i>
                    <span>{{res.msg}}</span>
                </div>
            </div>
        </form>

    </div>
</div>