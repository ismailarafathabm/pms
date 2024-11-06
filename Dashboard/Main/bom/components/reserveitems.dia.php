<style>
    .hed {
        background: #dbdbdb;
        font-weight: 600;
    }
</style>
<div class="ism-pms-dialog" ng-if="show_items_for_selected_project">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Item Reserved
            </div>
            <div ng-show="!boqinfo_dia.isloading" class="ism-pms-idalog-header-closebtn" ng-click="setreseveditemsforproject(false)">
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
                    <div class="old_pgm" style="width: 1200px;">
                        <div ng-show="is_loading_data">Loading</div>
                        <div ng-show="!is_loading_data" class="old_pgm_row" style="flex-direction:column;gap:20px">
                            <div>
                                Search :
                                <input type="text" ng-model="srcp.partno" placeholder="search by Part no"/>
                                <input type="text" ng-model="srcp.description" placeholder="search by Description"/>
                                <input type="text" ng-model="srcp.partalloy" placeholder="search by Alloy"/>
                                <input type="text" ng-model="srcp.partlength" placeholder="search by Length"/>
                                <input type="text" ng-model="srcp.partcolor" placeholder="search by Color"/>
                                <input type="text" ng-model="srcp.dieweight" placeholder="search by Die Wight"/>
                            </div>
                            <div class="old_pgm_fitbox" style="height:550px">
                                <table class="old_table itemlist">
                                    <tr>
                                        <td>Projct Names</td>
                                        <td>{{selectedprojectedlist}}</td>
                                    </tr>
                                </table>
                                <table class="old_table itemlist" style="width: 1100px;">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Part NO</th>
                                            <th>Description</th>
                                            <th>Alloy</th>
                                            <th>Length</th>
                                            <th>Color</th>
                                            <th>Die Weight</th>                                            
                                            <th>Units</th>
                                            <th>M.Category</th>
                                            <th>S.Category</th>
                                            <th>Reserved Qty</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="x in reservedmateriallist | filter:srcp">
                                            <td>{{$index+1}}</td>
                                            <td>{{x.partno}}</td>
                                            <td style="text-align:center;font-style:italic">{{x.description}}</td>
                                            <td>{{x.partalloy}}</td>
                                            <td>{{x.partlength}}</td>
                                            <td>{{x.partcolor}}</td>
                                            <td>{{x.dieweight}}</td>                                            
                                            <td>{{x.partuom}}</td>
                                            <td>{{x.materialcatagory}}</td>
                                            <td>{{x.systemcatagory}}</td>
                                            <td style="background:#fbffdf;font-size: 14px;font-weight: bold;text-align:center;font-weight:bold">{{
                                                (+x.reservedqty).toLocaleString(undefined,{maximumFractionDigits: 2})
                                            }}</td>
                                            <td>{{x.location}}</td>
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
            <button ng-show="!boqinfo_dia.isloading" type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setreseveditemsforproject(false)">
                <i class="fa fa-times"></i>
                Close
            </button>
            <button type="button" ng-click="getitemreservationbyproject()" class="ism-pms-dialog-btn  ism-btn-dialog-dagner">
                <i class="fa fa-print"></i>
                Print
            </button>
            <div class="{{res.theme}}" ng-show="res.display">
                <i class="{{res.icon}}"></i>
                <span>{{res.msg}}</span>
            </div>
        </div>

    </div>
</div>