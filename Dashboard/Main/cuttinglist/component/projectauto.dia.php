<div class="autocompleate-dia">
    <div class="autocompleate-container">
        <input type="text" ng-model="projectfilter" id="projectfilter" class="ism-dialog-rows-input-controller" placeholder="search" />
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table" >
            <thead>
                <tr>

                    <th>S.NO</th>
                    <th>Contract No.</th>
                    <th>Project Name</th>
                    <th>Project Contractor</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="x in projectslist | filter:projectfilter">
                    <td>{{$index+1}}</td>
                    <td>{{x.project_no}}</td>
                    <td>{{x.project_name}}</td>
                    <td>{{x.project_cname}}</td>
                    <td>
                        <button type="button" ng-click="selectcurrent(x)">Select</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>