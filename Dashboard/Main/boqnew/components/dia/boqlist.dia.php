<div class="autocompleate-dia">
    <div class="autocompleate-container">
        <input type="text" ng-model="boqfilter" id="boqfilter" class="ism-dialog-rows-input-controller" placeholder="search" />
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Description</th>                    
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in boqlist | filter:boqfilter">
                    <td>{{$index+1}}</td>
                    <td>{{x.poq_item_no}} - {{x.ptype_name}}</td>                    
                    <td>
                        <button type="button" ng-click="selectcurrentboqitem(x)">Select</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>