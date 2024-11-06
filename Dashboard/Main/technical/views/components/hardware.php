<div class="sub-body-container-title ntit">
            <div class="sub-container-left">
                HARDWARE SUBMITTAL
            </div>

            <div class="sub-container-right">
                <button ng-if="caniaccessbtns" ng-click="shownewhardwareapprovals_click(true)" class="ism-btns btn-normal">
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
                            <td class="table-header">S.No</td>
                            <td class="table-header">System</td>
                            <td class="table-header" style="width: 350px;">Submitted Accessories</td>
                            <td class="table-header" style="width: 230px;">Remarks</td>
                            <td class="table-header">Submitted By</td>
                            <td class="table-header">Submitted Date</td>
                            <td class="table-header">Status</td>
                            <td class="table-header">Approved Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in hardwareapprovals">
                            <td  ng-if="caniaccessbtns">
                                <button class="ism-btns btn-normal tbl-btn" type="button" ng-click="edit_hardwareSubmital(true,x)">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </button>
                            </td>
                            <td ng-class="{
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{$index+1}}
                            </td>
                            <td ng-class="{
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thsystem}}
                            </td>
                            <td ng-class="{
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thdescriptions}}
                            </td>

                            <td ng-class="{
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thnotes}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thsubmittedby}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thsubmitteddate_d}}
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{x.thstatus | StatusFilter}}                                
                            </td>
                            <td ng-class="
                            {
                                    'code_A' : x.thstatus === 'A' , 
                                    'code_B' : x.thstatus === 'B' , 
                                    'code_BC' : x.thstatus === 'BC' , 
                                    'code_C' : x.thstatus === 'C' , 
                                    'code_D' : x.thstatus === 'D' , 
                                    'code_U' : x.thstatus === 'U' , 
                                    'code_E' : x.thstatus === 'E' , 
                                    'code_F' : x.thstatus === 'F' , 
                                }">
                                {{
                                    x.thstatus !== "U" ? x.thsapprovedate_d : '-'
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>