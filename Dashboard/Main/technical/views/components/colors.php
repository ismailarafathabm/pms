<div class="sub-body-container-title ntit">
    <div class="sub-container-left">
        PROJECT APPROVALS
    </div>
    <div class="sub-container-right">
        <button ng-if="caniaccessbtns" ng-click="setColorshowStatus(true)" class="ism-btns btn-normal">
            <i class="fa fa-plus"></i>
            New Color Approvals
        </button>
    </div>
</div>
<div class="sub-body-container-contents">

    <div class="projectinfos-infos">
        <div ng-if="isloading_tech_colors_data">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <table class="naf-tables" ng-if="!isloading_tech_colors_data">
            <thead>
                <tr>
                    <td class="table-header" ng-if="caniaccessbtns"></td>
                    <td class="table-header">S.No</td>
                    <td class="table-header">Type</td>
                    <td class="table-header" style="width: 320px;">Description</td>
                    <td class="table-header">Submit By</td>
                    <td class="table-header" style="width: 120px;">Submit Date</td>
                    <td class="table-header">Status</td>
                    <td class="table-header" style="width: 120px;">Approved Date</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in tech_colorslist">
                    <td ng-if="caniaccessbtns" ng-class="{'approved_color' : (+x.tcapprovedstatus) === 2 , 'submitted_color' : (+x.tcapprovedstatus) === 1 , 'cancelled_color' : (+x.tcapprovedstatus) === 3 }">
                        <button class="ism-btns btn-normal tbl-btn" type="button" ng-click="edit_colorSubmital(true,x)">
                            <i class="fa fa-edit"></i>
                            Edit
                        </button>
                    </td>
                    <td ng-class="
                                {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">{{$index+1}}</td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">{{x.tcmaterial}}</td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">{{x.tecdescription}}</td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">{{x.tcsubmittedby}}</td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">{{x.tcsubmitteddate_d}}</td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">

                        {{x.tcapprovedstatus | StatusFilter}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcapprovedstatus === 'A' , 
                                    'code_B' : x.tcapprovedstatus === 'B' , 
                                    'code_BC' : x.tcapprovedstatus === 'BC' , 
                                    'code_C' : x.tcapprovedstatus === 'C' , 
                                    'code_D' : x.tcapprovedstatus === 'D' , 
                                    'code_U' : x.tcapprovedstatus === 'U' , 
                                    'code_E' : x.tcapprovedstatus === 'E' , 
                                    'code_F' : x.tcapprovedstatus === 'F' , 
                                }
                                ">
                        {{x.tcapprovedstatus !== 'U' ? x.tcapproveddate_d : "-" }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>