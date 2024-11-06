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
                        <th class="fiexdheader">PROJECT NO</th>
                        <th class="fiexdheader">PROJECT NAME</th>
                        <th class="fiexdheader">BOQ ITEM</th>
                        <th class="fiexdheader">BOQ QTY</th>
                        <th class="fiexdheader">RELEASED</th>
                        <th class="fiexdheader">BALANCE</th>
                        <th class="fiexdheader">MISCELLANEOUS</th>
                        <th class="fiexdheader"> %</th>

                    </tr>

                </thead>
                <tbody>
                    <tr class="{{x.diff == x.boq_qty ? 'tryellow' : '' || x.diff == 0 ? 'trgreen' : '' ||  x.diff <= 0 ? 'trred txt-red' : ''}}" ng-repeat="x in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy : ['-approvals_last_status','-approvals_infos_submitedon'] )">
                        <td>
                            {{$index+1}}</td>

                        <td>
                            {{x.poq_project_code}}

                        </td>
                        <td>

                            {{x.poq_project_name}}
                        </td>
                        <td>
                            <button type="button" ng-click="getreportsdatas(x.poq_project_code,x.boq_itme)" class="ism-btns btn-normal" style="padding:2px 5px">
                                {{x.boq_itme}}
                            </button>
                        </td>
                        <td style="font-weight:600">
                            {{x.boq_qty}}
                        </td>
                        <td style="font-weight:600">
                            {{x.cnt}}
                        </td>
                        <td style="font-weight:600;">
                            {{x.diff}}
                        </td>
                        <td style="font-weight:600">
                            {{x.mis}}
                        </td>

                        <td style="font-weight: 600; text-align:center">
                            {{x.prs}} %
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
                <th>BOQ ITEM</th>
                <th>In Boq Qty</th>
                <th>Actual Release</th>
                <th>Balance</th>
                <th>Compleated %</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="x in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy : ['-approvals_last_status','-approvals_infos_submitedon'] )">
                <td>
                    {{$index+1}}</td>

                <td>
                    <button type="button" ng-click="getreportsdatas(x.projectx,x.projectsort)" class="nafco-button link">
                        {{x.poq_project_code}}
                    </button>
                </td>
                <td>
                    {{x.poq_project_name}}
                </td>
                <td>
                    {{x.boq_itme}}
                </td>
                <td>
                    {{x.boq_qty}}
                </td>
                <td>
                    {{x.cnt}}
                </td>
                <td>
                    {{x.diff}}
                </td>
                <td class="{{x.prs>=50 ? 'td-ok' : 'td-danger'}}" style="font-weight: 600; text-align:center">
                    {{x.prs}} %
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
                {{pagetitles | uppercase}} - Revision List
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('revision_list').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="dialog-body">
            <table class="dialog-table">
                <thead id="hidiv">
                    <tr>
                        <th class="fiexdheader">BOQ ITME</th>
                        <th class="fiexdheader">CL.REF No</th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader">CL.Date Released</th>
                        <th class="fiexdheader">MO.Ref NO</th>
                        <th class="fiexdheader">MO.Released To Acct</th>
                        <th class="fiexdheader">MO.Released To Production</th>
                        <th class="fiexdheader">Released To</th>
                        <th class="fiexdheader">Done By</th>
                        <th class="fiexdheader">Marking Type</th>
                        <th class="fiexdheader">Desscription</th>
                        <th class="fiexdheader">Location</th>
                        <th class="fiexdheader">Qty</th>
                        <th class="fiexdheader">Height</th>
                        <th class="fiexdheader">Width</th>
                        <th class="fiexdheader">AREA.SQM</th>
                        <th class="fiexdheader">Tot.Area</th>
                        <th class="fiexdheader">Glass Ref. No.</th>
                        <th class="fiexdheader">SHEET TYPE</th>
                        <th class="fiexdheader">REMARK</th>
                        <th class="fiexdheader">SECTION</th>

                    <tr>
                </thead>
                <tbody>
                    <tr ng-repeat="ct in cuttinglist | filter:fi | orderBy:'cuttinglist_cldaterelease'" >
                        <td>
                            {{ct.cuttinglist_boqitem}}

                        </td>
                        <td>
                            {{ct.cuttinglist_clrefno}}

                        </td>
                        <td>
                            <div ng-if="ct.file === '1'">
                                <a target="_blank" href="<?php echo $url_base ?>viewuploads.php?foldertoken={{ct.cuttinglist_token}}" class="link">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                </a>
                            </div>
                        </td>
                        <td>
                            {{ct.cuttinglist_cldaterelease}}
                        </td>

                        <td>
                            {{ct.cuttinglist_morefno}}
                        </td>

                        <td>
                            {{ct.cuttinglist_moreleasedtoacct}}
                        </td>

                        <td>
                            {{ct.cuttinglist_moreleasedtoproduction}}
                        </td>
                        <td>
                            {{ct.cuttinglist_releasedto}}
                        </td>
                        <td>
                            {{ct.cuttinglist_doneby}}
                        </td>
                        <td>
                            {{ct.cuttinglist_markingtype}}
                        </td>
                        <td style="font-size:9px;">
                            {{ct.cuttinglist_descripton}}
                        </td>
                        <td style="font-size:9px;">
                            {{ct.cuttinglist_location}}
                        </td>
                        <td>
                            {{ct.cuttinglist_qty}} {{ct.cuttinglist_qty_type | uppercase}}
                        </td>
                        <td>
                            {{ct.cuttinglist_height}}
                        </td>
                        <td>
                            {{ct.cuttinglist_width}}
                        </td>
                        <td>
                            {{ct.cuttinglist_area | number :'2'}}
                        </td>
                        <td>
                            {{ct.cuttinglist_totarea | number :'2'}}
                        </td>
                        <td>
                            {{ct.cuttinglist_classrefno}}
                        </td>
                        <td>
                            {{ct.cuttinglist_sheettp}}
                        </td>
                        <td style="font-size:10px;">
                            {{ct.cuttinglist_remarks}}
                        </td>
                        <td>
                            {{ct.cuttinglist_section}}
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>