<style>
    .hed {
        background: #dbdbdb;
        font-weight: 600;
    }
</style>
<div class="ism-pms-dialog" ng-if="sho_which_project_has_reservations">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Item Reserved
            </div>
            <div ng-show="!boqinfo_dia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setProjectReserveStatus(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>

        <div class="ism-pms-dialog-loader" ng-show="boqinfo_dia.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>



        <div class="ism-pms-dialog-body" style="width: auto;">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>Projects has Reservations</span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <div class="naf-tables">
                    <div class="old_pgm" style="width: 600px;">
                        <div ng-show="is_loading_data">Loading</div>
                        <div ng-show="!is_loading_data" class="old_pgm_row" style="flex-direction:column;gap:20px">
                            <div>
                                <input type="text" ng-model="srcp"/>
                            </div>
                            <div class="old_pgm_fitbox" style="height:550px">
                                <table class="old_table itemlist" style="width: 500px; ">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Project Name</th>
                                            <th>Action</th>
                                        </tr>                                        
                                    </thead>
                                    <tbody>                                        
                                        <tr ng-repeat="x in projectlist | filter:srcp">
                                            <td>{{$index+1}}</td>
                                            <td>{{x.costcenter}}</td>
                                            <td>
                                                <button 
                                                ng-click="get_reserve_project(x.costcenter)"
                                                type="button"
                                                ng-click="getreservveinfo(x)"
                                                class="ism-btns btn-save"
                                                style="padding:3px;cursor: pointer;">
                                                    view
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ism-pms-dialog-footer">
            <button ng-show="!boqinfo_dia.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setProjectReserveStatus(false)">
                <i class="fa fa-times"></i>
                Close
            </button>
            <div class="{{res.theme}}" ng-show="res.display">
                <i class="{{res.icon}}"></i>
                <span>{{res.msg}}</span>
            </div>
        </div>


    </div>
</div>