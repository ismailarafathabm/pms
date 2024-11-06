<div class="autocompleate-dia">
    <div class="autocompleate-container">
        <input type="text" ng-model="usersfilter" id="usersfilter" class="ism-dialog-rows-input-controller" placeholder="search"/>
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>User Name</th>                    
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in userslist | filter:usersfilter">
                    <td>{{$index+1}}</td>
                    <td>{{x.user_id}}</td>                    
                    <td>
                        <button type="button" ng-click="selectcurrentusers(x)">Select</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>