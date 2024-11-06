<div class="sub-body-container-title ntit">
    <div class="sub-container-left">

        CALCULATION SUBMITTAL
    </div>

    <div class="sub-container-right">
        <button ng-click="show_calculationsubmittal()" class="ism-btns btn-normal" ng-if="caniaccessbtns">
            <i class="fa fa-plus"></i>
            New Calculation Submittals
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
                    <td class="table-header">Calculation</td>
                    <td class="table-header">Submittal NO</td>
                    <td class="table-header">Revision No</td>
                    <td class="table-header">Submitted By</td>
                    <td class="table-header">Submitted Date</td>
                    <td class="table-header">Status</td>
                    <td class="table-header">Approved Date</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in calculation_datas">
                    <td ng-if="caniaccessbtns">
                        <button class="ism-btns btn-normal tbl-btn" type="button" ng-click="edit_CalculationSubmital(x)">
                            <i class="fa fa-edit"></i>
                            Edit
                        </button>
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{$index+1}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcsubmitall}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcsubmittalno}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcsubmittalrv}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcsubmittedby}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcsubmittaldate_d}}
                    </td>
                    <td ng-class="
                            {
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcstatus | StatusFilter}}

                    </td>
                    <td ng-class="{
                                    'code_A' : x.tcstatus === 'A' , 
                                    'code_B' : x.tcstatus === 'B' , 
                                    'code_BC' : x.tcstatus === 'BC' , 
                                    'code_C' : x.tcstatus === 'C' , 
                                    'code_D' : x.tcstatus === 'D' , 
                                    'code_U' : x.tcstatus === 'U' , 
                                    'code_E' : x.tcstatus === 'E' , 
                                    'code_F' : x.tcstatus === 'F' , 
                                }">
                        {{x.tcstatus === 'U' ? '-' : x.tcapproveddate_d}}
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>