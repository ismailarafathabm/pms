<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$btnaccess = ['superadmin', 'operation', 'Management'];
$_btnaccess = false;
foreach ($btnaccess as $btns) {
    if ($userdep === $btns) {
        $_btnaccess = true;
        break;
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
                <div class="filters-sort" ng-repeat="val in getItems('project_filters',data)">
                    <input type="checkbox" ng-model="filter['project_filters'][val]" ng-value="val">
                    <lable> {{val | uppercase}}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby')">
                <div class='filter-tilte-text'>
                    Approval Details
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby">
                <div class="filters-sort" ng-repeat="val in getItems('approval_type_name',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['approval_type_name'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('abrovalforby')">
                <div class='filter-tilte-text'>
                    Approval Status
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="abrovalforby">
                <div class="filters-sort" ng-repeat="val in getItems('approvals_status',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['approvals_status'][val]" ng-value="val">
                    <lable> {{val | uppercase | apstatusfilter }}</lable>
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
                TECHNICAL APPROVAL REPORTS
            </div>
            <div class="sub-container-right">
                <button type="button" class="ism-btns btn-normal" ng-click="printclick()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button type="button" class="ism-btns btn-normal" onclick="tableToExcel('techapprovals', 'Technical Approvals')">
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

                        <th class="fiexdheader">Approval Details</th>
                        <th class="fiexdheader" style="width: 80px;">D.Approved</th>
                        <th class="fiexdheader" style="width: 80px;">D.Released</th>
                        <th class="fiexdheader">Remarks</th>
                        <th class="fiexdheader" style="width: 160px;"> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ap.approvals_status === 'b' ? 'trgreen' : '' || ap.approvals_status === 'a' ? 'trred txt-red' : ''}}" ng-repeat="ap in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput)" ng-if="ap.approvals_status!=='x'">
                        <td>{{$index+1}}</td>
                        <td>
                            <a target="_blank" href="<?php echo $url_base ?>assets/approvals/{{ap.approvals_token}}.pdf" download="{{ap.project_no}}-{{ap.approvals_remarks }}.pdf" ng-if="ap.approvals_status ==='b'" class="mr-1">
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                            </a>
                        </td>
                        <td>{{ap.project_no | uppercase}}</td>
                        <td>{{ap.project_name | uppercase}}</td>

                        <td>
                            <span ng-if="ap.approvals_status === 'a'" class="fa fa-circle" style="color:#ea5455"></span>
                            <span ng-if="ap.approvals_status === 'b'" class="fa fa-circle" style="color:#206a5d"></span>
                            {{ap.approval_type_name | uppercase}}

                        </td>
                        <td>

                            {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}

                        </td>
                        <td>

                            {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}

                        </td>
                        <td>{{ap.approvals_remarks}}</td>
                        <td>

                            <p ng-if="ap.approvals_status==='a'" class="txt-danger"> {{'approval not released' | uppercase }} </p>
                            <p ng-if="ap.approvals_status==='b'" class="txt-ok"> {{'approval released' | uppercase }} </p>
                            <p ng-if="ap.approvals_status==='x'"> {{'Supersede' |  uppercase }} </p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none;">
    <table class="project-list-table borderd" id="techapprovals">
        <thead>
            <tr>
                <th style="width:50px;">#S.NO</th>
                <th>Project No</th>
                <th>Project Name</th>
                <th>Approval Details</th>
                <th>D.Approved</th>
                <th>D.Released</th>
                <th>Remarks</th>
                <th style="width:180px;"> Status</th>
            <tr>
        </thead>
        <tbody>
            <tr ng-repeat="ap in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput)">
                <td>{{$index+1}}</td>
                <td>{{ap.project_no | uppercase}}</td>
                <td>{{ap.project_name | uppercase}}</td>
                <td>

                    {{ap.approval_type_name | uppercase}}

                </td>
                <td>

                    {{ap.approvals_adate | date :  "dd-MMM-yyyy"}}

                </td>
                <td>

                    {{ap.approvals_rdate | date :  "dd-MMM-yyyy"}}

                </td>
                <td>{{ap.approvals_remarks}}</td>
                <td>

                    <p ng-if="ap.approvals_status==='a'"> {{'approval not released' | uppercase }} </p>
                    <p ng-if="ap.approvals_status==='b'"> {{'approval released' | uppercase }} </p>
                    <p ng-if="ap.approvals_status==='x'"> {{'Supersede' |  uppercase }} </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>