<style>
    .autocompleate-table th {
        font-size: 0.95rem;
        padding: 2px;
        font-weight: bold;
    }

    .autocompleate-table th {
        font-size: 0.90rem;
        padding: 2px;
    }
</style>
<div class="autocompleate-dia" style="width: 990px;">
    <div class="autocompleate-container">
        <input type="text" ng-model="mritemfilters" id="mritemfilters" class="forminput-input" placeholder="search" />
    </div>
    <div class="autocompleate-loads">
        <table class="ism-pms-dialog-table">
            <thead>
                <tr>
                    <th class="ism-pms-dialog-tbale-header-cell"></th>
                    <th class="ism-pms-dialog-tbale-header-cell">S.NO</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Part#</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Description</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Die weight</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Lenght</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Qty Required</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Weight Required</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Qty Done</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Weight Done</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Finish</th>
                    <th class="ism-pms-dialog-tbale-header-cell">Remarks</th>

                </tr>
            </thead>
            <tbody class="ism-pms-dialog-table-body">
                <tr ng-repeat="x in mritems | filter :mritemfilters">
                    <td class="ism-table-dialog-table-body-cells">
                        <button type="button" class="btn-bttom btn-bttom-ok" ng-click="selectmritem(x)" style="padding:2px">
                            <i class="fa fa-check"></i>
                        </button>
                    </td>
                    <td class="ism-table-dialog-table-body-cells">{{$index+1}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrpartno}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mritem}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrdieweight}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrreqlength}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrorderedqty}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrorderedweight}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrreceiptqty}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrreceiptweght}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrfinish}}</td>
                    <td class="ism-table-dialog-table-body-cells">{{x.mrremarks}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>