<div class="ism-pms-dialog" id="dia_load_rptproject_logs">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
                Project Material to Be Load 
            </div>            
            <div class="ism-pms-idalog-header-closebtn" ng-show="!logs.isloading" onclick="document.getElementById('dia_load_rptproject_logs').style.display='none'">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>
        <div class="ism-pms-dialog-loader" ng-show="logs.isloading">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <form autocomplete="off" ng-show="!logs.isloading">
            <div class="ism-pms-dialog-body" style="width: auto;max-width:1260px">
                <table class="ism-pms-dialog-table">
                    <thead class="ism-pms-dialog-table-headers">
                        <tr>
                            <th class="ism-pms-dialog-tbale-header-cell">S.No</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Project</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Location</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Description</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Area/Qty</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Unit</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Loading Date</th>
                            <th class="ism-pms-dialog-tbale-header-cell">At Site</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Driver</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Status</th>
                            <th class="ism-pms-dialog-tbale-header-cell">Note</th>
                            
                        </tr>                        
                    </thead>
                    <tbody class="ism-pms-dialog-table-body" >
                        <tr ng-repeat="x in logs.data">
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{$index+1}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.loadproject}} [{{x.pjcno}}]</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.location}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}" style="color: #0082df;font-weight: 700;"> {{x.description}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}" style="text-align:right"> <strong>{{x.qty}}</strong></td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.unit}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.loadingdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.ascurrentdate_d}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.driver}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}">{{x.status}}</td>
                            <td class="ism-table-dialog-table-body-cells" ng-class="{successtheme:x.iscurrent==='1'}"> {{x.remark}}</td>                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ism-pms-dialog-footer">
                <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" onclick="document.getElementById('dia_load_rptproject_logs').style.display='none'">
                    Close
                </button>
            </div>
        </form>
    </div>
</div>