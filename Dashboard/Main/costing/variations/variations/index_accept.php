<?php
session_start();
include_once('../../../../../conf.php');


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
                <button type="button" onclick="document.getElementById('dia_new_varation').style.display='flex';" class="ism-btns btn-normal">
                    <i class="fa fa-plus"></i>
                    Add
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
        <div ng-show="!isloading" class="sub-body-container-contents">
            <div class="naf-table-div">
                <div class="naf-pms-table">

                    <div class="naf-pms-row naf-pms-header">
                        <div class="naf-pms-cell  naf-pms-header-cell">S.No</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Actions</div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell">VO No</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Accepted Date</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Released Date</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Ref. NO</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Revision No</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Atte</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Contractor/Client</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Date</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Subject</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Description</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Total Amount</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Region</div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Sales Man</div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell">Status</div>
                    </div>
                    <div class="naf-pms-row  naf-pms-header" style='background-color:#efeeee;top:20px'>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell">
                            <input type="text" ng-model="src.vno" class="new-inputs-black" style="padding:5px">
                        </div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell">
                            <input type="text" ng-model="src.variation_refno" class="new-inputs-black" style="padding:5px">
                        </div>
                        <div class="naf-pms-cell  naf-pms-header-cell">
                            <input type="text" ng-model="src.revision_no" class="new-inputs-black" style="padding:5px">
                        </div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>
                        <div class="naf-pms-cell  naf-pms-header-cell"></div>


                    </div>

                    <div class="naf-pms-row {{v.variation_status === '1' ? 'bg-yellow' : ''}} {{v.variation_status === '4' ? 'bg-borwn' : ''}} {{v.variation_status === '2' ? 'bg-green' : ''}} {{v.variation_status === '5' ? 'bg-greens' : ''}}" ng-repeat="v in (xfilter = variationslist | filter : src)">
                        <div class="naf-pms-cell"> {{$index+1}}</div>
                        <div class="naf-pms-cell">
                            <div style="
                                display: block;
                                overflow: auto;
                            ">
                                <div style="display:flex;">
                                    <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="Revision_btnList(v)">
                                        <i class="fa fa-list" style="margin:0px;"></i>
                                        Revison List
                                    </button>
                                    <button id="create_new_supplier" type="button" class="ism-btns btn-save" style="padding:2px 5px;margin:2px" ng-click="editvariationsdialogs(v)">
                                        <i class="fa fa-pencil" style="margin:0px;"></i>
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="naf-pms-cell">
                            <a target="_blank" href="<?php echo $url_base ?>assets/variations/{{v.variation_token}}.pdf">
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                            </a>
                        </div>
                        <div class="naf-pms-cell"> {{v.vno}}</div>
                        <div class="naf-pms-cell"> {{v.approvedate_d}}</div>
                        <div class="naf-pms-cell"> {{v.reldate_d}}</div>
                        <div class="naf-pms-cell"> {{v.variation_refno}}</div>
                        <div class="naf-pms-cell"> {{v.revision_no}}</div>
                        <div class="naf-pms-cell"> {{v.variation_atten}}</div>
                        <div class="naf-pms-cell"> {{v.variation_to}}</div>
                        <div class="naf-pms-cell"> {{v.variation_date}}</div>
                        <div class="naf-pms-cell"> {{v.v_sub_name}}</div>
                        <div class="naf-pms-cell"> {{v.variation_description}}</div>
                        <div class="naf-pms-cell naf-pms-cell-number" style="font-weight:bold">{{v.variation_amount | number : fractionSize}}</div>
                        <div class="naf-pms-cell"> {{v.region_name}}</div>
                        <div class="naf-pms-cell"> {{v.salesman_code }} - {{v.salesman_name | uppercase}}</div>
                        <div class="naf-pms-cell">
                            <a target="_blank" href="<?php echo $url_base ?>assets/variation_status/{{v.variation_token}}.pdf">
                                <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                            </a>
                        </div>
                        <div class="naf-pms-cell" style="font-weight:bold">

                            <span class="fa fa-circle {{v.variation_status === '1' ? 'bg-yellow-fa' : ''}}  {{v.variation_status === '2' ? 'bg-green-fa' : ''}} {{v.variation_status === '5' ? 'bg-greens-fa' : ''}}"></span>
                            {{v.variation_status | statusfilter}}</div>

                    </div>
                </div>
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