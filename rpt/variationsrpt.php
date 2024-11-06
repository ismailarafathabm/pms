<?php
include_once('../../../../conf.php');
?>
<?php include_once('../menu.php') ?>
<style>
    .hiddenRow {
        display: none;
    }
</style>
<div class="route-continer-project route-container-ok">
    <div class="route-container-header">
        <div class="router-container-back-btn">
            <a href="" id="back_btn">
                <i id="page-go-back" class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div class="router-container-title title-x">
            <Strong> {{'Variations' | uppercase}}</Strong>
        </div>
        <div class="router-container-options">
            <button ng-click="printbtn()" class="nafco-btn-danger nafco-button">
                <i class="fa fa-print"></i>
                Print</button>
            <button id="hidebutton" id="showHide" ng-click="showalldatas()" class="nafco-button nafco-btn-ok">Show/hide</button>
        </div>
    </div>
    <div class="route-container-content">
        <table class="project-list-table borderd show_datas">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Project</th>
                    <th>Name</th>
                    <th></th>
                    <th>Ref No</th>
                    <th style="width:50px;">Revision No</th>
                    <th>Atte</th>
                    <th>Contractor/Client</th>
                    <th style="width:100px">Date</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th style="width:100px">Total Amount</th>
                    <th>Region</th>
                    <th>Sales Man</th>
                    <th>Status</th>
                    <th></th>                    
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <select class="nafco-inputs" ng-model="fil.variation_project">
                            <option value="">-All-</option>
                            <option ng-repeat="pr in viewproject" value="{{pr.project_no | uppercase}}">{{pr.project_no | uppercase}}</option>
                        </select>
                        <!-- <input type="text" ng-model="fillters.approvals_project_code" class="nafco-inputs" placeholder="Search..."> -->
                    </td>
                    <td>
                        <select ng-model="fil.variation_project_name" class="nafco-inputs">
                            <option value="">-All-</option>
                            <option ng-repeat="pr in viewproject" value="{{pr.project_name | uppercase}}">{{pr.project_name | uppercase}}</option>
                        </select>
                    </td>
                    <td></td>
                    <td>
                        <input type="text" ng-model="fil.variation_refno" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_refno" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_refno" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_to" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_date" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <select ng-model="fil.variation_subject" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option ng-repeat="y in sublist123" value="{{y.v_sub_id}}">{{y.v_sub_name | uppercase}}</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_description" class="nafco-inputs" placeholder="search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fil.variation_amount" class="nafco-inputs" placeholder="search...">
                    </td>

                    <td>
                        <select ng-model="fil.variation_region" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option ng-repeat="x in listregion" value="{{x.region_id}}">{{x.region_name | uppercase}}</option>
                        </select>
                    </td>
                    <td>
                        <select ng-model="fil.salesman_code" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option ng-repeat="x in salesmanlist" value="{{x.salesman_code}}">{{x.salesman_code}} - {{x.salesman_name | uppercase}}</option>
                        </select>
                    </td>
                    <td>
                        <select ng-model="fil.variation_status" class="nafco-inputs">
                            <option value="">-Select-</option>
                            <option value="1">ISSUED FOR APPROVAL</option>
                            <option value="2">APPROVED</option>
                            <option value="3">{{'cancelled' | uppercase}}</option>
                            <option value="4">{{'dummy' | uppercase}}</option>
                        </select>

                    </td>
                    <td></td>
                    
                    <td></td>

                </tr>
            </thead>
            <tbody ng-repeat="v in variationslist | filter:fil">
                <tr>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{$index+1}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_project}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_project_name}}
                    </td>
                    <td>
                        <center>
                            <a target="_blank" href="<?php echo $url_base ?>assets/variations/{{v.variation_token}}.pdf"><i class="fa fa-download"></i></a>
                        </center>
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_refno}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.revision_no}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_atten}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_to}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_date}}
                    </td>

                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.v_sub_name}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_description}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.variation_amount}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.region_name}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        {{v.salesman_code}} - {{v.salesman_name}}
                    </td>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        <p ng-if="v.variation_status==='1'">
                            {{'ISSUED FOR APPROVAL' | uppercase}}
                        </p>
                        <p ng-if="v.variation_status==='2'">
                            {{'APPROVED' | uppercase}}
                        </p>
                        <p ng-if="v.variation_status==='3'">
                            {{'cancelled' | uppercase}}
                        </p>
                        <p ng-if="v.variation_status==='4'">
                            {{'dummy' | uppercase}}
                        </p>
                    </td>
                    <td>
                        <center ng-if="v.variation_status !== '1'">
                            <a target="_blank" href="<?php echo $url_base ?>assets/variation_status/{{v.variation_token}}.pdf"><i class="fa fa-download"></i></a>
                        </center>
                    </td>
                    
                    <td>
                        <button id="hbtn" class='nafco-button nafco-btn-ok' ng-click="hideinfos(v.variation_token)">
                            S/H</button>
                    </td>

                </tr>
                <tr id="{{v.variation_token}}" class="hiddenRow hidenrows">
                    <td></td>
                    <td colspan="15" style="padding:25px;background:#e4e3e3">
                        <table style='width:100%' class="project-list-table borderd drawing-approvals">
                            <thead>
                                <tr>
                                    <th style="background:#fff;color:#000">#S No</th>
                                    <th style="background:#fff;color:#000"></th>
                                    <th style="background:#fff;color:#000">Ref No</th>
                                    <th style="background:#fff;color:#000">Rev No</th>
                                    <th style="background:#fff;color:#000">Atten</th>
                                    <th style="background:#fff;color:#000">Date</th>
                                    <th style="background:#fff;color:#000">Subject</th>
                                    <th style="background:#fff;color:#000">Description</th>
                                    <th style="background:#fff;color:#000">Amount</th>
                                    <th style="background:#fff;color:#000">Sales Man</th>
                                    <th style="background:#fff;color:#000">Status</th>
                                    <th style="background:#fff;color:#000"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="xe in v.revision_infos">
                                    <td style="background:#fff;color:#000">
                                        {{$index + 1}}
                                    </td>
                                    <td tyle="background:#fff;color:#000">
                                        <center>
                                            <a target="_blank" href="<?php echo $url_base ?>assets/v1/{{xe.revison_token}}.pdf"><i class="fa fa-download"></i></a>
                                        </center>
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.revison_refno}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.revison_no}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.revison_atten}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.revision_date}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.v_sub_name}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.revision_description}}
                                    </td>

                                    <td style="background:#fff;color:#000">
                                        {{xe.revision_amount}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.salesman_code}} - {{xe.salesman_name}}
                                    </td>
                                    <td class="{{xe.revision_status==='3'?'td-danger':'' || xe.revision_status==='1'?'td-yellow':'' || xe.revision_status==='2'?'td-green':'' || xe.revision_status==='4'?'td-orange':''}}">
                                        <p ng-if="xe.revision_status==='1'">
                                            {{'ISSUED FOR APPROVAL' | uppercase}}
                                        </p>
                                        <p ng-if="xe.revision_status==='2'">
                                            {{'APPROVED' | uppercase}}
                                        </p>
                                        <p ng-if="xe.revision_status==='3'">
                                            {{'cancelled' | uppercase}}
                                        </p>
                                        <p ng-if="xe.revision_status==='4'">
                                            {{'dummy' | uppercase}}
                                        </p>
                                    </td>

                                    <td style="width:60px;background:#fff;color:#000">
                                        <center ng-if="xe.revision_status !== '1'">
                                            <a target="_blank" href="<?php echo $url_base ?>assets/vs1/{{xe.revison_token}}.pdf"><i class="fa fa-download"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="display:none">
    <table id="print_tbl" class="project-list-table borderd">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Project</th>
                <th>Name</th>
                <th>Ref No</th>
                <th style="width:50px;">Revision No</th>
                <th>Atte</th>
                <th>Contractor/Client</th>
                <th style="width:100px">Date</th>
                <th>Subject</th>
                <th>Description</th>
                <th style="width:100px">Total Amount</th>
                <th>Region</th>
                <th>Sales Man</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="v in variationslist | filter:fil">
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{$index+1}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_project}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_project_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_refno}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.revision_no}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_atten}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_to}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_date}}
                </td>

                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.v_sub_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_description}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_amount}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.region_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.salesman_code}} - {{v.salesman_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    <p ng-if="v.variation_status==='1'">
                        {{'ISSUED FOR APPROVAL' | uppercase}}
                    </p>
                    <p ng-if="v.variation_status==='2'">
                        {{'APPROVED' | uppercase}}
                    </p>
                    <p ng-if="v.variation_status==='3'">
                        {{'cancelled' | uppercase}}
                    </p>
                    <p ng-if="v.variation_status==='4'">
                        {{'dummy' | uppercase}}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>