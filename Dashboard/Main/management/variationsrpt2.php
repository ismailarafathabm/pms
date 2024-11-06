<?php
session_start();
include_once('../../../conf.php');
$user_department = $_SESSION['nafco_alu_user_department'];
$access_departments = ['estimate', 'Management', 'operation', 'accounts', 'superadmin'];

$user_department = $_SESSION['nafco_alu_user_department'];
$access_departments = ['estimate', 'Management', 'operation', 'accounts', 'superadmin', 'contract and operations'];
$access_buttons = ['estimate', 'superadmin'];
$access_vbuttons = ['estimate', 'superadmin', 'operation', 'Management'];
$excel_exportbutton = ['estimate', 'superadmin', 'operation', 'Management', 'contract and operations'];


$_access = false;
foreach ($access_departments as $ac) {
    if ($user_department === $ac) {
        $_access = true;
        break;
    }
}
$_btn_access = false;
foreach ($access_buttons as $b) {
    if ($user_department === $b) {
        $_btn_access = true;
        break;
    }
}
$_access_vbutton = false;
foreach ($access_vbuttons as $b) {
    if ($user_department === $b) {
        $_access_vbutton = true;
        break;
    }
}
$_access_vbuttonx = false;
foreach ($excel_exportbutton as $b) {
    if ($user_department === $b) {
        $_access_vbuttonx = true;
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
                    <form autocomplete="off">
                        <input autocomplete="off" type="text" id="sdate" placeholder="dd-mm-yyyy" class="nafco-inputs" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_godate" ng-model="startdate" style="margin-bottom:3px;">
                        <input autocomplete="off" type="text" id="edate" placeholder="dd-mm-yyyy" class="nafco-inputs" ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="val_gedate" ng-model="endate" style="margin-bottom:3px;"></br>
                        <button class="ism-btns btn-normal" style="width:100%" ng-click="srtbydate()">Get</button>
                    </form>
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
                <div class="filters-sort" ng-repeat="val in getItems('dispproject',data)">
                    <input type="checkbox" ng-model="filter['dispproject'][val]" ng-value="val">
                    <lable> {{val | uppercase}}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby')">
                <div class='filter-tilte-text'>
                    Subject
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby">
                <div class="filters-sort" ng-repeat="val in getItems('v_sub_name',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['v_sub_name'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby1')">
                <div class='filter-tilte-text'>
                    Atte
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby1">
                <div class="filters-sort" ng-repeat="val in getItems('variation_atten',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['variation_atten'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby2')">
                <div class='filter-tilte-text'>
                    Contract/Client
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby2">
                <div class="filters-sort" ng-repeat="val in getItems('variation_to',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['variation_to'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby3')">
                <div class='filter-tilte-text'>
                    Region
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby3">
                <div class="filters-sort" ng-repeat="val in getItems('region_name',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['region_name'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('revesionby4')">
                <div class='filter-tilte-text'>
                    Sales Man
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="revesionby4">
                <div class="filters-sort" ng-repeat="val in getItems('salesman_name',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['salesman_name'][val]" ng-value="val">
                    <lable> {{val | uppercase }}</lable>
                </div>
            </div>
        </div>
        <div class="filter-sub">
            <div class="filter-title-sub" ng-click="showhidesfilters('abrovalforby')">
                <div class='filter-tilte-text'>
                    Status
                </div>
                <div class="downbutton">
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <div class="filterslist lis" id="abrovalforby">
                <div class="filters-sort" ng-repeat="val in getItems('variation_status',data) | orderBy : 'approvals_project_code'">
                    <input type="checkbox" ng-model="filter['variation_status'][val]" ng-value="val">
                    <lable> {{val | varstatusfilter }}</lable>
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
                VARIATIONS REPORTS
            </div>
            <div class="sub-container-right">
                <button type="button" class="ism-btns btn-normal" ng-click="print_btn()">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <button type="button" class="ism-btns btn-normal" onclick="tableToExcel('print_tbl', 'Technical Approvals')">
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
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>
                        <th class="fiexdheader">Datex</th>
                        <th class="fiexdheader">Subject</th>
                        <th class="fiexdheader">Project</th>
                        <th class="fiexdheader">Name</th>
                        <th class="fiexdheader">Ref No</th>
                        <th class="fiexdheader">Revision No</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader" style="width:100px">Total Amount</th>
                        <?php
                        }
                        ?>
                        <th class="fiexdheader">Status</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>
                        <th class="fiexdheader">Atte</th>
                        <th class="fiexdheader">Contractor/Client</th>
                        <th class="fiexdheader">Description</th>
                        <th class="fiexdheader">Region</th>
                        <th class="fiexdheader">Sales Man</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="v in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput)" class="{{v.variation_status==='3'?'trred':'' || v.variation_status==='1'?'tryellow':'' || v.variation_status==='2'?'trgreen':'' || v.variation_status==='4'?'trorange':''}}">
                        <td>
                            {{$index+1}}
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center>
                                    <a target="_blank" href="<?php echo $url_base ?>assets/variations/{{v.variation_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:15px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                        <td>
                            {{v.variation_date}}
                        </td>
                        <td>
                            {{v.v_sub_name}}
                        </td>
                        <td>
                            {{v.variation_project}}
                        </td>
                        <td>
                            {{v.variation_project_name}}
                        </td>


                        <td>
                            {{v.variation_refno}}
                        </td>
                        <td>
                            {{v.revision_no}}
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td style="font-weight:bold;text-align: right;">
                                {{v.variation_amount | number : fractionSize}}
                            </td>
                        <?php
                        }
                        ?>

                        <td>




                            <p ng-if="v.variation_status==='1'">
                                <span ng-if="v.variation_status === '1'" class="fa fa-circle" style="color:#ffa62b"></span>
                                {{'ISSUED FOR APPROVAL' | uppercase}}
                            </p>
                            <p ng-if="v.variation_status==='2'">
                                <span ng-if="v.variation_status === '2'" class="fa fa-circle" style="color:#206a5d"></span>
                                {{'APPROVED' | uppercase}}
                            </p>
                            <p ng-if="v.variation_status==='3'">
                                <span ng-if="v.variation_status === '3'" class="fa fa-circle" style="color:#bb2205"></span>

                                {{'cancelled' | uppercase}}
                            </p>
                            <p ng-if="v.variation_status==='4'">
                                <span ng-if="v.variation_status === '4'" class="fa fa-circle" style="color:#db6400"></span>
                                {{'dummy' | uppercase}}
                            </p>
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center ng-if="v.variation_status !== '1'">
                                    <a target="_blank" href="<?php echo $url_base ?>assets/variation_status/{{v.variation_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>
                        <td>

                        </td>
                        <td>
                            {{v.variation_atten | uppercase}}
                        </td>
                        <td>
                            {{v.variation_to}}
                        </td>



                        <td>
                            {{v.variation_description}}
                        </td>

                        <td>
                            {{v.region_name | uppercase}}
                        </td>
                        <td>
                            {{v.salesman_code | uppercase}} - {{v.salesman_name | uppercase}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
                <?php
                if ($_access === true) {
                ?>
                    <th style="width:100px">Total Amount</th>
                <?php
                }
                ?>

                <th>Region</th>
                <th>Sales Man</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="v in filtered=(data | filter:filterByPropertiesMatchingAND | filter:searchinput)" class="{{v.variation_status==='3'?'trred':'' || v.variation_status==='1'?'tryellow':'' || v.variation_status==='2'?'trgreen':'' || v.variation_status==='4'?'trorange':''}}">
                <td>
                    {{$index+1}}
                </td>
                <td>
                    {{v.variation_project}}
                </td>
                <td>
                    {{v.variation_project_name}}
                </td>
                <td>
                    {{v.variation_refno}}
                </td>
                <td>
                    {{v.revision_no}}
                </td>
                <td>
                    {{v.variation_atten}}
                </td>
                <td>
                    {{v.variation_to}}
                </td>
                <td>
                    {{v.variation_date}}
                </td>

                <td>
                    {{v.v_sub_name}}
                </td>
                <td>
                    {{v.variation_description}}
                </td>
                <?php
                if ($_access === true) {
                ?>
                    <td style="font-weight:bold">
                        {{v.variation_amount}}
                    </td>
                <?php
                }
                ?>

                <td>
                    {{v.region_name}}
                </td>
                <td>
                    {{v.salesman_code}} - {{v.salesman_name}}
                </td>
                <td>
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