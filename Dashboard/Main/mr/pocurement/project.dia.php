<div class="autocompleate-dia">
    <div class="autocompleate-container">
        <input type="text" ng-model="projectfilter" id="projectfilter" class="forminput-input" placeholder="search" />
    </div>
    <div class="autocompleate-loads">
        <table class="autocompleate-table" >
            <thead>
                <tr>
                    <th></th>
                    <th>S.NO</th>
                    <th>Contract No.</th>
                    <th>Project Name</th>
                    <th>Project Contractor</th>                    
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="x in srcprojectlist | filter:projectfilter">
                    <td>
                        <button type="button" class="btn-bttom btn-bttom-ok" style="padding:2px" ng-click="selectcurrent(x)">Select</button>
                    </td>
                    <td>{{$index+1}}</td>
                    <td>{{x.project_no}}</td>
                    <td>{{x.project_name}}</td>
                    <td>{{x.project_cname}}</td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</div>