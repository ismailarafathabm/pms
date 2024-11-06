<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];

$update_access = ['superadmin', 'operation'];
$_update_access = false;
foreach ($update_access as $a) {
    if ($userdep === $a) {
        $_update_access = true;
        break;
    }
}
$price_access = ['superadmin', 'operation', 'Management', 'contract and operations'];
$_price_acces = false;
foreach ($price_access as $p) {
    if ($userdep === $p) {
        $_price_acces = true;
    }
}
include_once('../menu1.php');
?>
<div class="sub-body">
    <div class="left-filters">
        <div class="filter-sub">
            <div class="filter-title-sub">
                <div class='filter-tilte-text'>
                    Search
                </div>
                <div class="downbutton">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="filterslist">
                <div class="filters-sort">
                    <input type="input" placeholder="search....." class="nafco-inputs" ng-model="searchinput.$">
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub">
                <div class='filter-tilte-text'>
                    By Submited On
                </div>
                <div class="downbutton">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="filterslist">
                <div class="filters-sort colm-mode">
                    <input autocomplete="off" type="text" id="sdate" placeholder="dd-mm-yyyy" class="nafco-inputs" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_godate" ng-model="startdate" style="margin-bottom:3px;">
                    <input autocomplete="off" type="text" id="edate" placeholder="dd-mm-yyyy" class="nafco-inputs" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_gedate" ng-model="endate" style="margin-bottom:3px;"></br>
                    <button class="ism-btns btn-normal" style="width:100%" ng-click="srtbydate()">Get</button>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('projectby')">
                <div class='filter-tilte-text'>
                    By Project
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="projectby">
                <div class="filters-sort" ng-repeat="val in getItems('project_infos',data)">
                    <input type="checkbox" ng-model="filter['project_infos'][val]" ng-value="val">
                    <lable> {{val | uppercase}}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('statusby')">
                <div class='filter-tilte-text'>
                    By Status
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="statusby">
                <div class="filters-sort" ng-repeat="val in getItems('approvals_last_status',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['approvals_last_status'][val]" ng-value="val">
                    <lable> {{val | uppercase | myfi2 }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby')">
                <div class='filter-tilte-text'>
                    By Revision
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby">
                <div class="filters-sort" ng-repeat="val in getItems('approvals_last_revision_code',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['approvals_last_revision_code'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('abrovalforby')">
                <div class='filter-tilte-text'>
                    Approval For
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="abrovalforby">
                <div class="filters-sort" ng-repeat="val in getItems('types_name',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['types_name'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-body-container inreportsbody">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                SHOP DRAWING APPROVAL REPORTS
            </div>
            <div class="sub-container-right">
                <button type="button" class="ism-btns btn-normal" ng-click="print_btn()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button type="button" class="ism-btns btn-normal" onclick="tableToExcel('draw_approvals', 'Technical Approvals')" disabled>
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
            </div>
        </div>
        <div ng-show="isloading" class="sub-body-container-contents loadingdiv">
            <center>
                <img src="<?php echo $url_base ?>/themes/defload.gif" width="50px" height="50px">
                <br />
                <span style="margin-top:5px;">Please Wait Loading Data....</span>
            </center>
        </div>
        <div ng-show="!isloading" class="sub-body-container-contents mainbodys_data">
            <table class="naf-tables">
                <thead id="hidiv">

                    <tr>
                        <th class="fiexdheader">#S.NO</th>
                        <th class="fiexdheader">File</th>
                        <th class="fiexdheader">Project No</th>
                        <th class="fiexdheader">Project Name</th>
                        <th class="fiexdheader">Approval For</th>
                        <th class="fiexdheader">Drawing No</th>
                        <th class="fiexdheader">Code</th>
                        <th class="fiexdheader">Description</th>
                        <th class="fiexdheader">Rev #</th>
                        <th class="fiexdheader">SUB #</th>
                        <th class="fiexdheader">Submitted On</th>
                        <th class="fiexdheader">Received On</th>
                        <th class="fiexdheader">Client Sign On</th>

                        <th class="fiexdheader">Delay</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy : ['-approvals_last_status','-approvals_infos_submitedon']) " class="{{x.approvals_last_status==='U'?'tryellow':'' || x.approvals_last_status==='A'?'trgreen':'' || x.approvals_last_status==='B'?'trgreen2':'' || x.approvals_last_status==='C'?'trred txt-red':'' || x.approvals_last_status==='D'?'trorange':'' || x.approvals_last_status==='H'?'tryellow2':'' || x.approvals_last_status==='X'?'trred2 txt-red':'' || x.approvals_last_status==='F'?'trblue':''}}">
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{$index+1}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            <a ng-if="x.f==='1'" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf" download="{{x.approvals_draw_no}}.pdf">
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                            </a>
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.approvals_project_code}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.project_name}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.types_name}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            <button type="button" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="Revision_btnList(x)">
                                {{x.approvals_draw_no | uppercase}}
                            </button>
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            <span ng-if="x.approvals_last_status==='A'" class="fa fa-circle" style="color:#0d7377"></span>
                            <span ng-if="x.approvals_last_status==='B'" class=" fa fa-circle" style="color:#41aea9"></span>
                            <span ng-if="x.approvals_last_status==='C'" class="fa fa-circle" style="color:#bb2205"></span>
                            <span ng-if="x.approvals_last_status==='U'" class="fa fa-circle" style="color:#f6830f"></span>
                            <span ng-if="x.approvals_last_status==='H'" class="fa fa-circle" style="color:#0278ae"></span>
                            <span ng-if="x.approvals_last_status==='F'" class="fa fa-circle" style="color:#150485"></span>
                            <span ng-if="x.approvals_last_status==='X'" class="fa fa-circle" style="color:#e60412"></span>
                            {{x.approvals_last_status | myfi2}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.approvals_descriptions}}
                        </td>

                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">

                            {{x.approvals_last_revision_code}}

                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.approvals_infos_sub}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.approvals_infos_submitedon_d}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.approvals_infos_receivedon_d}}

                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            <p ng-if="x.approvals_last_status==='U' || x.approvals_last_status==='D' || x.approvals_last_status==='C'">-</p>
                            <p ng-if="x.approvals_last_status==='A' || x.approvals_last_status==='B'">{{x.approvals_infos_clienton}}</p>
                        </td>


                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':''}}">
                            {{x.delayclient}}
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>