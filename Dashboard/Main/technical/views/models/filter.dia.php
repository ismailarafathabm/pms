<div class="ism-pms-dialog" ng-if="show_status_filter">
    <div class="ism-pms-dialog-container">
        <div class="ism-pms-dialog-headers">
            <div class="ism-pms-dialog-header-title">
               Filter
            </div>
            <div class="ism-pms-idalog-header-closebtn" ng-click="setStatusFilter(false)">
                <i class="fa fa-times closebtn"></i>
            </div>
        </div>


        <div class="ism-pms-dialog-body" style="width: autopx;">
            <div class="ism-pms-dialog-body-group-title">
                <i class="fa fa-info-circle active"></i> <span>Filter By Status </span>
            </div>
            <div class="ism-pms-dialog-body-rows">
                <table class="naf-tables">
                    <tr>
                        <td>
                            <input type="checkbox" id="uncheckun" ng-model="uncheck.un" ng-change="uncheckall()"/>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_A" ng-model="filters.status_filter_A"/>
                        </td>
                        <td>A - Approved as Submitted</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_B" ng-model="filters.status_filter_B" />
                        </td>
                        <td>B - Approved as Noted</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_BC" ng-model="filters.status_filter_BC" />
                        </td>
                        <td>BC - Approved with Conditions</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_C" ng-model="filters.status_filter_C" />
                        </td>
                        <td>C - Revise and resubmit</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_D" ng-model="filters.status_filter_D" />
                        </td>
                        <td>D - Rejected</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_U" ng-model="filters.status_filter_U" />
                        </td>
                        <td>U - Under review</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_E" ng-model="filters.status_filter_E" />
                        </td>
                        <td>E - For Information</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="status_filter_F" ng-model="filters.status_filter_F" />
                        </td>
                        <td>F - Cancelled</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="ism-pms-dialog-footer">
            <button type="button" ng-click="startfilter()" class="ism-pms-dialog-btn ism-btn-dialog-save">
                Fitler
            </button>
            <button type="button" class="ism-pms-dialog-btn  ism-btn-dialog-dagner" ng-click="setStatusFilter(false)">
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