<div class="sub-body-container-title ntit">
            <div class="sub-container-left">

                TECHNICAL SUBMITTAL
            </div>

            <div class="sub-container-right">
                <button ng-click="show_technicalsubmittal_click(true)" class="ism-btns btn-normal" ng-if="caniaccessbtns">
                    <i class="fa fa-plus"></i>
                    New Hardware Approvals
                </button>
            </div>
        </div>
        <div class="sub-body-container-contents">
            <div class="projectinfos-infos">
                <table class="naf-tables">
                    <thead>
                        <tr>
                            <td class="table-header" ng-if="caniaccessbtns"></td>
                            <td class="table-header">#S.NO</td>
                            <td class="table-header">Submittal For</td>
                            <td class="table-header">Description</td>
                            <td class="table-header">Notes</td>
                            <td class="table-header">Submitted by</td>
                            <td class="table-header">Submitted Date</td>
                            <td class="table-header">Status</td>
                            <td class="table-header">Approved Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in technicalapproval_datas">
                            <td ng-if="caniaccessbtns">
                                <button class="ism-btns btn-normal tbl-btn" type="button" ng-click="edit_technicalSubmital(true,x)">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{$index+1}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.taapproval}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.tadescription}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.taremarks}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.tasubmittedby}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.tasubmitteddate_d}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.tastatus | StatusFilter}}                                
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.tastatus === 'A' , 
                                    'code_B' : x.tastatus === 'B' , 
                                    'code_BC' : x.tastatus === 'BC' , 
                                    'code_C' : x.tastatus === 'C' , 
                                    'code_D' : x.tastatus === 'D' , 
                                    'code_U' : x.tastatus === 'U' , 
                                    'code_E' : x.tastatus === 'E' , 
                                    'code_F' : x.tastatus === 'F' , 
                                }">
                                {{x.tastatus === 'U' ? '-' : x.taapproveddate_d}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>