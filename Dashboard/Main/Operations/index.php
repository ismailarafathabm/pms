<?php
session_start();
include_once('../../../conf.php');
$userdep = $_SESSION['nafco_alu_user_department'];
$new_btnAccess = ['superadmin', 'it', 'operation'];
$_newBtnAccess = false;
foreach ($new_btnAccess as $x) {
    if ($userdep === $x) {
        $_newBtnAccess = true;
        break;
    }
}

$summaryPdf = ['superadmin', 'it', 'operation', 'estimate', 'accounts', 'Management', 'contract and operations'];
$_pdfaccess = false;
foreach ($summaryPdf as $x) {
    if ($userdep === $x) {
        $_pdfaccess = true;
        break;
    }
}
?>

<style>
    .naf-tables-new {
        border-collapse: collapse;
        font-family: roboto;
        font-size: 14px;
        margin-bottom: 10px;
    }
</style>

<?php
include_once('../menu1.php');
?>


<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                Projects Lists
            </div>
            <div class="sub-container-right">
                <button type="button" type="button" class="ism-btns btn-normal" onclick="document.getElementById('manpower_summary_dialog').style.display='block'">
                    <i class="fa fa-users"></i>
                    Get Manpower Summary
                </button>
                <button onclick="tableToExcel('techapprovals', 'Projects List')" class="ism-btns btn-normal">
                    <i class="fa fa-file-excel-o"></i>
                    Export Excel
                </button>
                <?php
                if ($_newBtnAccess === true) {
                ?>

                    <button type="button" type="button" class="ism-btns btn-save" onclick="document.getElementById('dia_addnewProjects').style.display='block'">
                        <i class="fa fa-plus"></i>
                        Add New Project
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
        <div ng-show="isloading" class="sub-body-container-contents loadingdiv">
            <center>
                <img src="<?php echo $url_base ?>/themes/defload.gif" width="50px" height="50px">
                <br />
                <span style="margin-top:5px;">Please Wait Loading Data....</span>
            </center>
        </div>
        <div ng-show="!isloading" class="sub-body-container-contents">

            <table class="naf-tables" style="margin-bottom:5px;">
                <thead id="hidiv">
                    <tr>
                        <th style="width:20px" class="fiexdheader">#S.NO</th>
                        <?php
                        if ($_pdfaccess === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>

                        <th style="width:75px" class="fiexdheader">Contract No</th>
                        <th style="width:420px" class="fiexdheader">Project Name</th>
                        <th style="width:350px" class="fiexdheader">Contractor Name</th>
                        <th style="width:150px" class="fiexdheader">Location</th>
                        <?php
                        if ($_pdfaccess) {
                        ?>
                            <th style="width:150px" class="fiexdheader">Contract Value</th>
                        <?php
                        }
                        ?>

                        <th style="width:150px" class="fiexdheader">Sales Man</th>
                        <th style="width:150px" class="fiexdheader">Sign Date</th>
                        <th style="width:150px" class="fiexdheader">Duration</th>
                        <th style="width:150px" class="fiexdheader">Expiry Date</th>
                        <th class="fiexdheader">Technical (%)</th>
                        <th class="fiexdheader">Engineering (%)</th>
                        <th class="fiexdheader">Production (%)</th>
                        <th class="fiexdheader">Total (%)</th>
                        <th class="fiexdheader">Project (%)</th>
                        <th class="fiexdheader">Hand Over</th>
                        <th class="fiexdheader">Hand Over Date</th>
                    </tr>
                    <tr class="nx">
                        <th class="bg-whites fiexdheader-sort"></th>

                        <?php
                        if ($_pdfaccess === true) {
                        ?>
                            <th class="bg-whites fiexdheader-sort"></th>
                        <?php
                        }
                        ?>


                        <th class="bg-whites fiexdheader-sort">
                            <input ng-model="src_project.project_no" class="nafco-inputs" type="text" placeholder="search...">
                        </th>
                        <th class="bg-whites fiexdheader-sort">
                            <input ng-model="src_project.project_name" class="nafco-inputs" type="text" placeholder="search...">
                        </th>
                        <th class="bg-whites fiexdheader-sort">
                            <input ng-model="src_project.project_cname" class="nafco-inputs" type="text" placeholder="search...">
                        </th>
                        <th style="width:100px" class="bg-whites fiexdheader-sort">
                            <input ng-model="src_project.project_location" class="nafco-inputs" type="text" placeholder="search...">
                        </th>
                        <?php
                        if ($_pdfaccess) {
                        ?>
                            <th class="bg-whites fiexdheader-sort"></th>
                        <?php
                        }
                        ?>

                        <th class="bg-whites fiexdheader-sort">
                            <input ng-model="src_project.Sales_Representative" class="nafco-inputs" type="text" placeholder="search...">
                        </th>
                        <th class="bg-whites fiexdheader-sort">

                        </th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort"></th>
                        <th class="bg-whites fiexdheader-sort">
                            <select ng-model="src_project.project_hadnover" class="nafco-inputs">
                                <option value="">All</option>
                                <option value="1">Initial Handing Over</option>
                                <option value="2">Partial Handing Over</option>
                                <option value="3">Final Handing Over</option>
                            </select>
                        </th>
                        <th class="bg-whites fiexdheader-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-class-odd="'oddtr'" ng-repeat="_p in (filtervalue=(_projects | filter:src_project | orderBy:'-projectsnodisp'))">
                        <td>{{$index+1}}</td>
                        <?php
                        if ($_pdfaccess === true) {
                        ?>
                            <td style='text-align:center'>
                                <a ng-show="_p.f==='1'" download="{{_p.project_name}} - {{_p.project_no}}.pdf"  class="link" href="<?php echo $url_base ?>assets/contract/{{_p.project_no_enc}}.pdf">
                                    <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:15px;">
                                </a>
                            </td>
                        <?php
                        }
                        ?>

                        <td>
                            <a href="" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goproject(_p.project_no_enc)">
                                {{_p.project_no | uppercase}}
                            </a>
                        </td>
                        <td>
                            <a href="" class="ism-btns btn-normal" style="padding:2px 5px" ng-click="goproject(_p.project_no_enc)">
                                {{_p.project_name}}
                            </a>
                        </td>
                        <td>
                            {{_p.project_cname}}
                        </td>
                        <td>
                            {{_p.project_location}}
                        </td>
                        <?php
                        if ($_pdfaccess) {
                        ?>
                            <td style="text-align:right">
                                {{_p.project_amount | number}}
                            </td>
                        <?php
                        }
                        ?>

                        <td>
                            {{_p.Sales_Representative}}
                        </td>
                        <td>
                            {{_p.project_singdate}}
                        </td>
                        <td>
                            {{_p.project_contract_duration}} Months
                        </td>
                        <td>
                            {{_p.project_expiry_date}}
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            <spane ng-if="_p.project_hadnover === '0'" style="color:red">
                                -
                            </spane>
                            <spane ng-if="_p.project_hadnover === '1'" style="color:orangered">
                                Initial Handing Over
                            </spane>
                            <spane ng-if="_p.project_hadnover === '2'" style="color:greenyellow">
                                Partial Handing Over
                            </spane>
                            <spane ng-if="_p.project_hadnover === '3'" style="color:green">
                                Final Handing Over
                            </spane>
                        </td>
                        <td>
                            <spane ng-if="_p.project_hadnover === '0'" style="color:red">
                                -
                            </spane>
                            <spane ng-if="_p.project_hadnover !== '0'" style="color:green">
                                {{_p.project_handover_date}}
                            </spane>
                        </td>
                    </tr>
                    <?php
                    if ($_pdfaccess === true) {
                    ?>
                        <tr>

                            <td colspan="6" style="text-align: right;">
                                Total Value
                            </td>
                            <td style="text-align: right;font-weight:bold">
                                {{filtervalue | sumrow:'project_amount' | number}}
                            </td>
                            <td colspan="11">

                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once('new.php');
?>
<table id='techapprovals' class="naf-tables" style="margin-bottom:5px;display:none !important">
    <thead id="hidiv">
        <tr>
            <th style="width:20px" class="fiexdheader">#S.NO</th>


            <th style="width:75px" class="fiexdheader">Contract No</th>
            <th style="width:420px" class="fiexdheader">Project Name</th>
            <th style="width:350px" class="fiexdheader">Contractor Name</th>
            <th style="width:150px" class="fiexdheader">Location</th>
            <?php
            if ($_pdfaccess) {
            ?>
                <th style="width:150px" class="fiexdheader">Contract Value</th>
            <?php
            }
            ?>

            <th style="width:150px" class="fiexdheader">Sales Man</th>
            <th style="width:150px" class="fiexdheader">Sign Date</th>
            <th style="width:150px" class="fiexdheader">Duration</th>
            <th style="width:150px" class="fiexdheader">Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-class-odd="'oddtr'" ng-repeat="_p in (filtervalue=(_projects | filter:src_project | orderBy:'-projectsnodisp'))">
            <td>{{$index+1}}</td>


            <td>

                {{_p.project_no | uppercase}}

            </td>
            <td>

                {{_p.project_name}}

            </td>
            <td>
                {{_p.project_cname}}
            </td>
            <td>
                {{_p.project_location}}
            </td>
            <?php
            if ($_pdfaccess) {
            ?>
                <td style="text-align:right">
                    {{_p.project_amount | number}}
                </td>
            <?php
            }
            ?>

            <td>
                {{_p.Sales_Representative}}
            </td>
            <td>
                {{_p.project_singdate}}
            </td>
            <td>
                {{_p.project_contract_duration}} Months
            </td>
            <td>
                {{_p.project_expiry_date}}
            </td>

        </tr>
        <?php
        if ($_pdfaccess === true) {
        ?>
            <tr>

                <td colspan="5" style="text-align: right;">
                    Total Value
                </td>
                <td style="text-align: right;font-weight:bold">
                    {{filtervalue | sumrow:'project_amount' | number}}
                </td>
                <td colspan="3">

                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


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

<style>
    .ism-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .ism-table th {
        background-color: #2c445c;
        color: #fff;
        font-weight: 400;
        padding: 3px 5px;
        text-align: left;
        border: 1px solid #2c445c;
    }

    .ism-table td {
        padding: 3px 5px;
        border: 1px solid #2c445c;
        background: #ffffff9e;
    }

    .dashboard-modal {
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 3;
        background-color: #34333354;
        overflow: auto;
        padding-top: 20px;
        backdrop-filter: blur(10px) saturate(180%);
        z-index: 99999999;
        min-height: 100vh;
    }

    .dashboard-modal-container {
        background-color: #e9e9e952;
        width: 800px;
        margin: 0 auto;
        border-radius: 8px;
        color: #000;
        padding: 0px 10px;
        font-family: segoeui;
        /* backdrop-filter: grayscale(1); */
        box-shadow: -4px -2px 15px 2px #9f9f9f78;

    }

    .dashboard-modal-title {
        color: #0603c8;
        font-size: 16px;
        font-weight: bolder;
        padding: 13px 0px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-modal-title i {
        color: #000;
        transition: all 0.2s;
    }

    .dashboard-modal-title i:hover {
        color: #f00;

    }

    .dasboard-modal-foot {
        padding: 20px 0px;
    }

    .list-of-employees-container {
        padding: 10px 20px;
        margin-top: 14px;
        height: 80%;
        overflow: auto;
    }

    .list-of-employees-container .ism-table {
        font-size: 14px;
    }

    .modal-employee-card {
        font-family: overpass;
        border: 1px dashed #1900d8;
        background-color: #f1f1f147;
        border-radius: 10px;
        box-shadow: inset -4px -7px 8px #baaeff38;
        padding: 17px 16px;
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .modal-employee-card-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .modal-employee-card-image-disp img {
        width: 100px;
        height: 100px;
        border-radius: 100%;
        margin-bottom: 12px;
    }

    .modal-employee-card-image-disp-fileno {
        font-size: 16px;
        color: #0603c8;
        font-weight: 700;
    }

    .modal-employee-card-details {
        margin-left: 30px;

    }

    .modal-employee-card-details-info {
        display: flex;
        align-items: center;
        width: 500px;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .employee-card-details-info-lable {
        width: 150px;
    }

    .employee-card-details-info-cemi {
        width: 10px;
    }

    .employee-card-details-info-detatils {
        width: 335px;
        font-weight: bold;
        color: #0603c8
    }

    .dashboard-modal-frms center .i:hover {
        color: #005f48;
    }

    .danger-border {
        border: 1px dashed #ff0000;
        box-shadow: inset 4px 6px 20px #ff000026;
    }

    .danger-border .modal-employee-card-image .modal-employee-card-image-disp-fileno,
    .danger-border .modal-employee-card-details .modal-employee-card-details-info .employee-card-details-info-detatils {
        color: #550000;
    }

    .tanger-tr td {
        background: #ffe7e7;
        color: #550000;
    }

    .dashboard-modal-frms i {
        padding: 4px;
    }
</style>


<div class="dashboard-modal" id="manpower_summary_dialog">
    <div class="dashboard-modal-container">
        <div class="dashboard-modal-title">
            <div>
                Manpower Summary Report Creator
            </div>
            <div>
                <i class="fa fa-times" onclick="document.getElementById('manpower_summary_dialog').style.display='none'"></i>
            </div>
        </div>
        <div class="dashboard-modal-body">
            <div class="dashboard-modal-search">
                <div class="dashboard-modal-frms">
                    <center>
                        <form name="getmanpower" id="manpower_reports" ng-submit="manpower_summaryreport()">

                            Star Date : <input type="text" ng-model="srcmanpower_date" class="ism-inputs" id="date_search" name='date_search' ng-modal="srcmanpower.date_search" style="margin:0 auto;width:250px;" placeholder="Enter Date" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="manpower_csigdate">
                            </br>
                            End Date : <input type="text" ng-model="srcmanpower_date1" class="ism-inputs" id="date_search1" name='date_search1' ng-modal="srcmanpower.date_searchs" style="margin:0 auto;width:250px;" placeholder="Enter Date" required ng-hijri-gregorian-datepicker datepicker-config="gregorianDatepickerConfigdotravels" selected-date="manpower_csigdatex">
                            </br>
                            <button type="submit" ng-disabled="getmanpower.$invalid" class="ism-btns btn-save" style="padding:2px 2px;"><i class="fa fa-check"></i> Search</button>
                        </form>
                    </center>

                </div>
            </div>
        </div>
        <div class="dasboard-modal-foot">
            <button type="button" class="ism-btns btn-delete" onclick="document.getElementById('manpower_summary_dialog').style.display='none'">
                <i class="fa fa-times"></i>
                Close
            </button>
        </div>
    </div>
</div>