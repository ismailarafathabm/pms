<div class="autocompleate-dia">
    <div class="autocompleate-container"  style="display: flex;gap: 10px;">
        <input type="text" ng-model="mofilter" id="mofilter" class="ism-dialog-rows-input-controller" placeholder="search" />
        <button type="button" ng-click="shownewmo()">Add</button>
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table" >
            <thead>
                <tr>

                    <th>S.NO</th>
                    <th>M.O</th>
                    <th>Status</th>
                    <th>Forwared To Account</th>
                    <th>Received From Account</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="x in project_mos | filter:mofilter">
                    <td>{{$index+1}}</td>
                    <td>{{x.c_mono}}</td>
                    <td>{{x.c_mo_accountfalg_txt}}</td>
                    <td>{{(+x.c_mo_accountfalg) > 1 ? x.c_mo_account_issue_d.display : ''}}</td>
                    <td>{{(+x.c_mo_accountfalg) > 2 ? x.c_mo_account_release_d.display : ''}}</td>
                    <td>
                        <button type="button" ng-click="selectmocurrent(x)">Select</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>