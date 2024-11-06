<?php
include_once('../../../../conf.php');
?>
<?php include_once('../menu.php') ?>
<style>
    .multiselect {
        width: 280px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overselect {
        position: absolute;
    }

    #checkboexes {
        display: none;
        border: 1px #000 solid;
    }

    #checkboexes label {
        display: block;
    }
</style>

<div class="route-continer-project route-container-ok">
    <div class="route-container-header">
        <div class="router-container-back-btn">
            <a href="" id="back_btn">
                <i id="page-go-back" class="fa fa-arrow-left"></i>
            </a>
        </div>
        <div class="router-container-title">
            <Strong> {{'Shop Drawings Approvals' | uppercase}}</Strong>
        </div>
        <div class="router-container-options">
            <button id="print_btn" name="print_btn" ng-click="print_btn()" class="nafco-button nafco-btn-ok">Print</button>
            <button id="hidebutton" name="hidebutton" ng-click="hidedetials()" class="nafco-button nafco-btn-ok">Show Details</button>
            <div style="font-size:12px;display:none;flex-direction:column">
                <label for='one'>
                    <input id="type1" type="checkbox" ng-model='fillters.approvals_last_statusu' ng-true-value="'u'" ng-false-value="''">
                    U - Under Review
                </label>
                <label for='two'>
                    <input id="type2" type="checkbox" ng-model='fillters.approvals_last_statusa' ng-true-value="'a'" ng-false-value="''">
                    A - Approved
                </label>
                <label for='three'>
                    <input id="type3" type="checkbox" ng-model='fillters.approvals_last_statusb' ng-true-value="'b'" ng-false-value="''">
                    B - Approved As noted
                </label>
                <label for='three'>
                    <input id="type4" type="checkbox" ng-model='fillters.approvals_last_statusc' ng-true-value="'c'" ng-false-value="''">
                    C - Approved as noted Re-submit
                </label>
                <label for='three'>
                    <input id="type5" type="checkbox" ng-model='fillters.approvals_last_statusd' ng-true-value="'d'" ng-false-value="''">
                    D - Revised And Re-submit as noted
                </label>                
            </div>
        </div>
    </div>
    <div class="route-container-content">
        <div class='approvals-filters'>
        </div>
        <table class="project-list-table borderd drawing-approvals">
            <thead>
                <tr>
                    <th style="width:10px">#S.NO</th>
                    <th style="width:50px"></th>
                    <th style="width:100px">Project No</th>
                    <th style="width:450px">Project Name</th>
                    <th style="width:120px">Approval For</th>
                    <th style="width:650px">Drawing No</th>
                    <th style="width:850px">Description</th>
                    <th style="width:220px">Rev #</th>
                    <th style="width:220">SUB #</th>
                    <th style="width:220px">Submitted On</th>
                    <th style="width:220px">Received On</th>
                    <th style="width:250px">Client Sign On</th>
                    <th style="width:250px">Code</th>
                    <th style="width:250px">Delay</th>
                <tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <select class="nafco-inputs" ng-model="fillters.approvals_project_code">
                            <option value="">-All-</option>
                            <option ng-repeat="pr in viewproject" value="{{pr.project_no | uppercase}}">{{pr.project_no | uppercase}}</option>
                        </select>
                        <!-- <input type="text" ng-model="fillters.approvals_project_code" class="nafco-inputs" placeholder="Search..."> -->
                    </td>
                    <td>
                        <select ng-model="fillters.project_name" class="nafco-inputs">
                            <option value="">-All-</option>
                            <option ng-repeat="pr in viewproject" value="{{pr.project_name | uppercase}}">{{pr.project_name | uppercase}}</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_for" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_draw_no" class="nafco-inputs" placeholder="Search...">
                    <td>
                        <input type="text" ng-model="fillters.approvals_descriptions" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_last_revision_code" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_infos_sub" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_infos_submitedon" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_infos_receivedon" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <input type="text" ng-model="fillters.approvals_infos_clienton" class="nafco-inputs" placeholder="Search...">
                    </td>
                    <td>
                        <select ng-model="fillters.approvals_last_status" class="nafco-inputs">
                            <option value="">-All-</option>
                            <option value="U">U - Under Review </option>
                            <option value="A">A - Approved</option>
                            <option value="B">B - Approved As noted</option>
                            <option value="C">C - Approved as noted Re-submit</option>
                            <option value="D">D - Revised And Re-submit as noted</option>
                        </select>
                    </td>
                    <td>

                    </td>
                </tr>
            </thead>
            <tbody ng-repeat="x in _approvals | filter:fillters | orderBy:['-approvals_last_status','approvals_infos_clienton']">
                <tr>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{$index+1}}</td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        <a download="FileName" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf">
                            <i class="fa fa-download"></i>
                        </a>
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_project_code}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.project_name}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.types_name}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_draw_no | uppercase}}

                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_descriptions}}
                    </td>

                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_last_revision_code}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_infos_sub}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_infos_submitedon | date : myDatefilter}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_infos_receivedon}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        <p ng-if="x.approvals_last_status==='U' || x.approvals_last_status==='D' || x.approvals_last_status==='C'">-</p>
                        <p ng-if="x.approvals_last_status==='A' || x.approvals_last_status==='B'">{{x.approvals_infos_clienton}}</p>
                    </td>

                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="font-weight:bold;font-size:13;color:black">
                        {{x.approvals_last_status}}
                    </td>
                    <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}" style="text-align:center;font-weight:bold;font-size:13;color:black">
                        {{x.delayclient}}
                    </td>
                </tr>
                <tr ng-show="_fview === '1'">
                    <td colspan="14" style="padding:25px;background:#e4e3e3">
                        <table style='width:100%' class="project-list-table borderd drawing-approvals">
                            <thead>
                                <tr>
                                    <th style="background:#fff;color:#000">#S No</th>
                                    <th style="background:#fff;color:#000">#Drawing No</th>
                                    <th style="background:#fff;color:#000">Rev #</th>
                                    <th style="background:#fff;color:#000">Sub.#</th>
                                    <th style="background:#fff;color:#000">Submited On</th>
                                    <th style="background:#fff;color:#000">Received On</th>
                                    <th style="background:#fff;color:#000">Client Approved On</th>
                                    <th style="background:#fff;color:#000">Code</th>
                                    <th style="background:#fff;color:#000">Delay</th>

                                    <th style="background:#fff;color:#000"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="xe in x.rinfo">
                                    <td style="background:#fff;color:#000">
                                        {{$index + 1}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_drawing_no | uppercase}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_reveision_no}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_sub}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_submited_on}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_received_on}}
                                    </td>
                                    <td style="background:#fff;color:#000">
                                        {{xe.approvals_info_client_on}}
                                    </td>

                                    <td class="{{xe.approvals_info_code==='U'?'td-yellow':'' || xe.approvals_info_code==='A'?'td-ok':'' || xe.approvals_info_code==='B'?'td-green':'' || xe.approvals_info_code==='C'?'td-orange':'' || xe.approvals_info_code==='D'?'td-danger':''}}">
                                        {{xe.approvals_info_code}}
                                    </td>
                                    <td style="text-align:center">
                                        {{xe.delay}}
                                    </td style="background:#fff;color:#000">

                                    <td style="width:60px;background:#fff;color:#000">
                                        <a download="FileName" ng-if="xe.files==='1'" class="nafco-button nafco-sm-btn nafco-btn-noborder nafco-btn-danger" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{xe.approvals_info_token}}.pdf">
                                            <i class="fa fa-download"></i>
                                        </a>
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
    <table class="project-list-table borderd drawing-approvals" id="draw_approvals">
        <thead>
            <tr>
                <th style="width:10px">#S.NO</th>
                <th style="width:100px">Project No</th>
                <th style="width:450px">Project Name</th>
                <th style="width:120px">Approval For</th>
                <th style="width:650px">Drawing No</th>
                <th style="width:850px">Description</th>
                <th style="width:220px">Rev #</th>
                <th style="width:220">SUB #</th>
                <th style="width:220px">Submitted On</th>
                <th style="width:220px">Received On</th>
                <th style="width:250px">Client Return On</th>
                <th style="width:250px">Code</th>
                <th style="width:250px">Delay</th>
            <tr>
        </thead>
        <tbody ng-repeat="x in _approvals | filter:fillters">
            <tr>
                <td>
                    {{$index+1}}
                </td>
                <td>
                    {{x.approvals_project_code}}
                </td>
                <td>
                    {{x.project_name}}
                </td>
                <td>
                    {{x.types_name}}
                </td>
                <td>
                    {{x.approvals_draw_no | uppercase}}
                </td>
                <td>
                    {{x.approvals_descriptions}}
                </td>

                <td>
                    {{x.approvals_last_revision_code}}
                </td>
                <td>
                    {{x.approvals_infos_sub}}
                </td>
                <td>
                    {{x.approvals_infos_submitedon}}
                </td>
                <td>
                    {{x.approvals_infos_receivedon}}
                </td>
                <td>
                    {{x.approvals_infos_clienton}}
                </td>
                <td>
                    {{x.approvals_last_status}}
                </td>
                <td>
                    {{x.delayclient}}
                </td>
            </tr>
        </tbody>
    </table>
</div>


<script>
    var exp = false;
    var checkbox = document.getElementById("checkboexes");

    function showcheckboexe() {
        if (!exp) {
            checkbox.style.display = "block";
            exp = true;
        } else {
            checkbox.style.display = "none ";
            exp = false;
        }
    }
</script>