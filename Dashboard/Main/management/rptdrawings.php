<?php
session_start();
include_once('../../../conf.php');
$user_department = $_SESSION['nafco_alu_user_department'];
$access_departments = ['estimate', 'Management', 'operation', 'accounts', 'superadmin'];

$_access = false;
foreach ($access_departments as $ac) {
    if ($user_department === $ac) {
        $_access = true;
        break;
    }
}

$_btnacces = false;
$button_access = ['estimate', 'Management', 'superadmin'];

foreach ($button_access as $ac) {
    if ($user_department === $ac) {
        $_btnacces = true;
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
            <div class="filter-title-sub" ng-click="showhidesfilters('projectsort')">
                <div class='filter-tilte-text'>
                    By Project
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="projectsort">
                <div class="filters-sort" ng-repeat="val in getItems('projectsort',data)">
                    <input type="checkbox" ng-model="filter['projectsort'][val]" ng-value="val">
                    <lable> {{val | uppercase}}</lable>
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
                Drawing Reports
            </div>
            <div class="sub-container-right">
                <button type="button" class="ism-btns btn-normal" ng-click="print_btn()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button type="button" class="ism-btns btn-normal" onclick="tableToExcel('draw_approvals', 'Technical Approvals')">
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
                        <th class="fiexdheader">Project No</th>
                        <th class="fiexdheader">Project Name</th>
                        <th class="fiexdheader">Shop Dwg Progress %</th>
                        <th class="fiexdheader">Total Dwg Sheets</th>
                        <th class="fiexdheader">Total Sheets Submitted</th>
                        <th class="fiexdheader">Code A</th>
                        <th class="fiexdheader">Code B</th>
                        <th class="fiexdheader">Code C</th>
                        <th class="fiexdheader">Code U</th>
                        <th class="fiexdheader">Code H</th>
                        <th class="fiexdheader">Code F</th>
                        <th class="fiexdheader">Code X</th>

                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy : ['-approvals_last_status','-approvals_infos_submitedon'] )" ng-class-odd="'oddtr'">
                        <td>
                            {{$index+1}}</td>

                        <td>
                            <button type="button" class="ism-btns btn-normal" ng-click="getreportsdatas(x.projectx,x.projectsort)" style="padding:2px 5px">
                                {{x.project | uppercase}}
                            </button>
                        </td>
                        <td>
                            {{x.projectname}}
                        </td>
                        <td class="{{x.pr>=50 ? 'td-ok' : 'td-danger'}}" style="font-weight: 600; text-align:center">
                            {{x.pr}} %
                        </td>
                        <td style="color:#132743;font-weight: bold;background-color: #c3dcff;">
                            {{x.cnt_approvals}}
                        </td>
                        <td>
                            {{x.cnt_revision}}
                        </td>
                        <td style="color:#0d7377;font-weight: bold;background-color: #e2feff; text-align:center">
                            {{x.cnt_a}}
                        </td>
                        <td style="color:#41aea9;font-weight: bold;background-color: #d2fff1; text-align:center">
                            {{x.cnt_b}}
                        </td>
                        <td style="color:#bb2205;font-weight: bold;background-color: #fadbd6; text-align:center">
                            {{x.cnt_c}}
                        </td>
                        <td style="color:#a85603;font-weight: bold;background-color: #fecdc2; text-align:center">
                            {{x.cnt_u}}
                        </td>
                        <td style="color:#0278ae;font-weight: bold;background-color: #c6e8ff; text-align:center">
                            {{x.cnt_h}}
                        </td>
                        <td style="color:#150485;font-weight: bold;background-color: #c3dcff; text-align:center">
                            {{x.cnt_f}}
                        </td>
                        <td style="color:#e60412;font-weight: bold;background-color: #ffc6c9; text-align:center">
                            {{x.cnt_x}}
                        </td>


                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none">
    <table class="project-list-table borderd drawing-approvals" id="draw_approvals">
        <thead>
            <tr>
                <th>#S.NO</th>
                <th>Project No</th>
                <th>Project Name</th>
                <th>Total Dwg Sheets</th>
                <th>Total Sheets Submitted</th>
                <th class="td-green">Code A</th>
                <th class="td-ok">Code B</th>
                <th class="td-orange">Code C</th>
                <th class="ted-yellow">Code U</th>
                <th>Code H</th>
                <th>Code F</th>
                <th>Code X</th>
                <th>Shop Dwg Progress %</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy : ['-approvals_last_status','-approvals_infos_submitedon'] )">
                <td>
                    {{$index+1}}</td>

                <td>
                    {{x.project}}
                </td>
                <td>
                    {{x.projectname}}
                </td>
                <td>
                    {{x.cnt_approvals}}
                </td>
                <td>
                    {{x.cnt_revision}}
                </td>
                <td>
                    {{x.cnt_a}}
                </td>
                <td>
                    {{x.cnt_b}}
                </td>
                <td>
                    {{x.cnt_c}}
                </td>
                <td>
                    {{x.cnt_u}}
                </td>
                <td>
                    {{x.cnt_h}}
                </td>
                <td>
                    {{x.cnt_f}}
                </td>
                <td>
                    {{x.cnt_x}}
                </td>
                <td>
                    {{x.pr}}
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


<div class="ism-dialogbox" id="revision_list">
    <div class="ism-dialog-body ism-dialog-bodytables">
        <div class="dialog-head">
            <div class="dialog-head-title">
                {{pagetitles}} - Cutting List And MO's
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead id="hidiv">
                    <tr>

                        <th class="fiexdheader">#S.NO</th>
                        <th class="fiexdheader">File</th>
                        <th class="fiexdheader">Approval For</th>
                        <th class="fiexdheader">Drawing No</th>
                        <th class="fiexdheader">Description</th>
                        <th class="fiexdheader">Rev #</th>
                        <th class="fiexdheader">SUB #</th>
                        <th class="fiexdheader">Submitted On</th>
                        <th class="fiexdheader">Received On</th>
                        <th class="fiexdheader">Client Return On</th>
                        <th class="fiexdheader">Code</th>
                        <th class="fiexdheader">Delay</th>

                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in _approvals | filter:fillters" class="{{x.approvals_last_status==='U'?'tryellow':'' || x.approvals_last_status==='A'?'trgreen':'' || x.approvals_last_status==='B'?'trgreen2':'' || x.approvals_last_status==='C'?'trred txt-red':'' || x.approvals_last_status==='D'?'trorange':'' || x.approvals_last_status==='H'?'tryellow2':'' || x.approvals_last_status==='X'?'trred2 txt-red':'' || x.approvals_last_status==='F'?'trblue':''}}">
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}" style="color:#000">
                            {{$index+1}}</td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}" style="color:#000">
                            <a ng-if="x.f == '1'" style="color:#000" target="_blank" href="<?php echo $url_base ?>assets/drawingapprovals/{{x.approvals_last_revision_no}}.pdf">
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                            </a>
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}" style="color:#000">
                            {{x.types_name}}
                        </td>
                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}" style="color:#000">
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

                        <td class="{{x.approvals_last_status==='U'?'td-yellow':'' || x.approvals_last_status==='A'?'td-ok':'' || x.approvals_last_status==='B'?'td-green':'' || x.approvals_last_status==='C'?'td-orange':'' || x.approvals_last_status==='D'?'td-danger':'' || x.approvals_last_status==='H'?'td-yellow3':'' || x.approvals_last_status==='X'?'td-red3':'' || x.approvals_last_status==='F'?'td-blue3':''}}" style="color:#000">
                            {{x.approvals_last_status}}
                        </td>
                        <td style="text-align:center">
                            {{x.delayclient}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>