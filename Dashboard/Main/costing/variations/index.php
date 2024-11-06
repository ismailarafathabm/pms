<?php
session_start();
include_once('../../../../conf.php');
$user_department = $_SESSION['nafco_alu_user_department'];
$access_departments = ['estimate', 'Management', 'operation', 'accounts', 'superadmin', 'contract and operations'];
$access_buttons = ['estimate', 'superadmin','operation'];
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

include_once('../../menu.php');
?>



<div class="sub-body">
    <div class="sub-body-container">
        <div class="sub-body-container-title">
            <div class="sub-container-left">
                <div class="rpt-backbtn" id="back_btn">
                    <i class="fa fa-arrow-left"></i>
                </div>
                {{'Variations' | uppercase}}
            </div>
            <div class="sub-container-right">
                <?php
                if ($_access_vbuttonx === true) {
                ?>

                    <button onclick="tableToExcel('variations', 'Variations List')" class="ism-btns btn-normal">
                        <i class="fa fa-file-excel-o"></i>
                        Export Excel
                    </button>
                <?php
                }
                ?>
                <?php

                if ($_btn_access === true) {
                ?>

                    <a type="button" onclick="document.getElementById('new-glassorder').style.display='block';document.getElementById('variation_refno_p2').focus()" ) class="ism-btns btn-normal">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
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

            <table class="naf-tables">
                <thead>
                    <tr>
                        <th class="fiexdheader">S.No</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>

                        <th class="fiexdheader">Ref No</th>
                        <th class="fiexdheader" style="width:50px;">Revision No</th>
                        <th class="fiexdheader">Atte</th>
                        <th class="fiexdheader">Contractor/Client</th>
                        <th class="fiexdheader" style="width:100px">Date</th>
                        <th class="fiexdheader">Subject</th>
                        <th class="fiexdheader">Description</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader" style="width:100px">Total Amount</th>
                        <?php
                        }
                        ?>

                        <th class="fiexdheader">Region</th>
                        <th class="fiexdheader">Sales Man</th>
                        <th class="fiexdheader">Status</th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="fiexdheader"></th>
                        <?php
                        }
                        ?>

                        <th class="fiexdheader" style="width:100px;">Actions</th>
                        <th class="fiexdheader">Who</th>
                        <th class="fiexdheader">Date</th>
                    </tr>
                    <tr class="nx">
                        <th class="bg-whites"></th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="bg-whites"></th>
                        <?php
                        }
                        ?>

                        <th class="bg-whites">
                            <input type="text" ng-model="fil.variation_refno" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.revision_no" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.variation_atten" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.variation_to" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.variation_date" class="nafco-inputs" placeholder="search...">
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fil.variation_subject" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="y in sublist123" value="{{y.v_sub_id}}">{{y.v_sub_name | uppercase}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <input type="text" ng-model="fil.variation_description" class="nafco-inputs" placeholder="search...">
                        </th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="bg-whites">
                                <input type="text" ng-model="fil.variation_amount" class="nafco-inputs" placeholder="search...">
                            </th>
                        <?php
                        }
                        ?>


                        <th class="bg-whites">
                            <select ng-model="fil.variation_region" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="x in listregion" value="{{x.region_id}}">{{x.region_name | uppercase}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fil.salesman_code" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option ng-repeat="x in salesmanlist" value="{{x.salesman_code}}">{{x.salesman_code}} - {{x.salesman_name | uppercase}}</option>
                            </select>
                        </th>
                        <th class="bg-whites">
                            <select ng-model="fil.variation_status" class="nafco-inputs">
                                <option value="">-Select-</option>
                                <option value="1">ISSUED FOR APPROVAL</option>
                                <option value="2">APPROVED</option>
                                <option value="3">{{'cancelled' | uppercase}}</option>
                                <option value="4">{{'dummy' | uppercase}}</option>
                            </select>
                        </th>
                        <?php
                        if ($_access === true) {
                        ?>
                            <th class="bg-whites"></th>
                        <?php
                        }
                        ?>

                        <th class="bg-whites"></th>
                        <th class="fiexdheader"></th>
                        <th class="fiexdheader"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="v in variationslist | filter:fil | orderBy:'-sdate'" class="{{v.variation_status==='3'?'trred':'' || v.variation_status==='1'?'tryellow':'' || v.variation_status==='2'?'trgreen':'' || v.variation_status==='4'?'trorange':''}}">
                        <td>
                            {{$index+1}}
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center>
                                    <a target="_blank" href="<?php echo $url_base ?>assets/variations/{{v.variation_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                        <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                            {{v.variation_refno}}

                        </td>
                        <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
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
                            <td style="font-weight:bold;text-align: right;">
                                {{v.variation_amount | number : fractionSize}}
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
                        <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
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
                            <p ng-if="v.variation_status==='5'">
                                <span ng-if="v.variation_status === '5'" class="fa fa-circle" style="color:#206a5d"></span>
                                {{'paid/Invoice' | uppercase}}
                            </p>
                        </td>
                        <?php
                        if ($_access === true) {
                        ?>
                            <td>
                                <center ng-if="v.variation_status !== '1' && v.variation_status !== '5'">
                                    <a target="_blank" href="<?php echo $url_base ?>assets/variation_status/{{v.variation_token}}.pdf">
                                        <img src="<?php echo $url_base ?>assets/pdfdownload.png?v=<?php echo $v ?>" style="width:18px;">
                                    </a>
                                </center>
                            </td>
                        <?php
                        }
                        ?>

                        <td>

                            <?php
                            if ($_btn_access === true) {
                            ?>
                                <button type="button" ng-click="AddNewRevision_btn(v)" class="ism-btns btn-normal" style="padding:2px 5px" ng-if="'<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='estimate' || '<?php echo $_SESSION['nafco_alu_user_department'] ?>'=='Management'">
                                    <i class="fa fa-plus"></i>
                                </button>
                            <?php
                            }
                            ?>


                            <button type="button" ng-click="Revision_btnList(v)" class="ism-btns btn-normal" style="padding:2px 5px">
                                <i class="fa fa-list"></i>
                            </button>
                            <?php
                            if ($_btn_access === true) {
                            ?>
                                <button type="button" ng-click="editvariationsdialogs(v)" class="ism-btns btn-normal" style="padding:2px 5px">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            <?php
                            }
                            ?>


                        </td>
                        <td>
                            {{v.whochange}}
                        </td>
                        <td>
                            {{v.datechange}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div style="display:none">
    <table class="project-list-table borderd" id="variations">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Ref No</th>
                <th style="width:50px;">Revision No</th>
                <th>Atte</th>
                <th>Contractor/Client</th>
                <th>Date</th>
                <th>Subject</th>
                <th>Description</th>
                <?php
                if ($_access === true) {
                ?>
                    <th>Total Amount</th>
                <?php
                }
                ?>

                <th>Region</th>
                <th>Sales Man</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="v in variationslist | filter:fil">
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{$index+1}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_refno}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.revision_no}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_atten}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_to}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_date}}
                </td>

                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.v_sub_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.variation_description}}
                </td>
                <?php
                if ($_access === true) {
                ?>
                    <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                        <p style="text-align:right"> {{v.variation_amount | number}}</p>
                    </td>
                <?php
                }
                ?>

                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.region_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
                    {{v.salesman_code}} - {{v.salesman_name}}
                </td>
                <td class="{{v.variation_status==='3'?'td-danger':'' || v.variation_status==='1'?'td-yellow':'' || v.variation_status==='2'?'td-green':'' || v.variation_status==='4'?'td-orange':''}}">
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
                    <p ng-if="v.variation_status==='5'">
                        {{'Paid/Invoice' | uppercase}}
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

<?php
include_once('list.php');
include_once('new.php');
include_once('edit.php');
include_once('revisionnew.php');
?>

<div class="ism-dialogbox" id="new-region">
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
</div>


<div class="ism-dialogbox" id="new-variationsubject">
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
</div>

<div class="ism-dialogbox" id="new-salesmanadd">
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
</div>



<div class="ism-dialogbox" id="change-status">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Estimaiton - Change Variation Status
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('change-status').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="status_change_frm1" id="status_change_frm1" enctype="multipart/form-data">
            <div class="dialog-body">
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Token variation
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_variation" name="token_variation" id="token_variation" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Token revision
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_revison" name="token_revison" id="token_revison" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-frm-ctrls" style="display:none">
                    <div class="dialog-frm-lable">
                        Project
                    </div>
                    <div class="dialog-frm-cemi">:</div>
                    <div class="dialog-frm-controls">
                        <input type="text" class="nafco-inputs" ng-model="changestatus.project_no" name="project_no" id="project_no" required>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Status
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="changestatus.status" name="status" id="status" required>
                                <option value="">-Select-</option>

                                <?php
                                if ($user_department === 'Management') {
                                ?>
                                    <option value="3">{{'cancelled' | uppercase}}</option>
                                <?php
                                } else {
                                ?>
                                    <option value="2">APPROVED</option>
                                    <option value="3">{{'cancelled' | uppercase}}</option>
                                    <option value="4">{{'dummy' | uppercase}}</option>
                                    <option value="5">{{'Paid/Invoice' | uppercase}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm" ng-show="changestatus.status==='5'">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Who?
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.who" name="who" id="who" ng-required="changestatus.status==='5'">
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm" ng-show="changestatus.status==='5'">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Date
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.datepaid" name="datepaid" id="datepaid" ng-required="changestatus.status==='5'">
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm" ng-hide="changestatus.status==='5'">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload PDF Document
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" class="nafco-inputs" name="pdffile" id="pdffile">
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('change-status').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="status_change_frm1.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="status_change_frm1.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!status_change_frm1.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="ism-dialogbox" id="change-status_other">
    <div class="ism-dialog-body" style="max-width:620px">
        <div class="dialog-head">
            <div class="dialog-head-title">
                <span class="fa fa-plus"></span>
                Change Variation Status
            </div>
            <div class="dialog-closebutton" onclick="document.getElementById('change-status_other').style.display='none'">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <form name="status_change_frm_others" id="status_change_frm" enctype="multipart/form-data">
            <div class="dialog-body">
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Token variation
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_variation" name="token_variation" id="token_variation" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Token revision
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.token_revison" name="token_revison" id="token_revison" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm nodis">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Project
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.project_no" name="project_no" id="project_no" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Status
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <select class="nafco-inputs" ng-model="changestatus.status" name="status" id="status" required>
                                <option value="">-Select-</option>
                                <option value="2">APPROVED</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Amount
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="text" class="nafco-inputs" ng-model="changestatus.revision_amount" name="amount" id="amount" required>
                        </div>
                    </div>
                </div>
                <div class="dialog-row-sm">
                    <div class="dialog-frm-ctrls">
                        <div class="dialog-frm-lable">
                            Upload PDF Document
                        </div>
                        <div class="dialog-frm-cemi">:</div>
                        <div class="dialog-frm-controls">
                            <input type="file" class="nafco-inputs" name="pdffile" id="pdffile">
                        </div>
                    </div>
                </div>
            </div>

            <div class="dialog-foot">
                <div class="dialog-foot-buttons">
                    <button type="button" class="ism-btns btn-close" onclick="document.getElementById('change-status_other').style.display='none'">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button ng-disabled="status_change_frm_others.$invalid" type="submit" class="ism-btns btn-save" name="save_approval_btn" id="save_approval_btn">
                        <i ng-if="status_change_frm_others.$invalid" class="fa fa-times" style="color:#cf84c2"></i>
                        <i ng-if="!status_change_frm_others.$invalid" class=" fa fa-check" style="color:#84cccf"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>