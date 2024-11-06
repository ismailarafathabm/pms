<?php
session_start();
include_once('../../../../../conf.php');


$user_department = $_SESSION['nafco_alu_user_department'];
$username = $_SESSION['nafco_alu_user_name'];
$access_departments = ['estimate', 'Management', 'operation', 'accounts', 'superadmin', 'contract and operations'];
$access_buttons = ['estimation', 'superadmin', 'demo', 'operation@alunafco.com'];
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
    if ($username === $b) {
        $_btn_access = true;
        break;
    }
}
$_access_vbutton = false;
foreach ($access_vbuttons as $b) {
    if ($username === $b) {
        $_access_vbutton = true;
        break;
    }
}
$_access_vbuttonx = false;
foreach ($excel_exportbutton as $b) {
    if ($username === $b) {
        $_access_vbuttonx = true;
        break;
    }
}
include_once('../../../menu.php');
?>
<style>
    .naf-table-div {
        position: relative;
        display: block;
        background-color: #efeeee;
        overflow: auto;
        font-family: 'sfpro', -apple-system, BlinkMacSystemFont, 'se', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .naf-pms-table {
        border-collapse: collapse;
        word-break: break;
        display: table;
        white-space: nowrap;
    }

    .naf-pms-row {
        display: table-row;
        border: 1px solid #d8d5d5;

    }

    .naf-pms-cell {
        display: table-cell;
        padding: 3px 7px;
        font-size: 0.85rem;
        border: 1px solid #d8d5d5;
        color: #323131;
    }

    .naf-pms-cell-number {
        text-align: right;
    }

    .naf-pms-header {
        position: sticky;
        top: 0px;
        background-color: #c4d0d2;
        color: #000;
        font-weight: bold;
    }

    .bg-yellow {
        background-color: #fcf4e4;
    }

    .bg-yellow-fa {
        color: #e1984d;
    }

    .bg-yellow {
        background-color: #fcf4e4;
    }

    .bg-yellow-fa {
        color: #e1984d;
    }

    .bg-green {
        background-color: #e4fafc;
    }

    .bg-greens {
        background-color: #dbeeff;
    }

    .bg-green-fa {
        color: #4dbfe1;
    }

    .bg-greens-fa {
        color: #3b61a7;
    }

    .bg-red {
        background-color: #fce4e7;
    }

    .bg-red-fa {
        color: #ad4e5a;
    }
</style>

<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                {{'pending Variations' | uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_access) {
                ?>
                    <button type="button" onclick="btnExport()" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>
                <?php
                if ($_btn_access) {
                ?>
                    <button type="button" onclick="document.getElementById('dia_new_varation').style.display='flex'" class="ism-btns btn-normal">
                        <i class="fa fa-plus"></i>
                        Add
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
            <div class="naf-table-div">
                <?php
                include_once 'temp.php';
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'new.php';
include_once 'edit.php';
include_once 'revisoin.php';
include_once 'revisionlist.php';
include_once 'status.php';
?>


<div class="filterdialog" id="new-region">
    <div class="filterdialog-conatiner" style="width:335px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <span class="fa fa-plus"></span>
                </div>
                <div class="filterheadertext">
                    ADD NEW REGION
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('new-region').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_region" ng-submit="region_new_save()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Region Name</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="addnewregionname" name="addnewregionname" id="addnewregionname" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('new-region').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="save_new_region.$invalid">
                        <i ng-if="save_new_region.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_region.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- <div class="ism-dialogbox" id="new-region">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                ADD NEW REGION
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-region').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_region" ng-submit="region_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Region Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="addnewregionname" name="addnewregionname" id="addnewregionname" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-region').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_region.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_region.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_region.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> -->

<div class="filterdialog" id="new-variationsubject">
    <div class="filterdialog-conatiner" style="width:335px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <span class="fa fa-plus"></span>
                </div>
                <div class="filterheadertext">
                    ADD NEW VARIATION SUBJECT
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('new-variationsubject').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_subjectname" ng-submit="subjectname_new_save()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Subject Name</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="addnewsubjectname" name="addnewsubjectname" id="addnewsubjectname" required>

                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('new-variationsubject').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="save_new_subjectname.$invalid">
                        <i ng-if="save_new_subjectname.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_subjectname.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- <div class="ism-dialogbox" id="new-variationsubject">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                ADD NEW VARIATION SUBJECT
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-variationsubject').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_subjectname" ng-submit="subjectname_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Subject Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="addnewsubjectname" name="addnewsubjectname" id="addnewsubjectname" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-variationsubject').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_subjectname.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_subjectname.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_subjectname.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> -->


<div class="filterdialog" id="new-salesmanadd">
    <div class="filterdialog-conatiner" style="width:335px">
        <div class="fitlerdialogheader">
            <div class="filterheadertitle">
                <div class="filterheadericons">
                    <span class="fa fa-plus"></span>
                </div>
                <div class="filterheadertext">
                    ADD NEW SALES MAN
                </div>
            </div>
            <div class="filterheaderclosebtn" onclick="document.getElementById('new-salesmanadd').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_salesman" ng-submit="salesman_new_save()">
            <div class="filterdialogbody">
                <div class="filterdialogbodycontainer">
                    <div class="row">
                        <div class="new-lable">Sales Man Code</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="addsalesmancode" name="addsalesmancode" id="addsalesmancode" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="new-lable"> Sales Man Name</div>
                        <div class="inputitmes">
                            <input type="text" class="new-inputs-black" ng-model="addsalesmanname" name="addsalesmanname" id="addsalesmanname" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filterdialogfooter">
                <div class="rightbutton">
                    <button type="button" class="closenewbutton" onclick="document.getElementById('new-salesmanadd').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                </div>
                <div class="leftbuttons">
                    <button type="submit" class="savenewbutton" ng-disabled="save_new_salesman.$invalid">
                        <i ng-if="save_new_salesman.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_salesman.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- <div class="ism-dialogbox" id="new-salesmanadd">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                ADD NEW SALES MAN
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('new-salesmanadd').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="save_new_salesman" ng-submit="salesman_new_save()">
            <div class="dialog-body">
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sales Man Code
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="addsalesmancode" name="addsalesmancode" id="addsalesmancode" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Sales Man Name
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="addsalesmanname" name="addsalesmanname" id="addsalesmanname" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('new-salesmanadd').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="save_new_salesman.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="save_new_salesman.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!save_new_salesman.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> -->



<script type="text/javascript">
    // var tableToExcel = (function() {
    //     var uri = 'data:application/vnd.ms-excel;base64,',
    //         template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
    //         base64 = function(s) {
    //             return window.btoa(unescape(encodeURIComponent(s)))
    //         },
    //         format = function(s, c) {
    //             return s.replace(/{(\w+)}/g, function(m, p) {
    //                 return c[p];
    //             })
    //         }
    //     return function(table, name) {
    //         if (!table.nodeType) table = document.getElementById(table)
    //         var ctx = {
    //             worksheet: name || 'Worksheet',
    //             table: table.innerHTML
    //         }
    //         window.location.href = uri + base64(format(template, ctx))
    //     }
    // })()
    function btnExport() {
        var pjcno = document.getElementById("project_number_div").innerText;
        var pjname = document.getElementById("project_name_div").innerText;
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = document.getElementById('dvData');
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        //setting the file name
        a.download =`${pjname} [${pjcno}] - Variations.xls`;
        //triggering the function
        a.click();
        //just in case, prevent default behaviour
        ///e.preventDefault();
    }
</script>