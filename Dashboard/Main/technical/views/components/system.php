
<div class="projectinfos-infos">
                <div ng-if="isloading_system">
                    <i class="fa fa-cog fa-spin"></i>
                </div>
                <table class="naf-tables" ng-if="!isloading_system">
                    <thead>
                        <tr>
                            <td class="table-header" ng-if="caniaccessbtns"></td>
                            <td class="table-header">S.No</td>
                            <td class="table-header" style="width:450px">System</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in approvedsystems">
                            <td ng-if="caniaccessbtns">
                                <button class="ism-btns btn-normal tbl-btn" type="button" ng-click="edit_systems(true,x)">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                            </td>
                            <td>{{$index+1}}</td>
                            <td>{{x.techsyssystem}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>