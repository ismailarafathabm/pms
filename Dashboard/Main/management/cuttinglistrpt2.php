<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$btnaccess = ['superadmin', 'Management', 'engineering'];
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
                    Cl.Released Date
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
                <div class="filters-sort" ng-repeat="val in getItems('projectby',data)">
                    <input type="checkbox" ng-model="filter['projectby'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby')">
                <div class='filter-tilte-text'>
                    Release To
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby">
                <div class="filters-sort" ng-repeat="val in getItems('cuttinglist_releasedto',data)">
                    <input type="checkbox" ng-model="filter['cuttinglist_releasedto'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby1')">
                <div class='filter-tilte-text'>
                    Done By
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby1">
                <div class="filters-sort" ng-repeat="val in getItems('cuttinglist_doneby',data)">
                    <input type="checkbox" ng-model="filter['cuttinglist_doneby'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby2')">
                <div class='filter-tilte-text'>
                    Marking Type
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby2">
                <div class="filters-sort" ng-repeat="val in getItems('cuttinglist_markingtype',data)">
                    <input type="checkbox" ng-model="filter['cuttinglist_markingtype'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby3')">
                <div class='filter-tilte-text'>
                    Sheet Type
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby3">
                <div class="filters-sort" ng-repeat="val in getItems('cuttinglist_sheettp',data)">
                    <input type="checkbox" ng-model="filter['cuttinglist_sheettp'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby4')">
                <div class='filter-tilte-text'>
                    Section
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby4">
                <div class="filters-sort" ng-repeat="val in getItems('cuttinglist_section',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['cuttinglist_section'][val]" ng-value="val">
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
                Cutting List
            </div>
            <div class="sub-container-right">
                <button type="button" class="ism-btns btn-normal" ng-click="printclick()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button ng-show="access_cuttinglist_excel_report" type="button" class="ism-btns btn-normal" onclick="tableToExcel('cuttinglist', 'Technical Approvals')">
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
                        <th class="fiexdheader">S.No</th>
                        <th class="fiexdheader">File</th>
                        <th class="fiexdheader">Project No</th>
                        <th class="fiexdheader">Project Name</th>
                        <th class="fiexdheader">CL.REF No</th>
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
                    </tr>
                </thead>
                <tbody>
                    <tr ng-class-odd="'oddtr'" ng-repeat="ct in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput | orderBy:['-cuttinglist_moreleasedtoproduction_s','-cuttinglist_moreleasedtoacct_s','-cuttinglist_cldaterelease_s'])">
                        <td>
                            {{$index+1}}
                        </td>
                        <td>
                            <div ng-if="ct.file === '1'">
                                <a target="_blank" href="<?php echo $url_base ?>viewuploads.php?foldertoken={{ct.cuttinglist_token}}">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png" style="width:18px;">
                                </a>
                            </div>
                        </td>
                        <td>
                            {{ct.cuttinglist_project_id}}
                        </td>
                        <td>
                            {{ct.project_name}}
                        </td>
                        <td>
                            {{ct.cuttinglist_clrefno}}
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
                        <td>
                            {{ct.cuttinglist_descripton}}
                        </td>
                        <td>
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
                        <td>
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






<div style="display:none;">
    <table class="project-list-table borderd drawing-approvals" id="cuttinglist">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Project No</th>
                <th>Project Name</th>
                <th>CL.REF No</th>
                <th>CL.Date Released</th>
                <th>MO.Ref NO</th>
                <th>MO.Released To Acct</th>
                <th>MO.Released To Production</th>
                <th>Released To</th>
                <th>Done By</th>
                <th>Marking Type</th>
                <th>Desscription</th>
                <th>Location</th>
                <th>Qty</th>
                <th>Height</th>
                <th>Width</th>
                <th>AREA.SQM</th>
                <th>Tot.Area</th>
                <th>Glass Ref. No.</th>
                <th>SHEET TYPE</th>
                <th>REMARK</th>
                <th>SECTION</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="ct in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput)">
                <td>
                    {{$index+1}}
                </td>
                <td>
                    {{ct.cuttinglist_project_id}}
                </td>
                <td>
                    {{ct.project_name}}
                </td>
                <td>
                    {{ct.cuttinglist_clrefno}}
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
                <td style="text-align:right">
                    {{ct.cuttinglist_qty}} {{ct.cuttinglist_qty_type | uppercase}}
                </td>
                <td style="text-align:right">
                    {{ct.cuttinglist_height}}
                </td>
                <td style="text-align:right">
                    {{ct.cuttinglist_width}}
                </td>
                <td style="text-align:right">
                    {{ct.cuttinglist_area | number :'2'}}
                </td>
                <td style="text-align:right">
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